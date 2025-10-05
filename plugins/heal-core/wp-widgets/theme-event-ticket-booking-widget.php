<?php
/**
 * Theme Event Ticket Booking Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // exit if accessed directly
}

// Control core classes to avoid errors
if (class_exists('CSF')) {

    // Create a Ticket Booking Widget
    CSF::createWidget('heal_event_ticket_booking_widget', array(
        'title' => esc_html__('Heal: Event Ticket Booking Form', 'heal-core'),
        'classname' => 'heal-ticket-booking-event',
        'description' => esc_html__('Display Ticket Booking Form widget for event sidebar', 'heal-core'),
        'fields' => array(
            array(
                'id' => 'heading',
                'type' => 'text',
                'title' => esc_html__('Enter Your Header Title', 'heal-core'),
                'default' => esc_html__('Book Your Ticket Now', 'heal-core'),
            ),
            array(
                'id' => 'ticket_form_shortcode',
                'type' => 'text',
                'title' => esc_html__('Contact Form 7 Shortcode', 'heal-core'),
                'desc'  => esc_html__('Enter the Contact Form 7 shortcode to display the ticket booking form.', 'heal-core'),
                'default' => '[contact-form-7 id="1234" title="Event Ticket Booking"]', // Default shortcode
            ),
        )
    ));

    if (!function_exists('heal_event_ticket_booking_widget')) {
        function heal_event_ticket_booking_widget($args, $instance)
        {
            echo $args['before_widget'];

            $heading_title = $instance['heading'] ?? '';
            $ticket_form_shortcode = $instance['ticket_form_shortcode'] ?? '';

            ?>
         

               <div class="gt-event-sideber-widget">
                    <div class="ticekt-form">
                        <div class="gt-widget-title">
                            <h3><?php echo esc_html($heading_title); ?></h3>
                        </div>
                    
                        <?php 
                            // Check if the shortcode is provided, then display the form
                            if (!empty($ticket_form_shortcode)) {
                                echo do_shortcode($ticket_form_shortcode); 
                            } else {
                                // Fallback content if no shortcode is provided
                                echo '<p>' . esc_html__('Please provide a valid Contact Form 7 shortcode to display the booking form.', 'heal-core') . '</p>';
                            }
                        ?>
                </div>
            </div>



            <?php

            echo $args['after_widget'];
        }
    }
}

?>
