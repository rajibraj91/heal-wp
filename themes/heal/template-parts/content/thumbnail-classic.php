<?php
/**
 * Post Thumbnail Functions
 * @package heal
 * @since 1.0.0
 */

$heal = heal();
if (has_post_thumbnail()): ?>
     <div class="gt-news-image gt-details-image">
        <?php $heal->post_thumbnail('post-thumbnail'); ?>
    </div>
<?php endif; ?>