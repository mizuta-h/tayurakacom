<?php
     get_header();
     $options = get_design_plus_option();
     $bg_image = wp_get_attachment_image_src($options['page_404_bg_image'], 'full');
?>

<div id="page_404_header" style="background:#000;">

 <div class="content">
  <h2 class="catch common_headline rich_font"><?php if($options['page_404_catch']){ echo nl2br(esc_html($options['page_404_catch'])); } else { echo '404 NOT FOUND'; }; ?></h2>
  <?php if ($options['page_404_desc']) { ?>
  <p class="desc"><?php echo nl2br(esc_html($options['page_404_desc'])); ?></p>
  <?php } ?>
 </div>

 <?php if($options['page_404_use_overlay']){ ?>
 <div class="overlay"></div>
 <?php }; ?>

 <?php if(!empty($bg_image)) { ?>
 <div class="bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>

</div>

<?php get_footer(); ?>