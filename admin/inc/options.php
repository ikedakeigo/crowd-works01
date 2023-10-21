<?php
/*
 * オプションの設定
 */


 //フォントタイプ
global $font_type_options;
$font_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Meiryo', 'tcd-ankle' ),'label_en' => 'Arial'),
  'type2' => array('value' => 'type2','label' => __( 'YuGothic', 'tcd-ankle' ),'label_en' => 'San Serif'),
  'type3' => array('value' => 'type3','label' => __( 'YuMincho', 'tcd-ankle' ),'label_en' => 'Times New Roman')
);
// ロケール情報がJA以外の場合に配列のラベルを書き換える
foreach ( $font_type_options as &$option ) {
  if(strtoupper(get_locale()) != 'JA') $option['label'] = $option['label_en'];
}

// コンテンツの方向
global $content_direction_options;
$content_direction_options = array(
	'type1' => array('value' => 'type1', 'label' => __( 'Align left', 'tcd-ankle' )),
	'type2' => array('value' => 'type2', 'label' => __( 'Align center', 'tcd-ankle' )),
	'type3' => array('value' => 'type3', 'label' => __( 'Align right', 'tcd-ankle' ))
);

// テキストの方向
global $text_align_options;
$text_align_options = array(
	'left' => array('value' => 'left', 'label' => __( 'Align left', 'tcd-ankle' )),
	'center' => array('value' => 'center', 'label' => __( 'Align center', 'tcd-ankle' )),
);

// コンテンツの横幅
global $content_width_options;
$content_width_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Main content width', 'tcd-ankle' )),
  'type2' => array('value' => 'type2','label' => __( 'Window width', 'tcd-ankle' ))
);

global $basic_display_options;
$basic_display_options = array(
	'display' => array(
		'value' => 'display',
		'label' => __( 'Display', 'tcd-ankle' ),
	),
	'hide' => array(
		'value' => 'hide',
		'label' => __( 'Hide', 'tcd-ankle' ),
	)
);



/*
 * 基本設定
 */

// hover effect
global $hover_type_options;
$hover_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Zoom in', 'tcd-ankle' )),
  'type2' => array('value' => 'type2','label' => __( 'Zoom out', 'tcd-ankle' )),
  'type3' => array('value' => 'type3','label' => __( 'Slide', 'tcd-ankle' )),
  'type4' => array('value' => 'type4','label' => __( 'Fade', 'tcd-ankle' )),
  'type5' => array('value' => 'type5','label' => __( 'No animation', 'tcd-ankle' ))
);
global $hover3_direct_options;
$hover3_direct_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Left to Right', 'tcd-ankle' )),
  'type2' => array('value' => 'type2','label' => __( 'Right to Left', 'tcd-ankle' ))
);

// ソーシャルボタンの設定
global $sns_type_options;
$sns_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Type1 (color)', 'tcd-ankle' ), 'img' => 'share_type1.jpg'),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Type2 (mono)', 'tcd-ankle' ), 'img' => 'share_type2.jpg'),
  'type3' => array( 'value' => 'type3', 'label' => __( 'Type3 (4 column - color)', 'tcd-ankle' ), 'img' => 'share_type3.jpg'),
  'type4' => array( 'value' => 'type4', 'label' => __( 'Type4 (4 column - mono)', 'tcd-ankle' ), 'img' => 'share_type4.jpg'),
  'type5' => array( 'value' => 'type5', 'label' => __( 'Type5 (official design)', 'tcd-ankle' ), 'img' => 'share_type5.jpg')
);

// ローディングアイコンのタイプ
global $loading_type;
$loading_type = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Circle icon', 'tcd-ankle' ),
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Square icon', 'tcd-ankle' ),
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Dot circle icon', 'tcd-ankle' ),
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Logo', 'tcd-ankle' ),
	),
	'type5' => array(
		'value' => 'type5',
		'label' => __( 'Catchphrase', 'tcd-ankle' ),
	)
);

// ロード画面の表示タイプ
global $loading_display_page_options;
$loading_display_page_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Front page', 'tcd-ankle' )),
	'type2' => array('value' => 'type2','label' => __( 'All pages', 'tcd-ankle' ))
);

// ロード画面の表示回数
global $loading_display_time_options;
$loading_display_time_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Only once', 'tcd-ankle' )),
 'type2' => array('value' => 'type2','label' => __( 'Every time', 'tcd-ankle' ))
);

