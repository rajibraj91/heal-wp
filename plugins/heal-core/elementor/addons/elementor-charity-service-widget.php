<?php
/**
 * Plugin Name: Heal Core - Service Widget (Single File)
 * Description: Elementor Services widget with full Style controls.
 * Version:     1.0.2
 * Author:      Your Name
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
    // Elementor inactive
    return;
}

class Theme_Service extends Widget_Base {

    public function get_name() {
        return 'service-widget';
    }

    public function get_title() {
        return esc_html__( 'Services', 'heal-core' );
    }

    public function get_icon() {
        return 'theme-icon';
    }

    public function get_categories() {
        return [ 'heal_charity' ];
    }

    public function get_keywords() {
        return [ 'service', 'feature', 'icon', 'cards' ];
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
                'placeholder' => esc_html__( 'Enter title text', 'heal-core' ),
                'label_block' => true,
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
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * CONTENT: Service Items
         * ----------------------------- */
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Block', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'service_icon_switcher',
            [
                'label'        => esc_html__( 'Show Icon', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'heal-core' ),
                'label_off'    => esc_html__( 'Hide', 'heal-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater->add_control(
            'service_icon',
            [
                'label'       => esc_html__( 'Icon', 'heal-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid'   => [ 'star', 'gem', 'rocket', 'bolt', 'check' ],
                    'fa-regular' => [ 'star', 'circle' ],
                ],
                'condition'   => [ 'service_icon_switcher' => 'yes' ],
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label'       => esc_html__( 'Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Service Title', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'service_desc',
            [
                'label'       => esc_html__( 'Description', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Description', 'heal-core' ),
            ]
        );

        $this->add_control(
            'service_items',
            [
                'label'       => esc_html__( 'Service Items', 'heal-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{ service_title }}',
            ]
        );

        // Responsive Columns (Bootstrap mapping will be done in render())
        $this->add_responsive_control(
            'columns',
            [
                'label'           => __( 'Columns', 'heal-core' ),
                'type'            => Controls_Manager::SELECT,
                'options'         => [
                    '12' => '1',
                    '6'  => '2',
                    '4'  => '3',
                    '3'  => '4',
                ],
                'default'         => '4',
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '4',
                'tablet_default'  => '6',
                'mobile_default'  => '12',
                // ইচ্ছাকৃতভাবেই এখানে selectors বাদ — render()-এ ডাইনামিক col-* ক্লাস দেব
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
            'sh_title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header h2' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'sh_title_typo', 'selector' => '{{WRAPPER}} .section-header h2' ]
        );

        $this->add_control(
            'sh_desc_color',
            [
                'label'     => __( 'Description Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header p' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'sh_desc_typo', 'selector' => '{{WRAPPER}} .section-header p' ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Grid & Gap
         * ----------------------------- */
        $this->start_controls_section(
            'style_grid',
            [
                'label' => __( 'Grid', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // নোট: Bootstrap gutter class (g-4) থাকলে gap না-ও কাজ করতে পারে; কাস্টম লেআউটে ভালো কাজ করে
        $this->add_responsive_control(
            'grid_gap',
            [
                'label'     => __( 'Grid Gap', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 60 ] ],
                'selectors' => [ '{{WRAPPER}} .row.g-4' => 'gap: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Card / Item
         * ----------------------------- */
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
                'selectors' => [ '{{WRAPPER}} .service__item .service__inner' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [ 'name' => 'card_border', 'selector' => '{{WRAPPER}} .service__item .service__inner' ]
        );

        $this->add_responsive_control(
            'card_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [ '{{WRAPPER}} .service__item .service__inner' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'card_shadow', 'selector' => '{{WRAPPER}} .service__item .service__inner' ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .service__item .service__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Icon
         * ----------------------------- */
        $this->start_controls_section(
            'style_icon',
            [
                'label' => __( 'Icon', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => __( 'Icon Size', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 10, 'max' => 120 ] ],
                'selectors' => [ '{{WRAPPER}} .service__icon i, {{WRAPPER}} .service__icon svg' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .service__icon i, {{WRAPPER}} .service__icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};' ],
            ]
        );

        $this->add_control(
            'icon_bg',
            [
                'label'     => __( 'Icon BG', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .service__icon' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => __( 'Icon Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .service__icon' => 'display:inline-flex; align-items:center; justify-content:center; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'     => __( 'Icon Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
                'selectors' => [ '{{WRAPPER}} .service__icon' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Title & Description
         * ----------------------------- */
        $this->start_controls_section(
            'style_texts',
            [
                'label' => __( 'Title & Description', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .service__content h5' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'title_typo', 'selector' => '{{WRAPPER}} .service__content h5' ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => __( 'Description Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .service__content p' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'desc_typo', 'selector' => '{{WRAPPER}} .service__content p' ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $allowed  = wp_kses_allowed_html( 'post' );

        // Map responsive Columns → Bootstrap classes
        $col_d = (int)($settings['columns'] ?? 4);        // desktop lg
        $col_t = (int)($settings['columns_tablet'] ?? 6); // tablet  md
        $col_m = (int)($settings['columns_mobile'] ?? 12);// mobile  xs

        $valid = [12,6,4,3];
        if ( ! in_array($col_d, $valid, true) ) $col_d = 4;
        if ( ! in_array($col_t, $valid, true) ) $col_t = 6;
        if ( ! in_array($col_m, $valid, true) ) $col_m = 12;

        ?>
        <div class="service-section padding--top padding--bottom">
            <div class="container">
                <?php if ( ! empty( $settings['section_title'] ) || ! empty( $settings['section_description'] ) ) : ?>
                    <div class="section-header style-2">
                        <?php if ( ! empty( $settings['section_title'] ) ) : ?>
                            <h2><?php echo wp_kses( $settings['section_title'], $allowed ); ?></h2>
                        <?php endif; ?>
                        <?php if ( ! empty( $settings['section_description'] ) ) : ?>
                            <p><?php echo wp_kses( $settings['section_description'], $allowed ); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $settings['service_items'] ) ) : ?>
                    <div class="service">
                        <div class="row g-4 justify-content-center">
                            <?php foreach ( $settings['service_items'] as $item ) : ?>
                                <div class="col-lg-<?php echo esc_attr($col_d); ?> col-md-<?php echo esc_attr($col_t); ?> col-<?php echo esc_attr($col_m); ?>">
                                    <div class="service__item">
                                        <div class="service__inner text-center">
                                            <?php if ( ( $item['service_icon_switcher'] ?? '' ) === 'yes' && ! empty( $item['service_icon'] ) ) : ?>
                                                <div class="service__icon" aria-hidden="true">
                                                    <?php \Elementor\Icons_Manager::render_icon( $item['service_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="service__content">
                                                <?php if ( ! empty( $item['service_title'] ) ) : ?>
                                                    <h5><?php echo esc_html( $item['service_title'] ); ?></h5>
                                                <?php endif; ?>
                                                <?php if ( ! empty( $item['service_desc'] ) ) : ?>
                                                    <p><?php echo esc_html( $item['service_desc'] ); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <p><?php echo esc_html__( 'No service items found.', 'heal-core' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
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

    $widgets_manager->register( new \Elementor\Theme_Service() );
} );
