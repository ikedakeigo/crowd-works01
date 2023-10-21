<?php

// 吹き出し
function speech_balloon_template( $content, $i, $type = 'left' ) {

  $options = get_design_plus_option();

  $image = get_template_directory_uri().'/img/common/no_avatar.png';
  if($options['qt_speech_balloon'.$i.'_user_image']){
    $image = wp_get_attachment_image_src( $options['qt_speech_balloon'.$i.'_user_image'], 'square1' );
    if(!empty($image)) $image = $image[0];
  }
  $name = $options['qt_speech_balloon'.$i.'_user_name'];

  $html = '<div class="speech_balloon '.$type.'">'."\n";
  $html .= '<div class="speech_balloon_user">'."\n";
	$html .= '<img class="speech_balloon_user_image" src="'.esc_attr($image).'" alt="">'."\n";
  if($name) $html .= '<div class="speech_balloon_user_name">' . esc_html($name) . '</div>'."\n";
  $html .= '</div>'."\n";
  $html .= '<div class="speech_balloon_text speech_balloon'.$i.'">'."\n";
  $html .= '<span class="before"></span>';
  $html .= '<div class="speech_balloon_text_inner">'.wpautop( $content ).'</div>'."\n";
  $html .= '<span class="after"></span>';
  $html .= '</div>'."\n";
  $html .= '</div>'."\n";

  return $html;

}


function tcd_speech_balloon1( $attr, $content ) {
  return speech_balloon_template($content, 1, 'left');
}
add_shortcode( 'speech_balloon_left1', 'tcd_speech_balloon1' );

function tcd_speech_balloon2( $attr, $content ) {
  return speech_balloon_template($content, 2, 'left');
}
add_shortcode( 'speech_balloon_left2', 'tcd_speech_balloon2' );

function tcd_speech_balloon3( $attr, $content ) {
  return speech_balloon_template($content, 3, 'right');
}
add_shortcode( 'speech_balloon_right1', 'tcd_speech_balloon3' );

function tcd_speech_balloon4( $attr, $content ) {
  return speech_balloon_template($content, 4, 'right');
}
add_shortcode( 'speech_balloon_right2', 'tcd_speech_balloon4' );





/**
 * 吹き出しクイックタグ用ショートコード（フリー）
 */
function tcd_shortcode_speech_balloon_free( $atts, $content ) {

	$atts = shortcode_atts( array(
		'image' => '',
		'name' => '',
    'type' => 'left',
    'color' => '',
    'bg_color' => '',
    'border_color' => ''
	), $atts );

	// user_image_urlが指定されていればメディアID取得・差し替えを試みる
  $image = get_template_directory_uri().'/img/common/no_avatar.png';
	$user_image_url = $atts['image'];
	if ( $atts['image'] ) {
		$attachment_id = attachment_url_to_postid( $atts['image'] );
		if ( $attachment_id ) {
			$user_image = wp_get_attachment_image_src( $attachment_id, 'square1' );
			if ( $user_image ) {
				$image = esc_attr($user_image[0]);
			}
		}
	}

  $name = esc_html($atts['name']);
  $type = esc_attr($atts['type']);
  $color = ($atts['color']) ? 'color:'.esc_attr($atts['color']).';' : '';
  $bg_color = ($atts['bg_color']) ? 'background-color:'.esc_attr($atts['bg_color']).';' : '';
  $border_color = ($atts['border_color']) ? 'border-color:'.esc_attr($atts['border_color']).';' : '';

  $border_right_color = ($atts['bg_color']) ? 'border-right-color:'.esc_attr($atts['bg_color']).';' : '';
  $border_left_color = ($atts['border_color']) ? 'border-left-color:'.esc_attr($atts['border_color']).';' : '';

	$html = '<div class="speech_balloon '.$type.'">'."\n";
  $html .= '<div class="speech_balloon_user">'."\n";
	$html .= '<img class="speech_balloon_user_image" src="'.$image.'" alt="">'."\n";
  if($name) $html .= '<div class="speech_balloon_user_name">' . $name . '</div>'."\n";
  $html .= '</div>'."\n";
  $html .= '<div class="speech_balloon_text">' ."\n";
  $html .= '<span class="before" style="'.$border_left_color.'"></span>';
  $html .= '<div class="speech_balloon_text_inner" style="'.$color.$bg_color.$border_color.'">' .  wpautop( $content )   . '</div>'."\n";
  $html .= '<span class="after" style="'.$border_right_color.'"></span>';
  $html .= '</div>'."\n";
  $html .= '</div>'."\n";

	return $html;
}
add_shortcode( 'speech_balloon_free', 'tcd_shortcode_speech_balloon_free' );