// ロゴに画像を使うか否か
global $loading_screen_type_options;
$loading_screen_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Simple', 'tcd-ankle' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Splash', 'tcd-ankle' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type2.jpg'
  )
);




/*
 * トップページ
 */

// アイテムのタイプ
global $item_type_options;
$item_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Image', 'tcd-ankle' )),
  'type2' => array('value' => 'type2','label' => __( 'Video', 'tcd-ankle' )),
  'type3' => array('value' => 'type3','label' => __( 'YouTube', 'tcd-ankle' )),
);

// 背景アニメーション
global $slider_bg_animation_options;
$slider_bg_animation_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Zoom in', 'tcd-ankle' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Zoom out', 'tcd-ankle' )
  ),
  'type3' => array(
		'value' => 'type3',
		'label' => __( 'Not use', 'tcd-ankle' )
	)
);

// コンテンツアニメーション
global $slider_content_animation_options;
$slider_content_animation_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Fade In', 'tcd-ankle' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Slide In', 'tcd-ankle' )
  ),
  'type3' => array(
		'value' => 'type3',
		'label' => __( 'Not use', 'tcd-ankle' )
	)
);

// スライダーやロードアイコンで使用
global $time_options;
$time_options = array(
  '1000' => array('value' => '1000','label' => sprintf(__('%s second', 'tcd-ankle'), 1)),
  '2000' => array('value' => '2000','label' => sprintf(__('%s second', 'tcd-ankle'), 2)),
  '3000' => array('value' => '3000','label' => sprintf(__('%s second', 'tcd-ankle'), 3)),
  '4000' => array('value' => '4000','label' => sprintf(__('%s second', 'tcd-ankle'), 4)),
  '5000' => array('value' => '5000','label' => sprintf(__('%s second', 'tcd-ankle'), 5)),
  '6000' => array('value' => '6000','label' => sprintf(__('%s second', 'tcd-ankle'), 6))
);

// ニュースティッカー
global $news_ticker_order_options;
$news_ticker_order_options = array(
	'date' => array(
		'value' => 'date',
		'label' =>  __('Date', 'tcd-ankle')
	),
	'rand' => array(
		'value' => 'rand',
		'label' => __('Random', 'tcd-ankle')
  )
);

// フリースペースの余白
global $content_padding_options;
$content_padding_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' =>  __('Leave', 'tcd-ankle')
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __('Eliminate', 'tcd-ankle')
  )
);

// トップページのボタンタイプ
global $front_page_button_type;
$front_page_button_type = array(
  'button1' => array(
    'value' => 'button1',
    'label' => __( 'Button', 'tcd-ankle' ).'1'
  ),
  'button2' => array(
    'value' => 'button2',
    'label' => __( 'Button', 'tcd-ankle' ).'2'
  ),
  'button3' => array(
    'value' => 'button3',
    'label' => __( 'Button', 'tcd-ankle' ).'3'
  )
);



/*
 * 商品
 */

// 記号のタイプ
global $currency_symbol_options;
$currency_symbol_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => '&yen;'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'yen', 'tcd-ankle' )
  )
);

// アーカイブの読み込み
global $product_archive_display_type_options;
$product_archive_display_type_options = array(
  'async' => array(
    'value' => 'async',
    'label' => __( 'Load asynchronously', 'tcd-ankle' ),
    'image' => get_template_directory_uri() . '/admin/img/product_archive_display_type1.jpg'
  ),
  'pagination' => array(
    'value' => 'pagination',
    'label' => __( 'Use pagination', 'tcd-ankle' ),
    'image' => get_template_directory_uri() . '/admin/img/product_archive_display_type2.jpg'
  )
);

// タブのラベルの表示位置
global $wc_tabs_priority_options;
$wc_tabs_priority_options = array(
  'description' => array(
    'value' => 'description',
    'label' => __( 'Description tab', 'tcd-ankle' )
  ),
  'additional_information' => array(
    'value' => 'additional_information',
    'label' => __( 'Additional information tab', 'tcd-ankle' )
	),
	'reviews' => array(
    'value' => 'reviews',
    'label' => __( 'Reviews tab', 'tcd-ankle' )
  )
);



/*
 * ヘッダー
 */

