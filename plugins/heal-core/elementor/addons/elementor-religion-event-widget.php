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

        // $this->add_control(
        //     'style',
        //     [
        //         'label'   => esc_html__( 'Select Style', 'heal-core' ),
        //         'type'    => Controls_Manager::SELECT,
        //         'default' => 'style1',
        //         'options' => [
        //             'style1' => esc_html__( 'Style 1', 'heal-core' ),
        //             // 'style2' => esc_html__( 'Style 2', 'heal-core' ),0000000000000000000000000000
        //         ],
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
        $this->end_controls_section();
        // ========== BASIC / QUERY ==========



        // Style Tab Start Here...
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
        // STYLE: Section Header
        

        // ========== STYLE: Card Content Box ==========
        $this->start_controls_section(
            'style_card',
            [
                'label' => __( 'Card Content Box', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner .lab-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border',
                'selector' => '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner .lab-content',
            ]
        );

        $this->add_control(
            'card_radius',
            [
                'label'      => __( 'Border Radius', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner .lab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner .lab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'card_shadow',
                'selector' => '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner',
            ]
        );
        $this->add_control(
            'card_border_hover_color',
            [
                'label'     => __( 'Hover Border Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner:hover .lab-content' => 'border-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
        // ========== STYLE: Card Content Box ==========



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

        // Title Color - Normal & Hover
        $this->start_controls_tabs('title_color_tabs');
            // Normal
            $this->start_controls_tab(
                'title_color_normal',
                [
                    'label' => __( 'Normal', 'heal-core' ),
                ]
            );
            $this->add_control(
                'title_color_normal_control',
                [
                    'label'     => __( 'Title Color', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'separator' => 'after',
                    'selectors' => [
                        '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner .lab-content h5, .hafsa .event-top .event-top-content .event-top-content-wrapper h3' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner .lab-content h5 a, .hafsa .event-top .event-top-content .event-top-content-wrapper h3 a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->end_controls_tab();
            // Hover
            $this->start_controls_tab(
                'title_color_hover',
                [
                    'label' => __( 'Hover', 'heal-core' ),
                ]
            );
            $this->add_control(
                'title_color_hover_control',
                [
                    'label'     => __( 'Title Hover Color', 'heal-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'separator' => 'after',
                    'selectors' => [
                        '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner:hover .lab-content h5, .hafsa .event-top .event-top-content .event-top-content-wrapper h3:hover' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner:hover .lab-content h5 a, .hafsa .event-top .event-top-content .event-top-content-wrapper h3 a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        // Title Color - Normal & Hover

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_typo',
                'label'    => __( 'Meta/Text Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner .lab-content ul li, .hafsa .event-date li',
            ]
        );
        $this->add_control(
            'meta_icon_color_control',
            [
                'label'     => __( 'Icon Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner .lab-content ul li i, .hafsa .event-section .event-content .event-bottom .event-item .lab-inner .lab-content ul li svg, .hafsa .event-date li i, .hafsa .event-date li svg' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'meta_icon_margin',
            [
                'label'      => __( 'Icon Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .hafsa .event-section .event-content .event-bottom .event-item .lab-inner .lab-content ul li i, .hafsa .event-section .event-content .event-bottom .event-item .lab-inner .lab-content ul li svg, .hafsa .event-date li i, .hafsa .event-date li svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            ]
        );
        $this->add_control(
            'badge_width',
            [
                'label'     => __( 'Width', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hafsa .event-count li' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'badge_height',
            [
                'label'     => __( 'height', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hafsa .event-count li' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typo',
                'selector' => '{{WRAPPER}} .hafsa .event-count li div',
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'badge_number_color',
            [
                'label'     => __( 'Number Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .event-count li span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'badge_number_margin',
            [
                'label'      => __( 'Number Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .hafsa .event-count li span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'badge_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .event-count li div' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'badge_bg',
            [
                'label'     => __( 'Badge Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hafsa .event-count li' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [ 'name' => 'badge_border', 'selector' => '{{WRAPPER}} .hafsa .event-count li' ]
        );
        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
                'selectors' => [ '{{WRAPPER}} .hafsa .event-count li' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );
        $this->end_controls_section();
        // ========== STYLE: Date Badge ==========

        

        

        // ========== STYLE: Instant CSS ==========
        $this->start_controls_section(
            'inst_css_section',
            [
                'label' => __( 'Custom CSS (Per Widget)', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'inst_css',
            [
                'label'       => __( 'CSS', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'placeholder' => ".event__right h5{ letter-spacing: .3px; }",
            ]
        );
        $this->end_controls_section();
        // ========== STYLE: Instant CSS ==========
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();

        $root_id  = 'heal-event-' . $this->get_id();
        $root_sel = '#' . $root_id;

        // Helper: Parse Event Meta
        $parse_event_meta = function($post_id) {
            $meta = get_post_meta($post_id, 'heal_event_options', true);
            $meta = is_array($meta) ? $meta : [];

            $location = $meta['event_location'] ?? '';

            // Event Date
            $date_raw = $meta['event_date'] ?? '';
            $ts       = $date_raw ? strtotime($date_raw) : false;
            $day      = $ts ? date('d', $ts) : '';
            $month    = $ts ? date('M', $ts) : '';
            $datefmt  = $ts ? date('Y-m-d', $ts) : ''; // countdown format

            // Event Time
            $time_raw = $meta['event_time'] ?? '';
            $time     = '';
            if ($time_raw) {
                $dt = \DateTime::createFromFormat('H:i:s', $time_raw);
                if (!$dt) { $dt = \DateTime::createFromFormat('H:i', $time_raw); }
                if ($dt) { $time = $dt->format('H:i:s'); } // countdown format
            }

            return [ $location, $day, $month, $datefmt, $time ];
        };

        // Pagination
        $paged = max( 1, get_query_var('paged') ? get_query_var('paged') : get_query_var('page') );

        $args = [
            'post_type'           => 'event',
            'posts_per_page'      => !empty($settings['total']) ? (int)$settings['total'] : -1,
            'order'               => !empty($settings['order']) ? $settings['order'] : 'DESC',
            'orderby'             => !empty($settings['orderby']) ? $settings['orderby'] : 'date',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'paged'               => $paged,
        ];

        if ( !empty( $settings['category'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'event-cat',
                    'field'    => 'term_id',
                    'terms'    => (array) $settings['category'],
                ]
            ];
        }

        $query = new \WP_Query($args);
    ?>
    <div class="hafsa" id="<?php echo esc_attr($root_id); ?>">
        <div class="event-section padding-tb padding-b shape-4">
            <div class="container">
                <div class="row">
                    <?php if ( !empty($settings['section_title']) ): ?>
                        <div class="col-12">
                            <div class="header-title">
                                <?php if ( !empty($settings['section_subtitle']) ): ?>
                                    <h5><?php echo esc_html( $settings['section_subtitle'] ); ?></h5>
                                <?php endif; ?>
                                <h2><?php echo esc_html( $settings['section_title'] ); ?></h2>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-12">
                        <?php if ( $query->have_posts() ) : ?>
                            <?php 
                                $query->the_post();
                                list($location, $day, $month, $datefmt, $time) = $parse_event_meta(get_the_ID());
                            ?>
                            <div class="event-content">
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
                                                    <?php if ($datefmt): ?>
                                                        <li><i class="fa-solid fa-calendar-days"></i> <span><?php echo esc_html( date_i18n( get_option('date_format'), strtotime($datefmt) ) ); ?></span></li>
                                                    <?php endif; ?>
                                                    <?php if ($location): ?>
                                                        <li><i class="fa-solid fa-location-dot"></i> <span><?php echo esc_html($location); ?></span></li>
                                                    <?php endif; ?>
                                                </ul>


                                                <?php if ( 'yes' === $settings['thumb_date'] ) : ?>
                                                    <?php
                                                        // Event datetime
                                                        $event_datetime_str = $datefmt . ' ' . $time;
                                                        $event_datetime = new \DateTime($event_datetime_str);
                                                        $current_datetime = new \DateTime();

                                                        if ($current_datetime > $event_datetime) {
                                                            // Event expired
                                                            echo '<div class="event-expired-message text-danger mt-3">🔔 ' . esc_html__('This event has expired.', 'heal-core') . '</div>';
                                                        } else {
                                                            // Event upcoming, show countdown
                                                            ?>
                                                            <ul class="lab-ul event-count count-down" data-date="<?php echo esc_attr($event_datetime_str); ?>">
                                                                <li>
                                                                    <span class="days">0</span>
                                                                    <div class="count-text"><?php esc_html_e('Days', 'heal-core'); ?></div>
                                                                </li>
                                                                <li>
                                                                    <span class="hours">0</span>
                                                                    <div class="count-text"><?php esc_html_e('Hours', 'heal-core'); ?></div>
                                                                </li>
                                                                <li>
                                                                    <span class="minutes">0</span>
                                                                    <div class="count-text"><?php esc_html_e('Min', 'heal-core'); ?></div>
                                                                </li>
                                                                <li>
                                                                    <span class="seconds">0</span>
                                                                    <div class="count-text"><?php esc_html_e('Sec', 'heal-core'); ?></div>
                                                                </li>
                                                            </ul>
                                                            <?php
                                                        }
                                                    ?>


                                                    
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php wp_reset_postdata(); ?>
                                </div>

                                <div class="event-bottom">
                                    <div class="row justify-content-center">
                                        <?php 
                                            $bottom_query = new \WP_Query($args);
                                            $i = 0;
                                            while ( $bottom_query->have_posts() ) : $bottom_query->the_post(); 
                                            if ( $i == 0 ) { $i++; continue; } // skip top one
                                            list($location, $day, $month, $datefmt, $time) = $parse_event_meta(get_the_ID());
                                        ?>
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="event-item lab-item">
                                                <div class="lab-inner">
                                                    <?php if ( 'yes' === $settings['image_thumb_display'] ) : ?>
                                                        <div class="lab-thumb">
                                                            <?php the_post_thumbnail('large'); ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="lab-content">
                                                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h5>
                                                        <ul class="lab-ul event-date">
                                                            <?php if ($datefmt): ?>
                                                                <li><i class="fa-solid fa-calendar-days"></i> <span><?php echo esc_html( date_i18n( get_option('date_format'), strtotime($datefmt) ) ); ?></span></li>
                                                            <?php endif; ?>
                                                            <?php if ($location): ?>
                                                                <li><i class="fa-solid fa-location-dot"></i> <span><?php echo esc_html($location); ?></span></li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endwhile; wp_reset_postdata(); ?>
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
    </div>

    <?php
    // Instant CSS
    if ( !empty($settings['enable_inst_css']) && 'yes' === $settings['enable_inst_css'] && !empty($settings['inst_css']) ) {
        $scoped = str_replace('&', $root_sel, $settings['inst_css']);
        echo '<style id="'.esc_attr($root_id).'-inst-css">'.$scoped.'</style>';
    }
    }
}

// Elementor register (legacy/new)
if ( method_exists( Plugin::instance()->widgets_manager, 'register_widget_type' ) ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Theme_Hafsa_Event() );
} else {
    Plugin::instance()->widgets_manager->register( new Theme_Hafsa_Event() );
}
