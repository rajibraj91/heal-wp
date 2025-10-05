<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package heal
 * @since 1.0.0
 */
class Theme_Donate extends Widget_Base {

    public function get_name() { return 'donate-widget'; }
    public function get_title() { return esc_html__( 'Donate', 'heal-core' ); }
    public function get_icon() { return 'theme-icon'; }
    public function get_categories() { return ['heal_charity']; }

    protected function register_controls() {

        // ========== BASIC ==========
        $this->start_controls_section(
            'theme_donate',
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
            'section_title',
            [
                'label'       => esc_html__( 'Section Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter title text', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label'       => esc_html__( 'Description', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter description', 'heal-core' ),
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

        $this->add_control(
            'donate_tile',
            [
                'label'       => esc_html__( 'Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'We Are Very Thankful',
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter title', 'heal-core' ),
            ]
        );

        $this->add_control(
            'donate_sub_title',
            [
                'label'       => esc_html__( 'Sub Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter sub title', 'heal-core' ),
                'label_block' => true,
            ]
        );

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

        $this->add_control(
            'donate_amount_after_text',
            [
                'label'       => esc_html__( 'Amount After Text', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'so far!',
                'label_block' => true,
                'placeholder' => esc_html__( 'so far!', 'heal-core' ),
            ]
        );

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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sh_title_typo',
                'selector' => '{{WRAPPER}} .section-header h2, {{WRAPPER}} .section-header h3, {{WRAPPER}} .section-header h4',
            ]
        );

        $this->add_control(
            'sh_title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-header h2' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .section-header h3' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .section-header h4' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sh_desc_typo',
                'label'    => __( 'Description Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .section-header p',
            ]
        );

        $this->add_control(
            'sh_desc_color',
            [
                'label'     => __( 'Description Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header p' => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'sh_align',
            [
                'label'     => esc_html__( 'Alignment', 'heal-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [ 'title' => __( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
                    'center' => [ 'title' => __( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
                    'right'  => [ 'title' => __( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [ '{{WRAPPER}} .section-header' => 'text-align: {{VALUE}};' ],
            ]
        );

        $this->end_controls_section();

        // ========== STYLE: Donate Texts ==========
        $this->start_controls_section(
            'style_donate_texts',
            [
                'label' => __( 'Texts (Title / Sub / Amount)', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'don_title_typo',
                'label'    => __( 'Title Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .donaterange__content h3, {{WRAPPER}} .donaterange__content h4,
                               {{WRAPPER}} .donate2__content h3, {{WRAPPER}} .donate2__content h4',
            ]
        );

        $this->add_control(
            'don_title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .donaterange__content h3' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .donaterange__content h4' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .donate2__content h3'     => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .donate2__content h4'     => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        // Sub Title
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'don_sub_typo',
                'label'    => __( 'Sub Title Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .donaterange__content h3 + h3,
                               {{WRAPPER}} .donate2__content .donate2__subtitle',
            ]
        );

        $this->add_control(
            'don_sub_color',
            [
                'label'     => __( 'Sub Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .donaterange__content h3 + h3'          => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .donate2__content .donate2__subtitle'   => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        // Amount
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'don_amount_typo',
                'label'    => __( 'Amount Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .donaterange__content .donate-amount,
                               {{WRAPPER}} .donate2__content .donate-amount',
            ]
        );

        $this->add_control(
            'don_amount_color',
            [
                'label'     => __( 'Amount Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .donaterange__content .donate-amount' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .donate2__content .donate-amount'     => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== STYLE: Progress Bar ==========
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
                    '{{WRAPPER}} .donaterange__bars' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .donate2__bar-wrap' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bar_fill_color',
            [
                'label'     => __( 'Fill Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .donaterange__bar' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .donate2__bar'     => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .donaterange__bars' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .donaterange__bar'  => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .donate2__bar-wrap' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .donate2__bar'      => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .donaterange__bars, {{WRAPPER}} .donaterange__bar' =>
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .donate2__bar-wrap, {{WRAPPER}} .donate2__bar' =>
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'percent_typo',
                'label'     => __( 'Percent Typography', 'heal-core' ),
                'selector'  => '{{WRAPPER}} .donaterange__percent, {{WRAPPER}} .donate2__percent',
                'condition' => [ 'show_percent_text' => 'yes' ],
            ]
        );

        $this->add_control(
            'percent_color',
            [
                'label'     => __( 'Percent Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .donaterange__percent' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .donate2__percent'     => 'color: {{VALUE}};',
                ],
                'condition' => [ 'show_percent_text' => 'yes' ],
            ]
        );

        $this->end_controls_section();

        // ========== STYLE: Button ==========
        $this->start_controls_section(
            'style_button',
            [
                'label' => __( 'Button', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_align',
            [
                'label'     => esc_html__( 'Alignment', 'heal-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [ 'title' => __( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
                    'center' => [ 'title' => __( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
                    'right'  => [ 'title' => __( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .donate-btn-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typo',
                'selector' => '{{WRAPPER}} .default-btn',
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .default-btn' => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'btn_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .default-btn' => 'background: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'btn_color_hover',
            [
                'label'     => __( 'Hover Text', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .default-btn:hover' => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'btn_bg_hover',
            [
                'label'     => __( 'Hover Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .default-btn:hover'   => 'background: {{VALUE}} !important;',
                    '{{WRAPPER}} .default-btn::before' => 'background: {{VALUE}} !important;',
                    '{{WRAPPER}} .default-btn::after'  => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'selector' => '{{WRAPPER}} .default-btn',
            ]
        );

        $this->add_control(
            'btn_radius',
            [
                'label'      => __( 'Border Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .default-btn' =>
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .default-btn' =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

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
                'label_on'     => __( 'On', 'heal-core' ),
                'label_off'    => __( 'Off', 'heal-core' ),
                'return_value' => 'yes',
                'default'      => '',
                'description'  => __( 'Use "&" to target this widget. Example: & .donaterange__item{box-shadow:0 10px 30px rgba(0,0,0,.06)}', 'heal-core' ),
            ]
        );

        $this->add_control(
            'inst_css',
            [
                'label'       => __( 'CSS', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'placeholder' => "& .donaterange__bar{transition:width .6s ease;}",
                'condition'   => [ 'enable_inst_css' => 'yes' ],
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

        // animation duration
        $anim = isset($settings['bar_anim_duration']['size']) ? (int)$settings['bar_anim_duration']['size'] : 2000;

        ?>
        <div id="<?php echo esc_attr( $root_id ); ?>">
            <?php if ( 'style1' === $settings['style'] ) : ?>
                <div class="donate-range-section padding--top padding--bottom bg-img">
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

                        <div class="section-wrapper">
                            <div class="donaterange">
                                <div class="donaterange__content">

                                    <?php if ( ! empty( $settings['donate_tile'] ) ) : ?>
                                        <h4 class="mb-2"><?php echo wp_kses( $settings['donate_tile'], $allowed_tags ); ?></h4>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $settings['donate_sub_title'] ) ) : ?>
                                        <h3 class="donate-amount-sub mb-2"><?php echo wp_kses( $settings['donate_sub_title'], $allowed_tags ); ?></h3>
                                    <?php endif; ?>

                                    <?php if ( '' !== $amount_val ) : ?>
                                        <h3 class="donate-amount mb-3">
                                            <span><?php echo esc_html__( '$', 'heal-core' ); ?><?php echo esc_html( $amount_val ); ?></span>
                                            <?php if ( ! empty( $settings['donate_amount_after_text'] ) ) : ?>
                                                <?php echo ' ' . wp_kses( $settings['donate_amount_after_text'], $allowed_tags ); ?>
                                            <?php endif; ?>
                                        </h3>
                                    <?php endif; ?>

                                    <div class="donaterange__bars" data-percent="<?php echo esc_attr( $p ); ?>" data-duration="<?php echo esc_attr( $anim ); ?>">
                                        <div class="donaterange__bar js-bar" style="width:0;"></div>
                                    </div>

                                    <?php if ( ! empty( $settings['show_percent_text'] ) && 'yes' === $settings['show_percent_text'] ) : ?>
                                        <div class="donaterange__percent mt-2"><?php echo esc_html( round($p) ); ?>%</div>
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
                </div>

            <?php elseif ( 'style2' === $settings['style'] ) : ?>
                <div class="donate2-section padding--top padding--bottom bg-img">
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

            // animate width from 0 to data-percent
            function animateBar(barWrap){
                var bar = barWrap.querySelector('.js-bar');
                if(!bar) return;
                var pct = parseFloat(barWrap.getAttribute('data-percent') || '0');
                if(isNaN(pct)) pct = 0;
                pct = Math.max(0, Math.min(100, pct));

                var dur = parseInt(barWrap.getAttribute('data-duration') || '2000', 10);
                var start = null;

                function step(ts){
                    if(!start) start = ts;
                    var p = Math.min(1, (ts - start) / dur);
                    var w = (pct * p).toFixed(2);
                    bar.style.width = w + '%';
                    if(p < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }

            // Observe once
            function onVisible(el, fn){
                if('IntersectionObserver' in window){
                    var io = new IntersectionObserver(function(entries, obs){
                        entries.forEach(function(en){
                            if(en.isIntersecting){
                                fn();
                                obs.unobserve(en.target);
                            }
                        });
                    }, {threshold: 0.35});
                    io.observe(el);
                } else {
                    // fallback: run immediately
                    fn();
                }
            }

            var wraps = root.querySelectorAll('.donaterange__bars, .donate2__bar-wrap');
            wraps.forEach(function(w){ onVisible(w, function(){ animateBar(w); }); });
        })();
        </script>
        <?php
    }
}

// Elementor: register (new & legacy)
if ( method_exists( Plugin::instance()->widgets_manager, 'register_widget_type' ) ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Theme_Donate() );
} else {
    Plugin::instance()->widgets_manager->register( new Theme_Donate() );
}
