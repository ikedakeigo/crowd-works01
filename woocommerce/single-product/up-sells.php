<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $dp_options;
if ( ! $dp_options ) $dp_options = get_design_plus_option();

if ( $upsells ) {

?>
<section id="js-up-sells-products" class="related_products product_carousel">
<?php

	$title = $dp_options['product_single_upsells_products_headline'];
	$sub_title = $dp_options['product_single_upsells_products_sub_headline'];
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
		<div id="js-up-sells-products-slider" class="js-product-slider swiper" data-product-num="<?php echo count($upsells); ?>">
<?php

	woocommerce_product_loop_start();
	foreach ( $upsells as $upsell ) :
		$post_object = get_post( $upsell->get_id() );
		setup_postdata( $GLOBALS['post'] =& $post_object );
		wc_get_template_part( 'content', 'product' );
	endforeach;
	woocommerce_product_loop_end();

?>
		</div><!-- END swiper -->
		<div class="swiper-button-prev swiper_arrow"></div>
		<div class="swiper-button-next swiper_arrow"></div>
	</div>
</section><!-- END #up_sells_priducts -->
<?php
	wp_reset_postdata();

}
