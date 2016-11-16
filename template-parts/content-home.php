<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cooper
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h2><?php echo bloginfo( 'name' ); ?></h2>

	<div class="entry-content">
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->


</article><!-- #post-## -->
