<?php
     get_header();
     $options = get_design_plus_option();
?>
<div id="main_contents">

 <div id="main_col">

 <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
 ?>

  <article id="article">

   <?php if($page == '1') { // ***** only show on first page ***** ?>

   <div id="post_title">
    <h1 class="title rich_font entry-title"><?php the_title(); ?></h1>
    <ul class="meta_top clearfix">
     <?php if ( $options['single_news_show_date']){ ?>
     <li class="date"><time class="entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
     <?php
          if ( $options['single_news_show_update']){
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
        if($options['single_news_show_sns_top']) {
   ?>
   <div class="single_share clearfix" id="single_share_top">
    <?php get_template_part('template-parts/sns-btn-top'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_copy_top']) {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // banner top ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_news_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_news_top_ad_code']; ?>
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
        if($options['single_news_show_sns_btm']) {
   ?>
   <div class="single_share clearfix" id="single_share_bottom">
    <?php get_template_part('template-parts/sns-btn-btm'); ?>
   </div>
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
          if( $options['single_news_bottom_ad_code'] ) {
   ?>
   <div id="single_banner_bottom" class="single_banner">
    <?php echo $options['single_news_bottom_ad_code']; ?>
   </div><!-- END #single_banner_bottom -->
   <?php
          };
        };
   ?>

   <?php
        // mobile banner ------------------------------------------------------------------------------------------------------------------------
        if(is_mobile()) {
          if( $options['single_news_mobile_ad_code'] ) {
   ?>
   <div id="single_banner_bottom" class="single_banner">
    <?php echo $options['single_news_mobile_ad_code']; ?>
   </div><!-- END #single_banner_bottom -->
   <?php
          };
        };
   ?>

  <?php endwhile; endif; ?>

 </div><!-- END #main_col -->

 <?php
      // widget ------------------------
      get_sidebar();
 ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>