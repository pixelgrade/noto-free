<?php

if ( ! function_exists( 'noto_google_fonts_url' ) ) :
	/**
	 * Register Google fonts for Julia.
	 *
	 * @since Julia 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function noto_google_fonts_url() {
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
			$fonts[] = 'IBM Plex Sans:400,400i,500,500i,600,600i,700,700i';
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

if ( ! function_exists( 'noto_output_wave_svg' ) ) :
	function noto_output_wave_svg() {
		get_template_part( 'template-parts/svg/wave-card-svg' );
	}
endif;
add_action( 'pixelgrade_before_excerpt', 'noto_output_wave_svg' );

if ( ! function_exists( 'noto_append_svg_to_footer' ) ) :
	function noto_append_svg_to_footer() {
		get_template_part( 'template-parts/svg/wave-quote-svg' );
	}
endif;
add_action( 'pixelgrade_after_footer', 'noto_append_svg_to_footer' );

if ( ! function_exists( 'noto_hide_comments_by_default' ) ) {
	function noto_hide_comments_by_default( $string ) {
			return '';
	}
}
add_filter( 'pixelgrade_get_comments_toggle_checked_attribute', 'noto_hide_comments_by_default' );

function noto_dequeue_scripts() {
	wp_dequeue_style( 'jetpack-social-menu' );
}
add_action( 'wp_enqueue_scripts', 'noto_dequeue_scripts', 20 );

/**
 * Display the hidden "Styles" drop-down in the Advanced editor bar.
 *
 * @see https://codex.wordpress.org/TinyMCE_Custom_Styles
 */
function noto_mce_editor_buttons( $buttons ) {
	array_unshift($buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'mce_buttons_2', 'noto_mce_editor_buttons' );

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
function noto_mce_before_init( $settings ) {

	$style_formats =array(
		array( 'title' => esc_html__( 'Intro Text', '__theme_txtd' ), 'selector' => 'p', 'classes' => 'intro'),
		array( 'title' => esc_html__( 'Dropcap', '__theme_txtd' ), 'inline' => 'span', 'classes' => 'dropcap'),
		array( 'title' => esc_html__( 'Pull Left', '__theme_txtd' ), 'block' => 'div', 'classes' => 'pull-left' ),
		array( 'title' => esc_html__( 'Pull Right', '__theme_txtd' ), 'block' => 'div', 'classes' => 'pull-right' ),
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;
}
add_filter( 'tiny_mce_before_init', 'noto_mce_before_init' );

if ( ! function_exists( 'noto_get_the_reading_time_in_minutes' ) ) {
	function noto_get_the_reading_time_in_minutes() {
		$words_per_minute = 200;
		$words_per_second = $words_per_minute / 60;

		$content = get_the_content();
		$word_count = str_word_count( strip_tags( $content ) );
		$seconds = floor( $word_count / $words_per_second );
		$minutes = floor( $word_count / $words_per_minute );
		$seconds_remainder = $seconds % 60;

		if ( $minutes < 1 || $seconds_remainder > 40 ) {
			$minutes++;
		}

		return $minutes;
	}
}

if ( ! function_exists( 'noto_add_decoration_to_card_meta' ) ) {

	function noto_add_decoration_to_card_meta( $meta ) {
		if ( ! empty( $meta['category'] ) ) {
			$category = '';
			// On archives we want to show all the categories, not just the main one
			$categories = get_the_terms( get_the_ID(), 'category' );
			if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
				$category .= '<span class="screen-reader-text">' . esc_html__( 'Categories', '__components_txtd' ) . '</span><ul>' . PHP_EOL;
				foreach ( $categories as $this_category ) {
					$category .= '<li>' . PHP_EOL;
					$category .= '<a href="' . esc_url( get_category_link( $this_category ) ) . '" rel="category">' . $this_category->name . '</a>' . PHP_EOL;
					// $category .= '<div class="c-meta__decoration"></div>' . PHP_EOL;
					$category .= '</li>' . PHP_EOL;
				};
				$category .= '</ul>' . PHP_EOL;
			}
			$meta['category'] = $category;
		}

		return $meta;
	}
}
add_filter( 'pixelgrade_get_post_meta', 'noto_add_decoration_to_card_meta', 10 );


if ( ! function_exists( 'noto_alter_header_component_config' ) ) {

	function noto_alter_header_component_config( $config ) {

		$config = Pixelgrade_Config::merge( $config, array(
			'menu_locations' => array(
				'primary-left' => array(
					'title'    => esc_html__( 'Header Top', '__components_txtd' ),
				),
				'primary-right'  => array(
					'title'    => esc_html__( 'Header Bottom', '__components_txtd' ),
					'nav_menu_args' => array(
						
					)
				)
			)
		) );

		return $config;
	}
}
add_filter( 'pixelgrade_header_config', 'noto_alter_header_component_config', 10 );


if ( ! function_exists( 'noto_alter_blog_component_config' ) ) {

	function noto_alter_blog_component_config( $config ) {

		$config = Pixelgrade_Config::merge( $config, array(
			'sidebars' => array(
                'sidebar-1' => array(
	                'sidebar_args' => array(
                		'name'          => esc_html__( 'Posts Grid Widgets', '__components_txtd' ),
                    	'description'   => esc_html__( 'Insert your favorite widgets here, and we will place them throughout the Frontpage posts grid.', '__components_txtd' ),
	                    'before_widget' => '<div class="c-gallery__item c-gallery__item--widget %2$s"><section id="%1$s" class="widget">',
	                    'after_widget' => '</section></div>',
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


if ( ! function_exists( 'noto_alter_footer_component_config' ) ) {

	function noto_alter_footer_component_config( $config ) {
		$config = Pixelgrade_Config::merge( $config, array(
			'sidebars' => array(
				'sidebar-footer' => array(
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
add_filter( 'pixelgrade_footer_initial_config', 'noto_alter_footer_component_config', 10 );

/**
 * Change the Tag Cloud's Font Sizes.
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array
 */
function noto_change_tag_cloud_font_sizes( array $args ) {
	$args['smallest'] = '1.25';
	$args['largest'] = '2';
	$args['unit'] = 'rem';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'noto_change_tag_cloud_font_sizes');

function noto_add_tags_list( $content ) {

	$tags_content = '';

	// Hide tag text for pages.
	$add = ( 'post' === get_post_type() && is_singular( 'post' ) && is_main_query() );
	if ( apply_filters( 'pixelgrade_add_tags_to_content', $add ) ) {
		$tags_list = get_the_tag_list( '', ', ' );

		if ( ! empty( $tags_list ) ) {
			$tags_content .= '<div class="tags"><div class="tags__title">' . esc_html__( 'Tags', '__components_txtd' ) . sprintf( '</div>' . esc_html__( '%1$s', '__components_txtd' ) . '</div>', $tags_list ); // WPCS: XSS OK.
		}
	}

	return $content . $tags_content;
}
// add this filter with a priority smaller than sharedaddy - it has 19
remove_filter( 'the_content', 'pixelgrade_add_tags_list', 18 );
add_filter( 'the_content', 'noto_add_tags_list', 18 );

function noto_add_card_meta_decoration( $location ) { ?>

	<div class="c-meta__decoration"></div>

<?php }
add_action( 'pixelgrade_after_card_meta', 'noto_add_card_meta_decoration', 10, 1 );
