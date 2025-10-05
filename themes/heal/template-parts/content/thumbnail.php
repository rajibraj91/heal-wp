<?php
/**
 * Post Thumbnail 
 * @package heal
 * @since 1.0.0
 */
?>

 <div class="gt-news-image gt-details-image thumbnail">
    <?php
    if (has_post_thumbnail() && get_post_type() == 'post') {
        heal()->post_thumbnail('post-thumbnail');
    }
    ?>
</div>
