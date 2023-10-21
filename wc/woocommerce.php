<?php

/**
 * WooCommerce after_setup_theme
 * https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/#section-5
 * https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 */

function tcd_woocommerce_after_setup_theme() {
	if ( is_woocommerce_active() ) {
		add_theme_support( 'woocommerce' );
	}
}
add_action( 'after_setup_theme', 'tcd_woocommerce_after_setup_theme' );

/**
 * WooCommerce after_switch_theme
 */
function tcd_woocommerce_after_switch_theme() {
	// リライトルール更新
	flush_rewrite_rules( false );
}
add_action( 'after_switch_theme', 'tcd_woocommerce_after_switch_theme', 99 );


// ankle用
if ( is_woocommerce_active() ){
get_template_part( 'wc/ankle' );
}

/**
 * WooCommerce init
 */
function tcd_woocommerce_init() {
	// global $dp_options;
	$dp_options = get_design_plus_option();

	if ( is_woocommerce_active() ) {
		// アカウント削除時のメールクラスフィルター
		add_filter( 'woocommerce_email_classes','tcd_woocommerce_delete_account_email_classes', 10 );

		if ( is_admin() ) {
			// WooCommerceのカテゴリーメタを非表示に
			$wc_admin_taxonomies = WC_Admin_Taxonomies::get_instance();
			remove_action( 'product_cat_add_form_fields', array( $wc_admin_taxonomies, 'add_category_fields' ), 10 );
			remove_action( 'product_cat_edit_form_fields', array( $wc_admin_taxonomies, 'edit_category_fields' ), 10 );
			remove_action( 'created_term', array( $wc_admin_taxonomies, 'save_category_fields' ), 10 );
			remove_action( 'edit_term', array( $wc_admin_taxonomies, 'save_category_fields' ), 10 );

			// WooCommerceのカテゴリー画像カラムを非表示に
			add_filter( 'manage_edit-product_cat_columns', 'tcd_woocommerce_product_cat_columns', 20 );

			// WooCommerce customizerから不要項目削除
			add_action( 'customize_register', 'tcd_woocommerce_customize_register', 99 );

		} else {
			// 最近チェックしたアイテム用にクッキー保存
			add_action( 'wp', 'tcd_woocommerce_single_cookie' );

			// 価格範囲フォーマットフィルター
			add_filter( 'woocommerce_format_price_range', 'tcd_woocommerce_format_price_range', 10, 3 );

			// ウィッシュリストリクエスト メインクエリー上書きなど
			add_filter( 'wp', 'tcd_woocommerce_wishlist_wp', 11 );

			// アカウントダッシュボードに注文履歴追加
			add_action( 'woocommerce_account_dashboard', 'tcd_woocommerce_account_dashboard_my_orders', 10 );

			// WooCommerce アカウント削除
			add_action( 'wp_loaded', 'tcd_woocommerce_process_delete_account', 20 );

			// WooCommerceフィルター削除・移動など

			// Track product views.
			// remove_action( 'template_redirect', 'wc_track_product_view', 20 );

			// Content Wrappers.
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

			// Sale flashes.
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

			// Breadcrumbs.
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

			// Products Loop.
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

			// Product Loop Items.
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

			// After Single Products Summary Div.
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

			// カートページのクロスセルの実行タイミング変更
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
			add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 10 );

			// 関連商品
			add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 15 );
			// アップセル
			add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 20 );

			// Product Summary Box.
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

			// Product Add to cart.
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

			// Reviews
			remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
			remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
			add_action( 'woocommerce_review_before', 'tcd_woocommerce_review_display_gravatar', 10 );
			add_action( 'woocommerce_review_before_comment_text', 'woocommerce_review_display_rating', 10 );

			// CSS最適化+WooCommerce出力「<noscript><style>～」の不具合対策
			if ( $dp_options['use_css_optimization'] ) {
				remove_action( 'wp_head', 'wc_gallery_noscript', 10 );
			}

			// PayPal Checkout有効時に都道府県の必須項目が外れるのを再度必須項目にする
			if ( function_exists( 'wc_gateway_ppec' ) ) {
				add_action( 'woocommerce_get_country_locale', 'tcd_woocommerce_get_country_locale', 11 );
			}

			// Cart widget
			remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
			remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );
			add_action( 'woocommerce_widget_shopping_cart_buttons', 'tcd_woocommerce_widget_shopping_cart_button_view_cart', 10 );
			add_action( 'woocommerce_widget_shopping_cart_buttons', 'tcd_woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );
		}
	}
}
add_action( 'init', 'tcd_woocommerce_init', 99 );

