<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Noto
 * @since 1.1.0
 */

if ( ! function_exists( 'noto_google_fonts_url' ) ) :
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
endif;

if ( ! function_exists( 'noto_append_svg_to_footer' ) ) :
	/**
	 *  Output the wave quote svg code in the footer.
	 */
	function noto_append_svg_to_footer() {
		$accent = pixelgrade_option( 'accent_color', '#FFB1A5' );
		?>
        <div class="wave-svg js-pattern-template"
             style='background-image: <?php echo noto_get_pattern_background_image(); ?>' hidden></div>
        <div class="wave-svg js-pattern-accent-template"
             style='background-image: <?php echo noto_get_pattern_background_image( $accent ); ?>' hidden></div>
	<?php }
endif;
add_action( 'pixelgrade_after_footer', 'noto_append_svg_to_footer' );

if ( ! function_exists( 'noto_hide_comments_by_default' ) ) {
	/**
	 * Prevent the comments from being shown by default.
	 *
	 * It will force the comments display control to be unchecked.
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	function noto_hide_comments_by_default( $string ) {
		return '';
	}
}
add_filter( 'pixelgrade_get_comments_toggle_checked_attribute', 'noto_hide_comments_by_default' );

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


if ( ! function_exists( 'noto_get_the_reading_time_in_minutes' ) ) {
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
}

if ( ! function_exists( 'noto_add_decoration_to_card_meta' ) ) {

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
}
add_filter( 'pixelgrade_get_post_meta', 'noto_add_decoration_to_card_meta', 10 );


/**
 * Add the required features regarding the header component, mainly options regarding menus.
 *
 * @param array $config The array containing all the active features of the theme.
 *
 * @return array
 */
function noto_alter_header_component_config( $config ) {

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
		$config = Pixelgrade_Config::merge( $config, array(
			'menu_locations' => array(
				'primary-right' => array(
					'title'         => esc_html__( 'Header Bottom', '__theme_txtd' ),
					'nav_menu_args' => array()
				)
			)
		) );
	}

	return $config;
}
add_filter( 'pixelgrade_header_config', 'noto_alter_header_component_config', 10 );

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
 * Add the list of tags the post.
 *
 * @param string $content Content of a post.
 *
 * @return string
 */
function noto_add_tags_list( $content ) {

	$tags_content = '';

	// Hide tag text for pages.
	$add = ( 'post' === get_post_type() && is_singular( 'post' ) && is_main_query() );
	if ( apply_filters( 'pixelgrade_add_tags_to_content', $add ) ) {
		$tags_list = get_the_tag_list();

		if ( ! empty( $tags_list ) ) {
			$tags_content .= '<div class="tags"><div class="tags__title">' . esc_html__( 'Tags', '__theme_txtd' ) . sprintf( '</div>' . esc_html__( '%1$s', '__theme_txtd' ) . '</div>', $tags_list ); // WPCS: XSS OK.
		}
	}

	return $content . $tags_content;
}

// add this filter with a priority smaller than sharedaddy - it has 19
remove_filter( 'the_content', 'pixelgrade_add_tags_list', 18 );
add_filter( 'the_content', 'noto_add_tags_list', 18 );

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
 * Add our customizer styling edits into the wp_editor.
 */
function noto_add_css_for_autostyled_intro_in_editor() {
	$disable_intro_autostyle = pixelgrade_option( 'single_disable_intro_autostyle', true );
	$color                   = pixelgrade_option( 'secondary_color', '#E79696' );

	if ( ! $disable_intro_autostyle ) {
		$selectors = array(
			".intro[class], .mce-content-body > p:first-child",
			".intro[class]:before, .mce-content-body > p:first-child:before",
		);
	} else {
		$selectors = array(
			".intro[class]",
			".intro[class]:before",
		);
	}

	$css =
		$selectors[0] . ' { ' .
		'font-size: 1.555em;' .
		'line-height: 1.25em;' .
		'font-style: italic;' .
		'color: ' . $color . ';' .
		' } ' .
		$selectors[1] . ' { ' .
		'content: "";' .
		'display: block;' .
		'height: 8px;' .
		'margin-bottom: 21px;' .
		'background: ' . noto_get_pattern_background_image( $color ) . ';' .
		' } ';

	if ( ! $disable_intro_autostyle ) { ?>
        <script>
            (function ($) {
                $(window).load(function () {
                    var ifrm = window.frames['content_ifr'];
                    if (typeof ifrm === "undefined") {
                        return;
                    }
                    ifrm = (
                        ifrm.contentDocument || ifrm.document
                    );
                    var head = ifrm.getElementsByTagName('head')[0];
                    var style = document.createElement('style');
                    var css = '<?php echo $css; ?>';
                    style.type = 'text/css';
                    if (style.styleSheet) {
                        // This is required for IE8 and below.
                        style.styleSheet.cssText = css;
                    } else {
                        style.appendChild(document.createTextNode(css));
                    }

                    head.appendChild(style);
                });
            })(jQuery);
        </script>
		<?php get_template_part( 'template-parts/svg/wave-accent-svg' );
	}
}
add_action( 'admin_head', 'noto_add_css_for_autostyled_intro_in_editor' );

/**
 * Add the markup for the Noto Profile Photo.
 */
function noto_profile_photo() { ?>
    <div class="c-profile-photo">
        <div class="c-profile-photo__default">
			<?php pixelgrade_the_profile_photo(); ?>
        </div>
    </div>
	<?php
}

/**
 * Check the users' access level.
 *
 */
function noto_maybe_load_pro_features() {
	if ( true === pixelgrade_user_has_access( 'pro-features' ) ) {
		pixelgrade_autoload_dir( 'inc/pro' );
	} else {
		pixelgrade_autoload_dir( 'inc/lite' );
	}
}
// We want to do this as early as possible. So the zero priority is as intended.
add_action( 'after_setup_theme', 'noto_maybe_load_pro_features', 0 );
