<?php
/**
 * Theme Request Form Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {


    // Create a About Widget
    CSF::createWidget('heal_request_form_widget', array(
        'title' => esc_html__('Heal: Request Form', 'heal-core'),
        'classname' => 'heal-request-form-widget',
        'description' => esc_html__('Display Request Form widget', 'heal-core'),
        'fields' => array(
            array(
                'id' => 'background-image',
                'type' => 'media',
                'title' => esc_html__('Upload Your Photo', 'heal-core'),
            ),
            array(
                'id' => 'heading',
                'type' => 'text',
                'title' => esc_html__('Enter Your Header Title', 'heal-core'),
                'default' => esc_html__('Never Miss News', 'heal-core')
            ),
            array(
                'id' => 'heal_contact_form_id',
                'type' => 'select',
                'title' => esc_html__('Contact Form', 'heal-core'),
                'options' => heal_core()->get_contact_form_shortcode_list_el(),
            ),
        )
    ));


    if (!function_exists('heal_request_form_widget')) {
        function heal_request_form_widget($args, $instance)
        {

            echo $args['before_widget'];

            $instance['background-image'];
            $bg_image = $instance['background-image'];
            $img_id = $bg_image['id'] ?? '';
            $img_print = $img_id ? wp_get_attachment_image_src($img_id)[0] : '';
            $heading_title = $instance['heading'] ?? '';
            $shortcode = $instance['heal_contact_form_id'];

            ?>
            <div class="request-form-widget" style="background-image: url(<?php echo esc_url($img_print)?>)">
                <h4 class="widget-headline"><?php echo esc_html($heading_title); ?></h4>
                <div class="request-form">
                    <?php
                    echo do_shortcode('[contact-form-7  id="' . $shortcode . '"]');
                    ?>
                </div>
            </div>
            <?php

            echo $args['after_widget'];

        }
    }

}

?>