<?php
/*
 * お知らせの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_news_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );


// タブの名前
function add_news_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-ankle' );
  $tab_labels['news'] = $tab_label;
  return $tab_labels;
}

// 初期値
function add_news_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['news_label'] = __( 'News', 'tcd-ankle' );
	$dp_default_options['news_slug'] = 'news';
	$dp_default_options['news_no_image'] = false;

  // アーカイブ
	$dp_default_options['news_archive_headline'] = 'NEWS';
	$dp_default_options['news_archive_sub_headline'] = __( 'News', 'tcd-ankle' );
	$dp_default_options['news_archive_desc'] = '';
	$dp_default_options['news_archive_num'] = 5;
	$dp_default_options['news_archive_num_sp'] = 3;
  $dp_default_options['news_archive_title_font_size'] = 20;
	$dp_default_options['news_archive_title_font_size_sp'] = 16;
  $dp_default_options['news_archive_display_thumbnail'] = 'display';

	// 詳細ページ
	$dp_default_options['news_single_title_font_size'] = '24';
	$dp_default_options['news_single_title_font_size_sp'] = '18';
	$dp_default_options['news_single_show_sns_top'] = 'display';
	$dp_default_options['news_single_show_sns_btm'] = 'hide';
	$dp_default_options['news_single_show_copy_top'] = 'hide';

	// 最新のお知らせ一覧
	$dp_default_options['show_recent_news'] = 1;
	$dp_default_options['recent_news_headline'] = __( 'Latest news', 'tcd-ankle' );
	$dp_default_options['recent_news_num'] = '3';
	$dp_default_options['recent_news_num_sp'] = '3';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_tab_panel( $options ) {

  global $dp_default_options, $basic_display_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-ankle' );

?>

<div id="tab-content-news" class="tab-content">


  <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php echo tcd_admin_label('common'); ?></h3>
    <div class="theme_option_field_ac_content">

      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('content_name'); ?></h4>
      <div class="theme_option_message2"><p><?php echo tcd_admin_label('use_breadcrumb'); ?></p></div>
      <input id="dp_options[news_label]" class="regular-text" type="text" name="dp_options[news_label]" value="<?php echo esc_attr( $options['news_label'] ); ?>" />

      <h4 class="theme_option_headline2"><?php _e('Slug', 'tcd-ankle');  ?></h4>
      <div class="theme_option_message2">
        <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-ankle'); ?></p>
      </div>
      <p><input id="dp_options[news_slug]" class="hankaku regular-text" type="text" name="dp_options[news_slug]" value="<?php echo sanitize_title( $options['news_slug'] ); ?>" /></p>

      <?php // 代替画像 ------------------------ ?>
      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('no_image'); ?></h4>
      <div class="theme_option_message2">
        <p><?php echo tcd_admin_label('no_image_desc'); ?><br><?php echo tcd_admin_label('no_image_desc2'); ?></p>
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '480', '330'); ?></p>
      </div>
      <?php echo tcd_media_image_uploader($options, 'news_no_image', 'medium'); ?>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // アーカイブページ ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php echo tcd_admin_label('archive_page'); ?></h3>
    <div class="theme_option_field_ac_content">
      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('header'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[news_archive_headline]"><?php echo esc_textarea( $options['news_archive_headline'] ); ?></textarea></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('sub_headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[news_archive_sub_headline]"><?php echo esc_textarea( $options['news_archive_sub_headline'] ); ?></textarea></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[news_archive_desc]"><?php echo esc_textarea( $options['news_archive_desc'] ); ?></textarea></li>
      </ul>
      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('article_list'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option('news_archive_num', array(3,10,1), array(3,10,1)); ?></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size_title'); ?></span><?php echo tcd_font_size_option($options, 'news_archive_title_font_size') ?></li>
        <li class="cf"><span class="label"><?php _e('Featured Image', 'tcd-ankle'); ?></span><?php echo tcd_basic_radio_button($options, 'news_archive_display_thumbnail', $basic_display_options); ?></li>
      </ul>
      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>

    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // 詳細ページの設定 ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s article', 'tcd-ankle'), $news_label); ?></h3>
    <div class="theme_option_field_ac_content">

      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('article_title_area'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size_title'); ?></span><?php echo tcd_font_size_option($options, 'news_single_title_font_size') ?></li>
      </ul>

      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('display_setting'); ?></h4>
      <div class="theme_option_message2">
        <p><?php _e('You can set share button design from basic setting menu in theme option page.', 'tcd-ankle');  ?></p>
      </div>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Social button (above post content)', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'news_single_show_sns_top', $basic_display_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Social button (under post content)', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'news_single_show_sns_btm', $basic_display_options); ?></li>
        <li class="cf"><span class="label"><?php _e('"COPY Title&amp;URL" above post content', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'news_single_show_copy_top', $basic_display_options); ?></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Recent articles', 'tcd-ankle'); ?></h4>
      <input id="show_recent_news" class="show_checkbox" name="dp_options[show_recent_news]" type="checkbox" value="1" <?php checked( $options['show_recent_news'], 1 ); ?>>
      <label for="show_recent_news"><?php _e( 'Display recent articles', 'tcd-ankle' ); ?></label>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><input type="text" class="full_width" name="dp_options[recent_news_headline]" value="<?php echo esc_textarea(  $options['recent_news_headline'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option('recent_news_num', array(3,10,1), array(3,10,1)); ?></li>
      </ul>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_news_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_theme_options_validate( $input ) {

  global $dp_default_options, $basic_display_options;

  //基本設定
  $input['news_slug'] = sanitize_title( $input['news_slug'] );
  $input['news_label'] = wp_filter_nohtml_kses( $input['news_label'] );
  $input['news_no_image'] = absint( $input['news_no_image'] );

  // アーカイブ
	$input['news_archive_headline'] = wp_filter_nohtml_kses( $input['news_archive_headline'] );
	$input['news_archive_sub_headline'] = wp_filter_nohtml_kses( $input['news_archive_sub_headline'] );
	$input['news_archive_desc'] = wp_filter_nohtml_kses( $input['news_archive_desc'] );
	// アーカイブその他の設定
	$input['news_archive_title_font_size'] = absint( $input['news_archive_title_font_size'] );
	$input['news_archive_title_font_size_sp'] = absint( $input['news_archive_title_font_size_sp'] );
	$input['news_archive_num'] = absint( $input['news_archive_num'] );
	$input['news_archive_num_sp'] = absint( $input['news_archive_num_sp'] );
  if ( ! isset( $input['news_archive_display_thumbnail'] ) || ! array_key_exists( $input['news_archive_display_thumbnail'], $basic_display_options ) )
    $input['news_archive_display_thumbnail'] = $dp_default_options['news_archive_display_thumbnail'];

  //詳細ページ
  $input['news_single_title_font_size'] = absint( $input['news_single_title_font_size'] );
  $input['news_single_title_font_size_sp'] = absint( $input['news_single_title_font_size_sp'] );

  if ( ! isset( $input['news_single_show_sns_top'] ) || ! array_key_exists( $input['news_single_show_sns_top'], $basic_display_options ) )
    $input['news_single_show_sns_top'] = $dp_default_options['news_single_show_sns_top'];
  if ( ! isset( $input['news_single_show_sns_btm'] ) || ! array_key_exists( $input['news_single_show_sns_btm'], $basic_display_options ) )
    $input['news_single_show_sns_btm'] = $dp_default_options['news_single_show_sns_btm'];
  if ( ! isset( $input['news_single_show_copy_top'] ) || ! array_key_exists( $input['news_single_show_copy_top'], $basic_display_options ) )
    $input['news_single_show_copy_top'] = $dp_default_options['news_single_show_copy_top'];

  // 最新お知らせ一覧
  $input['show_recent_news'] = ! empty( $input['show_recent_news'] ) ? 1 : 0;
  $input['recent_news_headline'] = wp_filter_nohtml_kses( $input['recent_news_headline'] );
  $input['recent_news_num'] = absint( $input['recent_news_num'] );
  $input['recent_news_num_sp'] = absint( $input['recent_news_num_sp'] );

	return $input;

};


?>