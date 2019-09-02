<?php
/**
 * Pixelgrade Assistant Starter Content Compatibility File.
 * Here we add all the actions and filters responsible for the import action.
 */

/**
 * Filter the import action while getting the `noto_options` theme_mod
 *
 * @param array $theme_mod
 *
 * @return mixed
 */
function noto_filter_post_theme_mod_noto_options( $theme_mod ) {
	// Get the already imported data.
	$pixcare_options = get_option( 'pixcare_options' );
	// This holds the ids of posts, pages, medias and everything was already imported.
	$imported_options = $pixcare_options['imported_starter_content'];

	// We need to replace the ignored profile photo with the imported attachment id.
	if ( isset( $imported_options['media']['ignored'][ $theme_mod['profile_photo'] ] ) ) {
		$theme_mod['profile_photo'] = $imported_options['media']['ignored'][ $theme_mod['profile_photo'] ];
	}

	return $theme_mod;
}
add_filter( 'pixcare_sce_import_post_theme_mod_noto_options', 'noto_filter_post_theme_mod_noto_options' );
add_filter( 'pixassist_sce_import_post_theme_mod_noto_options', 'noto_filter_post_theme_mod_noto_options' );
