<?php
/**
 * The template for the reading progress indicator.
 *
 * This template can be overridden by copying it to a child theme in the template-parts directory.
 *
 * HOWEVER, on occasion Pixelgrade will need to update template files and you
 * will need to copy the new files to your child theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @version 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_single() && ! is_attachment() ) { ?>

	<div class="c-reading-progress">
		<progress value="0" max="100" class="js-reading-progress"></progress>
		<div class="c-reading-progress__label">
			<?php $minutes = noto_get_the_reading_time_in_minutes(); ?>
			<span><?php echo esc_html( $minutes ); ?></span>
			<p><?php /* translators: %s: number of minutes necessary for reading the post */
                printf( esc_html ( _n( 'min %s read', 'mins %s read', $minutes, '__theme_txtd' ) ), '<br>' ); ?></p>
		</div>
	</div>

<?php }
