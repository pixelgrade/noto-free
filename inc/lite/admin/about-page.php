<?php
/**
 * Noto (Free) Theme About Page logic.
 *
 * @package Noto Free
 */

function noto_lite_admin_setup() {
	/**
	 * Load the About page class
	 */
	// phpcs:ignore
	// @codingStandardsIgnoreLine
	require_once 'ti-about-page/class-ti-about-page.php';

	/*
	* About page instance
	*/
	$config = array(
		// Menu name under Appearance.
		'menu_name'               => esc_html__( 'About Noto', '__theme_txtd' ),
		// Page title.
		'page_name'               => esc_html__( 'About Noto', '__theme_txtd' ),
		/* translators: Main welcome title */
		'welcome_title'         => sprintf( esc_html__( 'Welcome to %s! - Version ', '__theme_txtd' ), 'Noto' ),
		// Main welcome content
		'welcome_content'       => esc_html__( ' Noto is a free travel blog theme to help you increase your revenue streams and see more of the world. With big and beautiful imagery and a smart widget system for next-level customizations, you have all the right tools to express your personality and nurture a loyal audience around your fascinating stories.', '__theme_txtd' ),
		/**
		 * Tabs array.
		 *
		 * The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
		 * the will be the name of the function which will be used to render the tab content.
		 */
		'tabs'                    => array(
			'getting_started'  => esc_html__( 'Getting Started', '__theme_txtd' ),
			'recommended_actions' => esc_html__( 'Recommended Actions', '__theme_txtd' ),
			'recommended_plugins' => esc_html__( 'Useful Plugins','__theme_txtd' ),
			'support'       => esc_html__( 'Support', '__theme_txtd' ),
			'changelog'        => esc_html__( 'Changelog', '__theme_txtd' ),
			'free_pro'         => esc_html__( 'Free VS PRO', '__theme_txtd' ),
		),
		// Support content tab.
		'support_content'      => array(
			'first' => array (
				'title' => esc_html__( 'Contact Support','__theme_txtd' ),
				'icon' => 'dashicons dashicons-sos',
				'text' => wp_kses( __( 'We want to make sure you have the best experience using Noto. If you <strong>do not have a paid upgrade</strong>, please post your question in our community forums.', '__theme_txtd' ), wp_kses_allowed_html() ),
				'button_label' => esc_html__( 'Contact Support','__theme_txtd' ),
				'button_link' => esc_url( 'https://wordpress.org/support/theme/vasco' ),
				'is_button' => true,
				'is_new_tab' => true
			),
			'second' => array(
				'title' => esc_html__( 'Documentation','__theme_txtd' ),
				'icon' => 'dashicons dashicons-book-alt',
				'text' => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use Noto.','__theme_txtd' ),
				'button_label' => esc_html__( 'Read The Documentation','__theme_txtd' ),
				'button_link' => 'https://pixelgrade.com/vasco-documentation/',
				'is_button' => false,
				'is_new_tab' => true
			)
		),
		// Getting started tab
		'getting_started' => array(
			'first' => array(
				'title' => esc_html__( 'Go to Customizer','__theme_txtd' ),
				'text' => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.','__theme_txtd' ),
				'button_label' => esc_html__( 'Go to Customizer','__theme_txtd' ),
				'button_link' => esc_url( admin_url( 'customize.php' ) ),
				'is_button' => true,
				'recommended_actions' => false,
				'is_new_tab' => true
			),
			'second' => array (
				'title' => esc_html__( 'Recommended actions','__theme_txtd' ),
				'text' => esc_html__( 'We have compiled a list of steps for you, to take make sure the experience you will have using one of our products is very easy to follow.','__theme_txtd' ),
				'button_label' => esc_html__( 'Recommended actions','__theme_txtd' ),
				'button_link' => esc_url( admin_url( 'themes.php?page=vasco-welcome&tab=recommended_actions' ) ),
				'button_ok_label' => esc_html__( 'You are good to go!','__theme_txtd' ),
				'is_button' => false,
				'recommended_actions' => true,
				'is_new_tab' => false
			),
			'third' => array(
				'title' => esc_html__( 'Read the documentation','__theme_txtd' ),
				'text' => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use Noto.','__theme_txtd' ),
				'button_label' => esc_html__( 'Documentation','__theme_txtd' ),
				'button_link' => 'https://pixelgrade.com/vasco-documentation/',
				'is_button' => false,
				'recommended_actions' => false,
				'is_new_tab' => true
			)
		),
		// Free vs pro array.
		'free_pro'                => array(
			'free_theme_name'     => 'Noto Free',
			'pro_theme_name'      => 'Noto PRO',
			'pro_theme_link'      => 'https://pixelgrade.com/themes/blogging/vasco-pro/?utm_source=vasco-lite-clients&utm_medium=about-page&utm_campaign=vasco-lite',
			/* translators: View link */
			'get_pro_theme_label' => sprintf( esc_html__( 'Get %s', '__theme_txtd' ), 'Noto Pro' ),
			'features'            => array(
				array(
					'title'       => esc_html__( 'Daring Design for Devoted Readers', '__theme_txtd' ),
					'description' => esc_html__( 'Noto\'s design focused on big and beautiful imagery helps you raise awareness and grab attention around your traveling stories. With a flexible home page, you have the chance to easily showcase your ideas.', '__theme_txtd' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Mobile-Ready For All Devices', '__theme_txtd' ),
					'description' => esc_html__( 'Noto makes room for your readers to enjoy your articles on the go, no matter the device they are using. We shaped everything to look amazing to your audience.', '__theme_txtd' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Widgetized Homepage To Keep Attention', '__theme_txtd' ),
					'description' => esc_html__( 'The widget-based flexible system allows you to add your favorite widgets all over the Front Page.', '__theme_txtd' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Location Widget to Connect with Your Local Community', '__theme_txtd' ),
					'description' => esc_html__( 'Share your whereabouts and connect with readers nearby with the help of our custom Location Widget.', '__theme_txtd' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'New Widgets for Extra Flexibility', '__theme_txtd' ),
					'description' => esc_html__( 'Noto PRO gives you extra ways to showcase your articles in great style. Besides the Grid Posts and Profile widgets, the PRO version comes with much more: Feature Card, Callout Box, Categories, and many others.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Advanced Widgets Options', '__theme_txtd' ),
					'description' => esc_html__( 'Noto\'s PRO version comes with more widget options to lay out and filter posts. For instance, you can have more control on setting the source of the posts (filtering by category, tags, etc.) or how they are displayed (e.g. Show Excerpt, Show Read More).', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Sidebar, Footer & Below Post Widget Areas', '__theme_txtd' ),
					'description' => esc_html__( 'Noto\'s PRO version unlocks more Widget Areas to be able to place your favorite widgets on the right side or below your posts and in the footer.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Reliable Support for All Kind of Ads', '__theme_txtd' ),
					'description' => esc_html__( 'Make money out of your website in various ways with the Promo Box widget. Use it to deliver quality ads to your audience, promote a special offer or anything else that helps you achieve your goals.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Customizable Stamp for a Unique Style', '__theme_txtd' ),
					'description' => esc_html__( 'Inspired by travelers lifestyle, you can level up your visual identity by auto-generating a stamp with custom text and a set of colorful shapes.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Sticky Menu, Announcement & Reading Progress Bar', '__theme_txtd' ),
					'description' => esc_html__( 'Keep the menu at the top of your page while you scroll, making it more accessible on whatever page you are navigating. On article pages, you will have a Progress Bar that switches to a link to the next article. The header area gets a boost with an Announcement Bar through which you can promote any link','__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Blobs for a Compelling Visual Brand Identity', '__theme_txtd' ),
					'description' => esc_html__( 'Our unique Blobs creating system allows you to give your website an one of a kind visual identity that your readers will recognize in a heartbeat.','__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Flexible Color Scheme with Style Manager', '__theme_txtd' ),
					'description' => esc_html__( 'Showcase your unique style in an easy and smart way by using an intuitive interface that allows you to change color palettes and fonts with a few clicks until they fully represent you and match your particular needs.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Advanced Typography Settings', '__theme_txtd' ),
					'description' => esc_html__( 'Adjust your fonts by taking advantage of a playground with 600+ fonts variety you can wisely choose from at any moment.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Premium Support and Assistance', '__theme_txtd' ),
					'description' => esc_html__( 'We offer ongoing customer support to help you get things done fast. This way, you save energy and time and focus on what brings you happiness. We know our products inside-out and we can lend a hand to help you save resources of all kinds.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Friendly Self-Service', '__theme_txtd' ),
					'description' => esc_html__( 'We give you full access to an in-depth documentation to get the job done as quickly as possible. We don\'t stay in your way by offering you full access to our self-help tool directly from your Dashboard.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'No Credit Footer Link', '__theme_txtd' ),
					'description' => esc_html__( 'You can easily remove the "Theme: Noto by Pixelgrade" copyright from the footer area and make the theme yours from start to finish.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				)
			),
		),
		// Plugins array.
		'recommended_plugins'        => array(
			'already_activated_message' => esc_html__( 'Already activated', '__theme_txtd' ),
			'version_label' => esc_html__( 'Version: ', '__theme_txtd' ),
			'install_label' => esc_html__( 'Install and Activate', '__theme_txtd' ),
			'activate_label' => esc_html__( 'Activate', '__theme_txtd' ),
			'deactivate_label' => esc_html__( 'Deactivate', '__theme_txtd' ),
			'content'                   => array(
				array(
					'slug' => 'jetpack'
				),
				array(
					'slug' => 'wordpress-seo'
				)
			),
		),
		// Required actions array.
		'recommended_actions'        => array(
			'install_label' => esc_html__( 'Install and Activate', '__theme_txtd' ),
			'activate_label' => esc_html__( 'Activate', '__theme_txtd' ),
			'deactivate_label' => esc_html__( 'Deactivate', '__theme_txtd' ),
			'content'            => array(
				// None right now.
			),
		),
	);
	Noto_Lite_About_Page::init( $config );
}
add_action( 'after_setup_theme', 'noto_lite_admin_setup' );
