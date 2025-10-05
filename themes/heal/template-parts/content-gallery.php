<?php
/**
 * Template part for displaying gallery posts 
 *
 * @package heal
 */


$heal = heal();
$post_meta = get_post_meta(get_the_ID(), 'heal_post_gallery_options', true);
$post_meta_gallery = isset($post_meta['gallery_images']) && !empty($post_meta['gallery_images']) ? $post_meta['gallery_images'] : '';
$gallery_images = !empty($post_meta_gallery) ? explode(',', $post_meta_gallery) : [];

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog__item'); ?>>
    <div class="blog__inner">
        <?php if (!empty($gallery_images)) : ?>
            <div class="swiper blog__item--slider">
                <div class="swiper-wrapper">
                    <?php foreach ($gallery_images as $image_id) :
                        $img_src = wp_get_attachment_image_src($image_id, 'full');
                        $img_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                        ?>
                        <div class="swiper-slide">
                            <div class="blog__thumb slide-img">
                                <img src="<?php echo esc_url($img_src[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php elseif (has_post_thumbnail()) : ?>
            <div class="blog__thumb">
                <?php $heal->post_thumbnail(); ?>
            </div>
        <?php endif; ?>

        <div class="blog__content">
            <?php
                // Author/date/comments meta
                get_template_part('template-parts/content/author-post-meta');
            ?>
            <div class="blog__postcontent">
                <?php 
                    // Post title
                    the_title('<a href="' . esc_url(get_permalink()) . '" rel="bookmark"><h5>', '</h5></a>');
                    // Excerpt + read more button
                    get_template_part('template-parts/content/post-excerpt');
                ?>
            </div>
        </div>
    </div>
</article>


