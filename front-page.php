<?php
/**
 * The template for displaying the front page.
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

				get_template_part( 'template-parts/content', 'home' );

			endwhile; // End of the loop.
			?>
		</div>

		<section id="cards">
			<div class="container">
				<div class="row">
					<?php if( have_rows('intro_categories') ): ?>
						<?php while( have_rows('intro_categories') ): the_row(); 

							// vars
							$image = get_sub_field('category_image');
							$title = get_sub_field('category_title');
							$content = get_sub_field('category_description');
							$link = get_sub_field('category_link');

							?>

							<div class="card">
								<?php if( $link ): ?>
									<a href="<?php echo $link; ?>">
								<?php endif; ?>

									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
									<div class="category-text">
										<h4><?php echo $title; ?></h4>

									<?php if( $link ): ?>
										</a>
									<?php endif; ?>

								    <?php echo $content; ?>
								    </div>
							</div>

						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<section id="studio">
			<div class="container">
				<div class="center">
					<h2><?php the_field('section_title'); ?></h2>
					<p><?php the_field('section_description'); ?></p>
				</div>

				<div class="row">
				<?php if( have_rows('section_categories') ): ?>
						<?php while( have_rows('section_categories') ): the_row(); 

							// vars
							$image = get_sub_field('studio_image');
							$title = get_sub_field('studio_title');
							$content = get_sub_field('studio_description');
							$link = get_sub_field('studio_link');

							?>

							<div class="card">
								<?php if( $link ): ?>
									<a href="<?php echo $link; ?>">
								<?php endif; ?>

									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
									<div class="category-text">
										<h4><?php echo $title; ?></h4>

									<?php if( $link ): ?>
										</a>
									<?php endif; ?>

								    <?php echo $content; ?>
								    </div>
							</div>

						<?php endwhile; ?>
					<?php endif; ?>

				</div>
			</div>
		</section>

		<?php 
		get_template_part( 'partials/social', 'blocks' );
		?>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
