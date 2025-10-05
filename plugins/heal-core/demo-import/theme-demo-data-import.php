<?php
// inc/demo/theme-demo-data-import.php
if ( ! defined('ABSPATH') ) { exit; }

/** Utility: is_plugin_active */
if ( ! function_exists('heal_is_plugin_active') ) {
    function heal_is_plugin_active( $plugin_slug ) {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';
        $candidates = [
            $plugin_slug . '/' . $plugin_slug . '.php',
            $plugin_slug . '.php',
        ];
        foreach ( $candidates as $file ) {
            if ( function_exists('is_plugin_active') && is_plugin_active( $file ) ) return true;
        }
        return false;
    }
}


function heal_block_ocdi_when_plugins_missing( $selected_import ) {
    $demo = '';
    if ( ! empty($selected_import['import_demo_slug']) ) {
        $demo = sanitize_key( $selected_import['import_demo_slug'] );
    } else {
        $demo = get_option('heal_current_demo', 'default');
    }
    if ( ! $demo ) $demo = 'default';

    $required_slugs = function_exists('heal_get_required_plugin_slugs_for_demo')
        ? heal_get_required_plugin_slugs_for_demo( $demo )
        : [];

    $missing = [];
    foreach ( $required_slugs as $slug ) {
        if ( ! heal_is_plugin_active( $slug ) ) $missing[] = $slug;
    }

    if ( ! empty($missing) ) {
        $tgmpa_url = admin_url( 'themes.php?page=tgmpa-install-plugins&heal_demo=' . urlencode($demo) );
        wp_die(
            sprintf(
                '<h2>%s</h2><p>%s</p><p><a class="button button-primary" href="%s">%s</a></p>',
                esc_html__('Required plugins are not active yet.', 'heal'),
                esc_html__('Please install & activate the required plugins first, then run the Demo Import again.', 'heal'),
                esc_url( $tgmpa_url ),
                esc_html__('Go to Install Plugins', 'heal')
            ),
            esc_html__('Plugins not active', 'heal'),
            [ 'back_link' => true ]
        );
    }
}


// OCDI (new & legacy) 
add_action( 'pt-ocdi/before_content_import', 'heal_block_ocdi_when_plugins_missing' );
add_action( 'ocdi/before_content_import',    'heal_block_ocdi_when_plugins_missing' );

