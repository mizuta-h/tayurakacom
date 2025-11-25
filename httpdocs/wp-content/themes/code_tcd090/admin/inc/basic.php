<?php
/*
 * 基本設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_basic_dp_default_options' );


// Add label of basic tab
add_action( 'tcd_tab_labels', 'add_basic_tab_label' );


// Add HTML of basic tab
add_action( 'tcd_tab_panel', 'add_basic_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_basic_theme_options_validate' );


// タブの名前
function add_basic_tab_label( $tab_labels ) {
	$tab_labels['basic'] = __( 'Basic setting', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_basic_dp_default_options( $dp_default_options ) {

	// 色の設定
	$dp_default_options['main_color'] = '#d9d900';
	$dp_default_options['text_hover_color'] = '#d9d900';
	$dp_default_options['content_link_color'] = '#000000';
	$dp_default_options['content_link_hover_color'] = '#d9d900';
	$dp_default_options['content_link_hover_color_use_sub'] = '1';

	// フォントの種類
	$dp_default_options['content_font_type'] = 'type2';
	$dp_default_options['content_font_size'] = '16';
	$dp_default_options['content_font_size_mobile'] = '14';
	$dp_default_options['headline_font_type'] = 'type2';
	$dp_default_options['headline_font_size'] = '32';
	$dp_default_options['headline_font_size_mobile'] = '22';

	// アニメーションの設定
	$dp_default_options['hover_type'] = 'type1';
	$dp_default_options['hover1_zoom'] = '1.2';
	$dp_default_options['hover2_zoom'] = '1.2';
	$dp_default_options['hover3_direct'] = 'type1';
	$dp_default_options['hover3_opacity'] = '0.5';
	$dp_default_options['hover3_bgcolor'] = '#FFFFFF';
	$dp_default_options['hover4_opacity'] = '0.5';
	$dp_default_options['hover4_bgcolor'] = '#FFFFFF';

	// オリジナルスタイルの設定
	$dp_default_options['css_code'] = '';

	// オリジナルスクリプトの設定
	$dp_default_options['script_code'] = '';

	// ロードアイコンの設定
	$dp_default_options['show_load_screen'] = 'type1';
	$dp_default_options['load_icon'] = 'type1';
	$dp_default_options['load_time'] = 5000;
	$dp_default_options['load_color1'] = '#000000';
	$dp_default_options['load_bgcolor'] = '#ffffff';
	$dp_default_options['load_type4_image'] = 0;
	$dp_default_options['load_type4_image_retina'] = 0;
	$dp_default_options['load_type4_image_mobile'] = 0;
	$dp_default_options['load_type4_image_retina_mobile'] = 0;
	$dp_default_options['loading_message'] = '';
	$dp_default_options['loading_message_font_size'] = 16;
	$dp_default_options['loading_message_font_size_sp'] = 14;
	$dp_default_options['loading_message_font_type'] = 'type3';
	$dp_default_options['loading_message_color'] = '#000000';
	$dp_default_options['loading_message_no_dot'] = 0;
	$dp_default_options['load_screen_animation_type'] = 'type1';
	$dp_default_options['loading_message'] = '';
	$dp_default_options['loading_message_font_size'] = 16;
	$dp_default_options['loading_message_font_size_sp'] = 14;
	$dp_default_options['loading_message_font_type'] = 'type3';
	$dp_default_options['loading_message_color'] = '#000000';
	$dp_default_options['use_load_logo_animation'] = '';
	$dp_default_options['load_type5_catch'] = '';
	$dp_default_options['load_type5_catch_font_size'] = 36;
	$dp_default_options['load_type5_catch_font_size_sp'] = 20;
	$dp_default_options['load_type5_catch_font_type'] = 'type2';
	$dp_default_options['load_type5_catch_color'] = '#000000';

	// NO IMAGE
	$dp_default_options['no_image1'] = false;

	// SNSボタン
	$dp_default_options['sns_type_top'] = 'type1';
	$dp_default_options['sns_type_btm'] = 'type1';

	$dp_default_options['show_twitter_top'] = 1;
	$dp_default_options['show_fblike_top'] = 1;
	$dp_default_options['show_fbshare_top'] = 1;
	$dp_default_options['show_hatena_top'] = 1;
	$dp_default_options['show_pocket_top'] = 1;
	$dp_default_options['show_feedly_top'] = 1;
	$dp_default_options['show_rss_top'] = 1;
	$dp_default_options['show_pinterest_top'] = 1;

	$dp_default_options['show_twitter_btm'] = 1;
	$dp_default_options['show_fblike_btm'] = 1;
	$dp_default_options['show_fbshare_btm'] = 1;
	$dp_default_options['show_hatena_btm'] = 1;
	$dp_default_options['show_pocket_btm'] = 1;
	$dp_default_options['show_feedly_btm'] = 1;
	$dp_default_options['show_rss_btm'] = 1;
	$dp_default_options['show_pinterest_btm'] = 1;

	$dp_default_options['twitter_info'] = '';

  //SNS フッター
	$dp_default_options['show_footer_sns'] = '1';
	$dp_default_options['footer_facebook_url'] = '';
	$dp_default_options['footer_twitter_url'] = '';
	$dp_default_options['footer_instagram_url'] = '';
  $dp_default_options['footer_tiktok_url'] = '';
	$dp_default_options['footer_pinterest_url'] = '';
	$dp_default_options['footer_youtube_url'] = '';
	$dp_default_options['footer_contact_url'] = '';
	$dp_default_options['footer_show_rss'] = 1;

	$dp_default_options['footer_sns_color_type'] = 'type1';
	$dp_default_options['single_sns_color_type'] = 'type1';

  //SNS サイド
	$dp_default_options['show_side_sns'] = '1';
	$dp_default_options['side_facebook_url'] = '';
	$dp_default_options['side_twitter_url'] = '';
	$dp_default_options['side_instagram_url'] = '';
  $dp_default_options['side_tiktok_url'] = '';
	$dp_default_options['side_pinterest_url'] = '';
	$dp_default_options['side_youtube_url'] = '';
	$dp_default_options['side_contact_url'] = '';
	$dp_default_options['side_show_rss'] = 1;
	$dp_default_options['side_sns_color_type'] = 'type1';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_basic_tab_panel( $options ) {

  global $dp_default_options, $time_options, $load_screen_options, $load_icon_type, $font_type_options, $hover_type_options, $hover3_direct_options, $sns_type_options, $footer_bar_icon_options;

?>

<div id="tab-content-basic" class="tab-content">

   <div class="theme_option_message no_arrow" style="margin-top:0;">
    <p><?php _e('In order for your site to display correctly, you must first go through the <a href="options-reading.php">"Reading Settings"</a> in WordPress. Check <a href="https://tcd-theme.com/2022/07/wordpress-homepage.html" target="_blank" rel="nofollow">this TCD blog</a> for instructions on how to set it up.', 'tcd-w');  ?></p>
   </div>

   <?php // 色の設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Color setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'Accent color will be used mostly in pager, navigation menu, button, and underline animation.', 'tcd-w' ); ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Accent color', 'tcd-w'); ?></span><input type="text" name="dp_options[main_color]" value="<?php echo esc_attr( $options['main_color'] ); ?>" data-default-color="#d9d900" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Text hover color', 'tcd-w'); ?></span><input type="text" name="dp_options[text_hover_color]" value="<?php echo esc_attr( $options['text_hover_color'] ); ?>" data-default-color="#d9d900" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Single page text link color', 'tcd-w'); ?></span><input type="text" name="dp_options[content_link_color]" value="<?php echo esc_attr( $options['content_link_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Single page text link color on mouseover', 'tcd-w'); ?></span>
       <div class="use_main_color">
        <input type="text" name="dp_options[content_link_hover_color]" value="<?php echo esc_attr( $options['content_link_hover_color'] ); ?>" data-default-color="#d9d900" class="c-color-picker">
       </div>
       <div class="use_main_color_checkbox">
        <label>
         <input name="dp_options[content_link_hover_color_use_sub]" type="checkbox" value="1" <?php checked( $options['content_link_hover_color_use_sub'], 1 ); ?>>
         <span><?php _e('Apply text hover color', 'tcd-w'); ?></span>
        </label>
       </div>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フォントの種類 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Font setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Headline setting', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This settings will be applied to most of the headline and catchphrase.', 'tcd-w'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[headline_font_type]">
        <?php
             foreach ( $font_type_options as $option ) {
               if(strtoupper(get_locale()) == 'JA'){
                 $label = $option['label'];
               } else {
                 $label = $option['label_en'];
               }
        ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['headline_font_type'], $option['value'] ); ?>><?php echo esc_html($label); ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[headline_font_size]" value="<?php esc_attr_e( $options['headline_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[headline_font_size_mobile]" value="<?php esc_attr_e( $options['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Post contet setting', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'This setting will be used in post contents and descriptions.', 'tcd-w' ); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[content_font_type]">
        <?php
             foreach ( $font_type_options as $option ) {
               if(strtoupper(get_locale()) == 'JA'){
                 $label = $option['label'];
               } else {
                 $label = $option['label_en'];
               }
        ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['content_font_type'], $option['value'] ); ?>><?php echo esc_html($label); ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[content_font_size]" value="<?php esc_attr_e( $options['content_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[content_font_size_mobile]" value="<?php esc_attr_e( $options['content_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ホバーアニメーション ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Featured image setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Hover effect type', 'tcd-w'); ?></h4>

     <div class="theme_option_message2">
      <p><?php _e('You can select the thumbnail hover effect from 4 types.', 'tcd-w'); ?></p>
     </div>

     <ul class="design_radio_button">
      <?php foreach ( $hover_type_options as $option ) { ?>
      <li>
       <input type="radio" id="hover_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[hover_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['hover_type'], $option['value'] ); ?> />
       <label for="hover_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo esc_html( $option['label'] ); ?></label>
      </li>
      <?php } ?>
     </ul>

     <div id="hover_type1_area" style="<?php if($options['hover_type'] == 'type1'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Zoom in effect setting', 'tcd-w'); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Magnification rate', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="10" min="1" step="0.1" name="dp_options[hover1_zoom]" value="<?php esc_attr_e( $options['hover1_zoom'] ); ?>" /></li>
      </ul>
     </div>

     <div id="hover_type2_area" style="<?php if($options['hover_type'] == 'type2'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Zoom out effect setting', 'tcd-w'); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Reduction rate', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="10" min="1" step="0.1" name="dp_options[hover2_zoom]" value="<?php esc_attr_e( $options['hover2_zoom'] ); ?>" /></li>
      </ul>
     </div>

     <div id="hover_type3_area" style="<?php if($options['hover_type'] == 'type3'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Slide effect setting', 'tcd-w'); ?></h4>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Direction', 'tcd-w'); ?></span>
        <select name="dp_options[hover3_direct]">
         <?php foreach ( $hover3_direct_options as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['hover3_direct'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
         <?php } ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[hover3_bgcolor]" value="<?php echo esc_attr( $options['hover3_bgcolor'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Opacity of background color', 'tcd-w'); ?></span>
        <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[hover3_opacity]" value="<?php esc_attr_e( $options['hover3_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0 from 1.0. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <div id="hover_type4_area" style="<?php if($options['hover_type'] == 'type4'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Fade effect setting', 'tcd-w'); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[hover4_bgcolor]" value="<?php echo esc_attr( $options['hover4_bgcolor'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Opacity of background color', 'tcd-w'); ?></span>
        <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[hover4_opacity]" value="<?php esc_attr_e( $options['hover4_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0 from 1.0. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <h3 class="theme_option_headline2"><?php _e('Original alternate image for featured image', 'tcd-w');  ?></h3>
     <div class="theme_option_message2">
      <p><?php _e('You can register original alternate image for featured image.', 'tcd-w');  ?></p>
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '752', '468'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js no_image1">
       <input type="hidden" value="<?php echo esc_attr( $options['no_image1'] ); ?>" id="no_image1" name="dp_options[no_image1]" class="cf_media_id">
       <div class="preview_field"><?php if($options['no_image1']){ echo wp_get_attachment_image($options['no_image1'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['no_image1']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // SNSボタン  ------------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Social button setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('Top social button in single page', 'tcd-w');  ?></h3>
      <div class="sub_box_content">

       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This button will be displayed under post title area.', 'tcd-w');  ?></p>
        <p><?php _e('Facebook like button is displayed only when you select Button type 5 (Default button).', 'tcd-w'); ?></p>
        <p><?php _e('RSS button is not displayed if you select Button type 5 (Default button).', 'tcd-w'); ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Social button design', 'tcd-w');  ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <?php foreach ( $sns_type_options as $option ) { ?>
        <li>
         <input type="radio" id="sns_type_top_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[sns_type_top]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['sns_type_top'], $option['value'] ); ?> />
         <label for="sns_type_top_<?php esc_attr_e( $option['value'] ); ?>">
          <span><?php echo esc_html($option['label']); ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="" title="" />
         </label>
        </li>
        <?php } ?>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
       <ul>
        <li><label><input name="dp_options[show_twitter_top]" type="checkbox" value="1" <?php checked( '1', $options['show_twitter_top'] ); ?> /> <?php _e('Display X button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_fblike_top]" type="checkbox" value="1" <?php checked( '1', $options['show_fblike_top'] ); ?> /> <?php _e('Display facebook like button -Button type 5 (Default button) only', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_fbshare_top]" type="checkbox" value="1" <?php checked( '1', $options['show_fbshare_top'] ); ?> /> <?php _e('Display facebook share button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_hatena_top]" type="checkbox" value="1" <?php checked( '1', $options['show_hatena_top'] ); ?> /> <?php _e('Display hatena button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_pocket_top]" type="checkbox" value="1" <?php checked( '1', $options['show_pocket_top'] ); ?> /> <?php _e('Display pocket button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_rss_top]" type="checkbox" value="1" <?php checked( '1', $options['show_rss_top'] ); ?> /> <?php _e('Display rss button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_feedly_top]" type="checkbox" value="1" <?php checked( '1', $options['show_feedly_top'] ); ?> /> <?php _e('Display feedly button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_pinterest_top]" type="checkbox" value="1" <?php checked( '1', $options['show_pinterest_top'] ); ?> /> <?php _e('Display pinterest button', 'tcd-w');  ?></label></li>
       </ul>

       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('Bottom social button in single page', 'tcd-w');  ?></h3>
      <div class="sub_box_content">

       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This button will be displayed under post content.', 'tcd-w');  ?></p>
        <p><?php _e('Facebook like button is displayed only when you select Button type 5 (Default button).', 'tcd-w'); ?></p>
        <p><?php _e('RSS button is not displayed if you select Button type 5 (Default button).', 'tcd-w'); ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Social button design', 'tcd-w');  ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <?php foreach ( $sns_type_options as $option ) { ?>
        <li>
         <input type="radio" id="sns_type_btm_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[sns_type_btm]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['sns_type_btm'], $option['value'] ); ?> />
         <label for="sns_type_btm_<?php esc_attr_e( $option['value'] ); ?>">
          <span><?php echo esc_html($option['label']); ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="" title="" />
         </label>
        </li>
        <?php } ?>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
       <ul>
        <li><label><input name="dp_options[show_twitter_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_twitter_btm'] ); ?> /> <?php _e('Display X button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_fblike_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_fblike_btm'] ); ?> /> <?php _e('Display facebook like button-Button type 5 (Default button) only', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_fbshare_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_fbshare_btm'] ); ?> /> <?php _e('Display facebook share button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_hatena_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_hatena_btm'] ); ?> /> <?php _e('Display hatena button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_pocket_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_pocket_btm'] ); ?> /> <?php _e('Display pocket button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_rss_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_rss_btm'] ); ?> /> <?php _e('Display rss button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_feedly_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_feedly_btm'] ); ?> /> <?php _e('Display feedly button', 'tcd-w');  ?></label></li>
        <li><label><input name="dp_options[show_pinterest_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_pinterest_btm'] ); ?> /> <?php _e('Display pinterest button', 'tcd-w');  ?></label></li>
       </ul>

       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('Side menu social button', 'tcd-w');  ?></h3>
      <div class="sub_box_content">

       <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
       <ul>
        <li><label><input name="dp_options[show_side_sns]" type="checkbox" value="1" <?php checked( '1', $options['show_side_sns'] ); ?> /> <?php _e('Display SNS on side menu', 'tcd-w');  ?></label></li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Social button design', 'tcd-w');  ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <li>
         <input type="radio" id="side_sns_color_type1" name="dp_options[side_sns_color_type]" value="type1" <?php checked( $options['side_sns_color_type'], 'type1' ); ?> />
         <label for="side_sns_color_type1">
          <span><?php _e('Monochrome (TCD ver)', 'tcd-w');  ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type1.png" alt="" title="" />
         </label>
        </li>
        <li>
         <input type="radio" id="side_sns_color_type2" name="dp_options[side_sns_color_type]" value="type2" <?php checked( $options['side_sns_color_type'], 'type2' ); ?> />
         <label for="side_sns_color_type2">
          <span><?php _e('Official color', 'tcd-w');  ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type2.png" alt="" title="" />
         </label>
        </li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Link setting', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('Enter url of your X, Facebook, Instagram, Pinterest, Flickr, Tumblr, and contact page. Please leave the field empty if you don\'t want to display certain sns button.', 'tcd-w');  ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Instagram URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[side_instagram_url]" value="<?php echo esc_attr( $options['side_instagram_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('TikTok URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[side_tiktok_url]" value="<?php echo esc_attr( $options['side_tiktok_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('X URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[side_twitter_url]" value="<?php echo esc_attr( $options['side_twitter_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Facebook URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[side_facebook_url]" value="<?php echo esc_attr( $options['side_facebook_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Pinterest URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[side_pinterest_url]" value="<?php echo esc_attr( $options['side_pinterest_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Youtube URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[side_youtube_url]" value="<?php echo esc_attr( $options['side_youtube_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Contact page URL (You can use mailto:)', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[side_contact_url]" value="<?php echo esc_attr( $options['side_contact_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Display RSS button', 'tcd-w'); ?></span><input name="dp_options[side_show_rss]" type="checkbox" value="1" <?php checked( '1', $options['side_show_rss'] ); ?> /></li>
       </ul>

       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('Footer social button', 'tcd-w');  ?></h3>
      <div class="sub_box_content">

       <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
       <ul>
        <li><label><input name="dp_options[show_footer_sns]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_sns'] ); ?> /> <?php _e('Display SNS on footer', 'tcd-w');  ?></label></li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Social button design', 'tcd-w');  ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <li>
         <input type="radio" id="footer_sns_color_type1" name="dp_options[footer_sns_color_type]" value="type1" <?php checked( $options['footer_sns_color_type'], 'type1' ); ?> />
         <label for="footer_sns_color_type1">
          <span><?php _e('Monochrome (TCD ver)', 'tcd-w');  ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type1.png" alt="" title="" />
         </label>
        </li>
        <li>
         <input type="radio" id="footer_sns_color_type2" name="dp_options[footer_sns_color_type]" value="type2" <?php checked( $options['footer_sns_color_type'], 'type2' ); ?> />
         <label for="footer_sns_color_type2">
          <span><?php _e('Official color', 'tcd-w');  ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type2.png" alt="" title="" />
         </label>
        </li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Link setting', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('Enter url of your X, Facebook, Instagram, Pinterest, Flickr, Tumblr, and contact page. Please leave the field empty if you don\'t want to display certain sns button.', 'tcd-w');  ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Instagram URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_instagram_url]" value="<?php echo esc_attr( $options['footer_instagram_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('TikTok URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_tiktok_url]" value="<?php echo esc_attr( $options['footer_tiktok_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('X URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_twitter_url]" value="<?php echo esc_attr( $options['footer_twitter_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Facebook URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_facebook_url]" value="<?php echo esc_attr( $options['footer_facebook_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Pinterest URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_pinterest_url]" value="<?php echo esc_attr( $options['footer_pinterest_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Youtube URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_youtube_url]" value="<?php echo esc_attr( $options['footer_youtube_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Contact page URL (You can use mailto:)', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_contact_url]" value="<?php echo esc_attr( $options['footer_contact_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Display RSS button', 'tcd-w'); ?></span><input name="dp_options[footer_show_rss]" type="checkbox" value="1" <?php checked( '1', $options['footer_show_rss'] ); ?> /></li>
       </ul>

       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('Author profile social button', 'tcd-w');  ?></h3>
      <div class="sub_box_content">

       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('You can set each the social link from <a href="./users.php">user profile page</a>. Profile will be displayed in single page when you check displayment checkbox in profile page.', 'tcd-w');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Social button design', 'tcd-w');  ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <li>
         <input type="radio" id="single_sns_color_type1" name="dp_options[single_sns_color_type]" value="type1" <?php checked( $options['single_sns_color_type'], 'type1' ); ?> />
         <label for="single_sns_color_type1">
          <span><?php _e('Monochrome (TCD ver)', 'tcd-w');  ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type1.png" alt="" title="" />
         </label>
        </li>
        <li>
         <input type="radio" id="single_sns_color_type2" name="dp_options[single_sns_color_type]" value="type2" <?php checked( $options['single_sns_color_type'], 'type2' ); ?> />
         <label for="single_sns_color_type2">
          <span><?php _e('Official color', 'tcd-w');  ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type2.png" alt="" title="" />
         </label>
        </li>
       </ul>

       <input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <h4 class="theme_option_headline2"><?php _e('Setting for the X button', 'tcd-w');  ?></h4>
     <label style="margin-top:20px;"><?php _e('Set of X account. (ex.tcd_jp)', 'tcd-w');  ?></label>
     <input style="display:block; margin:.6em 0 1em;" id="dp_options[twitter_info]" class="regular-text" type="text" name="dp_options[twitter_info]" value="<?php esc_attr_e( $options['twitter_info'] ); ?>" />

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ロード画面の設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Loading screen setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e('You can set the load screen displayed during page transition.', 'tcd-w');  ?></p>
      <p><?php _e('You can set the load screen only on front page.', 'tcd-w');  ?></p>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Load icon display setting', 'tcd-w'); ?></h4>
     <ul class="design_radio_button">
      <?php foreach ( $load_screen_options as $option ) { ?>
      <li id="show_load_screen_<?php esc_attr_e( $option['value'] ); ?>_button">
       <input type="radio" id="show_load_screen_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[show_load_screen]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['show_load_screen'], $option['value'] ); ?> />
       <label for="show_load_screen_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>

     <div id="load_screen_options" style="<?php if($options['show_load_screen'] != 'type1') { echo 'display:block'; } else { echo 'display:none;'; }; ?>">

      <h4 class="theme_option_headline2"><?php _e('Icon setting', 'tcd-w');  ?></h4>
      <ul class="option_list" style="margin-bottom:20px;">
       <li class="cf">
        <span class="label"><?php _e('Type of loader', 'tcd-w'); ?></span>
        <select id="load_icon_type" name="dp_options[load_icon]">
         <?php foreach ( $load_icon_type as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['load_icon'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
         <?php } ?>
        </select>
       </li>
       <li class="cf" id="load_icon_color1" style="<?php if($options['load_icon'] == 'type1' || $options['load_icon'] == 'type2' || $options['load_icon'] == 'type3') { echo 'display:block'; } else { echo 'display:none;'; }; ?>"><span class="label"><?php _e('Load icon color', 'tcd-w'); ?></span><input type="text" name="dp_options[load_color1]" value="<?php echo esc_attr( $options['load_color1'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      </ul>

      <?php // ロゴ画像 ?>
      <div class="sub_box cf" id="load_icon_type4">
       <h3 class="theme_option_subbox_headline"><?php echo __('Logo setting', 'tcd-w'); ?></h3>
       <div class="sub_box_content">

        <h4 class="theme_option_headline2"><?php _e( 'Logo image', 'tcd-w' ); ?></h4>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js load_type4_image">
          <input type="hidden" value="<?php echo esc_attr( $options['load_type4_image'] ); ?>" id="load_type4_image" name="dp_options[load_type4_image]" class="cf_media_id">
          <div class="preview_field"><?php if ( $options['load_type4_image'] ) { echo wp_get_attachment_image( $options['load_type4_image'], 'full' ); } ?></div>
          <div class="button_area">
           <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['load_type4_image'] ) { echo 'hidden'; } ?>">
          </div>
         </div>
        </div>
        <p><label><input name="dp_options[load_type4_image_retina]" type="checkbox" value="1" <?php checked( 1, $options['load_type4_image_retina'] ); ?>><?php _e( 'Use retina display logo image', 'tcd-w' ); ?></label></p>

        <h4 class="theme_option_headline2"><?php _e( 'Logo image (mobile)', 'tcd-w' ); ?></h4>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js load_type4_image_mobile">
          <input type="hidden" value="<?php echo esc_attr( $options['load_type4_image_mobile'] ); ?>" id="load_type4_image_mobile" name="dp_options[load_type4_image_mobile]" class="cf_media_id">
          <div class="preview_field"><?php if ( $options['load_type4_image_mobile'] ) { echo wp_get_attachment_image( $options['load_type4_image_mobile'], 'full' ); } ?></div>
          <div class="button_area">
           <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['load_type4_image_mobile'] ) { echo 'hidden'; } ?>">
          </div>
         </div>
        </div>
        <p><label><input name="dp_options[load_type4_image_retina_mobile]" type="checkbox" value="1" <?php checked( 1, $options['load_type4_image_retina_mobile'] ); ?>><?php _e( 'Use retina display logo image', 'tcd-w' ); ?></label></p>

        <h4 class="theme_option_headline2"><?php _e( 'Logo animation', 'tcd-w' ); ?></h4>
        <p><label><input name="dp_options[use_load_logo_animation]" type="checkbox" value="1" <?php checked( 1, $options['use_load_logo_animation'] ); ?>><?php _e( 'Use logo animation', 'tcd-w' ); ?></label></p>

       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->

      <?php // キャッチフレーズ ?>
      <div class="sub_box cf" id="load_icon_type5">
       <h3 class="theme_option_subbox_headline"><?php echo __('Catchphrase setting', 'tcd-w'); ?></h3>
       <div class="sub_box_content">

        <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
        <textarea class="large-text" name="dp_options[load_type5_catch]" rows="3"><?php echo esc_attr( $options['load_type5_catch'] ); ?></textarea>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
          <select name="dp_options[load_type5_catch_font_type]">
           <?php foreach ( $font_type_options as $option ) { ?>
           <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['load_type5_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
           <?php } ?>
          </select>
         </li>
         <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[load_type5_catch_font_size]" value="<?php esc_attr_e( $options['load_type5_catch_font_size'] ); ?>" /><span>px</span></li>
         <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[load_type5_catch_font_size_sp]" value="<?php esc_attr_e( $options['load_type5_catch_font_size_sp'] ); ?>" /><span>px</span></li>
         <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[load_type5_catch_color]" value="<?php echo esc_attr( $options['load_type5_catch_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        </ul>

       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->

      <?php // ロード中メッセージ ?>
      <div class="sub_box cf" id="load_message_option">
       <h3 class="theme_option_subbox_headline"><?php echo __('Loading message setting', 'tcd-w'); ?></h3>
       <div class="sub_box_content">

        <h4 class="theme_option_headline2"><?php _e( 'Loading message', 'tcd-w' ); ?></h4>
        <div class="theme_option_message2">
         <p><?php _e('You can display loading message below logo image or catchphrase.', 'tcd-w');  ?></p>
        </div>
        <textarea class="large-text" id="loading_message" name="dp_options[loading_message]" rows="3"><?php echo esc_attr( $options['loading_message'] ); ?></textarea>
        <ul class="option_list">
         <li class="cf">
          <span class="label"><?php _e('Dot animation setting', 'tcd-w');  ?></span><label><input name="dp_options[loading_message_no_dot]" type="checkbox" value="1" <?php checked( 1, $options['loading_message_no_dot'] ); ?>><?php _e( 'Don\'t display dot animation', 'tcd-w' ); ?></label>
          <div class="theme_option_message2">
           <p><?php _e('Animated dot will be display behind loading message.', 'tcd-w');  ?></p>
          </div>
         </li>
         <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
          <select name="dp_options[loading_message_font_type]">
           <?php foreach ( $font_type_options as $option ) { ?>
           <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['loading_message_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
           <?php } ?>
          </select>
         </li>
         <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[loading_message_font_size]" value="<?php esc_attr_e( $options['loading_message_font_size'] ); ?>" /><span>px</span></li>
         <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[loading_message_font_size_sp]" value="<?php esc_attr_e( $options['loading_message_font_size_sp'] ); ?>" /><span>px</span></li>
         <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[loading_message_color]" value="<?php echo esc_attr( $options['loading_message_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        </ul>

       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->

      <h4 class="theme_option_headline2"><?php _e('Common setting', 'tcd-w');  ?></h4>
      <ul class="option_list" style="margin-bottom:20px;">
       <li class="cf" id="after_loading_effect_option" style="<?php if($options['show_load_screen'] == 'type2') { echo 'display:block'; } else { echo 'display:none;'; }; ?>">
        <span class="label"><?php _e('Screen animation after loading content', 'tcd-w'); ?></span>
        <select name="dp_options[load_screen_animation_type]">
         <option style="padding-right: 10px;" value="type1" <?php selected( $options['load_screen_animation_type'], 'type1' ); ?>><?php _e('Fade in', 'tcd-w'); ?></option>
         <option style="padding-right: 10px;" value="type2" <?php selected( $options['load_screen_animation_type'], 'type2' ); ?>><?php _e('Slide up', 'tcd-w'); ?></option>
         <option style="padding-right: 10px;" value="type3" <?php selected( $options['load_screen_animation_type'], 'type3' ); ?>><?php _e('Slide down', 'tcd-w'); ?></option>
        </select>
       </li>
       <li class="cf">
        <span class="label"><?php _e('Maximum display time of loading screen', 'tcd-w'); ?></span>
        <select name="dp_options[load_time]">
         <?php $i = 1; foreach ( $time_options as $option ): if( $i >= 2 && $i <= 10 ){ ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['load_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
         <?php }; $i++; endforeach; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[load_bgcolor]" value="<?php echo esc_attr( $options['load_bgcolor'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      </ul>

     </div><!-- END #load_screen_options -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ユーザーCSS用の自由記入欄 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Custom css displayed inside &lt;head&gt; tag', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'This css will be displayed inside &lt;head&gt; tag.<br />You don\'t need to enter &lt;style&gt; tag in this field.', 'tcd-w' ); ?></p>
      <p><?php _e('Example:<br><strong>.custom_css { font-size:12px; }</strong>', 'tcd-w');  ?></p>
     </div>
     <textarea id="dp_options[css_code]" class="large-text" cols="50" rows="10" name="dp_options[css_code]"><?php echo esc_textarea( $options['css_code'] ); ?></textarea>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // カスタムスクリプト用の自由記入欄 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Custom script displayed inside &lt;head&gt; tag', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'This script will be displayed inside &lt;head&gt; tag.', 'tcd-w' ); ?></p>
     </div>
     <textarea id="dp_options[script_code]" class="large-text" cols="50" rows="10" name="dp_options[script_code]"><?php echo esc_textarea( $options['script_code'] ); ?></textarea>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_basic_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_basic_theme_options_validate( $input ) {

  global $dp_default_options, $sns_type_options, $time_options, $load_screen_options, $load_icon_type, $font_type_options, $hover_type_options, $hover3_direct_options, $footer_bar_icon_options;

  // 色の設定
  $input['main_color'] = sanitize_hex_color( $input['main_color'] );
  $input['text_hover_color'] = sanitize_hex_color( $input['text_hover_color'] );
  $input['content_link_color'] = sanitize_hex_color( $input['content_link_color'] );
  $input['content_link_hover_color'] = sanitize_hex_color( $input['content_link_hover_color'] );
  $input['content_link_hover_color_use_sub'] = ! empty( $input['content_link_hover_color_use_sub'] ) ? 1 : 0;


  // フォントの種類
  if ( ! isset( $input['content_font_type'] ) )
    $input['content_font_type'] = null;
  if ( ! array_key_exists( $input['content_font_type'], $font_type_options ) )
    $input['content_font_type'] = null;
  $input['content_font_size'] = wp_filter_nohtml_kses( $input['content_font_size'] );
  $input['content_font_size_mobile'] = wp_filter_nohtml_kses( $input['content_font_size_mobile'] );

  if ( ! isset( $input['headline_font_type'] ) )
    $input['headline_font_type'] = null;
  if ( ! array_key_exists( $input['headline_font_type'], $font_type_options ) )
    $input['headline_font_type'] = null;
  $input['headline_font_size'] = wp_filter_nohtml_kses( $input['headline_font_size'] );
  $input['headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['headline_font_size_mobile'] );


  // アニメーションの設定
  if ( ! isset( $input['hover_type'] ) )
    $input['hover_type'] = null;
  if ( ! array_key_exists( $input['hover_type'], $hover_type_options ) )
    $input['hover_type'] = null;
  $input['hover1_zoom'] = wp_filter_nohtml_kses( $input['hover1_zoom'] );
  $input['hover2_zoom'] = wp_filter_nohtml_kses( $input['hover2_zoom'] );
  if ( ! isset( $input['hover3_direct'] ) )
    $input['hover3_direct'] = null;
  if ( ! array_key_exists( $input['hover3_direct'], $hover3_direct_options ) )
    $input['hover3_direct'] = null;
  $input['hover3_opacity'] = wp_filter_nohtml_kses( $input['hover3_opacity'] );
  $input['hover3_bgcolor'] = sanitize_hex_color( $input['hover3_bgcolor'] );
  $input['hover4_opacity'] = wp_filter_nohtml_kses( $input['hover4_opacity'] );
  $input['hover4_bgcolor'] = sanitize_hex_color( $input['hover4_bgcolor'] );

  // オリジナルスタイルの設定
  $input['css_code'] = $input['css_code'];


  // オリジナルスクリプトの設定
  $input['script_code'] = $input['script_code'];


  // ロードアイコンの設定
  if ( ! isset( $input['show_load_screen'] ) )
    $input['show_load_screen'] = null;
  if ( ! array_key_exists( $input['show_load_screen'], $load_screen_options ) )
    $input['show_load_screen'] = null;
  if ( ! isset( $input['load_icon'] ) || ! array_key_exists( $input['load_icon'], $load_icon_type ) )
    $input['load_icon'] = $dp_default_options['load_icon'];
  if ( ! isset( $input['load_time'] ) || ! array_key_exists( $input['load_time'], $time_options ) )
    $input['load_time'] = $dp_default_options['load_time'];
  $input['load_color1'] = sanitize_hex_color( $input['load_color1'] );
  $input['load_type4_image'] = absint( $input['load_type4_image'] );
  $input['load_type4_image_retina'] = ! empty( $input['load_type4_image_retina'] ) ? 1 : 0;
  $input['load_type4_image_mobile'] = absint( $input['load_type4_image_mobile'] );
  $input['load_type4_image_retina_mobile'] = ! empty( $input['load_type4_image_retina_mobile'] ) ? 1 : 0;
  $input['loading_message'] = sanitize_textarea_field( $input['loading_message'] );
  $input['loading_message_font_size'] = absint( $input['loading_message_font_size'] );
  $input['loading_message_font_size_sp'] = absint( $input['loading_message_font_size_sp'] );
  if ( ! isset( $input['loading_message_font_type'] ) || ! array_key_exists( $input['loading_message_font_type'], $font_type_options ) )
    $input['loading_message_font_type'] = $dp_default_options['loading_message_font_type'];
  $input['loading_message_color'] = sanitize_hex_color( $input['loading_message_color'] );
  $input['loading_message_no_dot'] = ! empty( $input['loading_message_no_dot'] ) ? 1 : 0;
  $input['load_screen_animation_type'] = sanitize_text_field( $input['load_screen_animation_type'] );
  $input['use_load_logo_animation'] = ! empty( $input['use_load_logo_animation'] ) ? 1 : 0;
  $input['load_type5_catch'] = sanitize_textarea_field( $input['load_type5_catch'] );
  $input['load_type5_catch_font_size'] = absint( $input['load_type5_catch_font_size'] );
  $input['load_type5_catch_font_size_sp'] = absint( $input['load_type5_catch_font_size_sp'] );
  if ( ! isset( $input['load_type5_catch_font_type'] ) || ! array_key_exists( $input['load_type5_catch_font_type'], $font_type_options ) )
    $input['load_type5_catch_font_type'] = $dp_default_options['load_type5_catch_font_type'];
  $input['load_type5_catch_color'] = sanitize_hex_color( $input['load_type5_catch_color'] );


  // NO IMAGE
  $input['no_image1'] = wp_filter_nohtml_kses( $input['no_image1'] );


  // SNSルボタン　上部
  if ( ! isset( $input['sns_type_top'] ) )
    $input['sns_type_top'] = null;
  if ( ! array_key_exists( $input['sns_type_top'], $sns_type_options ) )
    $input['sns_type_top'] = null;
  $input['show_twitter_top'] = ! empty( $input['show_twitter_top'] ) ? 1 : 0;
  $input['show_fblike_top'] = ! empty( $input['show_fblike_top'] ) ? 1 : 0;
  $input['show_fbshare_top'] = ! empty( $input['show_fbshare_top'] ) ? 1 : 0;
  $input['show_hatena_top'] = ! empty( $input['show_hatena_top'] ) ? 1 : 0;
  $input['show_pocket_top'] = ! empty( $input['show_pocket_top'] ) ? 1 : 0;
  $input['show_feedly_top'] = ! empty( $input['show_feedly_top'] ) ? 1 : 0;
  $input['show_rss_top'] = ! empty( $input['show_rss_top'] ) ? 1 : 0;
  $input['show_pinterest_top'] = ! empty( $input['show_pinterest_top'] ) ? 1 : 0;


  // SNSボタン　下部
  if ( ! isset( $input['sns_type_btm'] ) )
    $input['sns_type_btm'] = null;
  if ( ! array_key_exists( $input['sns_type_btm'], $sns_type_options ) )
    $input['sns_type_btm'] = null;
  $input['show_twitter_btm'] = ! empty( $input['show_twitter_btm'] ) ? 1 : 0;
  $input['show_fblike_btm'] = ! empty( $input['show_fblike_btm'] ) ? 1 : 0;
  $input['show_fbshare_btm'] = ! empty( $input['show_fbshare_btm'] ) ? 1 : 0;
  $input['show_hatena_btm'] = ! empty( $input['show_hatena_btm'] ) ? 1 : 0;
  $input['show_pocket_btm'] = ! empty( $input['show_pocket_btm'] ) ? 1 : 0;
  $input['show_feedly_btm'] = ! empty( $input['show_feedly_btm'] ) ? 1 : 0;
  $input['show_rss_btm'] = ! empty( $input['show_rss_btm'] ) ? 1 : 0;
  $input['show_pinterest_btm'] = ! empty( $input['show_pinterest_btm'] ) ? 1 : 0;


  // SNSボタン　Xボタン
  $input['twitter_info'] = wp_filter_nohtml_kses( $input['twitter_info'] );


  // フッターのSNSボタンの設定
  $input['show_footer_sns'] = ! empty( $input['show_footer_sns'] ) ? 1 : 0;
  $input['footer_facebook_url'] = wp_filter_nohtml_kses( $input['footer_facebook_url'] );
  $input['footer_twitter_url'] = wp_filter_nohtml_kses( $input['footer_twitter_url'] );
  $input['footer_instagram_url'] = wp_filter_nohtml_kses( $input['footer_instagram_url'] );
  $input['footer_tiktok_url'] = wp_filter_nohtml_kses( $input['footer_tiktok_url'] );
  $input['footer_pinterest_url'] = wp_filter_nohtml_kses( $input['footer_pinterest_url'] );
  $input['footer_youtube_url'] = wp_filter_nohtml_kses( $input['footer_youtube_url'] );
  $input['footer_contact_url'] = wp_filter_nohtml_kses( $input['footer_contact_url'] );
  $input['footer_show_rss'] = ! empty( $input['footer_show_rss'] ) ? 1 : 0;
  $input['footer_sns_color_type'] = wp_filter_nohtml_kses( $input['footer_sns_color_type'] );

  // 投稿者のSNSボタンの設定
  $input['single_sns_color_type'] = wp_filter_nohtml_kses( $input['single_sns_color_type'] );

  // フッターのSNSボタンの設定
  $input['show_side_sns'] = ! empty( $input['show_side_sns'] ) ? 1 : 0;
  $input['side_facebook_url'] = wp_filter_nohtml_kses( $input['side_facebook_url'] );
  $input['side_twitter_url'] = wp_filter_nohtml_kses( $input['side_twitter_url'] );
  $input['side_instagram_url'] = wp_filter_nohtml_kses( $input['side_instagram_url'] );
  $input['side_tiktok_url'] = wp_filter_nohtml_kses( $input['side_tiktok_url'] );
  $input['side_pinterest_url'] = wp_filter_nohtml_kses( $input['side_pinterest_url'] );
  $input['side_youtube_url'] = wp_filter_nohtml_kses( $input['side_youtube_url'] );
  $input['side_contact_url'] = wp_filter_nohtml_kses( $input['side_contact_url'] );
  $input['side_show_rss'] = ! empty( $input['side_show_rss'] ) ? 1 : 0;
  $input['side_sns_color_type'] = wp_filter_nohtml_kses( $input['side_sns_color_type'] );

  // 検索の対象
  $input['search_type_page'] = ! empty( $input['search_type_page'] ) ? 1 : 0;
  $input['search_result_no_post_label'] = wp_filter_nohtml_kses( $input['search_result_no_post_label'] );

  return $input;

};


?>