<?php
     $options = get_design_plus_option();
     get_header();
?>
<div id="index_content_builder">

 <?php
      // 通常のコンテンツを読み込む ------------------------------------------------------------------------------
      if( (!is_mobile() && $options['index_content_type'] == 'type2') || (is_mobile() && $options['mobile_index_content_type'] == 'type3') ){
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        $page_content_width = ($options['page_content_width_type'] == 'type1') ?  ($options['page_content_width'] . 'px') : '100%';
 ?>

 <div id="one_col" class="content_width_<?php echo esc_attr($options['page_content_width_type']); ?>" style="width:<?php echo esc_attr($page_content_width); ?>;">

  <article id="article">
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>
  </article>

 </div><!-- END #one_col -->

 <?php
        endwhile; endif;
      } else {
 ?>

<?php
     // コンテンツビルダー
     if ($options['contents_builder'] || $options['mobile_contents_builder']) :
       $content_count = 1;
       if(is_mobile() && $options['mobile_index_content_type'] == 'type2') {
         $contents_builder = $options['mobile_contents_builder'];
       } else {
         $contents_builder = $options['contents_builder'];
       }
       foreach($contents_builder as $content) :

         // カルーセル --------------------------------------------------------------------------------
         if ( $content['cb_content_select'] == 'carousel' && $content['show_content'] ) {
?>
<div class="cb_carousel post_carousel cb_content num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

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
        $total_post = $post_list->post_count;
 ?>
 <div class="post_carousel_<?php echo esc_attr($content['carousel_type']); ?> <?php if(($content['carousel_type'] == 'type1') && ($total_post < 4)){ echo 'less'; }; ?> owl-carousel <?php if(empty($content['headline']) && empty($content['desc'])) { echo 'no_arrow'; }; ?>">
  <?php
       if($post_num > $total_post) {
          $total_post = $post_num;
       }
       $post_count = 1;
       // native ads --------------
       if($content['show_ads']){
         $banner_list = random_native_ads();
         if(!empty($banner_list)){
           $current_banner = 0;
           $total_banner = count($banner_list);
         }
       }
       while($post_list->have_posts()): $post_list->the_post();
  ?>
  <?php
       // native ads ------------------
       if(!empty($banner_list) && $content['show_ads'] && ($post_count == $content['banner_num']) ){
         $banner_num = $banner_list[$current_banner];
         if($total_banner <= $current_banner+1){
           $current_banner = 0;
         } else {
           $current_banner++;
         }
         $background_color = $options['pr_banner_label_bg_color'.$banner_num];
         $image = wp_get_attachment_image_src( $options['pr_banner_image'.$banner_num], 'size3');
  ?>
  <article class="item ad_item">
   <a class="image_link" href="<?php if($options['pr_banner_url'.$banner_num]) { echo esc_url($options['pr_banner_url'.$banner_num]); }; ?>" <?php if($options['pr_banner_target'.$banner_num]){ echo 'target="_blank"'; }; ?>>
    <div class="image_wrap">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
   </a>
   <div class="content no_author">
    <?php if ( $options['show_pr_banner_label'.$banner_num] && $options['pr_banner_label'.$banner_num] ) { ?>
    <p class="pr_label"><span class="label"><?php echo esc_html($options['pr_banner_label'.$banner_num]); ?></span><span class="line" style="background-color:<?php echo esc_attr($background_color); ?>;"></span></p>
    <?php }; ?>
    <div class="title_area">
     <h3 class="title"><a href="<?php if($options['pr_banner_url'.$banner_num]) { echo esc_url($options['pr_banner_url'.$banner_num]); }; ?>" <?php if($options['pr_banner_target'.$banner_num]){ echo 'target="_blank"'; }; ?>><span><?php echo esc_html($options['pr_banner_title'.$banner_num]); ?></span></a></h3>
    </div>
    <?php if($options['pr_banner_client'.$banner_num]) { ?><p class="client"><?php echo esc_html($options['pr_banner_client'.$banner_num]); ?></p><?php }; ?>
   </div>
  </article>
  <?php $post_count++; }; if($content['show_ads'] && ($post_count > $total_post)){ break; }; // END native ad ?>
  <?php
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
            if(isset($user_data->display_name)){
     ?>
     <a class="author" href="<?php echo esc_url($author_url); ?>">
      <div class="avatar_area animate_image"><?php echo wp_kses_post(get_avatar($author_id, 140)); ?></div>
      <div class="name"><?php echo esc_html($user_data->display_name); ?></div>
     </a>
     <?php }; ?>
     <?php }; ?>
    </div>
    <?php if ($content['show_date']){ ?>
    <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <?php }; ?>
   </div>
  </article>
  <?php $post_count++; endwhile; ?>
 </div><!-- END .post_carousel_type1 -->
 <?php
      endif;
      wp_reset_query();
 ?>

</div><!-- END .cb_carousel -->

<?php
         // タブコンテンツ --------------------------------------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'featured_content' && $content['show_content'] ) {
?>
<div class="cb_featured featured_content cb_content num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <div class="featured_content_wrap">

  <div class="featured_main_content">

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

   <div class="button_list_wrap">
    <div class="button_list">
     <?php
          $post_list_count = 1;
          for ( $i = 1; $i <= 3; $i++ ) :
          if($content['show_post_list'.$i]){
     ?>
     <div class="item<?php if($post_list_count == 1){ echo ' active'; }; ?>" data-postlist-num="post_list<?php echo $i; ?>"><?php echo esc_html($content['post_headline'.$i]); ?></div>
     <?php $post_list_count++; }; endfor; ?>
    </div>
   </div>

   <div class="post_list animation_<?php echo esc_attr($content['post_animation']); ?>">

    <?php
         $post_list_count = 1;
         if(is_mobile()) {
           $post_num = $content['post_num_mobile'];
         } else {
           $post_num = $content['post_num'];
         }
         for ( $i = 1; $i <= 3; $i++ ) :
           if($content['show_post_list'.$i]){
             $post_type = $content['post_type'.$i];
             $post_order = $content['post_order'.$i];
             if($post_type == 'recent_post'){
               $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order );
             } else {
               $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on', 'orderby' => $post_order );
             }
             $post_list = new wp_query($args);
             if($post_list->have_posts()):
               $total_post = $post_list->post_count;
               if($post_num > $total_post) {
                 $total_post = $post_num;
               }
    ?>
    <div class="featured_post post_list<?php echo $i; ?> <?php if($post_list_count == 1){ echo 'active first_post_list'; }; ?>">
     <?php
          $post_count = 1;
          // native ads --------------
          if($content['show_ads'.$i]){
            $banner_list = random_native_ads();
            if(!empty($banner_list)){
              $current_banner = 0;
              $total_banner = count($banner_list);
            }
          }
          while($post_list->have_posts()): $post_list->the_post();
     ?>
     <?php
          // native ads ------------------
          if(!empty($banner_list) && $content['show_ads'.$i] && ($post_count == $content['banner_num'.$i]) ){
            $banner_num = $banner_list[$current_banner];
            if($total_banner <= $current_banner+1){
              $current_banner = 0;
            } else {
              $current_banner++;
            }
            $background_color = $options['pr_banner_label_bg_color'.$banner_num];
            $image = wp_get_attachment_image_src( $options['pr_banner_image'.$banner_num], 'size3');
     ?>
     <article class="item ad_item animate_item">
      <a class="image_link" href="<?php if($options['pr_banner_url'.$banner_num]) { echo esc_url($options['pr_banner_url'.$banner_num]); }; ?>" <?php if($options['pr_banner_target'.$banner_num]){ echo 'target="_blank"'; }; ?>>
       <div class="image_wrap">
        <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
       </div>
      </a>
      <div class="content no_author">
       <?php if ( $options['show_pr_banner_label'.$banner_num] && $options['pr_banner_label'.$banner_num] ) { ?>
       <p class="pr_label"><span class="label"><?php echo esc_html($options['pr_banner_label'.$banner_num]); ?></span><span class="line" style="background-color:<?php echo esc_attr($background_color); ?>;"></span></p>
       <?php }; ?>
       <div class="title_area">
        <h3 class="title"><a href="<?php if($options['pr_banner_url'.$banner_num]) { echo esc_url($options['pr_banner_url'.$banner_num]); }; ?>" <?php if($options['pr_banner_target'.$banner_num]){ echo 'target="_blank"'; }; ?>><span><?php echo esc_html($options['pr_banner_title'.$banner_num]); ?></span></a></h3>
       </div>
      </div>
      <?php if($options['pr_banner_client'.$banner_num]) { ?><p class="client"><?php echo esc_html($options['pr_banner_client'.$banner_num]); ?></p><?php }; ?>
     </article>
     <?php $post_count++; }; if($content['show_ads'.$i] && ($post_count > $total_post)){ break; }; // END native ad ?>
     <?php
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
      <div class="content <?php if (!$content['show_author']){ echo ' no_author'; }; if(!$content['show_date']){ echo ' no_date'; }; ?>">
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
               if(isset($user_data->display_name)){
        ?>
        <a class="author" href="<?php echo esc_url($author_url); ?>">
         <div class="avatar_area animate_image"><?php echo wp_kses_post(get_avatar($author_id, 140)); ?></div>
         <div class="name"><?php echo esc_html($user_data->display_name); ?></div>
        </a>
        <?php }; ?>
        <?php }; ?>
       </div>
      </div>
      <?php if ($content['show_date']){ ?>
      <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php }; ?>
     </article>
     <?php $post_count++; endwhile; ?>
    </div><!-- END .featured_post -->
    <?php
             endif;
             wp_reset_query();
             $post_list_count++;
           };
         endfor;
    ?>

   </div><!-- END .post_list -->

  </div><!-- END .featured_main_content -->

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

