<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * @package   Codestar Framework - WordPress Options Framework
 * @author    Codestar <info@codestarthemes.com>
 * @link      http://codestarframework.com
 * @copyright 2015-2022 Codestar
 *
 *
 * Plugin Name: Codestar Framework
 * Plugin URI: http://codestarframework.com/
 * Author: Codestar
 * Author URI: http://codestarthemes.com/
 * Version: 2.3.1
 * Description: A Simple and Lightweight WordPress Option Framework for Themes and Plugins
 * Text Domain: csf
 * Domain Path: /languages
 *
 */
require_once plugin_dir_path( __FILE__ ) .'classes/setup.class.php';

function custom_csf_admin_css() {
    echo '<style>
        .csf--sibling.csf--image {
            box-shadow: 0 0 3px rgba(0, 0, 0, .1) !important;
            margin-bottom: 10px !important;
        }
    </style>';
}
add_action( 'admin_head', 'custom_csf_admin_css' );
