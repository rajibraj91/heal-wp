<?php
/**
 * Theme Social Share Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {


    // Create a About Widget
    CSF::createWidget('heal_social_share_widget', array(
        'title' => esc_html__('Heal: Social Share', 'heal-core'),
        'classname' => 'heal-social-share-about',
        'description' => esc_html__('Display Social Share widget', 'heal-core'),
        'fields' => array(
            array(
                'id' => 'heading',
                'type' => 'text',
                'title' => esc_html__('Enter Your Header Title', 'heal-core'),
                'default' => esc_html__('Never Miss News', 'heal-core')
            ),
            array(
                'id' => 'heal-social-icon-repeater',
                'type' => 'repeater',
                'title' => esc_html__('Social Icon', 'heal-core'),
                'fields' => array(
                    array(
                        'id' => 'heal-social-icon',
                        'type' => 'icon',
                        'title' => esc_html__('Icon', 'heal-core'),
                        'default' => 'fab fa-facebook'
                    ),
                    array(
                        'id' => 'heal-social-text',
                        'type' => 'text',
                        'title' => esc_html__('Enter Your Ulr', 'heal-core'),
                        'default' => '#'
                    ),
                ),
            ),
        )
    ));


    if (!function_exists('heal_social_share_widget')) {
        function heal_social_share_widget($args, $instance)
        {

            echo $args['before_widget'];
            

            $heading_title = $instance['heading'] ?? '';
            $socialIcon = is_array($instance['heal-social-icon-repeater']) && !empty($instance['heal-social-icon-repeater']) ? $instance['heal-social-icon-repeater'] : [];


            ?>
            <div class="social-share-widget">
                <h4 class="widget-headline"><?php echo esc_html($heading_title); ?></h4>
                <ul class="social-icon style-03">
                    <?php
                    foreach ($socialIcon as $icon) {
                        printf('<li><a href="%2$s"><i class="%1$s"></i></a></li>', esc_html($icon['heal-social-icon']), esc_url($icon['heal-social-text']));
                    };
                    ?>
                </ul>
            </div>

            <?php

            echo $args['after_widget'];

        }
    }

}

?>