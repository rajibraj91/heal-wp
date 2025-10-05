<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products section-padding pb-0">

		<div class="title-area text-center mb-4">
			<div class="sub-title mb-3">
				<h5><?php esc_html_e( 'Popular Products', 'heal' ); ?></h5>
			</div>
			<div class="title">
				<h2><?php esc_html_e( 'Best Selling Products', 'heal' ); ?></h2>
			</div>
		</div>

		<?php 
        $related_slider_class = count( $related_products ) >= 4 ? 'swiper team-slider pb-3 px-3' : 'container';
        $related_slider_active = count( $related_products ) >= 4 ? 'swiper-wrapper' : 'row row-cols-xl-4 justify-content-center';
        $related_slider_slide = count( $related_products ) >= 4 ? 'swiper-slide' : 'shop-card';
        ?>

	<div class="<?php echo esc_attr($related_slider_class);?>">
        <div class="<?php echo esc_attr($related_slider_active);?>">
		<?php foreach ( $related_products as $related_product ) : ?>
            <div class="<?php echo esc_attr($related_slider_slide);?>">
				<?php
				$post_object = get_post( $related_product->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				wc_get_template_part( 'content', 'product' );
				?>
            </div>
			<?php endforeach; ?>
        </div>
    </div>

	</section>
	<?php
endif;

wp_reset_postdata();
