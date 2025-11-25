<?php
     function tcd_head() {
       $options = get_design_plus_option();
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/design-plus.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sns-botton.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1201px)" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1201px)" href="<?php echo get_template_directory_uri(); ?>/css/footer-bar.css?ver=<?php echo version_num(); ?>">

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.4.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jscript.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/tcd_cookie.min.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/comment.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/parallax.js?ver=<?php echo version_num(); ?>"></script>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/simplebar.css?ver=<?php echo version_num(); ?>">
<script src="<?php echo get_template_directory_uri(); ?>/js/simplebar.min.js?ver=<?php echo version_num(); ?>"></script>

<?php if(is_mobile()) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/footer-bar.js?ver=<?php echo version_num(); ?>"></script>
<?php }; ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/header_fix.js?ver=<?php echo version_num(); ?>"></script>

<?php
     // ヘッダーメッセージ
     if($options['show_header_message']) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  if ($.cookie('close_header_message') == 'on') {
    $('#header_message').hide();
  }
  $('#close_header_message').click(function() {
    $('#header_message').hide();
    $.cookie('close_header_message', 'on', {
      path:'/'
    });
  });
});
</script>
<?php }; ?>

<?php /* URLやモバイル等でcssが変わらないものをここで出力 */ ?>
<style type="text/css">
<?php
     // フォントの設定　------------------------------------------------------------------
     $headline_font_size = $options['headline_font_size'] ? $options['headline_font_size'] : '32';
     $headline_font_size_mobile = $options['headline_font_size_mobile'] ? $options['headline_font_size_mobile'] : '22';
?>
body { font-size:<?php echo esc_html($options['content_font_size']); ?>px; }
.common_headline { font-size:<?php echo esc_html($headline_font_size); ?>px !important; }
@media screen and (max-width:750px) {
  body { font-size:<?php echo esc_html($options['content_font_size_mobile']); ?>px; }
  .common_headline { font-size:<?php echo esc_html($headline_font_size_mobile); ?>px !important; }
}
<?php
     // 基本のフォントタイプ
     if($options['content_font_type'] == 'type1') {
?>
body, input, textarea { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; }
<?php } elseif($options['content_font_type'] == 'type2') { ?>
body, input, textarea { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; }
<?php } else { ?>
body, input, textarea { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; }
<?php }; ?>

<?php
     // 見出しのフォントタイプ
     if($options['headline_font_type'] == 'type1') {
?>
.rich_font, .p-vertical { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; font-weight:600; }
<?php } elseif($options['headline_font_type'] == 'type2') { ?>
.rich_font, .p-vertical { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight:600; }
<?php } else { ?>
.rich_font, .p-vertical { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight:600; }
<?php }; ?>

.rich_font_type1 { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; font-weight:600; }
.rich_font_type2 { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight:600; }
.rich_font_type3 { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight:600; }

<?php
     // ヘッダー -------------------------------------------------------------------------------
     $mobile_header_bg_color = hex2rgb($options['mobile_header_bg_color']);
     $mobile_header_bg_color = implode(",",$mobile_header_bg_color);
?>
.mobile body #header { background:rgba(<?php echo esc_html($mobile_header_bg_color); ?>,1); }
.mobile body.home #header { background:none; }
.mobile body.header_fix_mobile #header, .mobile body.home.header_fix_mobile #header { background:rgba(<?php echo esc_html($mobile_header_bg_color); ?>,<?php echo esc_html($options['mobile_header_bg_color_opacity']); ?>); }
.mobile body.header_fix_mobile #header:hover { background:rgba(<?php echo esc_html($mobile_header_bg_color); ?>,1) !important; }
<?php
     // ロゴ
?>
#header_logo .logo_text { font-size:<?php echo esc_html($options['header_logo_font_size']); ?>px; }
#footer_logo .logo_text { font-size:<?php echo esc_html($options['footer_logo_font_size']); ?>px; }
@media screen and (max-width:1201px) {
  #header_logo .logo_text { font-size:<?php echo esc_html($options['header_logo_font_size_mobile']); ?>px; }
  #footer_logo .logo_text { font-size:<?php echo esc_html($options['footer_logo_font_size_mobile']); ?>px; }
}
<?php
     // サイドメニュー
       $drawer_menu_font_color_hover = ($options['drawer_menu_font_color_hover_use_main'] != 1) ? $options['drawer_menu_font_color_hover'] : $options['text_hover_color'];
       $drawer_menu_child_bg_color2 = hex2rgb($options['drawer_menu_child_bg_color']);
       $drawer_menu_child_bg_color2 = implode(",",$drawer_menu_child_bg_color2);
?>
#mega_menu, body.side_menu_type2 #side_menu:after { background:rgba(0,0,0,<?php echo esc_html($options['side_menu_bg_opacity']); ?>); }
#side_menu_content { background:<?php echo esc_html($options['drawer_menu_parent_bg_color']); ?>; }
#side_menu > .sub-menu { background:<?php echo esc_html($options['drawer_menu_child_bg_color']); ?>; }
#side_menu > .sub-menu .sub-menu { background:rgba(0,0,0,0.2); }
#side_menu a { color:<?php echo esc_html($options['drawer_menu_font_color']); ?>; }
#side_menu a:hover { color:<?php echo esc_html($drawer_menu_font_color_hover); ?>; }
#side_menu .menu-item-has-children:after, #side_menu .menu-item-has-children:before { background-color:<?php echo esc_html($options['drawer_menu_font_color']); ?>; }
#side_menu .menu-item-has-children:hover:after, #side_menu .menu-item-has-children:hover:before { background-color:<?php echo esc_html($drawer_menu_font_color_hover); ?>; }
#mega_category .category_name { font-size:<?php echo esc_attr($options['mega_category_name_font_size']); ?>px; }
#mega_category .title { font-size:<?php echo esc_attr($options['mega_category_title_font_size']); ?>px; }
<?php
     // ドロワーメニュー
     $mobile_menu_font_color = hex2rgb($options['mobile_menu_font_color']);
     $mobile_menu_font_color = implode(",",$mobile_menu_font_color);
