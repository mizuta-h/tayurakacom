<?php
/*
 * ヘッダーの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );


// タブの名前
function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_header_dp_default_options( $dp_default_options ) {

  //ヘッダーロゴ
	$dp_default_options['header_logo_type'] = 'type1';
	$dp_default_options['header_logo_font_size'] = '32';
	$dp_default_options['header_logo_font_size_mobile'] = '24';
	$dp_default_options['header_logo_image'] = false;
	$dp_default_options['header_logo_retina'] = '';
	$dp_default_options['header_logo_image_mobile'] = false;
	$dp_default_options['header_logo_retina_mobile'] = '';

  // トップページ用ロゴ
	$dp_default_options['index_header_logo_image'] = false;
	$dp_default_options['index_header_logo_retina'] = '';
	$dp_default_options['index_header_logo_image_mobile'] = false;
	$dp_default_options['index_header_logo_retina_mobile'] = '';

	// サイドメニューの設定
	$dp_default_options['side_menu_type'] = 'type2';
	$dp_default_options['side_menu_bg_opacity'] = '0.6';

	// カテゴリーの設定
	$dp_default_options['show_mega_category'] = 1;
	$dp_default_options['mega_category_headline'] = 'NEW POST';
	$dp_default_options['mega_category_sub_headline'] = '';
	$dp_default_options['mega_category_name_font_size'] = '26';
	$dp_default_options['mega_category_title_font_size'] = '18';
	$dp_default_options['mega_category_show_date'] = 1;
	$dp_default_options['mega_category_show_author'] = 1;

        $post_cats = get_terms("category",'orderby=term_order&hide_empty=true');
        foreach( $post_cats as $cat ){
          $cat_id = $cat->term_id;
          if (!isset($dp_default_options['cat'.$cat_id])) { $dp_default_options['cat'.$cat_id] = ''; }
        }

	// タグの設定
	$dp_default_options['show_mega_tag'] = 1;
	$dp_default_options['mega_tag_headline'] = 'TAG LIST';
	$dp_default_options['mega_tag_sub_headline'] = '';

        $tag_args = array( 'orderby' => 'name', 'order' => 'ASC' );
        $post_tags = get_tags($tag_args);
        foreach( $post_tags as $tag ){
          $tag_id = $tag->term_id;
          if (!isset($dp_default_options['tag'.$tag_id])) { $dp_default_options['tag'.$tag_id] = 1; }
        }

  // ナビメニュー / フリースペース
  $dp_default_options['show_navi_menu'] = 0;
  $dp_default_options['navi_menu_headline'] = 'MENU';
  $dp_default_options['navi_menu_sub_headline'] = '';
  $dp_default_options['show_free_space1'] = 0;
  $dp_default_options['navi_menu_free_space1_headline'] = '';
  $dp_default_options['navi_menu_free_space1_sub_headline'] = '';
  $dp_default_options['navi_menu_free_space1'] = '';
  $dp_default_options['show_free_space2'] = 0;
  $dp_default_options['navi_menu_free_space2_headline'] = '';
  $dp_default_options['navi_menu_free_space2_sub_headline'] = '';
  $dp_default_options['navi_menu_free_space2'] = '';


	// ドロワーメニューの設定
	$dp_default_options['drawer_menu_font_color'] = '#ffffff';
	$dp_default_options['drawer_menu_parent_bg_color'] = '#262626';
	$dp_default_options['drawer_menu_child_bg_color'] = '#2d2d2d';
	$dp_default_options['drawer_menu_font_color_hover'] = '#d9d900';
	$dp_default_options['drawer_menu_font_color_hover_use_main'] = '1';

	// モバイル用メニューの設定
	$dp_default_options['mobile_header_bg_color_opacity'] = '1';
	$dp_default_options['mobile_header_bg_color'] = '#ffffff';
	$dp_default_options['mobile_menu_font_color'] = '#ffffff';
	$dp_default_options['mobile_menu_bg_color'] = '#000000';
	$dp_default_options['mobile_menu_sub_menu_bg_color'] = '#333333';
	$dp_default_options['mobile_menu_bg_hover_color'] = '#444444';
	$dp_default_options['mobile_menu_border_color'] = '#444444';
	$dp_default_options['mobile_menu_ad_code'] = '';

  // サイトの説明文
	$dp_default_options['show_site_description'] = '1';

  // パンくずリンクの設定
	$dp_default_options['show_header_breadcrumb_link'] = '1';

  // 検索フォーム
	$dp_default_options['show_header_search'] = '1';
	$dp_default_options['show_header_search_mobile'] = '1';

  // メッセージ
	$dp_default_options['show_header_message'] = '';
	$dp_default_options['header_message'] = '';
	$dp_default_options['header_message_font_color'] = '#000000';
	$dp_default_options['header_message_bg_color'] = '#ffff66';
  
  $dp_default_options['header_message_url'] = '';
  $dp_default_options['header_message_target'] = 0;


	return $dp_default_options;
}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_tab_panel( $options ) {

  global $dp_default_options, $header_fix_options, $header_fix_options2, $content_width_options, $font_type_options, $logo_type_options;

?>

<div id="tab-content-header" class="tab-content">


   <?php // ヘッダーのロゴの設定 ----------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header logo setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Type of logo', 'tcd-w');  ?></h4>
     <ul class="design_radio_button select_logo_type">
      <?php foreach ( $logo_type_options as $option ) { ?>
      <li>
       <input type="radio" class="logo_type_option_<?php esc_attr_e( $option['value'] ); ?>" id="header_logo_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[header_logo_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['header_logo_type'], $option['value'] ); ?> />
       <label for="header_logo_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>
     <div class="logo_text_area" style="<?php if( $options['header_logo_type'] == 'type1' ) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Font size setting', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[header_logo_font_size]" value="<?php echo esc_attr( $options['header_logo_font_size'] ); ?>"><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[header_logo_font_size_mobile]" value="<?php echo esc_attr( $options['header_logo_font_size_mobile'] ); ?>"><span>px</span></li>
      </ul>
     </div>
     <div class="logo_image_area" style="<?php if( $options['header_logo_type'] == 'type2' ) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Logo image', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p>
       <?php printf( __( 'TCD demo site use [Width: %dpx, Height: %dpx] sizes of the logo image for Retina Display.', 'tcd-w' ), 225, 54 ); ?><br>
        <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?><br>
        <?php  _e( 'In order to avoid blurring images on retina displays, it is necessary to register an image that is at least twice the size that is actually displayed. Read <a href="https://tcd-theme.com/2019/04/retina-display.html" target="_blank">TCD article</a> for more details.', 'tcd-w' ); ?>
       </p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js header_logo_image">
        <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image'] ); ?>" id="header_logo_image" name="dp_options[header_logo_image]" class="cf_media_id">
        <div class="preview_field"><?php if($options['header_logo_image']){ echo wp_get_attachment_image($options['header_logo_image'], 'full'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
      <p><label><input name="dp_options[header_logo_retina]" type="checkbox" value="1" <?php checked( '1', $options['header_logo_retina'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
      <h4 class="theme_option_headline2"><?php _e('Logo image (mobile)', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p>
       <?php printf( __( 'TCD demo site use [Width: %dpx, Height: %dpx] sizes of the logo image for Retina Display.', 'tcd-w' ), 160, 38 ); ?><br />
        <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?>
       </p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js header_logo_image_mobile">
        <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image_mobile'] ); ?>" id="header_logo_image_mobile" name="dp_options[header_logo_image_mobile]" class="cf_media_id">
        <div class="preview_field"><?php if($options['header_logo_image_mobile']){ echo wp_get_attachment_image($options['header_logo_image_mobile'], 'full'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image_mobile']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
      <p><label><input name="dp_options[header_logo_retina_mobile]" type="checkbox" value="1" <?php checked( '1', $options['header_logo_retina_mobile'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
      <h4 class="theme_option_headline2"><?php _e('Front page logo image', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p>
       <?php printf( __( 'TCD demo site use [Width: %dpx, Height: %dpx] sizes of the logo image for Retina Display.', 'tcd-w' ), 225, 54 ); ?><br>
        <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?>
       </p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js index_header_logo_image">
        <input type="hidden" value="<?php echo esc_attr( $options['index_header_logo_image'] ); ?>" id="index_header_logo_image" name="dp_options[index_header_logo_image]" class="cf_media_id">
        <div class="preview_field"><?php if($options['index_header_logo_image']){ echo wp_get_attachment_image($options['index_header_logo_image'], 'full'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['index_header_logo_image']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
      <p><label><input name="dp_options[index_header_logo_retina]" type="checkbox" value="1" <?php checked( '1', $options['index_header_logo_retina'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
      <h4 class="theme_option_headline2"><?php _e('Front page logo image (mobile)', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p>
       <?php printf( __( 'TCD demo site use [Width: %dpx, Height: %dpx] sizes of the logo image for Retina Display.', 'tcd-w' ), 160, 38 ); ?><br />
        <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?>
       </p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js index_header_logo_image_mobile">
        <input type="hidden" value="<?php echo esc_attr( $options['index_header_logo_image_mobile'] ); ?>" id="index_header_logo_image_mobile" name="dp_options[index_header_logo_image_mobile]" class="cf_media_id">
        <div class="preview_field"><?php if($options['index_header_logo_image_mobile']){ echo wp_get_attachment_image($options['index_header_logo_image_mobile'], 'full'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['index_header_logo_image_mobile']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
      <p><label><input name="dp_options[index_header_logo_retina_mobile]" type="checkbox" value="1" <?php checked( '1', $options['index_header_logo_retina_mobile'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ヘッダーその他の設定 ----------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header other setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display breadcrumb link', 'tcd-w');  ?></span><input name="dp_options[show_header_breadcrumb_link]" type="checkbox" value="1" <?php checked( '1', $options['show_header_breadcrumb_link'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display search form', 'tcd-w');  ?></span><input name="dp_options[show_header_search]" type="checkbox" value="1" <?php checked( '1', $options['show_header_search'] ); ?> /></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // サイドメニューの設定 ----------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Side menu setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Side menu type', 'tcd-w'); ?></h4>
     <input class="tcd_admin_image_radio_button" id="side_menu_type1" type="radio" name="dp_options[side_menu_type]" value="type1" <?php checked( $options['side_menu_type'], 'type1' ); ?>>
     <label for="side_menu_type1" id="side_menu_type1_button">
       <span class="image_wrap"><img src="<?php bloginfo('template_url'); ?>/admin/img/side_menu1.jpg?ver2" alt=""></span>
       <span class="title_wrap"><span class="title"><?php _e('Category and tag list', 'tcd-w'); ?></span></span>
     </label>
     <input class="tcd_admin_image_radio_button" id="side_menu_type2" type="radio" name="dp_options[side_menu_type]" value="type2" <?php checked( $options['side_menu_type'], 'type2' ); ?>>
     <label for="side_menu_type2" id="side_menu_type2_button">
       <span class="image_wrap"><img src="<?php bloginfo('template_url'); ?>/admin/img/side_menu2.jpg?ver2" alt=""></span>
       <span class="title_wrap"><span class="title"><?php _e('Drawer menu', 'tcd-w'); ?></span></span>
     </label>

     <div class="side_menu_type1_option">
      <h4 class="theme_option_headline2"><?php _e('Background overlay setting', 'tcd-w'); ?></h4>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[side_menu_bg_opacity]" value="<?php echo esc_attr( $options['side_menu_bg_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can edit site catchphrase from <a href="./options-general.php" target="_blank">basic setting page</a>.','tcd-w'); ?></p>
      <p><?php _e('You can set social button setting in <strong>"Basic setting"</strong> menu in theme option.','tcd-w'); ?></p>
      <p class="side_menu_type1_option"><?php _e('Catchphrase will be displayed inside drawer menu in mobile size.','tcd-w'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display site catchphrase on sidebar', 'tcd-w');  ?></span><input name="dp_options[show_site_description]" type="checkbox" value="1" <?php checked( '1', $options['show_site_description'] ); ?> /></li>
     </ul>


     <?php // カテゴリー、タグ一覧 ---------------------------------- ?>
     <div class="side_menu_type1_option">
     
     <h4 class="theme_option_headline2"><?php _e('Navigation menu setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_navi_menu]" type="checkbox" value="1" <?php checked( '1', $options['show_navi_menu'] ); ?> /> <?php _e('Display navigation menu', 'tcd-w');  ?></label></p>
     <div style="<?php if($options['show_navi_menu'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <p><?php _e('The navigation menu displays menus that are checked under "Global Menu" in <a href="./nav-menus.php">the menu settings</a>.', 'tcd-w'); ?></p>
      </div>
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[navi_menu_headline]" value="<?php echo esc_attr($options['navi_menu_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Subheading', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[navi_menu_sub_headline]" value="<?php echo esc_attr($options['navi_menu_sub_headline']); ?>"></li>
      </ul>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?>（<?php _e('upper part', 'tcd-w');  ?>）</h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_free_space1]" type="checkbox" value="1" <?php checked( '1', $options['show_free_space1'] ); ?> /> <?php printf( __('Display free space%s', 'tcd-w'), '（' .__('upper part', 'tcd-w') .'）' );  ?></label></p>
     <div style="<?php if($options['show_free_space1'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[navi_menu_free_space1_headline]" value="<?php echo esc_attr($options['navi_menu_free_space1_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Subheading', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[navi_menu_free_space1_sub_headline]" value="<?php echo esc_attr($options['navi_menu_free_space1_sub_headline']); ?>"></li>
      </ul>
      <?php wp_editor( $options['navi_menu_free_space1'], 'navi_menu_free_space1', array ( 'textarea_name' => 'dp_options[navi_menu_free_space1]' ) ); ?>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Category post setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_mega_category]" type="checkbox" value="1" <?php checked( '1', $options['show_mega_category'] ); ?> /> <?php _e('Display category post', 'tcd-w');  ?></label></p>
     <div style="<?php if($options['show_mega_category'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[mega_category_headline]" value="<?php echo esc_attr($options['mega_category_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Subheading', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[mega_category_sub_headline]" value="<?php echo esc_attr($options['mega_category_sub_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Font size of category', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mega_category_name_font_size]" value="<?php esc_attr_e( $options['mega_category_name_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mega_category_title_font_size]" value="<?php esc_attr_e( $options['mega_category_title_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[mega_category_show_date]" type="checkbox" value="1" <?php checked( '1', $options['mega_category_show_date'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[mega_category_show_author]" type="checkbox" value="1" <?php checked( '1', $options['mega_category_show_author'] ); ?> /></li>
      </ul>
      <h4 class="theme_option_headline4"><span><?php _e('Categories to display', 'tcd-w');  ?></span></h4>
      <div class="theme_option_message2">
       <p><?php _e('The categories which has post will be displayed in this option.</br>You can click each category button.<br>Blue colored category will be displayed in category list and gray colored category will not be displayed in category list.', 'tcd-w'); ?></p>
      </div>
      <?php
           $post_cats = get_terms("category",'orderby=term_order&hide_empty=true');
           if ( $post_cats && ! is_wp_error( $post_cats ) ) {
      ?>
      <ul class="tag_check_list">
       <?php
            foreach( $post_cats as $cat ):
              $cat_id = $cat->term_id;
              $cat_name = $cat->name;
       ?>
       <li>
        <label>
         <input name="dp_options[cat<?php echo $cat_id; ?>]" type="checkbox" value="1" <?php checked( $options['cat'.$cat_id], 1 ); ?> />
         <span><?php echo $cat_name ?></span>
        </label>
       </li>
       <?php endforeach; ?>
      </ul>
      <?php } ?>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Tag list setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_mega_tag]" type="checkbox" value="1" <?php checked( '1', $options['show_mega_tag'] ); ?> /> <?php _e('Display tag list', 'tcd-w');  ?></label></p>
     <div style="<?php if($options['show_mega_tag'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[mega_tag_headline]" value="<?php echo esc_attr($options['mega_tag_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Subheading', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[mega_tag_sub_headline]" value="<?php echo esc_attr($options['mega_tag_sub_headline']); ?>"></li>
      </ul>
      <h4 class="theme_option_headline4"><span><?php _e('Tags to display', 'tcd-w');  ?></span></h4>
      <div class="theme_option_message2">
       <p><?php _e('Registered post tags will be displayed in this option<br>You can click each tag button.<br>Blue colored tag will be displayed in tag list and gray colored tag will not be displayed in tag list.', 'tcd-w'); ?></p>
      </div>
      <?php
           $tag_args = array( 'orderby' => 'name', 'order' => 'ASC' );
           $post_tags = get_tags($tag_args);
           if ( $post_tags && ! is_wp_error( $post_tags ) ) {
      ?>
      <ul class="tag_check_list">
       <?php
            foreach( $post_tags as $tag ):
              $tag_id = $tag->term_id;
              $tag_name = $tag->name;
       ?>
       <li>
        <label>
         <input name="dp_options[tag<?php echo $tag_id; ?>]" type="checkbox" value="1" <?php checked( $options['tag'.$tag_id], 1 ); ?> />
         <span><?php echo $tag_name ?></span>
        </label>
       </li>
       <?php endforeach; ?>
      </ul>
      <?php } ?>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?>（<?php _e('lower part', 'tcd-w');  ?>）</h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_free_space2]" type="checkbox" value="1" <?php checked( '1', $options['show_free_space2'] ); ?> /> <?php printf( __('Display free space%s', 'tcd-w'), '（' .__('lower part', 'tcd-w') .'）' );  ?></label></p>
     <div style="<?php if($options['show_free_space2'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[navi_menu_free_space2_headline]" value="<?php echo esc_attr($options['navi_menu_free_space2_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Subheading', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[navi_menu_free_space2_sub_headline]" value="<?php echo esc_attr($options['navi_menu_free_space2_sub_headline']); ?>"></li>
      </ul>
      <?php wp_editor( $options['navi_menu_free_space2'], 'navi_menu_free_space2', array ( 'textarea_name' => 'dp_options[navi_menu_free_space2]' ) ); ?>
     </div>

     </div><!-- END #side_menu_type1_option -->

     <?php // ドロワーメニュー ---------------------------------- ?>
     <div class="side_menu_type2_option">

     <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[drawer_menu_font_color]" value="<?php echo esc_attr( $options['drawer_menu_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Font color on mouseover', 'tcd-w'); ?></span>
       <div class="use_main_color">
        <input type="text" name="dp_options[drawer_menu_font_color_hover]" value="<?php echo esc_attr( $options['drawer_menu_font_color_hover'] ); ?>" data-default-color="#d9d900" class="c-color-picker">
       </div>
       <div class="use_main_color_checkbox">
        <label>
         <input name="dp_options[drawer_menu_font_color_hover_use_main]" type="checkbox" value="1" <?php checked( $options['drawer_menu_font_color_hover_use_main'], 1 ); ?>>
         <span><?php _e('Apply text hover color', 'tcd-w'); ?></span>
        </label>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Background color of parent menu', 'tcd-w'); ?></span><input type="text" name="dp_options[drawer_menu_parent_bg_color]" value="<?php echo esc_attr( $options['drawer_menu_parent_bg_color'] ); ?>" data-default-color="#262626" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color of child menu', 'tcd-w'); ?></span><input type="text" name="dp_options[drawer_menu_child_bg_color]" value="<?php echo esc_attr( $options['drawer_menu_child_bg_color'] ); ?>" data-default-color="#2d2d2d" class="c-color-picker"></li>
     </ul>

     </div><!-- END .side_menu_type2_option -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // モバイル用メニュー ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Mobile menu setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Header background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_header_bg_color]" value="<?php echo esc_attr( $options['mobile_header_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of fixed header background color', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_header_bg_color_opacity]" value="<?php echo esc_attr( $options['mobile_header_bg_color_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 1. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf side_menu_type2_option"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_font_color]" value="<?php echo esc_attr( $options['mobile_menu_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf side_menu_type2_option"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_border_color]" value="<?php echo esc_attr( $options['mobile_menu_border_color'] ); ?>" data-default-color="#444444" class="c-color-picker"></li>
      <li class="cf side_menu_type2_option"><span class="label"><?php _e('Background color of menu', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_bg_color]" value="<?php echo esc_attr( $options['mobile_menu_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf side_menu_type2_option"><span class="label"><?php _e('Background color of menu on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_bg_hover_color]" value="<?php echo esc_attr( $options['mobile_menu_bg_hover_color'] ); ?>" data-default-color="#444444" class="c-color-picker"></li>
      <li class="cf side_menu_type2_option"><span class="label"><?php _e('Background color of child menu', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_sub_menu_bg_color]" value="<?php echo esc_attr( $options['mobile_menu_sub_menu_bg_color'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
     </ul>

     <div class="side_menu_type2_option">

     <?php // 検索フォームの設定 ---------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Search form setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display search form inside mobile menu', 'tcd-w');  ?></span><input name="dp_options[show_header_search_mobile]" type="checkbox" value="1" <?php checked( '1', $options['show_header_search_mobile'] ); ?> /></li>
     </ul>

     <?php // バナーの設定 ---------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Additional content settings for mobile menu bottom area', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can display banners in HTML, Google calendar, SNS timeline, etc.', 'tcd-w');  ?></p>
     </div>
     <textarea class="full_width" cols="50" rows="10" name="dp_options[mobile_menu_ad_code]"><?php echo esc_textarea( $options['mobile_menu_ad_code'] ); ?></textarea>

     </div><!-- .side_menu_type2_option -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // メッセージ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header message setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
    <div class="theme_option_message2">
      <p><?php _e('The "header message" is displayed at the top of the site (above the header bar).', 'tcd-w'); ?></p>
    </div>

     <p class="displayment_checkbox"><label><input name="dp_options[show_header_message]" type="checkbox" value="1" <?php checked( '1', $options['show_header_message'] ); ?> /> <?php _e('Display header message', 'tcd-w');  ?></label></p>
     <div style="<?php if($options['show_header_message'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Message', 'tcd-w');  ?></h4>
      <!--<?php wp_editor( $options['header_message'], 'header_message', array ( 'textarea_name' => 'dp_options[header_message]' ) ); ?>-->
      <ul class="option_list">
        <li class="cf">
          <span class="label"><?php _e('Message', 'tcd-w');  ?></span>
          <textarea class="full_width" cols="50" rows="2" name="dp_options[header_message]"><?php echo esc_textarea( $options['header_message'] ); ?></textarea>
        </li>
        <li class="cf">
          <span class="label"><?php _e('URL', 'tcd-w');  ?></span>
          <div class="admin_link_option">
            <input id="dp_options[header_message_url]" class="full_width" type="text" name="dp_options[header_message_url]" value="<?php echo esc_attr( $options['header_message_url'] ); ?>" />
            <input type="hidden" name="dp_options[header_message_target]" value="" data-current-value=""><input id="header_message_target" class="admin_link_option_target" name="dp_options[header_message_target]" type="checkbox" value="1" <?php checked( $options['header_message_target'], 1 ); ?>>
            <label for="header_message_target">&#xe92a;</label>
          </div>
        </li>
      <!--</ul>-->

      <!--<h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Display on front page', 'tcd-w'); ?></span><input name="dp_options[show_header_message_top]" type="checkbox" value="1" <?php checked( $options['show_header_message_top'], 1 ); ?>></li>
       <li class="cf"><span class="label"><?php _e('Display on sub pages', 'tcd-w'); ?></span><input name="dp_options[show_header_message_sub]" type="checkbox" value="1" <?php checked( $options['show_header_message_sub'], 1 ); ?>></li>
      </ul>-->
      <!--<h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
      <ul class="design_radio_button">
       <?php foreach ( $content_width_options as $option ) { ?>
       <li>
        <input type="radio" id="header_message_width_<?php echo esc_attr($option['value']); ?>" name="dp_options[header_message_width]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['header_message_width'], $option['value'] ); ?> />
        <label for="header_message_width_<?php echo esc_attr($option['value']); ?>"><?php echo esc_html( $option['label'] ); ?></label>
       </li>
       <?php } ?>
      </ul>
      <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-w');  ?></h4>
      <ul class="option_list">-->
       <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[header_message_font_color]" value="<?php echo esc_attr( $options['header_message_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[header_message_bg_color]" value="<?php echo esc_attr( $options['header_message_bg_color'] ); ?>" data-default-color="#ffff66" class="c-color-picker"></li>
       <!--<li class="cf color_picker_bottom"><span class="label"><?php _e('Font color of text link', 'tcd-w'); ?></span><input type="text" name="dp_options[header_message_link_font_color]" value="<?php echo esc_attr( $options['header_message_link_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>-->
      </ul>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_header_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_theme_options_validate( $input ) {

  global $dp_default_options, $header_fix_options, $header_fix_options2, $content_width_options, $font_type_options, $logo_type_options;

  // ヘッダーロゴ
  if ( ! isset( $input['header_logo_type'] ) )
    $input['header_logo_type'] = null;
  if ( ! array_key_exists( $input['header_logo_type'], $logo_type_options ) )
    $input['header_logo_type'] = null;
  $input['header_logo_font_size'] = wp_filter_nohtml_kses( $input['header_logo_font_size'] );
  $input['header_logo_font_size_mobile'] = wp_filter_nohtml_kses( $input['header_logo_font_size_mobile'] );
  $input['header_logo_image'] = wp_filter_nohtml_kses( $input['header_logo_image'] );
  $input['header_logo_retina'] = ! empty( $input['header_logo_retina'] ) ? 1 : 0;
  $input['header_logo_image_mobile'] = wp_filter_nohtml_kses( $input['header_logo_image_mobile'] );
  $input['header_logo_retina_mobile'] = ! empty( $input['header_logo_retina_mobile'] ) ? 1 : 0;


  // トップページ用ヘッダーロゴ
  $input['index_header_logo_image'] = wp_filter_nohtml_kses( $input['index_header_logo_image'] );
  $input['index_header_logo_retina'] = ! empty( $input['index_header_logo_retina'] ) ? 1 : 0;
  $input['index_header_logo_image_mobile'] = wp_filter_nohtml_kses( $input['index_header_logo_image_mobile'] );
  $input['index_header_logo_retina_mobile'] = ! empty( $input['index_header_logo_retina_mobile'] ) ? 1 : 0;


  // パンくずリンクの設定
  $input['show_header_breadcrumb_link'] = ! empty( $input['show_header_breadcrumb_link'] ) ? 1 : 0;


  // サイドメニューの設定
  $input['side_menu_type'] = wp_filter_nohtml_kses( $input['side_menu_type'] );
  $input['show_site_description'] = ! empty( $input['show_site_description'] ) ? 1 : 0;
  $input['side_menu_bg_opacity'] = wp_filter_nohtml_kses( $input['side_menu_bg_opacity'] );


  // 検索フォームの設定
  $input['show_header_search'] = ! empty( $input['show_header_search'] ) ? 1 : 0;
  $input['show_header_search_mobile'] = ! empty( $input['show_header_search_mobile'] ) ? 1 : 0;


  // ナビメニューの設定
  $input['show_navi_menu'] = ! empty( $input['show_navi_menu'] ) ? 1 : 0;
  $input['navi_menu_headline'] = wp_filter_nohtml_kses( $input['navi_menu_headline'] );
  $input['navi_menu_sub_headline'] = wp_filter_nohtml_kses( $input['navi_menu_sub_headline'] );

  $input['show_free_space1'] = ! empty( $input['show_free_space1'] ) ? 1 : 0;
  $input['navi_menu_free_space1_headline'] = wp_filter_nohtml_kses( $input['navi_menu_free_space1_headline'] );
  $input['navi_menu_free_space1_sub_headline'] = wp_filter_nohtml_kses( $input['navi_menu_free_space1_sub_headline'] );
  $input['navi_menu_free_space1'] = wp_kses_post( $input['navi_menu_free_space1'] );
  $input['show_free_space2'] = ! empty( $input['show_free_space2'] ) ? 1 : 0;
  $input['navi_menu_free_space2_headline'] = wp_filter_nohtml_kses( $input['navi_menu_free_space2_headline'] );
  $input['navi_menu_free_space2_sub_headline'] = wp_filter_nohtml_kses( $input['navi_menu_free_space2_sub_headline'] );
  $input['navi_menu_free_space2'] = wp_kses_post( $input['navi_menu_free_space2'] );


  // カテゴリーの設定
  $input['show_mega_category'] = ! empty( $input['show_mega_category'] ) ? 1 : 0;
  $input['mega_category_headline'] = wp_filter_nohtml_kses( $input['mega_category_headline'] );
  $input['mega_category_sub_headline'] = wp_filter_nohtml_kses( $input['mega_category_sub_headline'] );
  $input['mega_category_name_font_size'] = wp_filter_nohtml_kses( $input['mega_category_name_font_size'] );
  $input['mega_category_title_font_size'] = wp_filter_nohtml_kses( $input['mega_category_title_font_size'] );
  $input['mega_category_show_date'] = ! empty( $input['mega_category_show_date'] ) ? 1 : 0;
  $input['mega_category_show_author'] = ! empty( $input['mega_category_show_author'] ) ? 1 : 0;

        $post_cats = get_terms("category",'orderby=term_order&hide_empty=true');
        foreach( $post_cats as $cat ){
          $cat_id = $cat->term_id;
          $input['cat'.$cat_id] = ! empty( $input['cat'.$cat_id] ) ? 1 : 0;
        }

  // タグの設定
  $input['show_mega_tag'] = ! empty( $input['show_mega_tag'] ) ? 1 : 0;
  $input['mega_tag_headline'] = wp_filter_nohtml_kses( $input['mega_tag_headline'] );
  $input['mega_tag_sub_headline'] = wp_filter_nohtml_kses( $input['mega_tag_sub_headline'] );

        $tag_args = array( 'orderby' => 'name', 'order' => 'ASC' );
        $post_tags = get_tags($tag_args);
        foreach( $post_tags as $tag ){
          $tag_id = $tag->term_id;
          $input['tag'.$tag_id] = ! empty( $input['tag'.$tag_id] ) ? 1 : 0;
        }


  // ドロワーメニューの設定
  $input['drawer_menu_font_color'] = wp_filter_nohtml_kses( $input['drawer_menu_font_color'] );
  $input['drawer_menu_parent_bg_color'] = wp_filter_nohtml_kses( $input['drawer_menu_parent_bg_color'] );
  $input['drawer_menu_child_bg_color'] = wp_filter_nohtml_kses( $input['drawer_menu_child_bg_color'] );
  $input['drawer_menu_font_color_hover'] = wp_filter_nohtml_kses( $input['drawer_menu_font_color_hover'] );
  $input['drawer_menu_font_color_hover_use_main'] = ! empty( $input['drawer_menu_font_color_hover_use_main'] ) ? 1 : 0;


  // モバイルメニューの設定
  $input['mobile_header_bg_color'] = wp_filter_nohtml_kses( $input['mobile_header_bg_color'] );
  $input['mobile_header_bg_color_opacity'] = wp_filter_nohtml_kses( $input['mobile_header_bg_color_opacity'] );
  $input['mobile_menu_font_color'] = wp_filter_nohtml_kses( $input['mobile_menu_font_color'] );
  $input['mobile_menu_bg_color'] = wp_filter_nohtml_kses( $input['mobile_menu_bg_color'] );
  $input['mobile_menu_bg_hover_color'] = wp_filter_nohtml_kses( $input['mobile_menu_bg_hover_color'] );
  $input['mobile_menu_sub_menu_bg_color'] = wp_filter_nohtml_kses( $input['mobile_menu_sub_menu_bg_color'] );
  $input['mobile_menu_border_color'] = wp_filter_nohtml_kses( $input['mobile_menu_border_color'] );
  $input['mobile_menu_ad_code'] = $input['mobile_menu_ad_code'];


  // メッセージ
  $input['show_header_message'] = ! empty( $input['show_header_message'] ) ? 1 : 0;
  $input['header_message'] = wp_kses_post( $input['header_message'] );
  $input['header_message_font_color'] = wp_filter_nohtml_kses( $input['header_message_font_color'] );
  $input['header_message_bg_color'] = wp_filter_nohtml_kses( $input['header_message_bg_color'] );
  $input['header_message_url'] = wp_filter_nohtml_kses( $input['header_message_url'] );
  $input['header_message_target'] = !empty( $input['header_message_target'] ) ? 1 : 0;

  return $input;

};


?>