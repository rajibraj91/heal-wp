<?php
/**
 * Theme Header Template
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package heal
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
do_action( 'heal_after_body' );
$page_container_meta = Heal_Group_Fields_Value::page_container( 'heal', 'header_options' );

$back_top_enable             = cs_get_option('back_top_enable');
$back_top_icon               = cs_get_option('back_top_icon');

?>

<?php if ( $back_top_enable ): ?>
    <a href="#0" class="scrollToTop"><i class="<?php echo esc_attr($back_top_icon); ?>"></i><span class="pluse_1"></span><span class="pluse_2"></span></a>
<?php endif; ?>

<div id="page" class="site">
    

    <div class="site-header">
        <?php 
            // get_template_part('template-parts/header/header',$page_container_meta['navbar_type']); 

            $navbar_slug = !empty($page_container_meta['navbar_type']) ? $page_container_meta['navbar_type'] : '';
            get_template_part('template-parts/header/header', $navbar_slug);
        ?>
        <?php
            // if ( function_exists( 'heal_render_location' ) ) {
            //     heal_render_location( 'header' );
            // } else {
            //     get_template_part( 'template-parts/header/default' );
            // }
        ?>
    </div>

	<?php do_action( 'heal_before_page_content' ) ?>
    
    <div id="content" class="site-content">



