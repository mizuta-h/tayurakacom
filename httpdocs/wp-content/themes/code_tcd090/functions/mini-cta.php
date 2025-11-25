<?php

// ミニCTA メタボックス追加
function mini_cta_add_meta_box() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	// 全公開ポストタイプからattachmentを除外
	$public_post_types = get_post_types( array( 'public' => true ) );
	if ( isset( $public_post_types['attachment'] ) ) {
		unset( $public_post_types['attachment'] );
	}

	add_meta_box(
		'mini_cta_meta_box',
		__( 'Popup CTA settings', 'tcd-w' ),
		'mini_cta_show_meta_box',
		$public_post_types,
		'side',
		'low'
	);

}
add_action( 'add_meta_boxes', 'mini_cta_add_meta_box' );

// ミニCTA メタボックス表示
function mini_cta_show_meta_box() {
	global $post;

	// nonce field
	wp_nonce_field( 'mini_cta_meta_box_nonce', 'mini_cta_meta_box_nonce', false, true );

	$meta_key = 'hide_mini_cta';
	$meta_value = get_post_meta( $post->ID, $meta_key, true );

	printf(
		'<p><input type="hidden" name="%s" value=""><label><input type="checkbox" name="%s" value="1" %s> %s</label></p>',
		esc_attr( $meta_key ),
		esc_attr( $meta_key ),
		checked( $meta_value, 1, false ),
		esc_html( __( 'Hide Popup CTA on this page', 'tcd-w' ) )
	);
}

// ミニCTA メタボックス保存
function mini_cta_save_meta_box( $post_id ) {
	// verify nonce
	if ( ! isset( $_POST['mini_cta_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['mini_cta_meta_box_nonce'], 'mini_cta_meta_box_nonce' ) ) {
		return $post_id;
	}

	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// check permissions
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			 return $post_id;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$cf_keys = array(
		'hide_mini_cta'
	);

	// save or delete
	foreach ( $cf_keys as $cf_key ) {
		if ( isset( $_POST[ $cf_key ] ) ) {
			$old = get_post_meta( $post_id, $cf_key, true );
			$new = wp_unslash( $_POST[ $cf_key ] );

			if ( $new !== $old ) {
				update_post_meta( $post_id, $cf_key, $new );
			}
		}
	}
}
add_action( 'save_post', 'mini_cta_save_meta_box' );

// ミニCTA フロントエンドフック登録
function mini_cta_wp() {
	global $dp_options, $post;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$show_mini_cta = $dp_options['show_mini_cta'];

	if ( $show_mini_cta ) {
		// キャッチ・説明分・ボタンラベルいずれもなければfalse
		if ( ! $dp_options['mini_cta_catch'] && ! $dp_options['mini_cta_desc'] && ! $dp_options['mini_cta_button_label'] ) {
			$show_mini_cta = false;

		// 非表示クッキーがあればfalse
		} elseif ( ! empty( $_COOKIE['hide_mini_cta'] ) ) {
			$show_mini_cta = false;

		// シングル表示でhide_mini_ctaがあればfalse
		} elseif ( is_singular() && $post && $post->hide_mini_cta ) {
			$show_mini_cta = false;
		}
	}

	if ( $show_mini_cta ) {
		add_action( 'wp_enqueue_scripts', 'mini_cta_enqueue_script' );
		add_filter( 'body_class', 'mini_cta_body_class' );
		add_action( 'tcd_head_css_current_page', 'mini_cta_css' );
		add_action( 'wp_footer', 'render_mini_cta' );
	}
}
add_action( 'wp', 'mini_cta_wp' );

// ミニCTA js
function mini_cta_enqueue_script() {
	wp_enqueue_script( 'mini-cta', get_template_directory_uri() . '/js/mini-cta.js', array( 'jquery' ), version_num(), true );
}

// ミニCTA body_class
function mini_cta_body_class( $classes ) {
	if ( ! in_array( 'hide_return_top', $classes ) ) {
		$classes[] = 'hide_return_top';
	}

	return $classes;
}

// ミニcss出力
function mini_cta_css() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$css = array();

	if ( $dp_options['mini_cta_catch'] ) {
		$css[] = '.p-mini-cta__catch { color: ' . esc_html( $dp_options['mini_cta_catch_font_color'] ) . '; }';
	}

	if ( $dp_options['mini_cta_button_label'] && $dp_options['mini_cta_button_url'] ) {
		$css[] = 'a.p-mini-cta__button:hover, .p-mini-cta__close:hover { border-color: ' . esc_html( $dp_options['mini_cta_button_font_color_hover'] ) . '; color: ' . esc_html( $dp_options['mini_cta_button_font_color_hover'] ) . '; }';
	}

	if ( $css ) {
		echo implode( "\n", $css ) . "\n";
	}
}

// ミニCTA出力
function render_mini_cta() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$out = null;

	if ( $dp_options['mini_cta_catch'] ) {
		$out .= "\t\t\t";
		$out .= '<div class="p-mini-cta__catch">' . str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( $dp_options['mini_cta_catch'] ) ) . "</div>\n";
	}

	if ( $dp_options['mini_cta_desc'] ) {
		$out .= "\t\t\t";
		$out .= '<div class="p-mini-cta__desc">' . str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( $dp_options['mini_cta_desc'] ) ) . "</div>\n";
	}

	if ( $dp_options['mini_cta_button_label'] && $dp_options['mini_cta_button_url'] ) {
		$out .= "\t\t\t";
		$out .= '<a class="p-mini-cta__button" href="' . esc_attr( $dp_options['mini_cta_button_url'] ) . '"' . ( $dp_options['mini_cta_button_target_blank'] ? ' target="_blank"' : '' ) . '>' . esc_html( $dp_options['mini_cta_button_label'] ) . "</a>\n";
	} elseif ( $dp_options['mini_cta_button_label'] ) {
		$out .= "\t\t\t";
		$out .= '<div class="p-mini-cta__button">' . esc_html( $dp_options['mini_cta_button_label'] ) . "</div>\n";
	}

	if ( $out ) {
		echo '<div id="js-mini-cta" class="p-mini-cta">' . "\n";
		echo "\t" . '<div class="p-mini-cta__inner">' . "\n";
		echo "\t\t" . '<button class="p-mini-cta__close" data-cookiepath="' . esc_attr( COOKIEPATH ) . '">&#xe91a;</button>' ." \n";
		echo "\t\t" . '<div class="p-mini-cta__contents">' . "\n";
		echo "\t\t\t" . trim( $out ) . "\n";
		echo "\t\t</div>\n";
		echo "\t</div>\n";
		echo "</div>\n";
	}
}
