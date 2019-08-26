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
add_filter( 'customify_filter_fields', 'noto_lite_add_customify_style_manager_section', 12, 1 );

add_filter( 'customify_filter_fields', 'noto_lite_fill_customify_options', 20 );

define( 'NOTOLITE_SM_COLOR_PRIMARY', '#FFB1A5' ); // Pink (used at 40% opacity)
define( 'NOTOLITE_SM_COLOR_SECONDARY', '#E79696' ); // Darker Pink
define( 'NOTOLITE_SM_COLOR_TERTIARY', '#383E5A' ); // Vibrant Blue

define( 'NOTOLITE_SM_DARK_PRIMARY', '#34394B' ); // Blueish
define( 'NOTOLITE_SM_DARK_SECONDARY', '#49494B' ); // Dark Grey
define( 'NOTOLITE_SM_DARK_TERTIARY', '#A2A3A2' ); // Light Grey

define( 'NOTOLITE_SM_LIGHT_PRIMARY', '#FFFFFF' ); // White
define( 'NOTOLITE_SM_LIGHT_SECONDARY', '#FFF4F4' ); // Light Pink
define( 'NOTOLITE_SM_LIGHT_TERTIARY', '#FFF5C1' ); // Light Yellow

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

	$options['sections']['style_manager_section'] = Customify_Array::array_merge_recursive_distinct( $options['sections']['style_manager_section'], $new_config );

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

	$buttons_solid   = implode( ',', array_map( 'noto_prefix_solid_buttons', $buttons ) );
	$buttons_outline = implode( ',', array_map( 'noto_prefix_outline_buttons', $buttons ) );

	$buttons_solid_hover = implode( ',', array_map( 'noto_suffix_hover_buttons', $buttons ) );


	$new_config = array(
		'general'        => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
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
							'selector' => 'body',
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
			)
		),
		'footer_section' => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
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
			)
		),
		'blog_grid'      => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
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
			)
		),
		'buttons'        => array(
			'title'   => '',
			'type'    => 'hidden',
			'options' => array(
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
			)
		)
	);

	$options['sections'] = Customify_Array::array_merge_recursive_distinct( $options['sections'], $new_config );

	return $options;
}

function noto_change_site_identity_section( $options ) {
	$options['sections']['title_tagline'] = array(
		'section_id' => 'title_tagline', // This is needed so we avoid the prefixing and use the core defined section.
		'options'    => array(
			'profile_photo' => array(
				'label'         => esc_html__( 'Profile Photo', '__theme_txtd' ),
				'type'          => 'cropped_image',
				'priority'      => 7, // this will make it appear above Logo (that has a priority of 8).
				'width'         => 700, // Suggested width for cropped image.
				'height'        => 700, // Suggested height for cropped image.
				'flex_width'    => true, // Whether the width is flexible.
				'flex_height'   => true, // Whether the height is flexible.
				'button_labels' => array(
					'select'       => esc_html__( 'Select photo', '__theme_txtd' ),
					'change'       => esc_html__( 'Change photo', '__theme_txtd' ),
					'remove'       => esc_html__( 'Remove', '__theme_txtd' ),
					'default'      => esc_html__( 'Default', '__theme_txtd' ),
					'placeholder'  => esc_html__( 'No photo selected', '__theme_txtd' ),
					'frame_title'  => esc_html__( 'Select photo', '__theme_txtd' ),
					'frame_button' => esc_html__( 'Choose photo', '__theme_txtd' ),
				),
			),
		),
	);

	// "Instruct" Customify to remove controls and their settings.
	if ( empty( $options['remove_controls'] ) ) {
		$options['remove_controls'] = array();
	}
	if ( empty( $options['remove_settings'] ) ) {
		$options['remove_settings'] = array();
	}

	// We want to replace the Display Site Title and Tagline control with two, one for each site title and site description.
	$options['remove_controls'][] = 'header_text';
	$options['remove_settings'][] = 'header_text';

	// Change the priority of the blogdescription control so we can insert a control between it and the site title one.
	if ( empty( $options['change_control_props'] ) ) {
		$options['change_control_props'] = array();
	}
	$options['change_setting_props']['blogname']        = array(
		'transport' => 'postMessage',
	);
	$options['change_setting_props']['blogdescription'] = array(
		'transport' => 'postMessage',
	);
	$options['change_control_props']['blogdescription'] = array(
		'priority' => 11,
	);

	$options['sections']['title_tagline']['options']['display_site_title'] = array(
		'label'    => esc_html__( 'Display Site Title', '__theme_txtd' ),
		'type'     => 'checkbox',
		'priority' => 10.5,
		'default'  => true,
	);

	$options['sections']['title_tagline']['options']['display_site_description'] = array(
		'label'    => esc_html__( 'Display Site Tagline', '__theme_txtd' ),
		'type'     => 'checkbox',
		'priority' => 11.5,
		'default'  => true,
	);


	return $options;
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

function noto_add_default_color_palette( $color_palettes ) {

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

add_filter( 'customify_get_color_palettes', 'noto_add_default_color_palette' );

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
