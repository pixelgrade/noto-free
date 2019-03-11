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
		'welcome_content'       => esc_html__( 'Noto is a free notebook inspired blogging theme, designed for your creative ambitions. From the variety of colors, the use of subtle motion effects and visual cues, this is the perfect solution to explore the rhythm and dynamics of your text‐based content.', '__theme_txtd' ),
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
			'pro_theme_link'      => 'https://pixelgrade.com/themes/blogging/noto-pro/?utm_source=noto-lite-clients&utm_medium=about-page&utm_campaign=noto-lite',
			/* translators: View link */
			'get_pro_theme_label' => sprintf( esc_html__( 'Get %s', '__theme_txtd' ), 'Noto Pro' ),
			'features'            => array(
				array(
					'title'       => esc_html__( 'Notebook Design to Impress Your Readers', '__theme_txtd' ),
					'description' => esc_html__( 'Noto breaks the classic grid construction and offers an engaging dynamic for readers. The inspiration from the notebooks\' world creates momentum and provides a unique look-and-feel so that your stories receive the best showcase experience.', '__theme_txtd' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Mobile-Ready For All Devices', '__theme_txtd' ),
					'description' => esc_html__( 'Noto makes room for your readers to enjoy your articles on the go, no matter the device they are using. We shaped everything to look stunning to your audience without harming the overall feeling of your content. This way, people have the chance to connect in-depth with your stories.', '__theme_txtd' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Featured Images on Hover', '__theme_txtd' ),
					'description' => esc_html__( 'With the use of a subtle fade-in and some motion effects, this is the perfect solution to let your audience explore the feeling around your text‐based content and immerse them to stay longer on your website.', '__theme_txtd' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Widgetized Footer', '__theme_txtd' ),
					'description' => esc_html__( 'Keep your audience engaged by adding widgets in the footer that will follow them around the website. Push a newsletter subscribe box, your Instagram feed, contact info or anything else that supports your ambitions. The sky’s the limit.', '__theme_txtd' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Social Sharing Features To Boost Traffic', '__theme_txtd' ),
					'description' => esc_html__( 'Noto PRO comes with a subtle approach to increasing engagement by displaying social sharing buttons on the left side of your content and just below it. This way, you give people a handy option to spread the word about your content, without having to rely on third-party options that don’t keep the same design approach.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Extra Flexibility for the Below Post Area', '__theme_txtd' ),
					'description' => esc_html__( 'Noto PRO unlocks a new widget area, allowing you to place your favorite widgets right below your posts for extra exposure. At the same time, you can add related posts, an author info box, and a previous/next article section to allow people to easily browse your content.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Post-it Note Area to Welcome Visitors', '__theme_txtd' ),
					'description' => esc_html__( 'We went a step further into the note-taking feel of Noto PRO by creating a post-it note style area on your homepage. You can use it to introduce yourself and invite your visitors to learn more about who you are or what kind of creative work you are providing.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Front-Page Widget Area', '__theme_txtd' ),
					'description' => esc_html__( 'Go a step further and add custom widgets on your Home Page that will be sprinkled between your blog articles. This will help you maintain interest and provide extra exposure to what’s important.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'More Customization Options', '__theme_txtd' ),
					'description' => esc_html__( 'Noto PRO allows you to personalize your website even further. You can add a pattern style design below your blog titles, change the shape and color of the buttons, and transform the first paragraphs into a beautifully designed intro.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Additional Menu Options and Locations', '__theme_txtd' ),
					'description' => esc_html__( 'Using Noto PRO means that you can use submenus and benefit from two additional menu locations: below your main menu and in the footer. Let people know where to follow you on social media by adding a social menu with custom icons for each network.','__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Flexible Color Scheme with Style Manager', '__theme_txtd' ),
					'description' => esc_html__( 'Showcase your unique style in an easy and smart way by using an intuitive interface that allows you to change color palettes and fonts with a few clicks until they fully represent you and match your particular needs.','__theme_txtd' ),
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
					'description' => esc_html__( 'Behind every single support ticket stands a real person who gives the best to help you in due time. This way, you save energy and time and focus on what brings you happiness. We know our products inside-out and we can lend a hand to help you save resources of all kinds.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'Friendly Self-Help', '__theme_txtd' ),
					'description' => esc_html__( 'We give you full access to an in-depth documentation to get the job done as quickly as possible. We don\'t stay in your way by offering you full access to our self-help tool directly from your Dashboard.', '__theme_txtd' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
				),
				array(
					'title'       => esc_html__( 'No Credit Footer Link', '__theme_txtd' ),
					'description' => esc_html__( 'You can easily remove the “Theme: Noto by Pixelgrade” copyright from the footer area and make the theme yours from start to finish.', '__theme_txtd' ),
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
