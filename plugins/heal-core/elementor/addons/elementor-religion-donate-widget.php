<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package heal
 * @since 1.0.0
 */
class Theme_Religion_Donate extends Widget_Base {

    public function get_name() { return 'hafsa-donate-widget'; }
    public function get_title() { return esc_html__( 'Donate', 'heal-core' ); }
    public function get_icon() { return 'theme-icon'; }
    public function get_categories() { return ['heal_religion']; }

    protected function register_controls() {

        // ========== BASIC ==========
        $this->start_controls_section(
            'theme_religion_donate',
            [ 'label' => esc_html__( 'Donate Style', 'heal-core' ) ]
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
        $this->end_controls_section();

        // ========== SECTION HEADER (optional heading/desc above block) ==========
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
                'placeholder' => esc_html__( 'Enter Sub Title', 'heal-core' ),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'section_title',
            [
                'label'       => esc_html__( 'Section Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter title text', 'heal-core' ),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        // ========== CONTENT ==========
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Block', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // $this->add_control(
        //     'donate_tile',
        //     [
        //         'label'       => esc_html__( 'Title', 'heal-core' ),
        //         'type'        => Controls_Manager::TEXT,
        //         'default'     => 'We Are Very Thankful',
        //         'label_block' => true,
        //         'placeholder' => esc_html__( 'Enter title', 'heal-core' ),
        //     ]
        // );

        // $this->add_control(
        //     'donate_sub_title',
        //     [
        //         'label'       => esc_html__( 'Sub Title', 'heal-core' ),
        //         'type'        => Controls_Manager::TEXTAREA,
        //         'placeholder' => esc_html__( 'Enter sub title', 'heal-core' ),
        //         'label_block' => true,
        //     ]
        // );

        // Percent as slider (0-100)
        $this->add_control(
            'donate_percent',
            [
                'label'   => esc_html__( 'Donate Percent', 'heal-core' ),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
                'default' => [ 'size' => 60 ],
            ]
        );

        $this->add_control(
            'donate_amount',
            [
                'label'       => esc_html__( 'Donate Amount', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '10000', 'heal-core' ),
                'description' => esc_html__( 'Numbers only (prefix $ auto)', 'heal-core' ),
            ]
        );

        // $this->add_control(
        //     'donate_amount_after_text',
        //     [
        //         'label'       => esc_html__( 'Amount After Text', 'heal-core' ),
        //         'type'        => Controls_Manager::TEXT,
        //         'default'     => 'so far!',
        //         'label_block' => true,
        //         'placeholder' => esc_html__( 'so far!', 'heal-core' ),
        //     ]
        // );

        $this->add_control(
            'donate_button_text',
            [
                'label'       => esc_html__( 'Button Text', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Donate Now', 'heal-core' ),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'donate_button_icon',
            [
                'label'       => esc_html__( 'Icon', 'heal-core' ),
                'type'        => Controls_Manager::ICONS,
                'placeholder' => esc_html__( 'Choose Your Icon', 'heal-core' ),
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-rocket',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'donate_button_url',
            [
                'label'         => esc_html__( 'Button URL', 'heal-core' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'heal-core' ),
                'show_external' => true,
                'default'       => [ 'url' => '#', 'is_external' => false, 'nofollow' => true ],
                'label_block'   => true,
            ]
        );

        $this->end_controls_section();

        // ========== STYLE: Section Header ==========
        $this->start_controls_section(
            'style_section_header',
            [
                'label' => __( 'Section Header', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'sh_align',
            [
                'label'     => esc_html__( 'Header Content Alignment', 'heal-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [ 'title' => __( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
                    'center' => [ 'title' => __( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
                    'right'  => [ 'title' => __( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [ '{{WRAPPER}} .header-title' => 'text-align: {{VALUE}};' ],
            ]
        );
        $this->add_control( 'sh_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
            'separator' => 'after',
			'selectors'  => [ '{{WRAPPER}} .hafsa .program-section .header-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sh_title_typo',
                'selector' => '{{WRAPPER}} .header-title h2',
            ]
        );

        $this->add_control(
            'sh_title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
				'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .header-title h2' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control( 'sh_title_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .header-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sh_subtitle_typo',
                'label'    => __( 'Sub Title Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .header-title h5',
            ]
        );

        $this->add_control(
            'sh_desc_color',
            [
                'label'     => __( 'Sub Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .header-title h5' => 'color: {{VALUE}} !important;' ],
            ]
        );
        
        $this->add_control( 'sh_subtitle_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
            'separator' => 'after',
			'selectors'  => [ '{{WRAPPER}} .header-title h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

        $this->end_controls_section();

        // ========== STYLE: Donate Texts ==========
        $this->start_controls_section(
            'style_donate_texts',
            [
                'label' => __( 'Texts', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'don_text_typo',
                'label'    => __( 'Text Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .hafsa .program-section .progress-item .progress-item-status li',
            ]
        );

        $this->add_control(
            'don_text_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .program-section .progress-item .progress-item-status li' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control( 'don_text_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
            'separator' => 'after',
			'selectors'  => [ '{{WRAPPER}} .hafsa .program-section .progress-item .progress-item-status li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

        

        // Amount
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'don_amount_typo',
                'label'    => __( 'Amount Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .hafsa .program-section .progress-item .progress-item-status li span',
            ]
        );
        $this->add_control(
            'don_amount_color',
            [
                'label'     => __( 'Amount Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .program-section .progress-item .progress-item-status li span' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->end_controls_section();

        //  Progress Bar 
        $this->start_controls_section(
            'style_progress',
            [
                'label'     => __( 'Progress Bar', 'heal-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bar_track_color',
            [
                'label'     => __( 'Track Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .progress-item .progress-bar-wrapper .progress-bar' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bar_height',
            [
                'label'     => __( 'Height', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 2, 'max' => 40 ] ],
                'default'   => [ 'size' => 10 ],
                'selectors' => [
                    '{{WRAPPER}} .hafsa .program-section .progress-item .progress-bar-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bar_radius',
            [
                'label'      => __( 'Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .hafsa .program-section .progress-item .progress-bar-wrapper, .hafsa .program-section .progress-item .progress-bar-wrapper .progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bar_anim_duration',
            [
                'label'   => __( 'Animation Duration (ms)', 'heal-core' ),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [ 'px' => [ 'min' => 200, 'max' => 6000, 'step' => 100 ] ],
                'default' => [ 'size' => 2000 ],
            ]
        );

        $this->add_control(
            'show_percent_text',
            [
                'label'        => __( 'Show Percent Text', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );


        $this->add_control(
            'percent_color',
            [
                'label'     => __( 'Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .progress-item .progress-bar-percent' => 'color: {{VALUE}};',
                    // '{{WRAPPER}} .donate2__percent'     => 'color: {{VALUE}};',
                ],
                'condition' => [ 'show_percent_text' => 'yes' ],
            ]
        );
        $this->add_control(
            'percent_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .hafsa .progress-item .progress-bar-percent, .hafsa .progress-item .progress-bar-percent::after' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->end_controls_section();

        // Button 
        $this->start_controls_section(
            'style_button',
            [
                'label' => __( 'Button', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Padding
        $this->add_control(
            'btn_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .lab-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typography',
                'selector' => '{{WRAPPER}} .lab-btn',
            ]
        );

        // Normal & Hover Tabs
        $this->start_controls_tabs( 'btn_style_tabs' );

        // ▶ Normal Tab
        $this->start_controls_tab(
            'btn_tab_normal',
            [
                'label' => __( 'Normal', 'heal-core' ),
            ]
        );

        // Text Color
        $this->add_control(
            'btn_text_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lab-btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .lab-btn svg ' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Background
        $this->add_control(
            'btn_background_color',
            [
                'label'     => __( 'Background Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lab-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab(); // end normal

        // ▶ Hover Tab
        $this->start_controls_tab(
            'btn_tab_hover',
            [
                'label' => __( 'Hover', 'heal-core' ),
            ]
        );

        // Hover Text Color
        $this->add_control(
            'btn_text_hover_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lab-btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .lab-btn:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Hover Background
        $this->add_control(
            'btn_background_hover_color',
            [
                'label'     => __( 'Background Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lab-btn:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .lab-btn::before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .lab-btn::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab(); // end hover

        $this->end_controls_tabs(); // end tabs

        // Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'separator' => 'after',
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .lab-btn',
            ]
        );

        // Border Radius
        $this->add_control(
            'btn_border_radius',
            [
                'label'      => __( 'Border Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .lab-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Optional: Box Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_box_shadow',
                'selector' => '{{WRAPPER}} .lab-btn',
            ]
        );

        $this->end_controls_section();

        // Custom CSS ==========
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
        $settings     = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html( 'post' );

        // root id for scoping
        $root_id  = 'heal-donate-' . $this->get_id();
        $root_sel = '#' . $root_id;

        // percent (0..100)
        $p = isset($settings['donate_percent']['size']) ? floatval($settings['donate_percent']['size']) : 0;
        if ( $p < 0 )   $p = 0;
        if ( $p > 100 ) $p = 100;

        // amount numeric (display with $)
        $amount_raw = isset($settings['donate_amount']) ? preg_replace('/[^\d\.]/', '', (string)$settings['donate_amount']) : '';
        $amount_val = $amount_raw === '' ? '' : number_format_i18n( (float)$amount_raw );

        // Raised Amount 
        $raised = $p > 0 ? ($p / 100) * (float) $amount_raw : 0;
        $raised_val = number_format_i18n($raised);

        // animation duration
        $anim = isset($settings['bar_anim_duration']['size']) ? (int)$settings['bar_anim_duration']['size'] : 2000;

        ?>
        <div id="<?php echo esc_attr( $root_id ); ?>">
            <?php if ( 'style1' === $settings['style'] ) : ?>
                <div class="hafsa">
                    <div class="program-section padding-tb">
                        <div class="container">
                            <div class="row">
                                <?php if ( ! empty( $settings['section_title'] ) ) : ?>
                                    <div class="col-12">
                                        <div class="header-title">
                                            <?php if ( ! empty( $settings['section_subtitle'] ) ) : ?>
                                                <h5><?php echo wp_kses( $settings['section_subtitle'], $allowed_tags ); ?></h5>
                                            <?php endif; ?>

                                            <h2 class="mb-4"><?php echo wp_kses( $settings['section_title'], $allowed_tags ); ?></h2>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="col-12">
                                    <div class="progress-item-wrapper text-center">
                                        <div class="progress-item mb-4">
                                            <div class="progress-bar-wrapper progress" data-percent="<?php echo esc_attr( $p ); ?>%">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated"></div>
                                            </div>

                                            <?php if ( ! empty( $settings['show_percent_text'] ) && 'yes' === $settings['show_percent_text'] ) : ?>
                                                <div class="progress-bar-percent d-flex align-items-center justify-content-center">
                                                    <?php
                                                        $duration = isset( $settings['bar_anim_duration']['size'] ) ? (int) $settings['bar_anim_duration']['size'] : 2000;
                                                    ?>
                                                    <span class="counter__number d-inline-block"
                                                        data-target="<?php echo esc_attr( $p ); ?>"
                                                        data-duration="<?php echo esc_attr( $duration ); ?>">
                                                        <?php echo esc_attr( $p ); ?>
                                                    </span>
                                                    <sup><?php echo esc_html__('%', 'heal-core'); ?></sup> 
                                                </div>
                                            <?php endif; ?>

                                            <ul class="progress-item-status lab-ul d-flex justify-content-between">
                                                <li><?php echo esc_html__( 'Raised', 'heal-core' ); ?><span> <?php echo esc_html__( '$', 'heal-core' ); ?><?php echo esc_html__( $raised_val ); ?></span></li>
                                                <li><?php echo esc_html__( 'Gold', 'heal-core' ); ?><span> <?php echo esc_html__( '$', 'heal-core' ); ?><?php echo esc_html__( $amount_val ); ?></span></li>
                                            </ul>
                                        </div>

                                        <?php if ( ! empty( $settings['donate_button_url']['url'] ) ) : ?>
                                            <a href="<?php echo esc_url( $settings['donate_button_url']['url'] ); ?>" 
                                                class="lab-btn" 
                                                <?php echo ! empty( $settings['donate_button_url']['is_external'] ) ? 'target="_blank" rel="noopener"' : ''; ?>>
                                                
                                                <?php echo esc_html( $settings['donate_button_text'] ); ?>
                                                
                                                <?php 
                                                if ( ! empty( $settings['donate_button_icon'] ) ) {
                                                    \Elementor\Icons_Manager::render_icon( $settings['donate_button_icon'], [ 'aria-hidden' => 'true' ] );
                                                }
                                                ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            <?php elseif ( 'style2' === $settings['style'] ) : ?>
                <div class="donate2-section padding--top padding--bottom bg-img d-none">
                    <div class="container">

                        <?php if ( ! empty( $settings['section_title'] ) || ! empty( $settings['section_description'] ) ) : ?>
                            <div class="section-header style-3">
                                <?php if ( ! empty( $settings['section_title'] ) ) : ?>
                                    <h4><?php echo wp_kses( $settings['section_title'], $allowed_tags ); ?></h4>
                                <?php endif; ?>
                                <?php if ( ! empty( $settings['section_description'] ) ) : ?>
                                    <p><?php echo wp_kses( $settings['section_description'], $allowed_tags ); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="donate2">
                            <div class="donate2__content">

                                <?php if ( ! empty( $settings['donate_tile'] ) ) : ?>
                                    <h4 class="mb-2"><?php echo wp_kses( $settings['donate_tile'], $allowed_tags ); ?></h4>
                                <?php endif; ?>

                                <?php if ( ! empty( $settings['donate_sub_title'] ) ) : ?>
                                    <div class="donate2__subtitle mb-2"><?php echo wp_kses( $settings['donate_sub_title'], $allowed_tags ); ?></div>
                                <?php endif; ?>

                                <?php if ( '' !== $amount_val ) : ?>
                                    <div class="donate-amount mb-3">
                                        <span><?php echo esc_html__( '$', 'heal-core' ); ?><?php echo esc_html( $amount_val ); ?></span>
                                        <?php if ( ! empty( $settings['donate_amount_after_text'] ) ) : ?>
                                            <?php echo ' ' . wp_kses( $settings['donate_amount_after_text'], $allowed_tags ); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="donate2__bar-wrap" data-percent="<?php echo esc_attr( $p ); ?>" data-duration="<?php echo esc_attr( $anim ); ?>">
                                    <div class="donate2__bar js-bar" style="width:0;"></div>
                                </div>

                                <?php if ( ! empty( $settings['show_percent_text'] ) && 'yes' === $settings['show_percent_text'] ) : ?>
                                    <div class="donate2__percent mt-2"><?php echo esc_html( round($p) ); ?>%</div>
                                <?php endif; ?>

                                <?php if ( ! empty( $settings['donate_button_text'] ) && ! empty( $settings['donate_button_url']['url'] ) ) : ?>
                                    <div class="donate-btn-wrap mt-3">
                                        <a class="default-btn move-right"
                                           href="<?php echo esc_url( $settings['donate_button_url']['url'] ); ?>"
                                           <?php echo ! empty( $settings['donate_button_url']['is_external'] ) ? 'target="_blank" rel="noopener"' : ''; ?>>
                                            <span><?php echo esc_html( $settings['donate_button_text'] ); ?> <i class="fas fa-heart"></i></span>
                                        </a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php
                // Instant CSS
                if ( ! empty( $settings['enable_inst_css'] ) && 'yes' === $settings['enable_inst_css'] && ! empty( $settings['inst_css'] ) ) {
                    $scoped_css = str_replace( '&', $root_sel, $settings['inst_css'] );
                    echo '<style id="' . esc_attr( $root_id ) . '-inst-css">' . $scoped_css . '</style>';
                }
            ?>
        </div>

        <script>
            (function(){
                var root = document.getElementById('<?php echo esc_js( $root_id ); ?>');
                if(!root) return;

                function animate(el){
                    var target = parseFloat(el.getAttribute('data-target') || '0');
                    var dur    = parseInt(el.getAttribute('data-duration') || '1500', 10);
                    var start  = 0;
                    var t0     = null;

                    function step(ts){
                        if(!t0) t0 = ts;
                        var p = Math.min(1, (ts - t0)/dur);
                        var val = Math.floor(start + (target - start) * p);
                        el.textContent = val.toLocaleString();
                        if(p < 1) requestAnimationFrame(step);
                    }
                    requestAnimationFrame(step);
                }

                var observer = ('IntersectionObserver' in window) ? new IntersectionObserver(function(entries, obs){
                    entries.forEach(function(entry){
                        if(entry.isIntersecting){
                            var el = entry.target;
                            if(!el.__done){
                                animate(el);
                                el.__done = true;
                            }
                            obs.unobserve(el);
                        }
                    });
                }, { threshold: 0.35 }) : null;

                var nodes = root.querySelectorAll('.counter__number[data-target]');
                if(observer){
                    nodes.forEach(function(n){ observer.observe(n); });
                } else {
                    nodes.forEach(function(n){ animate(n); });
                }
            })();
        </script>

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

// Elementor: register (new & legacy)
if ( method_exists( Plugin::instance()->widgets_manager, 'register_widget_type' ) ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Theme_Religion_Donate() );
} else {
    Plugin::instance()->widgets_manager->register( new Theme_Religion_Donate() );
}
