<?php

function tcd_quicktag_admin_init() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	if ( $dp_options['use_quicktags'] && ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) ) {
		add_filter( 'mce_external_plugins', 'tcd_add_tinymce_plugin' );

		add_filter( 'mce_buttons', 'tcd_register_mce_button' );
		
		add_action( 'admin_print_footer_scripts', 'tcd_add_quicktags' );

		// Dynamic css for classic visual editor
		add_filter( 'editor_stylesheets', 'editor_stylesheets_tcd_visual_editor_dynamic_css' );

		// Dymamic css for visual editor on block editor
		wp_enqueue_style( 'tcd-quicktags', get_tcd_quicktags_dynamic_css_url(), false, version_num() );
	}
}
add_action( 'admin_init', 'tcd_quicktag_admin_init' );

// Declare script for new button
function tcd_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['tcd_mce_button'] = get_template_directory_uri() . '/admin/js/mce-button.js?ver=' . version_num();
	return $plugin_array;
}

// Register new button in the editor
function tcd_register_mce_button( $buttons ) {
	array_push( $buttons, 'tcd_mce_button' );
	return $buttons;
}

function tcd_add_quicktags() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$tcdQuicktagsL10n = array(
		'pulldown_title' => array(
			'display' => __( 'quicktags', 'tcd-ankle' ),
		),
		'ytube' => array(
			'display' => __( 'YouTube', 'tcd-ankle' ),
			'tag' => __( '<div class="ytube">YouTube code here</div>', 'tcd-ankle' )
		),
		'relatedcardlink' => array(
			'display' => __( 'Cardlink', 'tcd-ankle' ),
			'tag' => __( '[clink url="Post URL to display"]', 'tcd-ankle' )
		),
		'post_col-2' => array(
			'display' => __( '2 column', 'tcd-ankle' ),
			'tag' => __( '<div class="post_row"><div class="post_col post_col-2">Text and image tags to display in the left column</div><div class="post_col post_col-2">Text and image tags to display in the right column</div></div>', 'tcd-ankle' )
		),
		'post_col-3' => array(
			'display' => __( '3 column', 'tcd-ankle' ),
			'tag' => __( '<div class="post_row"><div class="post_col post_col-3">Text and image tags to display in the left column</div><div class="post_col post_col-3">Text and image tags to display in the center column</div><div class="post_col post_col-3">Text and image tags to display in the right column</div></div>', 'tcd-ankle' )
		),
		'q_comment_out' => array(
			'display' => __( 'Comment out', 'tcd-ankle' ),
			'tag' => '<div class="hidden"><!-- ' . __( 'Text entered in this area will not be displayed on the browser', 'tcd-ankle' ) . ' --></div>'
		),
		'q_h2' => array(
			'display' => __( 'Styled h2 tag', 'tcd-ankle' ),
			'tag' => '<h2 class="styled_h2">' . __( 'Heading 2', 'tcd-ankle' ) . '</h2>'
		),
		'q_h3' => array(
			'display' => __( 'Styled h3 tag', 'tcd-ankle' ),
			'tag' => '<h3 class="styled_h3">' . __( 'Heading 3', 'tcd-ankle' ) . '</h3>'
		),
		'q_h4' => array(
			'display' => __( 'Styled h4 tag', 'tcd-ankle' ),
			'tag' => '<h4 class="styled_h4">' . __( 'Heading 4', 'tcd-ankle' ) . '</h4>'
		),
		'q_h5' => array(
			'display' => __( 'Styled h5 tag', 'tcd-ankle' ),
			'tag' => '<h5 class="styled_h5">' . __( 'Heading 5', 'tcd-ankle' ) . '</h5>'
		),
		'well2' => array(
			'display' => __( 'Frame style', 'tcd-ankle' ),
			'tag' => __( '<p class="well2">Frame style</p>', 'tcd-ankle' )
		),
		'q_custom_button1' => array(
			'display' => sprintf( __( 'Button %d', 'tcd-ankle' ), 1 ),
			'tag' => '<a href="#" class="q_custom_button q_custom_button1">' . sprintf( __( 'Button %d', 'tcd-ankle' ), 1 ) . '</a>'
		),
		'q_custom_button2' => array(
			'display' => sprintf( __( 'Button %d', 'tcd-ankle' ), 2 ),
			'tag' => '<a href="#" class="q_custom_button q_custom_button2">' . sprintf( __( 'Button %d', 'tcd-ankle' ), 2 ) . '</a>'
		),
		'q_custom_button3' => array(
			'display' => sprintf( __( 'Button %d', 'tcd-ankle' ), 3 ),
			'tag' => '<a href="#" class="q_custom_button q_custom_button3">' . sprintf( __( 'Button %d', 'tcd-ankle' ), 3 ) . '</a>'
		),
		'q_underline1' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-ankle' ), 1 ),
			'tag' => '<span class="q_underline q_underline1" style="border-bottom-color:;">' . sprintf( __( 'Underline %d', 'tcd-ankle' ), 1 ) . '</span>'
		),
		'q_underline2' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-ankle' ), 2 ),
			'tag' => '<span class="q_underline q_underline2" style="border-bottom-color:;">' . sprintf( __( 'Underline %d', 'tcd-ankle' ), 2 ) . '</span>'
		),
		'q_underline3' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-ankle' ), 3 ),
			'tag' => '<span class="q_underline q_underline3" style="border-bottom-color:;">' . sprintf( __( 'Underline %d', 'tcd-ankle' ), 3 ) . '</span>'
		),
		'speech_balloon_left1' => array(
			'display' => __( 'Speech balloon left 1', 'tcd-ankle' ),
			'tag' => '[speech_balloon_left1]'.__( 'Enter the text in the speech balloon here.', 'tcd-ankle' ).'[/speech_balloon_left1]'
		),
		'speech_balloon_left2' => array(
			'display' => __( 'Speech balloon left 2', 'tcd-ankle' ),
			'tag' => '[speech_balloon_left2]'.__( 'Enter the text in the speech balloon here.', 'tcd-ankle' ).'[/speech_balloon_left2]'
		),
		'speech_balloon_right1' => array(
			'display' => __( 'Speech balloon right 1', 'tcd-ankle' ),
			'tag' => '[speech_balloon_right1]'.__( 'Enter the text in the speech balloon here.', 'tcd-ankle' ).'[/speech_balloon_right1]'
		),
		'speech_balloon_right2' => array(
			'display' => __( 'Speech balloon right 2', 'tcd-ankle' ),
			'tag' => '[speech_balloon_right2]'.__( 'Enter the text in the speech balloon here.', 'tcd-ankle' ).'[/speech_balloon_right2]'
		),
		'google_map' => array(
			'display' => __( 'Google map' ),
			'tag' => '[qt_google_map address="'. __( 'Enter address here', 'tcd-ankle' ) . '"]'
		)
	);
