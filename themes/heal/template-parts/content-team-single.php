<?php
/**
 * Template part for displaying single team post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package heal
 */

$heal_meta = get_post_meta(get_the_ID(), 'heal_team_options', true);

$img_id      = get_post_thumbnail_id(get_the_ID());
$img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'heal-team-single', false) : '';
$img_url     = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
$img_alt     = $img_id ? get_post_meta($img_id, '_wp_attachment_image_alt', true) : '';

$designation     = !empty($heal_meta['designation']) ? $heal_meta['designation'] : '';
$team_content    = !empty($heal_meta['team_content']) ? $heal_meta['team_content'] : '';
$social_icons    = !empty($heal_meta['social-icons']) ? $heal_meta['social-icons'] : [];
$contact_infos   = !empty($heal_meta['contact-infos']) ? $heal_meta['contact-infos'] : [];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('heal-details-content-area team-details-section'); ?>>
    <div class="gt-team-details-wrapper">
        <div class="row g-4 align-items-center">
            <?php if ( $img_url ) : ?>
                <div class="col-lg-6">
                    <div class="gt-thumb">
                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-lg-6">
                <div class="gt-details-content">
                    <h5><?php echo esc_html(get_the_title()); ?></h5>

                    <?php if ( $designation ) : ?>
                        <span><?php echo esc_html($designation); ?></span>
                    <?php endif; ?>

                    <?php if ( $team_content ) : ?>
                        <p><?php echo wp_kses_post($team_content); ?></p>
                    <?php endif; ?>

                    <?php if ( !empty($contact_infos) ) : ?>
                        <ul class="gt-list">
                            <?php foreach ( $contact_infos as $contact ) : ?>
                                <li>
                                    <?php if ( !empty($contact['icon']) ) : ?>
                                        <i class="<?php echo esc_attr($contact['icon']); ?>"></i>
                                    <?php endif; ?>

                                    <?php if ( !empty($contact['info']) ) : ?>
                                        <?php echo esc_html($contact['info']); ?>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ( !empty($social_icons) ) : ?>
                        <div class="gt-social-icon">
                            <?php foreach ( $social_icons as $item ) : ?>
                                <?php if ( !empty($item['url']) && !empty($item['icon']) ) : ?>
                                    <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener noreferrer">
                                        <i class="<?php echo esc_attr($item['icon']); ?>"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