?>
.mobile #header, .mobile body.single.header_fix #header  { }
.mobile #header:hover {  }
#drawer_menu { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_color']); ?>; }
#drawer_menu a { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; }
#drawer_menu a:hover { }
#mobile_menu a { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; border-color:<?php echo esc_html($options['mobile_menu_border_color']); ?>; }
#mobile_menu li li a { background:<?php echo esc_html($options['mobile_menu_sub_menu_bg_color']); ?>; }
#mobile_menu a:hover, #drawer_menu .close_button:hover, #mobile_menu .child_menu_button:hover { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_hover_color']); ?>; }
#mobile_menu .child_menu_button .icon:before, #mobile_menu .child_menu_button:hover .icon:before { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; }
<?php
     // メッセージ -----------------------------------------------------------------------------------
      if($options['show_header_message'] && $options['header_message']) {
?>
#header_message { background:<?php echo esc_attr($options['header_message_bg_color']); ?>; color:<?php echo esc_attr($options['header_message_font_color']); ?>; }
#close_header_message:before { color:<?php echo esc_attr($options['header_message_font_color']); ?>; }
<?php
      };
     // フッター -----------------------------------------------------------------------------------
     if( $options['show_footer_banner']) {
?>
#footer_banner .title { font-size:<?php echo esc_attr($options['footer_banner_title_font_size']); ?>px; }
#footer_banner .desc { font-size:<?php echo esc_attr($options['footer_banner_desc_font_size']); ?>px; }
@media screen and (max-width:1050px) {
  #footer_banner .title { font-size:<?php echo esc_attr($options['footer_banner_title_font_size_mobile']); ?>px; }
  #footer_banner .desc { font-size:<?php echo esc_attr($options['footer_banner_desc_font_size_mobile']); ?>px; }
}
<?php
     if( $options['footer_banner_use_overlay']) {
       $overlay_color = hex2rgb($options['footer_banner_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['footer_banner_overlay_opacity'];
?>
#footer_banner a:before {
  background: -moz-linear-gradient(left,  rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>) 0%, rgba(<?php echo esc_attr($overlay_color); ?>,0) 100%);
  background: -webkit-linear-gradient(left,  rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>) 0%,rgba(<?php echo esc_attr($overlay_color); ?>,0) 100%);
  background: linear-gradient(to right,  rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>) 0%,rgba(<?php echo esc_attr($overlay_color); ?>,0) 100%);
}
<?php }; ?>
<?php
     };

     // サムネイルのホバーアニメーション設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
     if($options['hover_type']!="type5"){

       // ズームイン ------------------------------------------------------------------------------
       if($options['hover_type']=="type1"){
?>
.author_profile .avatar_area img, .animate_image img, .animate_background .image {
  width:100%; height:auto; will-change:transform;
  -webkit-transition: transform  0.5s ease;
  transition: transform  0.5s ease;
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image {
  -webkit-transform: scale(<?php echo $options['hover1_zoom']; ?>);
  transform: scale(<?php echo $options['hover1_zoom']; ?>);
}

<?php
     // ズームアウト ------------------------------------------------------------------------------
     } if($options['hover_type']=="type2"){
?>
.author_profile .avatar_area img, .animate_image img, .animate_background .image {
  width:100%; height:auto; will-change:transform;
  -webkit-transition: transform  0.5s ease;
  transition: transform  0.5s ease;
  -webkit-transform: scale(<?php echo $options['hover2_zoom']; ?>);
  transform: scale(<?php echo $options['hover2_zoom']; ?>);
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image {
  -webkit-transform: scale(1);
  transform: scale(1);
}

<?php
     // スライド ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type3"){
?>
.author_profile .avatar_area, .animate_image, .animate_background, .animate_background .image_wrap {
  background: <?php echo $options['hover3_bgcolor']; ?>;
}
.animate_image img, .animate_background .image {
  -webkit-width:calc(100% + 30px) !important; width:calc(100% + 30px) !important; height:auto; max-width:inherit !important;
  <?php if($options['hover3_direct']=='type1'): ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php else: ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php endif; ?>
}
.animate_image.avatar_area img {
  width:calc(100% + 10px) !important;
  <?php if($options['hover3_direct']=='type1'): ?>
  -webkit-transform: translate(-5px, 0px); transform: translate(-5px, 0px);
  <?php else: ?>
  -webkit-transform: translate(-5px, 0px); transform: translate(-5px, 0px);
  <?php endif; ?>
}
.animate_image:hover img, .animate_background:hover .image {
  opacity:<?php echo $options['hover3_opacity']; ?> !important;
  <?php if($options['hover3_direct']=='type1'): ?>
  -webkit-transform: translate(0px, 0px);
  transform: translate(0px, 0px);
  <?php else: ?>
  -webkit-transform: translate(-30px, 0px);
  transform: translate(-30px, 0px);
  <?php endif; ?>
}
<?php
     // フェードアウト ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type4"){
?>
.author_profile .avatar_area, .animate_image, .animate_background, .animate_background .image_wrap {
  background: <?php echo $options['hover4_bgcolor']; ?>;
}
.author_profile a.avatar img, .animate_image img, .animate_background .image {
  -webkit-transition-property: opacity; -webkit-transition: 0.5s;
  transition-property: opacity; transition: 0.5s;
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image {
  opacity: <?php echo $options['hover4_opacity']; ?> !important;
}
<?php }; }; // アニメーションここまで ?>

<?php
     // 色関連のスタイル　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
?>
a { color:#000; }

<?php
     // メインカラー ----------------------------------
     $main_color = $options['main_color'];
?>
#blog_total_num .num { color:<?php echo esc_html($main_color); ?>; }
#page_header .catch span:after, #author_page_header .name:after, #author_list .name:after, .post_carousel .author_list .name:after, #page_header.simple .catch:after, .post_carousel .category:after, .cat-item a:after, #author_post li a span:after, .author_profile .tab li:hover, .toc_widget_wrap.styled .toc_link:after,
  .cb_featured .button_list .item:hover, .author_profile .tab li a:hover, #p_readmore .button:hover, .c-pw__btn:hover, #comment_tab li a:hover, #submit_comment:hover, #cancel_comment_reply a:hover,
    #wp-calendar #prev a:hover, #wp-calendar #next a:hover, #wp-calendar td a:hover, #comment_tab li a:hover, #return_top a:hover
      { background-color:<?php echo esc_html($main_color); ?>; }

.page_navi a:hover, #post_pagination a:hover, #comment_textarea textarea:focus, .c-pw__box-input:focus
  { border-color:<?php echo esc_html($main_color); ?>; }

<?php
     // テキストホバーカラー ----------------------------------
     $text_hover_color = $options['text_hover_color'];
?>
a:hover, #mega_category .title a:hover, #mega_category a:hover .name, #header_slider .post_item .title a:hover, #footer_top a:hover, #footer_social_link li a:hover:before, #next_prev_post a:hover, .single_copy_title_url_btn:hover,
  .cb_category_post .title a:hover, .cb_trend .post_list.type2 .name:hover, #header_content_post_list .item .title a:hover, #header_content_post_list .item .name:hover,
    .tcdw_search_box_widget .search_area .search_button:hover:before, #single_author_title_area .author_link li a:hover:before, .author_profile a:hover, #post_meta_bottom a:hover, .cardlink_title a:hover,
      .comment a:hover, .comment_form_wrapper a:hover, #mega_menu_mobile_global_menu li a:hover, #tcd_toc.styled .toc_link:hover, .tcd_toc_widget.no_underline .toc_widget_wrap.styled .toc_link:hover, .rank_headline .headline:hover
        { color:<?php echo esc_html($text_hover_color); ?>; }
@media screen and (max-width:750px) {
  #author_post li a:hover, .category_list_widget li a:hover { color:<?php echo esc_html($text_hover_color); ?> !important; }
}
<?php
     // 詳細ページのテキストカラー ----------------------------------
     $content_link_hover_color = ($options['content_link_hover_color_use_sub'] != 1) ? $options['content_link_hover_color'] : $options['text_hover_color'];
?>
.post_content a, .custom-html-widget a { color:<?php echo esc_html($options['content_link_color']); ?>; }
.post_content a:hover, .custom-html-widget a:hover { color:<?php echo esc_html($content_link_hover_color); ?>; }

<?php
     //カテゴリーの色を出力 -------------------------------------------
     $cats = get_terms("category",'orderby=term_order&hide_empty=true');

     foreach ($cats as $cat):
       $cat_id = $cat->term_id;
       $cat_meta_data = get_option( 'taxonomy_' . $cat_id, array() );
       $color1 =  isset($cat_meta_data['color1']) ? $cat_meta_data['color1'] : '#b43936';
?>
.cat_id<?php echo esc_html($cat_id); ?>_text_link:hover { color:<?php echo esc_html($color1); ?> !important; }
.cat_id<?php echo esc_html($cat_id); ?>:after, .cat-item-<?php echo esc_html($cat_id); ?> a:after { background-color:<?php echo esc_html($color1); ?> !important; }
<?php
     endforeach;

     // カスタムCSS --------------------------------------------
     if($options['css_code']) {
       echo $options['css_code'];
     };

     // クイックタグ --------------------------------------------
     if ( $options['use_quicktags'] ) :

     // 見出し
?>
.styled_h2 {
  font-size:<?php echo esc_attr($options['qt_h2_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h2_text_align']); ?>; color:<?php echo esc_attr($options['qt_h2_font_color']); ?>; <?php if($options['show_qt_h2_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h2_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h2_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h2_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h2_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h2_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h2_padding_top']); ?>px <?php echo esc_attr($options['qt_h2_padding_right']); ?>px <?php echo esc_attr($options['qt_h2_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h2_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h2_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h2_margin_bottom']); ?>px !important;
}
.styled_h3 {
  font-size:<?php echo esc_attr($options['qt_h3_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h3_text_align']); ?>; color:<?php echo esc_attr($options['qt_h3_font_color']); ?>; <?php if($options['show_qt_h3_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h3_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h3_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h3_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h3_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h3_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h3_padding_top']); ?>px <?php echo esc_attr($options['qt_h3_padding_right']); ?>px <?php echo esc_attr($options['qt_h3_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h3_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h3_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h3_margin_bottom']); ?>px !important;
}
.styled_h4 {
  font-size:<?php echo esc_attr($options['qt_h4_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h4_text_align']); ?>; color:<?php echo esc_attr($options['qt_h4_font_color']); ?>; <?php if($options['show_qt_h4_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h4_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h4_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h4_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h4_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h4_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h4_padding_top']); ?>px <?php echo esc_attr($options['qt_h4_padding_right']); ?>px <?php echo esc_attr($options['qt_h4_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h4_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h4_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h4_margin_bottom']); ?>px !important;
}
.styled_h5 {
  font-size:<?php echo esc_attr($options['qt_h5_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h5_text_align']); ?>; color:<?php echo esc_attr($options['qt_h5_font_color']); ?>; <?php if($options['show_qt_h5_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h5_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h5_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h5_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h5_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h5_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h5_padding_top']); ?>px <?php echo esc_attr($options['qt_h5_padding_right']); ?>px <?php echo esc_attr($options['qt_h5_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h5_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h5_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h5_margin_bottom']); ?>px !important;
}
@media screen and (max-width:750px) {
  .styled_h2 { font-size:<?php echo esc_attr($options['qt_h2_font_size_mobile']); ?>px !important; margin:0px 0px 20px !important; }
  .styled_h3 { font-size:<?php echo esc_attr($options['qt_h3_font_size_mobile']); ?>px !important; margin:0px 0px 20px !important; }
  .styled_h4 { font-size:<?php echo esc_attr($options['qt_h4_font_size_mobile']); ?>px !important; margin:0px 0px 20px !important; }
  .styled_h5 { font-size:<?php echo esc_attr($options['qt_h5_font_size_mobile']); ?>px !important; margin:0px 0px 20px !important; }
}
<?php
     // ボタン
     for ( $i = 1; $i <= 3; $i++ ) {
       if ( 'type4' === $options['qt_custom_button_animation_type' . $i] ) {
         $design_button_border_color = $options['qt_custom_button_underline_color'.$i];
?>
.q_custom_button<?php echo $i; ?>.animation_type4 span:after { background-color:<?php echo esc_html($design_button_border_color); ?>; }
<?php
       } else {
         $qt_custom_button_border_color = hex2rgb($options['qt_custom_button_border_color' . $i]);
         $qt_custom_button_border_color = implode(",",$qt_custom_button_border_color);
         $qt_custom_button_border_color_hover = hex2rgb($options['qt_custom_button_border_color_hover' . $i]);
         $qt_custom_button_border_color_hover = implode(",",$qt_custom_button_border_color_hover);
?>
.q_custom_button<?php echo $i; ?> {
  color:<?php echo esc_attr($options['qt_custom_button_font_color' . $i]); ?> !important;
  border-color:rgba(<?php echo esc_attr($qt_custom_button_border_color); ?>,<?php echo esc_attr($options['qt_custom_button_border_color_opacity' . $i]); ?>);
}
.q_custom_button<?php echo $i; ?>.animation_type1 { background:<?php echo esc_attr($options['qt_custom_button_bg_color' . $i]); ?>; }
.q_custom_button<?php echo $i; ?>:hover, .q_custom_button<?php echo $i; ?>:focus {
  color:<?php echo esc_attr($options['qt_custom_button_font_color_hover' . $i]); ?> !important;
  border-color:rgba(<?php echo esc_attr($qt_custom_button_border_color_hover); ?>,<?php echo esc_attr($options['qt_custom_button_border_color_hover_opacity' . $i]); ?>);
}
.q_custom_button<?php echo $i; ?>.animation_type1:hover { background:<?php echo esc_attr($options['qt_custom_button_bg_color_hover' . $i]); ?>; }
.q_custom_button<?php echo $i; ?>:before { background:<?php echo esc_attr($options['qt_custom_button_bg_color_hover' . $i]); ?>; }
<?php
       };
     };

     // 吹き出し
?>
.speech_balloon_left1 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color1'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color1'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color1'] ); ?> }
.speech_balloon_left1 .speach_balloon_text::before { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_border_color1'] ); ?> }
.speech_balloon_left1 .speach_balloon_text::after { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color1'] ); ?> }
.speech_balloon_left2 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color2'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color2'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color2'] ); ?> }
.speech_balloon_left2 .speach_balloon_text::before { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_border_color2'] ); ?> }
.speech_balloon_left2 .speach_balloon_text::after { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color2'] ); ?> }
.speech_balloon_right1 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color3'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color3'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color3'] ); ?> }
.speech_balloon_right1 .speach_balloon_text::before { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_border_color3'] ); ?> }
.speech_balloon_right1 .speach_balloon_text::after { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color3'] ); ?> }
.speech_balloon_right2 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color4'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color4'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color4'] ); ?> }
.speech_balloon_right2 .speach_balloon_text::before { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_border_color4'] ); ?> }
.speech_balloon_right2 .speach_balloon_text::after { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color4'] ); ?> }
<?php
     endif;
     // Google map
     $qt_gmap_marker_bg = $options['qt_gmap_marker_bg'];
?>
.qt_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo esc_attr($qt_gmap_marker_bg); ?>; color:<?php echo esc_attr($options['qt_gmap_marker_color']); ?>; }
.qt_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo esc_attr($qt_gmap_marker_bg); ?> transparent transparent transparent; }
<?php
	// tcd_head_css action
	do_action( 'tcd_head_css' );
?>
</style>

<?php /* URLやモバイル等でcssが変わるものはここで出力 ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ */ ?>
<style id="current-page-style" type="text/css">
<?php
     // トップページ -----------------------------------------------------------------------------
     if(is_front_page()) {

       // ヘッダーコンテンツ
       $index_slider = '';
       $display_header_content = '';

       if(is_mobile() && ($options['mobile_show_index_slider'] == 'type2')){
         $device = 'mobile_';
       } else {
         $device = '';
       }

       if(!is_mobile() && $options['show_index_slider']) {
         $index_slider = $options['index_slider'];
         $index_slider_type = $options['index_slider_type'];
         $display_header_content = 'show';
       } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type2') ) {
         $index_slider = $options['mobile_index_slider'];
         $index_slider_type = $options['mobile_index_slider_type'];
         $display_header_content = 'show';
       } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type1') ) {
         $index_slider = $options['index_slider'];
         $index_slider_type = $options['index_slider_type'];
         $display_header_content = 'show';
       }

       if($display_header_content == 'show'){

         // 記事スライダー ----------------------------------------------
         if($index_slider_type == 'type1'){
           if(is_mobile() && ($options['mobile_show_index_slider'] == 'type2')) {
             $title_font_size_mobile = $options['index_post_slider_title_font_size'];
           } else {
             $title_font_size_mobile = $options['index_post_slider_title_font_size_mobile'];
           }
?>
#header_slider .post_item .title { font-size:<?php echo esc_html($options['index_post_slider_title_font_size'] ); ?>px; }
@media screen and (max-width:950px) {
  #header_slider .post_item .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
}
<?php
         // 記事スライダー以外 ----------------------------------------------
         } else {

         $i = 1;
         foreach ( $index_slider as $key => $value ) :

           if(is_mobile() && ($options['mobile_show_index_slider'] == 'type2')) {
             $catch_font_size_mobile = $value['catch_font_size'];
             $desc_font_size_mobile = $value['desc_font_size'];
             $title_font_size_mobile = $value['post_title_font_size'];
           } else {
             $catch_font_size_mobile = $value['catch_font_size_mobile'];
             $desc_font_size_mobile = $value['desc_font_size_mobile'];
             $title_font_size_mobile = $value['post_title_font_size_mobile'];
           }
?>
#header_slider .item<?php echo $i; ?> .catch { font-size:<?php echo esc_attr($value['catch_font_size']); ?>px; }
#header_slider .item<?php echo $i; ?> .desc { font-size:<?php echo esc_attr($value['desc_font_size']); ?>px; }
#header_slider .post_item.item<?php echo $i; ?> .title { font-size:<?php echo esc_attr($value['post_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #header_slider .item<?php echo $i; ?> .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
  #header_slider .item<?php echo $i; ?> .desc { font-size:<?php echo esc_attr($desc_font_size_mobile); ?>px; }
  #header_slider .post_item.item<?php echo $i; ?> .title { font-size:<?php echo esc_attr($title_font_size_mobile); ?>px !important; }
  #header_slider_wrap.index_slider_type3 #header_slider .post_item.item<?php echo $i; ?> .title { font-size:<?php echo esc_attr($title_font_size_mobile); ?>px !important; }
}
<?php
           // button setting ---------------------------------------------------------
           if($value['show_button']){
             $button_font_color = $value['button_font_color'] ? $value['button_font_color'] : '#000000';
             $button_font_color_hover = $value['button_font_color_hover'] ? $value['button_font_color_hover'] : '#ffffff';
             $button_bg_color = $value['button_bg_color'] ? $value['button_bg_color'] : '#ffffff';
             $button_bg_color_hover = $value['button_bg_color_hover'] ? $value['button_bg_color_hover'] : '#000000';
             if($value['button_type'] == 'type1'){
?>
#header_slider .item<?php echo $i; ?> .design_button2.type1 a { color:<?php echo esc_attr($button_font_color); ?> !important; background:<?php echo esc_attr($button_bg_color); ?>; }
#header_slider .item<?php echo $i; ?> .design_button2.type1 a:hover { color:<?php echo esc_attr($button_font_color_hover); ?> !important; background:<?php echo esc_attr($button_bg_color_hover); ?>; }
<?php
             } else {
               $button_border_color = $value['button_border_color'] ? $value['button_border_color'] : '#ffffff';
               $button_border_color_opacity = $value['button_border_color_opacity'] ? $value['button_border_color_opacity'] : '1';
               $button_border_color = hex2rgb($button_border_color);
               $button_border_color = implode(",",$button_border_color);
               $button_border_color_hover = $value['button_border_color_hover'] ? $value['button_border_color_hover'] : '#000000';
               $button_border_color_opacity_hover = $value['button_border_color_hover_opacity'] ? $value['button_border_color_hover_opacity'] : '1';
               $button_border_color_hover = hex2rgb($button_border_color_hover);
               $button_border_color_hover = implode(",",$button_border_color_hover);
?>
#header_slider .item<?php echo $i; ?> .design_button2.type2 a, #header_slider .item<?php echo $i; ?> .design_button2.type3 a { color:<?php echo esc_attr($button_font_color); ?> !important; border-color:rgba(<?php echo esc_attr($button_border_color); ?>,<?php echo esc_attr($button_border_color_opacity); ?>); }
#header_slider .item<?php echo $i; ?> .design_button2.type2 a:hover, #header_slider .item<?php echo $i; ?> .design_button2.type3 a:hover { color:<?php echo esc_attr($button_font_color_hover); ?> !important; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_opacity_hover); ?>); }
#header_slider .item<?php echo $i; ?> .design_button2.type2 a:before, #header_slider .item<?php echo $i; ?> .design_button2.type3 a:before { background:<?php echo esc_attr($button_bg_color_hover); ?>; }
<?php
             };
           }; // END button setting

           $use_overlay = $value['use_overlay'];
           $overlay_color = hex2rgb($value['overlay_color']);
           $overlay_opacity = $value['overlay_opacity'];
           $overlay_color = implode(",",$overlay_color);
           if($use_overlay) {
?>
#header_slider .item<?php echo $i; ?> .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
           }; // END overlay

         $i++;
         endforeach;

         }; // END index_slider_type

         // ヘッダーコンテンツタイプ3 ----------------------------------------------
         if($index_slider_type == 'type3'){
           if(is_mobile() && ($options['mobile_show_index_slider'] == 'type2')) {
             $title_font_size_mobile = $options[$device.'index_header_content_type3_title_font_size'];
           } else {
             $title_font_size_mobile = $options['index_header_content_type3_title_font_size_mobile'];
           }
?>
#header_content_post_list .item .title { font-size:<?php echo esc_attr($options[$device.'index_header_content_type3_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #header_content_post_list .item .title { font-size:<?php echo esc_attr($title_font_size_mobile); ?>px !important; }
}
<?php
           $use_overlay = $options['index_header_content_type3_use_overlay'];
           $overlay_color = hex2rgb($options['index_header_content_type3_overlay_color']);
           $overlay_opacity = $options['index_header_content_type3_overlay_opacity'];
           $overlay_color = implode(",",$overlay_color);
           if($use_overlay) {
?>
#header_content_post_list .item .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
           }; // END overlay
         }; // END index_slider_type

       };

       // トップページ　コンテンツビルダー -------------------------------------------------------------------------------------------------------------
       if ($options['contents_builder'] || $options['mobile_contents_builder']) :
         $content_count = 1;
         if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
           $contents_builder = $options['mobile_contents_builder'];
         } else {
           $contents_builder = $options['contents_builder'];
         }
         foreach($contents_builder as $content) :

           // カルーセル ---------------------------------------------------------
           if ( $content['cb_content_select'] == 'carousel' && $content['show_content'] ) {

             if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
               $title_font_size_mobile = $content['title_font_size'];
             } else {
               $title_font_size_mobile = $content['title_font_size_mobile'];
             }
?>
.cb_carousel.num<?php echo $content_count; ?> .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .cb_carousel.num<?php echo $content_count; ?> .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
}
<?php
           // 特集コンテンツ ---------------------------------------------------------
           } elseif ( $content['cb_content_select'] == 'featured_content' && $content['show_content'] ) {

             if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
               $title_font_size_mobile = $content['title_font_size'];
             } else {
               $title_font_size_mobile = $content['title_font_size_mobile'];
             }
?>
.cb_featured.num<?php echo $content_count; ?> .featured_post .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .cb_featured.num<?php echo $content_count; ?> .featured_post .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
}
<?php
           // カテゴリー記事 -----------------------------------------------------------------
           } elseif ( $content['cb_content_select'] == 'category_post' && $content['show_content'] ) {

             if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
               $title_font_size_mobile = $content['title_font_size'];
             } else {
               $title_font_size_mobile = $content['title_font_size_mobile'];
             }
?>
.cb_category_post.num<?php echo $content_count; ?> .post_list .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .cb_category_post.num<?php echo $content_count; ?> .post_list .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
}
<?php
             $use_overlay = $content['bg_use_overlay'];
             $overlay_color = hex2rgb($content['bg_overlay_color']);
             $overlay_opacity = $content['bg_overlay_opacity'];
             $overlay_color = implode(",",$overlay_color);
             if($use_overlay) {
?>
.cb_category_post.num<?php echo $content_count; ?> .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
             }; // END overlay

            // 3カラムコンテンツ ---------------------------------------------------------
           } elseif ( $content['cb_content_select'] == 'trend' && $content['show_content'] ) {

             if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
               $title_font_size_mobile = $content['title_font_size'];
             } else {
               $title_font_size_mobile = $content['title_font_size_mobile'];
             }
