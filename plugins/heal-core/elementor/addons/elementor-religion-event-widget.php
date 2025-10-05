<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package heal
 * @since 1.0.0
 */
class Theme_Hafsa_Event extends Widget_Base {

    public function get_name() { return 'hafsa-event-widget'; }
    public function get_title() { return esc_html__( 'Events', 'heal-core' ); }
    public function get_icon() { return 'theme-icon'; }
    public function get_categories() { return ['heal_religion']; }

    protected function register_controls() {

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


        // $this->add_control(
        //     'section_description',
        //     [
        //         'label'       => esc_html__( 'Description', 'heal-core' ),
        //         'type'        => Controls_Manager::TEXTAREA,
        //         'default'     => '',
        //         'placeholder' => esc_html__( 'Enter description', 'heal-core' ),
        //         'label_block' => true,
        //     ]
        // );

        $this->end_controls_section();


        // ========== BASIC / QUERY ==========
        $this->start_controls_section(
            'settings_section',
            [
                'label' => esc_html__('Events Settings', 'heal-core'),
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
                    // 'style2' => esc_html__( 'Style 2', 'heal-core' ),0000000000000000000000000000
                ],
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

        // $this->add_control(
        //     'reg_button_switcher',
        //     [
        //         'label'     => esc_html__('Join Button Switcher', 'heal-core'),
        //         'type'      => Controls_Manager::SWITCHER,
        //         'condition' => [ 'style' => 'style1' ],
        //     ]
        // );

        // $this->add_control(
        //     'reg_button',
        //     [
        //         'label'       => __( 'Join Button Text', 'heal-core' ),
        //         'type'        => Controls_Manager::TEXT,
        //         'default'     => esc_html__('Join Now', 'heal-core'),
        //         'placeholder' => esc_html__( 'Enter join button text', 'heal-core' ),
        //         'condition'   => [ 'reg_button_switcher' => 'yes', 'style' => 'style1' ],
        //     ]
        // );

        // $this->add_control(
        //     'reg_button_url',
        //     [
        //         'label'       => esc_html__( 'Join Button URL', 'heal-core' ),
        //         'type'        => Controls_Manager::URL,
        //         'placeholder' => esc_html__( 'https://your-link.com', 'heal-core' ),
        //         'default'     => [ 'url' => '#' ],
        //         'show_external' => true,
        //         'condition'   => [ 'reg_button_switcher' => 'yes', 'style' => 'style1' ],
        //         'label_block' => true,
        //         'separator'   => 'after',
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

        // $this->add_control(
        //     'offset',
        //     [
        //         'label'       => esc_html__('Offset', 'heal-core'),
        //         'type'        => Controls_Manager::NUMBER,
        //         'default'     => 0,
        //         'description' => esc_html__('Skip this many posts from start', 'heal-core'),
        //     ]
        // );

        $this->add_control(
            'category',
            [
                'label'       => esc_html__('Category', 'heal-core'),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => function_exists('heal_core') ? heal_core()->get_terms_names('event-cat', 'id') : [],
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
                    'menu_order'          => esc_html__('Menu Order', 'heal-core'),
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

        $this->add_control(
            'thumb_date',
            [
                'label' => esc_html__('Show Date', 'heal-core'),
                'type'  => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        // $this->add_control(
        //     'pagination',
        //     [
        //         'label'   => esc_html__('Pagination', 'heal-core'),
        //         'type'    => Controls_Manager::SWITCHER,
        //         'default' => 'yes'
        //     ]
        // );

        $this->end_controls_section();

        

        // ========== STYLE: Card ==========
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
                    '{{WRAPPER}} .event__item' => 'background: {{VALUE}};',
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

        // ========== STYLE: Title / Meta / Text ==========
        $this->start_controls_section(
            'style_typo',
            [
                'label' => __( 'Title & Meta', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'selector' => '{{WRAPPER}} .event__content h5, {{WRAPPER}} .event__right h5',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event__content h5, {{WRAPPER}} .event__right h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .event__content h5 a, {{WRAPPER}} .event__right h5 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_typo',
                'label'    => __( 'Meta/Text Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .event__content ul, {{WRAPPER}} .event__content p, {{WRAPPER}} .event__right ul, {{WRAPPER}} .event__right p',
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label'     => __( 'Meta/Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event__content ul li, {{WRAPPER}} .event__content p, {{WRAPPER}} .event__right ul li, {{WRAPPER}} .event__right p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== STYLE: Date Badge ==========
        $this->start_controls_section(
            'style_date_badge',
            [
                'label' => __( 'Date Badge', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'thumb_date',
                            'operator' => '==',
                            'value' => 'yes',
                        ]
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typo',
                'selector' => '{{WRAPPER}} .event__left h4, {{WRAPPER}} .event__left h6',
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event__left h4, {{WRAPPER}} .event__left h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg',
            [
                'label'     => __( 'Badge Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event__left' => 'background: {{VALUE}};',
                ],
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
                'selectors' => [ '{{WRAPPER}} .event__btn' => 'text-align: {{VALUE}};' ],
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
                'selectors'  => [ '{{WRAPPER}} .default-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ],
            ]
        );

        $this->add_control(
            'btn_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [ '{{WRAPPER}} .default-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ],
            ]
        );

        $this->end_controls_section();

        // ========== STYLE: Section Header ==========
        $this->start_controls_section(
            'style_section_header',
            [
                'label' => __( 'Section Header', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [ 'style!' => 'style1' ],
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
                    '{{WRAPPER}} .section-header h2, {{WRAPPER}} .section-header h3, {{WRAPPER}} .section-header h4' => 'color: {{VALUE}} !important;',
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

        $root_id  = 'heal-event-' . $this->get_id();
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
        $offset    = isset($settings['offset']) ? (int)$settings['offset'] : 0;
        $category  = !empty($settings['category']) ? (array)$settings['category'] : [];

        $args = [
            'post_type'           => 'event',
            'posts_per_page'      => $total,
            'order'               => $order,
            'orderby'             => $orderby,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'paged'               => $paged,
        ];
        if ( $offset > 0 ) { $args['offset'] = $offset; }

        if ( !empty( $category ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'event-cat',
                    'field'    => 'term_id',
                    'terms'    => $category
                ]
            ];
        }

        $query = new \WP_Query($args);

        // Helper: meta parse
        $parse_event_meta = function() {
            $meta = get_post_meta(get_the_ID(), 'heal_event_options', true);
            $meta = is_array($meta) ? $meta : [];

            $location = $meta['event_location'] ?? '';

            // date
            $date_raw = $meta['event_date'] ?? '';
            $ts       = $date_raw ? strtotime($date_raw) : false;
            $day      = $ts ? date('d', $ts) : '';
            $month    = $ts ? date('M', $ts) : '';
            $datefmt  = $ts ? date('d M, Y', $ts) : '';

            // time
            $time_raw = $meta['event_time'] ?? '';
            $time     = '';
            if ( $time_raw ) {
                $dt = \DateTime::createFromFormat('H:i:s', $time_raw);
                if (!$dt) { $dt = \DateTime::createFromFormat('H:i', $time_raw); }
                if ($dt) { $time = $dt->format('h:i A'); }
            }

            $speakers = isset($meta['event_speakers']) && is_array($meta['event_speakers']) ? $meta['event_speakers'] : [];

            return [ $location, $day, $month, $datefmt, $time, $speakers ];
        };

        // Swiper init (only for slider styles)
        // if ( in_array( $settings['style'], ['style5', 'style6'], true ) ) {
        //     echo '<script>
        //     jQuery(function($){
        //         var root = $("#'.esc_js($root_id).'");
        //         if(!root.length) return;
        //         var wrap = root.find(".event__slider");
        //         if(!wrap.length) return;
        //         var swiper = new Swiper(wrap[0], {
        //             loop: true,
        //             autoplay: { delay: 10000, disableOnInteraction: false },
        //             navigation: {
        //                 nextEl: root.find(".event__next")[0],
        //                 prevEl: root.find(".event__prev")[0],
        //             }
        //         });
        //     });
        //     </script>';
        // }
        ?>

        <div id="<?php echo esc_attr($root_id); ?>">
            <?php if ( 'style1' === $settings['style'] ) : ?>
                <div class="hafsa">
                    <div class="event-section padding-tb padding-b shape-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="header-title">
                                        <h5>Upcoming Events</h5>
                                        <h2>Ethical And Moral Beliefs That Guides
                                            To The Straight Path!</h2>
                                    </div>
                                </div>
                                <?php if ( $query->have_posts() ) : ?>
                                <div class="col-12">
                                    <div class="event-content">
                                        <?php 
                                            $count = 0;
                                            while ( $query->have_posts() ) : 
                                            $query->the_post();

                                            list($event_location,$event_day,$event_month,$event_date,$event_time,$event_speakers) = $parse_event_meta();
                                            $speaker = !empty($event_speakers[0]) ? $event_speakers[0] : [];
                                            $speaker_img_id  = isset($speaker['speaker_image']['id']) ? $speaker['speaker_image']['id'] : '';
                                            $speaker_img_url = $speaker_img_id ? wp_get_attachment_image_url($speaker_img_id, 'thumbnail') : '';
                                        ?>
                                        <div class="event-top tri-shape-2 pattern-2">
                                            <?php if ( 'yes' === $settings['image_thumb_display'] ) : ?>
                                                <div class="event-top-thumb">
                                                    <?php the_post_thumbnail('large'); ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="event-top-content">
                                                <div class="event-top-content-wrapper">
                                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h3>
                                                    <div class="date-count-wrapper">
                                                        <ul class="lab-ul event-date">
                                                            <li><i class="fa-solid fa-calendar-days"></i> <span>December 24,2021</span></li>
                                                            <li><i class="fa-solid fa-location-dot"></i> <span>New York AK United States</span></li>
                                                        </ul>

                                                        <?php if ( 'yes' === $settings['thumb_date'] ) : ?>
                                                            <ul class="lab-ul event-count" data-date="July 05, 2024 21:14:01">
                                                                <li>
                                                                    <span class="days"><?php echo esc_html__('34', 'heal-core'); ?></span>
                                                                    <div class="count-text"><?php echo esc_html__('Days', 'heal-core'); ?></div>
                                                                </li>
                                                                <li>
                                                                    <span class="hours"><?php echo esc_html__('09', 'heal-core'); ?></span>
                                                                    <div class="count-text"><?php echo esc_html__('Hours', 'heal-core'); ?></div>
                                                                </li>
                                                                <li>
                                                                    <span class="minutes"><?php echo esc_html__('32', 'heal-core'); ?></span>
                                                                    <div class="count-text"><?php echo esc_html__('Min', 'heal-core'); ?></div>
                                                                </li>
                                                                <li>
                                                                    <span class="seconds"><?php echo esc_html__('32', 'heal-core'); ?></span>
                                                                    <div class="count-text"><?php echo esc_html__('Sec', 'heal-core'); ?></div>
                                                                </li>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                            $count++;
                                            if ( $count >= 1 ) break;
                                            endwhile;
                                            wp_reset_postdata(); 
                                        ?>

                                        <div class="event-bottom">
                                            <div class="row justify-content-center">
                                                <?php 
                                                    $count = 0;
                                                    while ( $query->have_posts() ) : 
                                                    $query->the_post();

                                                    list($event_location,$event_day,$event_month,$event_date,$event_time,$event_speakers) = $parse_event_meta();
                                                    $speaker = !empty($event_speakers[0]) ? $event_speakers[0] : [];
                                                    $speaker_img_id  = isset($speaker['speaker_image']['id']) ? $speaker['speaker_image']['id'] : '';
                                                    $speaker_img_url = $speaker_img_id ? wp_get_attachment_image_url($speaker_img_id, 'thumbnail') : '';
                                                ?>
                                                <div class="col-lg-4 col-md-6 col-12">
                                                    <div class="event-item lab-item">
                                                        <div class="lab-inner">
                                                            <div class="lab-thumb">
                                                                <?php the_post_thumbnail('large'); ?>
                                                            </div>
                                                            <div class="lab-content">
                                                                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h5>
                                                                <ul class="lab-ul event-date">
                                                                    <li><i class="icofont-calendar"></i> <span>December 24,2021</span></li>
                                                                    <li><i class="icofont-location-pin"></i> <span>New York AK United States</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php 
                                                    $count++;
                                                    endwhile;
                                                    wp_reset_postdata(); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php else: ?>
                                    <div class="col-12"><p><?php esc_html_e('No events found.', 'heal-core'); ?></p></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php elseif ( 'style2' === $settings['style'] ) : ?>
                <div class="event-section padding--top padding--bottom bg-white" id="event">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-lg-8 col-12">
                                <?php if ( !empty($settings['section_title']) || !empty($settings['section_description']) ) : ?>
                                <div class="section-header style-3">
                                    <?php if ( !empty($settings['section_title']) ) : ?><h4><?php echo wp_kses($settings['section_title'], $allowed_tags); ?></h4><?php endif; ?>
                                    <?php if ( !empty($settings['section_description']) ) : ?><p><?php echo wp_kses($settings['section_description'], $allowed_tags); ?></p><?php endif; ?>
                                </div>
                                <?php endif; ?>

                                <div class="section-wrapper">
                                    <div class="event">
                                        <div class="row g-4">
                                            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                                                list($event_location,$event_day,$event_month,$event_date,$event_time,$event_speakers) = $parse_event_meta();
                                                $speaker = !empty($event_speakers[0]) ? $event_speakers[0] : [];
                                                $speaker_img_id  = isset($speaker['speaker_image']['id']) ? $speaker['speaker_image']['id'] : '';
                                                $speaker_img_url = $speaker_img_id ? wp_get_attachment_image_url($speaker_img_id, 'thumbnail') : '';
                                            ?>
                                            <div class="col-sm-6 col-12">
                                                <div class="event__item">
                                                    <div class="event__inner">
                                                        <?php if ( 'yes' === $settings['image_thumb_display'] ) : ?>
                                                            <div class="event__thumb"><?php the_post_thumbnail('large'); ?></div>
                                                        <?php endif; ?>
                                                        <div class="event__content">
                                                            <?php if ( !empty($speaker) ) : ?>
                                                                <div class="event__author">
                                                                    <?php if ( $speaker_img_url ) : ?>
                                                                        <img src="<?php echo esc_url($speaker_img_url); ?>" alt="<?php echo esc_attr($speaker['speaker_name'] ?? ''); ?>" class="rounded-circle">
                                                                    <?php endif; ?>
                                                                    <div class="name">
                                                                        <h6><?php echo esc_html($speaker['speaker_name'] ?? ''); ?></h6>
                                                                        <span><?php echo esc_html($speaker['speaker_role'] ?? ''); ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="event__list">
                                                                <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                                                                <ul>
                                                                    <li><i class="far fa-clock"></i> <b><?php esc_html_e('Time :-', 'heal-core'); ?></b> <?php echo esc_html($event_date); ?> <?php esc_html_e('at', 'heal-core'); ?> <?php echo esc_html($event_time); ?></li>
                                                                    <li><i class="fas fa-map-marker-alt"></i> <b><?php esc_html_e('Address :-', 'heal-core'); ?></b> <?php echo esc_html($event_location); ?></li>
                                                                </ul>
                                                            </div>
                                                            <div class="event__btn">
                                                                <a href="<?php the_permalink(); ?>" class="default-btn move-right"><span><?php echo esc_html($settings['button']); ?></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile; wp_reset_postdata(); else: ?>
                                                <div class="col-12"><p><?php esc_html_e('No events found.', 'heal-core'); ?></p></div>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ( 'yes' === $settings['pagination'] ) : ?>
                                            <nav aria-label="Page navigation example" class="mt-5">
                                                <?php
                                                $big = 999999999;
                                                $paged_now = max(1, get_query_var('paged'));
                                                $links = paginate_links( [
                                                    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                                    'format'    => '?paged=%#%',
                                                    'current'   => $paged_now,
                                                    'total'     => $query->max_num_pages,
                                                    'prev_text' => 'Previous',
                                                    'next_text' => 'Next',
                                                    'type'      => 'array',
                                                    'end_size'  => 1,
                                                    'mid_size'  => 2,
                                                ] );
                                                if ( is_array( $links ) ) {
                                                    echo '<ul class="pagination justify-content-center">';
                                                    foreach ( $links as $link ) {
                                                        if ( strpos( $link, 'current' ) !== false ) echo '<li class="page-item active">' . str_replace( 'page-numbers', 'page-link', $link ) . '</li>';
                                                        elseif ( strpos( $link, 'dots' ) !== false ) echo '<li class="page-item disabled">' . str_replace( 'page-numbers', 'page-link', $link ) . '</li>';
                                                        else echo '<li class="page-item">' . str_replace( 'page-numbers', 'page-link', $link ) . '</li>';
                                                    }
                                                    echo '</ul>';
                                                }
                                                ?>
                                            </nav>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>

                            <?php if ( is_active_sidebar('event-sidebar') ) : ?>
                                <div class="col-lg-4 col-12">
                                    <div class="sidebar">
                                        <?php dynamic_sidebar('event-sidebar'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php elseif ( 'style3' === $settings['style'] ) : ?>
                <div class="event-section padding--top padding--bottom bg-white" id="event">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-lg-8 col-12">
                                <div class="section-wrapper">
                                    <div class="event event-listview">
                                        <div class="row g-4">
                                            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                                                list($event_location,$event_day,$event_month,$event_date,$event_time,$event_speakers) = $parse_event_meta();
                                                $speaker = !empty($event_speakers[0]) ? $event_speakers[0] : [];
                                                $speaker_img_id  = isset($speaker['speaker_image']['id']) ? $speaker['speaker_image']['id'] : '';
                                                $speaker_img_url = $speaker_img_id ? wp_get_attachment_image_url($speaker_img_id, 'thumbnail') : '';
                                            ?>
                                            <div class="col-12">
                                                <div class="event__item">
                                                    <div class="event__inner">
                                                        <?php if ( 'yes' === $settings['image_thumb_display'] ) : ?>
                                                            <div class="event__thumb"><?php the_post_thumbnail('large'); ?></div>
                                                        <?php endif; ?>

                                                        <div class="event__content">
                                                            <?php if ( !empty($speaker) ) : ?>
                                                                <div class="event__author">
                                                                    <?php if ( $speaker_img_url ) : ?>
                                                                        <img src="<?php echo esc_url($speaker_img_url); ?>" alt="<?php echo esc_attr($speaker['speaker_name'] ?? ''); ?>" class="rounded-circle">
                                                                    <?php endif; ?>
                                                                    <div class="name">
                                                                        <h6><?php echo esc_html($speaker['speaker_name'] ?? ''); ?></h6>
                                                                        <span><?php echo esc_html($speaker['speaker_role'] ?? ''); ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>

                                                            <div class="event__list">
                                                                <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                                                                <ul>
                                                                    <li><i class="far fa-clock"></i> <b><?php esc_html_e('Time :-', 'heal-core'); ?></b> <?php echo esc_html($event_date); ?> <?php esc_html_e('at', 'heal-core'); ?> <?php echo esc_html($event_time); ?></li>
                                                                    <li><i class="fas fa-map-marker-alt"></i> <b><?php esc_html_e('Address :-', 'heal-core'); ?></b> <?php echo esc_html($event_location); ?></li>
                                                                </ul>
                                                            </div>
                                                            <div class="event__btn">
                                                                <a href="<?php the_permalink(); ?>" class="default-btn move-right"><span><?php echo esc_html($settings['button']); ?></span></a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile; wp_reset_postdata(); else: ?>
                                                <div class="col-12"><p><?php esc_html_e('No events found.', 'heal-core'); ?></p></div>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ( 'yes' === $settings['pagination'] ) : ?>
                                            <nav aria-label="Page navigation example" class="mt-5">
                                                <?php
                                                $big = 999999999;
                                                $paged_now = max(1, get_query_var('paged'));
                                                $links = paginate_links( [
                                                    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                                    'format'    => '?paged=%#%',
                                                    'current'   => $paged_now,
                                                    'total'     => $query->max_num_pages,
                                                    'prev_text' => 'Previous',
                                                    'next_text' => 'Next',
                                                    'type'      => 'array',
                                                    'end_size'  => 1,
                                                    'mid_size'  => 2,
                                                ] );
                                                if ( is_array( $links ) ) {
                                                    echo '<ul class="pagination justify-content-center">';
                                                    foreach ( $links as $link ) {
                                                        if ( strpos( $link, 'current' ) !== false ) echo '<li class="page-item active">' . str_replace( 'page-numbers', 'page-link', $link ) . '</li>';
                                                        elseif ( strpos( $link, 'dots' ) !== false ) echo '<li class="page-item disabled">' . str_replace( 'page-numbers', 'page-link', $link ) . '</li>';
                                                        else echo '<li class="page-item">' . str_replace( 'page-numbers', 'page-link', $link ) . '</li>';
                                                    }
                                                    echo '</ul>';
                                                }
                                                ?>
                                            </nav>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>

                            <?php if ( is_active_sidebar('event-sidebar') ) : ?>
                                <div class="col-lg-4 col-12">
                                    <div class="sidebar">
                                        <?php dynamic_sidebar('event-sidebar'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php elseif ( 'style4' === $settings['style'] ) : ?>
                <div class="event-section padding--top padding--bottom" id="event">
                    <div class="container">
                        <div class="row g-4">
                            <?php if ( !empty($settings['section_title']) ) : ?>
                            <div class="col-xl-3 col-12">
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
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if ( $query->have_posts() ) : ?>
                            <div class="col-xl-9 col-12">
                                <div class="section-wrapper">
                                    <div class="event event-style3">
                                        <div class="row g-4">
                                            <?php while ( $query->have_posts() ) : $query->the_post();
                                                list($event_location,$event_day,$event_month,$event_date,$event_time,$event_speakers) = $parse_event_meta();
                                            ?>
                                            <div class="col-sm-6 col-12">
                                                <div class="event__item">
                                                    <div class="event__inner">
                                                        <?php if ( 'yes' === $settings['thumb_date'] ) : ?>
                                                        <div class="event__left">
                                                            <h4><?php echo esc_html($event_day); ?></h4>
                                                            <h6><?php echo esc_html($event_month); ?></h6>
                                                        </div>
                                                        <?php endif; ?>

                                                        <div class="event__right">
                                                            <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                                                            <ul>
                                                                <li><b><?php esc_html_e('Time :', 'heal-core'); ?></b> <?php echo esc_html($event_time); ?></li>
                                                                <li><b><?php esc_html_e('Address :', 'heal-core'); ?></b> <?php echo esc_html($event_location); ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile; wp_reset_postdata(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                                <div class="col-12"><p><?php esc_html_e('No events found.', 'heal-core'); ?></p></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php elseif ( 'style5' === $settings['style'] ) : ?>
                <div class="event-section padding--top padding--bottom" id="event">
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
                                    <div class="event">
                                        <div class="event__slider overflow-hidden">
                                            <div class="swiper-wrapper">
                                                <?php while ( $query->have_posts() ) : $query->the_post();
                                                    list($event_location,$event_day,$event_month,$event_date,$event_time,$event_speakers) = $parse_event_meta();
                                                    $speaker = !empty($event_speakers[0]) ? $event_speakers[0] : [];
                                                    $speaker_img_id  = isset($speaker['speaker_image']['id']) ? $speaker['speaker_image']['id'] : '';
                                                    $speaker_img_url = $speaker_img_id ? wp_get_attachment_image_url($speaker_img_id, 'thumbnail') : '';
                                                ?>
                                                <div class="swiper-slide">
                                                    <div class="event__item">
                                                        <div class="event__inner">
                                                            <?php if ( 'yes' === $settings['image_thumb_display'] ) : ?>
                                                                <div class="event__thumb"><?php the_post_thumbnail('large'); ?></div>
                                                            <?php endif; ?>

                                                            <div class="event__content">
                                                                <?php if (!empty($speaker)) : ?>
                                                                <div class="event__author">
                                                                    <?php if ($speaker_img_url) : ?>
                                                                        <img src="<?php echo esc_url($speaker_img_url); ?>" alt="<?php echo esc_attr($speaker['speaker_name'] ?? ''); ?>" class="rounded-circle">
                                                                    <?php endif; ?>
                                                                    <div class="name">
                                                                        <h6><?php echo esc_html($speaker['speaker_name'] ?? ''); ?></h6>
                                                                        <span><?php echo esc_html($speaker['speaker_role'] ?? ''); ?></span>
                                                                    </div>
                                                                </div>
                                                                <?php endif; ?>

                                                                <div class="event__list">
                                                                    <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                                                                    <ul>
                                                                        <li><i class="far fa-clock"></i> <b><?php esc_html_e('Time :-', 'heal-core'); ?></b> <?php echo esc_html($event_date); ?> <?php esc_html_e('at', 'heal-core'); ?> <?php echo esc_html($event_time); ?></li>
                                                                        <li><i class="fas fa-map-marker-alt"></i> <b><?php esc_html_e('Address :-', 'heal-core'); ?></b> <?php echo esc_html($event_location); ?></li>
                                                                    </ul>
                                                                </div>

                                                                <div class="event__btn">
                                                                    <a href="<?php the_permalink(); ?>" class="default-btn move-right"><span><?php echo esc_html($settings['button']); ?></span></a>
                                                                </div>
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
                                <div class="col-12"><p><?php esc_html_e('No events found.', 'heal-core'); ?></p></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php elseif ( 'style6' === $settings['style'] ) : ?>
                <div class="event-section padding--top padding--bottom" id="event">
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
                                                    list($event_location,$event_day,$event_month,$event_date,$event_time,$event_speakers) = $parse_event_meta();
                                                ?>
                                                <div class="swiper-slide">
                                                    <div class="event__item">
                                                        <div class="event__inner">
                                                            <?php if ( 'yes' === $settings['image_thumb_display'] ) : ?>
                                                                <div class="event__thumb">
                                                                    <?php the_post_thumbnail('large'); ?>
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
                                <div class="col-12"><p><?php esc_html_e('No events found.', 'heal-core'); ?></p></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
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
    Plugin::instance()->widgets_manager->register_widget_type( new Theme_Hafsa_Event() );
} else {
    Plugin::instance()->widgets_manager->register( new Theme_Hafsa_Event() );
}
