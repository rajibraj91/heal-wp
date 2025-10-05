<?php
/**
 * Theme Options
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {

    $allowed_html = heal()->kses_allowed_html(array('mark'));
    $prefix = 'heal';
    // Create options
    CSF::createOptions($prefix . '_theme_options', array(
        'menu_title' => esc_html__('Theme Options', 'heal'),
        'menu_slug' => 'heal_theme_options',
        'menu_parent' => 'heal_theme_options',
        'menu_type' => 'submenu',
        'footer_credit' => ' ',
        'menu_icon' => 'fa fa-filter',
        'show_footer' => false,
        'enqueue_webfont' => false,
        'show_search' => true,
        'show_reset_all' => true,
        'show_reset_section' => true,
        'show_all_options' => false,
        'theme' => 'dark',
        'framework_title' => heal()->get_theme_info('name')
    ));

    /*-------------------------------------------------------
        ** General  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('General', 'heal'),
        'id' => 'general_options',
        'icon' => 'fas fa-cogs',
    ));
    /* Preloader */
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Preloader & SVG Enable', 'heal'),
        'id' => 'theme_general_preloader_options',
        'icon' => 'fa fa-spinner',
        'parent' => 'general_options',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Preloader Options', 'heal') . '</h3>'
            ),
            array(
                'id' => 'preloader_enable',
                'title' => esc_html__('Preloader', 'heal'),
                'type' => 'switcher',
                'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to enable/disable preloader', 'heal'), $allowed_html),
                'default' => false,
            ),
            array(
                'id' => 'preloader_bg_color',
                'title' => esc_html__('Preloader Background Color', 'heal'),
                'type' => 'color',
                'default' => '',
                'desc' => wp_kses(__('you can set <mark>overlay color</mark> for preloader background image', 'heal'), $allowed_html),
                'dependency' => array('preloader_enable', '==', 'true')
            ),
            // array(
            //     'id'      => 'preloader_title',
            //     'type'    => 'text',
            //     'title'   => esc_html__('Preloader Title', 'heal'),
            //     'desc'    => esc_html__('Enter the title to display during preloading. If left empty, the site name will be used.', 'heal'),
            //     'default' => get_bloginfo('name'),
            //     'dependency' => array('preloader_enable', '==', 'true')
            // ),

            // array(
            //     'id'      => 'loading_text',
            //     'type'    => 'text',
            //     'title'   => esc_html__('Preloader Loading Text', 'heal'),
            //     'desc'    => esc_html__('Enter the text to display below the loading animation.', 'heal'),
            //     'default' => '',
            //     'dependency' => array('preloader_enable', '==', 'true')
            // ),            
              
            // array(
            //     'id' => 'enable_svg_upload',
            //     'type' => 'switcher',
            //     'title' => esc_html__('Enable Svg Upload ?', 'heal'),
            //     'desc' => esc_html__('If you want to enable or disable svg upload you can set ( YES / NO )', 'heal'),
            //     'default' => true,
            // ),
        )
    ));

    /*-------------------------------------------------------
           ** Typography  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'typography',
        'title' => esc_html__('Typography', 'heal'),
        'icon' => 'fas fa-text-height',
        'parent' => 'general_options',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Body Font Options', 'heal') . '</h3>',
            ),
            array(
                'type' => 'typography',
                'title' => esc_html__('Typography', 'heal'),
                'id' => '_body_font',
                'default' => array(
                    'font-family' => 'poppins',
                    'font-size' => '16',
                    'line-height' => '26',
                    'unit' => 'px',
                    'type' => 'google',
                ),
                'color' => false,
                'subset' => false,
                'text_align' => false,
                'text_transform' => false,
                'letter_spacing' => false,
                'line_height' => false,
                'desc' => wp_kses(__('you can set <mark>font</mark> for all html tags (if not use different heading font)', 'heal'), $allowed_html),
            ),
            array(
                'id' => 'body_font_variant',
                'type' => 'select',
                'title' => esc_html__('Load Font Variant', 'heal'),
                'multiple' => true,
                'chosen' => true,
                'options' => array(
                    '300' => esc_html__('Light 300', 'heal'),
                    '400' => esc_html__('Regular 400', 'heal'),
                    '500' => esc_html__('Medium 500', 'heal'),
                    '600' => esc_html__('Semi Bold 600', 'heal'),
                    '700' => esc_html__('Bold 700', 'heal'),
                    '800' => esc_html__('Extra Bold 800', 'heal'),
                ),
                'default' => array('400', '500', '600', '700')
            ),
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Heading Font Options', 'heal') . '</h3>',
            ),
            array(
                'type' => 'switcher',
                'id' => 'heading_font_enable',
                'title' => esc_html__('Heading Font', 'heal'),
                'desc' => wp_kses(__('you can set <mark>yes</mark> to select different heading font', 'heal'), $allowed_html),
                'default' => true
            ),
            array(
                'type' => 'typography',
                'title' => esc_html__('Typography', 'heal'),
                'id' => 'heading_font',
                'default' => array(
                    'font-family' => 'raleway',
                    'type' => 'google',
                ),
                'color' => false,
                'subset' => false,
                'text_align' => false,
                'text_transform' => false,
                'letter_spacing' => false,
                'font_size' => false,
                'line_height' => false,
                'desc' => wp_kses(__('you can set <mark>font</mark> for  for heading tag .eg: h1,h2,h3,h4,h5,h6', 'heal'), $allowed_html),
                'dependency' => array('heading_font_enable', '==', 'true')
            ),
            array(
                'id' => 'heading_font_variant',
                'type' => 'select',
                'title' => esc_html__('Load Font Variant', 'heal'),
                'multiple' => true,
                'chosen' => true,
                'options' => array(
                    '300' => esc_html__('Light 300', 'heal'),
                    '400' => esc_html__('Regular 400', 'heal'),
                    '500' => esc_html__('Medium 500', 'heal'),
                    '600' => esc_html__('Semi Bold 600', 'heal'),
                    '700' => esc_html__('Bold 700', 'heal'),
                    '800' => esc_html__('Extra Bold 800', 'heal'),
                ),
                'default' => array('400', '500', '600', '700'),
                'dependency' => array('heading_font_enable', '==', 'true')
            ),
        )
    ));

    /*-------------------------------------------------------
    ** Back To Top  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Back To Top', 'heal'),
        'id' => 'theme_general_back_top_options',
        'icon' => 'fa fa-arrow-up',
        'parent' => 'general_options',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Back Top Options', 'heal') . '</h3>'
            ),
            array(
                'id' => 'back_top_enable',
                'title' => esc_html__('Back Top', 'heal'),
                'type' => 'switcher',
                'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide back to top', 'heal'), $allowed_html),
                'default' => true,
            ),
            array(
                'id' => 'back_top_icon',
                'title' => esc_html__('Back Top Icon', 'heal'),
                'type' => 'icon',
                'default' => 'fa-solid fa-arrow-up-long',
                'desc' => wp_kses(__('you can set <mark>icon</mark> for back to top.', 'heal'), $allowed_html),
                'dependency' => array('back_top_enable', '==', 'true')
            ),
        )
    ));

    /*-------------------------------------------------------
        ** Menu Sidebar  Options
    --------------------------------------------------------*/
    // CSF::createSection($prefix . '_theme_options', array(
    //     'title' => esc_html__('Menu Sidebar', 'heal'),
    //     'id' => 'theme_general_sidebar_options',
    //     'icon' => 'fas fa-bars',
    //     'parent' => 'general_options',
    //     'fields' => array(
    //         array(
    //             'type' => 'subheading',
    //             'content' => '<h3>' . esc_html__('Menu Sidebar Option', 'heal') . '</h3>'
    //         ),
    //         array(
    //             'id' => 'sidebar_logo',
    //             'type' => 'media',
    //             'title' => esc_html__('Sidebar Logo', 'heal'),
    //             'library' => 'image',
    //             'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'heal'), $allowed_html),
    //         ),
    //         array(
    //             'id' => 'sidebar_text',
    //             'type' => 'textarea',
    //             'title' => esc_html__('Sidebar Text', 'heal'),
    //             'default' => esc_html__('We understand better that enim ad minim veniam, consectetur adipis cing elit, sed do', 'heal'),
    //         ),
    //         array(
    //             'id' => 'sidebar_title',
    //             'type' => 'text',
    //             'title' => esc_html__('Sidebar Title', 'heal'),
    //             'default' => esc_html__('Contact Info', 'heal'),
    //         ),
    //         array(
    //             'id'        => 'sidebar_contact_info',
    //             'type'      => 'repeater',
    //             'title'     => 'Contact Info Repeater',
    //             'fields'    => array(
              
    //               array(
    //                 'id'    => 'sidebar_contact_icon',
    //                 'type'  => 'icon',
    //                 'default' => 'fa-solid fa-phone-volume',
    //                 'title' => 'Info Icon',
    //               ),              
    //               array(
    //                 'id'    => 'sidebar_contact_text',
    //                 'type'  => 'text',
    //                 'title' => 'Info Text',
    //               ),
    //               array(
    //                 'id'    => 'sidebar_contact_text_url',
    //                 'type'  => 'text',
    //                 'title' => 'Info Url',
    //               ),
              
    //             )
    //         ),
    //         array(
    //             'id' => 'sidebar_btn_enabled',
    //             'type' => 'switcher',
    //             'title' => esc_html__('Show Button', 'heal'),
    //             'default' => true,
    //             'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar button of header one', 'heal'), $allowed_html),
    //         ),
    //         array(
    //             'id' => 'sidebar_btn_text',
    //             'type' => 'text',
    //             'title' => esc_html__('Button Text', 'heal'),
    //             'default' => 'Get A Quote',
    //             'dependency' => array('sidebar_btn_enabled', '==', 'true')
    //         ),
    //         array(
    //             'id' => 'sidebar_btn_text_url',
    //             'type' => 'text',
    //             'title' => esc_html__('Button Url', 'heal'),
    //             'default' => esc_html__('#', 'heal'),
    //             'dependency' => array('sidebar_btn_enabled', '==', 'true')
    //         ),
    //         array(
    //             'id'        => 'sidebar_socials',
    //             'type'      => 'repeater',
    //             'title'     => 'Socials Info Repeater',
    //             'fields'    => array(
              
    //               array(
    //                 'id'    => 'sidebar_socials_icon',
    //                 'type'  => 'icon',
    //                 'default' => 'fa fa-facebook',
    //                 'title' => 'Socials Info Icon',
    //               ),  
    //               array(
    //                 'id'    => 'sidebar_socials_icon_url',
    //                 'type'  => 'text',
    //                 'title' => 'Socials Info Url',
    //               ),
              
    //             )
    //         ),
    //     )
    // ));

    /*-------------------------------------------------------
    ** Theme Color  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Theme Colors', 'heal'),
        'id' => 'theme_color',
        'icon' => 'fa fa-palette',
        'parent' => 'general_options',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Theme Color Option', 'heal') . '</h3>'
            ),
        
            array(
                'id'      => 'theme_body_color',
                'type'    => 'color',
                'title'   => 'Body Color',
                'default' => '#fff',
            ),
            array(
                'id'      => 'theme_black_color',
                'type'    => 'color',
                'title'   => 'Black Color',
                'default' => '#000',
            ),
            array(
                'id'      => 'theme_white_color',
                'type'    => 'color',
                'title'   => 'White Color',
                'default' => '#fff',
            ),
            array(
                'id'      => 'theme_color_1',
                'type'    => 'color',
                'title'   => 'Theme Color',
                'default' => '#E63946',
            ),
            // array(
            //     'id'      => 'theme_color_2',
            //     'type'    => 'color',
            //     'title'   => 'Theme Color 2',
            //     'default' => '#5faf1f',
            // ),
            // array(
            //     'id'      => 'theme_color_3',
            //     'type'    => 'color',
            //     'title'   => 'Theme Color 3',
            //     'default' => '#f39c12',
            // ),
            array(
                'id'      => 'primary_color',
                'type'    => 'color',
                'title'   => 'Primary Color',
                'default' => '#2e746c',
            ),
            // array(
            //     'id'      => 'theme_header_color',
            //     'type'    => 'color',
            //     'title'   => 'Header Color',
            //     'default' => '#1D1D1D',
            // ),
            array(
                'id'      => 'theme_title_color',
                'type'    => 'color',
                'title'   => 'Title Color',
                'default' => '#0d0d0d',
            ),
            array(
                'id'      => 'theme_text_1_color',
                'type'    => 'color',
                'title'   => 'Text Color',
                'default' => '#737373',
            ),
            array(
                'id'      => 'theme_border_color',
                'type'    => 'color',
                'title'   => 'Border Color',
                'default' => '#ecf0f3',
            ),
            array(
                'id'      => 'theme_bg_ash_color',
                'type'    => 'color',
                'title'   => 'Background Color',
                'default' => '#e3e7e8',
            ),
            array(
                'id'      => 'theme_box_shadow',
                'type'    => 'text',
                'title'   => 'Box Shadow',
                'default' => '0px 1px 5px 0px rgba(0, 0, 0, 0.13)',
            ),
        )
    ));


    /*-------------------------------------------------------
    ** Social Media Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Social Media', 'heal'),
        'id' => 'social_media',
        'icon' => 'fa fa-share',
        'parent' => 'general_options',
        'fields' => array(
            // Social Icons
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Social Media Icons', 'heal'),
            ),
            array(
                'id'     => 'theme_socials',
                'type'   => 'repeater',
                'title'  => esc_html__('Social Media Links', 'heal'),
                'fields' => array(
                array(
                    'id'    => 'name',
                    'type'  => 'text',
                    'title' => esc_html__('Social Icon Name', 'heal'),
                ),
                array(
                    'id'    => 'icon',
                    'type'  => 'icon',
                    // 'type'  => 'upload',
                    'title' => esc_html__('Social Icon', 'heal'),
                    'library' => 'fa',
                ),
                array(
                    'id'    => 'url',
                    'type'  => 'text',
                    'title' => esc_html__('URL', 'heal'),
                ),
                ),
            ),
              
        )
    ));


    /*-------------------------------------------------------
    ** All Page Global Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Demos Page', 'heal'),
        'id' => 'demos_page',
        'icon' => 'fas fa-cogs',
    ));
    
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Hafsa Global Option', 'heal'),
        'id' => 'global_page',
        'icon' => 'fa fa-edit',
        'parent' => 'demos_page',
        'fields' => array(
            // Shape Images
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Shape Image', 'heal'),
            ),
            array(
                'id' => 'hafsa_shape_1',
                'type' => 'media',
                'title' => esc_html__('Shape 1', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('You can upload a <mark>shape</mark> here, it will overwrite the customizer uploaded shape image.', 'heal'), $allowed_html),
            ),
            array(
                'id' => 'hafsa_shape_2',
                'type' => 'media',
                'title' => esc_html__('Shape 2', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('You can upload a <mark>shape 2</mark> here, it will overwrite the customizer uploaded shape image.', 'heal'), $allowed_html),
            ),
            array(
                'id' => 'hafsa_shape_3',
                'type' => 'media',
                'title' => esc_html__('Shape 3', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('You can upload a <mark>shape 3</mark> here, it will overwrite the customizer uploaded shape image.', 'heal'), $allowed_html),
            ),
            array(
                'id' => 'hafsa_shape_4',
                'type' => 'media',
                'title' => esc_html__('Shape 4', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('You can upload a <mark>shape 4</mark> here, it will overwrite the customizer uploaded shape image.', 'heal'), $allowed_html),
            ),

            // Pattern Images
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Pattern Image', 'heal'),
            ),
            
            array(
                'id' => 'pattern_image_1',
                'type' => 'media',
                'title' => esc_html__('Pattern 1', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('You can upload a <mark>Pattern 1</mark> here, it will overwrite the customizer uploaded pattern image.', 'heal'), $allowed_html),
            ),
            array(
                'id' => 'pattern_image_2',
                'type' => 'media',
                'title' => esc_html__('Pattern 2', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('You can upload a <mark>Pattern 2</mark> here, it will overwrite the customizer uploaded pattern image.', 'heal'), $allowed_html),
            ),
            array(
                'id' => 'pattern_image_3',
                'type' => 'media',
                'title' => esc_html__('Pattern 3', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('You can upload a <mark>Pattern 3</mark> here, it will overwrite the customizer uploaded pattern image.', 'heal'), $allowed_html),
            ),

            // Tri Shape Images
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Tri Shape Image', 'heal'),
            ),
            
            array(
                'id' => 'hafsa_tri_shape_1',
                'type' => 'media',
                'title' => esc_html__('Tri Shape 1', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('You can upload a <mark>tri shape</mark> here, it will overwrite the customizer uploaded tri shape image.', 'heal'), $allowed_html),
            ),
            array(
                'id' => 'hafsa_tri_shape_2',
                'type' => 'media',
                'title' => esc_html__('Tri Shape 2', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('You can upload a <mark>tri shape 2</mark> here, it will overwrite the customizer uploaded tri shape image.', 'heal'), $allowed_html),
            ),
            array(
                'id' => 'hafsa_tri_shape_3',
                'type' => 'media',
                'title' => esc_html__('Tri Shape 3', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('You can upload a <mark>tri shape 3</mark> here, it will overwrite the customizer uploaded tri shape image.', 'heal'), $allowed_html),
            ),
        )
    ));
    


    /*----------------------------------
    Header & Footer Style
    -----------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Set Header & Footer', 'heal'),
        'id' => 'header_footer_style_options',
        'icon' => 'eicon-banner',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => esc_html__('Global Header Style', 'heal'),
            ),
            array(
                'id' => 'navbar_type',
                'title' => esc_html__('Navbar Type', 'heal'),
                'type' => 'image_select',
                'options' => array(
                    '' => HEAL_THEME_SETTINGS_IMAGES . '/header/01.png',
                    'style-01' => HEAL_THEME_SETTINGS_IMAGES . '/header/02.png',
                    'style-02' => HEAL_THEME_SETTINGS_IMAGES . '/header/03.png',
                    'style-03' => HEAL_THEME_SETTINGS_IMAGES . '/header/04.png',
                ),
                'default' => '',
                'desc' => wp_kses(__('you can set <mark>navbar type</mark> it will show in every page except you select specific navbar type form page settings.', 'heal'), $allowed_html),
            ),
            array(
                'type' => 'subheading',
                'content' => esc_html__('Global Footer Style', 'heal'),
            ),
            array(
                'id' => 'footer_type',
                'title' => esc_html__('Footer Type', 'heal'),
                'type' => 'image_select',
                'options' => array(
                    '' => HEAL_THEME_SETTINGS_IMAGES . '/footer/01.png',
                    'style-01' => HEAL_THEME_SETTINGS_IMAGES . '/footer/02.png',
                    'style-02' => HEAL_THEME_SETTINGS_IMAGES . '/footer/03.png',
                ),
                'default' => '',
                'desc' => wp_kses(__('you can set <mark>footer type</mark> it will show in every page except you select specific navbar type form page settings.', 'heal'), $allowed_html),
            ),
        )
    ));

    /*-------------------------------------------------------
    ** Entire Site Header Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'headers_settings',
        'title' => esc_html__('Headers', 'heal'),
        'icon' => 'fa fa-home'
    ));

    /* Header Style 01 */
    CSF::createSection($prefix . '_theme_options', array(
        'title'  => esc_html__('Header 1', 'heal'),
        'id'     => 'theme_header_one_options',
        'icon' => 'fa fa-heading',
        'parent' => 'headers_settings',
        'fields' => array(
    
            // Logo Options
            array(
                'type'    => 'subheading',
                'content' => '<h3>' . esc_html__('Logo Options | Header 1', 'heal') . '</h3>',
            ),
            array(
                'id'      => 'header_one_logo',
                'type'    => 'media',
                'title'   => esc_html__('Logo', 'heal'),
                'library' => 'image',
                'desc'    => wp_kses(__('Upload <mark>main logo</mark> here.', 'heal'), $allowed_html),
            ),
    
            // Header Buttons & Icons
            array(
                'id'        => 'header_one_right_btn_enabled',
                'type'      => 'switcher',
                'title'     => esc_html__('Header Button', 'heal'),
                'default'   => true,
            ),
            array(
                'id'         => 'header_one_right_btn_text',
                'type'       => 'text',
                'title'      => esc_html__('Button Text', 'heal'),
                'default'    => 'Get A Quote',
                'dependency' => array('header_one_right_btn_enabled', '==', 'true'),
            ),
            array(
                'id'         => 'header_one_right_btn_url',
                'type'       => 'text',
                'title'      => esc_html__('Button URL', 'heal'),
                'default'    => '#',
                'dependency' => array('header_one_right_btn_enabled', '==', 'true'),
            ),
    
        ),
    ));

    
    /* Header Style 02 */
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Header 2', 'heal'),
        'id' => 'theme_header_two_options',
        'icon' => 'fa fa-heading',
        'parent' => 'headers_settings',
        'fields' => array(
            
            // Logo Options
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Logo Options | Header 2', 'heal') . '</h3>'
            ),
            array(
                'id' => 'header_two_logo',
                'type' => 'media',
                'title' => esc_html__('Logo', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('You can upload a <mark>logo</mark> here, it will overwrite the customizer uploaded logo.', 'heal'), $allowed_html),
            ),
    
            // Right Button Options
            array(
                'id' => 'header_two_right_btn_enabled',
                'type' => 'switcher',
                'title' => esc_html__('Show Button', 'heal'),
                'default' => true,
                'desc' => wp_kses(__('You can <mark>show/hide</mark> the navbar button of header two.', 'heal'), $allowed_html),
            ),
            array(
                'id' => 'header_two_right_btn_icon',
                'type' => 'icon',
                'title' => esc_html__('Button Icon', 'heal'),
                'dependency' => array('header_two_right_btn_enabled', '==', 'true'),
            ),
            array(
                'id' => 'header_two_right_btn_text',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'heal'),
                'default' => 'Get A Quote',
                'dependency' => array('header_two_right_btn_enabled', '==', 'true'),
            ),
            array(
                'id' => 'header_two_right_btn_url',
                'type' => 'text',
                'title' => esc_html__('Button URL', 'heal'),
                'default' => esc_html__('#', 'heal'),
                'dependency' => array('header_two_right_btn_enabled', '==', 'true'),
            ),

            array(
                'id' => 'header_two_bottom_bar_bg',
                'type' => 'color',
                'title' => esc_html__('Menu Bar Background', 'heal'),
                'default' => true,
                // 'dependency' => array('header_two_top_bar_enabled', '==', 'true'),
            ),
            // array(
            //     'id' => 'header_two_top_bar_text_color',
            //     'type' => 'color',
            //     'title' => esc_html__('Top Bar Text Color', 'heal'),
            //     'default' => true,
            //     'dependency' => array('header_two_top_bar_enabled', '==', 'true'),
            // ),
    
            // Cart Button Options
            // array(
            //     'id'      => 'header_default_two_cart_btn_enabled',
            //     'type'    => 'switcher',
            //     'title'   => esc_html__('Show Cart Button', 'heal'),
            //     'default' => true,
            // ),

            // // Search Button Options
            // array(
            //     'id' => 'header_two_search_enabled',
            //     'type' => 'switcher',
            //     'title' => esc_html__('Show Search Button', 'heal'),
            //     'default' => true,
            //     'desc' => wp_kses(__('You can <mark>show/hide</mark> the navbar search button of header two.', 'heal'), $allowed_html),
            // ),
    
            // Top Bar Options
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Top Bar Options', 'heal') . '</h3>'
            ),
            array(
                'id' => 'header_two_top_bar_enabled',
                'type' => 'switcher',
                'title' => esc_html__('Show Header Top Bar', 'heal'),
                'default' => true,
                'desc' => wp_kses(__('You can <mark>show/hide</mark> the top bar of header two.', 'heal'), $allowed_html),
            ),
            
            array(
                'id'        => 'header_2_top_bar_contacts',
                'type'      => 'repeater',
                'title'     => 'Contact Info Repeater',
                'dependency' => array('header_two_top_bar_enabled', '==', 'true'),
                'fields'    => array(
                    array(
                        'id'    => 'header_2_top_bar_icon',
                        'type'  => 'icon',
                        'default' => 'fas fa-phone-volume',
                        'title' => 'Info Icon',
                    ),              
                    array(
                        'id'    => 'header_2_top_bar_info',
                        'type'  => 'text',
                        'title' => 'Info Text',
                    ),
                    array(
                        'id'    => 'header_2_top_bar_info_url',
                        'type'  => 'text',
                        'title' => 'Info URL',
                    ),
                )
            ),
            array(
                'id'        => 'header_2_top_bar_socials',
                'type'      => 'repeater',
                'title'     => 'Socials Info Repeater',
                'dependency' => array('header_two_top_bar_enabled', '==', 'true'),
                'fields'    => array(
                    array(
                        'id'    => 'header_2_top_bar_socials_icon',
                        'type'  => 'icon',
                        'default' => 'fa fa-facebook',
                        'title' => 'Socials Info Icon',
                    ),  
                    array(
                        'id'    => 'header_2_top_bar_socials_icon_url',
                        'type'  => 'text',
                        'title' => 'Socials Info URL',
                    ),
                )
            ),
        )
    ));


    /* Header Style 03 */
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Header 3', 'heal'),
        'id' => 'theme_header_three_options',
        'icon' => 'fa fa-heading',
        'parent' => 'headers_settings',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>Logo Options | Header 3</h3>'
            ),
            array(
                'id' => 'header_3_logo',
                'type' => 'media',
                'title' => esc_html__('Logo', 'heal'),
                'library' => 'image',
            ),
            array(
                'type' => 'subheading',
                'content' => '<h3>Button & Phone Options</h3>'
            ),
            array(
                'id' => 'header_3_right_btn_enabled',
                'type' => 'switcher',
                'title' => esc_html__('Show Button', 'heal'),
                'default' => true,
            ),
            array(
                'id' => 'header_3_right_btn_text',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'heal'),
                'default' => 'Get A Quote',
                'dependency' => array('header_3_right_btn_enabled', '==', 'true'),
            ),
            array(
                'id' => 'header_3_right_btn_url',
                'type' => 'text',
                'title' => esc_html__('Button URL', 'heal'),
                'default' => '#',
                'dependency' => array('header_3_right_btn_enabled', '==', 'true'),
            ),
            array(
                'type' => 'subheading',
                'content' => '<h3>Top Bar Options</h3>'
            ),
            array(
                'id' => 'header_3_top_bar_enabled',
                'type' => 'switcher',
                'title' => esc_html__('Enable Top Bar', 'heal'),
                'default' => true,
            ),

            array(
                'id' => 'header_3_top_bg',
                'type' => 'media',
                'title' => esc_html__('Background Image Top Bar', 'heal'),
                'library' => 'image',
                'dependency' => array('header_3_top_bar_enabled', '==', 'true'),
            ),
            array(
                'id' => 'header_3_top_bar_contacts',
                'type' => 'repeater',
                'title' => esc_html__('Top Contact Infos', 'heal'),
                'dependency' => array('header_3_top_bar_enabled', '==', 'true'),
                'fields' => array(
                    array(
                        'id' => 'icon',
                        'type' => 'icon',
                        'default' => 'fas fa-phone',
                        'title' => esc_html__('Icon', 'heal'),
                    ),
                    array(
                        'id' => 'left_text',
                        'type' => 'text',
                        'title' => esc_html__('Label Text (e.g., Email Address)', 'heal'),
                    ),
                    array(
                        'id' => 'text',
                        'type' => 'text',
                        'title' => esc_html__('Main Text (e.g., info@example.com)', 'heal'),
                    ),
                    array(
                        'id' => 'link_type',
                        'type' => 'select',
                        'title' => esc_html__('Link Type', 'heal'),
                        'options' => array(
                            'email' => 'Email',
                            'phone' => 'Phone',
                            'custom' => 'Custom URL',
                        ),
                        'default' => 'custom',
                    ),
                    array(
                        'id' => 'custom_url',
                        'type' => 'text',
                        'title' => esc_html__('Custom URL (if selected above)', 'heal'),
                        'default' => '#',
                        'dependency' => array('link_type', '==', 'custom'),
                    ),
                )
            ),
            array(
                'id' => 'header_3_search_enabled',
                'type' => 'switcher',
                'title' => esc_html__('Enable Search Icon', 'heal'),
                'default' => true,
                'dependency' => array('header_3_top_bar_enabled', '==', 'true'),
            ),
            array(
                'id' => 'header_3_cart_enabled',
                'type' => 'switcher',
                'title' => esc_html__('Enable Cart Button', 'heal'),
                'default' => true,
                'dependency' => array('header_3_top_bar_enabled', '==', 'true'),
            ),

        )
    ));


    /* Header Style 04 */
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Header 4', 'heal'),
        'id' => 'theme_header_three_options',
        'icon' => 'fa fa-heading',
        'parent' => 'headers_settings',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>Logo Options | Header 4</h3>'
            ),
            array(
                'id' => 'header_4_logo',
                'type' => 'media',
                'title' => esc_html__('Logo', 'heal'),
                'library' => 'image',
            ),
            array(
                'type' => 'subheading',
                'content' => '<h3>Button & Phone Options</h3>'
            ),
            array(
                'id' => 'header_4_right_btn_enabled',
                'type' => 'switcher',
                'title' => esc_html__('Show Button', 'heal'),
                'default' => true,
            ),
            array(
                'id' => 'header_4_right_btn_text',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'heal'),
                'default' => 'Get A Quote',
                'dependency' => array('header_4_right_btn_enabled', '==', 'true'),
            ),
            array(
                'id' => 'header_4_right_btn_url',
                'type' => 'text',
                'title' => esc_html__('Button URL', 'heal'),
                'default' => '#',
                'dependency' => array('header_4_right_btn_enabled', '==', 'true'),
            ),
            array(
                'type' => 'subheading',
                'content' => '<h3>Top Bar Options</h3>'
            ),
            array(
                'id' => 'header_4_top_bar_enabled',
                'type' => 'switcher',
                'title' => esc_html__('Enable Top Bar', 'heal'),
                'default' => true,
            ),
            array(
                'id' => 'header_4_top_bg',
                'type' => 'media',
                'title' => esc_html__('Background Image Top Bar', 'heal'),
                'library' => 'image',
                'dependency' => array('header_4_top_bar_enabled', '==', 'true'),
            ),
            array(
                'id' => 'header_4_top_bar_contacts',
                'type' => 'repeater',
                'title' => esc_html__('Top Contact Infos', 'heal'),
                'dependency' => array('header_4_top_bar_enabled', '==', 'true'),
                'fields' => array(
                    array(
                        'id' => 'icon',
                        'type' => 'icon',
                        'default' => 'fas fa-phone',
                        'title' => esc_html__('Icon', 'heal'),
                    ),
                    array(
                        'id' => 'left_text',
                        'type' => 'text',
                        'title' => esc_html__('Label Text (e.g., Email Address)', 'heal'),
                    ),
                    array(
                        'id' => 'text',
                        'type' => 'text',
                        'title' => esc_html__('Main Text (e.g., info@example.com)', 'heal'),
                    ),
                    array(
                        'id' => 'link_type',
                        'type' => 'select',
                        'title' => esc_html__('Link Type', 'heal'),
                        'options' => array(
                            'email' => 'Email',
                            'phone' => 'Phone',
                            'custom' => 'Custom URL',
                        ),
                        'default' => 'custom',
                    ),
                    array(
                        'id' => 'custom_url',
                        'type' => 'text',
                        'title' => esc_html__('Custom URL (if selected above)', 'heal'),
                        'default' => '#',
                        'dependency' => array('link_type', '==', 'custom'),
                    ),
                )
            ),
            
        )
    ));


    /* Sticky Header */
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Sticky Header', 'heal'),
        'id' => 'sticky_header_options',
        'icon' => 'eicon-header',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Sticky Header Option', 'heal') . '</h3>'
            ),
            array(
                'id' => 'sticky_header_enabled',
                'title' => esc_html__('Sticky Header Enable', 'heal'),
                'type' => 'switcher',
                'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide sticky header', 'heal'), $allowed_html),
                'default' => true,
            ),
        )
    ));

    /* Breadcrumb */
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Breadcrumb', 'heal'),
        'id' => 'breadcrumb_options',
        'icon' => ' eicon-product-breadcrumbs',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Breadcrumb Options', 'heal') . '</h3>'
            ),
            array(
                'id' => 'breadcrumb_enabled',
                'title' => esc_html__('Breadcrumb', 'heal'),
                'type' => 'switcher',
                'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide breadcrumb', 'heal'), $allowed_html),
                'default' => true,
            ),
            array(
                'id' => 'breadcrumb_main_image',
                'type' => 'media',
                'title' => esc_html__('Background Image', 'heal'),
                'library' => 'image',
                'desc' => wp_kses(__('you can upload <mark>background image</mark> here.', 'heal'), $allowed_html),
                'dependency' => array('breadcrumb_enabled', '==', 'true')
            ),
        )
    ));

    /*-------------------------------------------------------
    ** Footer  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title'  => esc_html__('Footer', 'heal'),
        'id'     => 'footer_options',
        'icon'   => 'eicon-footer',
    ));
      
    CSF::createSection($prefix . '_theme_options', array(
        'parent' => 'footer_options',
        'title'  => esc_html__('Footer 1', 'heal'),
        'id'     => 'footer_1_options',
        'icon' => 'fa fa-list-ul',
        'fields' => array(
      
            // Footer Logo
            // array(
            //     'id'      => 'footer_1_logo',
            //     'type'    => 'media',
            //     'title'   => esc_html__('Footer Logo', 'heal'),
            //     'library' => 'image',
            // ),
      
            // // Footer Description
            // array(
            //     'id'    => 'footer_1_description',
            //     'type'  => 'textarea',
            //     'title' => esc_html__('Footer Description', 'heal'),
            // ),
      
            // // Contact Info
            // array(
            //     'id'     => 'footer_1_contact_info',
            //     'type'   => 'repeater',
            //     'title'  => esc_html__('Contact Info', 'heal'),
            //     'fields' => array(
            //     array(
            //         'id'      => 'icon_img',
            //         'type'    => 'media',
            //         'title'   => esc_html__('Icon Image', 'heal'),
            //         'library' => 'image',
            //     ),
            //     array(
            //         'id'    => 'label',
            //         'type'  => 'text',
            //         'title' => esc_html__('Label (e.g. Phone, Location)', 'heal'),
            //     ),
            //     array(
            //         'id'    => 'value',
            //         'type'  => 'text',
            //         'title' => esc_html__('Text (e.g. number/address)', 'heal'),
            //     ),
            //     array(
            //         'id'    => 'url',
            //         'type'  => 'text',
            //         'title' => esc_html__('Optional Link (e.g. tel: or map URL)', 'heal'),
            //     ),
            //     ),
            // ),
        
            // Footer Widgets (4 columns)
            // array(
            //     'id'     => 'footer_1_widgets',
            //     'type'   => 'repeater',
            //     'title'  => esc_html__('Footer Widgets (Max 3 Columns)', 'heal'),
            //     'max'    => 4,
            //     'fields' => array(
            //     array(
            //         'id'    => 'widget_title',
            //         'type'  => 'text',
            //         'title' => esc_html__('Widget Title', 'heal'),
            //     ),
            //     array(
            //         'id'     => 'widget_links',
            //         'type'   => 'repeater',
            //         'title'  => esc_html__('Widget Links', 'heal'),
            //         'fields' => array(
            //         array(
            //             'id'    => 'text',
            //             'type'  => 'text',
            //             'title' => esc_html__('Link Text', 'heal'),
            //         ),
            //         array(
            //             'id'    => 'url',
            //             'type'  => 'text',
            //             'title' => esc_html__('Link URL', 'heal'),
            //         ),
            //         ),
            //     ),
            //     ),
            // ),
        
            // // Newsletter Section
            // array(
            //     'type'    => 'subheading',
            //     'content' => esc_html__('Newsletter Section', 'heal'),
            // ),
            // array(
            //     'id'    => 'newsletter_title',
            //     'type'  => 'text',
            //     'title' => esc_html__('Newsletter Title', 'heal'),
            // ),
    
            // array(
            //     'id' => 'footer_1_newsletter_form',
            //     'type' => 'text',
            //     'title' => esc_html__('Newsletter Form Shortcode', 'heal'),
            //     'desc' => wp_kses(__('Use <mark> MC4WP/Mailchimp</mark> shorcode here', 'heal'), $allowed_html),
            // ),  



            // Social Icons
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Social Media Icons', 'heal'),
            ),
            array(
                'id'     => 'footer_1_socials',
                'type'   => 'repeater',
                'title'  => esc_html__('Social Media Links', 'heal'),
                'fields' => array(
                array(
                    'id'    => 'icon',
                    'type'  => 'icon',
                    'title' => esc_html__('Social Icon', 'heal'),
                ),
                array(
                    'id'    => 'url',
                    'type'  => 'text',
                    'title' => esc_html__('URL', 'heal'),
                ),
                ),
            ),
        
            // Background Images (Shapes / Dots)
            // array(
            //     'type'    => 'subheading',
            //     'content' => esc_html__('Footer Background Shapes', 'heal'),
            // ),

            // array(
            //     'id' => 'footer_1_shapes',
            //     'type' => 'media',
            //     'title' => esc_html__('Footer Gt line Shape', 'heal'),
            //     'library' => 'image',
            //     'desc' => wp_kses(__('you can upload <mark> shape image</mark> here', 'heal'), $allowed_html),
            // ),

            // array(
            //     'id' => 'footer_shapes_2',
            //     'type' => 'media',
            //     'title' => esc_html__('Footer Gt line Shape 2', 'heal'),
            //     'library' => 'image',
            //     'desc' => wp_kses(__('you can upload <mark> shape image</mark> here', 'heal'), $allowed_html),
            // ),

            // array(
            //     'id' => 'footer_shapes_3',
            //     'type' => 'media',
            //     'title' => esc_html__('Footer Gt line Shape Dot', 'heal'),
            //     'library' => 'image',
            //     'desc' => wp_kses(__('you can upload <mark> shape image</mark> here', 'heal'), $allowed_html),
            // ),

            // Copyright
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Footer Copyright', 'heal'),
            ),
            array(
                'id'    => 'footer_1_copyright',
                'type'  => 'textarea',
                'title' => esc_html__('Copyright Text', 'heal'),
                'desc'  => esc_html__('Use {year} to auto-print current year.', 'heal'),
            ),
      
        )
    ));

      
    /*-------------------------------------------------------
           ** Footer Style Two
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'parent' => 'footer_options',
        'id' => 'footer_two_options',
        'title' => esc_html__('Footer 2', 'heal'),
        'icon' => 'fa fa-list-ul',
        'fields' => array(
      
            // Footer Background
            array(
                'id'      => 'footer_2_bg_color',
                'type'    => 'color',
                'title'   => esc_html__('Footer Background Color', 'heal'),
                'default' => true,
            ),
        
            // Footer Bottom Section
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Footer Bottom Area', 'heal'),
            ),
            array(
                'id'    => 'footer_2_copyright',
                'type'  => 'textarea',
                'title' => esc_html__('Copyright Text', 'heal'),
                'desc'  => esc_html__('Use {year} to auto-print current year.', 'heal'),
            ),
            array(
                'id'     => 'footer_2_bottom_links',
                'type'   => 'repeater',
                'title'  => esc_html__('Footer Bottom Menu', 'heal'),
                'fields' => array(
                array(
                    'id'    => 'text',
                    'type'  => 'text',
                    'title' => esc_html__('Link Text', 'heal'),
                ),
                array(
                    'id'    => 'url',
                    'type'  => 'text',
                    'title' => esc_html__('Link URL', 'heal'),
                ),
                ),
            ),
        )
    ));

    

    /*-------------------------------------------------------
          ** Blog  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'blog_settings',
        'title' => esc_html__('Blog Settings', 'heal'),
        'icon' => 'fa fa-book'
    ));
    CSF::createSection($prefix . '_theme_options', array(
        'parent' => 'blog_settings',
        'id' => 'blog_post_options',
        'title' => esc_html__('Blog Post', 'heal'),
        'icon' => 'fa fa-list-ul',
        'fields' => Heal_Group_Fields::post_meta('blog_post', esc_html__('Blog Page', 'heal'))
    ));
    CSF::createSection($prefix . '_theme_options', array(
        'parent' => 'blog_settings',
        'id' => 'blog_single_post_options',
        'title' => esc_html__('Single Post', 'heal'),
        'icon' => 'fa fa-list-alt',
        'fields' => Heal_Group_Fields::post_meta('blog_single_post', esc_html__('Blog Single Page', 'heal'))
    )); 

    /*-------------------------------------------------------
          ** Pages & templates Options
   --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'pages_and_template',
        'title' => esc_html__('Pages Settings', 'heal'),
        'icon' => 'fa fa-files-o'
    ));

    /*  404 page options */
    CSF::createSection( $prefix . '_theme_options', array(
        'id' => '404_page',
        'title' => esc_html__('Blog Settings', 'heal'),
        'parent' => 'pages_and_template',
        'icon' => 'fa fa-exclamation-triangle',
        'fields' => array(

            array(
                'id'      => '404_enable_image',
                'type'    => 'switcher',
                'title'   => esc_html__('Enable 404 Image', 'heal'),
                'default' => true,
            ),

            array(
                'id'         => '404_image',
                'type'       => 'media',
                'title'      => esc_html__('404 Image', 'heal'),
                'desc'       => esc_html__('Upload the error image shown on the 404 page.', 'heal'),
                'dependency' => array('404_enable_image', '==', 'true'),
            ),

            array(
                'type'    => 'subheading',
                'content' => '<h4>' . esc_html__('404 Page Content', 'heal') . '</h4>',
            ),

            // array(
            //     'id'       => '404_big_title',
            //     'type'     => 'text',
            //     'title'    => esc_html__('Title Highlighted Text', 'heal'),
            //     'default'  => 'Oops',
            //     'desc'     => esc_html__('Heading Highlighted text for 404 page.', 'heal'),
            // ),

            array(
                'id'       => '404_title',
                'type'     => 'text',
                'title'    => esc_html__('Title Text', 'heal'),
                'default'  => 'Oops... Looks like You got lost..!!',
                'desc'     => esc_html__('Main heading text for 404 page.', 'heal'),
            ),

            array(
                'id'       => '404_paragraph',
                'type'     => 'textarea',
                'title'    => esc_html__('Paragraph Text', 'heal'),
                'default'  => "Looks like you took a wrong turn! But don’t worry, even the best riders get lost sometimes.",
            ),

            array(
                'id'       => '404_button_text',
                'type'     => 'text',
                'title'    => esc_html__('Button Text', 'heal'),
                'default'  => 'BACK TO HOME',
            ),

            array(
                'type'    => 'subheading',
                'content' => '<h4>' . esc_html__('404 Page Design Options', 'heal') . '</h4>',
            ),

            array(
                'id'      => '404_background_color',
                'type'    => 'color',
                'title'   => esc_html__('Background Color', 'heal'),
                'default' => '#ffffff',
            ),
            array(
                'id'      => '404_title_color',
                'type'    => 'color',
                'title'   => esc_html__('Title Color', 'heal'),
                'default' => '#000',
            ),

            array(
                'id'      => '404_desc_color',
                'type'    => 'color',
                'title'   => esc_html__('Description Color', 'heal'),
                'default' => '#332c2cff',
            ),

            array(
                'id'      => '404_padding_top',
                'type'    => 'slider',
                'title'   => esc_html__('Padding Top (px)', 'heal'),
                'default' => 120,
                'min'     => 0,
                'max'     => 300,
                'step'    => 1,
                'unit'    => 'px',
            ),

            array(
                'id'      => '404_padding_bottom',
                'type'    => 'slider',
                'title'   => esc_html__('Padding Bottom (px)', 'heal'),
                'default' => 120,
                'min'     => 0,
                'max'     => 300,
                'step'    => 1,
                'unit'    => 'px',
            ),
        )
    ) );




    /*  blog page options */
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'blog_page',
        'title' => esc_html__('Blog Page', 'heal'),
        'parent' => 'pages_and_template',
        'icon' => 'fa fa-indent',
        'fields' => Heal_Group_Fields::page_layout_options(esc_html__('Blog', 'heal'), 'blog')
    ));
    /*  blog single page options */
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'blog_single_page',
        'title' => esc_html__('Blog Single Page', 'heal'),
        'parent' => 'pages_and_template',
        'icon' => 'fa fa-indent',
        'fields' => Heal_Group_Fields::page_layout_options(esc_html__('Blog Single', 'heal'), 'blog_single')
    ));
    /*  archive page options */
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'archive_page',
        'title' => esc_html__('Archive Page', 'heal'),
        'parent' => 'pages_and_template',
        'icon' => 'fa fa-archive',
        'fields' => Heal_Group_Fields::page_layout_options(esc_html__('Archive', 'heal'), 'archive')
    ));
    /*  search page options */
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'search_page',
        'title' => esc_html__('Search Page', 'heal'),
        'parent' => 'pages_and_template',
        'icon' => 'fa fa-search',
        'fields' => Heal_Group_Fields::page_layout_options(esc_html__('Search', 'heal'), 'search')
    ));

    /*-------------------------------------------------------
           ** Backup  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'backup',
        'title' => esc_html__('Import / Export', 'heal'),
        'icon' => 'eicon-export-kit',
        'fields' => array(
            array(
                'type' => 'notice',
                'style' => 'warning',
                'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'heal'),
            ),
            array(
                'type' => 'backup',
                'title' => esc_html__('Backup & Import', 'heal')
            )
        )
    ));
}
