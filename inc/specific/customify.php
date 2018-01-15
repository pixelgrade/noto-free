<?php
/**
 * Custom functions related to Customify.
 *
 * Some of the Customify controls come straight from components.
 * If you need to customize the settings for those controls you can use the appropriate filter.
 * For details search for the add_customify_options() function in the main component class (usually in class-componentname.php).
 *
 * Development notice: This file is synced from the variations directory! Do not edit in the `inc` directory!
 *
 * @package Boilerplate
 * @since 1.0.0
 */

// @todo standardize naming here
add_filter( 'pixelgrade_customify_general_section_options', 'variation_change_customify_general_section', 20, 2 );
add_filter( 'pixelgrade_header_customify_section_options', 'variation_change_customify_header_section_options', 20, 2 );
add_filter( 'pixelgrade_customify_main_content_section_options', 'variation_change_customify_main_content', 20, 2 );
add_filter( 'pixelgrade_customify_buttons_section_options', 'variation_change_customify_buttons', 20, 2 );
add_filter( 'pixelgrade_footer_customify_section_options', 'variation_change_customify_footer_section_options', 20, 2 );
add_filter( 'pixelgrade_customify_blog_grid_section_options', 'variation_change_customify_blog_grid_section', 20, 2 );

define( 'VARIATION_TEXT_COLOR', '#333131' );
define( 'VARIATION_ACCENT_COLOR', '#ff6000' );

define( 'VARIATION_SERIF_FONT', 'Charter' );
define( 'VARIATION_SANS_SERIF_FONT', 'HK Grotesk' );
define( 'VARIATION_SITE_TITLE_FONT', 'Caudex' );

