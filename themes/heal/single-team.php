<?php
/**
 * Single Team Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package heal
 */

get_header();
$page_layout_meta = Heal_Group_Fields_Value::page_layout_options('team_single');
?>
    <div id="primary" class="team-content-area gt-team-details-section fix section-padding">
        <main id="main" class="site-main">
            <div class="container">
                <?php
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content', 'team-single' );
                    endwhile; // End of the loop.
                ?>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