?>
.cb_trend.num<?php echo $content_count; ?> .post_list.type1 .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .cb_trend.num<?php echo $content_count; ?> .post_list.type1 .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
}
<?php
           // Newsコンテンツ ---------------------------------------------------------
           } elseif ( $content['cb_content_select'] == 'news_list' && $content['show_content'] ) {

             if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
               $title_font_size_mobile = $content['title_font_size_mobile'];
             } else {
               $title_font_size_mobile = $content['title_font_size_mobile'];
             }
?>
.cb_news_list.num<?php echo $content_count; ?> .news_archive_item_content .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .cb_news_list.num<?php echo $content_count; ?> .news_archive_item_content .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
}
<?php
          // フリースペース ----------------------------------------------------
           } elseif ( $content['cb_content_select'] == 'free_space' && $content['show_content'] ) {
             if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
               $margin_top_mobile = $content['margin_top'];
               $margin_bottom_mobile = $content['margin_bottom'];
             } else {
               $margin_top_mobile = $content['margin_top_mobile'];
               $margin_bottom_mobile = $content['margin_bottom_mobile'];
             }
?>
.cb_free_space.num<?php echo $content_count; ?> { padding-top:<?php echo esc_html($content['margin_top']); ?>px; padding-bottom:<?php echo esc_html($content['margin_bottom']); ?>px; }
@media screen and (max-width:750px) {
  .cb_free_space.num<?php echo $content_count; ?> { padding-top:<?php echo esc_html($margin_top_mobile); ?>px; padding-bottom:<?php echo esc_html($margin_bottom_mobile); ?>px; }
}
<?php
           };
         $content_count++;
         endforeach;
       endif; // END コンテンツビルダーここまで

     // Newsアーカイブ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('news')) {
