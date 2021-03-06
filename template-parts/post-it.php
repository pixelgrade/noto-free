<?php
/**
 * The template for the Post-it Note on archives.
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

$post_it_title = pixelgrade_option( 'archive_post_it_title', 'Hello' );
$post_it_content = pixelgrade_option( 'archive_post_it_content', __( '<p>Welcome to my blog! Check out the latest post, browse the highlights or <a href="/contact/">reach me</a> to say Hi!</p>', '__theme_txtd' ) );

if ( ! pixelgrade_option( 'archive_post_it_disable', false ) ) { ?>

	<div class="c-noto__item  c-noto__item--widget  c-noto__item--post-it  post-it  small">

		<div class="widget">
			<?php if ( ! empty ( $post_it_title ) ) { ?>
				<h6 class="c-post-it__title"><?php echo wp_kses( $post_it_title, wp_kses_allowed_html() ) ?></h6>
			<?php }

			if ( ! empty ( $post_it_content ) ) { ?>
				<div class="c-post-it__content"><?php echo wp_kses_post( $post_it_content ) ?></div>
			<?php } ?>
		</div>

		<?php
			if ( is_user_logged_in() ) {
				echo '<a class="c-card__link" href="'. esc_url( admin_url( '/customize.php?autofocus[section]=noto_options[general]' ) ) . '"></a>';
			}
		?>

	</div>

<?php
}
