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
				<p>Take it to the next level and stand out. See the hotspots of Vasco PRO:</p>
				<ul class="upsell-features">
                        <li>
                            <h4>Personalize to Match Your Style</h4>
                            <div class="description">Having different tastes and preferences might be tricky for users, but not with Vasco onboard. It has Style Manager, an intuitive and catchy interface that allows you to change color palettes and fonts with a few clicks.</div>
                        </li>

                        <li>
                            <h4>New Widgets for More Flexibility</h4>
                            <div class="description">Besides the Grid Posts and Profile widgets, the PRO version comes with much more: Feature Card, Callout Box, Categories, Promo Box and many others. You also get more layout options and widget areas to play with such as Sidebar, Footer and Below Post.</div>
                        </li>

                        <li>
                            <h4>Advanced Features for a Unique Look</h4>
                            <div class="description">Vasco PRO takes everything to the next level, unlocking features like custom Stamps & Blobs for compelling visual identity. You also get access to Sticky Menu, Announcement Bar at the top of your website, Reading Progress Bar, Author Info Box and Related Posts to display below your articles.</div>
                        </li>

                        <li>
                            <h4>Premium Customer Support</h4>
                            <div class="description">You will benefit from priority support from a caring and devoted team, eager to help and to spread happiness. We work hard to provide a flawless experience for those who vote us with trust and choose to be our special clients.</div>
                        </li>
                        
                </ul> %s </div>', '__theme_txtd'
				),
				sprintf( '<a href="%1$s" target="_blank" class="button button-primary">%2$s</a>', esc_url( noto_lite_get_pro_link() ), esc_html__( 'Get Noto Pro', '__theme_txtd' ) )
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
