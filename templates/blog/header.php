<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * This template part can be overridden by copying it to a child theme or in the same theme
 * by putting it in the root `/header.php` or in `/templates/blog/header.php`.
 * @see pixelgrade_locate_component_template()
 *
 * HOWEVER, on occasion Pixelgrade will need to update template files and you
 * will need to copy the new files to your child theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://pixelgrade.com
 * @author     Pixelgrade
 * @package    Components/Blog
 * @version    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php pixelgrade_body_attributes(); ?>>

<?php
/**
 * pixelgrade_after_body_open hook.
 *
 * @hooked nothing() - 10 (outputs nothings)
 */
do_action( 'pixelgrade_after_body_open', 'main' );
?>

<?php
/**
 * pixelgrade_before_barba_wrapper hook.
 *
 * @hooked nothing() - 10 (outputs nothing)
 */
do_action( 'pixelgrade_before_barba_wrapper', 'main' );
?>

<div id="barba-wrapper" class="site u-wrap-text u-header-height-padding-top u-border-width">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '__components_txtd' ); ?></a>

    <div id="content" class="site-content barba-container">

        <div class="c-noto c-noto--header">
			<?php
			/**
			 * pixelgrade_before_header hook.
			 *
			 * @hooked nothing() - 10 (outputs nothing)
			 */
			do_action( 'pixelgrade_before_header', 'main' );
			?>

			<?php
			/**
			 * pixelgrade_header hook.
			 *
			 * @hooked pixelgrade_the_header() - 10 (outputs the header markup)
			 */
			do_action( 'pixelgrade_header', 'main' );
			?>

			<?php
			/**
			 * pixelgrade_after_header hook.
			 *
			 * @hooked nothing() - 10 (outputs nothing)
			 */
			do_action( 'pixelgrade_after_header', 'main' );
			?>
        </div>

        <div class="c-noto c-noto--body">
        	<div class="widget widget_text widget--content widget_custom_html small post-it">
				<h2 class="widget__title h6">Salut</h2>
				<div class="textwidget">
					<p>Welcome to my blog! Check out the <a href="#">latest post</a>, browse the highlights or <a href="#">reach me</a> to say Hi!</p>
				</div>
			</div>

			<div class="widget widget_text widget--content widget_custom_html small">
				<h2 class="widget__title h6">Widget Title</h2>
				<div class="textwidget">
					<p>The Text Widget allows you to add text to your sidebar. It’s the most popular widget because of its power and flexibility — use one to display text, links, images, or any combination.</p>
					<p class="small">
						Put simply, smaller text will usually be read after smaller text. Small columns of text are easier to read than large ones.
					</p>
					<a href="#" class="button">Button</a>
				</div>
			</div>

			<div class="widget widget_text widget--content widget_custom_html">
				<h2 class="widget__title h6">Widget Title</h2>
				<div class="textwidget">
					<p>The Text Widget allows you to add text to your sidebar. It’s the most popular widget because of its power and flexibility — use one to display text, links, images, or any combination.</p>
					<p class="small">
						Put simply, smaller text will usually be read after smaller text. Small columns of text are easier to read than large ones.
					</p>
					<a href="#" class="button">Button</a>
				</div>
			</div>
	        <?php
	        $zones = pixelgrade_header_get_zones();
	        unset( $zones['left'] );

	        // Cycle through each zone and display the nav menus or other "bogus" things.
	        foreach ( $zones as $zone_id => $zone ) {
		        // Get the menu_locations in the current zone.
		        $menu_locations = pixelgrade_header_get_zone_nav_menu_locations( $zone_id, $zone );

		        // First, if there are no menu locations to be displayed in the current zone,
		        // and if we are not supposed to show anything if the zone is blank,
		        // skip this zone.
		        if ( empty( $menu_locations ) && empty( $zone['display_blank'] ) ) {
			        continue;
		        }

		        // Second, go through each menu location and determine if there is an actual output.
		        // All this to determine if the zone is actually empty (blank) and we should not show anything if instructed so.

		        // Start the output buffering
		        ob_start();
		        if ( ! empty( $menu_locations ) ) {
			        foreach ( $menu_locations as $menu_id => $menu_location ) {
				        if ( ! empty( $menu_location['bogus'] ) ) {
					        // We have something special to show.
					        if ( 'header-branding' === $menu_id ) {
						        pixelgrade_get_component_template_part( Pixelgrade_Header::COMPONENT_SLUG, 'branding' );
					        } elseif ( 'jetpack-social-menu' === $menu_id && function_exists( 'jetpack_social_menu' ) ) {
						        jetpack_social_menu();
					        }
				        } else {
					        // We have a nav menu location that we need to show.
					        // Make sure we have some nav_menu args.
					        if ( empty( $menu_location['nav_menu_args'] ) ) {
						        $menu_location['nav_menu_args'] = array();
					        }

					        pixelgrade_header_the_nav_menu( $menu_location['nav_menu_args'], $menu_id );
				        }
			        }
		        }
		        // Get the output buffer and end it
		        $output = trim( ob_get_clean() );

		        if ( empty( $output ) && empty( $zone['display_blank'] ) ) {
			        continue;
		        }

		        /**
		         * Do note that you can make use of the fact that we've used the pixelgrade_css_class() function to
		         * output the classes for each zone. You can use the `pixelgrade_css_class` filter and, depending on
		         * the location received, act accordingly.
		         */
		        ?>

                <div <?php pixelgrade_css_class( $zone['classes'], array( 'header', 'navbar', 'zone', $zone_id ) ); ?>>
			        <?php echo $output; ?>
                </div><!-- .c-navbar__zone -->

	        <?php } ?>

			<?php
			/**
			 * pixelgrade_before_barba_container hook.
			 *
			 * @hooked nothing() - 10 (outputs nothing)
			 */
			do_action( 'pixelgrade_before_barba_container', 'main' );
			?>
