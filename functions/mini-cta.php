<?php

// ミニCTA フロントエンドフック登録
function mini_cta_wp() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$show_mini_cta = ($dp_options['mini_cta_type'] == 'type3') ? false : true;

	if ( $show_mini_cta ) {

		// 商品詳細ページなら非表示
		if(is_woocommerce_active() && is_singular('product')){
			$show_mini_cta = false;
		}

		// 固定ページだったら非表示
		if(is_page() && !is_front_page() && !is_home()){
			$show_mini_cta = false;
		}

		// 画像がなければ
		if($dp_options['mini_cta_type'] == 'type2' && !$dp_options['mini_cta_image']){
			$show_mini_cta = false;
		}

		// 非表示クッキーがあればfalse
		if ( ! empty( $_COOKIE['hide_mini_cta'] ) ) {
			$show_mini_cta = false;
		}
		
	}

	if ( $show_mini_cta ) {
		add_action( 'wp_enqueue_scripts', 'mini_cta_enqueue_script' );
		add_filter( 'body_class', 'mini_cta_body_class' );
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
	$classes[] = 'show_mini_cta';
	return $classes;
}


// ミニCTA出力
function render_mini_cta() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$out = null;

	if($dp_options['mini_cta_type'] == 'type1'){

		if ( $dp_options['mini_cta_catch'] ) {
			$catch_color = $dp_options['mini_cta_catch_font_color'];
			$out .= "\t\t\t";
			$out .= '<h2 class="p-mini-cta__catch" style="color:' . esc_attr($catch_color) . ';"><span>' . str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( $dp_options['mini_cta_catch'] ) ) . "</span></h2>\n";
		}

		if ( $dp_options['mini_cta_desc'] ) {
			$out .= "\t\t\t";
			$out .= '<div class="p-mini-cta__desc"><span>' . str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( $dp_options['mini_cta_desc'] ) ) . "</span></div>\n";
		}

		$button_bg_color = $dp_options['mini_cta_button_bg_color'];
		if ( $dp_options['mini_cta_button_url'] ) {
			$out .= "\t\t\t";
			$out .= '<a class="p-mini-cta__button" href="' . esc_attr( $dp_options['mini_cta_button_url'] ) . '" style="background-color:' . esc_attr($button_bg_color) . ';">' . esc_html( $dp_options['mini_cta_button_label'] ) . "</a>\n";
		} else {
			$out .= "\t\t\t";
			$out .= '<div class="p-mini-cta__button" style="background-color:' . esc_attr($button_bg_color) . ';">' . esc_html( $dp_options['mini_cta_button_label'] ) . "</div>\n";
		}

	}elseif($dp_options['mini_cta_type'] == 'type2' && $dp_options['mini_cta_image']){

		$url = $dp_options['mini_cta_image_url'];
		$out .= "\t\t\t";
		if($url){
			$out .= '<a href="' . esc_url($dp_options['mini_cta_image_url']) . '" class="p-mini-cta__image">' . "\n";
		}else{
			$out .= '<div class="p-mini-cta__image">' . "\n";
		}

		$image = wp_get_attachment_image_src( $dp_options['mini_cta_image'], 'full' );
		if($image){
			$out .= "\t\t\t";
			$out .= '<img src="' . esc_attr($image[0]) . '" alt="" width="' . esc_attr($image[1]) . '" height="' . esc_attr($image[2]) . '">' . "\n";
		}
		
		$out .= "\t\t\t";
		if($url){
			$out .= '</a>' . "\n";
		}else{
			$out .= '</div>' . "\n";
		}

	}

	if ( $out ) {
		echo '<div id="js-mini-cta" class="p-mini-cta '.esc_html($dp_options['mini_cta_type']).'">' . "\n";
		echo "\t" . '<div class="p-mini-cta__inner">' . "\n";
		echo "\t\t" . '<button class="p-mini-cta__close" data-cookiepath="' . esc_attr( COOKIEPATH ) . '">&#xe91a;</button>' ." \n";
		echo "\t\t" . '<div class="p-mini-cta__contents">' . "\n";
		echo "\t\t\t" . trim( $out ) . "\n";
		echo "\t\t</div>\n";
		echo "\t</div>\n";
		echo "</div>\n";
	}
}
