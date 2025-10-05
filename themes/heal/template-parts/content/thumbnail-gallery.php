<?php
/**
 * Post Thumbnail Gallery using Swiper.js
 * @package heal
 * @since 1.0.0
 */

$heal = heal();
$post_meta = get_post_meta(get_the_ID(), 'heal_post_gallery_options', true);
$post_meta_gallery = isset($post_meta['gallery_images']) && !empty($post_meta['gallery_images']) ? $post_meta['gallery_images'] : '';
$gallery_images = explode(',', $post_meta_gallery);

?>

<?php if (!empty($gallery_images)) : ?>
    <!-- Swiper Slider Start -->
    <div class="swiper gt-blog-slider">
        <div class="swiper-wrapper">
            <?php foreach ($gallery_images as $image_id) :
                $img_src = wp_get_attachment_image_src($image_id, 'full');
                $img_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                ?>
                <div class="swiper-slide">
                    <div class="gt-news-image gt-details-image slide-img">
                        <img src="<?php echo esc_url($img_src[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Add Swiper Pagination and Navigation Controls -->
        <div class="gt-array-items blog-array">
            <button class="array-prev"><i class="icon-icon-2"></i></button>
            <button class="array-next"><i class="icon-icon-3"></i></button>
        </div>
    </div>
    <!-- Swiper Slider End -->
<?php elseif (has_post_thumbnail()) : ?>
    <!-- Display Featured Image if no gallery images -->
    <div class="gt-news-image">
        <?php $heal->post_thumbnail(); ?>
    </div>
<?php endif; ?>


<div class="gt-news-content">
    <?php
        // Include post metadata (author/date/comments)
        get_template_part('template-parts/content/author-post-meta');

        // Display the title
        the_title('<h3 class="title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');

        // Display the post excerpt
        get_template_part('template-parts/content/post-excerpt');
    ?>
</div>
