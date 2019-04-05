<?php
/**
 * Noto Lite Customizer Options logic
 *
 * @package Noto
 * @since 1.1.0
 */

/**
 * Assets that will be loaded for the customizer sidebar
 */
function noto_lite_customizer_assets() {
	wp_enqueue_style( 'noto_lite_customizer_style', get_template_directory_uri() . '/inc/lite/admin/customizer.css', null, '1.0.0', false );
}
add_action( 'customize_controls_enqueue_scripts', 'noto_lite_customizer_assets' );

/**
 * Add PRO Tab in Customizer
 *
 * @param WP_Customize_Manager $wp_customize
 */
function noto_lite_customizer_add_pro_controls( $wp_customize ) {
	// View Pro
	$wp_customize->add_section(
		'noto_lite_style_view_pro', array(
			'title'       => esc_html__( 'View PRO Version', '__theme_txtd' ),
			'priority'    => 2,
			'description' => sprintf(
			/* translators: %s: The upsell link. */
				__(
					'<div class="upsell-container">
				<h2>Need More? Go PRO</h2>
				<p>Take it to the next level and stand out. See the hotspots of Noto PRO:</p>
				<ul class="upsell-features">
                        <li>
                            <h4>Personalize to Match Your Style</h4>
                            <div class="description">Having different tastes and preferences might be tricky for users, but not with Noto PRO onboard. It has Style Manager, an intuitive and catchy interface that allows you to change color palettes and fonts with a few clicks.</div>
                        </li>

                        <li>
                            <h4>More Widget Areas for Extra Flexibility</h4>
                            <div class="description">The PRO version comes with three widget-friendly sections: on your Home Page, Below Posts, and in the Footer. Use these areas to get new email subscribers, social media followers or anything else that gets you closer to your goals.</div>
                        </li>

                        <li>
                            <h4>Advanced Features for a Unique Look</h4>
                            <div class="description">Noto PRO takes everything to the next level, unlocking features like more menu locations, a search option, and an Author Info Box along with social media sharing buttons. You also get access to 600+ fonts & other styling options for buttons, text intro and article titles.</div>
                        </li>

                        <li>
                            <h4>Premium Customer Support</h4>
                            <div class="description">You will benefit from priority support from a caring and devoted team, eager to help and to spread happiness. We work hard to provide a flawless experience for those who vote us with trust and choose to be our special clients.</div>
                        </li>
                        
                </ul> %s </div>', '__theme_txtd'
				),
				sprintf( '<a href="%1$s" target="_blank" class="button button-primary">%2$s</a>', esc_url( noto_lite_get_pro_link() ), esc_html__( 'Get Noto PRO', '__theme_txtd' ) )
			),
		)
	);

	// This is just an empty control so that the section will show up.
	$wp_customize->add_setting(
		'noto_lite_style_view_pro_desc', array(
			'default'           => '',
			'sanitize_callback' => '__return_true',
		)
	);
	$wp_customize->add_control(
		'noto_lite_style_view_pro_desc', array(
			'section' => 'noto_lite_style_view_pro',
			'type'    => 'hidden',
		)
	);
}
add_action( 'customize_register', 'noto_lite_customizer_add_pro_controls', 10, 1 );

/**
 * Add the Theme Options controls.
 *
 * @param WP_Customize_Manager $wp_customize
 */
