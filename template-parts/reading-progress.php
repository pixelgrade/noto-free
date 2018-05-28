<?php if ( is_single() && ! is_attachment() ) { ?>

	<div class="c-reading-progress">
		<progress value="0" max="100" class="js-reading-progress"></progress>
		<div class="c-reading-progress__label">
			<?php $minutes = noto_get_the_reading_time_in_minutes(); ?>
			<span><?php echo $minutes; ?></span>
			<p><?php printf( _n( 'min %s read', 'mins %s read', $minutes, '__theme_txtd' ), '<br>' ); ?></p>
		</div>
	</div>

<?php } ?>