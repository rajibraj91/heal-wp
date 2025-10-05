<?php
if (!defined('ABSPATH')) { exit(); }

if (class_exists('CSF')) {

    CSF::createWidget('heal_sidebar_gallery_widget', array(
        'title'       => esc_html__('Heal: Sidebar Gallery', 'heal-core'),
        'classname'   => 'heal-widget-footer-gallery',
        'description' => esc_html__('Display footer gallery widget', 'heal-core'),
        'fields'      => array(
            array(
                'id'      => 'footer-gallery-title',
                'type'    => 'text',
                'title'   => esc_html__('Gallery Title', 'heal-core'),
                'default' => esc_html__('Instagram', 'heal-core'),
            ),
            array(
                'id'      => 'footer-gallery-images',
                'type'    => 'gallery',
                'title'   => esc_html__('Gallery Images', 'heal-core'),
            ),
        )
    ));

    if (!function_exists('heal_sidebar_gallery_widget')) {
        function heal_sidebar_gallery_widget($args, $instance)
        {
            echo $args['before_widget'];

            $title = isset($instance['footer-gallery-title']) ? $instance['footer-gallery-title'] : '';
            $images = isset($instance['footer-gallery-images']) ? $instance['footer-gallery-images'] : '';
            if (!empty($images)) {
                if (is_string($images)) {
                    $images = explode(',', $images);
                }
            } else {
                $images = array();
            }

            ?>

            <div class="sidebar__instagram mb-5">
                <?php if ($title): ?>
                    <div class="sidebar__head">
                        <h4><?php echo esc_html($title); ?></h4>
                    </div>
                <?php endif; ?>

                <?php if (!empty($images)): ?>
                    <div class="sidebar__body">
                        <ul>
                            <?php foreach ($images as $img_id):
                                $img_url = wp_get_attachment_image_url($img_id, 'thumbnail');
                                $full_url = wp_get_attachment_image_url($img_id, 'full');
                                $alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
                            ?>
                            <li><img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($alt); ?>"></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php else: ?>
                    <p style="color:red;">No images added yet. Please add gallery images from the widget settings.</p>
                <?php endif; ?>
            </div>
            <?php

            echo $args['after_widget'];
        }
    }
}
?>