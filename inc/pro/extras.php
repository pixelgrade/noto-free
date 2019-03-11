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


if ( ! function_exists( 'noto_output_wave_svg' ) ) :
	/**
	 * Output the wave card SVG code.
	 */
	function noto_output_wave_svg() { ?>
        <div class="wave-svg-mask">
            <div class="wave-svg" style='background-image: <?php echo noto_get_pattern_background_image(); ?>'></div>
        </div>
	<?php }
endif;

add_action( 'pixelgrade_before_excerpt', 'noto_output_wave_svg' );


if ( ! function_exists( 'noto_alter_blog_component_config' ) ) {

	function noto_alter_blog_component_config( $config ) {

		$config = Pixelgrade_Config::merge( $config, array(
			'sidebars' => array(
				'sidebar-1' => array(
					'sidebar_args' => array(
						'name'          => esc_html__( 'Posts Grid Widgets', '__theme_txtd' ),
						'description'   => esc_html__( 'Insert your favorite widgets here, and we will place them throughout the Frontpage posts grid.', '__theme_txtd' ),
						'before_widget' => '<div class="c-noto__item c-noto__item--widget %2$s"><section id="%1$s" class="widget">',
						'after_widget'  => '</section></div>',
						'before_title'  => '<h2 class="widget__title h6"><span>',
						'after_title'   => '</span></h2>',
					),
				),
				'sidebar-2' => array(
					'sidebar_args' => array(
						'before_title' => '<h2 class="widget__title h4"><span>',
						'after_title'  => '</span></h2>',
					),
				)
			)
		) );

		return $config;
	}
}
add_filter( 'pixelgrade_blog_initial_config', 'noto_alter_blog_component_config', 10 );


if ( ! function_exists( '_noto_custom_logo_header_styles' ) ) {

	/**
	 * Adds CSS to hide header text for custom logo, based on Customizer setting.
	 */
	function _noto_custom_logo_header_styles() {
		if ( ! current_theme_supports( 'custom-header', 'header-text' ) && get_theme_support( 'custom-logo', 'header-text' ) ) {
			// remove the default core hook that handles the custom inline CSS for hiding the Site Title & Description.
			remove_action( 'wp_head', '_custom_logo_header_styles', 10 );

			$classes = array();
			if ( ! pixelgrade_option( 'display_site_title' ) ) {
				$classes[] = 'site-title';
			}
			if ( ! pixelgrade_option( 'display_site_description' ) ) {
				$classes[] = 'site-description-text';
			}
			if ( empty( $classes ) ) {
				return;
			}

			$classes = array_map( 'sanitize_html_class', $classes );
			$classes = '.' . implode( ', .', $classes );

			?>
            <!-- Custom Logo: hide header text -->
            <style id="custom-logo-css" type="text/css">
                <?php echo $classes; ?>
                {
                    position: absolute
                ;
                    clip: rect(1px, 1px, 1px, 1px)
                ;
                }
            </style>
			<?php
		}
	}
}

add_action( 'wp_head', '_noto_custom_logo_header_styles', 9 );


if ( ! function_exists( 'noto_profile_photo' ) ) {
	/**
	 * Add the markup for the Noto Profile Photo.
	 */
	function noto_profile_photo() { ?>
        <div class="c-profile-photo">
            <div class="c-profile-photo__default">
				<?php pixelgrade_the_profile_photo(); ?>
            </div>
        </div>
	<?php }
}

add_action( 'noto_profile_photo', 'noto_profile_photo', 10 );


if ( ! function_exists( 'noto_search_icon' ) ) {
	/**
	 * Add the markup for the Noto Search Icon.
	 */
	function noto_search_icon() { ?>

        <div class="search-trigger">
            <button class="js-search-trigger">
				<?php get_template_part( 'template-parts/svg/icon-search-svg' ); ?>
                <span class="screen-reader-text"><?php esc_html_e( 'Search', '__theme_txtd' ); ?></span>
            </button>
        </div>
		<?php
	}
}

add_action( 'noto_search_icon', 'noto_search_icon', 10 );


if ( ! function_exists( 'noto_post_navigation' ) ) {
	/**
	 * Add the markup for the posts navigation.
	 */
	function noto_post_navigation() {

		pixelgrade_the_post_navigation();

	}
}

add_action( 'noto_post_navigation', 'noto_post_navigation', 10 );


