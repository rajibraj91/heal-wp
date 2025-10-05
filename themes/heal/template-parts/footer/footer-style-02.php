<?php
/**
 * Footer Style 03 For HomePage 3
 * @package heal
 * @since 1.0.0
 */

// Background
$footer_bg = cs_get_option('footer_3_bg_color');

// Contact Info
$contact_title   = cs_get_option('footer_3_contact_title');
$contact_address = cs_get_option('footer_3_address');
$contact_email   = cs_get_option('footer_3_email');
$contact_phone   = cs_get_option('footer_3_phone');

// Services & Useful Links
$service_title = cs_get_option('service_widget_title');
$services_links = cs_get_option('footer_3_services');
$usefull_title   = cs_get_option('usefull_widget_title');
$useful_links   = cs_get_option('footer_3_useful_links');

// Gallery
$gallery_title = cs_get_option('gallery_widget_title');
// $gallery_images = cs_get_option('footer_3_gallery');

// Footer Bottom
$bottom_links   = cs_get_option('footer_3_bottom_links');
$social_icons   = cs_get_option('footer_3_socials');

// Dynamic replacements
// $copyright_text = str_replace('{year}', date('Y'), $copyright_text);
// $copyright_text = str_replace('{copy}', '&copy;', $copyright_text);




// Set default copyright text with placeholders
$default_copyright = 'Copyright {copy} {year} <b>Heal</b>. All Rights Reserved.';
$copyright_raw = cs_get_option('footer_3_copyright_text') ?: $default_copyright;
$copyright_text = str_replace(
    ['{copy}', '{year}'],
    ['&copy;', date('Y')],
    $copyright_raw
);


?>

<footer class="footer 2">
    <div class="footer__top padding--top padding--bottom">
        <div class="container">
            <div class="row g-4 justify-content-center">

                <div class="col-lg-3 col-sm-6 col-12">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    <?php endif; ?>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    <?php endif; ?>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-4' ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer__bottom" <?php if (! in_array( 'heal-core/heal-core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?> style="background-color: #f9f9f9;" <?php endif; ?>>
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6 col-12">
                    <div class="footer__copyright">
                        <p <?php if (empty($footer_socials)) : ?> style="text-align: center;"<?php endif; ?>><?php echo wp_kses($copyright_text, heal()->kses_allowed_html(['a', 'b', 'strong', 'em'])); ?></p>
                    </div>
                </div>

                <?php if (!empty($footer_socials)) : ?>
                    <div class="col-lg-6 col-12">
                        <div class="footer__social">
                            <ul>
                                <?php
                                    foreach ($footer_socials as $social_item) :
                                    $social_icon = !empty($social_item['icon']) ? $social_item['icon'] : 'fab fa-facebook-f';
                                    $social_url = !empty($social_item['url']) ? $social_item['url'] : '#';
                                ?>
                                    <li><a href="<?php echo esc_url($social_url); ?>"><i class="<?php echo esc_attr($social_icon); ?>"></i></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>