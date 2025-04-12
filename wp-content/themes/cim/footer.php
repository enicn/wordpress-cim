<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Industrial
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container footer-container">
			<div class="footer-column">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php else : ?>
					<h3 class="footer-title"><?php echo esc_html( get_theme_mod( 'industrial_about_title', __( 'About Us', 'industrial' ) ) ); ?></h3>
					<p><?php echo wp_kses_post( get_theme_mod( 'industrial_about_text', __( 'Industrial is a modern WordPress theme designed for manufacturing, engineering, and industrial businesses. Our focus is on providing innovative solutions for the industrial sector.', 'industrial' ) ) ); ?></p>
				<?php endif; ?>
			</div>
			
			<div class="footer-column">
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php else : ?>
					<h3 class="footer-title"><?php esc_html_e( 'Quick Links', 'industrial' ); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'menu'           => 'Default',
							'menu_class'     => 'footer-menu',
							'container'      => false,
							'fallback_cb'    => false,
							'depth'          => 1,
						)
					);
					?>
				<?php endif; ?>
			</div>
			
			<div class="footer-column">
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-3' ); ?>
				<?php else : ?>
					<h3 class="footer-title"><?php esc_html_e( 'Contact Info', 'industrial' ); ?></h3>
					<div class="footer-contact-item">
						<i class="fas fa-map-marker-alt contact-icon"></i>
						<div><?php echo esc_html( get_theme_mod( 'industrial_contact_address', __( '123 Industrial Avenue, Manufacturing District, City, Country', 'industrial' ) ) ); ?></div>
					</div>
					<div class="footer-contact-item">
						<i class="fas fa-phone-alt contact-icon"></i>
						<div><?php echo esc_html( get_theme_mod( 'industrial_contact_phone', __( '+1 234 567 8900', 'industrial' ) ) ); ?></div>
					</div>
					<div class="footer-contact-item">
						<i class="fas fa-envelope contact-icon"></i>
						<div><?php echo esc_html( get_theme_mod( 'industrial_contact_email', __( 'info@industrial-theme.com', 'industrial' ) ) ); ?></div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<?php
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				if ( has_custom_logo() ) :
					echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" class="footer-logo">';
				else :
					echo '<h3>' . get_bloginfo('name') . '</h3>';
				endif;
				?>
				
				<div class="footer-social">
					<a href="<?php echo esc_url( get_theme_mod( 'industrial_facebook_url', '#' ) ); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
					<a href="<?php echo esc_url( get_theme_mod( 'industrial_twitter_url', '#' ) ); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
					<a href="<?php echo esc_url( get_theme_mod( 'industrial_linkedin_url', '#' ) ); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
					<a href="<?php echo esc_url( get_theme_mod( 'industrial_youtube_url', '#' ) ); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
				</div>
				
				<div class="copyright">
					<?php
					/* translators: %s: Current year and site name */
					printf( esc_html__( '© %s %s. All Rights Reserved.', 'industrial' ), date_i18n( 'Y' ), get_bloginfo( 'name' ) );
					?>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->

	<!-- Fixed Footer Navigation -->
	<div class="footer-fixed-nav">
		<div class="container footer-nav-container">
			<div class="footer-nav-left">
				<?php
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				if ( has_custom_logo() ) :
					echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" class="footer-nav-logo">';
				endif;
				?>
				<div class="footer-nav-info">
					<a href="mailto:sales@canadiancim.com">sales@canadiancim.com</a>
					<a href="http://canadiancim.com/">http://canadiancim.com/</a>
				</div>
			</div>
			
			<div class="footer-nav-categories">
				<a href="#" class="footer-nav-category">MINING</a>
				<span class="category-separator">|</span>
				<a href="#" class="footer-nav-category">ENERGY</a>
				<span class="category-separator">|</span>
				<a href="#" class="footer-nav-category">CONSTRUCTION</a>
			</div>
			
			<div class="footer-nav-social">
				<a href="<?php echo esc_url( get_theme_mod( 'industrial_facebook_url', '#' ) ); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
				<a href="<?php echo esc_url( get_theme_mod( 'industrial_twitter_url', '#' ) ); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
				<a href="<?php echo esc_url( get_theme_mod( 'industrial_instagram_url', '#' ) ); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
				<a href="<?php echo esc_url( get_theme_mod( 'industrial_linkedin_url', '#' ) ); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
				<a href="<?php echo esc_url( get_theme_mod( 'industrial_youtube_url', '#' ) ); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
			</div>
		</div>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>