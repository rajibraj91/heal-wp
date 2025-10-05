<?php
/**
 * Heal: Event Short Details Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

// Control core classes to avoid errors
if (class_exists('CSF')) {

    // Create Event Short Details Widget
    CSF::createWidget('heal_event_short_details_widget', array(
        'title'     => esc_html__('Heal: Event Short Details', 'heal-core'),
        'classname' => 'heal-short-details-event',
        'description' => esc_html__('Display event short details for the sidebar in a clean and flexible format.', 'heal-core'),
        'fields' => array(
            // Header Text
            array(
                'id'    => 'heading',
                'type'  => 'text',
                'title' => esc_html__('Widget Heading', 'heal-core'),
                'default' => esc_html__('Event Quick Details', 'heal-core'),
                'desc'  => esc_html__('Enter the header title for the widget.', 'heal-core'),
            ),
            // Repeater for Event Details
            array(
                'id'    => 'event_detail_list',
                'type'  => 'repeater',
                'title' => esc_html__('Event Details', 'heal-core'),
                'fields' => array(
                    // Event Label
                    array(
                        'id'    => 'label',
                        'type'  => 'text',
                        'title' => esc_html__('Label', 'heal-core'),
                        'desc'  => esc_html__('e.g., Start Date, Venue, etc.', 'heal-core'),
                    ),
                    // Event Value
                    array(
                        'id'    => 'value',
                        'type'  => 'text',
                        'title' => esc_html__('Value', 'heal-core'),
                        'desc'  => esc_html__('e.g., February 24, 2025, Melbourne, etc.', 'heal-core'),
                    ),
                ),
            ),
        )
    ));

    // Widget Function
    if (!function_exists('heal_event_short_details_widget')) {
        function heal_event_short_details_widget($args, $instance) {

            echo $args['before_widget'];

            $heading_title = isset($instance['heading']) ? $instance['heading'] : '';
            $details = isset($instance['event_detail_list']) && is_array($instance['event_detail_list']) ? $instance['event_detail_list'] : [];

            ?>

            <div class="gt-event-sideber-widget">
                <?php if ($heading_title) : ?>
                    <div class="gt-widget-title">
                        <h3><?php echo esc_html($heading_title); ?></h3>
                    </div>
                <?php endif; ?>

                <?php if (!empty($details)) : ?>
                    <ul class="gt-sideber-list">
                        <?php foreach ($details as $detail) : ?>
                            <li>
                                <span><?php echo esc_html($detail['label']); ?>:</span>
                                <?php echo esc_html($detail['value']); ?>
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
