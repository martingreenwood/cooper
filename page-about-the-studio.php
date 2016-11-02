<?php
/**
 * The template for displaying the About page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _cooper
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

		<section id="about-studio">
			<div class="container">
					<?php if( have_rows('about_sections') ): $counter = 0; ?>
						<?php while( have_rows('about_sections') ): the_row(); 

							// vars
							$image = get_sub_field('about_image');
							$content = get_sub_field('about_text');

							if ($counter++ / 2):
							?>

							<div class="about-row">
									<div class="section-text">
								    <?php echo $content; ?>
								    </div>

									<div class="section-image"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" /></div>
									
							</div>

						<?php else: ?>

							<div class="about-row odd">

									<div class="section-image"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" /></div>
									
									<div class="section-text">
								    <?php echo $content; ?>
								    </div>
							</div>

						<?php endif; ?>

						<?php endwhile; ?>
					<?php endif; ?>
			</div>
		</section>

		<?php get_template_part( 'partials/social', 'blocks' ); ?>

		</main>
	</div>

<?php get_footer();
