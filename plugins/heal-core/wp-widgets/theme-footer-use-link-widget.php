<?php
/**
 * Theme Footer Useful Links Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

// Control core classes for avoiding errors
if (class_exists('CSF')) {

    // Create Footer Useful Links Widget
    CSF::createWidget('heal_footer_useful_links_widget', array(
        'title' => esc_html__('Heal: Footer Useful Links', 'heal-core'),
        'classname' => 'heal-widget-footer-useful-links',
        'description' => esc_html__('Display useful links widget in footer', 'heal-core'),
        'fields' => array(
            array(
                'id' => 'useful_links_title',
                'type' => 'text',
                'title' => esc_html__('Title', 'heal-core'),
                'default' => esc_html__('Useful Links', 'heal-core'),
            ),
            array(
                'id' => 'useful_links',
                'type' => 'repeater',
                'title' => esc_html__('Useful Links', 'heal-core'),
                'fields' => array(
                    array(
                        'id' => 'useful_link_label',
                        'type' => 'text',
                        'title' => esc_html__('Link Text', 'heal-core'),
                        'default' => esc_html__('About Us', 'heal-core'),
                    ),
                    array(
                        'id' => 'useful_link_url',
                        'type' => 'text',
                        'title' => esc_html__('Link URL', 'heal-core'),
                        'default' => esc_html__('#', 'heal-core'),
                    ),
                ),
            ),
        )
    ));

    if (!function_exists('heal_footer_useful_links_widget')) {
        /**
         * Function to render the Footer Useful Links widget.
         * 
         * @param array $args Widget arguments.
         * @param array $instance Widget instance with widget options.
         */
        function heal_footer_useful_links_widget($args, $instance)
        {
            echo $args['before_widget'];

            // Get widget settings
            $title = $instance['useful_links_title'] ?? '';
            $links = is_array($instance['useful_links']) && !empty($instance['useful_links']) ? $instance['useful_links'] : [];

            ?>
            <div class="gt-footer-widget-items">
                <div class="gt-widget-head">
                    <h3><?php echo esc_html($title); ?></h3>
                </div>
                <ul class="gt-list-area">
                    <?php if (!empty($links)) { 
                        foreach ($links as $link) { 
                            $link_text = $link['useful_link_label'] ?? '';
                            $link_url = $link['useful_link_url'] ?? '#';
                    ?>
                        <li>
                            <a href="<?php echo esc_url($link_url); ?>">
                                <?php echo esc_html($link_text); ?>
                            </a>
                        </li>
                    <?php } 
                    } ?>
                </ul>
            </div>

            <?php
            echo $args['after_widget'];
        }
    }

}
?>
