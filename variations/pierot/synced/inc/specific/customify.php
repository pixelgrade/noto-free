<?php
/**
 * Custom functions related to Customify specific for this variation.
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

add_filter( 'pixelgrade_customify_general_section_options', 'variation_change_customify_general_section', 20, 2 );
add_filter( 'pixelgrade_header_customify_section_options', 'variation_change_customify_header_section', 20, 2 );
add_filter( 'pixelgrade_customify_main_content_section_options', 'variation_change_customify_main_content_section', 20, 2 );
add_filter( 'pixelgrade_customify_buttons_section_options', 'variation_change_customify_buttons_section', 20, 2 );
add_filter( 'pixelgrade_footer_customify_section_options', 'variation_change_customify_footer_section', 20, 2 );
add_filter( 'pixelgrade_customify_blog_grid_section_options', 'variation_change_customify_blog_grid_section', 20, 2 );

define( 'VARIATION_DARK_COLOR', '#34394B' );
define( 'VARIATION_DARK_SECONDARY_COLOR', '#49494B' );

define( 'VARIATION_ACCENT_COLOR', '#E79696' );
define( 'VARIATION_ACCENT_LIGHT_COLOR', '#FCD9D2' );

define( 'VARIATION_LIGHT_COLOR', '#FFF4F4' );

define( 'VARIATION_HEADINGS_FONT', 'IBM Plex Sans' );
define( 'VARIATION_ACCENT_FONT', 'IBM Plex Mono' );
define( 'VARIATION_BODY_FONT', 'IBM Plex Sans' );

/**
 * Footer Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $section_options The modified specific config
 */
function variation_change_customify_general_section( $section_options, $options ) {

	unset( $section_options['general'] );

	return $section_options;
}

/**
 * Main Content Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $section_options The modified specific config
 */
