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
 * @package Noto
 * @since 1.0.0
 */

add_filter( 'customify_filter_fields', 'pixelgrade_add_customify_style_manager_section', 12, 1 );
add_filter( 'pixelgrade_customify_general_section_options', 'variation_change_customify_general_section', 20, 2 );
add_filter( 'pixelgrade_header_customify_section_options', 'variation_change_customify_header_section', 20, 2 );
add_filter( 'pixelgrade_customify_main_content_section_options', 'variation_change_customify_main_content_section', 20, 2 );
add_filter( 'pixelgrade_customify_buttons_section_options', 'variation_change_customify_buttons_section', 20, 2 );
add_filter( 'pixelgrade_footer_customify_section_options', 'variation_change_customify_footer_section', 20, 2 );
add_filter( 'pixelgrade_customify_blog_grid_section_options', 'variation_change_customify_blog_grid_section', 20, 2 );

// Color Palette
define( 'SM_COLOR_PRIMARY', '#E87474' );
define( 'SM_COLOR_SECONDARY', '#E79696' );
define( 'SM_COLOR_TERTIARY', '#FCD9D2' );
define( 'SM_COLOR_QUATERNARY', '#FFEA80' ); // Bright Yellow

define( 'SM_DARK_PRIMARY', '#34394B' ); // Blueish
define( 'SM_DARK_SECONDARY', '#49494B' ); 
define( 'SM_DARK_TERTIARY', '#394059' );

define( 'SM_LIGHT_PRIMARY', '#FFFFFF' ); // White
define( 'SM_LIGHT_SECONDARY', '#FFF4F4' ); // Light Pink
define( 'SM_LIGHT_TERTIARY', '#FFF5C1' ); // Light Yellow

define( 'SM_HEADINGS_FONT', 'IBM Plex Sans' );
define( 'SM_ACCENT_FONT', 'IBM Plex Sans' );
define( 'SM_BODY_FONT', 'IBM Plex Sans' );
define( 'SM_LOGO_FONT', 'Bungee' );

/**
 * Add the Style Manager cross-theme Customizer section.
 *
 * @param array $options
 *
 * @return array
 */
function pixelgrade_add_customify_style_manager_section( $options ) {
	// If the theme hasn't declared support for style manager, bail.
	if ( ! current_theme_supports( 'customizer_style_manager' ) ) {
		return $options;
	}

	if ( ! isset( $options['sections']['style_manager_section'] ) ) {
		$options['sections']['style_manager_section'] = array();
	}

	// The section might be already defined, thus we merge, not replace the entire section config.
	$options['sections']['style_manager_section'] = array_replace_recursive( $options['sections']['style_manager_section'], array(
		'options' => array(
			'sm_color_primary' => array(
				'default' => SM_COLOR_PRIMARY,
				'connected_fields' => array(
				),
			),
			'sm_color_secondary' => array(
				'default' => SM_COLOR_SECONDARY,
				'connected_fields' => array(
					'accent_color'
				),
			),
			'sm_color_tertiary' => array(
				'default' => SM_COLOR_TERTIARY,
				'connected_fields' => array(
					'accent_light_color'
				),
			),
			'sm_dark_primary' => array(
				'default' => SM_DARK_PRIMARY,
				'connected_fields' => array(
					'main_content_border_color',
					'main_content_page_title_color',
					'main_content_body_link_color',
					'main_content_body_link_active_color',
					'main_content_underlined_body_links',
					'main_content_heading_1_color',
					'main_content_heading_2_color',
					'main_content_heading_3_color',
					'main_content_heading_4_color',
					'main_content_heading_5_color',
					'main_content_heading_6_color',
					'footer_background',
					'buttons_color',
				),
			),
			'sm_dark_secondary' => array(
				'default' => SM_DARK_SECONDARY,
				'connected_fields' => array(
					'main_content_body_text_color',
				),
			),
			'sm_dark_tertiary' => array(
				'default' => SM_DARK_TERTIARY,
				'connected_fields' => array(
					'dark_tertiary_color'
				),
			),
			'sm_light_primary' => array(
				'default' => SM_LIGHT_PRIMARY,
				'connected_fields' => array(
					'main_content_content_background_color',
					'header_navigation_links_color',
					'footer_body_text_color',
					'buttons_text_color',
				),
			),
			'sm_light_secondary' => array(
				'default' => SM_LIGHT_SECONDARY,
				'connected_fields' => array(
					'accent_lighter_color',
					'header_background',
					'footer_links_color',
				),
			),
			'sm_light_tertiary' => array(
				'default' => SM_LIGHT_TERTIARY,
				'connected_fields' => array(
					'light_tertiary_color'
				),
			),
	    ),
	));

	return $options;
}

