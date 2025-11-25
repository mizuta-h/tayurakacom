<?php
     get_header();
     $options = get_design_plus_option();
     $catch = $options['archive_blog_header_catch'];
     $catch_font_type = $options['headline_font_type'];
     $desc = $options['archive_blog_header_desc'];
     $desc_mobile = $options['archive_blog_header_desc_mobile'];
     $bg_image = wp_get_attachment_image_src($options['archive_blog_header_bg_image'], 'full');
     $bg_image_mobile = wp_get_attachment_image_src($options['archive_blog_header_bg_image_mobile'], 'full');
     $use_overlay = $options['archive_blog_header_use_overlay'];
     // overwrite the data if category data exist
     if (is_category()) {
       $query_obj = get_queried_object();
       $catch = $query_obj->name;
       $desc = '';
       $desc_mobile = '';
       if (!empty($query_obj->description)){
         $desc = $query_obj->description;
       }
       $current_cat_id = $query_obj->term_id;
       $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
       if (!empty($term_meta['image'])){
         $bg_image = wp_get_attachment_image_src( $term_meta['image'], 'full' );
       }
       if (!empty($term_meta['image_mobile'])){
         $bg_image_mobile = wp_get_attachment_image_src( $term_meta['image_mobile'], 'full' );
       }
       if (!empty($term_meta['image']) && !empty($term_meta['use_overlay'])){
         $use_overlay = $term_meta['use_overlay'];
       }
       if (!empty($term_meta['desc_mobile'])){
         $desc_mobile = $term_meta['desc_mobile'];
       }
     } elseif(is_tag()) {
       $query_obj = get_queried_object();
       $catch = $query_obj->name;
       $desc = '';
       $desc_mobile = '';
       if (!empty($query_obj->description)){
         $desc = $query_obj->description;
       }
     } elseif ( is_day() ) {
       $catch = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'F jS, Y', 'tcd-w' ) ) );
       $desc = '';
       $desc_mobile = '';
     } elseif ( is_month() ) {
       $catch = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'F, Y', 'tcd-w') ) );
       $desc = '';
       $desc_mobile = '';
     } elseif ( is_year() ) {
       $catch = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'Y', 'tcd-w') ) );
       $desc = '';
       $desc_mobile = '';
     }
