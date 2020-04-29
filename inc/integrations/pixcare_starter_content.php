<?php
/**
 * Pixelgrade Assistant Starter Content Compatibility File.
 * Here we add all the actions and filters responsible for the import action.
 */

/**
 * Filter the import action while getting the `noto_options` theme_mod
 *
 * @param array $theme_mod
 * @param string $demo_key
 *
 * @return mixed
 */
function noto_filter_post_theme_mod_noto_options( $theme_mod, $demo_key ) {
	// this holds the ids of posts, pages, medias and everything was already imported
	$starter_content = PixelgradeAssistant_Admin::get_option( 'imported_starter_content' );

	// We need to replace the ignored profile photo with the imported attachment id.
	if ( isset( $theme_mod['profile_photo'] ) && isset( $starter_content[ $demo_key ]['media']['ignored'][ $theme_mod['profile_photo'] ] ) ) {
		$theme_mod['profile_photo'] = $starter_content[ $demo_key ]['media']['ignored'][ $theme_mod['profile_photo'] ];
	}

	return $theme_mod;
}
add_filter( 'pixassist_sce_import_post_theme_mod_noto_options', 'noto_filter_post_theme_mod_noto_options', 10, 2 );
