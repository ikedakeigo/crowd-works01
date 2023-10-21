<?php


// WooCommerce css & js
function wc_enqueue_script() {

  wp_enqueue_style( 'woocommerce-basic-style', get_template_directory_uri()  . '/wc/css/woocommerce.css');
  wp_enqueue_style( 'woocommerce-ankle-style', get_template_directory_uri()  . '/wc/css/ankle-style.css');

  wp_enqueue_script( 'single-product-js', get_template_directory_uri() . '/wc/js/single-product.js', array( 'jquery' ), version_num(), true );
	wp_enqueue_script( 'archive-product-js', get_template_directory_uri() . '/wc/js/archive-product.js', array( 'jquery' ), version_num(), true );
  wp_enqueue_script( 'header-js', get_template_directory_uri() . '/wc/js/header.js', array( 'jquery' ), version_num(), true );
	wp_enqueue_script( 'like-js', get_template_directory_uri() . '/wc/js/like.js', array( 'jquery' ), version_num(), true );
  wp_localize_script( 'like-js', 'TCD_FUNCTIONS', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'ajax_error_message' => __( 'Error was occurred. Please retry again.', 'tcd-ankle' ),
	) );

}
add_action( 'wp_enqueue_scripts', 'wc_enqueue_script', 10 );

// CF
get_template_part( 'wc/woocommerce-cf' );

// Like
get_template_part( 'wc/like' );

// footer bar
get_template_part( 'wc/footer-bar' );

// head
get_template_part( 'wc/head' );






/* ----------------------------------------------------------------------
 ラベル
---------------------------------------------------------------------- */


// 詳細ページのカートボタンのラベル変更
function tcd_woocommerce_product_single_add_to_cart_text($label, $instance) {
	if($instance->get_type() !== 'external') $label =  __( 'Add to cart', 'tcd-ankle' );
	return $label;
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'tcd_woocommerce_product_single_add_to_cart_text', 10, 2 ); 


// 詳細ページの在庫切れラベルフィルター
function tcd_woocommerce_get_availability_text($availability, $product) {

	global $dp_options;
	$outofstock_label = ($dp_options['product_list_outofstock_label']) ? $dp_options['product_list_outofstock_label'] : __('SOLD OUT', 'tcd-ankle');

	if ( ! $product->is_in_stock() ) {
		$availability = $outofstock_label;
	} elseif ( $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
		$availability = $product->backorders_require_notification() ? __( 'Available on backorder', 'woocommerce' ) : '';
	} elseif ( ! $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
		$availability = __( 'Available on backorder', 'woocommerce' );
	} elseif ( $product->managing_stock() ) {
		$availability = wc_format_stock_for_display( $product );
	} else {
		$availability = '';
	}
  return $availability;
}
add_filter( 'woocommerce_get_availability_text', 'tcd_woocommerce_get_availability_text', 999, 2 );


/* ----------------------------------------------------------------------
 一覧ページの数
---------------------------------------------------------------------- */

/**
 * WooCommerce 一覧表示件数フィルター
 */
function tcd_woocommerce_loop_shop_per_page( $loop_shop_per_page ) {
	
	$dp_options = get_design_plus_option();

	if ( wp_is_mobile() ) {
		$product_archive_num = is_numeric( $dp_options['product_archive_num_sp'] ) ? absint( $dp_options['product_archive_num_sp'] ) : 12;
	} else {
		$product_archive_num = is_numeric( $dp_options['product_archive_num'] ) ? absint( $dp_options['product_archive_num'] ) : 12;
	}
	return $product_archive_num;
}
add_filter( 'loop_shop_per_page', 'tcd_woocommerce_loop_shop_per_page', 10 );


/* ----------------------------------------------------------------------
 ウィジェット
---------------------------------------------------------------------- */

// 商品カテゴリーウィジェットの商品件数のHTMLをデフォルトカテゴリーと同じ構造に置き換える
function product_categories_widget_filter( $output ) {
  $replaced = preg_replace('/<span class="count">(\([0-9]*\))<\/span>/', '$1', $output);
  if($replaced != NULL) $output = $replaced;
  return $output;
}
add_filter( 'wp_list_categories', 'product_categories_widget_filter', 9, 2 );


// スターレビューが有効化されていなければ、商品リストウィジェットにクラス追加
function product_list_widget_filter( $list ) {
  if(get_option( 'woocommerce_enable_reviews' ) === 'no' || get_option( 'woocommerce_enable_review_rating' ) === 'no'){
    $list = '<ul class="product_list_widget no_review">';
  }
  return $list;
}
add_filter( 'woocommerce_before_widget_product_list', 'product_list_widget_filter', 10, 1 );

