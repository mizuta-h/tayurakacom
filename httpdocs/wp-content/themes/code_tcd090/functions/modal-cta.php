<?php

// モーダルCTA メタボックス追加
function modal_cta_add_meta_box() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	// 全公開ポストタイプからattachmentを除外
	$public_post_types = get_post_types( array( 'public' => true ) );
	if ( isset( $public_post_types['attachment'] ) ) {
		unset( $public_post_types['attachment'] );
	}

	add_meta_box(
		'modal_cta_meta_box',
		__( 'Modal CTA settings', 'tcd-w' ),
		'modal_cta_show_meta_box',
		$public_post_types,
		'side',
		'low'
	);

}
add_action( 'add_meta_boxes', 'modal_cta_add_meta_box' );

// モーダルCTA メタボックス表示
function modal_cta_show_meta_box() {
	global $post;

	// nonce field
	wp_nonce_field( 'modal_cta_meta_box_nonce', 'modal_cta_meta_box_nonce', false, true );

	$modal_cta_options = array(
		array(
			'label' => __( 'Use theme option settings', 'tcd-w' ),
			'value' => ''
		),
		array(
			'label' => __( 'Display Modal CTA on this page', 'tcd-w' ),
			'value' => 'show'
		),
		array(
			'label' => __( 'Hide Modal CTA on this page', 'tcd-w' ),
			'value' => 'hide'
		)
	);

	$meta_key = 'modal_cta';
	$meta_value = get_post_meta( $post->ID, $meta_key, true );

	foreach ( $modal_cta_options as $option ) {
		printf(
			'<p><label><input type="radio" name="%s" value="%s" %s> %s</label></p>',
			esc_attr( $meta_key ),
			esc_attr( $option['value'] ),
			checked( $option['value'], $meta_value, false ),
			esc_html( $option['label'] )
		);
	}
}

