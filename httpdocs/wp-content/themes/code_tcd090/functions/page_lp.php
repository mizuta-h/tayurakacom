<?php

function lp_meta_box() {
  $options = get_design_plus_option();
  add_meta_box(
    'lp_meta_box',//ID of meta box
    __('LP page setting', 'tcd-w'),//label
    'show_lp_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'lp_meta_box');

function show_lp_meta_box() {

  global $post, $font_type_options;

  // コンテンツビルダー
  $lp_content = get_post_meta( $post->ID, 'lp_content', true );

  echo '<input type="hidden" name="lp_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap contents_builder_wrap">

 <div class="theme_option_message">
  <?php echo __( '<p>STEP1: Click add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Enter the necessary data in the content entry fields displayed and publish or save the article.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
  <?php echo __( '<p>Margins will be automatically adjusted and displayed where the content is not set. You do not have to enter all the content.</p>', 'tcd-w' ); ?>
  <br>
  <p><?php _e('For headline and description that do not have font type or font size options, please adjust all at once from the font setting section of the basic settings ', 'tcd-w');  ?></p>
  <h4 class="content_builder_headline"><?php _e( 'Content image', 'tcd-w' ); ?></h4>
  <ul class="design_button_list cf">
   <li><a data-rel="lightcase:lpimage" href="<?php bloginfo('template_url'); ?>/admin/img/lp_design_content.jpg" title="<?php _e( 'Design content', 'tcd-w' ); ?>"><?php _e( 'Design content', 'tcd-w' ); ?></a></li>
   <li><a data-rel="lightcase:lpimage" href="<?php bloginfo('template_url'); ?>/admin/img/cb_carousel.jpg" title="<?php _e( 'Post carousel', 'tcd-w' ); ?>"><?php _e( 'Post carousel', 'tcd-w' ); ?></a></li>
   <li><a class="icon_link" href="https://demo.tcd-theme.com/tcd090/lp-sample/" target="_blank" title="<?php _e( 'Complete image', 'tcd-w' ); ?>"><?php _e( 'Complete image', 'tcd-w' ); ?></a></li>
  </ul>
 </div>


 <?php
      // コンテンツビルダーはここから -----------------------------------------------------------------
 ?>
 <div class="contents_builder">
  <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
  <?php
       if ( $lp_content && is_array( $lp_content ) ) :
         foreach( $lp_content as $key => $content ) :
           $cb_index = 'cb_' . $key . '_' . mt_rand( 0, 999999 );
  ?>
  <div class="cb_row">
   <ul class="cb_button cf">
    <li><span class="cb_move"><?php _e( 'Move', 'tcd-w' ); ?></span></li>
    <li><span class="cb_delete"><?php _e( 'Delete', 'tcd-w' ); ?></span></li>
   </ul>
   <div class="cb_column_area cf">
    <div class="cb_column">
     <input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>">
     <?php
          lp_content_select( $cb_index, $content['cb_content_select'] );
          if ( ! empty( $content['cb_content_select'] ) ) :
            lp_content_content_setting( $cb_index, $content['cb_content_select'], $content );
          endif;
     ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
         endforeach;
       endif;
  ?>
 </div><!-- END .contents_builder -->
 <ul class="button_list cf cb_add_row_buttton_area">
  <li><input type="button" value="<?php _e( 'Add content', 'tcd-w' ); ?>" class="button-ml add_row"></li>
 </ul>

 <?php // コンテンツビルダー追加用 非表示 ?>
 <div class="contents_builder-clone hidden">
  <div class="cb_row">
   <ul class="cb_button cf">
    <li><span class="cb_move"><?php _e( 'Move', 'tcd-w' ); ?></span></li>
    <li><span class="cb_delete"><?php _e( 'Delete', 'tcd-w' ); ?></span></li>
   </ul>
   <div class="cb_column_area cf">
    <div class="cb_column">
     <input type="hidden" class="cb_index" value="cb_cloneindex">
       <?php lp_content_select( 'cb_cloneindex' ); ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
       foreach ( lp_get_contents() as $key => $value ) :
         lp_content_content_setting( 'cb_cloneindex', $key );
       endforeach;
  ?>
 </div><!-- END .contents_builder-clone -->

</div><!-- END .tcd_custom_field_wrap -->
<?php
}

function save_lp_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['lp_meta_box_nonce']) || !wp_verify_nonce($_POST['lp_meta_box_nonce'], basename(__FILE__))) {
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

	// コンテンツビルダー 整形保存
	if ( ! empty( $_POST['lp_content'] ) && is_array( $_POST['lp_content'] ) ) {
		$cb_contents = lp_get_contents();
		$cb_data = array();

		foreach ( $_POST['lp_content'] as $key => $value ) {
			// クローン用はスルー
			if ( 'cb_cloneindex' === $key ) continue;

			// コンテンツデフォルト値に入力値をマージ
			if ( ! empty( $value['cb_content_select'] ) && isset( $cb_contents[$value['cb_content_select']]['default'] ) ) {
				$value = array_merge( (array) $cb_contents[$value['cb_content_select']]['default'], $value );
			}

      // デザインコンテンツ -----------------------------------------------------------------------
      if ($value['cb_content_select'] == 'design_content') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['catch_font_size'] = wp_filter_nohtml_kses( $value['catch_font_size'] );
        $value['catch_font_size_mobile'] = wp_filter_nohtml_kses( $value['catch_font_size_mobile'] );

        $value['item_list'] = $value['item_list'];

      // カルーセル -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'carousel') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );

        $value['carousel_type'] = wp_filter_nohtml_kses( $value['carousel_type'] );
        $value['post_num'] = wp_filter_nohtml_kses( $value['post_num'] );
        $value['post_num_mobile'] = wp_filter_nohtml_kses( $value['post_num_mobile'] );
        $value['post_type'] = wp_filter_nohtml_kses( $value['post_type'] );
        $value['post_order'] = wp_filter_nohtml_kses( $value['post_order'] );

        $value['show_category'] = ! empty( $value['show_category'] ) ? 1 : 0;
        $value['show_author'] = ! empty( $value['show_author'] ) ? 1 : 0;
        $value['show_date'] = ! empty( $value['show_date'] ) ? 1 : 0;

        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );
        $value['title_font_size_mobile'] = wp_filter_nohtml_kses( $value['title_font_size_mobile'] );

        $value['bg_color'] = wp_filter_nohtml_kses( $value['bg_color'] );

			// フリースペース
			} elseif ( 'free_space' === $value['cb_content_select'] ) {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['content_width'] = wp_filter_nohtml_kses( $value['content_width'] );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['desc'] = wp_kses_post( $value['desc'] );

        $value['content'] = wp_kses_post( $value['content'] );

        $value['top_space'] = wp_filter_nohtml_kses( $value['top_space'] );
        $value['top_space_mobile'] = wp_filter_nohtml_kses( $value['top_space_mobile'] );
        $value['bottom_space'] = wp_filter_nohtml_kses( $value['bottom_space'] );
        $value['bottom_space_mobile'] = wp_filter_nohtml_kses( $value['bottom_space_mobile'] );

			}

			$cb_data[] = $value;
		}

		if ( $cb_data ) {
			update_post_meta( $post_id, 'lp_content', $cb_data );
		} else {
			delete_post_meta( $post_id, 'lp_content' );
		}
	}
}
add_action('save_post', 'save_lp_meta_box');


