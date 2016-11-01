<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _cooper
 */

?>

	</div><!-- #content -->
	
	
	
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
				<div class="site-info">
					© <?php echo date('Y'); ?> Heaton Cooper Studio | Email <?php the_field('email_address','option'); ?> | Telephone <?php the_field('phone','option'); ?> | Fax <?php the_field('fax','option'); ?>
				</div><!-- .site-info -->
			</div>
		</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
