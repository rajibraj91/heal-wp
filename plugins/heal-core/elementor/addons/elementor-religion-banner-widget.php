<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Banner Widget (Improved + More Style Controls)
 * @package heal-core
 * @since 1.0.0
 */
class Theme_Religion_Banner extends Widget_Base {

	public function get_name() { return 'hafsa-banner-widget'; }
	public function get_title() { return esc_html__( 'Banner', 'heal-core' ); }
	public function get_icon() { return 'theme-icon'; }
	public function get_categories() { return [ 'heal_religion' ]; }

	public function get_script_depends() {
		$deps = [ 'jquery' ];
		if ( wp_script_is( 'swiper', 'registered' ) ) {
			$deps[] = 'swiper';
		} else {
			$deps[] = 'elementor-frontend';
		}
		return $deps;
	}

	public function get_style_depends() {
		return wp_style_is( 'swiper', 'registered' ) ? [ 'swiper' ] : [];
	}

	protected function register_controls() {

		/* -------------------------
		 * CONTENT — Style chooser
		 * ------------------------- */
		$this->start_controls_section( 'theme_Religion_banner', [ 'label' => esc_html__( 'Banner', 'heal-core' ) ] );
		$this->add_control( 'style', [
			'label'   => esc_html__( 'Select Style', 'heal-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'style1',
			'options' => [
				'style1' => esc_html__( 'Style 1', 'heal-core' ),
				'style2' => esc_html__( 'Style 2', 'heal-core' ),
				'style3' => esc_html__( 'Style 3', 'heal-core' ),
			],
		] );
		$this->end_controls_section();

		
		/* -------------------------
		 * CONTENT — Blocks
		 * ------------------------- */
		$this->start_controls_section( 'content_section', [
			'label' => __( 'Block', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
            'condition'   => [ 'style' => [ 'style1' ] ],
		] );

        $this->add_control( 'block_image', [
            'label'   => esc_html__( 'Thumb', 'heal-core' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => Utils::get_placeholder_image_src() ],
        ]);

        $this->add_control( 'block_image_alt', [
			'label'       => __( 'Alt text', 'heal-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'dynamic'     => [ 'active' => true ],
			'placeholder' => __( 'Enter Your Text', 'heal-core' ),
		] );


        $this->add_control( 'block_title', [
            'label'   => esc_html__( 'Title', 'heal-core' ),
            'type'    => Controls_Manager::TEXTAREA,
        ]);

        $this->add_control( 'block_text', [
            'label'   => esc_html__( 'Text', 'heal-core' ),
            'type'    => Controls_Manager::TEXTAREA,
        ]);

        $this->add_control( 'block_button', [
            'label'   => __( 'Button', 'heal-core' ),
            'type'    => Controls_Manager::TEXT,
            'dynamic' => [ 'active' => true ],
            'default' => esc_html__( 'Donate Now', 'heal-core' ),
        ]);

        $this->add_control( 'block_button_link', [
            'label'        => __( 'Button Url', 'heal-core' ),
            'type'         => Controls_Manager::URL,
            'placeholder'  => __( 'https://your-link.com', 'heal-core' ),
            'show_external'=> true,
            'default'      => [ 'url' => '', 'is_external' => true, 'nofollow' => true ],
        ]);


		$this->end_controls_section();

		

		/* -------------------------
		 * STYLE — Title
		 * ------------------------- */
		$this->start_controls_section( 'title_settings', [
			'label' => __( 'Title Settings', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'show_title', [
			'label'   => esc_html__( 'Show Title', 'heal-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'show' => [ 'title' => esc_html__( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
				'none' => [ 'title' => esc_html__( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
			],
			'default'   => 'show',
			'selectors' => [ '{{WRAPPER}} .banner__content .banner-title' => 'display: {{VALUE}} !important' ],
		] );

		$this->add_control( 'title_alignment', [
			'label'     => esc_html__( 'Alignment', 'heal-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [ 'title' => esc_html__( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
			],
			'default'   => '',
			'condition' => [ 'show_title' => 'show' ],
			'toggle'    => true,
			'selectors' => [ '{{WRAPPER}} .banner__content .banner-title' => 'text-align: {{VALUE}}' ],
		] );

		$this->add_control( 'title_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'condition'  => [ 'show_title' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

		$this->add_control( 'title_padding', [
			'label'      => __( 'Padding', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'condition'  => [ 'show_title' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'title_typography',
			'label'     => __( 'Typography', 'heal-core' ),
			'condition' => [ 'show_title' => 'show' ],
			'selector'  => '{{WRAPPER}} .banner__content .banner-title',
		] );

		$this->add_control( 'title_color', [
			'label'      => __( 'Color', 'heal-core' ),
			'type'       => Controls_Manager::COLOR,
			'condition'  => [ 'show_title' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-title' => 'color: {{VALUE}} !important' ],
		] );

		$this->add_control( 'title_hover_color', [
			'label'      => __( 'Hover Color', 'heal-core' ),
			'type'       => Controls_Manager::COLOR,
			'condition'  => [ 'show_title' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-title:hover' => 'color: {{VALUE}} !important' ],
		] );

		$this->end_controls_section();

		/* -------------------------
		 * STYLE — Text
		 * ------------------------- */
		$this->start_controls_section( 'text_settings', [
			'label' => __( 'Text Settings', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'show_text', [
			'label'   => esc_html__( 'Show Text', 'heal-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'show' => [ 'title' => esc_html__( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
				'none' => [ 'title' => esc_html__( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
			],
			'default'   => 'show',
			'selectors' => [ '{{WRAPPER}} .banner__content .banner-text' => 'display: {{VALUE}} !important' ],
		] );

		$this->add_control( 'text_alignment', [
			'label'     => esc_html__( 'Alignment', 'heal-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [ 'title' => esc_html__( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
			],
			'default'   => '',
			'condition' => [ 'show_text' => 'show' ],
			'toggle'    => true,
			'selectors' => [ '{{WRAPPER}} .banner__content .banner-text' => 'text-align: {{VALUE}} !important' ],
		] );

		$this->add_control( 'text_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'condition'  => [ 'show_text' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

		$this->add_control( 'text_padding', [
			'label'      => __( 'Padding', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'condition'  => [ 'show_text' => 'show' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'text_typography',
			'label'     => __( 'Typography', 'heal-core' ),
			'condition' => [ 'show_text' => 'show' ],
			'selector'  => '{{WRAPPER}} .banner__content .banner-text',
		] );

		$this->add_control( 'text_color', [
			'label'      => __( 'Color', 'heal-core' ),
			'type'       => Controls_Manager::COLOR,
			'condition'  => [ 'show_text' => 'show' ],
			'separator'  => 'after',
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-text' => 'color: {{VALUE}} !important' ],
		] );

		$this->add_control( 'text_hover_color', [
			'label'      => __( 'Hover Color', 'heal-core' ),
			'type'       => Controls_Manager::COLOR,
			'condition'  => [ 'show_text' => 'show' ],
			'separator'  => 'after',
			'selectors'  => [ '{{WRAPPER}} .banner__content .banner-text:hover' => 'color: {{VALUE}} !important' ],
		] );

		$this->end_controls_section();

		/* -------------------------
		 * STYLE — Button
		 * ------------------------- */
		$this->start_controls_section( 'button_control', [
			'label' => __( 'Button Settings', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'show_button', [
			'label'   => esc_html__( 'Show Button', 'heal-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'show' => [ 'title' => esc_html__( 'Show', 'heal-core' ), 'icon' => 'eicon-check-circle' ],
				'none' => [ 'title' => esc_html__( 'Hide', 'heal-core' ), 'icon' => 'eicon-close-circle' ],
			],
			'default'   => 'show',
			'selectors' => [ '{{WRAPPER}} .banner__content .theme-btn' => 'display: {{VALUE}} !important' ],
		] );

		$this->add_control( 'button_alignment', [
			'label'     => esc_html__( 'Alignment', 'heal-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'condition' => [ 'show_button' => 'show' ],
			'options'   => [
				'left'   => [ 'title' => esc_html__( 'Left', 'heal-core' ), 'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'heal-core' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'heal-core' ), 'icon' => 'eicon-text-align-right' ],
			],
			'default'   => '',
			'toggle'    => true,
			'selectors' => [ '{{WRAPPER}} .banner__content .theme-btn' => 'text-align: {{VALUE}} !important' ],
		] );

		$this->add_control( 'button_color', [
			'label'     => __( 'Button Color', 'heal-core' ),
			'type'      => Controls_Manager::COLOR,
			'condition' => [ 'show_button' => 'show' ],
			'selectors' => [ '{{WRAPPER}} .banner__content .theme-btn' => 'color: {{VALUE}} !important' ],
		] );

		$this->add_control( 'button_bg_color', [
			'label'     => __( 'Button Background Color', 'heal-core' ),
			'type'      => Controls_Manager::COLOR,
			'condition' => [ 'show_button' => 'show' ],
			'selectors' => [ '{{WRAPPER}} .banner__content .theme-btn' => 'background: {{VALUE}} !important' ],
		] );

		$this->add_control( 'button_hover_color', [
			'label'     => __( 'Button Hover Color', 'heal-core' ),
			'type'      => Controls_Manager::COLOR,
			'condition' => [ 'show_button' => 'show' ],
			'selectors' => [ '{{WRAPPER}} .banner__content .theme-btn:hover' => 'color: {{VALUE}} !important' ],
		] );

		$this->add_control( 'button_bg_hover_color', [
			'label'     => __( 'Button Background Hover Color', 'heal-core' ),
			'type'      => Controls_Manager::COLOR,
			'condition' => [ 'show_button' => 'show' ],
			'selectors' => [
				'{{WRAPPER}} .banner__content .theme-btn::before' => 'background: {{VALUE}} !important',
				'{{WRAPPER}} .banner__content .theme-btn::after'  => 'background: {{VALUE}} !important',
			],
		] );

		$this->add_control( 'button_padding', [
			'label'      => __( 'Padding', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'condition'  => [ 'show_button' => 'show' ],
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important' ],
		] );

		$this->add_control( 'button_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'condition'  => [ 'show_button' => 'show' ],
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .theme-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'button_typography',
			'condition' => [ 'show_button' => 'show' ],
			'label'     => __( 'Typography', 'heal-core' ),
			'selector'  => '{{WRAPPER}} .banner__content .theme-btn',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'border',
			'condition' => [ 'show_button' => 'show' ],
			'selector'  => '{{WRAPPER}} .banner__content .theme-btn',
		] );

		$this->add_control( 'border_radius', [
			'label'      => __( 'Border Radius', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'condition'  => [ 'show_button' => 'show' ],
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [ '{{WRAPPER}} .banner__content .theme-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important' ],
		] );

		$this->end_controls_section();

		

		/* -------------------------
		 * STYLE — Section spacing
		 * ------------------------- */
		$this->start_controls_section( 'section_box', [
			'label' => __( 'Section Box', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'section_padding', [
			'label'      => __( 'Padding', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .banner__section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		] );

		$this->add_control( 'section_margin', [
			'label'      => __( 'Margin', 'heal-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .banner__section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		] );

		$this->end_controls_section();

		/* -------------------------
		 * STYLE — Instance CSS
		 * ------------------------- */
		$this->start_controls_section( 'section_custom_css', [
			'label' => __( 'Custom CSS (Instance)', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$control_type = defined( '\Elementor\Controls_Manager::CODE' ) ? Controls_Manager::CODE : Controls_Manager::TEXTAREA;
		$this->add_control( 'custom_css', [
			'label'       => __( 'Write CSS', 'heal-core' ),
			'type'        => $control_type,
			'rows'        => 20,
			'label_block' => true,
			'language'    => 'css',
			'description' => __( 'Use <code>{{WRAP}}</code> as root selector. Example: <code>{{WRAP}} .banner__content{max-width:720px}</code>', 'heal-core' ),
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$allowed    = wp_kses_allowed_html( 'post' );
		$widget_id  = $this->get_id();
		$root_id    = 'banner-' . $widget_id;
		$root_sel   = '#'. $root_id;

		

		// Instance CSS
		if ( ! empty( $settings['custom_css'] ) ) {
			$css = str_replace( '{{WRAP}}', $root_sel, $settings['custom_css'] );
			echo '<style id="banner-css-'.esc_attr($widget_id).'">'.$css.'</style>';
		}

		// ---------- MARKUP ----------
		?>
		<div id="<?php echo esc_attr( $root_id ); ?>" class="banner-widget">
		<?php

		// STYLE 1
		if ( 'style1' === ( $settings['style'] ?? '' ) ) : ?>	
            <div class="hafsa">
                <div class="banner-section">
                    <div class="container">
                        <div class="row align-items-center flex-column-reverse flex-md-row">
                            <?php if(!empty($settings['block_image']['url'] )) : ?>
                                <div class="col-md-6">
                                    <div class="banner-item">
                                        <div class="banner-inner">
                                            <div class="banner-thumb">
                                                <img src="<?php echo esc_url( $settings['block_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['block_image_alt'] ); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="col-md-6">
                                <div class="banner-item">
                                    <div class="banner-inner">
                                        <div class="banner-content align-middle">
                                            <h1><?php echo wp_kses( $settings['block_title'], $allowed ); ?></h1>
                                            <p><?php echo wp_kses( $settings['block_text'], $allowed ); ?></p>

                                            <?php if ( ! empty( $settings['block_button'] ) && ! empty( $settings['block_button_link']['url'] ) ) : ?>
                                                <a href="<?php echo esc_url( $settings['block_button_link']['url'] ); ?>"
                                                class="lab-btn mt-3"
                                                <?php echo ! empty( $settings['block_button_link']['is_external'] ) ? 'target="_blank" rel="noopener"' : ''; ?>>
                                                    <span><?php echo wp_kses( $settings['block_button'], $allowed ); ?></span>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php
		// STYLE 2
		elseif ( 'style2' === ( $settings['style'] ?? '' ) ) :
			
        ?>

		<?php
		// STYLE 3
		elseif ( 'style3' === ( $settings['style'] ?? '' ) ) :
			
            
        ?>
		<?php endif; ?>

		</div><!-- #<?php echo esc_html( $root_id ); ?> -->
		<?php
	}
}

/* Register custom category (if needed) */
\add_action( 'elementor/elements/categories_registered', function( $elements_manager ){
	$elements_manager->add_category( 'heal_widgets', [
		'title' => __( 'Heal Widgets', 'heal-core' ),
		'icon'  => 'fa fa-plug',
	], 1 );
} );

/* Register widget (new API) */
\add_action( 'elementor/widgets/register', function( $widgets_manager ) {
	$widgets_manager->register( new \Elementor\Theme_Religion_Banner() );
} );
