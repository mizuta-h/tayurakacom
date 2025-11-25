<?php
/*
 * 404設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_404_dp_default_options' );


// Add label of basic tab
add_action( 'tcd_tab_labels', 'add_404_tab_label' );


// Add HTML of basic tab
add_action( 'tcd_tab_panel', 'add_404_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_404_theme_options_validate' );


// タブの名前
function add_404_tab_label( $tab_labels ) {
	$tab_labels['404'] = __( '404 / Search result page', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_404_dp_default_options( $dp_default_options ) {

	// 404 ページ
	$dp_default_options['page_404_bg_image'] = false;
	$dp_default_options['page_404_catch'] = '404 NOT FOUND';
	$dp_default_options['page_404_desc'] = __( 'The page you are looking for are not found', 'tcd-w' );
	$dp_default_options['page_404_use_overlay'] = '1';
	$dp_default_options['page_404_overlay_color'] = '#000000';
	$dp_default_options['page_404_overlay_opacity'] = '0.5';
  
  	// search ページ
	$dp_default_options['page_search_bg_image'] = false;
	$dp_default_options['page_search_catch'] = 'SEARCH NOT FOUND';
	$dp_default_options['page_search_placeholder'] = __('Please enter search keyword.', 'tcd-w');
	$dp_default_options['page_search_use_overlay'] = '1';
	$dp_default_options['page_search_overlay_color'] = '#000000';
	$dp_default_options['page_search_overlay_opacity'] = '0.5';
    // Basicから移動
	$dp_default_options['search_type_page'] = '';
	$dp_default_options['search_result_no_post_label'] = __( 'There is no registered post.', 'tcd-w' );
  
	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_404_tab_panel( $options ) {

  global $dp_default_options;

?>

<div id="tab-content-basic" class="tab-content">


   <?php // 404 ページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac open active">
    <h3 class="theme_option_headline"><?php _e( 'Settings for 404 page', 'tcd-w' ); ?></h3>
    <div class="theme_option_field_ac_content">
    <p><?php printf(__('You can check 404 page form <a href="%s" target="_blank">this page</a>.', 'tcd-w'), esc_url(home_url('check404notfoundpage')) );  ?></p>
     <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
     <textarea class="full_width" cols="50" rows="2" name="dp_options[page_404_catch]"><?php echo esc_textarea( $options['page_404_catch'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
     <textarea class="full_width" cols="50" rows="2" name="dp_options[page_404_desc]"><?php echo esc_textarea( $options['page_404_desc'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
     <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '650'); ?></p>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js page_404_bg_image">
       <input type="hidden" value="<?php echo esc_attr( $options['page_404_bg_image'] ); ?>" id="page_404_bg_image" name="dp_options[page_404_bg_image]" class="cf_media_id">
       <div class="preview_field"><?php if ( $options['page_404_bg_image'] ) { echo wp_get_attachment_image( $options['page_404_bg_image'], 'medium' ); } ?></div>
       <div class="button_area">
        <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['page_404_bg_image'] ) { echo 'hidden'; } ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Overlay setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[page_404_use_overlay]" type="checkbox" value="1" <?php checked( $options['page_404_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['page_404_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[page_404_overlay_color]" value="<?php echo esc_attr( $options['page_404_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[page_404_overlay_opacity]" value="<?php echo esc_attr( $options['page_404_overlay_opacity'] ); ?>" />
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
   
   <?php // search ページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac open active">
    <h3 class="theme_option_headline"><?php _e( 'Settings for search page', 'tcd-w' ); ?></h3>
    <div class="theme_option_field_ac_content">
    <p><?php printf(__('You can check search result page form <a href="%s" target="_blank">this page</a>.', 'tcd-w'), esc_url(home_url('?s=checksearchresultpage')) );  ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'Search form setting', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
      <p><?php _e('This setting will be applied to all search forms, including the search widget. ', 'tcd-w');  ?></p>
     </div>
    <ul class="option_list">
      <li class="cf"><span class="label"><?php printf(__('Include %s in search range', 'tcd-w'), __('pages', 'tcd-w') ); ?></span><input name="dp_options[search_type_page]" type="checkbox" value="1" <?php checked( '1', $options['search_type_page'] ); ?> /></li>
     </ul>
     
     <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
     <textarea class="full_width" cols="50" rows="2" name="dp_options[page_search_catch]"><?php echo esc_textarea( $options['page_search_catch'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
     <textarea class="full_width" cols="50" rows="2" name="dp_options[search_result_no_post_label]"><?php echo esc_attr($options['search_result_no_post_label']); ?></textarea>
     
     <h4 class="theme_option_headline2"><?php _e( 'Wording to be displayed on search form', 'tcd-w' ); ?></h4>
     <input type="text" class="full_width" name="dp_options[page_search_placeholder]" value="<?php echo esc_textarea( $options['page_search_placeholder'] ); ?>">

     <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
     <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '650'); ?></p>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js page_search_bg_image">
       <input type="hidden" value="<?php echo esc_attr( $options['page_search_bg_image'] ); ?>" id="page_search_bg_image" name="dp_options[page_search_bg_image]" class="cf_media_id">
       <div class="preview_field"><?php if ( $options['page_search_bg_image'] ) { echo wp_get_attachment_image( $options['page_search_bg_image'], 'medium' ); } ?></div>
       <div class="button_area">
        <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['page_search_bg_image'] ) { echo 'hidden'; } ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Overlay setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[page_search_use_overlay]" type="checkbox" value="1" <?php checked( $options['page_search_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['page_search_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[page_search_overlay_color]" value="<?php echo esc_attr( $options['page_search_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[page_search_overlay_opacity]" value="<?php echo esc_attr( $options['page_search_overlay_opacity'] ); ?>" />
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


</div><!-- END .tab-content -->

<?php
} // END add_basic_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_404_theme_options_validate( $input ) {

  global $dp_default_options;


  // 404 ページ
  $input['page_404_catch'] = wp_filter_nohtml_kses( $input['page_404_catch'] );
  $input['page_404_desc'] = wp_filter_nohtml_kses( $input['page_404_desc'] );

  $input['page_404_bg_image'] = wp_filter_nohtml_kses( $input['page_404_bg_image'] );

  $input['page_404_use_overlay'] = ! empty( $input['page_404_use_overlay'] ) ? 1 : 0;
  $input['page_404_overlay_color'] = wp_filter_nohtml_kses( $input['page_404_overlay_color'] );
  $input['page_404_overlay_opacity'] = wp_filter_nohtml_kses( $input['page_404_overlay_opacity'] );
  
    // search ページ
    $input['page_search_catch'] = wp_filter_nohtml_kses( $input['page_search_catch'] );
    $input['page_search_placeholder'] = wp_filter_nohtml_kses( $input['page_search_placeholder'] );
  
    $input['page_search_bg_image'] = wp_filter_nohtml_kses( $input['page_search_bg_image'] );
  
    $input['page_search_use_overlay'] = ! empty( $input['page_search_use_overlay'] ) ? 1 : 0;
    $input['page_search_overlay_color'] = wp_filter_nohtml_kses( $input['page_search_overlay_color'] );
    $input['page_search_overlay_opacity'] = wp_filter_nohtml_kses( $input['page_search_overlay_opacity'] );

  return $input;

};


?>