?>
.news_list .title { font-size:<?php echo esc_attr($options['archive_news_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .news_list .title { font-size:<?php echo esc_attr($options['archive_news_title_font_size_mobile']); ?>px; }
}
<?php
       $use_overlay = $options['archive_news_header_use_overlay'];
       $overlay_color = hex2rgb($options['archive_news_header_overlay_color']);
       $overlay_opacity = $options['archive_news_header_overlay_opacity'];
       $overlay_color = implode(",",$overlay_color);
       $border_color = $options['main_color'];
       if($use_overlay) {
?>
#page_header .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
       }; // END overlay

       if(is_post_type_archive('news')){
                $border_color = isset($border_color)? $border_color : '#b43936';
       ?>
#page_header .catch span:after { background-color:<?php echo esc_attr($border_color); ?>; }
<?php
       }

     // ブログアーカイブ -----------------------------------------------------------------------------
     } elseif(is_archive() || is_home() || is_search()) {
       if (is_category()) {
         $query_obj = get_queried_object();
         $cat_id = $query_obj->term_id;
         $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
         $archive_carousel_title_font_size =  (isset($term_meta['archive_carousel_title_font_size']) && !empty($term_meta['archive_carousel_title_font_size'])) ? $term_meta['archive_carousel_title_font_size'] : '18';
         $archive_carousel_title_font_size_mobile =  (isset($term_meta['archive_carousel_title_font_size_mobile']) && !empty($term_meta['archive_carousel_title_font_size_mobile'])) ? $term_meta['archive_carousel_title_font_size_mobile'] : '16';
       } else {
         $archive_carousel_title_font_size =  $options['archive_carousel_title_font_size'];
         $archive_carousel_title_font_size_mobile =  $options['archive_carousel_title_font_size_mobile'];
       }
?>
.owl-carousel .title { font-size:<?php echo esc_attr($archive_carousel_title_font_size); ?>px !important; }
.blog_list .title { font-size:<?php echo esc_attr($options['archive_blog_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .owl-carousel .title { font-size:<?php echo esc_attr($archive_carousel_title_font_size_mobile); ?>px !important; }
  .blog_list .title { font-size:<?php echo esc_attr($options['archive_blog_title_font_size_mobile']); ?>px; }
}
<?php
       $use_overlay = $options['archive_blog_header_use_overlay'];
       $overlay_color = hex2rgb($options['archive_blog_header_overlay_color']);
       $overlay_opacity = $options['archive_blog_header_overlay_opacity'];
       if (is_category()) {
         $border_color =  isset($term_meta['color1']) ? $term_meta['color1'] : '#b43936';
         if (!empty($term_meta['image']) && !empty($term_meta['use_overlay'])){
           $use_overlay = $term_meta['use_overlay'];
         } elseif (!empty($term_meta['image']) && empty($term_meta['use_overlay'])){
           $use_overlay = '';
         }
         if (!empty($term_meta['image']) && !empty($term_meta['overlay_color'])){ $overlay_color = hex2rgb($term_meta['overlay_color']); }
         if (!empty($term_meta['image']) && !empty($term_meta['overlay_opacity'])){ $overlay_opacity = $term_meta['overlay_opacity']; }
       }
       $overlay_color = implode(",",$overlay_color);
       if($use_overlay) {
?>
#page_header .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
       }; // END overlay

       if(is_archive()){
                $border_color = isset($border_color)? $border_color : '#b43936';
       ?>
#page_header .catch span:after { background-color:<?php echo esc_attr($border_color); ?>; }
<?php
       }

     // ブログ詳細ページ -----------------------------------------------------------------------------
     } elseif(is_single()){
?>
#post_title .title { font-size:<?php echo esc_attr($options['single_blog_title_font_size']); ?>px; }
#related_post .title { font-size:<?php echo esc_attr($options['related_post_title_font_size']); ?>px; }
.featured_post .title { font-size:<?php echo esc_attr($options['featured_post_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #post_title .title { font-size:<?php echo esc_attr($options['single_blog_title_font_size_mobile']); ?>px; }
  #related_post .title { font-size:<?php echo esc_attr($options['related_post_title_font_size_mobile']); ?>px; }
  .featured_post .title { font-size:<?php echo esc_attr($options['featured_post_title_font_size_mobile']); ?>px; }
}
<?php
     // 固定ページ --------------------------------------------------------------------
     } elseif(is_page()) {

       global $post;

       if(is_page_template('page-ranking-list.php') || is_page_template('page-author-list.php')) {
         $page_header_catch_font_size = $options['headline_font_size'] ? $options['headline_font_size'] : '32';
         $page_header_catch_font_size_mobile = $options['headline_font_size_mobile'] ? $options['headline_font_size_mobile'] : '22';
         $page_header_desc_font_size = $options['content_font_size'] ? $options['content_font_size'] : '16';
         $page_header_desc_font_size_mobile = $options['content_font_size_mobile'] ? $options['content_font_size_mobile'] : '14';
       } else {
         $page_header_catch_font_size = get_post_meta($post->ID, 'page_header_catch_font_size', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size', true) : '32';
         $page_header_catch_font_size_mobile = get_post_meta($post->ID, 'page_header_catch_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size_mobile', true) : '22';
         $page_header_desc_font_size = get_post_meta($post->ID, 'page_header_desc_font_size', true) ?  get_post_meta($post->ID, 'page_header_desc_font_size', true) : '16';
         $page_header_desc_font_size_mobile = get_post_meta($post->ID, 'page_header_desc_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_desc_font_size_mobile', true) : '14';
       }
       $page_header_catch_border_color = (get_post_meta($post->ID, 'page_header_catch_color_use_main', true) != 1) ? get_post_meta($post->ID, 'page_header_catch_border_color', true) : $options['main_color'];


       $page_content_font_size = get_post_meta($post->ID, 'page_content_font_size', true) ?  get_post_meta($post->ID, 'page_content_font_size', true) : '16';
       $page_content_font_size_mobile = get_post_meta($post->ID, 'page_content_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_content_font_size_mobile', true) : '14';
?>
#page_header .catch { font-size:<?php echo esc_html($page_header_catch_font_size); ?>px;}
#page_header .catch span:after { background-color:<?php echo esc_html($page_header_catch_border_color); ?> !important; }
#page_header .desc { font-size:<?php echo esc_html($page_header_desc_font_size); ?>px; }
#lp_page_content, #one_col { font-size:<?php echo esc_html($page_content_font_size); ?>px; }
@media screen and (max-width:750px) {
  #page_header .catch { font-size:<?php echo esc_html($page_header_catch_font_size_mobile); ?>px;}
  #page_header .desc { font-size:<?php echo esc_html($page_header_desc_font_size_mobile); ?>px;}
  #lp_page_content, #one_col { font-size:<?php echo esc_html($page_content_font_size_mobile); ?>px; }
}
<?php
       $use_overlay = get_post_meta($post->ID, 'page_header_use_overlay', true);
       $overlay_color = get_post_meta($post->ID, 'page_header_overlay_color', true) ?  get_post_meta($post->ID, 'page_header_overlay_color', true) : '#000000';
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = get_post_meta($post->ID, 'page_header_overlay_opacity', true) ?  get_post_meta($post->ID, 'page_header_overlay_opacity', true) : '0.3';
       if($use_overlay) {
?>
#page_header .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
       }; // END overlay

       // ランキングページ --------------------------------------------------------------------
       if(is_page_template('page-ranking-list.php')) {
         $ranking_title_font_size = get_post_meta($post->ID, 'ranking_title_font_size', true) ?  get_post_meta($post->ID, 'ranking_title_font_size', true) : '18';
         $ranking_title_font_size_mobile = get_post_meta($post->ID, 'ranking_title_font_size_mobile', true) ?  get_post_meta($post->ID, 'ranking_title_font_size_mobile', true) : '16';
?>
#ranking_list .post_carousel .title { font-size:<?php echo esc_attr($ranking_title_font_size); ?>px; }
@media screen and (max-width:750px) {
  #ranking_list .post_carousel .title { font-size:<?php echo esc_attr($ranking_title_font_size_mobile); ?>px; }
}
<?php
       }

       // LPページ --------------------------------------------------------------------
       if(is_page_template('page-lp.php')) {
         $lp_content = get_post_meta( $post->ID, 'lp_content', true );
         $content_count = 1;
         if ( $lp_content && is_array( $lp_content ) ) :
           foreach( $lp_content as $key => $content ) :

             // デザインコンテンツ ---------------------------------------------------------
             if ( $content['cb_content_select'] == 'design_content' && $content['show_content'] ) {
?>
.design_content.num<?php echo esc_attr($content_count); ?> .item .catch { font-size:<?php echo esc_attr($content['catch_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .design_content.num<?php echo esc_attr($content_count); ?> .item  .catch { font-size:<?php echo esc_attr($content['catch_font_size_mobile']); ?>px; }
}
<?php
             // カルーセル ---------------------------------------------------------
             } elseif ( $content['cb_content_select'] == 'carousel' && $content['show_content'] ) {
               $bg_color = isset($content['bg_color']) ?  $content['bg_color'] : '#f3f3f3';
?>
.cb_carousel.num<?php echo $content_count; ?> { background:<?php echo esc_html($bg_color); ?>; }
.cb_carousel.num<?php echo $content_count; ?> .content { background:<?php echo esc_html($bg_color); ?>; }
.cb_carousel.num<?php echo $content_count; ?> .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .cb_carousel.num<?php echo $content_count; ?> .title { font-size:<?php echo esc_html($content['title_font_size_mobile']); ?>px; }
}
<?php
             // フリースペース -----------------------------------------------------------------
             } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content']) {
               $catch_font_size = isset($content['catch_font_size']) ?  $content['catch_font_size'] : '32';
               $catch_font_size_mobile = isset($content['catch_font_size_mobile']) ?  $content['catch_font_size_mobile'] : '22';
?>
.lp_free_space.num<?php echo esc_attr($content_count); ?> .lp_free_space_inner { padding-top:<?php echo esc_attr($content['top_space']); ?>px; padding-bottom:<?php echo esc_attr($content['bottom_space']); ?>px; }
.lp_free_space.num<?php echo esc_attr($content_count); ?> .cb_content_header .catch { font-size:<?php echo esc_attr($catch_font_size); ?>px; }
@media screen and (max-width:750px) {
  .lp_free_space.num<?php echo esc_attr($content_count); ?> .lp_free_space_inner { padding-top:<?php echo esc_attr($content['top_space_mobile']); ?>px; padding-bottom:<?php echo esc_attr($content['bottom_space_mobile']); ?>px; }
  .lp_free_space.num<?php echo esc_attr($content_count); ?> .cb_content_header .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
}
<?php
             }
           $content_count++;
           endforeach;
         endif;
       } // END LPページ

     // 404ページ -----------------------------------------------------------------------------
     } elseif( is_404()) {

       $use_overlay = $options['page_404_use_overlay'];
       $overlay_color = hex2rgb($options['page_404_overlay_color']);
       $overlay_opacity = $options['page_404_overlay_opacity'];
       $overlay_color = implode(",",$overlay_color);
       if($use_overlay) {
?>
#page_404_header .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
       }; // END overlay

     }; //END page setting
     
     if(is_search() && ( !have_posts() || empty( get_search_query() ))){

      $use_overlay = $options['page_search_use_overlay'];
      $overlay_color = hex2rgb($options['page_search_overlay_color']);
      $overlay_opacity = $options['page_search_overlay_opacity'];
      $overlay_color = implode(",",$overlay_color);
      if($use_overlay) {
?>
#page_search_header .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
      }; // END overlay
     }

     // カスタムCSS --------------------------------------------
     if(is_single() || is_page()) {
       global $post;
       $custom_css = get_post_meta($post->ID, 'custom_css', true);
       if($custom_css) {
         echo $custom_css;
       };
     }

     // ロード画面 -----------------------------------------
     get_template_part('functions/loader_css');
     if($options['load_icon'] == 'type4' || $options['load_icon'] == 'type5'){
?>
#site_loader_logo_inner .message { font-size:<?php echo esc_html($options['loading_message_font_size']); ?>px; color:<?php echo esc_html($options['loading_message_color']); ?>; }
#site_loader_logo_inner i { background:<?php echo esc_html($options['loading_message_color']); ?>; }
<?php
     if($options['load_icon'] == 'type5'){
       $load_type5_catch_font_size_middle = ($options['load_type5_catch_font_size'] + $options['load_type5_catch_font_size_sp']) / 2;
?>
#site_loader_logo_inner .catch { font-size:<?php echo esc_html($options['load_type5_catch_font_size']); ?>px; color:<?php echo esc_html($options['load_type5_catch_color']); ?>; }
@media screen and (max-width:1100px) {
  #site_loader_logo_inner .catch { font-size:<?php echo esc_attr(ceil($load_type5_catch_font_size_middle)); ?>px; }
}
<?php }; ?>
@media screen and (max-width:750px) {
  #site_loader_logo_inner .message { font-size:<?php echo esc_html($options['loading_message_font_size_sp']); ?>px; }
  <?php if($options['load_icon'] == 'type5'){ ?>
  #site_loader_logo_inner .catch { font-size:<?php echo esc_html($options['load_type5_catch_font_size_sp']); ?>px; }
  <?php }; ?>
}
<?php
     };

     //フッターバー --------------------------------------------
     if(is_mobile()) {
       if($options['footer_bar_type'] == 'type1' && $options['footer_bar_display'] != 'type3'){
         $footer_bar_border_color = hex2rgb($options['footer_bar_border_color']);
         $footer_bar_border_color = implode(",",$footer_bar_border_color);
?>
#dp-footer-bar { background:<?php echo esc_attr($options['footer_bar_bg_color']); ?>; color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a { border-color:rgba(<?php echo esc_attr($footer_bar_border_color); ?>,<?php echo esc_html($options['footer_bar_border_color_opacity']); ?>); color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a:hover { border-color:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; background:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; }
<?php
       } elseif($options['footer_bar_type'] == 'type2' && $options['footer_bar_display'] != 'type3'){
         for($i = 1; $i <= 2; $i++) {
           if($options['show_footer_button'.$i]) {
             $footer_button_bg_color_hover = ($options['footer_button_bg_color_hover_use_sub'.$i] != 1) ? $options['footer_button_bg_color_hover'.$i] : $options['main_color'];
?>
#dp-footer-bar a.footer_button.num<?php echo $i; ?> { font-size:<?php echo esc_attr($options['footer_button_font_size']); ?>px; color:<?php echo esc_attr($options['footer_button_font_color'.$i]); ?>; background:<?php echo esc_attr($options['footer_button_bg_color'.$i]); ?>; }
#dp-footer-bar a.footer_button.num<?php echo $i; ?>:hover { background:<?php echo esc_attr($footer_button_bg_color_hover); ?>; }
<?php
           }
         };
       };
     };
?>
<?php
	// tcd_head_css_current_page action
	do_action( 'tcd_head_css_current_page' );
?>
</style>

<?php
     // JavaScriptの設定はここから　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

     // トップページ
     if(is_front_page()) {

       $index_slider = '';
       $display_header_content = '';

       if(!is_mobile() && $options['show_index_slider']) {
         $index_slider = $options['index_slider'];
         $display_header_content = 'show';
         $device = '';
       } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type2') ) {
         $index_slider = $options['mobile_index_slider'];
         $display_header_content = 'show';
         $device = 'mobile_';
       } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type1') ) {
         $index_slider = $options['index_slider'];
         $display_header_content = 'show';
         $device = '';
       }

       if($display_header_content == 'show'){
         wp_enqueue_style('slick-style', get_template_directory_uri() . '/js/slick.css', '', '1.0.0');
         wp_enqueue_script('slick-script', get_template_directory_uri() . '/js/slick.min.js', '', '1.0.0', true);
         $index_slider_time = $options[$device . 'index_slider_time'];
         if($options['show_load_screen'] == 'type1'){
?>
<script type="text/javascript">
jQuery(document).ready(function($){
<?php get_template_part('functions/slider_ini'); ?>
});
</script>
<?php
         };
       }; // END $display_header_content

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
             wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
             wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.css', array(), '2.3.4' );
             $carousel_type = $content['carousel_type'];
             if(is_mobile()) {
               $post_num = $content['post_num_mobile'];
             } else {
               $post_num = $content['post_num'];
             }
             $post_type = $content['post_type'];
             if($post_type == 'recent_post'){
               $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num);
             } else {
               $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on' );
             }
             $post_list = new wp_query($args);
             $total_post = $post_list->post_count;
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  if ($('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').length){
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').on('initialized.owl.carousel',function() {
      var win_width = $(window).width();
      if (window.matchMedia('(min-width: 2020px)').matches) {
        var item_width = (win_width - 200) / 5 - 24;
      } else if (window.matchMedia('(min-width: 1620px)').matches) {
        var item_width = (win_width - 200) / 4 - 22.5;
      } else if (window.matchMedia('(min-width: 1201px)').matches) {
        var item_width = (win_width - 200) / 3 - 20;
      } else if (window.matchMedia('(min-width: 950px)').matches) {
        var item_width = (win_width - 60) / 3 - 20;
      } else if (window.matchMedia('(min-width: 650px)').matches) {
        var item_width = (win_width - 60) / 2 - 15;
      } else {
        var item_width = win_width - 40;
      }
      $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?> .item').css('width', item_width);
    });
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').owlCarousel({
      autoplay: true,
      autoplayHoverPause: true,
      autoplayTimeout: 5000,
      autoplaySpeed: 700,
      autoWidth: true,
<?php if($carousel_type == 'type1' && ($total_post > 3)){ ?>
      center: true,
<?php }; ?>
      dots: false,
      touchDrag: true,
      mouseDrag: true,
      nav: true,
      navText: ['&#xe94b', '&#xe94a'],
      responsive : {
        0 : { loop : true, items: 1, margin: 20},
        650 : { <?php if($total_post > 2){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:2, margin: 30},
        950 : { <?php if($total_post > 3){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:3, margin: 30},
      }
    });
  }
});
(function($) {
  $(window).on('load resize', function(){
    var win_width = $(window).width();
    if (window.matchMedia('(min-width: 2020px)').matches) {
      var item_width = (win_width - 200) / 5 - 24;
    } else if (window.matchMedia('(min-width: 1620px)').matches) {
      var item_width = (win_width - 200) / 4 - 22.5;
    } else if (window.matchMedia('(min-width: 1201px)').matches) {
      var item_width = (win_width - 200) / 3 - 20;
    } else if (window.matchMedia('(min-width: 950px)').matches) {
      var item_width = (win_width - 60) / 3 - 20;
    } else if (window.matchMedia('(min-width: 650px)').matches) {
      var item_width = (win_width - 60) / 2 - 15;
    } else {
      var item_width = win_width - 40;
    }
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?> .item').css('width', item_width);
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').trigger('refresh.owl.carousel');
  });
})(jQuery);
</script>
<?php
           // 投稿者一覧 --------------------------------------------------------------------------------
           } elseif ( $content['cb_content_select'] == 'author_list' && $content['show_content'] ) {
             wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
             wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.css', array(), '2.3.4' );
             $carousel_type = $content['carousel_type'];
             $total_post = count($content['author_list_order']);
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  if ($('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').length){
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').on('initialized.owl.carousel',function() {
      var win_width = $(window).width();
      if (window.matchMedia('(min-width: 2020px)').matches) {
        var item_width = (win_width - 200) / 5 - 24;
      } else if (window.matchMedia('(min-width: 1620px)').matches) {
        var item_width = (win_width - 200) / 4 - 22.5;
      } else if (window.matchMedia('(min-width: 1201px)').matches) {
        var item_width = (win_width - 200) / 4 - 22.5;
      } else if (window.matchMedia('(min-width: 950px)').matches) {
        var item_width = (win_width - 60) / 3 - 20;
      } else if (window.matchMedia('(min-width: 650px)').matches) {
        var item_width = (win_width - 60) / 2 - 15;
      } else {
        var item_width = win_width - 40;
      }
      $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?> .item').css('width', item_width);
    });
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').owlCarousel({
      autoplay: true,
      autoplayHoverPause: true,
      autoplayTimeout: 5000,
      autoplaySpeed: 700,
      autoWidth: true,
