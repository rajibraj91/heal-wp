<?php
if (!defined('ABSPATH')) { exit(); }

if (class_exists('CSF')) {

    // Create Footer Contact Widget
    CSF::createWidget('heal_footer_contact_widget', array(
        'title'       => esc_html__('Heal: Footer Contact', 'heal-core'),
        'classname'   => 'heal-widget-footer-contact',
        'description' => esc_html__('Display footer contact info', 'heal-core'),
        'fields'      => array(
            array(
                'id'      => 'footer-contact-title',
                'type'    => 'text',
                'title'   => esc_html__('Contact Title', 'heal-core'),
                'default' => esc_html__('Contact Info', 'heal-core'),
            ),
            array(
                'id'      => 'footer-contact-desc',
                'type'    => 'textarea',
                'title'   => esc_html__('Description', 'heal-core'),
                'default' => esc_html__('Nam nec tellus a odio tincidunt auctor a ornare odio.', 'heal-core'),
            ),
            array(
                'id'      => 'footer-contact-address',
                'type'    => 'text',
                'title'   => esc_html__('Address', 'heal-core'),
                'default' => esc_html__('13/2 Elizabeth St, Dimond steet Inner distric Road.', 'heal-core'),
            ),
            array(
                'id'      => 'footer-contact-phone',
                'type'    => 'text',
                'title'   => esc_html__('Phone', 'heal-core'),
                'default' => esc_html__('+880 1234567895 +880 9874321457', 'heal-core'),
            ),
            array(
                'id'      => 'footer-contact-email',
                'type'    => 'text',
                'title'   => esc_html__('Email', 'heal-core'),
                'default' => esc_html__('contact@yourmail.com', 'heal-core'),
            ),
        )
    ));

    if (!function_exists('heal_footer_contact_widget')) {
        function heal_footer_contact_widget($args, $instance)
        {
            echo $args['before_widget'];

            $title    = isset($instance['footer-contact-title']) ? $instance['footer-contact-title'] : '';
            $desc     = isset($instance['footer-contact-desc']) ? $instance['footer-contact-desc'] : '';
            $address  = isset($instance['footer-contact-address']) ? $instance['footer-contact-address'] : '';
            $phone    = isset($instance['footer-contact-phone']) ? $instance['footer-contact-phone'] : '';
            $email    = isset($instance['footer-contact-email']) ? $instance['footer-contact-email'] : '';

            ?>
            
            <div class="footer__info footer-title">
                <?php if ($title): ?>
                    <h3><?php echo esc_html($title); ?></h3>
                <?php endif; ?>

                <?php if ($desc): ?>
                    <p><?php echo esc_html($desc); ?></p>
                <?php endif; ?>

                <ul>
                    <?php if ($address): ?>
                        <li><i class="fas fa-home"></i> <?php echo esc_html($address); ?></li>
                    <?php endif; ?>
                    <?php if ($phone): ?>
                        <li><i class="fas fa-phone-alt"></i> <?php echo esc_html($phone); ?></li>
                    <?php endif; ?>
                    <?php if ($email): ?>
                        <li><i class="fas fa-envelope"></i> <?php echo esc_html($email); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php

            echo $args['after_widget'];
        }
    }
}
?>