// ロゴに画像を使うか否か
global $logo_type_options;
$logo_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Use text for logo', 'tcd-ankle' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Use image for logo', 'tcd-ankle' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type2.jpg'
  )
);

// ドロワーメニュー
global $drawer_menu_color_type_options;
$drawer_menu_color_type_options = array(
	'dark' => array(
		'value' => 'dark',
		'label' => __( 'Dark color', 'tcd-ankle' ),
		'image' => get_template_directory_uri() . '/admin/img/drawer_menu_color_type1.jpg'
	),
	'light' => array(
		'value' => 'light',
		'label' => __( 'Light color', 'tcd-ankle' ),
		'image' => get_template_directory_uri() . '/admin/img/drawer_menu_color_type2.jpg'
	)
);



/*
 * フッター
 */

// フッターの固定メニュー 表示タイプ
global $footer_bar_display_options;
$footer_bar_display_options = array(
	'type1' => array('value' => 'type1', 'label' => __( 'Fade In', 'tcd-ankle' )),
	'type2' => array('value' => 'type2', 'label' => __( 'Slide In', 'tcd-ankle' )),
	'type3' => array('value' => 'type3', 'label' => __( 'Hide', 'tcd-ankle' ))
);

// フッターの固定メニュー ボタンのタイプ
global $footer_bar_button_options;
$footer_bar_button_options = array(
  'type1' => array('value' => 'type1', 'label' => __( 'Default', 'tcd-ankle' )),
  'type2' => array('value' => 'type2', 'label' => __( 'Share', 'tcd-ankle' )),
  'type3' => array('value' => 'type3', 'label' => __( 'Telephone', 'tcd-ankle' ))
);

// フッターの固定メニューのアイコン
global $footer_bar_icon_options;
$footer_bar_icon_options = array(
  'twitter' => array('value' => 'twitter'),
  'facebook' => array('value' => 'facebook'),
  'instagram' => array('value' => 'instagram'),
  'youtube' => array('value' => 'youtube'),
  'line' => array('value' => 'line'),
  'heart' => array('value' => 'heart'),
  'star1' => array('value' => 'star1'),
  'list2' => array('value' => 'list2'),
  'fire' => array('value' => 'fire'),
  'bubble' => array('value' => 'bubble'),
  'bell' => array('value' => 'bell'),
  'cart' => array('value' => 'cart'),
  'user' => array('value' => 'user'),
  'map' => array('value' => 'map'),
  'film' => array('value' => 'film'),
  'camera' => array('value' => 'camera'),
  'news' => array('value' => 'news'),
  'office' => array('value' => 'office'),
  'home' => array('value' => 'home'),
  'help' => array('value' => 'help'),
  'light' => array('value' => 'light'),
  'menu' => array('value' => 'menu'),
  'grid' => array('value' => 'grid'),
  'search' => array('value' => 'search'),
  'tel' => array('value' => 'tel'),
  'calendar' => array('value' => 'calendar'),
  'mail' => array('value' => 'mail'),
  'pdf' => array('value' => 'pdf'),
  'pencil' => array('value' => 'pencil'),
  'clock' => array('value' => 'clock'),
);



/*
 * クイックタグ
 */

// 見出し
global $font_weight_options;
$font_weight_options = array(
	'400' => array('value' => '400','label' => __( 'Normal', 'tcd-ankle' )),
	'600' => array('value' => '600','label' => __( 'Bold', 'tcd-ankle' ))
);
global $border_potition_options;
$border_potition_options = array(
	'left' => array('value' => 'left','label' => __( 'Left', 'tcd-ankle' )),
	'top' => array('value' => 'top','label' => __( 'Top', 'tcd-ankle' )),
	'bottom' => array('value' => 'bottom','label' => __( 'Bottom', 'tcd-ankle' )),
	'right' => array('value' => 'right','label' => __( 'Right', 'tcd-ankle' ))
);
global $border_style_options;
$border_style_options = array(
	'solid' => array('value' => 'solid','label' => __( 'Solid', 'tcd-ankle' )),
	'dotted' => array('value' => 'dotted','label' => __( 'Dot', 'tcd-ankle' )),
	'double' => array('value' => 'double','label' => __( 'Double', 'tcd-ankle' ))
);

