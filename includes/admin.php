<?php
/**
 * Admin Page
 *
 * @package SecuritytxtManager
 */

namespace SecuritytxtManager\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use const SecuritytxtManager\Constants\CAPABILITY;
use const SecuritytxtManager\Constants\SETTING_OPTION;

/**
 * Default setup routine
 *
 * @return void
 */
function setup() {
	if ( SECURITY_TXT_MANAGER_IS_NETWORK ) {
		add_action( 'network_admin_menu', __NAMESPACE__ . '\\network_admin_menu' );
	} else {
		add_action( 'admin_menu', __NAMESPACE__ . '\\admin_menu' );
	}
	add_action( 'admin_init', __NAMESPACE__ . '\\save_settings' );
}

/**
 * Add admin menu
 *
 * @return void
 */
function network_admin_menu() {
	add_submenu_page(
		'settings.php',
		esc_html__( 'Security.txt', 'security-txt-manager' ),
		esc_html__( 'Security.txt', 'security-txt-manager' ),
		'manage_network',
		'security-txt-settings',
		__NAMESPACE__ . '\\securitytxt_settings_screen'
	);
}

/**
 * Add admin menu
 *
 * @return void
 */
function admin_menu() {
	add_options_page(
		esc_html__( 'Security.txt', 'security-txt-manager' ),
		esc_html__( 'Security.txt', 'security-txt-manager' ),
		CAPABILITY,
		'security-txt-settings',
		__NAMESPACE__ . '\\securitytxt_settings_screen'
	);
}

/**
 * Settings screen
 *
 * @return void
 */
function securitytxt_settings_screen() {
	$settings = \SecuritytxtManager\Utils\get_settings();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Security.txt Manager', 'security-txt-manager' ); ?></h1>
		<?php if ( is_network_admin() ) : ?>
			<?php settings_errors(); ?>
		<?php endif; ?>

		<form method="post" action="">
			<?php
			wp_nonce_field( 'security_txt', 'security_txt_nonce' );
			?>
			<p>
				<?php
				// Translators: %1$s Link to securitytxt.org website
				printf( __( 'You can generate security.txt content on %1$s', 'security-txt-manager' ), '<a  rel="noopener" target="_blank" href="https://securitytxt.org/">securitytxt.org</a>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</p>
			<label class="screen-reader-text" for="security_txt_content"><?php esc_html_e( 'Security.txt content', 'security-txt-manager' ); ?></label>
			<textarea class="widefat code" rows="25" name="security_txt_content" id="security_txt_content"><?php echo esc_textarea( $settings['content'] ); ?></textarea>

			<table class="form-table">
				<tr>
					<th scope="row"><label for="is_sandbox"><?php esc_html_e( 'Credits', 'security-txt-manager' ); ?></label></th>
					<td>
						<label>
							<input type="checkbox" <?php checked( $settings['credits'], 1 ); ?> id="credits" name="credits" value="1">
							<?php esc_html_e( 'Enable credits at the bottom of your security.txt file.', 'security-txt-manager' ); ?>
						</label>
					</td>
				</tr>
			</table>

			<?php
			submit_button( esc_html__( 'Save Changes', 'security-txt-manager' ), 'submit primary' );
			?>
		</form>
	</div>
	<?php
}

/**
 * Save settings
 *
 * @return void
 */
function save_settings() {
	$settings = [];

	$nonce = filter_input( INPUT_POST, 'security_txt_nonce', FILTER_SANITIZE_SPECIAL_CHARS );

	if ( wp_verify_nonce( $nonce, 'security_txt' ) ) {
		$security_txt_content = sanitize_textarea_field( filter_input( INPUT_POST, 'security_txt_content' ) );
		$settings['content']  = $security_txt_content;
		$settings['credits']  = (bool) filter_input( INPUT_POST, 'credits' );

		if ( SECURITY_TXT_MANAGER_IS_NETWORK ) {
			update_site_option( SETTING_OPTION, $settings );
		} else {
			update_option( SETTING_OPTION, $settings, false );
		}

		add_settings_error( 'security-txt-settings', 'security-txt-settings', esc_html__( 'Settings saved.', 'security-txt-manager' ), 'success' );
	}

}
