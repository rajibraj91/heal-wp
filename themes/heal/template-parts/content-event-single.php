<?php
/**
 * Template part for displaying single event post
 *
 * @package heal
 */

$heal = heal();
$event_meta_data = get_post_meta(get_the_ID(), 'heal_event_options', true);


// Event Location
$event_location = $event_meta_data['event_location'] ?? '';
$event_time_title     = $event_meta_data['event_time_title'] ?? '';
$event_date     = $event_meta_data['event_date'] ?? '';

$event_time_raw = $event_meta_data['event_time'] ?? '';
$event_time_obj = !empty($event_time_raw) ? \DateTime::createFromFormat('H:i:s', $event_time_raw) : false;
$event_time     = $event_time_obj ? $event_time_obj->format('h:i A') : '';


// Get social share URLs
$social_media_links = $event_meta_data['social_media_links'] ?? [];  // Default to an empty array

// Get YouTube Video Link
$event_video_link = $event_meta_data['event_video_link'] ?? '';
$event_video_thumb_id = $event_meta_data['event_video_thumb']['id'] ?? '';
$event_video_thumb_url = $event_video_thumb_id ? wp_get_attachment_url($event_video_thumb_id) : '';




// Event Introo Content
$intro_title       = $event_meta_data['event_intro_title'] ?? '';
$intro_description = $event_meta_data['event_intro_description'] ?? '';



// Get Event Highlights
$social_media_links = $event_meta_data['social_media_links'] ?? [];  // Default to an empty array
$highlight_sections  = $event_meta_data['event_highlights_rep'] ?? '';

// Get Speakers Info
$event_speakers = $event_meta_data['event_speakers'] ?? [];  // Default to an empty array
$speaker_title       = $event_meta_data['event_speaker_title'] ?? '';
$speaker_description = $event_meta_data['event_speaker_description'] ?? '';


// Get Venue Directions and Google Map Embed
$venue_dir_title = $event_meta_data['venue_direction_title'] ?? '';
$venue_directions = $event_meta_data['venue_directions'] ?? '';
$google_map_embed = $event_meta_data['google_map_embed'] ?? '';
?>


