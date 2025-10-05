<?php
/**
 * Theme Author Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {


    // Create a About Widget
    CSF::createWidget('heal_author_widget', array(
        'title' => esc_html__('Heal: Author', 'heal-core'),
        'classname' => 'heal-widget-author',
        'description' => esc_html__('Display Author widget', 'heal-core'),
        'fields' => array(
            array(
                'id' => 'image',
                'type' => 'media',
                'title' => esc_html__('Image', 'Heal-core')
            ),
            array(
                'id' => 'name',
                'type' => 'text',
                'title' => esc_html__('Name', 'Heal-core'),
                'default' => esc_html__('Leslie Alexander', 'heal-core')
            ),
            array(
                'id' => 'phone',
                'type' => 'text',
                'title' => esc_html__('Phone', 'Heal-core'),
                'default' => esc_html__('(480) 555-0103', 'heal-core')
            ),

            array(
                'id' => 'heal-author-social-repeater',
                'type' => 'repeater',
                'title' => esc_html__('Author', 'heal-core'),
                'fields' => array(
                    array(
                        'id' => 'heal-author-social',
                        'type' => 'icon',
                        'title' => esc_html__('author social', 'heal-core'),
                    ),
                    array(
                        'id' => 'heal-author-social-url',
                        'type' => 'text',
                        'title' => esc_html__('author social', 'heal-core'),
                        'default' => esc_html__('#', 'heal-core')
                    ),

                ),
            ),
        )
    ));


    if (!function_exists('heal_author_widget')) {
        function heal_author_widget($args, $instance)
        {

            echo $args['before_widget'];
            $image = $instance['image'];
            $img_id = $image['id'] ?? '';
            $img_print = $img_id ? wp_get_attachment_image_src($img_id,'full')[0] : '';
            $alt_text = get_post_meta($img_id, '_wp_attachment_image_alt', true);
            $name = $instance['name'] ?? '';
            $phone = $instance['phone'] ?? '';
            $author = is_array($instance['heal-author-social-repeater']) && !empty($instance['heal-author-social-repeater']) ? $instance['heal-author-social-repeater'] : [];
            ?>

            <div class="widget_author text-center">  
                <?php
                    if (!empty($img_print)) {
                        printf('<div class="thumb"><img src="%1$s" alt="%2$s"/></div>', esc_url($img_print), esc_attr($alt_text));
                    }
                ?> 
                <div class="details">
                    <h5><?php echo esc_html($name); ?></h5>
                    <h6><?php echo esc_html($phone); ?></h6>
                    <ul class="social-media-list">
                        <?php
                            foreach ($author as $socials) {
                                echo '<li>
                                    <a href="'.$socials['heal-author-social-url'].'">
                                        <i class="' . $socials['heal-author-social'] . '"></i>
                                    </a>
                                </li>';
                            };
                        ?>
                    </ul>
                </div>
            </div>
            <?php

            echo $args['after_widget'];

        }
    }

}

?>