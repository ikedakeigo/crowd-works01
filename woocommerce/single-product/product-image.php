<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $dp_options, $product, $post;


// 商品画像
$image_urls = array();
$image_ids = array();
$image_id = $product->get_image_id();
$gallery_image_ids = $product->get_gallery_image_ids();

if ( $image_id ) {
	$image_ids[] = $image_id;
}

if ( $gallery_image_ids ) {
	$image_ids = array_merge( $image_ids, $gallery_image_ids );
};

if ( $image_ids ) {
	foreach( $image_ids as $key => $image_id ) :
		$image = wp_get_attachment_image_src( $image_id, 'full' );
		if ( $image ) {
			$image_urls[] = $image[0];
			if ( 10 <= count( $image_urls ) ) break;
		};
	endforeach;
};

// 商品カテゴリー
$product_float_category = null;

if(!$image_urls) $image_urls[0] = wc_placeholder_img_src( 'full' );

if ( $image_urls ) :

?>
	<div class="p-entry-product__images has-images--<?php echo count( $image_urls ); ?>" id="js-entry-product__images">
		<div class="p-entry-product__images-inner">
			<div class="p-entry-product__mainimage">

				<img class="p-entry-product__mainimage-normal" src="<?php echo esc_attr( $image_urls[0] ); ?>" alt="<?php the_title_attribute(); ?>">

				<div class="p-entry-product__mainimage-zoom">
					<img class="p-entry-product__mainimage-zoom-image" src="<?php echo esc_attr( $image_urls[0] ); ?>" alt="<?php the_title_attribute(); ?>">
				</div>

				<!-- <div class="p-entry-product__mainimage-zoom-icon"></div> -->

				</div>
				<div class="p-entry-product__subimages">
					<div class="p-entry-product__subimages-inner">

<?php foreach ( $image_urls as $key => $image_url ) : ?>
						<div class="p-entry-product__subimage p-entry-product__subimage p-hover-effect__bg p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); if ( 0 === $key ) echo ' is-active'; ?>" data-zoom-image="<?php echo esc_attr( $image_url ); ?>"><div class="p-entry-product__subimage-inner p-hover-effect__image" style="background-image: url(<?php echo esc_attr( $image_url ); ?>);"></div></div>
<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
<?php
endif;