<div class="row g-4">
    <div class="col-lg-8 col-12">
        <div class="section-wrapper">
            <div class="event event-single">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="event__item">
                            <div class="event__inner">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="event__thumb">
                                        <?php the_post_thumbnail('heal-event-single'); ?>
                                    </div>
                                <?php endif; ?>


                                <div class="event__content">
                                    <?php if(!empty($event_date)) : ?>
                                        <div class="event__time">
                                            <?php if(!empty($event_time_title)) : ?>
                                                <div class="event__time-title">
                                                    <h3><?php echo esc_html($event_time_title); ?></h3>
                                                </div>
                                            <?php endif; ?>

                                            <div class="event__time-schedule">
                                                <ul class="countdown count-down" data-date="<?php echo esc_attr( date_i18n( get_option('date_format'), strtotime( $event_date ) ) ); ?> <?php echo esc_html($event_time); ?>">
                                                    <li class="clock-item">
                                                        <span class="count-number days"><?php echo esc_html__('0', 'heal'); ?></span>
                                                        <p class="count-text"><?php echo esc_html__('Days', 'heal'); ?></p>
                                                    </li>
                                
                                                    <li class="clock-item">
                                                        <span class="count-number hours"><?php echo esc_html__('0', 'heal'); ?></span>
                                                        <p class="count-text"><?php echo esc_html__('Hours', 'heal'); ?></p>
                                                    </li>
                                
                                                    <li class="clock-item">
                                                        <span class="count-number minutes"><?php echo esc_html__('0', 'heal'); ?></span>
                                                        <p class="count-text"><?php echo esc_html__('Minutes', 'heal'); ?></p>
                                                    </li>
                                
                                                    <li class="clock-item">
                                                        <span class="count-number seconds"><?php echo esc_html__('0', 'heal'); ?></span>
                                                        <p class="count-text"><?php echo esc_html__('Seconds', 'heal'); ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php 
                                        if ($event_speakers) : 
                                        foreach ($event_speakers as $speaker) : 
                                        $speaker_image_id = $speaker['speaker_image']['id'] ?? '';
                                        $speaker_image_url = $speaker_image_id ? wp_get_attachment_image_url($speaker_image_id, 'heal-speaker-thumb') : '';
                                    ?>
                                    <div class="event__speaker">
                                        <?php if (!empty($speaker_image_url)) : ?>
                                            <div class="event__speaker-thumb">
                                                <img src="<?php echo esc_url($speaker_image_url); ?>" alt="<?php echo esc_attr($speaker['speaker_name']); ?>">
                                            </div>
                                        <?php endif; ?>

                                        <div class="event__speaker-content">
                                            <?php if(!empty($speaker['speaker_role'])) : ?>
                                                <p><i class="fas fa-microphone"></i> <b><?php echo esc_html__('Aynal Suffe :-', 'heal'); ?></b> <?php echo esc_html($speaker['speaker_role']); ?></p>
                                            <?php endif; ?>

                                            <?php if(!empty($event_date)) : ?>
                                                <p><i class="far fa-clock"></i> <b><?php echo esc_html__('Time :-', 'heal'); ?></b> <?php echo esc_html( date_i18n( get_option('date_format'), strtotime( $event_date ) ) ); ?> <?php if(!empty($event_time)) : ?> <?php echo esc_html__('at', 'heal'); ?> <?php echo esc_html($event_time); ?> <?php endif; ?></p>
                                            <?php endif; ?>

                                            <?php if(!empty($event_location)) : ?>
                                                <p><i class="fas fa-map-marker-alt"></i> <b><?php echo esc_html__('Address :-', 'heal'); ?></b> <?php echo esc_html($event_location); ?></p>
                                            <?php endif; ?>

                                            <?php if (!empty($social_media_links)) : ?>
                                                <div class="footer__social">
                                                    <ul class="justify-content-start">
                                                        <?php
                                                            foreach ( $social_media_links as $social ) :
                                                            $icon = $social['social_icon'] ?? '';
                                                            $url = $social['social_url'] ?? '';
                                                            $platform = $social['social_platform'] ?? '';
                                                        ?>
                                                            <li>
                                                                <a href="<?php echo esc_url($url); ?>" target="_blank">
                                                                    <?php if ( $icon ) : ?>
                                                                        <i class="<?php echo esc_attr($icon); ?>"></i>
                                                                    <?php endif; ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; endif; ?>

                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $terms = wp_get_post_terms( get_the_ID(), 'event-cat', array( 'fields' => 'ids' ) );
                        $args = array(
                            'post_type'      => 'event',
                            'posts_per_page' => 2,
                            'post__not_in'   => array( get_the_ID() ), // exclude current post
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'event-cat',
                                    'field'    => 'term_id',
                                    'terms'    => $terms,
                                ),
                            ),
                        );
                        $related_events = new WP_Query( $args );
                    ?>

                    <?php if ( $related_events->have_posts() ) : ?>
                        <div class="event__relpost">
                            <div class="row g-4">
                                <?php while ( $related_events->have_posts() ) : $related_events->the_post(); ?>

                                <?php 
                                    // $event_date2     = $event_meta_data['event_date'] ?? '';

                                    // $event_time_raw = $event_meta_data['event_time'] ?? '';
                                    // $event_time_obj = !empty($event_time_raw) ? \DateTime::createFromFormat('H:i:s', $event_time_raw) : false;
                                    // $event_time2     = $event_time_obj ? $event_time_obj->format('h:i A') : '';

                                    $related_meta = get_post_meta( get_the_ID(), 'heal_event_options', true );

                                    $event_date2     = $related_meta['event_date'] ?? '';

                                    $event_time_raw2 = $related_meta['event_time'] ?? '';
                                    $event_time_obj2 = !empty($event_time_raw2) ? \DateTime::createFromFormat('H:i:s', $event_time_raw2) : false;
                                    $event_time2     = $event_time_obj2 ? $event_time_obj2->format('h:i A') : '';
                                ?>
                                    <div class="col-md-6 col-12">
                                        <div class="event__item">
                                            <div class="event__inner">
                                                <div class="event__thumb">
                                                    <?php the_post_thumbnail('medium'); ?>
                                                </div>
                                                <div class="event__content">
                                                    <div class="event__author">
                                                        <?php if (!empty($speaker_image_url)) : ?>
                                                            <img src="<?php echo esc_url($speaker_image_url); ?>" alt="<?php echo esc_attr($speaker['speaker_name']); ?>">
                                                        <?php endif; ?>

                                                        <?php if(!empty($speaker['speaker_name'])) : ?>
                                                            <div class="name">
                                                                <h6><?php echo esc_html($speaker['speaker_name']); ?></h6>

                                                                <?php if(!empty($speaker['speaker_role'])) : ?>
                                                                    <span><?php echo esc_html($speaker['speaker_role']); ?></span>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    
                                                    <div class="event__list">
                                                        <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                                                        <ul>
                                                            <li><i class="far fa-clock"></i><b><?php echo esc_html__('Time :-', 'heal'); ?></b> <?php echo esc_html( date_i18n( 'd M, Y', strtotime( $event_date2 ) ) ); ?> <?php if(!empty($event_time2)) : ?> <?php echo esc_html__('at', 'heal'); ?> <?php echo esc_html($event_time2); ?> <?php endif; ?></li>

                                                            <li><i class="fas fa-map-marker-alt"></i><b><?php echo esc_html__('Address :-', 'heal'); ?></b> <?php echo esc_html($event_location); ?></li>
                                                        </ul>
                                                    </div>
                                                    <div class="event__btn">
                                                        <a href="<?php the_permalink(); ?>" class="default-btn move-right"><span><?php echo esc_html__('Read More', 'heal'); ?></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; wp_reset_postdata(); ?> 
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php if(is_active_sidebar('event-sidebar')){ ?>
        <div class="col-lg-4 col-12">
            <div class="sidebar">
                <?php dynamic_sidebar('event-sidebar');?>
            </div>
        </div>
    <?php } ?>
</div>