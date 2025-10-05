<?php
/**
 * Theme Post Search Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

if (class_exists('CSF')) {

    // Register the widget with Codestar
    CSF::createWidget('heal_post_search_widget', array(
        'title' => esc_html__('Heal Post Search', 'heal-core'),
        'classname' => 'heal-widget-post-search',
        'description' => esc_html__('Display a custom post search widget.', 'heal-core'),
        'fields' => array(
            array(
                'id' => 'title',
                'type' => 'text',
                'title' => esc_html__('Title', 'heal-core'),
            ),
        )
    ));

    // Widget Front-End Render
    if (!function_exists('heal_post_search_widget')) {
        function heal_post_search_widget($args, $instance)
        {
            echo $args['before_widget'];

            $title = $instance['title'] ?? esc_html__('Search Here', 'heal-core');
            ?>

          
                <?php if (!empty($title)) : ?>
                    <div class="gt-widget-title">
                        <h4><?php echo esc_html($title); ?></h4>
                    </div>
                <?php endif; ?>
                <div class="sidebar__search mb-5">
                    <form class="d-flex bg-white border rounded" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                        <input class="form-control mb-0 border-0" type="search" name="s" placeholder="<?php echo esc_attr__('Search here', 'heal-core'); ?>" aria-label="Search">
                        <button class="btn btn-outline-none border-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
           
            <?php
            echo $args['after_widget'];
        }
    }
}
?>
