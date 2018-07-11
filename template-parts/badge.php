<?php
$badge_title = pixelgrade_option( 'archive_badge_title' );
$badge_content = pixelgrade_option( 'archive_badge_content' );

if ( ! empty( $badge_title ) || ! empty( $badge_content ) ) { ?>
	<div class="c-gallery__item  c-gallery__item--widget  c-gallery__item--post-it  post-it  small">
		
		<div class="widget">
			<?php if ( ! empty ( $badge_title ) ) { ?>
				<h6><?php echo $badge_title ?></h6>
			<?php } ?>

			<?php if ( ! empty ( $badge_content ) ) { ?>
				<div class="c-badge__content"><?php echo $badge_content ?></div>
			<?php } ?>
		</div>

	</div>

<?php } ?>
