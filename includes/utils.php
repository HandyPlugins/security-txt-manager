<?php
/**
 * Utils
 *
 * @package SecuritytxtManager
 */

namespace SecuritytxtManager\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use const SecuritytxtManager\Constants\SETTING_OPTION;

/**
 * Is plugin activated network wide?
 *
 * @param string $plugin_file file path
 *
 * @return bool
 * @since 1.0
 */
function is_network_wide( $plugin_file ) {
	if ( ! is_multisite() ) {
		return false;
	}

	if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
		require_once ABSPATH . '/wp-admin/includes/plugin.php';
	}

	return is_plugin_active_for_network( plugin_basename( $plugin_file ) );
}

/**
 * Get settings with defaults
 *
 * @return array
 * @since  1.0
 */
function get_settings() {
	$defaults = [
		'content' => '',
		'credits' => true,
	];

	if ( SECURITY_TXT_MANAGER_IS_NETWORK ) {
		$settings = get_site_option( SETTING_OPTION, [] );
	} else {
		$settings = get_option( SETTING_OPTION, [] );
	}

	$settings = wp_parse_args( $settings, $defaults );

	return $settings;
}