?>
<script type="text/javascript">
<?php
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		echo "var tcdQuicktagsL10n = " . json_encode( $tcdQuicktagsL10n ) . ";\n";
	}
	if ( wp_script_is( 'quicktags' ) ) {
		foreach ( $tcdQuicktagsL10n as $key => $value ) {
			if ( is_numeric( $key ) || empty( $value['display'] ) ) continue;
			if ( empty( $value['tag'] ) && empty( $value['tagStart'] ) ) continue;

			if ( isset( $value['tag'] ) && ! isset( $value['tagStart'] ) ) {
				$value['tagStart'] = $value['tag'] . "\n\n";
			}
			if ( ! isset( $value['tagEnd'] ) ) {
				$value['tagEnd'] = '';
			}

			$key = json_encode( $key );
			$display = json_encode( $value['display'] );
			$tagStart = json_encode( $value['tagStart'] );
			$tagEnd = json_encode( $value['tagEnd'] );
			echo "QTags.addButton($key, $display, $tagStart, $tagEnd);\n";
		}
	}
?>
</script>
<?php
}

// Get dymamic css url
function get_tcd_quicktags_dynamic_css_url() {
	return admin_url( 'admin-ajax.php?action=tcd_quicktags_dynamic_css' );
}

// Dymamic css for visual editor
function tcd_ajax_quicktags_dynamic_css() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	header( 'Content-Type: text/css; charset=UTF-8' );

