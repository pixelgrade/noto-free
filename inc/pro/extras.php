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
						'after_widget' => '</section></div>',
						'before_title'  => '<h2 class="widget__title h6"><span>',
						'after_title'   => '</span></h2>',
					),
				),
				'sidebar-2' => array(
					'sidebar_args' => array(
						'before_title' => '<h2 class="widget__title h4"><span>',
						'after_title' => '</span></h2>',
					),
				)
			)
		) );

		return $config;
	}
}
	add_filter( 'pixelgrade_blog_initial_config', 'noto_alter_blog_component_config', 10 );

