<?php
/**
 * Require files that deal with various plugins integrations.
 *
 * @codingStandardsIgnoreFile
 * phpcs:ignoreFile
 *
 * @package Noto
 * @since 1.1.0
 */

/**
 * Load Pixelgrade Care compatibility file.
 * http://pixelgrade.com/
 */
require pixelgrade_get_parent_theme_file_path( pixelgrade_get_theme_relative_path( __DIR__ ) . 'integrations/pixelgrade-care.php' );


/**
 * Load Jetpack compatibility file.
 * https://jetpack.me/
 */
require pixelgrade_get_parent_theme_file_path( pixelgrade_get_theme_relative_path( __DIR__ ) . 'integrations/jetpack.php' );
