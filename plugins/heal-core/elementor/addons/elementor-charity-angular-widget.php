<?php
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

class Theme_Angular extends Widget_Base {

    public function get_name() {
        return 'angular-widget';
    }

    public function get_title() {
        return esc_html__( 'Angular Shape', 'heal-core' );
    }

    public function get_icon() {
        // Elementor built-in icon
        return 'theme-icon';
    }

    public function get_categories() {
        return [ 'heal_charity' ];
    }

    public function get_keywords() {
        return [ 'angular', 'shape' ];
    }

    public function get_script_depends() { return []; }
    public function get_style_depends()  { return []; }

    protected function register_controls() {

        /* -----------------------------
         * CONTENT: Section Header
         * ----------------------------- */
        $this->start_controls_section(
            'section_shape',
            [
                'label' => __( 'Choose Angle', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'style',
            [
                'label'   => esc_html__( 'Select Angle', 'heal-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__( 'Angle Top', 'heal-core' ),
                    'style2' => esc_html__( 'Angle Bottom', 'heal-core' ),
                ],
            ]
        );

        $this->end_controls_section();



        /* -----------------------------
         * STYLE: Angular
         * ----------------------------- */
        $this->start_controls_section(
            'style_item',
            [
                'label' => __( 'Angular Shape', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        // $this->add_responsive_control(
        //     'angular_padding',
        //     [
        //         'label'      => __( 'Padding', 'heal-core' ),
        //         'type'       => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px', 'em', '%' ],
        //         'selectors'  => [
        //             '{{WRAPPER}} .angular' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ],
        //     ]
        // );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'angle_top_bg',
                'label' => esc_html__( 'Background', 'heal-core' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .top-angle::before',
                'condition' => [
                    'style' => 'style1',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'angle_bottom_bg',
                'label' => esc_html__( 'Background', 'heal-core' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bottom-angle::before',
                'condition' => [
                    'style' => 'style2',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $allowed = wp_kses_allowed_html( 'post' );
        $widget_id = $this->get_id();
        $wrap_id   = 'angular-'.$widget_id;
    ?>  
        <?php if ( 'style1' === $settings['style'] ) : ?>
            <div class="angular">
                <div class="top-angle"></div>
            </div>

        <?php elseif ( 'style2' === $settings['style'] ) : ?>
            <div class="angular">
                <div class="bottom-angle"></div>
            </div>
        <?php endif; ?>

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

    $widgets_manager->register( new \Elementor\Theme_Angular() );
} );
