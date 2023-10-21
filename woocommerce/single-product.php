<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $dp_options, $post;
if ( ! $dp_options ) $dp_options = get_design_plus_options();

get_header( 'shop' );
?>
<!-- <main id="single_product" class="l-main"> -->
<?php
get_template_part( 'template-parts/breadcrumb' );
?>
	<main id="main_contents">
<?php
/**
 * Hook: woocommerce_after_main_content.
 */
do_action( 'woocommerce_before_main_content' );

if ( have_posts() ) :
	the_post();
	wc_get_template_part( 'content', 'single-product' );
endif;

/**
 * Hook: woocommerce_after_main_content.
 */
do_action( 'woocommerce_after_main_content' );

?>
<?php
// if ( $active_sidebar ) :
	/**
	 * Hook: woocommerce_sidebar.
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	// do_action( 'woocommerce_sidebar' );
// endif;
?>
	</main>
<!-- </main> -->
<?php
get_footer( 'shop' );