// モーダルCTA メタボックス保存
function modal_cta_save_meta_box( $post_id ) {
	// verify nonce
	if ( ! isset( $_POST['modal_cta_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['modal_cta_meta_box_nonce'], 'modal_cta_meta_box_nonce' ) ) {
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
		'modal_cta'
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
add_action( 'save_post', 'modal_cta_save_meta_box' );

// モーダルCTAモードを取得 front|sub|false|0）
function get_modal_cta_mode() {
	static $flag = null;

	if ( null !== $flag ) {
		return $flag;
	}

	global $dp_options, $post;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	if ( is_front_page() ) {
		if ( $dp_options['show_modal_cta_front'] ) {
			$flag = 'front';
		}
	} elseif ( $dp_options['show_modal_cta_sub_same_front'] ) {
		$flag = 'front';
	} else {
		$flag = 'sub';
	}

	if ( ! is_front_page() ) {
		if ( is_singular() ) {
			if ( 'hide' === $post->modal_cta ) {
				$flag = false;
			} elseif ( 'show' !== $post->modal_cta ) {
				if (
					( is_singular( 'post' ) && ! $dp_options['show_modal_cta_sub_single_post'] ) ||
					( is_singular('news') && ! $dp_options['show_modal_cta_sub_news_single_post'] ) ||
					( is_page() && ! $dp_options['show_modal_cta_sub_single_page'] ) 
				) {
					$flag = false;
				}
			}
		} elseif ( is_search() || is_404() ) {
			$flag = false;

		} elseif (
			( is_home() && ! $dp_options['show_modal_cta_sub_archive_post'] ) ||

			( is_category() && ! $dp_options['show_modal_cta_sub_archive_post'] ) ||
			( is_tag() && ! $dp_options['show_modal_cta_sub_archive_post'] ) ||
			( is_date() && ! $dp_options['show_modal_cta_sub_archive_post'] ) ||
			( is_author() && ! $dp_options['show_modal_cta_sub_archive_post'] ) ||
			( is_post_type_archive('news') && ! $dp_options['show_modal_cta_sub_news_archive_post'] )
		) {
			$flag = false;
		}
	}

	// 1回だけ表示の場合
	if ( $flag && $dp_options['modal_cta_' . $flag . '_only_once'] ) {
		// クッキーがあれば非表示に
		if ( ! empty( $_COOKIE['shown_modal_cta_' . $flag] ) ) {
			$flag = 0;
		// モーダルCTAは表示＝閉じたと取れるのでjsではなくここでクッキー保存
		} else {
			setcookie( 'shown_modal_cta_' . $flag, 1, 0, COOKIEPATH, COOKIE_DOMAIN, false );
		}
	}

	return $flag;
}

// モーダルCTA フロントエンドフック登録
function modal_cta_wp() {
	if ( get_modal_cta_mode() ) {
		add_action( 'wp_enqueue_scripts', 'modal_cta_enqueue_script' );
		add_action( 'tcd_head_css_current_page', 'modal_cta_css' );
		add_action( 'wp_footer', 'render_modal_cta' );
	}
}
add_action( 'wp', 'modal_cta_wp' );


// モーダルCTA js
function modal_cta_enqueue_script() {
	wp_enqueue_script( 'modal-cta', get_template_directory_uri() . '/js/modal-cta.js', array( 'jquery' ), version_num(), true );
}

// モーダルcss出力
function modal_cta_css() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$flag = get_modal_cta_mode();
	if ( ! $flag ) return;

	$css = array();
	$css_mobile = array();

	if ( 'type1' === $dp_options['modal_cta_' . $flag . '_type'] ) {
		$css[] = '.p-modal-cta__info { background-color: rgba(' . esc_html( implode( ', ', hex2rgb( $dp_options['modal_cta_' . $flag . '_type1_overlay_color'] ) ) . ', ' . $dp_options['modal_cta_' . $flag . '_type1_overlay_opacity'] ) . '); }';
		if ( $dp_options['display_modal_cta_' . $flag . '_catch'] && $dp_options['modal_cta_' . $flag . '_catch'] ) {
			$css[] = '.p-modal-cta__catch { color: ' . esc_html( $dp_options['modal_cta_' . $flag . '_catch_color'] ) . '; font-size: ' . esc_html( $dp_options['modal_cta_' . $flag . '_catch_font_size'] ) . 'px; }';
			$css_mobile[] = '.p-modal-cta__catch { font-size: ' . esc_html( $dp_options['modal_cta_' . $flag . '_catch_font_size_mobile'] ) . 'px; }';
		}

		if ( $dp_options['display_modal_cta_' . $flag . '_desc'] && $dp_options['modal_cta_' . $flag . '_desc'] ) {
			$css[] = '.p-modal-cta__desc { color: ' . esc_html( $dp_options['modal_cta_' . $flag . '_desc_color'] ) . '; font-size: ' . esc_html( $dp_options['modal_cta_' . $flag . '_desc_font_size'] ) . 'px; }';
			$css_mobile[] = '.p-modal-cta__desc { font-size: ' . esc_html( $dp_options['modal_cta_' . $flag . '_desc_font_size_mobile'] ) . 'px; }';
		}
	} elseif ( 'type2' === $dp_options['modal_cta_' . $flag . '_type'] ) {
		$css[] = '.p-modal-cta--type2 .post_content { background-color: ' . esc_html( $dp_options['modal_cta_' . $flag . '_editor_bg_color'] ) . '; }';
	}

	if ( $css || $css_mobile ) {
		if ( $css ) {
			echo implode( "\n", $css ) . "\n";
		}
		if ( $css_mobile ) {
			echo "@media (max-width: 950px) {\n";
			echo "\t" . implode( "\n\t", $css_mobile ) . "\n";
			echo "}\n";
		}
	}
}

// モーダルCTA出力
function render_modal_cta() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$flag = get_modal_cta_mode();
	if ( ! $flag ) return;

	$out = null;
	$contents_add_class = null;

	if ( 'type1' === $dp_options['modal_cta_' . $flag . '_type'] ) {
		$image = wp_get_attachment_image_src( $dp_options['modal_cta_' . $flag . '_image'], 'full' );
		if ( $image ) {
			$info = '';

			if ( $dp_options['modal_cta_' . $flag . '_image_url'] ) {
				$out .= "\t\t\t";
				$out .= '<a class="p-modal-cta__image-anchor" href="' . esc_attr( $dp_options['modal_cta_' . $flag . '_image_url'] ) . '"' . ( $dp_options['modal_cta_' . $flag . '_image_target_blank'] ? ' target="_blank"': '' ) . '>' . "\n";
			}

			$out .= "\t\t\t\t";
			$out .= '<div class="p-modal-cta__image">';
			$out .= '<img src="' . esc_attr( $image[0] ) . '">';
			$out .= '</div>' . "\n";

			if ( $dp_options['display_modal_cta_' . $flag . '_catch'] && $dp_options['modal_cta_' . $flag . '_catch'] ) {
				$info .= "\t\t\t\t\t";
				$info .= '<h2 class="p-modal-cta__catch c-font-type--' . esc_attr( $dp_options['modal_cta_' . $flag . '_catch_font_type'] ) . '">' . str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( $dp_options['modal_cta_' . $flag . '_catch'] ) ) . "</h2>\n";
			}

			if ( $dp_options['display_modal_cta_' . $flag . '_desc'] && $dp_options['modal_cta_' . $flag . '_desc'] ) {
				$info .= "\t\t\t\t\t";
				$info .= '<div class="p-modal-cta__desc c-font-type--' . esc_attr( $dp_options['modal_cta_' . $flag . '_desc_font_type'] ) . '">' . str_replace( array( "\r\n", "\r", "\n" ), '', wpautop( $dp_options['modal_cta_' . $flag . '_desc'] ) ) . "</div>\n";
			}

			if ( $info ) {
				$out .= "\t\t\t\t" . '<div class="p-modal-cta__info">' . "\n". $info ."\t\t\t\t</div>\n";
			}

			if ( $dp_options['modal_cta_' . $flag . '_image_url'] ) {
				$out .= "\t\t\t</a>\n";
			}
		}

	} elseif ( 'type2' === $dp_options['modal_cta_' . $flag . '_type'] && $dp_options['modal_cta_' . $flag . '_editor'] ) {
		$out .= '<div class="post_content">';
		$out .= trim( apply_filters( 'the_content', $dp_options['modal_cta_' . $flag . '_editor'] ) );
		$out .= '</div>';
	}

	if ( $out ) {
		echo '<div id="js-modal-cta" class="p-modal-cta p-modal-cta--' . $dp_options['modal_cta_' . $flag . '_type'] . ' is-active">' . "\n";
		echo "\t" . '<div class="p-modal-cta__inner">' . "\n";
		echo "\t\t" . '<div class="p-modal-cta__contents ' . $contents_add_class . '">' . "\n";
		echo "\t\t\t" . trim( $out ) . "\n";
		echo "\t\t</div>\n";
		echo "\t\t" . '<button class="p-modal-cta__close">&#xe91a;</button>' ." \n";
		echo "\t</div>\n";
		echo "</div>\n";
	}
}
