<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

global $dp_options;

if ( $cross_sells) {

?>
		<section id="js-cross-sells-products" class="closs_sells_products product_carousel">
		<?php

			$title = apply_filters( 'woocommerce_product_cross_sells_products_heading', $dp_options['product_single_closs_sells_products_headline'] );
			if($title){

		?>
			<h2 class="heading rich_font">
					<span><?php echo esc_html($title); ?></span>
			</h2>
		<?php
			}
		?>
			<div class="slider_wrap">
				<div id="js-closs-sells-products-slider" class="js-product-slider swiper" data-product-num="<?php echo count($cross_sells); ?>">
		<?php

			woocommerce_product_loop_start();

			foreach ( $cross_sells as $cross_sell ) :
				$post_object = get_post( $cross_sell->get_id() );
				setup_postdata( $GLOBALS['post'] =& $post_object );
				wc_get_template_part( 'content', 'product' );
			endforeach;

			woocommerce_product_loop_end();

		?>
				</div><!-- END swiper -->
				<div class="swiper-button-prev swiper_arrow"></div>
				<div class="swiper-button-next swiper_arrow"></div>
			</div>
		</section>
	<?php

	wp_reset_postdata();

};
