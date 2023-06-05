<?php
/**
 * Uninstall Security.txt
 * Deletes all plugin related data and configurations
 *
 * @package SecuritytxtManager
 */

// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

require_once 'plugin.php';

// delete plugin settings
delete_option( \SecuritytxtManager\Constants\SETTING_OPTION );
delete_site_option( \SecuritytxtManager\Constants\SETTING_OPTION );
