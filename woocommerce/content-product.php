<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $dp_options, $post, $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) return;

// WooCommerce用変数
$is_woocommerce_active = is_woocommerce_active();
$is_woocommerce_product = false;
if ( $is_woocommerce_active && 'product' === $post->post_type ) {
	$product = wc_get_product( $post );
	if ( $product ) $is_woocommerce_product = true;
};

// 画像
$image_url = null;
$image_ids = array();
$image_id = $product->get_image_id(); // 商品画像
$gallery_image_ids = $product->get_gallery_image_ids(); // ギャラリー画像のid配列
$image_size = (is_mobile()) ? 'square2' : 'square3';

if ( $image_id ) $image_ids[] = $image_id;
if ( $gallery_image_ids ) $image_ids = array_merge( $image_ids, $gallery_image_ids );

if ( $image_ids ) {
	$image_id = array_shift( $image_ids );
	$image = wp_get_attachment_image_src( $image_id, $image_size );
	if ( $image ) $image_url = $image[0];
}else{
	$image_url = wc_placeholder_img_src( $image_size );
	if(!$image_url) $image_url = $image[0] = get_template_directory_uri() . "/img/common/no_image1.gif";
}

// カテゴリー
$category = wp_get_post_terms( $post->ID, 'product_cat' , array( 'orderby' => 'term_order' ));
if ( $category && ! is_wp_error($category) ) {
	foreach ( $category as $cat ) :
		$cat_name = $cat->name;
		$cat_id = $cat->term_id;
		$cat_url = get_term_link($cat_id,'product_cat');
		break;
	endforeach;
};

// スライダー用クラス
$loop_type = wc_get_loop_prop('name');

// カルーセル
$slider_class = '';
if($loop_type == 'related' || $loop_type == 'cross-sells' || $loop_type == 'up-sells' || $loop_type == 'recentry-viewed-products'){
	$slider_class = ' swiper-slide';
}

// バッジ
$badge = get_tcd_product_badge($product, $dp_options);



?>
<article <?php wc_product_class( 'product_item'.$slider_class , $product ); ?>>
<?php

	if($loop_type == 'wishlist'){
		echo '<button class="wishlist_remove_button js-product-remove-like" href="javascript:void(0);" data-post-id="'.esc_attr( $post->ID ).'">&#xe91a;</button>';
	}

?>
	<a class="link animate_background no_editor_style" href="<?php the_permalink(); ?>">
<?php
/**
 * Hook: woocommerce_before_shop_loop_item.
 */
do_action( 'woocommerce_before_shop_loop_item' );

?>
		<div class="image_wrap">
			<div class="image" style="background: url(<?php echo esc_attr( $image_url ); ?>) no-repeat center; background-size:cover;"></div>
		</div>

		<div class="content_wrap">
			<div class="category">
				<span class="category_link cat_id<?php echo esc_attr($cat_id); ?> js-category-link" data-href="<?php echo esc_attr($cat_url); ?>"><?php echo esc_html($cat_name); ?></span>
			</div>
<?php

/**
 * Hook: woocommerce_before_shop_loop_item_title.
 */
do_action( 'woocommerce_before_shop_loop_item_title' );
?>
			<h3 class="title rich_font no_editor_style line1"><span><?php the_title(); ?></span></h3>
<?php
/**
 * Hook: woocommerce_shop_loop_item_title.
 */
do_action( 'woocommerce_shop_loop_item_title' );

/**
 * Hook: woocommerce_after_shop_loop_item_title.
 *
 * @hooked woocommerce_template_loop_rating - 5
 * @hooked woocommerce_template_loop_price - 10
 */
do_action( 'woocommerce_after_shop_loop_item_title' ); // price
?>
		</div>

	</a>
<?php

	if($loop_type !== 'wishlist'){

?>
	<div class="cart_wrap">
    <span class="spacer"></span>

		<?php if($badge['is_active']) { ?>
		<span class="highlight_label" style="background-color:<?php echo esc_attr($badge['bg_color']); ?>;"><?php echo esc_html($badge['label']); ?></span>
		<?php }
		
			if($product->is_in_stock()){
		
		?>
    <div class="cart_wrap_inner">

      <!-- いいねボタン -->
      <div class="like_button js-product-toggle-like<?php if ( is_liked( $post->ID ) ) echo ' is-liked'; ?>" data-post-id="<?php echo $post->ID; ?>"></div>

      <!-- カートボタン -->
			<?php

				$product_type = $product->get_type();
				if( ( $product_type == 'simple' && $product->is_purchasable() ) ){
			
			?>
      <div class="cart_button_wrap">
        <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', wc_get_cart_url() ) ); ?>" method="post" enctype='multipart/form-data'>
          <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="cart_button"></button>
        </form>
      </div>
<?php

				}

?>
    </div>
		<?php

			}else{

				$outofstock_label = ($dp_options['product_list_outofstock_label']) ? $dp_options['product_list_outofstock_label'] : __('SOLD OUT', 'tcd-ankle');
				$outofstock_bg_color = implode(",",hex2rgb($dp_options['product_list_outofstock_bg_color']));
		
		?>
		<div class="outofstock_label" style="background-color:rgba(<?php echo esc_attr($outofstock_bg_color); ?>, 0.7);">
			<span><?php echo esc_html($outofstock_label); ?></span>
		</div>
		<?php } ?>
	</div>
<?php

	}elseif($loop_type === 'wishlist'){

		echo '<div class="wishlist_cart">';
		woocommerce_template_loop_add_to_cart();
		echo '</div>';

	}elseif(!$product->is_in_stock()){

		

	}

?>
</article>