<?php
/**
 * Header Style 2
 * @package heal
 * @since 1.0.0
 */
?>

<?php
// Get theme options for Header 2
$header_two_logo = cs_get_option('header_two_logo');


$header_two_right_btn_enabled = cs_get_option('header_two_right_btn_enabled');
$header_two_right_btn_icon = cs_get_option('header_two_right_btn_icon');
$header_two_right_btn_text = cs_get_option('header_two_right_btn_text');
$header_two_right_btn_url = cs_get_option('header_two_right_btn_url');

$header_two_search_enabled = cs_get_option('header_two_search_enabled');
$header_two_top_bar_enabled = cs_get_option('header_two_top_bar_enabled');
$header_2_top_bar_contacts = cs_get_option('header_2_top_bar_contacts');
$header_2_top_bar_socials = cs_get_option('header_2_top_bar_socials');
$header_two_bottom_bar_bg = cs_get_option('header_two_bottom_bar_bg');

$header_default_two_cart_btn_enabled = cs_get_option('header_default_two_cart_btn_enabled');
$sticky_header_enabled       = cs_get_option('sticky_header_enabled');


?>



<div class="hafsa-header">
    <header class="header-3 pattern-1" id="header" data-sticky="<?php echo esc_attr($sticky_header_enabled ? 'true' : 'false'); ?>">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-3 col-12">
                    <div class="mobile-menu-wrapper d-flex flex-wrap align-items-center justify-content-between">
                        <div class="header-bar d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="logo">
                            <?php
                                if ( has_custom_logo() && empty($header_two_logo['url']) ) {
                                    the_custom_logo();
                                } elseif ( !empty($header_two_logo['url']) ) {
                                    echo '<a href="' . esc_url(home_url('/')) . '" class="header-logo">';
                                    echo '<img src="' . esc_url($header_two_logo['url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                                    echo '</a>';
                                } else {
                                    echo '<a href="' . esc_url(home_url('/')) . '" class="site-title">';
                                    echo esc_html(get_bloginfo('name'));
                                    echo '</a>';
                                }
                            ?>
                        </div>

                        <div class="ellepsis-bar d-lg-none">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-12">
                    <?php if ($header_two_top_bar_enabled): ?>
                        <div class="header-top">
                            <div class="header-top-area">
                                <ul class="left lab-ul">
                                    <?php foreach ($header_2_top_bar_contacts as $contact): ?>
                                        <li>
                                            <?php if (isset($contact['header_2_top_bar_icon'])): ?>
                                                <i class="<?php echo esc_attr($contact['header_2_top_bar_icon']); ?>"></i>
                                            <?php endif; ?>

                                            <?php if (isset($contact['header_2_top_bar_info'])): ?>
                                                <span>
                                                    <?php
                                                        if(!empty($contact['header_2_top_bar_info_url'])) {
                                                            ?>
                                                                <a href="<?php echo esc_url($contact['header_2_top_bar_info_url']); ?>" class="link"><?php echo esc_html($contact['header_2_top_bar_info']); ?></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <?php echo esc_html($contact['header_2_top_bar_info']); ?>
                                                            <?php
                                                        }
                                                    ?>
                                                </span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <?php if ($header_2_top_bar_socials): ?>
                                    <ul class="social-icons lab-ul d-flex">
                                        <?php foreach ($header_2_top_bar_socials as $social): ?>
                                            <?php if (!empty($social['header_2_top_bar_socials_icon']) && !empty($social['header_2_top_bar_socials_icon_url'])): ?>
                                                <li>
                                                    <a href="<?php echo esc_url($social['header_2_top_bar_socials_icon_url']); ?>" target="_blank" rel="noopener noreferrer"><i class="<?php echo esc_attr($social['header_2_top_bar_socials_icon']); ?>"></i></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="header-bottom" <?php if(!empty($header_two_bottom_bar_bg)) : ?> style="background: <?php echo esc_attr($header_two_bottom_bar_bg); ?>" <?php endif; ?>>
                        <div class="header-wrapper">
                            <div class="menu-area justify-content-between w-100">
                                <!-- <div class="menu"> -->
                                    <?php
                                        wp_nav_menu([
                                            'theme_location' => 'main-menu',
                                            'container' => false,
                                            'menu_class' => 'menu lab-ul',
                                            // 'walker' => new \IMAddons\Admin\Nav_Menu_Walker(),
                                            'fallback_cb' => 'heal_theme_fallback_menu',  
                                        ]);
                                    ?>
                                <!-- </div> -->

                                <?php if ( $header_two_right_btn_enabled ): ?>
                                    <div class="prayer-time d-none d-lg-block">
                                        <a href="<?php echo esc_url($header_two_right_btn_url); ?>" class="prayer-time-btn" target="_blank"><span><i class="<?php echo esc_attr($header_two_right_btn_icon); ?>"></i><?php echo esc_html($header_two_right_btn_text); ?></span></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>