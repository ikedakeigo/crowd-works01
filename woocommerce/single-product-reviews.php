<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $post, $wp, $dp_options;

if ( ! comments_open() ) {
	return;
}

// ディスカッションのコメント設定を一部無視して新着順表示します

// 全コメント取得
$comments = get_comments( array(
	'orderby' => 'comment_date_gmt',
	'order' => 'DESC',
	'post_id' => $post->ID,
	'status' => 'approve'
) );
?>
<div id="reviews" class="woocommerce-Reviews">
<?php
if ( $comments ) :
?>
	<div id="comments">
		<ol class="commentlist">
<?php
	if ( get_option( 'page_comments' ) && get_option( 'comments_per_page' ) ) :
		$comments_per_page = get_option( 'comments_per_page' );

		// 「最後のページをデフォルトで表示する」対策
		if ( empty( $wp->query_vars['cpage'] ) ) :
			$comments_page = 1;
		else :
			$comments_page = get_query_var( 'cpage' );
		endif;
	else :
		$comments_page = 0;
		$comments_per_page = 0;
	endif;

	wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array(
		'callback' => 'woocommerce_comments',
		'page' => $comments_page,
		'per_page' => $comments_per_page,
		'reverse_children' => false,
		'reverse_top_level' => false
	) ), $comments );
?>
		</ol>
	</div>
<?php
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		$paginate_links = paginate_comments_links( array(
			'current' => $comments_page,
			'echo' => false,
			'next_text' => '&#xe910;',
			'prev_text' => '&#xe90f;',
			'type' => 'array'
		) );
		if ( $paginate_links ) :
			echo "\t";
			echo '<ul class="p-pager p-pager-reviews">';

			foreach ( $paginate_links as $paginate_link ) :
				echo '<li class="p-pager__item">' . $paginate_link . '</li>';
			endforeach;

			echo '</ul>' . "\n";
		endif;
	endif;
else :
?>
	<div id="comments"></div>
<?php
endif;

if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) :
?>
	<div id="review_form_wrapper">
		<div id="review_form">
<?php

	$commenter    = wp_get_current_commenter();
	$title_reply = ($dp_options['product_single_reviews_form_title']) ? wp_kses_post(nl2br($dp_options['product_single_reviews_form_title'])) : __( 'Add a review', 'tcd-ankle' );
	$label_submit = ($dp_options['product_single_reviews_form_button_label']) ? esc_html($dp_options['product_single_reviews_form_button_label']) : __( 'Submit review', 'tcd-ankle' );

	$comment_form = array(
		/* translators: %s is product title */
		'title_reply'         => $title_reply,
		/* translators: %s is product title */
		'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
		'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
		'title_reply_after'   => '</span>',
		'comment_notes_after' => '',
		'class_submit'        => 'p-button submit submit-review',
		'id_submit'           => 'submit-review',
		'label_submit'        => $label_submit,
		'comment_field'       => '',
	);

	$name_email_required = (bool) get_option( 'require_name_email', 1 );

	if ( $name_email_required ) {
		$comment_form['comment_notes_before'] = '<p class="comment-notes"><span id="email-notes">' . __( 'Your email address will not be published.', 'tcd-ankle' ) . '</span> ' . __( 'All fields are required.', 'tcd-ankle' ) . '</p>';
	}

	$fields              = array(
		'author' => array(
			'label'    => __( 'Name', 'tcd-ankle' ),
			'type'     => 'text',
			'value'    => $commenter['comment_author'],
			'required' => $name_email_required,
		),
		'email' => array(
			'label'    => __( 'Email', 'tcd-ankle' ),
			'type'     => 'email',
			'value'    => $commenter['comment_author_email'],
			'required' => $name_email_required,
		),
	);

	$comment_form['fields'] = array();

	foreach ( $fields as $key => $field ) {
		$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
		$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

		if ( ! $name_email_required && $field['required'] ) {
			$field_html .= '&nbsp;<span class="required">*</span>';
		}

		$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

		$comment_form['fields'][ $key ] = $field_html;
	}

	$account_page_url = wc_get_page_permalink( 'myaccount' );
	if ( $account_page_url ) {

		/* translators: %s opening and closing link tags respectively */
		$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
	}

	if ( wc_review_ratings_enabled() ) {

		$reviews_desc = ($dp_options['product_single_reviews_form_desc']) ? wp_kses_post(nl2br($dp_options['product_single_reviews_form_desc'])) : __( 'Your rating', 'tcd-ankle' );

		$comment_form['comment_field'] = '<div class="comment-form-rating">
	<label for="rating"><p>' . $reviews_desc . '</p></label>
	<div class="comment-form-rating-radios">
		<input type="radio" name="rating" id="rating-1" value="1">
		<input type="radio" name="rating" id="rating-2" value="2">
		<input type="radio" name="rating" id="rating-3" value="3" checked>
		<input type="radio" name="rating" id="rating-4" value="4">
		<input type="radio" name="rating" id="rating-5" value="5">
		<label class="rating-1" for="rating-1"><span>' . esc_html__( 'Very poor', 'woocommerce' ) . '</span></label>
		<label class="rating-2" for="rating-2"><span>' . esc_html__( 'Not that bad', 'woocommerce' ) . '</span></label>
		<label class="rating-3" for="rating-3"><span>' . esc_html__( 'Average', 'woocommerce' ) . '</span></label>
		<label class="rating-4" for="rating-4"><span>' . esc_html__( 'Good', 'woocommerce' ) . '</span></label>
		<label class="rating-5" for="rating-5"><span>' . esc_html__( 'Perfect', 'woocommerce' ) . '</span></label>
	</div>
</div>';
	}

	$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'tcd-ankle' ) . ( ! $name_email_required ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';
	$comment_form['comment_field'] .= '<input type="hidden" name="redirect_to" value="' . get_permalink() . '">';

	// Cookieのチェックボックス削除
	remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );

	comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );


?>
		</div>
	</div>
<?php
else :
?>
	<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
<?php
endif;
?>
	<div class="clear"></div>
</div>