?>
<?php
     if($dp_options['headline_font_type'] == 'type1') {
?>
body.cb_wysiwyg_editor h2, body.cb_wysiwyg_editor h3 { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; font-weight:600; }
<?php } elseif($dp_options['headline_font_type'] == 'type2') { ?>
body.cb_wysiwyg_editor h2, body.cb_wysiwyg_editor h3 { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight:600; }
<?php } else { ?>
body.cb_wysiwyg_editor h2, body.cb_wysiwyg_editor h3 { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight:600; }
<?php }; ?>

body.cb_wysiwyg_editor h2.styled_h2:before { display:none; }
<?php
      if($dp_options['content_font_type'] == 'type1') {
?>
body.cb_wysiwyg_editor h2.styled_h2, body.cb_wysiwyg_editor h3.styled_h3 { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; }
<?php } elseif($dp_options['content_font_type'] == 'type2') { ?>
body.cb_wysiwyg_editor h2.styled_h2, body.cb_wysiwyg_editor h3.styled_h3 { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; }
<?php } else { ?>
body.cb_wysiwyg_editor h2.styled_h2, body.cb_wysiwyg_editor h3.styled_h3 { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; }
<?php
			};

			for ( $i = 2; $i <= 5; $i++ ){

				$heading_font_size = $dp_options['qt_h'.$i.'_font_size'];
				$heading_font_size_sp = $dp_options['qt_h'.$i.'_font_size_sp'];
				$heading_text_align = $dp_options['qt_h'.$i.'_text_align'];
				$heading_font_weight = $dp_options['qt_h'.$i.'_font_weight'];
				$heading_font_color = $dp_options['qt_h'.$i.'_font_color'];
				$heading_bg_color = $dp_options['qt_h'.$i.'_bg_color'];
				$heading_ignore_bg = $dp_options['qt_h'.$i.'_ignore_bg'];
				$heading_border = 'qt_h'.$i.'_border_';
				$heading_border_color = $dp_options['qt_h'.$i.'_border_color'];
				$heading_border_width = $dp_options['qt_h'.$i.'_border_width'];
				$heading_border_style = $dp_options['qt_h'.$i.'_border_style'];

?>
.styled_h<?php echo $i ?>, .editor-styles-wrapper .styled_h<?php echo $i ?> {
  font-size:<?php echo esc_attr($heading_font_size); ?>px!important;
  text-align:<?php echo esc_attr($heading_text_align); ?>!important;
  font-weight:<?php echo esc_attr($heading_font_weight); ?>!important;
  color:<?php echo esc_attr($heading_font_color); ?>;
  border-color:<?php echo esc_attr($heading_border_color); ?>;
  border-width:<?php echo esc_attr($heading_border_width); ?>px;
  border-style:<?php echo esc_attr($heading_border_style); ?>;
<?php

  $border_potition = array('left', 'right', 'top', 'bottom');
  foreach( $border_potition as $position ):

    if($dp_options[$heading_border.$position]){
      if($position == 'left' || $position == 'right'){
        echo 'padding-'.$position.':1em!important;'."\n".'padding-top:0.5em!important;'."\n".'padding-bottom:0.5em!important;'."\n";
      }else{
        echo 'padding-'.$position.':0.8em!important;'."\n";
      }
    }else{
      echo 'border-'.$position.':none;'."\n";
    }

  endforeach;

  if($heading_ignore_bg){
    echo 'background-color:transparent;'."\n";
  }else{
    echo 'background-color:'.esc_attr($heading_bg_color).';'."\n".'padding:0.8em 1em!important;'."\n";
  }

?>
}
<?php
		
		}
		
		// カスタムボタン
		for ( $i = 1; $i <= 3; $i++ ) {

	$button_type = $dp_options['qt_button'.$i.'_type'];
	$button_shape = $dp_options['qt_button'.$i.'_border_radius'];
	$button_size = $dp_options['qt_button'.$i.'_size'];
	$button_animation_type = $dp_options['qt_button'.$i.'_animation_type'];
	$button_color = $dp_options['qt_button'.$i.'_color'];
	$button_color_hover = $dp_options['qt_button'.$i.'_color_hover'];

	$colors = array();
	$animations = array();

	switch ($button_shape){
		case 'flat': $shape = 'border-radius:0px;'; break;
		case 'rounded': $shape = 'border-radius:6px;'; break;
		case 'oval': $shape = 'border-radius:70px;'; break;
	}
	switch ($button_size){
		case 'small': $size = 'width:130px; height:40px; line-height:40px;'; break;
		case 'medium': $size = 'width:270px; height:60px; line-height:60px;'; break;
		case 'large': $size = 'width:400px; height:70px; line-height:70px;'; break;
	}
	switch ($button_type){
		case 'type1': $colors = array('background-color:'.$button_color.';border:none;', 'background-color:'.$button_color_hover.';', '' ); break;
		case 'type2': $colors = array('color:'.$button_color.';border-color:'.$button_color.';', 'background-color:'.$button_color_hover.';', 'color:#fff;border-color:'.$button_color_hover.';'); break;
		case 'type3': $colors = array('border-color:'.$button_color.';','background-color:'.$button_color.';', 'color:'.$button_color_hover.';border-color:'.$button_color_hover.';' ); break;
	}
	switch ($button_animation_type){
		case 'animation_type1': $animations = ($button_type != 'type3') ? array('opacity:0;', 'opacity:1;') : array('opacity:1;', 'opacity:0;'); break;
		case 'animation_type2': $animations = ($button_type != 'type3') ? array('left:-100%;', 'left:0;') : array('left:0;', 'left:100%;'); break;
		case 'animation_type3': $animations = ($button_type != 'type3') ? array('left:calc(-100% - 110px);transform:skewX(45deg); width:calc(100% + 70px);', 'left:-35px;') : array('left:-35px;transform:skewX(45deg); width:calc(100% + 70px);', 'left:calc(100% + 50px);'); break;
	}

?>
.q_custom_button<?php echo $i; ?> { <?php echo $size.$shape.$colors[0]; ?> }
.q_custom_button<?php echo $i; ?>:before { <?php echo $colors[1].$animations[0]; ?> }
<?php

	}


	// アンダーライン
	for ( $i = 1; $i <= 3; $i++ ) {

		$underline_color = $dp_options['qt_underline'.$i.'_border_color'];
		$underline_font_weight = $dp_options['qt_underline'.$i.'_font_weight'];

?>
.q_underline<?php echo $i; ?> {
	font-weight:<?php echo esc_attr($underline_font_weight); ?>;
	border-bottom-color:<?php echo esc_attr($underline_color); ?>;
}


<?php

	}


?>
<?php
	exit;
}
add_action( 'wp_ajax_tcd_quicktags_dynamic_css', 'tcd_ajax_quicktags_dynamic_css' );

// add_editor_style()だとテーマ内のcssが最後になるためここで最後尾にcss追加
function editor_stylesheets_tcd_visual_editor_dynamic_css( $stylesheets ) {
	$stylesheets[] = get_tcd_quicktags_dynamic_css_url();
	$stylesheets = array_unique( $stylesheets );
	return $stylesheets;
}
