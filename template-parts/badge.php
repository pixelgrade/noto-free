<?php
$badge_title = pixelgrade_option( 'archive_badge_title' );
$badge_content = pixelgrade_option( 'archive_badge_content' );

if ( ! empty( $badge_title ) || ! empty( $badge_content ) ) { ?>
	<div class="c-badge">
		<?php if ( ! empty ( $badge_title ) ) { ?>
			<div class="c-badge__title"><?php echo $badge_title ?></div>
		<?php } ?>

		<?php if ( ! empty ( $badge_content ) ) { ?>
			<div class="c-badge__content"><?php echo $badge_content ?></div>
		<?php } ?>
	</div>
<?php } ?>
