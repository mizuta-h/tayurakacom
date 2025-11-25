<?php
     get_header();
     $options = get_design_plus_option();
     $catch = $options['archive_news_header_catch'];
     $catch_font_type = $options['headline_font_type'];
     $desc = $options['archive_news_header_desc'];
     $desc_mobile = $options['archive_news_header_desc_mobile'];
     $bg_image = wp_get_attachment_image_src($options['archive_news_header_bg_image'], 'full');
     $bg_image_mobile = wp_get_attachment_image_src($options['archive_news_header_bg_image_mobile'], 'full');
     $use_overlay = $options['archive_news_header_use_overlay'];
?>
<div id="page_header">

 <div id="page_header_inner">
  <?php if($catch){ ?>
  <h1 class="catch common_headline rich_font_<?php echo esc_attr($catch_font_type); ?> animate_item"><?php echo sepLine($catch); ?></h1>
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

<div id="news_archive">

 <?php if ( have_posts() ) : ?>

 <div class="news_list">
  <?php
       while ( have_posts() ) : the_post();
  ?>
  <article class="item animate_item">
   <a class="animate_item_link" href="<?php the_permalink(); ?>">
      <div class="news_archive_item_content">
        <?php if($options['archive_news_show_date']||$options['archive_news_show_update']){ ?>
        <ul>
          <?php if ($options['archive_news_show_date']){ ?>
          <li><time class="date entry-date" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
          <?php }; ?>
          <?php
          if ($options['archive_news_show_update']){
            $post_date = get_the_time('Ymd',$post->ID);
            $modified_date = get_the_modified_date('Ymd',$post->ID);
            if($post_date < $modified_date){
          ?>
          <li><time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time></li>
          <?php }; }; ?>
        </ul>
        <?php }; ?>
        <h2 class="title"><span><?php the_title(); ?></span></h2>
      </div>
   </a>
  </article>
  <?php endwhile; ?>
 </div><!-- END #news_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

 <?php endif; ?>

</div><!-- END #news_archive -->

<?php get_footer(); ?>
