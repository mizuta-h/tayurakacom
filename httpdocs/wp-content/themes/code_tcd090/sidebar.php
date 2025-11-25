<?php
     global $post;
     $options = get_design_plus_option();

     $sidebar = '';

     if( is_singular('news') ){
       $sidebar = 'news_widget';
     } elseif ( is_single() ) {
       $sidebar = 'post_single_widget';
     } elseif( is_page() ){
       $sidebar = 'page_widget';
     } 

     if ( is_mobile() ) {
       $sidebar .= '_mobile';
     }

     if ( is_active_sidebar( $sidebar )) {
?>
<div id="side_col">
 <?php if ( is_active_sidebar( $sidebar ) ) { dynamic_sidebar( $sidebar ); }; ?>
</div>
<?php } ?>