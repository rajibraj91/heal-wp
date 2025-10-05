<?php
/**
 * Footer Style For HomePage 2 Footer
 * @package heal
 * @since 1.0.0
*/

$footer_bg         = cs_get_option('footer_2_bg');
$section_title     = cs_get_option('footer_2_section_title');
$logo              = cs_get_option('footer_2_logo');
$description       = cs_get_option('footer_2_description');
$contact_info      = cs_get_option('footer_2_contact_info');
$widgets           = cs_get_option('footer_2_widgets');

$get_in_touch_enabled = cs_get_option('footer_2_get_in_touch_enable');
$get_in_touch_title   = cs_get_option('footer_2_get_in_touch_title');
$get_in_touch_items   = cs_get_option('footer_2_get_in_touch');


$newsletter_title  = cs_get_option('footer_2_newsletter_title');
$newsletter_desc   = cs_get_option('footer_2_newsletter_description');
$newsletter_form   = cs_get_option('footer_2_newsletter_shortcode');

$bottom_links      = cs_get_option('footer_2_bottom_links');
$footer_socials           = cs_get_option('footer_2_socials');
$theme_socials             = cs_get_option('theme_socials');

// Set default copyright text with placeholders
$default_copyright = 'Copyright {copy} {year} <b>Heal</b>. All Rights Reserved.';
$copyright_raw = cs_get_option('footer_2_copyright') ?: $default_copyright;
$copyright_text = str_replace(
    ['{copy}', '{year}'],
    ['&copy;', date('Y')],
    $copyright_raw
);


?>



<?php if (!empty($theme_socials)) : ?>
    <div class="social-section">
        <div class="container">
            <div class="social">
                <ul>
                    <?php
                        foreach ($theme_socials as $social_item) :
                        $social_name = !empty($social_item['name']) ? $social_item['name'] : 'facebook';
                        $social_icon = !empty($social_item['icon']) ? $social_item['icon'] : 'fab fa-facebook-f';
                        $social_url = !empty($social_item['url']) ? $social_item['url'] : '#';
                    ?>
                    <li class="social__list"><a href="<?php echo esc_url($social_url); ?>" class="social__name social-<?php echo esc_attr(strtolower($social_name)); ?>"><span class="social__icon"><i class="<?php echo esc_attr($social_icon); ?>"></i></span> <span><?php echo esc_html($social_name); ?></span></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>



<footer class="footer footer--style2">
    <?php if (! in_array( 'heal-core/heal-core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
        <div class="footer__top padding--top padding--bottom">
            <div class="container">
                <div class="row g-4 justify-content-center">

                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <?php dynamic_sidebar( 'footer-1' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <?php dynamic_sidebar( 'footer-2' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <?php dynamic_sidebar( 'footer-3' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <?php dynamic_sidebar( 'footer-4' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

   




    <div class="footer__bottom" <?php if (! in_array( 'heal-core/heal-core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?> style="background-color: #f9f9f9;" <?php endif; ?>>
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="footer__bottom--area">
                    <div class="footer__copyright">
                        <p <?php if (empty($bottom_links)) : ?> style="text-align: center;"<?php endif; ?>><?php echo wp_kses($copyright_text, heal()->kses_allowed_html(['a', 'b', 'strong', 'em'])); ?></p>
                    </div>

                    <?php if (!empty($bottom_links)) : ?>
                        <div class="footer__link">
                            <ul>
                                <?php
                                    foreach ($bottom_links as $item) :
                                    $text = !empty($item['text']) ? $item['text'] : 'Home';
                                    $url = !empty($item['url']) ? $item['url'] : '#';
                                ?>
                                    <li><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($text); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>