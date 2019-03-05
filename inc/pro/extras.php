<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @package Noto
 * @since 1.1.0
 */


/**
 * Sets up pro theme features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function noto_pro_setup() {
	/**
	 * Enable support for the Style Manager Customizer section (via Customify).
	 */
	add_theme_support( 'customizer_style_manager' );
}
add_action( 'after_setup_theme', 'noto_pro_setup' );


