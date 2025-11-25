<?php

class ranking_post_list_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'ranking_post_list_widget',// ID
      __( 'Ranking post list (tcd ver)', 'tcd-w' ),
      array(
        'classname' => 'ranking_post_list_widget',
        'description' => __('Displays post list based on post view.', 'tcd-w')
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    global $post;
    $options = get_design_plus_option();

    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $show_rank_num = $instance['show_rank_num'];
    $post_num = $instance['post_num'];

    // Before widget //
    echo $before_widget;

    // Title of widget //
    if ( $title ) { echo $before_title . $title . $after_title; }

    // Widget output //
?>
<div class="rank_post_wrap" data-active-postlist="rank_post1">
 <div class="rank_headline">
  <?php
       $postlist_num = 1;
       for ( $i = 1; $i <= 3; $i++ ) :
         $show_rank = $instance['show_rank'.$i];
         $rank_headline = $instance['rank_headline'.$i];
         if($show_rank){
  ?>
  <div class="headline <?php if($i == 1){ echo ' active'; }; ?>" data-postlist-num="rank_post<?php echo $postlist_num; ?>"><?php echo esc_html($rank_headline); ?></div>
  <?php
         $postlist_num++;
         };
       endfor;
  ?>
  <div class="slide_item"></div>
 </div>
 <div class="rank_post_list_wrap">
 <?php
      for ( $i = 1; $i <= 3; $i++ ) :

        $show_rank = $instance['show_rank'.$i];
        $rank_range = $instance['rank_range'.$i];

        if($show_rank){
          $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1);
          $post_list = get_posts_views_ranking( $rank_range, $args, 'WP_Query' );
 ?>
 <ol class="rank_post rank_post<?php echo $i; if($i == 1){ echo ' active'; }; ?>">
  <?php
       $rank_num = 1;
       if ($post_list->have_posts()) {
         while ($post_list->have_posts()) : $post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
           } elseif($options['no_image1']) {
             $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
           } else {
             $image = array();
             $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
           }
  ?>
  <li class="item">
   <a class="image_link animate_background" href="<?php the_permalink() ?>" style="background:none;">
    <?php if($show_rank_num){ ?><div class="rank"><?php echo esc_html($rank_num); ?></div><?php }; ?>
    <div class="image_wrap">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
   </a>
   <div class="title_area">
    <div class="title"><a href="<?php the_permalink() ?>"><span><?php the_title_attribute(); ?></span></a></div>
     <ul class="meta clearfix">
      <li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
      <?php
           $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
           if ( $category && ! is_wp_error($category) ) {
             foreach ( $category as $cat ) :
               $cat_name = $cat->name;
               $cat_id = $cat->term_id;
               break;
             endforeach;
           };
      ?>
      <li class="category"><a class="cat_id<?php echo esc_attr($cat_id); ?>_text_link" href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><?php echo esc_html($cat_name); ?></a></li>
     </ul>
    </div>
  </li>
  <?php $rank_num++; endwhile; wp_reset_query(); } else { ?>
  <li class="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></li>
  <?php }; ?>
 </ol>
<?php
      }; // END show rank
    endfor;
?>
 </div><!-- END .rank_post_wrap -->