function variation_change_customify_general_section( $general_section, $options ) {

	$modified_config = array(
		'general' => array(
			'options' => array(
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$general_section = Pixelgrade_Config::merge( $general_section, $modified_config );

	return $general_section;
}

/**
 * Main Content Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $section_options The modified specific config
 */
function variation_change_customify_main_content( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(
		// Main Content
		'main_content' => array(
			'options' => array(
				'main_content_content_width'            => array(
					'default' => 885,
				),
				'main_content_border_width'             => array(
					'default' => 0,
				),
				'main_content_page_title_color'         => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_body_text_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_body_link_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_body_link_active_color'   => array(
					'default' => VARIATION_ACCENT_COLOR,
				),
				'main_content_heading_1_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_heading_2_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_heading_3_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_heading_4_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_heading_5_color'          => array(
					'default' => VARIATION_TEXT_COLOR,
				),
				'main_content_heading_6_color'          => array(
					'default' => VARIATION_ACCENT_COLOR,
				),

				// [Sub Section] Backgrounds
				'main_content_content_background_color' => array(
					'default' => '#FFFCFC',
				),

				// [Section] FONTS
				'main_content_page_title_font'          => array(
					'default' => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '700',
						'font-size'      => 50,
						'line-height'    => 1.2,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_body_text_font' => array(
					'default' => array(
						'font-family'    => VARIATION_SERIF_FONT,
						'font-weight'    => '400',
						'font-size'      => 17,
						'line-height'    => 1.6,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_quote_block_font' => array(
					'default' => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '700',
						'font-size'      => 50,
						'line-height'    => 1.2,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				// [Sub Section] Headings Fonts
				'main_content_heading_1_font'   => array(
					'default' => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '700',
						'font-size'      => 36,
						'line-height'    => 1.1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_2_font' => array(
					'default' => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '700',
						'font-size'      => 26,
						'line-height'    => 1.,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_3_font' => array(
					'default' => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '700',
						'font-size'      => 21,
						'line-height'    => 1.2,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_4_font' => array(
					'default' => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '500',
						'font-size'      => 16,
						'line-height'    => 1.2,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_5_font' => array(
					'selector' => '.entry-content h5, .h5, h5, .header-meta, .nav-links__label',
					'default' => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '700',
						'font-size'      => 14,
						'line-height'    => 1.2,
						'letter-spacing' => 0.15,
						'text-transform' => 'uppercase',
					),
				),

				'main_content_heading_6_font' => array(
					'default' => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '500',
						'font-size'      => 13,
						'line-height'    => 1.2,
						'letter-spacing' => 0.15,
						'text-transform' => 'uppercase',
					),
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

/**
 * Buttons Section
 *
 * @param array $main_content_section The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function variation_change_customify_buttons( $section_options, $options ) {

	$button_selector = '
		.c-btn,
		.c-card__action,
		button[type=button],
		button[type=reset],
		button[type=submit],
		input[type=button],
		input[type=submit],
		div.jetpack-recipe .jetpack-recipe-print[class] a,
		.featured-posts__more,
		.entry-content .cats[class] > a,
		.meta__item--button';

	$new_section_options = array(

		// Main Content
		'buttons' => array(
			'options' => array(
				'buttons_color' => array(
					'default' => VARIATION_ACCENT_COLOR,
					'css' => array(
						array(
							'property' => 'background-color',
							'selector' => $button_selector,
						),
					),
				),
				'buttons_text_color' => array(
					'default' => '#FFFFFF',
					'css' => array(
						array(
							'property' => 'color',
							'selector' => $button_selector,
						),
					),
				),
				'buttons_font' => array(
					'selector' => $button_selector,
					'default'  => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '500',
						'font-size'      => 16,
						'line-height'    => 1.2,
						'letter-spacing' => 0,
					),
				),
			)
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}


/**
 * Modify the Customify config for the Blog Grid Section - from the Base component
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $blog_grid_section The modified specific config
 */
function variation_change_customify_blog_grid_section( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(
		// Blog Grid
		'blog_grid' => array(
			'options' => array(
				// [Section] Layout
				'blog_items_aspect_ratio'        => array(
					'default' => 120,
				),
				'blog_items_vertical_spacing'    => array(
					'default' => 40,
				),
				'blog_items_horizontal_spacing'  => array(
					'default' => 40,
				),
				// [Section] COLORS
				'blog_item_title_color'          => array(
					'default' => '#333131',
				),
				'blog_item_meta_primary_color'   => array(
					'default' => VARIATION_ACCENT_COLOR,
				),
				'blog_item_meta_secondary_color' => array(
					'default' => VARIATION_ACCENT_COLOR,
				),
				// [Section] FONTS
				'blog_item_title_font'           => array(
					'default' => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '700',
						'font-size'      => 21,
						'line-height'    => 1.3,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_meta_font'            => array(
					'default' => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '500',
						'font-size'      => 13,
						'line-height'    => 1.1,
						'letter-spacing' => 0.1,
						'text-transform' => 'uppercase',
					),
				),
				'blog_item_excerpt_font' => array(
					'default' => array(
						'font-family'    => VARIATION_SERIF_FONT,
						'font-weight'    => '400',
						'font-size'      => 16,
						'line-height'    => 1.5,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}


/**
 * Modify the Customify config for the Header Component
 *
 * @param array $section_options
 *
 * @return array
 */
function variation_change_customify_header_section_options( $section_options, $options ) {

	$new_section_options = array(
		'header_section' => array(
			'options' => array(
				// [Section] Layout
				'header_navigation_links_spacing' => array(
					'default' => 56,
				),
				'header_width' => array(
					'default' => 'container',
				),
				// [Section] Colors
				'header_navigation_links_color'    => array(
					'default' => '#323232',
				),
				'header_links_active_color'        => array(
					'default' => VARIATION_ACCENT_COLOR,
				),
				'header_background'                => array(
					'default' => '#fff4e8',
				),
				'header_site_title_font'           => array(
					'fields'  => array(
						'font-size' => array(
							'max' => 150,
						),
					),
					'default' => array(
						'font-family'    => VARIATION_SITE_TITLE_FONT,
						'font-weight'    => '700',
						'font-size'      => 100,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'header_navigation_font'           => array(
					'default' => array(
						'font-family'    => VARIATION_SANS_SERIF_FONT,
						'font-weight'    => '500',
						'font-size'      => 16,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none'
					),
				),
			),
		),
	);

	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}


/**
 * Modify the Customify config for the Footer Component
 *
 * @param array $section_options
 *
 * @return array
 */
function variation_change_customify_footer_section_options( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(
		// Footer
		'footer_section' => array(
			'options' => array(
				'footer_layout'          => array(
					'default' => 'row',
				),
				'footer_bottom_spacing'  => array(
					'default' => 56,
					'css'         => array(
						// Component
						array(
							'property'        => 'padding-bottom',
							'selector'        => '.u-footer-bottom-spacing',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
						// Custom for Julia/Felt
						array(
							'property' => 'padding-top',
							'selector' => '.c-footer__zone--bottom:not(:first-child)',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
					),
				),
				'footer_top_spacing'     => array(
					'default' => 80,
					'css'     => array(
						// Component
						array(
							'property'        => 'padding-top',
							'selector'        => '.u-footer-top-spacing',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
						// Custom for Julia/Felt
						array(
							'property' => 'margin-top',
							'selector' => '.c-footer__zone:not(:empty)+.c-footer__zone',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
					),
				),
				// [Section] COLORS
				'footer_body_text_color' => array(
					'default' => '#FFFFFF',
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.c-footer, .widget.dark'
						),
					),
				),
				'footer_links_color' => array(
					'default' => '#FFFFFF'
				),
				'footer_background'      => array(
					'default' => '#1C1C1C',
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => '.u-footer-background, .widget.dark',
						),
					),
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

// Custom single post header width for the case in which there is no sidebar.
// In this case, the header's width is container-width + sidebar-width (300)
// @todo Are these needed in the BOILERPLATE and is their place here?
function boilerplate_container_width_single_header( $value, $selector, $property, $unit ) {
	$output = '';
	$value  = $value - 300;

	$output .= $selector . ' {' . PHP_EOL .
	           $property . ': ' . $value . $unit . ';' . PHP_EOL .
	           '}' . PHP_EOL;

	return $output;
}

function boilerplate_single_header_width( $value, $selector, $property, $unit ) {
	$output = '';

	$output .= $selector . ' {' . PHP_EOL .
	           $property . ': ' . ( $value + 300 + 112 + 56 ) . 'px;' . PHP_EOL .
	           '}' . PHP_EOL;

	return $output;
}
