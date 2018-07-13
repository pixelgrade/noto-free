<?php
/**
 * Custom template tags specific for this variation.
 *
 * Development notice: This file is synced from the variations directory! Do not edit in the `inc` directory!
 *
 * @package Noto
 * @since 1.0.0
 */

if ( ! function_exists( 'pixelgrade_has_profile_photo' ) ) {
	/**
	 * Determines whether the site has a profile photo.
	 *
	 * @param int $blog_id Optional. ID of the blog in question. Default is the ID of the current blog.
	 *
	 * @return bool Whether the site has a custom logo or not.
	 */
	function pixelgrade_has_profile_photo( $blog_id = 0 ) {
		$switched_blog = false;

		if ( is_multisite() && ! empty( $blog_id ) && (int) $blog_id !== get_current_blog_id() ) {
			switch_to_blog( $blog_id );
			$switched_blog = true;
		}

		$profile_photo_id = pixelgrade_option( 'profile_photo', false );

		if ( $switched_blog ) {
			restore_current_blog();
		}

		return (bool) $profile_photo_id;
	}
}

if ( ! function_exists( 'pixelgrade_get_profile_photo' ) ) {
	/**
	 * Returns a profile photo, linked to home.
	 *
	 * @param int $blog_id Optional. ID of the blog in question. Default is the ID of the current blog.
	 *
	 * @return string Custom logo markup.
	 */
	function pixelgrade_get_profile_photo( $blog_id = 0 ) {
		$html          = '';
		$switched_blog = false;

		if ( is_multisite() && ! empty( $blog_id ) && (int) $blog_id !== get_current_blog_id() ) {
			switch_to_blog( $blog_id );
			$switched_blog = true;
		}

		$profile_photo_id = pixelgrade_option( 'profile_photo', false );

		// We have a logo. Logo is go.
		if ( $profile_photo_id ) {
			$profile_photo_attr = array(
				'class'    => 'profile-photo',
				'itemprop' => 'logo',
			);

			/*
			 * If the logo alt attribute is empty, get the site title and explicitly
			 * pass it to the attributes used by wp_get_attachment_image().
			 */
			$image_alt = get_post_meta( $profile_photo_id, '_wp_attachment_image_alt', true );
			if ( empty( $image_alt ) ) {
				$profile_photo_attr['alt'] = get_bloginfo( 'name', 'display' );
			}

			/*
			 * If the alt attribute is not empty, there's no need to explicitly pass
			 * it because wp_get_attachment_image() already adds the alt attribute.
			 */
			$html = sprintf( '<a href="%1$s" class="profile-photo-link" rel="home" itemprop="url">%2$s</a>',
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image( $profile_photo_id, 'full', false, $profile_photo_attr )
			);
		} // If no logo is set but we're in the Customizer, leave a placeholder (needed for the live preview).
		elseif ( is_customize_preview() ) {
			$html = sprintf( '<a href="%1$s" class="profile-photo-link" style="display:none;"><img class="profile-photo"/></a>',
				esc_url( home_url( '/' ) )
			);
		}

		if ( $switched_blog ) {
			restore_current_blog();
		}

		/**
		 * Filters the profile photo output.
		 *
		 * @param string $html Profile photo HTML output.
		 * @param int $blog_id ID of the blog to get the profile photo for.
		 */
		return apply_filters( 'pixelgrade_get_profile_photo', $html, $blog_id );
	}
}

if ( ! function_exists( 'pixelgrade_the_profile_photo' ) ) {
	/**
	 * Displays a profile photo, linked to home.
	 *
	 * @param int $blog_id Optional. ID of the blog in question. Default is the ID of the current blog.
	 */
	function pixelgrade_the_profile_photo( $blog_id = 0 ) {
		echo pixelgrade_get_profile_photo( $blog_id );
	}
}