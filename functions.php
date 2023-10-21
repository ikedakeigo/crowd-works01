<?php


// 言語ファイル --------------------------------------------------------------------------------
load_textdomain('tcd-ankle', dirname(__FILE__).'/languages/' . get_locale() . '.mo');


// テーマの説明文
__('The WordPress theme "Ankle" was developed with the concept of a minimal interior shop. As soon as you think of it, you can build your online shop quickly. Its simple, unassertive design puts your products in the spotlight.', 'tcd-ankle');


// WooCommerceがインストール・有効化されているか
if ( ! function_exists( 'is_woocommerce_active' ) ) {
	function is_woocommerce_active() {
		global $woocommerce;

		if ( class_exists( 'WooCommerce', false ) && $woocommerce ) {
			return true;
		}
		return false;
	}
}

// hook wp_head --------------------------------------------------------------------------------
require get_template_directory() . '/functions/head.php';


// テーマオプション --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/admin/theme-options.php' );
$options = get_design_plus_option();


// 更新通知 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/update_notifier.php' );


// Javascriptの読み込み -----------------------------------------------------------------------
function my_admin_scripts() {
  $options = get_design_plus_option();
  wp_enqueue_script('wp-color-picker');
  wp_enqueue_script('thickbox');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('jquery-ui-resizable');//トップページヘッダーコンテンツのロゴリサイズ機能で使用
  wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/js/jquery.cookieTab.js', '', '1.0.0', true);
  wp_enqueue_script('jquery.cookie', get_template_directory_uri().'/js/jquery.cookie.min.js', '', '1.0.0', true);
  wp_enqueue_script('my_script', get_template_directory_uri().'/admin/js/my_script.js', '', '1.1.8', true);
  wp_enqueue_script('admin_ankle', get_template_directory_uri().'/admin/js/admin_ankle.js', '', '1.0.0', true);
  wp_localize_script( 'my_script', 'TCD_MESSAGES', array(
    'cookieResetSuccess' => __( 'Cookie has been deleted', 'tcd-ankle' ),
    'ajaxSubmitSuccess' => __( 'Settings Saved Successfully', 'tcd-ankle' ),
    'ajaxSubmitError' => __( 'Can not save data. Please try again', 'tcd-ankle' ),
    'tabChangeWithoutSave' => __( "Your changes on the current tab have not been saved.\nTo stay on the current tab so that you can save your changes, click Cancel.", 'tcd-ankle' ),
    'contentBuilderDelete' => __( 'Are you sure you want to delete this content?', 'tcd-ankle' ),
    'imageContentWidthMessage' => __( '<span>You can display image by content width when you displaying border around the content on LP page.</span>', 'tcd-ankle' ),
    'mainColor' => $options['main_color']
  ) );
  wp_enqueue_media();//画像アップロード用
  wp_enqueue_script('cf-media-field', get_template_directory_uri().'/admin/js/cf-media-field.js', '', '1.0.0', true); //画像アップロード用
  wp_localize_script( 'cf-media-field', 'cfmf_text', array(
    'image_title' => __( 'Please select image', 'tcd-ankle' ),
    'image_button' => __( 'Use this image', 'tcd-ankle' ),
    'video_title' => __( 'Please select MP4 file', 'tcd-ankle' ),
    'video_button' => __( 'Use this MP4 file', 'tcd-ankle' ),
    'image_save' => __( 'Save', 'tcd-ankle' ),
  ) );
}
add_action('admin_print_scripts', 'my_admin_scripts');


// スタイルシートの読み込み -----------------------------------------------------------------------
function my_admin_styles() {
  wp_enqueue_style('imgareaselect');
  wp_enqueue_style('jquery-ui-draggable');
  wp_enqueue_style('wp-color-picker');
  wp_enqueue_style('thickbox');
  wp_enqueue_style('my_admin_css', get_template_directory_uri() .'/admin/css/my_admin.css','','1.0.5');
  wp_enqueue_style('ankle_admin_css', get_template_directory_uri() .'/admin/css/ankle_admin.css','','1.0.0');
}
add_action('admin_print_styles', 'my_admin_styles');


