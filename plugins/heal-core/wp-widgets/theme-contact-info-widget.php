<?php
/**
 * Theme Need Help Contact Info Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

// Check if Codestar Framework exists
if (class_exists('CSF')) {

    // Create the widget settings panel in the admin
    CSF::createWidget('heal_contact_info_widget', array(
        'title' => esc_html__('Heal: Need Help Widget', 'heal-core'),
        'classname' => 'heal-widget-contact-info',
        'description' => esc_html__('Displays a Blog Sidebar with help info', 'heal-core'),
        'fields' => array(
            array(
                'id' => 'title',
                'type' => 'text',
                'title' => esc_html__('Title', 'heal-core'),
                'default' => esc_html__('Need Any Help', 'heal-core'),
            ),
            array(
                'id' => 'subtitle',
                'type' => 'text',
                'title' => esc_html__('Subtitle', 'heal-core'),
                'default' => esc_html__('Need Any Help, Call Us 24/7 Full Support', 'heal-core'),
            ),
            array(
                'id' => 'phone',
                'type' => 'text',
                'title' => esc_html__('Phone Number', 'heal-core'),
                'default' => '+009 438 222 9540',
            ),
            array(
                'id' => 'email',
                'type' => 'text',
                'title' => esc_html__('Email Address', 'heal-core'),
                'default' => 'info@xridergamil.com',
            ),
            array(
                'id' => 'location',
                'type' => 'textarea',
                'title' => esc_html__('Location', 'heal-core'),
                'default' => 'Toronto, Montreal, City 2026',
            ),
            array(
                'id' => 'bg_image',
                'type' => 'media',
                'title' => esc_html__('Background Image', 'heal-core'),
            ),
        )
    ));

    // Frontend rendering callback
    if (!function_exists('heal_contact_info_widget')) {
        function heal_contact_info_widget($args, $instance)
        {
            $title    = $instance['title'] ?? '';
            $subtitle = $instance['subtitle'] ?? '';
            $phone    = $instance['phone'] ?? '';
            $email    = $instance['email'] ?? '';
            $location = $instance['location'] ?? '';
            $bg_image = !empty($instance['bg_image']['url']) ? $instance['bg_image']['url'] : '';

            echo $args['before_widget'];
            ?>
            <div class="gt-contact-bg bg-cover" style="background-image: url('<?php echo esc_url($bg_image); ?>');">
                <div class="gt-contact-content">
                    <?php if (!empty($title)) : ?>
                        <h3><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>
                    <?php if (!empty($subtitle)) : ?>
                        <p><?php echo esc_html($subtitle); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($phone)) : ?>
                        <div class="gt-contact-item">
                            <div class="gt-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <ul class="gt-list">
                                <li><span><?php esc_html_e('Call Us:', 'heal-core'); ?></span></li>
                                <li><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></li>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($email)) : ?>
                        <div class="gt-contact-item">
                            <div class="gt-icon">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <ul class="gt-list">
                                <li><span><?php esc_html_e('Mail Us', 'heal-core'); ?></span></li>
                                <li><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></li>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($location)) : ?>
                        <div class="gt-contact-item mb-0">
                            <div class="gt-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <ul class="gt-list">
                                <li><span><?php esc_html_e('Location:', 'heal-core'); ?></span></li>
                                <li><?php echo esc_html($location); ?></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            echo $args['after_widget'];
        }
    }

}
?>
