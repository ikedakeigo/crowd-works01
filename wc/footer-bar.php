<?php

// wc必須

function render_wc_footer_bar() {

  global $product, $post;

  // 商品詳細ページ && 在庫ありだったら表示
  if( is_woocommerce_active() && is_product() ){

  $label = '';
  if($product->get_type() !== 'external') $label = __( 'Add to cart', 'tcd-ankle' );

?>
<div id="js-product-footer-bar" class="product_footer_bar">
  <div class="product_footer_bar_inner">
    <button id="js-product-footer-bar-cart" class="product_footer_cart_button"><?php echo $label; ?></button>
    <button id="js-product-footer-bar-like" class="product_footer_like_button"></button>
  </div>  
</div>
<?php

  }
}
add_action( 'wp_footer', 'render_wc_footer_bar' );


// お気に入りモーダル
function render_wc_like_message() {
  echo '<div id="js-like-modal-message" class="product_like_message_wrap"></div>';
}
add_action( 'wp_footer', 'render_wc_like_message' );