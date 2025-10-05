<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package heal
 * @since 1.0.0
 */
class Theme_Cause extends Widget_Base {

    public function get_name() { return 'cause-widget'; }
    public function get_title() { return esc_html__( 'Causes', 'heal-core' ); }
    public function get_icon() { return 'theme-icon'; }
    public function get_categories() { return ['heal_charity']; }

    protected function register_controls() {

        // ========== BASIC / QUERY ==========
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
            'button',
            [
                'label'       => __( 'Details Button Text', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Read More', 'heal-core'),
                'placeholder' => esc_html__( 'Enter your button text', 'heal-core' ),
            ]
        );

        

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

        // ========== SECTION HEADER (title/desc/icon) ==========
        $this->start_controls_section(
            'section_heading',
            [
                'label'     => __( 'Section Header', 'heal-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                // 'condition' => [ 'style' => 'style1' ],
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
            'section_icon',
            [
                'label'   => esc_html__( 'Icon', 'heal-core' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'    => 'fas fa-calendar-alt',
                    'library'  => 'fa-solid',
                ],
            ]
        );

        $this->end_controls_section();

        // ========== STYLE: Card ==========
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Section', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'section_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-section' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'section_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .event-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();



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
                'label' => __( 'Title', 'heal-core' ),
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
                // 'condition' => [ 'style!' => 'style1' ],
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
                                                            <?php if ( 'yes' === $settings['image_thumb_display'] ) : ?>
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


        <script>
            (function($){
                $(window).scroll(function() {
                    var hT = $('.donaterange__content').offset().top,
                        hH = $('.donaterange__content').outerHeight(),
                        wH = $(window).height(),
                        wS = $(this).scrollTop();
                    if (wS > (hT+hH-1.4*wH)){
                        jQuery(document).ready(function(){
                            jQuery('.donaterange__bars').each(function(){
                                jQuery(this).find('.donaterange__bar').animate({
                                    width:jQuery(this).attr('data-percent')
                                }, 5000); // 5 seconds
                            });
                        });
                    }
                });
            })(jQuery);
        </script>

        <?php
    }
}

// Elementor register (legacy/new)
if ( method_exists( Plugin::instance()->widgets_manager, 'register_widget_type' ) ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Theme_Cause() );
} else {
    Plugin::instance()->widgets_manager->register( new Theme_Cause() );
}
