<?php

function init_featured_video_meta_box() {
	if ( current_user_can( 'upload_files' ) ) {
		add_action( 'add_meta_boxes', 'add_featured_video_meta_box', 9 );
		add_action( 'save_post_post', 'save_featured_video_meta_box' );
	}
}
add_action( 'admin_init', 'init_featured_video_meta_box' );

function add_featured_video_meta_box() {
	add_meta_box(
		'featured_video_meta_box',
		__( 'Featured video', 'tcd-w' ),
		'show_featured_video_meta_box',
		'post',
		'side',
		'low'
	);
}

function show_featured_video_meta_box() {
	global $post;

	echo '<input type="hidden" name="featured_video_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '">';

	$tcd_featured_video = get_post_meta( $post->ID, 'tcd_featured_video', true );
?>
<div class="tcd_custom_fields">
	<div class="tcd_cf_content">
		<p><?php _e( 'Setting the featured video to be displayed in header content post slider on front page', 'tcd-w' ); ?></p>
		<div class="cf cf_media_field hide-if-no-js">
			<input type="hidden" value="<?php echo esc_attr( $tcd_featured_video ); ?>" id="tcd_featured_video" name="tcd_featured_video" class="cf_media_id">
			<div class="preview_field preview_field_video">
				<?php if ( $tcd_featured_video ) {  ?>
				<h4><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h4>
				<p><?php echo esc_url( wp_get_attachment_url( $tcd_featured_video ) ); ?></p>
				<?php } ?>
			</div>
			<div class="buttton_area">
				<input type="button" value="<?php _e( 'Select MP4 file', 'tcd-w' ); ?>" class="cfmf-select-video button">
				<input type="button" value="<?php _e( 'Remove MP4 file', 'tcd-w' ); ?>" class="cfmf-delete-video button <?php if ( ! $tcd_featured_video) echo 'hidden'; ?>">
			</div>
		</div>
	</div>
</div>
<?php
}

function save_featured_video_meta_box( $post_id ) {
	// verify nonce
	if ( ! isset( $_POST['featured_video_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['featured_video_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// check permissions
	if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
		if ( ! current_user_can('edit_page', $post_id ) ) {
			return $post_id;
		}
	} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// save or delete
	$cf_keys = array( 'tcd_featured_video' );
	foreach ( $cf_keys as $cf_key ) {
		$old = get_post_meta( $post_id, $cf_key, true );
		$new = isset( $_POST[ $cf_key ] ) ? wp_unslash( $_POST[ $cf_key ] ) : '';

		if ( $new && $new != $old ) {
			update_post_meta( $post_id, $cf_key, $new );
		} elseif ( ! $new && $old ) {
			delete_post_meta( $post_id, $cf_key, $old );
		}
	}
}
