<?php

// ロード画面 フロントエンドフック登録
function loading_screen_wp() {
	global $dp_options, $post;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$show_loading = $dp_options['show_loading'];
  $display_page = $dp_options['loading_display_page'];
  $display_times = $dp_options['loading_display_time'];

  if ( $show_loading ) {

    // トップページだけの場合
    if($display_page == 'type1' && !is_front_page()){
      $show_loading = false;
    }

    // 一度だけ表示する場合
    if($display_times == 'type1'){
      if ( ! empty( $_COOKIE['hide_loading_screen'] ) ) {
        $show_loading = false;
      }else{
        // ここでクッキー保存
        setcookie( 'hide_loading_screen', 1, 0, COOKIEPATH, COOKIE_DOMAIN, false );
      }
    }

  }

	if ( $show_loading ) {
		add_action( 'wp_enqueue_scripts', 'loading_screen_enqueue_script' );
		add_filter( 'body_class', 'loading_screen_body_class' );
		add_action( 'tcd_output_loading_screen', 'render_loading_screen' );
	}
}
add_action( 'wp', 'loading_screen_wp' );


// ローディング css & js
function loading_screen_enqueue_script() {
  wp_enqueue_style( 'loading-screen-css', get_template_directory_uri()  . '/css/loading-screen.css');
	wp_enqueue_script( 'loading-screen-js', get_template_directory_uri() . '/js/loading-screen.js', array( 'jquery' ), version_num(), false );
}


// ローディング body class
function loading_screen_body_class( $classes ) {
	
  $classes[] = 'use_loading_screen';

	return $classes;
}


// ローディング 出力
function render_loading_screen() {

  global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

  $out = null;

  
  $loading_type = $dp_options['loading_type'];
  $icon_color = esc_attr($dp_options['loading_icon_color']);
  $type = 'simple';

  // サークル
  if($loading_type == 'type1'){

    $out .= '<div class="p-loading-screen__circle">';
    $out .= '<svg class="p-loading-screen__circle-icon" viewBox="25 25 50 50">';
    $out .= '<circle class="p-loading-screen__circle-path" style="stroke:'.$icon_color.';" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>';
    $out .= '</svg>';
    $out .= '</div>';


  // スクエア
  }elseif($loading_type == 'type2'){

    $out .= '<div class="p-loading-screen__square">';
    for ( $i = 1; $i <= 9; $i++ ) {
      $out .= '<div class="p-loading-screen__square-icon p-loading-screen__square-icon--'.$i.'" style="background-color:'.$icon_color.';"></div>';
    }
    $out .= '</div>';


  // ドット
  }elseif($loading_type == 'type3'){

    $out .= '<div class="p-loading-screen__dot">';
    for( $i = 1; $i <= 12; $i++ ){
      $out .= '<div class="p-loading-screen__dot-icon p-loading-screen__dot-icon--'.$i.'"><span style="background-color:'.$icon_color.';"></span></div>';
    }
    $out .= '</div>';


  // ロゴ
  }elseif($loading_type == 'type4'){

    $type = 'splash';
    $out .= '<div id="js-loading-screen-content" class="p-loading-screen__logo p-loading-screen--content">';

    $image = wp_get_attachment_image_src( $dp_options['loading_logo_image'], 'full' );
    $image_sp = wp_get_attachment_image_src( $dp_options['loading_logo_image_sp'], 'full' );

    if($image && $image_sp){
      $retina_sp = $dp_options['loading_logo_retina_sp'];
      if($retina_sp == 'yes'){
        $image_sp[1] = round($image_sp[1] / 2);
        $image_sp[2] = round($image_sp[2] / 2);
      }
      $out .= '<img class="p-loading-screen__logo-image__sp" src="'.esc_attr($image_sp[0]).'" alt="" width="'.esc_attr($image_sp[1]).'" height="'.esc_attr($image_sp[2]).'">';
    }

    if($image){
      $retina = $dp_options['loading_logo_retina'];
      if($retina == 'yes'){
        $image[1] = round($image[1] / 2);
        $image[2] = round($image[2] / 2);
      }
      $out .= '<img class="p-loading-screen__logo-image__pc" src="'.esc_attr($image[0]).'" alt="" width="'.esc_attr($image[1]).'" height="'.esc_attr($image[2]).'">';
    }

    $out .= '</div>';


  // キャッチフレーズ
  }elseif($loading_type == 'type5'){

    $type = 'splash';
    $catch = $dp_options['loading_catch'];
    $catch_font_type = $dp_options['loading_catch_font_type'];
    $catch_font_color = $dp_options['loading_catch_font_color'];
    $catch_font_size = $dp_options['loading_catch_font_size'];
    $catch_font_size_sp = $dp_options['loading_catch_font_size_sp'];

    $out .= '<div id="js-loading-screen-content" class="p-loading-screen__catch p-loading-screen--content rich_font_'.esc_attr($catch_font_type).'">';

    if($catch){
      $out .= '<p class="p-loading-screen__catch-pc" style="color:'.esc_attr($catch_font_color).';font-size:'.esc_attr($catch_font_size).'px;">'.str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( $catch ) ).'</p>';
      $out .= '<p class="p-loading-screen__catch-sp" style="color:'.esc_attr($catch_font_color).';font-size:'.esc_attr($catch_font_size_sp).'px;">'.str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( $catch ) ).'</p>';
    }

    $out .= '</div>';

  }

  if ( $out ) {

    $bg_color = $dp_options['loading_bg_color'];

    echo '<div id="js-loadding-screen" class="p-loading-screen p-loading-screen--'.$type.'" style="background-color:' . $bg_color . ';">' . "\n";
    echo "\t" . '<div class="p-loading-screen__inner">' . "\n";
    echo "\t\t\t" . trim( $out ) . "\n";
    echo "\t</div>\n";
		echo "</div>\n";
    
  }

}