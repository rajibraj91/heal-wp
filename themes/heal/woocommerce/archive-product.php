<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>

<?php

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action( 'woocommerce_shop_loop_header' );

$product_col = is_active_sidebar('product-sidebar') ? '9' : '12';

if ( woocommerce_product_loop() ) {?>

	<div class="row g-4">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop.
		*
		* @hooked woocommerce_output_all_notices - 10
		* @hooked woocommerce_result_count - 20
		* @hooked woocommerce_catalog_ordering - 30
		*/
		do_action('woocommerce_before_shop_loop');
		?>
		<div class="col-xl-<?php echo esc_attr($product_col);?> col-xl-9 col-lg-8 order-1 order-md-2">		
			<div class="gt-shop-notices-wrapper">
				<div class="gt-shop-showing">
					<ul class="nav">
						<li class="nav-item">
							<a href="#grid" data-bs-toggle="tab" class="nav-link active">
								<i class="fa-solid fa-border-all"></i>
							</a>
						</li>
						<li class="nav-item">
							<a href="#list" data-bs-toggle="tab" class="nav-link">
								<i class="fa-solid fa-list-ul"></i>
							</a>
						</li>
					</ul>
					<p class="woocommerce-result-count mb-0"><?php woocommerce_result_count();?></p>

					<div class="form-clt">
						<div class="form">
							<?php woocommerce_catalog_ordering();?>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-content" id="pills-tabContent">
				<div id="grid" class="tab-pane fade show active">
					<div class="row">
						<div class="dishes-card-wrap">

								<?php

								woocommerce_product_loop_start();

								if ( wc_get_loop_prop( 'total' ) ) {
									while ( have_posts() ) {
										the_post();

										/**
										 * Hook: woocommerce_shop_loop.
										 */
										do_action( 'woocommerce_shop_loop' );

										wc_get_template_part( 'content', 'product' );
									}
								}

								woocommerce_product_loop_end();

							?>

						</div>
					</div>
				</div>
				<div id="list" class="tab-pane fade">
					<div class="row">

						<?php

							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'content', 'product-list' );
								}
							}

						?>

					</div>
				</div>
			</div>
			<?php
			/**
			 * Hook: woocommerce_before_shop_loop.
			*
			* @hooked woocommerce_output_all_notices - 10
			* @hooked woocommerce_result_count - 20
			* @hooked woocommerce_catalog_ordering - 30
			*/
			do_action('woocommerce_after_shop_loop');
			?>
		</div>		

		<?php if(is_active_sidebar('product-sidebar')) : ?>	
			<div class="col-xl-3 col-lg-4 order-2 order-md-1">
				<div class="main-sidebar gt-shop-sidebar-area sticky-style">
					<?php dynamic_sidebar('product-sidebar'); ?>
				</div>
			</div>
		<?php endif;?>

	</div>

<?php

} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
