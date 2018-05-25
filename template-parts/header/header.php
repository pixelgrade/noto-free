<?php
/**
 * The template part for header
 *
 * This template part can be overridden by copying it to a child theme or in the same theme
 * by putting it in template-parts/header/header.php.
 *
 * HOWEVER, on occasion Pixelgrade will need to update template files and you
 * will need to copy the new files to your child theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://pixelgrade.com
 * @author     Pixelgrade
 * @package    Components/Header
 * @version    1.1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<input class="c-navbar__checkbox" id="menu-toggle" type="checkbox">
<label class="c-navbar__label u-header-sides-spacing" for="menu-toggle">
	<span class="c-navbar__label-icon"><?php pixelgrade_get_component_template_part( Pixelgrade_Header::COMPONENT_SLUG, 'burger' ); ?></span>
	<span class="c-navbar__label-text screen-reader-text"><?php esc_html_e( 'Menu', '__components_txtd' ); ?></span>
</label><!-- .c-navbar__label -->

<?php pixelgrade_get_component_template_part( Pixelgrade_Header::COMPONENT_SLUG, 'content-navbar' ); ?>

<div class="search-trigger">
    <button class="js-search-trigger">
        <?php get_template_part( 'template-parts/svg/icon-search-svg' );?>
        <span class="screen-reader-text"><?php esc_html_e( 'Search', '__theme_txtd' ); ?></span>
    </button>
</div>

<?php pixelgrade_get_component_template_part( Pixelgrade_Blog::COMPONENT_SLUG, 'search-overlay' ); ?>
