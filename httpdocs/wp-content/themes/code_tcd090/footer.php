<?php $options = get_design_plus_option(); ?>
<?php if(!(is_404() || (is_search() && ( !have_posts() || empty( get_search_query() ))))): ?>
 <?php
      if(is_page()){ 
        $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true);
      } else {
        $page_hide_footer = '';
      }
      if(!$page_hide_footer){
 ?>

 <?php
      // Banner content --------------------------------------------------------------------
      if( $options['show_footer_banner'] ) {
       $banners = array();
       for ( $i = 1; $i <= 5; $i++ ) :
         if($options['show_footer_banner'.$i]) {
           array_push($banners,$i);
         };
       endfor;
       if(!empty($banners)){
         $banners_total = count($banners);
         if($banners_total > 3){
           shuffle($banners);
         }
 ?>
 <div id="footer_banner" class="<?php if($banners_total == 1){ echo 'type1'; } elseif($banners_total == 2) { echo 'type2'; } else { echo 'type3';}; ?>">
  <?php
       for ( $i = 0; $i <= 2; $i++ ) :
         if(isset($banners[$i])){
           $banner_num = $banners[$i];
           if($options['show_footer_banner'.$banner_num]) {
             $image = wp_get_attachment_image_src( $options['footer_banner_image'.$banner_num], 'full' );
             if($image) {
  ?>
  <div class="item">
   <a class="link animate_background" href="<?php echo esc_url($options['footer_banner_url'.$banner_num]); ?>">
    <div class="image_wrap">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
    <div class="title_area">
     <p class="title rich_font_<?php echo esc_attr($options['footer_banner_font_type']); ?>"><?php echo esc_html($options['footer_banner_title'.$banner_num]); ?></p>
     <?php if($options['footer_banner_desc'.$banner_num]) { ?><p class="desc"><?php echo wp_kses_post(nl2br($options['footer_banner_desc'.$banner_num])); ?></p><?php }; ?>
    </div>
   </a>
  </div>
  <?php
             };
           };
         };
       endfor;
  ?>
 </div><!-- END #footer_banner -->
 <?php }; }; ?>

 <?php }; // END hide footer ?>

 <footer id="footer">

  <?php
       if(!$page_hide_footer){
  ?>

  <?php
       // logo area -----------------------------------------------------
       if( $options['show_footer_logo'] || $options['show_footer_sns'] || has_nav_menu('footer-menu') ) {
  ?>
  <div id="footer_top">
   <?php
        // logo ------------------------
        if( $options['show_footer_logo']) {
   ?>
   <div id="footer_logo">
    <?php footer_logo(); ?>
   </div>
   <?php }; ?>
   <?php
        // footer sns ------------------------------------
        if($options['show_footer_sns']) {
          $facebook = $options['footer_facebook_url'];
          $twitter = $options['footer_twitter_url'];
          $insta = $options['footer_instagram_url'];
          $tiktok = $options['footer_tiktok_url'];
          $pinterest = $options['footer_pinterest_url'];
          $youtube = $options['footer_youtube_url'];
          $contact = $options['footer_contact_url'];
          $show_rss = $options['footer_show_rss'];
   ?>
   <ul id="footer_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['footer_sns_color_type']); ?>">
    <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
    <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow noopener" target="_blank" title="Tiktok"><span>Tiktok</span></a></li><?php }; ?>
    <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
    <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
    <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
    <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
    <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
    <?php if($show_rss) { ?><li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
   </ul>
   <?php }; ?>
   <?php
        // footer menu ------------------------------------------------------
        if (has_nav_menu('footer-menu')) {
   ?>
   <div id="footer_menu">
    <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu' , 'container' => '' , 'depth' => '1') ); ?>
   </div>
   <?php }; ?>
  </div><!-- END #footer_top -->
  <?php }; ?>

  <?php
       // footer menu bottom ------------------------------------------------------
       if (has_nav_menu('footer-menu-bottom')) {
  ?>
  <div id="footer_menu_bottom">
   <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu-bottom' , 'container' => '' , 'depth' => '1') ); ?>
  </div>
  <?php }; ?>

  <?php }; // END hide footer ?>

  <?php // copyright -------------------------------------------- ?>
  <p id="copyright"><?php echo wp_kses_post($options['copyright']); ?></p>

 </footer>

 <?php
      // footer bar for mobile device -------------------
      if( is_mobile() && ($options['footer_bar_display'] != 'type3') && ($options['footer_bar_type'] == 'type1') && ($options['footer_cta_display'] == '5')) {
        get_template_part('template-parts/footer-bar');
      } elseif( is_mobile() && ($options['footer_bar_display'] != 'type3') && ($options['footer_bar_type'] == 'type2') && ($options['footer_cta_display'] == '5')) {
 ?>
 <div id="dp-footer-bar" class="type2">
  <?php
       for($i = 1; $i <= 2; $i++) {
         if($options['show_footer_button'.$i]) {
  ?>
  <a class="footer_button num<?php echo $i; ?>" href="<?php echo esc_html($options['footer_button_url'.$i]); ?>" <?php if($options['footer_button_target'.$i]){ echo 'target="_blank"'; }; ?>>
   <span><?php echo esc_html($options['footer_button_label'.$i]); ?></span>
  </a>
  <?php }; }; ?>
 </div>
 <?php
      }
      // footer cta -------------------
      if( $options['footer_cta_display'] != '5' && ! isset( $_COOKIE['tcdHideFooterCTA'] ) && ( ! $options['show_mini_cta'] || ! empty( $_COOKIE['hide_mini_cta'] ) ) ) {
        if( ( is_front_page() && ! $options['footer_cta_hide_on_front'] ) || ! is_front_page() ) {
          get_template_part( 'template-parts/footer-cta' );
        }
      }
 ?>

 <div id="return_top">
  <a href="#body"><span><?php echo wp_kses_post($options['return_top_label']); ?></span></a>
 </div>

</div><!-- #container -->
<?php else: // 404ページのとき ?>
  <footer id="footer">
    <p id="copyright"><?php echo wp_kses_post($options['copyright']); ?></p>
</footer>
<?php endif; // END 404 ?>
<?php // drawer menu -------------------------------------------- ?>
<?php if ( ($options['side_menu_type'] == 'type2') && has_nav_menu('global-menu') ) { ?>
<div id="drawer_menu">
 <nav>
  <?php
       if(has_nav_menu('global-menu')) {
         wp_nav_menu( array( 'menu_id' => 'mobile_menu', 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) );
       }
  ?>
 </nav>
 <?php
      // Search --------------------------------------------------------------------
      if( $options['show_header_search_mobile']) {
 ?>
 <div id="footer_search">
  <form role="search" method="get" id="footer_searchform" action="<?php echo esc_url(home_url()); ?>">
   <div class="input_area"><input type="text" value="" id="footer_search_input" name="s" autocomplete="off"></div>
   <div class="button"><label for="footer_search_button"></label><input type="submit" id="footer_search_button" value=""></div>
  </form>
 </div>
 <?php }; ?>
 <div id="mobile_banner">
  <?php if( $options['mobile_menu_ad_code'] ) { ?>
  <div class="banner">
   <?php echo $options['mobile_menu_ad_code']; ?>
  </div>
  <?php }; ?>
 </div><!-- END #footer_mobile_banner -->
</div>
<?php }; ?>

<?php
     // load script -----------------------------------------------------------
     if ($options['show_load_screen'] == 'type2') {
       if(is_front_page()){
         has_loading_screen();
       } else {
         no_loading_screen();
       }
     } elseif ($options['show_load_screen'] == 'type3') {
       if(is_front_page() || is_home() || is_archive()){
         has_loading_screen();
       } else {
         no_loading_screen();
       }
     } else {
       no_loading_screen();
     };
?>

<?php
     // share button ----------------------------------------------------------------------
     if ( is_single() && ( $options['single_blog_show_sns_top'] || $options['single_blog_show_sns_btm']) ) :
       if ( 'type5' == $options['sns_type_top'] || 'type5' == $options['sns_type_btm'] ) :
         if ( $options['show_twitter_top'] || $options['show_twitter_btm'] ) :
?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php
         endif;
         if ( $options['show_fblike_top'] || $options['show_fbshare_top'] || $options['show_fblike_btm'] || $options['show_fbshare_btm'] ) :
?>
<!-- facebook share button code -->
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
         endif;
         if ( $options['show_hatena_top'] || $options['show_hatena_btm'] ) :
?>
<script type="text/javascript" src="//b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
         endif;
         if ( $options['show_pocket_top'] || $options['show_pocket_btm'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
         endif;
         if ( ($options['show_pinterest_top'] && $options['sns_type_top'] == 'type5') || ($options['show_pinterest_btm'] && $options['sns_type_btm'] == 'type5') ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
         endif;
       endif;
     endif;
?>
  <?php wp_footer(); ?>
</body>
</html>