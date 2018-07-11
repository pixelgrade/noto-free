<?php
$badge_title = pixelgrade_option( 'archive_badge_title' );
$badge_content = pixelgrade_option( 'archive_badge_content' );

if ( ! empty( $badge_title ) || ! empty( $badge_content ) ) { ?>
	<div class="c-badge widget post-it small">
		<?php if ( ! empty ( $badge_title ) ) { ?>
			<h6 class="c-badge__title"><?php echo $badge_title ?></h6>
		<?php } ?>

		<?php if ( ! empty ( $badge_content ) ) { ?>
			<div class="c-badge__content"><?php echo $badge_content ?></div>
		<?php } ?>

        <?php get_template_part( 'template-parts/svg/wave-card-svg' ); ?>
	</div>
<?php } ?>
