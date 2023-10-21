<?php
/*
 * クイックタグの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_quicktag_dp_default_options' );


//  Add label of quicktag tab
add_action( 'tcd_tab_labels', 'add_quicktag_tab_label' );


// Add HTML of quicktag tab
add_action( 'tcd_tab_panel', 'add_quicktag_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_quicktag_theme_options_validate' );


// タブの名前
function add_quicktag_tab_label( $tab_labels ) {
	$tab_labels['quicktag'] = __( 'Quick tag', 'tcd-ankle' );
	return $tab_labels;
}


// 初期値
function add_quicktag_dp_default_options( $dp_default_options ) {

	$dp_default_options['use_quicktags'] = 1;

  // h2
  $dp_default_options['qt_h2_font_size'] = '26';
	$dp_default_options['qt_h2_font_size_sp'] = '18';
	$dp_default_options['qt_h2_text_align'] = 'center';
	$dp_default_options['qt_h2_font_weight'] = '600';
	$dp_default_options['qt_h2_font_color'] = '#000000';
	$dp_default_options['qt_h2_bg_color'] = '#ffffff';
	$dp_default_options['qt_h2_ignore_bg'] = 1;
	$dp_default_options['qt_h2_border_left'] = '';
	$dp_default_options['qt_h2_border_top'] = '';
	$dp_default_options['qt_h2_border_bottom'] = '';
	$dp_default_options['qt_h2_border_right'] = '';
	$dp_default_options['qt_h2_border_color'] = '#000000';
	$dp_default_options['qt_h2_border_width'] = '3';
	$dp_default_options['qt_h2_border_style'] = 'solid';
  // h3
  $dp_default_options['qt_h3_font_size'] = '20';
	$dp_default_options['qt_h3_font_size_sp'] = '16';
	$dp_default_options['qt_h3_text_align'] = 'left';
	$dp_default_options['qt_h3_font_weight'] = '600';
	$dp_default_options['qt_h3_font_color'] = '#000000';
	$dp_default_options['qt_h3_bg_color'] = '#fafafa';
	$dp_default_options['qt_h3_ignore_bg'] = 1;
	$dp_default_options['qt_h3_border_left'] = 1;
	$dp_default_options['qt_h3_border_top'] = '';
	$dp_default_options['qt_h3_border_bottom'] = '';
	$dp_default_options['qt_h3_border_right'] = '';
	$dp_default_options['qt_h3_border_color'] = '#000000';
	$dp_default_options['qt_h3_border_width'] = '2';
	$dp_default_options['qt_h3_border_style'] = 'solid';
  // h4
  $dp_default_options['qt_h4_font_size'] = '18';
	$dp_default_options['qt_h4_font_size_sp'] = '18';
	$dp_default_options['qt_h4_text_align'] = 'left';
	$dp_default_options['qt_h4_font_weight'] = '400';
	$dp_default_options['qt_h4_font_color'] = '#000000';
	$dp_default_options['qt_h4_bg_color'] = '#ffffff';
	$dp_default_options['qt_h4_ignore_bg'] = 1;
	$dp_default_options['qt_h4_border_left'] = '';
	$dp_default_options['qt_h4_border_top'] = '';
	$dp_default_options['qt_h4_border_bottom'] = 1;
	$dp_default_options['qt_h4_border_right'] = '';
	$dp_default_options['qt_h4_border_color'] = '#dddddd';
	$dp_default_options['qt_h4_border_width'] = '1';
	$dp_default_options['qt_h4_border_style'] = 'dotted';
  // h5
  $dp_default_options['qt_h5_font_size'] = '16';
	$dp_default_options['qt_h5_font_size_sp'] = '16';
	$dp_default_options['qt_h5_text_align'] = 'left';
	$dp_default_options['qt_h5_font_weight'] = '400';
	$dp_default_options['qt_h5_font_color'] = '#000000';
	$dp_default_options['qt_h5_bg_color'] = '#fafafa';
	$dp_default_options['qt_h5_ignore_bg'] = '';
	$dp_default_options['qt_h5_border_left'] = '';
	$dp_default_options['qt_h5_border_top'] = '';
	$dp_default_options['qt_h5_border_bottom'] = '';
	$dp_default_options['qt_h5_border_right'] = '';
	$dp_default_options['qt_h5_border_color'] = '#000000';
	$dp_default_options['qt_h5_border_width'] = 3;
	$dp_default_options['qt_h5_border_style'] = 'double';


  // ボタン1
	$dp_default_options['qt_button1_type'] = 'type2';
	$dp_default_options['qt_button1_border_radius'] = 'oval';
	$dp_default_options['qt_button1_size'] = 'medium';
	$dp_default_options['qt_button1_animation_type'] = 'animation_type1';
	$dp_default_options['qt_button1_color'] = '#666666';
	$dp_default_options['qt_button1_color_hover'] = '#bf9d87';
  // ボタン2
  $dp_default_options['qt_button2_type'] = 'type1';
	$dp_default_options['qt_button2_border_radius'] = 'flat';
	$dp_default_options['qt_button2_size'] = 'medium';
	$dp_default_options['qt_button2_animation_type'] = 'animation_type2';
	$dp_default_options['qt_button2_color'] = '#333333';
	$dp_default_options['qt_button2_color_hover'] = '#bf9d87';
  // ボタン3
  $dp_default_options['qt_button3_type'] = 'type3';
	$dp_default_options['qt_button3_border_radius'] = 'oval';
	$dp_default_options['qt_button3_size'] = 'large';
	$dp_default_options['qt_button3_animation_type'] = 'animation_type3';
	$dp_default_options['qt_button3_color'] = '#bf9d87';
	$dp_default_options['qt_button3_color_hover'] = '#bf9d87';


  // アンダーライン1
	$dp_default_options['qt_underline1_border_color'] = '#fff799';
	$dp_default_options['qt_underline1_font_weight'] = '400';
	$dp_default_options['qt_underline1_use_animation'] = 'no';
  // アンダーライン2
	$dp_default_options['qt_underline2_border_color'] = '#99f9ff';
	$dp_default_options['qt_underline2_font_weight'] = '600';
	$dp_default_options['qt_underline2_use_animation'] = 'yes';
  // アンダーライン3
	$dp_default_options['qt_underline3_border_color'] = '#ff99b8';
	$dp_default_options['qt_underline3_font_weight'] = '400';
	$dp_default_options['qt_underline3_use_animation'] = 'yes';


  // 吹き出し1
  $dp_default_options['qt_speech_balloon1_user_image'] = '';
	$dp_default_options['qt_speech_balloon1_user_name'] = __('User name', 'tcd-ankle');
	$dp_default_options['qt_speech_balloon1_font_color'] = '#000';
	$dp_default_options['qt_speech_balloon1_bg_color'] = '#f2f2f2';
	$dp_default_options['qt_speech_balloon1_border_color'] = '#f2f2f2';
  // 吹き出し2
	$dp_default_options['qt_speech_balloon2_user_image'] = '';
	$dp_default_options['qt_speech_balloon2_user_name'] = __('User name', 'tcd-ankle');
	$dp_default_options['qt_speech_balloon2_font_color'] = '#000000';
	$dp_default_options['qt_speech_balloon2_bg_color'] = '#ffffff';
	$dp_default_options['qt_speech_balloon2_border_color'] = '#bf9d87';
  // 吹き出し3
	$dp_default_options['qt_speech_balloon3_user_image'] = '';
	$dp_default_options['qt_speech_balloon3_user_name'] = __('User name', 'tcd-ankle');
	$dp_default_options['qt_speech_balloon3_font_color'] = '#ffffff';
	$dp_default_options['qt_speech_balloon3_bg_color'] = '#bf9d87';
	$dp_default_options['qt_speech_balloon3_border_color'] = '#bf9d87';
  // 吹き出し4
	$dp_default_options['qt_speech_balloon4_user_image'] = '';
	$dp_default_options['qt_speech_balloon4_user_name'] = __('User name', 'tcd-ankle');
	$dp_default_options['qt_speech_balloon4_font_color'] = '#000000';
	$dp_default_options['qt_speech_balloon4_bg_color'] = '#ffffff';
	$dp_default_options['qt_speech_balloon4_border_color'] = '#000000';


  // Google Map
	$dp_default_options['qt_gmap_api_key'] = '';
  $dp_default_options['qt_access_saturation'] = 'monochrome';
	$dp_default_options['qt_gmap_marker_type'] = 'type2';
  $dp_default_options['qt_gmap_marker_bg'] = '#ffffff';
  $dp_default_options['qt_gmap_marker_text'] = 'MAP';
  $dp_default_options['qt_gmap_marker_color'] = '#000000';
  $dp_default_options['qt_gmap_marker_img'] = '';


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_quicktag_tab_panel( $options ) {

  global $dp_default_options, $text_align_options, $font_weight_options, $border_potition_options, $border_style_options, $button_type_options, $button_border_radius_options, $button_size_options, $button_animation_options, $bool_options, $google_map_design_options, $google_map_marker_options;

?>

<div id="tab-content-quicktag" class="tab-content">

  <div class="theme_option_field cf theme_option_field_ac open active">
    <h3 class="theme_option_headline"><?php _e('Activation', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">
      <p><?php _e( 'If you don\'t want to use quicktags included in the theme, please uncheck the box below.', 'tcd-ankle' ); ?></p>
      <p><label><input name="dp_options[use_quicktags]" type="checkbox" value="1" <?php checked( 1, $options['use_quicktags'] ); ?>><?php _e( 'Use quicktags', 'tcd-ankle' ); ?></label></p>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

  <?php // 見出し --------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php echo tcd_admin_label('headline'); ?></h3>
    <div class="theme_option_field_ac_content">
      <div class="theme_option_message2">
        <p><?php _e( 'These settings will be reflected in the quick tag button on the edit screen.', 'tcd-ankle' ); ?></p>
      </div>
      <?php for ( $i = 2; $i <= 5; $i++ ) : ?>
      <div class="sub_box cf qt-hn-preview-wrapper">
        <h3 class="theme_option_subbox_headline"><?php printf( __( 'H%d tag', 'tcd-ankle' ), $i ); ?></h3>
        <div class="sub_box_content">

          <?php // 見出しのプレビュー ?>
          <div class="admin_preview_area qt-hn-preview">
						<div class="qt_heading"><span><?php _e('Headline design', 'tcd-ankle'); ?></span></div>
					</div>

          <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-ankle' ); ?></h4>
					<ul class="option_list">
						<li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo tcd_font_size_option($options, 'qt_h'.$i.'_font_size'); ?></li>
						<li class="cf"><span class="label"><?php echo tcd_admin_label('text_align'); ?></span><?php echo tcd_basic_radio_button($options, 'qt_h'.$i.'_text_align', $text_align_options); ?></li>
						<li class="cf"><span class="label"><?php echo tcd_admin_label('font_weight'); ?></span><?php echo tcd_basic_radio_button($options, 'qt_h'.$i.'_font_weight', $font_weight_options); ?></li>
						<li class="cf"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[qt_h<?php echo $i; ?>_font_color]" value="<?php echo esc_attr( $options['qt_h'.$i.'_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
						<li class="cf">
							<span class="label"><?php echo tcd_admin_label('bg_color'); ?></span>
							<?php echo admin_cp_toggle_button($options, 'qt_h'.$i.'_ignore_bg' ) ?>
							<input type="text" name="dp_options[qt_h<?php echo $i; ?>_bg_color]" value="<?php esc_attr_e( $options['qt_h'.$i.'_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker">
						</li>
					</ul>

          <h4 class="theme_option_headline2"><?php _e( 'Border setting', 'tcd-ankle' ); ?></h4>
          <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Display position', 'tcd-ankle'); ?></span>
              <ul class="multiple_checkboxes">
                <?php foreach( $border_potition_options as $option ): ?>
                <li><label>
                  <input name="dp_options[qt_h<?php echo $i; ?>_border_<?php echo $option['value'] ?>]" type="checkbox" value="<?php echo $option['value'] ?>" <?php checked( $options['qt_h'.$i.'_border_'.$option['value']], 1 ); ?> />
                  <span><?php echo $option['label'] ?></span>
                </label></li>
                <?php endforeach; ?>
              </ul>
            </li>
            <li class="cf"><span class="label"><?php _e('Border style', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'qt_h'.$i.'_border_style', $border_style_options); ?></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('border_color'); ?></span><input type="text" name="dp_options[qt_h<?php echo $i; ?>_border_color]" value="<?php echo esc_attr( $options['qt_h'.$i.'_border_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
            <li class="cf">
              <span class="label"><?php _e('Border width', 'tcd-ankle'); ?></span>
              <label class="number_option">
                <input class="hankaku" type="number" name="dp_options[qt_h<?php echo $i; ?>_border_width]" value="<?php esc_attr_e( $options['qt_h'.$i.'_border_width'] ); ?>" min="0" max="100" />
              </label>
            </li>
					</ul>

          <div class="theme_option_message2">
            <p><?php _e( 'If you set the border style to "Double", please set the border width to 3px or more.', 'tcd-ankle' ); ?></p>
          </div>

          <ul class="button_list cf">
            <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
            <li><a class="close_sub_box button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
          </ul>
        </div>
      </div>
      <?php endfor; ?>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // ボタン --------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php echo tcd_admin_label('button'); ?></h3>
    <div class="theme_option_field_ac_content">
      <div class="theme_option_message2">
        <p><?php _e( 'These settings will be reflected in the quick tag button on the edit screen.', 'tcd-ankle' ); ?></p>
      </div>

      <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
      <div class="sub_box cf qt-btn-preview-wrapper">
        <h3 class="theme_option_subbox_headline"><?php echo tcd_admin_label('button').$i; ?></h3>
        <div class="sub_box_content">

          <div id="qt_preview_button<?php echo $i; ?>" class="admin_preview_area qt-btn-preview">
						<div class="qt_button_wrap">
              <div class="qt_button type1"><span class="text"><?php _e('General', 'tcd-ankle'); ?></span><span class="background"></span></div>
							<div class="qt_button type2"><span class="text"><?php _e('Ghost', 'tcd-ankle'); ?></span><span class="background"></span></div>
							<div class="qt_button type3"><span class="text"><?php _e('Reverse', 'tcd-ankle'); ?></span><span class="background"></span></div>
						</div>
					</div>

          <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-ankle' ); ?></h4>
					<ul class="option_list">
						<li class="cf"><span class="label"><?php echo tcd_admin_label('button_type'); ?></span><?php echo tcd_basic_radio_button($options, 'qt_button'.$i.'_type', $button_type_options); ?></li>
						<li class="cf"><span class="label"><?php _e('Shape', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'qt_button'.$i.'_border_radius', $button_border_radius_options); ?></li>
						<li class="cf"><span class="label"><?php _e('Size', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'qt_button'.$i.'_size', $button_size_options); ?></li>
						<li class="cf"><span class="label"><?php _e('Mouseover animation', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'qt_button'.$i.'_animation_type', $button_animation_options); ?></li>
						<li class="cf"><span class="label"><?php _e('Color scheme', 'tcd-ankle'); ?></span><input type="text" name="dp_options[qt_button<?php echo $i; ?>_color]" value="<?php echo esc_attr( $options['qt_button'.$i.'_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
						<li class="cf"><span class="label"><?php _e('Color scheme on mouseover', 'tcd-ankle'); ?></span><input type="text" name="dp_options[qt_button<?php echo $i; ?>_color_hover]" value="<?php echo esc_attr( $options['qt_button'.$i.'_color_hover'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
					</ul>

          <ul class="button_list cf">
            <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
            <li><a class="close_sub_box button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
          </ul>
        </div>
      </div>
      <?php endfor; ?>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // アンダーライン --------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Underline', 'tcd-ankle'); ?></h3>
    <div class="theme_option_field_ac_content">
      <div class="theme_option_message2">
        <p><?php _e( 'These settings will be reflected in the quick tag button on the edit screen.', 'tcd-ankle' ); ?></p>
      </div>
      <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
      <div class="sub_box cf qt-ul-preview-wrapper">
        <h3 class="theme_option_subbox_headline"><?php echo __('Underline', 'tcd-ankle').$i;  ?></h3>
        <div class="sub_box_content">

          <div class="admin_preview_area qt-ul-preview">
						<div>
							<span class="qt_underline inactive"><?php _e('Sample text for underline.', 'tcd-ankle'); ?></span>
							<span class="qt_underline active"><?php _e('The animation will be executed when you scroll into the screen.', 'tcd-ankle'); ?></span>
						</div>
					</div>

          <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-ankle' ); ?></h4>
					<ul class="option_list">
						<li class="cf"><span class="label"><?php echo tcd_admin_label('border_color'); ?></span><input type="text" name="dp_options[qt_underline<?php echo $i; ?>_border_color]" value="<?php echo esc_attr( $options['qt_underline'.$i.'_border_color'] ); ?>" data-default-color="#fff799" class="c-color-picker"></li>
						<li class="cf"><span class="label"><?php echo tcd_admin_label('font_weight'); ?></span><?php echo tcd_basic_radio_button($options, 'qt_underline'.$i.'_font_weight', $font_weight_options); ?></li>
						<li class="cf"><span class="label"><?php _e('Using animation', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'qt_underline'.$i.'_use_animation', $bool_options); ?></li>
					</ul>

          <ul class="button_list cf">
            <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
            <li><a class="close_sub_box button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
          </ul>
        </div>
      </div>
      <?php endfor; ?>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // 吹き出し --------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Speech balloon', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">
      <div class="theme_option_message2">
        <p><?php _e( 'These settings will be reflected in the quick tag button on the edit screen.', 'tcd-ankle' ); ?></p>
      </div>
      <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
      <div class="sub_box cf qt-sb-preview-wrapper preview_image_wrapper">
        <h3 class="theme_option_subbox_headline">
        <?php
            if ( 1 === $i ) _e( 'Speech balloon left 1', 'tcd-ankle' );
            elseif ( 2 === $i ) _e( 'Speech balloon left 2', 'tcd-ankle' );
            elseif ( 3 === $i ) _e( 'Speech balloon right 1', 'tcd-ankle' );
            elseif ( 4 === $i ) _e( 'Speech balloon right 2', 'tcd-ankle');
        ?>
        </h3>
        <div class="sub_box_content">

          <div class="admin_preview_area qt-sb-preview">
						<div class="qt_speech_bubble <?php if($i > 2) echo 'right'; ?>">
							<?php
								$no_image = get_template_directory_uri().'/img/common/no_avatar.png';
								$image = wp_get_attachment_image_src($options['qt_speech_balloon'.$i.'_user_image'], 'square1');
							?>
							<div class="user">
								<img class="image preview_image" src="<?php if($image){ echo $image[0]; }else{ echo $no_image; } ?>" alt="" data-src="<?php echo $no_image; ?>">
								<span class="name"><?php _e('User name', 'tcd-ankle'); ?></span>
							</div>
							<div class="content"><span class="before"></span><?php _e('The speech balloon can be set to a user name, image, and color.', 'tcd-ankle'); ?><span class="after"></span></div>							
						</div>
					</div>

          <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-ankle'); ?></h4>
          <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('User name', 'tcd-ankle'); ?></span><input class="regular-text" name="dp_options[qt_speech_balloon<?php echo $i; ?>_user_name]" type="text" value="<?php echo esc_attr( $options['qt_speech_balloon'.$i.'_user_name'] ); ?>"></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[qt_speech_balloon<?php echo $i; ?>_font_color]" value="<?php echo esc_attr( $options['qt_speech_balloon'.$i.'_font_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_speech_balloon'.$i.'_font_color'] ); ?>" class="c-color-picker"></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[qt_speech_balloon<?php echo $i; ?>_bg_color]" value="<?php echo esc_attr( $options['qt_speech_balloon'.$i.'_bg_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_speech_balloon'.$i.'_bg_color'] ); ?>" class="c-color-picker"></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('border_color'); ?></span><input type="text" name="dp_options[qt_speech_balloon<?php echo $i; ?>_border_color]" value="<?php echo esc_attr( $options['qt_speech_balloon'.$i.'_border_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['qt_speech_balloon'.$i.'_border_color'] ); ?>" class="c-color-picker"></li>
            <li class="cf"><span class="label"><?php _e( 'User image', 'tcd-ankle' ); ?><span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '80', '80'); ?></span></span><?php echo tcd_media_image_uploader($options, 'qt_speech_balloon'.$i.'_user_image', 'full'); ?></li>
          </ul>
          
          <ul class="button_list cf">
            <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
            <li><a class="close_sub_box button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
          </ul>
        </div>
      </div>
      <?php endfor; ?>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // Google Map ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac qt-gm-preview-wrapper preview_image_wrapper">
    <h3 class="theme_option_headline"><?php _e( 'Google Maps', 'tcd-ankle' );  ?></h3>
    <div class="theme_option_field_ac_content">
    
      <div class="theme_option_message2">
        <p><?php _e('You can set styles of marker in Google maps using this option.', 'tcd-ankle');  ?></p>
      </div>
      <?php

					$no_image = get_template_directory_uri().'/img/common/gmap_no_image.png';
					$image = wp_get_attachment_image_src($options['qt_gmap_marker_img'], 'square1');

			?>
      <div id="qt_google_map">
        <div class="admin_preview_area qt-gm-preview">
          <div class="qt_gmap">
            <span class="marker default"><img class="image" width="27px" height="auto" src="<?php echo get_template_directory_uri().'/admin/img/gmap_default_marker.png'; ?>"></span>
            <span class="marker custom text"><?php _e( 'MAP', 'tcd-ankle' ); ?></span>
            <span class="marker custom image"><img class="image preview_image" src="<?php if($image){ echo $image[0]; }else{ echo $no_image; } ?>" data-src="<?php echo $no_image; ?>"></span>
          </div>
          <div class="qt_gmap_background" style="background-image:url(<?php echo get_template_directory_uri().'/admin/img/gmap_background.jpg'; ?>);" ></div>
        </div>
      </div>


      <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-ankle' ); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('API key', 'tcd-ankle'); ?></span><input class="full_width" type="text" name="dp_options[qt_gmap_api_key]" value="<?php echo esc_attr( $options['qt_gmap_api_key'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Map design', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'qt_access_saturation', $google_map_design_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Marker type', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'qt_gmap_marker_type', $google_map_marker_options); ?></li>
      </ul>

      <h4 class="theme_option_headline2 qt_gmap_marker_type1"><?php _e( 'Custom marker setting', 'tcd-ankle' ); ?></h4>
      <ul class="option_list qt_gmap_marker_type1">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[qt_gmap_marker_bg]" value="<?php echo esc_attr( $options['qt_gmap_marker_bg'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf qt_gmap_marker_type3"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[qt_gmap_marker_color]" value="<?php echo esc_attr( $options['qt_gmap_marker_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
        <li class="cf qt_gmap_marker_type3"><span class="label"><?php echo tcd_admin_label('label'); ?></span><input class="full_width" type="text" name="dp_options[qt_gmap_marker_text]" value="<?php echo esc_attr( $options['qt_gmap_marker_text'] ); ?>" /></li>
        <li class="cf qt_gmap_marker_type2"><span class="label"><?php _e('Images used for markers', 'tcd-ankle'); ?><span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '60', '20'); ?></span></span><?php echo tcd_media_image_uploader($options, 'qt_gmap_marker_img', 'medium'); ?></li>
      </ul>

      <div class="theme_option_message2">
        <p><?php _e( 'In order to display Google Maps, you need to enter your API key. For details on how to obtain an API key, please see below.', 'tcd-ankle' ); ?></br><a href="https://tcd-theme.com/2018/08/google-maps-platform-api.html" target="_blank" rel="noopener noreferrer"><?php _e('How to get a Google Maps Platform API key and notes', 'tcd-ankle'); ?></a></p>
      </div>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_quicktag_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_quicktag_theme_options_validate( $input ) {

  global $dp_default_options, $text_align_options, $font_weight_options, $border_style_options, $button_type_options, $button_border_radius_options, $button_size_options, $button_animation_options, $bool_options, $google_map_design_options, $google_map_marker_options;

  if ( ! isset( $input['use_quicktags'] ) )
    $input['use_quicktags'] = null;
    $input['use_quicktags'] = ( $input['use_quicktags'] == 1 ? 1 : 0 );

  // 新見出し
  for ( $i = 2; $i <= 5; $i++ ) {
    $input['qt_h'.$i.'_font_size'] = absint( $input['qt_h'.$i.'_font_size'] );
    $input['qt_h'.$i.'_font_size_sp'] = absint( $input['qt_h'.$i.'_font_size_sp'] );
    if ( ! isset( $input['qt_h'.$i.'_text_align'] ) || ! array_key_exists( $input['qt_h'.$i.'_text_align'], $text_align_options ) )
      $input['qt_h'.$i.'_text_align'] = $dp_default_options['qt_h'.$i.'_text_align'];
    if ( ! isset( $input['qt_h'.$i.'_font_weight'] ) || ! array_key_exists( $input['qt_h'.$i.'_font_weight'], $font_weight_options ) )
      $input['qt_h'.$i.'_font_weight'] = $dp_default_options['qt_h'.$i.'_font_weight'];
    $input['qt_h'.$i.'_font_color'] = sanitize_hex_color( $input['qt_h'.$i.'_font_color'] );
    $input['qt_h'.$i.'_bg_color'] = sanitize_hex_color( $input['qt_h'.$i.'_bg_color'] );

    $input['qt_h'.$i.'_ignore_bg'] = ! empty( $input['qt_h'.$i.'_ignore_bg'] ) ? 1 : 0;
    $input['qt_h'.$i.'_border_left'] = ! empty( $input['qt_h'.$i.'_border_left'] ) ? 1 : 0;
    $input['qt_h'.$i.'_border_top'] = ! empty( $input['qt_h'.$i.'_border_top'] ) ? 1 : 0;
    $input['qt_h'.$i.'_border_bottom'] = ! empty( $input['qt_h'.$i.'_border_bottom'] ) ? 1 : 0;
    $input['qt_h'.$i.'_border_right'] = ! empty( $input['qt_h'.$i.'_border_right'] ) ? 1 : 0;
    $input['qt_h'.$i.'_border_color'] = sanitize_hex_color( $input['qt_h'.$i.'_border_color'] );
    $input['qt_h'.$i.'_border_width'] = absint( $input['qt_h'.$i.'_border_width'] );
    if ( ! isset( $input['qt_h'.$i.'_border_style'] ) || ! array_key_exists( $input['qt_h'.$i.'_border_style'], $border_style_options ) )
      $input['qt_h'.$i.'_border_style'] = $dp_default_options['qt_h'.$i.'_border_style'];
  }

  // 新ボタン
  for ( $i = 1; $i <= 3; $i++ ) {
    if ( ! isset( $input['qt_button'.$i.'_type'] ) || ! array_key_exists( $input['qt_button'.$i.'_type'], $button_type_options ) )
      $input['qt_button'.$i.'_type'] = $dp_default_options['qt_button'.$i.'_type'];
    if ( ! isset( $input['qt_button'.$i.'_border_radius'] ) || ! array_key_exists( $input['qt_button'.$i.'_border_radius'], $button_border_radius_options ) )
      $input['qt_button'.$i.'_border_radius'] = $dp_default_options['qt_button'.$i.'_border_radius'];
    if ( ! isset( $input['qt_button'.$i.'_size'] ) || ! array_key_exists( $input['qt_button'.$i.'_size'], $button_size_options ) )
      $input['qt_button'.$i.'_size'] = $dp_default_options['qt_button'.$i.'_size'];
    if ( ! isset( $input['qt_button'.$i.'_animation_type'] ) || ! array_key_exists( $input['qt_button'.$i.'_animation_type'], $button_animation_options ) )
      $input['qt_button'.$i.'_animation_type'] = $dp_default_options['qt_button'.$i.'_animation_type'];
    $input['qt_button'.$i.'_color'] = sanitize_hex_color( $input['qt_button'.$i.'_color'] );
    $input['qt_button'.$i.'_color_hover'] = sanitize_hex_color( $input['qt_button'.$i.'_color_hover'] );
  }

  // 新アンダーライン
  for ( $i = 1; $i <= 3; $i++ ) {
    $input['qt_underline'.$i.'_border_color'] = sanitize_hex_color( $input['qt_underline'.$i.'_border_color'] );
    if ( ! isset( $input['qt_underline'.$i.'_font_weight'] ) || ! array_key_exists( $input['qt_underline'.$i.'_font_weight'], $font_weight_options ) )
      $input['qt_underline'.$i.'_font_weight'] = $dp_default_options['qt_underline'.$i.'_font_weight'];
    if ( ! isset( $input['qt_underline'.$i.'_use_animation'] ) || ! array_key_exists( $input['qt_underline'.$i.'_use_animation'], $bool_options ) )
      $input['qt_underline'.$i.'_use_animation'] = $dp_default_options['qt_underline'.$i.'_use_animation'];
  }

  // 新フキダシ
  for ( $i = 1; $i <= 4; $i++ ) {
    $input['qt_speech_balloon'.$i.'_user_image'] = wp_filter_nohtml_kses( $input['qt_speech_balloon'.$i.'_user_image'] );
    $input['qt_speech_balloon'.$i.'_user_name'] = wp_filter_nohtml_kses( $input['qt_speech_balloon'.$i.'_user_name'] );
    $input['qt_speech_balloon'.$i.'_font_color'] = wp_filter_nohtml_kses( $input['qt_speech_balloon'.$i.'_font_color'] );
    $input['qt_speech_balloon'.$i.'_bg_color'] = wp_filter_nohtml_kses( $input['qt_speech_balloon'.$i.'_bg_color'] );
    $input['qt_speech_balloon'.$i.'_border_color'] = wp_filter_nohtml_kses( $input['qt_speech_balloon'.$i.'_border_color'] );
  }

  // 新Googleマップ
	$input['qt_gmap_api_key'] = wp_filter_nohtml_kses( $input['qt_gmap_api_key'] );
	if ( ! isset( $input['qt_access_saturation'] ) || ! array_key_exists( $input['qt_access_saturation'], $google_map_design_options ) )
	$input['qt_access_saturation'] = $dp_default_options['qt_access_saturation'];
	if ( ! isset( $input['qt_gmap_marker_type'] ) || ! array_key_exists( $input['qt_gmap_marker_type'], $google_map_marker_options ) )
	$input['qt_gmap_marker_type'] = $dp_default_options['qt_gmap_marker_type'];
  $input['qt_gmap_marker_text'] = wp_filter_nohtml_kses( $input['qt_gmap_marker_text'] );
  $input['qt_gmap_marker_color'] = wp_filter_nohtml_kses( $input['qt_gmap_marker_color'] );
  $input['qt_gmap_marker_img'] = wp_filter_nohtml_kses( $input['qt_gmap_marker_img'] );


	return $input;

};


?>