<?php
/**
 * Handle the specific Components integration.
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
	add_theme_support( 'pixelgrade-footer-component' );
	add_theme_support( 'pixelgrade-gallery-settings-component' );
}
add_action( 'after_setup_theme', 'noto_setup_components', 10 );


/**
 * Add the required features regarding the header component, mainly options regarding menus.
 *
 * @param array $config The array containing all the active features of the theme.
 *
 * @return array
 */
function noto_alter_header_component_config( $config ) {
	// Output markup in the header, even if empty (aka no menu assigned).
	$config['zones']['left']['display_blank'] = true;

	$config['menu_locations']['primary-left'] = array(
		'title'         => esc_html__( 'Header Top', '__theme_txtd' ),
		'default_zone'  => 'left',
		// This callback should always accept 3 parameters as documented in pixelgrade_header_get_zones()
		'zone_callback' => false,
		'order'         => 10,
		// We will use this to establish the display order of nav menu locations, inside a certain zone
		'nav_menu_args' => array( // skip 'theme_location' and 'echo' args as we will force those
			'menu_id'         => 'menu-1',
			'container'       => 'nav',
			'container_class' => '',
			'fallback_cb'     => false,
			'depth'           => 0,
		),
	);

	if ( ! pixelgrade_user_has_access( 'pro-features' ) ) {
		unset( $config['menu_locations']['primary-right'] );
		$config['menu_locations']['primary-left']['nav_menu_args']['depth'] = 1;
	} else {
		$config['menu_locations']['primary-right']['title'] = esc_html__( 'Header Bottom', '__theme_txtd' );
	}

	return $config;
}
add_filter( 'pixelgrade_header_config', 'noto_alter_header_component_config', 10, 1 );

/**
 * Add markup needed for paper stack effect in footer
 */
function noto_add_footer_layers() { ?>
	<div class="c-footer-layers  c-footer-layers__accent"></div>
    <div class="c-footer-layers  c-footer-layers__background"></div>
<?php }
add_action( 'noto_before_grid_end', 'noto_add_footer_layers', 10 );

/**
 * Add markup needed for paper stack effect in footer
 */
function noto_add_other_footer_layers() { ?>
	<div class="c-footer-layers  c-footer-layers__dark"></div>
<?php }
add_action( 'noto_after_grid_end', 'noto_add_other_footer_layers', 10 );

/**
 * Add markup needed for paper stack effect in footer
 */
function noto_add_search_overlay() {
	pixelgrade_get_component_template_part( Pixelgrade_Blog::COMPONENT_SLUG, 'search-overlay' );
}
add_action( 'pixelgrade_after_barba_wrapper', 'noto_add_search_overlay', 10 );