// ビジュアルエディタ用スタイルシートの読み込み
function wpdocs_theme_add_editor_styles() {
  add_theme_support('editor-styles');
  add_editor_style('admin/css/editor-style-03.css');//管理画面用のスタイルシートを変更した場合は、ファイルの名前と番号を変える （キャッシュ対策）
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );


// ウィジェット ------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/widget/widget.php' );

// CTA
require get_template_directory() . '/functions/single-cta.php';
require get_template_directory() . '/functions/modal-cta.php';
require get_template_directory() . '/functions/mini-cta.php';

// カードリンクパーツ --------------------------------------------------------------------------------
require get_template_directory() . '/functions/clink.php';


// おすすめ記事 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/recommend.php';


// meta title meta description  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/seo.php' );


// 管理画面の記事一覧、クイック編集 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/admin_column.php';
require get_template_directory() . '/functions/quick_edit.php';


// カスタムフィールド --------------------------------------------------------------------------------
require get_template_directory() . '/functions/page_cf.php';
require get_template_directory() . '/functions/taxonomy_cf.php';


// カスタムスクリプト --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_script.php';


// カスタムCSS --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_css.php';


// ビジュアルエディタにクイックタグを追加 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_editor.php';


// ショートコード --------------------------------------------------------------------------------
require get_template_directory() . '/functions/short_code.php';


// カスタムページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/custom_page_link.php' );


// OGP tag  -------------------------------------------------------------------------------------------
require get_template_directory() . '/functions/ogp.php';


//ロゴ用関数 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/logo.php' );


// プロフィール追加情報 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/user-profile.php';


// ロードアイコン -----------------------------------------------------------------------------
require get_template_directory() . '/functions/loading_screen.php';


// パスワード保護 -----------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/password_form.php' );


// 高速化 --------------------------------------------------------------------------------
require ( dirname(__FILE__) . '/functions/acceleration.php' );


// WooCommerce
require get_template_directory() . '/wc/woocommerce.php';


// 詳細ページ
require get_template_directory() . '/functions/single_parts.php';


// ビジュアルエディタに表(テーブル)の機能を追加 -----------------------------------------------
function mce_external_plugins_table($plugins) {
    $plugins['table'] = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/plugins/table/plugin.min.js';
    return $plugins;
}
add_filter( 'mce_external_plugins', 'mce_external_plugins_table' );

// tinymceのtableボタンにclass属性プルダウンメニューを追加
function mce_buttons_table($buttons) {
    $buttons[] = 'table';
    return $buttons;
}
add_filter( 'mce_buttons', 'mce_buttons_table' );

function bootstrap_classes_tinymce($settings) {
  $styles = array(
    array('title' => __('Default style', 'tcd-ankle'), 'value' => ''),
    array('title' => __('No border', 'tcd-ankle'), 'value' => 'table_no_border'),
    array('title' => __('Display only horizontal border', 'tcd-ankle'), 'value' => 'table_border_horizontal')
  );
  $settings['table_class_list'] = json_encode($styles);
  return $settings;
}
add_filter('tiny_mce_before_init', 'bootstrap_classes_tinymce');


