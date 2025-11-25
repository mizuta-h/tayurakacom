<?php
/*
 * トップページの設定（モバイル用）
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_front_page_mobile_dp_default_options' );


// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_front_page_mobile_tab_label' );


// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_front_page_mobile_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_front_page_mobile_theme_options_validate' );


// タブの名前
function add_front_page_mobile_tab_label( $tab_labels ) {
	$tab_labels['front_page_mobile'] = __( 'Front page (smartphone)', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_front_page_mobile_dp_default_options( $dp_default_options ) {

	// ヘッダースライダー
	$dp_default_options['mobile_show_index_slider'] = 'type2';
	$dp_default_options['mobile_index_slider_time'] = '7000';
	$dp_default_options['mobile_stop_index_slider_animation'] = '';
	$dp_default_options['mobile_index_slider_type'] = 'type1';
	$dp_default_options['mobile_index_slider'] = array();

  // 記事スライダー
	$dp_default_options['mobile_index_post_slider_post_type'] = 'recent_post';
	$dp_default_options['mobile_index_post_slider_post_order'] = 'date';
	$dp_default_options['mobile_index_post_slider_post_num'] = '5';
	$dp_default_options['mobile_index_post_slider_title_font_size'] = '18';
	$dp_default_options['mobile_index_post_slider_show_category'] = '1';
	$dp_default_options['mobile_index_post_slider_show_author'] = '1';
	$dp_default_options['mobile_index_post_slider_show_date'] = '1';
	$dp_default_options['mobile_index_post_slider_show_update'] = '';

  // ヘッダーコンテンツタイプ３
	$dp_default_options['mobile_index_header_content_type3_post_type'] = 'recent_post';
	$dp_default_options['mobile_index_header_content_type3_post_order'] = 'date';
	$dp_default_options['mobile_index_header_content_type3_title_font_size'] = '18';
	$dp_default_options['mobile_index_header_content_type3_show_category'] = '1';
	$dp_default_options['mobile_index_header_content_type3_show_author'] = '1';
	$dp_default_options['mobile_index_header_content_type3_show_date'] = '1';
	$dp_default_options['mobile_index_header_content_type3_show_update'] = '';
	$dp_default_options['mobile_index_header_content_type3_use_overlay'] = 1;
	$dp_default_options['mobile_index_header_content_type3_overlay_color'] = '#000000';
	$dp_default_options['mobile_index_header_content_type3_overlay_opacity'] = '0.3';

  // コンテンツビルダー
	$dp_default_options['mobile_index_content_type'] = 'type1';
	$dp_default_options['mobile_contents_builder'] = array();

	return $dp_default_options;

}

// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_mobile_tab_panel( $options ) {

  global $dp_default_options, $item_type_options, $time_options, $font_type_options, $slider_animation_options, $catch_animation_type_options;
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

?>

<div id="tab-content-front-page-mobile" class="tab-content">

   <?php // ヘッダーコンテンツの設定 ---------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header content setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <ul class="design_radio_button">
      <li id="mobile_show_index_slider_type1_button">
       <input type="radio" id="mobile_show_index_slider_type1" name="dp_options[mobile_show_index_slider]" value="type1" <?php checked( $options['mobile_show_index_slider'], 'type1' ); ?> />
       <label for="mobile_show_index_slider_type1"><?php _e('Display same header content in smartphone', 'tcd-w');  ?></label>
      </li>
      <li id="mobile_show_index_slider_type2_button">
       <input type="radio" id="mobile_show_index_slider_type2" name="dp_options[mobile_show_index_slider]" value="type2" <?php checked( $options['mobile_show_index_slider'], 'type2' ); ?> />
       <label for="mobile_show_index_slider_type2"><?php _e('Display different header content in smartphone', 'tcd-w');  ?></label>
      </li>
      <li id="mobile_show_index_slider_type3_button">
       <input type="radio" id="mobile_show_index_slider_type3" name="dp_options[mobile_show_index_slider]" value="type3" <?php checked( $options['mobile_show_index_slider'], 'type3' ); ?> />
       <label for="mobile_show_index_slider_type3"><?php _e('Don\'t display header content in smartphone', 'tcd-w');  ?></label>
      </li>
     </ul>

     <div id="index_slider_input_area" style="<?php if($options['mobile_show_index_slider'] == 'type2'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <h4 class="theme_option_headline2"><?php _e('Slider type', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('<strong>[Content slider1]</strong><br>You can display blog post, image, MP4 video, Youtube in contents slider.', 'tcd-w');  ?></p>
      <p><?php _e('<strong>[Content slider2]</strong><br>You can display blog post, image, MP4 video, Youtube in contents slider.<br>Slider will be displayed on top and post list will be displayed on bottom of header content.', 'tcd-w');  ?></p>
     </div>
     <ul class="design_radio_button2 slider_type_radio_button">
      <li class="index_slider_type1 <?php if($options['mobile_index_slider_type'] == 'type1'){ echo 'active'; }; ?>">
       <label for="mobile_index_slider_type1">
        <img src="<?php bloginfo('template_url'); ?>/admin/img/index_slider_type1.jpg" title="" alt="" />
        <span class="title"><?php _e('Post slider', 'tcd-w');  ?></span>
        <input type="radio" id="mobile_index_slider_type1" name="dp_options[mobile_index_slider_type]" value="type1" <?php checked( $options['mobile_index_slider_type'], 'type1' ); ?> />
       </label>
      </li>
      <li class="index_slider_type2 <?php if($options['mobile_index_slider_type'] == 'type2'){ echo 'active'; }; ?>">
       <label for="mobile_index_slider_type2">
        <img src="<?php bloginfo('template_url'); ?>/admin/img/index_slider_type2.jpg" title="" alt="" />
        <span class="title"><?php _e('Contents slider', 'tcd-w');  ?>1</span>
        <input type="radio" id="mobile_index_slider_type2" name="dp_options[mobile_index_slider_type]" value="type2" <?php checked( $options['mobile_index_slider_type'], 'type2' ); ?> />
       </label>
      </li>
      <li class="index_slider_type3 <?php if($options['mobile_index_slider_type'] == 'type3'){ echo 'active'; }; ?>">
       <label for="mobile_index_slider_type3">
        <img src="<?php bloginfo('template_url'); ?>/admin/img/index_slider_type3.jpg" title="" alt="" />
        <span class="title"><?php _e('Contents slider', 'tcd-w');  ?>2</span>
        <input type="radio" id="mobile_index_slider_type3" name="dp_options[mobile_index_slider_type]" value="type3" <?php checked( $options['mobile_index_slider_type'], 'type3' ); ?> />
       </label>
      </li>
     </ul>

     <?php //記事スライダーの設定 ----- ?>
     <div class="index_slider_type1_area" style="<?php if($options['mobile_index_slider_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="sub_box cf" style="margin-top:30px; margin-bottom:-10px;">
       <h3 class="theme_option_subbox_headline"><?php _e('Post slider setting', 'tcd-w');  ?></h3>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e('Post slider setting', 'tcd-w');  ?></h4>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
          <select name="dp_options[mobile_index_post_slider_post_type]">
           <option style="padding-right: 10px;" value="recent_post" <?php selected( $options['mobile_index_post_slider_post_type'], 'recent_post' ); ?>><?php _e('All post', 'tcd-w');  ?></option>
           <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['mobile_index_post_slider_post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w');  ?></option>
           <option style="padding-right: 10px;" value="featured_post" <?php selected( $options['mobile_index_post_slider_post_type'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w');  ?></option>
           <option style="padding-right: 10px;" value="pickup_post" <?php selected( $options['mobile_index_post_slider_post_type'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w');  ?></option>
          </select>
         </li>
         <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
          <select name="dp_options[mobile_index_post_slider_post_order]">
           <option style="padding-right: 10px;" value="date" <?php selected( $options['mobile_index_post_slider_post_order'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
           <option style="padding-right: 10px;" value="rand" <?php selected( $options['mobile_index_post_slider_post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
          </select>
         </li>
         <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
          <select name="dp_options[mobile_index_post_slider_post_num]">
           <?php for($i=3; $i<= 10; $i++): ?>
           <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['mobile_index_post_slider_post_num'], $i ); ?>><?php echo esc_html($i); ?></option>
           <?php endfor; ?>
          </select>
         </li>
         <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_post_slider_title_font_size]" value="<?php esc_attr_e( $options['mobile_index_post_slider_title_font_size'] ); ?>" /><span>px</span></li>
         <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[mobile_index_post_slider_show_category]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_post_slider_show_category'] ); ?> /></li>
         <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input class="display_option" data-option-name="mobile_index_post_slider_show_date" name="dp_options[mobile_index_post_slider_show_date]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_post_slider_show_date'] ); ?> /></li>
         <li class="cf mobile_index_post_slider_show_date"><span class="label"><?php _e('Display modified date', 'tcd-w'); ?></span><input name="dp_options[mobile_index_post_slider_show_update]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_post_slider_show_update'] ); ?> /></li>
         <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[mobile_index_post_slider_show_author]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_post_slider_show_author'] ); ?> /></li>
        </ul>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
     </div><!-- END .index_slider_type1_area -->

     <?php //記事スライダー以外の設定 ----- ?>
     <div class="index_slider_type2_area" style="<?php if($options['mobile_index_slider_type'] != 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <h4 class="theme_option_headline2"><?php _e('Slider setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message">
      <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-w');  ?></p>
     </div>

     <?php //繰り返しフィールド ----- ?>
     <div class="repeater-wrapper">
      <input type="hidden" name="dp_options[mobile_index_slider]" value="">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
       <?php
            if ( $options['mobile_index_slider'] ) :
              foreach ( $options['mobile_index_slider'] as $key => $value ) :
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-w' ); echo esc_attr( $key+1 ); ?></h4>
        <div class="sub_box_content">

         <div class="sub_box cf" style="margin-top:20px;">
          <h3 class="theme_option_subbox_headline"><?php echo __('Slider setting', 'tcd-w'); ?></h3>
          <div class="sub_box_content">

           <h4 class="theme_option_headline2"><?php _e('Item type', 'tcd-w');  ?></h4>
           <div class="theme_option_message2">
            <p><?php _e('You can display text content except item type "Blog post".', 'tcd-w');  ?></p>
           </div>
           <ul class="design_radio_button cf horizontal">
            <?php foreach ( $item_type_options as $option ) { ?>
            <li class="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>">
             <input type="radio" id="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][slider_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['slider_type'], $option['value'] ); ?> />
             <label for="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>"><?php echo $option['label']; ?></label>
            </li>
            <?php } ?>
           </ul>

           <?php // 動画アイテム ----------------------- ?>
           <div class="index_slider_video_area" style="<?php if($value['slider_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e('Video setting', 'tcd-w');  ?></h4>
            <div class="theme_option_message2">
             <p><?php _e('Please upload MP4 format file.', 'tcd-w');  ?></p>
             <p><?php _e( 'Register within 10 MB.', 'tcd-w' ); ?></p>
             <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
            </div>
            <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_video">
             <input type="hidden" value="<?php if($value['video']) { echo esc_attr( $value['video'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_video" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][video]" class="cf_media_id">
             <div class="preview_field preview_field_video">
              <?php if($value['video']){ ?>
              <h4><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h4>
              <p><?php echo esc_url(wp_get_attachment_url($value['video'])); ?></p>
              <?php }; ?>
             </div>
             <div class="buttton_area">
              <input type="button" value="<?php _e('Select MP4 file', 'tcd-w'); ?>" class="cfmf-select-video button">
              <input type="button" value="<?php _e('Remove MP4 file', 'tcd-w'); ?>" class="cfmf-delete-video button <?php if(!$value['video']){ echo 'hidden'; }; ?>">
             </div>
            </div>
           </div><!-- END .index_slider_video_area -->

           <?php // Youtubeアイテム ----------------------- ?>
           <div class="index_slider_youtube_area" style="<?php if($value['slider_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e('Youtube setting', 'tcd-w');  ?></h4>
            <div class="theme_option_message2">
             <p><?php _e('Please enter Youtube URL.', 'tcd-w');  ?></p>
             <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
            </div>
            <input class="regular-text" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][youtube]" value="<?php echo esc_attr( $value['youtube'] ); ?>">
           </div><!-- END .index_slider_youtube_area -->

           <?php // 背景画像 ----------------------- ?>
           <div class="index_slider_background_area" style="<?php if($value['slider_type'] != 'type4') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
            <div class="theme_option_message2">
             <div class="index_slider_video_image" style="<?php if($value['slider_type'] != 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
              <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
             </div>
             <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1050'); ?></p>
            </div>
            <div class="image_box cf">
             <div class="cf cf_media_field hide-if-no-js mobile_index_slider_image<?php echo esc_attr( $key ); ?>">
              <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="mobile_index_slider_image<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
              <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'full'); }; ?></div>
              <div class="buttton_area">
               <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
               <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
              </div>
             </div>
            </div>
           </div><!-- END .index_slider_background_area -->

           <?php // 記事アイテム ----------------------- ?>
           <div class="index_slider_post_area" style="<?php if($value['slider_type'] == 'type4') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e('Post setting', 'tcd-w');  ?></h4>
            <ul class="option_list">
             <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_type]">
               <option style="padding-right: 10px;" value="recent_post" <?php selected( $value['post_type'], 'recent_post' ); ?>><?php _e('All post', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="recommend_post" <?php selected( $value['post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="featured_post" <?php selected( $value['post_type'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="pickup_post" <?php selected( $value['post_type'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_order]">
               <option style="padding-right: 10px;" value="date" <?php selected( $value['post_order'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="rand" <?php selected( $value['post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_title_font_size]" value="<?php esc_attr_e( $value['post_title_font_size'] ); ?>" /><span>px</span></li>
             <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_show_category]" type="checkbox" value="1" <?php checked( '1', $value['post_show_category'] ); ?> /></li>
             <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input class="display_option" data-option-name="mobile_index_slider_<?php echo esc_attr( $key ); ?>_post_show_date" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_show_date]" type="checkbox" value="1" <?php checked( '1', $value['post_show_date'] ); ?> /></li>
             <li class="cf mobile_index_slider_<?php echo esc_attr( $key ); ?>_post_show_date"><span class="label"><?php _e('Display modified date', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_show_update]" type="checkbox" value="1" <?php checked( '1', $value['post_show_update'] ); ?> /></li>
             <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_show_author]" type="checkbox" value="1" <?php checked( '1', $value['post_show_author'] ); ?> /></li>
            </ul>
           </div><!-- END .index_slider_post_area -->

           <?php // オーバーレイ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
           <p class="displayment_checkbox"><label><input class="index_slider_use_overlay<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_overlay]" type="checkbox" value="1" <?php checked( $value['use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
           <div style="<?php if($value['use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
             <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_color]" value="<?php echo esc_attr( $value['overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
             <li class="cf">
              <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku index_slider_overlay_opacity<?php echo esc_attr( $key ); ?>" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $value['overlay_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
               <p><?php _e('It also has the effect of improving readability when setting text content.', 'tcd-w');  ?></p>
              </div>
             </li>
            </ul>
           </div>

          </div><!-- END .sub_box_content -->
         </div><!-- END .sub_box -->

         <div class="index_slider_non_post_area" style="<?php if($value['slider_type'] != 'type4') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

         <div class="sub_box cf">
          <h3 class="theme_option_subbox_headline"><?php echo __('Text content setting', 'tcd-w'); ?></h3>
          <div class="sub_box_content">

           <?php // キャッチフレーズ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
           <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
             <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_type]">
              <?php
                   foreach ( $font_type_options as $option ) {
                     if(strtoupper(get_locale()) == 'JA'){
                       $label = $option['label'];
                     } else {
                       $label = $option['label_en'];
                     }
              ?>
              <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo esc_html($label); ?></option>
              <?php } ?>
             </select>
            </li>
            <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_size]" value="<?php echo esc_attr( $value['catch_font_size'] ); ?>" /><span>px</span></li>
           </ul>
           <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
           <textarea class="large-text" cols="50" rows="4" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" /><span>px</span></li>
           </ul>
           <?php // ボタン ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
           <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
           <div class="button_option_area" style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <ul class="option_list button_option_area" style="border-top:1px dotted #ccc; padding-top:12px;">
             <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
             <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_url]" value="<?php esc_attr_e( $value['button_url'] ); ?>" /></li>
             <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_target]" type="checkbox" value="1" <?php checked( $value['button_target'], 1 ); ?>></li>
             <li class="cf"><span class="label"><?php _e('Button type', 'tcd-w');  ?></span>
              <select class="button_type_option" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_type]">
               <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_type'], 'type1' ); ?>><?php _e('Normal button', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_type'], 'type2' ); ?>><?php _e('Swipe animation button', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type3" <?php selected( $value['button_type'], 'type3' ); ?>><?php _e('Diagonal swipe animation button', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Button shape', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_shape]">
               <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_shape'], 'type1' ); ?>><?php _e('Round corner', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_shape'], 'type2' ); ?>><?php _e('Square corner', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
             <li class="cf button_type1_option"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf non_button_type1_option"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color]" value="<?php echo esc_attr( $value['button_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf non_button_type1_option">
              <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_opacity]" value="<?php echo esc_attr( $value['button_border_color_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
              </div>
             </li>
             <li class="cf"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
             <li class="cf non_button_type1_option"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover]" value="<?php echo esc_attr( $value['button_border_color_hover'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
             <li class="cf non_button_type1_option">
              <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover_opacity]" value="<?php echo esc_attr( $value['button_border_color_hover_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
              </div>
             </li>
            </ul>
           </div>

          </div><!-- END .sub_box_content -->
         </div><!-- END .sub_box -->

         </div><!-- END .index_slider_non_post_item -->

         <ul class="button_list cf">
          <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
             'slider_type' => 'type1',
             'image' => false,
             'video' => '',
             'youtube' => '',
             'catch' => '',
             'catch_font_type' => 'type2',
             'catch_font_size' => '18',
             'desc' => '',
             'desc_font_size' => '14',
             'show_button' => '',
             'button_type' => 'type1',
             'button_shape' => 'type2',
             'button_label' => '',
             'button_url' => '',
             'button_target' => '',
             'button_font_color' => '#000000',
             'button_font_color_hover' => '#ffffff',
             'button_bg_color' => '#ffffff',
             'button_bg_color_hover' => '#000000',
             'button_border_color' => '#ffffff',
             'button_border_color_opacity' => '1',
             'button_border_color_hover' => '#000000',
             'button_border_color_hover_opacity' => '1',
             'use_overlay' => '',
             'overlay_color' => '#000000',
             'overlay_opacity' => '0.3',
             'post_type' => 'recent_post',
             'post_order' => 'date',
             'post_show_category' => '1',
             'post_show_author' => '1',
             'post_show_date' => '1',
             'post_show_update' => '',
             'post_title_font_size' => '18',
            );
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
        <div class="sub_box_content">

         <div class="sub_box cf" style="margin-top:20px;">
          <h3 class="theme_option_subbox_headline"><?php echo __('Slider setting', 'tcd-w'); ?></h3>
          <div class="sub_box_content">

           <h4 class="theme_option_headline2"><?php _e('Item type', 'tcd-w');  ?></h4>
           <div class="theme_option_message2">
            <p><?php _e('You can display text content except item type "Blog post".', 'tcd-w');  ?></p>
           </div>
           <ul class="design_radio_button cf horizontal">
            <?php foreach ( $item_type_options as $option ) { ?>
            <li class="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>">
             <input type="radio" id="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][slider_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['slider_type'], $option['value'] ); ?> />
             <label for="mobile_index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>"><?php echo $option['label']; ?></label>
            </li>
            <?php } ?>
           </ul>

           <?php // 動画アイテム ----------------------- ?>
           <div class="index_slider_video_area" style="<?php if($value['slider_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e('Video setting', 'tcd-w');  ?></h4>
            <div class="theme_option_message2">
             <p><?php _e('Please upload MP4 format file.', 'tcd-w');  ?></p>
             <p><?php _e( 'Register within 10 MB.', 'tcd-w' ); ?></p>
             <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
            </div>
            <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_video">
             <input type="hidden" value="<?php if($value['video']) { echo esc_attr( $value['video'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_video" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][video]" class="cf_media_id">
             <div class="preview_field preview_field_video">
              <?php if($value['video']){ ?>
              <h4><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h4>
              <p><?php echo esc_url(wp_get_attachment_url($value['video'])); ?></p>
              <?php }; ?>
             </div>
             <div class="buttton_area">
              <input type="button" value="<?php _e('Select MP4 file', 'tcd-w'); ?>" class="cfmf-select-video button">
              <input type="button" value="<?php _e('Remove MP4 file', 'tcd-w'); ?>" class="cfmf-delete-video button <?php if(!$value['video']){ echo 'hidden'; }; ?>">
             </div>
            </div>
           </div><!-- END .index_slider_video_area -->

           <?php // Youtubeアイテム ----------------------- ?>
           <div class="index_slider_youtube_area" style="<?php if($value['slider_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e('Youtube setting', 'tcd-w');  ?></h4>
            <div class="theme_option_message2">
             <p><?php _e('Please enter Youtube URL.', 'tcd-w');  ?></p>
             <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
            </div>
            <input class="regular-text" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][youtube]" value="<?php echo esc_attr( $value['youtube'] ); ?>">
           </div><!-- END .index_slider_youtube_area -->

           <?php // 背景画像 ----------------------- ?>
           <div class="index_slider_background_area" style="<?php if($value['slider_type'] != 'type4') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
            <div class="theme_option_message2">
             <div class="index_slider_video_image" style="<?php if($value['slider_type'] != 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
              <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
             </div>
             <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1050'); ?></p>
            </div>
            <div class="image_box cf">
             <div class="cf cf_media_field hide-if-no-js mobile_index_slider_image<?php echo esc_attr( $key ); ?>">
              <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="mobile_index_slider_image<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
              <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'full'); }; ?></div>
              <div class="buttton_area">
               <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
               <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
              </div>
             </div>
            </div>
           </div><!-- END .index_slider_background_area -->

           <?php // 記事アイテム ----------------------- ?>
           <div class="index_slider_post_area" style="<?php if($value['slider_type'] == 'type4') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <h4 class="theme_option_headline2"><?php _e('Post setting', 'tcd-w');  ?></h4>
            <ul class="option_list">
             <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_type]">
               <option style="padding-right: 10px;" value="recent_post" <?php selected( $value['post_type'], 'recent_post' ); ?>><?php _e('All post', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="recommend_post" <?php selected( $value['post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="featured_post" <?php selected( $value['post_type'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="pickup_post" <?php selected( $value['post_type'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_order]">
               <option style="padding-right: 10px;" value="date" <?php selected( $value['post_order'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="rand" <?php selected( $value['post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_title_font_size]" value="<?php esc_attr_e( $value['post_title_font_size'] ); ?>" /><span>px</span></li>
             <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_show_category]" type="checkbox" value="1" <?php checked( '1', $value['post_show_category'] ); ?> /></li>
             <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input class="display_option" data-option-name="mobile_index_slider_<?php echo esc_attr( $key ); ?>_post_show_date" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_show_date]" type="checkbox" value="1" <?php checked( '1', $value['post_show_date'] ); ?> /></li>
             <li class="cf mobile_index_slider_<?php echo esc_attr( $key ); ?>_post_show_date"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_show_update]" type="checkbox" value="1" <?php checked( '1', $value['post_show_update'] ); ?> /></li>
             <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][post_show_author]" type="checkbox" value="1" <?php checked( '1', $value['post_show_author'] ); ?> /></li>
            </ul>
           </div><!-- END .index_slider_post_area -->

           <?php // オーバーレイ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
           <p class="displayment_checkbox"><label><input class="index_slider_use_overlay<?php echo esc_attr( $key ); ?>" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_overlay]" type="checkbox" value="1" <?php checked( $value['use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
           <div style="<?php if($value['use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
             <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_color]" value="<?php echo esc_attr( $value['overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
             <li class="cf">
              <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku index_slider_overlay_opacity<?php echo esc_attr( $key ); ?>" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $value['overlay_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
               <p><?php _e('It also has the effect of improving readability when setting text content.', 'tcd-w');  ?></p>
              </div>
             </li>
            </ul>
           </div>

          </div><!-- END .sub_box_content -->
         </div><!-- END .sub_box -->

         <div class="index_slider_non_post_area" style="<?php if($value['slider_type'] != 'type4') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

         <div class="sub_box cf">
          <h3 class="theme_option_subbox_headline"><?php echo __('Text content setting', 'tcd-w'); ?></h3>
          <div class="sub_box_content">

           <?php // キャッチフレーズ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
           <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
             <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_type]">
              <?php
                   foreach ( $font_type_options as $option ) {
                     if(strtoupper(get_locale()) == 'JA'){
                       $label = $option['label'];
                     } else {
                       $label = $option['label_en'];
                     }
              ?>
              <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo esc_html($label); ?></option>
              <?php } ?>
             </select>
            </li>
            <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_size]" value="<?php echo esc_attr( $value['catch_font_size'] ); ?>" /><span>px</span></li>
           </ul>
           <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
           <textarea class="large-text" cols="50" rows="4" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" /><span>px</span></li>
           </ul>
           <?php // ボタン ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
           <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
           <div class="button_option_area" style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <ul class="option_list button_option_area" style="border-top:1px dotted #ccc; padding-top:12px;">
             <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
             <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_url]" value="<?php esc_attr_e( $value['button_url'] ); ?>" /></li>
             <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_target]" type="checkbox" value="1" <?php checked( $value['button_target'], 1 ); ?>></li>
             <li class="cf"><span class="label"><?php _e('Button type', 'tcd-w');  ?></span>
              <select class="button_type_option" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_type]">
               <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_type'], 'type1' ); ?>><?php _e('Normal button', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_type'], 'type2' ); ?>><?php _e('Swipe animation button', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type3" <?php selected( $value['button_type'], 'type3' ); ?>><?php _e('Diagonal swipe animation button', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Button shape', 'tcd-w');  ?></span>
              <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_shape]">
               <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_shape'], 'type1' ); ?>><?php _e('Round corner', 'tcd-w');  ?></option>
               <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_shape'], 'type2' ); ?>><?php _e('Square corner', 'tcd-w');  ?></option>
              </select>
             </li>
             <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
             <li class="cf button_type1_option"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf non_button_type1_option"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color]" value="<?php echo esc_attr( $value['button_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf non_button_type1_option">
              <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_opacity]" value="<?php echo esc_attr( $value['button_border_color_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
              </div>
             </li>
             <li class="cf"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
             <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
             <li class="cf non_button_type1_option"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover]" value="<?php echo esc_attr( $value['button_border_color_hover'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
             <li class="cf non_button_type1_option">
              <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover_opacity]" value="<?php echo esc_attr( $value['button_border_color_hover_opacity'] ); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
               <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
              </div>
             </li>
            </ul>
           </div>

          </div><!-- END .sub_box_content -->
         </div><!-- END .sub_box -->

         </div><!-- END .index_slider_non_post_item -->

         <ul class="button_list cf">
          <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo htmlspecialchars( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
     </div><!-- END .repeater-wrapper -->
     <?php //繰り返しフィールドここまで ----- ?>

     </div><!-- END .index_slider_type2_area -->

     <div class="sub_box cf" style="margin-top:20px;">
      <h3 class="theme_option_subbox_headline"><?php echo __('Slider common setting', 'tcd-w'); ?></h3>
      <div class="sub_box_content">

       <h4 class="theme_option_headline2"><?php _e('Animation setting', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you use this option, the animation of all elements except the background image will be stopped and the text content can be displayed instantly.', 'tcd-w');  ?></p>
       </div>
       <p><label><input class="stop_index_slider_animation" name="dp_options[mobile_stop_index_slider_animation]" type="checkbox" value="1" <?php checked( $options['mobile_stop_index_slider_animation'], 1 ); ?>><?php _e( 'Stop all animation in header content', 'tcd-w' ); ?></label></p>

       <?php // スピードの設定 ---------- ?>
       <h4 class="theme_option_headline2"><?php _e('Slider speed setting', 'tcd-w');  ?></h4>
       <select class="index_slider_time" name="dp_options[mobile_index_slider_time]">
        <?php
             $i = 1;
             foreach ( $time_options as $option ):
               if( $i >= 3 && $i <= 15 ){
        ?>
        <option <?php if($i < 5){ echo 'class="no_animation"'; }; ?>style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['mobile_index_slider_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
        <?php
               }
               $i++;
            endforeach;
        ?>
       </select>

      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php //ヘッダーコンテンツタイプ3の設定 ----- ?>
     <div class="index_slider_type3_area" style="<?php if($options['mobile_index_slider_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="sub_box cf">
       <h3 class="theme_option_subbox_headline"><?php _e('Post list setting', 'tcd-w');  ?></h3>
       <div class="sub_box_content">
        <div class="theme_option_message2" style="margin-top:20px;">
         <p><?php _e('This post list will be display on bottom of header content.', 'tcd-w');  ?></p>
        </div>
        <h4 class="theme_option_headline2"><?php _e('Post list setting', 'tcd-w');  ?></h4>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
          <select name="dp_options[mobile_index_header_content_type3_post_type]">
           <option style="padding-right: 10px;" value="recent_post" <?php selected( $options['mobile_index_header_content_type3_post_type'], 'recent_post' ); ?>><?php _e('All post', 'tcd-w');  ?></option>
           <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['mobile_index_header_content_type3_post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w');  ?></option>
           <option style="padding-right: 10px;" value="featured_post" <?php selected( $options['mobile_index_header_content_type3_post_type'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w');  ?></option>
           <option style="padding-right: 10px;" value="pickup_post" <?php selected( $options['mobile_index_header_content_type3_post_type'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w');  ?></option>
          </select>
         </li>
         <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
          <select name="dp_options[mobile_index_header_content_type3_post_order]">
           <option style="padding-right: 10px;" value="date" <?php selected( $options['mobile_index_header_content_type3_post_order'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
           <option style="padding-right: 10px;" value="rand" <?php selected( $options['mobile_index_header_content_type3_post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
          </select>
         </li>
         <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_header_content_type3_title_font_size]" value="<?php esc_attr_e( $options['mobile_index_header_content_type3_title_font_size'] ); ?>" /><span>px</span></li>
         <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[mobile_index_header_content_type3_show_category]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_header_content_type3_show_category'] ); ?> /></li>
         <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input class="display_option" data-option-name="mobile_index_header_content_type3_show_date" name="dp_options[mobile_index_header_content_type3_show_date]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_header_content_type3_show_date'] ); ?> /></li>
         <li class="cf mobile_index_header_content_type3_show_date"><span class="label"><?php _e('Display modified date', 'tcd-w'); ?></span><input name="dp_options[mobile_index_header_content_type3_show_update]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_header_content_type3_show_update'] ); ?> /></li>
         <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[mobile_index_header_content_type3_show_author]" type="checkbox" value="1" <?php checked( '1', $options['mobile_index_header_content_type3_show_author'] ); ?> /></li>
        </ul>
        <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
        <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_header_content_type3_use_overlay]" type="checkbox" value="1" <?php checked( $options['mobile_index_header_content_type3_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
        <div style="<?php if($options['mobile_index_header_content_type3_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
         <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
          <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_header_content_type3_overlay_color]" value="<?php echo esc_attr( $options['mobile_index_header_content_type3_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
          <li class="cf">
           <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_header_content_type3_overlay_opacity]" value="<?php echo esc_attr( $options['mobile_index_header_content_type3_overlay_opacity'] ); ?>" />
           <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
            <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
           </div>
          </li>
         </ul>
        </div>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
     </div><!-- END .index_slider_type1_area -->

     </div><!-- END #index_slider_input_area -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // コンテンツビルダー ここから ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
   <div class="theme_option_field theme_option_field_ac open active <?php if($options['mobile_index_content_type'] == 'type2') { echo 'show_arrow'; }; ?>">
    <h3 class="theme_option_headline"><?php _e('Content builder', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <ul class="design_radio_button" style="margin-bottom:25px;">
      <li class="mobile_index_content_type1_button">
       <input type="radio" id="mobile_index_content_type1" name="dp_options[mobile_index_content_type]" value="type1" <?php checked( $options['mobile_index_content_type'], 'type1' ); ?> />
       <label for="mobile_index_content_type1"><?php _e('Display same content builder in smartphone', 'tcd-w');  ?></label>
      </li>
      <li class="mobile_index_content_type2_button">
       <input type="radio" id="mobile_index_content_type2" name="dp_options[mobile_index_content_type]" value="type2" <?php checked( $options['mobile_index_content_type'], 'type2' ); ?> />
       <label for="mobile_index_content_type2"><?php _e('Display diffrent content builder in smartphone', 'tcd-w');  ?></label>
      </li>
      <li class="mobile_index_content_type3_button">
       <input type="radio" id="mobile_index_content_type3" name="dp_options[mobile_index_content_type]" value="type3" <?php checked( $options['mobile_index_content_type'], 'type3' ); ?> />
       <label for="mobile_index_content_type3"><?php _e('Use page content instead of content builder', 'tcd-w');  ?></label>
      </li>
     </ul>

     <ul class="button_list cf mobile_index_content_type1_option <?php if($options['mobile_index_content_type'] != 'type2') { echo 'display:block'; }; ?>">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
     </ul>

     <?php
          $front_page_id = get_option('page_on_front');
          if($front_page_id){
     ?>
     <div class="mobile_index_content_type3_option" style="<?php if($options['mobile_index_content_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <p><?php printf(__('Please set content from <a href="post.php?post=%s&action=edit" target="_blank">Front page edit screen</a>.', 'tcd-w'), $front_page_id); ?></p>
      </div>
      <ul class="button_list cf">
       <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      </ul>
     </div>
     <?php }; ?>

     <div class="mobile_index_content_type2_option" style="<?php if($options['mobile_index_content_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <div class="theme_option_message no_arrow">
      <?php echo __( '<p>You can build contents freely with this function.</p><br /><p>STEP1: Click Add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
      <br>
      <p><?php _e('For headline and description that do not have font type or font size options, please adjust all at once from the font setting section of the basic settings ', 'tcd-w');  ?></p>
     </div>
     <h4 class="theme_option_headline2"><?php _e( 'Content image', 'tcd-w' ); ?></h4>
     <ul class="design_button_list cf">
      <li><a data-rel="lightcase:indexcbmobile" href="<?php bloginfo('template_url'); ?>/admin/img/cb_carousel.jpg" title="<?php _e( 'Post carousel', 'tcd-w' ); ?>"><?php _e( 'Post carousel', 'tcd-w' ); ?></a></li>
      <li><a data-rel="lightcase:indexcbmobile" href="<?php bloginfo('template_url'); ?>/admin/img/cb_featured.jpg" title="<?php _e( 'Tab post content', 'tcd-w' ); ?>"><?php _e( 'Tab post content', 'tcd-w' ); ?></a></li>
      <li><a data-rel="lightcase:indexcbmobile" href="<?php bloginfo('template_url'); ?>/admin/img/cb_category.jpg" title="<?php _e( 'Category post', 'tcd-w' ); ?>"><?php _e( 'Category post', 'tcd-w' ); ?></a></li>
      <li><a data-rel="lightcase:indexcbmobile" href="<?php bloginfo('template_url'); ?>/admin/img/cb_trend.jpg" title="<?php _e( 'Three column post content', 'tcd-w' ); ?>"><?php _e( 'Three column post content', 'tcd-w' ); ?></a></li>
      <li><a data-rel="lightcase:indexcbmobile" href="<?php bloginfo('template_url'); ?>/admin/img/cb_author_carousel.jpg" title="<?php _e( 'Author list', 'tcd-w' ); ?>"><?php _e( 'Author list', 'tcd-w' ); ?></a></li>
      <li><a data-rel="lightcase:indexcbmobile" href="<?php bloginfo('template_url'); ?>/admin/img/cb_news.jpg" title="<?php _e( 'News list', 'tcd-w' ); ?>"><?php _e( 'News list', 'tcd-w' ); ?></a></li>
     </ul>

     </div>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <div class="contents_builder_wrap mobile_index_content_type2_option" style="<?php if($options['mobile_index_content_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

    <div class="contents_builder">
     <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
     <?php
          if (!empty($options['mobile_contents_builder'])) {
            foreach($options['mobile_contents_builder'] as $key => $content) :
              $cb_index = 'cb_'.$key.'_'.mt_rand(0,999999);
     ?>
     <div class="cb_row">
      <ul class="cb_button cf">
       <li><span class="cb_move"><?php echo __('Move', 'tcd-w'); ?></span></li>
       <li><span class="cb_delete"><?php echo __('Delete', 'tcd-w'); ?></span></li>
      </ul>
      <div class="cb_column_area cf">
       <div class="cb_column">
        <input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>" />
        <?php mobile_the_cb_content_select($cb_index, $content['cb_content_select']); ?>
        <?php if (!empty($content['cb_content_select'])) mobile_the_cb_content_setting($cb_index, $content['cb_content_select'], $content); ?>
       </div>
      </div><!-- END .cb_column_area -->
     </div><!-- END .cb_row -->
     <?php
          endforeach;
         };
     ?>
    </div><!-- END .contents_builder -->
    <ul class="button_list cf cb_add_row_buttton_area">
     <li><input type="button" value="<?php echo __( 'Add content', 'tcd-w' ); ?>" class="button-ml add_row"></li>
     <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
    </ul>

    <?php // コンテンツビルダー追加用 非表示 ?>
    <div class="contents_builder-clone hidden">
     <div class="cb_row">
      <ul class="cb_button cf">
       <li><span class="cb_move"><?php echo __('Move', 'tcd-w'); ?></span></li>
       <li><span class="cb_delete"><?php echo __('Delete', 'tcd-w'); ?></span></li>
      </ul>
      <div class="cb_column_area cf">
       <div class="cb_column">
        <input type="hidden" class="cb_index" value="cb_cloneindex" />
        <?php mobile_the_cb_content_select('cb_cloneindex'); ?>
       </div>
      </div><!-- END .cb_column_area -->
     </div><!-- END .cb_row -->
     <?php
          mobile_the_cb_content_setting('cb_cloneindex', 'carousel');
          mobile_the_cb_content_setting('cb_cloneindex', 'featured_content');
          mobile_the_cb_content_setting('cb_cloneindex', 'category_post');
          mobile_the_cb_content_setting('cb_cloneindex', 'trend');
          mobile_the_cb_content_setting('cb_cloneindex', 'author_list');
          mobile_the_cb_content_setting('cb_cloneindex', 'news_list');
          mobile_the_cb_content_setting('cb_cloneindex', 'free_space');
     ?>
    </div><!-- END .contents_builder-clone -->

   </div><!-- END .contents_builder_wrap -->
   <?php // コンテンツビルダーここまで ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>


</div><!-- END .tab-content -->

<?php
} // END add_front_page_mobile_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_mobile_theme_options_validate( $input ) {

  global $dp_default_options, $item_type_options, $time_options, $font_type_options, $slider_animation_options, $catch_animation_type_options;

  // スライダーの基本設定
  $input['mobile_show_index_slider'] = wp_filter_nohtml_kses( $input['mobile_show_index_slider'] );
  if ( ! isset( $value['mobile_index_slider_time'] ) )
    $value['mobile_index_slider_time'] = null;
  if ( ! array_key_exists( $value['mobile_index_slider_time'], $time_options ) )
    $value['mobile_index_slider_time'] = null;
  $input['mobile_stop_index_slider_animation'] = ! empty( $input['mobile_stop_index_slider_animation'] ) ? 1 : 0;
  $input['mobile_index_slider_type'] = wp_filter_nohtml_kses( $input['mobile_index_slider_type'] );

  // 記事スライダー
  $input['mobile_index_post_slider_post_type'] = wp_filter_nohtml_kses( $input['mobile_index_post_slider_post_type'] );
  $input['mobile_index_post_slider_post_order'] = wp_filter_nohtml_kses( $input['mobile_index_post_slider_post_order'] );
  $input['mobile_index_post_slider_post_num'] = wp_filter_nohtml_kses( $input['mobile_index_post_slider_post_num'] );
  $input['mobile_index_post_slider_title_font_size'] = wp_filter_nohtml_kses( $input['mobile_index_post_slider_title_font_size'] );
  $input['mobile_index_post_slider_show_category'] = ! empty( $input['mobile_index_post_slider_show_category'] ) ? 1 : 0;
  $input['mobile_index_post_slider_show_author'] = ! empty( $input['mobile_index_post_slider_show_author'] ) ? 1 : 0;
  $input['mobile_index_post_slider_show_date'] = ! empty( $input['mobile_index_post_slider_show_date'] ) ? 1 : 0;
  $input['mobile_index_post_slider_show_update'] = ! empty( $input['mobile_index_post_slider_show_update'] ) ? 1 : 0;

  // ヘッダーコンテンツタイプ3
  $input['mobile_index_header_content_type3_post_type'] = wp_filter_nohtml_kses( $input['mobile_index_header_content_type3_post_type'] );
  $input['mobile_index_header_content_type3_post_order'] = wp_filter_nohtml_kses( $input['mobile_index_header_content_type3_post_order'] );
  $input['mobile_index_header_content_type3_title_font_size'] = wp_filter_nohtml_kses( $input['mobile_index_header_content_type3_title_font_size'] );
  $input['mobile_index_header_content_type3_show_category'] = ! empty( $input['mobile_index_header_content_type3_show_category'] ) ? 1 : 0;
  $input['mobile_index_header_content_type3_show_author'] = ! empty( $input['mobile_index_header_content_type3_show_author'] ) ? 1 : 0;
  $input['mobile_index_header_content_type3_show_date'] = ! empty( $input['mobile_index_header_content_type3_show_date'] ) ? 1 : 0;
  $input['mobile_index_header_content_type3_show_update'] = ! empty( $input['mobile_index_header_content_type3_show_update'] ) ? 1 : 0;
  $input['mobile_index_header_content_type3_use_overlay'] = ! empty( $input['mobile_index_header_content_type3_use_overlay'] ) ? 1 : 0;
  $input['mobile_index_header_content_type3_overlay_color'] = wp_filter_nohtml_kses( $input['mobile_index_header_content_type3_overlay_color'] );
  $input['mobile_index_header_content_type3_overlay_opacity'] = wp_filter_nohtml_kses( $input['mobile_index_header_content_type3_overlay_opacity'] );

  //スライダーの設定
  $index_slider = array();
  if ( isset( $input['mobile_index_slider'] ) && is_array( $input['mobile_index_slider'] ) ) {
    foreach ( $input['mobile_index_slider'] as $key => $value ) {
      $index_slider[] = array(
        'slider_type' => ( isset( $input['mobile_index_slider'][$key]['slider_type'] ) && array_key_exists( $input['mobile_index_slider'][$key]['slider_type'], $item_type_options ) ) ? $input['mobile_index_slider'][$key]['slider_type'] : 'type1',
        'image' => isset( $input['mobile_index_slider'][$key]['image'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['image'] ) : '',
        'video' => isset( $input['mobile_index_slider'][$key]['video'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['video'] ) : '',
        'youtube' => isset( $input['mobile_index_slider'][$key]['youtube'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['youtube'] ) : '',
        'catch' => isset( $input['mobile_index_slider'][$key]['catch'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch'] ) : '',
        'catch_font_type' => ( isset( $input['mobile_index_slider'][$key]['catch_font_type'] ) && array_key_exists( $input['mobile_index_slider'][$key]['catch_font_type'], $font_type_options ) ) ? $input['mobile_index_slider'][$key]['catch_font_type'] : 'type1',
        'catch_font_size' => isset( $input['mobile_index_slider'][$key]['catch_font_size'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_font_size'] ) : '18',
        'desc' => isset( $input['mobile_index_slider'][$key]['desc'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['desc'] ) : '',
        'desc_font_size' => isset( $input['mobile_index_slider'][$key]['desc_font_size'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['desc_font_size'] ) : '14',
        'show_button' => ! empty( $input['mobile_index_slider'][$key]['show_button'] ) ? 1 : 0,
        'button_label' => isset( $input['mobile_index_slider'][$key]['button_label'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_label'] ) : '',
        'button_type' => isset( $input['mobile_index_slider'][$key]['button_type'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_type'] ) : 'type1',
        'button_shape' => isset( $input['mobile_index_slider'][$key]['button_shape'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_shape'] ) : 'type1',
        'button_url' => isset( $input['mobile_index_slider'][$key]['button_url'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_url'] ) : '',
        'button_target' => ! empty( $input['mobile_index_slider'][$key]['button_target'] ) ? 1 : 0,
        'button_font_color' => isset( $input['mobile_index_slider'][$key]['button_font_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_font_color'] ) : '#ffffff',
        'button_font_color_hover' => isset( $input['mobile_index_slider'][$key]['button_font_color_hover'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_font_color_hover'] ) : '#ffffff',
        'button_bg_color' => isset( $input['mobile_index_slider'][$key]['button_bg_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_bg_color'] ) : '#00729f',
        'button_bg_color_hover' => isset( $input['mobile_index_slider'][$key]['button_bg_color_hover'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_bg_color_hover'] ) : '#00466d',
        'button_border_color' => isset( $input['mobile_index_slider'][$key]['button_border_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color'] ) : '#ffffff',
        'button_border_color_opacity' => isset( $input['mobile_index_slider'][$key]['button_border_color_opacity'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color_opacity'] ) : '1',
        'button_border_color_hover' => isset( $input['mobile_index_slider'][$key]['button_border_color_hover'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color_hover'] ) : '#00466d',
        'button_border_color_hover_opacity' => isset( $input['mobile_index_slider'][$key]['button_border_color_hover_opacity'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color_hover_opacity'] ) : '1',
        'use_overlay' => ! empty( $input['mobile_index_slider'][$key]['use_overlay'] ) ? 1 : 0,
        'overlay_color' => isset( $input['mobile_index_slider'][$key]['overlay_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['overlay_color'] ) : '#000000',
        'overlay_opacity' => isset( $input['mobile_index_slider'][$key]['overlay_opacity'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['overlay_opacity'] ) : '0.3',
        'post_type' => isset( $input['mobile_index_slider'][$key]['post_type'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['post_type'] ) : 'recent_post',
        'post_order' => isset( $input['mobile_index_slider'][$key]['post_order'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['post_order'] ) : 'date',
        'post_title_font_size' => isset( $input['mobile_index_slider'][$key]['post_title_font_size'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['post_title_font_size'] ) : '18',
        'post_show_category' => ! empty( $input['mobile_index_slider'][$key]['post_show_category'] ) ? 1 : 0,
        'post_show_author' => ! empty( $input['mobile_index_slider'][$key]['post_show_author'] ) ? 1 : 0,
        'post_show_date' => ! empty( $input['mobile_index_slider'][$key]['post_show_date'] ) ? 1 : 0,
        'post_show_update' => ! empty( $input['mobile_index_slider'][$key]['post_show_update'] ) ? 1 : 0,
      );
    }
  };
  $input['mobile_index_slider'] = $index_slider;


  // コンテンツビルダーの代わりに、固定ページのコンテンツを使う
  $input['mobile_index_content_type'] = wp_filter_nohtml_kses( $input['mobile_index_content_type'] );


  // コンテンツビルダー -----------------------------------------------------------------------------
  if (!empty($input['mobile_contents_builder'])) {

    $input_cb = $input['mobile_contents_builder'];
    $input['mobile_contents_builder'] = array();

    foreach($input_cb as $key => $value) {

      // クローン用はスルー
      //if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'))) continue;
      if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'), true)) continue;

      // カルーセル -----------------------------------------------------------------------
      if ($value['cb_content_select'] == 'carousel') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );

        $value['carousel_type'] = wp_filter_nohtml_kses( $value['carousel_type'] );
        $value['post_num_mobile'] = wp_filter_nohtml_kses( $value['post_num_mobile'] );
        $value['post_type'] = wp_filter_nohtml_kses( $value['post_type'] );
        $value['post_order'] = wp_filter_nohtml_kses( $value['post_order'] );

        $value['show_category'] = ! empty( $value['show_category'] ) ? 1 : 0;
        $value['show_author'] = ! empty( $value['show_author'] ) ? 1 : 0;
        $value['show_date'] = ! empty( $value['show_date'] ) ? 1 : 0;

        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );

        $value['show_ads'] = ! empty( $value['show_ads'] ) ? 1 : 0;
        $value['banner_num'] = wp_filter_nohtml_kses( $value['banner_num'] );

      // タブコンテンツ -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'featured_content') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );

        $value['show_post_list1'] = ! empty( $value['show_post_list1'] ) ? 1 : 0;
        $value['show_post_list2'] = ! empty( $value['show_post_list2'] ) ? 1 : 0;
        $value['show_post_list3'] = ! empty( $value['show_post_list3'] ) ? 1 : 0;

        $value['post_type1'] = wp_filter_nohtml_kses( $value['post_type1'] );
        $value['post_type2'] = wp_filter_nohtml_kses( $value['post_type2'] );
        $value['post_type3'] = wp_filter_nohtml_kses( $value['post_type3'] );

        $value['post_order1'] = wp_filter_nohtml_kses( $value['post_order1'] );
        $value['post_order2'] = wp_filter_nohtml_kses( $value['post_order2'] );
        $value['post_order3'] = wp_filter_nohtml_kses( $value['post_order3'] );

        $value['post_headline1'] = wp_filter_nohtml_kses( $value['post_headline1'] );
        $value['post_headline2'] = wp_filter_nohtml_kses( $value['post_headline2'] );
        $value['post_headline3'] = wp_filter_nohtml_kses( $value['post_headline3'] );

        $value['post_num_mobile'] = wp_filter_nohtml_kses( $value['post_num_mobile'] );

        $value['show_category'] = ! empty( $value['show_category'] ) ? 1 : 0;
        $value['show_author'] = ! empty( $value['show_author'] ) ? 1 : 0;
        $value['show_date'] = ! empty( $value['show_date'] ) ? 1 : 0;

        $value['post_animation'] = wp_filter_nohtml_kses( $value['post_animation'] );

        $value['show_ads1'] = ! empty( $value['show_ads1'] ) ? 1 : 0;
        $value['banner_num1'] = wp_filter_nohtml_kses( $value['banner_num1'] );
        $value['show_ads2'] = ! empty( $value['show_ads2'] ) ? 1 : 0;
        $value['banner_num2'] = wp_filter_nohtml_kses( $value['banner_num2'] );
        $value['show_ads3'] = ! empty( $value['show_ads3'] ) ? 1 : 0;
        $value['banner_num3'] = wp_filter_nohtml_kses( $value['banner_num3'] );

      // カテゴリー記事 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'category_post') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );
        $value['link_label'] = wp_filter_nohtml_kses( $value['link_label'] );

        $value['cat_id'] = wp_filter_nohtml_kses( $value['cat_id'] );
        $value['post_num_mobile'] = wp_filter_nohtml_kses( $value['post_num_mobile'] );

        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );
        $value['show_date'] = ! empty( $value['show_date'] ) ? 1 : 0;

        $value['bg_image'] = wp_filter_nohtml_kses( $value['bg_image'] );

        $value['bg_use_overlay'] = ! empty( $value['bg_use_overlay'] ) ? 1 : 0;
        $value['bg_overlay_color'] = wp_filter_nohtml_kses( $value['bg_overlay_color'] );
        $value['bg_overlay_opacity'] = wp_filter_nohtml_kses( $value['bg_overlay_opacity'] );

        $value['use_para'] = ! empty( $value['use_para'] ) ? 1 : 0;

        $value['show_ads'] = ! empty( $value['show_ads'] ) ? 1 : 0;
        $value['banner_num'] = wp_filter_nohtml_kses( $value['banner_num'] );

      // 3カラムコンテンツ -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'trend') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );

        $value['post_type1'] = wp_filter_nohtml_kses( $value['post_type1'] );
        $value['post_type2'] = wp_filter_nohtml_kses( $value['post_type2'] );
        $value['post_type3'] = wp_filter_nohtml_kses( $value['post_type3'] );

        $value['post_order1'] = wp_filter_nohtml_kses( $value['post_order1'] );
        $value['post_order2'] = wp_filter_nohtml_kses( $value['post_order2'] );
        $value['post_order3'] = wp_filter_nohtml_kses( $value['post_order3'] );

        $value['show_category'] = ! empty( $value['show_category'] ) ? 1 : 0;
        $value['show_author'] = ! empty( $value['show_author'] ) ? 1 : 0;
        $value['show_date'] = ! empty( $value['show_date'] ) ? 1 : 0;

        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );

      // 投稿者一覧 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'author_list') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );

        $value['carousel_type'] = wp_filter_nohtml_kses( $value['carousel_type'] );

        $value['author_list_order'] = !empty($value['author_list_order'])? $value['author_list_order'] : array();


      // News一覧 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'news_list') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );
        $value['show_date'] = ! empty( $value['show_date'] ) ? 1 : 0;
        $value['post_num_mobile'] = wp_filter_nohtml_kses( $value['post_num_mobile'] );
        $value['title_font_size_mobile'] = wp_filter_nohtml_kses( $value['title_font_size_mobile'] );


      // フリースペース -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'free_space') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        if ( ! isset( $value['free_space'] )) {
          $value['free_space'] = null;
        } else {
          $value['free_space'] = $value['free_space'];
        }

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );

        $value['content_width'] = wp_filter_nohtml_kses( $value['content_width'] );
        $value['margin_top'] = wp_filter_nohtml_kses( $value['margin_top'] );
        $value['margin_bottom'] = wp_filter_nohtml_kses( $value['margin_bottom'] );

      }

      $input['mobile_contents_builder'][] = $value;

    }

  } //コンテンツビルダーここまで -----------------------------------------------------------------------

  return $input;

};


/**
 * コンテンツビルダー用 コンテンツ選択プルダウン　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function mobile_the_cb_content_select($cb_index = 'cb_cloneindex', $selected = null) {

  $options = get_design_plus_option();
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

  $cb_content_select = array(
    'carousel' => __('Post carousel', 'tcd-w'),
    'featured_content' => __('Tab post content', 'tcd-w'),
    'category_post' => __('Category post', 'tcd-w'),
    'trend' => __('Three column post content', 'tcd-w'),
    'author_list' => __('Contributors list', 'tcd-w'),
    'news_list' => __('News list', 'tcd-w'),
    'free_space' => __('Free space', 'tcd-w')
  );

  if ($selected && isset($cb_content_select[$selected])) {
    $add_class = ' hidden';
  } else {
    $add_class = '';
  }

  $out = '<select name="dp_options[mobile_contents_builder]['.esc_attr($cb_index).'][cb_content_select]" class="cb_content_select'.$add_class.'">';
  $out .= '<option value="" style="padding-right: 10px;">'.__("Choose the content", "tcd-w").'</option>';

  foreach($cb_content_select as $key => $value) {
    $attr = '';
    if ($key == $selected) {
      $attr = ' selected="selected"';
    }
    $out .= '<option value="'.esc_attr($key).'"'.$attr.' style="padding-right: 10px;">'.esc_html($value).'</option>';
  }

  $out .= '</select>';

  echo $out; 

}


/**
 * コンテンツビルダー用 コンテンツ設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function mobile_the_cb_content_setting($cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array()) {

  global $content_direction_options, $font_type_options, $content_width_options, $post_list_animation_type_options;
  $options = get_design_plus_option();
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

?>

<div class="cb_content_wrap cf <?php echo esc_attr($cb_content_select); ?>">

<?php
     // カルーセル　-------------------------------------------------------------
     if ($cb_content_select == 'carousel') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['desc'])) { $value['desc'] = ''; }

       if (!isset($value['carousel_type'])) { $value['carousel_type'] = 'type1'; }

       if (!isset($value['post_num_mobile'])) { $value['post_num_mobile'] = '4'; }
       if (!isset($value['post_type'])) { $value['post_type'] = 'recent_post'; }
       if (!isset($value['post_order'])) { $value['post_order'] = 'date'; }

       if (!isset($value['show_category'])) { $value['show_category'] = 1; }
       if (!isset($value['show_author'])) { $value['show_author'] = 1; }
       if (!isset($value['show_date'])) { $value['show_date'] = 1; }

       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '16'; }

       if (!isset($value['show_ads'])) { $value['show_ads'] = ''; }
       if (!isset($value['banner_num'])) { $value['banner_num'] = '3'; }
?>

  <h3 class="cb_content_headline"><?php _e('Post carousel', 'tcd-w'); ?><span class="cb_content_headline_sub_title"></span></h3>
  <label class="cb_content_switch"><div class="label_wrap"><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div></label>
  <div class="cb_content">

   <div class="cb_content_switch_target">

    <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Headline', 'tcd-w');  ?></span>
       <input type="text" class="full_width cb-repeater-label" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php echo esc_html($value['headline']); ?>" />
       <div class="theme_option_message2" style="clear:both;">
         <p><?php _e('You can set font size and font type from basic setting menu font setting option section.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Description', 'tcd-w'); ?></span>
       <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
      </li>
     </ul>

    <h4 class="theme_option_headline2"><?php _e('Carousel', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Carousel type', 'tcd-w');  ?></span>
       <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][carousel_type]">
        <option style="padding-right: 10px;" value="type1" <?php selected( $value['carousel_type'], 'type1' ); ?>><?php _e('Full width carousel', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="type2" <?php selected( $value['carousel_type'], 'type2' ); ?>><?php _e('Carousel with space on the left', 'tcd-w'); ?></option>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
       <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_type]">
        <option style="padding-right: 10px;" value="recent_post" <?php selected( $value['post_type'], 'recent_post' ); ?>><?php _e('All post', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="recommend_post" <?php selected( $value['post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="featured_post" <?php selected( $value['post_type'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="pickup_post" <?php selected( $value['post_type'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w'); ?></option>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
       <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_order]">
        <option style="padding-right: 10px;" value="date" <?php selected( $value['post_order'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="rand" <?php selected( $value['post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
       <div class="display_post_num_option">
        <label class="number_option">
         <input class="hankaku" type="number" min="-1" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_num_mobile]" value="<?php esc_attr_e( $value['post_num_mobile'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span>
       <div class="font_size_option">
        <label class="font_size_label number_option">
         <input class="font_size hankaku" type="number" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_category]" type="checkbox" value="1" <?php checked( $value['show_category'], 1 ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_author]" type="checkbox" value="1" <?php checked( $value['show_author'], 1 ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_date]" type="checkbox" value="1" <?php checked( $value['show_date'], 1 ); ?>></li>
      <li class="cf">
       <span class="label"><?php _e('Native ads setting', 'tcd-w'); ?></span>
       <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_ads]" type="checkbox" value="1" <?php checked( $value['show_ads'], 1 ); ?>> <?php _e( 'Display native ads', 'tcd-w' ); ?></label></p>
       <div style="<?php if($value['show_ads'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
        <div class="theme_option_message2">
         <p><?php _e('Native ads will be displayed at number of articles set below.<br>For example if you set the number 3, native ads will be displayed between second post and third post.', 'tcd-w'); ?></p>
        </div>
        <p><input class="hankaku" style="width:70px;" type="number" max="9999" min="1" step="1" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][banner_num]" value="<?php echo esc_attr( $value['banner_num'] ); ?>" /></p>
       </div>
      </li>
     </ul>

   </div><!-- END .cb_content_switch_target -->

<?php
     // タブコンテンツ　-------------------------------------------------------------
     } elseif ($cb_content_select == 'featured_content') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['desc'])) { $value['desc'] = ''; }

       if (!isset($value['post_num_mobile'])) { $value['post_num_mobile'] = '4'; }

       if (!isset($value['show_post_list1'])) { $value['show_post_list1'] = 1; }
       if (!isset($value['show_post_list2'])) { $value['show_post_list2'] = 1; }
       if (!isset($value['show_post_list3'])) { $value['show_post_list3'] = 1; }

       if (!isset($value['post_type1'])) { $value['post_type1'] = 'recent_post'; }
       if (!isset($value['post_type2'])) { $value['post_type2'] = 'featured_post'; }
       if (!isset($value['post_type3'])) { $value['post_type3'] = 'recommend_post'; }

       if (!isset($value['post_order1'])) { $value['post_order1'] = 'date'; }
       if (!isset($value['post_order2'])) { $value['post_order2'] = 'rand'; }
       if (!isset($value['post_order3'])) { $value['post_order3'] = 'rand'; }

       if (!isset($value['post_headline1'])) { $value['post_headline1'] = __( 'All post', 'tcd-w' ); }
       if (!isset($value['post_headline2'])) { $value['post_headline2'] = __( 'Featured post', 'tcd-w' ); }
       if (!isset($value['post_headline3'])) { $value['post_headline3'] = __( 'Recommend post', 'tcd-w' ); }

       if (!isset($value['show_category'])) { $value['show_category'] = 1; }
       if (!isset($value['show_author'])) { $value['show_author'] = 1; }
       if (!isset($value['show_date'])) { $value['show_date'] = 1; }

       if (!isset($value['post_animation'])) { $value['post_animation'] = 'type4'; }

       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '16'; }

       if (!isset($value['show_ads1'])) { $value['show_ads1'] = ''; }
       if (!isset($value['banner_num1'])) { $value['banner_num1'] = '2'; }
       if (!isset($value['show_ads2'])) { $value['show_ads2'] = ''; }
       if (!isset($value['banner_num2'])) { $value['banner_num2'] = '2'; }
       if (!isset($value['show_ads3'])) { $value['show_ads3'] = ''; }
       if (!isset($value['banner_num3'])) { $value['banner_num3'] = '2'; }

?>

  <h3 class="cb_content_headline"><?php _e('Tab post content', 'tcd-w'); ?><span class="cb_content_headline_sub_title"></span></h3>
  <label class="cb_content_switch"><div class="label_wrap"><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div></label>

  <div class="cb_content tab_parent button_option_parent">

   <div class="cb_content_switch_target">

   <div class="theme_option_message2" style="margin-top: 20px;">
    <p><?php _e('You can display sort button and post list on left side and you can display featured widget on right side.<br>Please register featured widget at <a href="./widgets.php" target="_blank">widget page</a>.', 'tcd-w');  ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Headline', 'tcd-w');  ?></span>
     <input type="text" class="full_width cb-repeater-label" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php echo esc_html($value['headline']); ?>" />
     <div class="theme_option_message2">
      <p><?php _e('You can set font size and font type from basic setting menu font setting option section.', 'tcd-w');  ?></p>
     </div>
    </li>
    <li class="cf">
     <span class="label"><?php _e('Description', 'tcd-w'); ?></span>
     <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Content', 'tcd-w');  ?></h4>
   <div class="sub_box_tab">
    <div class="tab active" data-tab="tab1"><?php _e('Tab', 'tcd-w'); ?>1</div>
    <div class="tab" data-tab="tab2"><?php _e('Tab', 'tcd-w'); ?>2</div>
    <div class="tab" data-tab="tab3"><?php _e('Tab', 'tcd-w'); ?>3</div>
    <div class="tab" data-tab="tab4"><?php _e('Common setting', 'tcd-w'); ?></div>
   </div>

   <?php for ( $i = 1; $i <= 3; $i++ ): ?>
   <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Display this tab', 'tcd-w'); ?></span>
       <label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_post_list<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $value['show_post_list'.$i], 1 ); ?>></label>
      </li>
      <li class="cf space">
       <span class="label"><?php _e('Headline', 'tcd-w'); ?></span>
       <input type="text" class="tab_label full_width" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_headline<?php echo $i; ?>]" value="<?php echo esc_html(  $value['post_headline'.$i] ); ?>" />
      </li>
      <li class="cf">
       <span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
       <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_type<?php echo $i; ?>]">
        <option style="padding-right: 10px;" value="recent_post" <?php selected( $value['post_type'.$i], 'recent_post' ); ?>><?php _e('All post', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="recommend_post" <?php selected( $value['post_type'.$i], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="featured_post" <?php selected( $value['post_type'.$i], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="pickup_post" <?php selected( $value['post_type'.$i], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w'); ?></option>
       </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
       <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_order<?php echo $i; ?>]">
        <option style="padding-right: 10px;" value="date" <?php selected( $value['post_order'.$i], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="rand" <?php selected( $value['post_order'.$i], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
       </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Display native ads', 'tcd-w'); ?></span>
       <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_ads<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $value['show_ads'.$i], 1 ); ?>></label></p>
       <div style="<?php if($value['show_ads1'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
        <div class="theme_option_message2">
         <p><?php _e('Native ads will be displayed at number of articles set below.<br>For example if you set the number 3, native ads will be displayed between second post and third post.', 'tcd-w'); ?></p>
        </div>
        <p><input class="hankaku" style="width:70px;" type="number" max="9999" min="1" step="1" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][banner_num<?php echo $i; ?>]" value="<?php echo esc_attr( $value['banner_num'.$i] ); ?>" /></p>
       </div>
      </li>
     </ul>
   </div><!-- END .sub_box_tab_content -->
   <?php endfor; ?>
   <div class="sub_box_tab_content" data-tab-content="tab4">
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
       <div class="display_post_num_option">
        <label class="number_option">
         <input class="hankaku" type="number" min="-1" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_num_mobile]" value="<?php esc_attr_e( $value['post_num_mobile'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Animation type', 'tcd-w'); ?></span>
       <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_animation]">
        <?php foreach ( $post_list_animation_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['post_animation'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
        <option style="padding-right: 10px;" value="type4" <?php selected( $value['post_animation'], 'type4' ); ?>><?php _e('No animation', 'tcd-w'); ?></option>
       </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span>
       <div class="font_size_option">
        <label class="font_size_label number_option">
         <input class="font_size hankaku" type="number" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Display category', 'tcd-w'); ?></span>
       <input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_category]" type="checkbox" value="1" <?php checked( $value['show_category'], 1 ); ?>>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Display author', 'tcd-w'); ?></span>
       <input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_author]" type="checkbox" value="1" <?php checked( $value['show_author'], 1 ); ?>>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Display date', 'tcd-w'); ?></span>
       <input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_date]" type="checkbox" value="1" <?php checked( $value['show_date'], 1 ); ?>>
      </li>
     </ul>
   </div><!-- END .sub_box_tab_content -->

   </div><!-- END .cb_content_switch_target -->

<?php
     // カテゴリー記事　-------------------------------------------------------------
     } elseif ($cb_content_select == 'category_post') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['desc'])) { $value['desc'] = ''; }
       if (!isset($value['link_label'])) { $value['link_label'] = ''; }

       if (!isset($value['cat_id'])) { $value['cat_id'] = ''; }
       if (!isset($value['post_num_mobile'])) { $value['post_num_mobile'] = '3'; }

       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '14'; }
       if (!isset($value['show_date'])) { $value['show_date'] = '1'; }

       if (!isset($value['bg_image'])) { $value['bg_image'] = ''; }
       if (!isset($value['bg_use_overlay'])) { $value['bg_use_overlay'] = ''; }
       if (!isset($value['bg_overlay_color'])) { $value['bg_overlay_color'] = '#000000'; }
       if (!isset($value['bg_overlay_opacity'])) { $value['bg_overlay_opacity'] = '0.3'; }

       if (!isset($value['use_para'])) { $value['use_para'] = ''; }

       if (!isset($value['show_ads'])) { $value['show_ads'] = ''; }
       if (!isset($value['banner_num'])) { $value['banner_num'] = '3'; }
?>

  <h3 class="cb_content_headline"><?php _e('Category post', 'tcd-w'); ?><span class="cb_content_headline_sub_title"></span></h3>
  <label class="cb_content_switch"><div class="label_wrap"><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div></label>

  <div class="cb_content tab_parent button_option_parent">

   <div class="cb_content_switch_target" style="margin-top: 20px;">

   <div class="theme_option_message2">
     <p><?php _e('A group of articles in a specified category can be overlaid on a background image.', 'tcd-w'); ?></p>
   </div>

   <div class="sub_box_tab">
    <div class="tab active" data-tab="tab1"><?php _e('Catchphrase', 'tcd-w'); ?></div>
    <div class="tab" data-tab="tab2"><?php _e('Content', 'tcd-w'); ?></div>
    <div class="tab" data-tab="tab3"><?php _e('Background', 'tcd-w'); ?></div>
   </div>

   <div class="sub_box_tab_content active" data-tab-content="tab1">
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Headline', 'tcd-w');  ?></span>
       <input type="text" class="full_width cb-repeater-label" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php echo esc_html($value['headline']); ?>" />
       <div class="theme_option_message2">
        <p><?php _e('You can set font size and font type from basic setting menu font setting option section.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Catchphrase', 'tcd-w'); ?></span>
       <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
       <div class="theme_option_message2">
        <p><?php _e('You can set font size and font type from basic setting menu font setting option section.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Description', 'tcd-w'); ?></span>
       <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Archive page link label', 'tcd-w');  ?></span>
       <input type="text" class="full_width" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][link_label]" value="<?php echo esc_html($value['link_label']); ?>" />
      </li>
     </ul>
   </div><!-- END .sub_box_tab_content -->

   <div class="sub_box_tab_content" data-tab-content="tab2">
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Category of post', 'tcd-w');  ?></span>
       <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][cat_id]">
        <option style="padding-right: 10px;" value="" <?php selected( $value['cat_id'], ''); ?>><?php _e('Select category', 'tcd-w'); ?></option>
        <?php
             $cats = get_categories('hide_empty=0');
             if($cats){
               foreach ( $cats as $cat ) :
               $cat_id = $cat->cat_ID;
        ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($cat_id); ?>" <?php selected( $value['cat_id'], $cat_id ); ?>><?php echo esc_html($cat->cat_name); ?></option>
        <?php
               endforeach;
             }
        ?>
       </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
       <div class="display_post_num_option">
        <label class="number_option">
         <input class="hankaku" type="number" min="-1" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_num_mobile]" value="<?php esc_attr_e( $value['post_num_mobile'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span>
       <div class="font_size_option">
        <label class="font_size_label number_option">
         <input class="font_size hankaku" type="number" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Display date', 'tcd-w'); ?></span>
       <input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_date]" type="checkbox" value="1" <?php checked( $value['show_date'], 1 ); ?>>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Native ads setting', 'tcd-w'); ?></span>
       <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_ads]" type="checkbox" value="1" <?php checked( $value['show_ads'], 1 ); ?>> <?php _e( 'Display native ads', 'tcd-w' ); ?></label></p>
       <div style="<?php if($value['show_ads'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
        <div class="theme_option_message2">
         <p><?php _e('Native ads will be displayed at number of articles set below.<br>For example if you set the number 3, native ads will be displayed between second post and third post.', 'tcd-w'); ?></p>
        </div>
        <p><input class="hankaku" style="width:70px;" type="number" max="9999" min="1" step="1" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][banner_num]" value="<?php echo esc_attr( $value['banner_num'] ); ?>" /></p>
       </div>
      </li>
     </ul>
   </div><!-- END .sub_box_tab_content -->

   <div class="sub_box_tab_content" data-tab-content="tab3">
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Background image', 'tcd-w'); ?>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js bg_image-<?php echo $cb_index; ?>">
         <input type="hidden" class="cf_media_id" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_image]" id="bg_image-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['bg_image'] ); ?>">
         <div class="preview_field"><?php if ( $value['bg_image'] ) echo wp_get_attachment_image( $value['bg_image'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( empty($value['bg_image']) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <div class="theme_option_message2">
        <p class="no_para"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '580'); ?></p>
        <p class="yes_para"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '1020'); ?></p>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Use parallax effect', 'tcd-w'); ?></span>
       <input class="use_para_checkbox" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][use_para]" type="checkbox" value="1" <?php checked( $value['use_para'], 1 ); ?>>
       <div class="theme_option_message2" style="clear:both;">
        <p><?php _e('You can express a three-dimensional effect and depth background.', 'tcd-w'); ?></p>
        <p><?php _e('If you use parallax effect on background, please upload very high height image.', 'tcd-w'); ?></p>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Use overlay', 'tcd-w'); ?></span>
       <input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_use_overlay]" type="checkbox" value="1" <?php checked( $value['bg_use_overlay'], 1 ); ?>>
      </li>
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_overlay_color]" value="<?php echo esc_attr( $value['bg_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span>
       <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_overlay_opacity]" value="<?php echo esc_attr( $value['bg_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin-top:10px;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>
   </div><!-- END .sub_box_tab_content -->

   </div><!-- END .cb_content_switch_target -->

<?php
     // 3カラムコンテンツ　-------------------------------------------------------------
     } elseif ($cb_content_select == 'trend') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['desc'])) { $value['desc'] = ''; }

       if (!isset($value['post_type1'])) { $value['post_type1'] = 'recent_post'; }
       if (!isset($value['post_type2'])) { $value['post_type2'] = 'featured_post'; }
       if (!isset($value['post_type3'])) { $value['post_type3'] = 'recommend_post'; }

       if (!isset($value['post_order1'])) { $value['post_order1'] = 'date'; }
       if (!isset($value['post_order2'])) { $value['post_order2'] = 'rand'; }
       if (!isset($value['post_order3'])) { $value['post_order3'] = 'rand'; }

       if (!isset($value['show_category'])) { $value['show_category'] = 1; }
       if (!isset($value['show_author'])) { $value['show_author'] = 1; }
       if (!isset($value['show_date'])) { $value['show_date'] = 1; }

       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '14'; }

?>

  <h3 class="cb_content_headline"><?php _e('Three column post content', 'tcd-w'); ?><span class="cb_content_headline_sub_title"></span></h3>
  <label class="cb_content_switch"><div class="label_wrap"><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div></label>
  <div class="cb_content tab_parent button_option_parent">

   <div class="cb_content_switch_target">

   <div class="theme_option_message2" style="margin-top: 20px;">
    <p><?php _e('Each of the three columns can display a different group of articles.<br>The articles on the right column will be hidden when the screen is smartphone-sized.', 'tcd-w');  ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Headline', 'tcd-w');  ?></span>
     <input type="text" class="full_width cb-repeater-label" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php echo esc_html($value['headline']); ?>" />
     <div class="theme_option_message2">
      <p><?php _e('You can set font size and font type from basic setting menu font setting option section.', 'tcd-w');  ?></p>
     </div>
    </li>
    <li class="cf">
     <span class="label"><?php _e('Description', 'tcd-w'); ?></span>
     <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Content', 'tcd-w');  ?></h4>
   <div class="sub_box_tab">
    <div class="tab active" data-tab="tab1"><?php _e('Left post list', 'tcd-w'); ?></div>
    <div class="tab" data-tab="tab2"><?php _e('Center post list', 'tcd-w'); ?></div>
    <div class="tab" data-tab="tab3"><?php _e('Right post list', 'tcd-w'); ?></div>
    <div class="tab" data-tab="tab4"><?php _e('Common setting', 'tcd-w'); ?></div>
   </div>

   <div class="sub_box_tab_content active" data-tab-content="tab1">
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
        <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_type1]">
         <option style="padding-right: 10px;" value="recent_post" <?php selected( $value['post_type1'], 'recent_post' ); ?>><?php _e('All post', 'tcd-w'); ?></option>
         <option style="padding-right: 10px;" value="recommend_post" <?php selected( $value['post_type1'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w'); ?></option>
         <option style="padding-right: 10px;" value="featured_post" <?php selected( $value['post_type1'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w'); ?></option>
         <option style="padding-right: 10px;" value="pickup_post" <?php selected( $value['post_type1'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w'); ?></option>
        </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
       <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_order1]">
        <option style="padding-right: 10px;" value="date" <?php selected( $value['post_order1'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="rand" <?php selected( $value['post_order1'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
       </select>
      </li>
     </ul>
   </div><!-- END .sub_box_tab_content -->

   <div class="sub_box_tab_content" data-tab-content="tab2">
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
        <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_type2]">
          <option style="padding-right: 10px;" value="recent_post" <?php selected( $value['post_type2'], 'recent_post' ); ?>><?php _e('All post', 'tcd-w'); ?></option>
          <option style="padding-right: 10px;" value="recommend_post" <?php selected( $value['post_type2'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w'); ?></option>
          <option style="padding-right: 10px;" value="featured_post" <?php selected( $value['post_type2'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w'); ?></option>
          <option style="padding-right: 10px;" value="pickup_post" <?php selected( $value['post_type2'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w'); ?></option>
        </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
       <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_order2]">
        <option style="padding-right: 10px;" value="date" <?php selected( $value['post_order2'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="rand" <?php selected( $value['post_order2'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_author]" type="checkbox" value="1" <?php checked( $value['show_author'], 1 ); ?>></li>
     </ul>
   </div><!-- END .sub_box_tab_content -->

   <div class="sub_box_tab_content" data-tab-content="tab3">
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
        <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_type3]">
         <option style="padding-right: 10px;" value="recent_post" <?php selected( $value['post_type3'], 'recent_post' ); ?>><?php _e('All post', 'tcd-w'); ?></option>
         <option style="padding-right: 10px;" value="recommend_post" <?php selected( $value['post_type3'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w'); ?></option>
         <option style="padding-right: 10px;" value="featured_post" <?php selected( $value['post_type3'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w'); ?></option>
         <option style="padding-right: 10px;" value="pickup_post" <?php selected( $value['post_type3'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w'); ?></option>
        </select>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
       <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_order3]">
        <option style="padding-right: 10px;" value="date" <?php selected( $value['post_order3'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="rand" <?php selected( $value['post_order3'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
       </select>
      </li>
     </ul>
   </div><!-- END .sub_box_tab_content -->

   <div class="sub_box_tab_content" data-tab-content="tab4">
     <ul class="option_list">
      <li class="cf">
        <span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span>
       <div class="font_size_option">
        <label class="font_size_label number_option">
         <input class="font_size hankaku" type="number" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_category]" type="checkbox" value="1" <?php checked( $value['show_category'], 1 ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_date]" type="checkbox" value="1" <?php checked( $value['show_date'], 1 ); ?>></li>
     </ul>
   </div><!-- END .sub_box_tab_content -->

   </div><!-- END .cb_content_switch_target -->


<?php
     // 投稿者一覧　-------------------------------------------------------------
     } elseif ($cb_content_select == 'author_list') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['desc'])) { $value['desc'] = ''; }

       if (!isset($value['carousel_type'])) { $value['carousel_type'] = 'type1'; }
       if (!isset($value['author_list_order'])) { $value['author_list_order'] = array(); }
?>
  <h3 class="cb_content_headline"><?php _e('Contributors list', 'tcd-w'); ?><span class="cb_content_headline_sub_title"></span></h3>
  <label class="cb_content_switch"><div class="label_wrap"><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div></label>
  <div class="cb_content tab_parent button_option_parent">

   <div class="cb_content_switch_target">

   <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Headline', 'tcd-w');  ?></span>
     <input type="text" class="full_width cb-repeater-label" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php echo esc_html($value['headline']); ?>" />
     <div class="theme_option_message2">
      <p><?php _e('You can set font size and font type from basic setting menu font setting option section.', 'tcd-w');  ?></p>
     </div>
    </li>
    <li class="cf">
     <span class="label"><?php _e('Description', 'tcd-w'); ?></span>
     <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Carousel', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Carousel type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][carousel_type]">
      <option style="padding-right: 10px;" value="type1" <?php selected( $value['carousel_type'], 'type1' ); ?>><?php _e('Full width carousel', 'tcd-w'); ?></option>
      <option style="padding-right: 10px;" value="type2" <?php selected( $value['carousel_type'], 'type2' ); ?>><?php _e('Carousel with space on the left', 'tcd-w'); ?></option>
     </select>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Contributors', 'tcd-w');  ?></h4>
<?php
  if (empty($value['author_list_order']) || !is_array($value['author_list_order'])) {
    $value['author_list_order'] = array();
  }
  $users = get_users(array(
    'fields' => array('ID'),
    'role__not_in' => array('subscriber','contributor'),
    'orderby' => 'ID',
    'order' => 'ASC'
  ));

  if ($users) {
    $user_ids = array();
    foreach ($users as $user) {
      $user_ids[] = $user->ID;
    }

    if ($value['author_list_order']) {
      foreach ($value['author_list_order'] as $key => $author_id) {
        if (!in_array($author_id, $user_ids)) {
          unset($value['author_list_order'][$key]);
        }
      }
    }

    $author_list = $value['author_list_order'];
    foreach ($user_ids as $user_id) {
      if (!in_array($user_id, $value['author_list_order'])) {
        $author_list[] = $user_id;
      }
    }
    unset($user_ids, $user_id);
  } else {
    $value['author_list_order'] = array();
  }
  unset($users);
  $counter = 0;
  foreach( $author_list as $user_id ){
    $user_data = get_userdata($user_id);
    if($user_data->show_author_list){ $counter++; };
  }
?>
  <?php if($counter>0) { ?>
   <div class="theme_option_message2">
    <p><?php _e('Please check the checkbox "Show author profile at author list page" from each user <a href="./users.php">profile page</a> before you use this function.', 'tcd-w');  ?></p>
   </div>

   <div class="contributors_list_wrapper">
     <input type="hidden" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][author_list_order]" value="">
     <ul class="contributors_list ui-sortable">
      <?php
        if ( $author_list ) {
        foreach( $author_list as $user_id ):
          $user_data = get_userdata($user_id);
          $user_name = $user_data->display_name;
          $show_author_list = $user_data->show_author_list;
          if($show_author_list) {
      ?>
       <li class="item">
         <label>
           <input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][author_list_order][]" type="checkbox" value="<?php echo $user_id; ?>" <?php checked( in_array( $user_id, $value['author_list_order'] ), true ); ?> />
          <span><?php echo $user_name ?></span>
         </label>
       </li>
      <?php }; endforeach; }; ?>
     </ul>
   </div>
  <?php }else{ ?>
   <div class="theme_option_message2">
    <p><?php _e('The user displayed in the contributors list is not set.', 'tcd-w'); ?></p>
    <p><?php _e('Please check the checkbox "Show author profile at author list page" from each user <a href="./users.php">profile page</a> before you use this function.', 'tcd-w');  ?></p>
   </div>
  <?php }; ?>

   </div><!-- END .cb_content_switch_target -->

<?php
     // News一覧　-------------------------------------------------------------
     } elseif ($cb_content_select == 'news_list') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['desc'])) { $value['desc'] = ''; }
       if (!isset($value['show_date'])) { $value['show_date'] = 1; }
       if (!isset($value['post_num_mobile'])) { $value['post_num_mobile'] = '6'; }
       if (!isset($value['title_font_size_mobile'])) { $value['title_font_size_mobile'] = '18'; }
?>
  <h3 class="cb_content_headline"><?php _e('News list', 'tcd-w'); ?><span class="cb_content_headline_sub_title"></span></h3>
  <label class="cb_content_switch"><div class="label_wrap"><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div></label>
  <div class="cb_content">

   <div class="cb_content_switch_target">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_image_post_carousel.jpg" width="" height="" />
   </div>

    <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-w');  ?></span>
       <input type="text" class="full_width cb-repeater-label" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php echo esc_html($value['headline']); ?>" />
       <div class="theme_option_message2" style="clear:both;">
         <p><?php _e('You can set font size and font type from basic setting menu font setting option section.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf">
       <span class="label"><span class="num">2</span><?php _e('Description', 'tcd-w'); ?></span>
       <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
      </li>
     </ul>

    <h4 class="theme_option_headline2"><?php _e('Content', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
       <div class="display_post_num_option">
        <label class="number_option">
         <input class="hankaku" type="number" min="-1" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_num_mobile]" value="<?php esc_attr_e( $value['post_num_mobile'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span>
       <div class="font_size_option">
        <label class="font_size_label number_option">
         <input class="font_size hankaku" type="number" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size_mobile]" value="<?php esc_attr_e( $value['title_font_size_mobile'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_date]" type="checkbox" value="1" <?php checked( $value['show_date'], 1 ); ?>></li>
     </ul>

   </div><!-- END .cb_content_switch_target -->


<?php
     // フリースペース　-------------------------------------------------------------
     } elseif ($cb_content_select == 'free_space') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['free_space'])) {
         $value['free_space'] = '';
       }

       if (!isset($value['content_width'])) { $value['content_width'] = 'type1'; }

       if (!isset($value['headline'])) { $value['headline'] = ''; }
       if (!isset($value['desc'])) { $value['desc'] = ''; }

       if (!isset($value['margin_top'])) { $value['margin_top'] = '0'; }
       if (!isset($value['margin_bottom'])) { $value['margin_bottom'] = '0'; }
?>
  <h3 class="cb_content_headline"><?php _e('Free space', 'tcd-w');  ?><span class="cb_content_headline_sub_title"></span></h3>
  <label class="cb_content_switch"><div class="label_wrap"><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div></label>
  <div class="cb_content">

   <div class="cb_content_switch_target">

   <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Catchphrase', 'tcd-w'); ?></span>
     <input type="text" class="full_width cb-repeater-label" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][headline]" value="<?php echo esc_html($value['headline']); ?>" />
    </li>
    <li class="cf">
     <span class="label"><?php _e('Description', 'tcd-w'); ?></span>
     <textarea class="full_width" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
   <ul class="design_radio_button horizontal cf">
      <?php foreach ( $content_width_options as $option ) { ?>
      <li>
       <input type="radio" id="content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][content_width]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['content_width'], $option['value'] ); ?> />
       <label for="content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>"><?php echo esc_html( $option['label'] ); ?></label>
      </li>
      <?php } ?>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?></h4>
     <?php
          wp_editor(
            $value['free_space'],
            'cb_wysiwyg_editor-' . $cb_index,
            array (
              'textarea_name' => 'dp_options[mobile_contents_builder][' . $cb_index . '][free_space]'
            )
         );
     ?>

   <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf">
        <span class="label"><?php _e('Top space of content', 'tcd-w'); ?></span>
        <div class="font_size_option">
          <label class="font_size_label number_option">
           <input class="font_size hankaku" type="number" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][margin_top]" value="<?php esc_attr_e( $value['margin_top'] ); ?>" />
           <span class="icon icon_sp"></span>
          </label>
        </div>
      </li>
      <li class="cf">
        <span class="label"><?php _e('Bottom space of content', 'tcd-w'); ?></span>
        <div class="font_size_option">
          <label class="font_size_label number_option">
           <input class="font_size hankaku" type="number" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][margin_bottom]" value="<?php esc_attr_e( $value['margin_bottom'] ); ?>" />
           <span class="icon icon_sp"></span>
          </label>
        </div>
      </li>
     </ul>

   </div><!-- END .cb_content_switch_target -->

<?php
     // ボタンの表示　-------------------------------------------------------------
     } else {
?>
  <h3 class="cb_content_headline"><?php echo esc_html($cb_content_select); ?></h3>
  <div class="cb_content">

<?php
     }
?>

   <ul class="button_list cf">
    <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>

  </div><!-- END .cb_content -->

</div><!-- END .cb_content_wrap -->

<?php

} // END the_cb_content_setting()

?>