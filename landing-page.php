<?php
/**
 * Template Name: Landing Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cooper
 */

get_header(); ?>

	<?php get_template_part( 'partials/image', 'slider' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section id="column-intro">
				<div class="container">
					<h2><?php the_field('column_title') ?></h2>
					<div class="columns">
						<div class="left-column">
							<?php the_field('left_column') ?>
						</div>
						<div class="right-column">
							<?php the_field('right_column') ?>
						</div>
					</div>
				</div>
			</section>

			<section id="cards">
				<div class="container">
					<div class="row">
						<?php if( have_rows('two_col') ): ?>
							<?php while( have_rows('two_col') ): the_row(); 

								// vars
								$image = get_sub_field('landing_image');
								$title = get_sub_field('landing_title');
								$content = get_sub_field('landing_description');
								$link = get_sub_field('landing_link');

								?>

								<div class="card">

									<?php if( $link ): ?>
									<a href="<?php echo $link; ?>">
									<?php endif; ?>

										<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
										<div class="category-text">
											<h4><?php echo $title; ?></h4>
											<?php echo $content; ?>
										</div>

									<?php if( $link ): ?>
									</a>
									<?php endif; ?>

								</div>

							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</section>


		</main>
	</div>

<?php get_footer();
