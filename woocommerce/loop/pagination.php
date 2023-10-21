<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $dp_options, $wp_query;
if ( ! $dp_options ) $dp_options = get_design_plus_option();


$max_page = $wp_query->max_num_pages;
$page_links = array();
for($i = 0; $i <= $max_page; $i++){
	$page_links[] = get_pagenum_link($i, true);
}
unset($page_links[0]);
wp_localize_script( 'archive-product-js', 'PAGE_LINKS', $page_links  );


if( $dp_options['product_archive_display_type'] == 'async' && ( is_post_type_archive( 'product' ) || is_shop() || is_product_taxonomy() ) ){

	$current_num = get_query_var( 'paged' );
	if(!$current_num) $current_num = 1;

	$display_posts = (!is_mobile()) ? $dp_options['product_archive_num'] : $dp_options['product_archive_num_sp'];
	$found_posts = $wp_query->found_posts;
	if($found_posts > $display_posts){

		$button_label = ($dp_options['product_archive_ajax_button_label']) ? esc_html($dp_options['product_archive_ajax_button_label']) : __e('MORE ITEM', 'tcd-ankle');

?>
<div id="js-ajax-loading" class="product_ajax_loading">
	<button id="js-ajax-loading-button" class="product_ajax_loading_button ajax_loading_button" data-current-page-num="<?php echo $current_num; ?>" data-max-page-num="<?php echo $max_page; ?>"><?php echo $button_label; ?></button>
	<div id="js-ajax-loading-icon" class="product_ajax_loading_icon_wrap"><span class="product_ajax_loading_icon"></span></div>
</div>
<?php

	}

}else{

	$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
	$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
	$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );

	if ( $total <= 1 ) return;

	$paginate_links = paginate_links(
		apply_filters(
			'woocommerce_pagination_args',
			array( // WPCS: XSS ok.
				'base'      => $base,
				'current'   => max( 1, $current ),
				'total'     => $total,
				'prev_text' => '&#xe90f;',
				'next_text' => '&#xe910;',
				'end_size'  => 1,
				'mid_size'  => 1,
				'type'      => 'array',
				'prev_next' => false,
			)
		)
	);

	if ( $paginate_links ) :
		echo "\t\t\t";
		echo '<ul class="pagination">';

		foreach ( $paginate_links as $paginate_link ) :
			echo '<li class="pagination_item">' . $paginate_link . '</li>';
		endforeach;

		echo '</ul>' . "\n";
	endif;

	unset( $paginate_links, $paginate_links_args );

}
