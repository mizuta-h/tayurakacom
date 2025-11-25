<?php
     get_header();
     $options = get_design_plus_option();
     $author_info = $wp_query->get_queried_object();
     $author_id = $author_info->ID;
     if($author_id){
       $user_data = get_userdata($author_id);
       $user_name = $user_data->display_name;
       $desc = $user_data->description;
       $facebook = $user_data->facebook_url;
       $twitter = $user_data->twitter_url;
       $insta = $user_data->instagram_url;
       $tiktok = $user_data->tiktok_url;
       $pinterest = $user_data->pinterest_url;
       $youtube = $user_data->youtube_url;
       $contact = $user_data->contact_url;
       $author_url = get_author_posts_url($author_id);
       $user_url = $user_data->user_url;
       $catch = $user_data->catch;
?>
<div id="author_page_header">

 <div class="content">

   <div class="image"><?php echo wp_kses_post(get_avatar($author_id, 360)); ?></div>

   <h1 class="name rich_font"><?php echo esc_html($user_data->display_name); ?></h1>

   <?php if($catch) { ?>
   <p class="catch"><?php echo esc_html($catch); ?></p>
   <?php }; ?>

   <?php if($facebook || $twitter || $tiktok || $insta || $pinterest || $youtube || $contact || $user_url) { ?>
   <ul class="sns_button_list clearfix color_<?php echo esc_attr($options['single_sns_color_type']); ?>">
    <?php if($user_url) { ?><li class="user_url"><a href="<?php echo esc_url($user_url); ?>" target="_blank"><span><?php echo esc_url($user_url); ?></span></a></li><?php }; ?>
    <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
    <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
    <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
    <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
    <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
    <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
    <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
   </ul>
   <?php }; ?>

   <?php if($desc) { ?>
   <p class="desc"><span><?php echo esc_html($desc); ?></span></p>
   <?php }; ?>

 </div>

</div>
<?php }; ?>

<div id="blog_archive">

 <div id="blog_total_num" class="inview">
  <div class="content">
   <p class="headline"><?php echo __( 'TOTAL POSTS', 'tcd-w' ); ?></p>
   <p class="num" style="color:<?php echo esc_html($options['main_color']); ?>;"><?php printf(__('<span>%s</span> posts', 'tcd-w'), $wp_query->found_posts); ?></p>
  </div>
 </div>

 <?php if ( have_posts() ) : ?>

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
   <div class="content no_author">
    <?php
         if ($options['archive_blog_show_category']){
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
     <h2 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
    </div>
   </div>
   <?php if ($options['archive_blog_show_date']){ ?>
   <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
   <?php }; ?>
  </article>
  <?php endwhile; ?>
 </div><!-- END #blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

 <?php endif; ?>

</div><!-- END #blog_archive -->

<?php get_footer(); ?>