// ビジュアルエディタに書体を追加 ---------------------------------------------------------------------
add_filter('mce_buttons', function($buttons){
  array_unshift($buttons, 'fontselect');
  return $buttons;
});
add_filter('tiny_mce_before_init', function($settings){
  $settings['font_formats'] =
    "メイリオ=Arial, 'ヒラギノ角ゴ ProN W3', 'Hiragino Kaku Gothic ProN', 'メイリオ', Meiryo, sans-serif;" .
    "游ゴシック='Hiragino Sans', 'ヒラギノ角ゴ ProN', 'Hiragino Kaku Gothic ProN', '游ゴシック', YuGothic, 'メイリオ', Meiryo, sans-serif;" .
    "游明朝='Times New Roman' , '游明朝' , 'Yu Mincho' , '游明朝体' , 'YuMincho' , 'ヒラギノ明朝 Pro W3' , 'Hiragino Mincho Pro' , 'HiraMinProN-W3' , 'HGS明朝E' , 'ＭＳ Ｐ明朝' , 'MS PMincho' , serif;" .
    "Andale Mono=andale mono,times;" .
    "Arial=arial,helvetica,sans-serif;" .
    "Arial Black=arial black,avant garde;" .
    "Book Antiqua=book antiqua,palatino;" .
    "Comic Sans MS=comic sans ms,sans-serif;" .
    "Courier New=courier new,courier;" .
    "Georgia=georgia,palatino;" .
    "Helvetica=helvetica;" .
    "Impact=impact,chicago;" .
    "Symbol=symbol;" .
    "Tahoma=tahoma,arial,helvetica,sans-serif;" .
    "Terminal=terminal,monaco;" .
    "Times New Roman=times new roman,times;" .
    "Trebuchet MS=trebuchet ms,geneva;" .
    "Verdana=verdana,geneva;" .
    "Webdings=webdings;" .
    "Wingdings=wingdings,zapf dingbats";
  ;
  return $settings;
});


// ビジュアルエディタに文字サイズを追加 ---------------------------------------------------------------------
function add_font_size_to_tinymce( $buttons ) {
  array_unshift( $buttons, 'fontsizeselect' );
  return $buttons;
}
add_filter( 'mce_buttons_2', 'add_font_size_to_tinymce' );

function change_font_size_of_tinymce( $initArray ){
  $initArray['fontsize_formats'] = "10px 11px 12px 14px 16px 18px 20px 24px 28px 32px 38px";
  return $initArray;
}
add_filter( 'tiny_mce_before_init', 'change_font_size_of_tinymce' );


// ユーザーエージェントを判定するための関数---------------------------------------------------------------------
function is_mobile() {

  //タブレットも含める場合はwp_is_mobile()

  $match = 0;

  $ua = array(
   'iPhone', // iPhone
   'iPod', // iPod touch
   'Android.*Mobile', // 1.5+ Android *** Only mobile
   'Windows.*Phone', // *** Windows Phone
   'dream', // Pre 1.5 Android
   'CUPCAKE', // 1.5+ Android
   'BlackBerry', // BlackBerry
   'BB10', // BlackBerry10
   'webOS', // Palm Pre Experimental
   'incognito', // Other iPhone browser
   'webmate' // Other iPhone browser
  );

  $pattern = '/' . implode( '|', $ua ) . '/i';
  $match   = preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );

  if ( $match === 1 ) {
    return TRUE;
  } else {
    return FALSE;
  }

}


