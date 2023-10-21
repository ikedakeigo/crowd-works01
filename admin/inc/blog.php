<?php
/*
 * ブログの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );


//  Add label of blog tab
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );


// Add HTML of blog tab
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );


// タブの名前
function add_blog_tab_label( $tab_labels ) {
	$tab_labels['blog'] = tcd_admin_label('blog');
	return $tab_labels;
}


// 初期値
function add_blog_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['blog_label'] = tcd_admin_label('blog');
	$dp_default_options['blog_no_image'] = false;

	// アーカイブページ
  $dp_default_options['blog_archive_headline'] = 'BLOG';
	$dp_default_options['blog_archive_sub_headline'] = tcd_admin_label('blog');
	$dp_default_options['blog_archive_desc'] = '';
  $dp_default_options['blog_archive_num'] = '6';
	$dp_default_options['blog_archive_num_sp'] = '4';
	$dp_default_options['blog_archive_title_font_size'] = '18';
	$dp_default_options['blog_archive_title_font_size_sp'] = '16';

	// 記事ページ
	$dp_default_options['blog_single_title_font_size'] = '28';
	$dp_default_options['blog_single_title_font_size_sp'] = '20';

	$dp_default_options['blog_single_show_sns_top'] = 'hide';
	$dp_default_options['blog_single_show_sns_btm'] = 'display';
	$dp_default_options['blog_single_show_copy_top'] = 'display';

	$dp_default_options['blog_single_show_meta_category'] = 'display';
	$dp_default_options['blog_single_show_meta_tag'] = 'display';
	$dp_default_options['blog_single_show_meta_author'] = 'display';

	// 関連記事
	$dp_default_options['show_related_post'] = 1;
	$dp_default_options['related_post_headline'] = tcd_admin_label('related_post');
	$dp_default_options['related_post_num'] = '6';
	$dp_default_options['related_post_num_sp'] = '4';
	$dp_default_options['related_post_title_font_size'] = '14';
	$dp_default_options['related_post_title_font_size_sp'] = '14';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_tab_panel( $options ) {

  global $dp_default_options, $basic_display_options;

?>
<div id="tab-content-blog" class="tab-content">

  <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php echo tcd_admin_label('common'); ?></h3>
    <div class="theme_option_field_ac_content">
      
      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('content_name'); ?></h4>
      <div class="theme_option_message2"><p><?php echo tcd_admin_label('use_breadcrumb'); ?></p></div>
      <input class="full_width" type="text" name="dp_options[blog_label]" value="<?php echo esc_attr($options['blog_label']); ?>" />

      <?php // 代替画像 ------------------------ ?>
      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('no_image'); ?></h4>
      <div class="theme_option_message2">
        <p><?php echo tcd_admin_label('no_image_desc'); ?><br><?php echo tcd_admin_label('no_image_desc2'); ?></p>
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '720', '495'); ?></p>
      </div>
      <?php echo tcd_media_image_uploader($options, 'blog_no_image', 'medium'); ?>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // アーカイブページ ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php echo tcd_admin_label('archive_page'); ?></h3>
    <div class="theme_option_field_ac_content">

      <?php $home_page_id = get_option( 'page_for_posts' ); ?>
      <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('Settings for the post archive page.', 'tcd-ankle'); ?></p>
        <?php
            if($home_page_id) {
              $home_page_url = get_page_link( $home_page_id );
              if($home_page_url){
        ?>
        <p><?php _e('URL of the post archive page:', 'tcd-ankle'); ?><a class="e_link" href="<?php echo esc_url($home_page_url) ?>"><?php echo esc_url($home_page_url) ?></a></p>
        <?php
              };
            } else {
        ?>
        <p><?php _e('The page for the post archive page is not set.', 'tcd-ankle'); ?>
        <?php _e('Please refer to the <a href="https://dl.tcd-theme.com/tcd092/display-setting/">manual</a> to create and configure.', 'tcd-ankle'); ?></p>
        <?php } ?>
      </div>

      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('header'); ?></h4>
			<ul class="option_list">
				<li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[blog_archive_headline]"><?php echo esc_textarea( $options['blog_archive_headline'] ); ?></textarea></li>
				<li class="cf"><span class="label"><?php echo tcd_admin_label('sub_headline'); ?></span><textarea class="full_width" cols="50" rows="1" name="dp_options[blog_archive_sub_headline]"><?php echo esc_textarea( $options['blog_archive_sub_headline'] ); ?></textarea></li>
				<li class="cf"><span class="label"><?php echo tcd_admin_label('desc'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[blog_archive_desc]"><?php echo esc_textarea( $options['blog_archive_desc'] ); ?></textarea></li>
      </ul>

      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('article_list'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option('blog_archive_num', array(4,12,2), array(4,10,2)); ?></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size_title'); ?></span><?php echo tcd_font_size_option($options, 'blog_archive_title_font_size') ?></li>
      </ul>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // 詳細ページの設定 -------------------------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Blog article', 'tcd-ankle');  ?></h3>
    <div class="theme_option_field_ac_content">

      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('article_title_area'); ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size_title'); ?></span><?php echo tcd_font_size_option($options, 'blog_single_title_font_size') ?></li>
      </ul>

      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('display_setting'); ?></h4>
      <div class="theme_option_message2">
        <p><?php _e('You can set share button design from basic setting menu in theme option page.', 'tcd-ankle');  ?></p>
      </div>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Social button (above post content)', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'blog_single_show_sns_top', $basic_display_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Social button (under post content)', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'blog_single_show_sns_btm', $basic_display_options); ?></li>
        <li class="cf"><span class="label"><?php _e('"COPY Title&amp;URL" above post content', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'blog_single_show_copy_top', $basic_display_options); ?></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Meta box', 'tcd-ankle');  ?></h4>
      <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Author', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'blog_single_show_meta_author', $basic_display_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Categories', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'blog_single_show_meta_category', $basic_display_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Tags', 'tcd-ankle');  ?></span><?php echo tcd_basic_radio_button($options, 'blog_single_show_meta_tag', $basic_display_options); ?></li>
      </ul>

      <?php // 関連記事 ----------------------------- ?>
      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('related_post');  ?></h4>
      <input id="show_related_post" class="show_checkbox" name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( $options['show_related_post'], 1 ); ?>>
      <label for="show_related_post"><?php _e( 'Display related post', 'tcd-ankle' ); ?></label>
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('headline'); ?></span><input type="text" class="full_width" name="dp_options[related_post_headline]" value="<?php echo esc_attr($options['related_post_headline']); ?>"></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option('related_post_num', array(3,9,3), array(2,10,2)); ?></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size_title'); ?></span><?php echo tcd_font_size_option($options, 'related_post_title_font_size') ?></li>
      </ul>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>
    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->




</div><!-- END .tab-content -->

<?php
} // END add_blog_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_theme_options_validate( $input ) {

  global $dp_default_options, $basic_display_options;

  // 基本設定
  $input['blog_label'] = wp_filter_nohtml_kses( $input['blog_label'] );
  $input['blog_no_image'] = absint( $input['blog_no_image'] );

  // アーカイブ
	$input['blog_archive_headline'] = wp_filter_nohtml_kses( $input['blog_archive_headline'] );
	$input['blog_archive_sub_headline'] = wp_filter_nohtml_kses( $input['blog_archive_sub_headline'] );
	$input['blog_archive_desc'] = wp_filter_nohtml_kses( $input['blog_archive_desc'] );


  // アーカイブ
  $input['blog_archive_num'] = absint( $input['blog_archive_num'] );
  $input['blog_archive_num_sp'] = absint( $input['blog_archive_num_sp'] );
  $input['blog_archive_title_font_size'] = absint( $input['blog_archive_title_font_size'] );
  $input['blog_archive_title_font_size_sp'] = absint( $input['blog_archive_title_font_size_sp'] );


  // 記事ページ
  $input['blog_single_title_font_size'] = absint( $input['blog_single_title_font_size'] );
  $input['blog_single_title_font_size_sp'] = absint( $input['blog_single_title_font_size_sp'] );

  if ( ! isset( $input['blog_single_show_sns_top'] ) || ! array_key_exists( $input['blog_single_show_sns_top'], $basic_display_options ) )
    $input['blog_single_show_sns_top'] = $dp_default_options['blog_single_show_sns_top'];
  if ( ! isset( $input['blog_single_show_sns_btm'] ) || ! array_key_exists( $input['blog_single_show_sns_btm'], $basic_display_options ) )
    $input['blog_single_show_sns_btm'] = $dp_default_options['blog_single_show_sns_btm'];
  if ( ! isset( $input['blog_single_show_copy_top'] ) || ! array_key_exists( $input['blog_single_show_copy_top'], $basic_display_options ) )
    $input['blog_single_show_copy_top'] = $dp_default_options['blog_single_show_copy_top'];

  if ( ! isset( $input['blog_single_show_meta_category'] ) || ! array_key_exists( $input['blog_single_show_meta_category'], $basic_display_options ) )
    $input['blog_single_show_meta_category'] = $dp_default_options['blog_single_show_meta_category'];
  if ( ! isset( $input['blog_single_show_meta_tag'] ) || ! array_key_exists( $input['blog_single_show_meta_tag'], $basic_display_options ) )
    $input['blog_single_show_meta_tag'] = $dp_default_options['blog_single_show_meta_tag'];
  if ( ! isset( $input['blog_single_show_meta_author'] ) || ! array_key_exists( $input['blog_single_show_meta_author'], $basic_display_options ) )
    $input['blog_single_show_meta_author'] = $dp_default_options['blog_single_show_meta_author'];

  // 関連記事
  $input['show_related_post'] = ! empty( $input['show_related_post'] ) ? 1 : 0;
  $input['related_post_headline'] = wp_filter_nohtml_kses( $input['related_post_headline'] );
  $input['related_post_num'] = absint( $input['related_post_num'] );
  $input['related_post_num_sp'] = absint( $input['related_post_num_sp'] );
  $input['related_post_title_font_size'] = absint( $input['related_post_title_font_size'] );
  $input['related_post_title_font_size_sp'] = absint( $input['related_post_title_font_size_sp'] );

	return $input;

};


?>