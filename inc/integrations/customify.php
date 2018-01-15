<?php
/**
 * Boilerplate Customizer Options Config
 *
 * @package Boilerplate
 * @since 1.0.0
 */

/**
 * Hook into the Customify's fields and settings.
 *
 * The config can turn to be complex so is better to visit:
 * https://github.com/pixelgrade/customify
 *
 * @param $options array - Contains the plugin's options array right before they are used, so edit with care
 *
 * @return mixed The return of options is required, if you don't need options return an empty array
 *
 */

/* =============
 * For customizing the components Customify options you need to use the /inc/components.php file.
 * Also there you will find the example code for making changes.
 * ============= */

add_filter( 'customify_filter_fields', 'boilerplate_add_customify_options', 11, 1 );

// Modify Customify Config
add_filter( 'pixelgrade_customify_general_section_options', 'boilerplate_customify_general_section', 10, 2 );
add_filter( 'pixelgrade_header_customify_section_options', 'boilerplate_change_customify_header_section_options', 10, 2 );
add_filter( 'pixelgrade_customify_main_content_section_options', 'boilerplate_customify_main_content', 10, 2 );
add_filter( 'pixelgrade_customify_buttons_section_options', 'boilerplate_customify_buttons', 10, 2 );
add_filter( 'pixelgrade_footer_customify_section_options', 'boilerplate_change_customify_footer_section_options', 10, 2 );
add_filter( 'pixelgrade_customify_blog_grid_section_options', 'boilerplate_customify_blog_grid_section', 10, 2 );

function boilerplate_add_customify_options( $options ) {
	$options['opt-name'] = 'boilerplate_options';

	//start with a clean slate - no Customify default sections
	$options['sections'] = array();

	return $options;
}

/**
 * Modify the Customify config for the General Section - from the Base component
 *
 * @param array $general_section The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $general_section The modified specific config
 */
