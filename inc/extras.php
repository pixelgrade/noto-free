<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Noto
 * @since 1.1.0
 */

if ( ! function_exists( 'noto_google_fonts_url' ) ) {
	/**
	 * Register Google fonts for Noto.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function noto_google_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';


		/* Translators: If there are characters in your language that are not
		* supported by Bungee, translate this to 'off'. Do not translate
		* into your own language.
		*/
		if ( 'off' !== esc_html_x( 'on', 'Bungee font: on or off', '__theme_txtd' ) ) {
			$fonts[] = 'Bungee';
		}

		if ( 'off' !== esc_html_x( 'on', 'IBM Plex Sans font: on or off', '__theme_txtd' ) ) {
			$fonts[] = 'IBM Plex Sans:300,400,500,700';
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
}


/**
 * Prevent the comments from being shown by default.
 */
add_filter( 'pixelgrade_get_comments_toggle_checked_attribute', '__return_empty_string' );

/**
 * Dequeue various scripts.
 */
function noto_dequeue_scripts() {
	// Dequeue the Jetpack Social Menu Javascript as we don't need it.
	wp_dequeue_style( 'jetpack-social-menu' );
}
add_action( 'wp_enqueue_scripts', 'noto_dequeue_scripts', 20 );

/**
 * Display the hidden "Styles" drop-down in the Advanced editor bar.
 *
 * @see https://codex.wordpress.org/TinyMCE_Custom_Styles
 */
function noto_mce_editor_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}
add_filter( 'mce_buttons_2', 'noto_mce_editor_buttons' );

/**
 * Add styles/classes to the "Styles" drop-down.
 *
 * @see https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 * @param array $settings
 *
 * @return array
 */
function noto_mce_before_init( $settings ) {

	$style_formats = array(
		array( 'title' => esc_html__( 'Intro Text', '__theme_txtd' ), 'selector' => 'p', 'classes' => 'intro' ),
		array( 'title' => esc_html__( 'Highlight', '__theme_txtd' ), 'inline' => 'span', 'classes' => 'highlight' ),
		array( 'title' => esc_html__( 'Dropcap', '__theme_txtd' ), 'inline' => 'span', 'classes' => 'dropcap' ),
		array(
			'title'   => esc_html__( 'Pull Left', '__theme_txtd' ),
			'wrapper' => true,
			'block'   => 'blockquote',
			'classes' => 'pull-left'
		),
		array(
			'title'   => esc_html__( 'Pull Right', '__theme_txtd' ),
			'wrapper' => true,
			'block'   => 'blockquote',
			'classes' => 'pull-right'
		),
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;
}
add_filter( 'tiny_mce_before_init', 'noto_mce_before_init' );

/**
 * Calculate the reading time in minutes for the current post's content.
 *
 * @return float
 */
function noto_get_the_reading_time_in_minutes() {
	$words_per_minute = 200;
	$words_per_second = $words_per_minute / 60;
	$content           = get_the_content();
	$word_count        = str_word_count( strip_tags( $content ) );
	$seconds           = floor( $word_count / $words_per_second );
	$minutes           = floor( $word_count / $words_per_minute );
	$seconds_remainder = $seconds % 60;
	if ( $minutes < 1 || $seconds_remainder > 40 ) {
		$minutes ++;
	}
	return $minutes;
}

function noto_add_decoration_to_card_meta( $meta ) {
	if ( ! empty( $meta['category'] ) ) {
		$category = '';
		// On archives we want to show all the categories, not just the main one
		$categories = get_the_terms( get_the_ID(), 'category' );
		if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
			$category .= '<span class="screen-reader-text">' . esc_html__( 'Categories', '__theme_txtd' ) . '</span><ul>' . PHP_EOL;
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
add_filter( 'pixelgrade_get_post_meta', 'noto_add_decoration_to_card_meta', 10 );

/**
 * Change the Tag Cloud's Font Sizes.
 *
 * @param array $args
 *
 * @return array
 */
function noto_change_tag_cloud_font_sizes( array $args ) {
	$args['smallest'] = '1.25';
	$args['largest']  = '2';
	$args['unit']     = 'rem';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'noto_change_tag_cloud_font_sizes' );

/**
 * Add card meta decoration.
 */
function noto_add_card_meta_decoration( $location ) { ?>
    <div class="c-meta__decoration"></div>
<?php }
add_action( 'pixelgrade_after_card_meta', 'noto_add_card_meta_decoration', 10, 1 );

/**
 * Add specific classes for Archive page.
 */
function noto_alter_archive_post_classes( $classes = array() ) {
	$location = pixelgrade_get_location();

	if ( pixelgrade_in_location( 'index blog post portfolio jetpack', $location, false ) && ! is_single() ) {
		$classes[] = 'c-noto__item';
		$classes[] = 'c-noto__item--post';

		if ( has_post_thumbnail() ) {
			$classes[] = 'c-noto__item--image';
		} else {
			$classes[] = 'c-noto__item--no-image';
		}
	}

	return $classes;
}
add_filter( 'post_class', 'noto_alter_archive_post_classes', 20, 1 );

/**
 * Add specific classes for Body.
 *
 * @param array $classes Contains the CSS classes that will be used.
 *
 * @return array
 */
function noto_alter_body_classes( $classes ) {

	if ( is_singular() && ! pixelgrade_option( 'single_disable_intro_autostyle', true ) ) {
		$classes[] = 'u-intro-autostyle';
	}

	if ( ! pixelgrade_option( 'archive_disable_image_animations', false ) ) {
		$classes[] = 'u-featured-images-animation';
	}

	$pattern   = pixelgrade_option( 'pattern_style', 'wave' );
	$classes[] = 'u-pattern-' . $pattern;

	return $classes;
}

add_filter( 'body_class', 'noto_alter_body_classes', 20, 1 );

/**
 *
 * @param $posts_per_page
 *
 * @return int
 */
function noto_posts_per_page( $posts_per_page ) {
	if ( $posts_per_page < 20 ) {
		return 20;
	}

	return $posts_per_page;
}
add_filter( 'option_posts_per_page', 'noto_posts_per_page', 10, 1 );

/**
 * Handle the WUpdates theme identification.
 *
 * @param array $ids
 *
 * @return array
 */
function noto_wupdates_add_id_wporg( $ids = array() ) {

	// First get the theme directory name (unique)
	$slug = basename( get_template_directory() );

	// Now add the predefined details about this product
	// Do not tamper with these please!!!
	$ids[ $slug ] = array( 'name' => 'Noto', 'slug' => 'noto', 'id' => 'JDKZB', 'type' => 'theme_wporg', 'digest' => '315a30c0a1ab97ffb5118d4d17d09f61', );

	return $ids;
}
// The 5 priority is intentional to allow for pro to overwrite.
add_filter( 'wupdates_gather_ids', 'noto_wupdates_add_id_wporg', 5, 1 );

/**
 * Output the profile photo before the rest of the branding.
 */
add_action( 'pixelgrade_header_before_brading_content', 'noto_the_profile_photo' );

function noto_maybe_load_pro_features() {
	if ( true === pixelgrade_user_has_access( 'pro-features' ) ) {
		pixelgrade_autoload_dir( 'inc/pro' );
	} else {
		pixelgrade_autoload_dir( 'inc/lite' );
	}
}
// We want to do this as early as possible. So the zero priority is as intended.
add_action( 'after_setup_theme', 'noto_maybe_load_pro_features', 0 );
