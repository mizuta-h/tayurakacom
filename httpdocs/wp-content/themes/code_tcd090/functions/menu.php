<?php
/**
 * Add data-megamenu attributes to the global navigation
 */
function nano_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {

  $options = get_design_plus_option();

  if ( 'global-menu' !== $args->theme_location ) return $item_output;

  if ( ! isset( $options['megamenu'][$item->ID] ) ) return $item_output;

  if ( 'type1' === $options['megamenu'][$item->ID] ) return $item_output;

  if ( 'type2' === $options['megamenu'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button type2" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }
  if ( 'type3' === $options['megamenu'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button type3" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }
  if ( 'type4' === $options['megamenu'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button type4" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }

}

add_filter( 'walker_nav_menu_start_el', 'nano_walker_nav_menu_start_el', 10, 4 );


// Mega menu A -  Blog carousel ---------------------------------------------------------------
function render_megamenu_a( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
?>
<div class="megamenu megamenu_a" id="js-megamenu<?php echo esc_attr( $id ); ?>">
 <div class="megamenu_inner">

  <div class="slider_area">
   <?php
        // slider ----------------------------------------------------------------------------
        $slider_post_num = $options['mega_menu_a_post_num'];
        $post_num = $slider_post_num;
        $post_order = $options['mega_menu_a_post_order'];
        if($post_order == 'rand'){
          $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => 'rand' );
        } else {
          $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num );
        }
        $post_list = new WP_Query($args);
        $num_post = $post_list->post_count;
        if($post_list->have_posts()):
   ?>
   <div class="slider">
    <?php
         $i = 1;
         while ($post_list->have_posts()) : $post_list->the_post();
         $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
         if ( $category && ! is_wp_error($category) ) {
           foreach ( $category as $cat ) :
             $cat_name = $cat->name;
             $cat_id = $cat->term_id;
             $cat_url = get_term_link($cat_id,'category');
             break;
           endforeach;
         };
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
         } elseif($options['no_image1']) {
           $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
         }
    ?>
    <article class="item">
     <a class="link animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
      <div class="title_area">
       <h4 class="title"><span><?php the_title_attribute(); ?></span></h4>
      </div>
     </a>
     <?php if ( $category && ! is_wp_error($category) ) { ?>
     <a class="category cat_id<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
     <?php }; ?>
    </article>
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .slider -->
   <?php endif; ?>
  </div><!-- END .slider_area -->

 </div><!-- END .megamenu_a_inner -->
</div><!-- END .megamenu_a -->
<?php
}

// Mega menu B - Showroom list ---------------------------------------------------------------
function render_megamenu_b( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
  if(!empty($megamenus[$id])) {
?>
<div class="megamenu megamenu_b" id="js-megamenu<?php echo esc_attr( $id ); ?>">
 <div class="megamenu_inner">

  <div class="post_list">
   <?php
        $image = wp_get_attachment_image_src($options['mega_menu_b_all_image'], 'full');
        if($image){
   ?>
   <div class="item">
    <a class="animate_background" href="<?php echo esc_url(get_post_type_archive_link('showroom')); ?>">
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <h3 class="title"><span><?php if($options['mega_menu_b_all_label']) { echo esc_html($options['mega_menu_b_all_label']); }; ?></span></h3>
    </a>
   </div>
   <?php
         };

        foreach ( $megamenus[$id] as $menu ) :
          if ( 'showroom_category' !== $menu->object ) continue;
            $page_id = $menu->object_id;
            $page_name = $menu->title;
            $url = $menu->url;
            $term_meta = get_option( 'taxonomy_' . $page_id, array() );
            $image = isset($term_meta['mega_image']) ? wp_get_attachment_image_src($term_meta['mega_image'], 'full') : '';
            if($image){
   ?>
   <div class="item">
    <a class="animate_background" href="<?php echo esc_url($url); ?>">
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <h3 class="title"><?php if($page_name) { echo esc_html($page_name); }; ?></h3>
    </a>
   </div>
   <?php
            };
        endforeach;
   ?>
  </div>

 </div><!-- END .megamenu_b_inner -->
</div><!-- END .megamenu_b -->
<?php
  };
};

?>