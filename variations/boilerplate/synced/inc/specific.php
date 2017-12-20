<?php
/**
 * Provides specific logic for the current theme variation.
 *
 * @package Boilerplate
 * @since 1.0.0
 */

/*
 * Load all the files directly in the specific directory.
 */
pixelgrade_autoload_dir( trailingslashit( __DIR__ ) . 'specific' );

function boilerplate_setup_pixelgrade_care() {
	/*
	 * Declare support for Pixelgrade Care
	 */
	add_theme_support( 'pixelgrade_care', array(
			'support_url'   => 'https://pixelgrade.com/docs/boilerplate/',
			'changelog_url' => 'https://wupdates.com/boilerplate-changelog',
		)
	);
}
add_action( 'after_setup_theme', 'boilerplate_setup_pixelgrade_care' );