/**
 * Footer Section
 *
 * @param array $section_options The specific Customify config to be filtered
 * @param array $options The whole Customify config
 *
 * @return array $section_options The modified specific config
 */
function variation_change_customify_general_section( $section_options, $options ) {
	$new_section_options = array(
		// General
		'general' => array(
			'options' => array(
				'archive_badge_title' => array(
					'type'              => 'text',
					'label'             => esc_html__( 'Badge Title', '__theme_txtd' ),
					'desc'              => esc_html__( '', '__theme_txtd' ),
					'default'           => 'Salut',
					'live'              => array( '.c-badge__title' ),
				),
				'archive_badge_content' => array(
					'type'              => 'textarea',
					'label'             => esc_html__( 'Badge Content', '__theme_txtd' ),
					'desc'              => esc_html__( '', '__theme_txtd' ),
					'default'           => '<p>Welcome to my blog! Check out the <del>latest post</del>, browse the highlights or <del>reach me</del> to say Hi!</p>',
					'sanitize_callback' => 'wp_kses_post',
					'live'              => array( '.c-badge__content' ),
				),
				'general_title_colors_section'     => array(
					'type' => 'html',
					'html' => '<span id="section-title-general-colors" class="separator section label large">&#x1f3a8; ' . esc_html__( 'Colors', '__theme_txtd' ) . '</span>',
				),
				'accent_color' => array(
					'type'    => 'color',
					'label'   => esc_html__( 'Accent Color', '__theme_txtd' ),
					'live'    => true,
					'default' => SM_COLOR_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '
								.intro[class],
								.c-author__name[class], 
								.c-card:hover .c-card__excerpt,
								.widget_nav_menu a, 
								.widget_pages a,
								.slick-dots .slick-active',
						),
						array(
							'property' => 'background-color',
							'selector' => '.widget_wpcom_social_media_icons_widget ul li:hover'
						),
					),
				),
				'accent_light_color' => array(
					'type'    => 'color',
					'label'   => esc_html__( 'Accent Light Color', '__theme_txtd' ),
					'live'    => true,
					'default' => SM_COLOR_TERTIARY,
					'css'     => array(
						array(
							'property' => 'background',
							'selector' => '
								.header-category a:after,
								.c-meta__decoration:after',
							'callback_filter' => 'noto_meta_background_gradient_cb',
						),
						array(
							'property' => 'background-color',
							'selector' => '
								.c-footer-layers__accent,
								.c-card__action:before',
						),
					),
				),
				'accent_lighter_color' => array(
					'type'    => 'color',
					'label'   => esc_html__( 'Accent Lighter Color', '__theme_txtd' ),
					'live'    => true,
					'default' => SM_LIGHT_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '
								.c-card__letter,
								.c-navbar__label,
								.search-trigger[class]',
						),
						array(
							'property' => 'background-color',
							'selector' => '
								.c-card__frame:after,
								.c-gallery__item--widget',
						),
					),
				),
				'dark_tertiary_color' => array(
					'type'    => 'color',
					'label'   => esc_html__( 'Dark Tertiary Color', '__theme_txtd' ),
					'live'    => true,
					'default' => SM_DARK_TERTIARY,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => '.c-footer-layers__dark',
						),
					),
				),
				'light_tertiary_color' => array(
					'type'    => 'color',
					'label'   => esc_html__( 'Light Tertiary Color', '__theme_txtd' ),
					'live'    => true,
					'default' => SM_LIGHT_TERTIARY,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => '.c-badge[class]',
						),
					),
				),
			),
		),
		'title_tagline' => array(
			'section_id' => 'title_tagline', // This is needed so we avoid the prefixing and use the core defined section.
			'options' => array(
				'profile_photo' => array(
					'label' => esc_html__( 'Profile Photo', '__theme_txtd' ),
					'type' => 'cropped_image',
					'priority'      => 7, // this will make it appear above Logo (that has a priority of 8).
					'width'         => 700, // Suggested width for cropped image.
					'height'        => 700, // Suggested height for cropped image.
					'flex_width'    => true, // Whether the width is flexible.
					'flex_height'   => true, // Whether the height is flexible.
					'button_labels' => array(
						'select'       => __( 'Select photo' ),
						'change'       => __( 'Change photo' ),
						'remove'       => __( 'Remove' ),
						'default'      => __( 'Default' ),
						'placeholder'  => __( 'No photo selected' ),
						'frame_title'  => __( 'Select photo' ),
						'frame_button' => __( 'Choose photo' ),
					),
				)
			),
		),
	);

	// Now we merge the modified config with the original one
	// Thus overwriting what we have changed
	$section_options = Pixelgrade_Config::merge( $section_options, $new_section_options );

	// Remove Ajax Loading Option
	unset( $section_options['general']['options']['use_ajax_loading'] );

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
					'default' => SM_DARK_PRIMARY,
					'css' => array(
						array(
							'property' => 'background-color',
							'selector' => 'body.u-content-background',
						),
						array(
							'property' => 'color',
							'selector' => '.c-card .wave-svg-mask,
							.c-reading-progress',
						),
					),
				),
				'main_content_page_title_color'         => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_body_text_color'          => array(
					'default' => SM_DARK_SECONDARY
				),
				'main_content_body_link_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_body_link_active_color'   => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_underlined_body_links'    => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_1_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_2_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_3_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_4_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_5_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_heading_6_color'          => array(
					'default' => SM_DARK_PRIMARY
				),
				'main_content_content_background_color' => array(
					'default' => SM_LIGHT_PRIMARY,
					'css' => array(
						array(
							'property' => 'background-color',
							'selector' => '
								.c-footer-layers__background,
								.c-navbar__zone--left .menu > li > a:before,
								.c-search-overlay'
						),
					),
				),
				'main_content_page_title_font'          => array(
					'default' => array(
						'font-family'    => SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 74,
						'line-height'    => 1.08,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_body_text_font'           => array(
					'default' => array(
						'font-family'    => SM_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 15,
						'line-height'    => 1.6,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_paragraph_text_font'      => array(
					'selector' => '.entry-content, .site-description',
					'default' => array(
						'font-family'    => SM_BODY_FONT,
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
						'font-family'    => SM_ACCENT_FONT,
						'font-weight'    => 'italic',
						'font-size'      => 18,
						'line-height'    => 1.67,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_1_font'           => array(
					'default' => array(
						'font-family'    => SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 56,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_2_font'           => array(
					'default' => array(
						'font-family'    => SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 42,
						'line-height'    => 1.0476,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_3_font'           => array(
					'default' => array(
						'font-family'    => SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 32,
						'line-height'    => 1.0625,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_4_font'           => array(
					'default' => array(
						'font-family'    => SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 24,
						'line-height'    => 0.958,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_5_font'           => array(
					'selector' => 'h5, .header-category,
							ul.page-numbers, 
							.c-author__name, 
							.c-reading-progress__label, 
							.post-navigation .nav-links__label,
							.cats__title,
							.tags__title,
							.sharedaddy--official h3.sd-title[class]',
					'default'  => array(
						'font-family'    => SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 18,
						'line-height'    => 0.833,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_6_font'           => array(
					'selector' => 'h6, .h6,
									.comment-reply-title a, .comment__metadata a, 
									.edit-link a, .logged-in-as a, .reply a',
					'default'  => array(
						'font-family'    => SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 14,
						'line-height'    => 1.5,
						'letter-spacing' => 0.05,
						'text-transform' => 'uppercase',
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
				'blog_item_title_font'           => array(
					'selector' => '.c-card__title',
					'default'  => array(
						'font-family'    => SM_HEADINGS_FONT,
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
						'font-family'    => SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 16,
						'line-height'    => 1.5,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_items_primary_meta'      => array(
					'default' => 'category',
				),
				'blog_items_secondary_meta'      => array(
					'default' => 'date',
				),
				'blog_item_excerpt_font'         => array(
					'selector' => '.c-card__excerpt',
					'default'  => array(
						'font-family'    => SM_ACCENT_FONT,
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
		'blog_grid_title_colors_section',
		'blog_item_title_color',
		'blog_item_meta_primary_color',
		'blog_item_meta_secondary_color',
		'blog_item_excerpt_color',
	);

	foreach ( $options_to_be_removed as $option_name ) {
		unset( $section_options['blog_grid']['options'][ $option_name ] );
	}

	$section_options['blog_grid']['options'] = Pixelgrade_Array::insertAfterKey( $section_options['blog_grid']['options'], 'blog_item_excerpt_font', array(
		'blog_item_dropcap_font' => array(
			'type'        => 'font',
			'label'       => esc_html__( 'Item Dropcap Font', '__theme_txtd' ),
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
					'default' => 40
				),
				'header_navigation_links_color' => array(
					'default' => SM_LIGHT_PRIMARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.c-navbar__zone--left .menu > li > a',
						),
					),
				),
				'header_background' => array(
					'default' => SM_LIGHT_SECONDARY,
					'css'   => array(
						array(
							'media' => 'only screen and (min-width: 62.5em)',
							'property' => 'background-color',
							'selector' => 'body:not(.page):not(.single) .header'
						),
					),
				),
				'header_site_title_font'          => array(
					'default' => array(
						'font-family'    => SM_LOGO_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 40,
						'line-height'    => 1,
						'letter-spacing' => 0,
						'text-transform' => 'uppercase',
					),
					'fields'      => array(
						'font-size'       => array(
							'max'  => 100,
						),
					),
				),
				'header_navigation_font' => array(
					'selector' => '.c-navbar__zone--left, .c-navbar__zone--right',
					'default' => array(
						'font-family'    => SM_BODY_FONT,
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
					'default' => SM_LIGHT_PRIMARY
				),
				'footer_links_color'     => array(
					'default' => SM_LIGHT_SECONDARY
				),
				'footer_background'      => array(
					'default' => SM_DARK_SECONDARY
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
			'label'       => esc_html__( 'Footer Font', '__theme_txtd' ),
			'desc'        => '',
			'selector'    => '.c-footer',
			'callback'    => 'typeline_font_cb',

			'default'     => array(
				'font-family' => SM_ACCENT_FONT,
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
	$buttons_solid   = implode( ',', array_map( 'noto_prefix_solid_buttons', $buttons ) );
	$buttons_outline = implode( ',', array_map( 'noto_prefix_outline_buttons', $buttons ) );

	$buttons_active = implode( ',', array(
			implode( ',', $buttons ),
			implode( ',', array_map( 'noto_suffix_hover_buttons', $buttons ) ),
			implode( ',', array_map( 'noto_suffix_active_buttons', $buttons ) ),
			implode( ',', array_map( 'noto_suffix_focus_buttons', $buttons ) ),
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
					'default' => SM_DARK_PRIMARY,
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
					'default' => SM_LIGHT_PRIMARY,
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
						div.wpforms-container[class] .wpforms-form .wpforms-field-label',
					'default'  => array(
						'font-family'    => SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 16,
						'line-height'    => 1.27,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),

				// Initial classes for buttons_font:
				// .contact-form > div > .grunion-field-label:not(.checkbox):not(.radio),
				// .nf-form-cont .label-above .nf-field-label label,
				// .nf-form-cont .list-checkbox-wrap .nf-field-element li label,
				// .nf-form-cont .list-radio-wrap .nf-field-element li label,
				// input[type=date],
				// input[type=email],
				// input[type=number],
				// input[type=password],
				// input[type=search],
				// input[type=tel],
				// input[type=text],
				// input[type=url],
				// textarea,
				// select,
				// div.wpforms-container[class] .wpforms-form .wpforms-field-label,
				// div.wpforms-container[class] .wpforms-form input,
				// div.wpforms-container[class] .wpforms-form select,
				// div.wpforms-container[class] .wpforms-form textarea
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
function noto_prefix_solid_buttons( $value ) {
	return '.u-buttons-solid ' . $value;
}

function noto_suffix_hover_buttons( $value ) {
	return '.u-buttons-solid ' . $value . ':hover';
}

function noto_suffix_active_buttons( $value ) {
	return '.u-buttons-solid ' . $value . ':active';
}

function noto_suffix_focus_buttons( $value ) {
	return '.u-buttons-solid ' . $value . ':focus';
}

function noto_prefix_outline_buttons( $value ) {
	return '.u-buttons-outline ' . $value;
}

if ( ! function_exists( 'noto_border_width' ) ) {
	function noto_border_width( $value, $selector, $property, $unit ) {
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
				.c-noto {
					padding-top: ' . $value . $unit . ';
					padding-bottom: ' . 4 * $value . $unit . ';
				}';

		return $output;
	}
}

if ( ! function_exists( 'noto_meta_background_gradient_cb' ) ) {
	function noto_meta_background_gradient_cb( $value, $selector, $property, $unit ) {
		$output = $selector . ' {' .
		          $property . ': linear-gradient(90deg, ' . $value . ' 50%, transparent);' .
		          '}';

		return $output;
	}
}

if ( ! function_exists( 'noto_meta_background_gradient_cb_customizer_preview' ) ) :
	/**
	 * Outputs the inline JS code used in the Customizer for the aspect ratio live preview.
	 */
	function noto_meta_background_gradient_cb_customizer_preview() {

		$js = "
			function noto_meta_background_gradient_cb( value, selector, property, unit ) {
			
			    var css = '',
			        style = document.getElementById('noto_meta_background_gradient_cb_style_tag'),
			        head = document.head || document.getElementsByTagName('head')[0];
			
			    css += selector + ' {' +
			        property + ': linear-gradient(90deg, ' + value + ' 50%, transparent);' +
		        '}';
			
			    if ( style !== null ) {
			        style.innerHTML = css;
			    } else {
			        style = document.createElement('style');
			        style.setAttribute('id', 'noto_meta_background_gradient_cb_style_tag');
			
			        style.type = 'text/css';
			        if ( style.styleSheet ) {
			            style.styleSheet.cssText = css;
			        } else {
			            style.appendChild(document.createTextNode(css));
			        }
			
			        head.appendChild(style);
			    }
			}" . PHP_EOL;

		wp_add_inline_script( 'customify-previewer-scripts', $js );
	}
endif;

add_action( 'customize_preview_init', 'noto_meta_background_gradient_cb_customizer_preview', 20 );

function themename_add_default_color_palette( $color_palettes ) {

	$color_palettes = array_merge(array(
		'default' => array(
			'label' => esc_html__( 'Default', '__theme_txtd' ),
			'background_image_url' => '',
			'options' => array(
				'sm_color_primary' => SM_COLOR_PRIMARY,
				'sm_color_secondary' => SM_COLOR_SECONDARY,
				'sm_color_tertiary' => SM_COLOR_TERTIARY,
				'sm_dark_primary' => SM_DARK_PRIMARY,
				'sm_dark_secondary' => SM_DARK_SECONDARY,
				'sm_dark_tertiary' => SM_DARK_TERTIARY,
				'sm_light_primary' => SM_LIGHT_PRIMARY,
				'sm_light_secondary' => SM_LIGHT_SECONDARY,
				'sm_light_tertiary' => SM_LIGHT_TERTIARY,
			),
		),
	), $color_palettes);

	return $color_palettes;
}
add_filter( 'customify_get_color_palettes', 'themename_add_default_color_palette' );