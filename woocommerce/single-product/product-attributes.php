<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! $product_attributes ) {
	return;
}


?>
<div class="wc-tab_inner">
<table class="woocommerce-product-attributes shop_attributes wc-tab__attributes-table">
	<?php foreach ( $product_attributes as $product_attribute_key => $product_attribute ) : ?>
		<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--<?php echo esc_attr( $product_attribute_key ); ?>">
			<th class="woocommerce-product-attributes-item__label"><span><?php echo wp_kses_post( $product_attribute['label'] ); ?></span></th>
			<td class="woocommerce-product-attributes-item__value"><?php echo wp_kses_post( $product_attribute['value'] ); ?></td>
		</tr>
	<?php endforeach; if($product->get_tag_ids()){ ?>
	<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--tag">
		<th class="woocommerce-product-attributes-item__label"><span><?php _e('Tags', 'tcd-ankle') ?></span></th>
		<td class="woocommerce-product-attributes-item__value"><?php echo wc_get_product_tag_list($product->get_id(), '', '<div class="woocommerce-product-attributes-item__tag-list">', '</div>' ); ?></td>
	</tr>
	<?php } ?>
</table>
</div>