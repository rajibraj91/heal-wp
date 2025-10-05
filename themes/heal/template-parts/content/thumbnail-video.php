<?php
/**
 * Post Thumbnail Video
 * @package heal
 * @since 1.0.0
 */

$heal = heal();
$post_meta = get_post_meta(get_the_ID(),'heal_post_video_options',true);
$video_url = isset($post_meta['video_url']) && $post_meta['video_url'] ? $post_meta['video_url'] : '';
$blog_single_options = Heal_Group_Fields_Value::post_meta('blog_single_post');
if(!empty($video_url)):
    ?>
    <div class="gt-news-image gt-details-image">
        <?php $heal->post_thumbnail('post-thumbnail'); ?>
        <?php if(!empty($video_url)): ?>
        <div class="postbox__play-btn">
            <a href="<?php echo esc_url($video_url);?>" class="video-btn ripple video-popup">
                <i class="fa-solid fa-play"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
<?php endif; ?>



