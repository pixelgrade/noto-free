<?php
/**
 * Custom functions related to the Components Blocks system.
 *
 * Development notice: This file is synced from the variations directory! Do not edit in the `inc` directory!
 *
 * @package Noto
 * @since 1.0.0
 */

/**
 * Register new blog blocks, besides the ones provided by the blog component.
 *
 * @param string $component_slug The component's slug.
 * @param array $component_config The component entire component config.
 */

function noto_register_blog_blocks( $component_slug, $component_config ) {

	Pixelgrade_BlocksManager()->registerBlock( 'blog/entry-header', array() );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/entry-header-single', array(
		'extend' => 'blog/entry-header',
		'type'      => 'template_part',
		'templates' => array(
			array(
				'component_slug' => 'blog',
				'slug' => 'entry-header',
				'name' => 'single',
			),
		),
	));

	Pixelgrade_BlocksManager()->registerBlock( 'blog/single', array(
		'blocks' => array(
			'blog/entry-header-single',
			'blog/entry-content',
			'blog/sidebar-below-post',
			'blog/entry-footer',
			'blog/related-posts',
		),
		'wrappers' => array(
			'primary' => array(
				'id'       => 'primary',
				'classes'  => 'content-area',
				'priority' => 10,
			),
		),
	));

	Pixelgrade_BlocksManager()->registerBlock( 'blog/page', array(
		'extend' => 'blog/single'
	));

	Pixelgrade_BlocksManager()->registerBlock( 'blog/loop', array(
		'blocks' => array(
			'loop-posts' => array(
				'type'     => 'loop',
				'blocks'   => array(
					'grid-item' => array(
						'type'      => 'template_part',
						'templates' => array(
							array(
								'component_slug' => $component_slug,
								'slug'           => 'content'
							),
						),
					),
				),
			),
			'loop-pagination' => array(
				'type' => 'callback',
				'callback' => 'pixelgrade_the_posts_pagination',
				'args' =>array(
					'end_size'           => 1,
					'mid_size'           => 2,
					'type'               => 'list',
					'prev_text'          => esc_html_x( '&laquo; Previous', 'previous set of posts', '__components_txtd' ),
					'next_text'          => esc_html_x( 'Next &raquo;', 'next set of posts', '__components_txtd' ),
					'screen_reader_text' => esc_html__( 'Posts navigation', '__components_txtd' ),
				),
			),
		),
		'checks' => array(
			array(
				'callback' => 'have_posts',
				'args'     => array(),
			),
		),
	) );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/index', array(
		'blocks'   => array(
			'blog/loop', // These two are mutually exclusive
			'blog/loop-none',
			'blog/sidebar',
		),
	) );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/home', array(
		'extend' => 'blog/index'
	) );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/archive', array(
		'blocks'   => array(
			'blog/entry-header-archive',
			'blog/loop', // These two are mutually exclusive
			'blog/loop-none',
			'blog/sidebar',
		),
	) );

	Pixelgrade_BlocksManager()->registerBlock( 'blog/search', array(
		'blocks'   => array(
			'blog/entry-header-search',
			'blog/loop', // These two are mutually exclusive
			'blog/loop-none',
			'blog/sidebar',
		),
	) );

}
add_action( 'pixelgrade_blog_after_register_blocks', 'noto_register_blog_blocks', 10, 2 );
