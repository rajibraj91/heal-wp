<?php
/**
 * Theme More Links Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

if (class_exists('CSF')) {

    // Create the More Links Widget
    CSF::createWidget('heal_more_links_widget', array(
        'title'       => esc_html__('Heal: More Links', 'heal-core'),
        'classname'   => 'heal-widget-more-links',
        'description' => esc_html__('Display more links in the footer', 'heal-core'),
        'fields'      => array(
            array(
                'id'    => 'title',
                'type'  => 'text',
                'title' => esc_html__('Widget Title', 'heal-core'),
                'default' => esc_html__('More Links', 'heal-core')
            ),
            array(
                'id'    => 'more_links',
                'type'  => 'repeater',
                'title' => esc_html__('Footer Menu Links', 'heal-core'),
                'fields' => array(
                    array(
                        'id'    => 'text',
                        'type'  => 'text',
                        'title' => esc_html__('Link Text', 'heal-core'),
                        'default' => 'Link Item'
                    ),
                    array(
                        'id'    => 'url',
                        'type'  => 'text',
                        'title' => esc_html__('Link URL', 'heal-core'),
                        'default' => '#'
                    )
                )
            )
        )
    ));

    if (!function_exists('heal_more_links_widget')) {
        function heal_more_links_widget($args, $instance)
        {
            echo $args['before_widget'];

            $title = $instance['title'] ?? '';
            $links = $instance['more_links'] ?? [];

            ?>
            <div class="gt-footer-widget-items">
                <?php if (!empty($title)) : ?>
                    <div class="gt-widget-head">
                        <h3><?php echo esc_html($title); ?></h3>
                    </div>
                <?php endif; ?>

                <?php if (!empty($links)) : ?>
                    <ul class="gt-list-area">
                        <?php foreach ($links as $link) : ?>
                            <li>
                                <a href="<?php echo esc_url($link['url'] ?? '#'); ?>">
                                    <?php echo esc_html($link['text'] ?? ''); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <?php

            echo $args['after_widget'];
        }
    }

}
?>
