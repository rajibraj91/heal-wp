<?php
/**
* Template Name: Page Left Menu
*
* @package WordPress
* @subpackage Heal
* @since 1.0
* @version 1.0
*/
get_header('two'); 
?>
<div class="main-wrap-page-two">
	<div class="main-wrap-page-two-inner">
		<?php
			if(have_posts()){
				while(have_posts()) : the_post();
					the_content();
				endwhile;
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
		?>
	</div>
</div>

<?php get_footer('two'); ?>