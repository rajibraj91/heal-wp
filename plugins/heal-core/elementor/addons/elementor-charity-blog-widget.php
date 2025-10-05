<?php
/**
 * Elementor Widget
 * @package heal
 * @since 1.0.0
 */

namespace Elementor;

class Blog_Post extends Widget_Base {

    public function get_name() {
        return 'heal-blog-post-widget';
    }

    public function get_title() {
        return esc_html__( 'Blog Post', 'heal-core' );
    }

    public function get_icon() {
        return 'theme-icon';
    }

    public function get_categories() {
        return [ 'heal_charity' ];
    }

    protected function register_controls() {
        /* ---------------- Section Header ---------------- */
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

        /* ---------------- General Settings ---------------- */
        $this->start_controls_section(
            'settings_section',
            [
                'label' => esc_html__( 'General Settings', 'heal-core' ),
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
                    'style3' => esc_html__( 'Style 3', 'heal-core' ),
                ],
            ]
        );

        $this->add_control(
            'blog_grid',
            [
                'label'       => esc_html__( 'Blog Grid', 'heal-core' ),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'col-lg-2'  => esc_html__( 'col-lg-2', 'heal-core' ),
                    'col-lg-3'  => esc_html__( 'col-lg-3', 'heal-core' ),
                    'col-lg-4'  => esc_html__( 'col-lg-4', 'heal-core' ),
                    'col-lg-6'  => esc_html__( 'col-lg-6', 'heal-core' ),
                    'col-lg-12' => esc_html__( 'col-lg-12', 'heal-core' ),
                ],
                'default'     => 'col-lg-4',
                'description' => esc_html__( 'Select Blog Grid', 'heal-core' ),
            ]
        );

        $this->add_control(
            'button',
            [
                'label'       => __( 'Button', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => esc_html__( 'Enter your button text', 'heal-core' ),
                'default'     => esc_html__( 'Read More', 'heal-core' ),
            ]
        );

        $this->add_control(
            'total',
            [
                'label'       => esc_html__( 'Total Posts', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '-1',
                'description' => esc_html__( 'How many posts to show; -1 for all (no pagination).', 'heal-core' ),
            ]
        );

        $this->add_control(
            'offset',
            [
                'label'       => esc_html__( 'Offset Posts', 'heal-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '0',
                'description' => esc_html__( 'Skip first N posts.', 'heal-core' ),
            ]
        );

        $this->add_control(
            'category',
            [
                'label'       => esc_html__( 'Category', 'heal-core' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => function_exists('heal_core') ? heal_core()->get_terms_names( 'category', 'id' ) : [],
                'default'     => [],
                'include'     => [],
                'exclude'     => [],
                'description' => esc_html__( 'Select categories or leave empty for all.', 'heal-core' ),
            ]
        );

        $this->add_control(
            'order',
            [
                'label'       => esc_html__( 'Order', 'heal-core' ),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'ASC'  => esc_html__( 'Ascending', 'heal-core' ),
                    'DESC' => esc_html__( 'Descending', 'heal-core' ),
                ],
                'default'     => 'DESC',
                'description' => esc_html__( 'Select order.', 'heal-core' ),
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'       => esc_html__( 'OrderBy', 'heal-core' ),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'ID'            => esc_html__( 'ID', 'heal-core' ),
                    'title'         => esc_html__( 'Title', 'heal-core' ),
                    'date'          => esc_html__( 'Date', 'heal-core' ),
                    'rand'          => esc_html__( 'Random', 'heal-core' ),
                    'comment_count' => esc_html__( 'Most Comments', 'heal-core' ),
                ],
                'default'     => 'ID',
                'description' => esc_html__( 'Select orderby.', 'heal-core' ),
            ]
        );

        $this->add_control(
            'image_thumb_display',
            [
                'label'       => esc_html__( 'Image Display', 'heal-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'description' => esc_html__( 'Show/Hide featured image.', 'heal-core' ),
            ]
        );

        $this->add_control(
            'thumb_date',
            [
                'label'       => esc_html__( 'Thumb Date Show/Hide', 'heal-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'description' => esc_html__( 'Show/Hide date in meta.', 'heal-core' ),
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'       => esc_html__( 'Pagination', 'heal-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Enable pagination (ignored when Total = -1).', 'heal-core' ),
                'default'     => 'yes',
            ]
        );

        $this->add_control(
            'category_display',
            [
                'label'       => esc_html__( 'Category Display', 'heal-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Show/Hide categories.', 'heal-core' ),
                'default'     => '',
            ]
        );

        $this->add_control(
            'tag_display',
            [
                'label'       => esc_html__( 'Tags Display', 'heal-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Show/Hide tags.', 'heal-core' ),
                'default'     => '',
            ]
        );

        $this->add_control(
            'pagination_alignment',
            [
                'label'       => esc_html__( 'Pagination Alignment', 'heal-core' ),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'left'   => esc_html__( 'Left Align', 'heal-core' ),
                    'center' => esc_html__( 'Center Align', 'heal-core' ),
                    'right'  => esc_html__( 'Right Align', 'heal-core' ),
                ],
                'description' => esc_html__( 'Alignment for pagination.', 'heal-core' ),
                'default'     => 'left',
                'condition'   => [ 'pagination' => 'yes' ],
            ]
        );

        $this->end_controls_section();

        /* ---------------- Testimonial (Style 3 only) ---------------- */
        $this->start_controls_section(
            'testimonial_content',
            [
                'label'     => __( 'Testimonial', 'heal-core' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'style' => 'style3' ],
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control( 'reviwer_name', [
            'label'       => esc_html__( 'Name', 'heal-core' ),
            'type'        => Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Name', 'heal-core' ),
            'label_block' => true,
        ] );
        $repeater->add_control( 'reviwer_desi', [
            'label'       => esc_html__( 'Designation', 'heal-core' ),
            'type'        => Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Designation', 'heal-core' ),
        ] );
        $repeater->add_control( 'reviwer_desc', [
            'label'       => esc_html__( 'Description', 'heal-core' ),
            'type'        => Controls_Manager::TEXTAREA,
            'placeholder' => esc_html__( 'Description', 'heal-core' ),
        ] );
        $repeater->add_control( 'reviwer_img', [
            'label'   => esc_html__( 'Image', 'heal-core' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => Utils::get_placeholder_image_src() ],
        ] );
        $repeater->add_control( 'reviwer_img_alt', [
            'label'       => esc_html__( 'Alt/SEO Text', 'heal-core' ),
            'type'        => Controls_Manager::TEXTAREA,
            'placeholder' => esc_html__( 'Alt or seo text here', 'heal-core' ),
        ] );

        $this->add_control( 'reviwer_items', [
            'label'       => esc_html__( 'Testimonial Items', 'heal-core' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{ reviwer_name }}',
        ] );

        $this->end_controls_section();

        /* ---------------- STYLE: Title ---------------- */
        $this->start_controls_section( 'title_settings', [
            'label' => __( 'Title Settings', 'heal-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'show_title', [
            'label'   => esc_html__( 'Show Title', 'heal-core' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'show' => [ 'title' => __( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
                'none' => [ 'title' => __( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
            ],
            'default'   => 'show',
            'selectors' => [
                '{{WRAPPER}} .blog__postcontent h5' => 'display: {{VALUE}} !important;',
            ],
            'selectors_dictionary' => [
                'show' => 'block',
                'none' => 'none',
            ],
        ] );

        $this->add_control( 'title_alignment', [
            'label'     => esc_html__( 'Alignment', 'heal-core' ),
            'type'      => Controls_Manager::CHOOSE,
            'options'   => [
                'left'   => [ 'title' => __( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
                'center' => [ 'title' => __( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => __( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
            ],
            'condition' => [ 'show_title' => 'show' ],
            'selectors' => [
                '{{WRAPPER}} .blog__postcontent'  => 'text-align: {{VALUE}} !important;',
                '{{WRAPPER}} .blog__postcontent h5' => 'display: inline-block;',
            ],
        ] );

        $this->add_control( 'title_margin', [
            'label'      => __( 'Margin', 'heal-core' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'condition'  => [ 'show_title' => 'show' ],
            'selectors'  => [
                '{{WRAPPER}} .blog__postcontent h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
            ],
        ] );

        $this->add_control( 'title_padding', [
            'label'      => __( 'Padding', 'heal-core' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'condition'  => [ 'show_title' => 'show' ],
            'selectors'  => [
                '{{WRAPPER}} .blog__postcontent h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
            ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'      => 'title_typography',
            'label'     => __( 'Typography', 'heal-core' ),
            'selector'  => '{{WRAPPER}} .blog__postcontent h5',
            'condition' => [ 'show_title' => 'show' ],
        ] );

        $this->add_control( 'title_color', [
            'label'     => __( 'Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .blog__postcontent h5' => 'color: {{VALUE}} !important',
            ],
            'condition' => [ 'show_title' => 'show' ],
        ] );

        $this->add_control( 'title_hover_color', [
            'label'     => __( 'Hover Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .blog__postcontent h5:hover' => 'color: {{VALUE}} !important',
            ],
            'condition' => [ 'show_title' => 'show' ],
        ] );

        $this->end_controls_section();

        /* ---------------- STYLE: Text/Excerpt ---------------- */
        $this->start_controls_section( 'text_settings', [
            'label' => __( 'Text Settings', 'heal-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'show_text', [
            'label'   => esc_html__( 'Show Text', 'heal-core' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'show' => [ 'title' => __( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
                'none' => [ 'title' => __( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
            ],
            'default'   => 'show',
            'selectors' => [
                '{{WRAPPER}} .blog__postcontent p' => 'display: {{VALUE}} !important;',
            ],
            'selectors_dictionary' => [
                'show' => 'block',
                'none' => 'none',
            ],
        ] );

        $this->add_control( 'text_alignment', [
            'label'     => esc_html__( 'Alignment', 'heal-core' ),
            'type'      => Controls_Manager::CHOOSE,
            'options'   => [
                'left'   => [ 'title' => __( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
                'center' => [ 'title' => __( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => __( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
            ],
            'condition' => [ 'show_text' => 'show' ],
            'selectors' => [
                '{{WRAPPER}} .blog__postcontent p' => 'text-align: {{VALUE}} !important',
            ],
        ] );

        $this->add_control( 'text_margin', [
            'label'      => __( 'Margin', 'heal-core' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'condition'  => [ 'show_text' => 'show' ],
            'selectors'  => [
                '{{WRAPPER}} .blog__postcontent p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
            ],
        ] );

        $this->add_control( 'text_padding', [
            'label'      => __( 'Padding', 'heal-core' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'condition'  => [ 'show_text' => 'show' ],
            'selectors'  => [
                '{{WRAPPER}} .blog__postcontent p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
            ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'      => 'text_typography',
            'label'     => __( 'Typography', 'heal-core' ),
            'selector'  => '{{WRAPPER}} .blog__postcontent p',
            'condition' => [ 'show_text' => 'show' ],
        ] );

        $this->add_control( 'text_color', [
            'label'     => __( 'Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .blog__postcontent p' => 'color: {{VALUE}} !important',
            ],
            'condition' => [ 'show_text' => 'show' ],
        ] );

        $this->add_control( 'text_hover_color', [
            'label'     => __( 'Hover Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .blog__postcontent p:hover' => 'color: {{VALUE}} !important',
            ],
            'condition' => [ 'show_text' => 'show' ],
        ] );

        $this->end_controls_section();

        /* ---------------- STYLE: Meta & Icon ---------------- */
        $this->start_controls_section( 'meta_icon_settings', [
            'label' => __( 'Meta & Icon', 'heal-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'show_icon', [
            'label'   => esc_html__( 'Show Format Icon', 'heal-core' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'show' => [ 'title' => __( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
                'none' => [ 'title' => __( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
            ],
            'default'   => 'show',
            'selectors' => [
                '{{WRAPPER}} .blog__meta .blog__icon i' => 'display: {{VALUE}} !important',
            ],
            'selectors_dictionary' => [
                'show' => 'inline-block',
                'none' => 'none',
            ],
        ] );

        $this->add_control( 'meta_color', [
            'label'     => __( 'Meta Text Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .blog__meta ul li' => 'color: {{VALUE}} !important',
            ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'meta_typo',
            'label'    => __( 'Meta Typography', 'heal-core' ),
            'selector' => '{{WRAPPER}} .blog__meta ul li',
        ] );

        $this->add_control( 'icon_color', [
            'label'     => __( 'Icon Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .blog__meta .blog__icon i' => 'color: {{VALUE}} !important',
            ],
        ] );

        $this->end_controls_section();

        /* ---------------- STYLE: Button ---------------- */
        $this->start_controls_section( 'button_control', [
            'label' => __( 'Button Settings', 'heal-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'show_button', [
            'label'   => esc_html__( 'Show Button', 'heal-core' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'show' => [ 'title' => __( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
                'none' => [ 'title' => __( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
            ],
            'default'   => 'show',
            'selectors' => [
                '{{WRAPPER}} .blog__postcontent .default-btn' => 'display: {{VALUE}} !important',
            ],
            'selectors_dictionary' => [
                'show' => 'inline-block',
                'none' => 'none',
            ],
        ] );

        $this->add_control( 'button_alignment', [
            'label'     => esc_html__( 'Alignment', 'heal-core' ),
            'type'      => Controls_Manager::CHOOSE,
            'options'   => [
                'left'   => [ 'title' => __( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
                'center' => [ 'title' => __( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => __( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
            ],
            'selectors' => [
                '{{WRAPPER}} .blog__postcontent' => 'text-align: {{VALUE}} !important',
            ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'button_typography',
            'selector' => '{{WRAPPER}} .blog__postcontent .default-btn',
        ] );

        $this->add_control( 'button_color', [
            'label'     => __( 'Button Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .blog__item .default-btn span' => 'color: {{VALUE}} !important',
                '{{WRAPPER}} .blog__item .default-btn'  => 'border-color: {{VALUE}} !important',
            ],
        ] );

        $this->add_control( 'button_bg_color', [
            'label'     => __( 'Button Background', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .blog__item .default-btn' => 'background: {{VALUE}} !important',
            ],
        ] );

        $this->add_control( 'button_hover_color', [
            'label'     => __( 'Hover Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .blog__item .default-btn:hover span' => 'color: {{VALUE}} !important',
            ],
        ] );

        $this->add_control( 'button_bg_hover_color', [
            'label'     => __( 'Hover Background', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .blog__item .default-btn::before' => 'background: {{VALUE}} !important',
                '{{WRAPPER}} .blog__item .default-btn::after'  => 'background: {{VALUE}} !important',
            ],
        ] );

        $this->add_control( 'button_padding', [
            'label'      => __( 'Padding', 'heal-core' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .blog__item .default-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important',
            ],
        ] );

        $this->add_control( 'button_margin', [
            'label'      => __( 'Margin', 'heal-core' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .blog__item .default-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important',
            ],
        ] );

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'button_border',
            'selector' => '{{WRAPPER}} .blog__item .default-btn',
        ] );

        $this->add_control( 'border_radius', [
            'label'      => __( 'Border Radius', 'heal-core' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .blog__item .default-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important',
            ],
        ] );

        $this->end_controls_section();

        /* ---------------- STYLE: Instant CSS (Per Widget) ---------------- */
        $this->start_controls_section( 'inst_css_section', [
            'label' => __( 'Custom CSS (Per Widget)', 'heal-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'enable_inst_css', [
            'label'        => __( 'Enable', 'heal-core' ),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => __( 'On', 'heal-core' ),
            'label_off'    => __( 'Off', 'heal-core' ),
            'return_value' => 'yes',
            'default'      => '',
            'description'  => __( 'Use "&" to refer to this widget wrapper. Example: & .blog__item{border:1px solid #eee}', 'heal-core' ),
        ] );

        $this->add_control( 'inst_css', [
            'label'       => __( 'CSS', 'heal-core' ),
            'type'        => Controls_Manager::TEXTAREA,
            'rows'        => 12,
            'placeholder' => "& .blog__item {\n  box-shadow: 0 10px 30px rgba(0,0,0,.06);\n}\n",
            'condition'   => [ 'enable_inst_css' => 'yes' ],
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html( 'post' );

        // Wrapper for per-widget CSS scoping
        $root_id  = 'heal-blog-' . $this->get_id();
        $root_sel = '#' . $root_id;

        // Query setup
        $posts_per_page = (int) $settings['total'];
        $posts_per_page = ( $posts_per_page === 0 ) ? -1 : $posts_per_page;

        $paged = 1;
        if ( get_query_var( 'paged' ) ) {
            $paged = (int) get_query_var( 'paged' );
        } elseif ( get_query_var( 'page' ) ) {
            $paged = (int) get_query_var( 'page' );
        }

        $use_pagination = ( 'yes' === ( $settings['pagination'] ?? '' ) && $posts_per_page !== -1 );

        $args = [
            'post_type'           => 'post',
            'posts_per_page'      => $posts_per_page,
            'order'               => $settings['order'],
            'orderby'             => $settings['orderby'],
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ];

        // Tax filter
        if ( ! empty( $settings['category'] ) && is_array( $settings['category'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => array_map( 'intval', $settings['category'] ),
                ]
            ];
        }

        $base_offset = max( 0, (int) $settings['offset'] );

        if ( $use_pagination ) {
            $args['paged']  = max( 1, $paged );
            // include base offset into paged offset (WordPress ignores paged when offset is present; so compute final offset)
            $args['offset'] = ( $args['paged'] - 1 ) * $posts_per_page + $base_offset;
        } else {
            $args['offset'] = $base_offset;
        }

        $post_data = new \WP_Query( $args );

        echo '<div id="' . esc_attr( $root_id ) . '">';

        /* ---------------- Style 1 ---------------- */
        if ( 'style1' === $settings['style'] ) : ?>
            <div class="blog-section padding--top padding--bottom" id="blog">
                <div class="container">
                    <?php if ( ! empty( $settings['section_title'] ) ) : ?>
                        <div class="section-header style-2">
                            <h2><?php echo wp_kses( $settings['section_title'], $allowed_tags ); ?></h2>
                            <?php if ( ! empty( $settings['section_description'] ) ) : ?>
                                <p><?php echo wp_kses( $settings['section_description'], $allowed_tags ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="section-wrapper">
                        <div class="blog blog-style2">
                            <div class="row g-4">
                                <?php while ( $post_data->have_posts() ) : $post_data->the_post();
                                    $img_id      = get_post_thumbnail_id( get_the_ID() ) ?: 0;
                                    $img_url_val = $img_id ? wp_get_attachment_image_src( $img_id, 'heal_grid_blog_12', false ) : '';
                                    $img_url     = ( is_array( $img_url_val ) && ! empty( $img_url_val ) ) ? $img_url_val[0] : '';
                                    $img_alt     = $img_id ? get_post_meta( $img_id, '_wp_attachment_image_alt', true ) : '';
                                ?>
                                    <div class="<?php echo esc_attr( $settings['blog_grid'] ); ?> wow fadeInUp" data-wow-delay=".3s">
                                        <div class="blog__item">
                                            <div class="blog__inner">
                                                <?php if ( ! empty( $settings['image_thumb_display'] ) ) : ?>
                                                    <div class="blog__thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php if ( $img_url ) : ?>
                                                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="blog__content">
                                                    <div class="blog__meta">
                                                        <div class="blog__icon">
                                                            <i class="<?php echo esc_attr( $this->get_format_icon_class( get_the_ID() ) ); ?>"></i>
                                                        </div>
                                                        <ul>
                                                            <?php if ( ! empty( $settings['thumb_date'] ) ) : ?>
                                                                <li><?php echo esc_html( get_the_date( 'M d, y' ) ); ?></li>
                                                            <?php endif; ?>

                                                            <?php if ( ! empty( $settings['category_display'] ) ) : ?>
                                                                <li>
                                                                    <?php
                                                                    $cats = get_the_category();
                                                                    if ( $cats ) {
                                                                        $names = wp_list_pluck( $cats, 'name' );
                                                                        echo esc_html( implode( ', ', $names ) );
                                                                    }
                                                                    ?>
                                                                </li>
                                                            <?php endif; ?>

                                                            <?php if ( ! empty( $settings['tag_display'] ) ) : ?>
                                                                <li>
                                                                    <?php
                                                                    $tags = get_the_tags();
                                                                    if ( $tags && ! is_wp_error( $tags ) ) {
                                                                        $names = wp_list_pluck( $tags, 'name' );
                                                                        echo esc_html( implode( ', ', $names ) );
                                                                    }
                                                                    ?>
                                                                </li>
                                                            <?php endif; ?>

                                                            <li><?php the_author(); ?></li>
                                                            <li><?php comments_number(); ?></li>
                                                        </ul>
                                                    </div>

                                                    <div class="blog__postcontent">
                                                        <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                                                        <p><?php echo esc_html( wp_strip_all_tags( wp_trim_words( get_the_content(), 20, null ) ) ); ?></p>
                                                        <a href="<?php the_permalink(); ?>" class="default-btn move-bottom"><span><?php echo esc_html( $settings['button'] ); ?></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>

                        <?php
                        if ( $use_pagination && $post_data->max_num_pages > 1 ) {
                            $links = paginate_links( [
                                'total'     => $post_data->max_num_pages,
                                'current'   => max( 1, $paged ),
                                'type'      => 'list',
                                'prev_text' => '&laquo;',
                                'next_text' => '&raquo;',
                            ] );
                            if ( $links ) {
                                $align = ! empty( $settings['pagination_alignment'] ) ? $settings['pagination_alignment'] : 'left';
                                echo '<div class="heal-pagination align-' . esc_attr( $align ) . '">' . $links . '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

        <?php /* ---------------- Style 2 ---------------- */ elseif ( 'style2' === $settings['style'] ) : ?>
            <div class="blog-section padding--top padding--bottom" id="blog">
                <div class="container">
                    <?php if ( ! empty( $settings['section_title'] ) ) : ?>
                        <div class="section-header style-2">
                            <h2><?php echo wp_kses( $settings['section_title'], $allowed_tags ); ?></h2>
                            <?php if ( ! empty( $settings['section_description'] ) ) : ?>
                                <p><?php echo wp_kses( $settings['section_description'], $allowed_tags ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="section-wrapper">
                        <div class="blog blog-style2">
                            <div class="row g-4">
                                <?php while ( $post_data->have_posts() ) : $post_data->the_post();
                                    $img_id      = get_post_thumbnail_id( get_the_ID() ) ?: 0;
                                    $img_url_val = $img_id ? wp_get_attachment_image_src( $img_id, 'heal_grid_blog_12', false ) : '';
                                    $img_url     = ( is_array( $img_url_val ) && ! empty( $img_url_val ) ) ? $img_url_val[0] : '';
                                    $img_alt     = $img_id ? get_post_meta( $img_id, '_wp_attachment_image_alt', true ) : '';
                                ?>
                                    <div class="<?php echo esc_attr( $settings['blog_grid'] ); ?> wow fadeInUp" data-wow-delay=".3s">
                                        <div class="blog__item">
                                            <div class="blog__inner">
                                                <?php if ( ! empty( $settings['image_thumb_display'] ) ) : ?>
                                                    <div class="blog__thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php if ( $img_url ) : ?>
                                                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="blog__content">
                                                    <div class="blog__meta">
                                                        <div class="blog__icon">
                                                            <i class="<?php echo esc_attr( $this->get_format_icon_class( get_the_ID() ) ); ?>"></i>
                                                        </div>
                                                        <ul>
                                                            <?php if ( ! empty( $settings['thumb_date'] ) ) : ?>
                                                                <li><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></li>
                                                            <?php endif; ?>

                                                            <?php if ( ! empty( $settings['category_display'] ) ) : ?>
                                                                <li>
                                                                    <?php
                                                                    $cats = get_the_category();
                                                                    if ( $cats ) {
                                                                        $names = wp_list_pluck( $cats, 'name' );
                                                                        echo esc_html( implode( ', ', $names ) );
                                                                    }
                                                                    ?>
                                                                </li>
                                                            <?php endif; ?>

                                                            <?php if ( ! empty( $settings['tag_display'] ) ) : ?>
                                                                <li>
                                                                    <?php
                                                                    $tags = get_the_tags();
                                                                    if ( $tags && ! is_wp_error( $tags ) ) {
                                                                        $names = wp_list_pluck( $tags, 'name' );
                                                                        echo esc_html( implode( ', ', $names ) );
                                                                    }
                                                                    ?>
                                                                </li>
                                                            <?php endif; ?>

                                                            <li><?php the_author(); ?></li>
                                                            <li><?php comments_number(); ?></li>
                                                        </ul>
                                                    </div>

                                                    <div class="blog__postcontent">
                                                        <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                                                        <p><?php echo esc_html( wp_strip_all_tags( wp_trim_words( get_the_content(), 20, null ) ) ); ?></p>
                                                        <a href="<?php the_permalink(); ?>" class="default-btn move-bottom"><span><?php echo esc_html( $settings['button'] ); ?></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>

                        <?php
                        if ( $use_pagination && $post_data->max_num_pages > 1 ) {
                            $links = paginate_links( [
                                'total'     => $post_data->max_num_pages,
                                'current'   => max( 1, $paged ),
                                'type'      => 'list',
                                'prev_text' => '&laquo;',
                                'next_text' => '&raquo;',
                            ] );
                            if ( $links ) {
                                $align = ! empty( $settings['pagination_alignment'] ) ? $settings['pagination_alignment'] : 'left';
                                echo '<div class="heal-pagination align-' . esc_attr( $align ) . '">' . $links . '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

        <?php /* ---------------- Style 3 ---------------- */ elseif ( 'style3' === $settings['style'] ) : ?>
            <div class="blog-section padding--top padding--bottom" id="blog">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-lg-6 col-12">
                            <?php if ( ! empty( $settings['section_title'] ) ) : ?>
                                <div class="section-header style-4">
                                    <h3><?php echo wp_kses( $settings['section_title'], $allowed_tags ); ?></h3>
                                </div>
                            <?php endif; ?>

                            <div class="section-wrapper">
                                <div class="blog">
                                    <?php while ( $post_data->have_posts() ) : $post_data->the_post();
                                        $img_id      = get_post_thumbnail_id( get_the_ID() ) ?: 0;
                                        $img_url_val = $img_id ? wp_get_attachment_image_src( $img_id, 'heal_grid_blog_12', false ) : '';
                                        $img_url     = ( is_array( $img_url_val ) && ! empty( $img_url_val ) ) ? $img_url_val[0] : '';
                                        $img_alt     = $img_id ? get_post_meta( $img_id, '_wp_attachment_image_alt', true ) : '';
                                    ?>
                                        <div class="blog__item">
                                            <div class="blog__inner">
                                                <?php if ( ! empty( $settings['image_thumb_display'] ) ) : ?>
                                                    <div class="blog__thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php if ( $img_url ) : ?>
                                                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="blog__content">
                                                    <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                                                    <ul class="meta-post">
                                                        <li><b><?php echo esc_html__( 'Post by:', 'heal-core' ); ?></b> <?php the_author(); ?> </li>
                                                        <li><a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></li>
                                                    </ul>
                                                    <p><?php echo esc_html( wp_strip_all_tags( wp_trim_words( get_the_content(), 20, null ) ) ); ?></p>
                                                    <a href="<?php the_permalink(); ?>" class="default-btn move-bottom"><span><?php echo esc_html( $settings['button'] ); ?></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                </div>

                                <?php
                                if ( $use_pagination && $post_data->max_num_pages > 1 ) {
                                    $links = paginate_links( [
                                        'total'     => $post_data->max_num_pages,
                                        'current'   => max( 1, $paged ),
                                        'type'      => 'list',
                                        'prev_text' => '&laquo;',
                                        'next_text' => '&raquo;',
                                    ] );
                                    if ( $links ) {
                                        $align = ! empty( $settings['pagination_alignment'] ) ? $settings['pagination_alignment'] : 'left';
                                        echo '<div class="heal-pagination align-' . esc_attr( $align ) . '">' . $links . '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <?php if ( ! empty( $settings['reviwer_items'] ) ) : ?>
                            <div class="col-lg-6 col-12">
                                <div class="client__review">
                                    <div class="poster">
                                        <div class="d-flex flex-wrap flex-md-nowrap align-items-start">
                                            <div class="nav flex-md-column nav-pills me-3 poster__filter" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <?php
                                                $counter = 0;
                                                foreach ( $settings['reviwer_items'] as $item ) :
                                                    $counter++;
                                                    $is_active = ( 1 === $counter );
                                                    if ( ! empty( $item['reviwer_name'] ) && ! empty( $item['reviwer_img']['url'] ) ) :
                                                ?>
                                                    <button class="nav-link <?php echo $is_active ? 'active' : ''; ?>" id="v-pills-<?php echo esc_attr( $counter ); ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?php echo esc_attr( $counter ); ?>" type="button" role="tab" aria-controls="v-pills-<?php echo esc_attr( $counter ); ?>" aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>">
                                                        <img src="<?php echo esc_url( $item['reviwer_img']['url'] ); ?>" alt="<?php echo esc_attr( $item['reviwer_img_alt'] ); ?>">
                                                    </button>
                                                <?php
                                                    endif;
                                                endforeach;
                                                ?>
                                            </div>
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <?php
                                                $counter = 0;
                                                foreach ( $settings['reviwer_items'] as $item ) :
                                                    $counter++;
                                                    $is_active = ( 1 === $counter );
                                                    if ( ! empty( $item['reviwer_name'] ) && ! empty( $item['reviwer_img']['url'] ) ) :
                                                ?>
                                                    <div class="tab-pane fade <?php echo $is_active ? 'show active' : ''; ?>" id="v-pills-<?php echo esc_attr( $counter ); ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo esc_attr( $counter ); ?>-tab">
                                                        <div class="poster__item">
                                                            <div class="poster__inner">
                                                                <div class="poster__contentpart">
                                                                    <?php if ( ! empty( $item['reviwer_desc'] ) ) : ?>
                                                                        <blockquote>
                                                                            <p><?php echo esc_html( $item['reviwer_desc'] ); ?></p>
                                                                        </blockquote>
                                                                    <?php endif; ?>

                                                                    <h6><?php echo esc_html( $item['reviwer_name'] ); ?></h6>

                                                                    <?php if ( ! empty( $item['reviwer_desi'] ) ) : ?>
                                                                        <span><?php echo esc_html( $item['reviwer_desi'] ); ?></span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                    endif;
                                                endforeach;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endif;

        // Instant CSS injection (scoped)
        if ( ! empty( $settings['enable_inst_css'] ) && 'yes' === $settings['enable_inst_css'] && ! empty( $settings['inst_css'] ) ) {
            $scoped_css = str_replace( '&', $root_sel, $settings['inst_css'] );
            echo '<style id="' . esc_attr( $root_id ) . '-inst-css">' . $scoped_css . '</style>';
        }

        echo '</div>'; // end wrapper
    }

    /* ---------- Helper: Post Format Icon ---------- */
    private function get_format_icon_class( $post_id ) {
        $format = get_post_format( $post_id );
        switch ( $format ) {
            case 'image':   return 'fas fa-image';
            case 'video':   return 'fas fa-video';
            case 'gallery': return 'fas fa-images';
            case 'quote':   return 'fas fa-quote-right';
            case 'audio':   return 'fas fa-music';
            case 'link':    return 'fas fa-link';
            default:        return 'fas fa-file-alt';
        }
    }
}

if ( method_exists( Plugin::instance()->widgets_manager, 'register_widget_type' ) ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Blog_Post() );
} else {
    // For newer Elementor versions
    Plugin::instance()->widgets_manager->register( new Blog_Post() );
}
