<?php
/**
 * Noto Theme admin dashboard logic.
 *
 * @package Noto
 */

function noto_lite_admin_assets() {
	wp_enqueue_style( 'noto_lite_admin_style', get_template_directory_uri() . '/inc/lite/admin/css/admin.css', array(), '1.1.2', false );
}
add_action( 'admin_enqueue_scripts', 'noto_lite_admin_assets' );
