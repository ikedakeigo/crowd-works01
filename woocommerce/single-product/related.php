<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $dp_options;
if ( ! $dp_options ) $dp_options = get_design_plus_option();

if ( $related_products && $dp_options['show_product_single_related_products'] ) {

?>
<section id="js-related-products" class="related_products product_carousel">
<?php

	$title = $dp_options['product_single_related_products_headline'];
	$sub_title = $dp_options['product_single_related_products_sub_headline'];
	if($title || $sub_title){

?>
	<div class="common_header">
		<h2 class="heading rich_font">
			<?php if($title){ ?><span class="heading_top common_headline"><?php echo esc_html($title); ?></span><?php } ?>
			<?php if($sub_title){ ?><span class="heading_bottom"><?php echo esc_html($sub_title); ?></span><?php } ?>
		</h2>
	</div>
<?php
	}
?>
	<div class="slider_wrap">
		<div id="js-related-products-slider" class="js-product-slider swiper" data-product-num="<?php echo count($related_products); ?>">
<?php

	woocommerce_product_loop_start();

	foreach ( $related_products as $related_product ) :
		$post_object = get_post( $related_product->get_id() );
		setup_postdata( $GLOBALS['post'] =& $post_object );
		wc_get_template_part( 'content', 'product' );
	endforeach;

	woocommerce_product_loop_end();

?>
		</div><!-- END swiper -->
		<div class="swiper-button-prev swiper_arrow"></div>
		<div class="swiper-button-next swiper_arrow"></div>
	</div>
</section><!-- END related_priducts -->
<?php
	wp_reset_postdata();

};
