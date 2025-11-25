<?php
/*
Template Name:LP page
*/
__('LP page', 'tcd-w');
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
 <a class="animate_item" id="page_contents_link" href="#lp_page_content"></a>
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

<div id="lp_page_content">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <?php
      // コンテンツビルダー
      $lp_content = get_post_meta( $post->ID, 'lp_content', true );
      $content_count = 1;
      if ( $lp_content && is_array( $lp_content ) ) :
        foreach( $lp_content as $key => $content ) :

          // デザインコンテンツ --------------------------------------------------------------------------------
          if ( ($content['cb_content_select'] == 'design_content') && $content['show_content']) {
 ?>
 <div class="design_content num<?php echo $content_count; ?>" id="lp_content_<?php echo $content_count; ?>">

   <?php
        // コンテンツ一覧
        $data_list = isset($content['item_list']) ?  $content['item_list'] : '';
        if (!empty($data_list)) {
          foreach ( $data_list as $key => $value ) :
            $image_id = $value['image'];
            $catch = $value['catch'];
            $desc = $value['desc'];
            $bg_color = $value['bg_color'];
            if($image_id){
              $image = wp_get_attachment_image_src($image_id, 'full');
   ?>
   <div class="item" style="background:<?php echo esc_attr($bg_color); ?>;">

    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>

    <div class="content">
     <div class="content_inner">
      <?php if($catch){ ?>
      <h2 class="catch"><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h2>
      <?php }; ?>
      <?php if($desc){ ?>
      <div class="desc">
       <p><?php echo wp_kses_post(nl2br($desc)); ?></p>
      </div>
      <?php }; ?>
     </div>
    </div>

   </div>
   <?php
            };
          endforeach;
        };
   ?>

 </div><!-- END .design_content -->

 <?php
      // カルーセル --------------------------------------------------------------------------------
      } elseif ( ($content['cb_content_select'] == 'carousel') && $content['show_content']) {
 ?>
 <div class="cb_carousel post_carousel cb_content num<?php echo $content_count; ?>" id="cb_content_<?php echo $content_count; ?>">

 <?php if(!empty($content['headline']) || !empty($content['desc'])) { ?>
 <div class="headline_area">
  <?php if($content['headline']){ ?>
  <h2 class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><span><?php echo wp_kses_post(nl2br($content['headline'])); ?></span></h2>
  <?php }; ?>
  <?php if($content['desc']){ ?>
  <p class="desc"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      if(is_mobile()) {
        $post_num = $content['post_num_mobile'];
      } else {
        $post_num = $content['post_num'];
      }
      $post_type = $content['post_type'];
      $post_order = $content['post_order'];
      if($post_type == 'recent_post'){
        $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order);
      } else {
        $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on', 'orderby' => $post_order );
      }
      $post_list = new wp_query($args);
      if(!$post_list->have_posts()){
        $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num );
        $post_list = new WP_Query($args);
      }
      if($post_list->have_posts()):
 ?>
 <div class="post_carousel_<?php echo esc_attr($content['carousel_type']); ?> owl-carousel">
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
   <div class="content <?php if (!$content['show_author']){ echo ' no_author'; }; ?>">
    <?php
         if ($content['show_category']){
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
          if ($content['show_author']){
            $author_id = get_the_author_meta('ID');
            $user_data = get_userdata($author_id);
            $author_url = get_author_posts_url($author_id);
     ?>
     <a class="author" href="<?php echo esc_url($author_url); ?>">
      <div class="avatar_area animate_image"><?php echo wp_kses_post(get_avatar($author_id, 140)); ?></div>
      <div class="name"><?php echo esc_html($user_data->display_name ?? '' ); ?></div>
     </a>
     <?php }; ?>
    </div>
    <?php if ($content['show_date']){ ?>
    <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <?php }; ?>
   </div>
  </article>
  <?php endwhile; ?>
 </div><!-- END .post_carousel_type1 -->
 <?php
      endif;
      wp_reset_query();
 ?>

</div><!-- END .cb_carousel -->


 <?php
      // フリースペース -----------------------------------------------------------------
      } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content']) {
 ?>
 <div class="lp_content lp_free_space <?php echo esc_attr($content['content_width']); ?> num<?php echo esc_attr($content_count); ?>" id="lp_content_<?php echo $content_count; ?>">

  <div class="lp_free_space_inner" style="width:<?php echo esc_attr($page_content_width); ?>px;">

   <?php if(!empty($content['catch']) || !empty($content['desc'])) { ?>
   <div class="cb_content_header inview<?php if(empty($content['desc'])) { echo ' no_desc'; }; ?>">
    <?php if(!empty($content['catch'])) { ?>
    <h2 class="catch rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h2>
    <?php }; ?>
    <?php if(!empty($content['desc'])) { ?>
    <div class="desc">
     <p><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
    </div>
    <?php }; ?>
   </div>
   <?php }; ?>

   <?php if(!empty($content['content'])) { ?>
   <div class="post_content clearfix inview">
    <?php echo apply_filters('the_content', $content['content'] ); ?>
   </div>
   <?php }; ?>

  </div><!-- END .lp_free_space_inner -->

 </div><!-- END .lp_free_space -->

 <?php
          };
        $content_count++;
        endforeach; // END 並び替え
      endif;
 ?>

 <?php endwhile; endif; ?>

</div><!-- END #lp_page_contents -->
<?php get_footer(); ?>