// 使用できないウィジェット削除
function unregister_default_wc_widget() {
  unregister_widget( 'WC_Widget_Layered_Nav' ); // 商品を属性で絞り込む
	unregister_widget( 'WC_Widget_Layered_Nav_Filters' ); // 有効な商品絞り込み
	unregister_widget( 'WC_Widget_Price_Filter' ); // 商品を価格で絞り込む
	unregister_widget( 'WC_Widget_Rating_Filter' ); // 商品を評価で絞り込む
}
add_action( 'widgets_init', 'unregister_default_wc_widget' );


/* ----------------------------------------------------------------------
 price
---------------------------------------------------------------------- */
// 円記号を変更する
function woocommerce_currency_symbol_filter( $currency_symbol, $currency ) {

	$dp_options = get_design_plus_option();
	if ( 'JPY' == $currency && $dp_options['product_list_currency_symbol'] == 'type2' ){
		$currency_symbol = __( 'yen', 'tcd-ankle' );
	} 
	return $currency_symbol;
    
}
add_filter( 'woocommerce_currency_symbol', 'woocommerce_currency_symbol_filter', 10, 2 );




/* ----------------------------------------------------------------------
 バッジ
---------------------------------------------------------------------- */
function get_tcd_product_badge($product, $dp_options){

	// 公開日から3日経過したら表示
	$today = (int) wp_date('U');
	$release = get_the_time('U');
	$passed = date('U',($today - $release)) / 86400;
	$is_new = ( 3 > $passed ) ? true : false;

	switch( true ) {

		// SALE
		case $product->is_on_sale() && $dp_options['show_product_list_badge_sale']:
			$is_active = true;
			$label = $dp_options['product_list_badge_sale'];
			$bg_color = $dp_options['product_list_badge_sale_bg_color'];
			break;

		// Featured
		case $product->is_featured() && $dp_options['show_product_list_badge_featured']:
			$is_active = true;
			$label = $dp_options['product_list_badge_featured'];
			$bg_color = $dp_options['product_list_badge_featured_bg_color'];
			break;

		// NEW
		case $is_new && $dp_options['show_product_list_badge_new']:
			$is_active = true;
			$label = $dp_options['product_list_badge_new'];
			$bg_color = $dp_options['product_list_badge_new_bg_color'];
			break;

		// default
		default:
			$is_active = false;
			$label = '';
			$bg_color = '#000000';

	}

	$badge = array(
		'is_active' => $is_active,
		'label' => $label,
		'bg_color' => $bg_color
	);

	return $badge;

}


/* ----------------------------------------------------------------------
 ソートフィルター
---------------------------------------------------------------------- */

// ソートフィルターの名前変更
function tcd_woocommerce_catalog_orderby_filter($array) {

	$dp_options = get_design_plus_option();

	$array = array(
		'menu_order' => __( 'Default', 'tcd-ankle' ),
		'date'       => __( 'Latest', 'tcd-ankle' ),
		'popularity' => __( 'Popularity', 'tcd-ankle' ),
		'rating'     => __( 'Rating', 'tcd-ankle' ),
		'price'      => __( 'Price: Low to High', 'tcd-ankle' ),
		'price-desc' => __( 'Price: High to Low', 'tcd-ankle' ),
	);

	if(!$dp_options['product_archive_filter_date']) unset($array['date']);
	if(!$dp_options['product_archive_filter_popularity']) unset($array['popularity']);
	if(!$dp_options['product_archive_filter_rating']) unset($array['rating']);
	if(!$dp_options['product_archive_filter_price']) unset($array['price']);
	if(!$dp_options['product_archive_filter_price-desc']) unset($array['price-desc']);

	return $array;
  
}
add_filter('woocommerce_default_catalog_orderby_options', 'tcd_woocommerce_catalog_orderby_filter');
add_filter( 'woocommerce_catalog_orderby', 'tcd_woocommerce_catalog_orderby_filter', 10, 1 );

// デフォルトの選択肢を変更
function woocommerce_default_catalog_orderby_filter($orderby) {

	$dp_options = get_design_plus_option();
	$orderby = $dp_options['product_archive_filter_default'];
	if(!$orderby == 'menu_order'){
		if(!$dp_options['product_archive_filter_'.$orderby]) $orderby = 'menu_order';
	}
	return $orderby;

}
add_filter('woocommerce_default_catalog_orderby', 'woocommerce_default_catalog_orderby_filter');





/* ----------------------------------------------------------------------
 レビューフォーム
---------------------------------------------------------------------- */

