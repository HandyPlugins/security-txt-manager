<?php
/**
 * Plugin Name:       Security txt Manager
 * Plugin URI:        https://github.com/HandyPlugins/security-txt-manager
 * Description:       Security.txt Manager for WordPress.
 * Version:           1.0
 * Requires at least: 5.7
 * Requires PHP:      7.2
 * Author:            HandyPlugins
 * Author URI:        https://handyplugins.co/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       security-txt-manager
 * Domain Path:       /languages
 *
 * @package           SecuritytxtManager
 */

namespace SecuritytxtManager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Useful global constants.
define( 'SECURITY_TXT_MANAGER_VERSION', '1.0' );
define( 'SECURITY_TXT_MANAGER_PLUGIN_FILE', __FILE__ );
define( 'SECURITY_TXT_MANAGER_URL', plugin_dir_url( __FILE__ ) );
define( 'SECURITY_TXT_MANAGER_PATH', plugin_dir_path( __FILE__ ) );
define( 'SECURITY_TXT_MANAGER_INC', SECURITY_TXT_MANAGER_PATH . 'includes/' );

// Require Composer autoloader if it exists.
if ( file_exists( SECURITY_TXT_MANAGER_PATH . '/vendor/autoload.php' ) ) {
	require_once SECURITY_TXT_MANAGER_PATH . 'vendor/autoload.php';
}

// Include files.
require_once SECURITY_TXT_MANAGER_INC . 'constants.php';
require_once SECURITY_TXT_MANAGER_INC . 'utils.php';
require_once SECURITY_TXT_MANAGER_INC . 'core.php';
require_once SECURITY_TXT_MANAGER_INC . 'admin.php';

$network_activated = Utils\is_network_wide( SECURITY_TXT_MANAGER_PLUGIN_FILE );
if ( ! defined( 'SECURITY_TXT_MANAGER_IS_NETWORK' ) ) {
	define( 'SECURITY_TXT_MANAGER_IS_NETWORK', $network_activated );
}


/**
 * Setup routine
 *
 * @return void
 */
function setup_security_txt_manager() {
	Core\setup();
	Admin\setup();
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\setup_security_txt_manager' );


// Activation/Deactivation.
register_activation_hook( SECURITY_TXT_MANAGER_PLUGIN_FILE, '\SecuritytxtManager\Core\add_capability' );
register_deactivation_hook( SECURITY_TXT_MANAGER_PLUGIN_FILE, '\SecuritytxtManager\Core\deactivate' );
