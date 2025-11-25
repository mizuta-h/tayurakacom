<?php $options = get_design_plus_option(); ?>
<!DOCTYPE html>
<html class="pc" <?php language_attributes(); ?>>
<?php if($options['use_ogp']) { ?>
<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb#">
<?php } else { ?>
<head>
<?php }; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width">
<title><?php wp_title('|', true, 'right'); ?></title>
<meta name="google-site-verification" content="pJPtUeiet-Xq7h3ZEJMHzpxhEUCHOFE5siMuocJ6zEU" />
<meta name="description" content="<?php seo_description(); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_enqueue_style('style', get_stylesheet_uri(), false, version_num(), 'all'); wp_enqueue_script( 'jquery' ); if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>	
<?php
     if ($options['show_load_screen'] == 'type2') {
       if(is_front_page()){
         load_icon();
       }
     } elseif ($options['show_load_screen'] == 'type3') {
       if(is_front_page() || is_home() || is_archive()){
         load_icon();
       }
     };
?>

 <?php // side menu ---------------------------------------------------------------- ?>
 <div id="side_menu" class="side_menu_<?php echo esc_attr($options['side_menu_type']); if( $options['show_load_screen'] == 'type3' ){ echo ' no_loading_screen'; }; ?>">
  <div id="side_menu_button">
   <a href="#"><span></span><span></span><span></span></a>
  </div>
  <?php if ( ($options['side_menu_type'] == 'type2') && has_nav_menu('global-menu') ) { ?>
  <div id="side_menu_content">
   <nav>
    <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
   </nav>
  </div>
  <?php }; ?>
  <?php
       // side desc ------------------------------------
       if($options['show_site_description']) {
         $desc = get_bloginfo('description');
         if($desc){
  ?>
  <p id="site_desc"><?php echo esc_html($desc); ?></p>
  <?php
         };
       };
  ?>
  <?php
       // side sns ------------------------------------
       if($options['show_side_sns']) {
         $facebook = $options['side_facebook_url'];
         $twitter = $options['side_twitter_url'];
         $insta = $options['side_instagram_url'];
         $tiktok = $options['side_tiktok_url'];
         $pinterest = $options['side_pinterest_url'];
         $youtube = $options['side_youtube_url'];
         $contact = $options['side_contact_url'];
         $show_rss = $options['side_show_rss'];
  ?>
  <ul id="side_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['side_sns_color_type']); ?>">
   <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
   <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow noopener" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
   <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
   <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
   <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
   <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
   <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
   <?php if($show_rss) { ?><li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
  </ul>
  <?php }; ?>
 </div><!-- END #side_menu -->
 <?php if ($options['side_menu_type'] == 'type1') { ?>
 <div id="mega_menu">
  <div id="mega_menu_mobile_header">
   <div id="mega_menu_mobile_header_top">
    <div class="mobile_close_button"></div>
   </div>
   <?php if (has_nav_menu('global-menu')) { ?>
   <div id="mega_menu_mobile_global_menu">
    <nav>
     <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '', 'depth' => '1' ) ); ?>
    </nav>
   </div>
   <?php }; ?>
  </div>
  <div class="close_button"></div>
  <div id="mega_menu_inner">

   <?php
        // navigation menu -----------------------------------------------------------------------
        if($options['show_navi_menu']){
   ?>
   <div id="navi_menu_global_menu" class="mega_content">
   <?php if($options['navi_menu_headline'] || $options['navi_menu_sub_headline']){ ?>
    <div class="headline_area">
    <?php if($options['navi_menu_headline']){ ?>
     <div class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><span><?php echo wp_kses_post(nl2br($options['navi_menu_headline'])); ?></span></div>
     <?php }; ?>
     <?php if($options['navi_menu_sub_headline']){ ?>
     <p class="desc"><?php echo wp_kses_post(nl2br($options['navi_menu_sub_headline'])); ?></p>
     <?php }; ?>
    </div>
    <?php }; ?>
    <nav>
     <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '', 'depth' => '1' ) ); ?>
    </nav>
   </div>
   <?php }; ?>

   <?php
        // free space 1 -----------------------------------------------------------------------
        if($options['show_free_space1']){
   ?>
   <div id="mega_content_free_space1" class="mega_content">
   <?php if($options['navi_menu_free_space1_headline']  || ptions['navi_menu_free_space1_sub_headline']){ ?>
    <div class="headline_area">
    <?php if($options['navi_menu_free_space1_headline']){ ?>
     <div class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><span><?php echo wp_kses_post(nl2br($options['navi_menu_free_space1_headline'])); ?></span></div>
     <?php }; ?>
     <?php if($options['navi_menu_free_space1_sub_headline']){ ?>
     <p class="desc"><?php echo wp_kses_post(nl2br($options['navi_menu_free_space1_sub_headline'])); ?></p>
     <?php }; ?>
    </div>
    <?php }; ?>
    <div class="post_content clearfix inview">
      <?php echo apply_filters('the_content', $options['navi_menu_free_space1'] ); ?>
    </div>
   </div>
   <?php }; ?>

   <?php
        // category list -----------------------------------------------------------------------
        if($options['show_mega_category']){
   ?>
   <div id="mega_category" class="mega_content">
   <?php if($options['mega_category_headline'] || $options['mega_category_sub_headline']){ ?>
    <div class="headline_area">
    <?php if($options['mega_category_headline']){ ?>
     <div class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><span><?php echo wp_kses_post(nl2br($options['mega_category_headline'])); ?></span></div>
     <?php }; ?>
     <?php if($options['mega_category_sub_headline']){ ?>
     <p class="desc"><?php echo wp_kses_post(nl2br($options['mega_category_sub_headline'])); ?></p>
     <?php }; ?>
    </div>
    <?php }; ?>
    <div class="post_list_wrap">
     <div class="post_list owl-carousel">
      <?php
           $post_cats = get_terms("category",'orderby=term_order&hide_empty=true');
           if ( $post_cats && ! is_wp_error( $post_cats ) ) {
             foreach( $post_cats as $cat ){
               $cat_id = $cat->term_id;
               if($options['cat'.$cat_id]){
                 $args = array( 'cat' => $cat_id, 'showposts'=> 1);
                 $category_data = get_term($cat_id,'category');
                 $cat_name = $category_data->name;
                 $cat_meta_data = get_option( 'taxonomy_' . $cat_id, array() );
                 $color1 =  isset($cat_meta_data['color1']) ? $cat_meta_data['color1'] : '#b43936';
                 $post_list = new wp_query($args);
                 if($post_list->have_posts()):
                   while( $post_list->have_posts() ) : $post_list->the_post();
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
       <div class="category_name"><a style="color:<?php echo esc_attr($color1); ?>;" href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><?php echo esc_html($cat_name); ?></a></div>
       <a class="image_link animate_background" href="<?php the_permalink(); ?>">
        <div class="image_wrap">
         <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
        </div>
       </a>
       <div class="content <?php if (!$options['mega_category_show_author']){ echo ' no_author'; }; ?>">
        <div class="title_area">
         <p class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></p>
         <?php
              if ($options['mega_category_show_author']){
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
        <?php if ($options['mega_category_show_date']){ ?>
        <time class="date entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
        <?php }; ?>
       </div>
      </article>
      <?php
                   endwhile;
                 endif;
                 wp_reset_query();
               }; // if has cat_id
             };
           };
      ?>
     </div><!-- END .post_list -->
    </div><!-- END .post_list_wrap -->
   </div><!-- END #mega_category -->
   <?php }; ?>

   <?php
        // tag list -----------------------------------------------------------------------
        if($options['show_mega_tag']){
   ?>
   <div id="mega_tag" class="mega_content">
   <?php if($options['mega_tag_headline'] || $options['mega_tag_sub_headline']){ ?>
    <div class="headline_area">
    <?php if($options['mega_tag_headline']){ ?>
     <div class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><span><?php echo wp_kses_post(nl2br($options['mega_tag_headline'])); ?></span></div>
     <?php }; ?>
     <?php if($options['mega_tag_sub_headline']){ ?>
     <p class="desc"><?php echo wp_kses_post(nl2br($options['mega_tag_sub_headline'])); ?></p>
     <?php }; ?>
    </div>
    <?php }; ?>
    <?php
         $tag_args = array(
          'orderby' => 'name',
          'order' => 'ASC',
         ); 
         $post_tags = get_tags($tag_args);
         if ( $post_tags && ! is_wp_error( $post_tags ) ) {
    ?>
    <div class="tag_list">
     <ul>
      <?php
           foreach ( $post_tags as $tag ):
             $tag_id = $tag->term_id;
             $tag_name = $tag->name;
             $tag_url = get_tag_link($tag_id);
             if($options['tag'.$tag_id]){
      ?>
      <li><a href="<?php echo esc_url($tag_url); ?>"><?php echo esc_html($tag_name); ?></a></li>
      <?php
             };
           endforeach;
      ?>
     </ul>
    </div>
    <?php }; ?>
   </div><!-- END #mega_tag -->
   <?php }; ?>

   <?php
        // free space 2 -----------------------------------------------------------------------
        if($options['show_free_space2']){
   ?>
   <div id="mega_content_free_space2" class="mega_content">
   <?php if($options['navi_menu_free_space2_headline'] || $options['navi_menu_free_space2_sub_headline']){ ?>
    <div class="headline_area">
    <?php if($options['navi_menu_free_space2_headline']){ ?>
     <div class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><span><?php echo wp_kses_post(nl2br($options['navi_menu_free_space2_headline'])); ?></span></div>
     <?php }; ?>
     <?php if($options['navi_menu_free_space2_sub_headline']){ ?>
     <p class="desc"><?php echo wp_kses_post(nl2br($options['navi_menu_free_space2_sub_headline'])); ?></p>
     <?php }; ?>
    </div>
    <?php }; ?>
    <div class="post_content clearfix inview">
      <?php echo apply_filters('the_content', $options['navi_menu_free_space2'] ); ?>
    </div>
   </div>
   <?php }; ?>

  </div>
 </div>
 <?php }; ?>
 <?php if(!(is_404() || (is_search() && ( !have_posts() || empty( get_search_query() ))))): ?>
 <?php
      // Message --------------------------------------------------------------------
      if($options['show_header_message'] && $options['header_message']) {
        $message = $options['header_message'];
        $url = $options['header_message_url'];
        $target = $options['header_message_target'];
        if( !is_page() || is_front_page() || (get_post_meta($post->ID, 'page_hide_header_message', true)) == 'show'){
 ?>
 <div id="header_message" class="show_close_button" <?php if(isset($_COOKIE['close_header_message'])) { echo 'style="display:none;"'; }; ?>>
  <div class="post_content clearfix">
  <?php if($url){ ?>
            <a href="<?php echo esc_url($url); ?>"<?php if($target){ echo ' target="_blank" rel="nofollow noopener"'; }; ?> class="label"><?php echo wp_kses_post(nl2br($message)); ?></a>
        <?php }else{ ?>
            <p class="label"><?php echo wp_kses_post(nl2br($message)); ?></p>
        <?php } ?>
  </div>
  <div id="close_header_message"></div>
 </div>
 <?php };?>
 <?php };?>
 <?php endif;// END 404 ?>
 <?php if( is_page() && get_post_meta($post->ID, 'page_hide_header', true) ) { } else { ?>
 <header id="header" <?php if( $options['show_load_screen'] == 'type3' ){ echo 'class="no_loading_screen"'; }; ?>>
  <?php
       // Logo --------------------------------------------------------------------
  ?>
  <div id="header_logo">
   <?php header_logo(); ?>
  </div>
  <?php
       // bread crumb --------------------------------------------------------------------
       if($options['show_header_breadcrumb_link']) {
         if(!is_front_page()) {
           get_template_part('template-parts/breadcrumb');
         };
       };
  ?>
   <?php if(!(is_search() && ( !have_posts() || empty( get_search_query() )))): ?>
  <?php
       // Search form --------------------------------------------------------------------
       if( $options['show_header_search']) {
  ?>
  <div id="header_search">
   <div id="mobile_header_search_button"></div>
   <form role="search" method="get" id="header_searchform" action="<?php echo esc_url(home_url()); ?>">
    <div class="input_area"><input type="text" value="" id="header_search_input" name="s" autocomplete="off"></div>
    <div class="button"><label for="header_search_button"></label><input type="submit" id="header_search_button" value=""></div>
    <div id="mobile_header_search_close_button"></div>
   </form>
  </div>
  <?php }; ?>
  <?php endif;// END search ?>
  <a id="global_menu_button" href="#"><span></span><span></span><span></span></a>
 </header>

 <?php }; // END hide header ?>
