<?php
/**
 * Post Meta Functions
 * @package heal
 * @since 1.0.0
 */

?>

<div class="recent-post-area gt-recent-post-area">
    <?php
    // Define WP_Query arguments
    $args = array(
        'posts_per_page' => 2, // Display only two posts
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    // The Query
    $query = new WP_Query($args);

    // The Loop
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
    ?>
    <div class="recent-post-items gt-recent-items">
        <div class="gt-recent-thumb">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('thumbnail');
            } 
            ?>
        </div>
        <div class="gt-recent-content">
            <h5>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h5>
            <ul class="gt-date-list">
                <li>
                   
                    <?php echo get_the_date(); ?>
                </li>
            </ul>
        </div>
    </div>

   

    
    <?php
        }
        // Restore original Post Data
        wp_reset_postdata();
    } else {
        // No posts found
        echo '<p>No posts found.</p>';
    }
    ?>
</div>