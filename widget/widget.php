<?php

// ウィジェット関連の記述

global $pagenow;
$options = get_design_plus_option();

// スタイルシートの読み込み -----------------------------------------------------------------------
function tcd_widget_styles($pagenow) {
  if ( !is_admin() || ($pagenow != 'widget.php') ) {
  wp_enqueue_style('my_widget_css', get_template_directory_uri() . '/widget/css/style.css','','1.0.0');
  }
}
add_action('admin_print_styles', 'tcd_widget_styles');

// Javascriptの読み込み -----------------------------------------------------------------------
function tcd_widget_scripts($pagenow) {
  if ( !is_admin() || ($pagenow != 'widget.php') ) {
    wp_enqueue_script('my-widget-js', get_template_directory_uri().'/widget/js/script.js', '', '1.0.0', true);
  }
}
add_action('admin_print_scripts', 'tcd_widget_scripts');


// ウィジェットエリアの登録
function tcd_widgets_init() {

  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-ankle' );

  $before_widget = '<div class="widget_content clearfix %2$s" id="%1$s">'."\n";
  $after_widget = "</div>\n";
  $before_title = '<h3 class="widget_headline"><span>';
  $after_title = "</span></h3>";

  register_sidebar(array(
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title,
    'name' => __('Common widget', 'tcd-ankle'),
    'description' => __('Widgets set in this area are displayed as basic widget in the sidebar of all pages. If there are individual settings, the widget will be displayed.', 'tcd-ankle'),
    'id' => 'common_widget'
  ));
  register_sidebar(array(
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title,
    'name' => __('Common widget (smarphone)', 'tcd-ankle'),
    'description' => __('Widgets set in this area are displayed as basic widget in the sidebar of all pages. If there are individual settings, the widget will be displayed.', 'tcd-ankle'),
    'id' => 'common_widget_mobile'
  ));
  register_sidebar(array(
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title,
    'name' => __('Blog page', 'tcd-ankle'),
    'id' => 'single_widget'
  ));
  register_sidebar(array(
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title,
    'name' => __('Blog page (smartphone)', 'tcd-ankle'),
    'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-ankle'),
    'id' => 'single_widget_mobile'
  ));
  register_sidebar(array(
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title,
    'name' => sprintf(__('%s page', 'tcd-ankle'), $news_label),
    'id' => 'news_single_widget'
  ));
  register_sidebar(array(
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title,
    'name' => sprintf(__('%s page (smartphone)', 'tcd-ankle'), $news_label),
    'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-ankle'),
    'id' => 'news_single_widget_mobile'
  ));
  register_sidebar(array(
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title,
    'name' => __('WP Page', 'tcd-ankle'),
    'id' => 'page_widget'
  ));
  register_sidebar(array(
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title,
    'name' => __('WP Page (smartphone)', 'tcd-ankle'),
    'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-ankle'),
    'id' => 'page_widget_mobile'
  ));

}
add_action( 'widgets_init', 'tcd_widgets_init' );


// TCDオリジナルウィジェットの読み込み
get_template_part( 'widget/banner' );
get_template_part( 'widget/post-slider' );
get_template_part( 'widget/styled-post-list' );


// ウィジェットブロックエディターを無効化 --------------------------------------------------------------------------------
function remove_widgets_block_editor_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'remove_widgets_block_editor_support' );

// デフォルト カテゴリーウィジェットのカスタマイズ
function rewrite_categories_widget_count( $output ) {
  $replaced = preg_replace('/<\/a> \(([0-9]*)\)/', ' <span class="count">$1</span></a>', $output);
  if($replaced != NULL) $output = $replaced;
  return $output;
}
add_filter( 'wp_list_categories', 'rewrite_categories_widget_count', 10, 2 );

// デフォルト アーカイブウィジェットのカスタマイズ
function rewrite_archives_widget_count( $output ) {
	$replaced = preg_replace('/<\/a>\s*(&nbsp;)\((\d+)\)/','<span class="count">$2</span></a>',$output);
  if($replaced != NULL) {
    return $replaced;
  } else {
    return $output;
  }
}
add_filter( 'get_archives_link', 'rewrite_archives_widget_count' );

// デフォルト タグクラウドウィジェットのカスタマイズ
function my_widget_tag_cloud_args( $args ) {
  $args['smallest']  = 0.85;
  $args['largest']  = 0.85;
  $args['unit']  = 'em';
  $args['number']  = 0;
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args', 10, 1 );

// デフォルト テキストウィジェットのカスタマイズ
function rewrite_text_widget_count( $text ) {
	return '<div class="post_content clearfix">'.$text.'</div>';
}
add_filter( 'widget_text', 'rewrite_text_widget_count' );

// デフォルトウィジェットのタイトルが存在しない場合に出力しない
function filter_wp_widget_archives_widget_title ( $title, $instance = array(), $id_base = null ) {
  if( empty( $instance['title']) ) $title = '';
	return $title;
}
add_filter( 'widget_title', 'filter_wp_widget_archives_widget_title', 10, 3 );