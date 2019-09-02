<?php
/**
 * Noto Lite Customizer Options Config.
 *
 * @package Noto Lite
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
add_filter( 'customify_filter_fields', 'noto_lite_add_customify_options', 11, 1 );
add_filter( 'customify_filter_fields', 'noto_lite_add_customify_style_manager_section', 13, 1 );

add_filter( 'customify_filter_fields', 'noto_lite_fill_customify_options', 50 );

define( 'NOTOLITE_SM_COLOR_PRIMARY', '#FFB1A5' ); // Pink (used at 40% opacity)
define( 'NOTOLITE_SM_COLOR_SECONDARY', '#E79696' ); // Darker Pink
define( 'NOTOLITE_SM_COLOR_TERTIARY', '#383E5A' ); // Vibrant Blue

define( 'NOTOLITE_SM_DARK_PRIMARY', '#34394B' ); // Blueish
define( 'NOTOLITE_SM_DARK_SECONDARY', '#49494B' ); // Dark Grey
define( 'NOTOLITE_SM_DARK_TERTIARY', '#A2A3A2' ); // Light Grey

define( 'NOTOLITE_SM_LIGHT_PRIMARY', '#FFFFFF' ); // White
define( 'NOTOLITE_SM_LIGHT_SECONDARY', '#FFF4F4' ); // Light Pink
define( 'NOTOLITE_SM_LIGHT_TERTIARY', '#FFF5C1' ); // Light Yellow

define( 'NOTOLITE_SM_HEADINGS_FONT',     'IBM Plex Sans' );
define( 'NOTOLITE_SM_ACCENT_FONT',       'IBM Plex Sans' );
define( 'NOTOLITE_SM_BODY_FONT',         'IBM Plex Sans' );
define( 'NOTOLITE_SM_LOGO_FONT',         'Bungee' );

function noto_lite_add_customify_options( $options ) {
	$options['opt-name'] = 'noto_options';

	//start with a clean slate - no Customify default sections.
	$options['sections'] = array();

	return $options;
}

/**
 * Add the Style Manager cross-theme Customizer section.
 *
 * @param array $options
 *
 * @return array
 */
function noto_lite_add_customify_style_manager_section( $options ) {
	// If the theme hasn't declared support for style manager, bail.
	if ( ! current_theme_supports( 'customizer_style_manager' ) ) {
		return $options;
	}

	if ( ! isset( $options['sections']['style_manager_section'] ) ) {
		$options['sections']['style_manager_section'] = array();
	}

	$new_config = array(
		'options' => array(
			'sm_color_primary'   => array(
				'default'          => NOTOLITE_SM_COLOR_PRIMARY,
				'connected_fields' => array(
					'accent_color'
				),
				'css'              => array(
					array(
						'property' => '--sm-color-primary',
						'selector' => ':root',
					),
				),
			),
			'sm_color_secondary' => array(
				'default'          => NOTOLITE_SM_COLOR_SECONDARY,
				'connected_fields' => array(
					'accent_light_color'
				),
				'css'              => array(
					array(
						'property' => '--sm-color-secondary',
						'selector' => ':root',
					),
				),
			),
			'sm_color_tertiary'  => array(
				'default'          => NOTOLITE_SM_COLOR_TERTIARY,
				'connected_fields' => array(
					'tertiary_color'
				),
				'css'              => array(
					array(
						'property' => '--sm-color-tertiary',
						'selector' => ':root',
					),
				),
			),
			'sm_dark_primary'    => array(
				'default'          => NOTOLITE_SM_DARK_PRIMARY,
				'connected_fields' => array(
					'main_content_border_color',
					'main_content_page_title_color',
					'main_content_body_link_color',
					'main_content_body_link_active_color',
					'main_content_heading_1_color',
					'main_content_heading_2_color',
					'main_content_heading_3_color',
					'main_content_heading_4_color',
					'main_content_heading_5_color',
					'main_content_heading_6_color',
					'header_links_active_color',
					'footer_background',
					'buttons_color',
				),
				'css'              => array(
					array(
						'property' => '--sm-dark-primary',
						'selector' => ':root',
					),
					array(
						'property' => 'color',
						'selector' => '.c-noto__item--widget',
					),
				),
			),
			'sm_dark_secondary'  => array(
				'default'          => NOTOLITE_SM_DARK_SECONDARY,
				'connected_fields' => array(
					'main_content_body_text_color',
				),
				'css'              => array(
					array(
						'property' => '--sm-dark-secondary',
						'selector' => ':root',
					),
				),
			),
			'sm_dark_tertiary'   => array(
				'default'          => NOTOLITE_SM_DARK_TERTIARY,
				'connected_fields' => array(),
				'css'              => array(
					array(
						'property' => '--sm-dark-tertiary',
						'selector' => ':root',
					),
				),
			),
			'sm_light_primary'   => array(
				'default'          => NOTOLITE_SM_LIGHT_PRIMARY,
				'connected_fields' => array(
					'main_content_content_background_color',
					'header_navigation_links_color',
					'footer_body_text_color',
					'buttons_text_color',
				),
				'css'              => array(
					array(
						'property' => '--sm-light-primary',
						'selector' => ':root',
					),
				),
			),
			'sm_light_secondary' => array(
				'default'          => NOTOLITE_SM_LIGHT_SECONDARY,
				'connected_fields' => array(
					'accent_lighter_color',
					'header_background',
					'footer_links_color',
				),
				'css'              => array(
					array(
						'property' => '--sm-light-secondary',
						'selector' => ':root',
					),
				),
			),
			'sm_light_tertiary'  => array(
				'default'          => NOTOLITE_SM_LIGHT_TERTIARY,
				'connected_fields' => array(
					'light_tertiary_color'
				),
				'css'              => array(
					array(
						'property' => '--sm-light-tertiary',
						'selector' => ':root',
					),
				),
			),
		),
	);

	// The section might be already defined, thus we merge, not replace the entire section config.
	if ( class_exists( 'Customify_Array' ) && method_exists( 'Customify_Array', 'array_merge_recursive_distinct' ) ) {
		$options['sections']['style_manager_section'] = Customify_Array::array_merge_recursive_distinct( $options['sections']['style_manager_section'], $new_config );
	} else {
		$options['sections']['style_manager_section'] = array_merge_recursive( $options['sections']['style_manager_section'], $new_config );
	}

	return $options;
}

