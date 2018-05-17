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

//add_filter( 'pixelgrade_customify_general_section_options', 'variation_change_customify_general_section', 20, 2 );
//add_filter( 'pixelgrade_header_customify_section_options', 'variation_change_customify_header_section', 20, 2 );
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
        'main_content_container_width' => array(
        ),
        'main_content_container_sides_spacing' => array(
        ),
				'main_content_container_padding' => array(
        ),
				'main_content_content_width' => array(
        ),
        'main_content_border_width' => array(
        ),
        'main_content_border_color' => array(
          'default' => VARIATION_DARK_SECONDARY_COLOR
        ),
        'main_content_page_title_color' => array(
          'default' => VARIATION_DARK_COLOR
        ),
        'main_content_body_text_color' => array(
          'default' => VARIATION_DARK_COLOR
        ),
        'main_content_body_link_color' => array(
          'default' => VARIATION_DARK_COLOR
        ),
        'main_content_body_link_active_color' => array(
          'default' => VARIATION_DARK_COLOR
        ),
        'main_content_underlined_body_links' => array(
          'default' => VARIATION_DARK_COLOR
        ),
        'main_content_heading_1_color' => array(
          'default' => VARIATION_DARK_COLOR
        ),
        'main_content_heading_2_color' => array(
          'default' => VARIATION_DARK_COLOR
        ),
        'main_content_heading_3_color' => array(
          'default' => VARIATION_DARK_COLOR
        ),
        'main_content_heading_4_color' => array(
          'default' => VARIATION_DARK_COLOR
        ),
        'main_content_heading_5_color' => array(
          'default' => VARIATION_DARK_COLOR
        ),
        'main_content_heading_6_color' => array(
          'default' => VARIATION_DARK_COLOR
        ),
				'main_content_content_background_color' => array(
					'default' => '#FFFFFF'
				),
				'main_content_page_title_font' => array(
          'default' => array(
            'font-family'    => VARIATION_HEADINGS_FONT,
            'font-weight'    => '700',
            'font-size'      => 74,
            'line-height'    => 1.08,
            'letter-spacing' => 0,
            'text-transform' => 'none',
          ),
        ),
        'main_content_body_text_font' => array(
          'default' => array(
            'font-family'    => VARIATION_BODY_FONT,
            'font-weight'    => 'regular',
            'font-size'      => 17,
            'line-height'    => 1.65,
            'letter-spacing' => 0,
            'text-transform' => 'none',
          ),
        ),
        'main_content_paragraph_text_font' => array(
          'default' => array(
            'font-family'    => VARIATION_BODY_FONT,
            'font-weight'    => 'regular',
            'font-size'      => 18,
            'line-height'    => 1.67,
            'letter-spacing' => 0,
            'text-transform' => 'none',
          ),
        ),
        'main_content_quote_block_font' => array(
          'selector' => 'blockquote, .intro',
          'default' => array(
            'font-family'    => VARIATION_ACCENT_FONT,
            'font-weight'    => 'italic',
            'font-size'      => 18,
            'line-height'    => 1.67,
            'letter-spacing' => 0,
            'text-transform' => 'none',
          ),
        ),
        'main_content_heading_1_font' => array(
          'default' => array(
            'font-family'    => VARIATION_HEADINGS_FONT,
            'font-weight'    => '700',
            'font-size'      => 56,
            'line-height'    => 1,
            'letter-spacing' => 0,
            'text-transform' => 'none',
          ),
        ),
        'main_content_heading_2_font' => array(
          'default' => array(
            'font-family'    => VARIATION_HEADINGS_FONT,
            'font-weight'    => '700',
            'font-size'      => 42,
            'line-height'    => 1.0476,
            'letter-spacing' => 0,
            'text-transform' => 'none',
          ),
        ),
        'main_content_heading_3_font' => array(
          'default' => array(
            'font-family'    => VARIATION_HEADINGS_FONT,
            'font-weight'    => '700',
            'font-size'      => 32,
            'line-height'    => 1.0625,
            'letter-spacing' => 0,
            'text-transform' => 'none',
          ),
        ),
        'main_content_heading_4_font' => array(
          'default' => array(
            'font-family'    => VARIATION_HEADINGS_FONT,
            'font-weight'    => '700',
            'font-size'      => 24,
            'line-height'    => 0.958,
            'letter-spacing' => 0,
            'text-transform' => 'none',
          ),
        ),
        'main_content_heading_5_font' => array(
          'selector' => 'h5, .header-category',
          'default' => array(
            'font-family'    => VARIATION_ACCENT_FONT,
            'font-weight'    => '500italic',
            'font-size'      => 18,
            'line-height'    => 0.833,
            'letter-spacing' => 0.11,
            'text-transform' => 'none',
          ),
        ),
        'main_content_heading_6_font' => array(
					'selector' => 'h6, ul.page-numbers',
          'default' => array(
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
	unset( $section_options['main_content']['options']['main_content_content_width'] );
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
        'blog_items_secondary_meta' => array(
            'default' => 'none',
        ),
        'blog_item_title_font' => array(
          'selector' => '.c-card__title',
          'default' => array(
            'font-family'    => VARIATION_HEADINGS_FONT,
            'font-weight'    => '700',
            'font-size'      => 32,
            'line-height'    => 1.0625,
            'letter-spacing' => 0,
            'text-transform' => 'none',
          ),
        ),
        'blog_item_meta_font' => array(
          'selector' => '.c-card__meta',
          'default' => array(
            'font-family'    => VARIATION_ACCENT_FONT,
            'font-weight'    => '500italic',
            'font-size'      => 14,
            'line-height'    => 1.071,
            'letter-spacing' => 0.14,
            'text-transform' => 'none',
          ),
        ),
        'blog_item_excerpt_font' => array(
          'selector' => '.c-card__excerpt',
          'default' => array(
            'font-family'    => VARIATION_ACCENT_FONT,
            'font-weight'    => 'regular',
            'font-size'      => 15,
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

				'footer_background' => array(
					'default' => VARIATION_DARK_COLOR
				),
				'footer_body_text_color' => array(
					'default' => VARIATION_LIGHT_COLOR
				),
				'footer_links_color' => array(
					'default' => VARIATION_ACCENT_LIGHT_COLOR
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
		'.button:not(.default)',
		'button[type=button]',
		'button[type=reset]',
		'button[type=submit]',
		'input[type=button]',
		'input[type=submit]',
		'div.wpforms-container[class] .wpforms-form .wpforms-submit',
	);

	$buttons_default = implode( ',', $buttons );
	$buttons_solid = implode( ',', array_map( 'pierot_prefix_solid_buttons', $buttons ) );
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
