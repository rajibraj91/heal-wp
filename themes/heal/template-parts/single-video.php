<?php
/**
 * Template part for displaying single video post
 *
 * @package heal
 */

$heal = heal();
$post_meta = get_post_meta(get_the_ID(), 'heal_post_video_options', true);
$video_url = isset($post_meta['video_url']) && !empty($post_meta['video_url']) ? $post_meta['video_url'] : '';
$post_single_meta = Heal_Group_Fields_Value::post_meta('blog_single_post');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog__item'); ?>>
    <div class="blog__inner mb-0 pb-0 border-0">
        <?php if (has_post_thumbnail()): ?>
            <div class="blog__image position-relative">
                <?php $heal->post_thumbnail('post-thumbnail'); ?>

                <?php if(!empty($video_url)): ?>
                    <a href="<?php echo esc_url($video_url);?>" class="play-btn" data-rel="lightcase">
                        <i class="fa-solid fa-play"></i>
                        <span class="pluse_2"></span>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="blog__content">
            <?php
                // Author/date/comments meta
                get_template_part('template-parts/content/author-post-meta');
            ?>
            <div class="blog__postcontent">
                <h5 class="title"><?php the_title(); ?></h5>
                <?php the_content(); ?>
            </div>
        </div>
    </div>

    <?php if ('post' === get_post_type() && ((has_tag() && $post_single_meta['posted_tag']) || (shortcode_exists('heal_post_share') && $post_single_meta['posted_share']))) : ?>
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