/**
 * WooCommerceがインストール・有効化されているか
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {
	function is_woocommerce_active() {
		global $woocommerce;

		if ( class_exists( 'WooCommerce', false ) && $woocommerce ) {
			return true;
		}
		return false;
	}
}

/**
 * WooCommerce マイアカウントページの固定ページタイトルを返す
 */
function get_woocommerce_myaccount_page_title() {
	if ( is_woocommerce_active() ) {
		$myaccount_page_id = wc_get_page_id( 'myaccount' );
		if ( $myaccount_page_id ) {
			return get_the_title( $myaccount_page_id );
		}
	}
	return __( 'Mypage', 'tcd-ankle' );
}

/**
 * WooCommerceのカテゴリー画像カラムを非表示に
 */
function tcd_woocommerce_product_cat_columns( $columns ) {
	if ( isset( $columns['thumb'] ) ) {
		unset( $columns['thumb'] );
	}
	return $columns;
}

/**
 * WooCommerce customizerから不要項目削除
 */
function tcd_woocommerce_customize_register( $wp_customize ) {
	// 商品カタログセクション削除
	if ( $wp_customize->get_section( 'woocommerce_product_catalog' ) ) {
		$wp_customize->remove_section( 'woocommerce_product_catalog' );
	}

	// 商品画像セクション削除
	if ( $wp_customize->get_section( 'woocommerce_product_images' ) ) {
		$wp_customize->remove_section( 'woocommerce_product_images' );
	}
}

/**
 * WooCommerce 価格範囲フォーマットフィルター
 */
function tcd_woocommerce_format_price_range( $price, $from, $to ) {
	return str_replace( ' &ndash; ', '<span> &ndash; </span>', $price );
}

/**
 * WooCommerce 価格範囲を出力
 * 税込・税別等はWooCommerce設定→税→価格表示の接尾辞で設定でする
 */
function the_tcd_woocommerce_product_price( $product = null, $show_regular_price = false, $add_soldout = false ) {
	echo get_tcd_woocommerce_product_price( $product, $show_regular_price, $add_soldout );
}

/**
 * WooCommerce 最近チェックしたアイテム用にクッキー保存
 */
function tcd_woocommerce_single_cookie() {
	global $post;

	if ( is_product() ) {
		$recently_viewed_products = array();
		// $cookie_name = 'recently_viewed_woocommerce_products';
		$cookie_name = 'woocommerce_recently_viewed';

		if ( isset( $_COOKIE[$cookie_name] ) ) {
			// $recently_viewed_products = explode( ',', $_COOKIE[$cookie_name] );
			$recently_viewed_products = explode( '|', $_COOKIE[$cookie_name] );
		}

		array_unshift( $recently_viewed_products, $post->ID );

		$recently_viewed_products = array_unique( $recently_viewed_products );

		if ( 60 < count( $recently_viewed_products ) ) {
			$recently_viewed_products = array_slice( $recently_viewed_products, 0, 60 );
		}

		setcookie( $cookie_name, implode( '|', $recently_viewed_products ), time() + YEAR_IN_SECONDS * 5, COOKIEPATH, COOKIE_DOMAIN );
	}
}


/**
 * WooCommerce 出力用価格範囲を取得
 */
