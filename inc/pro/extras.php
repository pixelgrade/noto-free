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

function noto_pro_gutenberg_styles() {

	$style = '
	    .edit-post-visual-editor[class] blockquote:before {
            background-image: ' . noto_get_pattern_background_image() .'
        }';

	wp_add_inline_style( 'noto-gutenberg', $style );
}
add_action( 'enqueue_block_editor_assets', 'noto_pro_gutenberg_styles' );

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
add_action( 'pixelgrade_header_after_navbar_content', 'noto_search_icon', 20 );

if ( ! function_exists( 'noto_append_svg_to_footer' ) ) {
	/**
	 *  Output the wave quote svg code in the footer.
	 */
	function noto_append_svg_to_footer() {
		$accent = pixelgrade_option( 'accent_color', '#FFB1A5' );
		?>
		<div class="wave-svg js-pattern-template"
		     style='background-image: <?php echo esc_attr( noto_get_pattern_background_image() ); ?>' hidden></div>
		<div class="wave-svg js-pattern-accent-template"
		     style='background-image: <?php echo esc_attr( noto_get_pattern_background_image( $accent ) ); ?>'
		     hidden></div>
	<?php }
}
add_action( 'pixelgrade_after_footer', 'noto_append_svg_to_footer' );