function noto_lite_fill_customify_options( $options ) {
	$buttons = array(
		'.c-btn',
		'.c-card__action',
		'.c-comments-toggle__label',
		'.comment-respond .submit',
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
	$buttons_solid   = implode( ',', array_map( 'noto_lite_prefix_solid_buttons', $buttons ) );
	$buttons_outline = implode( ',', array_map( 'noto_lite_prefix_outline_buttons', $buttons ) );

	$buttons_solid_hover = implode( ',', array_map( 'noto_lite_suffix_hover_buttons', $buttons ) );

	$new_config = array(
		'general'        => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
				'single_disable_intro_autostyle' => array(
					'type'              => 'hidden_control',
					'default'           => false,
				),
				'archive_disable_image_animations' => array(
					'type'              => 'hidden_control',
					'default'           => false,
				),
				'pattern_style'           => array(
					'type'              => 'hidden_control',
					'default' => 'waves',
				),

				'accent_color'         => array(
					'type'    => 'hidden_control',
					'live'    => true,
					'default' => NOTOLITE_SM_COLOR_PRIMARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '
								.intro[class],
								.c-author__name[class],
								.c-card:hover .c-card__excerpt,
								.slick-dots .slick-active',
						),
						array(
							'property' => 'border-color',
							'selector' => '
								select:active, 
								select:focus,
								
								input[type=date]:active, 
								input[type=date]:focus, 
								input[type=email]:active, 
								input[type=email]:focus, 
								input[type=number]:active, 
								input[type=number]:focus, 
								input[type=password]:active, 
								input[type=password]:focus, 
								input[type=search]:active, 
								input[type=search]:focus, 
								input[type=tel]:active, 
								input[type=tel]:focus, 
								input[type=text]:active, 
								input[type=text]:focus, 
								input[type=url]:active, 
								input[type=url]:focus,
								
								textarea:active,
								textarea:focus',
						),
						array(
							'property' => 'background-color',
							'selector' => '.widget_wpcom_social_media_icons_widget ul li:hover'
						),
					),
				),
				'accent_light_color'   => array(
					'type'    => 'hidden_control',
					'live'    => true,
					'default' => NOTOLITE_SM_COLOR_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '
								.header-category a:after,
								.c-meta__decoration:after',
						),
						array(
							'property' => 'background-color',
							'selector' => '
								.c-footer-layers__accent:after,
								.c-card__action:before,
								.cats a:before,
								.c-comments-toggle__label:before,
                                .comment-respond .submit:before'
						),
					),
				),
				'accent_lighter_color' => array(
					'type'    => 'hidden_control',
					'live'    => true,
					'default' => NOTOLITE_SM_LIGHT_SECONDARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '
								.c-card__letter[class],
								.c-navbar__label,
								.search-trigger[class]',
						),
						array(
							'property' => 'background-color',
							'selector' => '
								.c-noto__item--widget,
								.entry-footer .c-author,
								.u-buttons-solid .c-footer button[type=submit],
								ul.page-numbers > li > .current',
						),
					),
				),
				'tertiary_color'       => array(
					'type'    => 'hidden_control',
					'live'    => true,
					'default' => NOTOLITE_SM_COLOR_TERTIARY,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => '
								.c-footer-layers__dark',
						),
					),
				),
				'light_tertiary_color' => array(
					'type'    => 'hidden_control',
					'live'    => true,
					'default' => NOTOLITE_SM_LIGHT_TERTIARY,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => '.c-noto__item--widget.small, .c-noto__item:nth-child(12n+13).c-noto__item--widget',
						),
					),
				),
			)
		),
		'header_section' => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
				'header_logo_height' => array(
					'type'    => 'hidden_control',
					'default' => 40
				),
				'header_links_active_style'       => array(
					'type'    => 'hidden_control',
					'default' => 'active',
				),
				'header_navigation_links_spacing' => array(
					'type'    => 'hidden_control',
					'default'     => 0,
					'input_attrs' => array(
						'min' => 0,
					),
					'css'         => array(
						array(
							'property'        => 'margin-left',
							'selector'        => '.c-noto--header ul',
							'unit'            => 'px',
							'callback_filter' => 'typeline_negative_spacing_cb',
							'negative_value'  => true,
						),
						array(
							'property' => 'margin-left',
							'selector' => '
							    .c-noto--header li, 
							    .c-navbar__zone--right li',
							'unit'     => 'px',
							'media'    => 'only screen and (min-width: 62.5em)',
						),
					),
				),

				'header_navigation_links_color' => array(
					'default' => NOTOLITE_SM_LIGHT_PRIMARY,
					'type'    => 'hidden_control',
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '
							    .c-navbar__zone--left .menu > li,
							    .c-navbar__zone--right .menu > li',
						),
					),
				),
				'header_links_active_color'     => array(
					'type'    => 'hidden_control',
					'live'    => true,
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'css'     => array(
						array(
							'property' => 'color',
							'media'    => 'only screen and (min-width: 62.5em)',
							'selector' => '.c-navbar__zone--left .menu > li:hover',
						),
					),
				),
				'header_background'             => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_LIGHT_SECONDARY,
					'css'     => array(
						array(
							'media'    => 'only screen and (min-width: 62.5em)',
							'property' => 'background-color',
							'selector' => 'body.blog .header'
						),
					),
				),
				'header_site_title_font'          => array(
					'type'    => 'hidden_control',
					'default' => array(
						'font-family'    => NOTOLITE_SM_LOGO_FONT,
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
					'type'    => 'hidden_control',
					'selector' => '.c-navbar__zone--left, .c-navbar__zone--right',
					'default' => array(
						'font-family'    => NOTOLITE_SM_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 16,
						'line-height'    => 1.65,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
			)
		),
		'main_content'   => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
				'main_content_border_color'             => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => 'body.u-content-background,
								.profile-photo-link__label:after',
						),
						array(
							'property' => 'color',
							'selector' => '.c-card .wave-svg-mask,
								.c-reading-progress,
								.profile-photo-link--default svg',
						),
					),
				),
				'main_content_page_title_color'         => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'css'     => array(
						array(
							'selector' => '.c-search-overlay .search-field, .entry-title, .h0',
							'property' => 'color',
						),
					),
				),
				'main_content_body_text_color'          => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_SECONDARY,
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'body, .c-card__excerpt',
						),
					),
				),
				'main_content_body_link_color'          => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'a',
						),
					),
				),
				'main_content_body_link_active_color'   => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'a:hover, a:active',
						),
					),
				),
				'main_content_heading_1_color'          => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h1, .h1',
						),
					),
				),
				'main_content_heading_2_color'          => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h2, .h2',
						),
					),
				),
				'main_content_heading_3_color'          => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h3, .h3',
						),
					),
				),
				'main_content_heading_4_color'          => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h4, .h4',
						),
					),
				),
				'main_content_heading_5_color'          => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h5, .h5',
						),
					),
				),
				'main_content_heading_6_color'          => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => 'h6, .h6',
						),
					),
				),
				'main_content_content_background_color' => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_LIGHT_PRIMARY,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => '
								.c-footer-layers__background,
								.c-footer-layers__accent,
								.c-navbar__zone--left .menu > li > a:before,
								.c-search-overlay,
								.c-reading-progress,
								.page .header:after,
								.single .header:after,
								.profile-photo-link--admin svg'
						),
						array(
							'property' => 'color',
							'selector' => '.profile-photo-link__label,
										   .u-buttons-solid  .search-submit[class]:hover'
						),
					),
				),

				'main_content_page_title_font'          => array(
					'type'    => 'hidden_control',
					'selector' => '.c-search-overlay .search-field, .entry-title, .h0',
					'default' => array(
						'font-family'    => NOTOLITE_SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 74,
						'line-height'    => 1.08,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_body_text_font'           => array(
					'type'    => 'hidden_control',
					'default' => array(
						'font-family'    => NOTOLITE_SM_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 15,
						'line-height'    => 1.6,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_paragraph_text_font'      => array(
					'type'    => 'hidden_control',
					'selector' => '.entry-content, .site-description, .mce-content-body',
					'default' => array(
						'font-family'    => NOTOLITE_SM_BODY_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 18,
						'line-height'    => 1.67,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_quote_block_font'         => array(
					'type'    => 'hidden_control',
					'selector' => 'blockquote, .intro',
					'default'  => array(
						'font-family'    => NOTOLITE_SM_ACCENT_FONT,
						'font-weight'    => 'italic',
						'font-size'      => 18,
						'line-height'    => 1.67,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_1_font'           => array(
					'type'    => 'hidden_control',
					'default' => array(
						'font-family'    => NOTOLITE_SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 56,
						'line-height'    => 1.05,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_2_font'           => array(
					'type'    => 'hidden_control',
					'default' => array(
						'font-family'    => NOTOLITE_SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 42,
						'line-height'    => 1.15,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_3_font'           => array(
					'type'    => 'hidden_control',
					'default' => array(
						'font-family'    => NOTOLITE_SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 32,
						'line-height'    => 1.2,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_4_font'           => array(
					'type'    => 'hidden_control',
					'default' => array(
						'font-family'    => NOTOLITE_SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 24,
						'line-height'    => 1.3,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_5_font'           => array(
					'type'    => 'hidden_control',
					'selector' => 'h5, .header-category,
							ul.page-numbers,
							.c-author__name,
							.c-reading-progress__label,
							.post-navigation .nav-links__label,
							.cats__title,
							.tags__title,
							.sharedaddy--official h3.sd-title[class]',
					'default'  => array(
						'font-family'    => NOTOLITE_SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 18,
						'line-height'    => 1.4,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'main_content_heading_6_font'           => array(
					'type'    => 'hidden_control',
					'selector' => 'h6, .h6,
									.comment-reply-title a, .comment__metadata a,
									.edit-link a, .logged-in-as a, .reply a',
					'default'  => array(
						'font-family'    => NOTOLITE_SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 14,
						'line-height'    => 1.5,
						'letter-spacing' => 0.05,
						'text-transform' => 'uppercase',
					),
				),
			)
		),
		'footer_section' => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
				// [Section] Layout.
				'copyright_text'               => array(
					'type'    => 'hidden_control',
					/* translators: %year%: current year  %site-title%: the site title */
					'default' => esc_html__( '&copy; %year% %site-title%.', '__theme_txtd' ),
				),
				'footer_top_spacing'     => array(
					'type'    => 'hidden_control',
					'default' => 48
				),
				'footer_bottom_spacing'  => array(
					'type'    => 'hidden_control',
					'default' => 48
				),
				'footer_hide_back_to_top_link' => array(
					'type'    => 'hidden_control',
					'default' => true,
				),
				'footer_hide_credits'          => array(
					'type'    => 'hidden_control',
					'default' => false,
				),
				'footer_layout'                => array(
					'type'    => 'hidden_control',
					'default' => 'row',
				),

				'footer_body_text_color' => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_LIGHT_PRIMARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.c-footer,
											.u-buttons-outline .c-footer button[type=submit]',
						),
					),
				),
				'footer_links_color'     => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_LIGHT_SECONDARY,
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.c-footer a',
						),
					),
				),
				'footer_background'      => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'css'     => array(
						array(
							'property' => 'background',
							'selector' => '.u-footer-background',
						),
						array(
							'property' => 'color',
							'selector' => '.u-buttons-solid .c-footer button[type=submit]',
						),
					),
				),

				'footer_font' => array(
					'type'    => 'hidden_control',
					'label'       => esc_html__( 'Footer Font', '__theme_txtd' ),
					'desc'        => '',
					'selector'    => '.c-footer',
					'callback'    => 'typeline_font_cb',

					'default'     => array(
						'font-family' => NOTOLITE_SM_ACCENT_FONT,
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
			)
		),
		'blog_grid'      => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
				'blog_item_title_font'           => array(
					'type'    => 'hidden_control',
					'selector' => '.c-card__title',
					'default'  => array(
						'font-family'    => NOTOLITE_SM_HEADINGS_FONT,
						'font-weight'    => '700',
						'font-size'      => 32,
						'line-height'    => 1.0625,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_meta_font'            => array(
					'type'    => 'hidden_control',
					'selector' => '.c-card__meta',
					'default'  => array(
						'font-family'    => NOTOLITE_SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 16,
						'line-height'    => 1.5,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_items_primary_meta'      => array(
					'type'    => 'hidden_control',
					'default' => 'category',
				),
				'blog_items_secondary_meta'      => array(
					'type'    => 'hidden_control',
					'default' => 'date',
				),
				'blog_items_heading'             => array(
					'type'    => 'hidden_control',
					'default' => 'title',
				),
				'blog_items_content'             => array(
					'type'    => 'hidden_control',
					'default' => 'excerpt',
				),
				'blog_items_footer'             => array(
					'type'    => 'hidden_control',
					'default' => 'read_more',
				),

				'blog_item_footer_color' => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'live'    => true,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => '.c-gallery--blog .c-card__footer',
						),
					),
				),

				'blog_item_footer_font'             => array(
					'type'    => 'hidden_control',
					'default' => array(
						'font-family'    => 'IBM Plex Sans',
						'font-weight'    => '500',
						'font-size'      => 16,
						'line-height'    => 1.3,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_excerpt_font'         => array(
					'type'    => 'hidden_control',
					'selector' => '.c-card__excerpt',
					'default'  => array(
						'font-family'    => NOTOLITE_SM_ACCENT_FONT,
						'font-weight'    => 'regular',
						'font-size'      => 15,
						'line-height'    => 1.6,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
				'blog_item_thumbnail_background' => array(
					'type'    => 'hidden_control',
					'selector' => '.c-card__frame:after'
				),
			)
		),
		'buttons'        => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
				'buttons_style'      => array(
					'type'    => 'hidden_control',
					'default' => 'outline',
				),
				'buttons_shape'      => array(
					'type'    => 'hidden_control',
					'default' => 'square',
				),

				'buttons_color'      => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_DARK_PRIMARY,
					'css'     => array(
						array(
							'property' => 'background-color',
							'selector' => $buttons_solid,
						),
						array(
							'property' => 'color',
							'selector' => implode( ',',
								array(
									$buttons_outline,
									$buttons_solid_hover,
								)
							),
						),
						array(
							'property' => 'color',
							'media'    => 'only screen and (min-width: 62.5em)',
							'selector' => '.u-buttons-solid .c-card:hover .c-card__action',
						),
					),
				),
				'buttons_text_color' => array(
					'type'    => 'hidden_control',
					'default' => NOTOLITE_SM_LIGHT_PRIMARY,
					'css'     => array(
						array(
							'property' => 'color',
							'selector' => implode( ',', $buttons )
						),
					),
				),

				'buttons_font'       => array(
					'type'    => 'hidden_control',
					'selector' => $buttons_default . ',
						.button.default,
						.not-found .search-form .search-submit,
						.contact-form > div > .grunion-field-label:not(.checkbox):not(.radio),
						.nf-form-cont .label-above .nf-field-label label,
						.nf-form-cont .list-checkbox-wrap .nf-field-element li label,
						.nf-form-cont .list-radio-wrap .nf-field-element li label,
						div.wpforms-container[class] .wpforms-form .wpforms-field-label',
					'default'  => array(
						'font-family'    => NOTOLITE_SM_ACCENT_FONT,
						'font-weight'    => '500',
						'font-size'      => 16,
						'line-height'    => 1.27,
						'letter-spacing' => 0,
						'text-transform' => 'none',
					),
				),
			)
		)
	);

	if ( class_exists( 'Customify_Array' ) && method_exists( 'Customify_Array', 'array_merge_recursive_distinct' ) ) {
		$options['sections'] = Customify_Array::array_merge_recursive_distinct( $options['sections'], $new_config );
	} else {
		$options['sections'] = array_merge_recursive( $options['sections'], $new_config );
	}

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
		unset( $options['sections']['blog_grid']['options'][ $option_name ] );
	}

	$options_to_be_removed = array(
		'main_content_container_width',
		'main_content_container_sides_spacing',
		'main_content_content_width',
		'main_content_container_padding',
		'main_content_border_width',
	);

	foreach ( $options_to_be_removed as $option_name ) {
		unset( $options['sections']['main_content']['options'][ $option_name ] );
	}

	return $options;
}

