<?php
/**
 * Single Event Template
 *
 * @package heal
 */

get_header();


$event_meta_data = get_post_meta(get_the_ID(), 'heal_event_options', true);
$event_style = $event_meta_data['event_style'] ?? '';

if ( class_exists('Heal_Group_Fields_Value') ) {
    $page_layout_meta = Heal_Group_Fields_Value::page_layout_options('event_single');
}
?>
<div id="primary" class="event-section padding--top padding--bottom bg-white">
    <main id="main" class="site-main">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();
                if ( 'single2' === $event_style ) {
                    get_template_part( 'template-parts/content', 'event-single2' );
                }
                else {
                    get_template_part( 'template-parts/content', 'event-single' );
                }
            endwhile;
            ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>
