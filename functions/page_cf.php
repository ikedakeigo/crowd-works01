<?php

/* フォーム用 画像フィールド出力 */
function mlcf_media_form($cf_key, $label) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($label)) $label = $cf_key;

	$media_id = get_post_meta($post->ID, $cf_key, true);
?>
<div class="image_box cf">
  <div class="cf cf_media_field hide-if-no-js <?php echo esc_attr($cf_key); ?>">
    <input type="hidden" class="cf_media_id" name="<?php echo esc_attr($cf_key); ?>" id="<?php echo esc_attr($cf_key); ?>" value="<?php echo esc_attr($media_id); ?>" />
    <div class="preview_field"><?php if ($media_id) the_mlcf_image($post->ID, $cf_key); ?></div>
    <div class="buttton_area">
      <input type="button" class="cfmf-select-img button" value="<?php echo tcd_admin_label('select_image'); ?>" />
      <input type="button" class="cfmf-delete-img button<?php if (!$media_id) echo ' hidden'; ?>" value="<?php echo tcd_admin_label('remove_image'); ?>" />
    </div>
  </div>
</div>
<?php
}


/* 画像フィールドで選択された画像をimgタグで出力 */
function the_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	echo get_mlcf_image($post_id, $cf_key, $image_size);
}

/* 画像フィールドで選択された画像をimgタグで返す */
function get_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_image($media_id, $image_size, $image_size);
	}

	return false;
}

/* 画像フィールドで選択された画像urlを返す */
function get_mlcf_image_url($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		$img = wp_get_attachment_image_src($media_id, $image_size);
		if (!empty($img[0])) {
			return $img[0];
		}
	}

	return false;
}

/* 画像フィールドで選択されたメディアのURLを出力 */
function the_mlcf_media_url($post_id, $cf_key) {
	echo get_mlcf_media_url($post_id, $cf_key);
}

/* 画像フィールドで選択されたメディアのURLを返す */
function get_mlcf_media_url($post_id, $cf_key) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_url($media_id);
	}

	return false;
}


// ヘッダーの設定 -------------------------------------------------------

