<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package heal
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Theme_Religion_About extends Widget_Base {

	public function get_name() {
		return 'hafsa-about-widget';
	}

	public function get_title() {
		return esc_html__( 'About', 'heal-core' );
	}

	public function get_icon() {
		return 'theme-icon';
	}

	public function get_categories() {
		return [ 'heal_religion' ];
	}

	protected function register_controls() {

		/**
		 * =============== CONTENT TAB ===============
		 */

		// Tab Start - 1
		$this->start_controls_section(
			'theme_religion_about',
			[
				'label' => esc_html__( 'About Style', 'heal-core' ),
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
					'style4' => esc_html__( 'Style 4', 'heal-core' ),
					'style5' => esc_html__( 'Style 5', 'heal-core' ),
				],
			]
		);

		$this->end_controls_section();
		// End of Tab Start - 1

		// Section Header start
		$this->start_controls_section(
			'section_heading',
			[
				'label' => __( 'Section Header', 'heal-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => [ 'style3', 'style5' ],
				],
			]
		);

		$this->add_control(
			'section_title',
			[
				'label' => esc_html__( 'Section Title', 'heal-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'placeholder' => esc_html__( 'Enter title text', 'heal-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'section_description',
			[
				'label' => esc_html__( 'Description', 'heal-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'placeholder' => esc_html__( 'Enter description', 'heal-core' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
		// End of Section Header

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


        $this->add_control( 'block_subtitle', [
            'label'   => esc_html__( 'Sub Title', 'heal-core' ),
            'type'    => Controls_Manager::TEXT,
            'label_block' => true,
        ]);

        $this->add_control( 'block_title', [
            'label'   => esc_html__( 'Title', 'heal-core' ),
            'type'    => Controls_Manager::TEXTAREA,
        ]);

        $this->add_control( 'block_subtitle2', [
            'label'   => esc_html__( 'Sub Title 2', 'heal-core' ),
            'type'    => Controls_Manager::TEXT,
            'label_block' => true,
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

		

		/*
		 * =============== STYLE TAB ===============
        */

		// Section Wrapper (common)
		$this->start_controls_section(
			'sec_style_wrapper',
			[
				'label' => esc_html__( 'Section Wrapper', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_padding',
			[
				'label' => esc_html__( 'Padding', 'heal-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .about-section'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .poster-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'section_bg',
				'label' => esc_html__( 'Background', 'heal-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .about-section, {{WRAPPER}} .poster-section',
			]
		);

		$this->end_controls_section();

        // Section Wrapper (common)
		$this->start_controls_section(
			'grp_style_wrapper',
			[
				'label' => esc_html__( 'Bg Grp', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bg_img_grp',
				'label' => esc_html__( 'Background', 'heal-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .img-grp',
			]
		);

		$this->end_controls_section();


	}

	/**
	 * Render
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$allowed_tags = wp_kses_allowed_html('post');
		?>
		

		<?php if ( 'style1' === $settings['style'] ) : ?>
            <div class="hafsa">
                <div class="about-section padding-tb shape-1">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-12">
                                <div class="lab-item">
                                    <div class="lab-inner">
                                        <div class="lab-content">
                                            <div class="header-title text-start m-0">
                                                <h5><?php echo wp_kses( $settings['block_subtitle'], $allowed_tags ); ?></h5>
                                                <h2 class="mb-0"><?php echo wp_kses( $settings['block_title'], $allowed_tags ); ?></h2>
                                            </div>
                                            <h5 class="my-4"><?php echo wp_kses( $settings['block_subtitle2'], $allowed_tags ); ?></h5>
                                            <p><?php echo wp_kses( $settings['block_text'], $allowed_tags ); ?></p>
                                            
                                            <?php if ( ! empty( $settings['block_button'] ) && ! empty( $settings['block_button_link']['url'] ) ) : ?>
                                                <a href="<?php echo esc_url( $settings['block_button_link']['url'] ); ?>"
                                                class="lab-btn mt-4"
                                                <?php echo ! empty( $settings['block_button_link']['is_external'] ) ? 'target="_blank" rel="noopener"' : ''; ?>>
                                                    <span><?php echo wp_kses( $settings['block_button'], $allowed_tags ); ?></span>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if(!empty($settings['block_image']['url'] )) : ?>
                                <div class="col-lg-6 col-12">
                                    <div class="lab-item">
                                        <div class="lab-inner">
                                            <div class="lab-thumb">
                                                <div class="img-grp">
                                                    <div class="about-circle-wrapper">
                                                        <div class="about-circle-2"></div>
                                                        <div class="about-circle"></div>
                                                    </div>
                                                    <div class="about-fg-img">
                                                        <img src="<?php echo esc_url( $settings['block_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['block_image_alt'] ); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

		<?php elseif ( 'style2' === $settings['style'] ) : ?>
			

		<?php elseif ( 'style3' === $settings['style'] ) : ?>
			

		<?php elseif ( 'style4' === $settings['style'] ) : ?>
			

		<?php elseif ( 'style5' === $settings['style'] ) : ?>
			
		<?php endif; ?>

		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Theme_Religion_About() );
