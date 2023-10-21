<?php
/**
 * Class WC_Email_Customer_Delete_Account file.
 *
 * @package WooCommerce\Emails
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! class_exists( 'WC_Email_Customer_Delete_Account', false ) ) :

	/**
	 * Customer Delete Account.
	 *
	 * An email sent to the customer when they delete an account.
	 *
	 * @class       WC_Email_Customer_New_Account
	 * @version     3.5.0
	 * @package     WooCommerce/Classes/Emails
	 * @extends     WC_Email
	 */
	class WC_Email_Customer_Delete_Account extends WC_Email {

		/**
		 * User login name.
		 *
		 * @var string
		 */
		public $user_login;

		/**
		 * User email.
		 *
		 * @var string
		 */
		public $user_email;

		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->id             = 'customer_delete_account';
			$this->customer_email = true;
			$this->title          = __( 'Delete account', 'tcd-ankle' );
			$this->description    = __( 'Customer "delete account" emails are sent to the customer when click the delete account via edit account page.', 'tcd-ankle' );
			$this->template_html  = 'emails/customer-delete-account.php';
			$this->template_plain = 'emails/plain/customer-delete-account.php';

			// Call parent constructor.
			parent::__construct();
		}

		/**
		 * Get email subject.
		 *
		 * @since  3.1.0
		 * @return string
		 */
		public function get_default_subject() {
			return __( 'Your {site_title} account has been deleted.', 'tcd-ankle' );
		}

		/**
		 * Get email heading.
		 *
		 * @since  3.1.0
		 * @return string
		 */
		public function get_default_heading() {
			return __( 'Your {site_title} account has been deleted.', 'tcd-ankle' );
		}

		/**
		 * Trigger.
		 *
		 * @param int    $user_id User ID.
		 */
		public function trigger( $user_id ) {
			$this->setup_locale();

			if ( $user_id ) {
				$this->object = new WP_User( $user_id );

				$this->user_login         = stripslashes( $this->object->user_login );
				$this->user_email         = stripslashes( $this->object->user_email );
				$this->recipient          = $this->user_email;
			}

			if ( $this->is_enabled() && $this->get_recipient() ) {
				$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
			}

			$this->restore_locale();
		}

		/**
		 * Get content html.
		 *
		 * @return string
		 */
		public function get_content_html() {
			return wc_get_template_html(
				$this->template_html,
				array(
					'email_heading'      => $this->get_heading(),
					'additional_content' => $this->get_additional_content(),
					'user_login'         => $this->user_login,
					'blogname'           => $this->get_blogname(),
					'sent_to_admin'      => false,
					'plain_text'         => false,
					'email'              => $this,
				)
			);
		}

		/**
		 * Get content plain.
		 *
		 * @return string
		 */
		public function get_content_plain() {
			return wc_get_template_html(
				$this->template_plain,
				array(
					'email_heading'      => $this->get_heading(),
					'additional_content' => $this->get_additional_content(),
					'user_login'         => $this->user_login,
					'blogname'           => $this->get_blogname(),
					'sent_to_admin'      => false,
					'plain_text'         => true,
					'email'              => $this,
				)
			);
		}

		/**
		 * Default content to show below main email content.
		 *
		 * @since 3.7.0
		 * @return string
		 */
		public function get_default_additional_content() {
			return __( 'We hope to see you again.', 'tcd-ankle' );
		}

		/**
		 * Admin Options.
		 *
		 * Setup the email settings screen.
		 * Override this in your email.
		 *
		 * @since 1.0.0
		 */
		public function admin_options() {
			// Do admin actions.
			$this->admin_actions();
			?>
			<h2><?php echo esc_html( $this->get_title() ); ?> <?php wc_back_link( __( 'Return to emails', 'woocommerce' ), admin_url( 'admin.php?page=wc-settings&tab=email' ) ); ?></h2>

			<?php echo wpautop( wp_kses_post( $this->get_description() ) ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>

			<?php
			/**
			 * Action hook fired before displaying email settings.
			 *
			 * @param string $email The email object
			 */
			do_action( 'woocommerce_email_settings_before', $this );
			?>

			<table class="form-table">
				<?php $this->generate_settings_html(); ?>
			</table>

			<?php
			/**
			 * Action hook fired after displaying email settings.
			 *
			 * @param string $email The email object
			 */
			do_action( 'woocommerce_email_settings_after', $this );
			?>

			<?php

			if ( current_user_can( 'edit_themes' ) && ( ! empty( $this->template_html ) || ! empty( $this->template_plain ) ) ) {
				?>
				<div id="template">
					<?php
					$templates = array(
						'template_html'  => __( 'HTML template', 'woocommerce' ),
						'template_plain' => __( 'Plain text template', 'woocommerce' ),
					);

					foreach ( $templates as $template_type => $title ) :
						$template = $this->get_template( $template_type );

						if ( empty( $template ) ) {
							continue;
						}

						$local_file    = $this->get_theme_template_file( $template );
						$core_file     = $this->template_base . $template;
						$template_file = apply_filters( 'woocommerce_locate_core_template', $core_file, $template, $this->template_base, $this->id );
						$template_dir  = apply_filters( 'woocommerce_template_directory', 'woocommerce', $template );
						?>
						<div class="template <?php echo esc_attr( $template_type ); ?>">
							<h4><?php echo wp_kses_post( $title ); ?></h4>

							<?php if ( file_exists( $local_file ) ) : ?>
								<p>
									<a href="#" class="button toggle_editor"></a>
								</p>

								<div class="editor" style="display:none">
									<textarea class="code" cols="25" rows="20"
									<?php
									if ( ! is_writable( $local_file ) ) : // phpcs:ignore WordPress.VIP.FileSystemWritesDisallow.file_ops_is_writable
										?>
										readonly="readonly" disabled="disabled"
									<?php else : ?>
										data-name="<?php echo esc_attr( $template_type ) . '_code'; ?>"<?php endif; ?>><?php echo esc_html( file_get_contents( $local_file ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents ?></textarea>
								</div>
							<?php else : ?>
								<p><?php esc_html_e( 'File was not found.', 'woocommerce' ); ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>

				<?php
				wc_enqueue_js(
					"jQuery( 'select.email_type' ).change( function() {

						var val = jQuery( this ).val();

						jQuery( '.template_plain, .template_html' ).show();

						if ( val != 'multipart' && val != 'html' ) {
							jQuery('.template_html').hide();
						}

						if ( val != 'multipart' && val != 'plain' ) {
							jQuery('.template_plain').hide();
						}

					}).change();

					var view = '" . esc_js( __( 'View template', 'woocommerce' ) ) . "';
					var hide = '" . esc_js( __( 'Hide template', 'woocommerce' ) ) . "';

					jQuery( 'a.toggle_editor' ).text( view ).toggle( function() {
						jQuery( this ).text( hide ).closest(' .template' ).find( '.editor' ).slideToggle();
						return false;
					}, function() {
						jQuery( this ).text( view ).closest( '.template' ).find( '.editor' ).slideToggle();
						return false;
					} );

					jQuery( 'a.delete_template' ).click( function() {
						if ( window.confirm('" . esc_js( __( 'Are you sure you want to delete this template file?', 'woocommerce' ) ) . "') ) {
							return true;
						}

						return false;
					});

					jQuery( '.editor textarea' ).change( function() {
						var name = jQuery( this ).attr( 'data-name' );

						if ( name ) {
							jQuery( this ).attr( 'name', name );
						}
					});"
				);
			}
		}
	}

endif;

return new WC_Email_Customer_Delete_Account();
