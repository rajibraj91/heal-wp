<?php
/**
 * Footer Style - Custom GT Version
 * @package heal
 * @since 1.0.0
 */

// Retrieve theme options

$footer_socials             = cs_get_option('footer_1_socials');
$default_copyright = 'Copyright {copy} {year} <b>Heal</b>. All Rights Reserved.';
$copyright_raw = cs_get_option('footer_1_copyright') ?: $default_copyright;
$copyright_text = str_replace(
    ['{copy}', '{year}'],
    ['&copy;', date('Y')],
    $copyright_raw
);



?>



<footer class="footer">
    <div class="footer__bottom">
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


    