function get_tcd_woocommerce_product_price( $product = null, $show_regular_price = false, $add_soldout = false ) {
	if ( ! is_woocommerce_active() ) {
		return null;
	}

	if ( ! $product ) {
		$product = wc_get_product( get_post() );
	}

	if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
		return null;
	}

	$price_html = $product->get_price_html();

	// 通常価格削除
	if ( ! $show_regular_price && false !== strpos( $price_html, '<del>' ) ) {
		$price_html = preg_replace( '#<del>.*?</del>|<ins>|</ins>#', '', $price_html );
	}

	if ( $add_soldout ) {
		$price_html .= '<span class="p-article__soldout">'. __( 'SOLD OUT', 'tcd-ankle' ) . '</span>';
	}

	return $price_html;
}

/**
 * WooCommerce 商品アーカイブ カテゴリ－・ソート・在庫フィルター表示
 */
function tcd_woocommerce_archive_category_sort_filter() {
	wc_get_template( 'loop/category-sort-filter.php' );
}
add_action( 'woocommerce_before_shop_loop', 'tcd_woocommerce_archive_category_sort_filter', 30 );



/**
 * WooCommerce レビュー アバター表示
 */

function tcd_woocommerce_review_display_gravatar( $comment ) {
	echo '<div class="avatar" style="background-image: url(' . esc_attr( get_avatar_url( $comment, apply_filters( 'tcd_woocommerce_review_gravatar_size', 300 ) ) ) . ')"></div>';
}

/**
 * WooCommerce ウィッシュリスト用にエンドポイント追加
 * initにフックだと遅い。要パーマリンク更新。
 */
function tcd_woocommerce_wishlist_add_endpoint( $query_vars ) {
	$query_vars['wishlist'] = 'wishlist';
	return $query_vars;
}
add_filter( 'woocommerce_get_query_vars', 'tcd_woocommerce_wishlist_add_endpoint' );

/**
 * ウィッシュリスト判別
 */
function is_tcd_woocommerce_wishlist( $check_template_exists = false ) {
	global $wp;

	if ( is_woocommerce_active() && isset( $wp->query_vars['wishlist'] ) && ( isset( $wp->query_vars['page_id']) || isset( $wp->query_vars['pagename'] ) ) ) {
		if ( $check_template_exists ) {
			// wishlist.phpがあれば
			$wishlist_template = locate_template( 'wishlist.php' );
			if ( $wishlist_template ) {
				return true;
			}
		} else {
			return true;
		}
	}

	return false;
}

/**
 * ウィッシュリストリクエストの場合、$wp_queryにページ分割済みのウィッシュリストをセット
 */
function tcd_woocommerce_wishlist_wp() {
	if ( ! is_woocommerce_active() ) return;

	if ( is_tcd_woocommerce_wishlist( true ) ) {
		global $dp_options, $wp, $wp_query, $wp_the_query;
		if ( ! $dp_options ) $dp_options = get_design_plus_option();

		// ページ番号
		$wishlist_paged = 1;
		if ( ! empty( $wp->query_vars['paged'] ) ) {
			$wishlist_paged = intval( $wp->query_vars['paged'] );
		} elseif ( ! empty( $wp->query_vars['page'] ) ) {
			$wishlist_paged = intval( $wp->query_vars['page'] );
		} elseif ( ! empty( $wp->query_vars['wishlist'] ) ) {
			// query_vars['wishlist'] => 'page/2'が入っている
			$wishlist_paged = intval( str_replace( 'page/', '', $wp->query_vars['wishlist'] ) );
        }
		$wishlist_paged = max( $wishlist_paged, 1 );

		// アイテム数
		if ( wp_is_mobile() ) {
			$product_archive_num = is_numeric( $dp_options['product_wishlist_num_sp'] ) ? absint( $dp_options['product_wishlist_num_sp'] ) : 9;
		} else {
			$product_archive_num = is_numeric( $dp_options['product_wishlist_num'] ) ? absint( $dp_options['product_wishlist_num'] ) : 10;
		}

		// $wp_queryを上書き
		$wp_query = $wp_the_query = get_user_liked_posts( null, array(
			'posts_per_page' => $product_archive_num,
			'paged' => $wishlist_paged
		), 'WP_Query' );

		// redirect_canonicalしない
		add_filter( 'redirect_canonical', '__return_false' );

		// WooCommerceのtemplate_redirectを削除
		remove_action( 'template_redirect', 'wc_template_redirect' );

		// テンプレート変更フィルター
		add_filter( 'template_include', 'tcd_wishlist_template_include', 10 );

		// ウィッシュリストタイトルフィルター
		add_filter( 'document_title_parts', 'tcd_woocommerce_wishlist_document_title_parts', 9 );
		add_filter( 'get_the_archive_title', 'get_tcd_woocommerce_wishlist_title', 9 );

		// ウィッシュリストbody_classフィルター
		add_filter( 'body_class', 'tcd_woocommerce_wishlist_body_classes' );

		// ウィッシュリスト ループ前後のアクションでカートに入れるボタンフィルター
		add_action( 'tcd_wishlist_before_loop', 'tcd_wishlist_before_loop' );
		add_action( 'tcd_wishlist_after_loop', 'tcd_wishlist_after_loop' );
	}
}

