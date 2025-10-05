<?php
/**
 * Header Style 3
 * @package heal
 * @since 1.0.0
 */

// Theme Options
$header_4_logo = cs_get_option('header_4_logo');
$header_4_right_btn_enabled = cs_get_option('header_4_right_btn_enabled');
$header_4_right_btn_text = cs_get_option('header_4_right_btn_text');
$header_4_right_btn_url = cs_get_option('header_4_right_btn_url');

$header_4_top_bar_enabled = cs_get_option('header_4_top_bar_enabled');
$header_4_top_bg = cs_get_option('header_4_top_bg');
$header_4_top_bar_contacts = cs_get_option('header_4_top_bar_contacts');
$header_4_top_bar_socials = cs_get_option('header_4_top_bar_socials');
$sticky_header_enabled       = cs_get_option('sticky_header_enabled');

// Back to Top settings
$back_top_enable = cs_get_option('back_top_enable');
$back_top_icon = cs_get_option('back_top_icon');



?>



<header class="header header--style4" id="header" data-sticky="<?php echo esc_attr($sticky_header_enabled ? 'true' : 'false'); ?>">
    <?php if ($header_4_top_bar_enabled): ?>
        <div class="header__top" style="background-image: url('<?php echo esc_url($header_4_top_bg['url']); ?>');">
            <div class="container">
                <div class="header__top--area">
                    <div class="">
                        <?php if (!empty($header_4_logo['url'])): ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo">
                                <img src="<?php echo esc_url($header_4_logo['url']); ?>" alt="white-logo">
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($header_4_black_logo['url'])): ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo-2">
                                <img src="<?php echo esc_url($header_4_black_logo['url']); ?>" alt="black-logo">
                            </a>
                        <?php endif; ?>
                    </div>
                    <ul class="header__top--left">
                        <?php if (!empty($header_4_top_bar_contacts)) :
                            foreach ($header_4_top_bar_contacts as $contact) :
                                // Icon
                                $icon = !empty($contact['icon']) ? $contact['icon'] : 'fas fa-info';

                                // Label text
                                $label = !empty($contact['left_text']) ? $contact['left_text'] : '';

                                // Main text & link
                                $main_text = isset($contact['text']) ? $contact['text'] : '';
                                $link_type = isset($contact['link_type']) ? $contact['link_type'] : 'custom';
                                $custom_url = isset($contact['custom_url']) ? $contact['custom_url'] : '#';

                                // Determine URL
                                if ($link_type === 'email') {
                                    $url = 'mailto:' . sanitize_email($main_text);
                                } elseif ($link_type === 'phone') {
                                    $url = 'tel:' . preg_replace('/[^0-9\+]/', '', $main_text);
                                } else {
                                    $url = esc_url($custom_url);
                                }
                                ?>
                                <li>
                                    <i class="<?php echo esc_attr($icon); ?>"></i>
                                    <span>
                                        <?php echo esc_html($label); ?>:
                                        <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($main_text); ?></a>
                                    </span>
                                </li>
                            <?php endforeach;
                        endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>

    

    <div class="header__bottom">
        <div class="container">
            <nav class="navbar navbar-expand-lg">

                <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarNavAltMarkup">
                    <div class="menu">
                        <?php
                            wp_nav_menu([
                                'theme_location' => 'main-menu',
                                'container' => false,
                                'menu_class' => '',
                                // 'walker' => new \IMAddons\Admin\Nav_Menu_Walker(),
                                'fallback_cb' => 'heal_theme_fallback_menu',  
                            ]);
                        ?>
                    </div>

                    <div class="header__bottom--right">
                        <?php if ($header_4_right_btn_enabled): ?>
                            <a href="<?php echo esc_url($header_4_right_btn_url); ?>" class="default-btn move-right d-block">
                                <span><?php echo esc_html($header_4_right_btn_text); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
