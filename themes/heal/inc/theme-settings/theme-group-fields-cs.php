<?php
/**
 *Theme Group Fields
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // exit if access directly
}


if (!class_exists('Heal_Group_Fields')) {

    class Heal_Group_Fields
    {
        
        /**
         * $instance
         * @since 1.0.0
         */
        private static $instance;


        /**
         * construct()
         * @since 1.0.0
         */
        public function __construct()
        {

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
         * Page layout options
         * @since 1.0.0
         */
        public static function page_layout()
        {
            $fields = array(
                array(
                    'type' => 'subheading',
                    'content' => esc_html__('Page Layouts & Colors Options', 'heal'),
                ),
                array(
                    'id' => 'page_layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Select Page Layout', 'heal'),
                    'options' => array(
                        'default' => HEAL_THEME_SETTINGS_IMAGES . '/page/default.png',
                        'left-sidebar' => HEAL_THEME_SETTINGS_IMAGES . '/page/left-sidebar.png',
                        'right-sidebar' => HEAL_THEME_SETTINGS_IMAGES . '/page/right-sidebar.png',
                        'blank' => HEAL_THEME_SETTINGS_IMAGES . '/page/blank.png',
                    ),
                    'default' => 'default'
                ),
                array(
                    'id' => 'page_bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Background Color', 'heal'),
                    'default' => ''
                ),
                array(
                    'id' => 'page_content_bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Content Background Color', 'heal'),
                    'default' => ''
                ),
                array(
                    'id' => 'page_content_text_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Content Text Color', 'heal'),
                    'default' => ''
                )

            );

            return $fields;
        }

        /**
         * Page container options
         * @since 1.0.0
         */
        public static function Page_Container_Options($type)
        {
            $fields = array();
            $allowed_html = heal()->kses_allowed_html(array('mark'));
            if ('header_options' == $type) {
                $fields = array(
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Header, Footer & Breadcrumb Options', 'heal'),
                    ),
                    array(
                        'id' => 'page_title',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Title', 'heal'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show/hide page title.', 'heal'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'heal'),
                        'text_off' => esc_html__('No', 'heal'),
                        'default' => true
                    ),
                    array(
                        'id' => 'page_breadcrumb',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Breadcrumb', 'heal'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show/hide page breadcrumb.', 'heal'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'heal'),
                        'text_off' => esc_html__('No', 'heal'),
                        'default' => true
                    ),
                    array(
                        'id' => 'navbar_type',
                        'title' => esc_html__('Navbar Type', 'heal'),
                        'type' => 'image_select',
                        'options' => array(
                            '' => HEAL_THEME_SETTINGS_IMAGES . '/header/01.png',
                            'style-01' => HEAL_THEME_SETTINGS_IMAGES . '/header/02.png',
                            'style-02' => HEAL_THEME_SETTINGS_IMAGES . '/header/03.png',
                            'style-03' => HEAL_THEME_SETTINGS_IMAGES . '/header/04.png',
                        ),
                        'default' => '',
                        'desc' => wp_kses(__('you can set <mark>navbar type</mark> transparent type or solid background.', 'heal'), $allowed_html),
                    ),
                    array(
                        'id' => 'footer_type',
                        'title' => esc_html__('Footer Type', 'heal'),
                        'type' => 'image_select',
                        'options' => array(
                            '' => HEAL_THEME_SETTINGS_IMAGES . '/footer/01.png',
                            'style-01' => HEAL_THEME_SETTINGS_IMAGES . '/footer/02.png',
                            'style-02' => HEAL_THEME_SETTINGS_IMAGES . '/footer/03.png',
                            // 'style-03' => HEAL_THEME_SETTINGS_IMAGES . '/footer/04.png',
                            // 'style-04' => HEAL_THEME_SETTINGS_IMAGES . '/footer/rtl.png',
                            // 'style-05' => HEAL_THEME_SETTINGS_IMAGES . '/footer/05.png',
                        ),
                        'default' => '',
                        'desc' => wp_kses(__('you can set <mark>footer type</mark> transparent type or solid background.', 'heal'), $allowed_html),
                    ),

                );
            } elseif ('container_options' == $type) {
                $fields = array(
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Width & Padding Options', 'heal'),
                    ),
                    array(
                        'id' => 'page_container',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Full Width', 'heal'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to set page container full width.', 'heal'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'heal'),
                        'text_off' => esc_html__('No', 'heal'),
                        'default' => false
                    ),
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Spacing Options', 'heal'),
                    ),
                    array(
                        'id' => 'page_spacing_top',
                        'title' => esc_html__('Page Spacing Top', 'heal'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page container.', 'heal'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 120,
                    ),
                    array(
                        'id' => 'page_spacing_bottom',
                        'title' => esc_html__('Page Spacing Bottom', 'heal'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page container.', 'heal'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 120,
                    ),
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Content Spacing Options', 'heal'),
                    ),
                    array(
                        'id' => 'page_content_spacing',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Content Spacing', 'heal'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to set page content spacing.', 'heal'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'heal'),
                        'text_off' => esc_html__('No', 'heal'),
                        'default' => false
                    ),
                    array(
                        'id' => 'page_content_spacing_top',
                        'title' => esc_html__('Page Spacing Bottom', 'heal'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page content area.', 'heal'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                    array(
                        'id' => 'page_content_spacing_bottom',
                        'title' => esc_html__('Page Spacing Bottom', 'heal'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.', 'heal'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                    array(
                        'id' => 'page_content_spacing_left',
                        'title' => esc_html__('Page Spacing Left', 'heal'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Left</mark> for page content area.', 'heal'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                    array(
                        'id' => 'page_content_spacing_right',
                        'title' => esc_html__('Page Spacing Right', 'heal'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Right</mark> for page content area.', 'heal'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                );
            }

            return $fields;
        }


        /**
         * Page layout options
         * @since 1.0.0
         */
        public static function page_layout_options($title, $prefix)
        {
            $allowed_html = heal()->kses_allowed_html(array('mark'));
            $fields = array(
                array(
                    'type' => 'subheading',
                    'content' => '<h3>' . $title . esc_html__(' Page Options', 'heal') . '</h3>',
                ),
                array(
                    'id' => $prefix . '_layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Select Page Layout', 'heal'),
                    'options' => array(
                        'right-sidebar' => HEAL_THEME_SETTINGS_IMAGES . '/page/right-sidebar.png',
                        'left-sidebar' => HEAL_THEME_SETTINGS_IMAGES . '/page/left-sidebar.png',
                        'no-sidebar' => HEAL_THEME_SETTINGS_IMAGES . '/page/no-sidebar.png',
                    ),
                    'default' => 'right-sidebar'
                ),
                array(
                    'id' => $prefix . '_bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Background Color', 'heal'),
                    'default' => ''
                ),
                array(
                    'id' => $prefix . '_spacing_top',
                    'title' => esc_html__('Page Spacing Top', 'heal'),
                    'type' => 'slider',
                    'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page content area.', 'heal'), $allowed_html),
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                    'unit' => 'px',
                    'default' => 120,
                ),
                array(
                    'id' => $prefix . '_spacing_bottom',
                    'title' => esc_html__('Page Spacing Bottom', 'heal'),
                    'type' => 'slider',
                    'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.', 'heal'), $allowed_html),
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                    'unit' => 'px',
                    'default' => 120,
                ),
            );

            return $fields;
        }

        /**
         * Post meta
         * @since 1.0.0
         */
        public static function post_meta($prefix, $title)
        {
            $allowed_html = heal()->kses_allowed_html(array('mark'));
            $fields = array(
                array(
                    'type' => 'subheading',
                    'content' => '<h3>' . $title . esc_html__(' Post Options', 'heal') . '</h3>',
                ),
                // array(
                //     'id' => $prefix . '_posted_meta',
                //     'type' => 'switcher',
                //     'title' => esc_html__('Post Meta', 'heal'),
                //     'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted meta.', 'heal'), $allowed_html),
                //     'text_on' => esc_html__('Yes', 'heal'),
                //     'text_off' => esc_html__('No', 'heal'),
                //     'default' => true
                // ),
                // array(
                //     'id' => $prefix . '_posted_by',
                //     'type' => 'switcher',
                //     'title' => esc_html__('Posted By', 'heal'),
                //     'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted by.', 'heal'), $allowed_html),
                //     'text_on' => esc_html__('Yes', 'heal'),
                //     'text_off' => esc_html__('No', 'heal'),
                //     'default' => true,
                //     'dependency' => array($prefix . '_posted_meta', '==', 'true'),
                // ),
            );

            if ('blog_post' == $prefix) {
                $fields[] = array(
                    'id' => $prefix . '_posted_meta',
                    'type' => 'switcher',
                    'title' => esc_html__('Post Meta', 'heal'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted meta.', 'heal'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'heal'),
                    'text_off' => esc_html__('No', 'heal'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_posted_by',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted By', 'heal'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted by.', 'heal'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'heal'),
                    'text_off' => esc_html__('No', 'heal'),
                    'default' => true,
                    'dependency' => array($prefix . '_posted_meta', '==', 'true'),
                );
                $fields[] = array(
                    'id' => $prefix . '_posted_date',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted Date', 'heal'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted date.', 'heal'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'heal'),
                    'text_off' => esc_html__('No', 'heal'),
                    'default' => true,
                    'dependency' => array($prefix . '_posted_meta', '==', 'true'),
                );
                $fields[] = array(
                    'id' => $prefix . '_posted_icon',
                    'type' => 'switcher',
                    'title' => esc_html__('Format Icon', 'heal'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide format icon.', 'heal'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'heal'),
                    'text_off' => esc_html__('No', 'heal'),
                    'default' => true,
                    'dependency' => array($prefix . '_posted_meta', '==', 'true'),
                );
                $fields[] = array(
                    'id' => $prefix . '_posted_comment',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted Comment', 'heal'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted comment.', 'heal'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'heal'),
                    'text_off' => esc_html__('No', 'heal'),
                    'default' => true,
                    'dependency' => array($prefix . '_posted_meta', '==', 'true'),
                );
                $fields[] = array(
                    'id' => $prefix . '_readmore_btn',
                    'type' => 'switcher',
                    'title' => esc_html__('Read More Button', 'heal'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide read more button.', 'heal'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'heal'),
                    'text_off' => esc_html__('No', 'heal'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_readmore_btn_text',
                    'type' => 'text',
                    'title' => esc_html__('Read More Text', 'heal'),
                    'desc' => wp_kses(__('you can set read more <mark>button text</mark> to button text.', 'heal'), $allowed_html),
                    'default' => esc_html__('Read More', 'heal'),
                    'dependency' => array($prefix . '_readmore_btn', '==', 'true')
                );
                // $fields[] = array(
                //     'id' => $prefix . '_excerpt_more',
                //     'type' => 'text',
                //     'title' => esc_html__('Excerpt More', 'heal'),
                //     'desc' => wp_kses(__('you can set read more <mark>button text</mark> to button text.', 'heal'), $allowed_html),
                //     'attributes' => array(
                //         'placeholder' => esc_html__('....', 'heal')
                //     )
                // );
                $fields[] = array(
                    'id' => $prefix . '_excerpt_length',
                    'type' => 'select',
                    'options' => array(
                        '25' => esc_html__('Short', 'heal'),
                        '55' => esc_html__('Regular', 'heal'),
                        '100' => esc_html__('Long', 'heal'),
                    ),
                    'title' => esc_html__('Excerpt Length', 'heal'),
                    'desc' => wp_kses(__('you can set <mark> excerpt length</mark> for post.', 'heal'), $allowed_html),
                );
            } elseif ('blog_single_post' == $prefix) {

                // $fields[] = array(
                //     'id' => $prefix . '_posted_category',
                //     'type' => 'switcher',
                //     'title' => esc_html__('Posted Category', 'heal'),
                //     'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted category.', 'heal'), $allowed_html),
                //     'text_on' => esc_html__('Yes', 'heal'),
                //     'text_off' => esc_html__('No', 'heal'),
                //     'default' => true
                // );
                // $fields[] = array(
                //     'id' => $prefix . '_post_date',
                //     'type' => 'switcher',
                //     'title' => esc_html__('Posted Date', 'heal'),
                //     'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post date.', 'heal'), $allowed_html),
                //     'text_on' => esc_html__('Yes', 'heal'),
                //     'text_off' => esc_html__('No', 'heal'),
                //     'default' => true
                // );
                $fields[] = array(
                    'id' => $prefix . '_posted_tag',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted Tags', 'heal'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post tags.', 'heal'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'heal'),
                    'text_off' => esc_html__('No', 'heal'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_posted_share',
                    'type' => 'switcher',
                    'title' => esc_html__('Post Share', 'heal'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post share.', 'heal'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'heal'),
                    'text_off' => esc_html__('No', 'heal'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_comment',
                    'type' => 'switcher',
                    'title' => esc_html__('Page Comment', 'heal'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post single comment.', 'heal'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'heal'),
                    'text_off' => esc_html__('No', 'heal'),
                    'default' => true
                );
            }

            return $fields;
        }

    }//end class

}//end if

