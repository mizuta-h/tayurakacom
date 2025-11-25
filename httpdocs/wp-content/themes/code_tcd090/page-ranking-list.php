<?php
/*
Template Name:Ranking list page
*/
__('Ranking list page', 'tcd-w');
?>
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
 <a class="animate_item" id="page_contents_link" href="#ranking_list"></a>
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

<div id="ranking_list">

<?php
     // ranking list ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     $show_ranking_num = get_post_meta($post->ID, 'show_ranking_num', true);
     $show_category = get_post_meta($post->ID, 'show_ranking_category', true);
     $show_date = get_post_meta($post->ID, 'show_ranking_date', true);
     $show_author = get_post_meta($post->ID, 'show_ranking_author', true);
     $show_view = get_post_meta($post->ID, 'show_ranking_view', true);
     for ( $i = 1; $i <= 3; $i++ ) :
       $show_ranking_list = get_post_meta($post->ID, 'show_ranking_list'.$i, true);
       if ($show_ranking_list == '1'){
         $post_num = get_post_meta($post->ID, 'ranking_list_post_num'.$i, true) ?  get_post_meta($post->ID, 'ranking_list_post_num'.$i, true) : '10';
         $rank_range = get_post_meta($post->ID, 'ranking_list_range'.$i, true) ?  get_post_meta($post->ID, 'ranking_list_range'.$i, true) : '';
         $headline = get_post_meta($post->ID, 'ranking_list_headline'.$i, true);
         $desc = get_post_meta($post->ID, 'ranking_list_desc'.$i, true);
         $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1);
         $post_list = get_posts_views_ranking( $rank_range, $args, 'WP_Query' );
         if ($post_list->have_posts()) {
?>
<div id="ranking_list<?php echo $i; ?>" class="post_carousel">
 <div class="headline_area">
  <?php if($headline){ ?>
  <h2 class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h2>
  <?php }; ?>
  <?php if($desc){ ?>
  <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
  <?php }; ?>
 </div>
 <div class="post_carousel_type2 owl-carousel">
  <?php
       $rank_num = 1;
       while( $post_list->have_posts() ) : $post_list->the_post();
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
   <?php if ($show_ranking_num == '1'){ ?>
   <div class="rank_num"><?php echo $rank_num; ?></div>
   <?php }; ?>
   <a class="image_link animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
   </a>
   <div class="content <?php if ($show_author != '1'){ echo ' no_author'; }; ?>">
    <?php
         if ($show_category == '1'){
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
          if ($show_author == '1'){
            $author_id = get_the_author_meta('ID');
            $user_data = get_userdata($author_id);
            $author_url = get_author_posts_url($author_id);
     ?>
     <a class="author" href="<?php echo esc_url($author_url); ?>">
      <div class="avatar_area animate_image"><?php echo wp_kses_post(get_avatar($author_id, 140)); ?></div>
      <div class="name"><?php echo esc_html($user_data->display_name ?? ''); ?></div>
     </a>
     <?php }; ?>
    </div>
    <?php if ($show_date == '1'){ ?>
    <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <?php }; ?>
    <?php if ($show_view == '1'){ ?>
    <div class="post_view"><?php echo number_format(esc_html(get_post_views($post->ID,$rank_range))); ?></div>
    <?php }; ?>
   </div>
  </article>
  <?php $rank_num++; endwhile; wp_reset_query(); ?>
 </div><!-- END .post_carousel_type2 -->
</div><!-- END .post_carousel -->
<?php
         };
       }; // END $show_ranking_list
     endfor;
?>

</div><!-- END #ranking_list -->

<?php get_footer(); ?>