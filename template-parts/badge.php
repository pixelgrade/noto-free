<?php
/**
 * The template for the badge on archives.
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

$badge_title = pixelgrade_option( 'archive_badge_title' );
$badge_content = pixelgrade_option( 'archive_badge_content' );

if ( ! empty( $badge_title ) || ! empty( $badge_content ) ) { ?>
	<div class="c-noto__item  c-noto__item--widget  c-noto__item--post-it  post-it  small">
		
		<div class="widget">
			<?php if ( ! empty ( $badge_title ) ) { ?>
				<h6><?php echo $badge_title ?></h6>
			<?php } ?>

			<?php if ( ! empty ( $badge_content ) ) { ?>
				<div class="c-badge__content"><?php echo $badge_content ?></div>
			<?php } ?>
		</div>

	</div>

<?php }
