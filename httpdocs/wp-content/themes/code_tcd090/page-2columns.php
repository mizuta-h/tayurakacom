<?php
/*
Template Name:2 Columns
*/
__('2 Columns', 'tcd-w');

     get_header();
     $options = get_design_plus_option();
?>
<div id="main_contents">

 <div id="main_col">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <article id="article">

   <?php if($page == '1') { // ***** only show on first page ***** ?>

   <div id="post_title">
    <h1 class="title rich_font entry-title"><?php the_title(); ?></h1>
   </div>

   <?php
        if(has_post_thumbnail()) {
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
   ?>
   <img id="post_image" src="<?php echo esc_attr($image[0]); ?>" alt="" title="">
   <?php }; ?>


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

 </article>

 <?php endwhile; endif; ?>

 </div><!-- END #main_col -->

 <?php
      // widget ------------------------
      get_sidebar();
 ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>