<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package heal
 * @since 1.0.0
 */
class Theme_Counter extends Widget_Base {

    public function get_name() {
        return 'counter-widget';
    }

    public function get_title() {
        return esc_html__( 'Counter', 'heal-core' );
    }

    public function get_icon() {
        return 'theme-icon';
    }

    public function get_categories() {
        return ['heal_charity'];
    }

    protected function register_controls() {

        // ========== BASIC ==========
        $this->start_controls_section(
            'theme_counter',
            [ 'label' => esc_html__( 'Counter Style', 'heal-core' ) ]
        );

        $this->add_control(
            'style',
            [
                'label'   => esc_html__( 'Select Style', 'heal-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__( 'Countdown', 'heal-core' ),
                    'style2' => esc_html__( 'Counters', 'heal-core' ),
                ],
            ]
        );
        $this->end_controls_section();

        // ========== SECTION HEADER ==========
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
                'default'     => '',
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

        // style1: countdown
        $this->add_control(
            'countdown_date',
            [
                'label'       => esc_html__( 'Target Date & Time', 'heal-core' ),
                'type'        => Controls_Manager::DATE_TIME,
                'placeholder' => esc_html__( 'Select your date', 'heal-core' ),
                'label_block' => true,
                'condition'   => [ 'style' => 'style1' ],
            ]
        );

        // style2: counters
        $repeater = new Repeater();

        $repeater->add_control(
            'counter_img_switcher',
            [
                'label'        => esc_html__( 'Image Switcher', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'heal-core' ),
                'label_off'    => esc_html__( 'Hide', 'heal-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater->add_control(
            'counter_img',
            [
                'label'     => esc_html__( 'Image', 'heal-core' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [ 'url' => Utils::get_placeholder_image_src() ],
                'condition' => [ 'counter_img_switcher' => 'yes' ],
            ]
        );

        $repeater->add_control(
            'counter_img_alt',
            [
                'label'       => esc_html__( 'Image Alt / SEO Text', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Alt/SEO Title', 'heal-core' ),
                'label_block' => true,
                'condition'   => [ 'counter_img_switcher' => 'yes' ],
            ]
        );

        $repeater->add_control(
            'counter_title',
            [
                'label'       => esc_html__( 'Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Counter Title', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'counter_number',
            [
                'label'       => esc_html__( 'Number', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '3000 or 3,000', 'heal-core' ),
                'description' => esc_html__( 'Digits only; commas allowed for readability', 'heal-core' ),
            ]
        );

        $repeater->add_control(
            'counter_number_extra',
            [
                'label'       => esc_html__( 'Suffix', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '+ / k / M', 'heal-core' ),
            ]
        );

        $this->add_control(
            'counter_items',
            [
                'label'       => esc_html__( 'Counter Items', 'heal-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{ counter_title }}',
                'condition'   => [ 'style' => 'style2' ],
            ]
        );

        $this->add_control(
            'enable_countup',
            [
                'label'        => esc_html__( 'Enable CountUp Animation', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [ 'style' => 'style2' ],
            ]
        );

        $this->add_control(
            'countup_duration',
            [
                'label'      => esc_html__( 'CountUp Duration (ms)', 'heal-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [ 'px' => [ 'min' => 200, 'max' => 8000, 'step' => 100 ] ],
                'default'    => [ 'size' => 1500 ],
                'condition'  => [ 'style' => 'style2', 'enable_countup' => 'yes' ],
            ]
        );

        $this->end_controls_section();

        // ========== STYLE: Section Title ==========
        $this->start_controls_section(
            'style_section_title',
            [
                'label' => __( 'Section Title', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'section_title_typo',
                'selector' => '{{WRAPPER}} .section-header h4, {{WRAPPER}} .section-header h2, {{WRAPPER}} .section-header h3',
            ]
        );

        $this->add_control(
            'section_title_color',
            [
                'label'     => __( 'Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-header h4' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .section-header h2' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .section-header h3' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'section_title_align',
            [
                'label'     => esc_html__( 'Alignment', 'heal-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [ 'title' => __( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
                    'center' => [ 'title' => __( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
                    'right'  => [ 'title' => __( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .section-header' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== STYLE: Countdown (style1) ==========
        $this->start_controls_section(
            'style_countdown',
            [
                'label'     => __( 'Countdown (Style 1)', 'heal-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [ 'style' => 'style1' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cd_digit_typo',
                'label'    => __( 'Digits Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .countdown .count-number',
            ]
        );

        $this->add_control(
            'cd_digit_color',
            [
                'label'     => __( 'Digits Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .countdown .count-number' => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'cd_digit_bg',
            [
                'label'     => __( 'Digits Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .countdown .clock-item' => 'background: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cd_label_typo',
                'label'    => __( 'Labels Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .countdown .count-text',
            ]
        );

        $this->add_control(
            'cd_label_color',
            [
                'label'     => __( 'Labels Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .countdown .count-text' => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'cd_item_padding',
            [
                'label'      => __( 'Box Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .countdown .clock-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cd_item_radius',
            [
                'label'      => __( 'Box Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .countdown .clock-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cd_gap',
            [
                'label'     => __( 'Item Gap', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [
                    '{{WRAPPER}} .countdown .clock-item + .clock-item' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== STYLE: Counter Items (style2) ==========
        $this->start_controls_section(
            'style_counters',
            [
                'label'     => __( 'Counters (Style 2)', 'heal-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [ 'style' => 'style2' ],
            ]
        );

        $this->add_control(
            'counter_card_bg',
            [
                'label'     => __( 'Card Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .counter__item' => 'background: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'counter_card_border',
                'selector' => '{{WRAPPER}} .counter__item',
            ]
        );

        $this->add_control(
            'counter_card_radius',
            [
                'label'      => __( 'Card Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .counter__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'counter_card_padding',
            [
                'label'      => __( 'Card Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .counter__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Image
        $this->add_control(
            'counter_img_width',
            [
                'label'     => __( 'Image Width', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 20, 'max' => 200 ] ],
                'selectors' => [ '{{WRAPPER}} .counter__thumb img' => 'width: {{SIZE}}{{UNIT}}; height: auto;' ],
            ]
        );

        $this->add_control(
            'counter_img_radius',
            [
                'label'      => __( 'Image Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .counter__thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Number + suffix
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'counter_num_typo',
                'label'    => __( 'Number Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .counter__content h2, {{WRAPPER}} .counter__number, {{WRAPPER}} .counter__persent',
            ]
        );

        $this->add_control(
            'counter_num_color',
            [
                'label'     => __( 'Number Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .counter__number' => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'counter_suffix_color',
            [
                'label'     => __( 'Suffix Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .counter__persent' => 'color: {{VALUE}} !important;' ],
            ]
        );

        // Title
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'counter_title_typo',
                'label'    => __( 'Title Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .counter__content p',
            ]
        );

        $this->add_control(
            'counter_title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .counter__content p' => 'color: {{VALUE}} !important;' ],
            ]
        );

        $this->add_control(
            'counter_align',
            [
                'label'     => __( 'Text Align', 'heal-core' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [ 'title' => __( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
                    'center' => [ 'title' => __( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
                    'right'  => [ 'title' => __( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [ '{{WRAPPER}} .counter__content' => 'text-align: {{VALUE}};' ],
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
                'description'  => __( 'Use "&" to target this widget. Example: & .counter__item{box-shadow:0 10px 30px rgba(0,0,0,.06)}', 'heal-core' ),
            ]
        );

        $this->add_control(
            'inst_css',
            [
                'label'       => __( 'CSS', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'placeholder' => "& .counter__number{letter-spacing:1px;}",
                'condition'   => [ 'enable_inst_css' => 'yes' ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html('post');

        $root_id  = 'heal-counter-' . $this->get_id();
        $root_sel = '#' . $root_id;
        ?>
        <div id="<?php echo esc_attr( $root_id ); ?>">
            <?php if ( 'style1' === $settings['style'] ) : ?>
                <div class="countdown-section padding--top padding--bottom bg-img">
                    <div class="container">
                        <?php if ( ! empty( $settings['section_title'] ) ) : ?>
                            <div class="section-header style-3">
                                <h4><?php echo wp_kses( $settings['section_title'], $allowed_tags ); ?></h4>
                            </div>
                        <?php endif; ?>

                        <?php
                        $iso = '';
                        if ( ! empty( $settings['countdown_date'] ) ) {
                            $ts  = strtotime( $settings['countdown_date'] );
                            if ( $ts ) {
                                // ISO 8601 for JS Date parsing reliability
                                $iso = gmdate( 'c', $ts );
                            }
                        }
                        ?>

                        <?php if ( ! empty( $iso ) ) : ?>
                            <div class="countdown">
                                <ul class="countdown count-down" data-date="<?php echo esc_attr( $iso ); ?>">
                                    <li class="clock-item">
                                        <span class="count-number days">00</span>
                                        <p class="count-text"><?php echo esc_html__( 'Days', 'heal-core' ); ?></p>
                                    </li>
                                    <li class="clock-item">
                                        <span class="count-number hours">00</span>
                                        <p class="count-text"><?php echo esc_html__( 'Hours', 'heal-core' ); ?></p>
                                    </li>
                                    <li class="clock-item">
                                        <span class="count-number minutes">00</span>
                                        <p class="count-text"><?php echo esc_html__( 'Minutes', 'heal-core' ); ?></p>
                                    </li>
                                    <li class="clock-item">
                                        <span class="count-number seconds">00</span>
                                        <p class="count-text"><?php echo esc_html__( 'Seconds', 'heal-core' ); ?></p>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            <?php elseif ( 'style2' === $settings['style'] ) : ?>
                <div class="counter-section padding--top padding--bottom bg-img">
                    <div class="container">
                        <div class="counter">
                            <?php if ( ! empty( $settings['section_title'] ) ) : ?>
                                <div class="section-header style-3">
                                    <h4><?php echo wp_kses( $settings['section_title'], $allowed_tags ); ?></h4>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $settings['counter_items'] ) ) : ?>
                                <div class="section-wrapper">
                                    <div class="row g-5 g-lg-4 justify-content-center">
                                        <?php foreach ( $settings['counter_items'] as $item ) :
                                            if ( empty( $item['counter_title'] ) ) { continue; }

                                            // sanitize numeric
                                            $raw      = isset($item['counter_number']) ? (string) $item['counter_number'] : '0';
                                            $numeric  = preg_replace('/[^\d\.]/', '', $raw); // keep digits & dot
                                            $numeric  = $numeric === '' ? '0' : $numeric;
                                            $suffix   = isset($item['counter_number_extra']) ? $item['counter_number_extra'] : '';
                                            $duration = isset($settings['countup_duration']['size']) ? (int)$settings['countup_duration']['size'] : 1500;

                                            $img_url = '';
                                            if ( ! empty( $item['counter_img']['url'] ) && 'yes' === ($item['counter_img_switcher'] ?? '') ) {
                                                $img_url = $item['counter_img']['url'];
                                            }
                                            ?>
                                            <div class="col-lg-3 col-sm-6 col-12">
                                                <div class="counter__item">
                                                    <div class="counter__inner">
                                                        <?php if ( ! empty( $img_url ) ) : ?>
                                                            <div class="counter__thumb">
                                                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $item['counter_img_alt'] ?? '' ); ?>">
                                                            </div>
                                                        <?php endif; ?>

                                                        <div class="counter__content">
                                                            <h2>
                                                                <span class="counter__number"
                                                                    <?php if ( ! empty( $settings['enable_countup'] ) && 'yes' === $settings['enable_countup'] ) : ?>
                                                                        data-target="<?php echo esc_attr( $numeric ); ?>"
                                                                        data-duration="<?php echo esc_attr( $duration ); ?>"
                                                                    <?php endif; ?>
                                                                >
                                                                    <?php
                                                                    if ( ! empty( $settings['enable_countup'] ) && 'yes' === $settings['enable_countup'] ) {
                                                                        echo '0';
                                                                    } else {
                                                                        // formatted immediate output
                                                                        $n = is_numeric($numeric) ? (float)$numeric : 0;
                                                                        echo esc_html( number_format_i18n( $n ) );
                                                                    }
                                                                    ?>
                                                                </span>
                                                                <?php if ( ! empty( $suffix ) ) : ?>
                                                                    <span class="counter__persent"><?php echo esc_html( $suffix ); ?></span>
                                                                <?php endif; ?>
                                                            </h2>
                                                            <p><?php echo esc_html( $item['counter_title'] ); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if ( ! empty( $settings['enable_countup'] ) && 'yes' === $settings['enable_countup'] ) : ?>
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
                <?php endif; ?>

            <?php endif; ?>

            <?php
            // Instant CSS
            if ( ! empty( $settings['enable_inst_css'] ) && 'yes' === $settings['enable_inst_css'] && ! empty( $settings['inst_css'] ) ) {
                $scoped_css = str_replace( '&', $root_sel, $settings['inst_css'] );
                echo '<style id="' . esc_attr( $root_id ) . '-inst-css">' . $scoped_css . '</style>';
            }
            ?>
        </div>
        <?php
    }
}

// Elementor registration (new & legacy support)
if ( method_exists( Plugin::instance()->widgets_manager, 'register_widget_type' ) ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Theme_Counter() );
} else {
    Plugin::instance()->widgets_manager->register( new Theme_Counter() );
}
