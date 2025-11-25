<?php
/*
 * ブログの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );


//  Add label of news tab
add_action( 'tcd_tab_labels', 'add_news_tab_label' );


// Add HTML of news tab
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );


// タブの名前
function add_news_tab_label( $tab_labels ) {
    $options = get_design_plus_option();
    $tab_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
    $tab_labels['news'] = $tab_label;
	return $tab_labels;
}


// 初期値
function add_news_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['news_label'] = __( 'News', 'tcd-w' );
    $dp_default_options['news_slug'] = 'news';

	// ヘッダー
	$dp_default_options['archive_news_header_catch'] = 'NEWS';
	$dp_default_options['archive_news_header_desc'] = '';
	$dp_default_options['archive_news_header_desc_mobile'] = '';

	$dp_default_options['archive_news_header_bg_image'] = false;
	$dp_default_options['archive_news_header_bg_image_mobile'] = false;
	$dp_default_options['archive_news_header_use_overlay'] = 1;
	$dp_default_options['archive_news_header_overlay_color'] = '#000000';
	$dp_default_options['archive_news_header_overlay_opacity'] = '0.3';

	// アーカイブページ
	$dp_default_options['archive_news_num'] = '9';
	$dp_default_options['archive_news_num_mobile'] = '6';
	$dp_default_options['archive_news_title_font_size'] = '18';
	$dp_default_options['archive_news_title_font_size_mobile'] = '16';
	$dp_default_options['archive_news_show_date'] = 1;
	$dp_default_options['archive_news_show_update'] = '';

	// 記事ページ
	$dp_default_options['single_news_title_font_size'] = '32';
	$dp_default_options['single_news_title_font_size_mobile'] = '18';
	$dp_default_options['single_news_show_date'] = 1;
	$dp_default_options['single_news_show_update'] = '';

	$dp_default_options['single_news_show_sns_top'] = 1;
	$dp_default_options['single_news_show_sns_btm'] = 1;
	$dp_default_options['single_news_show_copy_top'] = 1;
	
    // 記事ページのバナー
	$dp_default_options['single_news_top_ad_code'] = '';
	$dp_default_options['single_news_bottom_ad_code'] = '';
	$dp_default_options['single_news_mobile_ad_code'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $post_list_animation_type_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );

?>

<div id="tab-content-news" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-w'); ?></p>
     </div>
     <input class="full_width" type="text" name="dp_options[news_label]" value="<?php echo esc_attr($options['news_label']); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Slug', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input class="hankaku" type="text" name="dp_options[news_slug]" value="<?php echo sanitize_title( $options['news_slug'] ); ?>" /></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページのヘッダー設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page header setting', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set font size and font type from basic setting menu font setting option section.', 'tcd-w');  ?></p>
     </div>
     <input class="full_width" type="text" name="dp_options[archive_news_header_catch]" value="<?php echo esc_html($options['archive_news_header_catch']); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_news_header_desc]"><?php echo esc_textarea(  $options['archive_news_header_desc'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e('Description (mobile)', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please use this option if you want to display different description in mobile size.', 'tcd-w');  ?></p>
     </div>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_news_header_desc_mobile]"><?php echo esc_textarea(  $options['archive_news_header_desc_mobile'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '560'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js archive_news_header_bg_image">
       <input type="hidden" value="<?php echo esc_attr( $options['archive_news_header_bg_image'] ); ?>" id="archive_news_header_bg_image" name="dp_options[archive_news_header_bg_image]" class="cf_media_id">
       <div class="preview_field"><?php if($options['archive_news_header_bg_image']){ echo wp_get_attachment_image($options['archive_news_header_bg_image'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_news_header_bg_image']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Background image (mobile)', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '720', '960'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js archive_news_header_bg_image_mobile">
       <input type="hidden" value="<?php echo esc_attr( $options['archive_news_header_bg_image_mobile'] ); ?>" id="archive_news_header_bg_image_mobile" name="dp_options[archive_news_header_bg_image_mobile]" class="cf_media_id">
       <div class="preview_field"><?php if($options['archive_news_header_bg_image_mobile']){ echo wp_get_attachment_image($options['archive_news_header_bg_image_mobile'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_news_header_bg_image_mobile']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[archive_news_header_use_overlay]" type="checkbox" value="1" <?php checked( $options['archive_news_header_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['archive_news_header_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_news_header_overlay_color]" value="<?php echo esc_attr( $options['archive_news_header_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[archive_news_header_overlay_opacity]" value="<?php echo esc_attr( $options['archive_news_header_overlay_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page other setting', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php echo __('Post list setting', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Number of post to display per page', 'tcd-w'); ?></span>
       <select name="dp_options[archive_news_num]">
        <?php for($i=1; $i<= 15; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_news_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Number of post to display per page (mobile)', 'tcd-w'); ?></span>
       <select name="dp_options[archive_news_num_mobile]">
        <?php for($i=1; $i<= 10; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_news_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_news_title_font_size]" value="<?php esc_attr_e( $options['archive_news_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_news_title_font_size_mobile]" value="<?php esc_attr_e( $options['archive_news_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input class="display_option" data-option-name="archive_news_show_date" name="dp_options[archive_news_show_date]" type="checkbox" value="1" <?php checked( '1', $options['archive_news_show_date'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display modified date', 'tcd-w');  ?></span><input name="dp_options[archive_news_show_update]" type="checkbox" value="1" <?php checked( '1', $options['archive_news_show_update'] ); ?> /></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 記事ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Single page setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Post title area setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_news_title_font_size]" value="<?php esc_attr_e( $options['single_news_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_news_title_font_size_mobile]" value="<?php esc_attr_e( $options['single_news_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w');  ?></span><input class="display_option" data-option-name="single_news_show_date" name="dp_options[single_news_show_date]" type="checkbox" value="1" <?php checked( '1', $options['single_news_show_date'] ); ?> /></li>
      <li class="cf single_news_show_date"><span class="label"><?php _e('Display modified date', 'tcd-w');  ?></span><input name="dp_options[single_news_show_update]" type="checkbox" value="1" <?php checked( '1', $options['single_news_show_update'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display social button above post content', 'tcd-w');  ?></span><input name="dp_options[single_news_show_sns_top]" type="checkbox" value="1" <?php checked( '1', $options['single_news_show_sns_top'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button under post content', 'tcd-w');  ?></span><input name="dp_options[single_news_show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['single_news_show_sns_btm'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under featured image', 'tcd-w');  ?></span><input name="dp_options[single_news_show_copy_top]" type="checkbox" value="1" <?php checked( '1', $options['single_news_show_copy_top'] ); ?> /></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 広告 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Additional content settings', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e('You can display banners in HTML, Google calendar, SNS timeline, etc.', 'tcd-w');  ?></p>
     </div>

     <?php // メインコンテンツの上部 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Above main content', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This content will be displayed above main content.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Free HTML area', 'tcd-w');  ?></h4>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_top_ad_code]"><?php echo esc_textarea( $options['single_news_top_ad_code'] ); ?></textarea>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // メインコンテンツの下部 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Below main content', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This banner will be displayed after main content.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Free HTML area', 'tcd-w');  ?></h4>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_bottom_ad_code]"><?php echo esc_textarea( $options['single_news_bottom_ad_code'] ); ?></textarea>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // モバイル用 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Mobile device', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This content will be displayed in mobile device only.', 'tcd-w');  ?></p>
        <p><?php _e('This content will be display after main content and will be repleace by additional content for PC device.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Free HTML area', 'tcd-w');  ?></h4>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_mobile_ad_code]"><?php echo esc_textarea( $options['single_news_mobile_ad_code'] ); ?></textarea>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_news_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $post_list_animation_type_options;

  // 基本設定
  $input['news_label'] = wp_filter_nohtml_kses( $input['news_label'] );
  $input['news_slug'] = wp_filter_nohtml_kses( $input['news_slug'] );


  //ヘッダーの設定
  $input['archive_news_header_catch'] = wp_filter_nohtml_kses( $input['archive_news_header_catch'] );
  $input['archive_news_header_desc'] = wp_filter_nohtml_kses( $input['archive_news_header_desc'] );
  $input['archive_news_header_desc_mobile'] = wp_filter_nohtml_kses( $input['archive_news_header_desc_mobile'] );

  $input['archive_news_header_bg_image'] = wp_filter_nohtml_kses( $input['archive_news_header_bg_image'] );
  $input['archive_news_header_bg_image_mobile'] = wp_filter_nohtml_kses( $input['archive_news_header_bg_image_mobile'] );
  $input['archive_news_header_use_overlay'] = ! empty( $input['archive_news_header_use_overlay'] ) ? 1 : 0;
  $input['archive_news_header_overlay_color'] = wp_filter_nohtml_kses( $input['archive_news_header_overlay_color'] );
  $input['archive_news_header_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_news_header_overlay_opacity'] );


  // アーカイブ
  $input['archive_news_num'] = wp_filter_nohtml_kses( $input['archive_news_num'] );
  $input['archive_news_num_mobile'] = wp_filter_nohtml_kses( $input['archive_news_num_mobile'] );
  $input['archive_news_title_font_size'] = wp_filter_nohtml_kses( $input['archive_news_title_font_size'] );
  $input['archive_news_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_news_title_font_size_mobile'] );
  $input['archive_news_show_date'] = ! empty( $input['archive_news_show_date'] ) ? 1 : 0;
  $input['archive_news_show_update'] = ! empty( $input['archive_news_show_update'] ) ? 1 : 0;


  // 記事ページ
  $input['single_news_title_font_size'] = wp_filter_nohtml_kses( $input['single_news_title_font_size'] );
  $input['single_news_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_news_title_font_size_mobile'] );
  $input['single_news_show_date'] = ! empty( $input['single_news_show_date'] ) ? 1 : 0;
  $input['single_news_show_update'] = ! empty( $input['single_news_show_update'] ) ? 1 : 0;
  $input['single_news_show_sns_top'] = ! empty( $input['single_news_show_sns_top'] ) ? 1 : 0;
  $input['single_news_show_sns_btm'] = ! empty( $input['single_news_show_sns_btm'] ) ? 1 : 0;
  $input['single_news_show_copy_top'] = ! empty( $input['single_news_show_copy_top'] ) ? 1 : 0;


  // 記事ページのバナー広告
  $input['single_news_top_ad_code'] = $input['single_news_top_ad_code'];
  $input['single_news_bottom_ad_code'] = $input['single_news_bottom_ad_code'];
  $input['single_news_mobile_ad_code'] = $input['single_news_mobile_ad_code'];

	return $input;

};


?>