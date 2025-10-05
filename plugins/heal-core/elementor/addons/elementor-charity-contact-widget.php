<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package heal
 * @since 1.0.0
 */

class Theme_Contact extends Widget_Base {

    public function get_name() {
        return 'contact-widget';
    }

    public function get_title() {
        return esc_html__( 'Contact', 'heal-core' );
    }

    public function get_icon() {
        return 'theme-icon';
    }

    public function get_categories() {
        return [ 'heal_charity' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'theme_contact',
            [ 'label' => esc_html__( 'Contact Style', 'heal-core' ) ]
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

        // ========== CONTENT: Section Header ==========
        $this->start_controls_section(
            'section_heading',
            [
                'label' => __( 'Section Header', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => 'style2',
				],
            ]
        );
        $this->add_control(
            'section_switch',
            [
                'label'        => esc_html__( 'Section Switcher', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => esc_html__( 'Yes', 'heal-core' ),
                'label_off'    => esc_html__( 'No', 'heal-core' ),
                'separator'    => 'before',
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
                'condition'   => [ 'section_switch' => 'yes' ],
            ]
        );
        $this->add_control(
            'section_description',
            [
                'label'       => esc_html__( 'Description', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => esc_html__( 'Enter description', 'heal-core' ),
                'label_block' => true,
                'condition'   => [ 'section_switch' => 'yes' ],
            ]
        );
        $this->end_controls_section();

        /* ---------------- Contact Form ---------------- */
        $this->start_controls_section(
            'contact_form_part',
            [
                'label' => __( 'Contact Form', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'contact_title',
            [
                'label'       => esc_html__( 'Contact Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'default'     => '',
                'placeholder' => esc_html__( 'Enter title text', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'contact_shortcode',
            [
                'label'       => esc_html__( 'Contact Shortcode', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [ 'active' => true ],
                'default'     => '',
                'placeholder' => esc_html__( 'e.g. [contact-form-7 id="123"]', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        /* ---------------- Contact Info ---------------- */
        $this->start_controls_section(
            'contact_info_part',
            [
                'label' => __( 'Contact Info', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'contact_info_title',
            [
                'label'       => esc_html__( 'Info Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'default'     => '',
                'placeholder' => esc_html__( 'Enter title text', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'contact_info_desc',
            [
                'label'       => esc_html__( 'Info Description', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [ 'active' => true ],
                'default'     => '',
                'placeholder' => esc_html__( 'Enter Info Description', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'into_text',
            [
                'label'       => esc_html__( 'Info Text', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => esc_html__( 'Info Text', 'heal-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'info_icon',
            [
                'label' => esc_html__( 'Icon', 'heal-core' ),
                'type'  => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'info_items',
            [
                'label'       => esc_html__( 'Info List', 'heal-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{ into_text }}',
            ]
        );

        $this->end_controls_section();

        /* ---------------- STYLE: Form Title ---------------- */
        $this->start_controls_section(
            'style_section_header',
            [
                'label'     => __( 'Section Header', 'heal-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [ 'section_switch' => 'yes' ],
            ]
        );
        $this->add_control(
            'section_title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header h2' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'section_title_typo', 'selector' => '{{WRAPPER}} .section-header h2' ]
        );
        $this->add_control(
            'section_desc_color',
            [
                'label'     => __( 'Description Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header p' => 'color: {{VALUE}};' ],
            ]
        );
        $this->end_controls_section();

        // Form Style
        $this->start_controls_section(
            'style_form_title',
            [
                'label' => __( 'Form Title', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'form_title_typo',
                'label'    => __( 'Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .contact__form h4',
            ]
        );

        $this->add_control(
            'form_title_color',
            [
                'label'     => __( 'Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact__form h4' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'form_title_align',
            [
                'label'     => esc_html__( 'Alignment', 'heal-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [ 'title' => __( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
                    'center' => [ 'title' => __( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
                    'right'  => [ 'title' => __( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact__form h4' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'form_title_margin',
            [
                'label'      => __( 'Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .contact__form h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'form_title_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .contact__form h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        /* ---------------- STYLE: Form Fields ---------------- */
        $this->start_controls_section(
            'style_form_fields',
            [
                'label' => __( 'Form Fields', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $fields_selector = '{{WRAPPER}} .contact__form input[type="text"], {{WRAPPER}} .contact__form input[type="email"], {{WRAPPER}} .contact__form input[type="tel"], {{WRAPPER}} .contact__form input[type="url"], {{WRAPPER}} .contact__form select, {{WRAPPER}} .contact__form textarea';

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'form_fields_typo',
                'selector' => $fields_selector,
            ]
        );

        $this->add_control(
            'form_fields_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ $fields_selector => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'form_fields_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ $fields_selector => 'background-color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'form_fields_border',
                'selector' => $fields_selector,
            ]
        );

        $this->add_control(
            'form_fields_radius',
            [
                'label'      => __( 'Border Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    $fields_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'form_fields_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    $fields_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        /* ---------------- STYLE: Submit Button ---------------- */
        $this->start_controls_section(
            'style_form_button',
            [
                'label' => __( 'Submit Button', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $btn_selector = '{{WRAPPER}} .contact__form button, {{WRAPPER}} .contact__form input[type="submit"], {{WRAPPER}} .contact__form .default-btn';

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'form_button_typo',
                'selector' => $btn_selector,
            ]
        );

        $this->add_control(
            'form_button_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ $btn_selector => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'form_button_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ $btn_selector => 'background: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'form_button_color_h',
            [
                'label'     => __( 'Hover Text', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ $btn_selector . ':hover' => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'form_button_bg_h',
            [
                'label'     => __( 'Hover Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $btn_selector . ':hover'        => 'background: {{VALUE}} !important;',
                    $btn_selector . '::before'      => 'background: {{VALUE}} !important;',
                    $btn_selector . '::after'       => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'form_button_border',
                'selector' => $btn_selector,
            ]
        );

        $this->add_control(
            'form_button_radius',
            [
                'label'      => __( 'Border Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    $btn_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'form_button_pd',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    $btn_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        /* ---------------- STYLE: Info Title ---------------- */
        $this->start_controls_section(
            'style_info_title',
            [
                'label' => __( 'Info Title', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'info_title_typo',
                'selector' => '{{WRAPPER}} .contact__info h4',
            ]
        );

        $this->add_control(
            'info_title_color',
            [
                'label'     => __( 'Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .contact__info h4' => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'info_title_align',
            [
                'label'     => esc_html__( 'Alignment', 'heal-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [ 'title' => __( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
                    'center' => [ 'title' => __( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
                    'right'  => [ 'title' => __( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact__info h4' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        /* ---------------- STYLE: Info Description ---------------- */
        $this->start_controls_section(
            'style_info_desc',
            [
                'label' => __( 'Info Description', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'info_desc_typo',
                'selector' => '{{WRAPPER}} .contact__info > p',
            ]
        );

        $this->add_control(
            'info_desc_color',
            [
                'label'     => __( 'Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .contact__info > p' => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->end_controls_section();

        /* ---------------- STYLE: Info List ---------------- */
        $this->start_controls_section(
            'style_info_list',
            [
                'label' => __( 'Info List', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_info_icon',
            [
                'label'   => esc_html__( 'Show Icon', 'heal-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [ 'title' => __( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
                    'none' => [ 'title' => __( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
                ],
                'default'   => 'show',
                'selectors' => [
                    '{{WRAPPER}} .contact__info ul li .contact__info-left' => 'display: {{VALUE}} !important;',
                ],
                'selectors_dictionary' => [
                    'show' => 'block',
                    'none' => 'none',
                ],
            ]
        );

        // Icon styles
        $icon_sel = '{{WRAPPER}} .contact__info ul li .contact__info-left i, {{WRAPPER}} .contact__info ul li .contact__info-left svg';

        $this->add_control(
            'info_icon_color',
            [
                'label'     => __( 'Icon Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ $icon_sel => 'color: {{VALUE}} !important; fill: {{VALUE}} !important;' ],
                'condition' => [ 'show_info_icon' => 'show' ],
            ]
        );

        $this->add_control(
            'info_icon_bg',
            [
                'label'     => __( 'Icon Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .contact__info ul li .contact__info-left' => 'background: {{VALUE}} !important;' ],
                'condition' => [ 'show_info_icon' => 'show' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'info_icon_border',
                'selector'  => '{{WRAPPER}} .contact__info ul li .contact__info-left',
                'condition' => [ 'show_info_icon' => 'show' ],
            ]
        );

        $this->add_control(
            'info_icon_radius',
            [
                'label'      => __( 'Icon Box Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .contact__info ul li .contact__info-left' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [ 'show_info_icon' => 'show' ],
            ]
        );

        $this->add_control(
            'info_icon_pad',
            [
                'label'      => __( 'Icon Box Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .contact__info ul li .contact__info-left' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [ 'show_info_icon' => 'show' ],
            ]
        );

        // Text styles
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'info_text_typo',
                'selector' => '{{WRAPPER}} .contact__info ul li .contact__info-right p',
            ]
        );

        $this->add_control(
            'info_text_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .contact__info ul li .contact__info-right p' => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'info_item_gap',
            [
                'label'      => __( 'Row Gap (li)', 'heal-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 60 ] ],
                'selectors'  => [
                    '{{WRAPPER}} .contact__info ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* ---------------- STYLE: Instant CSS ---------------- */
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
                'description'  => __( 'Use "&" to target this widget. Example: & .contact__form{max-width:560px}', 'heal-core' ),
            ]
        );

        $this->add_control(
            'inst_css',
            [
                'label'       => __( 'CSS', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'placeholder' => "& .contact__info ul li{border-bottom:1px dashed #eee;}\n& .contact__form input{box-shadow:none;}",
                'condition'   => [ 'enable_inst_css' => 'yes' ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html( 'post' );

        $root_id  = 'heal-contact-' . $this->get_id();
        $root_sel = '#' . $root_id;

        $contact_form = '';
        if ( ! empty( $settings['contact_shortcode'] ) ) {
            // Shortcode output as-is (assume the form plugin handles sanitization)
            $contact_form = do_shortcode( $settings['contact_shortcode'] );
        }
        ?>
        <div id="<?php echo esc_attr( $root_id ); ?>">
            <?php  if ( 'style1' === $settings['style'] ) : ?>	
                <div class="contect-section padding--top padding--bottom">
                    <div class="container">
                        <div class="contact">
                            <div class="row">
                                <?php if ( ! empty( $contact_form ) ) : ?>
                                    <div class="col-lg-6 col-12">
                                        <div class="contact__form">
                                            <?php if ( ! empty( $settings['contact_title'] ) ) : ?>
                                                <h4 class="mb-4"><?php echo wp_kses( $settings['contact_title'], $allowed_tags ); ?></h4>
                                            <?php endif; ?>

                                            <?php echo $contact_form;?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ( ! empty( $settings['contact_info_title'] ) || ! empty( $settings['contact_info_desc'] ) || ! empty( $settings['info_items'] ) ) : ?>
                                    <div class="col-lg-6 col-12">
                                        <div class="contact__info">
                                            <?php if ( ! empty( $settings['contact_info_title'] ) ) : ?>
                                                <h4><?php echo wp_kses( $settings['contact_info_title'], $allowed_tags ); ?></h4>
                                            <?php endif; ?>

                                            <?php if ( ! empty( $settings['contact_info_desc'] ) ) : ?>
                                                <p><?php echo wp_kses( $settings['contact_info_desc'], $allowed_tags ); ?></p>
                                            <?php endif; ?>

                                            <?php if ( ! empty( $settings['info_items'] ) ) : ?>
                                                <ul>
                                                    <?php foreach ( $settings['info_items'] as $item ) :
                                                        if ( empty( $item['into_text'] ) ) { continue; } ?>
                                                        <li class="d-flex align-items-start gap-3">
                                                            <?php if ( ! empty( $item['info_icon'] ) ) : ?>
                                                                <div class="contact__info-left">
                                                                    <?php Icons_Manager::render_icon( $item['info_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="contact__info-right">
                                                                <p><?php echo esc_html( $item['into_text'] ); ?></p>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php  elseif ( 'style2' === $settings['style'] ) : ?>
                <div class="contect-section padding--top padding--bottom">
                    <div class="container">
                        <?php if(!empty($settings['section_title'])) : ?>
                            <div class="section-header style-2 mb-5">
                                <h2><?php echo wp_kses($settings['section_title'], $allowed_tags);?></h2>
                                <?php if(!empty($settings['section_description'])) : ?>
                                    <p><?php echo wp_kses($settings['section_description'], $allowed_tags);?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="contact">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="contact__form">
                                        <?php if ( ! empty( $settings['contact_title'] ) ) : ?>
                                            <h4 class="mb-4"><?php echo wp_kses( $settings['contact_title'], $allowed_tags ); ?></h4>
                                        <?php endif; ?>

                                        <?php echo $contact_form;?>
                                    </div> 
                                </div>

                                <?php if ( ! empty( $settings['contact_info_title'] ) || ! empty( $settings['contact_info_desc'] ) || ! empty( $settings['info_items'] ) ) : ?>
                                    <div class="col-lg-6 col-12">
                                        <div class="contact__info">
                                            <?php if ( ! empty( $settings['contact_info_title'] ) ) : ?>
                                                <h4><?php echo wp_kses( $settings['contact_info_title'], $allowed_tags ); ?></h4>
                                            <?php endif; ?>

                                            <?php if ( ! empty( $settings['contact_info_desc'] ) ) : ?>
                                                <p><?php echo wp_kses( $settings['contact_info_desc'], $allowed_tags ); ?></p>
                                            <?php endif; ?>

                                            <?php if ( ! empty( $settings['info_items'] ) ) : ?>
                                                <ul>
                                                    <?php foreach ( $settings['info_items'] as $item ) :
                                                        if ( empty( $item['into_text'] ) ) { continue; } ?>
                                                        <li class="d-flex align-items-start gap-3">
                                                            <?php if ( ! empty( $item['info_icon'] ) ) : ?>
                                                                <div class="contact__info-left">
                                                                    <?php Icons_Manager::render_icon( $item['info_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="contact__info-right">
                                                                <p><?php echo esc_html( $item['into_text'] ); ?></p>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>	

            <?php
            // Instant CSS (scoped to this widget instance)
            if ( ! empty( $settings['enable_inst_css'] ) && 'yes' === $settings['enable_inst_css'] && ! empty( $settings['inst_css'] ) ) {
                $scoped_css = str_replace( '&', $root_sel, $settings['inst_css'] );
                echo '<style id="' . esc_attr( $root_id ) . '-inst-css">' . $scoped_css . '</style>';
            }
            ?>
        </div>
        <?php
    }
}

// Elementor old/new registration support
if ( method_exists( Plugin::instance()->widgets_manager, 'register_widget_type' ) ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Theme_Contact() );
} else {
    Plugin::instance()->widgets_manager->register( new Theme_Contact() );
}
