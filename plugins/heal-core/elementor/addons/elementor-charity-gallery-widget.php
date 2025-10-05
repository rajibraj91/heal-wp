<?php
/**
 * Plugin Name: Heal Core - Gallery Widget (Single File)
 * Description: Elementor Gallery Widget with filter & style controls.
 * Version:     1.0.2
 * Author:      Your Name
 */

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
    // Elementor inactive
    return;
}

class Theme_Gallery extends Widget_Base {

    public function get_name() {
        return 'gallery-widget';
    }

    public function get_title() {
        return esc_html__( 'Gallery', 'heal-core' );
    }

    public function get_icon() {
        return 'theme-icon';
    }

    public function get_categories() {
        return [ 'heal_charity' ];
    }

    public function get_script_depends() { return []; }
    public function get_style_depends()  { return []; }

    protected function register_controls() {

        // ========== CONTENT: Widget Style ==========
        $this->start_controls_section(
            'theme_gallery',
            [ 'label' => esc_html__( 'Gallery Style', 'heal-core' ) ]
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
                    'style3' => esc_html__( 'Style 3', 'heal-core' ),
                    'style4' => esc_html__( 'Style 4', 'heal-core' ),
                ],
            ]
        );
        $this->end_controls_section();

        // ========== CONTENT: Section Header ==========
        $this->start_controls_section(
            'section_heading',
            [
                'label' => __( 'Section Header', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'section_switch',
            [
                'label'        => esc_html__( 'Section Switcher', 'heal-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => esc_html__( 'Yes', 'heal-core' ),
                'label_off'    => esc_html__( 'No', 'heal-core' ),
                'separator'    => 'before',
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
                'condition'   => [ 'section_switch' => 'yes' ],
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
                'condition'   => [ 'section_switch' => 'yes' ],
            ]
        );
        $this->end_controls_section();

        // ========== CONTENT: Gallery ==========
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Gallery', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery_fillter_switch',
            [
                'label'     => esc_html__( 'Fillter Switcher', 'heal-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => esc_html__( 'Yes', 'heal-core' ),
                'label_off' => esc_html__( 'No', 'heal-core' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'gallery_title_switch',
            [
                'label'     => esc_html__( 'Title Switcher', 'heal-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => esc_html__( 'Yes', 'heal-core' ),
                'label_off' => esc_html__( 'No', 'heal-core' ),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'gallery_icon_switch',
            [
                'label'     => esc_html__( 'Icon Switcher', 'heal-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => esc_html__( 'Yes', 'heal-core' ),
                'label_off' => esc_html__( 'No', 'heal-core' ),
                'separator' => 'before',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'gallery_image',
            [
                'label'   => esc_html__( 'Image', 'heal-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            ]
        );
        $repeater->add_control(
            'gallery_title',
            [
                'label'   => esc_html__( 'Title', 'heal-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Gallery Title', 'heal-core' ),
            ]
        );
        $repeater->add_control(
            'gallery_category',
            [
                'label'       => esc_html__( 'Category (Filter Class)', 'heal-core' ),
                'description' => esc_html__( 'Comma-separated (e.g. charity, events)', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'charity', 'heal-core' ),
            ]
        );
        $repeater->add_control(
            'lightbox_link',
            [
                'label'   => esc_html__( 'Lightbox/Link', 'heal-core' ),
                'type'    => Controls_Manager::URL,
                'default' => [ 'url' => '' ],
            ]
        );

        $this->add_control(
            'gallery_items',
            [
                'label'       => esc_html__( 'Gallery Items', 'heal-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{gallery_title}}',
            ]
        );

        // ✅ NEW: Responsive Columns control (Bootstrap mapping in render())
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
                    '2'  => '6',
                ],
                'default'         => '4',   // style1 default 3 columns (col-lg-4)
                'desktop_default' => '6',
                'tablet_default'  => '6',
                'mobile_default'  => '12',
            ]
        );

        $this->end_controls_section();

        // ========== STYLE: Section Header ==========
        $this->start_controls_section(
            'style_section_header',
            [
                'label'     => __( 'Section Header', 'heal-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [ 'section_switch' => 'yes' ],
            ]
        );
        $this->add_control(
            'section_title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header h2' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [ 'name' => 'section_title_typo', 'selector' => '{{WRAPPER}} .section-header h2' ]
        );
        $this->add_control(
            'section_desc_color',
            [
                'label'     => __( 'Description Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .section-header p' => 'color: {{VALUE}};' ],
            ]
        );
        $this->end_controls_section();

        // ========== STYLE: Filter ==========
        $this->start_controls_section(
            'style_filter',
            [
                'label' => __( 'Filter', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [ 'gallery_fillter_switch' => 'yes' ],
            ]
        );
        $this->add_responsive_control(
            'filter_gap',
            [
                'label'     => __( 'Gap', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [ '{{WRAPPER}} .gallery__filter li' => 'margin-right: {{SIZE}}{{UNIT}};' ],
            ]
        );
        $this->add_control(
            'filter_color',
            [
                'label'     => __( 'Text Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .gallery__filter li' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_control(
            'filter_active_color',
            [
                'label'     => __( 'Active Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .gallery__filter li.active' => 'color: {{VALUE}};' ],
            ]
        );
        $this->add_control(
            'filter_active_bg',
            [
                'label'     => __( 'Active BG', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .gallery__filter li.active' => 'background-color: {{VALUE}};' ],
            ]
        );
        $this->add_responsive_control(
            'filter_padding',
            [
                'label'      => __( 'Padding', 'heal-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .gallery__filter li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );
        $this->add_control(
            'filter_radius',
            [
                'label'     => __( 'Border Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
                'selectors' => [ '{{WRAPPER}} .gallery__filter li' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );
        $this->end_controls_section();

        // ========== STYLE: Items/Grid ==========
        $this->start_controls_section(
            'style_grid',
            [
                'label' => __( 'Items', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'item_bg',
            [
                'label'     => __( 'Card BG', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .gallery__item .gallery__inner' => 'background: {{VALUE}};' ],
            ]
        );
        $this->add_responsive_control(
            'item_radius',
            [
                'label'     => __( 'Card Radius', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
                'selectors' => [ '{{WRAPPER}} .gallery__item .gallery__inner, {{WRAPPER}} .gallery__thumb img' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'item_shadow', 'selector' => '{{WRAPPER}} .gallery__item .gallery__inner' ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'heal-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .gallery__content h5, {{WRAPPER}} .gallery__title h5' => 'color: {{VALUE}};' ],
                'condition' => [ 'gallery_title_switch' => 'yes' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typo',
                'selector'  => '{{WRAPPER}} .gallery__content h5, {{WRAPPER}} .gallery__title h5',
                'condition' => [ 'gallery_title_switch' => 'yes' ],
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => __( 'Icon Size', 'heal-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [ 'px' => [ 'min' => 10, 'max' => 80 ] ],
                'selectors' => [ '{{WRAPPER}} .gallery__icon i' => 'font-size: {{SIZE}}{{UNIT}};' ],
                'condition' => [ 'gallery_icon_switch' => 'yes' ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $widget_id  = $this->get_id();
        $wrapper_id = 'gallery-'.$widget_id;

        // Build categories map
        $categories = [];
        if ( ! empty( $settings['gallery_items'] ) ) {
            foreach ( $settings['gallery_items'] as $item ) {
                if ( ! empty( $item['gallery_category'] ) ) {
                    $raw_categories = explode(',', $item['gallery_category']);

                    foreach ( $raw_categories as $cat ) {
                        $cat = trim( $cat );
                        $slug = sanitize_title( $cat );
                        if ( ! array_key_exists( $slug, $categories ) ) {
                            $categories[ $slug ] = $cat;
                        }
                    }
                }
            }
        }
        $col_d = (int)($settings['columns'] ?? 4);        // lg
        $col_t = (int)($settings['columns_tablet'] ?? 6); // md
        $col_m = (int)($settings['columns_mobile'] ?? 12);// xs
        $valid = [12,6,4,3,2];
        if ( ! in_array($col_d, $valid, true) ) $col_d = 4;
        if ( ! in_array($col_t, $valid, true) ) $col_t = 6;
        if ( ! in_array($col_m, $valid, true) ) $col_m = 12;
        $col_class_base = 'col-lg-'.$col_d.' col-md-'.$col_t.' col-'.$col_m;
        

    ?>
        
    <?php  if ( 'style1' === $settings['style'] ) : ?>	
        <div class="gallery-section padding--top padding--bottom" id="gallery">
            <div class="container">
                <?php if ( $settings['section_switch'] === 'yes' ) : ?>
                    <div class="section-header style-2">
                        <h2><?php echo esc_html( $settings['section_title'] ); ?></h2>
                        <p><?php echo esc_html( $settings['section_description'] ); ?></p>
                    </div>
                <?php endif; ?>

                <div class="section-wrapper">
                    <div class="gallery">
                        <!-- Filter Part -->
                        <?php if ( ! empty( $categories ) && $settings['gallery_fillter_switch'] === 'yes' )  : ?>
                            <div class="gallery__filter">
                                <ul class="gallery__filter">
                                    <li data-filter="*" class="active"><?php echo esc_html__('All', 'heal-core'); ?></li>
                                    <?php foreach ( $categories as $slug => $name ) : ?>
                                        <li data-filter=".<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $name ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Gallery Grid -->
                        <div class="row g-4 grid">
                            <?php if ( ! empty( $settings['gallery_items'] ) ) : ?>
                                <?php foreach ( $settings['gallery_items'] as $item ) : 
                                    $cat_classes = '';
                                    if ( ! empty( $item['gallery_category'] ) ) {
                                        $raw_categories = explode(',', $item['gallery_category']);
                                        $slugs = array_map( function($cat) {
                                            return sanitize_title(trim($cat));
                                        }, $raw_categories );
                                        $cat_classes = implode(' ', $slugs);
                                    }
                                ?>
                                    <div class="<?php echo esc_attr( trim($col_class_base.' '.($cat_classes ?: '')) ); ?>">
                                        <div class="gallery__item">
                                            <div class="gallery__inner">
                                                <?php if ( ! empty( $item['gallery_image']['url'] ) ) : ?>
                                                    <div class="gallery__thumb">
                                                        <img src="<?php echo esc_url( $item['gallery_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['gallery_title'] ); ?>" class="w-100">
                                                    </div>
                                                <?php endif; ?>

                                                <div class="gallery__content text-center">
                                                    <?php if ( $settings['gallery_icon_switch'] === 'yes' ) : ?>
                                                        <a href="<?php echo esc_url( $item['gallery_image']['url'] ); ?>" data-rel="lightcase" class="gallery__icon">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ( $settings['gallery_title_switch'] === 'yes' ) : ?>
                                                        <h5><?php echo esc_html( $item['gallery_title'] ); ?></h5>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="col-12">    
                                    <div class="no-gallery text text-center">
                                        <p><?php echo esc_html__( 'No gallery items found.', 'heal-core' ); ?></p>  
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div> 
                </div>
            </div> 
        </div> 


    <?php  elseif ( 'style2' === $settings['style'] ) : ?>
        <div class="gallery-section padding--top padding--bottom" id="gallery">
            <div class="container">
                <?php if ( $settings['section_switch'] === 'yes' ) : ?>
                    <div class="section-header style-2">
                        <h2><?php echo esc_html( $settings['section_title'] ); ?></h2>
                        <p><?php echo esc_html( $settings['section_description'] ); ?></p>
                    </div>
                <?php endif; ?>

                <div class="section-wrapper">
                    <div class="gallery">
                        <?php if ( ! empty( $categories ) && $settings['gallery_fillter_switch'] === 'yes' )  : ?>
                            <div class="gallery__filter">
                                <ul class="gallery__filter">
                                    <li data-filter="*" class="active"><?php echo esc_html__('All', 'heal-core'); ?></li>
                                    <?php foreach ( $categories as $slug => $name ) : ?>
                                        <li data-filter=".<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $name ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="row g-4 grid">
                            <?php if ( ! empty( $settings['gallery_items'] ) ) : ?>
                                <?php foreach ( $settings['gallery_items'] as $item ) : 
                                    $cat_classes = '';
                                    if ( ! empty( $item['gallery_category'] ) ) {
                                        $raw_categories = explode(',', $item['gallery_category']);
                                        $slugs = array_map( function($cat) {
                                            return sanitize_title(trim($cat));
                                        }, $raw_categories );
                                        $cat_classes = implode(' ', $slugs);
                                    }
                                ?>
                                    <div class="<?php echo esc_attr( trim($col_class_base.' '.($cat_classes ?: '')) ); ?>">
                                        <div class="gallery__item">
                                            <div class="gallery__inner">
                                                <?php if ( ! empty( $item['gallery_image']['url'] ) ) : ?>
                                                    <div class="gallery__thumb">
                                                        <img src="<?php echo esc_url( $item['gallery_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['gallery_title'] ); ?>" class="w-100">
                                                    </div>
                                                <?php endif; ?>

                                                <div class="gallery__content text-center">
                                                    <a href="<?php echo esc_url( $item['gallery_image']['url'] ); ?>" data-rel="lightcase" class="gallery__icon"><i class="fas fa-plus"></i></a>
                                                    <h5><?php echo esc_html( $item['gallery_title'] ); ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="col-12">    
                                    <div class="no-gallery text text-center">
                                        <p><?php echo esc_html__( 'No gallery items found.', 'heal-core' ); ?></p>  
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php  elseif ( 'style3' === $settings['style'] ) : ?>
        <div class="gallery-section padding--top padding--bottom" id="gallery">
            <div class="container">
                <?php if ( $settings['section_switch'] === 'yes' ) : ?>
                    <div class="section-header style-2">
                        <h2><?php echo esc_html( $settings['section_title'] ); ?></h2>
                        <p><?php echo esc_html( $settings['section_description'] ); ?></p>
                    </div>
                <?php endif; ?>

                <div class="section-wrapper">
                    <div class="gallery gallery-style2">
                        <!-- Filter Part -->
                        <?php if ( ! empty( $categories ) && $settings['gallery_fillter_switch'] === 'yes' )  : ?>
                            <div class="gallery__filter">
                                <ul class="gallery__filter">
                                    <li data-filter="*" class="active"><?php echo esc_html__('All', 'heal-core'); ?></li>
                                    <?php foreach ( $categories as $slug => $name ) : ?>
                                        <li data-filter=".<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $name ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="row g-0 grid">
                            <?php if ( ! empty( $settings['gallery_items'] ) ) : ?>
                                <?php foreach ( $settings['gallery_items'] as $item ) : 
                                    $cat_classes = '';
                                    if ( ! empty( $item['gallery_category'] ) ) {
                                        $raw_categories = explode(',', $item['gallery_category']);
                                        $slugs = array_map( function($cat) {
                                            return sanitize_title(trim($cat));
                                        }, $raw_categories );
                                        $cat_classes = implode(' ', $slugs);
                                    }
                                ?>
                                <div class="<?php echo esc_attr( trim($col_class_base.' '.($cat_classes ?: '')) ); ?>">
                                    <div class="gallery__item">
                                        <div class="gallery__inner">
                                            <?php if ( ! empty( $item['gallery_image']['url'] ) ) : ?>
                                                <div class="gallery__thumb">
                                                    <img src="<?php echo esc_url( $item['gallery_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['gallery_title'] ); ?>" class="w-100">
                                                </div>
                                            <?php endif; ?>

                                            <?php if ( $settings['gallery_icon_switch'] === 'yes' ) : ?>
                                                <div class="gallery__content text-center">
                                                    <a href="<?php echo esc_url( $item['gallery_image']['url'] ); ?>" data-rel="lightcase" class="gallery__icon"><i class="fas fa-plus"></i></a>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ( $settings['gallery_title_switch'] === 'yes' ) : ?>
                                            <div class="gallery__title">
                                                <h5><?php echo esc_html( $item['gallery_title'] ); ?></h5>
                                                <span><?php echo esc_html( $cat_classes ); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php else : ?>
                                <div class="col-12">    
                                    <div class="no-gallery text text-center">
                                        <p><?php echo esc_html__( 'No gallery items found.', 'heal-core' ); ?></p>  
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php  elseif ( 'style4' === $settings['style'] ) : ?>
        <div class="gallery-section padding--top padding--bottom" id="gallery">
            <div class="container-fluid">
                <?php if ( $settings['section_switch'] === 'yes' ) : ?>
                    <div class="section-header style-2">
                        <h2><?php echo esc_html( $settings['section_title'] ); ?></h2>
                        <p><?php echo esc_html( $settings['section_description'] ); ?></p>
                    </div>
                <?php endif; ?>

                <div class="section-wrapper">
                    <div class="gallery">
                        <!-- Filter Part -->
                        <?php if ( ! empty( $categories ) && $settings['gallery_fillter_switch'] === 'yes' )  : ?>
                            <div class="gallery__filter">
                                <ul class="gallery__filter">
                                    <li data-filter="*" class="active"><?php echo esc_html__('All', 'heal-core'); ?></li>
                                    <?php foreach ( $categories as $slug => $name ) : ?>
                                        <li data-filter=".<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $name ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="row g-0 grid">
                            <?php if ( ! empty( $settings['gallery_items'] ) ) : ?>
                                <?php foreach ( $settings['gallery_items'] as $item ) : 
                                    $cat_classes = '';
                                    if ( ! empty( $item['gallery_category'] ) ) {
                                        $raw_categories = explode(',', $item['gallery_category']);
                                        $slugs = array_map( function($cat) {
                                            return sanitize_title(trim($cat));
                                        }, $raw_categories );
                                        $cat_classes = implode(' ', $slugs);
                                    }
                                ?>
                                <div class="<?php echo esc_attr( trim($col_class_base.' '.($cat_classes ?: '')) ); ?>">
                                    <div class="gallery__item">
                                        <div class="gallery__inner">
                                            <?php if ( ! empty( $item['gallery_image']['url'] ) ) : ?>
                                                <div class="gallery__thumb">
                                                    <img src="<?php echo esc_url( $item['gallery_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['gallery_title'] ); ?>" class="w-100">
                                                </div>
                                            <?php endif; ?>

                                            <div class="gallery__content text-center">
                                                <?php if ( $settings['gallery_icon_switch'] === 'yes' ) : ?>
                                                    <a href="<?php echo esc_url( $item['gallery_image']['url'] ); ?>" data-rel="lightcase" class="gallery__icon"><i class="fas fa-plus"></i></a>
                                                <?php endif; ?>

                                                <?php if ( $settings['gallery_title_switch'] === 'yes' ) : ?>
                                                    <h5><?php echo esc_html( $item['gallery_title'] ); ?></h5>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php else : ?>
                                <div class="col-12">    
                                    <div class="no-gallery text text-center">
                                        <p><?php echo esc_html__( 'No gallery items found.', 'heal-core' ); ?></p>  
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>	

        
        
    <?php
    }
}

// Register the widget
add_action( 'elementor/widgets/register', function( $widgets_manager ){
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

    $widgets_manager->register( new Theme_Gallery() );
} );
