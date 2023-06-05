<?php
/**
 * Plugin Name:       Security txt
 * Plugin URI:        https://handyplugins.co/
 * Description:       Security.txt manager for WordPress
 * Version:           1.0
 * Requires at least: 5.7
 * Requires PHP:      7.2
 * Author:            HandyPlugins
 * Author URI:        https://handyplugins.co/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       security-txt
 * Domain Path:       /languages
 *
 * @package           Securitytxt
 */

namespace Securitytxt;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Useful global constants.
define( 'SECURITY_TXT_VERSION', '1.0' );
define( 'SECURITY_TXT_PLUGIN_FILE', __FILE__ );
define( 'SECURITY_TXT_URL', plugin_dir_url( __FILE__ ) );
define( 'SECURITY_TXT_PATH', plugin_dir_path( __FILE__ ) );
define( 'SECURITY_TXT_INC', SECURITY_TXT_PATH . 'includes/' );

// Require Composer autoloader if it exists.
if ( file_exists( SECURITY_TXT_PATH . '/vendor/autoload.php' ) ) {
	require_once SECURITY_TXT_PATH . 'vendor/autoload.php';
}

// Include files.
require_once SECURITY_TXT_INC . 'constants.php';
require_once SECURITY_TXT_INC . 'utils.php';
require_once SECURITY_TXT_INC . 'core.php';
require_once SECURITY_TXT_INC . 'admin.php';

$network_activated = Utils\is_network_wide( SECURITY_TXT_PLUGIN_FILE );
if ( ! defined( 'SECURITY_TXT_IS_NETWORK' ) ) {
	define( 'SECURITY_TXT_IS_NETWORK', $network_activated );
}


/**
 * Setup routine
 *
 * @return void
 */
function setup_security_txt() {
	Core\setup();
	Admin\setup();
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\setup_security_txt' );


// Activation/Deactivation.
register_activation_hook( SECURITY_TXT_PLUGIN_FILE, '\Securitytxt\Core\add_capability' );
register_deactivation_hook( SECURITY_TXT_PLUGIN_FILE, '\Securitytxt\Core\deactivate' );
