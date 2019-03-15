<?php
/**
 * Handle the Components integration.
 *
 * @package Noto
 * @since 1.1.0
 */

/**
 * Change blog component config.
 *
 * @param array $config
 *
 * @return array
 */
function noto_alter_blog_component_config( $config ) {

	$config = Pixelgrade_Config::merge( $config, array(
		'sidebars' => array(
			'sidebar-1' => array(
				'sidebar_args' => array(
					'name'          => esc_html__( 'Posts Grid Widgets', '__theme_txtd' ),
					'description'   => esc_html__( 'Insert your favorite widgets here, and we will place them throughout the Frontpage posts grid.', '__theme_txtd' ),
					'before_widget' => '<div class="c-noto__item c-noto__item--widget %2$s"><section id="%1$s" class="widget">',
					'after_widget'  => '</section></div>',
					'before_title'  => '<h2 class="widget__title h6"><span>',
					'after_title'   => '</span></h2>',
				),
			),
			'sidebar-2' => array(
				'sidebar_args' => array(
					'before_title' => '<h2 class="widget__title h4"><span>',
					'after_title'  => '</span></h2>',
				),
			)
		)
	) );

	return $config;
}
add_filter( 'pixelgrade_blog_config', 'noto_alter_blog_component_config', 10 );

/**
 * Modify the Footer widget area settings.
 *
 * @param array $config
 *
 * @return array
 */
function noto_alter_footer_component_config( $config ) {
	$config = Pixelgrade_Config::merge( $config, array(
		'sidebars' => array(
			'sidebar-footer' => array(
				'sidebar_args' => array(
					'before_title' => '<h2 class="widget__title h4"><span>',
					'after_title'  => '</span></h2>',
				),
			)
		)
	) );

	return $config;
}
add_filter( 'pixelgrade_footer_config', 'noto_alter_footer_component_config', 10 );
