<?php
/**
 * Register Custom Post Types, Taxonomies, and Tags
 * @package Heal-Core
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit(); // Exit if accessed directly
}

if ( ! class_exists( 'Heal_Custom_Post_Type' ) ) {
    class Heal_Custom_Post_Type {

        private static $instance;

        public static function get_instance() {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function __construct() {
            add_action( 'init', [ $this, 'register_post_types_and_taxonomies' ] );
        }

        public function register_post_types_and_taxonomies() {
            if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
                return;
            }

            $post_types = [
                'service' => 'Service',
                'event'   => 'Event',
                'team'    => 'Team',
                'sermon'  => 'Sermon',
                'cause'  => 'Cause',
            ];

            foreach ( $post_types as $slug => $label ) {
                register_post_type( $slug, [
                    'label'               => esc_html__( $label, 'heal-core' ),
                    'description'         => esc_html__( $label, 'heal-core' ),
                    'labels'              => $this->get_labels( $label ),
                    'supports'            => [ 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'page-attributes' ],
                    'hierarchical'        => false,
                    'public'              => true,
                    'publicly_queryable'  => true,
                    'show_ui'             => true,
                    'show_in_menu'        => 'heal_theme_options',
                    'rewrite'             => [ 'slug' => 'all-' . $slug, 'with_front' => true ],
                    'can_export'          => true,
                    'capability_type'     => 'post',
                    'show_in_rest'        => true,
                    'rest_base'           => $slug,
                    'query_var'           => true,
                    'has_archive'         => true // Add this line to fix category/tag issue
                ] );
            }

            $taxonomies = [
                'service' => 'Service',
                'event'   => 'Event',
                'team'    => 'Team',
                'sermon'  => 'Sermon',
                'cause'  => 'Cause',
            ];

            foreach ( $taxonomies as $slug => $label ) {
                register_taxonomy( $slug . '-cat', [ $slug ], [
                    'labels'            => $this->get_taxonomy_labels( $label . ' Category' ),
                    'public'            => true,
                    'hierarchical'      => true,
                    'show_ui'           => true,
                    'show_admin_column' => true,
                    'rewrite'           => [ 'slug' => $slug . '-cat', 'with_front' => true ],
                    'show_in_rest'      => true,
                    'rest_base'         => "{$slug}-categories",
                ] );

                register_taxonomy( $slug . '-tag', [ $slug ], [
                    'labels'            => $this->get_taxonomy_labels( $label . ' Tag' ),
                    'public'            => true,
                    'hierarchical'      => false,
                    'show_ui'           => true,
                    'show_admin_column' => true,
                    'rewrite'           => [ 'slug' => $slug . '-tag' ],
                    'show_in_rest'      => true,
                    'rest_base'         => "{$slug}-tags",
                ] );
            }
        }

        private function get_labels( $singular ) {
            $plural = $singular . 's';
            return [
                'name'                  => esc_html__( $plural, 'heal-core' ),
                'singular_name'         => esc_html__( $singular, 'heal-core' ),
                'menu_name'             => esc_html__( $plural, 'heal-core' ),
                'name_admin_bar'        => esc_html__( $singular, 'heal-core' ),
                'add_new'               => esc_html__( 'Add New', 'heal-core' ),
                'add_new_item'          => esc_html__( "Add New $singular", 'heal-core' ),
                'edit_item'             => esc_html__( "Edit $singular", 'heal-core' ),
                'new_item'              => esc_html__( "New $singular", 'heal-core' ),
                'view_item'             => esc_html__( "View $singular", 'heal-core' ),
                'search_items'          => esc_html__( "Search $plural", 'heal-core' ),
                'not_found'             => esc_html__( 'Not found', 'heal-core' ),
                'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'heal-core' ),
                'featured_image'        => esc_html__( "$singular Image", 'heal-core' ),
                'set_featured_image'    => esc_html__( "Set $singular Image", 'heal-core' ),
                'remove_featured_image' => esc_html__( "Remove $singular Image", 'heal-core' ),
            ];
        }

        private function get_taxonomy_labels( $singular ) {
            $plural = $singular . 's';
            return [
                'name'              => esc_html__( $plural, 'heal-core' ),
                'singular_name'     => esc_html__( $singular, 'heal-core' ),
                'search_items'      => esc_html__( "Search $plural", 'heal-core' ),
                'all_items'         => esc_html__( "All $plural", 'heal-core' ),
                'parent_item'       => esc_html__( "Parent $singular", 'heal-core' ),
                'edit_item'         => esc_html__( "Edit $singular", 'heal-core' ),
                'update_item'       => esc_html__( "Update $singular", 'heal-core' ),
                'add_new_item'      => esc_html__( "Add New $singular", 'heal-core' ),
                'new_item_name'     => esc_html__( "New $singular Name", 'heal-core' ),
                'menu_name'         => esc_html__( $plural, 'heal-core' ),
            ];
        }
    }

    add_action( 'plugins_loaded', [ 'Heal_Custom_Post_Type', 'get_instance' ] );

    // Safe Rewrite Flush only on activation
    register_activation_hook( __FILE__, function () {
        Heal_Custom_Post_Type::get_instance()->register_post_types_and_taxonomies();
        flush_rewrite_rules();
    });
}