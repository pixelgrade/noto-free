<?php

if ( ! function_exists( 'boilerplate_google_fonts_url' ) ) :
	/**
	 * Register Google fonts for Julia.
	 *
	 * @since Julia 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function boilerplate_google_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';


		/* Translators: If there are characters in your language that are not
		* supported by IBM Plex Mono, translate this to 'off'. Do not translate
		* into your own language.
		*/
		if ( 'off' !== esc_html_x( 'on', 'IMB Plex Mono font: on or off', '__theme_txtd' ) ) {
			$fonts[] = 'IBM Plex Mono:500,500i';
		}

		/* Translators: If there are characters in your language that are not
		* supported by IBM Plex Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		if ( 'off' !== esc_html_x( 'on', 'IBM Plex Sans: on or off', '__theme_txtd' ) ) {
			$fonts[] = 'IBM Plex Sans:400,400i,700,700i';
		}

		/* Translators: If there are characters in your language that are not
		* supported by IBM Plex Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		if ( 'off' !== esc_html_x( 'on', 'IBM Plex Serif: on or off', '__theme_txtd' ) ) {
			$fonts[] = 'IBM Plex Serif:300i';
		}

		/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
		$subset = esc_html_x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', '__theme_txtd' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	} #function
endif;

if ( ! function_exists( 'pierot_output_wave_svg' ) ) :
	function pierot_output_wave_svg() {
		get_template_part( 'template-parts/svg/wave-card-svg' );
	}
endif;
add_action( 'pixelgrade_before_excerpt', 'pierot_output_wave_svg' );

if ( ! function_exists( 'pierot_append_svg_to_footer' ) ) :
	function pierot_append_svg_to_footer() {
		get_template_part( 'template-parts/svg/wave-quote-svg' );
	}
endif;
add_action( 'pixelgrade_after_footer', 'pierot_append_svg_to_footer' );

if ( ! function_exists( 'pierot_hide_comments_by_default' ) ) {
	function pierot_hide_comments_by_default( $string ) {
			return '';
	}
}
add_filter( 'pixelgrade_get_comments_toggle_checked_attribute', 'pierot_hide_comments_by_default' );

function pierot_dequeue_scripts() {
	wp_dequeue_style( 'jetpack-social-menu' );
}
add_action( 'wp_enqueue_scripts', 'pierot_dequeue_scripts', 20 );

/**
 * Display the hidden "Styles" drop-down in the Advanced editor bar.
 *
 * @see https://codex.wordpress.org/TinyMCE_Custom_Styles
 */
function pierot_mce_editor_buttons( $buttons ) {
	array_unshift($buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'mce_buttons_2', 'pierot_mce_editor_buttons' );

/**
 * Add styles/classes to the "Styles" drop-down.
 *
 * @since Julia 1.0
 *
 * @see https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 * @param array $settings
 *
 * @return array
 */
function pierot_mce_before_init( $settings ) {

	$style_formats =array(
		array( 'title' => esc_html__( 'Display', '__theme_txtd' ), 'block' => 'h1', 'classes' => 'h0'),
		array( 'title' => esc_html__( 'Intro Text', '__theme_txtd' ), 'selector' => 'p', 'classes' => 'intro'),
		array( 'title' => esc_html__( 'Dropcap', '__theme_txtd' ), 'inline' => 'span', 'classes' => 'dropcap' ),
		array( 'title' => esc_html__( 'Button Arrow', '__theme_txtd' ), 'selector' => 'a', 'classes' => 'button arrow' ),
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;
}
add_filter( 'tiny_mce_before_init', 'pierot_mce_before_init' );