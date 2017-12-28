<?php
/**
 * =====================
 * Some of the Customify controls come straight from components.
 * If you need to customize the settings for those controls you can use the appropriate filter.
 * For details search for the add_customify_options() function in the main component class (usually in class-componentname.php).
 *
 */

// @todo standardize naming here
add_filter( 'pixelgrade_header_customify_section_options', 'variation_change_customify_header_section_options', 20, 2 );
add_filter( 'pixelgrade_customify_main_content_section_options', 'variation_customify_main_content', 20, 2 );
add_filter( 'pixelgrade_customify_buttons_section_options', 'variation_change_customify_buttons', 20, 2 );
add_filter( 'pixelgrade_footer_customify_section_options', 'variation_change_customify_footer_section_options', 20, 2 );
add_filter( 'pixelgrade_customify_blog_grid_section_options', 'variation_customify_blog_grid_section', 20, 2 );

/**
 * Main Content Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $section_options The modified specific config
 */
function variation_customify_main_content( $section_options, $options ) {

	$main_content_content_css   = $section_options['main_content']['options']['main_content_content_width']['css'];
	$main_content_content_css[] = array(
		'property'        => 'max-width',
		'selector'        => '.single.has-sidebar [class].entry-header [class].entry-content > *',
		'unit'            => 'px',
		'callback_filter' => 'boilerplate_single_header_width'
	);

	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(

		// Main Content
		'main_content' => array(
			'options' => array(
				'main_content_content_width'   => array(
					'css' => $main_content_content_css
				),

				// [Section] FONTS
				'main_content_page_title_font' => array(
					'default' => array(
						'font-family'    => 'Lora',
						'font-weight'    => '700',
						'font-size'      => 66,
						'line-height'    => 1.174,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_body_text_font' => array(
					'default' => array(
						'font-family'    => 'PT Serif',
						'font-weight'    => '400',
						'font-size'      => 17,
						'line-height'    => 1.6,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_quote_block_font' => array(
					'default' => array(
						'font-family'    => "Lora",
						'font-weight'    => '700',
						'font-size'      => 28,
						'line-height'    => 1.17,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				// [Sub Section] Headings Fonts
				'main_content_heading_1_font'   => array(
					'default' => array(
						'font-family'    => 'Lora',
						'font-weight'    => '700',
						'font-size'      => 44,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_2_font' => array(
					'default' => array(
						'font-family'    => 'Lora',
						'font-weight'    => '700',
						'font-size'      => 32,
						'line-height'    => 1.25,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_3_font' => array(
					'default' => array(
						'font-family'    => 'Lora',
						'font-weight'    => '700',
						'font-size'      => 24,
						'line-height'    => 1.25,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_4_font' => array(
					'default' => array(
						'font-family'    => 'PT Serif',
						'font-weight'    => '700',
						'font-size'      => 18,
						'line-height'    => 1.15,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_5_font' => array(
					'default' => array(
						'font-family'    => 'Montserrat',
						'font-weight'    => '600',
						'font-size'      => 14,
						'line-height'    => 1.167,
						'letter-spacing' => 0.154,
						'text-transform' => 'uppercase',
					),
				),

				'main_content_heading_6_font' => array(
					'default' => array(
						'font-family'    => 'Montserrat',
						'font-weight'    => '600',
						'font-size'      => 12,
						'line-height'    => 1.1818,
						'letter-spacing' => 0.154,
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
 * Main Content Section
 *
 * @param array $main_content_section The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function variation_change_customify_buttons( $section_options, $options ) {

	$new_section_options = array(

		// Main Content
		'buttons' => array(
			'options' => array(
				'buttons_color'      => array(
					'default' => '#000000'
				),
				'buttons_text_color' => array(
					'default' => '#FFFFFF'
				),
				'buttons_font'       => array(
					'selector' => '
						.c-btn,
						button[type=button],
						button[type=reset],
						button[type=submit],
						input[type=button],
						input[type=submit],
						.widget_nav_menu,
						.widget_pages,
						.jetpack-recipe-print',
					'default'  => array(
						'font-family' => 'Montserrat',
						'font-weight' => 'regular',
						'font-size'   => 16,
						'line-height' => 1.2,
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
function variation_customify_blog_grid_section( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(
		// Blog Grid
		'blog_grid' => array(
			'options' => array(
				// [Section] FONTS
				'blog_item_title_font'   => array(
					'selector' => 'c-card__title',
					'default'  => array(
						'font-family'    => 'Lora',
						'font-weight'    => '700',
						'font-size'      => 24,
						'line-height'    => 1.25,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_meta_font'    => array(
					'default' => array(
						'font-family'    => 'Montserrat',
						'font-weight'    => 'regular',
						'font-size'      => 14,
						'line-height'    => 1.071,
						'letter-spacing' => 0.071,
						'text-transform' => 'uppercase',
					),
				),
				'blog_item_excerpt_font' => array(
					'default' => array(
						'font-family'    => 'PT Serif',
						'font-weight'    => '400',
						'font-size'      => 17,
						'line-height'    => 1.6,
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
				'header_background'      => array(
					'css' => array(
						array(
							'property' => 'background-color',
							'selector' => $section_options['header_section']['options']['header_background']['css'][0]['selector'] .
							              ', .entry-content blockquote, .comment__content blockquote'
						)
					),
				),
				'header_site_title_font' => array(
					'default' => array(
						'font-family'    => 'Lora',
						'font-weight'    => '700',
						'font-size'      => 140,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'header_navigation_font' => array(
					'default' => array(
						'font-family'    => 'Montserrat',
						'font-weight'    => '600',
						'font-size'      => 16,
						'line-height'    => 1,
						'letter-spacing' => 0.063,
						'text-transform' => 'uppercase'
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
			'options' => array(),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

// Custom single post header with for the case in which there is no sidebar.
// In this case, the header's width is container-width + sidebar-width (300)
function boilerplate_container_width_single_header( $value, $selector, $property, $unit ) {
	$output = '';
	$value  = $value - 300;

	$output .= $selector . ' {' . PHP_EOL .
	           $property . ': ' . $value . $unit . ';' . PHP_EOL .
	           '}' . PHP_EOL;

	return $output;
}

// @todo check this out
function boilerplate_single_header_width( $value, $selector, $property, $unit ) {
	$output = '';

	$output .= $selector . ' {' . PHP_EOL .
	           $property . ': ' . ( $value + 300 + 112 + 56 ) . 'px;' . PHP_EOL .
	           '}' . PHP_EOL;

	return $output;
}
