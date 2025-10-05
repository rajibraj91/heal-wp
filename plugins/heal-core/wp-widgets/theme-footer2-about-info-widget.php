<?php
/**
 * Theme Footer2 About Info Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

if (class_exists('CSF')) {

    // Register the Footer2 About Info Widget
    CSF::createWidget('heal_footer_about_info_widget', array(
        'title'       => esc_html__('Heal: Footer About Info', 'heal-core'),
        'classname'   => 'heal-widget-footer-about',
        'description' => esc_html__('Display footer about section with logo, text, phone and email.', 'heal-core'),
        'fields'      => array(
            array(
                'id'      => 'logo',
                'type'    => 'media',
                'title'   => esc_html__('Footer Logo', 'heal-core'),
            ),
            array(
                'id'      => 'description',
                'type'    => 'textarea',
                'title'   => esc_html__('Description Text', 'heal-core'),
                'default' => esc_html__('Lorem ipsum dolor sit amet consectetur. Mi vitae suspendisse volutpat dapibus.', 'heal-core'),
            ),
            array(
                'id'      => 'phone',
                'type'    => 'text',
                'title'   => esc_html__('Phone Number', 'heal-core'),
                'default' => '(1800)-88-66-999',
            ),
            array(
                'id'      => 'email',
                'type'    => 'text',
                'title'   => esc_html__('Email Address', 'heal-core'),
                'default' => 'info@example.com',
            ),
        )
    ));

    // Output function
    if (!function_exists('heal_footer_about_info_widget')) {
        function heal_footer_about_info_widget($args, $instance)
        {
            echo $args['before_widget'];

            $logo        = !empty($instance['logo']['url']) ? esc_url($instance['logo']['url']) : '';
            $description = !empty($instance['description']) ? esc_html($instance['description']) : '';
            $phone       = !empty($instance['phone']) ? esc_html($instance['phone']) : '';
            $email       = !empty($instance['email']) ? esc_html($instance['email']) : '';

            ?>
            <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                <div class="gt-footer-widget-items">
                    <?php if ($logo) : ?>
                        <div class="gt-widget-head">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="gt-footer-logo">
                                <img src="<?php echo $logo; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="gt-footer-content">
                        <?php if ($description) : ?>
                            <p><?php echo $description; ?></p>
                        <?php endif; ?>

                        <ul class="gt-contact-list-2">
                            <?php if ($phone) : ?>
                                <li>
                                    <a href="tel:<?php echo preg_replace('/[^0-9\+]/', '', $phone); ?>"><?php echo $phone; ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if ($email) : ?>
                                <li>
                                    <a href="mailto:<?php echo antispambot($email); ?>"><?php echo antispambot($email); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php

            echo $args['after_widget'];
        }
    }
}
?>
