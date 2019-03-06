<?php
/**
 * Noto Customizer Options Config.
 *
 * @package Noto
 * @since 1.0.0
 */

/**
 * Hook into the Customify's fields and settings.
 *
 * The config can turn to be complex so is best to visit:
 * https://github.com/pixelgrade/customify
 *
 * @param array $options Contains the plugin's options array right before they are used, so edit with care.
 *
 * @return array The returned options are required, if you don't need options return an empty array.
 */
add_filter( 'customify_filter_fields', 'noto_add_customify_options', 11, 1 );

// Modify Customify Config.
add_filter( 'pixelgrade_customify_general_section_options', 'noto_customify_general_section', 10, 2 );
add_filter( 'pixelgrade_header_customify_section_options', 'noto_customify_header_section', 10, 2 );
add_filter( 'pixelgrade_customify_main_content_section_options', 'noto_customify_main_content_section', 10, 2 );
add_filter( 'pixelgrade_customify_buttons_section_options', 'noto_customify_buttons_section', 10, 2 );
add_filter( 'pixelgrade_footer_customify_section_options', 'noto_customify_footer_section', 10, 2 );
add_filter( 'pixelgrade_customify_blog_grid_section_options', 'noto_customify_blog_grid_section', 10, 2 );

define( 'THEME_TEXT_COLOR', '#2B3D39' );
define( 'THEME_ACCENT_COLOR', '#DE2D16' );

define( 'THEME_BODY_FONT', 'Lato' );
define( 'THEME_HEADINGS_FONT', 'Roboto' );
define( 'THEME_HEADINGS_FONT_ALT', 'PT Sans' );
define( 'THEME_SITE_TITLE_FONT', 'Roboto' );

function noto_add_customify_options( $options ) {
	$options['opt-name'] = 'noto_options';

	//start with a clean slate - no Customify default sections.
	$options['sections'] = array();

	return $options;
}

/**
 * Modify the Customify config for the General Section - from the Base component.
 *
 * @param array $section_options The specific Customify config to be filtered.
 * @param array $options The whole Customify config.
 *
 * @return array $general_section The modified specific config.
 */
function noto_customify_general_section( $section_options, $options ) {

	$new_section_options = array(
		// Remove the General section default fields.
		'general' => array(
			'options' => array(
				// empty.
			),
		),
	);

	// Now we merge the modified config with the original one.
	// Thus overwriting what we have changed.
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}

/**
 * Main Content Section.
 *
 * @param array $section_options The specific Customify config to be filtered.
 * @param array $options The whole Customify config.
 *
 * @return array $main_content_section The modified specific config.
 */
function noto_customify_main_content_section( $section_options, $options ) {

	$modified_config = array(

		// Main Content.
		'main_content' => array(
			'options' => array(
				'main_content_container_width'          => array(
					'default' => 1240,
				),
				'main_content_container_sides_spacing'  => array(
					'default' => 42,
				),
				'main_content_container_padding'        => array(
					'default' => 0,
				),
				'main_content_content_width'            => array(
					'default' => 720,
				),
				'main_content_border_width'             => array(
					'default' => 0,
				),
				'main_content_border_color'             => array(
					'default' => '#F7F6F5',
				),

				// [Section] COLORS.
				'main_content_page_title_color'         => array(
					'default' => THEME_TEXT_COLOR,
				),
				'main_content_body_text_color'          => array(
					'default' => THEME_TEXT_COLOR,
				),
				'main_content_body_link_color'          => array(
					'default' => THEME_TEXT_COLOR,
				),
				'main_content_body_link_active_color'   => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'main_content_underlined_body_links'    => array(
					'default' => 1,
				),

				// [Sub Section] Headings Color.
				'main_content_heading_1_color'          => array(
					'default' => THEME_TEXT_COLOR,
				),
				'main_content_heading_2_color'          => array(
					'default' => THEME_TEXT_COLOR,
				),
				'main_content_heading_3_color'          => array(
					'default' => THEME_TEXT_COLOR,
				),
				'main_content_heading_4_color'          => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'main_content_heading_5_color'          => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'main_content_heading_6_color'          => array(
					'default' => THEME_ACCENT_COLOR,
				),

				// [Sub Section] Backgrounds.
				'main_content_content_background_color' => array(
					'default' => '#F5F6F1',
				),

				// [Section] FONTS.
				'main_content_page_title_font'          => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT,
						'font-size'      => 72,
						'line-height'    => 1.11,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_body_text_font' => array(
					'default' => array(
						'font-family'    => THEME_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 17,
						'line-height'    => 1.647,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_paragraph_text_font' => array(
					'default' => array(
						'font-family'    => THEME_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 18,
						'line-height'    => 1.66,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_quote_block_font' => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 40,
						'line-height'    => 1.5,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				// [Sub Section] Headings Fonts.
				'main_content_heading_1_font'   => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 48,
						'line-height'    => 1.167,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_2_font' => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 40,
						'line-height'    => 1.1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_3_font' => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 24,
						'line-height'    => 1.417,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_4_font' => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT_ALT,
						'font-weight'    => '500',
						'font-size'      => 19,
						'line-height'    => 1.21,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				'main_content_heading_5_font' => array(
					'default'  => array(
						'font-family'    => THEME_HEADINGS_FONT_ALT,
						'font-weight'    => '700',
						'font-size'      => 14,
						'line-height'    => 1.25,
						'letter-spacing' => 0.07,
						'text-transform' => 'uppercase',
					),
				),

				'main_content_heading_6_font' => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT_ALT,
						'font-weight'    => '700',
						'font-size'      => 12,
						'line-height'    => 1.25,
						'letter-spacing' => 0.08,
						'text-transform' => 'uppercase',
					),
				),
			)
		),
	);

	// Now we merge the modified config with the original one.
	// Thus overwriting what we have changed.
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );
	
	return $section_options;
}

