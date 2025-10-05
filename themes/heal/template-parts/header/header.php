<?php
/**
 * Header Style One Template
 * @package heal
 * @since 1.0.0
 */

// Theme options data
$header_one_logo             = cs_get_option('header_one_logo');
$header_one_logo_black       = cs_get_option('header_one_logo_black');
$header_one_search_enabled   = cs_get_option('header_one_search_enabled');
$header_one_right_btn_text   = cs_get_option('header_one_right_btn_text');
$header_one_right_btn_url    = cs_get_option('header_one_right_btn_url');
$header_one_right_btn_enabled = cs_get_option('header_one_right_btn_enabled');
$header_default_cart_btn_enabled = cs_get_option('header_default_cart_btn_enabled');
$sticky_header_enabled       = cs_get_option('sticky_header_enabled');


?>


<header class="header" id="header" data-sticky="<?php echo esc_attr($sticky_header_enabled ? 'true' : 'false'); ?>">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <?php
                if ( has_custom_logo() && empty($header_one_logo['url']) ) {
                    the_custom_logo();
                } elseif ( !empty($header_one_logo['url']) ) {
                    echo '<a href="' . esc_url(home_url('/')) . '" class="header-logo">';
                    echo '<img src="' . esc_url($header_one_logo['url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                    echo '</a>';

                    if ( !empty($header_one_logo_black['url']) ) {
                        echo '<a href="' . esc_url(home_url('/')) . '" class="header-logo-2">';
                        echo '<img src="' . esc_url($header_one_logo_black['url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                        echo '</a>';
                    }
                } else {
                    echo '<a href="' . esc_url(home_url('/')) . '" class="site-title">';
                    echo esc_html(get_bloginfo('name'));
                    echo '</a>';
                }
            ?>
            
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler--icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
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

                <?php if ( $header_one_right_btn_enabled ): ?>
                    <a href="<?php echo esc_url($header_one_right_btn_url); ?>" class="default-btn move-right"><span><?php echo esc_html($header_one_right_btn_text); ?> <i class="fas fa-heart"></i></span></a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>