<?php
/**
 * Handle the specific Components integration.
 *
 * Development notice: This file is synced from the variations directory! Do not edit in the `inc` directory!
 *
 * @package Noto
 * @since 1.0.0
 */

function noto_setup_components() {
	/*
	 * Declare support for the Pixelgrade Components the theme uses.
	 * Please note that some components will load regardless (like Base, Blog, Header, Footer).
	 * It is safe although to declare support for all that you use (for future proofing).
	 */
	add_theme_support( 'pixelgrade-base-component' );
	add_theme_support( 'pixelgrade-blog-component' );
	add_theme_support( 'pixelgrade-header-component' );
	add_theme_support( 'pixelgrade-hero-component' );
	add_theme_support( 'pixelgrade-footer-component' );
	add_theme_support( 'pixelgrade-featured-image-component' );
	add_theme_support( 'pixelgrade-gallery-settings-component' );
	add_theme_support( 'pixelgrade-multipage-component' );
	add_theme_support( 'pixelgrade-portfolio-component' );
}
add_action( 'after_setup_theme', 'noto_setup_components', 10 );

/**
 * Customize the Header component config.
 *
 * @param array $config
 *
 * @return array
 */
function noto_customize_header_config( $config ) {
	// Don't output empty markup in the header
	$config['zones']['left']['display_blank'] = false;
	$config['zones']['right']['display_blank'] = false;

	return $config;
}
add_filter( 'pixelgrade_header_initial_config', 'noto_customize_header_config', 10, 1 );

/**
 * Add markup needed for paper stack effect in footer
 */
function noto_add_footer_layers() { ?>
	<div class="c-footer-layers__dark"></div>
	<div class="c-footer-layers__accent"></div>
    <div class="c-footer-layers__background"></div>
<?php }
add_action( 'noto_before_grid_end', 'noto_add_footer_layers', 10 );

/**
 * Add markup needed for paper stack effect in footer
 */
function noto_add_search_overlay() {
	pixelgrade_get_component_template_part( Pixelgrade_Blog::COMPONENT_SLUG, 'search-overlay' );
}
add_action( 'pixelgrade_footer_before_content', 'noto_add_search_overlay', 10 );