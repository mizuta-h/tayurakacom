<?php
     get_header();
     $options = get_design_plus_option();
     $catch = $options['archive_blog_header_catch'];
     $catch_font_type = $options['headline_font_type'];
     $desc = $options['archive_blog_header_desc'];
     $bg_image = wp_get_attachment_image_src($options['archive_blog_header_bg_image'], 'full');
     $bg_image_mobile = wp_get_attachment_image_src($options['archive_blog_header_bg_image_mobile'], 'full');
     $use_overlay = $options['archive_blog_header_use_overlay'];
     // overwrite the data if category data exist
     if(is_tag()) {
       $query_obj = get_queried_object();
       $catch = $query_obj->name;
       $desc = '';
       if (!empty($query_obj->description)){
         $desc = $query_obj->description;
       }
     }
?>
<div id="page_header" class="simple" style="border-bottom:1px solid #ddd;">

 <div id="page_header_inner">
  <?php if($catch){ ?>
  <h1 class="catch common_headline rich_font_<?php echo esc_attr($catch_font_type); ?> <?php if (is_category()) { echo 'cat_id' . esc_attr($current_cat_id); }; ?> animate_item"><?php echo sepLine($catch); ?></h1>
  <?php }; ?>
  <?php if($desc){ ?>
  <p class="desc animate_item"><?php echo wp_kses_post(nl2br($desc)); ?></p>
  <?php }; ?>
 </div>

</div>

<div id="blog_archive">

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
     ?>
     <a class="author" href="<?php echo esc_url($author_url); ?>">
      <div class="avatar_area animate_image"><?php echo wp_kses_post(get_avatar($author_id, 140)); ?></div>
      <div class="name"><?php echo esc_html($user_data->display_name); ?></div>
     </a>
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
    <p class="pr_label"><span class="label"><?php echo esc_html($options['pr_banner_label'.$banner_num]); ?></span><span class="line" style="background:<?php echo esc_attr($background_color); ?>;"></span></p>
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