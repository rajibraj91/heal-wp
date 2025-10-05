<?php
/**
 * Theme Recent Post Widget
 * @package heal
 * @since 1.0.0
 * @changed 1.0.1
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}

class Heal_Sidebar_Recent_Post_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'heal_recent_posts',
            esc_html__('Heal: Sidebar Recent Posts', 'heal-core'),
            array('description' => esc_html__('Display your recent posts, with a thumbnail.', 'heal-core'))
        );
    }

    public function widget($args, $instance)
    {
        $title = isset($instance['title']) && !empty($instance['title']) ? $instance['title'] : '';
        $no_of_posts = isset($instance['no_of_posts']) && !empty($instance['no_of_posts']) ? $instance['no_of_posts'] : '';
        $order = isset($instance['order']) && !empty($instance['order']) ? $instance['order'] : 'ASC';
        $post_type = isset($instance['post_type']) && !empty($instance['post_type']) ? $instance['post_type'] : 'post';
        $orderby = isset($instance['orderby']) && !empty($instance['orderby']) ? $instance['orderby'] : 'ID';
        
        echo wp_kses_post($args['before_widget']);

        // if (!empty($title)) {
        //     echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']);
        // }

        // WP_Query argument
        $qargs = array(
            'post_type' => $post_type,
            'posts_per_page' => $no_of_posts,
            'offset' => 0,
            'ignore_sticky_posts' => 1,
            'post_status' => array('publish'),
            'order' => $order,
            'orderby' => $orderby
        );

        $recent_articles = new WP_Query($qargs);

        if ($recent_articles->have_posts()) : ?>
            <div class="sidebar__post mb-5">
                <?php if (!empty($title)) : ?>
                    <div class="sidebar__head">
                        <h4><?php echo esc_html($title); ?></h4>
                    </div>
                <?php endif; ?>

                <div class="sidebar__body">
                    <?php while ($recent_articles->have_posts()) : $recent_articles->the_post(); ?>
                    <div class="sidebar__post-item">
                        <div class="sidebar__post-inner">
                            <div class="sidebar__post-thumb">
                                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')); ?>" alt="<?php the_title_attribute(); ?>"></a>
                            </div>
                            <div class="sidebar__post-content">
                                <a href="<?php the_permalink(); ?>"><h6><?php the_title(); ?></h6></a>
                                <ul>
                                    <li><?php echo esc_html(get_the_date('F j, Y')); ?><?php echo esc_html(',','heal-core'); ?></li>
                                    <li>
                                        <?php 
                                            $comments_number = get_comments_number();
                                            if (comments_open()) {
                                                echo esc_html($comments_number) . ' ' . _n('Comment', 'Comments', $comments_number, 'heal');
                                            } else {
                                                esc_html_e('Comments are closed', 'heal');
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        <?php else : ?>
            <p><?php esc_html_e('Oops, there are no posts.', 'heal-core'); ?></p>
        <?php endif; ?>

        <?php 
            echo $args['after_widget'];
    }

    public function form($instance)
    {
        if (!empty($instance) && $instance['title']) {
            $title = apply_filters('widget_title', $instance['title']);
        } else {
            $title = esc_html__('Recent Posts', 'heal-core');
        }
        $no_of_posts = !empty($instance) && $instance['no_of_posts'] ? $instance['no_of_posts'] : '5';
        $order = !empty($instance) && $instance['order'] ? $instance['order'] : 'ASC';
        $orderby = !empty($instance) && $instance['orderby'] ? $instance['orderby'] : 'ID';

        $post_type = array(
            'post' => esc_html__('Blog Post Type', 'heal-core'),
            'service' => esc_html__('Service Post Type', 'heal-core'),
            'event' => esc_html__('Event Post Type', 'heal-core'),
            'team' => esc_html__('Team Post Type', 'heal-core'),
            'sermon' => esc_html__('Sermon Post Type', 'heal-core'),
        );

        $order_arr = array(
            'ASC' => esc_html__('Ascending', 'heal-core'),
            'DESC' => esc_html__('Descending', 'heal-core')
        );

        $orderby_arr = array(
            'ID' => esc_html__('ID', 'heal-core'),
            'title' => esc_html__('Title', 'heal-core'),
            'date' => esc_html__('Date', 'heal-core'),
            'rand' => esc_html__('Random', 'heal-core'),
            'comment_count' => esc_html__('Most Comment', 'heal-core')
        );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_type')) ?>"><?php esc_html_e('Post Type', 'heal-core'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('post_type')) ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('post_type')) ?>">
                <?php
                foreach ($post_type as $key => $value) {
                    $checked = ($key == $post_type) ? 'selected' : '';
                    printf('<option value="%1$s" %3$s >%2$s</option>', $key, $value, $checked);
                }
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'heal-core'); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')) ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title) ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('no_of_posts')) ?>"><?php esc_html_e('No Of Posts', 'heal-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('no_of_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('no_of_posts')); ?>" type="text" value="<?php echo esc_attr($no_of_posts); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('order')) ?>"><?php esc_html_e('Order', 'heal-core'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('order')) ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('order')) ?>">
                <?php
                foreach ($order_arr as $key => $value) {
                    $checked = ($key == $order) ? 'selected' : '';
                    printf('<option value="%1$s" %3$s >%2$s</option>', $key, $value, $checked);
                }
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('orderby')) ?>"><?php esc_html_e('Order By', 'heal-core'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('orderby')) ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('orderby')) ?>">
                <?php
                foreach ($orderby_arr as $key => $value) {
                    $checked = ($key == $orderby) ? 'selected' : '';
                    printf('<option value="%1$s" %3$s >%2$s</option>', $key, $value, $checked);
                }
                ?>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['order'] = (!empty($new_instance['order']) ? sanitize_text_field($new_instance['order']) : '');
        $instance['orderby'] = (!empty($new_instance['orderby']) ? sanitize_text_field($new_instance['orderby']) : '');
        $instance['title'] = (!empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '');
        $instance['post_type'] = (!empty($new_instance['post_type']) ? sanitize_text_field($new_instance['post_type']) : '');
        $instance['no_of_posts'] = (!empty($new_instance['no_of_posts']) ? absint($new_instance['no_of_posts']) : '');
        if (is_numeric($new_instance['no_of_posts']) == false) {
            $instance['no_of_posts'] = $old_instance['no_of_posts'];
        }
        return $instance;
    }
} // end class

if (!function_exists('Heal_Sidebar_Recent_Post_Widget')) {
    function Heal_Sidebar_Recent_Post_Widget()
    {
        register_widget('Heal_Sidebar_Recent_Post_Widget');
    }
    add_action('widgets_init', 'Heal_Sidebar_Recent_Post_Widget');
}