function boilerplate_customify_general_section( $general_section, $options ) {

	$modified_config = array(
		// General
		'general' => array(
			'options' => array(
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$general_section = Pixelgrade_Config::merge( $general_section, $modified_config );

	// Remove Ajax Loading Option
//	unset( $general_section['general']['options']['use_ajax_loading'] );

	return $general_section;
}

/**
 * Main Content Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function boilerplate_customify_main_content( $section_options, $options ) {

	$new_section_options = array(

		// Main Content
		'main_content' => array(
			'options' => array(
				'main_content_container_width'          => array(
					'default' => 1300,
				),
				'main_content_container_sides_spacing'  => array(
					'default' => 60,
				),
				'main_content_container_padding'        => array(
					'default' => 0,
				),
				'main_content_content_width'            => array(
					'default' => 720,
				),
				'main_content_border_width'             => array(
					'default' => 10,
				),
				'main_content_border_color'             => array(
					'default' => '#F7F6F5',
				),

				// [Section] COLORS
				'main_content_page_title_color'         => array(
					'default' => '#222222',
				),
				'main_content_body_text_color'          => array(
					'default' => '#383c50',
				),
				'main_content_body_link_color'          => array(
					'default' => '#383c50',
				),
				'main_content_body_link_active_color'   => array(
					'default' => '#222222',
				),
				'main_content_underlined_body_links'    => array(
					'default' => 1,
				),

				// [Sub Section] Headings Color
				'main_content_heading_1_color'          => array(
					'default' => '#383c50',
				),
				'main_content_heading_2_color'          => array(
					'default' => '#383c50',
				),
				'main_content_heading_3_color'          => array(
					'default' => '#383c50',
				),
				'main_content_heading_4_color'          => array(
					'default' => '#383c50',
				),
				'main_content_heading_5_color'          => array(
					'default' => '#383c50',
				),
				'main_content_heading_6_color'          => array(
					'default' => '#383c50',
				),
				'main_content_page_title_font' => array(
					'selector' => '.single .entry-title, .page .entry-title, .h0[class]'
				),

				// [Sub Section] Backgrounds
				'main_content_content_background_color' => array(
					'default' => '#F7F6F5',
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
 * Buttons Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function boilerplate_customify_buttons( $section_options, $options ) {

	$new_section_options = array(

		// Main Content
		'buttons' => array(
			'options' => array(
				'buttons_style' => array(
					'default' => 'solid'
				),
				'buttons_shape' => array(
					'default' => 'square'
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
 * Blog Grid Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function boilerplate_customify_blog_grid_section( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(
		// Blog Grid
		'blog_grid' => array(
			'options' => array(
				'blog_grid_width'                    => array(
					'default' => 1300,
				),
				'blog_container_sides_spacing'       => array(
					'default' => 60,
				),
				'blog_grid_layout'                   => array(
					'default' => 'regular',
				),
				'blog_items_aspect_ratio'            => array(
					'default' => 133,
				),
				'blog_items_per_row'                 => array(
					'default' => 3,
				),
				'blog_items_vertical_spacing'        => array(
					'default' => 42,
				),
				'blog_items_horizontal_spacing'      => array(
					'default' => 42,
				),
				// [Sub Section] Items Title
				'blog_items_title_position'          => array(
					'default' => 'below',
				),
				'blog_items_title_alignment_nearby'  => array(
					'default' => 'left',
				),
				'blog_items_title_alignment_overlay' => array(
					'default' => 'middle-center',
				),
				// Title Visiblity
				'blog_items_title_visibility'        => array(
					'default' => 1,
				),
				// Excerpt Visiblity
				'blog_items_excerpt_visibility'      => array(
					'default' => 1,
				),
				// [Sub Section] Items Meta
				'blog_items_primary_meta'            => array(
					'default' => 'category',
				),
				'blog_items_secondary_meta'          => array(
					'default' => 'date',
				),
				'blog_item_title_color'              => array(
					'default' => '#383c50',
				),
				'blog_item_meta_primary_color'       => array(
					'default' => '#383c50',
				),
				'blog_item_meta_secondary_color'     => array(
					'default' => '#383c50',
				),
				'blog_item_thumbnail_background'     => array(
					'default' => '#000000',
				),
				'blog_item_excerpt_color'              => array(
					'default' => '#383c50',
				),

				// [Sub Section] Thumbnail Hover
				'blog_item_thumbnail_hover_opacity'  => array(
					'default' => 1,
				),
				'blog_item_title_font' => array(
					'selector' => '.c-card__title, .c-card__letter',
				),
				'blog_item_meta_font' => array(
					'selector' => '.c-meta__primary, .c-meta__secondary',
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
 * Header Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $main_content_section The modified specific config
 */
function boilerplate_change_customify_header_section_options( $section_options, $options ) {

	$new_section_options = array(
		'header_section' => array(
			'options' => array(
				'header_logo_height'              => array(
					'default' => 140,
				),
				'header_height'                   => array(
					'default' => 53,
				),
				'header_navigation_links_spacing' => array(
					'default' => 56,
				),
				'header_position'                 => array(
					'default' => 'sticky',
				),
				'header_width'                    => array(
					'default' => 'full',
				),
				'header_sides_spacing'            => array(
					'default' => 30,
				),
				'header_navigation_links_color'   => array(
					'default' => '#252525',
				),
				'header_links_active_color'       => array(
					'default' => '#161616',
				),
				'header_links_active_style'       => array(
					'default' => 'active',
				),
				'header_background'               => array(
					'default' => '#E7F2F8',
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
 * @return array $main_content_section The modified specific config
 */
function boilerplate_change_customify_footer_section_options( $section_options, $options ) {
	// First setup the default values
	// These should always come from the theme, not relying on the component's defaults
	$new_section_options = array(
		// Footer
		'footer_section' => array(
			'options' => array(
				// [Section] Layout
				'copyright_text'               => array(
					'default' => esc_html__( '&copy; %year% %site-title%.', '__theme_txtd' ),
				),
				'footer_top_spacing'           => array(
					'default' => 112,
				),
				'footer_bottom_spacing'        => array(
					'default' => 112,
				),
				'footer_hide_back_to_top_link' => array(
					'default' => false,
				),
				'footer_hide_credits'          => array(
					'default' => false,
				),
				'footer_layout'                => array(
					'default' => 'stacked',
				),
				// [Section] COLORS
				'footer_body_text_color'       => array(
					'default' => '#383c50',
				),
				'footer_links_color'           => array(
					'default' => '#161616',
				),
				'footer_background'            => array(
					'default' => '#f7f6f5',
				),
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	return $section_options;
}
