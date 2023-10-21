<?php
/*
 * トップページの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_front_page_dp_default_options' );


// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_front_page_tab_label' );


// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_front_page_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_front_page_theme_options_validate' );


// タブの名前
function add_front_page_tab_label( $tab_labels ) {
	$tab_labels['front_page'] = __( 'Front page', 'tcd-ankle' );
	return $tab_labels;
}


// 初期値
function add_front_page_dp_default_options( $dp_default_options ) {

	// ヘッダースライダー
	$dp_default_options['show_index_slider'] = 1;

  $dp_default_options['index_slider_content_width'] = 'type1';
  $dp_default_options['index_slider_bg_animation'] = 'type3';
  $dp_default_options['index_slider_content_animation'] = 'type1';
  $dp_default_options['index_slider_time'] = '4000';

	$dp_default_options['index_slider'] = array(
		array(
			"slider_type" => 'type1',
			"image" => '',
			"image_sp" => '',
			"video" => '',
			"youtube" => '',
      "overlay_color" => '#000000',
			"overlay_opacity" => '0.2',

			"catch" => '',
      "catch_sp" => '',
			"catch_font_type" => 'type3',
			"catch_font_size" => '36',
			"catch_font_size_sp" => '24',
			"catch_font_color" => 'ffffff',
			"desc" => __( 'Description will be displayed here.<br>Description will be displayed here.', 'tcd-ankle' ),
			"desc_sp" => '',
			"desc_font_size" => '18',
			"desc_font_size_sp" => '14',
			"desc_font_color" => '#ffffff',

      "link_type" => 'type1',
			"button_label" => __( 'Button', 'tcd-ankle' ),
			"button_url" => '#',
      "button_type" => 'type2',
      "button_border_radius" => 'oval',
      "button_size" => "medium",
      "button_animation_type" => "animation_type1",
      "button_color" => "#ffffff",
      "button_color_hover" => "#bf9d87"		
    )
	);

	// ニュースティッカーの設定
	$dp_default_options['show_news_ticker'] = 1;
	$dp_default_options['news_ticker_post_type'] = 'news';
	$dp_default_options['news_ticker_post_order'] = 'date';

  // メインコンテンツ
	$dp_default_options['main_content_type'] = 'type1';
  $dp_default_options['main_content_width'] = 'type1';

  // フリースペース 1
	$dp_default_options['show_free_space1'] = '';
  $dp_default_options['free_space1_width'] = 'type1';
  $dp_default_options['free_space1_padding'] = 'type1';
  $dp_default_options['free_space1_bg_color'] = '#ffffff';
  $dp_default_options['free_space1_editor'] = '';

  // フリースペース 2
	$dp_default_options['show_free_space2'] = '';
  $dp_default_options['free_space2_width'] = 'type1';
  $dp_default_options['free_space2_padding'] = 'type1';
  $dp_default_options['free_space2_bg_color'] = '#ffffff';
  $dp_default_options['free_space2_editor'] = '';

  // フリースペース 3
	$dp_default_options['show_free_space3'] = '';
  $dp_default_options['free_space3_width'] = 'type1';
  $dp_default_options['free_space3_padding'] = 'type1';
  $dp_default_options['free_space3_bg_color'] = '#ffffff';
  $dp_default_options['free_space3_editor'] = '';

  // 商品一覧
  $dp_default_options['show_product_list'] = '';
  $dp_default_options['product_list_headline'] =  __( 'ALL ITEM', 'tcd-ankle' );
	$dp_default_options['product_list_sub_headline'] = __( 'Product list', 'tcd-ankle' );
	$dp_default_options['product_list_desc'] = '';
  // 一覧設定
  $dp_default_options['product_list_type'] = 'products';
  $dp_default_options['product_list_order'] = 'menu_order';
  $dp_default_options['product_list_num'] = 9;
	$dp_default_options['product_list_num_sp'] = 10;
  $dp_default_options['product_list_bg_color'] ='#ffffff';
  // ボタン
  $dp_default_options['product_list_button_display'] = 'display';
  $dp_default_options['product_list_button_label'] = tcd_admin_label('button');
  $dp_default_options['product_list_button_type'] = 'button1';
  
  // ブログカルーセル
  $dp_default_options['show_blog_carousel'] = 1;
  $dp_default_options['blog_carousel_headline'] = 'BLOG';
	$dp_default_options['blog_carousel_sub_headline'] = __( 'Blog', 'tcd-ankle' );
	$dp_default_options['blog_carousel_desc'] = '';

  $dp_default_options['blog_carousel_post_type'] = 'recent_post';
  $dp_default_options['blog_carousel_num'] = 6;
	$dp_default_options['blog_carousel_num_sp'] = 6;
  $dp_default_options['blog_carousel_title_font_size'] = 16;
	$dp_default_options['blog_carousel_title_font_size_sp'] = 16;
  $dp_default_options['blog_carousel_bg_color'] ='#f6f6f6';

  // ボタン
  $dp_default_options['blog_carousel_button_display'] = 'display';
  $dp_default_options['blog_carousel_button_label'] = tcd_admin_label('button');
  $dp_default_options['blog_carousel_button_type'] = 'button1';

	return $dp_default_options;

}

// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_tab_panel( $options ) {

  global $dp_default_options, $item_type_options, $time_options, $font_type_options, $basic_display_options, $button_border_radius_options, $button_size_options, $button_type_options, $button_animation_options, $slider_bg_animation_options, $slider_content_animation_options, $content_width_options, $news_ticker_order_options, $content_padding_options, $front_page_button_type;

  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : tcd_admin_label('news');

?>

<div id="tab-content-front-page" class="tab-content">

  <?php // ヘッダーコンテンツの設定 ---------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header slider', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">

      <input id="show_index_slider" class="show_checkbox" name="dp_options[show_index_slider]" type="checkbox" value="1" <?php checked( $options['show_index_slider'], 1 ); ?>>
      <label for="show_index_slider"><?php _e( 'Display header slider', 'tcd-ankle' ); ?></label>

      <div class="show_checkbox_area">

        <div class="theme_option_message">
          <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-ankle');  ?></p>
        </div>

        <?php //繰り返しフィールド ----- ?>
        <div class="repeater-wrapper">
          <input type="hidden" name="dp_options[index_slider]" value="">
          <div class="repeater sortable" data-delete-confirm="<?php echo tcd_admin_label('delete'); ?>">
          <?php
              if ( $options['index_slider'] ) :
                foreach ( $options['index_slider'] as $key => $value ) :
          ?>
            <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
              <h4 class="theme_option_subbox_headline"><?php echo tcd_admin_label('Item').esc_attr( $key+1 ); ?></h4>
              <div class="sub_box_content">

                <?php // タブラベル ----------------------- ?>
                <ul class="tcd_standard_tab_area">
                  <li class="tcd_standard_tab_label is_active"><?php _e('Background settings', 'tcd-ankle'); ?></li>
                  <li class="tcd_standard_tab_label"><?php _e('Text settings', 'tcd-ankle'); ?></li>
                  <li class="tcd_standard_tab_label"><?php _e('Link settings', 'tcd-ankle'); ?></li>
                </ul>

                <div class="tcd_standard_tab_contents">

                  <?php // 背景 ----------------------- ?>
                  <div class="tcd_standard_tab_content is_active">

                    <?php // アイテムのタイプ ----------------------- ?>
                    <h4 class="theme_option_headline2"><?php _e('Background type', 'tcd-ankle');  ?></h4>
                    <?php foreach ( $item_type_options as $option ) { ?>
                    <input type="radio" id="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>" class="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][slider_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['slider_type'], $option['value'] ); ?> style="vertical-align:bottom;" />
                    <label for="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>" style="margin-right:15px;position:relative;top:1px;"><?php echo $option['label']; ?></label>
                    <?php } ?>

                    <?php // 動画アイテム ----------------------- ?>
                    <div class="index_slider_video_area">
                      <h4 class="theme_option_headline2"><?php _e('Video', 'tcd-ankle');  ?></h4>
                      <div class="theme_option_message2">
                        <p><?php _e('Please upload MP4 format file.', 'tcd-ankle');  ?></p>
                        <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-ankle'); ?></p>
                      </div>
                      
                      <div class="cf cf_media_field hide-if-no-js index_slider<?php echo esc_attr( $key ); ?>_video">
                        <input type="hidden" value="<?php if($value['video']) { echo esc_attr( $value['video'] ); }; ?>" id="index_slider<?php echo esc_attr( $key ); ?>_video" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][video]" class="cf_media_id">
                        <div class="preview_field preview_field_video">
                          <?php if($value['video']){ ?>
                          <h4><?php _e( 'Uploaded MP4 file', 'tcd-ankle' ); ?></h4>
                          <p><?php echo esc_url(wp_get_attachment_url($value['video'])); ?></p>
                          <?php }; ?>
                        </div>
                        <div class="buttton_area">
                          <input type="button" value="<?php _e('Select MP4 file', 'tcd-ankle'); ?>" class="cfmf-select-video button">
                          <input type="button" value="<?php _e('Remove MP4 file', 'tcd-ankle'); ?>" class="cfmf-delete-video button <?php if(!$value['video']){ echo 'hidden'; }; ?>">
                        </div>
                      </div>
                    </div><!-- END .index_slider_video_area -->

                    <?php // Youtubeアイテム ----------------------- ?>
                    <div class="index_slider_youtube_area">
                      <h4 class="theme_option_headline2"><?php _e('YouTube', 'tcd-ankle'); ?></h4>
                      <div class="theme_option_message2">
                        <p><?php _e('Please enter YouTube URL.', 'tcd-ankle');  ?></p>
                        <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-ankle'); ?></p>
                      </div>
                      <input class="regular-text" type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][youtube]" value="<?php echo esc_attr( $value['youtube'] ); ?>">
                    </div><!-- END .index_slider_youtube_area -->

                    <?php // 背景画像 ----------------------- ?>
                    <h4 class="theme_option_headline2"><?php echo tcd_admin_label('bg_image'); ?></h4>
                    <div class="theme_option_message2 index_slider_bg_image_desc">
                      <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-ankle');  ?></p>
                    </div>
                    <ul class="option_list">
                      <li class="cf">
                        <span class="label"><?php echo tcd_admin_label('bg_image'); ?>
                          <span class="recommend_desc width_type1" style="<?php if($options['index_slider_content_width'] == 'type2') echo 'display:none;'; ?>"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '1000', '600'); ?></span>
                          <span class="recommend_desc width_type2" style="<?php if($options['index_slider_content_width'] == 'type1') echo 'display:none;'; ?>"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '1450', '600'); ?></span>
                        </span>
                        <?php echo tcd_media_image_uploader($value, array('index_slider', $key, 'image'), 'full', true) ?>
                      </li>
                      <li class="cf">
                        <span class="label"><?php echo tcd_admin_label('bg_image_sp'); ?><span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '750', '750'); ?></span></span>
                        <?php echo tcd_media_image_uploader($value, array('index_slider', $key, 'image_sp'), 'full', true) ?>
                      </li>
                    </ul>

                    <?php // オーバーレイ ----------------------- ?>
                    <h4 class="theme_option_headline2"><?php echo tcd_admin_label('overlay'); ?></h4>
                    <ul class="option_list">
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('overlay_color'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][overlay_color]" value="<?php echo esc_attr( $value['overlay_color'] ); ?>" data-default-color="#000000"></li>
                      <li class="cf">
                        <span class="label"><?php echo tcd_admin_label('overlay_opacity'); ?></span><input class="hankaku index_slider_overlay_opacity<?php echo esc_attr( $key ); ?>" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $value['overlay_opacity'] ); ?>" />
                        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;"><p><?php echo tcd_admin_label('opacity_desc'); ?></p></div>
                      </li>
                    </ul>
                  
                  </div><!-- END .tcd_standard_tab_content -->

                  <?php // テキスト ----------------------- ?>
                  <div class="tcd_standard_tab_content">

                    <h4 class="theme_option_headline2"><?php echo tcd_admin_label('catch'); ?></h4>
                    <ul class="option_list">
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('catch'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('catch_sp'); ?></span><textarea placeholder="<?php echo tcd_admin_label('device_diff_text'); ?>" class="full_width" cols="50" rows="2" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][catch_sp]"><?php echo esc_textarea(  $value['catch_sp'] ); ?></textarea></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($value, array('index_slider', $key, 'catch_font_type'), $font_type_options, true); ?></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo tcd_font_size_option($value, array('index_slider', $key, 'catch_font_size'), true ); ?></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
                    </ul>
                    <h4 class="theme_option_headline2"><?php echo tcd_admin_label('desc'); ?></h4>
                    <ul class="option_list">
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('desc_sp'); ?></span><textarea placeholder="<?php echo tcd_admin_label('device_diff_text'); ?>" class="full_width" cols="50" rows="3" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][desc_sp]"><?php echo esc_textarea(  $value['desc_sp'] ); ?></textarea></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo tcd_font_size_option($value, array('index_slider', $key, 'desc_font_size'), true ); ?></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][desc_font_color]" value="<?php echo esc_attr( $value['desc_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
                    </ul>
                  
                  </div><!-- END .tcd_standard_tab_content -->

                  <?php // ボタン ----------------------- ?>
                  <div class="tcd_standard_tab_content">

                    <?php // リンクのタイプ ----------------------- ?>
                    <h4 class="theme_option_headline2"><?php _e('Link type', 'tcd-ankle');  ?></h4>
                    <input type="radio" id="index_slider_link_type1_<?php echo esc_attr( $key ); ?>" class="index_slider_link_type1" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][link_type]" value="type1" <?php checked( $value['link_type'], 'type1' ); ?> style="vertical-align:bottom;" />
                    <label for="index_slider_link_type1_<?php echo esc_attr( $key ); ?>" style="margin-right:15px;position:relative;top:1px;"><?php _e('Background link', 'tcd-ankle'); ?></label>
                    <input type="radio" id="index_slider_link_type2_<?php echo esc_attr( $key ); ?>" class="index_slider_link_type2" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][link_type]" value="type2" <?php checked( $value['link_type'], 'type2' ); ?> style="vertical-align:bottom;" />
                    <label for="index_slider_link_type2_<?php echo esc_attr( $key ); ?>" style="margin-right:15px;position:relative;top:1px;"><?php _e('Button', 'tcd-ankle'); ?></label>

                    <h4 class="theme_option_headline2"><?php _e('Link', 'tcd-ankle'); ?></h4>
                    <ul class="option_list">
                      <li class="cf hide_index_slider_link_type1"><span class="label"><?php echo tcd_admin_label('button_label'); ?></span><input class="full_width" type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][button_label]" value="<?php echo esc_attr( $value['button_label'] ); ?>" /></li>
                      <li class="cf"><span class="label"><?php _e('URL', 'tcd-ankle'); ?></span><input class="full_width" type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][button_url]" value="<?php echo esc_attr( $value['button_url'] ); ?>"></li>
                    </ul>
                    <h4 class="theme_option_headline2 hide_index_slider_link_type1"><?php _e('Button design', 'tcd-ankle'); ?></h4>
                    <ul class="option_list">
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('button_type'); ?></span><?php echo tcd_basic_radio_button($value, array('index_slider', $key, 'button_type'), $button_type_options, true); ?></li>
                      <li class="cf"><span class="label"><?php _e('Shape', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($value, array('index_slider', $key, 'button_border_radius'), $button_border_radius_options, true); ?></li>
                      <li class="cf"><span class="label"><?php _e('Size', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($value, array('index_slider', $key, 'button_size'), $button_size_options, true); ?></li>
                      <li class="cf"><span class="label"><?php _e('Mouseover animation', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($value, array('index_slider', $key, 'button_animation_type'), $button_animation_options, true); ?></li>
                      <li class="cf"><span class="label"><?php _e('Color scheme', 'tcd-ankle'); ?></span><input type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][button_color]" value="<?php echo esc_attr( $value['button_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
                      <li class="cf"><span class="label"><?php _e('Color scheme on mouseover', 'tcd-ankle'); ?></span><input type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][button_color_hover]" value="<?php echo esc_attr( $value['button_color_hover'] ); ?>" data-default-color="#bf9d87" class="c-color-picker"></li>
                    </ul>
                    <div class="theme_option_message2">
                      <p><?php _e('In the case of a background link, the entire slide will be the link.', 'tcd-ankle');  ?></p>
                    </div>
                    
                  </div><!-- END .tcd_standard_tab_content -->

                </div><!-- END .tcd_standard_tab_contents -->

                <ul class="button_list cf">
                  <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
                </ul>
              
                <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php echo tcd_admin_label('delete_item'); ?></a></p>

              </div><!-- END .sub_box_content -->
            </div><!-- END .sub_box -->
            <?php
                  endforeach;
                endif;
                $key = 'addindex';
                $value = array(
                'slider_type' => 'type1',
                'image' => false,
                'image_sp' => false,
                'video' => false,
                'youtube' => '',
                'overlay_color' => '#000000',
                'overlay_opacity' => '0.2',

                'catch' => '',
                'catch_sp' => '',
                'catch_font_type' => 'type3',
                'catch_font_size' => '36',
                'catch_font_size_sp' => '24',
                'catch_font_color' => '#ffffff',
                'desc' => '',
                'desc_sp' => '',
                'desc_font_size' => '18',
                'desc_font_size_sp' => '14',
                'desc_font_color' => '#ffffff',

                'link_type' => 'type1',
                'button_label' => '',
                'button_url' => '',

                'button_type' => 'type2',
                'button_border_radius' => 'oval',
                'button_size' => 'medium',
                'button_animation_type' => 'animation_type1',
                'button_color' => '#ffffff',
                'button_color_hover' => '#bf9d87'
                );
                ob_start();
            ?>
            <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
              <h4 class="theme_option_subbox_headline"><?php echo tcd_admin_label('new_item'); ?></h4>
              <div class="sub_box_content">

                <?php // タブラベル ----------------------- ?>
                <ul class="tcd_standard_tab_area">
                  <li class="tcd_standard_tab_label is_active"><?php _e('Background settings', 'tcd-ankle'); ?></li>
                  <li class="tcd_standard_tab_label"><?php _e('Text settings', 'tcd-ankle'); ?></li>
                  <li class="tcd_standard_tab_label"><?php _e('Link settings', 'tcd-ankle'); ?></li>
                </ul>

                <div class="tcd_standard_tab_contents">
                  
                  <?php // 背景 ----------------------- ?>
                  <div class="tcd_standard_tab_content is_active">

                    <?php // アイテムのタイプ ----------------------- ?>
                    <h4 class="theme_option_headline2"><?php _e('Background type', 'tcd-ankle');  ?></h4>
                    <?php foreach ( $item_type_options as $option ) { ?>
                    <input type="radio" id="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>" class="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][slider_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $value['slider_type'], $option['value'] ); ?> style="vertical-align:bottom;" />
                    <label for="index_slider_item_<?php esc_attr_e( $option['value'] ); ?>_<?php echo esc_attr( $key ); ?>" style="margin-right:15px;position:relative;top:1px;"><?php echo $option['label']; ?></label>
                    <?php } ?>

                    <?php // 動画アイテム ----------------------- ?>
                    <div class="index_slider_video_area">
                      <h4 class="theme_option_headline2"><?php _e('Video', 'tcd-ankle');  ?></h4>
                      <div class="theme_option_message2">
                        <p><?php _e('Please upload MP4 format file.', 'tcd-ankle');  ?></p>
                        <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-ankle'); ?></p>
                      </div>
                      
                      <div class="cf cf_media_field hide-if-no-js index_slider<?php echo esc_attr( $key ); ?>_video">
                        <input type="hidden" value="<?php if($value['video']) { echo esc_attr( $value['video'] ); }; ?>" id="index_slider<?php echo esc_attr( $key ); ?>_video" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][video]" class="cf_media_id">
                        <div class="preview_field preview_field_video">
                          <?php if($value['video']){ ?>
                          <h4><?php _e( 'Uploaded MP4 file', 'tcd-ankle' ); ?></h4>
                          <p><?php echo esc_url(wp_get_attachment_url($value['video'])); ?></p>
                          <?php }; ?>
                        </div>
                        <div class="buttton_area">
                          <input type="button" value="<?php _e('Select MP4 file', 'tcd-ankle'); ?>" class="cfmf-select-video button">
                          <input type="button" value="<?php _e('Remove MP4 file', 'tcd-ankle'); ?>" class="cfmf-delete-video button <?php if(!$value['video']){ echo 'hidden'; }; ?>">
                        </div>
                      </div>
                    </div><!-- END .index_slider_video_area -->

                    <?php // Youtubeアイテム ----------------------- ?>
                    <div class="index_slider_youtube_area">
                      <h4 class="theme_option_headline2"><?php _e('YouTube', 'tcd-ankle'); ?></h4>
                      <div class="theme_option_message2">
                        <p><?php _e('Please enter YouTube URL.', 'tcd-ankle');  ?></p>
                        <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-ankle'); ?></p>
                      </div>
                      <input class="regular-text" type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][youtube]" value="<?php echo esc_attr( $value['youtube'] ); ?>">
                    </div><!-- END .index_slider_youtube_area -->

                    <?php // 背景画像 ----------------------- ?>
                    <h4 class="theme_option_headline2"><?php echo tcd_admin_label('bg_image'); ?></h4>
                    <div class="theme_option_message2 index_slider_bg_image_desc">
                      <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-ankle');  ?></p>
                    </div>
                    <ul class="option_list">
                      <li class="cf">
                        <span class="label"><?php echo tcd_admin_label('bg_image'); ?>
                          <span class="recommend_desc width_type1" style="<?php if($options['index_slider_content_width'] == 'type2') echo 'display:none;'; ?>"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '1000', '600'); ?></span>
                          <span class="recommend_desc width_type2" style="<?php if($options['index_slider_content_width'] == 'type1') echo 'display:none;'; ?>"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '1450', '600'); ?></span>
                        </span>
                        <?php echo tcd_media_image_uploader($value, array('index_slider', $key, 'image'), 'full', true) ?>
                      </li>
                      <li class="cf">
                        <span class="label"><?php echo tcd_admin_label('bg_image_sp'); ?><span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '750', '1400'); ?></span></span>
                        <?php echo tcd_media_image_uploader($value, array('index_slider', $key, 'image_sp'), 'full', true) ?>
                      </li>
                    </ul>

                    <?php // オーバーレイ ----------------------- ?>
                    <h4 class="theme_option_headline2"><?php echo tcd_admin_label('overlay'); ?></h4>
                    <ul class="option_list">
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('overlay_color'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][overlay_color]" value="<?php echo esc_attr( $value['overlay_color'] ); ?>" data-default-color="#000000"></li>
                      <li class="cf">
                        <span class="label"><?php echo tcd_admin_label('overlay_opacity'); ?></span><input class="hankaku index_slider_overlay_opacity<?php echo esc_attr( $key ); ?>" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $value['overlay_opacity'] ); ?>" />
                        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;"><p><?php echo tcd_admin_label('opacity_desc'); ?></p></div>
                      </li>
                    </ul>
                  
                  </div><!-- END .tcd_standard_tab_content -->

                  <?php // テキスト ----------------------- ?>
                  <div class="tcd_standard_tab_content">

                    <h4 class="theme_option_headline2"><?php echo tcd_admin_label('catch'); ?></h4>
                    <ul class="option_list">
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('catch'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('catch_sp'); ?></span><textarea placeholder="<?php echo tcd_admin_label('device_diff_text'); ?>" class="full_width" cols="50" rows="2" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][catch_sp]"><?php echo esc_textarea(  $value['catch_sp'] ); ?></textarea></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($value, array('index_slider', $key, 'catch_font_type'), $font_type_options, true); ?></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo tcd_font_size_option($value, array('index_slider', $key, 'catch_font_size'), true ); ?></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
                    </ul>
                    <h4 class="theme_option_headline2"><?php echo tcd_admin_label('desc'); ?></h4>
                    <ul class="option_list">
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('desc_sp'); ?></span><textarea placeholder="<?php echo tcd_admin_label('device_diff_text'); ?>" class="full_width" cols="50" rows="3" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][desc_sp]"><?php echo esc_textarea(  $value['desc_sp'] ); ?></textarea></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo tcd_font_size_option($value, array('index_slider', $key, 'desc_font_size'), true ); ?></li>
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][desc_font_color]" value="<?php echo esc_attr( $value['desc_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
                    </ul>
                    
                  </div><!-- END .tcd_standard_tab_content -->

                  <?php // ボタン ----------------------- ?>
                  <div class="tcd_standard_tab_content">

                    <?php // リンクのタイプ ----------------------- ?>
                    <h4 class="theme_option_headline2"><?php _e('Link type', 'tcd-ankle');  ?></h4>
                    <input type="radio" id="index_slider_link_type1_<?php echo esc_attr( $key ); ?>" class="index_slider_link_type1" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][link_type]" value="type1" <?php checked( $value['link_type'], 'type1' ); ?> style="vertical-align:bottom;" />
                    <label for="index_slider_link_type1_<?php echo esc_attr( $key ); ?>" style="margin-right:15px;position:relative;top:1px;"><?php _e('Background link', 'tcd-ankle'); ?></label>
                    <input type="radio" id="index_slider_link_type2_<?php echo esc_attr( $key ); ?>" class="index_slider_link_type2" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][link_type]" value="type2" <?php checked( $value['link_type'], 'type2' ); ?> style="vertical-align:bottom;" />
                    <label for="index_slider_link_type2_<?php echo esc_attr( $key ); ?>" style="margin-right:15px;position:relative;top:1px;"><?php _e('Button', 'tcd-ankle'); ?></label>

                    <h4 class="theme_option_headline2"><?php _e('Link', 'tcd-ankle'); ?></h4>
                    <ul class="option_list">
                      <li class="cf hide_index_slider_link_type1"><span class="label"><?php echo tcd_admin_label('button_label'); ?></span><input class="full_width" type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][button_label]" value="<?php echo esc_attr( $value['button_label'] ); ?>" /></li>
                      <li class="cf"><span class="label"><?php _e('URL', 'tcd-ankle'); ?></span><input class="full_width" type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][button_url]" value="<?php echo esc_attr( $value['button_url'] ); ?>"></li>
                    </ul>
                    <h4 class="theme_option_headline2 hide_index_slider_link_type1"><?php _e('Button design', 'tcd-ankle'); ?></h4>
                    <ul class="option_list">
                      <li class="cf"><span class="label"><?php echo tcd_admin_label('button_type'); ?></span><?php echo tcd_basic_radio_button($value, array('index_slider', $key, 'button_type'), $button_type_options, true); ?></li>
                      <li class="cf"><span class="label"><?php _e('Shape', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($value, array('index_slider', $key, 'button_border_radius'), $button_border_radius_options, true); ?></li>
                      <li class="cf"><span class="label"><?php _e('Size', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($value, array('index_slider', $key, 'button_size'), $button_size_options, true); ?></li>
                      <li class="cf"><span class="label"><?php _e('Mouseover animation', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($value, array('index_slider', $key, 'button_animation_type'), $button_animation_options, true); ?></li>
                      <li class="cf"><span class="label"><?php _e('Color scheme', 'tcd-ankle'); ?></span><input type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][button_color]" value="<?php echo esc_attr( $value['button_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
                      <li class="cf"><span class="label"><?php _e('Color scheme on mouseover', 'tcd-ankle'); ?></span><input type="text" name="dp_options[index_slider][<?php echo esc_attr( $key ); ?>][button_color_hover]" value="<?php echo esc_attr( $value['button_color_hover'] ); ?>" data-default-color="#bf9d87" class="c-color-picker"></li>
                    </ul>
                    <div class="theme_option_message2">
                      <p><?php _e('In the case of a background link, the entire slide will be the link.', 'tcd-ankle');  ?></p>
                    </div>
                  
                  </div><!-- END .tcd_standard_tab_content -->

                </div><!-- END .tcd_standard_tab_contents -->

                <ul class="button_list cf">
                  <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
                </ul>

                <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php echo tcd_admin_label('delete_item'); ?></a></p>
              </div><!-- END .sub_box_content -->
            </div><!-- END .sub_box -->
            <?php
              $clone = ob_get_clean();
            ?>
          </div><!-- END .repeater -->
          <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo htmlspecialchars( $clone ); ?>"><?php echo tcd_admin_label('add_item'); ?></a>
        </div><!-- END .repeater-wrapper -->
        <?php //繰り返しフィールドここまで ----- ?>

        <h4 class="theme_option_headline2"><?php echo tcd_admin_label('common'); ?></h4>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Slider width', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'index_slider_content_width', $content_width_options); ?></li>
          <li class="cf"><span class="label"><?php _e('Background animation (Image only)', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'index_slider_bg_animation', $slider_bg_animation_options); ?></li>
          <li class="cf"><span class="label"><?php _e('Contents animation', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'index_slider_content_animation', $slider_content_animation_options); ?></li>
          <li class="cf"><span class="label"><?php _e('Slider speed', 'tcd-ankle'); ?></span>
            <select class="index_slider_time" name="dp_options[index_slider_time]">
            <?php
                $i = 1;
                foreach ( $time_options as $option ):
                if( $i >= 3 ){
            ?>
            <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['index_slider_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
            <?php
                }
                $i++;
                endforeach;
            ?>
            </select>
          </li>
        </ul>

      </div><!-- END .show_checkbox_area -->

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->



  <?php // ニュースティッカーの設定 ---------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('News ticker', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">
      
      <input id="show_news_ticker" class="show_checkbox" name="dp_options[show_news_ticker]" type="checkbox" value="1" <?php checked( $options['show_news_ticker'], 1 ); ?>>
      <label for="show_news_ticker"><?php _e( 'Display news ticker', 'tcd-ankle' ); ?></label>
      <div class="show_checkbox_area">

        <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
          <li class="cf"><span class="label"><?php _e('Post type', 'tcd-ankle'); ?></span>
            <div class="standard_radio_button">
              <input id="news_ticker_post_type_post" type="radio" name="dp_options[news_ticker_post_type]" value="post" <?php checked( $options['news_ticker_post_type'], 'post' ); ?>>
              <label for="news_ticker_post_type_post"><?php echo tcd_admin_label('blog'); ?></label>
              <input id="news_ticker_post_type_news" type="radio" name="dp_options[news_ticker_post_type]" value="news" <?php checked( $options['news_ticker_post_type'], 'news' ); ?>>
              <label for="news_ticker_post_type_news"><?php echo $news_label; ?></label>
            </div>
          </li>
          <li class="cf"><span class="label"><?php _e('Post order', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'news_ticker_post_order', $news_ticker_order_options); ?></li>
        </ul>

        <div class="theme_option_message2">
          <p><?php _e('Load 5 articles by specifying the article type and sort order.', 'tcd-ankle');  ?></p>
        </div>

      </div>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

  <?php // メインコンテンツ ---------- ?>
  <div class="theme_option_field cf theme_option_field_ac open active">
    <h3 class="theme_option_headline"><?php _e('Main contents', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">

      <?php // メインコンテンツのタイプ ---------- ?>
      <h4 class="theme_option_headline2"><?php _e( 'Main contents type', 'tcd-ankle' ); ?></h4>
      <span class="simple_radio_button spacer"></span>
      <input type="radio" id="main_content_type1" name="dp_options[main_content_type]" value="type1" <?php checked( $options['main_content_type'], 'type1' ); ?> />
      <label for="main_content_type1"><?php _e('TCD Theme Options Main contents', 'tcd-ankle'); ?></label></br>
      <span class="simple_radio_button spacer"></span>
      <input type="radio" id="main_content_type2" name="dp_options[main_content_type]" value="type2" <?php checked( $options['main_content_type'], 'type2' ); ?> />
      <label for="main_content_type2"><?php _e('The editor of the page set in the front page', 'tcd-ankle'); ?></label></br>

      <div id="main_content_type1_area" style="margin-top:30px;">

        <?php // フリースペース ---------- ?>
        <div class="sub_box cf">
        <h3 class="theme_option_subbox_headline"><?php _e('Free space', 'tcd-ankle');  ?></h3>
          <div class="sub_box_content">

            <input id="show_free_space1" class="show_checkbox" name="dp_options[show_free_space1]" type="checkbox" value="1" <?php checked( $options['show_free_space1'], 1 ); ?> style="margin-top:20px;">
            <label for="show_free_space1" style="margin-top:20px;"><?php _e( 'Display free space', 'tcd-ankle' ); ?></label>
            <div class="show_checkbox_area">

              <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-ankle' ); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php _e('Content width', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'free_space1_width', $content_width_options); ?></li>
                <li class="cf"><span class="label"><?php _e('Vertical margin', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'free_space1_padding', $content_padding_options); ?></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[free_space1_bg_color]" value="<?php echo esc_attr( $options['free_space1_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
              </ul>
              <h4 class="theme_option_headline2"><?php _e( 'Editor', 'tcd-ankle' ); ?></h4>
              <?php wp_editor( $options['free_space1_editor'], 'free_space1_editor', array ( 'textarea_name' => 'dp_options[free_space1_editor]', 'textarea_rows' => 6 ) ); ?>

            </div>
            <ul class="button_list cf">
              <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
              <li><a class="close_sub_box button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
            </ul>
          </div><!-- END .sub_box -->
        </div><!-- END .sub_box_content -->


        <?php // 商品一覧 ---------- ?>
        <div class="sub_box cf">
        <h3 class="theme_option_subbox_headline"><?php _e('Product list', 'tcd-ankle');  ?></h3>
          <div class="sub_box_content">

            <?php if(is_woocommerce_active()){ ?>
            <input id="show_product_list" class="show_checkbox" name="dp_options[show_product_list]" type="checkbox" value="1" <?php checked( $options['show_product_list'], 1 ); ?> style="margin-top:20px;">
            <label for="show_product_list" style="margin-top:20px;"><?php _e( 'Display product list', 'tcd-ankle' ); ?></label>
            <div class="show_checkbox_area">

              <h4 class="theme_option_headline2"><?php echo tcd_admin_label('header'); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[product_list_headline]"><?php echo esc_textarea( $options['product_list_headline'] ); ?></textarea></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('sub_headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[product_list_sub_headline]"><?php echo esc_textarea( $options['product_list_sub_headline'] ); ?></textarea></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[product_list_desc]"><?php echo esc_textarea( $options['product_list_desc'] ); ?></textarea></li>
              </ul>

              <h4 class="theme_option_headline2"><?php _e('Product list', 'tcd-ankle'); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php _e('Product type', 'tcd-ankle');  ?></span>
                  <select name="dp_options[product_list_type]">
                    <option style="padding-right: 10px;" value="products" <?php selected( $options['product_list_type'], 'products' ); ?>><?php _e('All products', 'tcd-ankle'); ?></option>
                    <option style="padding-right: 10px;" value="featured_products" <?php selected( $options['product_list_type'], 'featured_products' ); ?>><?php _e('Featured products', 'tcd-ankle'); ?></option>
                    <option style="padding-right: 10px;" value="sale_products" <?php selected( $options['product_list_type'], 'sale_products' ); ?>><?php _e('Sale products', 'tcd-ankle'); ?></option>
                  </select>
                </li>
                <li class="cf"><span class="label"><?php _e('Product order', 'tcd-ankle');  ?></span>
                  <select name="dp_options[product_list_order]">
                    <option style="padding-right: 10px;" value="menu_order" <?php selected( $options['product_list_order'], 'menu_order' ); ?>><?php _e('Default', 'tcd-ankle'); ?></option>
                    <option style="padding-right: 10px;" value="date" <?php selected( $options['product_list_order'], 'date' ); ?>><?php _e('Latest', 'tcd-ankle'); ?></option>
                    <option style="padding-right: 10px;" value="popularity" <?php selected( $options['product_list_order'], 'popularity' ); ?>><?php _e('Popularity', 'tcd-ankle'); ?></option>
                    <option style="padding-right: 10px;" value="rand" <?php selected( $options['product_list_order'], 'rand' ); ?>><?php _e('Random', 'tcd-ankle'); ?></option>
                  </select>
                </li>
                <li class="cf"><span class="label"><?php _e('Number of products displayed', 'tcd-ankle'); ?></span><?php echo tcd_display_post_num_option('product_list_num', array(6,15,3), array(6,14,2)); ?></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[product_list_bg_color]" value="<?php echo esc_attr( $options['product_list_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
              </ul>

              <h4 class="theme_option_headline2"><?php echo tcd_admin_label('button'); ?></h4>
              <div class="theme_option_message2">
                <p>
                  <?php _e('This button is used to move to the product archive page.', 'tcd-ankle');  ?></br>
                  <?php _e('Buttons can be selected from the designs set in Theme Options > Quick Tags > Buttons.', 'tcd-ankle');  ?>
                </p>
              </div>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php echo tcd_admin_label('button'); ?></span><?php echo tcd_basic_radio_button($options, 'product_list_button_display', $basic_display_options); ?></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('button_label'); ?></span><input class="regular-text" type="text" name="dp_options[product_list_button_label]" value="<?php esc_attr_e( $options['product_list_button_label'] ); ?>" /></li>
                <li class="cf qt_button_preview_option"><span class="label"><?php _e('Button design', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'product_list_button_type', $front_page_button_type); ?></li>
              </ul>

              <?php // ボタンプレビュー  ?>
              <div class="admin_preview_area qt-btn-preview"></div>

            </div>
            <?php }else{ ?>
            <div class="theme_option_message2" style="margin-top:20px;">
              <p><b><?php _e('This feature is available after installing and activating WooCoomerce.', 'tcd-ankle'); ?></b></p>
            </div>
            <?php } ?>

            <ul class="button_list cf">
              <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
              <li><a class="close_sub_box button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
            </ul>
          </div><!-- END .sub_box -->
        </div><!-- END .sub_box_content -->


        <?php // フリースペース ---------- ?>
        <div class="sub_box cf">
        <h3 class="theme_option_subbox_headline"><?php _e('Free space', 'tcd-ankle');  ?></h3>
          <div class="sub_box_content">

            <input id="show_free_space1" class="show_checkbox" name="dp_options[show_free_space2]" type="checkbox" value="1" <?php checked( $options['show_free_space2'], 1 ); ?> style="margin-top:20px;">
            <label for="show_free_space1" style="margin-top:20px;"><?php _e( 'Display free space', 'tcd-ankle' ); ?></label>
            <div class="show_checkbox_area">

              <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-ankle' ); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php _e('Content width', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'free_space2_width', $content_width_options); ?></li>
                <li class="cf"><span class="label"><?php _e('Vertical margin', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'free_space2_padding', $content_padding_options); ?></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[free_space2_bg_color]" value="<?php echo esc_attr( $options['free_space2_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
              </ul>
              <h4 class="theme_option_headline2"><?php _e( 'Editor', 'tcd-ankle' ); ?></h4>
              <?php wp_editor( $options['free_space2_editor'], 'free_space2_editor', array ( 'textarea_name' => 'dp_options[free_space2_editor]', 'textarea_rows' => 6 ) ); ?>

            </div>

            <ul class="button_list cf">
              <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
              <li><a class="close_sub_box button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
            </ul>
          </div><!-- END .sub_box -->
        </div><!-- END .sub_box_content -->


        <?php // ブログカルーセル ---------- ?>
        <div class="sub_box cf">
        <h3 class="theme_option_subbox_headline"><?php _e('Blog carousel', 'tcd-ankle');  ?></h3>
          <div class="sub_box_content">

            <input id="show_blog_carousel" class="show_checkbox" name="dp_options[show_blog_carousel]" type="checkbox" value="1" <?php checked( $options['show_blog_carousel'], 1 ); ?> style="margin-top:20px;">
            <label for="show_blog_carousel" style="margin-top:20px;"><?php _e( 'Display blog carousel', 'tcd-ankle' ); ?></label>
            <div class="show_checkbox_area">

              <h4 class="theme_option_headline2"><?php echo tcd_admin_label('header'); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[blog_carousel_headline]"><?php echo esc_textarea( $options['blog_carousel_headline'] ); ?></textarea></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('sub_headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[blog_carousel_sub_headline]"><?php echo esc_textarea( $options['blog_carousel_sub_headline'] ); ?></textarea></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[blog_carousel_desc]"><?php echo esc_textarea( $options['blog_carousel_desc'] ); ?></textarea></li>
              </ul>

              <h4 class="theme_option_headline2"><?php echo tcd_admin_label('article_list'); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php _e( 'Article type', 'tcd-ankle' ); ?></span>
                <select name="dp_options[blog_carousel_post_type]">
                  <option value="recent_post" <?php selected('recent_post', $options['show_blog_carousel']); ?>><?php _e('All post', 'tcd-ankle'); ?></option>
                  <option value="recommend_post1" <?php selected('recommend_post1', $options['blog_carousel_post_type']); ?>><?php echo __('Recommend post', 'tcd-ankle').'1'; ?></option>
                  <option value="recommend_post2" <?php selected('recommend_post2', $options['blog_carousel_post_type']); ?>><?php echo __('Recommend post', 'tcd-ankle').'2'; ?></option>
                  <option value="recommend_post3" <?php selected('recommend_post3', $options['blog_carousel_post_type']); ?>><?php echo __('Recommend post', 'tcd-ankle').'3'; ?></option>
                </select>
                </li>
                <li class="cf"><span class="label"><?php _e('Number of articles to display in the carousel', 'tcd-ankle');  ?></span><?php echo tcd_display_post_num_option('blog_carousel_num', array(3,9,1), array(3,9,1)); ?></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size_title'); ?></span><?php echo tcd_font_size_option($options, 'blog_carousel_title_font_size') ?></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[blog_carousel_bg_color]" value="<?php echo esc_attr( $options['blog_carousel_bg_color'] ); ?>" data-default-color="#f6f6f6" class="c-color-picker"></li>
              </ul>

              <h4 class="theme_option_headline2"><?php echo tcd_admin_label('button'); ?></h4>
              <div class="theme_option_message2">
                <p>
                  <?php _e('This button is used to move to the post archive page.', 'tcd-ankle');  ?></br>
                  <?php _e('Buttons can be selected from the designs set in Theme Options > Quick Tags > Buttons.', 'tcd-ankle');  ?>
                </p>
              </div>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php echo tcd_admin_label('button'); ?></span><?php echo tcd_basic_radio_button($options, 'blog_carousel_button_display', $basic_display_options); ?></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('button_label'); ?></span><input class="regular-text" type="text" name="dp_options[blog_carousel_button_label]" value="<?php esc_attr_e( $options['blog_carousel_button_label'] ); ?>" /></li>
                <li class="cf qt_button_preview_option"><span class="label"><?php _e('Button design', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'blog_carousel_button_type', $front_page_button_type); ?></li>
              </ul>
              <?php // ボタンプレビュー  ?>
              <div class="admin_preview_area qt-btn-preview"></div>

            </div>

            <ul class="button_list cf">
              <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
              <li><a class="close_sub_box button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
            </ul>
          </div><!-- END .sub_box -->
        </div><!-- END .sub_box_content -->


        <?php // フリースペース ---------- ?>
        <div class="sub_box cf">
        <h3 class="theme_option_subbox_headline"><?php _e('Free space', 'tcd-ankle');  ?></h3>
          <div class="sub_box_content">

            <input id="show_free_space3" class="show_checkbox" name="dp_options[show_free_space3]" type="checkbox" value="1" <?php checked( $options['show_free_space3'], 1 ); ?> style="margin-top:20px;">
            <label for="show_free_space3" style="margin-top:20px;"><?php _e( 'Display free space', 'tcd-ankle' ); ?></label>
            <div class="show_checkbox_area">

              <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-ankle' ); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php _e('Content width', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'free_space3_width', $content_width_options); ?></li>
                <li class="cf"><span class="label"><?php _e('Vertical margin', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'free_space3_padding', $content_padding_options); ?></li>
                <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[free_space3_bg_color]" value="<?php echo esc_attr( $options['free_space3_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
              </ul>
              <h4 class="theme_option_headline2"><?php _e( 'Editor', 'tcd-ankle' ); ?></h4>
              <?php wp_editor( $options['free_space3_editor'], 'free_space3_editor', array ( 'textarea_name' => 'dp_options[free_space3_editor]', 'textarea_rows' => 6 ) ); ?>

            </div>

            <ul class="button_list cf">
              <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
              <li><a class="close_sub_box button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
            </ul>
          </div><!-- END .sub_box -->
        </div><!-- END .sub_box_content -->

      </div>


      <div id="main_content_type2_area" style="margin-top:30px;">
        <?php
          $front_page_id = get_option('page_on_front');
          if($front_page_id){
        ?>
        <div class="theme_option_message2">
          <p><?php _e('The content of the page set in the front page will be reflected.', 'tcd-ankle');  ?></br><a href="post.php?post=<?php echo $front_page_id; ?>&action=edit"><?php _e('Click here for the page editing screen.', 'tcd-ankle');  ?></a></p>
        </div>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php _e( 'Content width', 'tcd-ankle' ); ?></span><?php echo tcd_basic_radio_button($options, 'main_content_width', $content_width_options); ?></li>
        </ul>
        <?php }else{ ?>
        <div class="theme_option_message2">
          <p><?php _e('It seems that you have not created a page for the front page yet. Please refer to the following to create and configure it.', 'tcd-ankle'); ?></br><a href="#"><?php _e('Setup Manual - Home page display settings', 'tcd-ankle'); ?></a></p>
        </div>
        <?php } ?>
      </div>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->



</div><!-- END .tab-content -->

<?php
} // END add_front_page_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_theme_options_validate( $input ) {

  global $dp_default_options, $item_type_options, $time_options, $font_type_options, $basic_display_options, $button_border_radius_options, $button_size_options, $button_type_options, $button_animation_options, $slider_bg_animation_options, $slider_content_animation_options, $content_width_options, $news_ticker_order_options, $content_padding_options, $front_page_button_type;

  // スライダーの基本設定
  $input['show_index_slider'] = ! empty( $input['show_index_slider'] ) ? 1 : 0;
  if ( ! isset( $input['index_slider_content_width'] ) || ! array_key_exists( $input['index_slider_content_width'], $content_width_options ) )
    $input['index_slider_content_width'] = $dp_default_options['index_slider_content_width'];
  if ( ! isset( $input['index_slider_time'] ) || ! array_key_exists( $input['index_slider_time'], $time_options ) )
    $input['index_slider_time'] = $dp_default_options['index_slider_time'];
  if ( ! isset( $input['index_slider_bg_animation'] ) || ! array_key_exists( $input['index_slider_bg_animation'], $slider_bg_animation_options ) )
    $input['index_slider_bg_animation'] = $dp_default_options['index_slider_bg_animation'];
  if ( ! isset( $input['index_slider_content_animation'] ) || ! array_key_exists( $input['index_slider_content_animation'], $slider_content_animation_options ) )
    $input['index_slider_content_animation'] = $dp_default_options['index_slider_content_animation'];

  // ニュースティッカーの設定
  $input['show_news_ticker'] = ! empty( $input['show_news_ticker'] ) ? 1 : 0;
  $input['news_ticker_post_type'] = wp_filter_nohtml_kses( $input['news_ticker_post_type'] );
  if ( ! isset( $input['news_ticker_post_order'] ) || ! array_key_exists( $input['news_ticker_post_order'], $news_ticker_order_options ) )
    $input['news_ticker_post_order'] = $dp_default_options['news_ticker_post_order'];
  
  // メインコンテンツ
  $input['main_content_type'] = wp_filter_nohtml_kses( $input['main_content_type'] );
  if ( ! isset( $input['main_content_width'] ) || ! array_key_exists( $input['main_content_width'], $content_width_options ) )
    $input['main_content_width'] = $dp_default_options['main_content_width'];

  // フリースペース 1
  $input['show_free_space1'] = ! empty( $input['show_free_space1'] ) ? 1 : 0;
  if ( ! isset( $input['free_space1_width'] ) || ! array_key_exists( $input['free_space1_width'], $content_width_options ) )
    $input['free_space1_width'] = $dp_default_options['free_space1_width'];
  if ( ! isset( $input['free_space1_padding'] ) || ! array_key_exists( $input['free_space1_padding'], $content_padding_options ) )
    $input['free_space1_padding'] = $dp_default_options['free_space1_padding'];
  $input['free_space1_bg_color'] = sanitize_hex_color( $input['free_space1_bg_color'] );
  $input['free_space1_editor'] = $input['free_space1_editor'];

  // フリースペース 2
  $input['show_free_space2'] = ! empty( $input['show_free_space2'] ) ? 1 : 0;
  if ( ! isset( $input['free_space2_width'] ) || ! array_key_exists( $input['free_space2_width'], $content_width_options ) )
    $input['free_space2_width'] = $dp_default_options['free_space2_width'];
  if ( ! isset( $input['free_space2_padding'] ) || ! array_key_exists( $input['free_space2_padding'], $content_padding_options ) )
    $input['free_space2_padding'] = $dp_default_options['free_space2_padding'];
  $input['free_space2_bg_color'] = sanitize_hex_color( $input['free_space2_bg_color'] );
  $input['free_space2_editor'] = $input['free_space2_editor'];

  // 商品一覧
  $input['show_product_list'] = ! empty( $input['show_product_list'] ) ? 1 : 0;
  $input['product_list_headline'] = wp_filter_nohtml_kses( $input['product_list_headline'] );
	$input['product_list_sub_headline'] = wp_filter_nohtml_kses( $input['product_list_sub_headline'] );
	$input['product_list_desc'] = wp_filter_nohtml_kses( $input['product_list_desc'] );

  $input['product_list_type'] = wp_filter_nohtml_kses( $input['product_list_type'] );
  $input['product_list_order'] = wp_filter_nohtml_kses( $input['product_list_order'] );
  $input['product_list_num'] = absint( $input['product_list_num'] );
	$input['product_list_num_sp'] = absint( $input['product_list_num_sp'] );
  $input['product_list_bg_color'] = sanitize_hex_color( $input['product_list_bg_color'] );

  if ( ! isset( $input['product_list_button_display'] ) || ! array_key_exists( $input['product_list_button_display'], $basic_display_options ) )
    $input['product_list_button_display'] = $dp_default_options['product_list_button_display'];
  $input['product_list_button_label'] = wp_filter_nohtml_kses( $input['product_list_button_label'] );
  if ( ! isset( $input['product_list_button_type'] ) || ! array_key_exists( $input['product_list_button_type'], $front_page_button_type ) )
    $input['product_list_button_type'] = $dp_default_options['product_list_button_type'];

  // ブログカルーセル
  $input['show_blog_carousel'] = ! empty( $input['show_blog_carousel'] ) ? 1 : 0;
  $input['blog_carousel_headline'] = wp_filter_nohtml_kses( $input['blog_carousel_headline'] );
	$input['blog_carousel_sub_headline'] = wp_filter_nohtml_kses( $input['blog_carousel_sub_headline'] );
	$input['blog_carousel_desc'] = wp_filter_nohtml_kses( $input['blog_carousel_desc'] );
  $input['blog_carousel_title_font_size'] = absint( $input['blog_carousel_title_font_size'] );
	$input['blog_carousel_title_font_size_sp'] = absint( $input['blog_carousel_title_font_size_sp'] );
  $input['blog_carousel_post_type'] = wp_filter_nohtml_kses( $input['blog_carousel_post_type'] );
	$input['blog_carousel_num'] = absint( $input['blog_carousel_num'] );
	$input['blog_carousel_num_sp'] = absint( $input['blog_carousel_num_sp'] );
  $input['blog_carousel_bg_color'] = sanitize_hex_color( $input['blog_carousel_bg_color'] );

  if ( ! isset( $input['blog_carousel_button_display'] ) || ! array_key_exists( $input['blog_carousel_button_display'], $basic_display_options ) )
    $input['blog_carousel_button_display'] = $dp_default_options['blog_carousel_button_display'];
  $input['blog_carousel_button_label'] = wp_filter_nohtml_kses( $input['blog_carousel_button_label'] );
  if ( ! isset( $input['blog_carousel_button_type'] ) || ! array_key_exists( $input['blog_carousel_button_type'], $front_page_button_type ) )
    $input['blog_carousel_button_type'] = $dp_default_options['blog_carousel_button_type'];

  // フリースペース 3
  $input['show_free_space3'] = ! empty( $input['show_free_space3'] ) ? 1 : 0;
  if ( ! isset( $input['free_space3_width'] ) || ! array_key_exists( $input['free_space3_width'], $content_width_options ) )
    $input['free_space3_width'] = $dp_default_options['free_space3_width'];
  if ( ! isset( $input['free_space3_padding'] ) || ! array_key_exists( $input['free_space3_padding'], $content_padding_options ) )
    $input['free_space3_padding'] = $dp_default_options['free_space3_padding'];
  $input['free_space3_bg_color'] = sanitize_hex_color( $input['free_space3_bg_color'] );
  $input['free_space3_editor'] = $input['free_space3_editor'];

  //スライダーの設定
  $index_slider = array();
  if ( isset( $input['index_slider'] ) && is_array( $input['index_slider'] ) ) {
    foreach ( $input['index_slider'] as $key => $value ) {
      $index_slider[] = array(
        'slider_type' => isset( $input['index_slider'][$key]['slider_type'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['slider_type'] ) : 'type1',
        'image' => isset( $input['index_slider'][$key]['image'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['image'] ) : '',
        'image_sp' => isset( $input['index_slider'][$key]['image_sp'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['image_sp'] ) : '',
        'video' => isset( $input['index_slider'][$key]['video'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['video'] ) : '',
        'youtube' => isset( $input['index_slider'][$key]['youtube'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['youtube'] ) : '',
        'overlay_color' => isset( $input['index_slider'][$key]['overlay_color'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['overlay_color'] ) : '#000000',
        'overlay_opacity' => isset( $input['index_slider'][$key]['overlay_opacity'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['overlay_opacity'] ) : '0.3',
        
        'catch' => isset( $input['index_slider'][$key]['catch'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['catch'] ) : '',
        'catch_sp' => isset( $input['index_slider'][$key]['catch_sp'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['catch_sp'] ) : '',
        'catch_font_type' => ( isset( $input['index_slider'][$key]['catch_font_type'] ) && array_key_exists( $input['index_slider'][$key]['catch_font_type'], $font_type_options ) ) ? $input['index_slider'][$key]['catch_font_type'] : 'type1',
        'catch_font_size' => isset( $input['index_slider'][$key]['catch_font_size'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['catch_font_size'] ) : '30',
        'catch_font_size_sp' => isset( $input['index_slider'][$key]['catch_font_size_sp'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['catch_font_size_sp'] ) : '20',
        'catch_font_color' => isset( $input['index_slider'][$key]['catch_font_color'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['catch_font_color'] ) : '#FFFFFF',
        'desc' => isset( $input['index_slider'][$key]['desc'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['desc'] ) : '',
        'desc_sp' => isset( $input['index_slider'][$key]['desc_sp'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['desc_sp'] ) : '',
        'desc_font_size' => isset( $input['index_slider'][$key]['desc_font_size'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['desc_font_size'] ) : '20',
        'desc_font_size_sp' => isset( $input['index_slider'][$key]['desc_font_size_sp'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['desc_font_size_sp'] ) : '16',
        'desc_font_color' => isset( $input['index_slider'][$key]['desc_font_color'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['desc_font_color'] ) : '#FFFFFF',

        'link_type' => isset( $input['index_slider'][$key]['link_type'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['link_type'] ) : 'type1',
        'button_label' => isset( $input['index_slider'][$key]['button_label'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['button_label'] ) : '',
        'button_url' => isset( $input['index_slider'][$key]['button_url'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['button_url'] ) : '',

        'button_type' => ( isset( $input['index_slider'][$key]['button_type'] ) && array_key_exists( $input['index_slider'][$key]['button_type'], $button_type_options ) ) ? $input['index_slider'][$key]['button_type'] : 'type1',
        'button_border_radius' => ( isset( $input['index_slider'][$key]['button_border_radius'] ) && array_key_exists( $input['index_slider'][$key]['button_border_radius'], $button_border_radius_options ) ) ? $input['index_slider'][$key]['button_border_radius'] : 'flat',
        'button_size' => ( isset( $input['index_slider'][$key]['button_size'] ) && array_key_exists( $input['index_slider'][$key]['button_size'], $button_size_options ) ) ? $input['index_slider'][$key]['button_size'] : 'medium',
        'button_animation_type' => ( isset( $input['index_slider'][$key]['button_animation_type'] ) && array_key_exists( $input['index_slider'][$key]['button_animation_type'], $button_animation_options ) ) ? $input['index_slider'][$key]['button_animation_type'] : 'animation_type1',
        'button_color' => isset( $input['index_slider'][$key]['button_color'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['button_color'] ) : '#000000',
        'button_color_hover' => isset( $input['index_slider'][$key]['button_color_hover'] ) ? wp_filter_nohtml_kses( $input['index_slider'][$key]['button_color_hover'] ) : '#bf9d87'

        
      );
    }
  };
  $input['index_slider'] = $index_slider;

  return $input;

};


?>