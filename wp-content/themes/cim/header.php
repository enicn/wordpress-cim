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
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'industrial' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container header-container">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$industrial_description = get_bloginfo( 'description', 'display' );
				if ( $industrial_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $industrial_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'menu'           => 'Default',
						'walker'         => new CIM_Menu_Walker(),
					)
				);
				?>
			</nav><!-- #site-navigation -->
			
			<div class="social-links">
				<a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
				<a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
				<a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
				<a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
			</div>
		</div>
	</header><!-- #masthead -->