<?php
global $dp_options, $wp_is_mobile, $usces;
if ( ! $dp_options ) $dp_options = get_design_plus_options();

?>

<?php
if ( is_woocommerce_active() ) :
	// モバイルの場合、カートページ・チェックアウトページの場合は表示しない
	if ( $wp_is_mobile || is_cart() || is_checkout() ) return;
?>
				<div class="p-header-view-cart" id="js-header-view-cart">
<?php
	the_widget( 'WC_Widget_Cart', array( 'title' => '' ) );
?>
				</div>
<?php
endif;
