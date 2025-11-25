<?php
     get_header();
     $options = get_design_plus_option();
?>
<div id="main_contents">

 <div id="main_col">

 <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
        if ( $category && ! is_wp_error($category) ) {
          foreach ( $category as $cat ) :
            $cat_name = $cat->name;
            $cat_id = $cat->term_id;
            $cat_url = get_term_link($cat_id,'category');
            break;
          endforeach;
        };
 ?>

  <article id="article">

   <?php if($page == '1') { // ***** only show on first page ***** ?>

   <div id="post_title">
    <?php if ( ! is_wp_error($category) ) { ?>
    <a class="category cat_id<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url($cat_url); ?>"><span><?php echo esc_html($cat_name); ?></span></a>
    <?php }; ?>
    <h1 class="title rich_font entry-title"><?php the_title(); ?></h1>
    <ul class="meta_top clearfix">
     <?php if ( $options['single_blog_show_date']){ ?>
     <li class="date"><time class="entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
     <?php
          if ( $options['single_blog_show_update']){
            $post_date = get_the_time('Ymd');
            $modified_date = get_the_modified_date('Ymd');
            if($post_date < $modified_date){
     ?>
     <li class="update"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time></li>
     <?php
            };
          };
     ?>
     <?php }; ?>
    </ul>
   </div>

   <?php
        if(has_post_thumbnail()) {
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
   ?>
   <img id="post_image" src="<?php echo esc_attr($image[0]); ?>" alt="" title="">
   <?php }; ?>

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_sns_top']) {
   ?>
   <div class="single_share clearfix" id="single_share_top">
    <?php get_template_part('template-parts/sns-btn-top'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_copy_top']) {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // banner top ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        };
   ?>

   <?php }; // ***** END only show on first page ***** ?>

   <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

   <?php
        // CTA -----------------------------
        if ( $options['cta_display'] != '5') { get_template_part( 'template-parts/cta' ); }
   ?>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_sns_btm']) {
   ?>
   <div class="single_share clearfix" id="single_share_bottom">
    <?php get_template_part('template-parts/sns-btn-btm'); ?>
   </div>
   <?php }; ?>

   <?php
        // meta ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if ($options['single_blog_show_meta_box']) {
   ?>
   <ul id="post_meta_bottom" class="clearfix">
    <?php if ($options['single_blog_show_meta_author']) : ?><li class="post_author"><?php _e("Author","tcd-w"); ?>: <?php if (function_exists('coauthors_posts_links')) { coauthors_posts_links(', ',', ','','',true); } else { the_author_posts_link(); }; ?></li><?php endif; ?>
    <?php if (has_category()){ ?><li class="post_category"><?php the_category(', '); ?></li><?php }; ?>
    <?php if (has_tag()): ?><?php the_tags('<li class="post_tag">',', ','</li>'); ?><?php endif; ?>
    <?php if ($options['single_blog_show_meta_comment']) : if (comments_open()){ ?><li class="post_comment"><?php _e("Comment","tcd-w"); ?>: <a href="#comments"><?php comments_number( '0','1','%' ); ?></a></li><?php }; endif; ?>
   </ul>
   <?php }; ?>

   <?php
        // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   ?>
   <div id="next_prev_post">
    <?php next_prev_post_link(); ?>
   </div>

  </article><!-- END #article -->

   <?php
        // banner bottom ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_bottom_ad_code'] ) {
   ?>
   <div id="single_banner_bottom" class="single_banner">
    <?php echo $options['single_bottom_ad_code']; ?>
   </div><!-- END #single_banner_bottom -->
   <?php
          };
        };
   ?>

   <?php
        // Author profile ------------------------------------------------------------------------------------------------------------------------------
        $author_id = get_the_author_meta('ID');
        $user_data = get_userdata($author_id);
        if(!empty($user_data->show_author)) {
           $desc = $user_data->description;
           $author_url = get_author_posts_url($author_id);
           $catch = $user_data->catch;
           $post_num = $options['author_post_num'];
           $args = array( 'author' => $author_id, 'showposts' => $post_num );
           $author_post = new wp_query($args);
   ?>
   <div class="author_profile clearfix">
    <ul class="tab">
     <li class="tab1 active"><?php echo esc_html($options['author_tab_headline1']);  ?></li>
     <?php if($author_post->have_posts()) { ?><li class="tab2"><?php echo esc_html($options['author_tab_headline2']); ?></li><?php }; ?>
    </ul>
    <div class="content active" id="author_info">
     <a class="avatar_area animate_image" href="<?php echo esc_url($author_url); ?>"><?php echo wp_kses_post(get_avatar($author_id, 300)); ?></a>
     <div class="info">
      <div class="info_inner">
       <div class="info_header">
        <p class="name rich_font"><a href="<?php echo esc_url($author_url); ?>"><span class="author"><?php echo esc_html($user_data->display_name); ?></span></a></p>
        <?php if($catch) { ?>
        <p class="catch"><?php echo esc_html($catch); ?></p>
        <?php }; ?>
       </div>
       <?php if($desc) { ?>
       <p class="desc"><span><?php echo esc_html($desc); ?></span></p>
       <?php }; ?>
      </div>
     </div>
    </div><!-- END .content -->
    <?php if($author_post->have_posts()) { ?>
    <div class="content" id="author_post">
     <ol>
      <?php
           while ($author_post->have_posts()) {
             $author_post->the_post();
      ?>
      <li class="item">
       <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
       <p class="title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><span><?php the_title_attribute(); ?></span></a></p>
      </li>
      <?php }; ?>
     </ol>
     <?php wp_reset_query(); ?>
    </div><!-- END #author_post -->
    <?php }; ?>
   </div><!-- END .author_profile -->
   <?php }; ?>

   <?php
        // mobile banner ------------------------------------------------------------------------------------------------------------------------
        if(is_mobile()) {
          if( $options['single_mobile_ad_code'] ) {
   ?>
   <div id="single_banner_bottom" class="single_banner">
    <?php echo $options['single_mobile_ad_code']; ?>
   </div><!-- END #single_banner_bottom -->
   <?php
          };
        };
   ?>

  <?php endwhile; endif; ?>

  <?php
       // comment ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['single_blog_show_comment'] || $options['single_blog_show_trackback']) { comments_template('', true); };
  ?>

 </div><!-- END #main_col -->

 <?php
      // widget ------------------------
      get_sidebar();
 ?>

