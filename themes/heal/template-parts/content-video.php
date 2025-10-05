<?php
/**
 * Template part for displaying video posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package heal
 */




$heal = heal();
$post_meta = get_post_meta(get_the_ID(),'heal_post_video_options',true);
$video_url = isset($post_meta['video_url']) && $post_meta['video_url'] ? $post_meta['video_url'] : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog__item'); ?>>
    
    


    <div class="blog__inner">
        <?php if (has_post_thumbnail()):  ?>
            <div class="blog__image position-relative">
                <?php $heal->post_thumbnail('post-thumbnail'); ?>

                <?php if(!empty($video_url)): ?>
                    <a href="<?php echo esc_url($video_url);?>" class="play-btn" data-rel="lightcase">
                        <i class="fa-solid fa-play"></i>
                        <span class="pluse_2"></span>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif;?>

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
</article><!-- #post-<?php the_ID(); ?> -->
