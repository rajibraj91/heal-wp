<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Check if Codestar Framework exists
if ( class_exists( 'CSF' ) ) {

    $td_menu_meta = 'td_menu_meta';

    // Create Nav Menu Options for Codestar
    CSF::createNavMenuOptions( $td_menu_meta, array(
        'data_type' => 'serialize',
    ) );

    CSF::createSection( $td_menu_meta, array(
        'fields' => array(
            array(
                'id'       => 'enable_mega_menu',
                'type'     => 'switcher',
                'title'    => esc_html__( 'Enable Mega Menu', 'heal-core' ),
                'text_on'  => esc_html__( 'Yes', 'heal-core' ),
                'text_off' => esc_html__( 'No', 'heal-core' ),
                'default'  => false,
            ),
            array(
                'id'         => 'mega_menu_column',
                'type'       => 'select',
                'title'      => esc_html__( 'Mega Menu Column', 'heal-core' ),
                'options'    => array(
                    'td-mega-col-3' => '3 Column',
                    'td-mega-col-6' => '6 Column',
                ),
                'default'    => 'td-mega-col-6',
                'dependency' => array( 'enable_mega_menu', '==', 'true' ),
                'desc'       => esc_html__( 'Select number of columns for Mega Menu', 'heal-core' ),
            ),
            array(
                'id'         => 'mega_menu_items',
                'type'       => 'group',
                'title'      => esc_html__( 'Mega Menu Items', 'heal-core' ),
                'dependency' => array( 'enable_mega_menu', '==', 'true' ),
                'fields'     => array(
                    array(
                        'id'      => 'image',
                        'type'    => 'media',
                        'title'   => esc_html__( 'Image', 'heal-core' ),
                        'library' => 'image',
                        'url'     => false,
                    ),
                    array(
                        'id'    => 'title',
                        'type'  => 'text',
                        'title' => esc_html__( 'Title', 'heal-core' ),
                    ),
                    array(
                        'id'           => 'buttons',
                        'type'         => 'group',
                        'title'        => esc_html__( 'Buttons', 'heal-core' ),
                        'button_title' => esc_html__( 'Add Button', 'heal-core' ),
                        'fields'       => array(
                            array(
                                'id'    => 'text',
                                'type'  => 'text',
                                'title' => esc_html__( 'Button Text', 'heal-core' ),
                            ),
                            array(
                                'id'    => 'link',
                                'type'  => 'text',
                                'title' => esc_html__( 'Button Link', 'heal-core' ),
                            ),
                            array(
                                'id'      => 'target',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Button Target', 'heal-core' ),
                                'options' => array(
                                    '_self'  => esc_html__( 'Same Window', 'heal-core' ),
                                    '_blank' => esc_html__( 'New Window', 'heal-core' ),
                                ),
                                'default' => '_self',
                            ),
                        ),
                    ),
                ),
                'button_title' => esc_html__( 'Add Mega Menu Item', 'heal-core' ),
            ),
            array(
                'id'           => 'menu_image',
                'type'         => 'media',
                'title'        => esc_html__( 'Menu Image (For non-mega menu)', 'heal-core' ),
                'library'      => 'image',
                'url'          => false,
                'desc'         => esc_html__( 'Use same size image for all menu item.', 'heal-core' ),
                'button_title' => esc_html__( 'Upload Image', 'heal-core' ),
                'dependency'   => array( 'enable_mega_menu', '!=', 'true' ),
            ),
        ),
    ) );
}

