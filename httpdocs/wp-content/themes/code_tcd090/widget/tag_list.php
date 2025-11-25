<?php

class tcdw_tag_list_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'tcdw_tag_list_widget',// ID
      __( 'Tag list (tcd ver)', 'tcd-w' ),
      array(
        'classname' => 'tcdw_tag_list_widget',
        'description' => __('Displays designed tag list.', 'tcd-w')
      )
    );
  }

 // Extract Args //
 function widget($args, $instance) {
   extract( $args );
   $title = apply_filters('widget_title', $instance['title']); // the widget title

   // Before widget //
   echo $before_widget;

    // Title of widget //
    if ( $title ) { echo $before_title . $title . $after_title; }

   // Widget output //
?>
<?php
     $tag_args = array(
      'orderby' => 'name',
      'order' => 'ASC',
     ); 
     $post_tags = get_tags($tag_args);
     if ( $post_tags && ! is_wp_error( $post_tags ) ) {
?>
<ol>
 <?php
      foreach ( $post_tags as $tag ):
        $tag_id = $tag->term_id;
        $tag_name = $tag->name;
        $tag_url = get_tag_link($tag_id);
        if(!array_key_exists('tag_'.$tag_id,$instance)){$instance['tag_'.$tag_id]=1;};
        if($instance['tag_'.$tag_id]){
 ?>
 <li><a href="<?php echo esc_url($tag_url); ?>"><?php echo esc_html($tag_name); ?></a></li>
 <?php
        };
      endforeach;
 ?>
</ol>
<?php }; ?>
<?php

   // After widget //
   echo $after_widget;

} // end function widget


 // Update Settings //
 function update($new_instance, $old_instance) {
  $instance['title'] = strip_tags($new_instance['title']);

  $tag_args = array( 'orderby' => 'name', 'order' => 'ASC' );
  $post_tags = get_tags($tag_args);
  foreach( $post_tags as $tag ){
    $tag_id = $tag->term_id;
    $instance['tag_'.$tag_id] = $new_instance['tag_'.$tag_id];
  }

  return $instance;
 }

 // Widget Control Panel //
 function form($instance) {
  $defaults = array(
    'title' => '',
  );

  $tag_args = array( 'orderby' => 'name', 'order' => 'ASC' );
  $post_tags = get_tags($tag_args);
  foreach( $post_tags as $tag ){
    $tag_id = $tag->term_id;
    $defaults += array('tag_'.$tag_id => '1');
  }

  $instance = wp_parse_args( (array) $instance, $defaults );
?>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-w'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Tags to display', 'tcd-w');  ?></h3>
 <div class="theme_option_message2">
  <p><?php _e('Registered post tags will be displayed in this option<br>You can click each tag button.<br>Blue colored tag will be displayed in tag list and gray colored tag will not be displayed in tag list.', 'tcd-w'); ?></p>
 </div>
 <?php
      $tag_args = array( 'orderby' => 'name', 'order' => 'ASC' );
      $post_tags = get_tags($tag_args);
      if ( $post_tags && ! is_wp_error( $post_tags ) ) {
 ?>
 <ul class="tag_check_list">
  <?php
       foreach( $post_tags as $tag ):
         $tag_id = $tag->term_id;
         $tag_name = $tag->name;
  ?>
  <li>
   <label>
    <input name="<?php echo $this->get_field_name('tag_'.$tag_id); ?>" type="checkbox" value="1" <?php checked( $instance['tag_'.$tag_id], 1 ); ?> />
    <span><?php echo $tag_name ?></span>
   </label>
  </li>
  <?php endforeach; ?>
 </ul>
 <?php } ?>
</div>


<?php

  } // end function form
} // end class


function register_tcdw_tag_list_widget() {
	register_widget( 'tcdw_tag_list_widget' );
}
add_action( 'widgets_init', 'register_tcdw_tag_list_widget' );


?>
