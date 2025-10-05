<?php

/**
 * Elementor Addons Init
 * @package heal
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // exit if access directly
}

if ( ! class_exists( 'Heal_Elementor_Widget_Init' ) ) {

	class Heal_Elementor_Widget_Init {
	   /**
		* $instance
		* @since 1.0.0
		*/
		private static $instance;

	   /**
		* construct()
		* @since 1.0.0
		*/
		public function __construct() {
			// Category register + move to top (run LAST so we can reorder safely)
			add_action( 'elementor/elements/categories_registered', array( $this, '_widget_categories' ), 9999 );

			// Elementor widget registered (your existing loader)
			add_action( 'elementor/widgets/widgets_registered', array( $this, '_widget_registered' ) );

			// Elementor editor CSS
			add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'load_assets_for_elementor' ) );

			// i18n
			add_action( 'init', [ $this, 'i18n' ] );

			// icomoon icon pack include via modern register hook
			add_action( 'plugins_loaded', [ $this, 'init' ] );
		}

		public function i18n() {
			load_plugin_textdomain( 'heal-core' );
		}

		/**
	     * getInstance()
	     * @since 1.0.0
	     */
		public static function getInstance() {
			if ( null == self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * _widget_categories()
		 * Register our category and move it to the top of the list.
		 * @since 1.0.0
		 */
		// public function _widget_categories( $elements_manager ) {

		// 	// 1) Ensure our category exists
		// 	$elements_manager->add_category(
		// 		'heal_widgets',
		// 		[
		// 			'title' => esc_html__( 'Heal Widgets', 'heal-core' ),
		// 			'icon'  => 'fas fa-plug',
		// 		],

		// 		// Even
		// 		'heal_event_widgets',
		// 		[
		// 			'title' => esc_html__( 'Heal Event Widgets', 'heal-core' ),
		// 			'icon'  => 'fas fa-plug',
		// 		],
		// 	);


		// 	// 2) Reorder: bring 'heal_widgets' to the very first position
		// 	if ( ! method_exists( $elements_manager, 'get_categories' ) ) {
		// 		return;
		// 	}

		// 	$cats = $elements_manager->get_categories();
		// 	if ( empty( $cats['heal_widgets'] ) || ! is_array( $cats ) ) {
		// 		return;
		// 	}

		// 	// If already first, do nothing
		// 	if ( function_exists( 'array_key_first' ) && array_key_first( $cats ) === 'heal_widgets' ) {
		// 		return;
		// 	}

		// 	// Build new array: our category first, then the rest in original order
		// 	$new_order = [ 'heal_widgets' => $cats['heal_widgets'] ] + array_diff_key( $cats, [ 'heal_widgets' => true ] );

		// 	// 3) Write back into Elements_Manager::$categories via closure (safe for PHP 7.1+)
		// 	$setter = function ( $categories ) {
		// 		$this->categories = $categories; // $this === Elements_Manager
		// 	};

		// 	try {
		// 		$setter->call( $elements_manager, $new_order );
		// 	} catch ( \Throwable $e ) {
		// 		// Fallback with reflection (rarely needed)
		// 		try {
		// 			$ref = new \ReflectionClass( $elements_manager );
		// 			if ( $ref->hasProperty( 'categories' ) ) {
		// 				$prop = $ref->getProperty( 'categories' );
		// 				$prop->setAccessible( true );
		// 				$prop->setValue( $elements_manager, $new_order );
		// 			}
		// 		} catch ( \Exception $ignore ) {
		// 			// If this fails, editor still works; only order won't change.
		// 		}
		// 	}
		// }


		public function _widget_categories( $elements_manager ) {
			// categories
			$elements_manager->add_category(
				'heal_charity',
				[
					'title' => esc_html__( 'Heal Charity', 'heal-core' ),
					'icon'  => 'fas fa-plug',
				]
			);

			$elements_manager->add_category(
				'heal_religion',
				[
					'title' => __( 'Heal Religion', 'heal-core' ),
					'icon'  => 'fas fa-briefcase',
				]
			);

			$elements_manager->add_category(
				'heal_event',
				[
					'title' => __( 'Heal Event', 'heal-core' ),
					'icon'  => 'fas fa-calendar',
				]
			);

			

			// get_categories
			$cats = $elements_manager->get_categories();

			$desired_order = [
				'heal_religion',
				'heal_charity',
				'heal_event',
			];

			$new_order = [];
			foreach ( $desired_order as $slug ) {
				if ( isset( $cats[ $slug ] ) ) {
					$new_order[ $slug ] = $cats[ $slug ];
				}
			}

			$new_order = $new_order + array_diff_key( $cats, $new_order );

			$setter = function( $categories ) {
				$this->categories = $categories; // $this === Elements_Manager
			};
			$setter->call( $elements_manager, $new_order );

		}



		/**
		 * _widget_registered()
		 * Your existing widget loader
		 * @since 1.0.0
		 */
		public function _widget_registered() {
			if ( ! class_exists( 'Elementor\Widget_Base' ) ) {
				return;
			}
			$elementor_widgets = array(
				// Charity Addon
				'charity-banner',
				'charity-about',
				'charity-donate',
				'charity-sermon',
				'charity-gallery',
				'charity-event',
				'charity-cause',
				'charity-service',
				'charity-priceing',
				'charity-testmonial',
				'charity-blog',
				'charity-counter',
				'charity-sponsor',
				'charity-volunteers',
				'charity-contact',
				'charity-angular',

				// Religion Addon
				'religion-banner',
				'religion-about',
				'religion-feature',
				'religion-service',
				'religion-donate',
				'religion-cause',
				'religion-faith',
				'religion-quote',
				'religion-event',


				// Event Addon
				// 'event-about',
			);

			$elementor_widgets = apply_filters( 'heal_elementor_widget', $elementor_widgets );
			ksort( $elementor_widgets );

			if ( is_array( $elementor_widgets ) && ! empty( $elementor_widgets ) ) {
				foreach ( $elementor_widgets as $widget ) {
					if ( file_exists( HEAL_CORE_ELEMENTOR . '/addons/elementor-' . $widget . '-widget.php' ) ) {
						require_once HEAL_CORE_ELEMENTOR . '/addons/elementor-' . $widget . '-widget.php';
					}
				}
			}
		}

		/**
		 * Load custom assets for Elementor editor
		 * @since 1.0.0
		 */
		public function load_assets_for_elementor() {
			wp_enqueue_style( 'heal-core-elementor-style', HEAL_CORE_ADMIN_ASSETS . '/css/elementor-editor.css' );
		}

		/**
		 * Load custom icons for Elementor
		 * @since 1.0.0
		*/
		public function init() {
			// Modern hook (kept as you had)
			add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		}

		public function init_widgets() {
			require_once plugin_dir_path( __FILE__ ) . '../customicon/icon.php';
		}
	}

	if ( class_exists( 'Heal_Elementor_Widget_Init' ) ) {
		Heal_Elementor_Widget_Init::getInstance();
	}
} // end if
