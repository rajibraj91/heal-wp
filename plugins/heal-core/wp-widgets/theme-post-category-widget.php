<?php
/**
 * Theme Category Widget
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

class Heal_Category_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'heal_category',
            esc_html__('Heal: Category', 'heal-core'),
            array('description' => esc_html__('Display categories', 'heal-core'))
        );
    }

    public function widget($args, $instance)
    {
        $allowed_html = heal()->kses_allowed_html('all');

        $title    = !empty($instance['title']) ? $instance['title'] : '';
        $number   = $instance['number'] ?? '';
        $order    = !empty($instance['order']) ? $instance['order'] : 'ASC';
        $orderby  = !empty($instance['orderby']) ? $instance['orderby'] : 'ID';
        $taxonomy = !empty($instance['taxonomy']) ? $instance['taxonomy'] : 'category';

        echo wp_kses($args['before_widget'], $allowed_html);

        $terms = get_terms(array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => true,
            'orderby'    => $orderby,
            'order'      => $order,
            'number'     => $number
        ));

        if (!empty($terms) && !is_wp_error($terms)) :
            ?>
            <div class="sidebar__catagory mb-5">
                <?php if (!empty($title)) : ?>
                    <div class="sidebar__head">
                        <h4><?php echo esc_html($title); ?></h4>
                    </div>
                <?php endif; ?>

                <div class="sidebar__body">
                    <ul>
                        <?php foreach ($terms as $term) : ?>
                            <li>
                                <a href="<?php echo esc_url(get_term_link($term)); ?>"><i class="fas fa-chevron-right"></i> <?php echo esc_html($term->name); ?></a>
                                <span><?php echo esc_html($term->count); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php
        else :
            echo '<p>' . esc_html__('Oops, there are no categories.', 'heal-core') . '</p>';
        endif;

        echo wp_kses($args['after_widget'], $allowed_html);
    }

    public function form($instance)
    {
        $title    = !empty($instance['title']) ? $instance['title'] : esc_html__('Categories', 'heal-core');
        $number   = $instance['number'] ?? '';
        $order    = !empty($instance['order']) ? $instance['order'] : 'ASC';
        $orderby  = !empty($instance['orderby']) ? $instance['orderby'] : 'ID';
        $selected_taxonomy = !empty($instance['taxonomy']) ? $instance['taxonomy'] : 'category';

        $taxonomy_options = array(
            'category' => esc_html__('Blog Category', 'heal-core'),
            'sermon-cat' => esc_html__('Sermon Category', 'heal-core'),
            'team-cat' => esc_html__('Team Category', 'heal-core'),
            'event-cat' => esc_html__('Event Category', 'heal-core'),
            'service-cat' => esc_html__('Service Category', 'heal-core'),
        );

        $order_arr = array(
            'ASC'  => esc_html__('Ascending', 'heal-core'),
            'DESC' => esc_html__('Descending', 'heal-core')
        );

        $orderby_arr = array(
            'ID'            => esc_html__('ID', 'heal-core'),
            'title'         => esc_html__('Title', 'heal-core'),
            'date'          => esc_html__('Date', 'heal-core'),
            'rand'          => esc_html__('Random', 'heal-core')
        );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'heal-core'); ?></label>
            <input type="text" class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>"><?php esc_html_e('Taxonomy:', 'heal-core'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('taxonomy')); ?>" class="widefat"
                    id="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>">
                <?php foreach ($taxonomy_options as $key => $value) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php selected($selected_taxonomy, $key); ?>>
                        <?php echo esc_html($value); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of Categories:', 'heal-core'); ?></label>
            <input type="number" class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>"
                   value="<?php echo esc_attr($number); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php esc_html_e('Order:', 'heal-core'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('order')); ?>" class="widefat"
                    id="<?php echo esc_attr($this->get_field_id('order')); ?>">
                <?php foreach ($order_arr as $key => $value) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php selected($order, $key); ?>>
                        <?php echo esc_html($value); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php esc_html_e('Order By:', 'heal-core'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" class="widefat"
                    id="<?php echo esc_attr($this->get_field_id('orderby')); ?>">
                <?php foreach ($orderby_arr as $key => $value) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php selected($orderby, $key); ?>>
                        <?php echo esc_html($value); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title']    = sanitize_text_field($new_instance['title'] ?? '');
        $instance['number']   = absint($new_instance['number'] ?? 0);
        $instance['taxonomy'] = sanitize_text_field($new_instance['taxonomy'] ?? 'category');
        $instance['order']    = sanitize_text_field($new_instance['order'] ?? 'ASC');
        $instance['orderby']  = sanitize_text_field($new_instance['orderby'] ?? 'ID');
        return $instance;
    }
}

if (!function_exists('Heal_Category_Widget')) {
    function Heal_Category_Widget()
    {
        register_widget('Heal_Category_Widget');
    }

    add_action('widgets_init', 'Heal_Category_Widget');
}
