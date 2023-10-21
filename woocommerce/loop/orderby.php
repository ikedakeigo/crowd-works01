<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
				<div class="p-archive03__sort-filter__item">
					<div class="p-archive03__sort-filter__item-title"><?php echo esc_html( $orderby && ! empty( $catalog_orderby_options[$orderby] ) ? $catalog_orderby_options[$orderby] : __( 'Sort by', 'tcd-ankle' ) ); ?></div>
					<ul class="p-archive03__sort-filter__item-dropdown js-product-archive__sort">
<?php
foreach ( $catalog_orderby_options as $key => $value ) :
?>
						<li<?php if ( $orderby === $key ) echo ' class="is-active"'; ?> data-value="<?php echo esc_html( $key ); ?>"><span><?php echo esc_html( $value ); ?></span></li>
<?php
endforeach;
?>
					</ul>
				</div>