// ボタン（トップページでも使用）
global $button_type_options;
$button_type_options = array(
	'type1' => array('value' => 'type1','label' => __( 'General', 'tcd-ankle' )),
	'type2' => array('value' => 'type2','label' => __( 'Ghost', 'tcd-ankle' )),
	'type3' => array('value' => 'type3','label' => __( 'Reverse', 'tcd-ankle' ))
);
global $button_border_radius_options;
$button_border_radius_options = array(
	'flat' => array('value' => 'flat','label' => __( 'Square', 'tcd-ankle' )),
	'rounded' => array('value' => 'rounded','label' => __( 'Rounded', 'tcd-ankle' )),
	'oval' => array('value' => 'oval','label' => __( 'Pill', 'tcd-ankle' ))
);
global $button_size_options;
$button_size_options = array(
	'small' => array('value' => 'small','label' => __( 'Small', 'tcd-ankle' )),
	'medium' => array('value' => 'medium','label' => __( 'Medium', 'tcd-ankle' )),
	'large' => array('value' => 'large','label' => __( 'Large', 'tcd-ankle' ))
);
global $button_animation_options;
$button_animation_options = array(
	'animation_type1' => array('value' => 'animation_type1','label' => __( 'Fade', 'tcd-ankle' )),
	'animation_type2' => array('value' => 'animation_type2','label' => __( 'Swipe', 'tcd-ankle' )),
	'animation_type3' => array('value' => 'animation_type3','label' => __( 'Diagonal swipe', 'tcd-ankle' ))
);

// アンダーライン
global $bool_options;
$bool_options = array(
	'yes' => array('value' => 'yes','label' => __( 'Yes', 'tcd-ankle' )),
	'no' => array('value' => 'no','label' => __( 'No', 'tcd-ankle' ))
);

// Google Map
global $google_map_design_options;
$google_map_design_options = array(
	'default' => array('value' => 'default','label' => __( 'Default', 'tcd-ankle' )),
	'monochrome' => array('value' => 'monochrome','label' => __( 'Monochrome', 'tcd-ankle' ))
);
global $google_map_marker_options;
$google_map_marker_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Default', 'tcd-ankle' )),
	'type2' => array('value' => 'type2','label' => __( 'Text', 'tcd-ankle' )),
	'type3' => array('value' => 'type3','label' => __( 'Image', 'tcd-ankle' ))
);



/*
 * マーケティング
 */

// 記事下CTAのタイプ
global $cta_type_options;
$cta_type_options = array(
	'type1' => array( 
		'value' => 'type1', 
		'label' => __( 'Type1', 'tcd-ankle' )
	),
	'type2' => array( 
		'value' => 'type2', 
		'label' => __( 'Type2', 'tcd-ankle' )
	),
	'type3' => array( 
		'value' => 'type3', 
		'label' => __( 'Type3', 'tcd-ankle' ),
	)
);

// 表示するCTAのセレクトボックス（記事下・フッター兼用）
global $cta_display_options;
$cta_display_options = array(
	1 => array( 
		'value' => 1, 
		'label' => 'CTA-A'
	),
	2 => array( 
		'value' => 2, 
		'label' => 'CTA-B'
	),
	3 => array( 
		'value' => 3, 
		'label' => 'CTA-C'
	),
	4 => array(
		'value' => 4,
		'label' => __( 'Random display', 'tcd-ankle' )
	),
	5 => array(
		'value' => 5,
		'label' => __( 'Hidden', 'tcd-ankle' )
	)
);


/*
 * 固定ページ
 */

// コンテンツの横幅
global $page_content_width_options;
$page_content_width_options = array(
	'narrow' => array(
		'value' => 'narrow',
		'label' => __( 'Narrow', 'tcd-ankle' ),
	),
  'normal' => array(
		'value' => 'normal',
		'label' => __( 'Normal', 'tcd-ankle' ),
	),
	'wide' => array(
		'value' => 'wide',
		'label' => __( 'Wide', 'tcd-ankle' ),
	)
);

// ヘッダータイプ
global $page_header_type_options;
$page_header_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Hide header image', 'tcd-ankle' ),
		'image' => get_template_directory_uri() . '/admin/img/page_header_type1.jpg'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Display at normal height', 'tcd-ankle' ),
		'image' => get_template_directory_uri() . '/admin/img/page_header_type2.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Full screen display', 'tcd-ankle' ),
		'image' => get_template_directory_uri() . '/admin/img/page_header_type3.jpg'
	)
);


