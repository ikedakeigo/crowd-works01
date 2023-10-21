<?php

// アカウント編集ページに画像アップロードフィールド追加する処理

// ankleでは使用しない


// is_woocommerce_active()



/**
 * ユーザー削除時にプロフィール画像削除
 */
function tcd_woocommerce_profile_image_delete_user( $user_id ) {
	$profile_image = get_user_meta( $user_id, 'profile_image', true );
	if ( $profile_image ) {
		tcd_woocommerce_profile_delete_uploaded_image( $profile_image, $user_id );
	}
}
add_action( 'delete_user', 'tcd_woocommerce_profile_image_delete_user', 10 );


/**
 * プロフィール画像をメディアから削除（通常の関数）
 */
function tcd_woocommerce_profile_delete_uploaded_image( $media_id, $user_id ) {
	if ( ! $media_id || ! $user_id ) {
		return false;
	}

	$post = get_post( $media_id );
	if ( ! $post || empty( $post->post_author ) ) {
		return false;
	}

	if ( intval( $post->post_author ) === intval( $user_id ) ) {
		return wp_delete_post( $post->ID, false );
	}

	return false;
}


if ( !is_admin() ) {


/**
 * WooCommerce アカウント編集 プロフィール画像用js登録
 */
function tcd_woocommerce_profile_image_wp_enqueue_scripts() {
	global $wp;

	$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
	if ( $myaccount_page_id && is_page( $myaccount_page_id ) ) {
		$edit_account_endpoint = get_option( 'woocommerce_myaccount_edit_account_endpoint', 'edit-account' );
		if ( $edit_account_endpoint && isset( $wp->query_vars[ $edit_account_endpoint ] ) ) {
			wp_enqueue_script( 'tcd-profile-image', get_template_directory_uri() . '/wc/profile-image.js', array( 'jquery' ), version_num(), true );
			wp_localize_script( 'tcd-profile-image', 'TCD_PROFILE_IMAGE', array(
				'not_image_file' => __( 'Please choose the image file.', 'tcd-ankle' )
			) );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'tcd_woocommerce_profile_image_wp_enqueue_scripts', 11 );


/**
 * WooCommerce アカウント編集フォームでアップロード可能に
 */
function tcd_woocommerce_profile_image_edit_account_form_tag() {
	echo ' enctype="multipart/form-data"';
}
add_action( 'woocommerce_edit_account_form_tag', 'tcd_woocommerce_profile_image_edit_account_form_tag' );


/**
 * WooCommerce アカウント編集 プロフィール画像フィールド追加
 */
function tcd_woocommerce_profile_image_edit_account_form() {
	$user = wp_get_current_user();
	if ( $user ) {
		$args = array(
		);
		if ( $user->profile_image ) {
			$args['profile_image_url'] = get_avatar_url( $user->ID, array( 'size' => 300 ) );
		} else {
			$args['profile_image_url'] = null;
		}
		$args['old_profile_image_url'] = $args['profile_image_url'];

		// 一時アップロードがあれば取得
		$args['uploaded_profile_image'] = $user->uploaded_profile_image;
		$args['uploaded_profile_image_url'] = null;

		if ( $args['uploaded_profile_image'] ) {
			$args['uploaded_profile_image_url'] = wp_get_attachment_url( $args['uploaded_profile_image'] );
			if ( $args['uploaded_profile_image_url'] ) {
				$args['profile_image_url'] = $args['uploaded_profile_image_url'];
			}
		}

		wc_get_template( 'myaccount/profile-image.php', $args );
	}
}
add_action( 'woocommerce_edit_account_form', 'tcd_woocommerce_profile_image_edit_account_form', 10 );


/**
 * WooCommerce アカウント保存前バリデーションでプロフィール画像アップロード処理
 */
function tcd_woocommerce_profile_image_save_account_details_errors( $errors, $user ) {
	if ( empty( $_POST['save_account_details'] ) )
		return;

	$formdata = wp_unslash( $_POST );

	// 前回アップロード削除 profile_image
	if ( isset( $formdata['uploaded_profile_image_url'] ) && ! $formdata['uploaded_profile_image_url'] ) {
		tcd_woocommerce_profile_delete_uploaded_image( $user->uploaded_profile_image, $user->ID );
	}

	// ファイルアップロード profile_image
	if ( ! empty( $_FILES['profile_image_file']['name'] ) ) {
		// 必要ファイルインクルード
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		require_once( ABSPATH . 'wp-admin/includes/image.php' );

		// メディアにアップロード
		$upload = media_handle_upload( 'profile_image_file', 0 );

		// 成功
		if ( is_int( $upload ) ) {
			// 前回の一時アップロードがあれば削除
			if ( $user->uploaded_profile_image ) {
				tcd_woocommerce_profile_delete_uploaded_image( $user->uploaded_profile_image, $user->ID );
			}

			// 一時アップロードとしてユーザーメタに保存
			update_user_meta( $user->ID, 'uploaded_profile_image', $upload );

		// エラー
		} elseif ( is_wp_error( $upload ) ) {
			$errors->add( 'profile_image-upload_error', sprintf( __( 'Failed to upload %s. (%s)', 'tcd-ankle' ), __( 'Profile image', 'tcd-ankle' ), $upload->get_error_message() ) );
		} else {
			$errors->add( 'profile_image-upload_error', sprintf( __( 'Failed to upload %s.', 'tcd-ankle' ), __( 'Profile image', 'tcd-ankle' ) ) );
		}
	}
}
add_action( 'woocommerce_save_account_details_errors', 'tcd_woocommerce_profile_image_save_account_details_errors', 10, 2 );


/**
 * WooCommerce アカウント保存時プロフィール画像保存
 */
function tcd_woocommerce_profile_image_save_account_details( $user_id ) {

	$user = get_user_by( 'id', $user_id );

	// 画像削除フラグあり
	if ( ! empty( $_POST['delete-image-profile_image'] ) ) {
		tcd_woocommerce_profile_delete_uploaded_image( $user->profile_image, $user_id );
		tcd_woocommerce_profile_delete_uploaded_image( $user->uploaded_profile_image, $user_id );
		update_user_meta( $user_id, 'profile_image', '' );
		update_user_meta( $user_id, '_profile_image', '' );
		update_user_meta( $user_id, 'uploaded_profile_image', '' );

	// 一時アップロードがあれば反映
	} elseif ( $user->uploaded_profile_image ) {
		tcd_woocommerce_profile_delete_uploaded_image( $user->profile_image, $user_id );
		update_user_meta( $user_id, 'profile_image', $user->uploaded_profile_image );
		update_user_meta( $user_id, '_profile_image', '' );
		update_user_meta( $user_id, 'uploaded_profile_image', '' );
	}
}
add_action( 'woocommerce_save_account_details', 'tcd_woocommerce_profile_image_save_account_details', 10 );



} // if !is_admin()