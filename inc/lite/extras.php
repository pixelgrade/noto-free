<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Noto
 * @since 1.1.0
 */

/**
 * Theme About page logic.
 */
require get_template_directory() . '/inc/lite/admin/about-page.php'; // @codingStandardsIgnoreLines

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
function noto_lite_customize_register( $wp_customize ) {
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
                            <div class="description">Noto PRO takes everything to the next level, unlocking features like Post-it Note area to welcome visitors, more menu locations, and an Author Info Box to display below your articles along with social media sharing buttons, access to 600+ fonts & other styling options for buttons, text intro and article titles.</div>
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

	$wp_customize->add_setting(
		'noto_lite_style_view_pro_desc', array(
			'default'           => '',
			'sanitize_callback' => 'noto_sanitize_checkbox',
//			@todo check this sanitize
		)
	);

	$wp_customize->add_control(
		'noto_lite_style_view_pro_desc', array(
			'section' => 'noto_lite_style_view_pro',
			'type'    => 'hidden',
		)
	);

	//General
	$wp_customize->add_panel( 'general', array(
		'priority'       => 30,
		'theme_supports' => '',
		'title'          => __( 'General', '__theme_txtd' ),
		'description'    => __( '', '__theme_txtd' ),
	) );

	$wp_customize->add_section( 'post_it_note' , array(
		'title'    => __('Post-it Note','__theme_txtd'),
		'panel'    => 'general',
		'priority' => 10
	) );


	// Post-it Note title
	$wp_customize->add_setting( 'archive_post_it_title', array(
		'default'           => __( 'Hello', '__theme_txtd' ),
		'sanitize_callback' => 'noto_sanitize_text'
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'post_it_note_title',
			array(
				'label'    => __( 'Note Title', '__theme_txtd' ),
				'section'  => 'post_it_note',
				'settings' => 'archive_post_it_title',
				'type'     => 'text'
			)
		)
	);

	// Post-it Note content
	$wp_customize->add_setting( 'archive_post_it_content', array(
		'default'           => __( '<p>Welcome to my blog! Check out the latest post, browse the highlights or <a href="/contact/">reach me</a> to say Hi!</p>', '__theme_txtd' ),
		'sanitize_callback' => 'noto_sanitize_text'
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'post_it_note_content',
			array(
				'label'    => __( 'Note Content', '__theme_txtd' ),
				'section'  => 'post_it_note',
				'settings' => 'archive_post_it_content',
				'type'     => 'textarea'
			)
		)
	);

	// Post-it Note checkbox
	$wp_customize->add_setting( 'archive_post_it_disable', array(
		'default'           => 0,
		'sanitize_callback' => 'noto_sanitize_checkbox'
	) );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'post_it_note_checkbox',
			array(
				'label'    => __( 'Hide Post-it Note', '__theme_txtd' ),
				'section'  => 'post_it_note',
				'settings' => 'archive_post_it_disable',
				'type'     => 'checkbox',
			)
		)
	);


	// Site Identity
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'title_tagline', // This is needed so we avoid the prefixing and use the core defined section.
		 array(
			'profile_photo' => array(
				'label' => esc_html__( 'Profile Photo', '__theme_txtd' ),
				'type' => 'cropped_image',
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
			),
		)
	)
	);
}
add_action( 'customize_register', 'noto_lite_customize_register' );

/**
 * Generate a link to the Noto (Free) info page.
 */
function noto_lite_get_pro_link() {
	return 'https://pixelgrade.com/themes/blogging/noto-pro?utm_source=noto-lite-clients&utm_medium=customizer&utm_campaign=noto-lite';
}

function noto_lite_footer_credits_url( $url ) {
	return 'https://pixelgrade.com/?utm_source=noto-lite-clients&utm_medium=footer&utm_campaign=noto-lite';
}
add_filter( 'pixelgrade_footer_credits_url', 'noto_lite_footer_credits_url' );

function noto_lite_body_classes( $classes ) {

	$classes[] = 'lite-version';
	$classes[] = 'u-buttons-square';
	$classes[] = 'u-buttons-outline';

	return $classes;
}
add_filter( 'body_class', 'noto_lite_body_classes' );

function noto_alter_footer_component_config( $config ) {

	unset($config['sidebars']['sidebar-footer']);

	return $config;
}
add_filter( 'pixelgrade_footer_initial_config', 'noto_alter_footer_component_config', 10 );


add_filter( 'pixelgrade_prevent_post_navigation', '__return_true', 10 );






