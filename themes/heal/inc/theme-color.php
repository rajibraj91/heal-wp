<?php
/**
 * Enqueue theme styles with dynamic color options
 */

// function enqueue_custom_color_stylesheet() {
//     // Enqueue the main stylesheet
//     wp_enqueue_style('heal-style', get_stylesheet_uri());

//     // Apnar specific color palette
//     $theme_body_color   = '#fff'; 
//     $theme_black_color  = '#000'; 
//     $theme_white_color  = '#fff'; 
//     $theme_color_1      = '#E63946'; 
//     $theme_header_color = '#1D1D1D'; 
//     $theme_text_1_color = '#595959'; 
//     $theme_border_color = '#FCFCFC'; 
//     $theme_bg_color     = '#F2F2F2'; 
//     $theme_box_shadow   = '0px 1px 14px 0px rgba(0, 0, 0, 0.13)'; 

//     // Load a separate stylesheet for theme colors
//     wp_enqueue_style('custom-color-theme', get_template_directory_uri() . '/inc/theme-stylesheets/theme-color.css');

//     // Add inline CSS for theme colors
//     $custom_css = "
//     :root {
//         --gt-body: " . esc_attr($theme_body_color) . ";
//         --gt-black: " . esc_attr($theme_black_color) . ";
//         --gt-white: " . esc_attr($theme_white_color) . ";
//         --gt-theme: " . esc_attr($theme_color_1) . ";
//         --gt-header: " . esc_attr($theme_header_color) . ";
//         --gt-text: " . esc_attr($theme_text_1_color) . ";
//         --gt-border: " . esc_attr($theme_border_color) . ";
//         --gt-bg: " . esc_attr($theme_bg_color) . ";
//         --gt-box-shadow: " . esc_attr($theme_box_shadow) . ";
//     }";

//     // Add the inline styles to the theme stylesheet
//     wp_add_inline_style('custom-color-theme', $custom_css);
// }
// add_action('wp_enqueue_scripts', 'enqueue_custom_color_stylesheet');





function enqueue_custom_color_stylesheet() {
    // Enqueue main stylesheet
    wp_enqueue_style('heal-style', get_stylesheet_uri());

    // Load color CSS
    wp_enqueue_style('custom-color-theme', get_template_directory_uri() . '/inc/theme-stylesheets/theme-color.css');

    // Fetch theme options (via CSF)
    $theme_body_color   = cs_get_option('theme_body_color') ?: '#fff';
    $theme_black_color  = cs_get_option('theme_black_color') ?: '#000';
    $theme_white_color  = cs_get_option('theme_white_color') ?: '#fff';
    $theme_color_1      = cs_get_option('theme_color_1') ?: '#da5455';
    $theme_color_2      = cs_get_option('theme_color_2') ?: '#5faf1f';
    $theme_color_3      = cs_get_option('theme_color_3') ?: '#f39c12';
    $primary_color      = cs_get_option('primary_color') ?: '#f39c12';
    $theme_header_color = cs_get_option('theme_header_color') ?: '#1D1D1D';
    $theme_title_color  = cs_get_option('theme_title_color') ?: '#0d0d0d';
    $theme_text_1_color = cs_get_option('theme_text_1_color') ?: '#737373';
    $theme_border_color = cs_get_option('theme_border_color') ?: '#ecf0f3';
    $theme_bg_ash_color     = cs_get_option('theme_bg_ash_color') ?: '#e3e7e8';
    $theme_box_shadow   = cs_get_option('theme_box_shadow') ?: '0px 1px 5px 0px rgba(0, 0, 0, 0.13)';

    // Inline CSS
    $custom_css = "
    :root {
        --mrs-body: {$theme_body_color};
        --mrs-title: {$theme_title_color};
        --mrs-black: {$theme_black_color};
        --mrs-white: {$theme_white_color};
        --mrs-theme: {$theme_color_1};
        --mrs-theme2: {$theme_color_2};
        --mrs-theme3: {$theme_color_3};
        --mrs-primary: {$primary_color};
        --mrs-header: {$theme_header_color};
        --mrs-text: {$theme_text_1_color};
        --mrs-border: {$theme_border_color};
        --mrs-bg-ash: {$theme_bg_ash_color};
        --mrs-box-shadow: {$theme_box_shadow};
    }";

    wp_add_inline_style('custom-color-theme', $custom_css);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_color_stylesheet');


?>

