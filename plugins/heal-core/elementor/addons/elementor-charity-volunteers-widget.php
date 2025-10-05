<?php
/**
 * Plugin Name: Heal Core - Volunteers Widget (Single File)
 * Description: Elementor Volunteers/Team widget with two styles, full Style controls, and social links.
 * Version:     1.0.2
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

class Theme_Volunteers extends Widget_Base {

    public function get_name() { return 'volunteers-widget'; }
    public function get_title() { return esc_html__( 'Volunteers', 'heal-core' ); }
    public function get_icon()  { return 'theme-icon'; }
    public function get_categories() { return [ 'heal_charity' ]; }
    public function get_keywords() { return [ 'team', 'volunteer', 'member', 'staff', 'about' ]; }
    public function get_script_depends() { return []; }
    public function get_style_depends()  { return []; }

    protected function register_controls() {

        /* -----------------------------
         * STYLE SWITCH
         * ----------------------------- */
        $this->start_controls_section('theme_volunteer', [
            'label' => esc_html__( 'Volunteer Style', 'heal-core' ),
        ]);
        $this->add_control('style', [
            'label'   => esc_html__( 'Select Style', 'heal-core' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'style1',
            'options' => [
                'style1' => esc_html__( 'Style 1', 'heal-core' ),
                'style2' => esc_html__( 'Style 2', 'heal-core' ),
            ],
        ]);
        $this->end_controls_section();

        /* -----------------------------
         * SECTION HEADER (common)
         * ----------------------------- */
        $this->start_controls_section('section_heading', [
            'label' => __( 'Section Header', 'heal-core' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control('section_title', [
            'label'       => esc_html__( 'Section Title', 'heal-core' ),
            'type'        => Controls_Manager::TEXTAREA,
            'placeholder' => esc_html__( 'Enter title text', 'heal-core' ),
            'label_block' => true,
        ]);
        $this->add_control('section_description', [
            'label'       => esc_html__( 'Description', 'heal-core' ),
            'type'        => Controls_Manager::TEXTAREA,
            'placeholder' => esc_html__( 'Enter description', 'heal-core' ),
            'label_block' => true,
        ]);
        $this->end_controls_section();

        /* -----------------------------
         * STYLE 1: TEAM GRID (Repeater with Tabs)
         * ----------------------------- */
        $this->start_controls_section('team_member_section', [
            'label'     => __( 'Members', 'heal-core' ),
            'tab'       => Controls_Manager::TAB_CONTENT,
            'condition' => [ 'style' => 'style1' ],
        ]);

        $rep = new Repeater();

        // Tabs for repeater
        $rep->start_controls_tabs('team_member_tabs');

        // Info tab
        $rep->start_controls_tab('tab_information', [ 'label' => __( 'Information', 'heal-core' ) ]);

        $rep->add_control('member_image', [
            'label'   => __( 'Image', 'heal-core' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ]);
        $rep->add_control('member_image_alt', [
            'label'       => __( 'Image Alt', 'heal-core' ),
            'type'        => Controls_Manager::TEXT,
            'placeholder' => __( 'Alt text', 'heal-core' ),
        ]);
        $rep->add_control('member_name', [
            'label'       => __( 'Name', 'heal-core' ),
            'type'        => Controls_Manager::TEXT,
            'placeholder' => __( 'Name', 'heal-core' ),
        ]);
        $rep->add_control('member_desi', [
            'label'       => __( 'Designation', 'heal-core' ),
            'type'        => Controls_Manager::TEXT,
            'placeholder' => __( 'CEO', 'heal-core' ),
        ]);
        $rep->add_control('member_desc', [
            'label'       => __( 'Short Bio', 'heal-core' ),
            'type'        => Controls_Manager::TEXTAREA,
            'placeholder' => __( 'Description text...', 'heal-core' ),
        ]);
        $rep->add_control('member_permalink_switcher', [
            'label'        => esc_html__( 'Enable Profile Link', 'heal-core' ),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'heal-core' ),
            'label_off'    => esc_html__( 'Hide', 'heal-core' ),
            'return_value' => 'yes',
            'default'      => 'no',
        ]);
        $rep->add_control('member_permalink', [
            'label'       => __( 'URL', 'heal-core' ),
            'type'        => Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://your-link.com', 'heal-core' ),
            'default'     => [ 'url' => '' ],
            'condition'   => [ 'member_permalink_switcher' => 'yes' ],
        ]);

        $rep->end_controls_tab();

        // Social tab
        $rep->start_controls_tab('tab_social', [ 'label' => __( 'Social Links', 'heal-core' ) ]);

        foreach ([
            'facebook'  => 'Facebook',
            'instagram' => 'Instagram',
            'tiktok'    => 'TikTok',
            'youtube'   => 'YouTube',
            'whatsapp'  => 'WhatsApp',
            'x'         => 'X',
            'linkedin'  => 'LinkedIn',
            'snapchat'  => 'Snapchat',
            'pinterest' => 'Pinterest',
            'telegram'  => 'Telegram',
            'threads'   => 'Threads',
            'reddit'    => 'Reddit',
        ] as $key => $label) {
            $rep->add_control( $key.'_url', [
                'label'       => __( $label.' URL', 'heal-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => 'https://'.$key.'.com/',
                'default'     => [ 'url' => '' ],
            ]);
        }

        $rep->end_controls_tab();
        $rep->end_controls_tabs();

        $this->add_control('team_items', [
            'label'       => esc_html__( 'Volunteers Items', 'heal-core' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $rep->get_controls(),
            'title_field' => '{{ member_name }}',
        ]);

        // Column presets (Bootstrap-like)
        $this->add_control('columns', [
            'label'   => esc_html__( 'Columns', 'heal-core' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'col-xl-3 col-lg-4 col-sm-6 col-12', // 4 columns on xl
            'options' => [
                'col-12'                          => esc_html__( '1 Column', 'heal-core' ),
                'col-sm-6 col-12'                 => esc_html__( '2 Columns', 'heal-core' ),
                'col-lg-4 col-sm-6 col-12'        => esc_html__( '3 Columns', 'heal-core' ),
                'col-xl-3 col-lg-4 col-sm-6 col-12' => esc_html__( '4 Columns', 'heal-core' ),
                'col-xl-2 col-lg-3 col-sm-4 col-6'  => esc_html__( '6 Columns', 'heal-core' ),
            ],
        ]);

        $this->end_controls_section();

        /* -----------------------------
         * STYLE 2: CTA BLOCK
         * ----------------------------- */
        $this->start_controls_section('content_section', [
            'label'     => __( 'CTA Block', 'heal-core' ),
            'tab'       => Controls_Manager::TAB_CONTENT,
            'condition' => [ 'style' => 'style2' ],
        ]);

        $this->add_control('block_icon', [
            'label'   => esc_html__( 'Icon', 'heal-core' ),
            'type'    => Controls_Manager::ICONS,
            'default' => [ 'value' => 'fas fa-user', 'library' => 'fa-solid' ],
        ]);
        $this->add_control('block_heading', [
            'label'       => esc_html__( 'Heading', 'heal-core' ),
            'type'        => Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Become a Volunteer', 'heal-core' ),
        ]);
        $this->add_control('block_subheading', [
            'label'       => esc_html__( 'Sub Heading', 'heal-core' ),
            'type'        => Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Join our mission', 'heal-core' ),
        ]);
        $this->add_control('block_description', [
            'label'       => esc_html__( 'Description', 'heal-core' ),
            'type'        => Controls_Manager::WYSIWYG,
            'placeholder' => esc_html__( 'Enter description', 'heal-core' ),
        ]);
        $this->add_control('block_button_text', [
            'label'       => esc_html__( 'Button Text', 'heal-core' ),
            'type'        => Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Apply Now', 'heal-core' ),
        ]);
        $this->add_control('block_button_url', [
            'label'       => esc_html__( 'Button URL', 'heal-core' ),
            'type'        => Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://your-link.com', 'heal-core' ),
            'default'     => [ 'url' => '' ],
        ]);
        $this->add_control('block_img', [
            'label'   => esc_html__( 'Image', 'heal-core' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ]);
        $this->add_control('block_img_alt', [
            'label'       => esc_html__( 'Image ALT Text', 'heal-core' ),
            'type'        => Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Friendly volunteers', 'heal-core' ),
        ]);

        $this->end_controls_section();

        /* ============================
         * STYLE TAB(S)
         * ============================ */

        // Section header styles
        $this->start_controls_section('style_header', [
            'label' => __( 'Section Header', 'heal-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('sh_title_color', [
            'label'     => __( 'Title Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .section-header h2' => 'color: {{VALUE}};' ],
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'sh_title_typo',
            'selector' => '{{WRAPPER}} .section-header h2',
        ]);
        $this->add_control('sh_desc_color', [
            'label'     => __( 'Description Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .section-header p' => 'color: {{VALUE}};' ],
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'sh_desc_typo',
            'selector' => '{{WRAPPER}} .section-header p',
        ]);
        $this->add_responsive_control('header_spacing', [
            'label'     => __( 'Bottom Spacing', 'heal-core' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 0, 'max' => 120 ] ],
            'selectors' => [ '{{WRAPPER}} .section-header' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
        ]);
        $this->end_controls_section();

        // Card styles
        $this->start_controls_section('style_card', [
            'label' => __( 'Card', 'heal-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [ 'style' => 'style1' ],
        ]);
        $this->add_control('card_bg', [
            'label'     => __( 'Background', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .volunteer__item .volunteer__inner' => 'background-color: {{VALUE}};' ],
        ]);
        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'card_border',
            'selector' => '{{WRAPPER}} .volunteer__item .volunteer__inner',
        ]);
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name'     => 'card_shadow',
            'selector' => '{{WRAPPER}} .volunteer__item .volunteer__inner',
        ]);
        $this->add_responsive_control('card_radius', [
            'label'     => __( 'Border Radius', 'heal-core' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
            'selectors' => [ '{{WRAPPER}} .volunteer__item .volunteer__inner' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('card_padding', [
            'label'      => __( 'Padding', 'heal-core' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .volunteer__item .volunteer__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->end_controls_section();

        // Avatar & text styles
        $this->start_controls_section('style_media_text', [
            'label' => __( 'Avatar & Text', 'heal-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [ 'style' => 'style1' ],
        ]);
        $this->add_responsive_control('avatar_size', [
            'label'     => __( 'Avatar Size (px)', 'heal-core' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 40, 'max' => 200 ] ],
            'selectors' => [ '{{WRAPPER}} .volunteer__thumb img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; object-fit: cover;' ],
        ]);
        $this->add_responsive_control('avatar_radius', [
            'label'     => __( 'Avatar Radius', 'heal-core' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
            'selectors' => [ '{{WRAPPER}} .volunteer__thumb img' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ]);
        $this->add_control('name_color', [
            'label'     => __( 'Name Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .volunteer__content h5, {{WRAPPER}} .volunteer__title h5' => 'color: {{VALUE}};' ],
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'name_typo',
            'selector' => '{{WRAPPER}} .volunteer__content h5, {{WRAPPER}} .volunteer__title h5',
        ]);
        $this->add_control('desi_color', [
            'label'     => __( 'Designation Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .volunteer__content span, {{WRAPPER}} .volunteer__title h6' => 'color: {{VALUE}};' ],
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'desi_typo',
            'selector' => '{{WRAPPER}} .volunteer__content span, {{WRAPPER}} .volunteer__title h6',
        ]);
        $this->add_control('desc_color', [
            'label'     => __( 'Description Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .volunteer__content p' => 'color: {{VALUE}};' ],
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'desc_typo',
            'selector' => '{{WRAPPER}} .volunteer__content p',
        ]);
        $this->end_controls_section();

        // Social styles
        $this->start_controls_section('style_social', [
            'label' => __( 'Social Icons', 'heal-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [ 'style' => 'style1' ],
        ]);
        $this->add_responsive_control('social_size', [
            'label'     => __( 'Icon Size (px)', 'heal-core' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 10, 'max' => 48 ] ],
            'selectors' => [ '{{WRAPPER}} .footer__social a i' => 'font-size: {{SIZE}}{{UNIT}};' ],
        ]);
        $this->add_control('social_color', [
            'label'     => __( 'Icon Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .footer__social a' => 'color: {{VALUE}};' ],
        ]);
        $this->add_control('social_hover_color', [
            'label'     => __( 'Icon Hover Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .footer__social a:hover' => 'color: {{VALUE}};' ],
        ]);
        $this->add_responsive_control('social_gap', [
            'label'     => __( 'Gap', 'heal-core' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
            'selectors' => [ '{{WRAPPER}} .footer__social ul' => 'gap: {{SIZE}}{{UNIT}};' ],
        ]);
        $this->end_controls_section();

        // CTA (style2) styles
        $this->start_controls_section('style_cta', [
            'label'     => __( 'CTA Block', 'heal-core' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'style' => 'style2' ],
        ]);
        $this->add_control('cta_bg', [
            'label'     => __( 'Background', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .volunteer__item-style2 .volunteer__inner' => 'background-color: {{VALUE}};' ],
        ]);
        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'cta_border',
            'selector' => '{{WRAPPER}} .volunteer__item-style2 .volunteer__inner',
        ]);
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name'     => 'cta_shadow',
            'selector' => '{{WRAPPER}} .volunteer__item-style2 .volunteer__inner',
        ]);
        $this->add_responsive_control('cta_radius', [
            'label'     => __( 'Border Radius', 'heal-core' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
            'selectors' => [ '{{WRAPPER}} .volunteer__item-style2 .volunteer__inner' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('cta_padding', [
            'label'      => __( 'Padding', 'heal-core' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .volunteer__item-style2 .volunteer__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->add_control('cta_icon_color', [
            'label'     => __( 'Icon Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .volunteer__icon svg, .volunteer__icon i' => 'color: {{VALUE}}; fill: {{VALUE}};' ],
        ]);
         $this->add_control('cta_icon_border_color', [
            'label'     => __( 'Border Color', 'heal-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .volunteer__icon' => 'border-color: {{VALUE}};' ],
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'cta_heading_typo',
            'label'    => __( 'Heading Typography', 'heal-core' ),
            'selector' => '{{WRAPPER}} .volunteer__title h5',
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'cta_subheading_typo',
            'label'    => __( 'Subheading Typography', 'heal-core' ),
            'selector' => '{{WRAPPER}} .volunteer__title h6',
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        $allowed = wp_kses_allowed_html('post');

        if ( 'style1' === ($s['style'] ?? 'style1') ) {
            ?>
            <div class="volunteer-section padding--top padding--bottom">
                <div class="container">
                    <?php if ( ! empty( $s['section_title'] ) || ! empty( $s['section_description'] ) ) : ?>
                        <div class="section-header style-2">
                            <?php if ( ! empty( $s['section_title'] ) ) : ?>
                                <h2><?php echo wp_kses( $s['section_title'], $allowed ); ?></h2>
                            <?php endif; ?>
                            <?php if ( ! empty( $s['section_description'] ) ) : ?>
                                <p><?php echo wp_kses( $s['section_description'], $allowed ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="section-wrapper">
                        <div class="volunteer">
                            <div class="row justify-content-center g-4">
                                <?php if ( ! empty( $s['team_items'] ) && is_array( $s['team_items'] ) ) :
                                    foreach ( $s['team_items'] as $item ) :
                                        $name = $item['member_name'] ?? '';
                                        if ( empty( $name ) ) continue;

                                        $img  = $item['member_image']['url'] ?? '';
                                        $alt  = $item['member_image_alt'] ?? $name;
                                        $desi = $item['member_desi'] ?? '';
                                        $desc = $item['member_desc'] ?? '';
                                        $col  = $s['columns'] ?? 'col-xl-3 col-lg-4 col-sm-6 col-12';
                                        ?>
                                        <div class="<?php echo esc_attr( $col ); ?>">
                                            <div class="volunteer__item">
                                                <div class="volunteer__inner text-center">
                                                    <?php if ( ! empty( $img ) ) : ?>
                                                        <div class="volunteer__thumb">
                                                            <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy" decoding="async" />
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="volunteer__content">
                                                        <h5>
                                                            <?php
                                                            if ( ( $item['member_permalink_switcher'] ?? '' ) === 'yes' && ! empty( $item['member_permalink']['url'] ) ) {
                                                                $this->add_link_attributes( 'member_link_'.$this->get_id(), $item['member_permalink'] );
                                                                $this->add_render_attribute( 'member_link_'.$this->get_id(), 'rel', 'noopener' );
                                                                echo '<a '.$this->get_render_attribute_string( 'member_link_'.$this->get_id() ).'>'.esc_html( $name ).'</a>';
                                                            } else {
                                                                echo esc_html( $name );
                                                            }
                                                            ?>
                                                        </h5>

                                                        <?php if ( ! empty( $desi ) ) : ?><span><?php echo esc_html( $desi ); ?></span><?php endif; ?>
                                                        <?php if ( ! empty( $desc ) ) : ?><p><?php echo esc_html( $desc ); ?></p><?php endif; ?>

                                                        <div class="footer__social">
                                                            <ul class="justify-content-center" style="display:flex;flex-wrap:wrap;gap:.5rem;list-style:none;padding-left:0;margin:0;">
                                                                <?php
                                                                $socials = [
                                                                    'facebook'  => 'fa-facebook-f',
                                                                    'instagram' => 'fa-instagram',
                                                                    'tiktok'    => 'fa-tiktok',
                                                                    'youtube'   => 'fa-youtube',
                                                                    'whatsapp'  => 'fa-whatsapp',
                                                                    'x'         => 'fa-x-twitter',
                                                                    'linkedin'  => 'fa-linkedin-in',
                                                                    'snapchat'  => 'fa-snapchat',
                                                                    'pinterest' => 'fa-pinterest-p',
                                                                    'telegram'  => 'fa-telegram',
                                                                    'threads'   => 'fa-threads',
                                                                    'reddit'    => 'fa-reddit',
                                                                ];
                                                                foreach ( $socials as $key => $icon ) {
                                                                    $url = $item[ $key.'_url' ]['url'] ?? '';
                                                                    if ( ! empty( $url ) ) {
                                                                        echo '<li><a href="'.esc_url( $url ).'" target="_blank" rel="noopener" aria-label="'.esc_attr( ucfirst($key) ).'"><i class="fa-brands '.$icon.'"></i></a></li>';
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; else : ?>
                                    <div class="col-12"><p><?php echo esc_html__( 'No volunteers added.', 'heal-core' ); ?></p></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else { // style2
            $img  = $s['block_img']['url'] ?? '';
            $alt  = $s['block_img_alt'] ?? ( $s['block_heading'] ?? '' );
            $btn  = $s['block_button_text'] ?? '';
            $btnU = $s['block_button_url']['url'] ?? '';
            ?>
            <div class="volunteer-section bg-ash padding--top padding--bottom">
                <div class="container">
                    <?php if ( ! empty( $s['section_title'] ) || ! empty( $s['section_description'] ) ) : ?>
                        <div class="section-header style-2">
                            <?php if ( ! empty( $s['section_title'] ) ) : ?>
                                <h2><?php echo wp_kses( $s['section_title'], $allowed ); ?></h2>
                            <?php endif; ?>
                            <?php if ( ! empty( $s['section_description'] ) ) : ?>
                                <p><?php echo wp_kses( $s['section_description'], $allowed ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="section-wrapper pt-4">
                        <div class="volunteer volunteer-style2">
                            <div class="volunteer__item volunteer__item-style2">
                                <div class="volunteer__inner">
                                    <?php if ( ! empty( $img ) ) : ?>
                                        <div class="volunteer__thumb">
                                            <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy" decoding="async" />
                                        </div>
                                    <?php endif; ?>

                                    <div class="volunteer__content">
                                        <div class="volunteer__top">
                                            <?php if ( ! empty( $s['block_icon'] ) ) : ?>
                                                <div class="volunteer__icon" aria-hidden="true">
                                                    <?php \Elementor\Icons_Manager::render_icon( $s['block_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="volunteer__title">
                                                <?php if ( ! empty( $s['block_heading'] ) ) : ?>
                                                    <h5><?php echo esc_html( $s['block_heading'] ); ?></h5>
                                                <?php endif; ?>
                                                <?php if ( ! empty( $s['block_subheading'] ) ) : ?>
                                                    <h6><?php echo esc_html( $s['block_subheading'] ); ?></h6>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <?php if ( ! empty( $s['block_description'] ) ) : ?>
                                            <div class="volunteer__bottom">
                                                <p><?php echo wp_kses( $s['block_description'], $allowed ); ?></p>
                                                <?php if ( ! empty( $btnU ) && ! empty( $btn ) ) :
                                                    $this->add_link_attributes( 'cta_btn_'.$this->get_id(), $s['block_button_url'] );
                                                    $this->add_render_attribute( 'cta_btn_'.$this->get_id(), 'class', 'default-btn move-right' );
                                                    ?>
                                                    <a <?php echo $this->get_render_attribute_string( 'cta_btn_'.$this->get_id() ); ?>>
                                                        <span><?php echo esc_html( $btn ); ?></span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.volunteer-style2 -->
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

/* ---------------------------------
 * Register with modern API
 * --------------------------------- */
add_action( 'elementor/widgets/register', function( $widgets_manager ){
    // Ensure category exists
    add_action( 'elementor/elements/categories_registered', function( $elements_manager ){
        $categories = $elements_manager->get_categories();
        if ( ! isset( $categories['heal_widgets'] ) ) {
            $elements_manager->add_category(
                'heal_widgets',
                [ 'title' => esc_html__( 'Heal Widgets', 'heal-core' ), 'icon' => 'fa fa-plug' ]
            );
        }
    }, 5 );

    $widgets_manager->register( new \Elementor\Theme_Volunteers() );
} );
