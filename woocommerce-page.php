<?php
/**
 * Template Name: WooCommerce Page
 * The template for displaying the woocommerce
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cooper
 */

get_header(); ?>

	<?php get_template_part( 'partials/image', 'slider' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
	
			<div class="container">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile;
				?>
			</div>

		</main>
	</div>

<?php get_footer();
