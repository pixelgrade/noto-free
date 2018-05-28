<?php
/**
 * Require files that deal with various plugins integrations.
 *
 * @package Noto
 * @since 1.0.0
 */

/**
 * Load Customify compatibility file.
 * http://pixelgrade.com/
 */
require pixelgrade_get_parent_theme_file_path( '/inc/integrations/customify.php' );

/**
 * Load Pixelgrade Care compatibility file.
 * http://pixelgrade.com/
 */
require pixelgrade_get_parent_theme_file_path( '/inc/integrations/pixelgrade-care.php' );

/**
 * Load Jetpack compatibility file.
 * https://jetpack.me/
 */
require pixelgrade_get_parent_theme_file_path( '/inc/integrations/jetpack.php' );