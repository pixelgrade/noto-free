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

/**
 * pixelgrade_before_header hook.
 *
 * @hooked nothing() - 10 (outputs nothing)
 */
do_action( 'pixelgrade_before_header', 'main' );
?>

<?php
/**
 * pixelgrade_header_before_navbar_content hook.
 */
do_action( 'pixelgrade_header_before_navbar_content', 'header' );
?>

<?php pixelgrade_get_component_template_part( Pixelgrade_Header::COMPONENT_SLUG, 'content-navbar' ); ?>

<?php
/**
 * pixelgrade_header_after_navbar_content hook.
 */
do_action( 'pixelgrade_header_after_navbar_content', 'header' );
?>

<?php
/**
 * pixelgrade_after_header hook.
 *
 * @hooked nothing() - 10 (outputs nothing)
 */
do_action( 'pixelgrade_after_header', 'main' );
