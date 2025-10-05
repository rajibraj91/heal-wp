<?php
/**
 * Theme Shortcodes Generator
 * @package heal
 * @since 1.0.0
 */

if (!defined('ABSPATH')){
	exit(); //exit if access it directly
}

// Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {
	$prefix = 'heal';
	CSF::createShortcoder( $prefix.'_shortcodes', array(
		'button_title'   => esc_html__('Add Shortcode','heal'),
		'select_title'   => esc_html__('Select a shortcode','heal'),
		'insert_title'   => esc_html__('Insert Shortcode','heal')
	) );

	/*------------------------------------
		Social Icon Options
	-------------------------------------*/
	CSF::createSection( $prefix.'_shortcodes', array(
		'title'     => esc_html__('Social Icons','heal'),
		'view'      => 'group',
		'shortcode' => 'heal_social_icon_wrap',
		'fields' => [
            array(
                'id'      => 'custom_class',
                'type'    => 'text',
                'title'   => esc_html__('Custom Class','heal'),
            )
        ],
		'group_shortcode' => 'heal_social_icon',
		'group_fields'    => array(
			array(
				'id'    => 'social_icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon','heal'),
			),
			array(
				'id'      => 'social_link',
				'type'    => 'text',
				'title'   => esc_html__('URL','heal'),
			)
		)
	) );

	/*------------------------------------
		Top Menu Options
	-------------------------------------*/
	CSF::createSection( $prefix.'_shortcodes', array(
		'title'     => esc_html__('Top Menu','heal'),
		'view'      => 'group',
		'shortcode' => 'heal_top_menu_wrap',
		'group_shortcode' => 'heal_top_menu',
		'group_fields'    => array(
			array(
				'id'    => 'top_menu_text',
				'type'  => 'text',
				'title' => esc_html__('Text','heal'),
			),
			array(
				'id'      => 'top_menu_link',
				'type'    => 'text',
				'title'   => esc_html__('URL','heal'),
			)
		)
	) );

    /*------------------------------------
      Info Menu Options
    -------------------------------------*/
    CSF::createSection( $prefix.'_shortcodes', array(
        'title'     => esc_html__('Info Menu','heal'),
        'view'      => 'group',
        'shortcode' => 'heal_top_menu_wrap_02',
        'group_shortcode' => 'heal_top_menu_02',
        'group_fields'    => array(
            array(
                'id'    => 'top_menu_title_text',
                'type'  => 'text',
                'title' => esc_html__('Text','heal'),
            ),
            array(
                'id'    => 'top_menu_text',
                'type'  => 'text',
                'title' => esc_html__('Text','heal'),
            ),
            array(
                'id'      => 'top_menu_link',
                'type'    => 'text',
                'title'   => esc_html__('URL','heal'),
            )
        )
    ) );
    
	/*------------------------------------
		Inline info link options
	-------------------------------------*/
	CSF::createSection( $prefix.'_shortcodes', array(
		'title'     => esc_html__('Inline Info Link','heal'),
		'view'      => 'group',
		'shortcode' => 'heal_info_item_wrap',
		'group_shortcode' => 'heal_info_link',
		'group_fields'    => array(
			array(
				'id'    => 'icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon','heal'),
			),
			array(
				'id'      => 'text',
				'type'    => 'text',
				'title'   => esc_html__('Text','heal'),
			),
			array(
				'id'      => 'url',
				'type'    => 'text',
				'title'   => esc_html__('URL','heal'),
			)
		)
	) );

}