<?php if($carousel_type == 'type1' && ($total_post > 3)){ ?>
      center: true,
<?php }; ?>
      dots: false,
      touchDrag: true,
      mouseDrag: true,
      nav: true,
      navText: ['&#xe94b', '&#xe94a'],
      responsive : {
        0 : { loop : true, items: 1, margin: 20},
        650 : { <?php if($total_post > 2){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:2, margin: 30},
        950 : { <?php if($total_post > 3){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:3, margin: 30},
      }
    });
  }
});
(function($) {
  $(window).on('load resize', function(){
    var win_width = $(window).width();
    if (window.matchMedia('(min-width: 2020px)').matches) {
      var item_width = (win_width - 200) / 5 - 24;
    } else if (window.matchMedia('(min-width: 1620px)').matches) {
      var item_width = (win_width - 200) / 4 - 22.5;
    } else if (window.matchMedia('(min-width: 1201px)').matches) {
        var item_width = (win_width - 200) / 4 - 22.5;
    } else if (window.matchMedia('(min-width: 950px)').matches) {
      var item_width = (win_width - 60) / 3 - 20;
    } else if (window.matchMedia('(min-width: 650px)').matches) {
      var item_width = (win_width - 60) / 2 - 15;
    } else {
      var item_width = win_width - 40;
    }
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?> .item').css('width', item_width);
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').trigger('refresh.owl.carousel');
  });
})(jQuery);
</script>
<?php
           // タブコンテンツ --------------------------------------------------------------------------------
           } elseif ( $content['cb_content_select'] == 'featured_content' && $content['show_content'] ) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('.cb_featured .button_list').on('click', '.item', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    postlist_id = $(this).data('postlist-num');
    $(this).closest('.cb_featured').find('.featured_post').removeClass('active');
    $(this).closest('.cb_featured').find('.'+ postlist_id).addClass('active');
    $(this).closest('.cb_featured').find('.featured_post .item').removeClass('animate').fadeOut().finish().promise().done(function() {
      $(this).closest('.cb_featured').find('.'+ postlist_id + ' .animate_item').each(function(i){
        $(this).css('opacity','0').show();
        $(this).delay(i * 150).queue(function(next) {
          $(this).addClass('animate');
          next();
        });
      });
      return false;
    });
  });

