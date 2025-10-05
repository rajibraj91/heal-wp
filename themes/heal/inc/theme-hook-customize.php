<?php
/**
 * Theme Hooks Customize
 * @package heal
 * @since 1.0.0
 */

if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Heal_Customize')) {

    class Heal_Customize
    {
        /**
         * $instance
         * @since 1.0.0
         */
        protected static $instance;

        public function __construct()
        {
            //excerpt more
            add_action('excerpt_more', array($this, 'excerpt_more'));
            //search popup
            add_action('heal_after_body', array($this, 'search_popup'));
            //breadcrumb
            add_action('heal_before_page_content', array($this, 'breadcrumb'));      
            //order comment form
            add_filter('comment_form_fields', array($this, 'comment_fields_reorder'));
            // contact form 7
            add_filter('wpcf7_autop_or_not', '__return_false');
            //mouse move
            add_action('heal_after_body', array($this, 'mouse_move'));
            // theme_preloader
            add_action('heal_after_body', array($this, 'theme_preloader'));
             // sidebar
             add_action('heal_after_body', array($this, 'menu_sidebar'));
            
        }

        /**
         * getInstance()
         * @since 1.0.0
         */
        public static function getInstance()
        {
            if (null == self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Excerpt More
         * @since 1.0.0
         */
        public function excerpt_more($more)
        {
            $more = cs_get_option('blog_post_excerpt_more');
            return $more;
        }

        /**
         * Breadcrumb
         * @since 1.0.0
         */
        public function breadcrumb()
        {
            $page_id = heal()->page_id();
            $check_page = (!is_home() && !is_front_page() && is_singular()) || is_search() || is_author() || is_404() || is_archive();
            $check_home_page = heal()->is_home_page();
            $page_header_meta = Heal_Group_Fields_Value::page_container('heal', 'header_options');

            $page_breadcrumb_enable = isset($page_header_meta['page_breadcrumb_enable']) && $page_header_meta['page_breadcrumb_enable'];
            $breadcrumb_enable = false;

            if (!$check_home_page && !$check_page) {
                $breadcrumb_enable = true;
            } elseif (!$page_breadcrumb_enable && $check_page) {
                $breadcrumb_enable = true;
            }

            $breadcrumb_enable = !cs_get_switcher_option('breadcrumb_enabled') ? false : $breadcrumb_enable;

            // Only fetch images if breadcrumb is enabled
            if (!$breadcrumb_enable) {
                return;
            }

            // Safely fetch images AFTER breadcrumb check
            $breadcrumb_main_image = cs_get_option('breadcrumb_main_image');
            $breadcrumb_bg_url = (is_array($breadcrumb_main_image) && !empty($breadcrumb_main_image['url'])) ? esc_url($breadcrumb_main_image['url']) : '';

            ?>
            <!-- ================> Page Header section start here <================== -->
            <div class="pageheader-section wow fadeInUp" data-wow-delay=".3s" <?php if(!empty($breadcrumb_bg_url)) : ?> style="background: url('<?php echo esc_url($breadcrumb_bg_url); ?>');" <?php endif; ?>>
                <div class="container">
                    <div class="pageheader">
                        <div class="pageheader__title">
                            <?php
                                $title_class = 'wow fadeInUp';
                                if ( !empty($breadcrumb_bg_url) ) {
                                    $title_class .= ' text-white';
                                }
                            ?>
                            <?php
                                if (is_archive()) {
                                    if (class_exists('WooCommerce') && is_shop()) {
                                        printf('<h1 class="%1$s" data-wow-delay=".3s">%2$s</h1>', esc_attr($title_class), str_replace("Archives: ", "", get_the_archive_title()));
                                    } else {
                                        the_archive_title('<h1 class="'.esc_attr($title_class).'" data-wow-delay=".3s">', '</h1>');
                                    }
                                } elseif (is_404()) {
                                    printf('<h1 class="%1$s" data-wow-delay=".3s">%2$s</h1>', esc_attr($title_class), esc_html__('Error 404', 'heal'));
                                } elseif (is_search()) {
                                    printf('<h1 class="%1$s" data-wow-delay=".3s">%2$s %3$s</h1>', esc_attr($title_class), esc_html__('Search Results for:', 'heal'), get_search_query());
                                } elseif (is_singular('post') || is_singular('page')) {
                                    printf('<h1 class="%1$s" data-wow-delay=".3s">%2$s</h1>', esc_attr($title_class), get_the_title());
                                } else {
                                    printf('<h1 class="%1$s" data-wow-delay=".3s">%2$s</h1>', esc_attr($title_class), get_the_title($page_id));
                                }
                            ?>
                        </div>

                        <div class="pageheader__breadcamp">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'heal'); ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?php
                                            if (is_archive()) {
                                                echo wp_kses_post(get_the_archive_title());
                                            } elseif (is_404()) {
                                                esc_html_e('404 Page', 'heal');
                                            } elseif (is_search()) {
                                                echo esc_html(get_search_query());
                                            } else {
                                                the_title();
                                            }
                                        ?>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ================> Page Header section end here <================== -->
            <?php
        }



        /**
         * Preloader
         * @since 1.0.0
         */
        public function preloader()
        {
            $preloader_enable = cs_get_switcher_option('preloader_enable');
            if ( '1' == cs_get_option( 'enable_preloader', true ) ) {
                get_template_part( 'template-parts/preloader' );
            }
            ?>
            <?php
        }

           /**
         * Mouse Move
         * @since 1.0.0
         */
        public function mouse_move()
        {
            ?>
              <!--<< Mouse Cursor Start >>-->  
              <div class="mouseCursor cursor-outer"></div>
              <div class="mouseCursor cursor-inner"></div>
            <?php
        } 
        
           /**
         * Theme Preloader
         * @since 1.0.0
         */
        public function theme_preloader()
        {
            $preloader_enable = cs_get_option('preloader_enable'); 
            
            if ($preloader_enable == 1) {
                get_template_part('template-parts/preloader');
            }
        }


        /**
         * Menu Sidebar
         * @since 1.0.0
        */

        public function menu_sidebar()
        {
            $sidebar_logo = cs_get_option('sidebar_logo');
            $sidebar_text = cs_get_option('sidebar_text');
            $sidebar_contact_info = cs_get_option('sidebar_contact_info');
            $sidebar_btn_enabled = cs_get_option('sidebar_btn_enabled');
            $sidebar_btn_text = cs_get_option('sidebar_btn_text');
            $sidebar_btn_text_url = cs_get_option('sidebar_btn_text_url');
            $sidebar_socials = cs_get_option('sidebar_socials');
            $sidebar_title = cs_get_option('sidebar_title');
            ?>
            <div class="fix-area d-none">
                <div class="offcanvas__info">
                    <div class="offcanvas__wrapper">
                        <div class="offcanvas__content">
                            <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                                <div class="offcanvas__logo">
                                    <?php
                                    if (!empty($sidebar_logo['url'])) {
                                        printf(
                                            '<a href="%1$s"><img src="%2$s" alt="%3$s"></a>',
                                            esc_url(get_home_url()),
                                            esc_url($sidebar_logo['url']),
                                            esc_attr($sidebar_logo['alt'] ?? '')
                                        );
                                    } else {
                                        printf('<a href="%1$s">%2$s</a>', esc_url(get_home_url()), esc_html(get_bloginfo('name')));
                                    }
                                    ?>
                                </div>
                                <div class="offcanvas__close">
                                    <button>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <p class="text d-none d-xl-block">
                                <?php echo esc_html($sidebar_text); ?>
                            </p>

                            <div class="mobile-menu fix mb-3"></div>

                            <div class="offcanvas__contact">
                                <?php if (!empty($sidebar_title)) : ?>
                                    <h4><?php echo esc_html($sidebar_title); ?></h4>
                                <?php endif; ?>
                                <ul>
                                    <?php
                                    if (!empty($sidebar_contact_info) && is_array($sidebar_contact_info)) {
                                        foreach ($sidebar_contact_info as $contact) {
                                            $icon = isset($contact['sidebar_contact_icon']) ? $contact['sidebar_contact_icon'] : '';
                                            $text = isset($contact['sidebar_contact_text']) ? $contact['sidebar_contact_text'] : '';
                                            $url = isset($contact['sidebar_contact_text_url']) ? $contact['sidebar_contact_text_url'] : '#';

                                            echo '<li class="d-flex align-items-center">';
                                            echo '<div class="offcanvas__contact-icon"><i class="' . esc_attr($icon) . '"></i></div>';
                                            echo '<div class="offcanvas__contact-text">';
                                            echo '<a href="' . esc_url($url) . '">' . esc_html($text) . '</a>';
                                            echo '</div></li>';
                                        }
                                    }
                                    ?>
                                </ul>

                                <?php if ($sidebar_btn_enabled): ?>
                                    <div class="header-button mt-4">
                                        <a href="<?php echo esc_url($sidebar_btn_text_url); ?>" class="default-btn move-right">
                                            <span class="gt-icon-btn"><i class="icon-icon-1"></i></span>
                                            <span class="gt-text-btn">
                                                <span class="gt-text-2"><?php echo esc_html($sidebar_btn_text); ?></span>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="social-icon d-flex align-items-center">
                                    <?php
                                    if (!empty($sidebar_socials) && is_array($sidebar_socials)) {
                                        foreach ($sidebar_socials as $social) {
                                            $icon = isset($social['sidebar_socials_icon']) ? $social['sidebar_socials_icon'] : '';
                                            $url = isset($social['sidebar_socials_icon_url']) ? $social['sidebar_socials_icon_url'] : '#';

                                            echo '<a href="' . esc_url($url) . '"><i class="' . esc_attr($icon) . '"></i></a>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas__overlay"></div>
            <?php
        }

        
        /**
         * Reorder comments form
         * @since 1.0.0
         */
        public function comment_fields_reorder($fileds)
        {
            $comment_filed = $fileds['comment'];
            unset($fileds['comment']);
            $fileds['comment'] = $comment_filed;

            if (isset($fileds['cookies'])) {
                $comment_cookies = $fileds['cookies'];
                unset($fileds['cookies']);
                $fileds['cookies'] = $comment_cookies;
            }

            return $fileds;
        }

        /**
         * @since 1.0.0
         * Search Popup
         */
        public function search_popup()
        {
            ?>
         


            <div class="search-popup">
                <div class="search-popup__overlay"></div>
                <div class="search-popup__content">
                    <form role="search" method="get" class="search-popup__form" action="<?php echo esc_url(home_url('/')) ?>">
                        <input type="text" id="search" name="search" placeholder="<?php echo esc_attr__('Search....', 'heal'); ?>">
                        <button type="submit" aria-label="search submit" class="search-btn">
                            <span><i class="fa-solid fa-magnifying-glass"></i></span>
                        </button>
                    </form>
                </div>
            </div>

            
            <?php
        }

    

    }//end class
    if (class_exists('Heal_Customize')) {
        Heal_Customize::getInstance();
    }
}
