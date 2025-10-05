<?php
/**
 * Single Team Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package heal
 */

get_header();
$page_layout_meta = Heal_Group_Fields_Value::page_layout_options('service_single');
?>
    <div id="primary" class="service-content-area gt-service-details-section section-padding">
        <main id="main" class="site-main">
            <div class="gt-service-details-wrapper">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-lg-8 col-12">
                            <?php
                                while ( have_posts() ) :
                                    the_post();
                                    get_template_part( 'template-parts/content', 'service-single' );
                                endwhile; // End of the loop.
                                ?>
                        </div>
                        <?php
                            if(is_active_sidebar('service-sidebar')){ ?>
                                <div class="col-lg-4 col-12">
                                    <div class="gt-main-sideber sticky-style">
                                        <?php dynamic_sidebar('service-sidebar');?>
                                    </div>
                                </div>
                            <?php }
                        ?>
                    </div>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
