<?php

/* フォーム用 画像フィールド出力 */
function mlcf_media_form($cf_key, $label) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($label)) $label = $cf_key;

	$media_id = get_post_meta($post->ID, $cf_key, true);
?>
 <div class="image_box cf">
  <div class="cf cf_media_field hide-if-no-js <?php echo esc_attr($cf_key); ?>">
    <input type="hidden" class="cf_media_id" name="<?php echo esc_attr($cf_key); ?>" id="<?php echo esc_attr($cf_key); ?>" value="<?php echo esc_attr($media_id); ?>" />
    <div class="preview_field"><?php if ($media_id) the_mlcf_image($post->ID, $cf_key); ?></div>
    <div class="buttton_area">
     <input type="button" class="cfmf-select-img button" value="<?php _e('Select Image', 'tcd-w'); ?>" />
     <input type="button" class="cfmf-delete-img button<?php if (!$media_id) echo ' hidden'; ?>" value="<?php _e('Remove Image', 'tcd-w'); ?>" />
    </div>
  </div>
 </div>
<?php
}




/* 画像フィールドで選択された画像をimgタグで出力 */
function the_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	echo get_mlcf_image($post_id, $cf_key, $image_size);
}

/* 画像フィールドで選択された画像をimgタグで返す */
function get_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_image($media_id, $image_size, $image_size);
	}

	return false;
}

/* 画像フィールドで選択された画像urlを返す */
function get_mlcf_image_url($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		$img = wp_get_attachment_image_src($media_id, $image_size);
		if (!empty($img[0])) {
			return $img[0];
		}
	}

	return false;
}

/* 画像フィールドで選択されたメディアのURLを出力 */
function the_mlcf_media_url($post_id, $cf_key) {
	echo get_mlcf_media_url($post_id, $cf_key);
}

/* 画像フィールドで選択されたメディアのURLを返す */
function get_mlcf_media_url($post_id, $cf_key) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_url($media_id);
	}

	return false;
}


// ヘッダーの設定 -------------------------------------------------------

