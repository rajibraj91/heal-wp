<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package heal
 */

$heal = heal();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-main-item-01 gt-news-card-items-4'); ?>>
    
    <?php
        // Show post thumbnail
        get_template_part('template-parts/content/thumbnail-classic');
    ?>

    <div class="gt-news-content content">
        <?php get_template_part('template-parts/content/author-post-meta'); ?>

        <?php
            the_title(
                '<h3 class="title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', 
                '</a></h3>'
            );
            get_template_part('template-parts/content/post-excerpt');
        ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
