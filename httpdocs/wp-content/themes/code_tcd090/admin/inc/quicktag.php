<?php
/*
 * クイックタグの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_quicktag_dp_default_options' );


//  Add label of quicktag tab
add_action( 'tcd_tab_labels', 'add_quicktag_tab_label' );


// Add HTML of quicktag tab
add_action( 'tcd_tab_panel', 'add_quicktag_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_quicktag_theme_options_validate' );


// タブの名前
function add_quicktag_tab_label( $tab_labels ) {
	$tab_labels['quicktag'] = __( 'Quick tag & TOC', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_quicktag_dp_default_options( $dp_default_options ) {

	$dp_default_options['use_quicktags'] = 1;
	$dp_default_options['qt_custom_button_type1'] = 'type1';
	$dp_default_options['qt_custom_button_size1'] = 'type2';
	$dp_default_options['qt_custom_button_font_color1'] = '#ffffff';
	$dp_default_options['qt_custom_button_bg_color1'] = '#535353';
	$dp_default_options['qt_custom_button_border_color1'] = '#535353';
	$dp_default_options['qt_custom_button_border_color_opacity1'] = '1';
	$dp_default_options['qt_custom_button_font_color_hover1'] = '#ffffff';
	$dp_default_options['qt_custom_button_bg_color_hover1'] = '#7d7d7d';
	$dp_default_options['qt_custom_button_border_color_hover1'] = '#7d7d7d';
	$dp_default_options['qt_custom_button_border_color_hover_opacity1'] = '1';
	$dp_default_options['qt_custom_button_animation_type1'] = 'type1';

	$dp_default_options['qt_custom_button_type2'] = 'type2';
	$dp_default_options['qt_custom_button_size2'] = 'type2';
	$dp_default_options['qt_custom_button_font_color2'] = '#ffffff';
	$dp_default_options['qt_custom_button_bg_color2'] = '#535353';
	$dp_default_options['qt_custom_button_border_color2'] = '#535353';
	$dp_default_options['qt_custom_button_border_color_opacity2'] = '1';
	$dp_default_options['qt_custom_button_font_color_hover2'] = '#ffffff';
	$dp_default_options['qt_custom_button_bg_color_hover2'] = '#7d7d7d';
	$dp_default_options['qt_custom_button_border_color_hover2'] = '#7d7d7d';
	$dp_default_options['qt_custom_button_border_color_hover_opacity2'] = '1';
	$dp_default_options['qt_custom_button_animation_type2'] = 'type1';

	$dp_default_options['qt_custom_button_type3'] = 'type2';
	$dp_default_options['qt_custom_button_size3'] = 'type2';
	$dp_default_options['qt_custom_button_font_color3'] = '#ffffff';
	$dp_default_options['qt_custom_button_bg_color3'] = '#535353';
	$dp_default_options['qt_custom_button_border_color3'] = '#535353';
	$dp_default_options['qt_custom_button_border_color_opacity3'] = '1';
	$dp_default_options['qt_custom_button_font_color_hover3'] = '#ffffff';
	$dp_default_options['qt_custom_button_bg_color_hover3'] = '#7d7d7d';
	$dp_default_options['qt_custom_button_border_color_hover3'] = '#7d7d7d';
	$dp_default_options['qt_custom_button_border_color_hover_opacity3'] = '1';
	$dp_default_options['qt_custom_button_animation_type3'] = 'type1';

	$dp_default_options['qt_custom_button_underline_color1'] = '#d9d900';
	$dp_default_options['qt_custom_button_underline_color2'] = '#d9d900';
	$dp_default_options['qt_custom_button_underline_color3'] = '#d9d900';

	$dp_default_options['qt_underline_color1'] = '#fff799';
	$dp_default_options['qt_underline_color2'] = '#99f9ff';
	$dp_default_options['qt_underline_color3'] = '#ff99b8';

	$dp_default_options['qt_speech_balloon_user_image1'] = '';
	$dp_default_options['qt_speech_balloon_user_name1'] = '';
	$dp_default_options['qt_speech_balloon_font_color1'] = '#000000';
	$dp_default_options['qt_speech_balloon_bg_color1'] = '#ffdfdf';
	$dp_default_options['qt_speech_balloon_border_color1'] = '#ffdfdf';
	$dp_default_options['qt_speech_balloon_user_image2'] = '';
	$dp_default_options['qt_speech_balloon_user_name2'] = '';
	$dp_default_options['qt_speech_balloon_font_color2'] = '#000000';
	$dp_default_options['qt_speech_balloon_bg_color2'] = '#ffffff';
	$dp_default_options['qt_speech_balloon_border_color2'] = '#ff5353';
	$dp_default_options['qt_speech_balloon_user_image3'] = '';
	$dp_default_options['qt_speech_balloon_user_name3'] = '';
	$dp_default_options['qt_speech_balloon_font_color3'] = '#000000';
	$dp_default_options['qt_speech_balloon_bg_color3'] = '#ccf4ff';
	$dp_default_options['qt_speech_balloon_border_color3'] = '#ccf4ff';
	$dp_default_options['qt_speech_balloon_user_image4'] = '';
	$dp_default_options['qt_speech_balloon_user_name4'] = '';
	$dp_default_options['qt_speech_balloon_font_color4'] = '#000000';
	$dp_default_options['qt_speech_balloon_bg_color4'] = '#ffffff';
	$dp_default_options['qt_speech_balloon_border_color4'] = '#0789b5';

	$dp_default_options['qt_h2_text_align'] = 'left';
	$dp_default_options['qt_h2_font_size'] = '26';
	$dp_default_options['qt_h2_font_size_mobile'] = '16';
	$dp_default_options['qt_h2_font_color'] = '#ffffff';
	$dp_default_options['show_qt_h2_bg_color'] = '1';
	$dp_default_options['qt_h2_bg_color'] = '#000000';
	$dp_default_options['qt_h2_border_top_width'] = '0';
	$dp_default_options['qt_h2_border_bottom_width'] = '0';
	$dp_default_options['qt_h2_border_left_width'] = '0';
	$dp_default_options['qt_h2_border_right_width'] = '0';
	$dp_default_options['qt_h2_border_top_color'] = '#dddddd';
	$dp_default_options['qt_h2_border_bottom_color'] = '#dddddd';
	$dp_default_options['qt_h2_border_left_color'] = '#dddddd';
	$dp_default_options['qt_h2_border_right_color'] = '#dddddd';
	$dp_default_options['qt_h2_padding_top'] = '15';
	$dp_default_options['qt_h2_padding_bottom'] = '15';
	$dp_default_options['qt_h2_padding_left'] = '15';
	$dp_default_options['qt_h2_padding_right'] = '15';
	$dp_default_options['qt_h2_margin_top'] = '0';
	$dp_default_options['qt_h2_margin_bottom'] = '30';

	$dp_default_options['qt_h3_text_align'] = 'left';
	$dp_default_options['qt_h3_font_size'] = '22';
	$dp_default_options['qt_h3_font_size_mobile'] = '16';
	$dp_default_options['qt_h3_font_color'] = '#000000';
	$dp_default_options['show_qt_h3_bg_color'] = '';
	$dp_default_options['qt_h3_bg_color'] = '#fafafa';
	$dp_default_options['qt_h3_border_top_width'] = '0';
	$dp_default_options['qt_h3_border_bottom_width'] = '0';
	$dp_default_options['qt_h3_border_left_width'] = '2';
	$dp_default_options['qt_h3_border_right_width'] = '0';
	$dp_default_options['qt_h3_border_top_color'] = '#dddddd';
	$dp_default_options['qt_h3_border_bottom_color'] = '#dddddd';
	$dp_default_options['qt_h3_border_left_color'] = '#000000';
	$dp_default_options['qt_h3_border_right_color'] = '#dddddd';
	$dp_default_options['qt_h3_padding_top'] = '6';
	$dp_default_options['qt_h3_padding_bottom'] = '6';
	$dp_default_options['qt_h3_padding_left'] = '16';
	$dp_default_options['qt_h3_padding_right'] = '0';
	$dp_default_options['qt_h3_margin_top'] = '0';
	$dp_default_options['qt_h3_margin_bottom'] = '30';

	$dp_default_options['qt_h4_text_align'] = 'left';
	$dp_default_options['qt_h4_font_size'] = '18';
	$dp_default_options['qt_h4_font_size_mobile'] = '15';
	$dp_default_options['qt_h4_font_color'] = '#000000';
	$dp_default_options['show_qt_h4_bg_color'] = '';
	$dp_default_options['qt_h4_bg_color'] = '#ffffff';
	$dp_default_options['qt_h4_border_top_width'] = '0';
	$dp_default_options['qt_h4_border_bottom_width'] = '1';
	$dp_default_options['qt_h4_border_left_width'] = '0';
	$dp_default_options['qt_h4_border_right_width'] = '0';
	$dp_default_options['qt_h4_border_top_color'] = '#dddddd';
	$dp_default_options['qt_h4_border_bottom_color'] = '#dddddd';
	$dp_default_options['qt_h4_border_left_color'] = '#dddddd';
	$dp_default_options['qt_h4_border_right_color'] = '#dddddd';
	$dp_default_options['qt_h4_padding_top'] = '3';
	$dp_default_options['qt_h4_padding_bottom'] = '3';
	$dp_default_options['qt_h4_padding_left'] = '20';
	$dp_default_options['qt_h4_padding_right'] = '0';
	$dp_default_options['qt_h4_margin_top'] = '0';
	$dp_default_options['qt_h4_margin_bottom'] = '30';

	$dp_default_options['qt_h5_text_align'] = 'left';
	$dp_default_options['qt_h5_font_size'] = '14';
	$dp_default_options['qt_h5_font_size_mobile'] = '13';
	$dp_default_options['qt_h5_font_color'] = '#000000';
	$dp_default_options['show_qt_h5_bg_color'] = '';
	$dp_default_options['qt_h5_bg_color'] = '#ffffff';
	$dp_default_options['qt_h5_border_top_width'] = '0';
	$dp_default_options['qt_h5_border_bottom_width'] = '1';
	$dp_default_options['qt_h5_border_left_width'] = '0';
	$dp_default_options['qt_h5_border_right_width'] = '0';
	$dp_default_options['qt_h5_border_top_color'] = '#dddddd';
	$dp_default_options['qt_h5_border_bottom_color'] = '#dddddd';
	$dp_default_options['qt_h5_border_left_color'] = '#dddddd';
	$dp_default_options['qt_h5_border_right_color'] = '#dddddd';
	$dp_default_options['qt_h5_padding_top'] = '3';
	$dp_default_options['qt_h5_padding_bottom'] = '3';
	$dp_default_options['qt_h5_padding_left'] = '24';
	$dp_default_options['qt_h5_padding_right'] = '0';
	$dp_default_options['qt_h5_margin_top'] = '0';
	$dp_default_options['qt_h5_margin_bottom'] = '30';

	$dp_default_options['qt_gmap_api_key'] = '';
	$dp_default_options['qt_gmap_marker_type'] = 'type1';
	$dp_default_options['qt_gmap_custom_marker_type'] = 'type1';
	$dp_default_options['qt_gmap_marker_text'] = '';
	$dp_default_options['qt_gmap_marker_color'] = '#ffffff';
	$dp_default_options['qt_gmap_marker_img'] = '';
	$dp_default_options['qt_gmap_marker_bg'] = '#000000';
	$dp_default_options['qt_access_saturation'] = '-100';

  // 目次
  $dp_default_options['toc_title'] = __( 'Table of Contents', 'tcd-w' );

  $dp_default_options['active_toc_post_type_post'] = 1;

  $dp_default_options['active_toc_heading_num'] = '2';
  $dp_default_options['active_toc_heading_type'] = '2-3';
  $dp_default_options['toc_title_color'] = '#d9d900';
  $dp_default_options['use_toc_scroll_animation'] = 1;
  $dp_default_options['use_toc_theme_style'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_quicktag_tab_panel( $options ) {

  global $dp_default_options, $qt_custom_button_type_options, $qt_custom_button_size_options, $text_align_options, $font_type_options, $gmap_marker_type_options, $gmap_custom_marker_type_options;

?>

<div id="tab-content-quicktag" class="tab-content">

   <div class="theme_option_field cf theme_option_field_ac open active">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <p><?php _e( 'If you don\'t want to use quicktags included in the theme, please uncheck the box below.', 'tcd-w' ); ?></p>
     <p><label><input name="dp_options[use_quicktags]" type="checkbox" value="1" <?php checked( 1, $options['use_quicktags'] ); ?>><?php _e( 'Use quicktags', 'tcd-w' ); ?></label></p>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 見出し --------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Headline setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'These settings will be reflected in the quick tag button on the edit screen.', 'tcd-w' ); ?></p>
     </div>
     <?php for ( $i = 2; $i <= 5; $i++ ) : ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php printf( __( 'H%d tag', 'tcd-w' ), $i ); ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Font setting', 'tcd-w' ); ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_font_size]" value="<?php esc_attr_e( $options['qt_h'. $i .'_font_size'] ); ?>" /><span>px</span></li>
        <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_font_size_mobile]" value="<?php esc_attr_e( $options['qt_h'. $i .'_font_size_mobile'] ); ?>" /><span>px</span></li>
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[qt_h<?php echo $i; ?>_font_color]" value="<?php echo esc_attr( $options['qt_h'.$i.'_font_color'] ); ?>" data-default-color="<?php if($i == 2){ echo '#ffffff'; } else { echo '#000000'; }; ?>" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Text align', 'tcd-w'); ?></span>
         <select name="dp_options[qt_h<?php echo $i; ?>_text_align]">
          <?php $text_align_options_num = 1; foreach ( $text_align_options as $option ) : if($text_align_options_num < 3){ ?>
          <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['qt_h'.$i.'_text_align'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
          <?php }; $text_align_options_num++; endforeach; ?>
         </select>
        </li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Background color setting', 'tcd-w' ); ?></h4>
       <p class="displayment_checkbox"><label><input name="dp_options[show_qt_h<?php echo $i; ?>_bg_color]" type="checkbox" value="1" <?php checked( $options['show_qt_h'.$i.'_bg_color'], 1 ); ?>><?php _e( 'Display background color', 'tcd-w' ); ?></label></p>
       <div style="<?php if($options['show_qt_h'.$i.'_bg_color'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
        <p><input type="text" name="dp_options[qt_h<?php echo $i; ?>_bg_color]" value="<?php echo esc_attr( $options['qt_h'.$i.'_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Border setting', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e( 'Please enter 0 if you don\'t want to display border.', 'tcd-w' ); ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Make the top Xpx thicker ', 'tcd-w'); ?></span><input style="float:left;" class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_border_top_width]" value="<?php esc_attr_e( $options['qt_h'.$i.'_border_top_width'] ); ?>" /><span style="float:left; margin-right:15px;">px</span><input type="text" name="dp_options[qt_h<?php echo $i; ?>_border_top_color]" value="<?php echo esc_attr( $options['qt_h'.$i.'_border_top_color'] ); ?>" data-default-color="#222222" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Make the bottom Xpx thicker ', 'tcd-w'); ?></span><input style="float:left;" class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_border_bottom_width]" value="<?php esc_attr_e( $options['qt_h'.$i.'_border_bottom_width'] ); ?>" /><span style="float:left; margin-right:15px;">px</span><input type="text" name="dp_options[qt_h<?php echo $i; ?>_border_bottom_color]" value="<?php echo esc_attr( $options['qt_h'.$i.'_border_bottom_color'] ); ?>" data-default-color="#222222" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Make the left Xpx thicker ', 'tcd-w'); ?></span><input style="float:left;" class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_border_left_width]" value="<?php esc_attr_e( $options['qt_h'.$i.'_border_left_width'] ); ?>" /><span style="float:left; margin-right:15px;">px</span><input type="text" name="dp_options[qt_h<?php echo $i; ?>_border_left_color]" value="<?php echo esc_attr( $options['qt_h'.$i.'_border_left_color'] ); ?>" data-default-color="#222222" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Make the right Xpx thicker ', 'tcd-w'); ?></span><input style="float:left;" class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_border_right_width]" value="<?php esc_attr_e( $options['qt_h'.$i.'_border_right_width'] ); ?>" /><span style="float:left; margin-right:15px;">px</span><input type="text" name="dp_options[qt_h<?php echo $i; ?>_border_right_color]" value="<?php echo esc_attr( $options['qt_h'.$i.'_border_right_color'] ); ?>" data-default-color="#222222" class="c-color-picker"></li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Space between border and text', 'tcd-w' ); ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Make the top Xpx wider', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_padding_top]" value="<?php esc_attr_e( $options['qt_h'.$i.'_padding_top'] ); ?>" /><span>px</span></li>
        <li class="cf"><span class="label"><?php _e('Make the bottom Xpx wider', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_padding_bottom]" value="<?php esc_attr_e( $options['qt_h'.$i.'_padding_bottom'] ); ?>" /><span>px</span></li>
        <li class="cf"><span class="label"><?php _e('Make the left Xpx wider', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_padding_left]" value="<?php esc_attr_e( $options['qt_h'.$i.'_padding_left'] ); ?>" /><span>px</span></li>
        <li class="cf"><span class="label"><?php _e('Make the right Xpx wider', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_padding_right]" value="<?php esc_attr_e( $options['qt_h'.$i.'_padding_right'] ); ?>" /><span>px</span></li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Outer space ', 'tcd-w' ); ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Spread Xpx on top', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_margin_top]" value="<?php esc_attr_e( $options['qt_h'.$i.'_margin_top'] ); ?>" /><span>px</span></li>
        <li class="cf"><span class="label"><?php _e('Spread Xpx on bottom', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[qt_h<?php echo $i; ?>_margin_bottom]" value="<?php esc_attr_e( $options['qt_h'.$i.'_margin_bottom'] ); ?>" /><span>px</span></li>
       </ul>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div>
     </div>
     <?php endfor; ?>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ボタン --------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Button setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'These settings will be reflected in the quick tag button on the edit screen.', 'tcd-w' ); ?></p>
      <p><?php _e( 'You can also change the size of each button directly from edit screen.', 'tcd-w' ); ?></p>
     </div>

     <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php printf( __( 'Button %d settings', 'tcd-w' ), $i ); ?></h3>
      <div class="sub_box_content">

       <h4 class="theme_option_headline2"><?php _e( 'Hover effect setting', 'tcd-w' ); ?></h4>
       <ul class="design_radio_button2 qtag_button_hover_option">
        <li class="button_hover_type1 <?php if($options['qt_custom_button_animation_type'.$i] == 'type1'){ echo 'active'; }; ?>">
         <label for="button<?php echo $i; ?>_hover_type1">
          <div class="button_image"><span><?php _e( 'BUTTON IMAGE', 'tcd-w' ); ?></span></div>
          <span class="title"><?php _e('No hover effect', 'tcd-w');  ?></span>
          <input type="radio" id="button<?php echo $i; ?>_hover_type1" name="dp_options[qt_custom_button_animation_type<?php echo $i; ?>]" value="type1" <?php checked( $options['qt_custom_button_animation_type'.$i], 'type1' ); ?> />
         </label>
        </li>
        <li class="button_hover_type2 <?php if($options['qt_custom_button_animation_type'.$i] == 'type2'){ echo 'active'; }; ?>">
         <label for="button<?php echo $i; ?>_hover_type2">
          <div class="button_image"><span><?php _e( 'BUTTON IMAGE', 'tcd-w' ); ?></span></div>
          <span class="title"><?php _e('Swipe animation', 'tcd-w');  ?></span>
          <input type="radio" id="button<?php echo $i; ?>_hover_type2" name="dp_options[qt_custom_button_animation_type<?php echo $i; ?>]" value="type2" <?php checked( $options['qt_custom_button_animation_type'.$i], 'type2' ); ?> />
         </label>
        </li>
        <li class="button_hover_type3 <?php if($options['qt_custom_button_animation_type'.$i] == 'type3'){ echo 'active'; }; ?>">
         <label for="button<?php echo $i; ?>_hover_type3">
          <div class="button_image"><span><?php _e( 'BUTTON IMAGE', 'tcd-w' ); ?></span></div>
          <span class="title"><?php _e('Diagonal swipe animation', 'tcd-w');  ?></span>
          <input type="radio" id="button<?php echo $i; ?>_hover_type3" name="dp_options[qt_custom_button_animation_type<?php echo $i; ?>]" value="type3" <?php checked( $options['qt_custom_button_animation_type'.$i], 'type3' ); ?> />
         </label>
        </li>
        <li class="button_hover_type4 <?php if($options['qt_custom_button_animation_type'.$i] == 'type4'){ echo 'active'; }; ?>">
         <label for="button<?php echo $i; ?>_hover_type4">
          <div class="button_image"><span><?php _e( 'BUTTON IMAGE', 'tcd-w' ); ?></span></div>
          <span class="title"><?php _e('Underline animation', 'tcd-w');  ?></span>
          <input type="radio" id="button<?php echo $i; ?>_hover_type4" name="dp_options[qt_custom_button_animation_type<?php echo $i; ?>]" value="type4" <?php checked( $options['qt_custom_button_animation_type'.$i], 'type4' ); ?> />
         </label>
        </li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-w' ); ?></h4>
       <ul class="option_list button_option_area">
        <li class="cf"><span class="label"><?php _e('Button type', 'tcd-w');  ?></span>
         <select name="dp_options[qt_custom_button_type<?php echo $i; ?>]">
          <?php foreach ( $qt_custom_button_type_options as $option ) : ?>
          <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['qt_custom_button_type' . $i] ); ?>><?php echo esc_html($option['label']); ?></option>
          <?php endforeach; ?>
         </select>
        </li>
        <li class="cf"><span class="label"><?php _e('Button size', 'tcd-w');  ?></span>
         <select name="dp_options[qt_custom_button_size<?php echo $i; ?>]">
          <?php foreach ( $qt_custom_button_size_options as $option ) : ?>
          <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['qt_custom_button_size' . $i] ); ?>><?php echo esc_html($option['label']); ?></option>
          <?php endforeach; ?>
         </select>
        </li>
        <li class="cf short hide_for_button_type4"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[qt_custom_button_font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_custom_button_font_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_custom_button_font_color' . $i] ); ?>" class="c-color-picker"></li>
        <li class="cf short hide_bg_color"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[qt_custom_button_bg_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_custom_button_bg_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_custom_button_bg_color' . $i] ); ?>" class="c-color-picker"></li>
        <li class="cf short hide_for_button_type4"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[qt_custom_button_border_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_custom_button_border_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_custom_button_border_color' . $i] ); ?>" class="c-color-picker"></li>
        <li class="cf short hide_for_button_type4">
         <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[qt_custom_button_border_color_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_custom_button_border_color_opacity'.$i] ); ?>" />
         <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
          <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
         </div>
        </li>
        <li class="cf short hide_for_button_type4"><span class="label"><?php _e('Font color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[qt_custom_button_font_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_custom_button_font_color_hover' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_custom_button_font_color_hover' . $i] ); ?>" class="c-color-picker"></li>
        <li class="cf short hide_for_button_type4"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[qt_custom_button_bg_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_custom_button_bg_color_hover' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_custom_button_bg_color_hover' . $i] ); ?>" class="c-color-picker"></li>
        <li class="cf short hide_for_button_type4"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[qt_custom_button_border_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_custom_button_border_color_hover' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_custom_button_border_color_hover' . $i] ); ?>" class="c-color-picker"></li>
        <li class="cf short hide_for_button_type4">
         <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[qt_custom_button_border_color_hover_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_custom_button_border_color_hover_opacity'.$i] ); ?>" />
         <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
          <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
         </div>
        </li>
        <li class="cf show_for_button_type4">
         <span class="label"><?php _e('Color of underline', 'tcd-w'); ?></span>
         <input type="text" name="dp_options[qt_custom_button_underline_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_custom_button_underline_color'.$i] ); ?>" data-default-color="#d9d900" class="c-color-picker">
        </li>
       </ul>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div>
     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 下線 --------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Underline setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'These settings will be reflected in the quick tag button on the edit screen.', 'tcd-w' ); ?></p>
      <p><?php _e( 'You can also change the color of each underline directly from edit screen.', 'tcd-w' ); ?></p>
     </div>
     <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php printf( __( 'Underline %d setting', 'tcd-w' ), $i ); ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Color setting', 'tcd-w' ); ?></h4>
       <input class="c-color-picker" name="dp_options[qt_underline_color<?php echo $i; ?>]" type="text" value="<?php echo esc_attr( $options['qt_underline_color'.$i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_underline_color'.$i] ); ?>">
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div>
     </div>
     <?php endfor; ?>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 吹き出し --------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Speech balloon setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'These settings will be reflected in the quick tag button on the edit screen.', 'tcd-w' ); ?></p>
      <p><?php _e( 'You can also change the user image and name directly from short code generated on the edit screen.', 'tcd-w' ); ?></p>
     </div>
     <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline">
       <?php
            if ( 1 === $i ) printf( __( '%s settings', 'tcd-w' ), __( 'Speech balloon left 1', 'tcd-w' ) );
            elseif ( 2 === $i ) printf( __( '%s settings', 'tcd-w' ), __( 'Speech balloon left 2', 'tcd-w' ) );
            elseif ( 3 === $i ) printf( __( '%s settings', 'tcd-w' ), __( 'Speech balloon right 1', 'tcd-w' ) );
            elseif ( 4 === $i ) printf( __( '%s settings', 'tcd-w' ), __( 'Speech balloon right 2', 'tcd-w' ) );
       ?>
      </h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'User image', 'tcd-w' ); ?></h4>
       <p><?php printf( __( 'Recommend image size. Width:%dpx, Height:%dpx', 'tcd-w' ), 80, 80 ); ?></p>
       <div class="image_box cf index_slider_image<?php echo $i; ?>">
        <div class="cf cf_media_field hide-if-no-js qt_speech_balloon_user_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['qt_speech_balloon_user_image'.$i] ); ?>" id="qt_speech_balloon_user_image<?php echo $i; ?>" name="dp_options[qt_speech_balloon_user_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['qt_speech_balloon_user_image'.$i]){ echo wp_get_attachment_image($options['qt_speech_balloon_user_image'.$i], 'full'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['qt_speech_balloon_user_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'User name', 'tcd-w' ); ?></h4>
       <input class="regular-text" name="dp_options[qt_speech_balloon_user_name<?php echo $i; ?>]" type="text" value="<?php echo esc_attr( $options['qt_speech_balloon_user_name' . $i] ); ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Color setting', 'tcd-w' ); ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[qt_speech_balloon_font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_speech_balloon_font_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_speech_balloon_font_color' . $i] ); ?>" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[qt_speech_balloon_bg_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_speech_balloon_bg_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_speech_balloon_bg_color' . $i] ); ?>" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[qt_speech_balloon_border_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['qt_speech_balloon_border_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_speech_balloon_border_color' . $i] ); ?>" class="c-color-picker"></li>
       </ul>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div>
     </div>
     <?php endfor; ?>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // Google Map ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'Google Maps settings', 'tcd-w' );  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e('You can set styles of marker in Google maps using this option.<br />You can also set the saturation of map.', 'tcd-w');  ?></p>
     </div>
     <h4 class="theme_option_headline2"><?php _e( 'API key', 'tcd-w' ); ?></h4>
     <input type="text" class="regular-text" name="dp_options[qt_gmap_api_key]" value="<?php echo esc_attr( $options['qt_gmap_api_key'] ); ?>">
     <h4 class="theme_option_headline2"><?php _e( 'Marker type', 'tcd-w' ); ?></h4>
     <ul class="design_radio_button image_radio_button cf">
      <?php foreach ( $gmap_marker_type_options as $option ) : ?>
      <li class="gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>">
       <input type="radio" id="qt_gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>" name="dp_options[qt_gmap_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['qt_gmap_marker_type'] ); ?>>
       <label for="qt_gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>">
        <span><?php echo esc_html( $option['label'] ); ?></span>
        <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="" title="" />
       </label>
      </li>
      <?php endforeach; ?>
     </ul>
     <div class="gmap_marker_type2_area" style="<?php if($options['qt_gmap_marker_type'] == 'type1'){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e( 'Custom marker type', 'tcd-w' ); ?></h4>
      <ul class="design_radio_button">
       <?php foreach ( $gmap_custom_marker_type_options as $option ) : ?>
       <li class="gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>">
        <input type="radio" id="qt_gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>" name="dp_options[qt_gmap_custom_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['qt_gmap_custom_marker_type'] ); ?>>
        <label for="qt_gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>"><?php echo esc_html_e( $option['label'] ); ?></label>
       </li>
       <?php endforeach; ?>
      </ul>
      <div class="gmap_custom_marker_type1_area" style="<?php if ( $options['qt_gmap_custom_marker_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Custom marker text', 'tcd-w' ); ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Text', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[qt_gmap_marker_text]" value="<?php echo esc_attr( $options['qt_gmap_marker_text'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="dp_options[qt_gmap_marker_color]" value="<?php echo esc_attr( $options['qt_gmap_marker_color'] ); ?>" data-default-color="#ffffff"></li>
       </ul>
      </div>
      <div class="gmap_custom_marker_type2_area" style="<?php if ( $options['qt_gmap_custom_marker_type'] == 'type1') { echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Custom marker image', 'tcd-w' ); ?></h4>
       <p><?php _e( 'Recommended size: width:60px, height:20px', 'tcd-w' ); ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js qt_gmap_marker_img">
         <input type="hidden" value="<?php echo esc_attr( $options['qt_gmap_marker_img'] ); ?>" id="qt_gmap_marker_img" name="dp_options[qt_gmap_marker_img]" class="cf_media_id">
         <div class="preview_field"><?php if ( $options['qt_gmap_marker_img'] ) { echo wp_get_attachment_image($options['qt_gmap_marker_img'], 'medium' ); } ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['qt_gmap_marker_img'] ) { echo 'hidden'; } ?>">
         </div>
        </div>
       </div>
      </div>
      <h4 class="theme_option_headline2"><?php _e( 'Background color of marker', 'tcd-w' ); ?></h4>
      <ul class="option_list">
       <li class="cf"><input type="text" class="c-color-picker" name="dp_options[qt_gmap_marker_bg]" data-default-color="#000000" value="<?php echo esc_attr( $options['qt_gmap_marker_bg'] ); ?>"></li>
      </ul>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Saturation of map', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Please set the saturation of the map. If you set it to -100 the output map is monochrome.', 'tcd-w' ); ?></p>
     </div>
     <p class="range-output"><?php _e( 'Current value: ', 'tcd-w' ); ?><span><?php echo esc_html( $options['qt_access_saturation'] ); ?></span></p>
     <input class="range" type="range" name="dp_options[qt_access_saturation]" value="<?php echo esc_attr($options['qt_access_saturation']); ?>" min="-100" max="100" step="10" />
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 目次 --------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Table of Contents setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
       <p><?php _e( 'The contents registered here will be applied to all pages displaying the table of contents and to the original <a href="./widgets.php">Table of Contents (tcd ver)</a> widget.', 'tcd-w' ); ?></br>
          <?php _e( 'The title of the table of contents can also be set individually from the editing screen of each article.', 'tcd-w' ); ?></p>
     </div>

       <ul class="option_list" style="display:none;">
          <li class="cf"><span class="label"><?php _e('Post', 'tcd-w');  ?></span><input name="dp_options[active_toc_post_type_post]" type="checkbox" value="1" <?php checked( '1', $options['active_toc_post_type_post'] ); ?> /></li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-w' ); ?></h4>
       <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Created when there are more than X number of headings.', 'tcd-w');  ?></span>
            <select name="dp_options[active_toc_heading_num]">
			        <?php for($i=2; $i<= 10; $i++): ?>
	            <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['active_toc_heading_num'], $i ); ?>><?php echo esc_html($i); ?></option>
              <?php endfor; ?>
            </select>
	        </li>
          <li class="cf"><span class="label"><?php _e('Target heading', 'tcd-w'); ?></span>
            <select class="index_tab_post_list_type" name="dp_options[active_toc_heading_type]">
              <option style="padding-right: 10px;" value="2" <?php selected( $options['active_toc_heading_type'], '2' ); ?>><?php _e('Only h2 tag', 'tcd-w'); ?></option>
              <option style="padding-right: 10px;" value="2-3" <?php selected( $options['active_toc_heading_type'], '2-3' ); ?>><?php _e('h2 to h3 tag', 'tcd-w'); ?></option>
              <option style="padding-right: 10px;" value="2-4" <?php selected( $options['active_toc_heading_type'], '2-4' ); ?>><?php _e('h2 to h4 tag', 'tcd-w'); ?></option>
              <option style="padding-right: 10px;" value="2-5" <?php selected( $options['active_toc_heading_type'], '2-5' ); ?>><?php _e('h2 to h5 tag', 'tcd-w'); ?></option>
            </select>
          </li>
          <li class="cf"><span class="label"><?php _e('Title of the table of contents', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[toc_title]" value="<?php echo esc_attr($options['toc_title']); ?>" /></li>
          <li class="cf"><span class="label"><?php _e('Color scheme of the table of contents', 'tcd-w'); ?></span><input type="text" name="dp_options[toc_title_color]" value="<?php echo esc_attr( $options['toc_title_color'] ); ?>" data-default-color="#d9d900" class="c-color-picker"></li>
          <li class="cf"><span class="label"><?php _e('Use smooth scrolling', 'tcd-w');  ?></span><input name="dp_options[use_toc_scroll_animation]" type="checkbox" value="1" <?php checked( '1', $options['use_toc_scroll_animation'] ); ?> /></li>
          <li class="cf"><span class="label"><?php _e('Don\'t use theme styles', 'tcd-w');  ?></span><input name="dp_options[use_toc_theme_style]" type="checkbox" value="1" <?php checked( '1', $options['use_toc_theme_style'] ); ?> /></li>
       </ul>


     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_quicktag_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_quicktag_theme_options_validate( $input ) {

  global $dp_default_options, $qt_custom_button_type_options, $qt_custom_button_size_options, $text_align_options, $font_type_options, $gmap_marker_type_options, $gmap_custom_marker_type_options;

  if ( ! isset( $input['use_quicktags'] ) )
    $input['use_quicktags'] = null;
    $input['use_quicktags'] = ( $input['use_quicktags'] == 1 ? 1 : 0 );

  for ( $i = 2; $i <= 5; $i++ ) {
    if ( ! isset( $value['qt_h'.$i.'_text_align'] ) )
      $value['qt_h'.$i.'_text_align'] = null;
    if ( ! array_key_exists( $value['qt_h'.$i.'_text_align'], $text_align_options ) )
      $value['qt_h'.$i.'_text_align'] = null;
    $input['qt_h'.$i.'_font_size'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_font_size'] );
    $input['qt_h'.$i.'_font_size_mobile'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_font_size_mobile'] );
    $input['qt_h'.$i.'_font_color'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_font_color'] );
    if ( ! isset( $input['show_qt_h'.$i.'_bg_color'] ) )
      $input['show_qt_h'.$i.'_bg_color'] = null;
      $input['show_qt_h'.$i.'_bg_color'] = ( $input['show_qt_h'.$i.'_bg_color'] == 1 ? 1 : 0 );
    $input['qt_h'.$i.'_bg_color'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_bg_color'] );
    $input['qt_h'.$i.'_border_top_width'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_border_top_width'] );
    $input['qt_h'.$i.'_border_bottom_width'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_border_bottom_width'] );
    $input['qt_h'.$i.'_border_left_width'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_border_left_width'] );
    $input['qt_h'.$i.'_border_right_width'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_border_right_width'] );
    $input['qt_h'.$i.'_border_top_color'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_border_top_color'] );
    $input['qt_h'.$i.'_border_bottom_color'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_border_bottom_color'] );
    $input['qt_h'.$i.'_border_left_color'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_border_left_color'] );
    $input['qt_h'.$i.'_border_right_color'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_border_right_color'] );
    $input['qt_h'.$i.'_padding_top'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_padding_top'] );
    $input['qt_h'.$i.'_padding_bottom'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_padding_bottom'] );
    $input['qt_h'.$i.'_padding_left'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_padding_left'] );
    $input['qt_h'.$i.'_padding_right'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_padding_right'] );
    $input['qt_h'.$i.'_margin_top'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_margin_top'] );
    $input['qt_h'.$i.'_margin_bottom'] = wp_filter_nohtml_kses( $input['qt_h'.$i.'_margin_bottom'] );
  };

  for ( $i = 1; $i <= 3; $i++ ) {
    $input['qt_custom_button_type'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_type'.$i] );
    $input['qt_custom_button_size'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_size'.$i] );
    $input['qt_custom_button_font_color'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_font_color'.$i] );
    $input['qt_custom_button_bg_color'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_bg_color'.$i] );
    $input['qt_custom_button_border_color'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_border_color'.$i] );
    $input['qt_custom_button_border_color_opacity'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_border_color_opacity'.$i] );
    $input['qt_custom_button_font_color_hover'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_font_color_hover'.$i] );
    $input['qt_custom_button_bg_color_hover'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_bg_color_hover'.$i] );
    $input['qt_custom_button_border_color_hover'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_border_color_hover'.$i] );
    $input['qt_custom_button_border_color_hover_opacity'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_border_color_hover_opacity'.$i] );
    $input['qt_custom_button_animation_type'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_animation_type'.$i] );
    $input['qt_custom_button_underline_color'.$i] = wp_filter_nohtml_kses( $input['qt_custom_button_underline_color'.$i] );
  }

  for ( $i = 1; $i <= 3; $i++ ) {
    $input['qt_underline_color'.$i] = wp_filter_nohtml_kses( $input['qt_underline_color'.$i] );
  }

  for ( $i = 1; $i <= 4; $i++ ) {
    $input['qt_speech_balloon_user_image'.$i] = wp_filter_nohtml_kses( $input['qt_speech_balloon_user_image'.$i] );
    $input['qt_speech_balloon_user_name'.$i] = wp_filter_nohtml_kses( $input['qt_speech_balloon_user_name'.$i] );
    $input['qt_speech_balloon_font_color'.$i] = wp_filter_nohtml_kses( $input['qt_speech_balloon_font_color'.$i] );
    $input['qt_speech_balloon_bg_color'.$i] = wp_filter_nohtml_kses( $input['qt_speech_balloon_bg_color'.$i] );
    $input['qt_speech_balloon_border_color'.$i] = wp_filter_nohtml_kses( $input['qt_speech_balloon_border_color'.$i] );
  }

  // Google Maps 
  $input['qt_gmap_api_key'] = wp_filter_nohtml_kses( $input['qt_gmap_api_key'] );
  if ( ! isset( $input['qt_gmap_marker_type'] ) ) $input['qt_gmap_marker_type'] = null;
  if ( ! array_key_exists( $input['qt_gmap_marker_type'], $gmap_marker_type_options ) ) $input['qt_gmap_marker_type'] = null;
  if ( ! isset( $input['qt_gmap_custom_marker_type'] ) ) $input['qt_gmap_custom_marker_type'] = null;
  if ( ! array_key_exists( $input['qt_gmap_custom_marker_type'], $gmap_custom_marker_type_options ) ) $input['qt_gmap_custom_marker_type'] = null;
  $input['qt_gmap_marker_text'] = wp_filter_nohtml_kses( $input['qt_gmap_marker_text'] );
  $input['qt_gmap_marker_color'] = wp_filter_nohtml_kses( $input['qt_gmap_marker_color'] );
  $input['qt_gmap_marker_img'] = wp_filter_nohtml_kses( $input['qt_gmap_marker_img'] );
  $input['qt_access_saturation'] = wp_filter_nohtml_kses( $input['qt_access_saturation'] );

  // 目次
  $input['toc_title'] = wp_filter_nohtml_kses( $input['toc_title'] );
  $input['toc_title_color'] = sanitize_hex_color( $input['toc_title_color'] );
  $input['active_toc_post_type_post'] = ! empty( $input['active_toc_post_type_post'] ) ? 1 : 0;

  $input['active_toc_heading_num'] = wp_filter_nohtml_kses( $input['active_toc_heading_num'] );
  $input['active_toc_heading_type'] = wp_filter_nohtml_kses( $input['active_toc_heading_type'] );
  $input['use_toc_scroll_animation'] = ! empty( $input['use_toc_scroll_animation'] ) ? 1 : 0;
  $input['use_toc_theme_style'] = ! empty( $input['use_toc_theme_style'] ) ? 1 : 0;

	return $input;

};


?>