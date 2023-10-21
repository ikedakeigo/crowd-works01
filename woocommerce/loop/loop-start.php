<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$loop_type = wc_get_loop_prop('name');

// カルーセル
if($loop_type == 'related' || $loop_type == 'cross-sells' || $loop_type == 'up-sells'){
	$loop_class = 'swiper-wrapper related_loop';

// チェックした商品
}elseif($loop_type == 'recentry-viewed-products'){
	$loop_class = 'swiper-wrapper recentry_viewed_products_loop';

// ウィッシュリスト
}elseif($loop_type == 'wishlist'){
	$loop_class = 'wishlist_loop';

// それ以外
}else{
	$loop_class = 'product_loop';
}

?>
				<div class="<?php echo $loop_class; ?>">
