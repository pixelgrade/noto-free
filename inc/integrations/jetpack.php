<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Boilerplate
 * @since 1.0.0
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function boilerplate_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'posts-container',
		'render'    => 'boilerplate_infinite_scroll_render',
		'footer'    => 'page',
		'footer_widgets' => is_active_sidebar( 'sidebar-footer' ) || has_nav_menu('footer' ),
		'wrapper'   => false
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add support for content options, where it's appropriate
	add_theme_support( 'jetpack-content-options', array(
		'blog-display'       => false, // we only show the excerpt, not full post content on archives
		'author-bio'         => true, // display or not the author bio by default: true or false.
		'masonry'            => '.c-gallery--masonry', // a CSS selector matching the elements that triggers a masonry refresh if the theme is using a masonry layout.
		'post-details'       => array(
			'stylesheet'      => 'boilerplate-style', // name of the theme's stylesheet.
			'date'            => '.single-post .posted-on', // a CSS selector matching the elements that display the post date.
			'categories'      => '.single-post .cats', // a CSS selector matching the elements that display the post categories.
			'tags'            => '.single-post .tags', // a CSS selector matching the elements that display the post tags.
			'author'          => '.single-post .byline', // a CSS selector matching the elements that display the post author.
		),
		'featured-images'    => array(
			'archive'         => true, // enable or not the featured image check for archive pages: true or false.
			'post'            => true, // we do not display the featured image on single posts
			'page'            => false, // enable or not the featured image check for single pages: true or false.
		),
	) );

	/**
	 * Set our own default activated modules
	 * See jetpack/modules/modules-heading.php for module names
	 */
	$default_modules = array(
		'carousel',
		'contact-form',
		'shortcodes',
		'widget-visibility',
		'widgets',
		'tiled-gallery',
		'custom-css',
		'sharedaddy',
		'custom-content-types',
		'verification-tools',
	);
	set_theme_mod( 'pixelgrade_jetpack_default_active_modules', $default_modules );
}
add_action( 'after_setup_theme', 'boilerplate_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function boilerplate_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();

		// We use the same theme partial regardless of archive or search page
		get_template_part( 'template-parts/content', get_post_format() );
	}
}

/* ===================
 * Jetpack Sharing Options
 * =================== */

/**
 * Setup the default sharing services
 * See Sharing_Service->get_all_services() for the complete list.
 *
 * @param array $enabled
 *
 * @return array
 */
function boilerplate_default_jetpack_sharing_services( $enabled ) {
	return array(
		'visible' => array(
			'facebook',
			'twitter',
			'pinterest',
		),
		'hidden' => array(
		)
	);
}
add_filter( 'sharing_default_services', 'boilerplate_default_jetpack_sharing_services', 10, 1 );

/**
 * Set up the default Jetpack Sharing (Sharedaddy) global options.
 *
 * @param array $default
 *
 * @return array
 */
function boilerplate_default_jetpack_sharing_options( $default ) {
	$default = array(
		'global' => array(
			'button_style' => 'text',
			'sharing_label' => false,
			'open_links' => 'same',
			'show' => array (
				'post',
			),
			'custom' => array (
			),
		),
	);

	return $default;
}
add_filter( 'pixelgrade_filter_jetpack_sharing_default_options', 'boilerplate_default_jetpack_sharing_options', 10, 1 );

/**
 * Prevent sharing buttons when a Featured Posts widget starts.
 */
function boilerplate_remove_jetpack_sharing() {
	if ( has_filter( 'the_content', 'sharing_display' ) ) {
		remove_filter( 'the_content', 'sharing_display', 19 );
	}

	if ( has_filter( 'the_excerpt', 'sharing_display' ) ) {
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
	}
}
add_action( 'pixelgrade_featured_posts_widget_start', 'boilerplate_remove_jetpack_sharing', 10 );

/**
 * Add sharing logic after a Featured Posts widget has rendered.
 */
function boilerplate_add_jetpack_sharing() {
	if ( function_exists( 'sharing_display' ) ) {
		add_filter( 'the_content', 'sharing_display', 19 );
		add_filter( 'the_excerpt', 'sharing_display', 19 );
	}
}
add_action( 'pixelgrade_featured_posts_widget_end', 'boilerplate_add_jetpack_sharing', 10 );
