<?php

function author_list_meta_box() {
  add_meta_box(
    'author_list_meta_box',//ID of meta box
    __('Author list page setting', 'tcd-w'),//label
    'show_author_list_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'author_list_meta_box');

function show_author_list_meta_box() {
  global $post;


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

  echo '<input type="hidden" name="author_list_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap">

 <div class="theme_option_message" style="margin-top:0;">
  <p><?php _e('Please check the checkbox "Show author profile at author list page" from each user <a href="./users.php">profile page</a> before you use this function.<br>You can change author order by dragging each headline of option field.', 'tcd-w');  ?></p>
 </div>

 <?php // 投稿者一覧の並び替え ----- ?>
 <div id="author_list_order">

  <?php
       foreach((array) $author_list_order as $author_id) :
           $user_data = get_userdata($author_id);
           $user_name = $user_data->display_name;
           $show_author_list = $user_data->show_author_list;
  ?>
  <div class="item"<?php if(empty($show_author_list)) { echo ' style="display:none;"'; }; ?>>
   <h3 class="name"><?php echo esc_html($user_name); ?></h3>
   <input type="hidden" name="author_list_order[]" value="<?php echo esc_attr($author_id); ?>" />
  </div>
  <?php endforeach; ?>

 </div><!-- END #author_list_order -->

</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_author_list_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['author_list_meta_box_nonce']) || !wp_verify_nonce($_POST['author_list_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array();
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

  // repeater save or delete
  $cf_keys = array('author_list_order');
  foreach ( $cf_keys as $cf_key ) {
    $old = get_post_meta( $post_id, $cf_key, true );

    if ( isset( $_POST[$cf_key] ) && is_array( $_POST[$cf_key] ) ) {
      $new = array_values( $_POST[$cf_key] );
    } else {
      $new = false;
    }

    if ( $new && $new != $old ) {
      update_post_meta( $post_id, $cf_key, $new );
    } elseif ( ! $new && $old ) {
      delete_post_meta( $post_id, $cf_key, $old );
    }
  }

}
add_action('save_post', 'save_author_list_meta_box');




?>
