<?php $slides = get_field('slides'); if( $slides ): ?>
<section id="page-slider">
	<div class="slides">
		<?php foreach( $slides as $slide ): ?>
			<div class="slide">
				<img src="<?php echo $slide['sizes']['slide']; ?>" alt="<?php echo $slide['alt']; ?>" />
			</div>
		<?php endforeach; ?>
	</div>
</section>
<?php elseif(has_post_thumbnail()): ?>
	<section id="page-slider">
	<?php the_post_thumbnail( 'slide' ); ?>
	</section>
<?php endif; ?>