/**
 * ウィッシュリストテンプレートフィルター
 */
function tcd_wishlist_template_include( $template ) {
	if ( is_tcd_woocommerce_wishlist() ) {
		$wishlist_template = locate_template( 'wishlist.php' );
		if ( $wishlist_template ) {
			return $wishlist_template;
		}
	}

	return $template;
}

/**
 * ウィッシュリストタイトルフィルター
 */
function tcd_woocommerce_wishlist_document_title_parts( $title ) {
	if ( is_tcd_woocommerce_wishlist() ) {
		$title['title'] = get_tcd_woocommerce_wishlist_title();
	}
	return $title;
}
function get_tcd_woocommerce_wishlist_title() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();
	return __( 'Wishlist', 'tcd-ankle' );
}

/**
 * ウィッシュリストbody_classフィルター
 */
function tcd_woocommerce_wishlist_body_classes( $classes ) {
	global $dp_options, $active_sidebar, $post;

	$classes[] = 'wishlist';

	$key = array_search( 'blog', $classes );
	if ( false !== $key ) {
		unset( $classes[$key] );
	}

	return array_unique( $classes );
}

/**
 * ウィッシュリスト ループ前アクション
 */
function tcd_wishlist_before_loop() {
	// カートに入れるボタンフィルター
	add_filter( 'woocommerce_loop_add_to_cart_args', 'tcd_woocommerce_loop_add_to_cart_args', 10, 2 );
	add_filter( 'woocommerce_product_add_to_cart_text', 'tcd_woocommerce_product_add_to_cart_text', 10, 2 );
}

/**
 * ウィッシュリスト ループ後アクション
 */
function tcd_wishlist_after_loop() {
	remove_filter( 'woocommerce_loop_add_to_cart_args', 'tcd_woocommerce_loop_add_to_cart_args', 10 );
	remove_filter( 'woocommerce_product_add_to_cart_text', 'tcd_woocommerce_product_add_to_cart_text', 10 );
}

/**
 * WooCommerce 商品一覧からカートに入れるargsフィルター
 */
function tcd_woocommerce_loop_add_to_cart_args( $args, $product ) {
	if ( __( 'Add to cart', 'woocommerce' ) === $product->add_to_cart_text() ) {
		$args['class'] = preg_replace( '#^button #', 'p-button p-button-cart-icon', $args['class'] );
	} else {
		$args['class'] = preg_replace( '#^button #', 'p-button ', $args['class'] );
	}
	return $args;
}

/**
 * WooCommerce 商品一覧からカートに入れるテキストフィルター
 */
function tcd_woocommerce_product_add_to_cart_text( $add_to_cart_text, $product ) {

	$dp_options = get_design_plus_option();
	$outofstock_label = ($dp_options['product_list_outofstock_label']) ? $dp_options['product_list_outofstock_label'] : __('SOLD OUT', 'tcd-ankle');
	// 在庫がない時のテキスト
	if(!$product->is_in_stock()) return $outofstock_label;

	$product_type = $product->product_type;
	switch ( $product_type ) {

		case 'external': return __( 'Buy product', 'tcd-ankle' );    break;
		case 'grouped' : return __( 'View products', 'tcd-ankle' );  break;
		case 'simple'	 : return __( 'Add to cart', 'tcd-ankle' );    break;
		case 'variable': return __( 'View products', 'tcd-ankle' ); break;
		default				 : return __( 'View products', 'tcd-ankle' );

	}

}