// videoタグやyoutubeの自動再生に対応しているか判定 ----------------------------------------------
// Android 標準ブラウザは不可、Android版 Chrome ver53以下は不可、iOS ver10以下は不可、それ以外は再生を許可
function auto_play_movie() {
  $ua = mb_strtolower($_SERVER['HTTP_USER_AGENT']);
  // Android -----------------------------------
  if( preg_match('/android/ui', $ua) ) {
    //echo 'Android<br />';
    // 標準ブラウザ
    if (strpos($ua, 'android') !== false && strpos($ua, 'linux; u;') !== false && strpos($ua, 'chrome') === false) {
      return FALSE;
    // Chrome
    } elseif ( preg_match('/(chrome)\/([0-9\.]+)/', $ua , $matches) ){
      $match = (float) $matches[2];
      $version = floor($match);
      if($version < 53){
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return TRUE;
    }
  // iOS ---------------------------------------
  } elseif(preg_match('/iphone|ipod|ipad/ui', $ua)) {
    //echo 'iOS<br />';
    if ( preg_match('/(iphone|ipod|ipad) os ([0-9_]+)/', $ua, $matches) ) {
      $matches[2] = (float) str_replace('_', '.', $matches[2]);
      $version = floor($matches[2]);
      if($version < 10){
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return TRUE;
    }
  // PC等、その他のOS ---------------------------------------
  } else {
    //echo 'OTHER OS<br />';
    return TRUE;
  }
}


// スクリプトのバージョン管理 ----------------------------------------------------------------------------------------------
function version_num() {

  if (function_exists('wp_get_theme')) {
    $theme_data = wp_get_theme();
  } else {
    $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
  };

  $current_version = $theme_data['Version'];

  return $current_version;

};


// オリジナルの抜粋記事 --------------------------------------------------------------------------------
function trim_excerpt($a) {

  if(has_excerpt()) {

    $base_content = get_the_excerpt();
    $base_content = str_replace(array("\r\n", "\r", "\n"), "", $base_content);
    $trim_content = mb_substr($base_content, 0, $a ,"utf-8");

  } else {

    $base_content = get_the_content();
    $base_content = preg_replace('!<style.*?>.*?</style.*?>!is', '', $base_content);
    $base_content = preg_replace('!<script.*?>.*?</script.*?>!is', '', $base_content);
    // 吹き出し内のショートコードを取り除く
    $base_content = preg_replace('/\[speech_balloon_.*?\]/','', $base_content);
    $base_content = preg_replace('/\[\/speech_balloon_.*?\]/','', $base_content);
    // ショートコードを取り除く
    $base_content = strip_shortcodes( $base_content );
    $base_content = strip_tags($base_content);
    $trim_content = mb_substr($base_content, 0, $a,"utf-8");
    $trim_content = str_replace(']]>', ']]&gt;', $trim_content);
    $trim_content = str_replace(array("\r\n", "\r", "\n" , "&nbsp;"), "", $trim_content);
    $trim_content = htmlspecialchars($trim_content);

  };

  return $trim_content;

};
function trim_desc($desc,$num) {

  $trim_desc = mb_substr($desc, 0, $num ,"utf-8");
  $count_word = mb_strlen($trim_desc,"utf-8");
  return $trim_desc;

};

//抜粋からPタグを取り除く
remove_filter( 'the_excerpt', 'wpautop' );


// 記事タイトルの文字数制限 --------------------------------------------------------------------------------
function trim_title($num) {
  $base_title = strip_tags(get_the_title());
  $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
  $count_title = mb_strlen($trim_title,"utf-8");
  if($count_title > $num-1) {
    echo $trim_title . '…';
  } else {
    echo $trim_title;
  };
};

function trim_title2($num) {
  $base_title = strip_tags(get_the_title());
  $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
  $count_title = mb_strlen($trim_title,"utf-8");
  if($count_title > $num-1) {
    return $trim_title . '…';
  } else {
    return $trim_title;
  };
};

/* ショートコード用 */
function trim_title_sc($num) {
  $base_title = get_the_title();
  $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
  $count_title = mb_strwidth($trim_title,"utf-8");
  if($count_title > $num-1) {
    return $trim_title . '…';
  } else {
    return $trim_title;
  };
};


// タイトルをエンコード --------------------------------------------------------------------------------
function get_encoded_title($title){
  return urlencode(mb_convert_encoding($title, "UTF-8"));
}


// セルフピンバックを禁止する -------------------------------------------------------------------------------------
function no_self_ping( &$links ) {
  $home = home_url();
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );


// RSS用のフィードを追加 ---------------------------------------------------------------------------------------------------
add_theme_support( 'automatic-feed-links' );


//　ヘッダーから余分なMETA情報を削除 --------------------------------------------------------------------
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );


// インラインスタイルを取り除く --------------------------------------------------------------------------------
function remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'remove_recent_comments_style' );

