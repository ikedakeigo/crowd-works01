<?php
global $dp_options;
if ( ! $dp_options ) $dp_options = get_design_plus_options();

// モバイルの場合は表示しない
if ( is_mobile() ) return;

if ( is_woocommerce_active() ) :
	if ( is_user_logged_in() ) :
		$user = wp_get_current_user();

		// ログイン中
?>
				<div class="p-header-memberbox" id="js-header-memberbox">
					<div class="p-header-memberbox__login">
						<p><?php printf( __( 'Hello %s', 'tcd-ankle' ), esc_html( $user->display_name ) ); ?></p>
						<p class="mb10"><a class="p-button" href="<?php echo esc_attr( wc_get_account_endpoint_url( 'dashboard' ) ); ?>"><?php echo esc_html( get_woocommerce_myaccount_page_title() ); ?></a></p>
						<p><a class="p-button p-button--gray" href="<?php echo esc_attr( wc_logout_url() ); ?>"><?php _e( 'Logout', 'tcd-ankle' ); ?></a></p>
					</div>
				</div>
<?php

		// ログアウト中
	else :
?>
				<div class="p-header-memberbox" id="js-header-memberbox">
					<div class="p-header-memberbox__login">
						<form action="<?php echo esc_attr( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" method="post" onKeyDown="if (event.keyCode == 13) return false;">
							<?php do_action( 'woocommerce_login_form_start' ); ?>
							<p class="p-header-memberbox__login-email">
								<input class="p-header-memberbox__login-input" type="text" name="username" autocomplete="username" placeholder="<?php _e( 'Username or email address', 'woocommerce' ); ?>">
							</p>
							<p class="p-header-memberbox__login-password">
								<input class="p-header-memberbox__login-input" type="password" name="password" autocomplete="current-password" placeholder="<?php _e( 'Password', 'tcd-ankle' ); ?>">
							</p>
							<p class="p-header-memberbox__login-rememberme">
								<label><input name="rememberme" type="checkbox" value="forever"> <span><?php esc_html_e( 'Remember me', 'tcd-ankle' ); ?></span></label>
							</p>
							<?php do_action( 'woocommerce_login_form' ); ?>
							<p class="p-header-memberbox__login-button">
								<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
								<input type="hidden" name="redirect" value="">
								<button type="submit" class="p-button" name="login" value="<?php esc_attr_e( 'Login', 'tcd-ankle' ); ?>"><?php esc_html_e( 'Login', 'tcd-ankle' ); ?></button>
							</p>
							<p class="p-header-memberbox__login-lostpassword"><a href="<?php echo esc_attr( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'tcd-ankle' ); ?></a></p>
							<?php do_action( 'woocommerce_login_form_end' ); ?>
						</form>
					</div>

					<?php

						$account_page_url = wc_get_page_permalink( 'myaccount' );
						if('yes' === get_option( 'woocommerce_enable_myaccount_registration' ) && $account_page_url){
					
					?>
					<div class="p-header-memberbox__registration">
						<a href="<?php echo esc_url($account_page_url); ?>" class="p-button"><?php esc_attr_e( 'Registration', 'tcd-ankle' ); ?></a>
					</div>
					<?php } ?>
				</div>
<?php
	endif;
endif;