/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function lp_get_contents() {
	return array(
    // デザインコンテンツ
		'design_content' => array(
			'name' => 'design_content',
			'label' => __( 'Design content', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'item_list' => array(),
				'catch_font_size' => 26,
				'catch_font_size_mobile' => 18,
			),
			'item_list_default' => array(
				'image' => '',
				'catch' => '',
				'desc' => '',
				'bg_color' => '#f3f3f3',
			)
		),
    // カルーセル
		'carousel' => array(
			'name' => 'carousel',
			'label' => __( 'Post carousel', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'desc' => '',
				'carousel_type' => 'type1',
				'post_num' => '6',
				'post_num_mobile' => '4',
				'post_type' => 'recent_post',
				'post_order' => 'date',
				'show_category' => '1',
				'show_author' => '1',
				'show_date' => '1',
				'title_font_size' => '16',
				'title_font_size_mobile' => '14',
				'bg_color' => '#f3f3f3',
			)
		),
    // フリースペース
		'free_space' => array(
			'name' => 'free_space',
			'label' => __( 'Free space', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'content_width' => 'type1',
				'catch' => '',
				'catch_font_size' => '32',
				'catch_font_size_mobile' => '22',
				'desc' => '',
				'content' => '',
				'top_space' => 115,
				'top_space_mobile' => 40,
				'bottom_space' => 120,
				'bottom_space_mobile' => 40,
			)
		)
	);
}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function lp_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = lp_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="lp_content[' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
	$out .= '<option value="">' . __( 'Choose the content', 'tcd-w' ) . '</option>';

	foreach ( $cb_contents as $key => $value ) {
		$out .= '<option value="' . esc_attr( $key ) . '"' . selected( $key, $selected, false ) . '>' . esc_html( $value['label'] ) . '</option>';
	}

	$out .= '</select>';

	echo $out;
}

