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
