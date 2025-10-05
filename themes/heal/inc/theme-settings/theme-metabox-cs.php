<?php
/**
 * Theme Metabox Options
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // exit if access directly
}

if (class_exists('CSF')) {

    $allowed_html = heal()->kses_allowed_html(array('mark'));

    $prefix = 'heal';

    /*-------------------------------------
        Post Format Options
    -------------------------------------*/
    CSF::createMetabox($prefix . '_post_video_options', array(
        'title' => esc_html__('Video Post Format Options', 'heal'),
        'post_type' => 'post',
        'post_formats' => 'video'
    ));
    CSF::createSection($prefix . '_post_video_options', array(
        'fields' => array(
            array(
                'id' => 'video_url',
                'type' => 'text',
                'title' => esc_html__('Enter Video URL', 'heal'),
                'desc' => wp_kses(__('enter <mark>video url</mark> to show in frontend', 'heal'), $allowed_html)
            )
        )
    ));
    CSF::createMetabox($prefix . '_post_gallery_options', array(
        'title' => esc_html__('Gallery Post Format Options', 'heal'),
        'post_type' => 'post',
        'post_formats' => 'gallery'
    ));
    CSF::createSection($prefix . '_post_gallery_options', array(
        'fields' => array(
            array(
                'id' => 'gallery_images',
                'type' => 'gallery',
                'title' => esc_html__('Select Gallery Photos', 'heal'),
                'desc' => wp_kses(__('select <mark>gallery photos</mark> to show in frontend', 'heal'), $allowed_html)
            )
        )
    ));

    /*-------------------------------------
      Page Container Options
    -------------------------------------*/
    CSF::createMetabox($prefix . '_page_container_options', array(
        'title' => esc_html__('Page Options', 'heal'),
        'post_type' => array('page'),
    ));
    CSF::createSection($prefix . '_page_container_options', array(
        'title' => esc_html__('Layout & Colors', 'heal'),
        'icon' => 'fa fa-columns',
        'fields' => Heal_Group_Fields::page_layout()
    ));
    CSF::createSection($prefix . '_page_container_options', array(
        'title' => esc_html__('Header Footer & Breadcrumb', 'heal'),
        'icon' => 'fa fa-header',
        'fields' => Heal_Group_Fields::Page_Container_Options('header_options')
    ));
    CSF::createSection($prefix . '_page_container_options', array(
        'title' => esc_html__('Width & Padding', 'heal'),
        'icon' => 'fa fa-file-o',
        'fields' => Heal_Group_Fields::Page_Container_Options('container_options')
    ));
    //	Service Meta Box
    CSF::createMetabox($prefix . '_service_options', array(
        'title' => esc_html__('Service Options', 'heal'),
        'post_type' => 'service',
    ));
    // CSF::createSection($prefix . '_service_options', array(
    //     'fields' => array(
    //         array(
    //             'id' => 'service_icon',
    //             'type' => 'icon',
    //             'title' => esc_html__('Icon', 'heal'),
    //             'desc' => wp_kses(__('Select Your Icon', 'heal'), $allowed_html)
    //         ),
    //         array(
    //             'id' => 'service_count',
    //             'type' => 'textarea',
    //             'title' => esc_html__('Service Item Count', 'heal'),
    //             'desc' => wp_kses(__('Add Your Item number 1 or 2 etc.', 'heal'), $allowed_html)
    //         ),         
    //         //  FAQ Repeater Field
    //         array(
    //             'id'     => 'service_faqs',
    //             'type'   => 'repeater',
    //             'title'  => esc_html__('Service FAQs', 'heal'),
    //             'fields' => array(
    //                 array(
    //                     'id'    => 'faq_question',
    //                     'type'  => 'text',
    //                     'title' => esc_html__('Question', 'heal'),
    //                 ),
    //                 array(
    //                     'id'    => 'faq_answer',
    //                     'type'  => 'textarea',
    //                     'title' => esc_html__('Answer', 'heal'),
    //                 ),
    //             ),
    //         ),
    //     )
    // ));

    CSF::createSection($prefix . '_service_options', array(
        'fields' => array(
            // Select Field
            array(
                'id'          => 'service_type',
                'type'        => 'select',
                'title'       => esc_html__('Service Type Page', 'heal'),
                'placeholder' => esc_html__('Select a service type', 'heal'),
                'options'     => array(
                    'chiarity'  => 'Chiarity',
                    'hafsa'  => 'Hafsa',
                ),
                'default'     => '',
            ),

            // Only show when service_type is 'standard'
            array(
                'id'    => 'service_hafsa_icon',
                'type'  => 'media',
                'title' => esc_html__('Icon', 'heal'),
                'desc'  => wp_kses(__('Select Your Icon', 'heal'), $allowed_html),
                'dependency' => array('service_type', '==', 'hafsa'),
            ),

            array(
                'id'    => 'service_count',
                'type'  => 'textarea',
                'title' => esc_html__('Service Item Count', 'heal'),
                'desc'  => wp_kses(__('Add Your Item number 1 or 2 etc.', 'heal'), $allowed_html),
                'dependency' => array('service_type', '==', 'hafsa'),
            ),

            // Only show when service_type is 'advanced'
            array(
                'id'     => 'service_faqs',
                'type'   => 'repeater',
                'title'  => esc_html__('Service FAQs', 'heal'),
                'dependency' => array('service_type', '==', 'chiarity'),
                'fields' => array(
                    array(
                        'id'    => 'faq_question',
                        'type'  => 'text',
                        'title' => esc_html__('Question', 'heal'),
                    ),
                    array(
                        'id'    => 'faq_answer',
                        'type'  => 'textarea',
                        'title' => esc_html__('Answer', 'heal'),
                    ),
                ),
            ),
        ),
    ));



    // Sermon Meta Box
    CSF::createMetabox($prefix . '_sermon_options', array(
        'title' => esc_html__('Sermon Options', 'heal'),
        'post_type' => 'sermon',
    ));
    CSF::createSection($prefix . '_sermon_options', array(
        'fields' => array(
            array(
                'id'    => 'sermon_time',
                'type'  => 'date',
                'title' => esc_html__('Sermon Time', 'heal'),
                'desc'  => wp_kses(__('Choose your sermon time', 'heal'), $allowed_html),
            ),
            array(
                'id'    => 'sermon_video',
                'type'  => 'upload',
                'title' => esc_html__('Sermon Video', 'heal'),
                'desc'  => wp_kses(__('Upload your sermon video file or paste video URL', 'heal'), $allowed_html),
            ),
            array(
                'id'    => 'sermon_audio',
                'type'  => 'text',
                'title' => esc_html__('Sermon Audio URL', 'heal'),
                'desc'  => wp_kses(__('Add your SoundCloud or MP3 audio URL', 'heal'), $allowed_html),
            ),
            array(
                'id'    => 'sermon_notes',
                'type'  => 'text',
                'title' => esc_html__('Sermon Notes', 'heal'),
                'desc'  => wp_kses(__('Upload your sermon notes PDF or DOC', 'heal'), $allowed_html),
            ),
            array(
                'id'    => 'sermon_download',
                'type'  => 'upload',
                'title' => esc_html__('Sermon Download', 'heal'),
                'desc'  => wp_kses(__('Upload downloadable sermon file', 'heal'), $allowed_html),
            ),
        )
    ));

    /*-------------------------------------
     Team Options
    -------------------------------------*/
    
    CSF::createMetabox($prefix . '_team_options', array(
        'title' => esc_html__('Team Options', 'heal'),
        'post_type' => array('team'),
        'priority' => 'high'
    ));
    CSF::createSection($prefix . '_team_options', array(
        'title' => esc_html__('Team Info', 'heal'),
        'id' => 'heal-info',
        'fields' => array(

            array(
                'id' => 'designation',
                'type' => 'text',
                'title' => esc_html__('Designation', 'heal'),
            ),
            array(
                'id' => 'team_content',
                'type' => 'textarea',
                'title' => esc_html__('Team content', 'heal'),
                'desc' => wp_kses(__('Write Your content', 'heal'), $allowed_html)
            )

        )
    ));
    //Team Single Contact Info
    CSF::createSection($prefix . '_team_options', array(
        'title' => esc_html__('Team Single Contact Info', 'heal'),
        'id' => 'contact-info',
        'fields' => array(
            array(
                'id' => 'contact-infos',
                'type' => 'repeater',
                'title' => esc_html__('Contact Info', 'heal'),
                'fields' => array(
                    array(
                        'id' => 'icon',
                        'type' => 'icon',
                        'title' => esc_html__('Icon', 'heal'),
                        'default' => 'fa fa-facebook-f'

                    ),
                    array(
                        'id' => 'info',
                        'type' => 'text',
                        'title' => esc_html__('Contact Content', 'heal'),
                    ),
        
                ),
            ),
        )
    ));
    //Team Socials 
    CSF::createSection($prefix . '_team_options', array(
        'title' => esc_html__('Social Info', 'heal'),
        'id' => 'social-info',
        'fields' => array(
            array(
                'id' => 'social-icons',
                'type' => 'repeater',
                'title' => esc_html__('Social Info', 'heal'),
                'fields' => array(
                    array(
                        'id' => 'icon',
                        'type' => 'icon',
                        'title' => esc_html__('Icon', 'heal'),
                        'default' => 'fa fa-facebook-f'

                    ),
                    array(
                        'id' => 'url',
                        'type' => 'text',
                        'title' => esc_html__('URL', 'heal')
                    ),

                ),
            ),
        )
    ));

    

    CSF::createMetabox($prefix . '_event_options', array(
        'title' => esc_html__('Event Details', 'heal'),
        'post_type' => 'event',
    ));

    // Chiarity
    CSF::createSection($prefix . '_event_options', array(
        'title'      => esc_html__( 'Chiarity Event Settings', 'heal' ),
        'fields' => array(
		    // Event Style
            array(
                'id'          => 'event_style',
                'type'        => 'select',
                'title'       => 'Select',
                'placeholder' => 'Choose Your Style',
                'options'     => array(
                    'single'  => 'Style 1',
                    'single2'  => 'Style 2',
                    // 'single3'  => 'style 3',
                ),
                'default'     => 'single'
            ),
        
            // Event Location
            array(
                'id'    => 'event_location',
                'type'  => 'text',
                'title' => esc_html__('Event Location', 'heal'),
                'desc'  => esc_html__('Enter the location of the event (e.g., Niagara Falls, Banff National Park)', 'heal'),
                // 'dependency' => array( 'event_style', '!=', 'single3' ),
            ),

            // Event Time Title
            array(
                'id'    => 'event_time_title',
                'type'  => 'text',
                'title' => esc_html__('Event Time Title', 'heal'),
                'desc'  => esc_html__('Enter the event time title', 'heal'),
                'placeholder' => esc_html__('Event Time Title', 'heal'),
                'dependency' => array( 'event_style', '==', 'single2' ),
            ),

            // Event Time
            array(
                'id'    => 'event_time',
                'type'  => 'text',
                'title' => esc_html__('Event Time', 'heal'),
                'desc'  => esc_html__('Enter the event time: 10:30:25', 'heal'),
                'placeholder' => esc_html__('10:30:25', 'heal'),
            ),

            // Event Date
            array(
                'id'    => 'event_date',
                'type'  => 'date',
                'title' => esc_html__('Event Date', 'heal'),
                'desc'  => esc_html__('Select the event date', 'heal'),
                'placeholder' => esc_html__('Select Date', 'heal'),
            ),

            // Speakers Section (Repeater Field)
            array(
                'id'    => 'event_speaker_title',
                'type'  => 'text',
                'title' => esc_html__('Event Speaker Title', 'heal'),
                'desc'  => esc_html__('Enter the event speaker title', 'heal'),
                'placeholder' => esc_html__('Event Speaker Title', 'heal'),
            ),
            array(
                'id'    => 'event_speakers',
                'type'  => 'group',
                'title' => esc_html__('Event Speakers', 'heal'),
                'desc'  => esc_html__('Add speakers for the event', 'heal'),
                'dependency' => array( 'event_style', '==', 'single' ),
                'fields' => array(
                    array(
                        'id'    => 'speaker_name',
                        'type'  => 'text',
                        'title' => esc_html__('Speaker Name', 'heal'),
                        'desc'  => esc_html__('Enter the name of the speaker', 'heal'),
                    ),
                    array(
                        'id'    => 'speaker_role',
                        'type'  => 'text',
                        'title' => esc_html__('Speaker Role', 'heal'),
                        'desc'  => esc_html__('Enter the role of the speaker (e.g., Professional Rider)', 'heal'),
                    ),
                    array(
                        'id'    => 'speaker_image',
                        'type'  => 'media',
                        'title' => esc_html__('Speaker Image', 'heal'),
                        'desc'  => esc_html__('Upload a photo of the speaker', 'heal'),
                    ),
                ),
            ),
            

            // Social Media Links Repeater Field
            array(
                'id'    => 'social_media_links',
                'type'  => 'group',
                'title' => esc_html__('Social Media Links', 'heal'),
                'desc'  => esc_html__('Add social media links for sharing', 'heal'),
                'dependency' => array( 'event_style', '==', 'single' ),
                'fields' => array(
                    array(
                        'id'    => 'social_icon',
                        'type'  => 'icon', 
                        'title' => esc_html__('Social Icon', 'heal'),
                        'desc'  => esc_html__('Select an icon (e.g., Font Awesome)', 'heal'),
                    ),
                    array(
                        'id'    => 'social_url',
                        'type'  => 'text',
                        'title' => esc_html__('Social Media URL', 'heal'),
                        'desc'  => esc_html__('Enter the URL for the social media platform', 'heal'),
                    ),
                ),
            ),



            // Event Intro Title
            array(
                'id'    => 'event_video_title',
                'type'  => 'text',
                'title' => esc_html__('Event Video Title', 'heal'),
                'desc'  => esc_html__('Enter the title for the event video section (e.g., Started this Event:)', 'heal'),
                'placeholder' => esc_html__('Started this Event:', 'heal'),
                'dependency' => array( 'event_style', '==', 'single2' ),
            ),

            // YouTube Video Link
            array(
                'id'    => 'event_video_link',
                'type'  => 'text',
                'title' => esc_html__('Event YouTube Video Link', 'heal'),
                'desc'  => esc_html__('Add the YouTube link to be displayed in the video button', 'heal'),
                'placeholder' => esc_html__('https://www.youtube.com/watch?v=example', 'heal'),
                'dependency' => array( 'event_style', '==', 'single2' ),
            ),

            // ➕ New: YouTube Thumbnail Image
            array(
                'id'    => 'event_video_thumb',
                'type' => 'media',
                'title' => esc_html__('Event Video Thumbnail Image', 'heal'),
                'desc'  => esc_html__('Upload a thumbnail image for the event video section', 'heal'),
                'placeholder' => esc_html__('Upload Thumbnail Image', 'heal'),
                'dependency' => array( 'event_style', '==', 'single2' ),
            ),


            

            // Google Maps Embed URL for Venue Location
            array(
                'id'    => 'google_map_title',
                'type'  => 'text', 
                'title' => esc_html__('Google Maps Title', 'heal'),
                'desc'  => esc_html__('Google Maps Title Text Here.', 'heal'),
                'placeholder' => esc_html__('Google Maps Title', 'heal'),
                'dependency' => array( 'event_style', '==', 'single2' ),
            ),
            array(
                'id'    => 'google_map_embed',
                'type'  => 'textarea', 
                'title' => esc_html__('Google Maps Embed URL', 'heal'),
                'desc'  => esc_html__('Paste only the iframe "src" URL from Google Maps embed code.', 'heal'),
                'placeholder' => esc_html__('https://www.google.com/maps/embed?pb=...', 'heal'),
                'dependency' => array( 'event_style', '==', 'single2' ),
            ),

            // Style 3
            array(
                'id'    => 'event_donate_percent',
                'type'  => 'text',
                'title' => esc_html__('Event Donate %', 'heal'),
                'desc'  => esc_html__('Enter the event donate %', 'heal'),
                'placeholder' => esc_html__('Event Donate %', 'heal'),
                'dependency' => array( 'event_style', '==', 'single3' ),
            ),
        )
    ));

    // Hafsa
    CSF::createSection( $prefix . '_event_options', array(
        'title'      => esc_html__( 'Hafsa Event Settings', 'heal' ),
        'fields'     => array(
            array(
                'id'    => 'hafsa_event_Date',
                'type'  => 'date',
                'title' => esc_html__( 'Hafsa Event Date', 'heal' ),
                'desc'  => esc_html__( 'choose your event date', 'heal' ),
            ),
            array(
                'id'    => 'hafsa_event_location',
                'type'  => 'text',
                'title' => esc_html__( 'Hafsa Event Location', 'heal' ),
            ),
        ),
    ) );


























    //	Cause Meta Box
    CSF::createMetabox($prefix . '_cause_options', array(
        'title' => esc_html__('Causes Section Settings', 'heal'),
        'post_type' => 'cause',
    ));

    CSF::createSection($prefix . '_cause_options', array(
        // 'title' => esc_html__('Cause Field Option', 'heal'),
        'id' => 'cause-info',
        'fields' => array(
            array(
                'id' => 'currency_symbol',
                'type' => 'text',
                'title' => esc_html__('Currency Symbol', 'heal'),
                'default' => esc_html__('$', 'heal'),
            ),
            array(
                'id' => 'donation_goal',
                'type' => 'text',
                'title' => esc_html__('Donation Goal', 'heal'),
                'default' => esc_html__('1,00,000', 'heal'),
            ),
            array(
                'id' => 'donation_manually',
                'type' => 'text',
                'title' => esc_html__('Donate Manually', 'heal'),
                'default' => esc_html__('10,000', 'heal'),
            ),
            array(
                'id' => 'donation_paypal',
                'type' => 'text',
                'title' => esc_html__('PayPal', 'heal'),
            ),
            array(
                'id' => 'donation_bdt',
                'type' => 'textarea',
                'title' => esc_html__('Direct Bank Transfer', 'heal'),
            ),
            array(
                'id' => 'donation_cp',
                'type' => 'textarea',
                'title' => esc_html__('Check Payment', 'heal'),
            ),
            array(
                'id' => 'donation_link',
                'type' => 'text',
                'title' => esc_html__('Custom URL/WooCommerce Product link', 'heal'),
            ),
        )
    ));
}//endif