<?php
/**
 * Theme functions & definitations
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package heal
 */

/**
 * Define Theme Folder Path & URL Constant
 * @package heal
 * @since 1.0.0
 */

define('HEAL_THEME_ROOT', get_template_directory());
define('HEAL_THEME_ROOT_URL', get_template_directory_uri());
define('HEAL_INC', HEAL_THEME_ROOT . '/inc');
define('HEAL_THEME_SETTINGS', HEAL_INC . '/theme-settings');
define('HEAL_THEME_SETTINGS_IMAGES', HEAL_THEME_ROOT_URL . '/inc/theme-settings/images');
define('HEAL_TGMA', HEAL_INC . '/plugins/tgma');
define('HEAL_DYNAMIC_STYLESHEETS', HEAL_INC . '/theme-stylesheets');
define('HEAL_CSS', HEAL_THEME_ROOT_URL . '/assets/css');
define('HEAL_JS', HEAL_THEME_ROOT_URL . '/assets/js');
define('HEAL_ASSETS', HEAL_THEME_ROOT_URL . '/assets');
define('HEAL_DEV', true);


add_action( 'after_setup_theme', function () {
    load_theme_textdomain( 'heal', get_template_directory() . '/languages' );
} );

/**
 * Theme Initial File
 * @package heal
 * @since 1.0.0
 */
if (file_exists(HEAL_INC . '/theme-init.php')) {
    require_once HEAL_INC . '/theme-init.php';
}


/**
 * Codester Framework Functions
 * @package heal
 * @since 1.0.0
 */
if (file_exists(HEAL_INC . '/theme-cs-function.php')) {
    require_once HEAL_INC . '/theme-cs-function.php';
}


/**
 * Theme Helpers Functions
 * @package heal
 * @since 1.0.0
 */
if (file_exists(HEAL_INC . '/theme-helper-functions.php')) {

    require_once HEAL_INC . '/theme-helper-functions.php';
    if (!function_exists('heal')) {
        function heal()
        {
            return class_exists('Heal_Helper_Functions') ? new Heal_Helper_Functions() : false;
        }
    }
}
/**
 * Nav menu fallback function
 * @since 1.0.0
 */
if (is_user_logged_in()) {
    function heal_theme_fallback_menu()
    {
        get_template_part('template-parts/default', 'menu');
    }
}

// theme-color

if (file_exists(HEAL_INC . '/theme-color.php')) {
    require_once HEAL_INC . '/theme-color.php';
}


// custom-header

function heal_custom_header_setup() {
    add_theme_support( 'custom-header', array(
        'default-image'      => get_template_directory_uri() . '/inc/theme-settings/images/header/00.png',
        'width'              => 1000,
        'height'             => 250,
        'flex-width'         => true,
        'flex-height'        => true,
        'default-text-color' => '000000',  // Default header text color
        'wp-head-callback'   => 'heal_header_style',  // Custom callback function for header styles
    ) );
}

// custom-background

function heal_custom_background_setup() {
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );
}
add_action( 'after_setup_theme', 'heal_custom_background_setup' );


// woocode

if (class_exists('WooCommerce')) {
    include_once HEAL_INC . '/woo.php';
}

// mega menu

$mega_menu_file = get_template_directory() . '/mega-menu.php';

if (file_exists($mega_menu_file)) {
    require_once $mega_menu_file;
}


// Body Classes
function custom_body_classes( $classes ) {
    if ( is_front_page() || is_page('home') ) {
        
    } elseif ( is_page('home-2') ) {
        $classes[] = 'home-2';
    } elseif ( is_page('home-3') ) {
        $classes[] = 'home-3';
    } else {
        $classes[] = 'home-inner';
    }

    return $classes;
}
add_filter( 'body_class', 'custom_body_classes' );



// Fontasome
if( ! function_exists( 'your_prefix_enqueue_fa6' ) ) {
  function your_prefix_enqueue_fa6() {
    wp_enqueue_style( 'fa6', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css', array(), '6.5.2', 'all' );
    wp_enqueue_style( 'fa6-v4-shims', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/v4-shims.min.css', array(), '6.5.2', 'all' );
  }
  add_action( 'wp_enqueue_scripts', 'your_prefix_enqueue_fa6' );
}
