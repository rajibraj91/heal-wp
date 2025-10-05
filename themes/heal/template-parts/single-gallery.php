<?php
/**
 * Template part for displaying Single gallery posts
 *
 * @package heal
 */


// $heal = heal();
// $post_meta = get_post_meta( get_the_ID(), 'heal_post_gallery_options', true );
// $post_meta_gallery = isset( $post_meta['gallery_images'] ) && ! empty( $post_meta['gallery_images'] ) ? $post_meta['gallery_images'] : '';
// $gallery_images = explode( ',', $post_meta_gallery );
// $post_single_meta = Heal_Group_Fields_Value::post_meta( 'blog_single_post' );




$heal = heal();
$post_meta = get_post_meta( get_the_ID(), 'heal_post_gallery_options', true );

// Ensure $post_meta is an array before accessing keys
if (is_array($post_meta) && isset($post_meta['gallery_images']) && !empty($post_meta['gallery_images'])) {
    $post_meta_gallery = $post_meta['gallery_images'];
} else {
    $post_meta_gallery = '';
}

$gallery_images = !empty($post_meta_gallery) ? explode( ',', $post_meta_gallery ) : [];
$post_single_meta = Heal_Group_Fields_Value::post_meta( 'blog_single_post' );


?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-single-content-wrap' ); ?>>
    <?php if ( ! empty( $gallery_images ) ) : ?>
        <div class="gt-slider-wrapper">
            <div class="swiper gt-blog-slider">
                <div class="swiper-wrapper">
                    <?php foreach ( $gallery_images as $image_id ) :
                        $img_src = wp_get_attachment_image_src( $image_id, 'full' );
                        $img_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        ?>
                        <div class="swiper-slide">
                            <div class="gt-news-image slide-img">
                                <img src="<?php echo esc_url( $img_src[0] ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="gt-array-items blog-array">
                <button class="array-prev"><i class="icon-icon-2"></i></button>
                <button class="array-next"><i class="icon-icon-3"></i></button>
            </div>
        </div>
    <?php elseif ( has_post_thumbnail() ) : ?>
        <div class="gt-news-image">
            <?php $heal->post_thumbnail(); ?>
        </div>
    <?php endif; ?>

    <div class="gt-news-details-content entry-content">
        <h5 class="title"><?php the_title(); ?></h5>
        <?php the_content(); ?>
    </div>

    <?php if ( 'post' === get_post_type() && ( ( has_tag() && $post_single_meta['posted_tag'] ) || ( shortcode_exists( 'heal_post_share' ) && $post_single_meta['posted_share'] ) ) ) : ?>
        <div class="blog__tags">
            <?php if ( has_tag() ) : ?>
                <div class="blog__tags-left">
                    <div class="blog__tags-title">
                        <p><?php echo esc_html__('Tags:', 'heal'); ?></p>
                    </div>
                    <div class="blog__tags-details">
                        <?php $heal->posted_tag(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( shortcode_exists( 'heal_post_share' ) && $post_single_meta['posted_share'] ) : ?>
                <div class="blog__tags-right">
                    <div class="blog__tags-title">
                        <p><?php echo esc_html__('Share:', 'heal'); ?></p>
                    </div>
                    <div class="blog__tags-details">
                        <div class="footer__social">
                            <?php echo do_shortcode( '[heal_post_share]' ); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</article>
