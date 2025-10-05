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
$event_speaker_title     = $event_meta_data['event_speaker_title'] ?? '';
$event_speakers = $event_meta_data['event_speakers'] ?? [];


$event_time_raw = $event_meta_data['event_time'] ?? '';
$event_time_obj = !empty($event_time_raw) ? \DateTime::createFromFormat('H:i:s', $event_time_raw) : false;
$event_time     = $event_time_obj ? $event_time_obj->format('h:i A') : '';

// Get social share URLs
// $social_media_links = $event_meta_data['social_media_links'] ?? [];  // Default to an empty array



// Get YouTube Video Link
$event_video_title = $event_meta_data['event_video_title'] ?? '';
$event_video_link = $event_meta_data['event_video_link'] ?? '';
$event_video_thumb_id = $event_meta_data['event_video_thumb']['id'] ?? '';
$event_video_thumb_url = $event_video_thumb_id ? wp_get_attachment_url($event_video_thumb_id) : '';



// Get Venue Directions and Google Map Embed
$venue_dir_title = $event_meta_data['venue_direction_title'] ?? '';
$google_map_title = $event_meta_data['google_map_title'] ?? '';
$google_map_embed = $event_meta_data['google_map_embed'] ?? '';
?>


<div class="row g-5 g-lg-4">
    <div class="col-lg-8 col-12">
        <div class="section-wrapper">
            <div class="event event-single event-single2">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="event__item">
                            <div class="event__inner">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="event__thumb">
                                        <?php the_post_thumbnail('heal-event-single'); ?>
                                        
                                        <?php if(!empty($event_date)) : ?>
                                            <div class="event__time">
                                                <?php if(!empty($event_time_title)) : ?>
                                                    <div class="event__time-title">
                                                        <h3><?php echo esc_html($event_time_title); ?></h3>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="event__time-schedule">
                                                    <ul class="countdown count-down" data-date="<?php echo esc_attr( date_i18n( get_option('date_format'), strtotime( $event_date ) ) ); ?> <?php echo esc_attr($event_time); ?>">
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
                                    </div>
                                <?php endif; ?>

                                <div class="event__content">
                                    <?php the_content(); ?>
                                    
                                    <div class="event__speaker">
                                        <div class="row g-4">
                                            <div class="col-lg-6">
                                                <?php if ($event_video_thumb_url) : ?>
                                                    <div class="event__speaker-thumb mb-4 mb-xl-0">
                                                        <?php if(!empty($event_video_title)) : ?>
                                                            <div class="event__speaker-title">
                                                                <h5><?php echo esc_html( $event_video_title ); ?></h5>
                                                            </div>
                                                        <?php endif; ?>

                                                        <div class="position-relative">
                                                            <img src="<?php echo esc_url($event_video_thumb_url); ?>" alt="<?php esc_attr_e('Event Video Thumbnail', 'heal'); ?>">
                                                            
                                                            <?php if ($event_video_link) : ?>
                                                                <a href="<?php echo esc_url($event_video_link); ?>" data-rel="lightcase" class="play-btn"><i class="fas fa-play"></i></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="event__speaker-content">
                                                    <?php if(!empty($event_speaker_title)) : ?>
                                                        <div class="event__speaker-title">
                                                            <h5><?php echo esc_html( $event_speaker_title ); ?></h5>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php foreach ($event_speakers as $speaker) : ?>
                                                        <?php if(!empty($speaker['speaker_role'])) : ?>
                                                            <p><b><?php echo esc_html__('Aynal Suffe :-', 'heal'); ?></b> <?php echo esc_html($speaker['speaker_role']); ?></p>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>

                                                    <?php if(!empty($event_date)) : ?>
                                                        <p><b><?php echo esc_html__('Time :-', 'heal'); ?></b> <?php echo esc_html( date_i18n( get_option('date_format'), strtotime( $event_date ) ) ); ?> <?php if(!empty($event_time)) : ?> <?php echo esc_html__('at', 'heal'); ?> <?php echo esc_html($event_time); ?> <?php endif; ?></p>
                                                    <?php endif; ?>

                                                    <?php if(!empty($event_location)) : ?>
                                                        <p><b><?php echo esc_html__('Address :-', 'heal'); ?></b> <?php echo esc_html($event_location); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($google_map_embed)) : ?>
                            <div class="event__map">
                                <?php if(!empty($google_map_title)) : ?>
                                    <div class="event__map-title">
                                        <h5><?php echo esc_html($google_map_title); ?></h5>
                                    </div>
                                <?php endif; ?>

                                <iframe 
                                    src="<?php echo esc_url($google_map_embed); ?>" 
                                    style="border:0;" 
                                    allowfullscreen 
                                    loading="lazy">
                                </iframe> 
                            </div>
                        <?php else : ?>
                            <p><?php esc_html_e('Google Map Embed URL is not set.', 'heal'); ?></p>
                        <?php endif; ?>
                    </div>
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