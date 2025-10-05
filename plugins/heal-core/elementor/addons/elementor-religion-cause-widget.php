<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package heal
 * @since 1.0.0
 */
class Theme_Religion_Cause extends Widget_Base {

    public function get_name() { return 'hafsa-cause-widget'; }
    public function get_title() { return esc_html__( 'Causes', 'heal-core' ); }
    public function get_icon() { return 'theme-icon'; }
    public function get_categories() { return ['heal_religion']; }

    protected function register_controls() {

        // SECTION HEADER
        $this->start_controls_section(
            'section_heading',
            [
                'label'     => __( 'Section Header', 'heal-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                // 'condition' => [ 'style' => 'style1' ],
            ]
        );

        $this->add_control(
            'section_subtitle',
            [
                'label'       => esc_html__( 'Section Sub Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'section_title',
            [
                'label'       => esc_html__( 'Section Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'section_description',
            [
                'label'       => esc_html__( 'Description', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'block_button',
            [
                'label' => esc_html__( 'Button Text', 'heal-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'See All Causes',
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter button text', 'heal-core' ),
            ],
        );
        $this->add_control(
            'block_button_link',
            [
                'label' => esc_html__( 'Button URL', 'heal-core'),
                'type'  => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'heal-core' ),
                'default'=> [ 'url'=>'' ],
            ],
        );
        $this->add_control(
            'section_icon',
            [
                'label'   => esc_html__( 'Icon', 'heal-core' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'    => 'fas fa-solid fa-heart',
                    'library'  => 'fa-solid',
                ],
            ]
        );
        $this->end_controls_section();


        // ========== Settings BASIC / QUERY ==========
        $this->start_controls_section(
            'settings_section',
            [
                'label' => esc_html__('Causes Settings', 'heal-core'),
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
                ],
            ]
        );

        $this->add_control(
            'top_desc',
            [
                'label'       => __( 'Top Description', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('We offer security solutions and cost effective service for our client are safe and secure in any situation.', 'heal-core'),
                'placeholder' => esc_html__( 'Enter your top Description text', 'heal-core' ),
            ]
        );

        $this->add_control(
            'navi_switch',
            [
                'label' => esc_html__('Navigation Switcher', 'heal-core'),
                'type'  => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'after',
            ]
        );


        // $this->add_control(
        //     'button',
        //     [
        //         'label'       => __( 'Details Button Text', 'heal-core' ),
        //         'type'        => Controls_Manager::TEXT,
        //         'default'     => esc_html__('Read More', 'heal-core'),
        //         'placeholder' => esc_html__( 'Enter your button text', 'heal-core' ),
        //     ]
        // );

        

        $this->add_control(
            'total',
            [
                'label'       => esc_html__('Total Posts', 'heal-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => -1,
                'description' => esc_html__('-1 for all posts', 'heal-core'),
            ]
        );


        $this->add_control(
            'category',
            [
                'label'       => esc_html__('Category', 'heal-core'),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => function_exists('heal_core') ? heal_core()->get_terms_names('cause-cat', 'id') : [],
                'default'     => [],
                'label_block' => true,
                'description' => esc_html__('Leave empty for all categories', 'heal-core'),
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__('Order', 'heal-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [ 'ASC' => 'ASC', 'DESC' => 'DESC' ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__('Order By', 'heal-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ID'            => esc_html__('ID', 'heal-core'),
                    'title'         => esc_html__('Title', 'heal-core'),
                    'date'          => esc_html__('Date', 'heal-core'),
                    'rand'          => esc_html__('Random', 'heal-core'),
                    'comment_count' => esc_html__('Most Comments', 'heal-core'),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'image_thumb_display',
            [
                'label' => esc_html__('Show Thumbnail', 'heal-core'),
                'type'  => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );


        $this->end_controls_section();

        

        // STYLE: Section Header
        $this->start_controls_section(
            'style_section_header',
            [
                'label' => __( 'Section Header', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        

        $this->add_control(
            'sh_subtitle_color',
            [
                'label'     => __( 'Sub Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .donation-content h5' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'sh_subtitle_typo', 'selector' => '{{WRAPPER}} .donation-content h5' ]
        );
        $this->add_control(
            'sh_subtitle_margin',
            [
                'label'     => __( 'Sub Title Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .donation-content h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sh_title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .donation-content h2' => 'color: {{VALUE}};' ],
				'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'sh_title_typo', 'selector' => '{{WRAPPER}} .donation-content h2' ]
        );
        $this->add_control(
            'sh_title_margin',
            [
                'label'     => __( 'Sub Title Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .donation-content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sh_desc_color',
            [
                'label'     => __( 'Description Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .donation-content p' => 'color: {{VALUE}};' ],
				'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'sh_desc_typo', 'selector' => '{{WRAPPER}} .donation-content p' ]
        );
        $this->add_control(
            'sh_desc_margin',
            [
                'label'     => __( 'Description Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .donation-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Section Header Ending

        //  STYLE: Button 
        $this->start_controls_section(
            'style_button',
            [
                'label' => __( 'Button', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // 🔰 Alignment 
        $this->add_control(
            'btn_align',
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
                    '{{WRAPPER}} .lab-btn' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // ✍️ Typography 
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typo',
                'selector' => '{{WRAPPER}} .lab-btn',
            ]
        );

        // 🌈 Start Tabs: Normal | Hover
        $this->start_controls_tabs( 'tabs_button_style' );

            // 🟢 Normal Tab
            $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => __( 'Normal', 'heal-core' ),
                ]
            );

            $this->add_control(
                'btn_color',
                [
                    'label'     => __( 'Text Color', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lab-btn' => 'color: {{VALUE}} !important;',
                        '{{WRAPPER}} .lab-btn svg' => 'fill: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_control(
                'btn_bg',
                [
                    'label'     => __( 'Background', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lab-btn' => 'background: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'btn_border',
                    'selector' => '{{WRAPPER}} .lab-btn',
                ]
            );

            $this->add_control(
                'btn_radius',
                [
                    'label'      => __( 'Border Radius', 'heal-core' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .lab-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->add_control(
                'btn_padding',
                [
                    'label'      => __( 'Padding', 'heal-core' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .lab-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->end_controls_tab();

            // 🟡 Hover Tab
            $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => __( 'Hover', 'heal-core' ),
                ]
            );

            $this->add_control(
                'btn_color_hover',
                [
                    'label'     => __( 'Text Color', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lab-btn:hover' => 'color: {{VALUE}} !important;',
                        '{{WRAPPER}} .lab-btn:hover svg' => 'fill: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_control(
                'btn_bg_hover',
                [
                    'label'     => __( 'Background', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lab-btn:hover'   => 'background: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'btn_border_hover',
                    'selector' => '{{WRAPPER}} .lab-btn:hover',
                ]
            );

            $this->add_control(
                'btn_radius_hover',
                [
                    'label'      => __( 'Border Radius', 'heal-core' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .lab-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        // 🌈 End Tabs
        $this->end_controls_section();
        //  STYLE: Button 



        // STYLE: Card
        $this->start_controls_section(
            'style_card',
            [
                'label' => __( 'Card', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'card_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .program-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border',
                'selector' => '{{WRAPPER}} .event__item',
            ]
        );
        $this->add_control(
            'card_radius',
            [
                'label'      => __( 'Border Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .event__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'card_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .event__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'card_shadow',
                'selector' => '{{WRAPPER}} .event__item',
            ]
        );
        $this->end_controls_section();


        // STYLE: Donate Progress
        $this->start_controls_section(
            'style_dp',
            [
                'label' => __( 'Donate Progress', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'dp_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .lab-thumb-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'dp_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lab-thumb-content' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'dp_border',
                'selector' => '{{WRAPPER}} .lab-thumb-content',
            ]
        );
        $this->add_control(
            'dp_radius',
            [
                'label'      => __( 'Border Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .lab-thumb-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'dp_shadow',
                'selector' => '{{WRAPPER}} .lab-thumb-content',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'dp_amount_text_color',
            [
                'label'     => __( 'Amount Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .program-item .lab-inner .lab-thumb .lab-thumb-content .progress-item .progress-item-status li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'dp_amount_color',
            [
                'label'     => __( 'Amount Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .program-item .lab-inner .lab-thumb .lab-thumb-content .progress-item .progress-item-status li span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'dp_bar_color',
            [
                'label'     => __( 'Progress Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .program-item .lab-inner .lab-thumb .lab-thumb-content .progress-item .progress-bar-percent' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'dp_bar_bg_color',
            [
                'label'     => __( 'Progress BG Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .program-item .lab-inner .lab-thumb .lab-thumb-content .progress-item .progress-bar-wrapper .progress-bar, .hafsa .program-item .lab-inner .lab-thumb .lab-thumb-content .progress-item .progress-bar-percent, .hafsa .program-item .lab-inner .lab-thumb .lab-thumb-content .progress-item .progress-bar-percent::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'dp_bar_wap_bg_color',
            [
                'label'     => __( 'Wrapper Bar BG Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .program-item .lab-inner .lab-thumb .lab-thumb-content .progress-item .progress-bar-wrapper' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'dp_bar_height',
            [
                'label'     => __( 'Wrapper Bar Height', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hafsa .program-item .lab-inner .lab-thumb .lab-thumb-content .progress-item .progress-bar-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'dp_bar_radius',
            [
                'label'      => __( 'Border Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .hafsa .program-item .lab-inner .lab-thumb .lab-thumb-content .progress-item .progress-bar-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();




        // STYLE: Title / Meta / Text
        $this->start_controls_section(
            'style_typo',
            [
                'label' => __( 'Title', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'selector' => '{{WRAPPER}} .lab-content h5 a, {{WRAPPER}} .lab-content h5',
            ]
        );
        // 🌈 Start Tabs: Normal | Hover
        $this->start_controls_tabs( 'title_style_tabs' );
            // 🟢 Normal Tab
            $this->start_controls_tab(
                'title_tab_normal',
                [
                    'label' => __( 'Normal', 'heal-core' ),
                ]
            );
            $this->add_control(
                'title_normal_color',
                [
                    'label'     => __( 'Title Color', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .lab-content h5'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .lab-content h5 a' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'after',
                ]
            );
            $this->end_controls_tab();
            // 🟡 Hover Tab
            $this->start_controls_tab(
                'title_tab_hover',
                [
                    'label' => __( 'Hover', 'heal-core' ),
                ]
            );
            $this->add_control(
                'title_hover_color',
                [
                    'label'     => __( 'Title Color', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hafsa .program-item:hover .lab-inner .lab-content h5 a' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'after',
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        // 🌈 End Tabs

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_typo',
                'label'    => __( 'Meta/Text Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .lab-content span',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label'     => __( 'Meta/Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lab-content span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        // End


        // STYLE: Title / Meta / Text
        $this->start_controls_section(
            'style_navi',
            [
                'label' => __( 'Navigation', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'navi_typo',
                'selector' => '{{WRAPPER}} .hafsa .upcoming-programs .programs-item-part .program-desc ul li a',
            ]
        );
        // 🌈 Start Tabs: Normal | Hover
        $this->start_controls_tabs( 'navi_style_tabs' );
            // 🟢 Normal Tab
            $this->start_controls_tab(
                'navi_tab_normal',
                [
                    'label' => __( 'Normal', 'heal-core' ),
                ]
            );
            $this->add_control(
                'navi_normal_color',
                [
                    'label'     => __( 'Navigation Color', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hafsa .upcoming-programs .programs-item-part .program-desc ul li a'   => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'navi_normal_bg_color',
                [
                    'label'     => __( 'Navigation BG Color', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hafsa .upcoming-programs .programs-item-part .program-desc ul li a'   => 'background-color: {{VALUE}};',
                    ],
                    'separator' => 'after',
                ]
            );
            $this->end_controls_tab();
            // 🟡 Hover Tab
            $this->start_controls_tab(
                'navi_tab_hover',
                [
                    'label' => __( 'Hover', 'heal-core' ),
                ]
            );
            $this->add_control(
                'navi_hover_color',
                [
                    'label'     => __( 'Navigation Color', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hafsa .upcoming-programs .programs-item-part .program-desc ul li a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'navi_hover_bg_color',
                [
                    'label'     => __( 'Navigation BG Color', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hafsa .upcoming-programs .programs-item-part .program-desc ul li a:hover' => 'background-color: {{VALUE}};',
                    ],
                    'separator' => 'after',
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'navi_desc_typo',
                'selector' => '{{WRAPPER}} .hafsa .upcoming-programs .programs-item-part .program-desc p',
            ]
        );
        $this->add_control(
            'navi_desc_color',
            [
                'label'     => __( 'Navigation Description Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .upcoming-programs .programs-item-part .program-desc p'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        

       



        // ========== STYLE: Section Header ==========
        // $this->start_controls_section(
        //     'style_section_header',
        //     [
        //         'label' => __( 'Section Header', 'heal-core' ),
        //         'tab'   => Controls_Manager::TAB_STYLE,
        //         // 'condition' => [ 'style!' => 'style1' ],
        //     ]
        // );

        // $this->add_group_control(
        //     Group_Control_Typography::get_type(),
        //     [
        //         'name'     => 'sh_title_typo',
        //         'selector' => '{{WRAPPER}} .section-header h2, {{WRAPPER}} .section-header h3, {{WRAPPER}} .section-header h4',
        //     ]
        // );

        // $this->add_control(
        //     'sh_title_color',
        //     [
        //         'label'     => __( 'Title Color', 'heal-core' ),
        //         'type'      => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .section-header h2, {{WRAPPER}} .section-header h3, {{WRAPPER}} .section-header h4' => 'color: {{VALUE}} !important;',
        //         ],
        //     ]
        // );

        // $this->add_group_control(
        //     Group_Control_Typography::get_type(),
        //     [
        //         'name'     => 'sh_desc_typo',
        //         'label'    => __( 'Description Typography', 'heal-core' ),
        //         'selector' => '{{WRAPPER}} .section-header p',
        //     ]
        // );

        // $this->add_control(
        //     'sh_desc_color',
        //     [
        //         'label'     => __( 'Description Color', 'heal-core' ),
        //         'type'      => Controls_Manager::COLOR,
        //         'selectors' => [ '{{WRAPPER}} .section-header p' => 'color: {{VALUE}} !important;' ],
        //     ]
        // );

        // $this->add_control(
        //     'sh_align',
        //     [
        //         'label'     => esc_html__( 'Alignment', 'heal-core' ),
        //         'type'      => Controls_Manager::CHOOSE,
        //         'options'   => [
        //             'left'   => [ 'title' => __( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
        //             'center' => [ 'title' => __( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
        //             'right'  => [ 'title' => __( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
        //         ],
        //         'selectors' => [ '{{WRAPPER}} .section-header' => 'text-align: {{VALUE}};' ],
        //     ]
        // );

        // $this->end_controls_section();

        // ========== STYLE: Instant CSS ==========
        $this->start_controls_section(
            'inst_css_section',
            [
                'label' => __( 'Custom CSS (Per Widget)', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'enable_inst_css',
            [
                'label'        => __( 'Enable', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'description'  => __( 'Use "&" to target this widget. Example: & .event__item{box-shadow:0 10px 30px rgba(0,0,0,.06)}', 'heal-core' ),
            ]
        );

        $this->add_control(
            'inst_css',
            [
                'label'       => __( 'CSS', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'placeholder' => "& .event__right h5{letter-spacing:.3px;}",
                'condition'   => [ 'enable_inst_css' => 'yes' ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html('post');

        $root_id  = 'heal-cause-' . $this->get_id();
        $root_sel = '#' . $root_id;

        // paging
        if ( get_query_var('paged') ) {
            $paged = (int) get_query_var('paged');
        } elseif ( get_query_var('page') ) {
            $paged = (int) get_query_var('page');
        } else {
            $paged = 1;
        }

        $total     = isset($settings['total']) ? (int)$settings['total'] : -1;
        $order     = !empty($settings['order']) ? $settings['order'] : 'DESC';
        $orderby   = !empty($settings['orderby']) ? $settings['orderby'] : 'date';
        $category  = !empty($settings['category']) ? (array)$settings['category'] : [];

        $args = [
            'post_type'           => 'cause',
            'posts_per_page'      => $total,
            'order'               => $order,
            'orderby'             => $orderby,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'paged'               => $paged,
        ];

        if ( !empty( $category ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'cause-cat',
                    'field'    => 'term_id',
                    'terms'    => $category
                ]
            ];
        }

        $query = new \WP_Query($args);
        
    ?>

        <div id="<?php echo esc_attr($root_id); ?>">
            <?php if ( 'style1' === $settings['style'] ) : ?>
                <div class="event-section padding--top padding--bottom d-none" id="event">
                    <div class="container">
                        <div class="row g-4">
                            <?php if ( !empty($settings['section_title']) ) : ?>
                            <div class="col-lg-4 col-12">
                                <div class="section-header style-4">
                                    <?php if ( ! empty( $settings['section_icon'] ) ) : ?>
                                        <div class="event-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['section_icon'], [ 'aria-hidden' => 'true' ]  ); ?>
                                        </div>
                                    <?php endif; ?>

                                    <h3><?php echo wp_kses($settings['section_title'], $allowed_tags);?></h3>
                                    <?php if(!empty($settings['section_description'])) : ?>
                                        <p><?php echo wp_kses($settings['section_description'], $allowed_tags);?></p>
                                    <?php endif; ?>

                                    <div class="event_navi">
                                        <div class="event__next"><i class="fas fa-chevron-left"></i></div>
                                        <div class="event__prev"><i class="fas fa-chevron-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if ( $query->have_posts() ) : ?>
                            <div class="col-lg-8 col-12">
                                <div class="section-wrapper">
                                    <div class="event event-style2">
                                        <div class="event__slider overflow-hidden">
                                            <div class="swiper-wrapper">
                                                <?php while ( $query->have_posts() ) : $query->the_post();
                                                    $cause_single_meta_data = get_post_meta(get_the_ID(), 'heal_cause_options', true);

                                                    $currency_symbol   = $cause_single_meta_data['currency_symbol'] ?? '$';
                                                    $donation_goal     = $cause_single_meta_data['donation_goal'] ?? '0';
                                                    $donation_manually = $cause_single_meta_data['donation_manually'] ?? '0';
                                                    $donation_paypal   = $cause_single_meta_data['donation_paypal'] ?? '';
                                                    $donation_bdt      = $cause_single_meta_data['donation_bdt'] ?? '';
                                                    $donation_cp       = $cause_single_meta_data['donation_cp'] ?? '';
                                                    $donation_link     = $cause_single_meta_data['donation_link'] ?? '';

                                                    // Calculate Progress
                                                    $goal   = (int) str_replace(',', '', $donation_goal);
                                                    $raised = (int) str_replace(',', '', $donation_manually);
                                                    $percent = $goal > 0 ? ($raised / $goal) * 100 : 0;
                                                    $to_go  = $goal > $raised ? ($goal - $raised) : 0;
                                                ?>
                                                <div class="swiper-slide">
                                                    <div class="event__item">
                                                        <div class="event__inner">
                                                            <?php if ( ! empty( $settings['image_thumb_display'] ) && 'yes' === $settings['image_thumb_display'] ) : ?>
                                                                <div class="event__thumb">
                                                                    <?php the_post_thumbnail('large'); ?>
                                                                    <div class="event__bars">
                                                                        <div class="event__title">
                                                                            <p>
                                                                                <span><?php echo round($percent); ?>% <?php esc_html_e('Donated', 'heal-core'); ?></span> 
                                                                                <?php echo esc_html__('/', 'heal-core'); ?> 
                                                                                <?php echo esc_html($currency_symbol); ?><?php echo number_format($to_go); ?> 
                                                                                <?php esc_html_e('To Go', 'heal-core'); ?>
                                                                            </p>
                                                                        </div>
                                                                        <div class="donaterange__content">
                                                                            <div class="donaterange__bars">
                                                                                <div class="donaterange__bar" style="width:<?php echo round($percent); ?>%"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>

                                                            <div class="event__content">
                                                                <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                                                                <p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_content() ), 12, '…' ) ); ?></p>

                                                                <a href="<?php the_permalink(); ?>" class="default-btn move-right"><span><?php echo esc_html($settings['button']); ?></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endwhile; wp_reset_postdata(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                                <div class="col-12"><p><?php esc_html_e('No Causes found.', 'heal-core'); ?></p></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="hafsa">
                    <div class="upcoming-programs">
                        <div class="container">
                            <div class="row">
                                <?php if ( !empty($settings['section_title']) ) : ?>
                                    <div class="col-xl-4">
                                        <div class="donation-part bg-img">
                                            <div class="donation-content">
                                                <h5><?php echo esc_html($settings['section_subtitle']); ?></h5>
                                                <h2><?php echo wp_kses($settings['section_title'], $allowed_tags);?></h2>

                                                <?php if(!empty($settings['section_description'])) : ?>
                                                    <p><?php echo wp_kses($settings['section_description'], $allowed_tags);?></p>
                                                <?php endif; ?>

                                                <?php if ( ! empty( $settings['block_button'] ) && ! empty( $settings['block_button_link']['url'] ) ) : ?>
                                                    <a href="<?php echo esc_url( $settings['block_button_link']['url'] ); ?>"
                                                    class="lab-btn"
                                                    <?php echo ! empty( $settings['block_button_link']['is_external'] ) ? 'target="_blank" rel="noopener"' : ''; ?>>
                                                        <?php echo wp_kses( $settings['block_button'], $allowed_tags ); ?> <?php \Elementor\Icons_Manager::render_icon( $settings['section_icon'], [ 'aria-hidden' => 'true' ]  ); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="col-xl-8">
                                    <div class="programs-item-part">
                                        <?php if(!empty( $settings['top_desc'])) : ?>
                                            <div class="program-desc d-flex justify-content-between">
                                                <p><?php echo esc_html($settings['top_desc']); ?></p>

                                                <?php if ( ! empty( $settings['navi_switch'] ) && 'yes' === $settings['navi_switch'] ) : ?>
                                                    <ul class="lab-ul">
                                                        <li><a href="#0" class="program-next"><i class="fa-solid fa-angle-left"></i></a></li>
                                                        <li><a href="#0" class="program-prev"><i class="fa-solid fa-angle-right"></i></a></li>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( $query->have_posts() ) : ?>
                                            <div class="program-item-container">
                                                <div class="program-item-wrapper">
                                                    <div class="swiper-wrapper">
                                                        <?php while ( $query->have_posts() ) : $query->the_post();
                                                            $cause_single_meta_data = get_post_meta(get_the_ID(), 'heal_cause_options', true);

                                                            $currency_symbol   = $cause_single_meta_data['currency_symbol'] ?? '$';
                                                            $donation_goal     = $cause_single_meta_data['donation_goal'] ?? '0';
                                                            $donation_manually = $cause_single_meta_data['donation_manually'] ?? '0';
                                                            $donation_paypal   = $cause_single_meta_data['donation_paypal'] ?? '';
                                                            $donation_bdt      = $cause_single_meta_data['donation_bdt'] ?? '';
                                                            $donation_cp       = $cause_single_meta_data['donation_cp'] ?? '';
                                                            $donation_link     = $cause_single_meta_data['donation_link'] ?? '';

                                                            // Calculate Progress
                                                            $goal   = (int) str_replace(',', '', $donation_goal);
                                                            $raised = (int) str_replace(',', '', $donation_manually);
                                                            $percent = $goal > 0 ? ($raised / $goal) * 100 : 0;
                                                            $to_go  = $goal > $raised ? ($goal - $raised) : 0;
                                                        ?>
                                                        <div class="swiper-slide">
                                                            <div class="program-item">
                                                                <div class="lab-inner">
                                                                    <?php if ( ! empty( $settings['image_thumb_display'] ) && 'yes' === $settings['image_thumb_display'] ) : ?>
                                                                    <div class="lab-thumb">
                                                                        <?php the_post_thumbnail('large'); ?>
                                                                        <div class="lab-thumb-content">
                                                                            <div class="progress-item">
                                                                                <ul
                                                                                    class="progress-item-status lab-ul d-flex justify-content-between mb-2">
                                                                                    <li><?php echo esc_html__('Raised', 'heal-core'); ?><span> <?php echo esc_html($currency_symbol); ?><?php echo esc_html($raised); ?></span></li>
                                                                                    <li><?php echo esc_html__('Gold', 'heal-core'); ?><span> <?php echo esc_html($currency_symbol); ?><?php echo esc_html($goal); ?></span></li>
                                                                                </ul>
                                                                                <div class="progress-bar-wrapper progress"
                                                                                    data-percent="<?php echo round($percent); ?><?php echo esc_attr__('%', 'heal-core'); ?>">
                                                                                    <div
                                                                                        class="progress-bar progress-bar-striped progress-bar-animated">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="progress-bar-percent d-flex align-items-center justify-content-center"> 
                                                                                    <?php echo round($percent); ?> <sup><?php echo esc_html__('%', 'heal-core'); ?></sup>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>

                                                                    <div class="lab-content">
                                                                        <?php 
                                                                            $terms = get_the_terms( get_the_ID(), 'cause-cat' ); 
                                                                            if ( !empty($terms) && !is_wp_error($terms) ) {
                                                                                $cats = [];
                                                                                foreach ( $terms as $term ) {
                                                                                    $cats[] = esc_html( $term->name );
                                                                                }
                                                                                echo '<span>' . implode(', ', $cats) . '</span>';
                                                                            }
                                                                        ?>
                                                                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endwhile; wp_reset_postdata(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-12"><p><?php esc_html_e('No Causes found.', 'heal-core'); ?></p></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    (function($){
                        // $(window).scroll(function() {
                        //     var hT = $('.donaterange__content').offset().top,
                        //         hH = $('.donaterange__content').outerHeight(),
                        //         wH = $(window).height(),
                        //         wS = $(this).scrollTop();
                        //     if (wS > (hT+hH-1.4*wH)){
                        //         jQuery(document).ready(function(){
                        //             jQuery('.donaterange__bars').each(function(){
                        //                 jQuery(this).find('.donaterange__bar').animate({
                        //                     width:jQuery(this).attr('data-percent')
                        //                 }, 5000); // 5 seconds
                        //             });
                        //         });
                        //     }
                        // });

                        
                    })(jQuery);
                </script>

            <?php elseif ( 'style2' === $settings['style'] ) : ?>

            <?php endif; ?>

            <?php
            // Instant CSS
            if ( !empty($settings['enable_inst_css']) && 'yes' === $settings['enable_inst_css'] && !empty($settings['inst_css']) ) {
                $scoped = str_replace('&', $root_sel, $settings['inst_css']);
                echo '<style id="'.esc_attr($root_id).'-inst-css">'.$scoped.'</style>';
            }
            ?>
        </div>


        

        <?php
    }
}

// Elementor register (legacy/new)
if ( method_exists( Plugin::instance()->widgets_manager, 'register_widget_type' ) ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Theme_Religion_Cause() );
} else {
    Plugin::instance()->widgets_manager->register( new Theme_Religion_Cause() );
}