function page_header_meta_box() {
  add_meta_box(
    'page_header_meta_box',//ID of meta box
    __('Page setting', 'tcd-w'),//label
    'show_page_header_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'page_header_meta_box');

function show_page_header_meta_box() {

  global $post, $layout_options, $font_type_options, $catch_animation_type_options;

  $page_header_catch = get_post_meta($post->ID, 'page_header_catch', true);
  $page_header_catch_mobile = get_post_meta($post->ID, 'page_header_catch_mobile', true);
  $page_header_catch_font_size = get_post_meta($post->ID, 'page_header_catch_font_size', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size', true) : '32';
  $page_header_catch_font_size_mobile = get_post_meta($post->ID, 'page_header_catch_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size_mobile', true) : '22';

  $page_header_desc = get_post_meta($post->ID, 'page_header_desc', true);
  $page_header_desc_font_size = get_post_meta($post->ID, 'page_header_desc_font_size', true) ?  get_post_meta($post->ID, 'page_header_desc_font_size', true) : '16';
  $page_header_desc_font_size_mobile = get_post_meta($post->ID, 'page_header_desc_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_desc_font_size_mobile', true) : '14';

  $page_header_catch_border_color = get_post_meta($post->ID, 'page_header_catch_border_color', true) ?  get_post_meta($post->ID, 'page_header_catch_border_color', true) : '#d9d900';
  if(empty(get_post_meta($post->ID, 'page_header_catch_color_use_main', true))){
    $page_header_catch_color_use_main = '1';
  } else {
    $page_header_catch_color_use_main = get_post_meta($post->ID, 'page_header_catch_color_use_main', true);
  }
  $hide_underline = get_post_meta($post->ID, 'hide_underline', true);
  $hide_underline_mobile = get_post_meta($post->ID, 'hide_underline_mobile', true);

  $page_header_use_overlay = get_post_meta($post->ID, 'page_header_use_overlay', true);
  $page_header_overlay_color = get_post_meta($post->ID, 'page_header_overlay_color', true) ?  get_post_meta($post->ID, 'page_header_overlay_color', true) : '#000000';
  $page_header_overlay_opacity = get_post_meta($post->ID, 'page_header_overlay_opacity', true) ?  get_post_meta($post->ID, 'page_header_overlay_opacity', true) : '0.3';

  $page_hide_logo = get_post_meta($post->ID, 'page_hide_logo', true);
  $hide_page_header = get_post_meta($post->ID, 'hide_page_header', true);
  $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true);
  $page_hide_sidemenu = get_post_meta($post->ID, 'page_hide_sidemenu', true);

  $page_hide_search = get_post_meta($post->ID, 'page_hide_search', true);
  $page_hide_bread = get_post_meta($post->ID, 'page_hide_bread', true);

  $change_content_width = get_post_meta($post->ID, 'change_content_width', true);
  $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '800';

  $page_header_type = get_post_meta($post->ID, 'page_header_type', true) ?  get_post_meta($post->ID, 'page_header_type', true) : 'type1';
  $page_header_height = get_post_meta($post->ID, 'page_header_height', true) ?  get_post_meta($post->ID, 'page_header_height', true) : 'type1';

  $page_content_font_size = get_post_meta($post->ID, 'page_content_font_size', true) ?  get_post_meta($post->ID, 'page_content_font_size', true) : '16';
  $page_content_font_size_mobile = get_post_meta($post->ID, 'page_content_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_content_font_size_mobile', true) : '14';
  
  $page_hide_header_message = get_post_meta($post->ID, 'page_hide_header_message', true);
  if(empty($page_hide_header_message)){
    $page_hide_header_message = 'hide';
  }

  echo '<input type="hidden" name="page_header_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<?php
     // WP5.0対策として隠しフィールドを用意　選択されているページテンプレートによってLPページ用入力欄を表示・非表示する
     if ( count( get_page_templates( $post ) ) > 0 && get_option( 'page_for_posts' ) != $post->ID ) :
       $template = ! empty( $post->page_template ) ? $post->page_template : false;
?>
<select name="hidden_page_template" id="hidden_page_template" style="display:none;">
 <option value="default">Default Template</option>
 <?php page_template_dropdown( $template, 'page' ); ?>
</select>
<?php endif; ?>

<div class="tcd_custom_field_wrap">

  <?php // 基本設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac" id="page_cf_basic_settings">
   <h3 class="theme_option_headline"><?php _e( 'Basic setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">
    
   <p class="hidden"><input name="page_hide_header_message" type="hidden" value="show"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
     <p><?php _e('Please use the option below if you want to make this page like Landing page.', 'tcd-w'); ?></p>
    </div>
    <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Hide header message', 'tcd-w'); ?></span><input name="page_hide_header_message" type="checkbox" value="hide" <?php checked( $page_hide_header_message, 'hide' ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide logo', 'tcd-w'); ?></span><input name="page_hide_logo" type="checkbox" value="1" <?php checked( $page_hide_logo, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide breadcrumb link', 'tcd-w'); ?></span><input name="page_hide_bread" type="checkbox" value="1" <?php checked( $page_hide_bread, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide search form on header', 'tcd-w'); ?></span><input name="page_hide_search" type="checkbox" value="1" <?php checked( $page_hide_search, 1 ); ?>></li>
     <li class="cf" id="hide_page_header"><span class="label"><?php _e('Hide page header', 'tcd-w'); ?></span><input name="hide_page_header" type="checkbox" value="1" <?php checked( $hide_page_header, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide header side menu', 'tcd-w'); ?></span><input name="page_hide_sidemenu" type="checkbox" value="1" <?php checked( $page_hide_sidemenu, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide footer', 'tcd-w'); ?></span><input name="page_hide_footer" type="checkbox" value="1" <?php checked( $page_hide_footer, 1 ); ?>></li>
     <li id="hide_content_width" class="cf"><span class="label"><?php _e('Change content width', 'tcd-w'); ?></span><input  data-option-name="change_content_width" name="change_content_width" type="checkbox" value="1" <?php checked( $change_content_width, 1 ); ?>></li>
    </ul>

    <div id="page_width_setting_area">
     <h4 class="theme_option_headline2"><?php _e( 'Content width', 'tcd-w' ); ?></h4>
     <p><input class="hankaku page_content_width_input" style="width:100px;" type="number" name="page_content_width" value="<?php echo esc_attr($page_content_width); ?>" /><span>px</span></p>
    </div>
    <div id="hide_other-setting">
    <h4 class="theme_option_headline2"><?php _e( 'Other setting', 'tcd-w' ); ?></h4>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font size of content', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_content_font_size" value="<?php esc_attr_e( $page_content_font_size ); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font size of content (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_content_font_size_mobile" value="<?php esc_attr_e( $page_content_font_size_mobile ); ?>" /><span>px</span></li>
    </ul>
    </div>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

  <?php // ページヘッダーの設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac" id="page_header_setting_area">
   <h3 class="theme_option_headline"><?php _e( 'Header setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h4 class="theme_option_headline2"><?php _e('Header type', 'tcd-w');  ?></h4>
    <ul class="design_radio_button">
     <li id="page_header_type1_button">
      <input type="radio" id="page_header_type1" name="page_header_type" value="type1" <?php checked( $page_header_type, 'type1' ); ?> />
      <label for="page_header_type1"><?php _e('Display background image', 'tcd-w');  ?></label>
     </li>
     <li id="page_header_type2_button">
      <input type="radio" id="page_header_type2" name="page_header_type" value="type2" <?php checked( $page_header_type, 'type2' ); ?> />
      <label for="page_header_type2"><?php _e('Don\'t display background image', 'tcd-w');  ?></label>
     </li>
    </ul>

    <div class="page_header_type1_option">

     <h4 class="theme_option_headline2"><?php _e('Header height', 'tcd-w');  ?></h4>
     <ul class="design_radio_button">
      <li id="page_header_height1_button">
       <input type="radio" id="page_header_height1" name="page_header_height" value="type1" <?php checked( $page_header_height, 'type1' ); ?> />
       <label for="page_header_height1"><?php _e('Normal height', 'tcd-w');  ?></label>
      </li>
      <li id="page_header_height2_button">
       <input type="radio" id="page_header_height2" name="page_header_height" value="type2" <?php checked( $page_header_height, 'type2' ); ?> />
       <label for="page_header_height2"><?php _e('Full screen height', 'tcd-w');  ?></label>
      </li>
     </ul>

    </div><!-- END .page_header_type1_option -->

    <h3 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w'); ?></h3>
    <div class="theme_option_message2">
     <p class="font_size_setting_option1"><?php _e('You can set font type from basic setting menu font setting option section.', 'tcd-w');  ?></p>
     <p class="font_size_setting_option2"><?php _e('You can set font type and font size from basic setting menu font setting option section.', 'tcd-w');  ?></p>
    </div>
    <textarea class="full_width" cols="50" rows="3" name="page_header_catch"><?php echo esc_textarea(  $page_header_catch ); ?></textarea>
    <p class="hidden"><input name="page_header_catch_color_use_main" type="hidden" value="hide"></p>
    <ul class="option_list">
     <li class="cf font_size_setting_option1"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_catch_font_size" value="<?php esc_attr_e( $page_header_catch_font_size ); ?>" /><span>px</span></li>
     <li class="cf font_size_setting_option1"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_catch_font_size_mobile" value="<?php esc_attr_e( $page_header_catch_font_size_mobile ); ?>" /><span>px</span></li>
     <li class="cf">
      <span class="label"><?php _e('Color of underline', 'tcd-w'); ?></span>
      <div class="use_main_color">
       <input type="text" name="page_header_catch_border_color" value="<?php echo esc_attr( $page_header_catch_border_color ); ?>" data-default-color="#d9d900" class="c-color-picker">
      </div>
      <div class="use_main_color_checkbox">
       <label>
        <input name="page_header_catch_color_use_main" type="checkbox" value="1" <?php checked( $page_header_catch_color_use_main, 1 ); ?>>
        <span><?php _e('Apply accent color', 'tcd-w'); ?></span>
       </label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Don\'t display underline', 'tcd-w'); ?></span><input name="hide_underline" type="checkbox" value="1" <?php checked( $hide_underline, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Don\'t display underline (mobile)', 'tcd-w'); ?></span><input name="hide_underline_mobile" type="checkbox" value="1" <?php checked( $hide_underline_mobile, 1 ); ?>></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Catchphrase (mobile)', 'tcd-w'); ?></h3>
    <div class="theme_option_message2">
     <p><?php _e('Please use this option if you want to display different catchphrase in mobile size.', 'tcd-w');  ?></p>
    </div>
    <textarea class="full_width" cols="50" rows="3" name="page_header_catch_mobile"><?php echo esc_textarea(  $page_header_catch_mobile ); ?></textarea>

    <h3 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h3>
    <textarea class="full_width" cols="50" rows="3" name="page_header_desc"><?php echo esc_textarea(  $page_header_desc ); ?></textarea>
    <ul class="option_list font_size_setting_option1">
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_desc_font_size" value="<?php esc_attr_e( $page_header_desc_font_size ); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_desc_font_size_mobile" value="<?php esc_attr_e( $page_header_desc_font_size_mobile ); ?>" /><span>px</span></li>
    </ul>

    <div class="page_header_type1_option">

     <h3 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h3>
     <div class="theme_option_message2">
      <p class="page_header_height1_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '440'); ?></p>
      <p class="page_header_height2_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '1080'); ?></p>
     </div>
     <?php mlcf_media_form('page_header_bg_image', __('Background image', 'tcd-w')); ?>

     <h3 class="theme_option_headline2"><?php _e( 'Background image (mobile)', 'tcd-w' ); ?></h3>
     <div class="theme_option_message2">
      <p><?php echo __('Please use this option if you want to change background image in mobile device.', 'tcd-w'); ?></p>
      <p><?php printf(__('Recommended size assuming for retina display. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '300'); ?></p>
     </div>
     <?php mlcf_media_form('page_header_bg_image_mobile', __('Background image', 'tcd-w')); ?>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="page_header_use_overlay" type="checkbox" value="1" <?php checked( $page_header_use_overlay, 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($page_header_use_overlay == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="page_header_overlay_color" value="<?php echo esc_attr( $page_header_overlay_color ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" type="text" name="page_header_overlay_opacity" value="<?php echo esc_attr($page_header_overlay_opacity); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>
     </div>

    </div><!-- END .page_header_type1_option -->

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_page_header_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['page_header_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['page_header_custom_fields_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'page_header_catch','page_header_catch_mobile','page_header_catch_font_size','page_header_catch_font_size_mobile','page_header_desc','page_header_desc_font_size','page_header_desc_font_size_mobile','hide_underline','hide_underline_mobile',
    'page_header_bg_image','page_header_bg_image_mobile','page_header_use_overlay','page_header_overlay_color','page_header_overlay_opacity',
    'hide_page_header','page_hide_footer','change_content_width','page_content_width','page_header_height','page_hide_sidemenu',
    'hide_page_header','page_hide_footer','change_content_width','page_content_width','page_header_height',
    'page_hide_logo','page_header_type','page_hide_search','page_hide_bread','page_header_catch_border_color','page_header_catch_color_use_main',
    'page_content_font_size','page_content_font_size_mobile','page_hide_header_message'
  );
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

}
add_action('save_post', 'save_page_header_meta_box');



?>