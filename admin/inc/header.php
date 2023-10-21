<?php
/*
 * ヘッダーの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );


// タブの名前
function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = tcd_admin_label('header');
	return $tab_labels;
}


// 初期値
function add_header_dp_default_options( $dp_default_options ) {

  // ヘッダーバー
  $dp_default_options['header_wishlist_badge_color'] = '#bf9d87';
  $dp_default_options['header_cart_badge_color'] = '#bf9d87';

  // ロゴ
	$dp_default_options['header_logo_type'] = 'type1';
  $dp_default_options['header_logo_font_type'] = 'type3';
	$dp_default_options['header_logo_font_size'] = '36';
	$dp_default_options['header_logo_font_size_sp'] = '24';
	$dp_default_options['header_logo_image'] = false;
	$dp_default_options['header_logo_retina'] = 'yes';
	$dp_default_options['header_logo_image_sp'] = false;
	$dp_default_options['header_logo_retina_sp'] = 'yes';

  // メニュー
  $dp_default_options['drawer_menu_color_type'] = 'light';
  $dp_default_options['drawer_menu_caption'] = '';
  $dp_default_options['drawer_menu_image'] = false;
  $dp_default_options['drawer_menu_image_retina'] = 'yes';

  // メッセージ
	$dp_default_options['show_header_message'] = 1;
	$dp_default_options['header_message'] = __('Header message', 'tcd-ankle');
  $dp_default_options['header_message_url'] = '#';
  $dp_default_options['header_message_font_color'] = '#ffffff';
  $dp_default_options['header_message_bg_color'] = '#bf9d87';


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $logo_type_options, $drawer_menu_color_type_options, $bool_options;

?>

<div id="tab-content-header" class="tab-content">

  <?php // ヘッダーバーの設定 ----------------------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header bar', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
        <p><?php printf(__('On the left side of the header bar, you will see the Site Title and Tagline in the <a href="%s">General Settings</a>.', 'tcd-ankle'), './options-general.php'); ?></br><b><?php _e('In mobile size, the logo setting will be reflected.', 'tcd-ankle'); ?></b></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e('Member menu', 'tcd-ankle'); ?></h4>
      <?php if(is_woocommerce_active()){ ?>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Wishlist badge color', 'tcd-ankle'); ?></span><input type="text" name="dp_options[header_wishlist_badge_color]" value="<?php echo esc_attr( $options['header_wishlist_badge_color'] ); ?>" data-default-color="#bf9d87" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Cart badge color', 'tcd-ankle'); ?></span><input type="text" name="dp_options[header_cart_badge_color]" value="<?php echo esc_attr( $options['header_cart_badge_color'] ); ?>" data-default-color="#bf9d87" class="c-color-picker"></li>
      </ul>
      <?php }else{ ?>
      <div class="theme_option_message2">
        <p><b><?php _e('This feature is available after installing and activating WooCoomerce.', 'tcd-ankle'); ?></b></p>
      </div>
      <?php } ?>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // ヘッダーのロゴの設定 ----------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Logo', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">
      <div class="theme_option_message2">
        <p><?php _e('Select the type of logo you would like to display in the header.', 'tcd-ankle'); ?><br><b><?php _e('In mobile size, the logo will be displayed on the left side of the header bar.', 'tcd-ankle'); ?></b></p>
      </div>
      <?php echo tcd_admin_image_radio_button($options, 'header_logo_type', $logo_type_options) ?>

      <div id="header_logo_type1_area">
        <h4 class="theme_option_headline2"><?php echo tcd_admin_label('text'); ?></h4>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($options, 'header_logo_font_type', $font_type_options); ?></li>
          <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo tcd_font_size_option($options, 'header_logo_font_size'); ?></li>
        </ul>
      </div>

      <div id="header_logo_type2_area">
        <h4 class="theme_option_headline2"><?php _e('Logo image', 'tcd-ankle');  ?></h4>
        <div class="theme_option_message2">
          <p><?php _e('If you have uploaded a logo image for the Retina display, please select "Yes" for the radio button below.','tcd-ankle'); ?></p>
        </div>
        <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Logo image', 'tcd-ankle'); ?></span><?php echo tcd_media_image_uploader($options, 'header_logo_image', 'full'); ?></li>
          <li class="cf"><span class="label"><?php _e('Use retina display logo image', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'header_logo_retina', $bool_options); ?></li>
          <li class="cf"><span class="label"><?php _e('Logo image (mobile)', 'tcd-ankle'); ?></span><?php echo tcd_media_image_uploader($options, 'header_logo_image_sp', 'full'); ?></li>
          <li class="cf"><span class="label"><?php _e('Use retina display logo image', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'header_logo_retina_sp', $bool_options); ?></li>
        </ul>
      </div>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // ドロワーメニューの設定 ----------------------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php echo tcd_admin_label('menu'); ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('The header menu can be set from Appearance > Menus.', 'tcd-ankle'); ?><br><a href="./nav-menus.php"><?php _e('Click here to see the custom menu creation screen.', 'tcd-ankle'); ?></a></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e('Drawer menu', 'tcd-ankle'); ?></h4>
      <div class="theme_option_message2">
        <p><?php _e('The drawer menu can be expanded from the top-right burger menu in mobile size.', 'tcd-ankle'); ?></br><?php _e('Choose a design for your drawer menu.', 'tcd-ankle'); ?></p>
      </div>
      <?php echo tcd_admin_image_radio_button($options, 'drawer_menu_color_type', $drawer_menu_color_type_options) ?>
      <div class="theme_option_message2">
        <p><?php _e('"Caption" and "Image" will be displayed at the top of the drawer menu in mobile size.', 'tcd-ankle'); ?></br><?php _e('Use it to display a single word tagline or a large logo even on mobile devices.', 'tcd-ankle'); ?></p>
      </div>
      <ul class="option_list" style="padding-top:10px;border-top:1px dotted #ddd;">
        <li class="cf"><span class="label"><?php _e('Caption', 'tcd-ankle');  ?></span><input id="dp_options[drawer_menu_caption]" class="full_width" type="text" name="dp_options[drawer_menu_caption]" value="<?php echo esc_attr( $options['drawer_menu_caption'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Image', 'tcd-ankle');  ?></span><?php echo tcd_media_image_uploader($options, 'drawer_menu_image', 'full'); ?></li>
        <li class="cf"><span class="label"><?php _e('Use retina display logo image', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'drawer_menu_image_retina', $bool_options); ?></li>
      </ul>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>

    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // メッセージ ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header message', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
        <p><?php _e('The "header message" is displayed at the top of the site (above the header bar).', 'tcd-ankle'); ?></p>
      </div>

      <input id="show_header_message" class="show_checkbox" name="dp_options[show_header_message]" type="checkbox" value="1" <?php checked( $options['show_header_message'], 1 ); ?>>
      <label for="show_header_message"><?php _e( 'Display header message', 'tcd-ankle' ); ?></label>

      <div class="show_checkbox_area">

        <ul class="option_list" style="border-top: 1px dotted #ddd; padding-top: 10px;">
          <li class="cf"><span class="label"><?php _e('Message', 'tcd-ankle');  ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[header_message]"><?php echo esc_textarea( $options['header_message'] ); ?></textarea></li>
          <li class="cf"><span class="label"><?php _e('URL', 'tcd-ankle');  ?></span><input id="dp_options[header_message_url]" class="full_width" type="text" name="dp_options[header_message_url]" value="<?php echo esc_attr( $options['header_message_url'] ); ?>" /></li>
          <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[header_message_font_color]" value="<?php echo esc_attr( $options['header_message_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
          <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[header_message_bg_color]" value="<?php echo esc_attr( $options['header_message_bg_color'] ); ?>" data-default-color="#bf9d87" class="c-color-picker"></li>
        </ul>

      </div>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>

    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_header_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $logo_type_options, $drawer_menu_color_type_options, $bool_options;

  // ヘッダーバー
  $input['header_wishlist_badge_color'] = sanitize_hex_color( $input['header_wishlist_badge_color'] );
  $input['header_cart_badge_color'] = sanitize_hex_color( $input['header_cart_badge_color'] );

  // ヘッダーロゴ
  if ( ! isset( $input['header_logo_type'] ) )
    $input['header_logo_type'] = null;
  if ( ! array_key_exists( $input['header_logo_type'], $logo_type_options ) )
    $input['header_logo_type'] = null;
  $input['header_logo_font_size'] = wp_filter_nohtml_kses( $input['header_logo_font_size'] );
  $input['header_logo_font_size_sp'] = wp_filter_nohtml_kses( $input['header_logo_font_size_sp'] );
  if ( ! isset( $input['header_logo_font_type'] ) )
    $input['header_logo_font_type'] = null;
  if ( ! array_key_exists( $input['header_logo_font_type'], $font_type_options ) )
    $input['header_logo_font_type'] = null;
  $input['header_logo_image'] = absint( $input['header_logo_image'] );

  if ( ! isset( $input['header_logo_retina'] ) )
    $input['header_logo_retina'] = null;
  if ( ! array_key_exists( $input['header_logo_retina'], $bool_options ) )
    $input['header_logo_retina'] = null;

  $input['header_logo_image_sp'] = absint( $input['header_logo_image_sp'] );

  if ( ! isset( $input['header_logo_retina_sp'] ) )
    $input['header_logo_retina_sp'] = null;
  if ( ! array_key_exists( $input['header_logo_retina_sp'], $bool_options ) )
    $input['header_logo_retina_sp'] = null;

  // メニュー
  if ( ! isset( $input['drawer_menu_color_type'] ) )
    $input['drawer_menu_color_type'] = null;
  if ( ! array_key_exists( $input['drawer_menu_color_type'], $drawer_menu_color_type_options ) )
    $input['drawer_menu_color_type'] = null;

  $input['drawer_menu_caption'] = wp_filter_nohtml_kses( $input['drawer_menu_caption'] );
  $input['drawer_menu_image'] = absint( $input['drawer_menu_image'] );
  if ( ! isset( $input['drawer_menu_image_retina'] ) )
    $input['drawer_menu_image_retina'] = null;
  if ( ! array_key_exists( $input['drawer_menu_image_retina'], $bool_options ) )
    $input['drawer_menu_image_retina'] = null;


  // メッセージ
  $input['show_header_message'] = ! empty( $input['show_header_message'] ) ? 1 : 0;
  $input['header_message'] = wp_filter_nohtml_kses( $input['header_message'] );
  $input['header_message_url'] = wp_filter_nohtml_kses( $input['header_message_url'] );
  $input['header_message_font_color'] = sanitize_hex_color( $input['header_message_font_color'] );
  $input['header_message_bg_color'] = sanitize_hex_color( $input['header_message_bg_color'] );
  
  return $input;

};


?>