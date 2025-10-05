<?php
// inc/plugins/activation.php
if ( ! defined('ABSPATH') ) { exit; }

// TGMPA
require_once get_template_directory() . '/inc/plugins/tgma/theme-tgm-plugin-activation.php';


/** ---------- Category selection helpers ---------- */
function heal_get_current_category() {
    if ( isset($_GET['heal_cat']) ) return sanitize_key($_GET['heal_cat']);
    return get_option('heal_current_category', '');
}


function heal_get_base_plugins() {
    return [
        [
            'name'     => 'Heal Core',
            'slug'     => 'heal-core',
            'source'=> 'https://demos.codexcoder.com/heal/plugins/heal-core.zip',
            'required' => true,
            'version'  => '1.0.0',
        ],
        [
            'name'        => 'Elementor Page Builder',
            'slug'        => 'elementor',
            'required'    => false,
            'external_url'=> 'https://wordpress.org/plugins/elementor/',
        ],
        [
            'name'        => 'One Click Demo Import',
            'slug'        => 'one-click-demo-import',
            'required'    => false,
            'external_url'=> 'https://wordpress.org/plugins/one-click-demo-import/',
        ],
        [
            'name'         => 'Classic Editor',
            'slug'         => 'classic-editor',
            'required'     => false,
            'external_url' => 'https://wordpress.org/plugins/classic-editor/',
        ],
        [
           'name'         => 'Classic Widgets',
            'slug'         => 'classic-widgets',
            'required'     => false,
            'external_url' => 'https://wordpress.org/plugins/classic-widgets/', 
        ],
        [
            'name'         => 'SVG Support',
            'slug'         => 'svg-support',
            'required'     => false,
            'external_url' => 'https://wordpress.org/plugins/svg-support/',
        ],
        [
            'name'=>'Contact Form 7',
            'slug'=>'contact-form-7',
            'required'=>false,
            'external_url'=>'https://wordpress.org/plugins/contact-form-7/'
        ],
    ];
}


