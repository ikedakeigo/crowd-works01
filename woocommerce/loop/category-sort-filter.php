<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $dp_options;
if ( ! $dp_options ) $dp_options = get_design_plus_option();


// 商品検索ページでは、フィルターを表示しない
if(( !is_search() && $dp_options['show_product_archive_filter'] ) && ( is_shop() || is_post_type_archive( 'product' ) || is_product_taxonomy() )){

	$queried_object = get_queried_object();
	$is_product_category = is_product_category();

?>
			<div class="p-archive03__sort-filter<?php if ( 'yes' !== get_option( 'woocommerce_hide_out_of_stock_items' ) ) echo ' has-3items'; ?>">
<?php

	// 商品カテゴリーを取得
	$selected_categories = $dp_options['product_archive_filter_categories'];

	if ( !empty( $selected_categories ) ) {

		$shop_page = get_page( wc_get_page_id( 'shop' ) );
		$shop_label = $dp_options['product_archive_filter_category_label'];

		if ( is_shop() && $shop_page ) {
			$item_title = ($shop_label) ? $shop_label : $shop_page->post_title;
		} elseif ( $is_product_category ) {
			$item_title = $queried_object->name;
		} else {
			$item_title = __( 'Category', 'tcd-ankle' );
		};

?>
				<div class="p-archive03__sort-filter__item">
					<div class="p-archive03__sort-filter__item-title"><?php echo esc_html( $item_title ); ?></div>
					<ul class="p-archive03__sort-filter__item-dropdown js-product-archive__category">
<?php
		if ( $shop_page ) {
			$filter_label = ($shop_label) ? $shop_label : $shop_page->post_title;
?>
						<li<?php if ( is_shop() ) echo ' class="is-active"'; ?>><a href="<?php echo get_permalink( $shop_page ); ?>"><?php echo esc_html( $filter_label ); ?></a></li>
<?php

		};

		foreach($selected_categories as $cat_id) :

			$cat_id = (int) $cat_id;
			$cat = get_term($cat_id, 'product_cat');
			if($cat && !is_wp_error($cat)){

				$sep = '&nbsp;&nbsp;&nbsp;';
				$class = '';
				if($is_product_category && $queried_object->term_id === $cat_id ) $class = 'is-active';
				$depth = 1;
				if($cat->parent !== 0) $depth = 2;

?>
						<li class="<?php echo $class; ?>"><a href="<?php echo get_term_link( $cat ); ?>"><?php echo str_repeat( '&nbsp;&nbsp;&nbsp;', $depth ) . esc_html( $cat->name ); ?></a></li>
<?php

			}
		endforeach;

?>
					</ul>
				</div>
<?php

	};

	// ソート
	if($dp_options['product_archive_filter_date'] || $dp_options['product_archive_filter_popularity'] || $dp_options['product_archive_filter_rating'] || $dp_options['product_archive_filter_price'] || $dp_options['product_archive_filter_price-desc']) {
		woocommerce_catalog_ordering();
	}

	// 在庫フィルター
	if ( 'yes' !== get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
		
		$stocks = array(
			'in_stock' => __( 'In stock', 'tcd-ankle' ),
			'all' => __( 'All', 'tcd-ankle' )
		);
		if ( ! empty( $_GET['stock'] ) && array_key_exists( $_GET['stock'], $stocks ) ) {
			$stock = $_GET['stock'];
		} else {
			$stock = 'all';
		}

?>
				<div class="p-archive03__sort-filter__item">
					<div class="p-archive03__sort-filter__item-title"><?php echo esc_html( $stocks[$stock] ); ?></div>
					<ul class="p-archive03__sort-filter__item-dropdown js-product-archive__stock">
<?php
	foreach ( $stocks as $key => $value ) :
?>
						<li<?php if ( $stock === $key ) echo ' class="is-active"'; ?> data-value="<?php echo esc_html( $key ); ?>"><span><?php echo esc_html( $value ); ?></span></li>
<?php
	endforeach;
?>
					</ul>
				</div>
<?php
	}
?>
			</div>
<?php

}

