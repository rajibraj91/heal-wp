<?php
/**
 * The template for displaying 404 Error page
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package heal
 */

get_header();


// Fetch options
$image_enable   = cs_get_option('404_enable_image', true);
$image          = cs_get_option('404_image');
$title          = cs_get_option('404_title', 'Oops... Looks like You got lost..!!');
$paragraph      = cs_get_option('404_paragraph', 'Looks like you took a wrong turn! But don’t worry, even the best riders get lost sometimes.');
$btn_text       = cs_get_option('404_button_text', 'BACK TO HOME');
$bg_color       = cs_get_option('404_background_color', '#ffffff');
$title_color       = cs_get_option('404_title_color', '#050505ff');
$desc_color       = cs_get_option('404_desc_color', '#383333ff');
$padding_top    = cs_get_option('404_padding_top', 120);
$padding_bottom = cs_get_option('404_padding_bottom', 120);


?>

    <section class="error-section section-padding fix"
            style="background-color: <?php echo esc_attr($bg_color); ?>;
                    padding-top: <?php echo esc_attr($padding_top); ?>px;
                    padding-bottom: <?php echo esc_attr($padding_bottom); ?>px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="error-text text-center">

                        <?php if ($image_enable && !empty($image['url'])) : ?>
                            <div class="gt-error-image wow fadeInUp" data-wow-delay=".3s">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($title)) : ?>
                            <h2 class="wow fadeInUp" data-wow-delay=".5s" <?php if(!empty($title_color)) : ?> style="color: <?php echo esc_attr($title_color); ?>" <?php endif; ?>>
                                <?php echo esc_html($title); ?>
                            </h2>
                        <?php endif; ?>


                        <?php if (!empty($paragraph)) : ?>
                            <p class="wow fadeInUp" data-wow-delay=".3s" <?php if(!empty($title_color)) : ?> style="color: <?php echo esc_attr($title_color); ?>" <?php endif; ?>>
                                <?php echo esc_html($paragraph); ?>
                            </p>
                         <?php endif; ?>

                        <?php if (!empty($btn_text)) : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="default-btn move-right wow fadeInUp" data-wow-delay=".5s">
                                <span class="gt-icon-btn"><i class="icon-icon-1"></i></span>
                                <span class="gt-text-btn">
                                    <span class="gt-text-2"><?php echo esc_html($btn_text); ?></span>
                                </span>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
get_footer();

