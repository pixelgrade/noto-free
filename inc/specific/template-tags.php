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
		} else {
			// If no profile picture is set, leave a placeholder (needed for the live preview).
			$url = esc_url( home_url( '/' ) );
			$classname = 'profile-photo-link--default';
			$label = '';

			if ( is_user_logged_in() ) {
				$url = esc_url( admin_url( '/customize.php?autofocus[section]=noto_options[general]' ) );
				$label = '<div class="profile-photo-link__label"><span>' . __( 'Add Profile Photo', '__theme_txtd' ) . '</span></div>';
				$classname .= '  profile-photo-link--admin';
			}

			ob_start();
			get_template_part( 'assets/images/profile-photo' );
			$image = ob_get_contents();
			ob_end_clean();

			$html = sprintf( '<a href="%1$s" class="profile-photo-link  '. $classname .'">' . $image . $label . '</a>', $url);
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

if ( ! function_exists( 'noto_get_pattern_svg' ) ) {

	function noto_get_pattern_svg( $color = 'currentColor', $pattern = 'wave' ) {
		ob_start();

		switch ( $pattern ) {
		    case "triangles": ?>
				<svg width="25px" height="8px" viewBox="0 0 25 8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			        <g id="triangle" stroke="none" stroke-width="1" fill="<?php echo $color; ?>" fill-rule="evenodd">
			            <polygon points="0 0 4.5 8 9 0"></polygon>
			        </g>
				</svg>
		        <?php break;
		    case "bubbles": ?>
			    <svg width="45px" height="10px" viewBox="0 0 45 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				    <g id="bubbles" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
		                <circle id="Oval" stroke="<?php echo $color; ?>" cx="3.5" cy="3.5" r="2.5"></circle>
		                <circle id="Oval" stroke="<?php echo $color; ?>" cx="18.5" cy="3.5" r="2.5"></circle>
		                <circle id="Oval" stroke="<?php echo $color; ?>" cx="33.5" cy="3.5" r="2.5"></circle>
				    </g>
				</svg>
		    <?php break;
		    case "lines": ?>
			    <svg width="50px" height="8px" viewBox="0 0 50 8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				    <g id="lines" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
		                <path d="M7.3887012,1.3612988 L2.25,6.5" id="Line" stroke="<?php echo $color; ?>" stroke-width="2" stroke-linecap="square"></path>
		                <path d="M17.3887012,1.3612988 L12.25,6.5" id="Line" stroke="<?php echo $color; ?>" stroke-width="2" stroke-linecap="square"></path>
		                <path d="M27.3887012,1.3612988 L22.25,6.5" id="Line" stroke="<?php echo $color; ?>" stroke-width="2" stroke-linecap="square"></path>
		                <path d="M37.3887012,1.3612988 L32.25,6.5" id="Line" stroke="<?php echo $color; ?>" stroke-width="2" stroke-linecap="square"></path>
		                <path d="M47.3887012,1.3612988 L42.25,6.5" id="Line" stroke="<?php echo $color; ?>" stroke-width="2" stroke-linecap="square"></path>
				    </g>
				</svg>
		    <?php break;
		    case "zigzag": ?>
			    <svg width="10px" height="7px" viewBox="0 0 10 7" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<g id="lines" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="square">
						<polyline id="Line" stroke="<?php echo $color; ?>" points="10 6 5.13870121 1 0 6"></polyline>
					</g>
				</svg>
		    <?php break;
		    default: ?>
			    <svg width="18px" height="8px" viewBox="0 0 18 8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			        <g id="wave" transform="translate(-12, 1)" fill="none" stroke="<?php echo $color; ?>" stroke-width="2">
			            <path d="M8,3 C8.66808837,5 10.0010521,6 11.9988911,6 C13.9967301,6 15.3304331,5 16,3"></path>
			            <path d="M16,0 C16.6680884,2 18.0010521,3 19.9988911,3 C21.9967301,3 23.3304331,2 24,0" transform="translate(20, 1.5) rotate(-180) translate(-20, -1.5) "></path>
			            <path d="M24,3 C24.6680884,5 26.0010521,6 27.9988911,6 C29.9967301,6 31.3304331,5 32,3"></path>
			            <path d="M0,0 C0.668088373,2 2.00105206,3 3.99889107,3 C5.99673007,3 7.33043305,2 8,0" transform="translate(4, 1.5) rotate(-180) translate(-4, -1.5) "></path>
			        </g>
				</svg>
		<?php }

		$svg = ob_get_clean();
		return $svg;
	}
}

if ( ! function_exists( 'noto_get_pattern_background_image' ) ) {

	function noto_get_pattern_background_image( $color = '', $pattern = 'wave' ) {
		$pattern = pixelgrade_option( 'pattern_style', 'wave' );

		if ( empty( $color ) ) {
			$color = pixelgrade_option( 'main_content_body_text_color', '#49494B' );
			if ( is_single() || is_admin() ) {
			    $color = pixelgrade_option( 'secondary_color', '#E79696' );
			}
		}

		$svg = noto_get_pattern_svg( $color, $pattern );
		$svg = base64_encode( $svg );

		return 'url("data:image/svg+xml;base64,' . $svg . '");';
	}
}