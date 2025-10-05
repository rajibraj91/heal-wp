<?php
/**
 * Blog Single Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package heal
 */

get_header();
$heal = heal();

$page_layout_meta = Heal_Group_Fields_Value::page_layout_options('blog_single');

$single_comment   = cs_get_option('blog_single_post_comment');

$full_width_class = $page_layout_meta['content_column_class'] === 'col-lg-12' ? ' full-width-content ' : '';
if ($heal->is_heal_core_active()){
    heal_core()->setPostViews(get_the_ID());
}
?>
    <div id="primary" class="blog-section padding--top padding--bottom <?php echo esc_attr($full_width_class);?>">
        <main id="main" class="site-main">
            <div class="container">
                <div class="blog blog-style2 blog-single">
                    <div class="row g-4">
                        <div class="<?php echo esc_attr($page_layout_meta['content_column_class']);?>">
                            <?php
                                while ( have_posts() ) :
                                    the_post();
                                    // Load the correct format-based single template
                                    $post_format = get_post_format();
                                    if ( $post_format && locate_template( "template-parts/single-{$post_format}.php" ) ) {
                                        get_template_part( "template-parts/single", $post_format );
                                    } else {
                                        get_template_part( "template-parts/content", "single" );
                                    }
                                    
                                    if( isset($single_comment) && $single_comment ) :
                                        // If comments are open or we have at least one comment, load up the comment template.
                                        if ( comments_open() || get_comments_number() || get_option( 'thread_comments' )) :
                                            comments_template();
                                        endif;
                                    endif;
                                endwhile; // End of the loop.
                            ?>
                        </div>

                        <?php if ($page_layout_meta['sidebar_enable']): ?>
                            <div class="<?php echo esc_attr($page_layout_meta['sidebar_column_class']);?>">
                                <div class="gt-main-sideber sticky-style sidebar">
                                    <?php get_sidebar();?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
