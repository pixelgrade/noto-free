<?php
/**
 * Custom functions related to the Components Blocks system.
 *
 * Development notice: This file is synced from the variations directory! Do not edit in the `inc` directory!
 *
 * @package Boilerplate
 * @since 1.0.0
 */

/**
 * Register new blog blocks, besides the ones provided by the blog component.
 *
 * @param string $component_slug The component's slug.
 * @param array $component_config The component entire component config.
 */
function variation_register_blog_blocks( $component_slug, $component_config ) {

	Pixelgrade_BlocksManager()->registerBlock( 'blog/single-portrait', array(
		'blocks' => array(
			'blog/entry-thumbnail',
			'sidebar' => array(
				'extend'   => 'blog/side',
				'wrappers' => array(
					'side' => array(
						'extend_classes' => 'widget-area--post',
					),
				),
				'blocks'   => array( 'blog/sidebar' ),
			),
			'layout' => array(
				'wrappers' => array(
					'main' => array(
						'classes' => 'single-main clearfix',
					),
				),
				'blocks'   => array(
					'blog/entry-content',
					'blog/entry-footer',
				),
			),
		),
	) );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/single-landscape', array(
		'blocks' => array(
			'sidebar' => array(
				'extend'   => 'blog/side',
				'wrappers' => array(
					'side' => array(
						'extend_classes' => 'widget-area--post',
					),
				),
				'blocks'   => array( 'blog/sidebar' ),
			),
			'blog/entry-thumbnail',
			'blog/entry-content',
			'blog/entry-footer',
		),
	) );

	// Overwrite the Blog Component 'blog/single' block to take advantage of thumbnail aspect ratio logic.
	Pixelgrade_BlocksManager()->registerBlock( 'blog/single', array(
		'extend' => 'blog/default',
		'blocks' => array(
			'header' => array(
				'extend'   => 'blog/container',
				'wrappers' => array(
					array(
						'priority' => 100,
						'classes'  => 'u-header-background',
					),
				),
				'blocks'   => array( 'blog/entry-header-single' ),
			),
			'layout' => array(
				'extend' => 'blog/container',
				'blocks' => array(
					'image-landscape' => array(
						'extend' => 'blog/single-landscape',
						'checks' => array(
							'callback' => 'pixelgrade_has_landscape_thumbnail',
						),
					),
					'image-portrait'  => array(
						'extend' => 'blog/single-portrait',
						'checks' => array(
							'callback' => 'pixelgradee_has_portrait_thumbnail',
						),
					),
					'image-none'      => array(
						'extend' => 'blog/single-landscape',
						'checks' => array(
							'callback' => 'pixelgrade_has_no_thumbnail',
						),
					),
				),
			),
			'blog/related-posts',
		),
	) );
}
add_action( 'pixelgrade_blog_after_register_blocks', 'variation_register_blog_blocks', 10, 2 );
