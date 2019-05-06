<?php
/**
 * The template part used for displaying the entry header.
 *
 * This template part can be overridden by copying it to a child theme or in the same theme
 * by putting it in the root `/template-parts/entry-header.php` or in `/template-parts/blog/entry-header.php`.
 *
 * @see pixelgrade_locate_component_template_part()
 *
 * HOWEVER, on occasion Pixelgrade will need to update template files and you
 * will need to copy the new files to your child theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://pixelgrade.com
 * @author     Pixelgrade
 * @package    Components/Blog
 * @version    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$author = pixelgrade_get_the_author_info_box();
?>

<div class="header-stuff">
	<?php pixelgrade_the_main_category_link( '<div class="header-category">', '</div>' ); ?>
	<?php the_title( '<h1 class="entry-title u-page-title-color">', '</h1>' ); ?>

    <?php if ( 'portrait' === pixelgrade_get_post_thumbnail_aspect_ratio_class() ) { ?>
        <?php if ( ! empty( $author ) ) { ?>
	        <div class="c-header__author"><?php echo $author; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	    <?php } ?>
        <div class="header-meta"><?php pixelgrade_posted_on(); ?></div>
    <?php } ?>
</div>

<?php if ( has_post_thumbnail() ) { ?>
	<div class="entry-thumbnail">
		<div><?php the_post_thumbnail( 'pixelgrade_single_' . pixelgrade_get_post_thumbnail_aspect_ratio_class() ); ?></div>
	</div>
<?php } ?>

<?php if ( 'portrait' !== pixelgrade_get_post_thumbnail_aspect_ratio_class() ) { ?>
	<?php if ( ! empty( $author ) ) { ?>
        <div class="c-header__author"><?php echo $author; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	<?php } ?>
    <div class="header-meta"><?php pixelgrade_posted_on(); ?></div>
<?php } ?>