<?php if(!is_mobile()){ ?>
  if ($('.cb_featured .button_list_wrap').length) {
      new SimpleBar($('.cb_featured .button_list_wrap')[0]);
  };
<?php }; ?>

});
jQuery(window).on('scroll load', function(i) {
  var scTop = jQuery(this).scrollTop();
  var scBottom = scTop + jQuery(this).height();
  jQuery('.cb_featured .first_post_list').each( function(i) {
    var thisPos = jQuery(this).offset().top + 100;
    if ( thisPos < scBottom ) {
      jQuery(this).removeClass('.first_post_list');
      jQuery(".animate_item",this).each(function(i){
        jQuery(this).delay(i * 150).queue(function(next) {
          jQuery(this).addClass('animate');
          next();
        });
      });
    }
  });
});
</script>
<?php
           // 3カラムコンテンツ --------------------------------------------------------------------------------
           } elseif ( $content['cb_content_select'] == 'trend' && $content['show_content'] ) {
             wp_enqueue_style('slick-style', get_template_directory_uri() . '/js/slick.css', '', '1.0.0');
             wp_enqueue_script('slick-script', get_template_directory_uri() . '/js/slick.min.js', '', '1.0.0', true);
?>
<script type="text/javascript">
(function($) {
  $(window).on('load resize', function(){
    $('.cb_trend .post_list.type2').css('height', '');
    var content_height = $('.trend_wrap').height();
    $('.cb_trend .post_list.type2').css('height', content_height);
    $('.cb_trend .post_list.type2 .item').css('height', content_height);
  });
})(jQuery);
jQuery(document).ready(function($){

  if( $('.cb_trend .post_list.type2').length ){
    $('.cb_trend .post_list.type2').slick({
      infinite: true,
      dots: true,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      adaptiveHeight: false,
      pauseOnHover: false,
      autoplay: true,
      fade: false,
      easing: 'easeOutExpo',
      speed: 700,
      autoplaySpeed: 5000,
    });
  }

});
</script>
<?php
           };

         $content_count++;
         endforeach;
       endif; // END content builder

     }; // END front page

     // ドロワーメニュー ------------------------------------------
     if ( ($options['side_menu_type'] == 'type2') && has_nav_menu('global-menu') ) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  if ($('#side_menu').length) {

    $("#side_menu").hover(function(){
      $('html').addClass("open_side_menu");
    }, function(){
      $('html').removeClass("open_side_menu");
    });

    $('#side_menu_content > nav > ul > .menu-item-has-children').each(function(){
      var menu_id = $(this).attr('id');
      var child_menu = $('>ul',this);
      child_menu.attr('id', menu_id + '_menu');
      $('#side_menu').append(child_menu);
    });

    $("#side_menu .menu-item-has-children").hover(function(){
      $(this).addClass('active');
      var menu_id = $(this).attr('id');
      $('#' + menu_id + "_menu").addClass('active');
    }, function(){
      $(this).removeClass('active');
      var menu_id = $(this).attr('id');
      $('#' + menu_id + "_menu").removeClass('active');
    });

    $("#side_menu > .sub-menu").hover(function(){
      var parent_class = $(this).attr('id').replace(/_menu/g,"");
      $('.' + parent_class).addClass('active');
      $(this).addClass('active');
      $(this).attr('active');
    }, function(){
      var parent_class = $(this).attr('id').replace(/_menu/g,"");
      $('.' + parent_class).removeClass('active');
      $(this).removeClass('active');
    });

    $("#side_menu .sub-menu .menu-item-has-children").hover(function(){
       $(">ul:not(:animated)",this).slideDown("fast");
       $(this).addClass("active");
    }, function(){
       $(">ul",this).slideUp("fast");
       $(this).removeClass("active");
    });

    var side_menu_top_pos = $('#side_menu_content nav').position().top;
    $('#side_menu > .sub-menu').each(function(){
      $(this).css('padding-top',side_menu_top_pos);
    });

  };

});
</script>
<?php
     // サイドメニュータイプ1 --------------------------
     } else {
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  if ($('#side_menu').length) {

    $('#side_menu_button').click(function() {
      $('html').toggleClass("open_side_menu");
      return false;
    });

    $('#mega_menu .close_button').click(function() {
      $('html').toggleClass("open_side_menu");
    });
    $('#mega_menu .mobile_close_button').click(function() {
      $('html').toggleClass("open_menu");
    });

    new SimpleBar($('#mega_menu')[0]);

<?php if(!is_mobile()){ ?>
    if ($('#mega_menu_mobile_global_menu').length) {
      new SimpleBar($('#mega_menu_mobile_global_menu')[0]);
    };
<?php }; ?>

<?php
     $post_cats = get_terms("category",'orderby=term_order&hide_empty=true');
     if ( $post_cats && ! is_wp_error( $post_cats ) ) {
       $cat_count = 0;
       foreach( $post_cats as $cat ){
         $cat_id = $cat->term_id;
         if($options['cat'.$cat_id]){
           $cat_count++;
         }
       }
     }
?>

    if ($('#mega_category').length) {
      $('#mega_category .post_list').owlCarousel({
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 700,
        autoWidth: false,
        dots: false,
        touchDrag: true,
        mouseDrag: true,
        nav: true,
        navText: ['&#xe94b', '&#xe94a'],
        item: 3,
        responsive : {
          0 : { margin: 15,
<?php if($cat_count >= 3){ ?>
        loop: true,
<?php }; ?>
        },
          950 : { margin: 30,
<?php if($cat_count > 3){ ?>
        loop: true,
<?php }else{ ?>
        loop: false,
<?php }; ?>
        },
        }
      });
    };

  };

});
</script>
<?php
     };

     // ブログアーカイブページ -------------------------------------------------------------
     if(is_archive() || is_home() || is_search()){
       if (is_category()) {
         $query_obj = get_queried_object();
         $cat_id = $query_obj->term_id;
         $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
         $show_carousel =  (isset($term_meta['show_carousel']) && !empty($term_meta['show_carousel'])) ? $term_meta['show_carousel'] : '';
       } else {
         $show_carousel = $options['show_archive_carousel'];
       }
       if($show_carousel) {
         if(is_mobile()) {
           $post_num = $options['archive_carousel_num_mobile'];
         } else {
           $post_num = $options['archive_carousel_num'];
         }
         if (is_category()) {
           $post_type =  (isset($term_meta['archive_carousel_post_type']) && !empty($term_meta['archive_carousel_post_type'])) ? $term_meta['archive_carousel_post_type'] : 'pickup_post';
           $post_order =  (isset($term_meta['archive_carousel_post_order']) && !empty($term_meta['archive_carousel_post_order'])) ? $term_meta['archive_carousel_post_order'] : 'rand';
           $args = array( 'cat' => $cat_id, 'post_type' => 'post', 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on', 'orderby' => $post_order );
         } else {
           $post_type = $options['archive_carousel_post_type'];
           $post_order = $options['archive_carousel_post_order'];
           $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on', 'orderby' => $post_order );
         }
         $post_list = new wp_query($args);
         if($post_list->have_posts()){
           $total_post = $post_list->post_count;
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  if ($('.post_carousel_type1').length){
    $('.post_carousel_type1').on('initialized.owl.carousel',function() {
      var win_width = $(window).width();
      if (window.matchMedia('(min-width: 2020px)').matches) {
        var item_width = (win_width - 200) / 5 - 24;
      } else if (window.matchMedia('(min-width: 1620px)').matches) {
        var item_width = (win_width - 200) / 4 - 22.5;
      } else if (window.matchMedia('(min-width: 1201px)').matches) {
        var item_width = (win_width - 200) / 3 - 20;
      } else if (window.matchMedia('(min-width: 950px)').matches) {
        var item_width = (win_width - 60) / 3 - 20;
      } else if (window.matchMedia('(min-width: 650px)').matches) {
        var item_width = (win_width - 60) / 2 - 15;
      } else {
        var item_width = win_width - 40;
      }
      $('.post_carousel_type1 .item').css('width', item_width);
    });
    $('.post_carousel_type1').owlCarousel({
      autoplay: true,
      autoplayHoverPause: true,
      autoplayTimeout: 5000,
      autoplaySpeed: 700,
      autoWidth: true,
<?php if($total_post > 3){ ?>
      center: true,
<?php }; ?>
      dots: false,
      touchDrag: true,
      mouseDrag: true,
      nav: true,
      navText: ['&#xe94b', '&#xe94a'],
      responsive : {
        0 : { loop : true, items: 1, margin: 20},
        650 : { <?php if($total_post > 2){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:2, margin: 30},
        950 : { <?php if($total_post > 3){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:3, margin: 30},
      }
    });
  }
});
(function($) {
  $(window).on('load resize', function(){
    var win_width = $(window).width();
    if (window.matchMedia('(min-width: 2020px)').matches) {
      var item_width = (win_width - 200) / 5 - 24;
    } else if (window.matchMedia('(min-width: 1620px)').matches) {
      var item_width = (win_width - 200) / 4 - 22.5;
    } else if (window.matchMedia('(min-width: 1201px)').matches) {
      var item_width = (win_width - 200) / 3 - 20;
    } else if (window.matchMedia('(min-width: 950px)').matches) {
      var item_width = (win_width - 60) / 3 - 20;
    } else if (window.matchMedia('(min-width: 650px)').matches) {
      var item_width = (win_width - 60) / 2 - 15;
    } else {
      var item_width = win_width - 40;
    }
    $('.post_carousel_type1 .item').css('width', item_width);
    $('.post_carousel_type1').trigger('refresh.owl.carousel');
  });
})(jQuery);
</script>
<?php
         };
       };

       if (!is_mobile()) {
?>
<script>
jQuery(function($){
	var $blog_archive = $('#blog_archive');
	if ($blog_archive.length) {
		$blog_archive.on('click', '.page_navi a.page-numbers', function() {
			if ($blog_archive.hasClass('loading')) return false;

			var self = this;
			var $blog_list = $blog_archive.find('.blog_list');
			var $page_navi = $blog_archive.find('.page_navi');

			$blog_archive.addClass('loading');

			// ajax
			$.ajax({
				url: this.href,
				type: 'GET',
				dataType: 'html'
			}).success(function(data, textStatus, XMLHttpRequest) {
				$blog_archive.removeClass('loading');

				var $data_blog_archive = $($.parseHTML(data)).find('#blog_archive');
				if ($data_blog_archive.length) {
					// html replace
					$blog_list.html($data_blog_archive.find('.blog_list').html());
					$page_navi.html($data_blog_archive.find('.page_navi').html());

					// scroll and trigger
					var st = $blog_list.offset().top || 0;
					if (st) {
						if (window.innerWidth > 1200) {
							st -= 155;
						} else {
							st -= 98;
						}
					}
					$(window).scrollTop(st).trigger('scroll');
				} else {
					console.log('ajax data error');
				}
			}).error(function(XMLHttpRequest, textStatus, errorThrown) {
				$blog_archive.removeClass('loading');
				console.log('ajax error');
			});

			return false;
		});
	}
});
</script>
<?php
       }
     };

     // カルーセル（詳細ページ） -------------------------------------------------------------
     if(is_single()){
       if($options['show_related_post']) {
         global $post;
         $categories = get_the_category($post->ID);
         if ($categories) {
           $post_num = $options['related_post_num'];
           if(is_mobile()){
             $post_num = $options['related_post_num_mobile'];
           }
           $category_ids = array();
           foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
           $args = array( 'category__in' => $category_ids, 'post__not_in' => array($post->ID), 'showposts'=> $post_num, 'orderby' => 'rand');
           $post_list = new wp_query($args);
           $total_post = $post_list->post_count;
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  if ($('.post_carousel_type2').length){
    $('.post_carousel_type2').on('initialized.owl.carousel',function() {
      var win_width = $(window).width();
      if (window.matchMedia('(min-width: 2020px)').matches) {
        var item_width = (win_width - 200) / 5 - 24;
      } else if (window.matchMedia('(min-width: 1620px)').matches) {
        var item_width = (win_width - 200) / 4 - 22.5;
      } else if (window.matchMedia('(min-width: 1201px)').matches) {
        var item_width = (win_width - 200) / 3 - 20;
      } else if (window.matchMedia('(min-width: 950px)').matches) {
        var item_width = (win_width - 60) / 3 - 20;
      } else if (window.matchMedia('(min-width: 650px)').matches) {
        var item_width = (win_width - 60) / 2 - 15;
      } else {
        var item_width = win_width - 40;
      }
      $('.post_carousel_type2 .item').css('width', item_width);
    });
    $('.post_carousel_type2').owlCarousel({
      autoplay: true,
      autoplayHoverPause: true,
      autoplayTimeout: 5000,
      autoplaySpeed: 700,
      autoWidth: true,
      dots: false,
      touchDrag: true,
      mouseDrag: true,
      nav: true,
      navText: ['&#xe94b', '&#xe94a'],
      responsive : {
        0 : { loop : true, items: 1, margin: 20},
        650 : { <?php if($total_post > 2){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:2, margin: 30},
        950 : { <?php if($total_post > 3){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:3, margin: 30},
      }
    });
  }
});
(function($) {
  $(window).on('load resize', function(){
    var win_width = $(window).width();
    if (window.matchMedia('(min-width: 2020px)').matches) {
      var item_width = (win_width - 200) / 5 - 24;
    } else if (window.matchMedia('(min-width: 1620px)').matches) {
      var item_width = (win_width - 200) / 4 - 22.5;
    } else if (window.matchMedia('(min-width: 1201px)').matches) {
      var item_width = (win_width - 200) / 3 - 20;
    } else if (window.matchMedia('(min-width: 950px)').matches) {
      var item_width = (win_width - 60) / 3 - 20;
    } else if (window.matchMedia('(min-width: 650px)').matches) {
      var item_width = (win_width - 60) / 2 - 15;
    } else {
      var item_width = win_width - 40;
    }
    $('.post_carousel_type2 .item').css('width', item_width);
    $('.post_carousel_type2').trigger('refresh.owl.carousel');
  });
})(jQuery);
</script>
<?php
         };
       };
       // ブログ詳細ページ ---------------------------------
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('.author_profile .tab1').on('click', function(){
    $(this).addClass('active');
    $('.author_profile .tab2').removeClass('active');
    $('#author_info').addClass('active');
    $('#author_post').removeClass('active');
    return false;
  });
  $('.author_profile .tab2').on('click', function(){
    $(this).addClass('active');
    $('.author_profile .tab1').removeClass('active');
    $('#author_info').removeClass('active');
    $('#author_post').addClass('active');
    return false;
  });

<?php
  global $toc_id_name;
  $content = get_the_content();
  $headings = get_toc_headings($content);
  if(isset($headings)):
?>
  if ($('#side_col .widget_content').length){
    var last_widget = $('#side_col .widget_content:last-child');
    var last_widget_height = last_widget.innerHeight();
    var last_widget_top = last_widget.offset().top;
    var main_col = $('#main_col');
    $(window).bind('scroll load resize', function(i) {
      var main_col_height = main_col.height();
      var main_col_top = main_col.offset().top;
      var scTop = $(this).scrollTop();
      if ( scTop > last_widget_top - 135) {
        last_widget.addClass('active');
      } else {
        last_widget.removeClass('active');
      }
      if ( scTop > main_col_height + main_col_top - last_widget_height - 85) {
        last_widget.addClass('active_off');
      } else {
        last_widget.removeClass('active_off');
      }
    });
  };
<?php endif; ?>
  if ($('.featured_widget .widget_content').length){
    var featured_widget = $('.featured_widget');
    var featured_widget_height = featured_widget.innerHeight();
    var featured_widget_top = featured_widget.offset().top;
    var featured_main_content = $('.featured_post');
    $(window).bind('scroll load resize', function(i) {
      var featured_main_content_height = featured_main_content.height();
      var featured_main_content_top = featured_main_content.offset().top;
      var featured_content_wrap_width = $('.featured_content_wrap').width();
      var featured_main_content_width = featured_main_content.width();
      if( featured_main_content_height > featured_widget_height){
        var scTop = $(this).scrollTop();
        if ( scTop > featured_widget_top - 125) {
          featured_widget.addClass('active');
          featured_widget.css('width', featured_content_wrap_width - featured_main_content_width);
        } else {
          featured_widget.removeClass('active');
          featured_widget.css('width', '');
        }
        if ( scTop > featured_main_content_height + featured_main_content_top - featured_widget_height - 175) {
          featured_widget.addClass('active_off');
        } else {
          featured_widget.removeClass('active_off');
        }
      }
    });
  };
});
(function($) {
  $(window).on('load resize', function(){
    if ($('.tcd_toc_widget').length){
      $(".tcd_toc_widget .toc_link").each(function () {
        var divheight = $(this).height();
        var lineheight = $(this).css('line-height').replace("px","");
        var line_num = Math.round(divheight/parseInt(lineheight));
        if(line_num >= 2){
          $(this).closest('.tcd_toc_widget').addClass('no_underline');
        }
      });
    };
  });
})(jQuery);
</script>
<?php
     };

     // 固定ページ ----------------------------------------------------------
     if(is_page()) {
       global $post;
       $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  <?php if($page_hide_footer){ ?>
  $(window).on('scroll load', function(i) {
    var scTop = $(this).scrollTop();
    var scBottom = scTop + $(this).height();
    var docHeight = $(document).innerHeight();
    var windowHeight = $(this).innerHeight();
    var pageBottom = docHeight - windowHeight;
    if(pageBottom <= scTop + 200) {
      $('.inview').each( function(i) {
        $(this).addClass('animate');
      });
    }
  });
  <?php }; ?>

  <?php
       // 全画面ヘッダー
       $page_header_height = get_post_meta($post->ID, 'page_header_height', true) ?  get_post_meta($post->ID, 'page_header_height', true) : 'type1';
       $page_header_type = get_post_meta($post->ID, 'page_header_type', true) ?  get_post_meta($post->ID, 'page_header_type', true) : 'type1';
       if(($page_header_type == 'type1') && ($page_header_height == 'type2')){
  ?>
  var winH = $(window).innerHeight();
  var header_height = $('#header').innerHeight();
  if ($('#header').is(':hidden')) {
    header_height = '0';
  }
  $('#page_header.full_height').css('height', winH - header_height);
  $("#page_contents_link").off('click');
  $("#page_contents_link").on('click',function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top - header_height;
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });
  $(window).on('resize', function(){
    var winH = $(window).innerHeight();
    var header_height = $('#header').innerHeight();
    if ($('#header').is(':hidden')) {
      header_height = '0';
    }
    $('#page_header.full_height').css('height', winH - header_height);
    $("#page_contents_link").off('click');
    $("#page_contents_link").on('click',function() {
      var myHref= $(this).attr("href");
      var myPos = $(myHref).offset().top - header_height;
      $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
      return false;
    });
  });
  <?php }; ?>

});
</script>
<?php
     };


     // LPページ ------------------------------------------------------------
     if(is_page_template('page-lp.php')) {
       global $post;
       $lp_content = get_post_meta( $post->ID, 'lp_content', true );
       $content_count = 1;
       if ( $lp_content && is_array( $lp_content ) ) :
         foreach( $lp_content as $key => $content ) :

           // カルーセル ---------------------------------------------------------
           if ( $content['cb_content_select'] == 'carousel' && $content['show_content'] ) {
             wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
             wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.css', array(), '2.3.4' );
             $carousel_type = $content['carousel_type'];
             if(is_mobile()) {
               $post_num = $content['post_num_mobile'];
             } else {
               $post_num = $content['post_num'];
             }
             $post_type = $content['post_type'];
             if($post_type == 'recent_post'){
               $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num);
             } else {
               $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on' );
             }
             $post_list = new wp_query($args);
             $total_post = $post_list->post_count;
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  if ($('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').length){
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').on('initialized.owl.carousel',function() {
      var win_width = $(window).width();
      if (window.matchMedia('(min-width: 2020px)').matches) {
        var item_width = (win_width - 200) / 5 - 24;
      } else if (window.matchMedia('(min-width: 1620px)').matches) {
        var item_width = (win_width - 200) / 4 - 22.5;
      } else if (window.matchMedia('(min-width: 1201px)').matches) {
        var item_width = (win_width - 200) / 3 - 20;
      } else if (window.matchMedia('(min-width: 950px)').matches) {
        var item_width = (win_width - 60) / 3 - 20;
      } else if (window.matchMedia('(min-width: 650px)').matches) {
        var item_width = (win_width - 60) / 2 - 15;
      } else {
        var item_width = win_width - 40;
      }
      $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?> .item').css('width', item_width);
    });
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').owlCarousel({
      autoplay: true,
      autoplayHoverPause: true,
      autoplayTimeout: 5000,
      autoplaySpeed: 700,
      autoWidth: true,