function noto_lite_customizer_add_theme_options_controls( $wp_customize ) {

	/**
	 * Theme options.
	 */
	$wp_customize->add_panel(
		'theme_options',
		array(
			'title'    => esc_html__( 'Theme Options', '__theme_txtd' ),
			'priority' => 130, // Before Additional CSS.
		)
	);

	$wp_customize->add_section( 'post_it_note' , array(
		'title'    => esc_html__('Post-it Note','__theme_txtd'),
		'panel'    => 'theme_options',
		'priority' => 10
	) );


	// Post-it Note title
	$wp_customize->add_setting( 'noto_options[archive_post_it_title]', array(
		'default'           => esc_html__( 'Hello', '__theme_txtd' ),
		'capability' => 'edit_theme_options',
		'transport'  => 'refresh',
		'sanitize_callback' => 'wp_kses_post'
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'noto_options[archive_post_it_title]_control',
			array(
				'type'     => 'text',
				'label'    => esc_html__( 'Note Title', '__theme_txtd' ),
				'desc'     => '',
				'section'  => 'post_it_note',
				'settings' => 'noto_options[archive_post_it_title]',
			)
		)
	);

	// Post-it Note content
	$wp_customize->add_setting( 'noto_options[archive_post_it_content]', array(
		'default'           => wp_kses_post( __( '<p>Welcome to my blog! Check out the latest post, browse the highlights or <a href="/contact/">reach me</a> to say Hi!</p>', '__theme_txtd' ) ),
		'capability' => 'edit_theme_options',
		'transport'  => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'noto_options[archive_post_it_content]_control',
			array(
				'type'     => 'textarea',
				'label'    => esc_html__( 'Note Content', '__theme_txtd' ),
				'desc'     => '',
				'section'  => 'post_it_note',
				'settings' => 'noto_options[archive_post_it_content]',
			)
		)
	);

	// Hide Post-it Note checkbox
	$wp_customize->add_setting( 'noto_options[archive_post_it_disable]', array(
		'default'           => false,
		'capability' => 'edit_theme_options',
		'transport'  => 'refresh',
		'sanitize_callback' => 'noto_lite_sanitize_checkbox'
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'noto_options[archive_post_it_disable]_control',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Hide Post-it Note', '__theme_txtd' ),
				'desc'     => '',
				'section'  => 'post_it_note',
				'settings' => 'noto_options[archive_post_it_disable]',
			)
		)
	);
}
add_action( 'customize_register', 'noto_lite_customizer_add_theme_options_controls', 10, 1 );

/**
 * @param WP_Customize_Manager $wp_customize
 */
function noto_lite_add_profile_image_option( $wp_customize ) {

	$setting_id = 'noto_options[profile_photo]';

	$wp_customize->add_setting( $setting_id, array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'refresh',
		'sanitize_callback' => 'noto_lite_sanitize_profile_photo',
	) );

	$control = new WP_Customize_Cropped_Image_Control(
		$wp_customize,
		$setting_id . '_control',
		array(
			'label' => esc_html__( 'Profile Photo', '__theme_txtd' ),
			'priority'      => 7, // this will make it appear above Logo (that has a priority of 8).
			'width'         => 700, // Suggested width for cropped image.
			'height'        => 700, // Suggested height for cropped image.
			'flex_width'    => true, // Whether the width is flexible.
			'flex_height'   => true, // Whether the height is flexible.
			'button_labels' => array(
				'select'       => esc_html__( 'Select photo', '__theme_txtd'  ),
				'change'       => esc_html__( 'Change photo', '__theme_txtd'  ),
				'remove'       => esc_html__( 'Remove', '__theme_txtd'  ),
				'default'      => esc_html__( 'Default', '__theme_txtd'  ),
				'placeholder'  => esc_html__( 'No photo selected', '__theme_txtd'  ),
				'frame_title'  => esc_html__( 'Select photo', '__theme_txtd'  ),
				'frame_button' => esc_html__( 'Choose photo', '__theme_txtd'  ),
			),
			'section'  => 'title_tagline',
			'settings' => $setting_id,
		)
	);

	$wp_customize->add_control( $control );
}
add_action( 'customize_register', 'noto_lite_add_profile_image_option', 10, 1 );


/**
 * Sanitize the checkbox.
 *
 * @param boolean $input .
 *
 * @return boolean true if is 1 or '1', false if anything else
 */
function noto_lite_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Sanitize profile photo.
 *
 * @param boolean $input .
 *
 * @return mixed
 */
function noto_lite_sanitize_profile_photo( $input ) {

	$mimes_allowed = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png'
	);
	$extension     = get_post_mime_type( $input );

	//if file has a valid mime type return input, otherwise return FALSE
	foreach ( $mimes_allowed as $mime ) {
		if ( $extension == $mime ) {
			return $input;
		}
	}

	return false;
}
