<?php
/*
 * ブログの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );


//  Add label of blog tab
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );


// Add HTML of blog tab
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );


// タブの名前
function add_blog_tab_label( $tab_labels ) {
	$tab_labels['blog'] = __( 'Blog', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_blog_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['blog_label'] = __( 'Blog', 'tcd-w' );

	// ヘッダー
	$dp_default_options['archive_blog_header_catch'] = 'BLOG';
	$dp_default_options['archive_blog_header_desc'] = '';
	$dp_default_options['archive_blog_header_desc_mobile'] = '';

	$dp_default_options['archive_blog_header_bg_image'] = false;
	$dp_default_options['archive_blog_header_bg_image_mobile'] = false;
	$dp_default_options['archive_blog_header_use_overlay'] = 1;
	$dp_default_options['archive_blog_header_overlay_color'] = '#000000';
	$dp_default_options['archive_blog_header_overlay_opacity'] = '0.3';

	// アーカイブページ
	$dp_default_options['archive_blog_catch'] = 'NEW POST';
	$dp_default_options['archive_blog_desc'] = '';

	$dp_default_options['show_archive_carousel'] = 1;
	$dp_default_options['archive_carousel_headline'] = 'PICKUP';
	$dp_default_options['archive_carousel_post_type'] = 'pickup_post';
	$dp_default_options['archive_carousel_post_order'] = 'rand';
	$dp_default_options['archive_carousel_num'] = '6';
	$dp_default_options['archive_carousel_num_mobile'] = '4';
	$dp_default_options['archive_carousel_title_font_size'] = '18';
	$dp_default_options['archive_carousel_title_font_size_mobile'] = '16';
	$dp_default_options['archive_carousel_show_date'] = 1;
	$dp_default_options['archive_carousel_show_category'] = 1;
	$dp_default_options['archive_carousel_show_author'] = 1;

	$dp_default_options['archive_blog_num'] = '9';
	$dp_default_options['archive_blog_num_mobile'] = '6';
	$dp_default_options['archive_blog_title_font_size'] = '18';
	$dp_default_options['archive_blog_title_font_size_mobile'] = '16';
	$dp_default_options['archive_blog_show_date'] = 1;
	$dp_default_options['archive_blog_show_update'] = '';
	$dp_default_options['archive_blog_show_category'] = 1;
	$dp_default_options['archive_blog_show_author'] = 1;
	$dp_default_options['archive_blog_show_ads'] = '';
	$dp_default_options['archive_blog_banner_num'] = '3';
	$dp_default_options['archive_blog_animation'] = 'type4';

	$dp_default_options['show_author_archive_page_link'] = '';
	$dp_default_options['archive_page_link_url'] = '';
	$dp_default_options['archive_page_link_label'] = __( 'Author list', 'tcd-w' );

	// 記事ページ
	$dp_default_options['single_blog_title_font_size'] = '32';
	$dp_default_options['single_blog_title_font_size_mobile'] = '18';
	$dp_default_options['single_blog_show_date'] = 1;
	$dp_default_options['single_blog_show_update'] = '';

	$dp_default_options['single_blog_show_comment'] = 1;
	$dp_default_options['single_blog_show_trackback'] = 1;
	$dp_default_options['single_blog_show_sns_top'] = 1;
	$dp_default_options['single_blog_show_sns_btm'] = 1;
	$dp_default_options['single_blog_show_copy_top'] = 1;
	$dp_default_options['single_blog_show_meta_box'] = '';
	$dp_default_options['single_blog_show_meta_author'] = 1;
	$dp_default_options['single_blog_show_meta_comment'] = 1;

	// 投稿者記事一覧
	$dp_default_options['author_tab_headline1'] = __( 'Author of this post', 'tcd-w' );
	$dp_default_options['author_tab_headline2'] = __( 'Authors recent post', 'tcd-w' );
	$dp_default_options['author_post_num'] = '3';

	// 関連記事
	$dp_default_options['show_related_post'] = 1;
	$dp_default_options['related_post_headline'] = 'RELATED';
	$dp_default_options['related_post_desc'] = '';
	$dp_default_options['related_post_num'] = '6';
	$dp_default_options['related_post_num_mobile'] = '4';
	$dp_default_options['related_post_title_font_size'] = '18';
	$dp_default_options['related_post_title_font_size_mobile'] = '16';
	$dp_default_options['related_post_show_date'] = 1;
	$dp_default_options['related_post_show_category'] = 1;
	$dp_default_options['related_post_show_author'] = 1;

	// 特集コンテンツ
	$dp_default_options['show_featured_post'] = 1;
	$dp_default_options['featured_post_headline'] = 'FEATURED';
	$dp_default_options['featured_post_type'] = 'featured_post';
	$dp_default_options['featured_post_order'] = 'rand';
	$dp_default_options['featured_post_desc'] = '';
	$dp_default_options['featured_post_num'] = '6';
	$dp_default_options['featured_post_num_mobile'] = '4';
	$dp_default_options['featured_post_title_font_size'] = '18';
	$dp_default_options['featured_post_title_font_size_mobile'] = '16';
	$dp_default_options['featured_post_show_date'] = 1;
	$dp_default_options['featured_post_show_category'] = 1;
	$dp_default_options['featured_post_show_author'] = 1;

	// 記事ページのバナー
	$dp_default_options['single_top_ad_code'] = '';
	$dp_default_options['single_bottom_ad_code'] = '';
	$dp_default_options['single_mobile_ad_code'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $post_list_animation_type_options;
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

?>

<div id="tab-content-blog" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-w'); ?></p>
     </div>
     <input class="full_width" type="text" name="dp_options[blog_label]" value="<?php echo esc_attr($options['blog_label']); ?>" />

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
     <input class="full_width" type="text" name="dp_options[archive_blog_header_catch]" value="<?php echo esc_html($options['archive_blog_header_catch']); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_blog_header_desc]"><?php echo esc_textarea(  $options['archive_blog_header_desc'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e('Description (mobile)', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please use this option if you want to display different description in mobile size.', 'tcd-w');  ?></p>
     </div>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_blog_header_desc_mobile]"><?php echo esc_textarea(  $options['archive_blog_header_desc_mobile'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '560'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js archive_blog_header_bg_image">
       <input type="hidden" value="<?php echo esc_attr( $options['archive_blog_header_bg_image'] ); ?>" id="archive_blog_header_bg_image" name="dp_options[archive_blog_header_bg_image]" class="cf_media_id">
       <div class="preview_field"><?php if($options['archive_blog_header_bg_image']){ echo wp_get_attachment_image($options['archive_blog_header_bg_image'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_blog_header_bg_image']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Background image (mobile)', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '720', '960'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js archive_blog_header_bg_image_mobile">
       <input type="hidden" value="<?php echo esc_attr( $options['archive_blog_header_bg_image_mobile'] ); ?>" id="archive_blog_header_bg_image_mobile" name="dp_options[archive_blog_header_bg_image_mobile]" class="cf_media_id">
       <div class="preview_field"><?php if($options['archive_blog_header_bg_image_mobile']){ echo wp_get_attachment_image($options['archive_blog_header_bg_image_mobile'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_blog_header_bg_image_mobile']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[archive_blog_header_use_overlay]" type="checkbox" value="1" <?php checked( $options['archive_blog_header_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['archive_blog_header_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_blog_header_overlay_color]" value="<?php echo esc_attr( $options['archive_blog_header_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[archive_blog_header_overlay_opacity]" value="<?php echo esc_attr( $options['archive_blog_header_overlay_opacity'] ); ?>" />
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

     <?php $home_page_id = get_option( 'page_for_posts' ); ?>
     <div class="theme_option_message2">
      <p><?php _e('Settings for the post archive page.', 'tcd-w'); ?></p>
      <?php
           if($home_page_id) {
             $home_page_url = get_page_link( $home_page_id );
             if($home_page_url){
      ?>
      <p><?php _e('URL of the post archive page:', 'tcd-w'); ?><a class="e_link" href="<?php echo esc_url($home_page_url) ?>"><?php echo esc_url($home_page_url) ?></a></p>
      <?php
             };
           } else {
      ?>
      <p><?php _e('The page for the post archive page is not set.', 'tcd-w'); ?>
         <?php _e('Please refer to the <a href="https://dl.tcd-theme.com/tcd090/display-setting/">manual</a> to create and configure.', 'tcd-w'); ?></p>
      <?php } ?>
     </div>

     <?php // カルーセル ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Carousel setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_archive_carousel]" type="checkbox" value="1" <?php checked( $options['show_archive_carousel'], 1 ); ?>><?php _e( 'Display carousel', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_archive_carousel'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[archive_carousel_headline]" value="<?php echo esc_attr($options['archive_carousel_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
        <select name="dp_options[archive_carousel_post_type]">
         <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['archive_carousel_post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w');  ?></option>
         <option style="padding-right: 10px;" value="featured_post" <?php selected( $options['archive_carousel_post_type'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w');  ?></option>
         <option style="padding-right: 10px;" value="pickup_post" <?php selected( $options['archive_carousel_post_type'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w');  ?></option>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
        <select name="dp_options[archive_carousel_post_order]">
         <option style="padding-right: 10px;" value="date" <?php selected( $options['archive_carousel_post_order'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
         <option style="padding-right: 10px;" value="rand" <?php selected( $options['archive_carousel_post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[archive_carousel_num]">
         <?php for($i=5; $i<= 12; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_carousel_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Number of post to display (mobile)', 'tcd-w');  ?></span>
        <select name="dp_options[archive_carousel_num_mobile]">
         <?php for($i=3; $i<= 12; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_carousel_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_carousel_title_font_size]" value="<?php esc_attr_e( $options['archive_carousel_title_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_carousel_title_font_size_mobile]" value="<?php esc_attr_e( $options['archive_carousel_title_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[archive_carousel_show_category]" type="checkbox" value="1" <?php checked( '1', $options['archive_carousel_show_category'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[archive_carousel_show_date]" type="checkbox" value="1" <?php checked( '1', $options['archive_carousel_show_date'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[archive_carousel_show_author]" type="checkbox" value="1" <?php checked( '1', $options['archive_carousel_show_author'] ); ?> /></li>
      </ul>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[archive_blog_catch]" value="<?php echo esc_html($options['archive_blog_catch']); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_blog_desc]"><?php echo esc_textarea(  $options['archive_blog_desc'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php echo __('Post list setting', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Number of post to display per page', 'tcd-w'); ?></span>
       <select name="dp_options[archive_blog_num]">
        <?php for($i=1; $i<= 15; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_blog_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Number of post to display per page (mobile)', 'tcd-w'); ?></span>
       <select name="dp_options[archive_blog_num_mobile]">
        <?php for($i=1; $i<= 10; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_blog_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Animation type', 'tcd-w'); ?></span>
       <select name="dp_options[archive_blog_animation]">
        <?php foreach ( $post_list_animation_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['archive_blog_animation'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
        <option style="padding-right: 10px;" value="type4" <?php selected( $options['archive_blog_animation'], 'type4' ); ?>><?php _e('No animation', 'tcd-w'); ?></option>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_blog_title_font_size]" value="<?php esc_attr_e( $options['archive_blog_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_blog_title_font_size_mobile]" value="<?php esc_attr_e( $options['archive_blog_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[archive_blog_show_category]" type="checkbox" value="1" <?php checked( '1', $options['archive_blog_show_category'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input class="display_option" data-option-name="archive_blog_show_date" name="dp_options[archive_blog_show_date]" type="checkbox" value="1" <?php checked( '1', $options['archive_blog_show_date'] ); ?> /></li>
      <li class="cf archive_blog_show_date"><span class="label"><?php _e('Display modified date', 'tcd-w');  ?></span><input name="dp_options[archive_blog_show_update]" type="checkbox" value="1" <?php checked( '1', $options['archive_blog_show_update'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[archive_blog_show_author]" type="checkbox" value="1" <?php checked( '1', $options['archive_blog_show_author'] ); ?> /></li>
      <li class="cf">
       <span class="label"><?php _e('Native ads setting', 'tcd-w'); ?></span>
       <p class="displayment_checkbox"><label><input name="dp_options[archive_blog_show_ads]" type="checkbox" value="1" <?php checked( $options['archive_blog_show_ads'], 1 ); ?>> <?php _e( 'Display native ads', 'tcd-w' ); ?></label></p>
       <div style="<?php if($options['archive_blog_show_ads'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
        <div class="theme_option_message2">
         <p><?php _e('Native ads will be displayed randomly at intervals of the number of articles set below.', 'tcd-w'); ?></p>
        </div>
        <p><input class="hankaku" style="width:70px;" type="number" max="9999" min="1" step="1" name="dp_options[archive_blog_banner_num]" value="<?php echo esc_attr( $options['archive_blog_banner_num'] ); ?>" /></p>
       </div>
      </li>
     </ul>

     <?php // 投稿者ページ ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Author archive page setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please create author list page from <a href="./edit.php?post_type=page" target="_blank">WP pages</a> before using this options.', 'tcd-w'); ?></p>
     </div>
     <p class="displayment_checkbox"><label><input name="dp_options[show_author_archive_page_link]" type="checkbox" value="1" <?php checked( $options['show_author_archive_page_link'], 1 ); ?>><?php _e( 'Display author list page on breadcrumb link', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_author_archive_page_link'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('URL of author list page', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[archive_page_link_url]" value="<?php echo esc_attr($options['archive_page_link_url']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Label of link', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[archive_page_link_label]" value="<?php echo esc_attr($options['archive_page_link_label']); ?>"></li>
      </ul>
     </div>

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
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_blog_title_font_size]" value="<?php esc_attr_e( $options['single_blog_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_blog_title_font_size_mobile]" value="<?php esc_attr_e( $options['single_blog_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w');  ?></span><input class="display_option" data-option-name="single_blog_show_date" name="dp_options[single_blog_show_date]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_date'] ); ?> /></li>
      <li class="cf single_blog_show_date"><span class="label"><?php _e('Display modified date', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_update]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_update'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display comment', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_comment]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_comment'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display trackbacks', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_trackback]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_trackback'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button above post content', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_sns_top]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_sns_top'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button under post content', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_sns_btm'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under featured image', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_copy_top]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_copy_top'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Meta box setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[single_blog_show_meta_box]" type="checkbox" value="1" <?php checked( $options['single_blog_show_meta_box'], 1 ); ?>><?php _e( 'Display meta box', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['single_blog_show_meta_box'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_meta_author]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_meta_author'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display comment', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_meta_comment]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_meta_comment'] ); ?> /></li>
      </ul>
     </div>

     <?php // 投稿者記事 ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Author post setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Headline for author profile', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[author_tab_headline1]" value="<?php echo esc_attr($options['author_tab_headline1']); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Headline for author post', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[author_tab_headline2]" value="<?php echo esc_attr($options['author_tab_headline2']); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
       <select name="dp_options[author_post_num]">
        <?php for($i=3; $i<= 10; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['author_post_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
     </ul>

     <?php // 関連記事 ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Related post setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( $options['show_related_post'], 1 ); ?>><?php _e( 'Display related post', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_related_post'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[related_post_headline]" value="<?php echo esc_attr($options['related_post_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Description', 'tcd-w');  ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[related_post_desc]"><?php echo esc_textarea(  $options['related_post_desc'] ); ?></textarea></li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[related_post_num]">
         <?php for($i=5; $i<= 12; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['related_post_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Number of post to display (mobile)', 'tcd-w');  ?></span>
        <select name="dp_options[related_post_num_mobile]">
         <?php for($i=3; $i<= 12; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['related_post_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[related_post_title_font_size]" value="<?php esc_attr_e( $options['related_post_title_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[related_post_title_font_size_mobile]" value="<?php esc_attr_e( $options['related_post_title_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[related_post_show_category]" type="checkbox" value="1" <?php checked( '1', $options['related_post_show_category'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[related_post_show_date]" type="checkbox" value="1" <?php checked( '1', $options['related_post_show_date'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[related_post_show_author]" type="checkbox" value="1" <?php checked( '1', $options['related_post_show_author'] ); ?> /></li>
      </ul>
     </div>

     <?php // 特集コンテンツ ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Featured content setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_featured_post]" type="checkbox" value="1" <?php checked( $options['show_featured_post'], 1 ); ?>><?php _e( 'Display featured content', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_featured_post'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[featured_post_headline]" value="<?php echo esc_attr($options['featured_post_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Description', 'tcd-w');  ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[featured_post_desc]"><?php echo esc_textarea(  $options['featured_post_desc'] ); ?></textarea></li>
       <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
        <select name="dp_options[featured_post_type]">
         <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['featured_post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w');  ?></option>
         <option style="padding-right: 10px;" value="featured_post" <?php selected( $options['featured_post_type'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w');  ?></option>
         <option style="padding-right: 10px;" value="pickup_post" <?php selected( $options['featured_post_type'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w');  ?></option>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
        <select name="dp_options[featured_post_order]">
         <option style="padding-right: 10px;" value="date" <?php selected( $options['featured_post_order'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
         <option style="padding-right: 10px;" value="rand" <?php selected( $options['featured_post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[featured_post_num]">
         <?php for($i=4; $i<= 10; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['featured_post_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Number of post to display (mobile)', 'tcd-w');  ?></span>
        <select name="dp_options[featured_post_num_mobile]">
         <?php for($i=3; $i<= 10; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['featured_post_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[featured_post_title_font_size]" value="<?php esc_attr_e( $options['featured_post_title_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[featured_post_title_font_size_mobile]" value="<?php esc_attr_e( $options['featured_post_title_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[featured_post_show_category]" type="checkbox" value="1" <?php checked( '1', $options['featured_post_show_category'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[featured_post_show_date]" type="checkbox" value="1" <?php checked( '1', $options['featured_post_show_date'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[featured_post_show_author]" type="checkbox" value="1" <?php checked( '1', $options['featured_post_show_author'] ); ?> /></li>
      </ul>
     </div>

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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_top_ad_code]"><?php echo esc_textarea( $options['single_top_ad_code'] ); ?></textarea>
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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_bottom_ad_code]"><?php echo esc_textarea( $options['single_bottom_ad_code'] ); ?></textarea>
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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_mobile_ad_code]"><?php echo esc_textarea( $options['single_mobile_ad_code'] ); ?></textarea>
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
} // END add_blog_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $post_list_animation_type_options;

  // 基本設定
  $input['blog_label'] = wp_filter_nohtml_kses( $input['blog_label'] );


  //ヘッダーの設定
  $input['archive_blog_header_catch'] = wp_filter_nohtml_kses( $input['archive_blog_header_catch'] );
  $input['archive_blog_header_desc'] = wp_filter_nohtml_kses( $input['archive_blog_header_desc'] );
  $input['archive_blog_header_desc_mobile'] = wp_filter_nohtml_kses( $input['archive_blog_header_desc_mobile'] );

  $input['archive_blog_header_bg_image'] = wp_filter_nohtml_kses( $input['archive_blog_header_bg_image'] );
  $input['archive_blog_header_bg_image_mobile'] = wp_filter_nohtml_kses( $input['archive_blog_header_bg_image_mobile'] );
  $input['archive_blog_header_use_overlay'] = ! empty( $input['archive_blog_header_use_overlay'] ) ? 1 : 0;
  $input['archive_blog_header_overlay_color'] = wp_filter_nohtml_kses( $input['archive_blog_header_overlay_color'] );
  $input['archive_blog_header_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_blog_header_overlay_opacity'] );


  // アーカイブ
  $input['archive_blog_catch'] = wp_filter_nohtml_kses( $input['archive_blog_catch'] );
  $input['archive_blog_desc'] = wp_filter_nohtml_kses( $input['archive_blog_desc'] );

  $input['show_archive_carousel'] = ! empty( $input['show_archive_carousel'] ) ? 1 : 0;
  $input['archive_carousel_headline'] = wp_filter_nohtml_kses( $input['archive_carousel_headline'] );
  $input['archive_carousel_post_type'] = wp_filter_nohtml_kses( $input['archive_carousel_post_type'] );
  $input['archive_carousel_post_order'] = wp_filter_nohtml_kses( $input['archive_carousel_post_order'] );
  $input['archive_carousel_num'] = wp_filter_nohtml_kses( $input['archive_carousel_num'] );
  $input['archive_carousel_num_mobile'] = wp_filter_nohtml_kses( $input['archive_carousel_num_mobile'] );
  $input['archive_carousel_title_font_size'] = wp_filter_nohtml_kses( $input['archive_carousel_title_font_size'] );
  $input['archive_carousel_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_carousel_title_font_size_mobile'] );
  $input['archive_carousel_show_date'] = ! empty( $input['archive_carousel_show_date'] ) ? 1 : 0;
  $input['archive_carousel_show_category'] = ! empty( $input['archive_carousel_show_category'] ) ? 1 : 0;
  $input['archive_carousel_show_author'] = ! empty( $input['archive_carousel_show_author'] ) ? 1 : 0;

  $input['archive_blog_num'] = wp_filter_nohtml_kses( $input['archive_blog_num'] );
  $input['archive_blog_num_mobile'] = wp_filter_nohtml_kses( $input['archive_blog_num_mobile'] );
  $input['archive_blog_title_font_size'] = wp_filter_nohtml_kses( $input['archive_blog_title_font_size'] );
  $input['archive_blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_blog_title_font_size_mobile'] );
  $input['archive_blog_show_date'] = ! empty( $input['archive_blog_show_date'] ) ? 1 : 0;
  $input['archive_blog_show_update'] = ! empty( $input['archive_blog_show_update'] ) ? 1 : 0;
  $input['archive_blog_show_category'] = ! empty( $input['archive_blog_show_category'] ) ? 1 : 0;
  $input['archive_blog_show_author'] = ! empty( $input['archive_blog_show_author'] ) ? 1 : 0;
  $input['archive_blog_show_ads'] = ! empty( $input['archive_blog_show_ads'] ) ? 1 : 0;
  $input['archive_blog_banner_num'] = wp_filter_nohtml_kses( $input['archive_blog_banner_num'] );
  if ( ! isset( $value['archive_blog_animation'] ) )
    $value['archive_blog_animation'] = null;
  if ( ! array_key_exists( $value['archive_blog_animation'], $post_list_animation_type_options ) )
    $value['archive_blog_animation'] = null;

  $input['archive_blog_show_category'] = ! empty( $input['archive_blog_show_category'] ) ? 1 : 0;
  $input['archive_page_link_url'] = wp_filter_nohtml_kses( $input['archive_page_link_url'] );
  $input['archive_page_link_label'] = wp_filter_nohtml_kses( $input['archive_page_link_label'] );


  // 記事ページ
  $input['single_blog_title_font_size'] = wp_filter_nohtml_kses( $input['single_blog_title_font_size'] );
  $input['single_blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_blog_title_font_size_mobile'] );
  $input['single_blog_show_date'] = ! empty( $input['single_blog_show_date'] ) ? 1 : 0;
  $input['single_blog_show_update'] = ! empty( $input['single_blog_show_update'] ) ? 1 : 0;
  $input['single_blog_show_comment'] = ! empty( $input['single_blog_show_comment'] ) ? 1 : 0;
  $input['single_blog_show_trackback'] = ! empty( $input['single_blog_show_trackback'] ) ? 1 : 0;
  $input['single_blog_show_sns_top'] = ! empty( $input['single_blog_show_sns_top'] ) ? 1 : 0;
  $input['single_blog_show_sns_btm'] = ! empty( $input['single_blog_show_sns_btm'] ) ? 1 : 0;
  $input['single_blog_show_copy_top'] = ! empty( $input['single_blog_show_copy_top'] ) ? 1 : 0;
  $input['single_blog_show_meta_box'] = ! empty( $input['single_blog_show_meta_box'] ) ? 1 : 0;
  $input['single_blog_show_meta_comment'] = ! empty( $input['single_blog_show_meta_comment'] ) ? 1 : 0;
  $input['single_blog_show_meta_author'] = ! empty( $input['single_blog_show_meta_author'] ) ? 1 : 0;


  // 投稿者記事
  $input['author_tab_headline1'] = wp_filter_nohtml_kses( $input['author_tab_headline1'] );
  $input['author_tab_headline2'] = wp_filter_nohtml_kses( $input['author_tab_headline2'] );
  $input['author_post_num'] = wp_filter_nohtml_kses( $input['author_post_num'] );


  // 関連記事
  $input['show_related_post'] = ! empty( $input['show_related_post'] ) ? 1 : 0;
  $input['related_post_headline'] = wp_filter_nohtml_kses( $input['related_post_headline'] );
  $input['related_post_desc'] = wp_filter_nohtml_kses( $input['related_post_desc'] );
  $input['related_post_num'] = wp_filter_nohtml_kses( $input['related_post_num'] );
  $input['related_post_num_mobile'] = wp_filter_nohtml_kses( $input['related_post_num_mobile'] );
  $input['related_post_title_font_size'] = wp_filter_nohtml_kses( $input['related_post_title_font_size'] );
  $input['related_post_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['related_post_title_font_size_mobile'] );
  $input['related_post_show_date'] = ! empty( $input['related_post_show_date'] ) ? 1 : 0;
  $input['related_post_show_category'] = ! empty( $input['related_post_show_category'] ) ? 1 : 0;
  $input['related_post_show_author'] = ! empty( $input['related_post_show_author'] ) ? 1 : 0;


  // 特集コンテンツ
  $input['show_featured_post'] = ! empty( $input['show_featured_post'] ) ? 1 : 0;
  $input['featured_post_headline'] = wp_filter_nohtml_kses( $input['featured_post_headline'] );
  $input['featured_post_desc'] = wp_filter_nohtml_kses( $input['featured_post_desc'] );
  $input['featured_post_type'] = wp_filter_nohtml_kses( $input['featured_post_type'] );
  $input['featured_post_order'] = wp_filter_nohtml_kses( $input['featured_post_order'] );
  $input['featured_post_num'] = wp_filter_nohtml_kses( $input['featured_post_num'] );
  $input['featured_post_num_mobile'] = wp_filter_nohtml_kses( $input['featured_post_num_mobile'] );
  $input['featured_post_title_font_size'] = wp_filter_nohtml_kses( $input['featured_post_title_font_size'] );
  $input['featured_post_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['featured_post_title_font_size_mobile'] );
  $input['featured_post_show_date'] = ! empty( $input['featured_post_show_date'] ) ? 1 : 0;
  $input['featured_post_show_category'] = ! empty( $input['featured_post_show_category'] ) ? 1 : 0;
  $input['featured_post_show_author'] = ! empty( $input['featured_post_show_author'] ) ? 1 : 0;


  // 記事ページのバナー広告
  $input['single_top_ad_code'] = $input['single_top_ad_code'];
  $input['single_bottom_ad_code'] = $input['single_bottom_ad_code'];
  $input['single_mobile_ad_code'] = $input['single_mobile_ad_code'];

	return $input;

};


?>