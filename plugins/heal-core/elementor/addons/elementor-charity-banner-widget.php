<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Banner Widget (Improved + More Style Controls)
 * @package heal-core
 * @since 1.0.0
 */
class Theme_Banner extends Widget_Base {

	public function get_name() { return 'banner-widget'; }
	public function get_title() { return esc_html__( 'Banner', 'heal-core' ); }
	public function get_icon() { return 'theme-icon'; }
	public function get_categories() { return [ 'heal_charity' ]; }

	public function get_script_depends() {
		$deps = [ 'jquery' ];
		if ( wp_script_is( 'swiper', 'registered' ) ) {
			$deps[] = 'swiper';
		} else {
			$deps[] = 'elementor-frontend';
		}
		return $deps;
	}

	public function get_style_depends() {
		return wp_style_is( 'swiper', 'registered' ) ? [ 'swiper' ] : [];
	}

	protected function register_controls() {

		/* -------------------------
		 * CONTENT — Style chooser
		 * ------------------------- */
		$this->start_controls_section( 'theme_banner', [ 'label' => esc_html__( 'Banner', 'heal-core' ) ] );
		$this->add_control( 'style', [
			'label'   => esc_html__( 'Select Style', 'heal-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'style1',
			'options' => [
				'style1' => esc_html__( 'Style 1', 'heal-core' ),
				'style2' => esc_html__( 'Style 2', 'heal-core' ),
				'style3' => esc_html__( 'Style 3', 'heal-core' ),
			],
		] );
		$this->end_controls_section();

		/* -------------------------
		 * CONTENT — Slider options
		 * ------------------------- */
		$this->start_controls_section( 'slider_opts', [
			'label' => __( 'Slider Options', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
			'condition' => [ 'style' => [ 'style1', 'style3' ] ],
		] );

		$this->add_control( 'enable_autoplay', [
			'label'   => __( 'Autoplay', 'heal-core' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'autoplay_delay', [
			'label' => __( 'Autoplay Delay (ms)', 'heal-core' ),
			'type'  => Controls_Manager::NUMBER,
			'min'   => 100,
			'step'  => 100,
			'default' => 10000,
			'condition' => [ 'enable_autoplay' => 'yes' ],
		] );

		$this->add_control( 'enable_loop', [
			'label'   => __( 'Loop', 'heal-core' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'transition_speed', [
			'label' => __( 'Transition Speed (ms)', 'heal-core' ),
			'type'  => Controls_Manager::NUMBER,
			'min'   => 100,
			'step'  => 50,
			'default' => 600,
		] );

		$this->add_control( 'show_pagination', [
			'label'   => __( 'Show Pagination', 'heal-core' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->end_controls_section();

		/* -------------------------
		 * CONTENT — Image Part (style2)
		 * ------------------------- */
		$this->start_controls_section( 'image_part', [
			'label'     => __( 'Image Part', 'heal-core' ),
			'tab'       => Controls_Manager::TAB_CONTENT,
			'condition' => [ 'style' => [ 'style2' ] ],
		] );

		$this->add_control( 'image', [
			'label'   => __( 'Main Image', 'heal-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ],
		] );
		$this->add_control( 'alt_text', [
			'label'       => __( 'Alt text', 'heal-core' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'placeholder' => __( 'Enter Your Text', 'heal-core' ),
		] );
		$this->add_control( 'image_shape1', [
			'label'   => __( 'Shape 1', 'heal-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ],
		] );
		$this->add_control( 'alt_shape1', [
			'label'       => __( 'Alt text', 'heal-core' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'placeholder' => __( 'Enter Your Text', 'heal-core' ),
		] );
		$this->add_control( 'image_shape2', [
			'label'   => __( 'Shape 2', 'heal-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ],
		] );
		$this->add_control( 'alt_shape2', [
			'label'       => __( 'Alt text', 'heal-core' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'placeholder' => __( 'Enter Your Text', 'heal-core' ),
		] );
		$this->add_control( 'image_shape3', [
			'label'   => __( 'Shape 3', 'heal-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ],
		] );
		$this->add_control( 'alt_shape3', [
			'label'       => __( 'Alt text', 'heal-core' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'placeholder' => __( 'Enter Your Text', 'heal-core' ),
		] );
		$this->end_controls_section();

		/* -------------------------
		 * CONTENT — Blocks (style1/3 repeater, style2 static)
		 * ------------------------- */
		$this->start_controls_section( 'content_section', [
			'label' => __( 'Block', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'repeat', [
			'type'       => Controls_Manager::REPEATER,
			'separator'  => 'before',
			'default'    => [ [ 'block_title' => esc_html__( 'Banner Repeater', 'heal-core' ) ] ],
			'condition'  => [ 'style' => [ 'style1', 'style3' ] ],
			'fields'     => [
				[
					'name'        => 'offset_class',
					'label'       => __( 'Column Offset Classes', 'heal-core' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => '',
					'label_block' => true,
					'description' => __( 'Example: offset-xl-6 offset-md-4', 'heal-core' ),
				],
				[
					'name'    => 'block_bg_image',
					'label'   => esc_html__( 'Background image', 'heal-core' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [ 'url' => Utils::get_placeholder_image_src() ],
				],
				[ 'name' => 'block_subtitle', 'label' => esc_html__( 'Subtitle', 'heal-core' ), 'type' => Controls_Manager::TEXTAREA ],
				[ 'name' => 'block_title',    'label' => esc_html__( 'Title', 'heal-core' ),    'type' => Controls_Manager::TEXTAREA ],
				[ 'name' => 'block_text',     'label' => esc_html__( 'Text', 'heal-core' ),     'type' => Controls_Manager::TEXTAREA ],
				[
					'name'    => 'block_button',
					'label'   => __( 'Button', 'heal-core' ),
					'type'    => Controls_Manager::TEXT,
					'dynamic' => [ 'active' => true ],
					'default' => esc_html__( 'Read More', 'heal-core' ),
				],
				[
					'name'         => 'block_button_link',
					'label'        => __( 'Button Url', 'heal-core' ),
					'type'         => Controls_Manager::URL,
					'placeholder'  => __( 'https://your-link.com', 'heal-core' ),
					'show_external'=> true,
					'default'      => [ 'url' => '', 'is_external' => true, 'nofollow' => true ],
				],
			],
			'title_field' => '{{block_title}}',
		] );

		$this->add_control( 'title', [
			'label'      => __( 'Heading', 'heal-core' ),
			'type'       => Controls_Manager::TEXTAREA,
			'default'    => 'Save World To Save The Nation',
			'label_block'=> true,
			'condition'  => [ 'style' => 'style2' ],
		] );

		$this->add_control( 'subtitle', [
			'label'      => __( 'Subtitle', 'heal-core' ),
			'type'       => Controls_Manager::TEXTAREA,
			'default'    => "Earth provides enough to satisfy every man's needs, but not everyone's greed.",
			'label_block'=> true,
			'condition'  => [ 'style' => 'style2' ],
		] );

		$this->add_control( 'button_text', [
			'label'     => __( 'Button Text', 'heal-core' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => 'Learn More',
			'condition' => [ 'style' => 'style2' ],
		] );

		$this->add_control( 'button_link', [
			'label'        => __( 'Button URL', 'heal-core' ),
			'type'         => Controls_Manager::URL,
			'placeholder'  => 'https://example.com',
			'show_external'=> true,
			'default'      => [ 'url' => '#', 'is_external' => false, 'nofollow' => false ],
			'condition'    => [ 'style' => 'style2' ],
		] );

		$this->end_controls_section();

		/* -------------------------
		 * STYLE — Subtitle
		 * ------------------------- */
		$this->start_controls_section( 'subtitle_settings', [
			'label' => __( 'Sub Title Setting', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'show_subtitle', [
			'label'   => esc_html__( 'Show Sub Title', 'heal-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'show' => [ 'title' => esc_html__( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
				'none' => [ 'title' => esc_html__( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
			],
			'default'   => 'show',
			'selectors' => [ '{{WRAPPER}} .banner__content .banner-subtitle' => 'display: {{VALUE}} !important' ],
		] );

		$this->add_control( 'subtitle_alignment', [
			'label'     => esc_html__( 'Alignment', 'heal-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [ 'title' => esc_html__( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
			],
			'default'   => '',
			'condition' => [ 'show_subtitle' => 'show' ],
			'toggle'    => true,
			'selectors' => [ '{{WRAPPER}} .banner__content .banner-subtitle' => 'text-align: {{VALUE}} !important' ],
		] );

		$this->add_control( 'subtitle_padding', [
			'label'      => __( 'Padding', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'condition'  => [ 'show_subtitle' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

		$this->add_control( 'subtitle_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'condition'  => [ 'show_subtitle' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'subtitle_typography',
			'label'     => __( 'Typography', 'heal-core' ),
			'selector'  => '{{WRAPPER}} .banner__content .banner-subtitle',
			'condition' => [ 'show_subtitle' => 'show' ],
		] );

		$this->add_control( 'subtitle_color', [
			'label'      => __( 'Color', 'heal-core' ),
			'type'       => Controls_Manager::COLOR,
			'condition'  => [ 'show_subtitle' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-subtitle' => 'color: {{VALUE}} !important' ],
		] );

		$this->add_control( 'subtitle_bg_color', [
			'label'      => __( 'Background Color', 'heal-core' ),
			'type'       => Controls_Manager::COLOR,
			'condition'  => [ 'show_subtitle' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-subtitle' => 'background-color: {{VALUE}} !important' ],
		] );

		$this->end_controls_section();

		/* -------------------------
		 * STYLE — Title
		 * ------------------------- */
		$this->start_controls_section( 'title_settings', [
			'label' => __( 'Title Settings', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'show_title', [
			'label'   => esc_html__( 'Show Title', 'heal-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'show' => [ 'title' => esc_html__( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
				'none' => [ 'title' => esc_html__( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
			],
			'default'   => 'show',
			'selectors' => [ '{{WRAPPER}} .banner__content .banner-title' => 'display: {{VALUE}} !important' ],
		] );

		$this->add_control( 'title_alignment', [
			'label'     => esc_html__( 'Alignment', 'heal-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [ 'title' => esc_html__( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
			],
			'default'   => '',
			'condition' => [ 'show_title' => 'show' ],
			'toggle'    => true,
			'selectors' => [ '{{WRAPPER}} .banner__content .banner-title' => 'text-align: {{VALUE}}' ],
		] );

		$this->add_control( 'title_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'condition'  => [ 'show_title' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

		$this->add_control( 'title_padding', [
			'label'      => __( 'Padding', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'condition'  => [ 'show_title' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'title_typography',
			'label'     => __( 'Typography', 'heal-core' ),
			'condition' => [ 'show_title' => 'show' ],
			'selector'  => '{{WRAPPER}} .banner__content .banner-title',
		] );

		$this->add_control( 'title_color', [
			'label'      => __( 'Color', 'heal-core' ),
			'type'       => Controls_Manager::COLOR,
			'condition'  => [ 'show_title' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-title' => 'color: {{VALUE}} !important' ],
		] );

		$this->add_control( 'title_hover_color', [
			'label'      => __( 'Hover Color', 'heal-core' ),
			'type'       => Controls_Manager::COLOR,
			'condition'  => [ 'show_title' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-title:hover' => 'color: {{VALUE}} !important' ],
		] );

		$this->end_controls_section();

		/* -------------------------
		 * STYLE — Text
		 * ------------------------- */
		$this->start_controls_section( 'text_settings', [
			'label' => __( 'Text Settings', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'show_text', [
			'label'   => esc_html__( 'Show Text', 'heal-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'show' => [ 'title' => esc_html__( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
				'none' => [ 'title' => esc_html__( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
			],
			'default'   => 'show',
			'selectors' => [ '{{WRAPPER}} .banner__content .banner-text' => 'display: {{VALUE}} !important' ],
		] );

		$this->add_control( 'text_alignment', [
			'label'     => esc_html__( 'Alignment', 'heal-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [ 'title' => esc_html__( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
			],
			'default'   => '',
			'condition' => [ 'show_text' => 'show' ],
			'toggle'    => true,
			'selectors' => [ '{{WRAPPER}} .banner__content .banner-text' => 'text-align: {{VALUE}} !important' ],
		] );

		$this->add_control( 'text_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'condition'  => [ 'show_text' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

		$this->add_control( 'text_padding', [
			'label'      => __( 'Padding', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'condition'  => [ 'show_text' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'text_typography',
			'label'     => __( 'Typography', 'heal-core' ),
			'condition' => [ 'show_text' => 'show' ],
			'selector'  => '{{WRAPPER}} .banner__content .banner-text',
		] );

		$this->add_control( 'text_color', [
			'label'      => __( 'Color', 'heal-core' ),
			'type'       => Controls_Manager::COLOR,
			'condition'  => [ 'show_text' => 'show' ],
			'separator'  => 'after',
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-text' => 'color: {{VALUE}} !important' ],
		] );

		$this->add_control( 'text_hover_color', [
			'label'      => __( 'Hover Color', 'heal-core' ),
			'type'       => Controls_Manager::COLOR,
			'condition'  => [ 'show_text' => 'show' ],
			'separator'  => 'after',
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-text:hover' => 'color: {{VALUE}} !important' ],
		] );

		$this->end_controls_section();

		/* -------------------------
		 * STYLE — Button
		 * ------------------------- */
		$this->start_controls_section( 'button_control', [
			'label' => __( 'Button Settings', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'show_button', [
			'label'   => esc_html__( 'Show Button', 'heal-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'show' => [ 'title' => esc_html__( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
				'none' => [ 'title' => esc_html__( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
			],
			'default'   => 'show',
			'selectors' => [ '{{WRAPPER}} .banner__content .theme-btn' => 'display: {{VALUE}} !important' ],
		] );

		$this->add_control( 'button_alignment', [
			'label'     => esc_html__( 'Alignment', 'heal-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'condition' => [ 'show_button' => 'show' ],
			'options'   => [
				'left'   => [ 'title' => esc_html__( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
			],
			'default'   => '',
			'toggle'    => true,
			'selectors' => [ '{{WRAPPER}} .banner__content .theme-btn' => 'text-align: {{VALUE}} !important' ],
		] );

		$this->add_control( 'button_color', [
			'label'     => __( 'Button Color', 'heal-core' ),
			'type'      => Controls_Manager::COLOR,
			'condition' => [ 'show_button' => 'show' ],
			'selectors' => [ '{{WRAPPER}} .banner__content .theme-btn' => 'color: {{VALUE}} !important' ],
		] );

		$this->add_control( 'button_bg_color', [
			'label'     => __( 'Button Background Color', 'heal-core' ),
			'type'      => Controls_Manager::COLOR,
			'condition' => [ 'show_button' => 'show' ],
			'selectors' => [ '{{WRAPPER}} .banner__content .theme-btn' => 'background: {{VALUE}} !important' ],
		] );

		$this->add_control( 'button_hover_color', [
			'label'     => __( 'Button Hover Color', 'heal-core' ),
			'type'      => Controls_Manager::COLOR,
			'condition' => [ 'show_button' => 'show' ],
			'selectors' => [ '{{WRAPPER}} .banner__content .theme-btn:hover' => 'color: {{VALUE}} !important' ],
		] );

		$this->add_control( 'button_bg_hover_color', [
			'label'     => __( 'Button Background Hover Color', 'heal-core' ),
			'type'      => Controls_Manager::COLOR,
			'condition' => [ 'show_button' => 'show' ],
			'selectors' => [
				'{{WRAPPER}} .banner__content .theme-btn::before' => 'background: {{VALUE}} !important',
				'{{WRAPPER}} .banner__content .theme-btn::after'  => 'background: {{VALUE}} !important',
			],
		] );

		$this->add_control( 'button_padding', [
			'label'      => __( 'Padding', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'condition'  => [ 'show_button' => 'show' ],
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important' ],
		] );

		$this->add_control( 'button_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'condition'  => [ 'show_button' => 'show' ],
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .theme-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'button_typography',
			'condition' => [ 'show_button' => 'show' ],
			'label'     => __( 'Typography', 'heal-core' ),
			'selector'  => '{{WRAPPER}} .banner__content .theme-btn',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'border',
			'condition' => [ 'show_button' => 'show' ],
			'selector'  => '{{WRAPPER}} .banner__content .theme-btn',
		] );

		$this->add_control( 'border_radius', [
			'label'      => __( 'Border Radius', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'condition'  => [ 'show_button' => 'show' ],
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .theme-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important' ],
		] );

		$this->end_controls_section();

		/* -------------------------
		 * STYLE — Slide Overlay
		 * ------------------------- */
		$this->start_controls_section( 'overlay_styles', [
			'label'     => __( 'Slide Overlay', 'heal-core' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'style' => [ 'style1', 'style3' ] ],
		] );

		// $this->add_control( 'overlay_enable', [
		// 	'label'   => __( 'Enable Overlay', 'heal-core' ),
		// 	'type'    => Controls_Manager::SWITCHER,
		// 	'default' => '',
		// 	'selectors' => [
		// 		'{{WRAPPER}} .banner__overlay' => 'display: block !important',
		// 	],
		// ] );

		$this->add_control( 'overlay_enable', [
		    'label'        => __( 'Enable Overlay', 'heal-core' ),
		    'type'         => Controls_Manager::SWITCHER,
		    'label_on'     => __( 'On', 'heal-core' ),
		    'label_off'    => __( 'Off', 'heal-core' ),
		    'return_value' => 'yes', // স্পষ্ট করে দেওয়া ভালো
		    'default'      => '',
		    'selectors'    => [
		        '{{WRAPPER}} .banner__overlay' => 'display: block !important;',
		    ],
		] );

		$this->add_control( 'overlay_color', [
			'label'     => __( 'Overlay Color', 'heal-core' ),
			'type'      => Controls_Manager::COLOR,
			'condition' => [ 'overlay_enable' => 'yes' ],
			'selectors' => [
				'{{WRAPPER}} .banner__overlay' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_control( 'overlay_opacity', [
			'label'     => __( 'Overlay Opacity', 'heal-core' ),
			'type'      => Controls_Manager::SLIDER,
			'size_units'=> [ ],
			'range'     => [ 'px' => [ 'min' => 0, 'max' => 1, 'step' => 0.01 ] ],
			'default'   => [ 'size' => 0.4 ],
			'condition' => [ 'overlay_enable' => 'yes' ],
			'selectors' => [
				'{{WRAPPER}} .banner__overlay' => 'opacity: {{SIZE}}',
			],
		] );

		$this->end_controls_section();

		/* -------------------------
		 * STYLE — Pagination
		 * ------------------------- */
		$this->start_controls_section( 'pagination_styles', [
			'label'     => __( 'Pagination', 'heal-core' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [ 'style' => [ 'style1', 'style3' ], 'show_pagination' => 'yes' ],
		] );

		$this->add_control( 'pagination_color', [
			'label'     => __( 'Bullet Color', 'heal-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_control( 'pagination_active_color', [
			'label'     => __( 'Active Bullet Color', 'heal-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_control( 'pagination_size', [
			'label'     => __( 'Bullet Size', 'heal-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [ 'px' => [ 'min' => 4, 'max' => 24 ] ],
			'default'   => [ 'size' => 10 ],
			'selectors' => [
				'{{WRAPPER}} .banner__pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; border-radius: 999px;',
			],
		] );

		$this->add_control( 'pagination_margin', [
			'label'      => __( 'Pagination Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .banner__pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		] );

		$this->end_controls_section();

		/* -------------------------
		 * STYLE — Section spacing
		 * ------------------------- */
		$this->start_controls_section( 'section_box', [
			'label' => __( 'Section Box', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'section_padding', [
			'label'      => __( 'Padding', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .banner__section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		] );

		$this->add_control( 'section_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .banner__section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		] );

		$this->end_controls_section();

		/* -------------------------
		 * STYLE — Instance CSS
		 * ------------------------- */
		$this->start_controls_section( 'section_custom_css', [
			'label' => __( 'Custom CSS (Instance)', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$control_type = defined( '\Elementor\Controls_Manager::CODE' ) ? Controls_Manager::CODE : Controls_Manager::TEXTAREA;
		$this->add_control( 'custom_css', [
			'label'       => __( 'Write CSS', 'heal-core' ),
			'type'        => $control_type,
			'rows'        => 20,
			'label_block' => true,
			'language'    => 'css',
			'description' => __( 'Use <code>{{WRAP}}</code> as root selector. Example: <code>{{WRAP}} .banner__content{max-width:720px}</code>', 'heal-core' ),
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$allowed    = wp_kses_allowed_html( 'post' );
		$widget_id  = $this->get_id();
		$root_id    = 'banner-' . $widget_id;
		$root_sel   = '#'. $root_id;

		// Base CSS for overlay & positioning (scoped)
		echo '<style id="banner-base-'.esc_attr($widget_id).'">'
			. $root_sel . ' .swiper-slide.banner__padding,'
			. $root_sel . ' .swiper-slide.bg-img{position:relative;}'
			. $root_sel . ' .banner__overlay{position:absolute;inset:0;pointer-events:none;display:none;}'
			. '</style>';

		// Instance CSS
		if ( ! empty( $settings['custom_css'] ) ) {
			$css = str_replace( '{{WRAP}}', $root_sel, $settings['custom_css'] );
			echo '<style id="banner-css-'.esc_attr($widget_id).'">'.$css.'</style>';
		}

		// Slider init (scoped)
		$has_slider = in_array( $settings['style'] ?? '', [ 'style1', 'style3' ], true );
		if ( $has_slider ) {
			$loop    = ( 'yes' === ( $settings['enable_loop'] ?? 'yes' ) ) ? 'true' : 'false';
			$auto    = ( 'yes' === ( $settings['enable_autoplay'] ?? 'yes' ) ) ? 'true' : 'false';
			$delay   = (int) ( $settings['autoplay_delay'] ?? 10000 );
			$speed   = (int) ( $settings['transition_speed'] ?? 600 );
			$use_pag = ( 'yes' === ( $settings['show_pagination'] ?? 'yes' ) );

			$auto_conf = $auto ? "{delay:$delay,disableOnInteraction:false}" : "false";
			$pag_conf  = $use_pag ? "pagination:{el: \$root.find('.banner__pagination')[0], clickable:true}," : "";

			echo '<script>
				jQuery(function($){
				var $root = $("#'.esc_js($root_id).'");
				if(!$root.length) return;
				var $slider = $root.find(".banner__slider");
				if ($slider.length && typeof Swiper !== "undefined") {
					new Swiper($slider[0], {
					loop: '. $loop .',
					speed: '. $speed .',
					autoplay: '. $auto_conf .',
					'. $pag_conf .'
					});
				}
				if('. ( $use_pag ? 'false' : 'true' ) .'){ $root.find(".banner__pagination").hide(); }
				});
			</script>';
		}

		// ---------- MARKUP ----------
		?>
		<div id="<?php echo esc_attr( $root_id ); ?>" class="banner-widget">
		<?php

		// STYLE 1
		if ( 'style1' === ( $settings['style'] ?? '' ) ) :
			$items = ( ! empty( $settings['repeat'] ) && is_array( $settings['repeat'] ) ) ? $settings['repeat'] : [];
			?>
			<div class="banner__section">
				<div class="banner">
					<div class="banner__slider overflow-hidden position-relative">
						<div class="swiper-wrapper">
							<?php foreach( $items as $item ):
								$bg_url = ! empty( $item['block_bg_image']['url'] ) ? $item['block_bg_image']['url']
									: ( ! empty( $item['block_bg_image']['id'] ) ? wp_get_attachment_url( $item['block_bg_image']['id'] ) : '' );
								$offset = isset( $item['offset_class'] ) ? preg_replace( '/[^a-z0-9\-\s_]/i', '', $item['offset_class'] ) : '';
								?>
								<div class="swiper-slide banner__padding bg-img" style="background-image:url('<?php echo esc_url( $bg_url ); ?>');">
									<span class="banner__overlay" aria-hidden="true"></span>
									<div class="container">
										<div class="row g-0">
											<div class="col-xl-6 col-md-8 col-12 <?php echo esc_attr( $offset ); ?>">
												<div class="banner__item">
													<div class="banner__inner">
														<div class="banner__content">
															<?php if ( ! empty( $item['block_subtitle'] ) ) : ?>
																<h2 class="banner-subtitle"><?php echo wp_kses( $item['block_subtitle'], $allowed ); ?></h2>
															<?php endif; ?>
															<?php if ( ! empty( $item['block_title'] ) ) : ?>
																<h3 class="banner-title"><?php echo wp_kses( $item['block_title'], $allowed ); ?></h3>
															<?php endif; ?>
															<?php if ( ! empty( $item['block_text'] ) ) : ?>
																<p class="banner-text"><?php echo wp_kses( $item['block_text'], $allowed ); ?></p>
															<?php endif; ?>
															<?php if ( ! empty( $item['block_button'] ) && ! empty( $item['block_button_link']['url'] ) ) : ?>
																<a href="<?php echo esc_url( $item['block_button_link']['url'] ); ?>"
																   class="default-btn move-right theme-btn"
																   <?php echo ! empty( $item['block_button_link']['is_external'] ) ? 'target="_blank" rel="noopener"' : ''; ?>>
																	<span><?php echo wp_kses( $item['block_button'], $allowed ); ?></span>
																</a>
															<?php endif; ?>
														</div><!-- .banner__content -->
													</div>
												</div>
											</div><!-- col -->
										</div><!-- row -->
									</div><!-- container -->
								</div><!-- slide -->
							<?php endforeach; ?>
						</div>
						<div class="banner__pagination"></div>
					</div>
				</div>
			</div>

		<?php
		// STYLE 2
		elseif ( 'style2' === ( $settings['style'] ?? '' ) ) :
			$main_img = ! empty( $settings['image']['url'] ) ? $settings['image']['url']
				: ( ! empty( $settings['image']['id'] ) ? wp_get_attachment_url( $settings['image']['id'] ) : '' );

			$shape1   = ! empty( $settings['image_shape1']['url'] ) ? $settings['image_shape1']['url']
				: ( ! empty( $settings['image_shape1']['id'] ) ? wp_get_attachment_url( $settings['image_shape1']['id'] ) : '' );

			$shape2   = ! empty( $settings['image_shape2']['url'] ) ? $settings['image_shape2']['url']
				: ( ! empty( $settings['image_shape2']['id'] ) ? wp_get_attachment_url( $settings['image_shape2']['id'] ) : '' );

			$shape3   = ! empty( $settings['image_shape3']['url'] ) ? $settings['image_shape3']['url']
				: ( ! empty( $settings['image_shape3']['id'] ) ? wp_get_attachment_url( $settings['image_shape3']['id'] ) : '' );
			?>
			<div class="banner__section home-2">
				<div class="container">
					<div class="banner">
						<div class="banner__content">
							<?php if ( ! empty( $settings['title'] ) ) : ?>
								<h2 class="banner-title"><?php echo wp_kses( $settings['title'], $allowed ); ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $settings['subtitle'] ) ) : ?>
								<h5 class="banner-subtitle"><?php echo wp_kses( $settings['subtitle'], $allowed ); ?></h5>
							<?php endif; ?>
							<?php if ( ! empty( $settings['button_text'] ) && ! empty( $settings['button_link']['url'] ) ) : ?>
								<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>"
								   class="default-btn move-right theme-btn"
								   <?php echo ! empty( $settings['button_link']['is_external'] ) ? 'target="_blank" rel="noopener"' : ''; ?>>
									<span><?php echo wp_kses( $settings['button_text'], $allowed ); ?></span>
								</a>
							<?php endif; ?>
						</div><!-- .banner__content -->
					</div>
				</div>

				<?php if ( ! empty( $main_img ) ) : ?>
					<div class="banner__thumb text-center">
						<img src="<?php echo esc_url( $main_img ); ?>" alt="<?php echo esc_attr( $settings['alt_text'] ?? '' ); ?>"/>
						<ul>
							<?php if ( ! empty( $shape1 ) ) : ?>
								<li><img src="<?php echo esc_url( $shape1 ); ?>" alt="<?php echo esc_attr( $settings['alt_shape1'] ?? '' ); ?>"/></li>
							<?php endif; ?>
							<?php if ( ! empty( $shape2 ) ) : ?>
								<li><img src="<?php echo esc_url( $shape2 ); ?>" alt="<?php echo esc_attr( $settings['alt_shape2'] ?? '' ); ?>"/></li>
							<?php endif; ?>
							<?php if ( ! empty( $shape3 ) ) : ?>
								<li><img src="<?php echo esc_url( $shape3 ); ?>" alt="<?php echo esc_attr( $settings['alt_shape3'] ?? '' ); ?>"/></li>
							<?php endif; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>

		<?php
		// STYLE 3
		elseif ( 'style3' === ( $settings['style'] ?? '' ) ) :
			$items = ( ! empty( $settings['repeat'] ) && is_array( $settings['repeat'] ) ) ? $settings['repeat'] : [];
			?>
			<div class="banner__section">
				<div class="banner banner-style2">
					<div class="banner__slider overflow-hidden position-relative">
						<div class="swiper-wrapper">
							<?php foreach( $items as $item ):
								$bg_url = ! empty( $item['block_bg_image']['url'] ) ? $item['block_bg_image']['url']
									: ( ! empty( $item['block_bg_image']['id'] ) ? wp_get_attachment_url( $item['block_bg_image']['id'] ) : '' );
								?>
								<div class="swiper-slide banner__padding bg-img" style="background-image:url('<?php echo esc_url( $bg_url ); ?>');">
									<span class="banner__overlay" aria-hidden="true"></span>
									<div class="container">
										<div class="row g-0">
											<div class="col-xl-6 col-md-8 col-12">
												<div class="banner__item">
													<div class="banner__inner">
														<div class="banner__content">
															<?php if ( ! empty( $item['block_subtitle'] ) ) : ?>
																<h4 class="banner-subtitle"><?php echo wp_kses( $item['block_subtitle'], $allowed ); ?></h4>
															<?php endif; ?>
															<?php if ( ! empty( $item['block_title'] ) ) : ?>
																<h2 class="banner-title"><?php echo wp_kses( $item['block_title'], $allowed ); ?></h2>
															<?php endif; ?>
															<?php if ( ! empty( $item['block_text'] ) ) : ?>
																<p class="banner-text"><?php echo wp_kses( $item['block_text'], $allowed ); ?></p>
															<?php endif; ?>
															<?php if ( ! empty( $item['block_button'] ) && ! empty( $item['block_button_link']['url'] ) ) : ?>
																<a href="<?php echo esc_url( $item['block_button_link']['url'] ); ?>"
																   class="default-btn move-right theme-btn"
																   <?php echo ! empty( $item['block_button_link']['is_external'] ) ? 'target="_blank" rel="noopener"' : ''; ?>>
																	<span><?php echo wp_kses( $item['block_button'], $allowed ); ?></span>
																</a>
															<?php endif; ?>
														</div><!-- .banner__content -->
													</div>
												</div>
											</div><!-- col -->
										</div><!-- row -->
									</div><!-- container -->
								</div><!-- slide -->
							<?php endforeach; ?>
						</div>
						<div class="banner__pagination"></div>
					</div>
				</div>
			</div>

		<?php endif; ?>

		</div><!-- #<?php echo esc_html( $root_id ); ?> -->
		<?php
	}
}

/* Register custom category (if needed) */
\add_action( 'elementor/elements/categories_registered', function( $elements_manager ){
	$elements_manager->add_category( 'heal_widgets', [
		'title' => __( 'Heal Widgets', 'heal-core' ),
		'icon'  => 'fa fa-plug',
	], 1 );
} );

/* Register widget (new API) */
\add_action( 'elementor/widgets/register', function( $widgets_manager ) {
	$widgets_manager->register( new \Elementor\Theme_Banner() );
} );
