<?php

function variation_change_blog_component_config() {

	Pixelgrade_BlocksManager()->registerBlock( 'blog/single-portrait', array(
		'blocks' => array(
			'blog/entry-thumbnail',
			'sidebar' => array(
				'extend'   => 'blog/side',
				'blocks'   => array( 'blog/sidebar' ),
				'wrappers' => array(
					'side' => array(
						'extend_classes' => 'widget-area--post',
					),
				),
			),
			'layout' => array(
				'blocks'   => array(
					'blog/entry-content',
					'blog/entry-footer',
				),
				'wrappers' => array(
					'main' => array(
						'classes' => 'single-main clearfix'
					),
				),
			),
		),
	) );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/single-landscape', array(
		'blocks' => array(
			'sidebar' => array(
				'extend'   => 'blog/side',
				'blocks'   => array( 'blog/sidebar' ),
				'wrappers' => array(
					'side' => array(
						'extend_classes' => 'widget-area--post'
					),
				),
			),
			'blog/entry-thumbnail',
			'blog/entry-content',
			'blog/entry-footer',
		),
	) );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/single', array(
		'extend' => 'blog/default',
		'blocks' => array(
			'header' => array(
				'extend'   => 'blog/container',
				'blocks'   => array( 'blog/entry-header-single' ),
				'wrappers' => array(
					array(
						'priority' => 100,
						'classes'  => 'u-header-background'
					),
				),
			),
			'layout' => array(
				'extend' => 'blog/container',
				'blocks' => array(
					'image-landscape' => array(
						'extend' => 'blog/single-landscape',
						'checks' => array(
							'callback' => 'boilerplate_has_landscape_thumbnail'
						),
					),
					'image-portrait'  => array(
						'extend' => 'blog/single-portrait',
						'checks' => array(
							'callback' => 'boilerplate_has_portrait_thumbnail'
						),
					),
					'image-none'      => array(
						'extend' => 'blog/single-landscape',
						'checks' => array(
							'callback' => 'boilerplate_has_no_thumbnail'
						),
					),
				),
			),
			'blog/related-posts',
		),
	) );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/page', array(
		'extend' => 'blog/default',
		'blocks' => array(
			'content' => array(
				'extend' => 'blog/container',
				'blocks' => array(
					'layout' => array(
						'extend' => 'blog/layout',
						'wrappers' => array(
							'layout' => array(
								'extend_classes' => 'o-layout--blog'
							),
						),
						'blocks' => array(
							'main' => array(
								'extend' => 'blog/main',
								'blocks' => array(
									'blog/entry-header-page',
									'blog/entry-content',
									'blog/entry-footer',
								),
							),
							'side' => array(
								'extend' => 'blog/side',
								'blocks' => array( 'blog/sidebar' ),
								'checks' => array(
									array(
										'callback' => '__return_true',
										'args'     => array(),
									),
								),
							),
						),
					),
				),
			),
			'blog/related-posts',
		)
	) );
}

add_action( 'init', 'variation_change_blog_component_config', 20 );
