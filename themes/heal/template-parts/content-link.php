<?php
/**
 * Template part for displaying link posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package heal
 */

$heal = heal();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('gt-news-card-items-4'); ?>>
    <div class="blog__inner">
        <?php
            // Thumbnail output
            get_template_part('template-parts/content/thumbnail-classic');
        ?>

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