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
if ( class_exists( 'PixCustomifyPlugin' )) {
	require pixelgrade_get_parent_theme_file_path( '/inc/integrations/customify.php' ); // phpcs:ignore
}

/**
 * Load Pixelgrade Care Starter Content compatibility file.
 * http://pixelgrade.com/
 */
require pixelgrade_get_parent_theme_file_path( '/inc/integrations/pixcare_starter_content.php' ); // phpcs:ignore