?>
<div id="page_header">

 <div id="page_header_inner">
  <?php if($catch){ ?>
  <h1 class="catch common_headline rich_font_<?php echo esc_attr($catch_font_type); ?> <?php if (is_category()) { echo 'cat_id' . esc_attr($current_cat_id); }; ?> animate_item"><?php echo sepLine($catch); ?></h1>
  <?php }; ?>
  <?php if($desc){ ?>
  <p class="desc animate_item"><?php if($desc_mobile){ ?><span class="pc"><?php }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ ?></span><span class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></span><?php }; ?></p>
  <?php }; ?>
 </div>

 <?php if($use_overlay) { ?>
 <div class="overlay"></div>
 <?php }; ?>

 <?php if(!empty($bg_image)) { ?>
 <div class="bg_image<?php if(!empty($bg_image_mobile)) { echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>
 <?php if(!empty($bg_image_mobile)) { ?>
 <div class="bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>

</div>

<?php
     // カルーセル ---------------------------------------
     if (is_category()) {
       $show_carousel =  (isset($term_meta['show_carousel']) && !empty($term_meta['show_carousel'])) ? $term_meta['show_carousel'] : '';
     } else {
       $show_carousel = $options['show_archive_carousel'];
     }
     if($show_carousel){
       if(is_mobile()) {
         $post_num = $options['archive_carousel_num_mobile'];
       } else {
         $post_num = $options['archive_carousel_num'];
       }
       $archive_carousel_show_author = $options['archive_carousel_show_author'];
       $archive_carousel_show_category = $options['archive_carousel_show_category'];
       $archive_carousel_show_date = $options['archive_carousel_show_date'];
       if (is_category()) {
         $archive_carousel_headline =  (isset($term_meta['archive_carousel_headline']) && !empty($term_meta['archive_carousel_headline'])) ? $term_meta['archive_carousel_headline'] : 'PICKUP';
         $post_type =  (isset($term_meta['archive_carousel_post_type']) && !empty($term_meta['archive_carousel_post_type'])) ? $term_meta['archive_carousel_post_type'] : 'pickup_post';
         $post_order =  (isset($term_meta['archive_carousel_post_order']) && !empty($term_meta['archive_carousel_post_order'])) ? $term_meta['archive_carousel_post_order'] : 'rand';
         $args = array( 'cat' => $current_cat_id, 'post_type' => 'post', 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on', 'orderby' => $post_order );
       } else {
         $archive_carousel_headline = $options['archive_carousel_headline'];
         $post_type = $options['archive_carousel_post_type'];
         $post_order = $options['archive_carousel_post_order'];
         $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on', 'orderby' => $post_order );
       }
       $post_list = new wp_query($args);
       if($post_list->have_posts()):
         $total_post = $post_list->post_count;
?>
<div id="blog_archive_carousel" class="post_carousel">
 <div class="headline_area">
  <?php if($archive_carousel_headline){ ?><h2 class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($archive_carousel_headline)); ?></h2><?php }; ?>
 </div>
 <div class="post_carousel_type1 <?php if($total_post < 4){ echo 'less'; }; ?> owl-carousel">
  <?php
       while($post_list->have_posts()): $post_list->the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
         } elseif($options['no_image1']) {
           $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
         }
  ?>
  <article class="item">
   <a class="image_link animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
   </a>
   <div class="content <?php if($archive_carousel_show_author != 1){ echo ' no_author'; }; ?>">
    <?php
         if ($archive_carousel_show_category == '1'){
           $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
           if ( $category && ! is_wp_error($category) ) {
             foreach ( $category as $cat ) :
               $cat_name = $cat->name;
               $cat_id = $cat->term_id;
               break;
             endforeach;
    ?>
    <a class="category cat_id<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><span><?php echo esc_html($cat_name); ?></span></a>
    <?php
           };
         };
    ?>
    <div class="title_area">
     <h3 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
     <?php
          if ($archive_carousel_show_author == 1){
            $author_id = get_the_author_meta('ID');
            $user_data = get_userdata($author_id);
            $author_url = get_author_posts_url($author_id);
     ?>
     <a class="author" href="<?php echo esc_url($author_url); ?>">
      <div class="avatar_area animate_image"><?php echo wp_kses_post(get_avatar($author_id, 140)); ?></div>
      <div class="name"><?php echo esc_html($user_data->display_name); ?></div>
     </a>
     <?php }; ?>
    </div>
    <?php if ($archive_carousel_show_date == '1'){ ?>
    <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <?php }; ?>
   </div>
  </article>
  <?php endwhile; ?>
 </div>
</div><!-- END #blog_archive_carousel -->
<?php
       endif;
       wp_reset_query();
     };
?>

<div id="blog_archive">

 <?php if($paged == 0){ ?>

 <?php
      $catch2 = $options['archive_blog_catch'];
      $desc2 = $options['archive_blog_desc'];
      if($catch2 || $desc2) {
 ?>
 <div id="archive_header_desc" class="inview">
  <?php if($catch2){ ?><h2 class="catch common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($catch2)); ?></h2><?php }; ?>
  <?php if($desc2){ ?><p class="desc"><?php echo wp_kses_post(nl2br($desc2)); ?></p><?php }; ?>
 </div>
 <?php }; ?>

 <?php }; ?>

 <?php if ( have_posts() ) : ?>

 <div class="blog_list inview_group animation_<?php echo esc_attr($options['archive_blog_animation']); ?>">
  <?php
       $post_count = 1;
       // native ads --------------
       if($options['archive_blog_show_ads']){
         $banner_list = random_native_ads();
         if(!empty($banner_list)){
           $current_banner = 0;
           $total_banner = count($banner_list);
         }
       }
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
         } elseif($options['no_image1']) {
           $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
         }
  ?>
  <article class="item animate_item">
   <a class="image_link animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
   </a>
   <div class="content<?php if (!$options['archive_blog_show_author']){ echo ' no_author'; }; if(!$options['archive_blog_show_date']){ echo ' no_date'; }; ?>">
    <?php
         if ($options['archive_blog_show_category']){
           if(is_category()) {
           } else {
             $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
             if ( $category && ! is_wp_error($category) ) {
               foreach ( $category as $cat ) :
                 $cat_name = $cat->name;
                 $cat_id = $cat->term_id;
                 break;
               endforeach;
    ?>
    <a class="category cat_id<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><span><?php echo esc_html($cat_name); ?></span></a>
    <?php
             };
           };
         };
    ?>
    <div class="title_area">
     <h3 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
     <?php
          if ($options['archive_blog_show_author']){
            $author_id = get_the_author_meta('ID');
            $user_data = get_userdata($author_id);
            $author_url = get_author_posts_url($author_id);
            if(isset($user_data->display_name)){
     ?>
     <a class="author" href="<?php echo esc_url($author_url); ?>">
      <div class="avatar_area animate_image"><?php echo wp_kses_post(get_avatar($author_id, 140)); ?></div>
      <div class="name"><?php echo esc_html($user_data->display_name); ?></div>
     </a>
     <?php }; ?>
     <?php }; ?>
    </div>
   </div>
   <?php if ($options['archive_blog_show_date']){ ?>
   <time class="date entry-date" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
   <?php
        if ($options['archive_blog_show_update']){
          $post_date = get_the_time('Ymd',$post->ID);
          $modified_date = get_the_modified_date('Ymd',$post->ID);
          if($post_date < $modified_date){
   ?>
   <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
   <?php
          };
        };
   ?>
   <?php }; ?>
  </article>
  <?php
       // native ads ------------------
       if(!empty($banner_list) && $options['archive_blog_show_ads'] && ($post_count % $options['archive_blog_banner_num'] == 0) ){
         $banner_num = $banner_list[$current_banner];
         if($total_banner <= $current_banner+1){
           $current_banner = 0;
         } else {
           $current_banner++;
         }
         $background_color = $options['pr_banner_label_bg_color'.$banner_num];
         $image = wp_get_attachment_image_src( $options['pr_banner_image'.$banner_num], 'size3');
  ?>
  <article class="item ad_item animate_item">
   <a class="image_link" href="<?php if($options['pr_banner_url'.$banner_num]) { echo esc_url($options['pr_banner_url'.$banner_num]); }; ?>" <?php if($options['pr_banner_target'.$banner_num]){ echo 'target="_blank"'; }; ?>>
    <div class="image_wrap">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
   </a>
   <div class="content no_author">
    <?php if ( $options['show_pr_banner_label'.$banner_num] && $options['pr_banner_label'.$banner_num] ) { ?>
    <p class="pr_label"><span class="label"><?php echo esc_html($options['pr_banner_label'.$banner_num]); ?></span><span class="line" style="background-color:<?php echo esc_attr($background_color); ?>;"></span></p>
    <?php }; ?>
    <div class="title_area">
     <h3 class="title"><a href="<?php if($options['pr_banner_url'.$banner_num]) { echo esc_url($options['pr_banner_url'.$banner_num]); }; ?>" <?php if($options['pr_banner_target'.$banner_num]){ echo 'target="_blank"'; }; ?>><span><?php echo esc_html($options['pr_banner_title'.$banner_num]); ?></span></a></h3>
    </div>
   </div>
   <?php if($options['pr_banner_client'.$banner_num]) { ?><p class="client"><?php echo esc_html($options['pr_banner_client'.$banner_num]); ?></p><?php }; ?>
  </article>
  <?php }; $post_count++; // END native ad ?>
  <?php endwhile; ?>
 </div><!-- END #blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

 <?php endif; ?>

</div><!-- END #blog_archive -->

<?php get_footer(); ?>