/** ===== OCDI: Demo list ===== */
function heal_ocdi_import_files() {
    $base = trailingslashit( defined('HEAL_CORE_ROOT_PATH') ? HEAL_CORE_ROOT_PATH : get_template_directory() )
    . 'demo-import/demo-data/';

    $demos = [
        // [
        //     'import_file_name'             => 'Charity Demo 1',
        //     'import_demo_slug'             => 'charity-demo-1',
        //     'categories'                   => ['Charity'],
        //     'local_import_file'            => $base.'charity/demo-01/content.xml',
        //     'local_import_customizer_file' => $base.'charity/demo-01/customize.dat',
        //     'local_import_widget_file'     => $base.'charity/demo-01/widgets.wie',
        //     'local_import_json'            => [
        //         ['file_path' => $base.'/charity/demo-01/theme-settings.json', 'option_name' => 'heal_theme_options'],
        //     ],
        //     'preview_url' => 'https://demos.codexcoder.com/heal/charity/demo-01/',
        // ],
        [
            'import_file_name'             => 'Charity Demo 1',
            'import_demo_slug'             => 'charity-demo-1',
            'categories'                   => ['Charity'],
            'local_import_file'            => $base.'charity/demo-01/content.xml',
            'local_import_customizer_file' => $base.'charity/demo-01/customize.dat',
            'local_import_widget_file'     => $base.'charity/demo-01/widgets.wie',
            'local_import_json'            => [
                ['file_path' => $base.'/charity/demo-01/theme-settings.json', 'option_name' => 'heal_theme_options'],
            ],
            'preview_url' => 'https://demos.codexcoder.com/heal/charity/demo-01/',
        ],
        [
            'import_file_name'             => 'Charity Demo 2',
            'import_demo_slug'             => 'charity-demo-2',
            'categories'                   => ['Charity'],
            'local_import_file'            => $base.'charity/demo-02/content.xml',
            'local_import_customizer_file' => $base.'charity/demo-02/customize.dat',
            'local_import_widget_file'     => $base.'charity/demo-02/widgets.wie',
            'local_import_json'            => [
                ['file_path' => $base.'/charity/demo-02/theme-settings.json', 'option_name' => 'heal_theme_options'],
            ],
            'preview_url' => 'https://demos.codexcoder.com/heal/charity/demo-02/',
        ],
        [
            'import_file_name'             => 'Charity Demo 3',
            'import_demo_slug'             => 'charity-demo-3',
            'categories'                   => ['Charity'],
            'local_import_file'            => $base.'charity/demo-03/content.xml',
            'local_import_customizer_file' => $base.'charity/demo-03/customize.dat',
            'local_import_widget_file'     => $base.'charity/demo-03/widgets.wie',
            'local_import_json'            => [
                ['file_path' => $base.'/charity/demo-03/theme-settings.json', 'option_name' => 'heal_theme_options'],
            ],
            'preview_url' => 'https://demos.codexcoder.com/heal/charity/demo-03/',
        ],
        [
            'import_file_name'             => 'Charity Demo 4',
            'import_demo_slug'             => 'charity-demo-4',
            'categories'                   => ['Charity'],
            'local_import_file'            => $base.'charity/demo-04/content.xml',
            'local_import_customizer_file' => $base.'charity/demo-04/customize.dat',
            'local_import_widget_file'     => $base.'charity/demo-04/widgets.wie',
            'local_import_json'            => [
                ['file_path' => $base.'/charity/demo-04/theme-settings.json', 'option_name' => 'heal_theme_options'],
            ],
            'preview_url' => 'https://demos.codexcoder.com/heal/charity/demo-04/',
        ],
    ];

    // URL param 
    $sel = isset($_GET['heal_demo']) ? sanitize_key($_GET['heal_demo']) : '';
    if ($sel) {
        $filtered = array_values(array_filter($demos, function($d) use ($sel) {
            return ($d['import_demo_slug'] ?? '') === $sel;
        }));
        if ($filtered) return $filtered;
    }
    return $demos;
}
add_filter('ocdi/import_files',    'heal_ocdi_import_files');
add_filter('pt-ocdi/import_files', 'heal_ocdi_import_files');


/** ===== Import-time JSON + Which demo flag ===== */
function heal_after_content_import_execution($selected_import_files, $import_files, $selected_index) {
    if ( ! empty($import_files[$selected_index]['local_import_json']) ) {
        foreach ( $import_files[$selected_index]['local_import_json'] as $import ) {
            if ( ! empty($import['file_path']) && ! empty($import['option_name']) && class_exists('OCDI\Helpers') ) {
                $raw = OCDI\Helpers::data_from_file( $import['file_path'] );
                if ( $raw ) update_option( $import['option_name'], json_decode($raw, true) );
            }
        }
    }
    if ( ! empty($import_files[$selected_index]['import_demo_slug']) ) {
        update_option('heal_current_demo', sanitize_key($import_files[$selected_index]['import_demo_slug']));
    }
}
add_action('ocdi/after_content_import_execution',    'heal_after_content_import_execution', 3, 99);
add_action('pt-ocdi/after_content_import_execution', 'heal_after_content_import_execution', 3, 99);


/** ===== After import basic setup ===== */
function heal_ocdi_after_import_setup() {
    $menu = get_term_by('name','Main Menu','nav_menu');
    if ($menu && ! is_wp_error($menu)) {
        set_theme_mod('nav_menu_locations', ['main-menu' => (int)$menu->term_id]);
    }
    $front = get_page_by_title('Home');
    $blog  = get_page_by_title('Blogs');
    update_option('show_on_front','page');
    if ($front) update_option('page_on_front',(int)$front->ID);
    if ($blog)  update_option('page_for_posts',(int)$blog->ID);
}
add_action('pt-ocdi/after_import','heal_ocdi_after_import_setup');
add_action('ocdi/after_import',   'heal_ocdi_after_import_setup');
