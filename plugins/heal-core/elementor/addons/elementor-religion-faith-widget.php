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

class Theme_Hafsa_Faith extends Widget_Base {

    public function get_name() {
        return 'hafsa-faith-widget';
    }

    public function get_title() {
        return esc_html__( 'Faith', 'heal-core' );
    }

    public function get_icon() {
        return 'theme-icon';
    }

    public function get_categories() {
        return [ 'heal_religion' ];
    }

    public function get_keywords() {
        return [ 'faith', 'feature', 'icon', 'cards' ];
    }

    public function get_script_depends() { return []; }
    public function get_style_depends()  { return []; }

    protected function register_controls() {
        // Section Header
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
        // Section Header

        // Block
        $this->start_controls_section(
            'section_block',
            [
                'label' => __( 'Block', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'faith_img_switcher',
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
            'faith_img',
            [
                'label'       => esc_html__( 'Image', 'heal-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src() ],
                'condition'   => [ 'faith_img_switcher' => 'yes' ],
            ]
        );
        $repeater->add_control(
            'faith_img_alt',
            [
                'label'       => esc_html__( 'Image Alt', 'heal-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
                'condition'   => [ 'faith_img_switcher' => 'yes' ],
            ]
        );
        $repeater->add_control(
            'faith_icon_img_switcher',
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
            'faith_icon_img',
            [
                'label'       => esc_html__( 'Icon Image', 'heal-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src() ],
                'condition'   => [ 'faith_icon_img_switcher' => 'yes' ],
            ]
        );
        $repeater->add_control(
            'faith_icon_img_alt',
            [
                'label'       => esc_html__( 'Image Alt', 'heal-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
                'condition'   => [ 'faith_icon_img_switcher' => 'yes' ],
            ]
        );
        $repeater->add_control(
            'faith_title',
            [
                'label'       => esc_html__( 'Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Service Title', 'heal-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'faith_desc',
            [
                'label'       => esc_html__( 'Description', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Description', 'heal-core' ),
            ]
        );
        $this->add_control(
            'faith_items',
            [
                'label'       => esc_html__( 'Service Items', 'heal-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{ faith_title }}',
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
            'ht_width',
            [
                'label'     => __( 'Width', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hafsa .header-title' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ht_align',
            [
                'label'   => esc_html__( 'Alignment', 'heal-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => __( 'Left', 'heal-core' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'heal-core' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'heal-core' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hafsa .header-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label'      => __( 'Sub Title Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .header-title h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'sh_subtitle_color',
            [
                'label'     => __( 'Sub Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .header-title h5' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'sh_subtitle_typo', 'selector' => '{{WRAPPER}} .header-title h5' ],
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Title Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .header-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
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
        $this->end_controls_section();



       
        //  STYLE: Card / Item
        $this->start_controls_section(
            'style_card',
            [
                'label' => __( 'Top Card', 'heal-core' ),
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
                    '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'card_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [ 'name' => 'card_border', 'selector' => '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item' ]
        );

        $this->add_responsive_control(
            'card_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [ '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'card_shadow', 'selector' => '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item' ]
        );
        $this->add_control(
            'enable_overflow_hidden',
            [
                'label' => __( 'Hide Overflow', 'your-textdomain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'your-textdomain' ),
                'label_off' => __( 'No', 'your-textdomain' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'selectors' => [
                    '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item' => 'overflow: hidden; position: relative;',
                ],
            ]
        );
        $this->end_controls_section();
        // Card /Item
        

        //  STYLE: Category & Images
        $this->start_controls_section(
            'style_top_img',
            [
                'label' => __( 'Card Top Image', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'cti_width',
            [
                'label'     => __( 'Width', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item .lab-inner .lab-thumb img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'cti_height',
            [
                'label'     => __( 'height', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item .lab-inner .lab-thumb img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [ 'name' => 'cti_border', 'selector' => '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item .lab-inner .lab-thumb img' ]
        );
        $this->add_responsive_control(
            'cti_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
                'selectors' => [ '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item .lab-inner .lab-thumb img' => 'border-radius: {{SIZE}}{{UNIT}};' ],
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
                'selectors' => [ '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item .lab-inner .lab-content h4' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'title_typo', 'selector' => '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item .lab-inner .lab-content h4' ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Title Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item .lab-inner .lab-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => __( 'Description Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item .lab-inner .lab-content p' => 'color: {{VALUE}};' ],
				'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'desc_typo', 'selector' => '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item .lab-inner .lab-content p' ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label'      => __( 'Description Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .hafsa .faith-section .faith-content .faith-item .lab-inner .lab-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();



        //  STYLE: Card / Item Bottom
        $this->start_controls_section(
            'style_card_bottom',
            [
                'label' => __( 'Bottom Card', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'scb_width',
            [
                'label'     => __( 'Width', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hafsa .faith-section .faith-content .nav .nav-item .nav-link' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'acb_height',
            [
                'label'     => __( 'height', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hafsa .faith-section .faith-content .nav .nav-item .nav-link' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'card_bottom_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .hafsa .faith-section .faith-content .nav .nav-item .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'card_bottom_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .hafsa .faith-section .faith-content .nav .nav-item .nav-link' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [ 'name' => 'card_bottom_border', 'selector' => '{{WRAPPER}} .hafsa .faith-section .faith-content .nav .nav-item .nav-link' ]
        );

        $this->add_responsive_control(
            'card_bottom_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [ '{{WRAPPER}} .hafsa .faith-section .faith-content .nav .nav-item .nav-link' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );
        $this->add_control(
            'border_active_color',
            [
                'label'     => __( 'Active Border Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .hafsa .faith-section .faith-content .nav .nav-item .nav-link.active' => 'border-color: {{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'bg_card_active_color',
            [
                'label'     => __( 'Active BG Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .hafsa .faith-section .faith-content .nav .nav-item .nav-link.active' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->end_controls_section();
        // Card / Item


        

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
        ?>

        <div class="hafsa">
            <div class="faith-section padding-tb shape-3">
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

                        <?php 
                            if ( empty( $settings['faith_items'] ) ) {
                                return;
                            }
                        ?>
                        <div class="col-12">
                            <div class="faith-content">
                                <div class="tab-content" id="faith-tabContent">
                                    <?php 
                                    $i = 0;
                                    foreach ( $settings['faith_items'] as $item ) : 
                                        $tab_id   = 'faith-tab-' . $this->get_id() . '-' . $i;
                                        $is_active = $i === 0 ? 'show active' : '';
                                    ?>
                                        <div class="tab-pane fade <?php echo esc_attr( $is_active ); ?>" id="<?php echo esc_attr( $tab_id ); ?>" role="tabpanel">
                                            <div class="lab-item faith-item tri-shape-1 pattern-2">
                                                <div class="lab-inner d-flex align-items-center">
                                                    
                                                    <?php if ( 'yes' === $item['faith_img_switcher'] && !empty( $item['faith_img']['url'] ) ) : ?>
                                                        <div class="lab-thumb">
                                                            <img src="<?php echo esc_url( $item['faith_img']['url'] ); ?>" 
                                                                alt="<?php echo esc_attr( $item['faith_img_alt'] ); ?>">
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="lab-content">
                                                        <?php if ( ! empty( $item['faith_title'] ) ) : ?>
                                                            <h4><?php echo esc_html( $item['faith_title'] ); ?></h4>
                                                        <?php endif; ?>

                                                        <?php if ( ! empty( $item['faith_desc'] ) ) : ?>
                                                            <p><?php echo esc_html( $item['faith_desc'] ); ?></p>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                    $i++;
                                    endforeach; 
                                    ?>
                                </div>

                                <ul class="nav nav-pills mb-3 align-items-center justify-content-center" id="faith-tab" role="tablist">
                                    <?php 
                                    $j = 0;
                                    foreach ( $settings['faith_items'] as $item ) : 
                                        $tab_id   = 'faith-tab-' . $this->get_id() . '-' . $j;
                                        $active_class = $j === 0 ? 'active' : '';
                                    ?>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link <?php echo esc_attr( $active_class ); ?>" 
                                            id="<?php echo esc_attr( $tab_id . '-link' ); ?>" 
                                            data-bs-toggle="pill" 
                                            href="#<?php echo esc_attr( $tab_id ); ?>" 
                                            role="tab" 
                                            aria-controls="<?php echo esc_attr( $tab_id ); ?>" 
                                            aria-selected="<?php echo $j === 0 ? 'true' : 'false'; ?>">
                                                
                                                <?php if ( 'yes' === $item['faith_icon_img_switcher'] && !empty( $item['faith_icon_img']['url'] ) ) : ?>
                                                    <img src="<?php echo esc_url( $item['faith_icon_img']['url'] ); ?>" 
                                                        alt="<?php echo esc_attr( $item['faith_icon_img_alt'] ); ?>">
                                                <?php else : ?>
                                                    <span><?php echo esc_html( $item['faith_title'] ); ?></span>
                                                <?php endif; ?>

                                            </a>
                                        </li>
                                    <?php 
                                    $j++;
                                    endforeach; 
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
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

    $widgets_manager->register( new \Elementor\Theme_Hafsa_Faith() );
} );
