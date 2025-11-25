<?php

function ranking_list_meta_box() {
  add_meta_box(
    'ranking_list_meta_box',//ID of meta box
    __('Ranking list page setting', 'tcd-w'),//label
    'show_ranking_list_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'ranking_list_meta_box');

function show_ranking_list_meta_box() {
  global $post;

  $ranking_title_font_size = get_post_meta($post->ID, 'ranking_title_font_size', true) ?  get_post_meta($post->ID, 'ranking_title_font_size', true) : '18';
  $ranking_title_font_size_mobile = get_post_meta($post->ID, 'ranking_title_font_size_mobile', true) ?  get_post_meta($post->ID, 'ranking_title_font_size_mobile', true) : '16';

  if(empty(get_post_meta($post->ID, 'show_ranking_num', true))){
    $show_ranking_num = '1';
  } else {
    $show_ranking_num = get_post_meta($post->ID, 'show_ranking_num', true);
  }

  if(empty(get_post_meta($post->ID, 'show_ranking_category', true))){
    $show_ranking_category = '1';
  } else {
    $show_ranking_category = get_post_meta($post->ID, 'show_ranking_category', true);
  }

  if(empty(get_post_meta($post->ID, 'show_ranking_date', true))){
    $show_ranking_date = '1';
  } else {
    $show_ranking_date = get_post_meta($post->ID, 'show_ranking_date', true);
  }

  if(empty(get_post_meta($post->ID, 'show_ranking_author', true))){
    $show_ranking_author = '1';
  } else {
    $show_ranking_author = get_post_meta($post->ID, 'show_ranking_author', true);
  }

  if(empty(get_post_meta($post->ID, 'show_ranking_view', true))){
    $show_ranking_view = '1';
  } else {
    $show_ranking_view = get_post_meta($post->ID, 'show_ranking_view', true);
  }

  echo '<input type="hidden" name="ranking_list_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap">

 <div class="theme_option_field cf theme_option_field_ac">
  <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w'); ?></h3>
  <div class="theme_option_field_ac_content">
   <h3 class="theme_option_headline2"><?php _e('Ranking list common setting', 'tcd-w'); ?></h3>
   <p class="hidden"><input name="show_ranking_num" type="hidden" value="hide"></p>
   <p class="hidden"><input name="show_ranking_category" type="hidden" value="hide"></p>
   <p class="hidden"><input name="show_ranking_date" type="hidden" value="hide"></p>
   <p class="hidden"><input name="show_ranking_author" type="hidden" value="hide"></p>
   <p class="hidden"><input name="show_ranking_view" type="hidden" value="hide"></p>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_title_font_size" value="<?php esc_attr_e( $ranking_title_font_size ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_title_font_size_mobile" value="<?php esc_attr_e( $ranking_title_font_size_mobile ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Display rank number', 'tcd-w'); ?></span><input name="show_ranking_num" type="checkbox" value="1" <?php checked( $show_ranking_num, 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="show_ranking_category" type="checkbox" value="1" <?php checked( $show_ranking_category, 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="show_ranking_date" type="checkbox" value="1" <?php checked( $show_ranking_date, 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="show_ranking_author" type="checkbox" value="1" <?php checked( $show_ranking_author, 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Display post view number', 'tcd-w'); ?></span><input name="show_ranking_view" type="checkbox" value="1" <?php checked( $show_ranking_view, 1 ); ?>></li>
   </ul>
   <ul class="button_list cf">
    <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .theme_option_field_ac_content -->
 </div><!-- END .theme_option_field -->

 <div class="theme_option_field cf theme_option_field_ac">
  <h3 class="theme_option_headline"><?php _e('Ranking list individual setting', 'tcd-w'); ?></h3>
  <div class="theme_option_field_ac_content">

   <?php
        for($i = 1; $i <= 3; $i++) :
          if(empty(get_post_meta($post->ID, 'show_ranking_list'.$i, true))){
            $show_ranking_list = '1';
          } else {
            $show_ranking_list = get_post_meta($post->ID, 'show_ranking_list'.$i, true);
          }
          if($i == 1){
            $ranking_list_headline = get_post_meta($post->ID, 'ranking_list_headline'.$i, true) ?  get_post_meta($post->ID, 'ranking_list_headline'.$i, true) : 'DAILY';
          } elseif($i == 2){
            $ranking_list_headline = get_post_meta($post->ID, 'ranking_list_headline'.$i, true) ?  get_post_meta($post->ID, 'ranking_list_headline'.$i, true) : 'WEEKLY';
          } else{
            $ranking_list_headline = get_post_meta($post->ID, 'ranking_list_headline'.$i, true) ?  get_post_meta($post->ID, 'ranking_list_headline'.$i, true) : 'MONTHLY';
          }
          $ranking_list_desc = get_post_meta($post->ID, 'ranking_list_desc'.$i, true);
          $ranking_list_range = get_post_meta($post->ID, 'ranking_list_range'.$i, true) ?  get_post_meta($post->ID, 'ranking_list_range'.$i, true) : '';
          $ranking_list_post_num = get_post_meta($post->ID, 'ranking_list_post_num'.$i, true) ?  get_post_meta($post->ID, 'ranking_list_post_num'.$i, true) : '10';
   ?>
   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php printf(__('Ranking list%s', 'tcd-w'), $i); ?></h3>
    <div class="sub_box_content">
     <p class="hidden"><input name="show_ranking_list<?php echo $i; ?>" type="hidden" value="hide"></p>
     <p class="displayment_checkbox"><label><input name="show_ranking_list<?php echo $i; ?>" type="checkbox" value="1" <?php checked( '1', $show_ranking_list ); ?> /> <?php _e('Display this ranking list', 'tcd-w');  ?></label></p>
     <div style="<?php if($show_ranking_list == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
      <input class="full_width repeater-label" type="text" name="ranking_list_headline<?php echo $i; ?>" value="<?php esc_attr_e( $ranking_list_headline ); ?>" />
      <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
      <textarea class="full_width" cols="50" rows="3" name="ranking_list_desc<?php echo $i; ?>"><?php echo esc_textarea(  $ranking_list_desc ); ?></textarea>
      <h3 class="theme_option_headline2"><?php _e('Other setting', 'tcd-w'); ?></h3>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Range of ranking', 'tcd-w');  ?></span>
        <select name="ranking_list_range<?php echo $i; ?>">
         <option value="day" <?php selected('day', $ranking_list_range); ?>><?php _e('Daily', 'tcd-w'); ?></option>
         <option value="week" <?php selected('week', $ranking_list_range); ?>><?php _e('Weekly', 'tcd-w'); ?></option>
         <option value="month" <?php selected('month', $ranking_list_range); ?>><?php _e('Monthly', 'tcd-w'); ?></option>
         <option value="year" <?php selected('year', $ranking_list_range); ?>><?php _e('Yearly', 'tcd-w'); ?></option>
         <option value="" <?php selected('', $ranking_list_range); ?>><?php _e('All time', 'tcd-w'); ?></option>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="ranking_list_post_num<?php echo $i; ?>">
         <?php for($post_num=5; $post_num<= 12; $post_num++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($post_num); ?>" <?php selected( $ranking_list_post_num, $post_num ); ?>><?php echo esc_html($post_num); ?></option>
         <?php endfor; ?>
        </select>
       </li>
      </ul>
     </div>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->
   <?php endfor; ?>

   <ul class="button_list cf">
    <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .theme_option_field_ac_content -->
 </div><!-- END .theme_option_field -->

</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_ranking_list_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['ranking_list_meta_box_nonce']) || !wp_verify_nonce($_POST['ranking_list_meta_box_nonce'], basename(__FILE__))) {
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
    'ranking_title_font_size','ranking_title_font_size_mobile','show_ranking_num','show_ranking_category','show_ranking_date','show_ranking_author','show_ranking_view',
    'show_ranking_list1','ranking_list_headline1','ranking_list_desc1','ranking_list_range1','ranking_list_post_num1',
    'show_ranking_list2','ranking_list_headline2','ranking_list_desc2','ranking_list_range2','ranking_list_post_num2',
    'show_ranking_list3','ranking_list_headline3','ranking_list_desc3','ranking_list_range3','ranking_list_post_num3',
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
add_action('save_post', 'save_ranking_list_meta_box');




?>
