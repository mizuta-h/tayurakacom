<?php

// カテゴリー編集用入力欄を出力 -------------------------------------------------------
function edit_category_custom_fields( $term ) {
	$term_meta = get_option( 'taxonomy_' . $term->term_id, array() );
	$term_meta = array_merge( array(
		'color1' => '#b43936',
		'image' => null,
		'image_mobile' => null,
		'show_carousel' => '',
		'archive_carousel_headline' => 'PICKUP',
		'archive_carousel_post_type' => 'recommend_post',
		'archive_carousel_post_order' => 'rand',
		'use_overlay' => '',
		'use_grad_overlay' => 'type1',
		'overlay_color' => '#000000',
		'overlay_opacity' => '0.3',
		'desc_mobile' => '',
	), $term_meta );
?>
<tr class="form-field">
	<th colspan="2">

<div class="custom_category_meta">
 <h3 class="ccm_headline"><?php _e( 'Basic setting', 'tcd-w' ); ?></h3>

 <div class="ccm_content clearfix">
  <h4 class="headline"><?php _e( 'Category color setting', 'tcd-w' ); ?></h4>
  <ul class="option_list button_option_area">
   <li class="cf"><span class="label"><?php _e('Main color', 'tcd-w'); ?></span><input type="text" name="term_meta[color1]" value="<?php echo esc_attr( $term_meta['color1'] ); ?>" data-default-color="#b43936" class="c-color-picker"></li>
  </ul>
 </div><!-- END ccm_content -->

</div><!-- END .custom_category_meta -->

<div class="custom_category_meta">
 <h3 class="ccm_headline"><?php _e( 'Category page setting', 'tcd-w' ); ?></h3>

 <div class="ccm_content clearfix">
  <h4 class="headline"><?php _e( 'Description (mobile)', 'tcd-w' ); ?></h4>
  <div class="theme_option_message2">
   <p><?php _e('Please use this option if you want to display different description in mobile size.', 'tcd-w');  ?></p>
  </div>
  <textarea class="full_width" cols="50" rows="4" name="term_meta[desc_mobile]"><?php echo esc_textarea(  $term_meta['desc_mobile'] ); ?></textarea>
 </div><!-- END ccm_content -->

 <div class="ccm_content clearfix">
  <h4 class="headline"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
  <div class="theme_option_message2">
   <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '600'); ?></p>
  </div>
  <div class="input_field">
		<div class="image_box cf">
			<div class="cf cf_media_field hide-if-no-js image">
				<input type="hidden" value="<?php if ( $term_meta['image'] ) echo esc_attr( $term_meta['image'] ); ?>" id="image" name="term_meta[image]" class="cf_media_id">
				<div class="preview_field"><?php if ( $term_meta['image'] ) echo wp_get_attachment_image( $term_meta['image'], 'medium'); ?></div>
				<div class="button_area">
					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $term_meta['image'] ) echo 'hidden'; ?>">
				</div>
			</div>
		</div>
  </div><!-- END input_field -->
 </div><!-- END ccm_content -->

 <div class="ccm_content clearfix">
  <h4 class="headline"><?php _e( 'Background image (mobile)', 'tcd-w' ); ?></h4>
  <div class="theme_option_message2">
   <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '600'); ?></p>
  </div>
  <div class="input_field">
		<div class="image_box cf">
			<div class="cf cf_media_field hide-if-no-js image_mobile">
				<input type="hidden" value="<?php if ( $term_meta['image_mobile'] ) echo esc_attr( $term_meta['image_mobile'] ); ?>" id="image_mobile" name="term_meta[image_mobile]" class="cf_media_id">
				<div class="preview_field"><?php if ( $term_meta['image_mobile'] ) echo wp_get_attachment_image( $term_meta['image_mobile'], 'medium'); ?></div>
				<div class="button_area">
					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $term_meta['image_mobile'] ) echo 'hidden'; ?>">
				</div>
			</div>
		</div>
  </div><!-- END input_field -->
 </div><!-- END ccm_content -->

 <div class="ccm_content clearfix">
  <h4 class="headline"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
  <div class="input_field">

   <?php if (!$term_meta['image']){ ?>
   <div class="theme_option_message2">
    <p><?php echo __('Please register image and save the data before you use this option.', 'tcd-w'); ?></p>
   </div>
   <div style="display:none;">
   <?php }; ?>

   <p class="displayment_checkbox"><label><input name="term_meta[use_overlay]" type="checkbox" value="1" <?php checked( $term_meta['use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
   <div style="<?php if($term_meta['use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="term_meta[overlay_color]" value="<?php echo esc_attr( $term_meta['overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="term_meta[overlay_opacity]" value="<?php echo esc_attr( $term_meta['overlay_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
    </ul>
   </div>

   <?php if (!$term_meta['image']){ ?>
   </div>
   <?php }; ?>

  </div><!-- END input_field -->
 </div><!-- END ccm_content -->

 <div class="ccm_content clearfix">
  <h4 class="headline"><?php _e( 'Header carousel setting', 'tcd-w' ); ?></h4>
  <div class="input_field">
   <p class="displayment_checkbox"><label><input name="term_meta[show_carousel]" type="checkbox" value="1" <?php checked( $term_meta['show_carousel'], 1 ); ?>><?php _e( 'Display carousel', 'tcd-w' ); ?></label></p>
   <div style="<?php if($term_meta['show_carousel'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <p class="hidden"><input name="term_meta[archive_carousel_show_date]" type="hidden" value="hide"></p>
    <p class="hidden"><input name="term_meta[archive_carousel_show_author]" type="hidden" value="hide"></p>
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="term_meta[archive_carousel_headline]" value="<?php echo esc_attr($term_meta['archive_carousel_headline']); ?>"></li>
     <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
      <select name="term_meta[archive_carousel_post_type]">
       <option style="padding-right: 10px;" value="recommend_post" <?php selected( $term_meta['archive_carousel_post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="featured_post" <?php selected( $term_meta['archive_carousel_post_type'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="pickup_post" <?php selected( $term_meta['archive_carousel_post_type'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w');  ?></option>
      </select>
     </li>
     <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
      <select name="term_meta[archive_carousel_post_order]">
       <option style="padding-right: 10px;" value="date" <?php selected( $term_meta['archive_carousel_post_order'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="rand" <?php selected( $term_meta['archive_carousel_post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
      </select>
     </li>
    </ul>
   </div>
  </div><!-- END input_field -->
 </div><!-- END ccm_content -->

</div><!-- END .custom_category_meta -->

 </th>
</tr><!-- END .form-field -->
<?php
}
add_action( 'category_edit_form_fields', 'edit_category_custom_fields' );



// データを保存 -------------------------------------------------------
function save_category_custom_fields( $term_id ) {
  $new_meta = array();
  if ( isset( $_POST['term_meta'] ) ) {
		$current_term_id = $term_id;
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$new_meta[$key] = $_POST['term_meta'][$key];
			}
		}
	}
  update_option( "taxonomy_$current_term_id", $new_meta );
}
add_action( 'edited_category', 'save_category_custom_fields' );




?>