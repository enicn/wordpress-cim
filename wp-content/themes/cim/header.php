<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Industrial
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'industrial'); ?></a>

		<header id="masthead" class="site-header">
			<div class="container header-container">
				<div class="site-branding">
					<?php
					the_custom_logo();
					?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id' => 'primary-menu',
							'container' => false,
							'menu' => 'Default',
							'walker' => new CIM_Menu_Walker(),
						)
					);
					?>
				</nav><!-- #site-navigation -->

				<div class="social-links">
					<a href="<?php echo esc_url(get_theme_mod('cim_facebook_url', '#')); ?>" target="_blank"
						aria-label="<?php esc_attr_e('Facebook', 'CIM'); ?>"><i class="fab fa-facebook-f"></i></a>
					<a href="<?php echo esc_url(get_theme_mod('cim_twitter_url', '#')); ?>" target="_blank"
						aria-label="<?php esc_attr_e('Twitter', 'CIM'); ?>"><i class="fab fa-twitter"></i></a>
					<?php // Assuming X icon is for twitter ?>
					<a href="<?php echo esc_url(get_theme_mod('cim_instagram_url', '#')); ?>" target="_blank"
						aria-label="<?php esc_attr_e('Instagram', 'CIM'); ?>"><i class="fab fa-instagram"></i></a>
					<a href="<?php echo esc_url(get_theme_mod('cim_linkedin_url', '#')); ?>" target="_blank"
						aria-label="<?php esc_attr_e('LinkedIn', 'CIM'); ?>"><i class="fab fa-linkedin-in"></i></a>
					<a href="<?php echo esc_url(get_theme_mod('cim_youtube_url', '#')); ?>" target="_blank"
						aria-label="<?php esc_attr_e('YouTube', 'CIM'); ?>"><i class="fab fa-youtube"></i></a>
				</div>
			</div>
		</header><!-- #masthead -->