/**
 * Google Map用ショートコード
 */
function tcd_google_map( $atts) {
  global $options;
  if ( ! $options ) $options = get_design_plus_option();

  $atts = shortcode_atts( array(
    'address' => '',
  ), $atts );

  $html = '';

  if ( $atts['address'] ) {

    $use_custom_overlay = 'type1' !== $options['qt_gmap_marker_type'] ? 1 : 0;
    $custom_marker_type = $options['qt_gmap_marker_type'] ? $options['qt_gmap_marker_type'] : 'type2';

    $marker_img = $options['qt_gmap_marker_img'] ? wp_get_attachment_url( $options['qt_gmap_marker_img'] ) : get_template_directory_uri().'/img/common/gmap_no_image.png';
    if(($custom_marker_type == 'type3') && !empty($marker_img)) {
      $marker_text = '';
    } else {
      $marker_text = $options['qt_gmap_marker_text'];
    }
    if($options['qt_access_saturation'] == 'default'){
      $access_saturation = 0;
    }else{
      $access_saturation = -100;
    }
    $rand = rand();

    $html .= "<div class='qt_google_map'>\n";
    $html .= " <div class='qt_googlemap clearfix'>\n";
    $html .= "  <div id='qt_google_map" . $rand . "' class='qt_googlemap_embed'></div>\n";
    $html .= " </div>\n";
    $html .= " <script>\n";
    $html .= " jQuery(window).on('load', function() {\n";
    $html .= "  initMap('qt_google_map" . $rand . "', '" . esc_js( $atts['address'] ) . "', " . esc_js( $access_saturation ) . ", " . esc_js( $use_custom_overlay ) . ", '" . esc_js( $marker_img ) . "', '" . esc_js( $marker_text ) . "');\n";
    $html .= " });\n";
    $html .= " </script>\n";
    $html .= "</div>\n";

    if ( ! wp_script_is( 'qt_google_map_api', 'enqueued' ) ) {
      wp_enqueue_script( 'qt_google_map_api', 'https://maps.googleapis.com/maps/api/js?key=' . esc_attr( $options['qt_gmap_api_key'] ), array(), version_num(), true );
      wp_enqueue_script( 'qt_google_map', get_template_directory_uri() . '/js/googlemap.js', array(), version_num(), true );
    }
  }

	return $html;
}
add_shortcode( 'qt_google_map', 'tcd_google_map' );

/**
 * FAQ用ショートコード
 */
function tcd_faq( $atts) {
  global $post;

  $faq_list = get_post_meta($post->ID, 'faq_list', true);

  $html = '';

  if ( $faq_list ) {
    $html .= "<div class='faq_list'>\n";
    foreach ( $faq_list as $key => $value ) :
      $question = $value['question'];
      $answer = $value['answer'];
      if ( $question && $answer) {
        $html .= "<div class='item'>\n";
        $html .= '<h4 class="title no_editor_style"><span>' . esc_html($question) . "</span></h4>\n";
        $html .= '<div class="desc_area"><p class="desc no_editor_style"><span>' . wp_kses_post(nl2br($answer)) . "</span></p></div>\n";
        $html .= "</div>\n";
      }
    endforeach;
    $html .= "</div>\n";
  }

	return $html;
}
add_shortcode( 'sc_faq', 'tcd_faq' );


// タイトル
function sc_section_title($atts) {

  $atts = shortcode_atts( array(
		'main' => '',
		'sub' => ''
	), $atts );
	
	$main = $atts['main'];
	$sub = $atts['sub'];

  $html = '';
  if($main || $sub) {
    $html = '<div class="common_header short_code">';
    $html .= '<h2 class="heading rich_font no_editor_style">';
    if($main) $html .= '<span class="heading_top common_headline">'.esc_html($main).'</span>';
    if($sub) $html .= '<span class="heading_bottom">'.esc_html($sub).'</span>';
    $html .= '</h2>';
    $html .= '</div>';
  }
	
	return $html;
		
}
add_shortcode('sc_title', 'sc_section_title');