function variation_change_customify_main_content_section( $section_options, $options ) {

	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(

		// Main Content
		'main_content' => array(
			'options' => array(
				'main_content_border_color'             => array(
					'default' => VARIATION_DARK_SECONDARY_COLOR,
					'css' => array(
						array(
							'property' => 'color',
							'selector' => '.menu-item-has-children:hover',
						),
					),
				),
				'main_content_page_title_color'         => array(
					'default' => VARIATION_DARK_COLOR
				),
				'main_content_body_text_color'          => array(
					'default' => VARIATION_DARK_COLOR
				),
				'main_content_body_link_color'          => array(
					'default' => VARIATION_DARK_COLOR
				),
				'main_content_body_link_active_color'   => array(
					'default' => VARIATION_DARK_COLOR
				),
				'main_content_underlined_body_links'    => array(
					'default' => VARIATION_DARK_COLOR
				),
				'main_content_heading_1_color'          => array(
					'default' => VARIATION_DARK_COLOR
				),
				'main_content_heading_2_color'          => array(
					'default' => VARIATION_DARK_COLOR
				),
				'main_content_heading_3_color'          => array(
					'default' => VARIATION_DARK_COLOR
				),
				'main_content_heading_4_color'          => array(
					'default' => VARIATION_DARK_COLOR
				),
				'main_content_heading_5_color'          => array(
					'default' => VARIATION_DARK_COLOR
				),
				'main_content_heading_6_color'          => array(
					'default' => VARIATION_DARK_COLOR
				),
				'main_content_content_background_color' => array(
					'default' => '#FFFFFF'
				),
				'main_content_page_title_font'          => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 74,
						'line-height'    => 1.08,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_body_text_font'           => array(
					'default' => array(
						'font-family'    => VARIATION_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 16,
						'line-height'    => 1.65,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_paragraph_text_font'      => array(
					'default' => array(
						'font-family'    => VARIATION_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 18,
						'line-height'    => 1.67,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_quote_block_font'         => array(
					'selector' => 'blockquote, .intro',
					'default'  => array(
						'font-family'    => VARIATION_ACCENT_FONT,
						'font-weight'    => 'italic',
						'font-size'      => 18,
						'line-height'    => 1.67,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_1_font'           => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 56,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_2_font'           => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 42,
						'line-height'    => 1.0476,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_3_font'           => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 32,
						'line-height'    => 1.0625,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_4_font'           => array(
					'default' => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 24,
						'line-height'    => 0.958,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_5_font'           => array(
					'selector' => 'h5, .header-category',
					'default'  => array(
						'font-family'    => VARIATION_ACCENT_FONT,
						'font-weight'    => '500italic',
						'font-size'      => 18,
						'line-height'    => 0.833,
						'letter-spacing' => 0.11,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_6_font'           => array(
					'selector' => 'h6, ul.page-numbers, .c-author__name, .c-reading-progress__label',
					'default'  => array(
						'font-family'    => VARIATION_ACCENT_FONT,
						'font-weight'    => '500italic',
						'font-size'      => 14,
						'line-height'    => 1.071,
						'letter-spacing' => 0.142,
						'text-transform' => 'none',
					),
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	$options_to_be_removed = array(
		'main_content_container_width',
		'main_content_container_sides_spacing',
		'main_content_content_width',
		'main_content_container_padding',
		'main_content_border_width',
	);

	foreach ( $options_to_be_removed as $option_name ) {
		unset( $section_options['main_content']['options'][ $option_name ] );
	}

	return $section_options;
}

/**
 * Blog Grid Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $section_options The modified specific config
 */
function variation_change_customify_blog_grid_section( $section_options, $options ) {

	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(

		// Main Content
		'blog_grid' => array(
			'options' => array(
				'blog_items_secondary_meta'      => array(
					'default' => 'none',
				),
				'blog_item_title_font'           => array(
					'selector' => '.c-card__title',
					'default'  => array(
						'font-family'    => VARIATION_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 32,
						'line-height'    => 1.0625,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_meta_font'            => array(
					'selector' => '.c-card__meta',
					'default'  => array(
						'font-family'    => VARIATION_ACCENT_FONT,
						'font-weight'    => '500italic',
						'font-size'      => 14,
						'line-height'    => 1.071,
						'letter-spacing' => 0.14,
						'text-transform' => 'none',
					),
				),
				'blog_item_excerpt_font'         => array(
					'selector' => '.c-card__excerpt',
					'default'  => array(
						'font-family'    => VARIATION_ACCENT_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 15,
						'line-height'    => 1.6,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_thumbnail_background' => array(
					'selector' => '.c-card__frame:after'
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	$options_to_be_removed = array(
		'blog_grid_width',
		'blog_container_sides_spacing',
		'blog_grid_title_items_grid_section',
		'blog_grid_layout',
		'blog_items_aspect_ratio',
		'blog_items_per_row',
		'blog_items_vertical_spacing',
		'blog_items_horizontal_spacing',
		'blog_grid_title_items_title_section',
		'blog_items_title_position',
		'blog_items_title_alignment_nearby',
		'blog_items_title_alignment_overlay',
		'blog_items_title_visibility_title',
		'blog_items_title_visibility',
		'blog_grid_title_items_excerpt_section',
		'blog_items_excerpt_visibility_title',
		'blog_items_excerpt_visibility',
		'blog_item_thumbnail_background',
		'blog_grid_title_thumbnail_hover_section',
		'blog_item_thumbnail_hover_opacity',
	);

	foreach ( $options_to_be_removed as $option_name ) {
		unset( $section_options['blog_grid']['options'][ $option_name ] );
	}

	$section_options['blog_grid']['options'] = Pixelgrade_Array::insertAfterKey( $section_options['blog_grid']['options'], 'blog_item_excerpt_font', array(
		'blog_item_dropcap_font' => array(
			'type'        => 'font',
			'label'       => esc_html__( 'Item Dropcap Font', '__components_txtd' ),
			'desc'        => '',
			'selector'    => '.c-card__letter',
			'callback'    => 'typeline_font_cb',

			'default'     => array(
				'font-family' => 'IBM Plex Serif',
				'font-weight' => '300italic',
				'font-size' => 300,
				'line-height' => 1,
				'text-transform' => 'uppercase'
			),

			// Sub Fields Configuration (optional)
			'fields'      => array(
				'font-size'       => array(                           // Set custom values for a range slider
					'min'  => 30,
					'max'  => 300,
					'step' => 1,
					'unit' => 'px',
				),
				'text-align'      => false,
				'text-transform'  => true,
				'text-decoration' => false,
			),
		)
	) );

	return $section_options;
}

/**
 * Header Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $section_options The modified specific config
 */
function variation_change_customify_header_section( $section_options, $options ) {

	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(

		// Main Content
		'header_section' => array(
			'options' => array(
				'header_logo_height' => array(
					'default' => 48
				),
				'header_navigation_links_color' => array(
					'default' => VARIATION_LIGHT_COLOR,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.c-navbar__zone--left',
						),
					),
				),
				'header_background' => array(
					'default' => VARIATION_LIGHT_COLOR,
					'css' => array(
						array(
							'property' => 'background-color',
							'selector' => '.menu-item-has-children:hover, .site-content:before, .c-navbar__zone--left .sub-menu'
						),
					),
				),
				'header_navigation_font' => array(
					'selector' => '.c-navbar__zone--left, .c-navbar__zone--right',
					'default' => array(
						'font-family'    => VARIATION_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 16,
						'line-height'    => 1.65,
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

	$options_to_be_removed = array(
		'header_title_layout_section',
		'header_height',
		'header_position',
		'header_width',
		'header_sides_spacing',
	);

	foreach ( $options_to_be_removed as $option_name ) {
		unset( $section_options['header_section']['options'][ $option_name ] );
	}

	return $section_options;
}

/**
 * Footer Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $section_options The modified specific config
 */
function variation_change_customify_footer_section( $section_options, $options ) {

	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(

		// Main Content
		'footer_section' => array(
			'options' => array(
				'footer_top_spacing'     => array(
					'default' => 48
				),
				'footer_bottom_spacing'  => array(
					'default' => 48
				),
				'footer_body_text_color' => array(
					'default' => VARIATION_LIGHT_COLOR
				),
				'footer_links_color'     => array(
					'default' => VARIATION_ACCENT_LIGHT_COLOR
				),
				'footer_background'      => array(
					'default' => VARIATION_DARK_COLOR
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	$section_options['footer_section']['options'] = Pixelgrade_Array::insertAfterKey( $section_options['footer_section']['options'], 'footer_background', array(
		'footer_font' => array(
			'type'        => 'font',
			'label'       => esc_html__( 'Footer Font', '__components_txtd' ),
			'desc'        => '',
			'selector'    => '.c-footer',
			'callback'    => 'typeline_font_cb',

			'default'     => array(
				'font-family' => VARIATION_ACCENT_FONT,
				'font-weight' => 'regular',
				'font-size' => 15,
				'line-height' => 1.6,
			),

			// Sub Fields Configuration (optional)
			'fields'      => array(
				'font-size'       => array(                           // Set custom values for a range slider
					'min'  => 12,
					'max'  => 48,
					'step' => 1,
					'unit' => 'px',
				),
				'text-transform'  => true,
			),
		)
	) );

	return $section_options;
}

/**
 * Main Content Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function variation_change_customify_buttons_section( $section_options, $options ) {

	$buttons = array(
		'.c-btn',
		'.c-card__action',
		'.c-comments-toggle__label',
		'.cats a',
		'.button:not(.default)',
		'button[type=button]',
		'button[type=reset]',
		'button[type=submit]',
		'input[type=button]',
		'input[type=submit]',
		'div.wpforms-container[class] .wpforms-form .wpforms-submit',
	);

	$buttons_default = implode( ',', $buttons );
	$buttons_solid   = implode( ',', array_map( 'pierot_prefix_solid_buttons', $buttons ) );
	$buttons_outline = implode( ',', array_map( 'pierot_prefix_outline_buttons', $buttons ) );

	$buttons_active = implode( ',', array(
			implode( ',', $buttons ),
			implode( ',', array_map( 'pierot_suffix_hover_buttons', $buttons ) ),
			implode( ',', array_map( 'pierot_suffix_active_buttons', $buttons ) ),
			implode( ',', array_map( 'pierot_suffix_focus_buttons', $buttons ) ),
		)
	);

	$new_section_options = array(

		// Main Content
		'buttons' => array(
			'options' => array(
				'buttons_style'      => array(
					'default' => 'outline',
				),
				'buttons_shape'      => array(
					'default' => 'square',
				),
				'buttons_color'      => array(
					'default' => VARIATION_DARK_COLOR,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => $buttons_solid,
						),
						array(
							'property' => 'color',
							'selector' => $buttons_outline,
						),
					),
				),
				'buttons_text_color' => array(
					'default' => '#FFFFFF',
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => $buttons_active
						),
					),
				),
				'buttons_font'       => array(
					'selector' => $buttons_default . ',
						.button.default,
						.not-found .search-form .search-submit,
						.contact-form > div > .grunion-field-label:not(.checkbox):not(.radio),
						.nf-form-cont .label-above .nf-field-label label,
						.nf-form-cont .list-checkbox-wrap .nf-field-element li label,
						.nf-form-cont .list-radio-wrap .nf-field-element li label,
						input[type=date],
						input[type=email],
						input[type=number],
						input[type=password],
						input[type=search],
						input[type=tel],
						input[type=text],
						input[type=url],
						textarea,
						select,
						div.wpforms-container[class] .wpforms-form .wpforms-field-label,
						div.wpforms-container[class] .wpforms-form input,
						div.wpforms-container[class] .wpforms-form select,
						div.wpforms-container[class] .wpforms-form textarea',
					'default'  => array(
						'font-family'    => VARIATION_ACCENT_FONT,
						'font-weight'    => 'italic',
						'font-size'      => 18,
						'line-height'    => 1.27,
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

/*
 * Helper functions for the buttons section config.
 */
function pierot_prefix_solid_buttons( $value ) {
	return '.u-buttons-solid ' . $value;
}

function pierot_suffix_hover_buttons( $value ) {
	return '.u-buttons-solid ' . $value . ':hover';
}

function pierot_suffix_active_buttons( $value ) {
	return '.u-buttons-solid ' . $value . ':active';
}

function pierot_suffix_focus_buttons( $value ) {
	return '.u-buttons-solid ' . $value . ':focus';
}

function pierot_prefix_outline_buttons( $value ) {
	return '.u-buttons-outline ' . $value;
}

if ( ! function_exists( 'pierot_border_width' ) ) {
	function pierot_border_width( $value, $selector, $property, $unit ) {
		$output = '
				.c-border:before { height: ' . $value . $unit . ' }
				.c-border:after { width: ' . $value . $unit . ' }
				.c-border i:before {
					left: ' . $value . $unit . ';
					width: ' . 2 * $value . $unit . ';
					height: ' . 2 * $value . $unit . ';
				}
				.c-border i:after {
					top: ' . $value . $unit . ';
				}
				.site-content:before {
					top: ' . $value . $unit . ';
					left: ' . $value . $unit . ';
					bottom: ' . 2 * $value . $unit . ';
				}
				.c-pierot {
					padding-top: ' . $value . $unit . ';
					padding-bottom: ' . 4 * $value . $unit . ';
				}';

		return $output;
	}
}