function remove_adminbar_inline_style() {
  remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_adminbar_inline_style');


//　サムネイルの設定 --------------------------------------------------------------------------------
if ( function_exists('add_theme_support') ) {
  add_theme_support( 'post-thumbnails' );

  // 正方形
  add_image_size( 'square1', 200, 200, true );
  add_image_size( 'square2', 350, 350, true );
  add_image_size( 'square3', 500, 500, true );
  // 長方形
  add_image_size( 'landscape1', 320, 220, true );
  add_image_size( 'landscape2', 480, 330, true );
  add_image_size( 'landscape3', 640, 440, true );

}


// アイキャッチ画像登録エリアに推奨サイズを表示する
function message_image_meta_box($content, $post_id, $thumbnail_id) {
  $post = get_post($post_id);
  $options = get_design_plus_option();
  if ( $post->post_type == 'post' || $post->post_type == 'news') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-ankle'), '720', '495') . '</p>';
    return $content;
  }
  if ( $post->post_type == 'page') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.<br>This image will be used in search result and OGP tag.', 'tcd-ankle'),'1200','630') . '</p>';
    return $content;
  }
  return $content;
}
add_filter('admin_post_thumbnail_html', 'message_image_meta_box', 10, 3);


// カスタムメニューの設定 --------------------------------------------------------------------------------
if(function_exists('register_nav_menu')) {
  register_nav_menus( array(
    'global-menu' => __( 'Global menu', 'tcd-ankle' ),
		'footer-menu1' => __( 'Footer menu', 'tcd-ankle' ) . 1,
		'footer-menu2' => __( 'Footer menu', 'tcd-ankle' ) . 2,
		'footer-menu3' => __( 'Footer menu', 'tcd-ankle' ) . 3
	) );
}

// current-menu-itemを付ける
function custom_active_item_classes($classes = array(), $menu_item = false) {
  if(is_single()){
  global $post;
  $id = ( isset( $post->ID ) ? get_the_ID() : NULL );
  if (isset( $id )){
    $classes[] = ($menu_item->url == get_post_type_archive_link($post->post_type)) ? 'current-menu-item' : '';
  }
  }
  return $classes;
}
add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );


// 絵文字を消す ------------------------------------------------------------------
function disable_emoji() {
    $options = get_design_plus_option();
    if ( $options['use_emoji'] == 0 ) {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    } elseif ( $options['use_css_optimization'] ) {
        // 絵文字styleが先頭にある関係でCSS最適化+common.css未生成時に不具合起こる対策
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        add_action( 'wp_head', 'print_emoji_styles', 10 );
    }
}
add_action( 'init', 'disable_emoji' );


// bodyタグにclassを追加 --------------------------------------------------------------------------------
function tcd_body_classes($classes) {
    global $wp_query, $post;
    $options = get_design_plus_option();

    // Firefoxを判定
    $browser = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (strstr($browser , 'firefox')) {
      $classes[] = 'firefox';
    }

    if(wp_is_mobile()){
      $classes[] = 'mobile_device';
    }

    if( is_404() ) { $classes[] = 'home'; };

    if( is_single() && (!comments_open() && !pings_open()) ) { $classes[] = 'no_comment_form'; };

    if (wp_is_mobile()) {
      $classes[] = 'mobile_device';
    };
    if ( is_mobile() && ($options['footer_bar_display'] == 'type1') ) { $classes[] = 'show_footer_bar dp-footer-bar-type1'; };
    if ( is_mobile() && ($options['footer_bar_display'] == 'type2') ) { $classes[] = 'show_footer_bar dp-footer-bar-type2'; };

    return array_unique($classes);
};
add_filter('body_class','tcd_body_classes');


// HEXをRGBに変換 ------------------------------------------------------------------
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb;
}


// カスタムコメント --------------------------------------------------------------------------------------

