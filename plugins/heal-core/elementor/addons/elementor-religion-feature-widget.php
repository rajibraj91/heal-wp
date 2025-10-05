<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package heal
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Theme_Religion_Feature extends Widget_Base {

	public function get_name() {
		return 'hafsa-feature-widget';
	}

	public function get_title() {
		return esc_html__( 'Feature', 'heal-core' );
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
			'theme_religion_feature',
			[
				'label' => esc_html__( 'Feature Style', 'heal-core' ),
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
				],
			]
		);

		$this->end_controls_section();
		// End of Tab Start - 1

		

		/* ------ CONTENT — Blocks ------ */
		$this->start_controls_section( 'content_section', [
			'label' => __( 'Block', 'heal-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
            'condition'   => [ 'style' => [ 'style1' ] ],
		] );

        $this->add_control( 'repeat', [
			'type'       => Controls_Manager::REPEATER,
			'separator'  => 'before',
			'default'    => [ [ 'block_title' => esc_html__( 'Feature Repeater', 'heal-core' ) ] ],
			'condition'  => [ 'style' => [ 'style1'] ],
			'fields'     => [
				[
					'name'    => 'block_image',
					'label'   => esc_html__( 'Thumb', 'heal-core' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [ 'url' => Utils::get_placeholder_image_src() ],
				],
				[ 
                    'name' => 'block_image_alt', 
                    'label' => esc_html__( 'Alt Text', 'heal-core' ), 
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ],
				[ 
                    'name' => 'block_title',    
                    'label' => esc_html__( 'Title', 'heal-core' ),    
                    'type' => Controls_Manager::TEXTAREA ,
                    'label_block' => true,
                ],
				[ 
                    'name' => 'block_text',     
                    'label' => esc_html__( 'Text', 'heal-core' ),     
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                ],
				// [
				// 	'name'    => 'block_button',
				// 	'label'   => __( 'Button', 'heal-core' ),
				// 	'type'    => Controls_Manager::TEXT,
				// 	'dynamic' => [ 'active' => true ],
				// 	'default' => esc_html__( 'Donate Now', 'heal-core' ),
				// ],
				// [
				// 	'name'         => 'block_button_link',
				// 	'label'        => __( 'Button Url', 'heal-core' ),
				// 	'type'         => Controls_Manager::URL,
				// 	'placeholder'  => __( 'https://your-link.com', 'heal-core' ),
				// 	'show_external'=> true,
				// 	'default'      => [ 'url' => '', 'is_external' => true, 'nofollow' => true ],
				// ],
                [
                    'name' => 'show_button',
                    'label' => esc_html__( 'Show Button?', 'heal-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'heal-core' ),
                    'label_off' => esc_html__( 'Hide', 'heal-core' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ],
                [
                    'name'    => 'block_button',
                    'label'   => __( 'Button', 'heal-core' ),
                    'type'    => Controls_Manager::TEXT,
                    'dynamic' => [ 'active' => true ],
                    'default' => esc_html__( 'Donate Now', 'heal-core' ),
                    'condition' => [ 'show_button' => 'yes' ],
                ],
                [
                    'name'         => 'block_button_link',
                    'label'        => __( 'Button Url', 'heal-core' ),
                    'type'         => Controls_Manager::URL,
                    'placeholder'  => __( 'https://your-link.com', 'heal-core' ),
                    'show_external'=> true,
                    'default'      => [ 'url' => '', 'is_external' => true, 'nofollow' => true ],
                    'condition'    => [ 'show_button' => 'yes' ],
                ],
			],
			'title_field' => '{{block_title}}',
		] );

		$this->end_controls_section();

		

		/*
		 * =============== STYLE TAB ===============
        */

		// Section Wrapper (common)
		$this->start_controls_section(
			'sec_style_item',
			[
				'label' => esc_html__( 'Item Style', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_margin',
			[
				'label' => esc_html__( 'Margin', 'heal-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .lab-item'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__( 'Padding', 'heal-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .lab-item'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'item_bg',
				'label' => esc_html__( 'Background', 'heal-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .lab-item, {{WRAPPER}} .poster-section',
			]
		);
        $this->add_control(
            'item_border_radius',
            [
                'label' => esc_html__( 'Item Radius', 'heal-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .lab-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();


        $this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'heal-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .feature-section .lab-content h5'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__( 'Title Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .feature-section .lab-content h5',
            ]
        );
        
        $this->start_controls_tabs( 'tabs_title_color' );
        $this->start_controls_tab(
            'tab_title_color_normal',
            [
                'label' => esc_html__( 'Normal', 'heal-core' ),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'heal-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-section .lab-content h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_title_color_hover',
            [
                'label' => esc_html__( 'Hover', 'heal-core' ),
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'heal-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-section .lab-item:hover .lab-content h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->end_controls_section();

        // Description
        $this->start_controls_section(
			'desc_style',
			[
				'label' => esc_html__( 'Description', 'heal-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
			'desc_margin',
			[
				'label' => esc_html__( 'Margin', 'heal-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .feature-section .lab-content p'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'label'    => esc_html__( 'Title Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .feature-section .lab-content p',
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Color', 'heal-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-section .lab-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->end_controls_section();


        // Button Style Section
        $this->start_controls_section(
            'btn_style',
            [
                'label' => esc_html__( 'Button', 'heal-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Margin
        $this->add_responsive_control(
            'btn_margin',
            [
                'label' => esc_html__( 'Margin', 'heal-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .lab-item a.text-btn, {{WRAPPER}} .lab-item a.lab-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'heal-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-section .lab-content a.text-btn, {{WRAPPER}} .feature-section .lab-content a.lab-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typography',
                'label'    => esc_html__( 'Typography', 'heal-core' ),
                'selector' => '{{WRAPPER}} .feature-section .lab-content a.text-btn, {{WRAPPER}} .feature-section .lab-content a.lab-btn',
            ]
        );

        // Tabs: Normal & Hover
        $this->start_controls_tabs( 'tabs_btn_style' );

        // 🔹 Normal Tab
        $this->start_controls_tab(
            'tab_btn_style_normal',
            [
                'label' => esc_html__( 'Normal', 'heal-core' ),
            ]
        );

        // Text Color
        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__( 'Text Color', 'heal-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-section .lab-content a.text-btn, {{WRAPPER}} .feature-section .lab-content a.lab-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_background',
                'label' => esc_html__( 'Background', 'heal-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .feature-section .lab-content a.text-btn, {{WRAPPER}} .feature-section .lab-content a.lab-btn',
            ]
        );

        // Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'heal-core' ),
                'selector' => '{{WRAPPER}} .feature-section .lab-content a.text-btn, {{WRAPPER}} .feature-section .lab-content a.lab-btn',
            ]
        );

        // Border Radius
        $this->add_control(
            'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'heal-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .feature-section .lab-content a.text-btn, {{WRAPPER}} .feature-section .lab-content a.lab-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();


        // 🔹 Hover Tab
        $this->start_controls_tab(
            'tab_btn_style_hover',
            [
                'label' => esc_html__( 'Hover', 'heal-core' ),
            ]
        );

        // Hover Text Color
        $this->add_control(
            'btn_hover_color',
            [
                'label' => esc_html__( 'Text Hover Color', 'heal-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-section .lab-content a.text-btn:hover, {{WRAPPER}} .feature-section .lab-content a.lab-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Hover Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_hover_background',
                'label' => esc_html__( 'Hover Background', 'heal-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .feature-section .lab-content a.text-btn:hover, {{WRAPPER}} .feature-section .lab-content a.lab-btn:hover',
            ]
        );

        // Hover Border Color
        $this->add_control(
            'btn_hover_border_color',
            [
                'label' => esc_html__( 'Hover Border Color', 'heal-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-section .lab-content a.text-btn:hover, {{WRAPPER}} .feature-section .lab-content a.lab-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        // Transition
        $this->add_control(
            'btn_transition',
            [
                'label' => esc_html__( 'Transition Duration (ms)', 'heal-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 3000,
                'step' => 50,
                'default' => 300,
                'selectors' => [
                    '{{WRAPPER}} .feature-section .lab-content a.text-btn, {{WRAPPER}} .feature-section .lab-content a.lab-btn' => 'transition: all {{VALUE}}ms ease-in-out;',
                ],
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
		

		<?php if ( 'style1' === $settings['style'] ) : 
            $items = ( ! empty( $settings['repeat'] ) && is_array( $settings['repeat'] ) ) ? $settings['repeat'] : [];
        ?>
            <div class="hafsa">
                <div class="feature-section padding-tb">
                    <div class="container">
                        <div class="row justify-content-center">
                            <?php foreach( $items as $item ):
								$img_url = ! empty( $item['block_image']['url'] ) ? $item['block_image']['url']
                                : ( ! empty( $item['block_image']['id'] ) ? wp_get_attachment_url( $item['block_image']['id'] ) : '' );
                            ?>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="lab-item feature-item text-xs-center">
                                        <div class="lab-inner">
                                            <div class="lab-thumb">
                                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr($item['block_image_alt']); ?>">
                                            </div>
                                            <div class="lab-content">
                                                <h5><?php echo wp_kses( $item['block_title'], $allowed_tags ); ?></h5>
                                                <p><?php echo wp_kses( $item['block_text'], $allowed_tags ); ?></p>
                                                
                                                <?php if ( $item['show_button'] === 'yes' && !empty($item['block_button']) ) : ?>
                                                    <a class="text-btn" href="<?php echo esc_url( $item['block_button_link']['url'] ); ?>" 
                                                    <?php if( $item['block_button_link']['is_external'] ) echo 'target="_blank"'; ?>
                                                    <?php if( $item['block_button_link']['nofollow'] ) echo 'rel="nofollow"'; ?>
                                                    class="your-button-class">
                                                    <?php echo esc_html( $item['block_button'] ); ?>
                                                    </a>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
							<?php endforeach; ?>
                            
                        </div>
                    </div>
                </div>
            </div>

		<?php elseif ( 'style2' === $settings['style'] ) : ?>
			
			
		<?php endif; ?>

		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Theme_Religion_Feature() );
