<?php
/**
 * Theme Footer About Us Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

// Control core classes for avoiding errors
if (class_exists('CSF')) {

    // Create Footer About Us Widget
    CSF::createWidget('heal_footer_about_widget', array(
        'title' => esc_html__('Heal: Footer About Us', 'heal-core'),
        'classname' => 'heal-widget-footer-about',
        'description' => esc_html__('Display footer about us widget', 'heal-core'),
        'fields' => array(
            array(
                'id' => 'footer-logo',
                'type' => 'media',
                'title' => esc_html__('Upload Footer Logo', 'heal-core'),
            ),
            array(
                'id' => 'footer-description',
                'type' => 'textarea',
                'title' => esc_html__('Description', 'heal-core'),
                'default' => esc_html__('It is a long established fact that a reader will be distracted the road readable content of a page when looking at layout.', 'heal-core')
            ),
        )
    ));

    if (!function_exists('heal_footer_about_widget')) {
        /**
         * Function to render the Footer About Us widget.
         * 
         * @param array $args Widget arguments.
         * @param array $instance Widget instance with widget options.
         */
        function heal_footer_about_widget($args, $instance)
        {
            echo $args['before_widget'];

            // Get widget settings
            $logo = $instance['footer-logo'];
            $img_id = $logo['id'] ?? '';
            $img_print = $img_id ? wp_get_attachment_image_src($img_id, 'full')[0] : '';
            $alt_text = get_post_meta($img_id, '_wp_attachment_image_alt', true);
            $description = $instance['footer-description'] ?? '';

            ?>
            <div class="footer__logoarea">
                <?php if (!empty($img_print)) { ?>
                    <img src="<?php echo esc_url($img_print); ?>" alt="<?php echo esc_attr($alt_text); ?>">
                <?php } ?>

                <p><?php echo esc_html($description); ?></p>
            </div>
            
            <?php
            echo $args['after_widget'];
        }
    }

}
?>
