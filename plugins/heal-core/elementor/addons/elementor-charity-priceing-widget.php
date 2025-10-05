<?php
/**
 * Plugin Name: Heal Core - Price Widget (Single File)
 * Description: Elementor Pricing widget with Style controls and clean render.
 * Version:     1.0.3
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

class Theme_PricePlan extends Widget_Base {

    public function get_name() {
        return 'price-widget';
    }

    public function get_title() {
        return esc_html__( 'Price', 'heal-core' );
    }

    public function get_icon() {
        return 'theme-icon';
    }

    public function get_categories() {
        return [ 'heal_charity' ];
    }

    public function get_keywords() {
        return [ 'price', 'pricing', 'table', 'plan', 'packages' ];
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

        $this->add_control(
            'section_icon',
            [
                'label'       => esc_html__( 'Icon', 'heal-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-calendar-alt',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid'   => [ 'calendar-alt', 'tags', 'gem', 'star', 'check' ],
                    'fa-regular' => [ 'calendar', 'star' ],
                ],
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * CONTENT: Price Items
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
            'price_title',
            [
                'label'       => esc_html__( 'Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Service Title', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'price_amount',
            [
                'label'       => esc_html__( 'Price', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '$100', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'price_offer',
            [
                'label'       => esc_html__( 'Offer List', 'heal-core' ),
                'type'        => Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__( "• Feature one\n• Feature two", 'heal-core' ),
            ]
        );

        $repeater->add_control(
            'price_btn',
            [
                'label'       => esc_html__( 'Button Text', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Purchase', 'heal-core' ),
                'default'     => esc_html__( 'Purchase', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'price_btn_url',
            [
                'label'       => esc_html__( 'Button Url', 'heal-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://example.com/checkout', 'heal-core' ),
                'default'     => [ 'url' => '' ],
            ]
        );

        $repeater->add_control(
            'is_featured',
            [
                'label'        => esc_html__( 'Highlight Plan', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'heal-core' ),
                'label_off'    => esc_html__( 'No', 'heal-core' ),
                'default'      => 'no',
                'separator'    => 'before',
            ]
        );

        $repeater->add_control(
            'badge_text',
            [
                'label'       => esc_html__( 'Badge Text', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Popular', 'heal-core' ),
                'condition'   => [ 'is_featured' => 'yes' ],
            ]
        );

        $this->add_control(
            'price_items',
            [
                'label'       => esc_html__( 'Price Items', 'heal-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{ price_title }}',
            ]
        );

        // Responsive Columns (Bootstrap mapping in render())
        $this->add_responsive_control(
            'columns',
            [
                'label'        => __( 'Columns', 'heal-core' ),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    '12' => '1',
                    '6'  => '2',
                    '4'  => '3',
                    '3'  => '4',
                ],
                'default'         => '4',
                'desktop_default' => '4',
                'tablet_default'  => '6',
                'mobile_default'  => '12',
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
            'section_icon_color',
            [
                'label'     => __( 'Icon Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header .pricing-icon i, {{WRAPPER}} .section-header .pricing-icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};' ],
            ]
        );

        $this->add_control(
            'section_icon_border_color',
            [
                'label'     => __( 'Icon Border Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header .pricing-icon' => 'border-color: {{VALUE}};' ],
            ]
        );

        $this->add_responsive_control(
            'section_icon_size',
            [
                'label'     => __( 'Icon Size', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 10, 'max' => 120 ] ],
                'selectors' => [ '{{WRAPPER}} .section-header .pricing-icon i' => 'font-size: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_control(
            'section_title_color_style',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header h3' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'section_title_typo',
                'selector' => '{{WRAPPER}} .section-header h3',
            ]
        );

        $this->add_control(
            'section_desc_color_style',
            [
                'label'     => __( 'Description Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header p' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'section_desc_typo',
                'selector' => '{{WRAPPER}} .section-header p',
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
                'selectors' => [ '{{WRAPPER}} .pricing__item .pricing__inner' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'card_border',
                'selector' => '{{WRAPPER}} .pricing__item .pricing__inner',
            ]
        );

        $this->add_responsive_control(
            'card_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [ '{{WRAPPER}} .pricing__item .pricing__inner' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'card_shadow',
                'selector' => '{{WRAPPER}} .pricing__item .pricing__inner',
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .pricing__item .pricing__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Title & Amount
         * ----------------------------- */
        $this->start_controls_section(
            'style_headings',
            [
                'label' => __( 'Title & Amount', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'plan_title_color',
            [
                'label'     => __( 'Plan Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .pricing__head h5' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'plan_title_typo',
                'selector' => '{{WRAPPER}} .pricing__head h5',
            ]
        );

        $this->add_control(
            'amount_color',
            [
                'label'     => __( 'Amount Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .pricing__head h6' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'amount_typo',
                'selector' => '{{WRAPPER}} .pricing__head h6',
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Features
         * ----------------------------- */
        $this->start_controls_section(
            'style_features',
            [
                'label' => __( 'Features', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'features_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .pricing__body' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'features_typo',
                'selector' => '{{WRAPPER}} .pricing__body',
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Button
         * ----------------------------- */
        $this->start_controls_section(
            'style_button',
            [
                'label' => __( 'Button', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typo',
                'selector' => '{{WRAPPER}} .pricing__footer .default-btn',
            ]
        );

        $this->add_responsive_control(
            'btn_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .pricing__footer .default-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
                'selectors' => [ '{{WRAPPER}} .pricing__footer .default-btn' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->start_controls_tabs('btn_tabs');

        $this->start_controls_tab( 'btn_normal', [ 'label' => __( 'Normal', 'heal-core' ) ] );
        $this->add_control(
            'btn_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .pricing__footer .default-btn span' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_control(
            'btn_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .pricing__footer .default-btn::before' => 'background-color: {{VALUE}};' ],
            ]
        );
        $this->add_control(
            'btn_border_color',
            [
                'label'     => __( 'Border Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .pricing__footer .default-btn' => 'border-color: {{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'btn_hover', [ 'label' => __( 'Hover', 'heal-core' ) ] );
        $this->add_control(
            'btn_hover_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .pricing__footer .default-btn:hover span' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_control(
            'btn_hover_bg',
            [
                'label'     => __( 'Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .pricing__footer .default-btn:hover::before' => 'background-color: {{VALUE}};' ],
            ]
        );
        $this->add_control(
            'btn_hover_border_color',
            [
                'label'     => __( 'Border Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .pricing__footer .default-btn:hover' => 'border-color: {{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings    = $this->get_settings_for_display();
        $allowed     = wp_kses_allowed_html( 'post' ); // For WYSIWYG fields
        $widget_id   = $this->get_id();
        $wrapper_id  = 'pricing-'.$widget_id;

        // Responsive Columns → Bootstrap classes
        $col_d = (int)($settings['columns'] ?? 4);       // desktop (lg)
        $col_t = (int)($settings['columns_tablet'] ?? 6); // tablet (md)
        $col_m = (int)($settings['columns_mobile'] ?? 12);// mobile (xs)

        $valid = [12,6,4,3];
        if ( ! in_array($col_d, $valid, true) ) $col_d = 4;
        if ( ! in_array($col_t, $valid, true) ) $col_t = 6;
        if ( ! in_array($col_m, $valid, true) ) $col_m = 12;

        ?>
        <div id="<?php echo esc_attr( $wrapper_id ); ?>" class="pricing-section padding--top padding--bottom bg-ash">
            <div class="container">
                <div class="row">
                    <?php if( ! empty( $settings['section_title'] ) || ! empty( $settings['section_description'] ) || ! empty( $settings['section_icon'] ) ) : ?>
                        <div class="col-lg-4 col-12">
                            <div class="section-header style-4">
                                <?php if ( ! empty( $settings['section_icon'] ) ) : ?>
                                    <div class="pricing-icon" aria-hidden="true">
                                        <?php \Elementor\Icons_Manager::render_icon( $settings['section_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( ! empty( $settings['section_title'] ) ) : ?>
                                    <h3><?php echo wp_kses( $settings['section_title'], $allowed ); ?></h3>
                                <?php endif; ?>

                                <?php if( ! empty( $settings['section_description'] ) ) : ?>
                                    <p><?php echo wp_kses( $settings['section_description'], $allowed ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if( ! empty( $settings['price_items'] ) ) : ?>
                        <div class="col-lg-8 col-12">
                            <div class="pricing">
                                <div class="row g-0 align-items-stretch">
                                    <?php foreach ( $settings['price_items'] as $index => $item ) :
                                        // Link attributes (safe target, rel)
                                        $btn_key = 'btn_'.$index;
                                        if ( ! empty( $item['price_btn_url']['url'] ) ) {
                                            $this->add_link_attributes( $btn_key, $item['price_btn_url'] );
                                            $this->add_render_attribute( $btn_key, 'class', 'default-btn move-bottom' );
                                        }

                                        // Classes
                                        $item_classes = 'pricing__item priceing__item'; // keep both for compatibility
                                        if ( isset($item['is_featured']) && 'yes' === $item['is_featured'] ) {
                                            $item_classes .= ' is-featured';
                                        }
                                        ?>
                                        <div class="col-lg-<?php echo esc_attr($col_d); ?> col-md-<?php echo esc_attr($col_t); ?> col-<?php echo esc_attr($col_m); ?>">
                                            <div class="<?php echo esc_attr( $item_classes ); ?>">
                                                <div class="pricing__inner text-center">
                                                    <?php if ( ! empty( $item['badge_text'] ) && 'yes' === ( $item['is_featured'] ?? 'no' ) ) : ?>
                                                        <div class="pricing__badge"><?php echo esc_html( $item['badge_text'] ); ?></div>
                                                    <?php endif; ?>

                                                    <div class="pricing__content">
                                                        <?php if( ! empty( $item['price_title'] ) || ! empty( $item['price_amount'] ) ) : ?>
                                                            <div class="pricing__head">
                                                                <?php if( ! empty( $item['price_title'] ) ) : ?>
                                                                    <h5><?php echo esc_html( $item['price_title'] ); ?></h5>
                                                                <?php endif; ?>
                                                                <?php if( ! empty( $item['price_amount'] ) ) : ?>
                                                                    <h6><?php echo esc_html( $item['price_amount'] ); ?></h6>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if( ! empty( $item['price_offer'] ) ) : ?>
                                                            <div class="pricing__body">
                                                                <?php echo wp_kses( $item['price_offer'], $allowed ); ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if( ! empty( $item['price_btn_url']['url'] ) ) : ?>
                                                            <div class="pricing__footer">
                                                                <a <?php echo $this->get_render_attribute_string( $btn_key ); ?>>
                                                                    <span><?php echo esc_html( $item['price_btn'] ?: esc_html__('Purchase', 'heal-core') ); ?></span>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div><!-- /.pricing__content -->
                                                </div><!-- /.pricing__inner -->
                                            </div><!-- /.pricing__item -->
                                        </div>
                                    <?php endforeach; ?>
                                </div><!-- /.row -->
                            </div><!-- /.pricing -->
                        </div>
                    <?php endif; ?>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.pricing-section -->
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

    $widgets_manager->register( new \Elementor\Theme_PricePlan() );
} );
