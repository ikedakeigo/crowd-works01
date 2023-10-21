<?php

// モーダルCTA フロントエンドフック登録
function modal_cta_wp() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$show_modal_cta = ($dp_options['modal_cta_type'] == 'type3') ? false : true;

	if ( $show_modal_cta ) {

		// クッキーがあれば非表示に (モーダルCTAは1回限定表示決め打ち)
		if ( ! empty( $_COOKIE['hide_modal_cta'] ) ) {
			$show_modal_cta = false;
		}

	}

	if ( $show_modal_cta ) {
		add_action( 'wp_enqueue_scripts', 'modal_cta_enqueue_script' );
		add_filter( 'body_class', 'modal_cta_body_class' );
		add_action( 'tcd_head_css_current_page', 'modal_cta_css' );
		add_action( 'wp_footer', 'render_modal_cta' );
	}
}
add_action( 'wp', 'modal_cta_wp' );


// モーダルCTA js
function modal_cta_enqueue_script() {
	wp_enqueue_script( 'modal-cta', get_template_directory_uri() . '/js/modal-cta.js', array( 'jquery' ), version_num(), true );
}

// モーダルCTA body_class
function modal_cta_body_class( $classes ) {
	$classes[] = 'show_modal_cta';
	return $classes;
}

// モーダルCTA出力
function render_modal_cta() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$out = null;

	if($dp_options['modal_cta_type'] == 'type1'){

		if($dp_options['modal_cta_url']){
			$out .= '<a href="' . esc_attr($dp_options['modal_cta_url']) . '" class="p-modal-cta__image-anchor">' . "\n";
		}else{
			$out .= '<div class="p-modal-cta__image-anchor">' . "\n";
		}

		$image = wp_get_attachment_image_src( $dp_options['modal_cta_image'], 'full' );
		if($image){
			$out .= "\t\t\t\t";
			$out .= '<div class="p-modal-cta__image">' . "\n";
			$out .= "\t\t\t\t\t";
			$out .= '<img src="' . esc_attr($image[0]) . '" alt="" width="' . esc_attr($image[1]) . '" height="' . esc_attr($image[2]) . '">' . "\n";
			$out .= "\t\t\t\t";
			$out .= '</div>' . "\n";
		}

		$catch = $dp_options['modal_cta_catch'];
		if($catch){
			$out .= "\t\t\t\t";
			$out .= '<div class="p-modal-cta__info">' . "\n";
			$out .= "\t\t\t\t\t";
			$out .= '<h2 class="p-modal-cta__catch">'. str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( $catch ) ) . '</h2>' . "\n";
			$out .= "\t\t\t\t";
			$out .= '</div>' . "\n";
		}

		$overlay_color = implode(",",hex2rgb($dp_options['modal_cta_overlay_color']));
		$overlay_opacity = $dp_options['modal_cta_overlay_opacity'];

		$out .= "\t\t\t\t";
		$out .= '<div class="p-modal-cta__overlay" style="background-color:rgba(' . esc_attr($overlay_color) . ',' . esc_attr($overlay_opacity) . ');"></div>' . "\n";

		$out .= "\t\t\t";
		if($dp_options['modal_cta_url']){
			$out .= '</a>' . "\n";
		}else{
			$out .= '</div>' . "\n";
		}

	}elseif($dp_options['modal_cta_type'] == 'type2' && $dp_options['modal_cta_free_space']){

		$out .= "\t\t\t";
		$out .= '<div class="post_content clearfix">' . "\n";
		$out .= "\t\t\t";
		$out .= apply_filters('the_content', $dp_options['modal_cta_free_space'] ) . "\n";
		$out .= "\t\t\t";
		$out .= '</div>' . "\n";

	}

	if ( $out ) {
		echo '<div id="js-modal-cta" class="p-modal-cta is-active">' . "\n";
		echo "\t" . '<div class="p-modal-cta__inner">' . "\n";
		echo "\t\t" . '<div class="p-modal-cta__contents">' . "\n";
		echo "\t\t\t" . trim( $out ) . "\n";
		echo "\t\t</div>\n";
		echo "\t\t" . '<button id="js-modal-cta-close-button" class="p-modal-cta__close" data-cookiepath="' . esc_attr( COOKIEPATH ) . '">&#xe91a;</button>' ." \n";
		echo "\t</div>\n";
    echo "\t".'<div id="js-modal-cta-overlay" class="p-modal-cta__overlay"></div>'."\n";
		echo "</div>\n";
	}

}


// モーダルcss出力
function modal_cta_css() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	echo '.p-modal-cta__catch { font-size:' . esc_html($dp_options['modal_cta_catch_font_size']) . 'px; }' . "\n";
	echo "@media (max-width: 767px) {\n";
	echo "\t" . '.p-modal-cta__catch { font-size:' . esc_html($dp_options['modal_cta_catch_font_size_sp']) . 'px; }' . "\n";
	echo "}\n";

}