/*
 * Helper functions for the buttons section config.
 */
function noto_lite_prefix_solid_buttons( $value ) {
	return '.u-buttons-solid ' . $value;
}

function noto_lite_suffix_hover_buttons( $value ) {
	return '.u-buttons-solid ' . $value . ':hover';
}

function noto_lite_prefix_outline_buttons( $value ) {
	return '.u-buttons-outline ' . $value;
}

if ( ! function_exists( 'noto_lite_meta_background_gradient_cb' ) ) {
	function noto_lite_meta_background_gradient_cb( $value, $selector, $property, $unit ) {
		$output = $selector . ' {' .
		          $property . ': linear-gradient(90deg, ' . $value . ' 50%, transparent);' .
		          '}';

		return $output;
	}
}

if ( ! function_exists( 'noto_lite_meta_background_gradient_cb_customizer_preview' ) ) :
	/**
	 * Outputs the inline JS code used in the Customizer for the aspect ratio live preview.
	 */
	function noto_lite_meta_background_gradient_cb_customizer_preview() {

		$js = "
			function noto_lite_meta_background_gradient_cb( value, selector, property, unit ) {

			    var css = '',
			        style = document.getElementById('noto_lite_meta_background_gradient_cb_style_tag'),
			        head = document.head || document.getElementsByTagName('head')[0];

			    css += selector + ' {' +
			        property + ': linear-gradient(90deg, ' + value + ' 50%, transparent);' +
		        '}';

			    if ( style !== null ) {
			        style.innerHTML = css;
			    } else {
			        style = document.createElement('style');
			        style.setAttribute('id', 'noto_lite_meta_background_gradient_cb_style_tag');

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

add_action( 'customize_preview_init', 'noto_lite_meta_background_gradient_cb_customizer_preview', 20 );

function noto_lite_add_default_color_palette( $color_palettes ) {

	$color_palettes = array_merge( array(
		'default' => array(
			'label'   => esc_html__( 'Theme Default', '__theme_txtd' ),
			'preview' => array(
				'background_image_url' => 'https://cloud.pixelgrade.com/wp-content/uploads/2018/07/noto-palette-e1531482820427.jpg',
			),
			'options' => array(
				'sm_color_primary'   => NOTOLITE_SM_COLOR_PRIMARY,
				'sm_color_secondary' => NOTOLITE_SM_COLOR_SECONDARY,
				'sm_color_tertiary'  => NOTOLITE_SM_COLOR_TERTIARY,
				'sm_dark_primary'    => NOTOLITE_SM_DARK_PRIMARY,
				'sm_dark_secondary'  => NOTOLITE_SM_DARK_SECONDARY,
				'sm_dark_tertiary'   => NOTOLITE_SM_DARK_TERTIARY,
				'sm_light_primary'   => NOTOLITE_SM_LIGHT_PRIMARY,
				'sm_light_secondary' => NOTOLITE_SM_LIGHT_SECONDARY,
				'sm_light_tertiary'  => NOTOLITE_SM_LIGHT_TERTIARY,
			),
		),
	), $color_palettes );

	return $color_palettes;
}

add_filter( 'customify_get_color_palettes', 'noto_lite_add_default_color_palette' );

function noto_bind_profile_picture_script() {
	?>
    <script type="text/javascript">
		(
			function( $ ) {
				wp.customize.bind( 'ready', function() {
					wp.customize.previewer.bind( 'ready', function() {
						var $body = $( wp.customize.previewer.targetWindow().document.body );
						$body.on( 'click', '.profile-photo-link--default', function() {
							wp.customize['section'].instance( 'title_tagline' ).focus();
						} );
					} );
				} );
			}
		)( jQuery );
    </script>
	<?php
}

add_action( 'customize_controls_print_scripts', 'noto_bind_profile_picture_script' );