if (function_exists('wp_list_comments')) {
	// comment count
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $commentcount ) {
		global $id;
		$_commnets = get_comments('post_id=' . $id);
		$comments_by_type = separate_comments($_commnets);
		return count($comments_by_type['comment']);
	}
}


function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>

 <li class="comment <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-comment';} else {echo 'guest-comment';} ?>" id="comment-<?php comment_ID() ?>">
  <div class="comment-meta clearfix">
   <div class="comment-meta-left">
  <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 35); } ?>

    <ul class="comment-name-date">
     <li class="comment-name">
<?php if (get_comment_author_url()) : ?>
<a id="commentauthor-<?php comment_ID() ?>" class="url <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-url';} else {echo 'guest-url';} ?>" href="<?php comment_author_url() ?>" rel="nofollow">
<?php else : ?>
<span id="commentauthor-<?php comment_ID() ?>">
<?php endif; ?>

<?php comment_author(); ?>

<?php if(get_comment_author_url()) : ?>
</a>
<?php else : ?>
</span>
<?php endif; ?>
     <li class="comment-date"><?php echo get_comment_time('Y.m.d'); echo get_comment_time(' g:ia'); ?></li>
    </ul>
   </div>

   <ul class="comment-act">
<?php if (function_exists('comment_reply_link')) {
        if ( get_option('thread_comments') == '1' ) { ?>
    <li class="comment-reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('REPLY','tcd-ankle').'</span></span>'))) ?></li>
<?php   } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-ankle'); ?></a></li>
<?php   }
      } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-ankle'); ?></a></li>
<?php } ?>
    <li class="comment-quote"><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'comment');"><?php _e('QUOTE', 'tcd-ankle'); ?></a></li>
    <?php edit_comment_link(__('EDIT', 'tcd-ankle'), '<li class="comment-edit">', '</li>'); ?>
   </ul>

  </div>
  <div class="comment-content post_content" id="comment-content-<?php comment_ID() ?>">
  <?php if ($comment->comment_approved == '0') : ?>
   <span class="comment-note"><?php _e('Your comment is awaiting moderation.', 'tcd-ankle'); ?></span>
  <?php endif; ?>
  <?php comment_text(); ?>
  </div>

<?php

}


/* 記事編集画面のカテゴリー階層を保つ */
function lig_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
  $args['checked_ontop'] = false;
  return $args;
}
add_action( 'wp_terms_checklist_args', 'lig_wp_category_terms_checklist_no_top' );


// カスタム投稿の数が多い為、メディアメニューの位置を変更 ----------------------------------------------------------
function customize_menus(){
  global $menu;
  $menu[19] = $menu[10];
  unset($menu[10]);
}
add_action( 'admin_menu', 'customize_menus' );


// カスタム投稿「お知らせ」 --------------------------------------------------------------------------------
$options = get_design_plus_option();
$news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-ankle' );
$news_slug = $options['news_slug'] ? sanitize_title( $options['news_slug'] ) : 'news';
$news_labels = array(
  'name' => $news_label,
  'add_new' => __( 'Add New', 'tcd-ankle' ),
  'add_new_item' => __( 'Add New Item', 'tcd-ankle' ),
  'edit_item' => __( 'Edit', 'tcd-ankle' ),
  'new_item' => __( 'New item', 'tcd-ankle' ),
  'view_item' => __( 'View Item', 'tcd-ankle' ),
  'search_items' => __( 'Search Items', 'tcd-ankle' ),
  'not_found' => __( 'Not Found', 'tcd-ankle' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-ankle' ),
  'parent_item_colon' => ''
);

register_post_type( 'news', array(
  'label' => $news_label,
  'labels' => $news_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $news_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'editor', 'thumbnail' ),
  'show_in_rest' => false	// ブロックエディターを使用しない、REST APIで表示しない
));