</div>
<?php
    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['show_rank1'] = $new_instance['show_rank1'];
    $instance['show_rank2'] = $new_instance['show_rank2'];
    $instance['show_rank3'] = $new_instance['show_rank3'];
    $instance['rank_headline1'] = $new_instance['rank_headline1'];
    $instance['rank_headline2'] = $new_instance['rank_headline2'];
    $instance['rank_headline3'] = $new_instance['rank_headline3'];
    $instance['rank_range1'] = $new_instance['rank_range1'];
    $instance['rank_range2'] = $new_instance['rank_range2'];
    $instance['rank_range3'] = $new_instance['rank_range3'];
    $instance['show_rank_num'] = $new_instance['show_rank_num'];
    $instance['post_num'] = $new_instance['post_num'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $defaults = array(
      'title' => 'RANKING',
      'show_rank1' => 1,
      'show_rank2' => 1,
      'show_rank3' => 1,
      'rank_headline1' => 'DAILY',
      'rank_headline2' => 'WEEKLY',
      'rank_headline3' => 'MONTHLY',
      'rank_range1' => 'day',
      'rank_range2' => 'week',
      'rank_range3' => 'month',
      'show_rank_num' => '1',
      'post_num' => '3'
    );
    $instance = wp_parse_args( (array) $instance, $defaults );
?>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-w'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Number of post', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_num'); ?>" class="widefat" style="width:100%;">
  <option value="3" <?php selected('3', $instance['post_num']); ?>>3</option>
  <option value="4" <?php selected('4', $instance['post_num']); ?>>4</option>
  <option value="5" <?php selected('5', $instance['post_num']); ?>>5</option>
  <option value="6" <?php selected('6', $instance['post_num']); ?>>6</option>
  <option value="7" <?php selected('7', $instance['post_num']); ?>>7</option>
  <option value="8" <?php selected('8', $instance['post_num']); ?>>8</option>
  <option value="9" <?php selected('9', $instance['post_num']); ?>>9</option>
  <option value="10" <?php selected('10', $instance['post_num']); ?>>10</option>
 </select>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Display setting', 'tcd-w'); ?></h3>
 <p><label for="<?php echo $this->get_field_id('show_rank_num'); ?>"><input id="<?php echo $this->get_field_id('show_rank_num'); ?>" name="<?php echo $this->get_field_name('show_rank_num'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_rank_num'] ); ?> /><?php _e('Display rank number', 'tcd-w'); ?></label></p>
</div>

<div class="tcd_ad_widget_box_wrap">

 <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
 <h3 class="tcd_ad_widget_headline"><?php _e('Ranking','tcd-w'); ?><?php echo $i; ?></h3>
 <div class="tcd_ad_widget_box">

  <div class="tcd_widget_content">
   <p><label for="<?php echo $this->get_field_id('show_rank'.$i); ?>"><input id="<?php echo $this->get_field_id('show_rank'.$i); ?>" name="<?php echo $this->get_field_name('show_rank'.$i); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_rank'.$i] ); ?> /><?php printf(__('Display ranking%s', 'tcd-w'), $i); ?></label></p>
  </div>

  <div class="tcd_widget_content">
   <h3 class="tcd_widget_headline"><?php _e('Headline', 'tcd-w'); ?></h3>
   <input class="widefat" name="<?php echo $this->get_field_name('rank_headline'.$i); ?>'" type="text" value="<?php echo $instance['rank_headline'.$i]; ?>" />
  </div>

  <div class="tcd_widget_content">
   <h3 class="tcd_widget_headline"><?php _e('Range of ranking', 'tcd-w'); ?></h3>
   <select id="<?php echo $this->get_field_id('rank_range'.$i); ?>" name="<?php echo $this->get_field_name('rank_range'.$i); ?>" class="widefat" style="width:100%;">
    <option value="day" <?php selected('day', $instance['rank_range'.$i]); ?>><?php _e('Daily', 'tcd-w'); ?></option>
    <option value="week" <?php selected('week', $instance['rank_range'.$i]); ?>><?php _e('Weekly', 'tcd-w'); ?></option>
    <option value="month" <?php selected('month', $instance['rank_range'.$i]); ?>><?php _e('Monthly', 'tcd-w'); ?></option>
    <option value="year" <?php selected('year', $instance['rank_range'.$i]); ?>><?php _e('Yearly', 'tcd-w'); ?></option>
    <option value="" <?php selected('', $instance['rank_range'.$i]); ?>><?php _e('All time', 'tcd-w'); ?></option>
   </select>
  </div>

 </div>
 <?php endfor; ?>

</div>
<?php

  } // end function form

} // end class


function register_ranking_post_list_widget() {
	register_widget( 'ranking_post_list_widget' );
}
add_action( 'widgets_init', 'register_ranking_post_list_widget' );


?>
