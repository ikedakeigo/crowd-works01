<?php
/**
 * Profile image field
 */

defined( 'ABSPATH' ) || exit;
?>
	<div class="woocommerce-form-row form-row woocommerce-form-row-profile-image">
		<label for="profile_image_file"><?php esc_html_e( 'Profile image', 'tcd-ankle' ); ?></label>
		<div class="profile-image">
			<div class="profile-image__image">
				<div class="profile-image__image-current"<?php if ( $profile_image_url ) echo ' style="background-image: url(' . esc_attr( $profile_image_url ) . ');"'; ?>></div>
				<div class="profile-image__image-bg"<?php if ( $profile_image_url ) echo ' style="display: none;"'; ?>></div>
				<a class="profile-image__delete-button" href="javascript:void(0);"></a>
			</div>
			<a class="profile-image__upload-button p-button p-button--gray" href="javascript:void(0);"><?php _e( 'Select image', 'tcd-ankle' ); ?></a>
			<input type="file" name="profile_image_file">
			<input type="hidden" name="profile_image_url" value="<?php echo esc_attr( $old_profile_image_url ); ?>">
<?php
if ( $uploaded_profile_image_url ) :
?>
			<input type="hidden" name="uploaded_profile_image_url" value="<?php echo esc_attr( $uploaded_profile_image_url ); ?>">
<?php
endif;
?>
		</div>
	</div>