// 全てのカスタムフィールドを検索対象に含める --------------------------------------------------------------------------------
function cf_search_join($join, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' AS tcd_pm_search ON '. $wpdb->posts . '.ID = tcd_pm_search.post_id ';
    }
    return $join;
}
add_filter('posts_join', 'cf_search_join', 10, 2);

function cf_search_where($where, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (tcd_pm_search.meta_value LIKE $1)", $where);
    }
    return $where;
}
add_filter('posts_where', 'cf_search_where', 10, 2);

function cf_search_distinct($distinct, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        return "DISTINCT";
    }
    return $distinct;
}
add_filter('posts_distinct', 'cf_search_distinct', 10, 2);


// タイトルとurlをコピーのスクリプト --------------------------------------------------------------------------------
function copy_title_url_script() {
  global $dp_options;
  if ( ! $dp_options ) $dp_options = get_design_plus_option();

  if ( (is_singular('post') && $dp_options['blog_single_show_copy_top']) || (is_singular('news') && $dp_options['news_single_show_copy_top']) ) {
    wp_enqueue_script( 'copy_title_url', get_template_directory_uri().'/js/copy_title_url.js', array(), version_num(), true );
  }
}
add_action( 'wp_enqueue_scripts', 'copy_title_url_script' );


// カテゴリー編集画面にIDを表示する ------------------------------------------------------------------------------------
function add_category_columns( $columns ) {
  echo '<style>
  .taxonomy-category .manage-column.num {width: 90px;}
  .taxonomy-category .manage-column.column-id {width: 60px;}
  </style>';

  $columns['id'] = 'ID';
  return $columns;
}
function add_category_sortable_columns( $columns ) {
  $columns['id'] = 'ID';
  return $columns;
}
function custom_category_column( $content, $column_name, $term_id ) {
  if ( $column_name == 'id' ) {
    echo $term_id;
  }
}
add_filter( 'manage_edit-category_columns', 'add_category_columns' );
add_filter( 'manage_edit-category_sortable_columns', 'add_category_sortable_columns' );
add_action( 'manage_category_custom_column', 'custom_category_column', 10, 3 );


// ページのナビの有無をチェック ---------------------------------------------------------------------------------------
function show_posts_nav() {
  global $wp_query;
  return ($wp_query->max_num_pages > 1);
};


// ブログ用固定ページかっらメタボックス削除 ------------------------------------------------------------------------
function tcd_remove_meta_boxes() {
  global $typenow, $post;

  // ホームページ・投稿ページ表示に設定されているに固定ページ編集時
  if ( 'page' === $typenow && ! empty( $post->ID ) && 'page' === get_option('show_on_front') && in_array( $post->ID, array( get_option( 'page_on_front' ), get_option( 'page_for_posts' ) ) ) ) {
    remove_meta_box( 'page_header_meta_box', 'page', 'normal' );
    remove_meta_box( 'select_pw_meta_box', 'page', 'normal' );
    remove_meta_box( 'postexcerpt', 'page', 'normal' );
    remove_meta_box( 'postexcerpt', 'page', 'normal' );
    remove_meta_box( 'show_seo_meta_box', 'page', 'normal' );
  }

}
add_action( 'add_meta_boxes', 'tcd_remove_meta_boxes', 999 );



// ショートコードがpタグで囲まれるのを防ぐ
function remove_shortcode_empty_paragraph($content) {
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'remove_shortcode_empty_paragraph');



// 一部のタグ以外除去する（テーマオプション > 検索フォームの設定で使用）
function remove_non_inline_elements( $option ) {
  $allowed_html = [
    'a' => [ 'href' => [], 'class' => [] ],
    'br' => [ 'class' => [] ],
    'span' => [ 'class' => [] ]
  ];
  return wp_kses($option, $allowed_html);
}



