<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Noto
 * @since 1.1.0
 */

/**
 * Generate a link to the Noto (Free) info page.
 */
function noto_lite_get_pro_link() {
	return 'https://pixelgrade.com/themes/blogging/noto-pro?utm_source=noto-lite-clients&utm_medium=customizer&utm_campaign=noto-lite';
}

function noto_lite_footer_credits_url( $url ) {
	return 'https://pixelgrade.com/?utm_source=noto-lite-clients&utm_medium=footer&utm_campaign=noto-lite';
}
add_filter( 'pixelgrade_footer_credits_url', 'noto_lite_footer_credits_url' );

function noto_lite_body_classes( $classes ) {

	$classes[] = 'lite-version';
	$classes[] = 'u-buttons-square';
	$classes[] = 'u-buttons-outline';

	return $classes;
}
add_filter( 'body_class', 'noto_lite_body_classes' );

function noto_alter_footer_component_config( $config ) {

	unset($config['sidebars']['sidebar-footer']);

	return $config;
}
add_filter( 'pixelgrade_footer_initial_config', 'noto_alter_footer_component_config', 10 );

add_filter( 'pixelgrade_prevent_post_navigation', '__return_true', 10 );
