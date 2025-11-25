<?php
     $options = get_design_plus_option();
     global $post;
?>
<div id="bread_crumb">
 <ul class="clearfix" itemscope itemtype="https://schema.org/BreadcrumbList">
 <?php
     // お知らせアーカイブ -----------------------
     if(is_post_type_archive('news')) {
 ?>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
  <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span><meta itemprop="position" content="2"></li>
 <?php
     // お知らせ詳細 -----------------------
     } elseif(is_singular('news')) {
       $category = wp_get_post_terms( $post->ID, 'news_category' , array( 'orderby' => 'term_order' ));
 ?>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span></a><meta itemprop="position" content="2"></li>
  <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
  <?php
       // Search -----------------------
       }elseif(is_search()) {
  ?>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
  <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php _e('Search result','tcd-w'); ?></span><meta itemprop="position" content="2"></li>
  <?php
       // Blog page -----------------------
       } elseif(is_home()) {
  ?>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
  <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span><meta itemprop="position" content="2"></li>
  <?php
       // Author archive page -----------------------
       } elseif(is_author()) {
         $author_info = $wp_query->get_queried_object();
         $author_id = $author_info->ID;
         $user_data = get_userdata($author_id);
         $title = $user_data->display_name;
  ?>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
  <?php if ($options['show_author_archive_page_link'] && $options['archive_page_link_url']) { ?>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url($options['archive_page_link_url']); ?>"><span itemprop="name"><?php echo esc_html($options['archive_page_link_label']); ?></span></a><meta itemprop="position" content="2"></li>
  <?php } else { ?>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span></a><meta itemprop="position" content="2"></li>
  <?php }; ?>
  <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($title); ?></span><meta itemprop="position" content="3"></li>
  <?php
       // Category, Tag , Archive page -----------------------
       } elseif(is_category() || is_tag() || is_day() || is_month() || is_year()) {
         if (is_category()) {
           $title = single_cat_title('', false);
         } elseif( is_tag() ) {
           $title = single_tag_title('', false);
         } elseif( is_author() ) {
           $author_info = $wp_query->get_queried_object();
           $author_id = $author_info->ID;
           $user_data = get_userdata($author_id);
           $title = $user_data->display_name;
         } elseif (is_day()) {
           $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('F jS, Y', 'tcd-w')) );
         } elseif (is_month()) {
           $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('F, Y', 'tcd-w')) );
         } elseif (is_year()) {
           $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('Y', 'tcd-w')) );
         };
  ?>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span></a><meta itemprop="position" content="2"></li>
  <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($title); ?></span><meta itemprop="position" content="3"></li>
  <?php
       //  Page -----------------------
       } elseif(is_page()) {
          $ancestors_ids = array_reverse(get_post_ancestors( $post ));
          $content_num = 2;
   ?>
   <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
   <?php
        if(!empty($ancestors_ids)){
          foreach($ancestors_ids as $page_id):
   ?>
   <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink($page_id)); ?>"><span itemprop="name"><?php echo esc_html(get_the_title($page_id)); ?></span></a><meta itemprop="position" content="<?php echo esc_attr($content_num); ?>"></li>
   <?php
            $content_num++;
          endforeach;
        };
   ?>
   <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="<?php echo esc_attr($content_num); ?>"></li>  
  <?php
       //  404 -----------------------
       } elseif(is_404()) {
  ?>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
  <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php if($options['page_404_catch']){ echo esc_html($options['page_404_catch']); } else { echo '404 NOT FOUND'; }; ?></span><meta itemprop="position" content="2"></li>
  <?php
       // Other page -----------------------
       } else {
       $category = get_the_category();
  ?>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
  <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span></a><meta itemprop="position" content="2"></li>
  <?php if($category) { ?>
  <li class="category" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
   <?php
        $count=1;
        foreach ($category as $cat) {
   ?>
   <a itemprop="item" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><span itemprop="name"><?php echo esc_html($cat->name); ?></span></a>
   <?php $count++; } ?>
   <meta itemprop="position" content="3">
  </li>
  <?php }; ?>
  <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="4"></li>
  <?php }; ?>
 </ul>
</div>