</div><!-- END .cb_featured -->

<?php
         // 3カラムコンテンツ --------------------------------------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'trend' && $content['show_content'] ) {
?>
<div class="cb_trend cb_content num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

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

  <div class="trend_wrap">

   <?php
        $post_num = '3';
        for ( $i = 1; $i <= 3; $i++ ) :
          $post_type = $content['post_type'.$i];
          $post_order = $content['post_order'.$i];
          if($post_type == 'recent_post'){
            $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order );
          } else {
            $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on', 'orderby' => $post_order );
          }
          $post_list = new wp_query($args);
          if($post_list->have_posts()):
   ?>
   <div class="post_list <?php if($i == 2){ echo 'type2'; } else { echo 'type1'; }; ?>">
    <?php
         while($post_list->have_posts()): $post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
           } elseif($options['no_image1']) {
             $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
           } else {
             $image = array();
             $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
           }
    ?>
    <article class="item">
     <?php if($i != 2){ ?>
     <a class="image_link animate_background" href="<?php the_permalink(); ?>">
     <?php }; ?>
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
     <?php if($i != 2){ ?>
     </a>
     <?php }; ?>
     <?php
          if (($i == 2) && $content['show_author']){
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
     <div class="content">
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
      <h3 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
      <?php if ($content['show_date']){ ?>
      <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php }; ?>
     </div>
    </article>
    <?php endwhile; ?>
   </div><!-- END .post_list -->
   <?php
          endif;
          wp_reset_query();
        endfor;
   ?>

  </div><!-- END .trend_wrap -->

</div><!-- END .cb_trend -->

<?php
         // カテゴリー記事 --------------------------------------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'category_post' && $content['show_content'] ) {
           $cat_id = (int)$content['cat_id'];
?>
<div class="cb_category_post num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <div class="content_wrap">

  <?php if(!empty($content['headline']) || !empty($content['desc']) || !empty($content['catch']) || !empty($content['link_label'])) { ?>
  <div class="headline_area">
   <?php if($content['headline']){ ?>
   <h2 class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><span><?php echo wp_kses_post(nl2br($content['headline'])); ?></span></h2>
   <?php }; ?>
   <?php if($content['catch']){ ?>
   <p class="catch common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></p>
   <?php }; ?>
   <?php if($content['desc']){ ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
   <?php }; ?>
   <?php if($cat_id && $content['link_label']){ ?>
   <a class="archive_link" href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><?php echo esc_html($content['link_label']); ?></a>
   <?php }; ?>
  </div>
  <?php }; ?>

  <div class="post_list">
   <?php
        if($cat_id){
          if(is_mobile()) {
            $post_num = $content['post_num_mobile'];
          } else {
            $post_num = $content['post_num'];
          }
          $args = array( 'cat' => $cat_id, 'showposts'=> $post_num);
          $post_list = new wp_query($args);
          if($post_list->have_posts()):
            $total_post = $post_list->post_count;
            if($post_num > $total_post) {
              $total_post = $post_num;
            }
            $post_count = 1;
            // native ads --------------
            if($content['show_ads']){
              $banner_list = random_native_ads();
              if(!empty($banner_list)){
                $current_banner = 0;
                $total_banner = count($banner_list);
              }
            }
            while( $post_list->have_posts() ) : $post_list->the_post();
   ?>
   <?php
        // native ads ------------------
        if(!empty($banner_list) && $content['show_ads'] && ($post_count == $content['banner_num']) ){
          $banner_num = $banner_list[$current_banner];
          if($total_banner <= $current_banner+1){
            $current_banner = 0;
          } else {
            $current_banner++;
          }
          $image = wp_get_attachment_image_src( $options['pr_banner_image'.$banner_num], 'size1');
   ?>
   <article class="item ad_item">
    <a class="image_link" href="<?php if($options['pr_banner_url'.$banner_num]) { echo esc_url($options['pr_banner_url'.$banner_num]); }; ?>" <?php if($options['pr_banner_target'.$banner_num]){ echo 'target="_blank"'; }; ?>>
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
    </a>
    <div class="title_area">
     <h3 class="title"><a href="<?php if($options['pr_banner_url'.$banner_num]) { echo esc_url($options['pr_banner_url'.$banner_num]); }; ?>" <?php if($options['pr_banner_target'.$banner_num]){ echo 'target="_blank"'; }; ?>><span><?php echo esc_html($options['pr_banner_title'.$banner_num]); ?></span></a></h3>
     <?php if ( $options['show_pr_banner_label'.$banner_num] && $options['pr_banner_label'.$banner_num] ) { ?>
     <p class="pr_label"><?php echo esc_html($options['pr_banner_label'.$banner_num]); ?></p>
     <?php }; ?>
     <?php if($options['pr_banner_client'.$banner_num]) { ?>
     <p class="client"><?php echo esc_html($options['pr_banner_client'.$banner_num]); ?></p>
     <?php }; ?>
    </div>
   </article>
   <?php $post_count++; }; if($content['show_ads'] && ($post_count > $total_post)){ break; }; // END native ad ?>
   <?php
        if(has_post_thumbnail()) {
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
        } elseif($options['no_image1']) {
          $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
        } else {
          $image = array();
          $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
        }
   ?>
   <article class="item">
    <a class="image_link animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
    </a>
    <div class="title_area">
     <h3 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
     <?php if ($content['show_date']){ ?>
     <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
     <?php }; ?>
    </div>
   </article>
   <?php
            $post_count++; endwhile;
          endif;
          wp_reset_query();
        }; // if has cat_id
   ?>
  </div><!-- END .post_list -->

 </div><!-- END .content_wrap -->

 <?php if($content['bg_use_overlay']){ ?>
 <div class="overlay"></div>
 <?php }; ?>

 <?php
      $bg_image = isset($content['bg_image']) ? wp_get_attachment_image_src( $content['bg_image'], 'full' ) : '';
      $bg_image_mobile = isset($content['bg_image_mobile']) ? wp_get_attachment_image_src( $content['bg_image_mobile'], 'full' ) : '';
      if($bg_image && $content['use_para']) {
 ?>
 <div class="bg_image" data-parallax-image="<?php echo esc_attr($bg_image[0]); ?>" <?php if($bg_image_mobile) { ?>data-parallax-mobile-image="<?php echo esc_attr($bg_image_mobile[0]); ?>"<?php }; ?>></div>
 <?php } elseif($bg_image && !$content['use_para']) { ?>
 <div class="bg_image<?php if(!empty($bg_image_mobile)) { echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>
 <?php if($bg_image_mobile && !$content['use_para']) { ?>
 <div class="bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>

</div><!-- END .cb_category_post -->

 <?php
         // 投稿者一覧 --------------------------------------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'author_list' && $content['show_content'] ) {
?>

 <?php
      $author_list = $content['author_list_order'];
      $total_post = count($author_list);

      if($total_post>0):
 ?>
<div class="cb_author_list post_carousel cb_content num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

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
 <div class="author_list post_carousel_<?php echo esc_attr($content['carousel_type']); ?> <?php if(($content['carousel_type'] == 'type1') && ($total_post < 4)){ echo 'less'; }; ?> owl-carousel <?php if(empty($content['headline']) && empty($content['desc'])) { echo 'no_arrow'; }; ?>">
 <?php
        foreach($author_list as $author_id):
          $author_data = get_userdata($author_id);
          $author_name = $author_data->display_name ?? '';
          $catch = $author_data->catch ?? '';
          $author_url = get_author_posts_url($author_id);
  ?>
  <article class="item">
    <a class="animate_image" href="<?php echo esc_url($author_url); ?>">
     <div class="avatar_area">
      <?php echo wp_kses_post(get_avatar($author_id, 360)); ?>
     </div>
     <h3 class="name"><?php echo esc_html($author_name); ?></h3>
    </a>
    <?php if($catch) { ?>
    <p class="catch"><?php echo esc_html($catch); ?></p>
    <?php }; ?>
  </article>
  <?php endforeach; ?>
 </div><!-- END .post_carousel_type1 -->

</div><!-- END .cb_carousel -->
 <?php
      endif;
      wp_reset_query();
 ?>


 <?php
         // News一覧 --------------------------------------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'news_list' && $content['show_content'] ) {
?>
<div class="cb_news_list cb_content num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

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

 <div class="news_list">
   <?php
      $post_num = is_mobile()? $content['post_num_mobile'] : $content['post_num'];
      $args = array( 'post_type' => 'news', 'posts_per_page' => $post_num );
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
        while($post_list->have_posts()): $post_list->the_post();
   ?>
   <article class="item animate_item">
     <a href="<?php the_permalink(); ?>">
      <div class="news_archive_item_content">
        <?php if ($content['show_date']){ ?>
       <ul class="news_post_meta">
          <li><time class="date entry-date" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
        </ul>
      <?php }; ?>
       <h3 class="title"><span><?php the_title(); ?></span></h3>
       </div>
    </a>
   </article>
   <?php
        endwhile;
      endif;
   ?>
 </div>
</div>


<?php
     // フリースペース -----------------------------------------------------
     } elseif ( $content['cb_content_select'] == 'free_space' && $content['show_content'] ) {
       if (!empty($content['free_space'])) {
?>
<div class="cb_content cb_free_space num<?php echo $content_count; ?> <?php echo esc_attr($content['content_width']); ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

  <?php if(!empty($content['headline']) || !empty($content['desc'])) { ?>
  <div class="cb_content_header inview">
   <?php if(!empty($content['headline'])) { ?>
   <h2 class="catch common_headline rich_font_<?php echo esc_html($options['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['headline'])); ?></h2>
   <?php }; ?>
   <?php if(!empty($content['desc'])) { ?>
   <div class="desc">
    <p><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
   </div>
   <?php }; ?>
  </div>
  <?php }; ?>

  <div class="post_content clearfix inview">
   <?php echo apply_filters('the_content', $content['free_space'] ); ?>
  </div>

</div><!-- END .cb_free_space -->
<?php
           };
         };
       $content_count++;
       endforeach;
     endif;

// コンテンツビルダーここまで

     }; // END index_content_type
?>
</div><!-- END #index_content_builder -->
<?php get_footer(); ?>