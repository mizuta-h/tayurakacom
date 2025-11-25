<?php
/*
Template Name:Author list page
*/
__('Author list page', 'tcd-w');
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
 <a class="animate_item" id="page_contents_link" href="#author_list"></a>
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

<div id="author_list" class="inview">

 <?php
      $author_list_order = get_post_meta($post->ID, 'author_list_order', true);
      if (empty($author_list_order) || !is_array($author_list_order)) {
        $author_list_order = array();
      }

      $users = get_users(array(
        'fields' => array('ID'),
        'role__not_in' => array('subscriber','contributor'),
        'orderby' => 'ID',
        'order' => 'ASC'
      ));

      if ($users) {
        $user_ids = array();
        foreach ($users as $user) {
          $user_ids[] = $user->ID;
        }

        if ($author_list_order) {
          foreach ($author_list_order as $key => $author_id) {
            if (!in_array($author_id, $user_ids)) {
              unset($author_list_order[$key]);
            }
          }
        }

        foreach ($user_ids as $user_id) {
          if (!in_array($user_id, $author_list_order)) {
            $author_list_order[] = $user_id;
          }
        }

        unset($user_ids, $user_id);
      } else {
        $author_list_order = array();
      }
      unset($users);
      if ($author_list_order) {
        foreach((array) $author_list_order as $author_id) :
          $user_data = get_userdata($author_id);
          $user_name = $user_data->display_name;
          $catch = $user_data->catch;
          $author_url = get_author_posts_url($author_id);
          $show_author_list = $user_data->show_author_list;
          if($show_author_list) {
 ?>
 <article class="item">
  <a class="animate_image" href="<?php echo esc_url($author_url); ?>">
   <div class="avatar_area">
    <?php echo wp_kses_post(get_avatar($author_id, 360)); ?>
   </div>
   <h2 class="name"><?php echo esc_html($user_data->display_name); ?></h2>
  </a>
  <?php if($catch) { ?>
  <p class="catch"><?php echo esc_html($catch); ?></p>
  <?php }; ?>
 </article>
 <?php
          };
        endforeach;
      };
 ?>

</div><!-- END #author_list -->

<?php get_footer(); ?>