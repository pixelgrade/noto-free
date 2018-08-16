<?php
/**
 * PixCare Starter Content Compatibility File.
 * Here we add all the actions and filters responsible for the import action.
 */

/**
 * Filter the import action while getting the `noto_options` option
 *
 * @param $option
 *
 * @return mixed
 */
function noto_filter_post_option_noto_options( $option ) {
	// get the imported data
	$pixcare_options = get_option( 'pixcare_options' );
	// this holds the ids of posts, pages, medias and everything was already imported
	$imported_options = $pixcare_options['imported_starter_content'];

	// We need to replace the both logos from the demo with the imported attachment id
	if ( isset( $imported_options['media']['ignored'][ $option['profile_photo'] ] ) ) {
		$option['profile_photo'] = $imported_options['media']['ignored'][ $option['profile_photo'] ];
	}

	// on demo this is an option, oldy stuff
	// but on the new installations will need this as a theme mod
	set_theme_mod('noto_options', $option );

	return $option;
}
add_filter( 'pixcare_sce_import_post_option_noto_options', 'noto_filter_post_option_noto_options' );