function page_header_meta_box() {
  add_meta_box(
    'page_header_meta_box',//ID of meta box
    __('Page setting', 'tcd-ankle'),//label
    'show_page_header_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'page_header_meta_box');

function show_page_header_meta_box() {

  global $post, $font_type_options, $basic_display_options, $page_content_width_options, $page_header_type_options;

  // ヘッダーの設定
  $page_header_type = get_post_meta($post->ID, 'page_header_type', true) ?  get_post_meta($post->ID, 'page_header_type', true) : 'type1';
  $page_header_catch = get_post_meta($post->ID, 'page_header_catch', true);
  $page_header_catch_sp = get_post_meta($post->ID, 'page_header_catch_sp', true);
  $page_header_catch_font_size = get_post_meta($post->ID, 'page_header_catch_font_size', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size', true) : '32';
  $page_header_catch_font_size_sp = get_post_meta($post->ID, 'page_header_catch_font_size_sp', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size_sp', true) : '22';
  $page_header_catch_font_type = get_post_meta($post->ID, 'page_header_catch_font_type', true) ?  get_post_meta($post->ID, 'page_header_catch_font_type', true) : 'type3';
  $page_header_desc = get_post_meta($post->ID, 'page_header_desc', true);
  $page_header_desc_sp = get_post_meta($post->ID, 'page_header_desc_sp', true);
  $page_header_overlay_color = get_post_meta($post->ID, 'page_header_overlay_color', true) ?  get_post_meta($post->ID, 'page_header_overlay_color', true) : '#000000';
  $page_header_overlay_opacity = get_post_meta($post->ID, 'page_header_overlay_opacity', true) ?  get_post_meta($post->ID, 'page_header_overlay_opacity', true) : '0.3';

  // 基本設定
  $hide_header_message = get_post_meta($post->ID, 'hide_header_message', true) ?  get_post_meta($post->ID, 'hide_header_message', true) : 'display';
  $hide_header_bar = get_post_meta($post->ID, 'hide_header_bar', true) ?  get_post_meta($post->ID, 'hide_header_bar', true) : 'display';
  $hide_global_menu = get_post_meta($post->ID, 'hide_global_menu', true) ?  get_post_meta($post->ID, 'hide_global_menu', true) : 'display';
  $hide_footer = get_post_meta($post->ID, 'hide_footer', true) ?  get_post_meta($post->ID, 'hide_footer', true) : 'display';
  $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : 'normal';

  // FAQ
  $faq_list = get_post_meta($post->ID, 'faq_list', true);

  echo '<input type="hidden" name="page_header_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<?php
    // WP5.0対策として隠しフィールドを用意　選択されているページテンプレートによってLPページ用入力欄を表示・非表示する
    if ( count( get_page_templates( $post ) ) > 0 && get_option( 'page_for_posts' ) != $post->ID ) :
      $template = ! empty( $post->page_template ) ? $post->page_template : false;
?>
<select name="hidden_page_template" id="hidden_page_template" style="display:none;">
  <option value="default">Default Template</option>
  <?php page_template_dropdown( $template, 'page' ); ?>
</select>
<?php endif; ?>

<div class="tcd_custom_field_wrap">

  <?php // 基本設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac hide_when_normal_template">
    <h3 class="theme_option_headline"><?php echo tcd_admin_label('display_setting'); ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
        <p><?php _e('Please use the option below if you want to make this page like Landing page.', 'tcd-ankle'); ?></p>
      </div>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Header message', 'tcd-ankle'); ?></span><?php echo cf_tcd_basic_radio_button('hide_header_message', $hide_header_message, $basic_display_options) ?></li>
        <li class="cf"><span class="label"><?php _e('Header bar', 'tcd-ankle'); ?></span><?php echo cf_tcd_basic_radio_button('hide_header_bar', $hide_header_bar, $basic_display_options) ?></li>
        <li class="cf"><span class="label"><?php _e('Global menu', 'tcd-ankle'); ?></span><?php echo cf_tcd_basic_radio_button('hide_global_menu', $hide_global_menu, $basic_display_options) ?></li>
        <li class="cf"><span class="label"><?php _e('Footer', 'tcd-ankle'); ?></span><?php echo cf_tcd_basic_radio_button('hide_footer', $hide_footer, $basic_display_options) ?></li>
        <li class="cf"><span class="label"><?php _e('Content width', 'tcd-ankle'); ?></span><?php echo cf_tcd_basic_radio_button('page_content_width', $page_content_width, $page_content_width_options) ?></li>
      </ul>

      <ul class="button_list cf">
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>

    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // ページヘッダーの設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac" id="page_header_setting_area">
    <h3 class="theme_option_headline"><?php _e( 'Header', 'tcd-ankle' ); ?></h3>
    <div class="theme_option_field_ac_content">

      <ul class="tcd_standard_tab_area">
        <li class="tcd_standard_tab_label is_active"><?php _e( 'Header type', 'tcd-ankle' ); ?></li>
        <li class="tcd_standard_tab_label"><?php _e( 'Text settings', 'tcd-ankle' ); ?></li>
        <li class="tcd_standard_tab_label"><?php _e( 'Background settings', 'tcd-ankle' ); ?></li>
      </ul>
      <div class="tcd_standard_tab_contents">

        <div class="tcd_standard_tab_content is_active">
          <div class="theme_option_message2">
            <p><?php _e('Please select a header type from the list below.', 'tcd-ankle'); ?></p>
          </div>
          <?php echo cf_tcd_admin_image_radio_button('page_header_type', $page_header_type, $page_header_type_options); ?>
        </div>

        <div class="tcd_standard_tab_content">
          <h3 class="theme_option_headline2"><?php echo tcd_admin_label('catch'); ?></h3>
          <ul class="option_list">
            <li class="cf"><span class="label"><?php echo tcd_admin_label('catch'); ?></span>
              <textarea class="full_width" cols="50" rows="2" name="page_header_catch"><?php echo esc_textarea(  $page_header_catch ); ?></textarea>
            </li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('catch_sp'); ?></span>
              <textarea class="full_width" cols="50" rows="2" name="page_header_catch_sp" placeholder="<?php echo tcd_admin_label('device_diff_text'); ?>"><?php echo esc_textarea(  $page_header_catch_sp ); ?></textarea>
            </li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo cf_tcd_basic_radio_button('page_header_catch_font_type', $page_header_catch_font_type, $font_type_options) ?></li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo cf_tcd_font_size_option('page_header_catch_font_size', $page_header_catch_font_size, $page_header_catch_font_size_sp); ?></li>
          </ul>
          <h3 class="theme_option_headline2"><?php echo tcd_admin_label('desc'); ?></h3>
          <ul class="option_list">
            <li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span>
              <textarea class="full_width" cols="50" rows="3" name="page_header_desc"><?php echo esc_textarea(  $page_header_desc ); ?></textarea>
            </li>
            <li class="cf"><span class="label"><?php echo tcd_admin_label('desc_sp'); ?></span>
              <textarea class="full_width" cols="50" rows="3" name="page_header_desc_sp" placeholder="<?php echo tcd_admin_label('device_diff_text'); ?>"><?php echo esc_textarea(  $page_header_desc_sp ); ?></textarea>
            </li>
          </ul>
        </div>
        
        <div class="tcd_standard_tab_content">
          <h3 class="theme_option_headline2"><?php echo tcd_admin_label('bg_image'); ?></h3>
          <div class="theme_option_message2">
            <p class="page_header_type1_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '1450', '600'); ?></p>
          </div>
          <?php mlcf_media_form('page_header_bg_image', tcd_admin_label('bg_image')); ?>
          <h4 class="theme_option_headline2"><?php echo tcd_admin_label('overlay'); ?></h4>
          <ul class="option_list">
            <li class="cf"><span class="label"><?php echo tcd_admin_label('overlay_color'); ?></span><input type="text" name="page_header_overlay_color" value="<?php echo esc_attr( $page_header_overlay_color ); ?>" data-default-color="#000000" class="c-color-picker"></li>
            <li class="cf">
              <span class="label"><?php echo tcd_admin_label('overlay_opacity'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" type="text" name="page_header_overlay_opacity" value="<?php echo esc_attr($page_header_overlay_opacity); ?>" />
              <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
                <p><?php echo tcd_admin_label('opacity_desc'); ?></p>
              </div>
            </li>
          </ul>

        </div>
      </div>      
      

      <ul class="button_list cf">
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // FAQの設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'FAQ setting', 'tcd-ankle' ); ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
        <p><?php _e('Please copy and paste the short code below where you want to display FAQ list.', 'tcd-ankle'); ?></p>
      </div>

      <h3 class="theme_option_headline2"><?php _e('Short code', 'tcd-ankle'); ?></h3>
      <input class="fullwidth" type="text" value="[sc_faq]" readonly>

      <?php // リスト ------------------------------------------------------------------------- ?>
      <h4 class="theme_option_headline2"><?php _e( 'FAQ list', 'tcd-ankle' ); ?></h4>
      <?php //繰り返しフィールド ----- ?>
      <div class="repeater-wrapper">
        <div class="repeater sortable" data-delete-confirm="<?php echo tcd_admin_label('delete'); ?>">
          <?php
              if ( $faq_list ) :
                foreach ( $faq_list as $key => $value ) :
          ?>
          <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
            <h4 class="theme_option_subbox_headline"><?php echo esc_html( ! empty( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : tcd_admin_label('new_item') ); ?></h4>
            <div class="sub_box_content">
              <h4 class="theme_option_headline2"><?php _e( 'Question', 'tcd-ankle' ); ?></h4>
              <p><input class="repeater-label full_width" type="text" name="faq_list[<?php echo esc_attr( $key ); ?>][question]" value="<?php echo esc_attr( isset( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : '' ); ?>" /></p>
              <h4 class="theme_option_headline2"><?php _e( 'Answer', 'tcd-ankle' ); ?></h4>
              <textarea class="full_width" cols="50" rows="5" name="faq_list[<?php echo esc_attr( $key ); ?>][answer]"><?php echo esc_attr( isset( $faq_list[$key]['answer'] ) ? $faq_list[$key]['answer'] : '' ); ?></textarea>
              <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php echo tcd_admin_label('delete_item'); ?></a></p>
            </div><!-- END .sub_box_content -->
          </div><!-- END .sub_box -->
          <?php
                endforeach;
              endif;
              $key = 'addindex';
              ob_start();
          ?>
          <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
            <h4 class="theme_option_subbox_headline"><?php echo esc_html( ! empty( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : tcd_admin_label('new_item') ); ?></h4>
            <div class="sub_box_content">
              <h4 class="theme_option_headline2"><?php _e( 'Question', 'tcd-ankle' ); ?></h4>
              <p><input class="repeater-label full_width" type="text" name="faq_list[<?php echo esc_attr( $key ); ?>][question]" value="<?php echo esc_attr( isset( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : '' ); ?>" /></p>
              <h4 class="theme_option_headline2"><?php _e( 'Answer', 'tcd-ankle' ); ?></h4>
              <textarea class="full_width" cols="50" rows="5" name="faq_list[<?php echo esc_attr( $key ); ?>][answer]"><?php echo esc_attr( isset( $faq_list[$key]['answer'] ) ? $faq_list[$key]['answer'] : '' ); ?></textarea>
              <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php echo tcd_admin_label('delete_item'); ?></a></p>
            </div><!-- END .sub_box_content -->
          </div><!-- END .sub_box -->
          <?php
              $clone = ob_get_clean();
          ?>
          </div><!-- END .repeater -->
        <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php echo tcd_admin_label('add_item'); ?></a>
      </div><!-- END .repeater-wrapper -->
      <?php //繰り返しフィールドここまで ----- ?>

      <ul class="button_list cf">
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_page_header_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['page_header_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['page_header_custom_fields_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'page_header_catch','page_header_catch_sp','page_header_catch_font_size','page_header_catch_font_size_sp','page_header_catch_font_type','page_header_desc','page_header_desc_sp',
    'page_header_bg_image', 'page_header_overlay_color','page_header_overlay_opacity',
    'hide_header_message', 'hide_global_menu', 'hide_header_bar','hide_footer','page_content_width','page_header_type'
  );
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

  // repeater save or delete
  $cf_keys = array('faq_list');
  foreach ( $cf_keys as $cf_key ) {
    $old = get_post_meta( $post_id, $cf_key, true );

    if ( isset( $_POST[$cf_key] ) && is_array( $_POST[$cf_key] ) ) {
      $new = array_values( $_POST[$cf_key] );
    } else {
      $new = false;
    }

    if ( $new && $new != $old ) {
      update_post_meta( $post_id, $cf_key, $new );
    } elseif ( ! $new && $old ) {
      delete_post_meta( $post_id, $cf_key, $old );
    }
  }

}
add_action('save_post', 'save_page_header_meta_box');



?>