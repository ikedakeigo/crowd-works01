<?php
/*
 * 基本設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_basic_dp_default_options' );


// Add label of basic tab
add_action( 'tcd_tab_labels', 'add_basic_tab_label' );


// Add HTML of basic tab
add_action( 'tcd_tab_panel', 'add_basic_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_basic_theme_options_validate' );


// タブの名前
function add_basic_tab_label( $tab_labels ) {
	$tab_labels['basic'] = __( 'Basic setting', 'tcd-ankle' );
	return $tab_labels;
}


// 初期値
function add_basic_dp_default_options( $dp_default_options ) {

	// 色の設定
	$dp_default_options['main_color'] = '#bf9d87';
	$dp_default_options['content_link_color'] = '#1578d6';
	$dp_default_options['content_link_hover_color'] = '#0965bc';

	// フォントの種類
  $dp_default_options['headline_font_type'] = 'type2';
	$dp_default_options['headline_font_size'] = '34';
	$dp_default_options['headline_font_size_sp'] = '22';
	$dp_default_options['content_font_type'] = 'type2';
	$dp_default_options['content_font_size'] = '16';
	$dp_default_options['content_font_size_sp'] = '14';

	// アニメーションの設定
	$dp_default_options['hover_type'] = 'type1';
	$dp_default_options['hover1_zoom'] = '1.2';
	$dp_default_options['hover2_zoom'] = '1.2';
	$dp_default_options['hover3_direct'] = 'type1';
	$dp_default_options['hover3_opacity'] = '0.5';
	$dp_default_options['hover3_bgcolor'] = '#000000';
	$dp_default_options['hover4_opacity'] = '0.5';
	$dp_default_options['hover4_bgcolor'] = '#000000';

  // ロード画面
  $dp_default_options['show_loading'] = 1;
  $dp_default_options['loading_type'] = 'type3';
  // アイコン
  $dp_default_options['loading_icon_color'] = '#bf9d87';
  // ロゴ
  $dp_default_options['loading_logo_image'] = false;
  $dp_default_options['loading_logo_retina'] = 'yes';
  $dp_default_options['loading_logo_image_sp'] = false;
  $dp_default_options['loading_logo_retina_sp'] = 'yes';
  // キャッチフレーズ
  $dp_default_options['loading_catch'] = __('Catchphrase', 'tcd-ankle');
  $dp_default_options['loading_catch_font_type'] = 'type3';
  $dp_default_options['loading_catch_font_size'] = '36';
  $dp_default_options['loading_catch_font_size_sp'] = '20';
  $dp_default_options['loading_catch_font_color'] = '#000000';
  // 共通
  $dp_default_options['loading_bg_color'] = '#fafafa';
  $dp_default_options['loading_display_page'] = 'type2';
  $dp_default_options['loading_display_time'] = 'type2';

	// NO IMAGE
	$dp_default_options['no_image1'] = false;

	// ソーシャルシェアボタン
	$dp_default_options['sns_share_design_type'] = 'type1';
	$dp_default_options['show_sns_share_twitter'] = 1;
	$dp_default_options['show_sns_share_fblike'] = 1;
	$dp_default_options['show_sns_share_fbshare'] = 1;
	$dp_default_options['show_sns_share_hatena'] = 1;
	$dp_default_options['show_sns_share_pocket'] = 1;
	$dp_default_options['show_sns_share_feedly'] = 1;
	$dp_default_options['show_sns_share_rss'] = 1;
	$dp_default_options['show_sns_share_pinterest'] = 1;
	$dp_default_options['twitter_info'] = '';

  // ソーシャルボタン
	$dp_default_options['sns_button_color_type'] = 'type1';

  // 404 ページ
  $dp_default_options['page_404_catch'] = '404 NOT FOUND';
	$dp_default_options['page_404_desc'] = __( 'The page you are looking for are not found', 'tcd-ankle' );
  $dp_default_options['page_404_font_color'] = '#000000';
  $dp_default_options['page_404_bg_image'] = false;
  $dp_default_options['page_404_bg_color'] = '#000000';
  $dp_default_options['page_404_bg_opacity'] = '0.1';

  // カスタムCSS
	$dp_default_options['css_code'] = '';

	// カスタムスクリプト
	$dp_default_options['script_code'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_basic_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $hover_type_options, $hover3_direct_options, $sns_type_options, $loading_type, $loading_display_page_options, $loading_display_time_options, $bool_options;

  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-ankle' );
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-ankle' );

?>

<div id="tab-content-basic" class="tab-content">

  <?php // 色の設定 ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Color', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
        <p><?php _e( 'Accent color will be used mostly in navigation menu.', 'tcd-ankle' ); ?></p>
      </div>

      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Accent color', 'tcd-ankle'); ?></span><input type="text" name="dp_options[main_color]" value="<?php echo esc_attr( $options['main_color'] ); ?>" data-default-color="#bf9d87" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Single page text link color', 'tcd-ankle'); ?></span><input type="text" name="dp_options[content_link_color]" value="<?php echo esc_attr( $options['content_link_color'] ); ?>" data-default-color="#1578d6" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Single page text link color on mouseover', 'tcd-ankle'); ?></span> <input type="text" name="dp_options[content_link_hover_color]" value="<?php echo esc_attr( $options['content_link_hover_color'] ); ?>" data-default-color="#0965bc" class="c-color-picker"></li>
      </ul>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // フォントの種類 ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Font', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">

      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('headline'); ?></h4>
      <div class="theme_option_message2">
        <p><?php _e('This settings will be applied to most of the headline and catchphrase.', 'tcd-ankle'); ?></p>
      </div>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($options, 'headline_font_type', $font_type_options); ?></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo tcd_font_size_option($options, 'headline_font_size'); ?></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Post contet', 'tcd-ankle'); ?></h4>
      <div class="theme_option_message2">
        <p><?php _e( 'This setting will be used in post contents and descriptions.', 'tcd-ankle' ); ?></p>
      </div>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($options, 'content_font_type', $font_type_options); ?></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo tcd_font_size_option($options, 'content_font_size'); ?></li>
      </ul>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


   <?php // ホバーアニメーション ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Thumbnail and hover animation', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">
      <h4 class="theme_option_headline2"><?php _e('Hover effect type', 'tcd-ankle'); ?></h4>

      <div class="theme_option_message2">
        <p><?php _e('You can select the thumbnail hover effect from 4 types.', 'tcd-ankle'); ?></p>
      </div>

      <?php foreach ( $hover_type_options as $option ) { ?>
      <span class="simple_radio_button spacer"></span>
      <input type="radio" id="hover_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[hover_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['hover_type'], $option['value'] ); ?> />
      <label for="hover_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo esc_html( $option['label'] ); ?></label></br>
      <?php } ?>

      <?php // ズームイン   ?>
      <div class="simple_radio_content" id="hover_type_type1_content">
        <h4 class="theme_option_headline2"><?php _e('Zoom in', 'tcd-ankle'); ?></h4>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Magnification rate', 'tcd-ankle'); ?></span><input class="hankaku" style="width:70px;" type="number" max="10" min="1" step="0.1" name="dp_options[hover1_zoom]" value="<?php esc_attr_e( $options['hover1_zoom'] ); ?>" /></li>
        </ul>
      </div>
      <?php // ズームアウト   ?>
      <div class="simple_radio_content" id="hover_type_type2_content">
        <h4 class="theme_option_headline2"><?php _e('Zoom out', 'tcd-ankle'); ?></h4>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Reduction rate', 'tcd-ankle'); ?></span><input class="hankaku" style="width:70px;" type="number" max="10" min="1" step="0.1" name="dp_options[hover2_zoom]" value="<?php esc_attr_e( $options['hover2_zoom'] ); ?>" /></li>
        </ul>
      </div>
      <?php // スライド   ?>
      <div class="simple_radio_content" id="hover_type_type3_content">
        <h4 class="theme_option_headline2"><?php _e('Slide', 'tcd-ankle'); ?></h4>
        <ul class="option_list">
          <li class="cf">
            <span class="label"><?php _e('Direction', 'tcd-ankle'); ?></span>
            <select name="dp_options[hover3_direct]">
            <?php foreach ( $hover3_direct_options as $option ) { ?>
            <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['hover3_direct'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
            <?php } ?>
            </select>
          </li>
          <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[hover3_bgcolor]" value="<?php echo esc_attr( $options['hover3_bgcolor'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
          <li class="cf">
            <span class="label"><?php _e('Opacity of background color', 'tcd-ankle'); ?></span>
            <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[hover3_opacity]" value="<?php esc_attr_e( $options['hover3_opacity'] ); ?>" />
            <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;"><p><?php echo tcd_admin_label('opacity_desc'); ?></p></div>
          </li>
        </ul>
      </div>
      <?php // フェード   ?>
      <div class="simple_radio_content" id="hover_type_type4_content">
        <h4 class="theme_option_headline2"><?php _e('Fade', 'tcd-ankle'); ?></h4>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[hover4_bgcolor]" value="<?php echo esc_attr( $options['hover4_bgcolor'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
          <li class="cf">
            <span class="label"><?php _e('Opacity of background color', 'tcd-ankle'); ?></span>
            <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[hover4_opacity]" value="<?php esc_attr_e( $options['hover4_opacity'] ); ?>" />
            <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;"><p><?php echo tcd_admin_label('opacity_desc'); ?></p></div>
          </li>
        </ul>
      </div>

      <?php // 代替画像 ------------------------------------------------------------------- ?>
      <h3 class="theme_option_headline2"><?php echo tcd_admin_label('no_image'); ?></h3>
      <div class="theme_option_message2">
        <p><?php echo tcd_admin_label('no_image_desc'); ?></p>
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '720', '495'); ?></p>
      </div>
      <?php echo tcd_media_image_uploader($options, 'no_image1', 'medium'); ?>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // SNSボタン  ------------------------------------------------------------------ ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Share button and SNS icon', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">

      <?php // ソーシャルシェアボタン ------------------------------------------------------------------- ?>
      <div class="sub_box cf"> 
        <h3 class="theme_option_subbox_headline"><?php _e('Share button', 'tcd-ankle');  ?></h3>
        <div class="sub_box_content">

          <div class="theme_option_message2" style="margin-top:20px;">
            <p><?php printf(__('Share button will be displayed in blog article and %s article.', 'tcd-ankle'), $news_label); ?></p>
            <p><?php _e('Display position can be set from each post type.', 'tcd-ankle');  ?></p>
          </div>

          <h4 class="theme_option_headline2"><?php _e('Share button design', 'tcd-ankle');  ?></h4>
          <ul class="design_radio_button image_radio_button cf">
            <?php foreach ( $sns_type_options as $option ) { ?>
            <li>
              <input type="radio" id="sns_share_design_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[sns_share_design_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['sns_share_design_type'], $option['value'] ); ?> />
              <label for="sns_share_design_type_<?php esc_attr_e( $option['value'] ); ?>">
                <span><?php echo esc_html($option['label']); ?></span>
                <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="" title="" />
              </label>
            </li>
            <?php } ?>
          </ul>

          <h4 class="theme_option_headline2"><?php echo tcd_admin_label('display_setting'); ?></h4>
          <ul>
            <li><label><input name="dp_options[show_sns_share_twitter]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_twitter'] ); ?> /> <?php _e('Display twitter button', 'tcd-ankle');  ?></label></li>
            <li><label><input name="dp_options[show_sns_share_fblike]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_fblike'] ); ?> /> <?php _e('Display facebook like button -Button type 5 (Default button) only', 'tcd-ankle');  ?></label></li>
            <li><label><input name="dp_options[show_sns_share_fbshare]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_fbshare'] ); ?> /> <?php _e('Display facebook share button', 'tcd-ankle');  ?></label></li>
            <li><label><input name="dp_options[show_sns_share_hatena]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_hatena'] ); ?> /> <?php _e('Display hatena button', 'tcd-ankle');  ?></label></li>
            <li><label><input name="dp_options[show_sns_share_pocket]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_pocket'] ); ?> /> <?php _e('Display pocket button', 'tcd-ankle');  ?></label></li>
            <li><label><input name="dp_options[show_sns_share_feedly]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_feedly'] ); ?> /> <?php _e('Display feedly button', 'tcd-ankle');  ?></label></li>
            <li><label><input name="dp_options[show_sns_share_rss]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_rss'] ); ?> /> <?php _e('Display rss button', 'tcd-ankle');  ?></label></li>
            <li><label><input name="dp_options[show_sns_share_pinterest]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_pinterest'] ); ?> /> <?php _e('Display pinterest button', 'tcd-ankle');  ?></label></li>
          </ul>

          <h4 class="theme_option_headline2"><?php _e('Setting for the twitter button', 'tcd-ankle');  ?></h4>
          <label style="margin-top:20px;"><?php _e('Set of twitter account. (ex.tcd_jp)', 'tcd-ankle');  ?></label>
          <input style="display:block; margin:.6em 0 1em;" id="dp_options[twitter_info]" class="regular-text" type="text" name="dp_options[twitter_info]" value="<?php esc_attr_e( $options['twitter_info'] ); ?>" />

        </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->

      <?php // ソーシャルボタン ------------------------------------------------------------------- ?>
      <div class="sub_box cf"> 
        <h3 class="theme_option_subbox_headline"><?php _e('SNS icons', 'tcd-ankle');  ?></h3>
        <div class="sub_box_content">

          <h4 class="theme_option_headline2"><?php _e('SNS icon design', 'tcd-ankle');  ?></h4>
          <div class="theme_option_message2" style="margin-bottom:20px;">
            <p>
              <?php _e('The URL will be reflected on the left side of the site footer and in the contributor information that can be displayed at the bottom of the blog post.', 'tcd-ankle');  ?></br>
              <?php printf(__('Please set the URL from "Footer > SNS icons" and <a href="%s">"Users"</a>', 'tcd-ankle'), './users.php'); ?>
            </p>
          </div>
          <ul class="design_radio_button image_radio_button cf">
            <li>
              <input type="radio" id="sns_button_color_type1" name="dp_options[sns_button_color_type]" value="type1" <?php checked( $options['sns_button_color_type'], 'type1' ); ?> />
              <label for="sns_button_color_type1">
                <span><?php _e('Monochrome (TCD ver)', 'tcd-ankle');  ?></span>
                <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type1.png" alt="" title="" />
              </label>
            </li>
            <li>
              <input type="radio" id="sns_button_color_type2" name="dp_options[sns_button_color_type]" value="type2" <?php checked( $options['sns_button_color_type'], 'type2' ); ?> />
              <label for="sns_button_color_type2">
                <span><?php _e('Official color', 'tcd-ankle');  ?></span>
                <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type2.png" alt="" title="" />
              </label>
            </li>
          </ul>

        </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // ロード画面の設定 ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Loading screen', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">

      <input id="show_loading" class="show_checkbox" name="dp_options[show_loading]" type="checkbox" value="1" <?php checked( $options['show_loading'], 1 ); ?>>
      <label for="show_loading"><?php _e( 'Display loading screen', 'tcd-ankle' ); ?></label>

      <div class="show_checkbox_area">

        <div class="theme_option_message2" style="margin-top:20px;">
          <p><?php _e('You can set the load screen displayed during page transition.', 'tcd-ankle');  ?></p>
        </div>
        
        <input class="tcd_admin_image_radio_button" id="loading_type1" type="radio" name="dp_options[loading_type]" value="type1" <?php checked( $options['loading_type'], 'type1' ); ?>>
        <label for="loading_type1">
          <div class="loading_icon_wrap">
          <div class="circular_loader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
          </div>
          </div>
          <span class="title_wrap"><span class="title"><?php echo $loading_type['type1']['label']; ?></span></span>
        </label>
        <input class="tcd_admin_image_radio_button" id="loading_type2" type="radio" name="dp_options[loading_type]" value="type2" <?php checked( $options['loading_type'], 'type2' ); ?>>
        <label for="loading_type2">
          <div class="loading_icon_wrap">
          <div class="sk-cube-grid">
            <div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>
          </div>
          <span class="title_wrap"><span class="title"><?php echo $loading_type['type2']['label']; ?></span></span>
        </label>
        <input class="tcd_admin_image_radio_button" id="loading_type3" type="radio" name="dp_options[loading_type]" value="type3" <?php checked( $options['loading_type'], 'type3' ); ?>>
        <label for="loading_type3">
          <div class="loading_icon_wrap">
          <div class="sk-circle">
            <div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div>
          </div>
          </div>
          <span class="title_wrap"><span class="title"><?php echo $loading_type['type3']['label']; ?></span></span>
        </label>
        <input class="tcd_admin_image_radio_button" id="loading_type4" type="radio" name="dp_options[loading_type]" value="type4" <?php checked( $options['loading_type'], 'type4' ); ?>>
        <label for="loading_type4">
          <span class="image_wrap"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/loading_logo.gif" alt=""></span>
          <span class="title_wrap"><span class="title"><?php echo $loading_type['type4']['label']; ?></span></span>
        </label>
        <input class="tcd_admin_image_radio_button" id="loading_type5" type="radio" name="dp_options[loading_type]" value="type5" <?php checked( $options['loading_type'], 'type5' ); ?>>
        <label for="loading_type5">
          <span class="image_wrap"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/loading_catch.gif" alt=""></span>
          <span class="title_wrap"><span class="title"><?php echo $loading_type['type5']['label']; ?></span></span>
        </label>

        <?php // type1 - type3 ----------------------------------------- ?>
        <div id="loading_type1-3_area">
          <h4 class="theme_option_headline2"><?php _e('Icon design', 'tcd-ankle');  ?></h4>
          <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Icon color', 'tcd-ankle');  ?></span><input type="text" name="dp_options[loading_icon_color]" value="<?php echo esc_attr( $options['loading_icon_color'] ); ?>" data-default-color="#bf9d87" class="c-color-picker"></li>
          </ul>
        </div>

        <?php // type4 ----------------------------------------- ?>
        <div id="loading_type4_area">
          <h4 class="theme_option_headline2"><?php _e('Logo', 'tcd-ankle');  ?></h4>
          <div class="theme_option_message2">
            <p><?php _e('If you have uploaded a logo image for the Retina display, please select "Yes" for the radio button below.','tcd-ankle'); ?></p>
          </div>
          <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Image', 'tcd-ankle'); ?></span><?php echo tcd_media_image_uploader($options, 'loading_logo_image', 'full'); ?></li>
            <li class="cf"><span class="label"><?php _e('Use retina display logo image', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'loading_logo_retina', $bool_options); ?></li>
            <li class="cf"><span class="label"><?php _e('Image (mobile)', 'tcd-ankle'); ?></span><?php echo tcd_media_image_uploader($options, 'loading_logo_image_sp', 'full'); ?></li>
            <li class="cf"><span class="label"><?php _e('Use retina display logo image', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'loading_logo_retina_sp', $bool_options); ?></li>
          </ul>
        </div>

        <?php // type5 ----------------------------------------- ?>
        <div id="loading_type5_area">
          <h4 class="theme_option_headline2"><?php echo tcd_admin_label('catch'); ?></h4>
          <ul class="option_list">
            <li class="cf"><span class="label"><?php echo tcd_admin_label('catch'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[loading_catch]"><?php echo esc_textarea( $options['loading_catch'] ); ?></textarea></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($options, 'loading_catch_font_type', $font_type_options); ?></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo tcd_font_size_option($options, 'loading_catch_font_size'); ?></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[loading_catch_font_color]" value="<?php echo esc_attr( $options['loading_catch_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
          </ul>
        </div>

        <?php // 共通 ----------------------------------------- ?>
        <h4 class="theme_option_headline2"><?php echo tcd_admin_label('common'); ?></h4>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[loading_bg_color]" value="<?php echo esc_attr( $options['loading_bg_color'] ); ?>" data-default-color="#fafafa" class="c-color-picker"></li>
          <li class="cf"><span class="label"><?php _e('Display pages', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'loading_display_page', $loading_display_page_options); ?></li>
          <li class="cf"><span class="label"><?php _e('Display times', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'loading_display_time', $loading_display_time_options); ?></li>
        </ul>

      </div>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->



  <?php // 404 ページ ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( '404 page', 'tcd-ankle' ); ?></h3>
    <div class="theme_option_field_ac_content">
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('catch'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[page_404_catch]"><?php echo esc_textarea( $options['page_404_catch'] ); ?></textarea></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[page_404_desc]"><?php echo esc_textarea( $options['page_404_desc'] ); ?></textarea></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[page_404_font_color]" value="<?php echo esc_attr( $options['page_404_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_image'); ?></span><?php echo tcd_media_image_uploader($options, 'page_404_bg_image', 'medium'); ?></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('overlay_color'); ?></span><input type="text" name="dp_options[page_404_bg_color]" value="<?php echo esc_attr( $options['page_404_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('overlay_opacity'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[page_404_bg_opacity]" value="<?php echo esc_attr( $options['page_404_bg_opacity'] ); ?>" /></li>
      </ul>
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php echo tcd_admin_label('opacity_desc'); ?></p>
      </div>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

  <?php // ユーザーCSS用の自由記入欄 ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Custom CSS', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">
      <div class="theme_option_message2">
        <p><?php _e( 'This css will be displayed inside &lt;head&gt; tag.<br />You don\'t need to enter &lt;style&gt; tag in this field.', 'tcd-ankle' ); ?></p>
        <p><?php _e('Example:<br><strong>.custom_css { font-size:12px; }</strong>', 'tcd-ankle');  ?></p>
      </div>
      <textarea id="dp_options[css_code]" class="large-text" cols="50" rows="10" name="dp_options[css_code]"><?php echo esc_textarea( $options['css_code'] ); ?></textarea>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // カスタムスクリプト用の自由記入欄 ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Custom script', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">
      <div class="theme_option_message2">
        <p><?php _e( 'This script will be displayed inside &lt;head&gt; tag.', 'tcd-ankle' ); ?></p>
      </div>
      <textarea id="dp_options[script_code]" class="large-text" cols="50" rows="10" name="dp_options[script_code]"><?php echo esc_textarea( $options['script_code'] ); ?></textarea>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_basic_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_basic_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $hover_type_options, $hover3_direct_options, $sns_type_options, $loading_type, $loading_display_page_options, $loading_display_time_options, $bool_options;

  // 色の設定
  $input['main_color'] = sanitize_hex_color( $input['main_color'] );
  $input['content_link_color'] = sanitize_hex_color( $input['content_link_color'] );
  $input['content_link_hover_color'] = sanitize_hex_color( $input['content_link_hover_color'] );

  // フォントの種類
  if ( ! isset( $input['content_font_type'] ) )
    $input['content_font_type'] = null;
  if ( ! array_key_exists( $input['content_font_type'], $font_type_options ) )
    $input['content_font_type'] = null;
  $input['content_font_size'] = absint( $input['content_font_size'] );
  $input['content_font_size_sp'] = absint( $input['content_font_size_sp'] );

  if ( ! isset( $input['headline_font_type'] ) )
    $input['headline_font_type'] = null;
  if ( ! array_key_exists( $input['headline_font_type'], $font_type_options ) )
    $input['headline_font_type'] = null;
  $input['headline_font_size'] = absint( $input['headline_font_size'] );
  $input['headline_font_size_sp'] = absint( $input['headline_font_size_sp'] );

  // ホバーアニメーションの設定
  if ( ! isset( $input['hover_type'] ) )
    $input['hover_type'] = null;
  if ( ! array_key_exists( $input['hover_type'], $hover_type_options ) )
    $input['hover_type'] = null;
  $input['hover1_zoom'] = wp_filter_nohtml_kses( $input['hover1_zoom'] );
  $input['hover2_zoom'] = wp_filter_nohtml_kses( $input['hover2_zoom'] );
  if ( ! isset( $input['hover3_direct'] ) )
    $input['hover3_direct'] = null;
  if ( ! array_key_exists( $input['hover3_direct'], $hover3_direct_options ) )
    $input['hover3_direct'] = null;
  $input['hover3_opacity'] = wp_filter_nohtml_kses( $input['hover3_opacity'] );
  $input['hover3_bgcolor'] = sanitize_hex_color( $input['hover3_bgcolor'] );
  $input['hover4_opacity'] = wp_filter_nohtml_kses( $input['hover4_opacity'] );
  $input['hover4_bgcolor'] = sanitize_hex_color( $input['hover4_bgcolor'] );
  // NO IMAGE
  $input['no_image1'] = absint( $input['no_image1'] );

  // ソーシャルシェアボタン
  $input['sns_share_design_type'] = wp_filter_nohtml_kses( $input['sns_share_design_type'] );
  $input['show_sns_share_twitter'] = ! empty( $input['show_sns_share_twitter'] ) ? 1 : 0;
  $input['show_sns_share_fblike'] = ! empty( $input['show_sns_share_fblike'] ) ? 1 : 0;
  $input['show_sns_share_fbshare'] = ! empty( $input['show_sns_share_fbshare'] ) ? 1 : 0;
  $input['show_sns_share_hatena'] = ! empty( $input['show_sns_share_hatena'] ) ? 1 : 0;
  $input['show_sns_share_pocket'] = ! empty( $input['show_sns_share_pocket'] ) ? 1 : 0;
  $input['show_sns_share_feedly'] = ! empty( $input['show_sns_share_feedly'] ) ? 1 : 0;
  $input['show_sns_share_rss'] = ! empty( $input['show_sns_share_rss'] ) ? 1 : 0;
  $input['show_sns_share_pinterest'] = ! empty( $input['show_sns_share_pinterest'] ) ? 1 : 0;
  $input['twitter_info'] = wp_filter_nohtml_kses( $input['twitter_info'] );
  // ソーシャルボタン
  $input['sns_button_color_type'] = wp_filter_nohtml_kses( $input['sns_button_color_type'] );
  // ソーシャルボタンの表示設定
  $input['show_footer_sns'] = ! empty( $input['show_footer_sns'] ) ? 1 : 0;

  // ロード画面
  $input['show_loading'] = ! empty( $input['show_loading'] ) ? 1 : 0;
  if ( ! isset( $input['loading_type'] ) )
    $input['loading_type'] = null;
  if ( ! array_key_exists( $input['loading_type'], $loading_type ) )
    $input['loading_type'] = null;
  // シンプル
  $input['loading_icon_color'] = sanitize_hex_color( $input['loading_icon_color'] );
  // ロゴ
  $input['loading_logo_image'] = absint( $input['loading_logo_image'] );
  $input['show_loading'] = ! empty( $input['show_loading'] ) ? 1 : 0;
  if ( ! isset( $input['loading_logo_retina'] ) )
    $input['loading_logo_retina'] = null;
  if ( ! array_key_exists( $input['loading_logo_retina'], $bool_options ) )
    $input['loading_logo_retina'] = null;
  $input['loading_logo_image_sp'] = absint( $input['loading_logo_image_sp'] );
  $input['show_loading'] = ! empty( $input['show_loading'] ) ? 1 : 0;
  if ( ! isset( $input['loading_logo_retina_sp'] ) )
    $input['loading_logo_retina_sp'] = null;
  if ( ! array_key_exists( $input['loading_logo_retina_sp'], $bool_options ) )
    $input['loading_logo_retina_sp'] = null;
  // キャッチフレーズ
  $input['loading_catch'] = wp_filter_nohtml_kses( $input['loading_catch'] );
  if ( ! isset( $input['loading_catch_font_type'] ) )
    $input['loading_catch_font_type'] = null;
  if ( ! array_key_exists( $input['loading_catch_font_type'], $font_type_options ) )
    $input['loading_catch_font_type'] = null;
  $input['loading_catch_font_size'] = absint( $input['loading_catch_font_size'] );
  $input['loading_catch_font_size_sp'] = absint( $input['loading_catch_font_size_sp'] );
  $input['loading_catch_font_color'] = sanitize_hex_color( $input['loading_catch_font_color'] );
  // 共通
  $input['loading_bg_color'] = sanitize_hex_color( $input['loading_bg_color'] );
  if ( ! isset( $input['loading_display_page'] ) )
    $input['loading_display_page'] = null;
  if ( ! array_key_exists( $input['loading_display_page'], $font_type_options ) )
    $input['loading_display_page'] = null;
  if ( ! isset( $input['loading_display_time'] ) )
    $input['loading_display_time'] = null;
  if ( ! array_key_exists( $input['loading_display_time'], $loading_display_time_options ) )
    $input['loading_display_time'] = null;

  // 404 ページ
  $input['page_404_catch'] = wp_filter_nohtml_kses( $input['page_404_catch'] );
  $input['page_404_desc'] = remove_non_inline_elements( $input['page_404_desc'] );
  $input['page_404_font_color'] = sanitize_hex_color( $input['page_404_font_color'] );
  $input['page_404_bg_image'] = absint( $input['page_404_bg_image'] );
  $input['page_404_bg_color'] = sanitize_hex_color( $input['page_404_bg_color'] );
  $input['page_404_bg_opacity'] = wp_filter_nohtml_kses( $input['page_404_bg_opacity'] );

  // オリジナルスタイルの設定
  $input['css_code'] = $input['css_code'];

  // オリジナルスクリプトの設定
  $input['script_code'] = $input['script_code'];

  return $input;

};


?>