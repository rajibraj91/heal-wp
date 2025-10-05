<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package heal
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Theme_About extends Widget_Base {

	public function get_name() {
		return 'about-widget';
	}

	public function get_title() {
		return esc_html__( 'About', 'heal-core' );
	}

	public function get_icon() {
		return 'theme-icon';
	}

	public function get_categories() {
		return [ 'heal_charity' ];
	}

	protected function register_controls() {

		/**
		 * =============== CONTENT TAB ===============
		 */

		// Tab Start - 1
		$this->start_controls_section(
			'theme_about',
			[
				'label' => esc_html__( 'About Style', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Style', 'heal-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__( 'Style 1', 'heal-core' ),
					'style2' => esc_html__( 'Style 2', 'heal-core' ),
					'style3' => esc_html__( 'Style 3', 'heal-core' ),
					'style4' => esc_html__( 'Style 4', 'heal-core' ),
					'style5' => esc_html__( 'Style 5', 'heal-core' ),
				],
			]
		);

		$this->end_controls_section();
		// End of Tab Start - 1

		// Section Header start
		$this->start_controls_section(
			'section_heading',
			[
				'label' => __( 'Section Header', 'heal-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => [ 'style3', 'style5' ],
				],
			]
		);

		$this->add_control(
			'section_title',
			[
				'label' => esc_html__( 'Section Title', 'heal-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'placeholder' => esc_html__( 'Enter title text', 'heal-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'section_description',
			[
				'label' => esc_html__( 'Description', 'heal-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'placeholder' => esc_html__( 'Enter description', 'heal-core' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
		// End of Section Header

		// Tab Start - 2
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Block', 'heal-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// For style1 — Repeater
		$this->add_control(
			'repeat',
			[
				'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
				'default' => [
					[
						'block_title' => esc_html__( 'Repeater', 'heal-core' ),
					],
				],
				'condition' => [
					'style' => 'style1',
				],
				'fields' => [
					[
						'name' => 'block_icon',
						'label' => esc_html__( 'Icon', 'heal-core' ),
						'type' => Controls_Manager::ICONS,
						'default' => [
							'value' => 'fas fa-rocket',
							'library' => 'fa-solid',
						],
					],
					[
						'name' => 'block_title',
						'label' => esc_html__( 'Title', 'heal-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '',
					],
					[
						'name' => 'block_text',
						'label' => esc_html__( 'Text', 'heal-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '',
					],
				],
				'title_field' => '{{block_title}}',
			]
		);

		// For style2 — Repeater
		$this->add_control(
			'repeat2',
			[
				'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
				'default' => [
					[
						'tab_title' => esc_html__( 'Tab Title', 'heal-core' ),
					],
				],
				'condition' => [
					'style' => 'style2',
				],
				'fields' => [
					[
						'name' => 'tab_icon',
						'label' => esc_html__( 'Tab Icon', 'heal-core' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[
						'name' => 'tab_title',
						'label' => esc_html__( 'Tab Title', 'heal-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'label_block' => true,
						'placeholder' => esc_html__( 'Enter tab title', 'heal-core' ),
					],
					[
						'name' => 'tab_image',
						'label' => esc_html__( 'Tab Image', 'heal-core' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[
						'name' => 'heading',
						'label' => esc_html__( 'Heading', 'heal-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '',
						'label_block' => true,
						'placeholder' => esc_html__( 'Enter heading', 'heal-core' ),
					],
					[
						'name' => 'sub_heading',
						'label' => esc_html__( 'Sub Heading', 'heal-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '',
						'label_block' => true,
						'placeholder' => esc_html__( 'Enter sub heading', 'heal-core' ),
					],
					[
						'name' => 'description',
						'label' => esc_html__( 'Description', 'heal-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '',
						'label_block' => true,
						'placeholder' => esc_html__( 'Enter description', 'heal-core' ),
					],
					[
						'name' => 'button_text',
						'label' => esc_html__( 'Button Text', 'heal-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'label_block' => true,
						'placeholder' => esc_html__( 'Enter button text', 'heal-core' ),
					],
					[
						'name'  => 'button_url',
						'label' => esc_html__( 'Button URL', 'heal-core'),
						'type'  => Controls_Manager::URL,
						'placeholder' => esc_html__( 'https://your-link.com', 'heal-core' ),
						'default'=> [ 'url'=>'#' ],
					],
				],
				'title_field' => '{{tab_title}}',
			]
		);
		// End of style2

		// For style3/4/5 common fields
		$this->add_control(
			'style3_icon',
			[
				'label' => esc_html__( 'Icon', 'heal-core' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user',
					'library' => 'fa-solid',
				],
				'condition' => [
					'style' => [ 'style3', 'style4' ],
				],
			]
		);

		$this->add_control(
			'style3_heading',
			[
				'label' => esc_html__( 'Heading', 'heal-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Enter heading', 'heal-core' ),
				'condition' => [
					'style' => [ 'style3', 'style4', 'style5' ],
				],
			]
		);

		$this->add_control(
			'style3_subheading',
			[
				'label' => esc_html__( 'Sub Heading', 'heal-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Enter sub heading', 'heal-core' ),
				'condition' => [
					'style' => [ 'style3', 'style4' ],
				],
			]
		);

		$this->add_control(
			'style5_img',
			[
				'label' => esc_html__( 'Image', 'heal-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [ 'url' => Utils::get_placeholder_image_src() ],
				'separator' => 'before',
				'condition' => [
					'style' => 'style5',
				],
			]
		);

		$this->add_control(
			'style3_description',
			[
				'label' => esc_html__( 'Description', 'heal-core' ),
				'type' => Controls_Manager::WYSIWYG,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Enter Description', 'heal-core' ),
				'condition' => [
					'style' => [ 'style3', 'style4', 'style5' ],
				],
			]
		);

		$this->add_control(
			'style5_button_text',
			[
				'label' => esc_html__( 'Button Text', 'heal-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter button text', 'heal-core' ),
				'condition' => [
					'style' => 'style5',
				],
			]
		);

		$this->add_control(
			'style5_button_url',
			[
				'label' => esc_html__( 'Button URL', 'heal-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'heal-core' ),
				'default' => [ 'url' => '#' ],
				'label_block' => true,
				'condition' => [
					'style' => 'style5',
				],
			]
		);

		// style3 slider images
		$this->add_control(
			'repeat3',
			[
				'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
				'default' => [
					[ 'tab_title' => esc_html__( 'About Slider Image', 'heal-core' ) ],
				],
				'condition' => [
					'style' => 'style3',
				],
				'fields' => [
					[
						'name' => 'slider_image',
						'label' => esc_html__( 'Slider Image', 'heal-core' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
				],
			]
		);

		$this->end_controls_section();

		// About Video Section Start
		$this->start_controls_section(
			'section_thumb',
			[
				'label' => __( 'Thumbnail Field', 'heal-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => 'style4',
				],
			]
		);

		$this->add_control(
			'about_thumbnail',
			[
				'label' => esc_html__( 'Thumbnail Image', 'heal-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [ 'url' => Utils::get_placeholder_image_src() ],
			]
		);

		$this->add_control(
			'video_switch',
			[
				'label' => esc_html__( 'Video Switch', 'heal-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'heal-core' ),
				'label_off' => esc_html__( 'Off', 'heal-core' ),
				'default' => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'about_video',
			[
				'label' => esc_html__( 'Video URL', 'heal-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter video URL', 'heal-core' ),
				'condition' => [ 'video_switch' => 'yes' ],
			]
		);

		$this->add_control(
			'about_video_icon',
			[
				'label' => esc_html__( 'Video Icon', 'heal-core' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [ 'video_switch' => 'yes' ],
				'default' => [
					'value' => 'fas fa-play',
					'library' => 'fa-solid',
				],
			]
		);

		$this->end_controls_section();
		// About Video Section End

		// About Testimonial Section Start
		$this->start_controls_section(
			'about_testimonial',
			[
				'label' => __( 'Testimonial', 'heal-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => 'style5',
				],
			]
		);

		$this->add_control(
			'about_thumbnail_switch',
			[
				'label' => esc_html__( 'Navigation Switch', 'heal-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'heal-core' ),
				'label_off' => esc_html__( 'Off', 'heal-core' ),
				'default' => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'repeat5',
			[
				'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
				'default' => [
					[ 'at_title' => esc_html__( 'About Testimonial', 'heal-core' ) ],
				],
				'fields' => [
					[
						'name' => 'at_img',
						'label' => esc_html__( 'Image', 'heal-core' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[
						'name' => 'at_name',
						'label' => esc_html__( 'Name', 'heal-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'label_block' => true,
						'placeholder' => esc_html__( 'Enter Name', 'heal-core' ),
					],
					[
						'name' => 'at_designation',
						'label' => esc_html__( 'Designation', 'heal-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'label_block' => true,
						'placeholder' => esc_html__( 'Enter designation', 'heal-core' ),
					],
					[
						'name' => 'at_facebook',
						'label' => esc_html__( 'Facebook URL', 'heal-core' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'placeholder' => esc_html__( 'https://facebook.com/username', 'heal-core' ),
						'default' => [ 'url' => '', 'is_external' => true ],
					],
					[
						'name' => 'at_instagram',
						'label' => esc_html__( 'Instagram URL', 'heal-core' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'placeholder' => esc_html__( 'https://instagram.com/username', 'heal-core' ),
						'default' => [ 'url' => '', 'is_external' => true ],
					],
					[
						'name' => 'at_twitter',
						'label' => esc_html__( 'Twitter (X) URL', 'heal-core' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'placeholder' => esc_html__( 'https://twitter.com/username', 'heal-core' ),
						'default' => [ 'url' => '', 'is_external' => true ],
					],
					[
						'name' => 'at_linkedin',
						'label' => esc_html__( 'LinkedIn URL', 'heal-core' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'placeholder' => esc_html__( 'https://linkedin.com/in/username', 'heal-core' ),
						'default' => [ 'url' => '', 'is_external' => true ],
					],
					[
						'name' => 'at_youtube',
						'label' => esc_html__( 'YouTube URL', 'heal-core' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'placeholder' => esc_html__( 'https://youtube.com/@channelname', 'heal-core' ),
						'default' => [ 'url' => '', 'is_external' => true ],
					],
					[
						'name' => 'at_tiktok',
						'label' => esc_html__( 'TikTok URL', 'heal-core' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'placeholder' => esc_html__( 'https://tiktok.com/@username', 'heal-core' ),
						'default' => [ 'url' => '', 'is_external' => true ],
					],
					[
						'name' => 'at_behance',
						'label' => esc_html__( 'Behance URL', 'heal-core' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'placeholder' => esc_html__( 'https://behance.net/username', 'heal-core' ),
						'default' => [ 'url' => '', 'is_external' => true ],
					],
					[
						'name' => 'at_dribbble',
						'label' => esc_html__( 'Dribbble URL', 'heal-core' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'placeholder' => esc_html__( 'https://dribbble.com/username', 'heal-core' ),
						'default' => [ 'url' => '', 'is_external' => true ],
					],
					[
						'name' => 'at_pinterest',
						'label' => esc_html__( 'Pinterest URL', 'heal-core' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'placeholder' => esc_html__( 'https://pinterest.com/username', 'heal-core' ),
						'default' => [ 'url' => '', 'is_external' => true ],
					],
					[
						'name' => 'at_title',
						'label' => esc_html__( 'Title', 'heal-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '',
						'label_block' => true,
						'placeholder' => esc_html__( 'Enter Title', 'heal-core' ),
					],
					[
						'name' => 'at_subtitle',
						'label' => esc_html__( 'Sub Title', 'heal-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '',
						'label_block' => true,
						'placeholder' => esc_html__( 'Enter sub title', 'heal-core' ),
					],
					[
						'name' => 'at_description',
						'label' => esc_html__( 'Description', 'heal-core' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => '',
						'label_block' => true,
						'placeholder' => esc_html__( 'Enter description', 'heal-core' ),
					],
				],
				'title_field' => '{{at_title}}',
			]
		);

		$this->end_controls_section();
		// About Testimonial Section End


		/**
		 * =============== STYLE TAB ===============
		 * Note: Markup/Classes unchanged. Only CSS selectors mapped.
		 */

		// Section Wrapper (common)
		$this->start_controls_section(
			'sec_style_wrapper',
			[
				'label' => esc_html__( 'Section Wrapper', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_padding',
			[
				'label' => esc_html__( 'Padding', 'heal-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .about-section'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .poster-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'section_bg',
				'label' => esc_html__( 'Background', 'heal-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .about-section, {{WRAPPER}} .poster-section',
			]
		);

		$this->end_controls_section();

		// Section Header style (style3, style5)
		$this->start_controls_section(
			'sec_style_header',
			[
				'label' => esc_html__( 'Section Header', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [ 'style' => [ 'style3', 'style5' ] ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sec_title_typo',
				'label' => esc_html__( 'Title Typography', 'heal-core' ),
				'selector' => '{{WRAPPER}} .section-header h2',
			]
		);

		$this->add_control(
			'sec_title_color',
			[
				'label' => esc_html__( 'Title Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-header h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sec_desc_typo',
				'label' => esc_html__( 'Description Typography', 'heal-core' ),
				'selector' => '{{WRAPPER}} .section-header p',
			]
		);

		$this->add_control(
			'sec_desc_color',
			[
				'label' => esc_html__( 'Description Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-header p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Card / Item (style1 grid & slider items)
		$this->start_controls_section(
			'sec_style_item',
			[
				'label' => esc_html__( 'Card / Item', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [ 'style' => [ 'style1' ] ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'item_bg',
				'label' => esc_html__( 'Background', 'heal-core' ),
				'selector' => '{{WRAPPER}} .about__item .about__inner',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .about__item .about__inner',
			]
		);

		$this->add_responsive_control(
			'item_radius',
			[
				'label' => esc_html__( 'Border Radius', 'heal-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .about__item .about__inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_shadow',
				'selector' => '{{WRAPPER}} .about__item .about__inner',
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__( 'Padding', 'heal-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .about__item .about__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Icon
		$this->add_control(
			'icon_heading',
			[
				'label' => esc_html__( 'Icon', 'heal-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'heal-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [ 'min' => 10, 'max' => 200 ],
				],
				'selectors' => [
					'{{WRAPPER}} .about__iconbg i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .about__iconbg svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__iconbg i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .about__iconbg svg' => 'fill: {{VALUE}}; color: {{VALUE}};',
					'{{WRAPPER}} .about__iconbg' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .about__iconbg::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .about__iconbg::before' => 'border-color: {{VALUE}};',

				],
			]
		);

		

		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( 'Icon BG Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__iconbg' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__inner:hover .about__iconbg i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .about__inner:hover .about__iconbg svg' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_bg',
			[
				'label' => esc_html__( 'Icon Hover BG Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__inner:hover .about__iconbg' => 'background: {{VALUE}};',
					'{{WRAPPER}} .about__inner:hover .about__iconbg' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .about__inner:hover .about__iconbg::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .about__inner:hover .about__iconbg::before' => 'border-color: {{VALUE}};',
				],
			]
		);

		// Title & Text
		$this->add_control(
			'ttl_heading',
			[
				'label' => esc_html__( 'Title', 'heal-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'item_title_typo',
				'selector' => '{{WRAPPER}} .about__content h5',
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label' => esc_html__( 'Title Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__content h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_title_hover_color',
			[
				'label' => esc_html__( 'Title Hover Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__inner:hover .about__content h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'txt_heading',
			[
				'label' => esc_html__( 'Description', 'heal-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'item_text_typo',
				'selector' => '{{WRAPPER}} .about__content p',
			]
		);

		$this->add_control(
			'item_text_color',
			[
				'label' => esc_html__( 'Text Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__content p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Tabs (style2)
		$this->start_controls_section(
			'sec_style_tabs',
			[
				'label' => esc_html__( 'Tabs (Style 2)', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [ 'style' => 'style2' ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tabs_typo',
				'selector' => '{{WRAPPER}} .about__filter .nav-link span',
			]
		);

		$this->add_control(
			'tabs_color',
			[
				'label' => esc_html__( 'Text Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__filter .nav-link span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tabs_active_color',
			[
				'label' => esc_html__( 'Active Text Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__filter .nav-link.active span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'tabs_bg',
				'label' => esc_html__( 'Tab BG', 'heal-core' ),
				'selector' => '{{WRAPPER}} .about__filter .nav-link',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'tabs_bg_active',
				'label' => esc_html__( 'Active Tab BG', 'heal-core' ),
				'selector' => '{{WRAPPER}} .about__filter .nav-link.active',
			]
		);

		$this->add_responsive_control(
			'tabs_gap',
			[
				'label' => esc_html__( 'Tab Spacing', 'heal-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 0, 'max' => 60 ] ],
				'selectors' => [
					'{{WRAPPER}} .about__filter .nav-link' => 'margin: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0;',
				],
			]
		);

		// Tab content typographies
		$this->add_control(
			'tab_content_head',
			[
				'label' => esc_html__( 'Content Typographies', 'heal-core' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tab_h5_typo',
				'label' => esc_html__( 'Heading (h5)', 'heal-core' ),
				'selector' => '{{WRAPPER}} .about__content h5',
			]
		);

		$this->add_control(
			'tab_h5_color',
			[
				'label' => esc_html__( 'Heading Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__content h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tab_h6_typo',
				'label' => esc_html__( 'Subheading (h6)', 'heal-core' ),
				'selector' => '{{WRAPPER}} .about__content h6',
			]
		);

		$this->add_control(
			'tab_h6_color',
			[
				'label' => esc_html__( 'Subheading Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__content h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tab_p_typo',
				'label' => esc_html__( 'Paragraph', 'heal-core' ),
				'selector' => '{{WRAPPER}} .about__content p',
			]
		);

		$this->add_control(
			'tab_p_color',
			[
				'label' => esc_html__( 'Paragraph Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__content p' => 'color: {{VALUE}};',
				],
			]
		);

		// Button
		$this->add_control(
			'tab_btn_head',
			[
				'label' => esc_html__( 'Button', 'heal-core' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'btn_tabs' );

		$this->start_controls_tab(
			'btn_normal',
			[ 'label' => esc_html__( 'Normal', 'heal-core' ) ]
		);

		$this->add_control(
			'btn_color',
			[
				'label' => esc_html__( 'Text Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .default-btn.move-right span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .poster__right .default-btn.move-right span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_bg',
				'label' => esc_html__( 'Background', 'heal-core' ),
				'selector' => '{{WRAPPER}} .default-btn.move-right',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_hover',
			[ 'label' => esc_html__( 'Hover', 'heal-core' ) ]
		);

		$this->add_control(
			'btn_color_hover',
			[
				'label' => esc_html__( 'Text Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .default-btn.move-right:hover span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_bg_hover',
				'label' => esc_html__( 'Background', 'heal-core' ),
				'selector' => '{{WRAPPER}} .default-btn.move-right:hover',
				'selector' => '{{WRAPPER}} .default-btn.move-right::before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'btn_radius',
			[
				'label' => esc_html__( 'Border Radius', 'heal-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .default-btn.move-right' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Volunteer block (style3, style4, style5 shared bits)
		$this->start_controls_section(
			'sec_style_volunteer',
			[
				'label' => esc_html__( 'Volunteer Block', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [ 'style' => [ 'style3', 'style4', 'style5' ] ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'vol_h5_typo',
				'label' => esc_html__( 'Heading (h5)', 'heal-core' ),
				'selector' => '{{WRAPPER}} .volunteer__title h5, {{WRAPPER}} .poster__contentpart h5',
			]
		);

		$this->add_control(
			'vol_h5_color',
			[
				'label' => esc_html__( 'Heading Color', 'heal-core' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .volunteer__title h5' => 'color: {{VALUE}};',
					'{{WRAPPER}} .poster__contentpart h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'vol_h6_typo',
				'label' => esc_html__( 'Subheading (h6)', 'heal-core' ),
				'selector' => '{{WRAPPER}} .volunteer__title h6, {{WRAPPER}} .poster__contentpart h6',
			]
		);

		$this->add_control(
			'vol_h6_color',
			[
				'label' => esc_html__( 'Subheading Color', 'heal-core' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .volunteer__title h6' => 'color: {{VALUE}};',
					'{{WRAPPER}} .poster__contentpart h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'vol_p_typo',
				'label' => esc_html__( 'Paragraph', 'heal-core' ),
				'selector' => '{{WRAPPER}} .volunteer__bottom p, {{WRAPPER}} .poster__contentpart p',
			]
		);

		$this->add_control(
			'vol_p_color',
			[
				'label' => esc_html__( 'Paragraph Color', 'heal-core' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .volunteer__bottom p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .poster__contentpart p' => 'color: {{VALUE}};',
				],
			]
		);

		// Icon (style3/4 header icon)
		$this->add_control(
			'vol_icon_head',
			[
				'label' => esc_html__( 'Header Icon', 'heal-core' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'vol_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .volunteer__icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .volunteer__icon svg' => 'fill: {{VALUE}}; color: {{VALUE}};',
					'{{WRAPPER}} .volunteer__icon' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'vol_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'heal-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 10, 'max' => 200 ] ],
				'selectors' => [
					'{{WRAPPER}} .volunteer__icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .volunteer__icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Video Play Button (style4)
		$this->start_controls_section(
			'sec_style_video',
			[
				'label' => esc_html__( 'Video Play Button', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [ 'style' => 'style4' ],
			]
		);

		$this->add_control(
			'play_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'heal-core' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-btn i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .play-btn svg' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'play_bg',
				'label' => esc_html__( 'Button Background', 'heal-core' ),
				'selector' => '{{WRAPPER}} .play-btn',
				'selector' => '{{WRAPPER}} .play-btn span, .play-btn span::before, .play-btn span::after',
			]
		);

		$this->add_responsive_control(
			'play_btn_size',
			[
				'label' => esc_html__( 'Button Size', 'heal-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 20, 'max' => 200 ] ],
				'selectors' => [
					'{{WRAPPER}} .play-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Slider Pagination / Nav (style3 & style5)
		$this->start_controls_section(
			'sec_style_slider_ui',
			[
				'label' => esc_html__( 'Slider UI (Pagination/Nav)', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [ 'style' => [ 'style3', 'style5' ] ],
			]
		);

		$this->add_control(
			'pag_bullet_color',
			[
				'label' => esc_html__( 'Pagination Bullet', 'heal-core' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__pagination .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
				'condition' => [ 'style' => 'style3' ],
			]
		);

		$this->add_control(
			'pag_bullet_active_color',
			[
				'label' => esc_html__( 'Active Bullet', 'heal-core' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about__pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
				],
				'condition' => [ 'style' => 'style3' ],
			]
		);

		$this->add_control(
			'nav_color',
			[
				'label' => esc_html__( 'Nav Arrow Color', 'heal-core' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .poster__navi .poster__next i,
					 {{WRAPPER}} .poster__navi .poster__prev i' => 'color: {{VALUE}};',
				],
				'condition' => [ 'style' => 'style5' ],
			]
		);
		$this->add_control(
			'nav_hover_color',
			[
				'label' => esc_html__( 'Nav Hover Color', 'heal-core' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .poster__navi .poster__next:hover i,
					 {{WRAPPER}} .poster__navi .poster__prev:hover i' => 'color: {{VALUE}};',
				],
				'condition' => [ 'style' => 'style5' ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'nav_bg',
				'label' => esc_html__( 'Nav BG', 'heal-core' ),
				'selector' => '{{WRAPPER}} .poster__navi .poster__next, {{WRAPPER}} .poster__navi .poster__prev',
				'condition' => [ 'style' => 'style5' ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'nav_hover_bg',
				'label' => esc_html__( 'Nav Hover BG', 'heal-core' ),
				'selector' => '{{WRAPPER}} .poster__navi .poster__next:hover, {{WRAPPER}} .poster__navi .poster__prev:hover',
				'condition' => [ 'style' => 'style5' ],
			]
		);

		$this->end_controls_section();

		// Poster Right (style5)
		$this->start_controls_section(
			'sec_style_poster_right',
			[
				'label' => esc_html__( 'Poster Right (Style 5)', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [ 'style' => 'style5' ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'poster_right_h3_typo',
				'label' => esc_html__( 'Right Title (h3)', 'heal-core' ),
				'selector' => '{{WRAPPER}} .poster__right h3',
			]
		);

		$this->add_control(
			'poster_right_h3_color',
			[
				'label' => esc_html__( 'Right Title Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .poster__right h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'poster_right_desc_typo',
				'label' => esc_html__( 'Right Description', 'heal-core' ),
				'selector' => '{{WRAPPER}} .poster__right, {{WRAPPER}} .poster__right p',
			]
		);

		$this->add_control(
			'poster_right_desc_color',
			[
				'label' => esc_html__( 'Right Text Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .poster__right, {{WRAPPER}} .poster__right p' => 'color: {{VALUE}};',
				],
			]
		);


		// Button
		$this->add_control(
			'tab_btn_head_5',
			[
				'label' => esc_html__( 'Button', 'heal-core' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'btn_tabs_5' );

		$this->start_controls_tab(
			'btn_normal_5',
			[ 'label' => esc_html__( 'Normal', 'heal-core' ) ]
		);

		$this->add_control(
			'btn_color_5',
			[
				'label' => esc_html__( 'Text Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .default-btn.move-right span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .poster__right .default-btn.move-right span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_bg_5',
				'label' => esc_html__( 'Background', 'heal-core' ),
				'selector' => '{{WRAPPER}} .default-btn.move-right',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_hover_5',
			[ 'label' => esc_html__( 'Hover', 'heal-core' ) ]
		);

		$this->add_control(
			'btn_color_hover_5',
			[
				'label' => esc_html__( 'Text Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .default-btn.move-right:hover span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_bg_hover_5',
				'label' => esc_html__( 'Background', 'heal-core' ),
				'selector' => '{{WRAPPER}} .default-btn.move-right:hover',
				'selector' => '{{WRAPPER}} .default-btn.move-right::before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Testimonial identity (style5 left panel)
		$this->start_controls_section(
			'sec_style_testi_identity',
			[
				'label' => esc_html__( 'Testimonial Identity', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [ 'style' => 'style5' ],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'testi_name_typo',
				'label' => esc_html__( 'Name', 'heal-core' ),
				'selector' => '{{WRAPPER}} .poster__thumbpart-content h5',
			]
		);

		$this->add_control(
			'testi_name_color',
			[
				'label' => esc_html__( 'Name Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .poster__thumbpart-content h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'testi_desig_typo',
				'label' => esc_html__( 'Designation', 'heal-core' ),
				'selector' => '{{WRAPPER}} .poster__thumbpart-content span',
			]
		);

		$this->add_control(
			'testi_desig_color',
			[
				'label' => esc_html__( 'Designation Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .poster__thumbpart-content span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'testi_social_color',
			[
				'label' => esc_html__( 'Social Icon Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .poster__thumbpart-content ul li a i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'testi_social_hover_color',
			[
				'label' => esc_html__( 'Social Icon Hover Color', 'heal-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .poster__thumbpart-content ul li a:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$allowed_tags = wp_kses_allowed_html('post');
		?>
		<?php
		// Swiper init (unchanged markup/classes)
		echo '
	 	<script>
			jQuery(document).ready(function($) {
				var swiper = new Swiper(".mission__slider", {
					loop: true,
					autoplay: { delay: 10000, disableOnInteraction: false },
					breakpoints: {
						992: { slidesPerView: 3 },
						768: { slidesPerView: 2 },
						575: { slidesPerView: 1 }
					}
				});

				var swiper2 = new Swiper(".about__slider", {
					loop: true,
					autoplay: { delay: 10000, disableOnInteraction: false },
					pagination: { el: ".about__pagination", clickable: true }
				});

				var swiper3 = new Swiper(".poster__slider", {
					loop: true,
					autoplay: { delay: 10000, disableOnInteraction: false },
					navigation: {
						nextEl: ".poster__next",
						prevEl: ".poster__prev"
					}
				});
			});
		</script>';
		?>

		<?php if ( 'style1' === $settings['style'] ) : ?>
			<div class="about-section">
				<div class="container">
					<div class="about">
						<div class="row g-0 justify-content-center d-none">
							<?php if ( ! empty( $settings['repeat'] ) ) :
								foreach ( $settings['repeat'] as $item ) : ?>
									<div class="col-lg-4 col-sm-6 col-12">
										<div class="about__item">
											<div class="about__inner">
												<div class="about__thumb">
													<span class="about__iconbg">
														<?php
														if ( ! empty( $item['block_icon'] ) ) {
															\Elementor\Icons_Manager::render_icon( $item['block_icon'], [ 'aria-hidden' => 'true' ] );
														}
														?>
													</span>
												</div>
												<div class="about__content">
													<h5><?php echo wp_kses( $item['block_title'], $allowed_tags ); ?></h5>
													<p><?php echo wp_kses( $item['block_text'], $allowed_tags ); ?></p>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; endif; ?>
						</div>
						<?php
						$items = isset( $settings['repeat'] ) ? $settings['repeat'] : [];
						$total_items = is_array( $items ) ? count( $items ) : 0;
						?>
						<?php if ( $total_items && $total_items <= 3 ) : ?>
							<div class="row g-0 justify-content-center d-none d-lg-flex">
								<?php foreach ( $items as $item ) : ?>
									<div class="col-lg-4 col-sm-6 col-12">
										<div class="about__item">
											<div class="about__inner">
												<div class="about__thumb">
													<span class="about__iconbg">
														<?php
														if ( ! empty( $item['block_icon'] ) ) {
															\Elementor\Icons_Manager::render_icon( $item['block_icon'], [ 'aria-hidden' => 'true' ] );
														}
														?>
													</span>
												</div>
												<div class="about__content">
													<h5><?php echo wp_kses( $item['block_title'], $allowed_tags ); ?></h5>
													<p><?php echo wp_kses( $item['block_text'], $allowed_tags ); ?></p>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="swiper-container mission__slider overflow-hidden d-lg-none">
								<div class="swiper-wrapper">
									<?php foreach ( $items as $item ) : ?>
										<div class="swiper-slide col-12">
											<div class="about__item">
												<div class="about__inner">
													<div class="about__thumb">
														<span class="about__iconbg">
															<?php
															if ( ! empty( $item['block_icon'] ) ) {
																\Elementor\Icons_Manager::render_icon( $item['block_icon'], [ 'aria-hidden' => 'true' ] );
															}
															?>
														</span>
													</div>
													<div class="about__content">
														<h5><?php echo wp_kses( $item['block_title'], $allowed_tags ); ?></h5>
														<p><?php echo wp_kses( $item['block_text'], $allowed_tags ); ?></p>
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php else : ?>
							<?php if ( $total_items ) : ?>
								<div class="swiper-container mission__slider overflow-hidden">
									<div class="swiper-wrapper">
										<?php foreach ( $items as $item ) : ?>
											<div class="swiper-slide col-12">
												<div class="about__item">
													<div class="about__inner">
														<div class="about__thumb">
															<span class="about__iconbg">
																<?php
																if ( ! empty( $item['block_icon'] ) ) {
																	\Elementor\Icons_Manager::render_icon( $item['block_icon'], [ 'aria-hidden' => 'true' ] );
																}
																?>
															</span>
														</div>
														<div class="about__content">
															<h5><?php echo wp_kses( $item['block_title'], $allowed_tags ); ?></h5>
															<p><?php echo wp_kses( $item['block_text'], $allowed_tags ); ?></p>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>

		<?php elseif ( 'style2' === $settings['style'] ) : ?>
			<div class="about-section bg-white padding--top padding--bottom">
				<div class="container">
					<div class="about">
						<div class="d-flex flex-wrap flex-xl-nowrap align-items-start">
							<div class="about__filter nav flex-xl-column justify-content-center nav-pills me-xl-3"
								id="v-pills-tab" role="tablist" aria-orientation="vertical">
								<?php if ( ! empty( $settings['repeat2'] ) ) :
									foreach ( $settings['repeat2'] as $index => $item ):
										$active = ( $index === 0 ) ? 'active' : ''; // keep UX sane, no markup change
										?>
										<button class="nav-link <?php echo esc_attr( $active ); ?>" id="v-pills-<?php echo esc_attr( $index ); ?>-tab"
												data-bs-toggle="pill" data-bs-target="#v-pills-<?php echo esc_attr( $index ); ?>"
												type="button" role="tab"
												aria-selected="<?php echo ( $index === 0 ) ? 'true' : 'false'; ?>">
											<?php if ( ! empty( $item['tab_icon']['url'] ) ) : ?>
												<img src="<?php echo esc_url( $item['tab_icon']['url'] ); ?>" alt="tab-icon">
											<?php endif; ?>
											<span><?php echo esc_html( $item['tab_title'] ); ?></span>
										</button>
									<?php endforeach; endif; ?>
							</div>

							<div class="about__filtercontent tab-content" id="v-pills-tabContent">
								<?php if ( ! empty( $settings['repeat2'] ) ) :
									foreach ( $settings['repeat2'] as $index => $item ):
										$active = ( $index === 0 ) ? 'show active' : '';
										?>
										<div class="tab-pane fade <?php echo esc_attr( $active ); ?>" id="v-pills-<?php echo esc_attr( $index ); ?>" role="tabpanel">
											<div class="about__item">
												<div class="about__inner">
													<div class="about__thumb">
														<?php if ( ! empty( $item['tab_image']['url'] ) ) : ?>
															<img src="<?php echo esc_url( $item['tab_image']['url'] ); ?>" alt="about-thumb">
														<?php endif; ?>
													</div>

													<div class="about__content">
														<?php if ( ! empty( $item['heading'] ) ) : ?>
															<h5><?php echo esc_html( $item['heading'] ); ?></h5>
														<?php endif; ?>

														<?php if ( ! empty( $item['sub_heading'] ) ) : ?>
															<h6><?php echo esc_html( $item['sub_heading'] ); ?></h6>
														<?php endif; ?>

														<?php if ( ! empty( $item['description'] ) ) : ?>
															<p><?php echo esc_html( $item['description'] ); ?></p>
														<?php endif; ?>

														<?php if ( ! empty( $item['button_url']['url'] ) ) : ?>
															<a href="<?php echo esc_url( $item['button_url']['url'] ); ?>" class="default-btn move-right">
																<span><?php echo esc_html( $item['button_text'] ); ?></span>
															</a>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
								<?php endforeach; endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php elseif ( 'style3' === $settings['style'] ) : ?>
			<div class="about-section bg-white padding--top padding--bottom">
				<div class="container">
					<div class="about about-style2">
						<?php if ( ! empty( $settings['section_title'] ) ) : ?>
							<div class="section-header style-2">
								<h2><?php echo wp_kses( $settings['section_title'], $allowed_tags ); ?></h2>
								<?php if ( ! empty( $settings['section_description'] ) ) : ?>
									<p><?php echo wp_kses( $settings['section_description'], $allowed_tags ); ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<div class="volunteer volunteer-style2">
							<div class="volunteer__item volunteer__item-style2">
								<div class="volunteer__inner flex-row-reverse">
									<div class="volunteer__thumb">
										<div class="about__slider position-relative">
											<div class="swiper-wrapper">
												<?php if ( ! empty( $settings['repeat3'] ) ) :
													foreach ( $settings['repeat3'] as $item ) : ?>
														<div class="swiper-slide">
															<div class="about__thumb">
																<?php if ( ! empty( $item['slider_image']['url'] ) ) : ?>
																	<img src="<?php echo esc_url( $item['slider_image']['url'] ); ?>" alt="<?php bloginfo('name'); ?>">
																<?php endif; ?>
															</div>
														</div>
												<?php endforeach; endif; ?>
											</div>
											<div class="about__pagination"></div>
										</div>
									</div>

									<div class="volunteer__content">
										<div class="volunteer__top">
											<div class="volunteer__icon">
												<?php
												if ( ! empty( $settings['style3_icon'] ) ) {
													\Elementor\Icons_Manager::render_icon( $settings['style3_icon'], [ 'aria-hidden' => 'true' ] );
												}
												?>
											</div>

											<div class="volunteer__title">
												<?php if ( ! empty( $settings['style3_heading'] ) ) : ?>
													<h5><?php echo wp_kses( $settings['style3_heading'], $allowed_tags ); ?></h5>
												<?php endif; ?>

												<?php if ( ! empty( $settings['style3_subheading'] ) ) : ?>
													<h6><?php echo wp_kses( $settings['style3_subheading'], $allowed_tags ); ?></h6>
												<?php endif; ?>
											</div>
										</div>

										<?php if ( ! empty( $settings['style3_description'] ) ) : ?>
											<div class="volunteer__bottom">
												<p><?php echo wp_kses( $settings['style3_description'], $allowed_tags ); ?></p>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

		<?php elseif ( 'style4' === $settings['style'] ) : ?>
			<div class="about-section bg-white padding--top padding--bottom bg-ash">
				<div class="container">
					<div class="about">
						<div class="volunteer volunteer-style2">
							<div class="volunteer__item volunteer__item-style2">
								<div class="volunteer__inner">
									<div class="volunteer__thumb position-relative">
										<?php if ( ! empty( $settings['about_thumbnail']['url'] ) ) : ?>
											<img src="<?php echo esc_url( $settings['about_thumbnail']['url'] ); ?>" alt="about-thumb">
										<?php endif; ?>
										<?php if ( 'yes' === $settings['video_switch'] && ! empty( $settings['about_video'] ) ) : ?>
											<a href="<?php echo esc_url( $settings['about_video'] ); ?>" class="play-btn" data-rel="lightcase" target="_blank" rel="noopener">
												<?php if ( ! empty( $settings['about_video_icon'] ) ) {
													\Elementor\Icons_Manager::render_icon( $settings['about_video_icon'], [ 'aria-hidden' => 'true' ] );
												} ?>
												<span class="pluse_2"></span>
											</a>
										<?php endif; ?>
									</div>

									<div class="volunteer__content">
										<div class="volunteer__top">
											<?php if ( ! empty( $settings['style3_icon'] ) ) : ?>
												<div class="volunteer__icon">
													<?php \Elementor\Icons_Manager::render_icon( $settings['style3_icon'], [ 'aria-hidden' => 'true' ] ); ?>
												</div>
											<?php endif; ?>

											<div class="volunteer__title">
												<?php if ( ! empty( $settings['style3_heading'] ) ) : ?>
													<h5><?php echo wp_kses( $settings['style3_heading'], $allowed_tags ); ?></h5>
												<?php endif; ?>

												<?php if ( ! empty( $settings['style3_subheading'] ) ) : ?>
													<h6><?php echo wp_kses( $settings['style3_subheading'], $allowed_tags ); ?></h6>
												<?php endif; ?>
											</div>
										</div>

										<?php if ( ! empty( $settings['style3_description'] ) ) : ?>
											<div class="volunteer__bottom">
												<p><?php echo wp_kses( $settings['style3_description'], $allowed_tags ); ?></p>
											</div>
										<?php endif; ?>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php elseif ( 'style5' === $settings['style'] ) : ?>
			<div class="poster-section padding--top padding--bottom">
				<div class="container">
					<?php if ( ! empty( $settings['section_title'] ) ) : ?>
						<div class="section-header style-2">
							<h2><?php echo wp_kses( $settings['section_title'], $allowed_tags ); ?></h2>
							<?php if ( ! empty( $settings['section_description'] ) ) : ?>
								<p><?php echo wp_kses( $settings['section_description'], $allowed_tags ); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<div class="section-wrapper">
						<div class="poster">
							<div class="row g-4 justify-content-center">
								<div class="col-xl-8 col-12">
									<div class="poster__left">
										<div class="poster__slider overflow-hidden position-relative">
											<div class="swiper-wrapper">
												<?php if ( ! empty( $settings['repeat5'] ) ) :
													foreach ( $settings['repeat5'] as $index => $item ) : ?>
														<div class="swiper-slide">
															<div class="poster__item">
																<div class="poster__inner">
																	<div class="poster__thumbpart">
																		<?php if ( ! empty( $item['at_img']['url'] ) ) : ?>
																			<div class="poster__thumbpart-thumb">
																				<img src="<?php echo esc_url( $item['at_img']['url'] ); ?>" alt="<?php bloginfo('name'); ?>">
																			</div>
																		<?php endif; ?>

																		<div class="poster__thumbpart-content">
																			<?php if ( ! empty( $item['at_name'] ) ) : ?>
																				<h5><?php echo wp_kses( $item['at_name'], $allowed_tags ); ?></h5>
																			<?php endif; ?>

																			<?php if ( ! empty( $item['at_designation'] ) ) : ?>
																				<span><?php echo wp_kses( $item['at_designation'], $allowed_tags ); ?></span>
																			<?php endif; ?>

																			<ul>
																				<?php if ( ! empty( $item['at_facebook']['url'] ) ) : ?>
																					<li><a href="<?php echo esc_url( $item['at_facebook']['url'] ); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li>
																				<?php endif; ?>
																				<?php if ( ! empty( $item['at_instagram']['url'] ) ) : ?>
																					<li><a href="<?php echo esc_url( $item['at_instagram']['url'] ); ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a></li>
																				<?php endif; ?>
																				<?php if ( ! empty( $item['at_twitter']['url'] ) ) : ?>
																					<li><a href="<?php echo esc_url( $item['at_twitter']['url'] ); ?>" target="_blank" rel="noopener"><i class="fab fa-x-twitter"></i></a></li>
																				<?php endif; ?>
																				<?php if ( ! empty( $item['at_linkedin']['url'] ) ) : ?>
																					<li><a href="<?php echo esc_url( $item['at_linkedin']['url'] ); ?>" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></li>
																				<?php endif; ?>
																				<?php if ( ! empty( $item['at_youtube']['url'] ) ) : ?>
																					<li><a href="<?php echo esc_url( $item['at_youtube']['url'] ); ?>" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a></li>
																				<?php endif; ?>
																				<?php if ( ! empty( $item['at_tiktok']['url'] ) ) : ?>
																					<li><a href="<?php echo esc_url( $item['at_tiktok']['url'] ); ?>" target="_blank" rel="noopener"><i class="fab fa-tiktok"></i></a></li>
																				<?php endif; ?>
																				<?php if ( ! empty( $item['at_behance']['url'] ) ) : ?>
																					<li><a href="<?php echo esc_url( $item['at_behance']['url'] ); ?>" target="_blank" rel="noopener"><i class="fab fa-behance"></i></a></li>
																				<?php endif; ?>
																				<?php if ( ! empty( $item['at_dribbble']['url'] ) ) : ?>
																					<li><a href="<?php echo esc_url( $item['at_dribbble']['url'] ); ?>" target="_blank" rel="noopener"><i class="fab fa-dribbble"></i></a></li>
																				<?php endif; ?>
																				<?php if ( ! empty( $item['at_pinterest']['url'] ) ) : ?>
																					<li><a href="<?php echo esc_url( $item['at_pinterest']['url'] ); ?>" target="_blank" rel="noopener"><i class="fab fa-pinterest-p"></i></a></li>
																				<?php endif; ?>
																			</ul>
																		</div>
																	</div>

																	<div class="poster__contentpart">
																		<?php if ( ! empty( $item['at_title'] ) ) : ?>
																			<h5><?php echo wp_kses( $item['at_title'], $allowed_tags ); ?></h5>
																		<?php endif; ?>

																		<?php if ( ! empty( $item['at_subtitle'] ) ) : ?>
																			<h6><?php echo wp_kses( $item['at_subtitle'], $allowed_tags ); ?></h6>
																		<?php endif; ?>

																		<?php echo wp_kses( $item['at_description'], $allowed_tags ); ?>
																	</div>
																</div>
															</div>
														</div>
												<?php endforeach; endif; ?>
											</div>

											<?php if ( isset( $settings['about_thumbnail_switch'] ) && 'yes' === $settings['about_thumbnail_switch'] ) : ?>
												<div class="poster__navi">
													<div class="poster__next">
														<i class="fas fa-chevron-left"></i>
													</div>
													<div class="poster__prev">
														<i class="fas fa-chevron-right"></i>
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>

								<div class="col-xl-4 col-md-6 col-12">
									<div class="poster__right">
										<?php if ( ! empty( $settings['style3_heading'] ) ) : ?>
											<h3><?php echo wp_kses( $settings['style3_heading'], $allowed_tags ); ?></h3>
										<?php endif; ?>

										<?php if ( ! empty( $settings['style5_img']['url'] ) ) : ?>
											<img src="<?php echo esc_url( $settings['style5_img']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="w-100">
										<?php endif; ?>

										<?php if ( ! empty( $settings['style3_description'] ) ) : ?>
											<?php echo wp_kses( $settings['style3_description'], $allowed_tags ); ?>
										<?php endif; ?>

										<?php if ( ! empty( $settings['style5_button_url'] ) && ! empty( $settings['style5_button_text'] ) ) : ?>
											<a href="<?php echo esc_url( is_array( $settings['style5_button_url'] ) ? $settings['style5_button_url']['url'] : $settings['style5_button_url'] ); ?>" class="default-btn move-right">
												<span><?php echo wp_kses( $settings['style5_button_text'], $allowed_tags ); ?></span>
											</a>
										<?php endif; ?>
									</div>
								</div>

							</div>
						</div>
					</div>

				</div>
			</div>
		<?php endif; ?>

		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Theme_About() );
