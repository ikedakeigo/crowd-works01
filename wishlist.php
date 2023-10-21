<?php
global $dp_options, $wp_query;
if ( ! $dp_options ) $dp_options = get_design_plus_option();

// 削除された商品が残っている場合があるのでここでリセット
if ( 0 === $wp_query->found_posts ) {

	$user_id = get_current_user_id();
	if ( $user_id ) :
		delete_user_meta( $user_id, 'tcd_likes' );
	elseif ( ! empty( $_COOKIE['tcd_likes'] ) ) :
		setcookie( 'tcd_likes', '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN );
	endif;

}

// loop set
wc_set_loop_prop('name','wishlist');

get_header();

$wishlist_label = ($dp_options['product_wishlist_label']) ? ($dp_options['product_wishlist_label']) : __( 'Wishlist', 'tcd-ankle' );

?>
<main class="wishlist woocommerce">

	<div class="wishlist_inner">
		<div class="common_header archive">
			<h1 class="heading rich_font">
				<span class="heading_top common_headline"><?php echo esc_html($wishlist_label); ?></span>
			</h1>
		</div>
		<div id="js-wishlist-counter" class="<?php echo 'item_count_'.$wp_query->found_posts; ?>"></div>
<?php

	if ( have_posts() ) :

		do_action( 'tcd_wishlist_before_loop' );

		woocommerce_product_loop_start();

		while ( have_posts() ) : the_post();
			wc_get_template_part( 'content', 'product' );
		endwhile;

		woocommerce_product_loop_end();

		get_template_part( 'template-parts/pager' );
		do_action( 'tcd_wishlist_after_loop' );

	endif;

	$no_wishlist_message = ($dp_options['product_wishlist_message']) ? ($dp_options['product_wishlist_message']) : __( 'There are no items on your wishlist yet.', 'tcd-ankle' );
	echo '<p class="no_wishlist">'.wp_kses_post(nl2br($no_wishlist_message)).'</p>';

?>
	</div>
</main>
<?php

get_footer();