/**
 * WooCommerce アカウントダッシュボードに注文履歴追加
 */
function tcd_woocommerce_account_dashboard_my_orders() {
	$current_page = 1;
	$customer_orders = wc_get_orders(
		apply_filters(
			'tcd_woocommerce_account_dashboard_my_orders_query',
			apply_filters(
				'woocommerce_my_account_my_orders_query',
				array(
					'customer' => get_current_user_id(),
					'page' => $current_page,
					'paginate' => true
				)
			)
		)
	);

	if ( 0 < $customer_orders->total ) {
		// ページネートさせない
		$customer_orders->max_num_pages = 1;

		wc_get_template(
			'myaccount/orders.php',
			array(
				'current_page' => absint( $current_page ),
				'customer_orders' => $customer_orders,
				'has_orders' => 0 < $customer_orders->total,
				'show_title' => true
			)
		);
	}
}


/**
 * WooCommerce アカウント削除
 */
function tcd_woocommerce_process_delete_account() {
	if ( ! isset( $_POST['action'], $_POST['delete-account-nonce'] ) || 'tcd_woocommerce_delete_account' !== $_POST['action'] ) {
		return;
	}

	$user = wp_get_current_user();

	if ( $user && wp_verify_nonce( $_POST['delete-account-nonce'], 'tcd_woocommerce_delete_account' ) ) {
		// 未完了の注文があればエラー表示
		$customer_orders = wc_get_orders(
			apply_filters(
				'tcd_woocommerce_process_delete_account_processing_orders_query',
				array(
					'customer_id' => $user->ID,
					'status' => array( 'pending', 'processing', 'on-hold' )
				)
			)
		);
		if ( $customer_orders ) {
			wc_add_notice( __( 'Delete account error: You have some incomplete orders.', 'tcd-ankle' ), 'error' );
			return;
		}

		// action hook
		do_action( 'tcd_woocommerce_delete_account', $user->ID );

		// アカウント削除実行
		require_once( ABSPATH . 'wp-admin/includes/user.php' );
		wp_delete_user( $user->ID );
		wp_logout();

		// action hook
		do_action( 'tcd_woocommerce_deleted_account', $user->ID );

		// メール送信
		try {
			WC()->mailer()->emails['WC_Email_Customer_Delete_Account']->trigger( $user->ID );
		} catch ( Exception $e ) {
		}

		// アカウント削除済みノーティス
		wc_add_notice( __( 'Your account was deleted successfully.', 'tcd-ankle' ) );

		// リダイレクト
		wp_redirect( wc_get_page_permalink( 'myaccount' ) );
		exit;
	}
}

/**
 * WooCommerce アカウント削除時のメールクラスフィルター
 */
function tcd_woocommerce_delete_account_email_classes( $emails ) {
	if ( ! isset( $emails['WC_Email_Customer_Delete_Account'] ) ) {
		$emails['WC_Email_Customer_Delete_Account'] = include( get_template_directory() . '/wc/class-wc-email-customer-delete-account.php' );
	}

	return $emails;
}

/**
 * WooCommerce PayPal Checkout有効時に都道府県の必須項目が外れるのを再度必須項目にする
 */
function tcd_woocommerce_get_country_locale( $country_locale ) {
	if ( isset( $country_locale['JP'] ) ) {
		$country_locale['JP']['state']['required'] = true;
	}
	return $country_locale;
}

/**
 * WooCommerce Cart widget view cart button
 */
function tcd_woocommerce_widget_shopping_cart_button_view_cart() {
	echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="p-button p-button--gray wc-forward">' . esc_html__( 'View cart', 'tcd-ankle' ) . '</a>';
}

/**
 * WooCommerce Cart widget checkout button
 */
function tcd_woocommerce_widget_shopping_cart_proceed_to_checkout() {
	echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="p-button checkout wc-forward">' . esc_html__( 'Checkout', 'tcd-ankle' ) . '</a>';
}


