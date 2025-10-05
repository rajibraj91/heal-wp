<?php
/**
 * Plugin Name: Heal Core - Sermon Widget (Single File)
 * Description: Elementor Sermon widget with slider, accordion & style controls.
 * Version:     1.0.1
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

class Theme_Sermon extends Widget_Base {

    public function get_name() {
        return 'sermon-widget';
    }

    public function get_title() {
        return esc_html__( 'Sermon', 'heal-core' );
    }

    public function get_icon() {
        // Elementor icon library
        return 'theme-icon';
    }

    public function get_categories() {
        return [ 'heal_charity' ];
    }

    public function get_keywords() {
        return [ 'sermon', 'post', 'church', 'slider', 'accordion' ];
    }

    public function get_script_depends() { return []; } // keep empty; inline safe-check used
    public function get_style_depends()  { return []; }

    protected function register_controls() {

        /* -----------------------------
         * CONTENT: Section Header (Left)
         * ----------------------------- */
        $this->start_controls_section(
            'section_heading',
            [
                'label' => __( 'Section Header (Left)', 'heal-core' ),
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
            'sermon_icon_switch',
            [
                'label'        => esc_html__( 'Show Media Icons', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => esc_html__( 'Yes', 'heal-core' ),
                'label_off'    => esc_html__( 'No', 'heal-core' ),
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'sermon_time_switch',
            [
                'label'        => esc_html__( 'Show Date/Time', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => esc_html__( 'Yes', 'heal-core' ),
                'label_off'    => esc_html__( 'No', 'heal-core' ),
            ]
        );

        $this->add_control(
            'sermon_btn_switch',
            [
                'label'        => esc_html__( 'Show Button', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => esc_html__( 'Yes', 'heal-core' ),
                'label_off'    => esc_html__( 'No', 'heal-core' ),
            ]
        );

        $this->add_control(
            'sermon_btn_text',
            [
                'label'       => esc_html__( 'Button Text', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read On', 'heal-core' ),
                'condition'   => [ 'sermon_btn_switch' => 'yes' ],
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * CONTENT: Query Options
         * ----------------------------- */
        $this->start_controls_section(
            'sermon_query',
            [
                'label' => __( 'Posts Query', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => esc_html__( 'Posts Per Page', 'heal-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
                'min'     => 1,
                'max'     => 24,
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Order', 'heal-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => 'DESC',
                    'ASC'  => 'ASC',
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order By', 'heal-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'          => esc_html__( 'Date', 'heal-core' ),
                    'title'         => esc_html__( 'Title', 'heal-core' ),
                    'menu_order'    => esc_html__( 'Menu Order', 'heal-core' ),
                    'rand'          => esc_html__( 'Random', 'heal-core' ),
                ],
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label'   => esc_html__( 'Excerpt Words', 'heal-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 20,
                'min'     => 5,
                'max'     => 80,
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * CONTENT: Right "What We Do" Accordion
         * ----------------------------- */
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Right Block: What We Do', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'wwd_section_title',
            [
                'label'       => esc_html__( 'Section Title', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => esc_html__( 'Enter title text', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wwd_section_description',
            [
                'label'       => esc_html__( 'Description', 'heal-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => esc_html__( 'Enter description', 'heal-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wwd_accordion_items',
            [
                'label'       => esc_html__( 'Accordion Items', 'heal-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => [
                    [
                        'name'  => 'aci_title',
                        'label' => esc_html__( 'Title', 'heal-core' ),
                        'type'  => Controls_Manager::TEXT,
                        'default' => '',
                    ],
                    [
                        'name'  => 'aci_image',
                        'label' => esc_html__( 'Image', 'heal-core' ),
                        'type'  => Controls_Manager::MEDIA,
                        'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                    ],
                    [
                        'name'  => 'aci_content',
                        'label' => esc_html__( 'Content', 'heal-core' ),
                        'type'  => Controls_Manager::TEXTAREA,
                        'default' => '',
                    ],
                ],
                'title_field' => '{{ aci_title }}',
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Left Header
         * ----------------------------- */
        $this->start_controls_section(
            'style_left_header',
            [
                'label' => __( 'Left Header', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'lh_title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sermon__left .section-header h3' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'lh_title_typo', 'selector' => '{{WRAPPER}} .sermon__left .section-header h3' ]
        );

        $this->add_control(
            'lh_desc_color',
            [
                'label'     => __( 'Description Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sermon__left .section-header p' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'lh_desc_typo', 'selector' => '{{WRAPPER}} .sermon__left .section-header p' ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Sermon Card
         * ----------------------------- */
        $this->start_controls_section(
            'style_card',
            [
                'label' => __( 'Sermon Card', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_bg',
            [
                'label'     => __( 'Card Background', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sermon__item .sermon__inner' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [ 'name' => 'card_border', 'selector' => '{{WRAPPER}} .sermon__item .sermon__inner' ]
        );

        $this->add_responsive_control(
            'card_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [ '{{WRAPPER}} .sermon__item .sermon__inner' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'card_shadow', 'selector' => '{{WRAPPER}} .sermon__item .sermon__inner' ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .sermon__item .sermon__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Title/Time/Excerpt
         * ----------------------------- */
        $this->start_controls_section(
            'style_texts',
            [
                'label' => __( 'Title / Time / Excerpt', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_title_color',
            [ 'label'=>__('Title Color','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .sermon__content h5'=>'color: {{VALUE}};'] ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name'=>'post_title_typo','selector'=>'{{WRAPPER}} .sermon__content h5' ]
        );

        $this->add_control(
            'post_time_color',
            [ 'label'=>__('Time Color','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .sermon__content span'=>'color: {{VALUE}};'] ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name'=>'post_time_typo','selector'=>'{{WRAPPER}} .sermon__content span' ]
        );

        $this->add_control(
            'excerpt_color',
            [ 'label'=>__('Excerpt Color','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .sermon__content p'=>'color: {{VALUE}};'] ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name'=>'excerpt_typo','selector'=>'{{WRAPPER}} .sermon__content p' ]
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
                'condition' => [ 'sermon_btn_switch' => 'yes' ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name'=>'btn_typo','selector'=>'{{WRAPPER}} .sermon__content .default-btn' ]
        );

        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => __( 'Padding','heal-core' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units'=>['px','em','%'],
                'selectors'=>['{{WRAPPER}} .sermon__content .default-btn'=>'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );

        $this->add_responsive_control(
            'btn_radius',
            [
                'label'=>__('Border Radius','heal-core'),
                'type'=>Controls_Manager::SLIDER,
                'range'=>['px'=>['min'=>0,'max'=>50]],
                'selectors'=>['{{WRAPPER}} .sermon__content .default-btn'=>'border-radius: {{SIZE}}{{UNIT}};'],
            ]
        );

        $this->start_controls_tabs('btn_tabs');
        $this->start_controls_tab('btn_normal',[ 'label'=>__('Normal','heal-core') ]);
        $this->add_control('btn_color',[ 'label'=>__('Text','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .sermon__content .default-btn span'=>'color: {{VALUE}};'] ]);
        $this->add_control('btn_bg',[ 'label'=>__('Background','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .sermon__content .default-btn::before'=>'background-color: {{VALUE}};'] ]);
        $this->add_control('btn_border',[ 'label'=>__('Border Color','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .sermon__content .default-btn'=>'border-color: {{VALUE}};'] ]);
        $this->end_controls_tab();
        $this->start_controls_tab('btn_hover',[ 'label'=>__('Hover','heal-core') ]);
        $this->add_control('btn_hover_color',[ 'label'=>__('Text','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .sermon__content .default-btn:hover span'=>'color: {{VALUE}};'] ]);
        $this->add_control('btn_hover_bg',[ 'label'=>__('Background','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .sermon__content .default-btn:hover::before'=>'background-color: {{VALUE}};'] ]);
        $this->add_control('btn_hover_border',[ 'label'=>__('Border Hover Color','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .sermon__content .default-btn:hover'=>'border-color: {{VALUE}};'] ]);
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Icon Links (video/audio/notes/download)
         * ----------------------------- */
        $this->start_controls_section(
            'style_icons',
            [
                'label' => __( 'Media Icons', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'=>__('Icon Size','heal-core'),
                'type'=>Controls_Manager::SLIDER,
                'range'=>['px'=>['min'=>10,'max'=>60]],
                'selectors'=>['{{WRAPPER}} .sermon-links i'=>'font-size: {{SIZE}}{{UNIT}};'],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'=>__('Icon Color','heal-core'),
                'type'=>Controls_Manager::COLOR,
                'selectors'=>['{{WRAPPER}} .sermon-links a'=>'color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'icon_border_color',
            [
                'label'=>__('Border Color','heal-core'),
                'type'=>Controls_Manager::COLOR,
                'selectors'=>['{{WRAPPER}} .sermon-links a'=>'border-color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'=>__('Icon Hover Color','heal-core'),
                'type'=>Controls_Manager::COLOR,
                'selectors'=>['{{WRAPPER}} .sermon-links a:hover'=>'color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label'=>__('Border Color','heal-core'),
                'type'=>Controls_Manager::COLOR,
                'selectors'=>['{{WRAPPER}} .sermon-links a:hover'=>'border-color: {{VALUE}};'],
            ]
        );

        $this->end_controls_section();

        /* -----------------------------
         * STYLE: Right Header & Accordion
         * ----------------------------- */
        $this->start_controls_section(
            'style_right',
            [
                'label' => __( 'Right Block (Header + Accordion)', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rh_title_color',
            [ 'label'=>__('Right Title Color','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .sermon__right .section-header h3'=>'color: {{VALUE}};'] ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name'=>'rh_title_typo','selector'=>'{{WRAPPER}} .sermon__right .section-header h3' ]
        );

        $this->add_control(
            'rh_desc_color',
            [ 'label'=>__('Right Description Color','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .sermon__right .section-header p'=>'color: {{VALUE}};'] ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name'=>'rh_desc_typo','selector'=>'{{WRAPPER}} .sermon__right .section-header p' ]
        );

        $this->add_control(
            'acc_title_color',
            [ 'label'=>__('Accordion Title Color','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .accordion-button'=>'color: {{VALUE}};'] ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name'=>'acc_title_typo','selector'=>'{{WRAPPER}} .accordion-button' ]
        );

        $this->add_control(
            'acc_body_color',
            [ 'label'=>__('Accordion Body Text','heal-core'),'type'=>Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .accordion-body'=>'color: {{VALUE}};'] ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [ 'name'=>'acc_border','selector'=>'{{WRAPPER}} .accordion-item' ]
        );

        $this->add_responsive_control(
            'acc_radius',
            [
                'label'=>__('Accordion Radius','heal-core'),
                'type'=>Controls_Manager::SLIDER,
                'range'=>['px'=>['min'=>0,'max'=>30]],
                'selectors'=>['{{WRAPPER}} .accordion-item'=>'border-radius: {{SIZE}}{{UNIT}}; overflow: hidden;'],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $allowed    = wp_kses_allowed_html( 'post' );
        $widget_id  = $this->get_id();
        $wrap_id    = 'sermon-'.$widget_id;
        $acc_id     = 'accordion-'.$widget_id; // unique accordion id

        // Query posts
        $ppp     = ! empty( $settings['posts_per_page'] ) ? absint( $settings['posts_per_page'] ) : 6;
        $order   = in_array( $settings['order'] ?? 'DESC', ['ASC','DESC'], true ) ? $settings['order'] : 'DESC';
        $orderby = in_array( $settings['orderby'] ?? 'date', ['date','title','menu_order','rand'], true ) ? $settings['orderby'] : 'date';
        $excerpt = ! empty( $settings['excerpt_length'] ) ? absint( $settings['excerpt_length'] ) : 20;

        $args = [
            'post_type'      => 'sermon',
            'posts_per_page' => $ppp,
            'order'          => $order,
            'orderby'        => $orderby,
            'no_found_rows'  => true,
        ];
        $query = new \WP_Query( $args );
        ?>
        <div id="<?php echo esc_attr( $wrap_id ); ?>" class="sermon-section padding--top padding--bottom">
            <div class="container">
                <div class="sermon">
                    <div class="row g-4">
                        <!-- Left: Sermon Slider -->
                        <div class="col-lg-8 col-12">
                            <div class="sermon__left">
                                <?php if ( ! empty( $settings['section_title'] ) || ! empty( $settings['section_description'] ) ) : ?>
                                <div class="section-header style-4">
                                    <?php if ( ! empty( $settings['section_title'] ) ) : ?>
                                        <h3><?php echo wp_kses( $settings['section_title'], $allowed ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $settings['section_description'] ) ) : ?>
                                        <p><?php echo wp_kses( $settings['section_description'], $allowed ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>

                                <div class="section-wrapper">
                                    <div class="sermon__slider overflow-hidden">
                                        <?php if ( $query->have_posts() ) : ?>
                                            <div class="swiper-wrapper">
                                                <?php
                                                $count = 0;
                                                while ( $query->have_posts() ) :
                                                    $query->the_post();

                                                    // Fetch meta values
                                                    $post_meta = get_post_meta( get_the_ID(), 'heal_sermon_options', true );
                                                    $video     = ! empty( $post_meta['sermon_video'] )    ? $post_meta['sermon_video']    : '';
                                                    $audio     = ! empty( $post_meta['sermon_audio'] )    ? $post_meta['sermon_audio']    : '';
                                                    $notes     = ! empty( $post_meta['sermon_notes'] )    ? $post_meta['sermon_notes']    : '';
                                                    $download  = ! empty( $post_meta['sermon_download'] ) ? $post_meta['sermon_download'] : '';

                                                    if ( 0 === $count % 2 ) {
                                                        echo '<div class="swiper-slide">';
                                                    }
                                                    ?>
                                                    <div class="sermon__item">
                                                        <div class="sermon__inner">
                                                            <div class="sermon__thumb">
                                                                <?php if ( 'yes' === ( $settings['sermon_icon_switch'] ?? 'yes' ) ) : ?>
                                                                    <div class="sermon__social">
                                                                        <ul class="sermon-links">
                                                                            <?php if ( $video ) : ?>
                                                                                <li><a href="<?php echo esc_url( $video ); ?>" target="_blank" rel="noopener"><i class="fas fa-video"></i></a></li>
                                                                            <?php endif; ?>
                                                                            <?php if ( $audio ) : ?>
                                                                                <li><a href="<?php echo esc_url( $audio ); ?>" target="_blank" rel="noopener"><i class="fas fa-microphone"></i></a></li>
                                                                            <?php endif; ?>
                                                                            <?php if ( $notes ) : ?>
                                                                                <li><a href="<?php echo esc_url( $notes ); ?>" data-rel="lightbox"><i class="fas fa-book"></i></a></li>
                                                                            <?php endif; ?>
                                                                            <?php if ( $download ) : ?>
                                                                                <li><a href="<?php echo esc_url( $download ); ?>" download><i class="fas fa-cloud-download-alt"></i></a></li>
                                                                            <?php endif; ?>
                                                                        </ul>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <div class="sermon__image">
                                                                    <?php
                                                                    if ( has_post_thumbnail() ) {
                                                                        the_post_thumbnail( 'large', [ 'class' => 'img-fluid', 'loading' => 'lazy' ] );
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            <div class="sermon__content">
                                                                <a href="<?php echo esc_url( get_permalink() ); ?>">
                                                                    <h5><?php echo esc_html( get_the_title() ); ?></h5>
                                                                </a>

                                                                <?php if ( 'yes' === ( $settings['sermon_time_switch'] ?? 'yes' ) ) : ?>
                                                                    <span><?php echo esc_html__( 'Time:', 'heal-core' ); ?> <?php echo esc_html( get_the_date() ); ?></span>
                                                                <?php endif; ?>

                                                                <?php if ( $excerpt > 0 ) : ?>
                                                                    <p><?php echo esc_html( wp_trim_words( get_the_content(), $excerpt ) ); ?></p>
                                                                <?php endif; ?>

                                                                <?php if ( 'yes' === ( $settings['sermon_btn_switch'] ?? 'yes' ) ) : ?>
                                                                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="default-btn move-bottom">
                                                                        <span><?php echo esc_html( $settings['sermon_btn_text'] ?: esc_html__( 'Read On', 'heal-core' ) ); ?></span>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $count++;
                                                    if ( 0 === $count % 2 ) {
                                                        echo '</div>'; // close .swiper-slide
                                                    }
                                                endwhile;
                                                if ( 0 !== $count % 2 ) {
                                                    echo '</div>'; // close last .swiper-slide if odd
                                                }
                                                wp_reset_postdata();
                                                ?>
                                            </div>
                                        <?php else : ?>
                                            <p><?php echo esc_html__( 'No sermons found.', 'heal-core' ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right: What We Do Accordion -->
                        <div class="col-lg-4 col-12">
                            <div class="sermon__right">
                                <?php if ( ! empty( $settings['wwd_section_title'] ) || ! empty( $settings['wwd_section_description'] ) ) : ?>
                                <div class="section-header style-4">
                                    <?php if ( ! empty( $settings['wwd_section_title'] ) ) : ?>
                                        <h3><?php echo wp_kses( $settings['wwd_section_title'], $allowed ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $settings['wwd_section_description'] ) ) : ?>
                                        <p><?php echo wp_kses( $settings['wwd_section_description'], $allowed ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>

                                <div class="section-wrapper">
                                    <div class="accordion" id="<?php echo esc_attr( $acc_id ); ?>">
                                        <?php if ( ! empty( $settings['wwd_accordion_items'] ) && is_array( $settings['wwd_accordion_items'] ) ) : ?>
                                            <?php foreach ( $settings['wwd_accordion_items'] as $index => $item ) :
                                                $hid = 'heading-'.$widget_id.'-'.$index;
                                                $cid = 'collapse-'.$widget_id.'-'.$index;
                                                $is_first = ( 0 === $index );
                                                ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="<?php echo esc_attr( $hid ); ?>">
                                                        <button class="accordion-button <?php echo $is_first ? '' : 'collapsed'; ?>"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#<?php echo esc_attr( $cid ); ?>"
                                                            aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                                                            aria-controls="<?php echo esc_attr( $cid ); ?>">
                                                            <?php echo esc_html( $item['aci_title'] ?? '' ); ?>
                                                        </button>
                                                    </h2>
                                                    <div id="<?php echo esc_attr( $cid ); ?>"
                                                         class="accordion-collapse collapse <?php echo $is_first ? 'show' : ''; ?>"
                                                         aria-labelledby="<?php echo esc_attr( $hid ); ?>"
                                                         data-bs-parent="#<?php echo esc_attr( $acc_id ); ?>">
                                                        <div class="accordion-body">
                                                            <?php if ( ! empty( $item['aci_image']['url'] ) ) : ?>
                                                                <img src="<?php echo esc_url( $item['aci_image']['url'] ); ?>" alt="accordion-thumb" class="w-100" loading="lazy">
                                                            <?php endif; ?>
                                                            <?php if ( ! empty( $item['aci_content'] ) ) : ?>
                                                                <p><?php echo esc_html( $item['aci_content'] ); ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <p><?php echo esc_html__( 'No accordion items.', 'heal-core' ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.row -->
                </div><!-- /.sermon -->
            </div><!-- /.container -->
        </div><!-- /.sermon-section -->

        <script>
        (function($){
            $(function(){
                // Swiper safe-init (requires Swiper to be enqueued elsewhere)
                var $root = $('#<?php echo esc_js( $wrap_id ); ?>');
                var el = $root.find('.sermon__slider')[0];
                if (window.Swiper && el) {
                    var swiper = new Swiper(el, {
                        loop: true,
                        autoplay: { delay: 10000, disableOnInteraction: false },
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

    $widgets_manager->register( new \Elementor\Theme_Sermon() );
} );
