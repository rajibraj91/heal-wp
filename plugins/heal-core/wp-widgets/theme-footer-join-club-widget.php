<?php
/**
 * Theme Footer Join Club Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

if (class_exists('CSF')) {

    // Create Join Club Widget
    CSF::createWidget('heal_footer_join_club_widget', array(
        'title' => esc_html__('Heal: Footer Join Club', 'heal-core'),
        'classname' => 'heal-widget-footer-join-club',
        'description' => esc_html__('Display join club links widget in footer', 'heal-core'),
        'fields' => array(
            array(
                'id' => 'join_club_title',
                'type' => 'text',
                'title' => esc_html__('Widget Title', 'heal-core'),
                'default' => esc_html__('Join Our Club', 'heal-core'),
            ),
            array(
                'id' => 'join_club_links',
                'type' => 'repeater',
                'title' => esc_html__('Join Club Links', 'heal-core'),
                'fields' => array(
                    array(
                        'id' => 'join_link_text',
                        'type' => 'text',
                        'title' => esc_html__('Link Text', 'heal-core'),
                        'default' => esc_html__('Club History', 'heal-core'),
                    ),
                    array(
                        'id' => 'join_link_url',
                        'type' => 'text',
                        'title' => esc_html__('Link URL', 'heal-core'),
                        'default' => esc_html__('#', 'heal-core'),
                    ),
                ),
            ),
        ),
    ));

    if (!function_exists('heal_footer_join_club_widget')) {
        /**
         * Function to render the Footer Join Club widget
         *
         * @param array $args Widget arguments.
         * @param array $instance Widget instance settings.
         */
        function heal_footer_join_club_widget($args, $instance)
        {
            echo $args['before_widget'];

            // Get widget values
            $title = $instance['join_club_title'] ?? '';
            $links = !empty($instance['join_club_links']) && is_array($instance['join_club_links']) ? $instance['join_club_links'] : [];

            ?>
            <div class="gt-footer-widget-items">
                <div class="gt-widget-head">
                    <?php if (!empty($title)) : ?>
                        <h3><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>
                </div>
                <ul class="gt-list-area">
                    <?php foreach ($links as $link) :
                        $text = $link['join_link_text'] ?? '';
                        $url = $link['join_link_url'] ?? '#';
                        ?>
                        <li>
                            <a href="<?php echo esc_url($url); ?>">
                                <?php echo esc_html($text); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php

            echo $args['after_widget'];
        }
    }
}
?>