// ボタンのCSS出力
function tcd_output_button_style($dp_options, $key, $selector){

  $button_type = $dp_options[$key . '_type'];
  $button_shape = $dp_options[$key . '_border_radius'];
  $button_size = $dp_options[$key . '_size'];
  $button_animation_type = $dp_options[$key . '_animation_type'];
  $button_color = $dp_options[$key . '_color'];
  $button_color_hover = $dp_options[$key . '_color_hover'];

  $colors = array();
  $animations = array();

  switch ($button_shape){
    case 'flat': $shape = 'border-radius:0px;'; break;
    case 'rounded': $shape = 'border-radius:6px;'; break;
    case 'oval': $shape = 'border-radius:70px;'; break;
  }
  switch ($button_size){
    case 'small': $size = 'width:130px; height:40px;'; break;
    case 'medium': $size = 'width:270px; height:60px;'; break;
    case 'large': $size = 'width:400px; height:70px;'; break;
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

  $html = $selector.' { '.$size.$shape.$colors[0].' }';
  $html .= $selector.':before'.' { '.$colors[1].$animations[0].' }';
  $html .= $selector.':hover'.' { '.$colors[2].' }';
  $html .= $selector.':hover:before'.' { '.$animations[1].' }';

  return $html;

}


// pre_get_postsフィルター
function ankle_pre_get_posts( $wp_query ) {

	$dp_options = get_design_plus_option();

	if ( ! is_admin() && $wp_query->is_main_query() ) {

    if ( is_woocommerce_active() && ( $wp_query->is_post_type_archive( 'product' ) || $wp_query->is_tax( 'product_cat' ) || $wp_query->is_tax( 'product_tag' ) ) ) {
			// 表示件数はtcd_woocommerce_loop_shop_per_pageで
			// ソートはWooCommerce機能

			// 在庫
			if ( ! empty( $_GET['stock'] ) && 'in_stock' === $_GET['stock'] && 'yes' !== get_option( 'woocommerce_hide_out_of_stock_items' ) ) {

				$product_visibility_terms = wc_get_product_visibility_term_ids();
				if ( ! empty( $product_visibility_terms['outofstock'] ) ) {
					$tax_query = $wp_query->get( 'tax_query' );
					if( ! $tax_query ){
						$tax_query = array();
					}

					$tax_query[] = array(
						'taxonomy' => 'product_visibility',
						'field' => 'term_taxonomy_id',
						'terms' => $product_visibility_terms['outofstock'],
						'operator' => 'NOT IN',
					);

					$wp_query->set( 'tax_query', $tax_query );
				}
			}


    // news 表示件数
		} elseif ( $wp_query->is_post_type_archive( 'news' ) ) {
			if ( wp_is_mobile() ) {
				$news_per_page = is_numeric( $dp_options['news_archive_num_sp'] ) ? absint( $dp_options['news_archive_num_sp'] ) : 10;
			} else {
				$news_per_page = is_numeric( $dp_options['news_archive_num'] ) ? absint( $dp_options['news_archive_num'] ) : 10;
			}
			$wp_query->set( 'posts_per_page', $news_per_page );


    // blog 表示件数
		} else {
			if ( wp_is_mobile() ) {
				$posts_per_page = is_numeric( $dp_options['blog_archive_num_sp'] ) ? absint( $dp_options['blog_archive_num_sp'] ) : 10;
			} else {
				$posts_per_page = is_numeric( $dp_options['blog_archive_num'] ) ? absint( $dp_options['blog_archive_num'] ) : 10;
			}
			$wp_query->set( 'posts_per_page', $posts_per_page );
		}


	}
}
add_filter( 'pre_get_posts', 'ankle_pre_get_posts' );

// iOS判別
function is_ios() {
  $useragents = array(
    'iPhone'        // iPhone
  );
  $pattern = '/'.implode('|', $useragents).'/i';

  if (!preg_match($pattern, $_SERVER['HTTP_USER_AGENT'])) {
    return false;
  }

  return true;
}