// Remove title attribute from menu item <a> tag
function td_remove_nav_menu_link_title( $atts, $item, $args, $depth ) {
    if ( isset( $atts['title'] ) ) {
        unset( $atts['title'] );
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'td_remove_nav_menu_link_title', 10, 4 );

// Add classes for mega menu items
function td_add_mega_menu_class( $classes, $item ) {
    $menu_meta = get_post_meta( $item->ID, 'td_menu_meta', true );

    if ( is_array( $menu_meta ) ) {
        if ( ! empty( $menu_meta['enable_mega_menu'] ) ) {
            $classes[] = 'td-mega-menu';
            $classes[] = sanitize_html_class( $menu_meta['mega_menu_column'] );
        }
        if ( ! empty( $menu_meta['menu_image']['url'] ) ) {
            $classes[] = 'td-mega-menu-image';
        }
    }

    return $classes;
}
add_filter( 'nav_menu_css_class', 'td_add_mega_menu_class', 10, 2 );

// Inject mega menu markup outside <a> tag in menu item and remove Navigation Label text inside <a>
function td_wp_nav_menu_start_el( $item_output, $item, $depth, $args ) {
    $menu_meta = get_post_meta( $item->ID, 'td_menu_meta', true );

    if ( ! is_array( $menu_meta ) ) {
        return $item_output;
    }

    // Remove Navigation Label text inside <a> for mega menu items
    if ( ! empty( $menu_meta['enable_mega_menu'] ) ) {
        // Replace the text inside <a>...</a> with empty string (keeping <a> tag and attributes intact)
        $item_output = preg_replace( '/(<a\b[^>]*>)(.*?)(<\/a>)/is', '$1$3', $item_output );
    }

    // Mega Menu enabled with items
    if ( ! empty( $menu_meta['enable_mega_menu'] ) && ! empty( $menu_meta['mega_menu_items'] ) ) {

        ob_start();

        echo '<div class="td-mega-menu-wrapper">';

        foreach ( $menu_meta['mega_menu_items'] as $mega_item ) {
            $image_url = ! empty( $mega_item['image']['url'] ) ? esc_url( $mega_item['image']['url'] ) : '';
            $image_alt = esc_attr( $mega_item['image']['alt'] ?? '' );
            $title     = esc_html( $mega_item['title'] ?? '' );

            echo '<div class="homemenu">';

            if ( $image_url ) {
                echo '<div class="homemenu-thumb">';
                echo '<img loading="lazy" src="' . $image_url . '" alt="' . $image_alt . '">';
            }

            if ( ! empty( $mega_item['buttons'] ) ) {
                echo '<div class="demo-button">';
                foreach ( $mega_item['buttons'] as $button ) {
                    $btn_text   = esc_html( $button['text'] ?? '' );
                    $btn_link   = esc_url( $button['link'] ?? '#' );
                    $btn_target = ( isset( $button['target'] ) && $button['target'] === '_blank' ) ? ' target="_blank" rel="noopener noreferrer"' : '';

                    echo '<a href="' . $btn_link . '"' . $btn_target . ' class="default-btn move-right">';
                    echo '<span class="gt-icon-btn"><i class="icon-icon-1"></i></span>';
                    echo '<span class="gt-text-btn"><span class="gt-text-2">' . $btn_text . '</span></span>';
                    echo '</a>';
                }
                echo '</div>'; // .demo-button
            }

            if ( $image_url ) {
                echo '</div>'; // .homemenu-thumb
            }

            echo '<div class="homemenu-content text-center">';
            echo '<h4 class="homemenu-title">' . $title . '</h4>';
            echo '</div>';

            echo '</div>'; // .homemenu
        }

        echo '</div>';

        $mega_menu_html = ob_get_clean();

        // Append mega menu HTML after closing </a> tag
        $pos = strpos( $item_output, '</a>' );
        if ( $pos !== false ) {
            $item_output = substr_replace( $item_output, '</a>' . $mega_menu_html, $pos, 4 );
        } else {
            // fallback, append at the end
            $item_output .= $mega_menu_html;
        }

        return $item_output;
    }

    // Non mega menu image output
    if ( ! empty( $menu_meta['menu_image']['url'] ) ) {
        $image_url = esc_url( $menu_meta['menu_image']['url'] );
        $image_alt = esc_attr( $menu_meta['menu_image']['alt'] ?? '' );
        $image_html = '<div class="td-mega-menu-image-wrapper"><img loading="lazy" src="' . $image_url . '" alt="' . $image_alt . '"></div>';

        // Append after <a> tag
        $pos = strpos( $item_output, '</a>' );
        if ( $pos !== false ) {
            $item_output = substr_replace( $item_output, '</a>' . $image_html, $pos, 4 );
        } else {
            $item_output .= $image_html;
        }
    }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'td_wp_nav_menu_start_el', 10, 4 );