/** ---------- Category-wise ---------- */
function heal_get_category_plugins_map() {
    return [
        'default' => [
            [
                'name'     => 'Heal Core',
                'slug'     => 'heal-core',
                'source'=> 'https://demos.codexcoder.com/heal/plugins/heal-core.zip',
                'required' => true,
                'version'  => '1.0.0',
            ],
            [
                'name'        => 'Elementor Page Builder',
                'slug'        => 'elementor',
                'required'    => false,
                'external_url'=> 'https://wordpress.org/plugins/elementor/',
            ],
            [
                'name'        => 'One Click Demo Import',
                'slug'        => 'one-click-demo-import',
                'required'    => false,
                'external_url'=> 'https://wordpress.org/plugins/one-click-demo-import/',
            ],
            [
                'name'         => 'Classic Editor',
                'slug'         => 'classic-editor',
                'required'     => false,
                'external_url' => 'https://wordpress.org/plugins/classic-editor/',
            ],
            [
               'name'         => 'Classic Widgets',
                'slug'         => 'classic-widgets',
                'required'     => false,
                'external_url' => 'https://wordpress.org/plugins/classic-widgets/', 
            ],
            [
                'name'         => 'SVG Support',
                'slug'         => 'svg-support',
                'required'     => false,
                'external_url' => 'https://wordpress.org/plugins/svg-support/',
            ],
        ],

        'charity' => [
            [
                'name'=>'GiveWP – Donation Plugin',
                'slug'=>'give',
                'required'=>false,
                'external_url'=>'https://wordpress.org/plugins/give/'
            ],
            [
                'name'=>'Contact Form 7',
                'slug'=>'contact-form-7',
                'required'=>false,
                'external_url'=>'https://wordpress.org/plugins/contact-form-7/'
            ],
        ],

        // 'education' => [
        //     [
        //         'name'=>'LearnPress',
        //         'slug'=>'learnpress',
        //         'required'=>false,
        //         'external_url'=>'https://wordpress.org/plugins/learnpress/'
        //     ],
        //     [
        //         'name'=>'LearnPress – Course Wishlist',
        //         'slug'=>'learnpress-wishlist',
        //         'required'=>false,
        //         'external_url'=>'https://wordpress.org/plugins/learnpress-wishlist/'
        //     ],
        // ],

        // 'business' => [
        //     [
        //         'name'=>'WooCommerce',
        //         'slug'=>'woocommerce',
        //         'required'=>false,
        //         'external_url'=>'https://wordpress.org/plugins/woocommerce/'
        //     ],
        //     [
        //         'name'=>'WooCommerce Blocks',
        //         'slug'=>'woo-gutenberg-products-block',
        //         'required'=>false,
        //         'external_url'=>'https://wordpress.org/plugins/woo-gutenberg-products-block/'
        //     ],
        // ],

        // 'agency' => [
        //     [
        //         'name'=>'Contact Form 7',
        //         'slug'=>'contact-form-7',
        //         'required'=>false,
        //         'external_url'=>'https://wordpress.org/plugins/contact-form-7/'
        //     ],
        //     [
        //         'name'=>'MC4WP: Mailchimp for WordPress',
        //         'slug'=>'mailchimp-for-wp',
        //         'required'=>false,'external_url'=>'https://wordpress.org/plugins/mailchimp-for-wp/'
        //     ],
        // ],

        // 'religion' => [
        //     [
        //         'name'=>'GiveWP – Donation Plugin',
        //         'slug'=>'give','required'=>false,
        //         'external_url'=>'https://wordpress.org/plugins/give/'
        //     ],
        // ],

        // 'corporate' => [
        //     [
        //         'name'=>'WPForms Lite',
        //         'slug'=>'wpforms-lite',
        //         'required'=>false,
        //         'external_url'=>'https://wordpress.org/plugins/wpforms-lite/'
        //     ],
        // ],

        // 'dating' => [
        //     [
        //         'name'=>'BuddyPress',
        //         'slug'=>'buddypress',
        //         'required'=>false,'external_url'=>'https://wordpress.org/plugins/buddypress/'
        //     ],
        // ],

        // 'agro' => [
        //     [
        //         'name'=>'WooCommerce',
        //         'slug'=>'woocommerce',
        //         'required'=>false,
        //         'external_url'=>'https://wordpress.org/plugins/woocommerce/'
        //     ],
        // ],

        // fallback
        // 'generic' => [
        //     [
        //         'name'=>'Contact Form 7',
        //         'slug'=>'contact-form-7',
        //         'required'=>false,'external_url'=>'https://wordpress.org/plugins/contact-form-7/'
        //     ],
        // ],
    ];
}



function heal_get_plugins_for_category( $category ) {
    if ( ! $category ) $category = 'generic';
    $plugins = array_merge(
        heal_get_base_plugins(),
        ( heal_get_category_plugins_map()[ $category ] ?? [] )
    );
    $seen = [];
    $out  = [];
    foreach ( $plugins as $p ) {
        $slug = $p['slug'] ?? '';
        if ( $slug && ! isset($seen[$slug]) ) {
            $seen[$slug] = true;
            $out[] = $p;
        }
    }
    return $out;
}




function heal_get_required_plugin_slugs_for_category( $category ) {
    $list  = heal_get_plugins_for_category( $category );
    $slugs = [];
    foreach ( $list as $p ) {
        if ( ! empty($p['slug']) ) $slugs[] = $p['slug'];
    }
    return array_values( array_unique( $slugs ) );
}



/** ---------- TGMPA register: ---------- */
add_action( 'tgmpa_register', function () {
    $cat = heal_get_current_category();
    if ( ! $cat ) $cat = 'generic';

    $plugins = heal_get_plugins_for_category( $cat );

    $config = [
        'id'           => 'heal',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'is_automatic' => false,
        'message'      => '',
    ];

    tgmpa( $plugins, $config );
});



add_action('admin_init', function () {
    if ( isset($_GET['heal_cat']) ) {
        update_option('heal_current_category', sanitize_key($_GET['heal_cat']));
    }
});
