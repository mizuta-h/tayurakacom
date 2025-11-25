<?php
     get_header();
     $options = get_design_plus_option();
     $catch = get_post_meta($post->ID, 'page_header_catch', true);
     $catch_mobile = get_post_meta($post->ID, 'page_header_catch_mobile', true);
     $catch_font_type = $options['headline_font_type'];
     $hide_underline = get_post_meta($post->ID, 'hide_underline', true);
     $hide_underline_mobile = get_post_meta($post->ID, 'hide_underline_mobile', true);
     $desc = get_post_meta($post->ID, 'page_header_desc', true);
     $bg_image = wp_get_attachment_image_src(get_post_meta($post->ID, 'page_header_bg_image', true), 'full');
     $bg_image_mobile = wp_get_attachment_image_src(get_post_meta($post->ID, 'page_header_bg_image_mobile', true), 'full');
     $use_overlay = get_post_meta($post->ID, 'page_header_use_overlay', true);
     $hide_page_header = get_post_meta($post->ID, 'hide_page_header', true);
     $page_header_height = get_post_meta($post->ID, 'page_header_height', true) ?  get_post_meta($post->ID, 'page_header_height', true) : 'type1';
     $page_header_type = get_post_meta($post->ID, 'page_header_type', true) ?  get_post_meta($post->ID, 'page_header_type', true) : 'type1';
     $change_content_width = get_post_meta($post->ID, 'change_content_width', true);
     if($change_content_width){
       $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '690';
     } else {
       $page_content_width = '690';
     }
     if(!$hide_page_header){
?>
<div id="page_header" <?php if($page_header_type == 'type2'){ echo 'class="simple"'; } elseif($page_header_height == 'type2'){ echo 'class="full_height"'; }; ?>>

 <div id="page_header_inner" class="underline_setting<?php if($hide_underline){ echo ' hide_underline'; }; if($hide_underline_mobile){ echo ' hide_underline_mobile'; }; ?>">
  <?php if($catch_mobile && is_mobile()){ ?>
  <h1 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?> animate_item"><?php echo sepLine($catch_mobile); ?></h1>
  <?php } else { ?>
  <?php if($catch){ ?>
  <h1 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?> animate_item"><?php if($catch_mobile){ echo '<div class="pc">'; }; echo sepLine($catch); ?><?php if($catch_mobile){ echo '</div><div class="mobile">' . sepLine($catch_mobile) . '</div>'; }; ?></h1>
  <?php }; ?>
  <?php }; ?>
  <?php if($desc){ ?>
  <p class="desc animate_item"><?php echo wp_kses_post(nl2br($desc)); ?></p>
  <?php }; ?>
 </div>

 <?php if($page_header_type == 'type1'){ ?>

 <?php if($page_header_height == 'type2'){ ?>
 <a class="animate_item" id="page_contents_link" href="#one_col"></a>
 <?php }; ?>

 <?php if($use_overlay) { ?>
 <div class="overlay"></div>
 <?php }; ?>

 <?php if(!empty($bg_image)) { ?>
 <div class="bg_image<?php if(!empty($bg_image_mobile)) { echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>
 <?php if(!empty($bg_image_mobile)) { ?>
 <div class="bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>

 <?php }; ?>

</div>
<?php }; ?>

<div id="one_col" style="width:<?php echo esc_attr($page_content_width); ?>px;">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <article id="article">

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

</div><!-- END #one_col -->

<?php get_footer(); ?>