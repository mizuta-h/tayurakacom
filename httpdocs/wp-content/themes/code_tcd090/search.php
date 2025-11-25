<?php
     get_header();
     $options = get_design_plus_option();
     if ( !empty( get_search_query() ) ) {
       $catch = sprintf( __( 'Search result for %s', 'tcd-w' ), get_search_query() );
     } else {
       $catch = __( 'Search result', 'tcd-w' );
     }
     $catch_font_type = $options['headline_font_type'];
     $bg_image = wp_get_attachment_image_src($options['archive_blog_header_bg_image'], 'full');
     $bg_image_mobile = wp_get_attachment_image_src($options['archive_blog_header_bg_image_mobile'], 'full');
     $use_overlay = $options['archive_blog_header_use_overlay'];
?>
 <?php if ( have_posts() && !empty( get_search_query() )) : ?>
<div id="page_header">

 <div id="page_header_inner">
  <?php if($catch){ ?>
  <h1 class="catch common_headline rich_font_<?php echo esc_attr($catch_font_type); ?> <?php if (is_category()) { echo 'cat cat_id' . esc_attr($current_cat_id); }; ?> animate_item"><?php echo sepLine($catch); ?></h1>
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

<div id="blog_archive">


 <div class="blog_list inview_group animation_<?php echo esc_attr($options['archive_blog_animation']); ?>">
  <?php
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
  <?php endwhile; ?>
 </div><!-- END #blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>
 </div><!-- END #blog_archive -->
 <?php else: ?>
 <?php
      $options = get_design_plus_option();
      $bg_image = wp_get_attachment_image_src($options['page_search_bg_image'], 'full');
  ?>
 <div id="page_search_header" style="background:#000;">

 <div class="content">
  <h2 class="catch common_headline rich_font"><?php if($options['page_search_catch']){ echo nl2br(esc_html($options['page_search_catch'])); } else { echo 'search NOT FOUND'; }; ?></h2>
  <?php if ($options['search_result_no_post_label']) { ?>
  <p class="desc"><?php echo nl2br($options['search_result_no_post_label']); ?></p>
  <?php } ?>
    <div id="search_form" class="search_form">
      <form role="search" method="get" action="<?php echo esc_url(home_url()); ?>">
        <div class="input_area"><input type="text" value="<?php echo $_GET["s"] ?>" name="s" autocomplete="off"  placeholder="<?php echo nl2br(esc_html($options['page_search_placeholder'])); ?>"></div>
        <div class="search_button"><label for="no_search_result_button"></label><input type="submit" id="no_search_result_button" value=""></div>
      </form>
    </div>
 </div>
 <?php if($options['page_search_use_overlay']){ ?>
 <div class="overlay"></div>
 <?php }; ?>

 <?php if(!empty($bg_image)) { ?>
 <div class="bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>

</div>
 <?php endif; ?>
<?php get_footer(); ?>