<?php
/**
 * Plugin Name: Heal Core - Testimonial Widget (Single File)
 * Description: Elementor Testimonial slider with Style & Slider controls (2 styles).
 * Version:     1.0.1
 * Author:      Your Name
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
    return; // Elementor inactive
}

class Theme_Hafsa_Quote extends Widget_Base {

    public function get_name() {
        return 'hafsa-qoute-widget';
    }

    public function get_title() {
        return esc_html__( 'Quote', 'heal-core' );
    }

    public function get_icon() {
        return 'theme-icon';
    }

    public function get_categories() {
        return [ 'heal_religion' ];
    }

    public function get_keywords() {
        return [ 'Quote', 'review', 'slider', 'quote', 'client' ];
    }

    public function get_script_depends() { return []; }
    public function get_style_depends()  { return []; }

    protected function register_controls() {

        /* -----------------------------
         * CONTENT: Style selection
         * ----------------------------- */
        // $this->start_controls_section(
        //     'section_style_switch',
        //     [
        //         'label' => esc_html__( 'Testimonial Style', 'heal-core' ),
        //     ]
        // );

        // $this->add_control(
        //     'style',
        //     [
        //         'label'   => esc_html__( 'Select Style', 'heal-core' ),
        //         'type'    => Controls_Manager::SELECT,
        //         'default' => 'style1',
        //         'options' => [
        //             'style1' => esc_html__( 'Style 1', 'heal-core' ),
        //             'style2' => esc_html__( 'Style 2', 'heal-core' ),
        //         ],
        //     ]
        // );

        // $this->end_controls_section();

        /* -----------------------------
         * CONTENT: Items - Style 1
         * ----------------------------- */
        $this->start_controls_section(
            'section_content',
            [
                'label'     => __( 'Items', 'heal-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'repeat',
			[
				'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
				'default' => [
					[
						'quote_name' => esc_html__( 'Quote Repeater', 'heal-core' ),
					],
				],
				'fields' => [
					[
						'name' => 'block_icon',
						'label' => esc_html__( 'Icon', 'heal-core' ),
						'type' => Controls_Manager::ICON,
                        'label_block' => true,
					],
					[
						'name' => 'quote_title',
						'label' => esc_html__( 'Quote Title', 'heal-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Quote From Prophet',
                        'label_block' => true,
					],
					[
						'name' => 'quote_text',
						'label' => esc_html__( 'Quote Text', 'heal-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '',
					],
					[
						'name' => 'quote_name',
						'label' => esc_html__( 'Quote Name', 'heal-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
                        'label_block' => true,
					],
				],
				'title_field' => '{{quote_name}}',
			]
		);
        $this->end_controls_section();

        

        /* -----------------------------
         * CONTENT: Slider Settings (common)
        * ----------------------------- */
        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __( 'Slider Settings', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slider_pagination',
            [
                'label'     => esc_html__( 'Pagination', 'heal-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => esc_html__( 'Yes', 'heal-core' ),
                'label_off' => esc_html__( 'No', 'heal-core' ),
            ]
        );

        $this->add_control(
            'slider_loop',
            [
                'label'     => esc_html__( 'Loop', 'heal-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => esc_html__( 'Yes', 'heal-core' ),
                'label_off' => esc_html__( 'No', 'heal-core' ),
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'     => esc_html__( 'Autoplay', 'heal-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => esc_html__( 'Yes', 'heal-core' ),
                'label_off' => esc_html__( 'No', 'heal-core' ),
            ]
        );

        $this->add_control(
            'slider_delay',
            [
                'label'     => esc_html__( 'Autoplay Delay (ms)', 'heal-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'min'       => 1000,
                'max'       => 20000,
                'condition' => [ 'slider_autoplay' => 'yes' ],
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'   => esc_html__( 'Transition Speed (ms)', 'heal-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 600,
                'min'     => 100,
                'max'     => 5000,
            ]
        );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'label'           => __( 'Slides Per View (Desktop)', 'heal-core' ),
                'type'            => Controls_Manager::NUMBER,
                'default'         => 2,
                'min'             => 1,
                'max'             => 5,
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'tablet_default'  => 1,
                'mobile_default'  => 1,
            ]
        );

        $this->add_responsive_control(
            'space_between',
            [
                'label'           => __( 'Space Between (px)', 'heal-core' ),
                'type'            => Controls_Manager::NUMBER,
                'default'         => 24,
                'min'             => 0,
                'max'             => 80,
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'tablet_default'  => 16,
                'mobile_default'  => 12,
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Card/Item
        * ----------------------------- */
        $this->start_controls_section(
            'style_quote',
            [
                'label' => __( 'Quote Prophet', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [ 'name' => 'qp_border', 'selector' => '{{WRAPPER}} .hafsa .qoute-section .qoute-container .qoute-item .lab-inner .lab-thumb' ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'qp_shadow', 'selector' => '{{WRAPPER}} .hafsa .qoute-section .qoute-container .qoute-item .lab-inner .lab-thumb' ]
        );

        $this->add_responsive_control(
            'qp_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [ '{{WRAPPER}} .hafsa .qoute-section .qoute-container .qoute-item .lab-inner .lab-thumb' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'qp_margin',
            [
                'label'      => __( 'Margin', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .hafsa .qoute-section .qoute-container .qoute-item .lab-inner .lab-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Texts (Name/Quote/Time)
         * ----------------------------- */
        $this->start_controls_section(
            'style_texts',
            [
                'label' => __( 'Texts', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => __( 'Name Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .testimonial__content h5, {{WRAPPER}} .testimonial__content p span' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'name_typo', 'selector' => '{{WRAPPER}} .testimonial__content h5, {{WRAPPER}} .testimonial__content p span' ]
        );

        $this->add_control(
            'quote_color',
            [
                'label'     => __( 'Quote Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .testimonial__content p' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'quote_typo', 'selector' => '{{WRAPPER}} .testimonial__content p' ]
        );

        $this->add_control(
            'time_color',
            [
                'label'     => __( 'Time Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .testimonial__content > span' => 'color: {{VALUE}};' ],
                'condition' => [ 'style' => 'style2' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'time_typo', 'selector' => '{{WRAPPER}} .testimonial__content > span' ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Avatar / Icon / Pagination
         * ----------------------------- */
        $this->start_controls_section(
            'style_media',
            [
                'label' => __( 'Avatar / Icon / Pagination', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'avatar_size',
            [
                'label'     => __( 'Avatar Size (px)', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 30, 'max' => 160 ] ],
                'selectors' => [ '{{WRAPPER}} .testimonial__thumb img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; object-fit: cover;' ],
            ]
        );

        $this->add_responsive_control(
            'avatar_radius',
            [
                'label'     => __( 'Avatar Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
                'selectors' => [ '{{WRAPPER}} .testimonial__thumb img' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => __( 'Icon Size', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 12, 'max' => 120 ] ],
                'selectors' => [ '{{WRAPPER}} .testimonial__icon i, {{WRAPPER}} .testimonial__icon svg' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
                'condition' => [ 'style' => 'style2' ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .testimonial__icon i, .testimonial__icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};' ],
                'condition' => [ 'style' => 'style2' ],
            ]
        );
        $this->add_control(
            'icon_border_color',
            [
                'label'     => __( 'Icon Border Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .testimonial__icon' => 'border-color: {{VALUE}};' ],
                'condition' => [ 'style' => 'style2' ],
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     => __( 'Pagination Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .testimonial__pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->add_control(
            'pagination_active_color',
            [
                'label'     => __( 'Pagination Active Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .testimonial__pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings        = $this->get_settings_for_display();
        $allowed   = wp_kses_allowed_html( 'post' );
        // $widget_id = $this->get_id();
        // $wrap_id   = 'testimonial-'.$widget_id;

        // Slider conf
        $loop     = ( $settings['slider_loop'] ?? 'yes' ) === 'yes';
        // $pagination     = ( $s['slider_pagination'] ?? 'yes' ) === 'yes';
        $autoplay = ( $settings['slider_autoplay'] ?? 'yes' ) === 'yes';
        $delay    = ! empty( $settings['slider_delay'] ) ? absint( $settings['slider_delay'] ) : 5000;
        $speed    = ! empty( $settings['slider_speed'] ) ? absint( $settings['slider_speed'] ) : 600;

        $spv_d    = ! empty( $settings['slides_per_view'] ) ? max( 1, (int) $settings['slides_per_view'] ) : 2;
        $spv_t    = ! empty( $settings['slides_per_view_tablet'] ) ? max( 1, (int) $settings['slides_per_view_tablet'] ) : 1;
        $spv_m    = ! empty( $settings['slides_per_view_mobile'] ) ? max( 1, (int) $settings['slides_per_view_mobile'] ) : 1;

        $space_d  = isset( $settings['space_between'] ) ? max( 0, (int) $settings['space_between'] ) : 24;
        $space_t  = isset( $settings['space_between_tablet'] ) ? max( 0, (int) $settings['space_between_tablet'] ) : 16;
        $space_m  = isset( $settings['space_between_mobile'] ) ? max( 0, (int) $settings['space_between_mobile'] ) : 12;

        // $style    = $s['style'] ?? 'style1';
        ?>
            
        <div class="hafsa">
            <div class="qoute-section padding-tb">
                <div class="qoute-section-wrapper">
                    <div class="qoute-overlay"></div>
                    <div class="container">
                        <div class="qoute-container">
                            <div class="swiper-wrapper">
                                <?php 
                                    if ( ! empty( $settings['repeat'] ) ) :
                                    foreach ( $settings['repeat'] as $item ) : 
                                ?>
                                <div class="swiper-slide">
                                    <div class="lab-item qoute-item">
                                        <div class="lab-inner d-flex align-items-center">
                                            <?php if(!empty($item['quote_title'])) : ?>
                                                <div class="lab-thumb">
                                                    <span><?php echo esc_html( $item['quote_title']); ?></span>

                                                    <?php if(!empty($item['block_icon'])) : ?>
                                                        <i class="<?php echo esc_attr($item['block_icon']); ?>"></i>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ( ! empty( $item['quote_text'] ) ) : ?>
                                                <div class="lab-content">
                                                    <blockquote class="blockquote">
                                                        <p><?php echo wp_kses( $item['quote_text'], $allowed ); ?></p>
                                                        <?php if ( ! empty( $item['quote_name'] ) ) : ?>
                                                            <footer class="blockquote-footer bg-transparent"><?php echo esc_html( $item['quote_name']); ?></footer>
                                                        <?php endif; ?>
                                                    </blockquote>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            (function($){
                $(function(){
                    var root = document.getElementById('<?php echo esc_js( $wrap_id ); ?>');
                    if (!root) return;
                    var slider = root.querySelector('.testimonial__slider');
                    if (!slider) return;

                    if (window.Swiper) {
                        var swiper = new Swiper(slider, {
                            loop: <?php echo $loop ? 'true' : 'false'; ?>,
                            speed: <?php echo (int) $speed; ?>,
                            autoplay: <?php echo $autoplay ? '{ delay: '.(int)$delay.', disableOnInteraction: false }' : 'false'; ?>,
                            slidesPerView: <?php echo (int) $spv_d; ?>,
                            spaceBetween: <?php echo (int) $space_d; ?>,
                            pagination: {
                                el: root.querySelector('.testimonial__pagination'),
                                clickable: true
                            },
                            breakpoints: {
                                0:   { slidesPerView: <?php echo (int) $spv_m; ?>, spaceBetween: <?php echo (int) $space_m; ?> },
                                768: { slidesPerView: <?php echo (int) $spv_t; ?>, spaceBetween: <?php echo (int) $space_t; ?> },
                                992: { slidesPerView: <?php echo (int) $spv_d; ?>, spaceBetween: <?php echo (int) $space_d; ?> }
                            }
                        });
                    }
                });
            })(jQuery);
        </script>
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

    $widgets_manager->register( new \Elementor\Theme_Hafsa_Quote() );
} );
