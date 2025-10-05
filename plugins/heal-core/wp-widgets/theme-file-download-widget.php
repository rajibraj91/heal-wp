<?php
/**
 * Theme File Download Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {


    // Create a About Widget
    CSF::createWidget('heal_file_download_widget', array(
        'title' => esc_html__('Heal: File Download', 'heal-core'),
        'classname' => 'heal-widget-file-download',
        'description' => esc_html__('Display File Download widget', 'heal-core'),
        'fields' => array(
            array(
                'id' => 'title',
                'type' => 'text',
                'title' => esc_html__('Title', 'Heal-core'),
                'default' => esc_html__('Download', 'heal-core')
            ),

            array(
                'id' => 'heal-file-download-repeater',
                'type' => 'repeater',
                'title' => esc_html__('File Download', 'heal-core'),
                'fields' => array(
                    array(
                        'id' => 'heal-file-download',
                        'type' => 'media',
                        'title' => esc_html__('File', 'heal-core'),
                    ),
                    array(
                        'id' => 'heal-file-download-text',
                        'type' => 'text',
                        'title' => esc_html__('File Text', 'heal-core'),
                        'default' => esc_html__('Company Profile', 'heal-core')
                    ),

                ),
            ),
        )
    ));


    if (!function_exists('heal_file_download_widget')) {
        function heal_file_download_widget($args, $instance)
        {

            echo $args['before_widget'];

            $title = $instance['title'] ?? '';
            $file_download = is_array($instance['heal-file-download-repeater']) && !empty($instance['heal-file-download-repeater']) ? $instance['heal-file-download-repeater'] : [];


            ?>
            <div class="widget_download">
                <h5 class="widget-headline style-01"><?php echo esc_html($title); ?></h5>               
                <ul>
                    <?php
                        foreach ($file_download as $file) {
                            echo '<li class="mb-0 mt-0">
                                <a download href="'.$file['heal-file-download']['url'].'">
                                    ' . $file['heal-file-download-text'] . '
                                    <i class="fa fa-angle-double-right"></i>
                                </a>
                            </li>';
                        };
                    ?>
                </ul>
            </div>
            <?php

            echo $args['after_widget'];

        }
    }

}

?>