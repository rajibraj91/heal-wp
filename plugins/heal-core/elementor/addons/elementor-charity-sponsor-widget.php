<?php
/**
 * Plugin Name: Heal Core - Sponsor Widget (Single File)
 * Description: Elementor Sponsor/Partner logo slider with full Style & Slider controls.
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

class Theme_Sponsor extends Widget_Base {

    public function get_name() {
        return 'sponsor-widget';
    }

    public function get_title() {
        return esc_html__( 'Sponsor', 'heal-core' );
    }

    public function get_icon() {
        // Elementor built-in icon
        return 'theme-icon';
    }

    public function get_categories() {
        return [ 'heal_charity' ];
    }

    public function get_keywords() {
        return [ 'sponsor', 'partner', 'logo', 'brand', 'carousel', 'slider' ];
    }

    public function get_script_depends() { return []; }
    public function get_style_depends()  { return []; }

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
            'section_title',
            [
                'label'       => esc_html__( 'Section Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => esc_html__( 'Our Sponsors', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * CONTENT: Items
         * ----------------------------- */
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Logos', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'sponsor_img',
            [
                'label'   => esc_html__( 'Image', 'heal-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            ]
        );

        $repeater->add_control(
            'sponsor_img_alt',
            [
                'label'       => esc_html__( 'Image Alt / SEO Text', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Brand name', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'sponsor_link',
            [
                'label'       => esc_html__( 'Link (optional)', 'heal-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://brand.com', 'heal-core' ),
                'default'     => [ 'url' => '' ],
            ]
        );

        $this->add_control(
            'sponsor_items',
            [
                'label'       => esc_html__( 'Sponsor Items', 'heal-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ sponsor_img_alt }}}',
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * CONTENT: Slider Settings
         * ----------------------------- */
        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __( 'Slider Settings', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slider_loop',
            [
                'label'        => esc_html__( 'Loop', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'heal-core' ),
                'label_off'    => esc_html__( 'No', 'heal-core' ),
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'        => esc_html__( 'Autoplay', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'heal-core' ),
                'label_off'    => esc_html__( 'No', 'heal-core' ),
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'slider_delay',
            [
                'label'     => esc_html__( 'Autoplay Delay (ms)', 'heal-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 4000,
                'min'       => 1000,
                'max'       => 15000,
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
                'default'         => 5,
                'min'             => 1,
                'max'             => 10,
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'tablet_default'  => 3,
                'mobile_default'  => 2,
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
         * STYLE: Section Header
         * ----------------------------- */
        $this->start_controls_section(
            'style_section_header',
            [
                'label' => __( 'Section Header', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header h4' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'selector' => '{{WRAPPER}} .section-header h4',
            ]
        );

        $this->add_responsive_control(
            'header_margin_bottom',
            [
                'label'      => __( 'Header Bottom Spacing', 'heal-core' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [ 'px' => [ 'min' => 0, 'max' => 200 ] ],
                'selectors'  => [ '{{WRAPPER}} .section-header' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Item/Card
         * ----------------------------- */
        $this->start_controls_section(
            'style_item',
            [
                'label' => __( 'Item', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [ 'name' => 'item_border', 'selector' => '{{WRAPPER}} .partner__item .partner__inner' ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'item_shadow', 'selector' => '{{WRAPPER}} .partner__item .partner__inner' ]
        );

        $this->add_responsive_control(
            'item_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [ '{{WRAPPER}} .partner__item .partner__inner' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .partner__item .partner__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Image
         * ----------------------------- */
        $this->start_controls_section(
            'style_image',
            [
                'label' => __( 'Image', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'img_max_height',
            [
                'label'     => __( 'Max Height (px)', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 20, 'max' => 200 ] ],
                'selectors' => [ '{{WRAPPER}} .partner__thumb img' => 'max-height: {{SIZE}}{{UNIT}}; height:auto;' ],
            ]
        );

        $this->add_responsive_control(
            'img_fit',
            [
                'label'   => __( 'Object Fit', 'heal-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''        => __( 'Default', 'heal-core' ),
                    'contain' => 'contain',
                    'cover'   => 'cover',
                    'fill'    => 'fill',
                    'scale-down' => 'scale-down',
                ],
                'selectors' => [ '{{WRAPPER}} .partner__thumb img' => 'object-fit: {{VALUE}};' ],
            ]
        );

        $this->add_responsive_control(
            'img_radius',
            [
                'label'     => __( 'Image Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [ '{{WRAPPER}} .partner__thumb img' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_control(
            'img_grayscale',
            [
                'label'        => __( 'Grayscale', 'heal-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
                'default'      => [ 'size' => 0 ],
                'selectors'    => [ '{{WRAPPER}} .partner__thumb img' => 'filter: grayscale({{SIZE}}%);' ],
            ]
        );

        $this->add_responsive_control(
            'img_opacity',
            [
                'label'     => __( 'Opacity', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 1, 'step' => 0.05 ] ],
                'default'   => [ 'size' => 1 ],
                'selectors' => [ '{{WRAPPER}} .partner__thumb img' => 'opacity: {{SIZE}};' ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        $allowed = wp_kses_allowed_html( 'post' );
        $widget_id = $this->get_id();
        $wrap_id   = 'partner-'.$widget_id;

        // Slider settings with fallbacks
        $loop         = ( $s['slider_loop'] ?? 'yes' ) === 'yes';
        $autoplay     = ( $s['slider_autoplay'] ?? 'yes' ) === 'yes';
        $delay        = ! empty( $s['slider_delay'] ) ? absint( $s['slider_delay'] ) : 4000;
        $speed        = ! empty( $s['slider_speed'] ) ? absint( $s['slider_speed'] ) : 600;

        $spv_d        = ! empty( $s['slides_per_view'] ) ? max( 1, (int) $s['slides_per_view'] ) : 5;
        $spv_t        = ! empty( $s['slides_per_view_tablet'] ) ? max( 1, (int) $s['slides_per_view_tablet'] ) : 3;
        $spv_m        = ! empty( $s['slides_per_view_mobile'] ) ? max( 1, (int) $s['slides_per_view_mobile'] ) : 2;

        $space_d      = isset( $s['space_between'] ) ? max( 0, (int) $s['space_between'] ) : 24;
        $space_t      = isset( $s['space_between_tablet'] ) ? max( 0, (int) $s['space_between_tablet'] ) : 16;
        $space_m      = isset( $s['space_between_mobile'] ) ? max( 0, (int) $s['space_between_mobile'] ) : 12;
        ?>
        <div id="<?php echo esc_attr( $wrap_id ); ?>" class="partner-section padding--top padding--bottom">
            <div class="container">
                <div class="partner">
                    <?php if ( ! empty( $s['section_title'] ) ) : ?>
                        <div class="section-header style-3">
                            <h4><?php echo wp_kses( $s['section_title'], $allowed ); ?></h4>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $s['sponsor_items'] ) ) : ?>
                        <div class="section-wrapper">
                            <div class="partner__slider overflow-hidden">
                                <div class="swiper-wrapper">
                                    <?php foreach ( $s['sponsor_items'] as $index => $item ) :
                                        $img  = $item['sponsor_img']['url'] ?? '';
                                        if ( empty( $img ) ) { continue; }
                                        $alt  = $item['sponsor_img_alt'] ?? '';
                                        $link = $item['sponsor_link']['url'] ?? '';

                                        $link_key = 'sponsor_link_'.$index;
                                        if ( ! empty( $link ) ) {
                                            $this->add_link_attributes( $link_key, $item['sponsor_link'] );
                                            $this->add_render_attribute( $link_key, 'class', 'partner__link' );
                                            $this->add_render_attribute( $link_key, 'aria-label', esc_attr( $alt ?: __( 'Sponsor', 'heal-core' ) ) );
                                        }
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="partner__item">
                                                <div class="partner__inner text-center">
                                                    <div class="partner__thumb">
                                                        <?php if ( ! empty( $link ) ) : ?>
                                                            <a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
                                                                <img src="<?php echo esc_url( $img ); ?>"
                                                                     alt="<?php echo esc_attr( $alt ); ?>"
                                                                     loading="lazy" decoding="async">
                                                            </a>
                                                        <?php else : ?>
                                                            <img src="<?php echo esc_url( $img ); ?>"
                                                                 alt="<?php echo esc_attr( $alt ); ?>"
                                                                 loading="lazy" decoding="async">
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <p><?php echo esc_html__( 'No sponsors added.', 'heal-core' ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <script>
        (function($){
            $(function(){
                var root = document.getElementById('<?php echo esc_js( $wrap_id ); ?>');
                if (!root) return;
                var sliderEl = root.querySelector('.partner__slider');
                if (!sliderEl) return;

                if (window.Swiper) {
                    var swiper = new Swiper(sliderEl, {
                        loop: <?php echo $loop ? 'true' : 'false'; ?>,
                        speed: <?php echo (int) $speed; ?>,
                        autoplay: <?php echo $autoplay ? '{ delay: '.(int)$delay.', disableOnInteraction: false }' : 'false'; ?>,
                        slidesPerView: <?php echo (int) $spv_d; ?>,
                        spaceBetween: <?php echo (int) $space_d; ?>,
                        breakpoints: {
                            0:   { slidesPerView: <?php echo (int) $spv_m; ?>, spaceBetween: <?php echo (int) $space_m; ?> },
                            768: { slidesPerView: <?php echo (int) $spv_t; ?>, spaceBetween: <?php echo (int) $space_t; ?> },
                            992: { slidesPerView: <?php echo (int) $spv_d; ?>, spaceBetween: <?php echo (int) $space_d; ?> },
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

    $widgets_manager->register( new \Elementor\Theme_Sponsor() );
} );
