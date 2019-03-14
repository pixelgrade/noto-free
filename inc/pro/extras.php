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


/**
 * Handle the specific Pixelgrade Care integration.
 *
 * @package Noto
 * @since 1.0.0
 */
function noto_setup_pixelgrade_care() {
	/*
	 * Declare support for Pixelgrade Care
	 */
	add_theme_support( 'pixelgrade_care', array(
			'support_url'   => 'https://pixelgrade.com/docs/noto/',
			'changelog_url' => 'https://wupdates.com/noto-changelog',
		)
	);
}

add_action( 'after_setup_theme', 'noto_setup_pixelgrade_care', 10 );

/**
 * Output the wave card SVG code.
 */
function noto_output_wave_svg() {
	if ( pixelgrade_option( 'pattern_style' ) != 'none' ) { ?>
        <div class="wave-svg-mask">
            <div class="wave-svg"
                 style='background-image: <?php echo esc_attr( noto_get_pattern_background_image() ); ?>'></div>
        </div>
	<?php }
}
add_action( 'pixelgrade_before_excerpt', 'noto_output_wave_svg' );


/**
 * Initialize custom widgets.
 *
 * @since 1.1.0
 *
 * @param array $config
 *
 * @return array
 */
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
add_filter( 'pixelgrade_blog_initial_config', 'noto_alter_blog_component_config', 10 );

/**
 * Modify the Footer widget area settings.
 *
 * @param array $config
 *
 * @return array
 */
function noto_alter_footer_component_config( $config ) {
	$config = Pixelgrade_Config::merge( $config, array(
		'sidebars' => array(
			'sidebar-footer' => array(
				'sidebar_args' => array(
					'before_title' => '<h2 class="widget__title h4"><span>',
					'after_title'  => '</span></h2>',
				),
			)
		)
	) );

	return $config;
}
add_filter( 'pixelgrade_footer_initial_config', 'noto_alter_footer_component_config', 10 );


/**
 * Adds CSS to hide header text for custom logo, based on Customizer setting.
 */
function _noto_custom_logo_header_styles() {
	if ( ! current_theme_supports( 'custom-header', 'header-text' ) && get_theme_support( 'custom-logo', 'header-text' ) ) {
		// remove the default core hook that handles the custom inline CSS for hiding the Site Title & Description.
		remove_action( 'wp_head', '_custom_logo_header_styles', 10 );

		$classes = array();
		if ( ! pixelgrade_option( 'display_site_title' ) ) {
			$classes[] = '.site-title';
		}
		if ( ! pixelgrade_option( 'display_site_description' ) ) {
			$classes[] = '.site-description-text';
		}
		if ( empty( $classes ) ) {
			return;
		}

		$classes = array_map( 'sanitize_html_class', $classes );
		$classes = implode( ', ', $classes );

		?>
        <!-- Custom Logo: hide header text -->
        <style id="custom-logo-css" type="text/css">
            <?php echo $classes; ?>
            {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }
        </style>
		<?php
	}
}
add_action( 'wp_head', '_noto_custom_logo_header_styles', 9 );


/**
 * Add the markup for the Noto reading progress bar.
 */
function noto_reading_progress() {

    get_template_part( 'template-parts/reading-progress' );

}
add_action('pixelgrade_after_render_block_blog/entry-footer/single_content', 'noto_reading_progress');


/**
 * Add the markup for the Noto Search Icon.
 */
function noto_search_icon() { ?>

<div class="search-trigger">
	<button class="js-search-trigger">
		<?php get_template_part( 'template-parts/svg/icon-search' );?>
		<span class="screen-reader-text"><?php esc_html_e( 'Search', '__theme_txtd' ); ?></span>
	</button>
</div>
    <?php
}
add_action('pixelgrade_header_after_navbar_content', 'noto_search_icon', 20);
