<?php
/**
 * Custom template tags for the PRO version of the theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Noto
 * @since 1.1.0
 */

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
				<svg width="10px" height="8px" viewBox="0 0 10 8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<g id="lines" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<path d="M7.3887012,1.3612988 L2.25,6.5" id="Line" stroke="<?php echo $color; ?>" stroke-width="2" stroke-linecap="square"></path>
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
			case "none": ?>
				<?php break;
			default: ?>
				<svg width="16px" height="8px" viewBox="0 0 16 8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<g id="wave" fill="none" stroke="<?php echo $color; ?>" stroke-width="2">
						<path d="M0,1 C1.99876282,1 3.33271475,2 4.00185576,4 C4.66852243,6.00073701 6.00185576,7.00110551 8.00185576,7.00110551 C10.0018558,7.00110551 11.3351891,6.00073701 12.0018558,4 C12.6685224,2 14.0018558,1 16.0018558,1"></path>
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
		}

		$svg = noto_get_pattern_svg( $color, $pattern );

		return 'url("data:image/svg+xml;utf8,' . rawurlencode(trim($svg)) . '");';
	}
}