<?php if($carousel_type == 'type1' && $total_post > 3){ ?>
      center: true,
<?php }; ?>
      dots: false,
      touchDrag: true,
      mouseDrag: true,
      nav: true,
      navText: ['&#xe94b', '&#xe94a'],
      responsive : {
        0 : { loop : true, items: 1, margin: 20},
        650 : { <?php if($total_post > 2){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:2, margin: 30},
        950 : { <?php if($total_post > 3){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:3, margin: 30},
      }
    });
  }
});
(function($) {
  $(window).on('load resize', function(){
    var win_width = $(window).width();
    if (window.matchMedia('(min-width: 2020px)').matches) {
      var item_width = (win_width - 200) / 5 - 24;
    } else if (window.matchMedia('(min-width: 1620px)').matches) {
      var item_width = (win_width - 200) / 4 - 22.5;
    } else if (window.matchMedia('(min-width: 1201px)').matches) {
      var item_width = (win_width - 200) / 3 - 20;
    } else if (window.matchMedia('(min-width: 950px)').matches) {
      var item_width = (win_width - 60) / 3 - 20;
    } else if (window.matchMedia('(min-width: 650px)').matches) {
      var item_width = (win_width - 60) / 2 - 15;
    } else {
      var item_width = win_width - 40;
    }
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?> .item').css('width', item_width);
    $('#cb_content_<?php echo $content_count; ?> .post_carousel_<?php echo esc_html($carousel_type); ?>').trigger('refresh.owl.carousel');
  });
})(jQuery);
</script>
<?php
           }
         $content_count++;
         endforeach;
       endif;
     };

     // ランキングページ ------------------------------------------------------------
     if(is_page_template('page-ranking-list.php')) {
       global $post;
?>
<script type="text/javascript">
<?php
     for ( $i = 1; $i <= 3; $i++ ) :
       $show_ranking_list = get_post_meta($post->ID, 'show_ranking_list'.$i, true);
       if ($show_ranking_list == '1'){
         $post_num = get_post_meta($post->ID, 'ranking_list_post_num'.$i, true) ?  get_post_meta($post->ID, 'ranking_list_post_num'.$i, true) : '10';
         $rank_range = get_post_meta($post->ID, 'ranking_list_range'.$i, true) ?  get_post_meta($post->ID, 'ranking_list_range'.$i, true) : '';
         $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1);
         $post_list = get_posts_views_ranking( $rank_range, $args, 'WP_Query' );
         $total_post = $post_list->post_count;
         if ($post_list->have_posts()) {
?>
jQuery(document).ready(function($){
  if ($('#ranking_list<?php echo $i; ?> .post_carousel_type2').length){
    $('#ranking_list<?php echo $i; ?> .post_carousel_type2').on('initialized.owl.carousel',function() {
      var win_width = $(window).width();
      if (window.matchMedia('(min-width: 2020px)').matches) {
        var item_width = (win_width - 200) / 5 - 24;
      } else if (window.matchMedia('(min-width: 1620px)').matches) {
        var item_width = (win_width - 200) / 4 - 22.5;
      } else if (window.matchMedia('(min-width: 1201px)').matches) {
        var item_width = (win_width - 200) / 3 - 20;
      } else if (window.matchMedia('(min-width: 950px)').matches) {
        var item_width = (win_width - 60) / 3 - 20;
      } else if (window.matchMedia('(min-width: 650px)').matches) {
        var item_width = (win_width - 60) / 2 - 15;
      } else {
        var item_width = win_width - 40;
      }
      $('#ranking_list<?php echo $i; ?> .post_carousel_type2 .item').css('width', item_width);
    });
    $('#ranking_list<?php echo $i; ?> .post_carousel_type2').owlCarousel({
      autoplay: true,
      autoplayHoverPause: true,
      autoplayTimeout: 5000,
      autoplaySpeed: 700,
      autoWidth: true,
      dots: false,
      touchDrag: true,
      mouseDrag: true,
      nav: true,
      navText: ['&#xe94b', '&#xe94a'],
      responsive : {
        0 : { loop : true, items: 1, margin: 20},
        650 : { <?php if($total_post > 2){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:2, margin: 30},
        950 : { <?php if($total_post > 3){ echo 'loop : true'; } else { echo 'loop : false'; }; ?>, items:3, margin: 30},
      }
    });
  }
});
(function($) {
  $(window).on('load resize', function(){
    var win_width = $(window).width();
    if (window.matchMedia('(min-width: 2020px)').matches) {
      var item_width = (win_width - 200) / 5 - 24;
    } else if (window.matchMedia('(min-width: 1620px)').matches) {
      var item_width = (win_width - 200) / 4 - 22.5;
    } else if (window.matchMedia('(min-width: 1201px)').matches) {
      var item_width = (win_width - 200) / 3 - 20;
    } else if (window.matchMedia('(min-width: 950px)').matches) {
      var item_width = (win_width - 60) / 3 - 20;
    } else if (window.matchMedia('(min-width: 650px)').matches) {
      var item_width = (win_width - 60) / 2 - 15;
    } else {
      var item_width = win_width - 40;
    }
    $('#ranking_list<?php echo $i; ?> .post_carousel_type2 .item').css('width', item_width);
    $('#ranking_list<?php echo $i; ?> .post_carousel_type2').trigger('refresh.owl.carousel');
  });
})(jQuery);
<?php
         };
       };
     endfor;
?>
</script>
<?php
     }

     // スライダーウィジェット --------------------
     if ( is_single() && is_active_widget(false, false, 'post_slider_widget', true) || is_page() && is_active_widget(false, false, 'post_slider_widget', true)) {
       wp_enqueue_style('slick-style', get_template_directory_uri() . '/js/slick.css', '', '1.0.0');
       wp_enqueue_script('slick-script', get_template_directory_uri() . '/js/slick.min.js', '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  if( $('.post_slider_widget').length ){
    $('.post_slider_widget .post_slider').slick({
      infinite: true,
      dots: true,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      adaptiveHeight: false,
      pauseOnHover: false,
      autoplay: true,
      fade: false,
      easing: 'easeOutExpo',
      speed: 700,
      autoplaySpeed: 5000,
    });
  }

});
</script>
<?php
     } // スライダーウィジェット

     // ランキングウィジェット --------------------
     if ( is_single() && is_active_widget(false, false, 'ranking_post_list_widget', true) || is_page() && is_active_widget(false, false, 'ranking_post_list_widget', true)) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  var rank_num = $('.ranking_post_list_widget .headline').length;
  $('.ranking_post_list_widget').addClass('rank_num'+rank_num);

  $('.rank_headline').on('click', '.headline', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    postlist_id = $(this).data('postlist-num');
    $(this).closest('.rank_post_wrap').attr('data-active-postlist',postlist_id);
    return false;
  });

});
</script>
<?php
     } // ランキングウィジェット

    // 目次のスクロールアニメーション
    if(is_singular() && $options['use_toc_scroll_animation'] && !is_front_page()){
?>
<script>
jQuery(document).ready(function($){
  $('#tcd_toc a[href^="#"], .toc_widget_wrap a[href^="#"]').on('click',function() {
    var toc_href= $(this).attr("href");
    var target = $(toc_href).offset().top - 100;
    $("html,body").animate({scrollTop : target}, 1000, 'easeOutExpo');
    return false;
  });
});
</script>
<?php
    }// use_toc_scroll_animation

     // 404 --------------------------------------------
     if(is_404()) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  $('#page_404_header').addClass('animate');
  var winH = $(window).innerHeight();
  var footer_height = $('#footer').innerHeight();
  var header_height = $('#header').innerHeight();
  if( $(window).innerWidth() > 1201 ){
      $('#page_404_header').css('height', winH -  footer_height );
    }else{
      $('#page_404_header').css('height', winH - header_height - footer_height );
    }
  $(window).on('resize', function(){
    var winH = $(window).innerHeight();
    var footer_height = $('#footer').innerHeight();
    var header_height = $('#header').innerHeight();
    if( $(window).innerWidth() > 1201 ){
      $('#page_404_header').css('height', winH -  footer_height );
    }else{
      $('#page_404_header').css('height', winH - header_height - footer_height );
    }
  });
});
</script>
<?php
     };
          // search --------------------------------------------
          if(is_search() && ( !have_posts() || empty( get_search_query() ))) {
            ?>
            <script type="text/javascript">
            jQuery(document).ready(function($){
              $('#page_search_header').addClass('animate');
              var winH = $(window).innerHeight();
              var footer_height = $('#footer').innerHeight();
              var header_height = $('#header').innerHeight();
              if( $(window).innerWidth() > 1201 ){
                  $('#page_search_header').css('height', winH -  footer_height );
                }else{
                  $('#page_search_header').css('height', winH - header_height - footer_height );
                }
              
              $(window).on('resize', function(){
                var winH = $(window).innerHeight();
                var footer_height = $('#footer').innerHeight();
                var header_height = $('#header').innerHeight();
                if( $(window).innerWidth() > 1201 ){
                  $('#page_search_header').css('height', winH -  footer_height );
                }else{
                  $('#page_search_header').css('height', winH - header_height - footer_height );
                }
              });
            });
            </script>
            <?php
                 };

     // カスタムスクリプト--------------------------------------------
     if($options['script_code']) {
       echo $options['script_code'];
     };
     if(is_single() || is_page()) {
       global $post;
       $custom_script = get_post_meta($post->ID, 'custom_script', true);
       if($custom_script) {
         echo $custom_script;
       };
     };
?>

<?php
     }; // END function tcd_head()
     add_action("wp_head", "tcd_head");

// スライダースクリプトのキューイング
function tcd_enqueue_slider_scripts() {

  wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
  wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.css', array(), '2.3.4' );

}
add_action( 'wp_enqueue_scripts', 'tcd_enqueue_slider_scripts' );
?>
