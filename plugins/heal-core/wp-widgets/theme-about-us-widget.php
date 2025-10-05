<?php
/**
 * Theme About Us Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {


    // Create a About Widget
    CSF::createWidget('heal_about_widget', array(
        'title' => esc_html__('Heal: About Us', 'heal-core'),
        'classname' => 'heal-widget-about',
        'description' => esc_html__('Display about us widget', 'heal-core'),
        'fields' => array(
            array(
                'id' => 'logo-area',
                'type' => 'media',
                'title' => esc_html__('Upload Your Photo', 'heal-core'),
            ),
            array(
                'id' => 'description',
                'type' => 'textarea',
                'title' => esc_html__('Description', 'Heal-core'),
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.', 'heal-core')
            ),
            array(
                'id' => 'shortcode',
                'type' => 'textarea',
                'title' => esc_html__('Shortcode', 'Heal-core'),
            ),

            array(
                'id' => 'heal-footer-social-icon-repeater',
                'type' => 'repeater',
                'title' => esc_html__('Social Icon', 'heal-core'),
                'fields' => array(

                    array(
                        'id' => 'heal-footer-social-icon',
                        'type' => 'icon',
                        'title' => esc_html__('Icon', 'heal-core'),
                        'default' => 'flaticon-call'
                    ),
                    array(
                        'id' => 'heal-footer-social-text',
                        'type' => 'text',
                        'title' => esc_html__('Enter Your Url', 'heal-core'),
                        'default' => esc_html__('#', 'heal-core')
                    ),

                ),
            ),
        )
    ));


    if (!function_exists('heal_about_widget')) {
        function heal_about_widget($args, $instance)
        {

            echo $args['before_widget'];

            $logo = $instance['logo-area'];
            $img_id = $logo['id'] ?? '';
            $img_print = $img_id ? wp_get_attachment_image_src($img_id,'full')[0] : '';
            $alt_text = get_post_meta($img_id, '_wp_attachment_image_alt', true);
            $paragraph = $instance['description'] ?? '';
            $shortcode = $instance['shortcode'] ?? '';
            $socialIcon = is_array($instance['heal-footer-social-icon-repeater']) && !empty($instance['heal-footer-social-icon-repeater']) ? $instance['heal-footer-social-icon-repeater'] : [];


            ?>
            <div class="footer-widget widget">
                <div class="about_us_widget style-01">
                    <a href="<?php echo get_home_url(); ?>" class="footer-logo"><?php
                        if (!empty($img_print)) {
                            printf('<img src="%1$s" alt="%2$s"/>', esc_url($img_print), esc_attr($alt_text));
                        }
                    ?>  
                    </a>
                    <?php echo $paragraph; ?>
                    <?php echo do_shortcode($shortcode); ?>
                    <?php if (!empty($socialIcon)) { ?>
                        <ul class="contact_info_list">
                            <?php
                            foreach ($socialIcon as $icon) {
                                echo '<li class="single-info-item">
                                <div class="icon"><a href="'.$icon['heal-footer-social-text'].'">
                                    <i class="' . $icon['heal-footer-social-icon'] . '"></i></a>
                                </div>
                            </li>';
                            };
                            ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>

            <?php

            echo $args['after_widget'];

        }
    }

}

?>