/**
 * コンテンツビルダー用 コンテンツ設定
 */
function lp_content_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {

  global $post, $font_type_options, $content_width_options, $content_direction_options, $content_direction_options2, $text_align_options;

	$cb_contents = lp_get_contents();

  $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1200';

	// 不明なコンテンツの場合は終了
	if ( ! $cb_content_select || ! isset( $cb_contents[$cb_content_select] ) ) return false;

	// コンテンツデフォルト値に入力値をマージ
	if ( isset( $cb_contents[$cb_content_select]['default'] ) ) {
		$value = array_merge( (array) $cb_contents[$cb_content_select]['default'], $value );
	}
?>
  <div class="cb_content_wrap cf <?php echo esc_attr( $cb_content_select ); ?>">

  <?php
      // デザインコンテンツ -------------------------------------------------------------------------
      if ( 'design_content' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span class="cb_content_headline_sub_title"></span></h3>
  <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
  <label class="cb_content_switch"><div class="label_wrap"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div></label>
  <div class="cb_content">
  <div class="cb_content_switch_target">
  <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/lp_design_content.jpg" width="" height="" />
   </div>
     <?php // リピーターここから -------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Content list setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-w');  ?></p>
     </div>
     <div class="repeater-wrapper">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
       <?php
            if ( $value['item_list'] && is_array( $value['item_list'] ) ) :
              foreach ( $value['item_list'] as $repeater_key => $repeater_value ) :
                 $repeater_value = array_merge( $cb_contents[$cb_content_select]['item_list_default'], $repeater_value );
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-w' ); echo esc_attr( $repeater_key+1 ); ?></h4>
        <div class="sub_box_content">
        <ul class="option_list">
          <li class="cf">
          <span class="label"><?php _e('Headline', 'tcd-w');  ?></span>
          <input type="text" class="full_width cb-repeater-label repeater-label" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch]" value="<?php echo esc_textarea($repeater_value['catch']); ?>" />
          </li>
          <li class="cf">
          <span class="label"><?php _e('Description', 'tcd-w'); ?></span>
          <textarea class="full_width" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea($repeater_value['desc']); ?></textarea>
          </li>
          <li class="cf">
          <span class="label"><?php _e( 'Background color', 'tcd-w' ); ?></span>
          <input type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_color]" value="<?php echo esc_attr( $repeater_value['bg_color'] ); ?>" data-default-color="#f3f3f3" class="c-color-picker">
          </li>
          <li class="cf">
          <span class="label"><?php _e( 'Image', 'tcd-w' ); ?></span>
          <div class="image_box cf">
                <div class="cf cf_media_field hide-if-no-js dc_image_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>">
                <input type="hidden" value="<?php if ( $repeater_value['image'] ) echo esc_attr( $repeater_value['image'] ); ?>" id="dc_image_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
                <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium'); ?></div>
                <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '720', '580'); ?></p>
                <div class="button_area">
                  <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
                  <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $repeater_value['image'] ) echo 'hidden'; ?>">
                </div>
                </div>
              </div>
          </li>
        </ul>
         <ul class="button_list cf">
          <li class="delete-row" style="float:right; margin-right:0;"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
              endforeach;
            endif;

            $repeater_key = 'addindex';
            $repeater_value = $cb_contents[$cb_content_select]['item_list_default'];
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
        <div class="sub_box_content">
       <ul class="option_list">
          <li class="cf">
          <span class="label"><?php _e('Headline', 'tcd-w');  ?></span>
          <input type="text" class="full_width cb-repeater-label repeater-label" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch]" value="<?php echo esc_textarea($repeater_value['catch']); ?>" />
          </li>
          <li class="cf">
          <span class="label"><?php _e('Description', 'tcd-w'); ?></span>
          <textarea class="full_width" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea($repeater_value['desc']); ?></textarea>
          </li>
          <li class="cf">
          <span class="label"><?php _e( 'Background color', 'tcd-w' ); ?></span>
          <input type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][bg_color]" value="<?php echo esc_attr( $repeater_value['bg_color'] ); ?>" data-default-color="#f3f3f3" class="c-color-picker">
          </li>
          <li class="cf">
          <span class="label"><?php _e( 'Image', 'tcd-w' ); ?></span>
          <div class="image_box cf">
                <div class="cf cf_media_field hide-if-no-js dc_image_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>">
                <input type="hidden" value="<?php if ( $repeater_value['image'] ) echo esc_attr( $repeater_value['image'] ); ?>" id="dc_image_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
                <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium'); ?></div>
                <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '720', '580'); ?></p>
                <div class="button_area">
                  <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
                  <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $repeater_value['image'] ) echo 'hidden'; ?>">
                </div>
                </div>
              </div>
          </li>
        </ul>

         <ul class="button_list cf">
          <li class="delete-row" style="float:right; margin-right:0;"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
     </div><!-- END .repeater-wrapper -->
     <?php // リピーターここまで -------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Font size of catchphrase', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf">
        <span class="label"><?php _e('Font size of catchphrase', 'tcd-w'); ?></span>
        <div class="font_size_option">
        <label class="font_size_label number_option">
          <input class="font_size hankaku" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" />
          <span class="icon icon_pc"></span>
        </label>
        <label class="font_size_label number_option">
          <input class="font_size hankaku" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size_mobile]" value="<?php esc_attr_e( $value['catch_font_size_mobile'] ); ?>" />
          <span class="icon icon_sp"></span>
          </label>
        </div>
      </li>
    </ul>


   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
   </div><!-- END .cb_content_switch_target -->
  </div><!-- END .cb_content -->


  <?php
      // カルーセル -------------------------------------------------------------------------
      elseif ( 'carousel' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span class="cb_content_headline_sub_title"></span></h3>
  <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
  <label class="cb_content_switch"><div class="label_wrap"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div></label>
  <div class="cb_content">
  <div class="cb_content_switch_target">
  <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/cb_image_post_carousel.jpg" width="" height="" />
   </div>
   
   <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-w');  ?></h4>
    <ul class="option_list">
      <li class="cf">
       <span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-w');  ?></span>
       <input type="text" class="full_width cb-repeater-label" name="lp_content[<?php echo $cb_index; ?>][headline]" value="<?php echo esc_html($value['headline']); ?>" />
       <div class="theme_option_message2" style="clear:both;">
         <p><?php _e('You can set font size and font type from basic setting menu font setting option section.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf">
       <span class="label"><span class="num">2</span><?php _e('Description', 'tcd-w'); ?></span>
       <textarea class="full_width" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Carousel', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Carousel type', 'tcd-w');  ?></span>
       <select name="lp_content[<?php echo $cb_index; ?>][carousel_type]">
        <option style="padding-right: 10px;" value="type1" <?php selected( $value['carousel_type'], 'type1' ); ?>><?php _e('Full width carousel', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="type2" <?php selected( $value['carousel_type'], 'type2' ); ?>><?php _e('Carousel with space on the left', 'tcd-w'); ?></option>
       </select>
      </li>
      <li class="cf space"><span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
       <select name="lp_content[<?php echo $cb_index; ?>][post_type]">
        <option style="padding-right: 10px;" value="recent_post" <?php selected( $value['post_type'], 'recent_post' ); ?>><?php _e('Recent post', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="recommend_post" <?php selected( $value['post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="featured_post" <?php selected( $value['post_type'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w'); ?></option>
        <option style="padding-right: 10px;" value="pickup_post" <?php selected( $value['post_type'], 'pickup_post' ); ?>><?php _e('Pickup post', 'tcd-w'); ?></option>
       </select>
      </li>
      <li class="cf space"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
       <select name="lp_content[<?php echo $cb_index; ?>][post_order]">
        <option style="padding-right: 10px;" value="date" <?php selected( $value['post_order'], 'date' ); ?>><?php _e('Post date', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="rand" <?php selected( $value['post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
       </select>
      </li>
      <li class="cf space"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
       <div class="display_post_num_option">
        <label class="number_option">
         <input class="hankaku" type="number" min="-1" name="lp_content[<?php echo $cb_index; ?>][post_num]" value="<?php esc_attr_e( $value['post_num'] ); ?>" />
         <span class="icon icon_pc"></span>
        </label>
        <label class="number_option">
         <input class="hankaku" type="number" min="-1" name="lp_content[<?php echo $cb_index; ?>][post_num_mobile]" value="<?php esc_attr_e( $value['post_num_mobile'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf space"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span>
       <div class="font_size_option">
        <label class="font_size_label number_option">
         <input class="font_size hankaku" type="number" name="lp_content[<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" />
         <span class="icon icon_pc"></span>
        </label>
        <label class="font_size_label number_option">
         <input class="font_size hankaku" type="number" name="lp_content[<?php echo $cb_index; ?>][title_font_size_mobile]" value="<?php esc_attr_e( $value['title_font_size_mobile'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
      <li class="cf space"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="lp_content[<?php echo $cb_index; ?>][show_category]" type="checkbox" value="1" <?php checked( $value['show_category'], 1 ); ?>></li>
      <li class="cf space"><span class="label"><?php _e('Display author', 'tcd-w'); ?></span><input name="lp_content[<?php echo $cb_index; ?>][show_author]" type="checkbox" value="1" <?php checked( $value['show_author'], 1 ); ?>></li>
      <li class="cf space"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="lp_content[<?php echo $cb_index; ?>][show_date]" type="checkbox" value="1" <?php checked( $value['show_date'], 1 ); ?>></li>
      <li class="cf space"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][bg_color]" value="<?php echo esc_attr( $value['bg_color'] ); ?>" data-default-color="#f3f3f3" class="c-color-picker"></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
   </div><!-- END .cb_content_switch_target -->
  </div><!-- END .cb_content -->


  <?php
      // フリースペース -------------------------------------------------------------------------
      elseif ( 'free_space' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span class="cb_content_headline_sub_title"></span></h3>
  <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
    <label class="cb_content_switch"><div class="label_wrap"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><span class="label"><span class="on">ON</span><span class="sep"></span><span class="off">OFF</span></span></div></label>
  <div class="cb_content">
  <div class="cb_content_switch_target">
   <h4 class="theme_option_headline2"><?php _e('Header', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set font size and font type from basic setting menu font setting option section.', 'tcd-w');  ?></p>
     </div>
     <ul class="option_list">
    <li class="cf">
    <span class="label"><?php _e('Catchphrase', 'tcd-w'); ?></span>
     <input type="text" class="full_width cb-repeater-label" name="lp_content[<?php echo $cb_index; ?>][catch]" value="<?php echo esc_textarea($value['catch']); ?>" />
    </li>
    <li class="cf">
    <span class="label"><?php _e('Description', 'tcd-w'); ?></span>
     <input type="text" class="full_width" name="lp_content[<?php echo $cb_index; ?>][desc]" value="<?php echo esc_textarea($value['desc']); ?>" />
    </li>
    <li class="cf">
      <span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span>
      <div class="font_size_option">
      <label class="font_size_label number_option">
        <input class="font_size hankaku" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" />
        <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
        <input class="font_size hankaku" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size_mobile'] ); ?>" />
        <span class="icon icon_sp"></span>
        </label>
      </div>
    </li>
  </ul>

     <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
     <ul class="design_radio_button">
      <?php foreach ( $content_width_options as $option ) { ?>
      <li>
       <input type="radio" id="content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>" name="lp_content[<?php echo $cb_index; ?>][content_width]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['content_width'], $option['value'] ); ?> />
       <label for="content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>"><?php echo esc_html( $option['label'] ); ?></label>
      </li>
      <?php } ?>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?><span class="cb_content_headline_sub_title"></span></h4>
     <?php wp_editor( $value['content'], 'cb_wysiwyg_editor-desc-' . $cb_index, array ( 'textarea_name' => 'lp_content[' . $cb_index . '][content]' ) ); ?>

     <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf">
        <span class="label"><?php _e('Top space of content', 'tcd-w'); ?></span>
        <div class="font_size_option">
        <label class="font_size_label number_option">
          <input class="font_size hankaku" type="number" name="lp_content[<?php echo $cb_index; ?>][top_space]" value="<?php esc_attr_e( $value['top_space'] ); ?>" />
          <span class="icon icon_pc"></span>
        </label>
        <label class="font_size_label number_option">
          <input class="font_size hankaku" type="number" name="lp_content[<?php echo $cb_index; ?>][top_space_mobile]" value="<?php esc_attr_e( $value['top_space_mobile'] ); ?>" />
          <span class="icon icon_sp"></span>
          </label>
        </div>
      </li>
      <li class="cf">
        <span class="label"><?php _e('Bottom space of content', 'tcd-w'); ?></span>
        <div class="font_size_option">
        <label class="font_size_label number_option">
          <input class="font_size hankaku" type="number" name="lp_content[<?php echo $cb_index; ?>][bottom_space]" value="<?php esc_attr_e( $value['bottom_space'] ); ?>" />
          <span class="icon icon_pc"></span>
        </label>
        <label class="font_size_label number_option">
          <input class="font_size hankaku" type="number" name="lp_content[<?php echo $cb_index; ?>][bottom_space_mobile]" value="<?php esc_attr_e( $value['bottom_space_mobile'] ); ?>" />
          <span class="icon icon_sp"></span>
          </label>
        </div>
      </li>
     </ul>
   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
   </div><!-- END .cb_content_switch_target -->
  </div><!-- END .cb_content -->

  <?php
       // ボタンを表示 ----------------------------------------------------------------------------
       else :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_content_select ); ?></h3>
  <div class="cb_content">
   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div>
  <?php endif; ?>

  </div><!-- END .cb_content_wrap -->
<?php
}

/**
 * クローン用のリッチエディター化処理をしないようにする
 * クローン後のリッチエディター化はjsで行う
 */
function cb_tiny_mce_before_init( $mceInit, $editor_id ) {
  if ( strpos( $editor_id, 'cb_cloneindex' ) !== false ) {
    $mceInit['wp_skip_init'] = true;
  }
  return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'cb_tiny_mce_before_init', 10, 2 );