/**
 * Buttons Section.
 *
 * @param array $section_options The specific Customify config to be filtered.
 * @param array $options The whole Customify config.
 *
 * @return array $main_content_section The modified specific config.
 */
function noto_customify_buttons_section( $section_options, $options ) {
	$modified_config = array(

		// Main Content
		'buttons' => array(
			'options' => array(
				'buttons_style' => array(
					'default' => 'solid',
				),
				'buttons_shape' => array(
					'default' => 'rounded',
				),
				'buttons_color'      => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'buttons_text_color' => array(
					'default' => '#FFFFFF',
				),
				'buttons_font'       => array(
					'default'  => array(
						'font-family'    => THEME_HEADINGS_FONT_ALT,
						'font-weight'    => '500',
						'font-size'      => 17,
						'line-height'    => 1.94,
						'letter-spacing' => 0,
					),
				),
			)
		),
	);

	// Now we merge the modified config with the original one.
	// Thus overwriting what we have changed.
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

	return $section_options;
}

/**
 * Blog Grid Section.
 *
 * @param array $section_options The specific Customify config to be filtered.
 * @param array $options The whole Customify config.
 *
 * @return array $main_content_section The modified specific config.
 */
function noto_customify_blog_grid_section( $section_options, $options ) {
	// First setup the default values.
	// These should always come from the theme, not relying on the component's defaults.
	$modified_config = array(
		// Blog Grid.
		'blog_grid' => array(
			'options' => array(
				// [Section] Layout.
				'blog_grid_width'                    => array(
					'default' => 1240,
				),
				'blog_container_sides_spacing'       => array(
					'default' => 42,
				),
				// [Sub Section] Items Grid.
				'blog_grid_layout'                   => array(
					'default' => 'regular',
				),
				'blog_items_aspect_ratio'            => array(
					'default' => 50,
				),
				'blog_items_per_row'                 => array(
					'default' => 3,
				),
				'blog_items_vertical_spacing'        => array(
					'default' => 32,
				),
				'blog_items_horizontal_spacing'      => array(
					'default' => 32,
				),
				// [Sub Section] Items Title.
				'blog_items_title_position'          => array(
					'default' => 'below',
				),
				'blog_items_title_alignment_nearby'  => array(
					'default' => 'left',
				),
				'blog_items_title_alignment_overlay' => array(
					'default' => 'middle-center',
				),
				// Title Visiblity.
				'blog_items_title_visibility'        => array(
					'default' => 1,
				),
				// Excerpt Visiblity.
				'blog_items_excerpt_visibility'      => array(
					'default' => 1,
				),
				// [Sub Section] Items Meta.
				'blog_items_primary_meta'            => array(
					'default' => 'category',
				),
				'blog_items_secondary_meta'          => array(
					'default' => 'date',
				),

				// [Section] COLORS.
				'blog_item_title_color'              => array(
					'default' => '#333131',
				),
				'blog_item_meta_primary_color'       => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'blog_item_meta_secondary_color'     => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'blog_item_thumbnail_background'     => array(
					'default' => '#000000',
				),
				'blog_item_excerpt_color'              => array(
					'default' => THEME_ACCENT_COLOR,
				),

				// [Sub Section] Thumbnail Hover.
				'blog_item_thumbnail_hover_opacity'  => array(
					'default' => 1,
				),

				// [Section] FONTS.
				'blog_item_title_font'           => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 21,
						'line-height'    => 1.3,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_meta_font'            => array(
					'default' => array(
						'font-family'    => THEME_SITE_TITLE_FONT,
						'font-weight'    => '400',
						'font-size'      => 13,
						'line-height'    => 1.1,
						'letter-spacing' => 0.1,
						'text-transform' => 'uppercase',
					),
				),
				'blog_item_excerpt_font'         => array(
					'default' => array(
						'font-family'    => THEME_BODY_FONT,
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

	// Now we merge the modified config with the original one.
	// Thus overwriting what we have changed.
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

	return $section_options;
}

/**
 * Header Section.
 *
 * @param array $section_options The specific Customify config to be filtered.
 * @param array $options The whole Customify config.
 *
 * @return array $main_content_section The modified specific config.
 */
function noto_customify_header_section( $section_options, $options ) {

	$modified_config = array(
		'header_section' => array(
			'options' => array(
				// [Section] Layout.
				'header_logo_height'              => array(
					'default' => 30,
				),
				'header_height'                   => array(
					'default' => 87,
				),
				'header_navigation_links_spacing' => array(
					'default' => 56,
					'css'         => array(
						array(
							'property'        => 'margin-left',
							'selector'        => '.c-noto--header ul',
							'unit'            => 'px',
							'callback_filter' => 'typeline_negative_spacing_cb',
							'negative_value'  => true,
						),
						array(
							'property'        => 'margin-left',
							'selector'        => '.c-noto--header li',
							'unit'            => 'px',
							'callback_filter' => 'typeline_spacing_cb',
						),
					),
				),
				'header_position'                 => array(
					'default' => 'sticky',
				),
				'header_width'                    => array(
					'default' => 'full',
				),
				'header_sides_spacing'            => array(
					'default' => 42,
				),

				// [Section] COLORS.
				'header_navigation_links_color'   => array(
					'default' => '#323232',
				),
				'header_links_active_color'       => array(
					'default' => THEME_ACCENT_COLOR,
				),
				'header_links_active_style'       => array(
					'default' => 'active',
				),
				'header_background'               => array(
					'default' => '#F5F6F1',
				),

				// [Section] FONTS.
				'header_site_title_font'          => array(
					'default' => array(
						'font-family'    => THEME_SITE_TITLE_FONT,
						'font-weight'    => '400',
						'font-size'      => 30,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'header_navigation_font'          => array(
					'default' => array(
						'font-family'    => THEME_HEADINGS_FONT_ALT,
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

	// Now we merge the modified config with the original one.
	// Thus overwriting what we have changed.
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

	return $section_options;
}

/**
 * Footer Section.
 *
 * @param array $section_options The specific Customify config to be filtered.
 * @param array $options The whole Customify config.
 *
 * @return array $main_content_section The modified specific config.
 */
function noto_customify_footer_section( $section_options, $options ) {
	// First setup the default values.
	// These should always come from the theme, not relying on the component's defaults.
	$modified_config = array(
		// Footer.
		'footer_section' => array(
			'options' => array(
				// [Section] Layout.
				'copyright_text'               => array(
					'default' => esc_html__( '&copy; %year% %site-title%.', '__theme_txtd' ),
				),
				'footer_top_spacing'     => array(
					'default' => 80,
				),
				'footer_bottom_spacing'  => array(
					'default' => 56,
				),
				'footer_hide_back_to_top_link' => array(
					'default' => false,
				),
				'footer_hide_credits'          => array(
					'default' => false,
				),
				'footer_layout'                => array(
					'default' => 'row',
				),

				// [Section] COLORS
				'footer_body_text_color'       => array(
					'default' => '#2B3D39',
				),
				'footer_links_color'           => array(
					'default' => '#2B3D39',
				),
				'footer_background'            => array(
					'default' => '#F5F6F1',
				),
			),
		),
	);

	// Now we merge the modified config with the original one.
	// Thus overwriting what we have changed.
	$section_options = Pixelgrade_Config::merge( $section_options, $modified_config );

	return $section_options;
}