</div><!-- END #main_contents -->

<?php
     // 関連記事 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     if ($options['show_related_post']){
       $categories = get_the_category($post->ID);
       if ($categories) {
         $post_num = $options['related_post_num'];
         if(is_mobile()){
           $post_num = $options['related_post_num_mobile'];
         }
         $category_ids = array();
         foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
         $args = array( 'category__in' => $category_ids, 'post__not_in' => array($post->ID), 'showposts'=> $post_num, 'orderby' => 'rand');
         $related_post_list = new wp_query($args);
         if($related_post_list->have_posts()):
?>
<div id="related_post" class="post_carousel">
 <div class="headline_area">
  <h2 class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><span><?php echo wp_kses_post(nl2br($options['related_post_headline'])); ?></span></h2>
  <?php if($options['related_post_desc']){ ?>
  <p class="desc"><?php echo wp_kses_post(nl2br($options['related_post_desc'])); ?></p>
  <?php }; ?>
 </div>
 <div class="post_carousel_type2 owl-carousel">
  <?php
       while( $related_post_list->have_posts() ) : $related_post_list->the_post();
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
   <div class="content <?php if (!$options['related_post_show_author']){ echo ' no_author'; }; ?>">
    <?php
         if ($options['related_post_show_category']){
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
          if ($options['related_post_show_author']){
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
    <?php if ($options['related_post_show_date']){ ?>
    <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <?php }; ?>
   </div>
  </article>
  <?php endwhile; wp_reset_query(); ?>
 </div><!-- END .post_carousel_type2 -->
</div><!-- END #related_post -->
<?php
         endif;
       };
     };
?>

<?php
     // 特集コンテンツ -------------------------------------------------------------------------
     if($options['show_featured_post']){
?>
<div id="single_featured_content" class="featured_content">

 <div class="featured_content_wrap">

  <?php
       // 特集記事 -----------------------------------------
       if(is_mobile()) {
         $post_num = $options['featured_post_num_mobile'];
       } else {
         $post_num = $options['featured_post_num'];
       }
       $post_type = $options['featured_post_type'];
       $post_order = $options['featured_post_order'];
       $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on', 'orderby' => $post_order );
       $post_list = new wp_query($args);
       if($post_list->have_posts()):
  ?>
  <div class="featured_post">
   <div class="headline_area">
    <h2 class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><span><?php echo wp_kses_post(nl2br($options['featured_post_headline'])); ?></span></h2>
    <?php if($options['featured_post_desc']){ ?>
    <p class="desc"><?php echo wp_kses_post(nl2br($options['featured_post_desc'])); ?></p>
    <?php }; ?>
   </div>
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
    <div class="content <?php if (!$options['featured_post_show_author']){ echo ' no_author'; }; if(!$options['featured_post_show_date']){ echo 'no_date'; }; ?>">
     <?php
          if ($options['featured_post_show_category']){
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
           if ($options['featured_post_show_author']){
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
    <?php if ($options['featured_post_show_date']){ ?>
    <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <?php }; ?>
   </article>
   <?php endwhile; ?>
  </div><!-- END .featured_post -->
  <?php
       endif;
       wp_reset_query();
  ?>

  <?php
       // 特集ウィジェット -----------------------------------------
       if ( is_mobile() && is_active_sidebar( 'featured_widget_mobile' )) {
  ?>
  <div class="featured_widget">
   <?php dynamic_sidebar( 'featured_widget_mobile' ); ?>
  </div>
  <?php
        } elseif (is_active_sidebar( 'featured_widget' )) {
  ?>
  <div class="featured_widget">
   <?php dynamic_sidebar( 'featured_widget' ); ?>
  </div>
  <?php }; ?>

 </div><!-- END .featured_content_wrap -->
</div><!-- END #single_featured_content -->
<?php }; ?>

<?php get_footer(); ?>