<div id="container" <?php if( $options['show_load_screen'] == 'type3' ){ echo 'class="no_loading_screen"'; }; ?>>

 <?php
      //  Front page -------------------------------------------------------------------------
      if(is_front_page()) {

        $index_slider = '';
        $display_header_content = '';

        if(is_mobile() && ($options['mobile_show_index_slider'] == 'type2')){
          $device = 'mobile_';
        } else {
          $device = '';
        }

        if(!is_mobile() && $options['show_index_slider']) {
          $index_slider = $options['index_slider'];
          $display_header_content = 'show';
        } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type2') ) {
          $index_slider = $options['mobile_index_slider'];
          $display_header_content = 'show';
        } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type1') ) {
          $index_slider = $options['index_slider'];
          $display_header_content = 'show';
        }

        //  Header slider -------------------------------------------------------------------------
        if($display_header_content == 'show'){
 ?>
 <div id="header_slider_wrap" class="<?php if($options[$device.'index_slider_type'] == 'type1') { echo 'index_slider_type1'; } else { echo 'index_slider_type2'; }; if($options[$device.'index_slider_type'] == 'type3') { echo ' index_slider_type3'; }; ?>">
  <div id="header_slider">
   <?php
        // Post slider --------------------------------
        if($options[$device.'index_slider_type'] == 'type1'){
          $post_num = $options[$device.'index_post_slider_post_num'];
          $post_type = $options[$device.'index_post_slider_post_type'];
          $post_order = $options[$device.'index_post_slider_post_order'];
          if($post_type == 'recent_post'){
            $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order);
          } else {
            $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on', 'orderby' => $post_order );
          }
          $post_list = new wp_query($args);
          $slider_item_total = $post_list->post_count;
          $i = 1;
          if($post_list->have_posts()):
            while($post_list->have_posts()): $post_list->the_post();
              $featured_video_url = null;
              $featured_video_mime = null;
              if ( $post->tcd_featured_video && auto_play_movie() ) {
                $featured_video_url = wp_get_attachment_url( $post->tcd_featured_video );
                $featured_video_mime = get_post_mime_type( $post->tcd_featured_video );
              }
              if ( ! $featured_video_url ) {
                if(has_post_thumbnail()) {
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                } elseif($options['no_image1']) {
                  $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
                } else {
                  $image = array();
                  $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
                }
              }
   ?>
   <div class="item <?php echo $featured_video_url ? 'video' : 'image_item'; ?> post_item item<?php echo $i; ?> <?php if($i == 1){ echo 'first_item'; }; ?> slick-slide">

    <div class="progress_bar"><div class="bar"></div></div>

    <?php if ( $featured_video_url ) { ?>
    <div class="video_wrap image_wrap">
     <video class="bg_video" preload="auto" muted playsinline>
      <source src="<?php echo esc_url( $featured_video_url ); ?>" type="<?php echo esc_attr( $featured_video_mime ); ?>">
     </video>
    </div>
    <?php } else { ?>
    <div class="image_wrap">
     <div class="bg_image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
    <?php } ?>

    <div class="animate_item <?php if($i == 1){ echo 'first_animate_item'; }; ?>">

     <div class="content <?php if (!$options['index_post_slider_show_author']){ echo ' no_author'; }; ?>">
      <div class="content_inner">
       <?php
            if ($options[$device.'index_post_slider_show_category']){
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
       <h2 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
       <?php if ($options[$device.'index_post_slider_show_date']){ ?>
       <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
       <?php
            if ($options[$device.'index_post_slider_show_update']){
              $post_date = get_the_time('Ymd',$post->ID);
              $modified_date = get_the_modified_date('Ymd',$post->ID);
              if($post_date < $modified_date){
       ?>
       <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
       <?php
              };
            };
       ?>
       <?php }; ?>
      </div>
      <?php
           if ($options[$device.'index_post_slider_show_author']){
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

    </div><!-- .animate_item -->

   </div><!-- END .item -->
   <?php
            $i++; endwhile;
          endif;
          wp_reset_query();

        // Other slider --------------------------------
        } else {

          $i = 1;
          $slider_item_total = count($index_slider);
          $post_ids = array();
          foreach ( $index_slider as $key => $value ) :
            $item_type = $value['slider_type'];
            if(is_mobile() && ($options['mobile_show_index_slider'] == 'type2') ) {
              $image = wp_get_attachment_image_src( $value['image'], 'full');
              $image_mobile = '';
              $desc_mobile = '';
            } else {
              $image = wp_get_attachment_image_src( $value['image'], 'full');
              $image_mobile = wp_get_attachment_image_src( $value['image_mobile'], 'full');
              $desc_mobile = $value['desc_mobile'];
            }
            $video = $value['video'];
            $youtube_url = $value['youtube'];

            // if item type is post
            if($item_type == 'type4'){
              $post_type = $value['post_type'];
              $post_order = $value['post_order'];
              if($post_type == 'recent_post'){
                $args = array( 'post_type' => 'post', 'posts_per_page' => 1, 'post__not_in' => $post_ids, 'orderby' => $post_order);
              } else {
                $args = array( 'post_type' => 'post', 'posts_per_page' => 1, 'meta_key' => $post_type, 'meta_value' => 'on', 'post__not_in' => $post_ids, 'orderby' => $post_order );
              }
              $post_list = new wp_query($args);
              if($post_list->have_posts()):
                while($post_list->have_posts()): $post_list->the_post();
                  $current_post_id = $post->ID;
                  array_push($post_ids,$current_post_id);
                  $featured_video_url = null;
                  $featured_video_mime = null;
                  if ( $post->tcd_featured_video && auto_play_movie() ) {
                    $featured_video_url = wp_get_attachment_url( $post->tcd_featured_video );
                    $featured_video_mime = get_post_mime_type( $post->tcd_featured_video );
                  }
                  if ( ! $featured_video_url ) {
                    if(has_post_thumbnail()) {
                      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                    } elseif($options['no_image1']) {
                      $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
                    } else {
                      $image = array();
                      $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
                    }
                  }
   ?>
   <div class="item <?php echo $featured_video_url ? 'video' : 'image_item'; ?> post_item item<?php echo $i; ?> <?php if($i == 1){ echo 'first_item'; }; ?> slick-slide">

    <?php if($slider_item_total != 1) { ?><div class="progress_bar"><div class="bar"></div></div><?php }; ?>

    <div class="animate_item <?php if($i == 1){ echo 'first_animate_item'; }; ?>">

     <?php
          if (($options['index_slider_type'] == 'type3') && $value['post_show_author']){
            $author_id = get_the_author_meta('ID');
            $user_data = get_userdata($author_id);
            $author_url = get_author_posts_url($author_id);
     ?>
     <a class="author" href="<?php echo esc_url($author_url); ?>">
      <div class="avatar_area animate_image"><?php echo wp_kses_post(get_avatar($author_id, 140)); ?></div>
      <div class="name"><?php echo esc_html($user_data->display_name); ?></div>
     </a>
     <?php }; ?>

     <div class="content <?php if (!$value['post_show_author']){ echo ' no_author'; }; ?>">
      <div class="content_inner">
       <?php
            if ($value['post_show_category']){
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
       <h2 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
       <?php if ($value['post_show_date']){ ?>
       <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
       <?php
            if ($value['post_show_update']){
              $post_date = get_the_time('Ymd',$post->ID);
              $modified_date = get_the_modified_date('Ymd',$post->ID);
              if($post_date < $modified_date){
       ?>
       <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
       <?php
              };
            };
       ?>
       <?php }; ?>
      </div>
      <?php
           if (($options['index_slider_type'] == 'type2') && $value['post_show_author']){
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

    </div><!-- .animate_item -->

    <?php if($value['use_overlay'] == 1) { ?><div class="overlay"></div><?php }; ?>

    <?php if ( $featured_video_url ) { ?>
    <div class="video_wrap image_wrap">
     <video class="bg_video" preload="auto" muted playsinline>
      <source src="<?php echo esc_url( $featured_video_url ); ?>" type="<?php echo esc_attr( $featured_video_mime ); ?>">
     </video>
    </div>
    <?php } else { ?>
    <div class="image_wrap">
     <div class="bg_image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
    <?php } ?>

   </div>
   <?php
                endwhile;
              endif;
              wp_reset_query();

            // if item type is not post
            } else {
   ?>
   <div class="item <?php if( ($item_type == 'type2') && $video && auto_play_movie() ) { echo 'video'; } elseif( ($item_type == 'type3') && $youtube_url && auto_play_movie() ) { echo 'youtube'; } else { echo 'image_item'; }; ?> item<?php echo $i; ?> <?php if($i == 1){ echo 'first_item'; }; ?> slick-slide">

    <div class="caption">

     <?php if(!empty($value['catch'])){ ?>
     <h2 class="animate_item <?php if($i == 1){ echo 'first_animate_item'; }; ?> catch rich_font_<?php echo esc_attr($value['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($value['catch'])); ?></h2>
     <?php }; ?>

     <?php if(!empty($value['desc'])){ ?>
     <div class="animate_item <?php if($i == 1){ echo 'first_animate_item'; }; ?> desc">
      <p<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($value['desc'])); ?></p>
      <?php if($desc_mobile) { ?><p class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p><?php }; ?>
     </div>
     <?php }; ?>

     <?php if($value['show_button']){ ?>
     <div class="design_button2 <?php echo esc_attr($value['button_type']); ?> shape_<?php echo esc_attr($value['button_shape']); ?> animate_item <?php if($i == 1){ echo 'first_animate_item'; }; ?>">
      <a href="<?php echo esc_attr($value['button_url']); ?>" <?php if($value['button_target']){ echo 'target="_blank" rel="nofollow noopener"'; }; ?>><span><?php echo esc_html($value['button_label']); ?></span></a>
     </div>
     <?php }; ?>

    </div><!-- END .caption -->

    <?php if($value['use_overlay'] == 1) { ?><div class="overlay"></div><?php }; ?>

    <?php if( ($item_type == 'type2') && $video && auto_play_movie() ) { ?>
    <video class="video_wrap video_media" preload="auto" muted playsinline <?php if($slider_item_total == 1) { echo "loop"; }; ?>>
     <source src="<?php echo esc_url(wp_get_attachment_url($video)); ?>" type="<?php echo esc_attr( get_post_mime_type( $video ) ); ?>" />
    </video>
    <?php
         } elseif( ($item_type == 'type3') && $youtube_url && auto_play_movie() ) {
           if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $youtube_url, $matches)) {
    ?>
    <div class="video_wrap youtube_wrap">
     <div class="youtube_inner">
      <iframe id="youtube-player-<?php echo $i; ?>" class="youtube-player slide-youtube" src="https://www.youtube.com/embed/<?php echo esc_attr($matches[1]); ?>?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&<?php if($slider_item_total > 1) { echo "loop=0"; } else { echo "playlist=" . esc_attr($matches[1]); }; ?>&playsinline=1" frameborder="0"></iframe>
     </div>
    </div>
    <?php
           };
         } else {
    ?>
    <?php if($image) { ?><div class="bg_image <?php if($image_mobile) { echo 'pc'; }; ?>" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"></div><?php }; ?>
    <?php if($image_mobile) { ?><div class="bg_image mobile" style="background:url(<?php echo esc_attr($image_mobile[0]); ?>) no-repeat center top; background-size:cover;"></div><?php }; ?>
    <?php }; ?>

   </div><!-- END .item -->
   <?php
            }; // END item type
          $i++;
          endforeach;

        }; // END index_slider_type
   ?>

   <?php if($slider_item_total > 2){ ?>
   <div class="carousel_arrow next_item"></div>
   <div class="carousel_arrow prev_item"></div>
   <?php }; ?>

  </div><!-- END #header_slider -->

  <?php
       // header content type3 -------------------------------
       if ($options[$device.'index_slider_type'] == 'type3'){
         $post_type = $options[$device.'index_header_content_type3_post_type'];
         $post_order = $options[$device.'index_header_content_type3_post_order'];
         if($post_type == 'recent_post'){
           $args = array( 'post_type' => 'post', 'posts_per_page' => 2, 'orderby' => $post_order);
         } else {
           $args = array( 'post_type' => 'post', 'posts_per_page' => 2, 'meta_key' => $post_type, 'meta_value' => 'on', 'orderby' => $post_order );
         }
         $post_list = new wp_query($args);
         if($post_list->have_posts()):
  ?>
  <div id="header_content_post_list">
   <?php
           while($post_list->have_posts()): $post_list->the_post();
             $current_post_id = $post->ID;
             array_push($post_ids,$current_post_id);
             if(has_post_thumbnail()) {
               $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
             } elseif($options['no_image1']) {
               $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
             } else {
               $image = array();
               $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
             }
   ?>
   <div class="item">

    <?php
         if ($options[$device.'index_header_content_type3_show_author']){
           $author_id = get_the_author_meta('ID');
           $user_data = get_userdata($author_id);
           $author_url = get_author_posts_url($author_id);
    ?>
    <a class="author" href="<?php echo esc_url($author_url); ?>">
     <div class="avatar_area animate_image"><?php echo wp_kses_post(get_avatar($author_id, 140)); ?></div>
     <div class="name"><?php echo esc_html($user_data->display_name); ?></div>
    </a>
    <?php }; ?>
    <div class="content">
     <div class="content_inner">
      <?php
           if ($options[$device.'index_header_content_type3_show_category']){
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
      <h2 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
      <?php if ($options[$device.'index_header_content_type3_show_date']){ ?>
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php
           if ($options[$device.'index_header_content_type3_show_update']){
             $post_date = get_the_time('Ymd',$post->ID);
             $modified_date = get_the_modified_date('Ymd',$post->ID);
             if($post_date < $modified_date){
      ?>
      <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
      <?php
             };
           };
      ?>
      <?php }; ?>
     </div>
    </div>
    <div class="image_wrap">
     <div class="image bg_image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
    <?php if($options[$device.'index_header_content_type3_use_overlay'] == 1) { ?><div class="overlay"></div><?php }; ?>
   </div>
   <?php endwhile; ?>
  </div><!-- END #header_content_post_list -->
  <?php
         endif;
         wp_reset_query();
       };
   ?>

 </div><!-- END #header_slider_wrap -->
 <?php
        }; // END display_header_content

      }; // END front page
 ?>

