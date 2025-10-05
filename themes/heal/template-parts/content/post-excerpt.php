<?php
/**
 * Theme Post excerpt Template
 * @package heal
 * @since 1.0.0
 */

$heal = heal();
$post_meta = Heal_Group_Fields_Value::post_meta('blog_post');
$excerpt_length = !empty($post_meta['excerpt_length']) ? $post_meta['excerpt_length'] : 55;
$readmore_text = !empty($post_meta['readmore_btn_text']) ? $post_meta['readmore_btn_text'] : esc_html__('Read More','heal');


Heal_Excerpt($excerpt_length);
?>


<?php
    if ($post_meta['readmore_btn']) {
        printf(
            '<a href="%1$s" class="default-btn move-bottom"><span>%2$s</span></a>',
            esc_url(get_the_permalink()), 
            esc_html($readmore_text) 
        );
    }
?>
