<?php
/**
 * Manage acceleration tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_acceleration_dp_default_options' );

// Add label of acceleration tab
add_action( 'tcd_tab_labels', 'add_acceleration_tab_label' );

// Add HTML of acceleration tab
add_action( 'tcd_tab_panel', 'add_acceleration_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_acceleration_theme_options_validate' );

function add_acceleration_dp_default_options( $dp_default_options ) {
	$dp_default_options['use_emoji'] = 0;
	$dp_default_options['use_js_optimization'] = 0;
	$dp_default_options['use_css_optimization'] = 0;
	$dp_default_options['use_html_optimization'] = 0;

	// Facebook OGPの設定
	$dp_default_options['use_ogp'] = 0;
	$dp_default_options['fb_app_id'] = '';
	$dp_default_options['ogp_image'] = '';

	// X Cardsの設定
	$dp_default_options['twitter_account_name'] = '';

	return $dp_default_options;
}

function add_acceleration_tab_label( $tab_labels ) {
	$tab_labels['acceleration'] = __( 'SEO', 'tcd-w' );
	return $tab_labels;
}

function add_acceleration_tab_panel( $dp_options ) {
?>
<div id="tab-content-acceleration" class="tab-content">
<?php // Use OGP tag ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('OGP', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e('OGP is a mechanism for correctly conveying page information.', 'tcd-w'); ?></p>
     </div>    
     <p><label><input id="dp_options[use_ogp]" name="dp_options[use_ogp]" type="checkbox" value="1" <?php checked( '1', $dp_options['use_ogp'] ); ?> /> <?php _e('Use OGP', 'tcd-w');  ?></label></p>
     <h4 class="theme_option_headline2"><?php _e( 'OGP image', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'This image is displayed for OGP if the page does not have a thumbnail.', 'tcd-w' ); ?></p>
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1200', '630'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" value="<?php echo esc_attr( $dp_options['ogp_image'] ); ?>" id="ogp_image" name="dp_options[ogp_image]" class="cf_media_id">
       <div class="preview_field"><?php if ( $dp_options['ogp_image'] ) { echo wp_get_attachment_image( $dp_options['ogp_image'], 'medium'); } ?></div>
       <div class="button_area">
        <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['ogp_image'] ) { echo 'hidden'; } ?>">
       </div>
      </div>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Facebook OGP setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'In order to use Facebook Insights please set your app ID.', 'tcd-w' ); ?></p>
      <p><a href="https://tcd-theme.com/2018/01/facebook_app_id.html" target="_blank"><?php _e( 'Information about Facebook app ID.', 'tcd-w' ); ?></a></p>
     </div>
     <p><?php _e( 'Your app ID', 'tcd-w' );  ?> <input class="regular-text" type="text" name="dp_options[fb_app_id]" value="<?php esc_attr_e( $dp_options['fb_app_id'] ); ?>"></p>


   <?php // X card ----------------------------------------- ?>
    <h4 class="theme_option_headline2"><?php _e('X Cards setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('In order to use X cards please set your account name.', 'tcd-w'); ?></p>
     </div>    
     <p><?php _e( 'Your X account name (exclude @ mark)', 'tcd-w' ); ?><input id="dp_options[twitter_account_name]" class="regular-text" type="text" name="dp_options[twitter_account_name]" value="<?php esc_attr_e( $dp_options['twitter_account_name'] ); ?>"></p>
     <p><a href="https://tcd-theme.com/2016/11/twitter-cards.html" target="_blank"><?php _e( 'Information about X Cards.', 'tcd-w' ); ?></a></p>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

	<div class="theme_option_field cf theme_option_field_ac">
		<h3 class="theme_option_headline"><?php _e( 'Acceleration setting', 'tcd-w' ); ?></h3>
		<div class="theme_option_field_ac_content">
			<h4 class="theme_option_headline2"><?php _e( 'Emoji setting', 'tcd-w' ); ?></h4>
			<div class="theme_option_message2">
				<p><?php _e( "We recommend to checkoff this option if you dont use any Emoji in your post content.", 'tcd-w' ); ?></p>
			</div>
			<p><label><input name="dp_options[use_emoji]" type="checkbox" value="1" <?php checked( 1, $dp_options['use_emoji'] ); ?>><?php _e( 'Use emoji', 'tcd-w' ); ?></label></p>
			<h4 class="theme_option_headline2"><?php _e( 'Optimization setting', 'tcd-w' ); ?></h4>
			<div class="theme_option_message2">
				<p><?php _e( 'Check here to remove margins and line breaks in JavaScript.', 'tcd-w' ); ?></p>
			</div>
			<p><label><input name="dp_options[use_js_optimization]" type="checkbox" value="1" <?php checked( 1, $dp_options['use_js_optimization'] ); ?>> <?php _e( 'Use JavaScript optimization', 'tcd-w' ); ?></label></p>
			<div class="theme_option_message2">
				<p><?php _e( 'Check here to remove margins and line breaks in CSS.<br>It also improves the loading speed by generating a page common CSS cache file.<br>* This specification does not apply to external CSS (CDN, etc.).', 'tcd-w' ); ?></p>
			</div>
			<p><label><input name="dp_options[use_css_optimization]" type="checkbox" value="1" <?php checked( 1, $dp_options['use_css_optimization'] ); ?>> <?php _e( 'Use CSS optimization', 'tcd-w' ); ?></label></p>
			<div class="theme_option_message2">
				<p><?php _e( 'Check here to remove margins and line breaks in HTML.', 'tcd-w' ); ?></p>
			</div>
			<p><label><input name="dp_options[use_html_optimization]" type="checkbox" value="1" <?php checked( 1, $dp_options['use_html_optimization'] ); ?>> <?php _e( 'Use HTML optimization', 'tcd-w' ); ?></label></p>

			<ul class="button_list cf">
				<li><input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>"></li>
			</ul>
		</div>
	</div>
</div>
<?php
}

function add_acceleration_theme_options_validate( $input ) {
		
	// Facebook OGPの設定
	$input['use_ogp'] = ! empty( $input['use_ogp'] ) ? 1 : 0;
	$input['ogp_image'] = wp_filter_nohtml_kses( $input['ogp_image'] );
	$input['fb_app_id'] = wp_filter_nohtml_kses( $input['fb_app_id'] );

	// X Cardsの設定
	$input['twitter_account_name'] = wp_filter_nohtml_kses( $input['twitter_account_name'] );

	$input['use_emoji'] = ! empty( $input['use_emoji'] ) ? 1 : 0;
	$input['use_js_optimization'] = ! empty( $input['use_js_optimization'] ) ? 1 : 0;
	$input['use_css_optimization'] = ! empty( $input['use_css_optimization'] ) ? 1 : 0;
	$input['use_html_optimization'] = ! empty( $input['use_html_optimization'] ) ? 1 : 0;

	return $input;
}
