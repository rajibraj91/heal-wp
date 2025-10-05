<?php
/**
 * Plugin Name: Heal Core
 * Description: Companion plugin for the Heal theme — CPTs, metaboxes, Elementor widgets, shortcodes, and one-click demo import.
 * Version: 3.2.4
 * Author: CodexCoder
 * Text Domain: heal-core
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Version: 3.2.4
 * Developer: Rajib Raj
 * Email: rajibraj3d@gmail.com
*/	





/**
 * If this file is called directly, abort.
 * @package heal
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Plugin directory path
 * @package heal
 * @since 1.0.0
 */
define( 'HEAL_CORE_ROOT_PATH', plugin_dir_path( __FILE__ ) );
define( 'HEAL_CORE_ROOT_URL', plugin_dir_url( __FILE__ ) );
define( 'HEAL_CORE_SELF_PATH', 'heal-core/heal-core.php' );
define( 'HEAL_CORE_VERSION', '1.0.0' );
define( 'HEAL_CORE_INC', HEAL_CORE_ROOT_PATH .'/inc');
define( 'HEAL_CORE_LIB', HEAL_CORE_ROOT_PATH .'/lib');
define( 'HEAL_CORE_ELEMENTOR', HEAL_CORE_ROOT_PATH .'/elementor');
define( 'HEAL_CORE_DEMO_IMPORT', HEAL_CORE_ROOT_PATH .'/demo-import');
define( 'HEAL_CORE_ADMIN', HEAL_CORE_ROOT_PATH .'/admin');
define( 'HEAL_CORE_ADMIN_ASSETS', HEAL_CORE_ROOT_URL .'admin/assets');
define( 'HEAL_CORE_WP_WIDGETS', HEAL_CORE_ROOT_PATH .'/wp-widgets');
define( 'HEAL_CORE_ASSETS', HEAL_CORE_ROOT_URL .'assets/');
define( 'HEAL_CORE_CSS', HEAL_CORE_ASSETS .'css');
define( 'HEAL_CORE_JS', HEAL_CORE_ASSETS .'js');
define( 'HEAL_CORE_IMG', HEAL_CORE_ASSETS .'img');


/**
 * Load additional helpers functions
 * @package heal
 * @since 1.0.0
 */
if (!function_exists('heal_core')){
	require_once HEAL_CORE_INC .'/theme-core-helper-functions.php';
	if (!function_exists('heal_core')){
		function heal_core(){
			return class_exists('Heal_Core_Helper_Functions') ? new Heal_Core_Helper_Functions() : false;
		}
	}
}
//ob flash
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );


/**
 * Load Codestar Framework Functions
 * @package heal
 * @since 1.0.0
 */
if ( !heal_core()->is_heal_active()) {
	if ( file_exists( HEAL_CORE_ROOT_PATH . '/inc/csf-functions.php' ) ) {
		require_once HEAL_CORE_ROOT_PATH . '/inc/csf-functions.php';
	}
}

// Multi Plugin
require_once HEAL_CORE_ROOT_PATH . '/inc/theme-multi-plugin.php';




/**
 * Core Plugin Init
 * @package heal
 * @since 1.0.0
 */
if ( file_exists( HEAL_CORE_ROOT_PATH . '/inc/theme-core-init.php' ) ) {
	require_once HEAL_CORE_ROOT_PATH . '/inc/theme-core-init.php';
}