function tcd_woocommerce_product_review_comment_form_args($args) {

	global $dp_options;

	// レビューフォームは、ログインユーザーしかレビューできない仕様（決め打ち）

	// 名前、メールアドレス、URLの入力欄を表示しない
	$args['fields'] = array();

	// ログイン中のメッセージを表示しない	
	$args['must_log_in'] = '';

	// としてログインしています、ログアウトしますか？ (ログイン中) 表示しない
	$args['logged_in_as'] = '';

	// メールアドレスは公開されません。 すべて必須項目です。(ログアウト中) 表示しない
	$args['comment_notes_before'] = '';

	// ログアウト中
	if ( !is_user_logged_in() ) {

		// コメントフォームを表示しない
		$args['comment_field'] = '';

		// アカウントページが存在していれば、会員登録ボタンを表示
		$account_page_url = wc_get_page_permalink( 'myaccount' );
		if($account_page_url){
			$log_out_label = ($dp_options['product_single_reviews_form_desc_logout']) ? wp_kses_post(nl2br($dp_options['product_single_reviews_form_desc_logout'])) : __( 'You must be a registered member to post a review.', 'tcd-ankle' );
			$log_out_button_label = ($dp_options['product_single_reviews_form_button_label_logout']) ? esc_html($dp_options['product_single_reviews_form_button_label_logout']) : __( 'Write a review', 'tcd-ankle' );
			$args['title_reply_after'] .= '<p class="must-log-in">'.$log_out_label.'</p><p class="form-submit"><a class="p-button" href="'.esc_url( $account_page_url).'">'.$log_out_button_label.'</a></p>';
		}

		// コメント投稿ボタンを表示しない
		$args['action'] = '';
		$args['id_form'] = '';
		$args['class_form'] = 'close_comment_form';
		$args['submit_button'] = '';

		// ログアウト中のタイトル変更
		$title_reply = ($dp_options['product_single_reviews_form_title_logout']) ? wp_kses_post(nl2br($dp_options['product_single_reviews_form_title_logout'])) : __( 'Want to write a review?', 'tcd-ankle' );
		$args['title_reply'] = $title_reply;

	}

	return $args;

}
add_filter('woocommerce_product_review_comment_form_args', 'tcd_woocommerce_product_review_comment_form_args');


/* ----------------------------------------------------------------------
 関連商品
---------------------------------------------------------------------- */

/**
 * WooCommerce アップセル表示数フィルター
 */
function tcd_woocommerce_upsells_total( $limit = null ) {
	$limit = 15;
	return $limit;
}
add_filter( 'woocommerce_upsells_total', 'tcd_woocommerce_upsells_total', 10 );

/**
 * WooCommerce クロスセル表示数フィルター
 */
function tcd_woocommerce_cross_sells_total( $limit = null ) {
	$limit = 15;
	return $limit;
}
add_filter( 'woocommerce_cross_sells_total', 'tcd_woocommerce_cross_sells_total', 10 );


/**
 * WooCommerce 関連商品表示数フィルター
 */
function tcd_woocommerce_output_related_products_args( $args ) {

	global $dp_options;

	$related_product_num = (!is_mobile()) ? $dp_options['product_single_related_products_num'] : $dp_options['product_single_related_products_num_sp'];
	$args = array(
		'posts_per_page' => $related_product_num,
		'columns'        => 4,
		'orderby'        => 'rand',
	);
	return $args;

}
add_filter( 'woocommerce_output_related_products_args', 'tcd_woocommerce_output_related_products_args', 10 );



/* ----------------------------------------------------------------------
 管理画面
---------------------------------------------------------------------- */
function tcd_woocommerce_product_short_description_editor_settings($settings) {

	$settings = array(
		'media_buttons' => false,
		'textarea_name' => 'excerpt',
		'quicktags'     => array( 'buttons' => 'em,strong,link' ),
		'tinymce'       => array(
			'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
			'theme_advanced_buttons2' => '',
		),
		// 'tinymce'       => false,
		// 'quicktags'			=> false,
		'editor_css'    => '<style>#wp-excerpt-editor-container .wp-editor-area{min-height:120px; width:100%;}</style>',
	);

	return $settings;

}
add_filter('woocommerce_product_short_description_editor_settings', 'tcd_woocommerce_product_short_description_editor_settings');

// WooCommerceのメタボックスの位置変更
function tcd_change_wc_short_description_position(){
	remove_meta_box( 'postexcerpt', 'product', 'normal' );
	add_meta_box( 'postexcerpt', __( 'Product short description', 'woocommerce' ).__( ' - Displayed below the price', 'tcd-ankle' ), 'WC_Meta_Box_Product_Short_Description::output', 'product', 'advanced', 'high' );

	remove_meta_box( 'woocommerce-product-data', 'product', 'normal' );
	add_meta_box( 'woocommerce-product-data', __( 'Product data', 'woocommerce' ), 'WC_Meta_Box_Product_Data::output', 'product', 'advanced', 'default' );
}
add_action( 'add_meta_boxes', 'tcd_change_wc_short_description_position', 99 );

// メタボックス（advanced）の上で出力する
function tcd_title_after_output_metabox(){
	global $post, $wp_meta_boxes;

	// var_dump($wp_meta_boxes['product']['advanced']);

	if($post->post_type === 'product'){

		do_meta_boxes(get_current_screen(), 'advanced', $post);
		unset($wp_meta_boxes[get_post_type($post)]['advanced']);

	}

}
add_action('edit_form_after_title', 'tcd_title_after_output_metabox');



