<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
    // Elementor inactive
    return;
}

class Theme_Hafsa_Service extends Widget_Base {

    public function get_name() {
        return 'hafsa-service-widget';
    }

    public function get_title() {
        return esc_html__( 'Services', 'heal-core' );
    }

    public function get_icon() {
        return 'theme-icon';
    }

    public function get_categories() {
        return [ 'heal_religion' ];
    }

    public function get_keywords() {
        return [ 'service', 'feature', 'icon', 'cards' ];
    }

    public function get_script_depends() { return []; }
    public function get_style_depends()  { return []; }

    protected function register_controls() {

        $this->start_controls_section(
            'type_style',
            [
                'label' => __( 'Service Type Style', 'heal-core' ),
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
					'style1' => esc_html__( 'Permalink', 'heal-core' ),
					'style2' => esc_html__( 'Block', 'heal-core' ),
				],
			]
		);

        $this->end_controls_section();

        /* -----------------------------
         * CONTENT: Section Header
        * ----------------------------- */
        $this->start_controls_section(
            'section_heading',
            [
                'label' => __( 'Section Header', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        
        $this->add_control(
            'section_subtitle',
            [
                'label'       => esc_html__( 'Sub Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__( 'Enter subtiltle', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label'       => esc_html__( 'Section Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => esc_html__( 'Enter title text', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Permalink
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'General Settings', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
					'style' => [ 'style1' ],
				],
            ]
        );
        $this->add_control(
            'sp_grid',
            [
                'label'       => esc_html__( 'Service Grid', 'heal-core' ),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'col-lg-2'  => esc_html__( 'col-lg-2', 'heal-core' ),
                    'col-lg-3'  => esc_html__( 'col-lg-3', 'heal-core' ),
                    'col-lg-4'  => esc_html__( 'col-lg-4', 'heal-core' ),
                    'col-lg-6'  => esc_html__( 'col-lg-6', 'heal-core' ),
                    'col-lg-12' => esc_html__( 'col-lg-12', 'heal-core' ),
                ],
                'default'     => 'col-lg-4',
                'description' => esc_html__( 'Select Service Grid', 'heal-core' ),
            ]
        );
        $this->add_control(
            'button',
            [
                'label'       => __( 'Button', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => esc_html__( 'Enter your button text', 'heal-core' ),
                'default'     => esc_html__( 'Read More', 'heal-core' ),
            ]
        );
        $this->add_control(
            'total',
            [
                'label'       => esc_html__( 'Total Posts', 'heal-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '-1',
                'description' => esc_html__( 'How many posts to show; -1 for all (no pagination).', 'heal-core' ),
            ]
        );
        $this->add_control(
            'category',
            [
                'label'       => esc_html__( 'Category', 'heal-core' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => function_exists('heal_core') ? heal_core()->get_terms_names( 'service-cat', 'id' ) : [],
                'default'     => [],
                'include'     => [],
                'exclude'     => [],
                'description' => esc_html__( 'Select categories or leave empty for all.', 'heal-core' ),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'order',
            [
                'label'       => esc_html__( 'Order', 'heal-core' ),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'ASC'  => esc_html__( 'Ascending', 'heal-core' ),
                    'DESC' => esc_html__( 'Descending', 'heal-core' ),
                ],
                'default'     => 'DESC',
                'description' => esc_html__( 'Select order.', 'heal-core' ),
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label'       => esc_html__( 'OrderBy', 'heal-core' ),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'ID'            => esc_html__( 'ID', 'heal-core' ),
                    'title'         => esc_html__( 'Title', 'heal-core' ),
                    'date'          => esc_html__( 'Date', 'heal-core' ),
                    'rand'          => esc_html__( 'Random', 'heal-core' ),
                    'menu_order' => __('Manual Order', 'heal-core'),
                    'comment_count' => esc_html__( 'Most Comments', 'heal-core' ),
                ],
                'default'     => 'ID',
                'description' => esc_html__( 'Select orderby.', 'heal-core' ),
            ]
        );
        $this->add_control(
            'image_thumb_display',
            [
                'label'       => esc_html__( 'Image Display', 'heal-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'description' => esc_html__( 'Show/Hide featured image.', 'heal-core' ),
            ]
        );
        $this->add_control(
            'pagination',
            [
                'label'       => esc_html__( 'Pagination', 'heal-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Enable pagination (ignored when Total = -1).', 'heal-core' ),
                'default'     => 'yes',
            ]
        );
        $this->add_control(
            'pagination_alignment',
            [
                'label'       => esc_html__( 'Pagination Alignment', 'heal-core' ),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'left'   => esc_html__( 'Left Align', 'heal-core' ),
                    'center' => esc_html__( 'Center Align', 'heal-core' ),
                    'end'  => esc_html__( 'Right Align', 'heal-core' ),
                ],
                'description' => esc_html__( 'Alignment for pagination.', 'heal-core' ),
                'default'     => 'left',
                'condition'   => [ 'pagination' => 'yes' ],
            ]
        );
        $this->add_control(
            'category_display',
            [
                'label'       => esc_html__( 'Category Display', 'heal-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Show/Hide categories.', 'heal-core' ),
                'default'     => '',
            ]
        );
        // $this->add_control(
        //     'tag_display',
        //     [
        //         'label'       => esc_html__( 'Tags Display', 'heal-core' ),
        //         'type'        => Controls_Manager::SWITCHER,
        //         'description' => esc_html__( 'Show/Hide tags.', 'heal-core' ),
        //         'default'     => '',
        //     ]
        // );
        $this->end_controls_section();
        // Permalink

        // Block
        $this->start_controls_section(
            'section_block',
            [
                'label' => __( 'Block', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
					'style' => [ 'style2' ],
				],
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'service_img_switcher',
            [
                'label'        => esc_html__( 'Show Image', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'heal-core' ),
                'label_off'    => esc_html__( 'Hide', 'heal-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $repeater->add_control(
            'service_img',
            [
                'label'       => esc_html__( 'Image', 'heal-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src() ],
                'condition'   => [ 'service_img_switcher' => 'yes' ],
            ]
        );
        $repeater->add_control(
            'service_img_alt',
            [
                'label'       => esc_html__( 'Image Alt', 'heal-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
                'condition'   => [ 'service_img_switcher' => 'yes' ],
            ]
        );
        $repeater->add_control(
            'service_icon_img_switcher',
            [
                'label'        => esc_html__( 'Show Icon Image', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'heal-core' ),
                'label_off'    => esc_html__( 'Hide', 'heal-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $repeater->add_control(
            'service_icon_img',
            [
                'label'       => esc_html__( 'Icon Image', 'heal-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src() ],
                'condition'   => [ 'service_icon_img_switcher' => 'yes' ],
            ]
        );
        $repeater->add_control(
            'service_icon_img_alt',
            [
                'label'       => esc_html__( 'Image Alt', 'heal-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
                'condition'   => [ 'service_icon_img_switcher' => 'yes' ],
            ]
        );
        $repeater->add_control(
            'service_title',
            [
                'label'       => esc_html__( 'Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Service Title', 'heal-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'service_desc',
            [
                'label'       => esc_html__( 'Description', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Description', 'heal-core' ),
            ]
        );
        $this->add_control(
            'service_items',
            [
                'label'       => esc_html__( 'Service Items', 'heal-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{ service_title }}',
            ]
        );
        // Responsive Columns (Bootstrap mapping will be done in render())
        $this->add_responsive_control(
            'columns',
            [
                'label'           => __( 'Columns', 'heal-core' ),
                'type'            => Controls_Manager::SELECT,
                'options'         => [
                    '12' => '1',
                    '6'  => '2',
                    '4'  => '3',
                    '3'  => '4',
                ],
                'default'         => '4',
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '4',
                'tablet_default'  => '6',
                'mobile_default'  => '12',
            ]
        );
        $this->end_controls_section();
        // Block

        // STYLE: Section Header
        $this->start_controls_section(
            'style_section_header',
            [
                'label' => __( 'Section Header', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sh_title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .header-title h2' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'sh_title_typo', 'selector' => '{{WRAPPER}} .header-title h2' ]
        );

        $this->add_control(
            'sh_desc_color',
            [
                'label'     => __( 'Sub Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .header-title h5' => 'color: {{VALUE}};' ],
				'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'sh_desc_typo', 'selector' => '{{WRAPPER}} .header-title h5' ]
        );

        $this->end_controls_section();

        // STYLE: Grid & Gap
        $this->start_controls_section(
            'style_grid',
            [
                'label' => __( 'Gap', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'grid_gutter',
            [
                'label'   => __( 'Grid Gutter', 'heal-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
                'default' => '3',
            ]
        );

        $this->end_controls_section();

       
        //  STYLE: Card / Item
        $this->start_controls_section(
            'style_card',
            [
                'label' => __( 'Card', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'card_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .lab-item.service-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'card_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .lab-item.service-item' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [ 'name' => 'card_border', 'selector' => '{{WRAPPER}} .lab-item.service-item' ]
        );

        $this->add_responsive_control(
            'card_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [ '{{WRAPPER}} .lab-item.service-item' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'card_shadow', 'selector' => '{{WRAPPER}} .lab-item.service-item' ]
        );
        $this->end_controls_section();


        //  STYLE: Category & Images
        $this->start_controls_section(
            'style_cat_img',
            [
                'label' => __( 'Category & Image', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'cat_margin',
            [
                'label'      => __( 'Category Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .hafsa .service-item .lab-inner .lab-content .content-top .service-top-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'cat_color',
            [
                'label'     => __( 'Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .hafsa .service-item .lab-inner .lab-content .content-top .service-top-content span' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'cat_typo', 'selector' => '{{WRAPPER}} .hafsa .service-item .lab-inner .lab-content .content-top .service-top-content span' ]
        );

        $this->add_responsive_control(
            'img_margin',
            [
                'label'      => __( 'Image Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .service-top-thumb img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //  STYLE: Title & Description
        $this->start_controls_section(
            'style_texts',
            [
                'label' => __( 'Title & Description', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .service-top-content h5' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'title_typo', 'selector' => '{{WRAPPER}} .service-top-content h5' ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Title Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .service-top-content h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => __( 'Description Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .content-bottom p' => 'color: {{VALUE}};' ],
				'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'desc_typo', 'selector' => '{{WRAPPER}} .content-bottom p' ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label'      => __( 'Description Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .content-bottom p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_border',
            [
                'label'        => __( 'Content Border Switcher', 'heal-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Hide', 'heal-core' ),
                'label_off'    => __( 'Show', 'heal-core' ),
                'return_value' => 'no',
                'default'      => '',
				'separator' => 'before',
				'separator' => 'after',
                'selectors'    => [
                    '{{WRAPPER}} .lab-content-wrapper'         => 'border: none !important;',
                    '{{WRAPPER}} .lab-content-wrapper::after'  => 'border: none !important; background-color: transparent !important;',
                    '{{WRAPPER}} .lab-content-wrapper::before' => 'border: none !important; background-color: transparent !important;',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_bg',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .hafsa .pattern-2::after',
			]
		);
        $this->end_controls_section();

        // Css
        $this->start_controls_section(
            'section_custom_css',
            [
                'label' => __( 'Custom CSS', 'heal-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'custom_css',
            [
                'label'       => __( 'Write Custom CSS', 'heal-core' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => 'Selector { property: value; }',
                'description' => __( 'Write your custom CSS. Use <strong>selector</strong> keyword instead of wrapper class.', 'heal-core' ),
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $allowed  = wp_kses_allowed_html( 'post' );
        $selected_cats = $settings['category'];
        $order = $settings['order'];
        $orderby = $settings['orderby'];
        $total_posts = $settings['total'];
        
        $paged = 1;
        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');
        } elseif ( isset($_GET['paged']) ) {
            // Elementor inside page builder or querystring
            $paged = (int) $_GET['paged'];
        }

        
        //other settings
        $pagination = $settings['pagination'] ? false : true;
        $pagination_alignment = $settings['pagination_alignment'];


        // Map responsive Columns → Bootstrap classes
        $col_d = (int)($settings['columns'] ?? 4);        // desktop lg
        $col_t = (int)($settings['columns_tablet'] ?? 6); // tablet  md
        $col_m = (int)($settings['columns_mobile'] ?? 12);// mobile  xs

        $valid = [12,6,4,3];
        if ( ! in_array($col_d, $valid, true) ) $col_d = 4;
        if ( ! in_array($col_t, $valid, true) ) $col_t = 6;
        if ( ! in_array($col_m, $valid, true) ) $col_m = 12;

        ?>
        <?php if ( 'style1' === $settings['style'] ) : ?>
            <?php 
                $args = [
                    'post_type' => 'service',
                    'posts_per_page' => $total_posts,
                    'post_status' => 'publish',
                    'order' => $order,
                    'orderby' => $orderby,
                    'paged'          => $paged,
                ];
                if ( !empty($selected_cats) && is_array($selected_cats) ) {
                    $args['tax_query'] = [
                        [
                            'taxonomy' => 'service-cat',
                            'field' => 'term_id',
                            'terms' => $selected_cats,
                            // 'include_children' => false,
                        ],
                    ];
                }


                $post_data = new \WP_Query($args);
                
            ?>
            <div class="hafsa">
                <div class="service-section padding-tb padding-b shape-2">
                    <div class="container">
                        <div class="row">
                            <?php if(!empty($settings['section_title'])) : ?>
                                <div class="col-12">
                                    <div class="header-title">
                                        <?php if(!empty($settings['section_subtitle'])) : ?>
                                            <h5><?php echo esc_html($settings['section_subtitle']); ?></h5>
                                        <?php endif; ?>

                                        <h2><?php echo esc_html($settings['section_title']); ?></h2>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-12">
                                <div class="row g-0 justify-content-center service-wrapper">
                                    <?php while ($post_data->have_posts()) : $post_data->the_post(); 
                                        $post_id = get_the_ID();

                                        // Thumbnail setup
                                        $img_id = get_post_thumbnail_id($post_id);
                                        $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'mrs_grid_blog_12', false) : '';
                                        $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                                        $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true) ? : get_the_title();

                                        // Meta Service
                                        $service_meta_data = get_post_meta(get_the_ID(), 'heal_service_options', true);
                                        $meta_icon = '';
                                        if ( !empty($service_meta_data['service_hafsa_icon']) && is_array($service_meta_data['service_hafsa_icon']) ) {
                                            $meta_icon = !empty($service_meta_data['service_hafsa_icon']['url']) 
                                                ? $service_meta_data['service_hafsa_icon']['url'] 
                                                : '';
                                        }

                                    ?>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="lab-item service-item">
                                            <div class="lab-inner">
                                                <?php if ( has_post_thumbnail() && !empty($settings['image_thumb_display']) ) : ?>
                                                    <div class="lab-thumb">
                                                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" loading="lazy">
                                                    </div>
                                                <?php endif; ?>

                                                <div class="lab-content pattern-2">
                                                    <div class="lab-content-wrapper">
                                                        <div class="content-top">
                                                            <div class="service-top-thumb">
                                                                <?php if ( !empty($meta_icon) ) : ?>
                                                                    <img src="<?php echo esc_url($meta_icon); ?>" alt="<?php the_title(); ?>">
                                                                <?php endif; ?>

                                                            </div>
                                                            <div class="service-top-content">
                                                                <?php 
                                                                    $terms = get_the_terms( get_the_ID(), 'service-cat' ); 
                                                                    if ( !empty($terms) && !is_wp_error($terms) ) {
                                                                        $cats = [];
                                                                        foreach ( $terms as $term ) {
                                                                            $cats[] = esc_html( $term->name );
                                                                        }
                                                                        echo '<span>' . implode(', ', $cats) . '</span>';
                                                                    }
                                                                ?>
                                                                <h5><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h5>
                                                            </div>
                                                        </div>
                                                        <div class="content-bottom">
                                                            <p><?php echo wp_trim_words( get_the_content(), 18, 'heal-core' ); ?></p>

                                                            <?php if (!empty($settings['button'])) : ?>
                                                                <a href="<?php the_permalink(); ?>" class="text-btn"><?php echo esc_html($settings['button']); ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endwhile; wp_reset_postdata(); ?>
                                </div>

                                <?php if ( $settings['pagination'] === 'yes' && $post_data->max_num_pages > 1 ) : ?>
                                    <div class="paginations">
                                        <ul class="lab-ul d-flex flex-wrap justify-content-<?php echo $pagination_alignment ?> mb-1">
                                            <?php
                                            $pages = paginate_links( [
                                                'total'   => $post_data->max_num_pages,
                                                'current' => max( 1, $paged ),
                                                'prev_text' => __('<i class="fa-solid fa-angles-left"></i>', 'heal-core'),
                                                'next_text' => __('<i class="fa-solid fa-angles-right"></i>', 'heal-core'),
                                                'type'    => 'array', // Important
                                            ] );

                                            if ( is_array( $pages ) ) {
                                                foreach ( $pages as $page ) {
                                                    echo '<li>' . $page . '</li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ( 'style2' === $settings['style'] ) : ?>
            <div class="hafsa">
                <div class="service-section padding-tb padding-b shape-2">
                    <div class="container">
                        <div class="row">
                            <?php if(!empty($settings['section_title'])) : ?>
                                <div class="col-12">
                                    <div class="header-title">
                                        <?php if(!empty($settings['section_subtitle'])) : ?>
                                            <h5><?php echo esc_html($settings['section_subtitle']); ?></h5>
                                        <?php endif; ?>

                                        <h2><?php echo esc_html($settings['section_title']); ?></h2>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $settings['service_items'] ) ) : ?>
                            <div class="col-12">
                                <?php
                                    $gutter = isset($settings['grid_gutter']) && $settings['grid_gutter'] !== '' ? 'g-' . esc_attr($settings['grid_gutter']) : '';
                                ?>
                                <div class="row <?php echo $gutter; ?> justify-content-center service-wrapper">
                                    <?php foreach ( $settings['service_items'] as $item ) : ?>
                                    <div class="col-lg-<?php echo esc_attr($col_d); ?> col-md-<?php echo esc_attr($col_t); ?> col-<?php echo esc_attr($col_m); ?>">
                                        <div class="lab-item service-item">
                                            <div class="lab-inner">
                                                <?php if ( !empty($item['service_img']['id']) ) : ?>
                                                    <div class="lab-thumb">
                                                        <img src="<?php echo esc_url($item['service_img']['url']); ?>" alt="<?php echo esc_attr($item['service_img_alt']); ?>" loading="lazy">
                                                    </div>
                                                <?php endif; ?>

                                                <div class="lab-content pattern-2">
                                                    <div class="lab-content-wrapper">
                                                        <div class="content-top">
                                                            <div class="service-top-thumb">
                                                                <?php if ( !empty($item['service_icon_img']['url']) ) : ?>
                                                                    <img src="<?php echo esc_url($item['service_icon_img']['url']); ?>" alt="<?php echo esc_attr($item['service_icon_img_alt']); ?>" loading="lazy">
                                                                <?php endif; ?>
                                                            </div>

                                                            <div class="service-top-content">
                                                                <span>Test, Test2</span>

                                                                <?php if ( ! empty( $item['service_title'] ) ) : ?>
                                                                    <h5><?php echo esc_html( $item['service_title'] ); ?></h5>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="content-bottom">
                                                            <?php if ( ! empty( $item['service_desc'] ) ) : ?>
                                                                <p class="mb-0"><?php echo esc_html( $item['service_desc'] ); ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php else : ?>
                                <p><?php echo esc_html__( 'No service items found.', 'heal-core' ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        
        <?php
        // Custom CSS render
            if ( ! empty( $settings['custom_css'] ) ) {
                echo '<style>';
                echo str_replace( 'selector', '.elementor-element.elementor-element-' . $this->get_id(), $settings['custom_css'] );
                echo '</style>';
            }
        ?>
        <?php
    }
}

/* ---------------------------------
 * Register with modern API
 * --------------------------------- */
add_action( 'elementor/widgets/register', function( $widgets_manager ){
    // Ensure custom category exists
    add_action( 'elementor/elements/categories_registered', function( $elements_manager ){
        $categories = $elements_manager->get_categories();
        if ( ! isset( $categories['heal_widgets'] ) ) {
            $elements_manager->add_category(
                'heal_widgets',
                [
                    'title' => esc_html__( 'Heal Widgets', 'heal-core' ),
                    'icon'  => 'fa fa-plug',
                ]
            );
        }
    }, 5 );

    $widgets_manager->register( new \Elementor\Theme_Hafsa_Service() );
} );
