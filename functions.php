<?php
/**
 * Noto functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Noto
 * @since 1.0.0
 */

/**
 * =========================
 * A few (wise) words
 *
 * For consistency amongst our themes, we have put as much of the theme behaviour (both logical and stylistic)
 * in components (the `components` directory). This includes the "classic" theme files like `archive.php`, `single.php`,
 * `header.php`, or `sidebar.php`.
 * Do no worry. You can still have those files in a theme, or a child theme. It will automagically work!
 *
 * We prefer not to use those files if the theme design allows us to stick to the markup patterns common to our themes,
 * available in our components.
 * This will make for more solid themes, faster update cycles and faster development for new themes.
 *
 * Now, let the show begin!
 * Oh snap... it already began :)
 * =========================
 */

/*
 * =========================
 * Autoload the Pixelgrade Components FTW!
 * This must be the FIRST thing a theme does!
 * =========================
 */
require_once trailingslashit( get_template_directory() ) . 'components/components-autoload.php';
Pixelgrade_Components_Autoload();


if ( ! function_exists( 'noto_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function noto_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on '__theme_txtd', use a find and replace
		 * to change '__theme_txtd' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( '__theme_txtd', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded title tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Add image sizes used by theme.
		 */
		// Used for blog archive(the height is flexible)
		add_image_size( 'noto-card-image', 450, 9999, false );
		// Used for sliders(fixed height)
		add_image_size( 'noto-slide-image', 9999, 800, false );
		// Used for hero image
		add_image_size( 'noto-hero-image', 2700, 9999, false );

		/*
		 * Add theme support for site logo
		 *
		 * First, it's the image size we want to use for the logo thumbnails
		 * Second, the 2 classes we want to use for the "Display Header Text" Customizer logic
		 */
		add_theme_support( 'custom-logo', apply_filters( 'noto_header_site_logo', array(
			'height'      => 600,
			'width'       => 1360,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array(
				'site-title',
				'site-description-text',
			)
		) ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Remove themes' post formats support
		 */
		remove_theme_support( 'post-formats' );

		/*
		 * Add the editor style and fonts
		 */
		add_editor_style(
			array(
				'editor-style.css',
			)
		);

		/*
		 * Enable support for Visible Edit Shortcuts in the Customizer Preview
		 *
		 * @link https://make.wordpress.org/core/2016/11/10/visible-edit-shortcuts-in-the-customizer-preview/
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Enable support for the Style Manager Customizer section (via Customify).
		 */
		add_theme_support( 'customizer_style_manager' );
	}
}
add_action( 'after_setup_theme', 'noto_setup', 10 );

/**
 * Enqueue scripts and styles.
 */
function noto_scripts() {
	$theme           = wp_get_theme( get_template() );
	$main_style_deps = array();
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style( 'noto-google-fonts', noto_google_fonts_url() );

	/* The main theme stylesheet */
	wp_enqueue_style( 'noto-style', get_template_directory_uri() . '/style.css', $main_style_deps, $theme->get( 'Version' ) );

	wp_style_add_data( 'noto-style', 'rtl', 'replace' );

	/* Scripts */

	//The main script
	wp_register_script( 'tweenmax', get_theme_file_uri( '/assets/js/TweenMax' . $suffix . '.js' ), array(), '2.1.2', true );
	wp_enqueue_script( 'noto-scripts', get_theme_file_uri( '/assets/js/scripts' . $suffix . '.js' ), array( 'jquery','imagesloaded', 'tweenmax', 'hoverIntent' ), $theme->get( 'Version' ), true );

	if ( is_customize_preview() ) {
		wp_enqueue_script( 'noto-customizer-scripts', get_theme_file_uri( '/assets/js/customizer.js' ), array(), $theme->get( 'Version' ), true );
	}

	$localization_array = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);
	wp_localize_script( 'noto-scripts', 'notoStrings', $localization_array );
}
add_action( 'wp_enqueue_scripts', 'noto_scripts' );

function noto_load_wp_admin_style() {
	wp_register_style( 'noto_wp_admin_css', get_template_directory_uri() . '/admin.css', false, '1.1.2' );
	wp_enqueue_style( 'noto_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'noto_load_wp_admin_style' );

function noto_gutenberg_styles() {
	wp_enqueue_style( 'noto-gutenberg', get_theme_file_uri( '/editor.css' ), false );
	wp_enqueue_style( 'noto-google-fonts', noto_google_fonts_url() );
}
add_action( 'enqueue_block_editor_assets', 'noto_gutenberg_styles' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function noto_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'noto_content_width', 720 );
}
add_action( 'after_setup_theme', 'noto_content_width', 0 );

function noto_custom_tiled_gallery_width() {
	$width = pixelgrade_option( 'main_content_container_width', 1300 );

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$width = pixelgrade_option( 'main_content_container_width', 1300 ) - 300 - 56;
	}

	return $width;
}
add_filter( 'tiled_gallery_content_width', 'noto_custom_tiled_gallery_width' );

/*
 * ==================================================
 * Load all the files directly in the `inc` directory
 * ==================================================
 */
pixelgrade_autoload_dir( 'inc' );
