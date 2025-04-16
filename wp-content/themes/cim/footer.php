<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Industrial
 */

?>

</div><!-- #content -->
<?php // This closes the main content div, ensure it exists in your header.php or relevant template ?>

<?php // Remove the original site-footer block ?>
<?php /*
<footer id="colophon" class="site-footer">
// ... Original footer content removed ...
</footer><!-- #colophon -->
*/ ?>

<!-- Fixed Footer Based on Screenshot -->
<div class="footer-fixed-bottom"> <?php // Renamed class for clarity ?>
	<div class="container footer-fixed-container"> <?php // Use a container for centering/width ?>

		<div class="footer-fixed-left">
			<?php
			$custom_logo_id = get_theme_mod('custom_logo');
			if ($custom_logo_id):
				$logo_data = wp_get_attachment_image_src($custom_logo_id, 'full');
				$logo_url = $logo_data[0];
				// Note: You might want a smaller version of the logo for the footer.
				// e.g., $logo_data = wp_get_attachment_image_src( $custom_logo_id , 'thumbnail' );
				?>
				<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
					<img src="<?php echo esc_url($logo_url); ?>"
						alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="footer-fixed-logo">
				</a>
			<?php endif; ?>
			<div class="footer-fixed-company-name">
				<?php // Use site name or a custom theme option if available ?>
			</div>
		</div>

		<div class="footer-fixed-social">
			<?php $facebook = get_theme_mod('cim_facebook_url', '');
			if ($facebook): ?>
				<a href="<?php echo esc_url($facebook); ?>" target="_blank"
					aria-label="<?php esc_attr_e('Facebook', 'CIM'); ?>"><i class="fab fa-facebook-f"></i></a>
			<?php endif; ?>
			<?php $twitter = get_theme_mod('cim_twitter_url', '');
			if ($twitter): ?>
				<a href="<?php echo esc_url($twitter); ?>" target="_blank"
					aria-label="<?php esc_attr_e('Twitter', 'CIM'); ?>"><i class="fab fa-twitter"></i></a>
			<?php endif; ?>
			<?php $instagram = get_theme_mod('cim_instagram_url', '');
			if ($instagram): ?>
				<a href="<?php echo esc_url($instagram); ?>" target="_blank"
					aria-label="<?php esc_attr_e('Instagram', 'CIM'); ?>"><i class="fab fa-instagram"></i></a>
			<?php endif; ?>
			<?php $linkedin = get_theme_mod('cim_linkedin_url', '');
			if ($linkedin): ?>
				<a href="<?php echo esc_url($linkedin); ?>" target="_blank"
					aria-label="<?php esc_attr_e('LinkedIn', 'CIM'); ?>"><i class="fab fa-linkedin-in"></i></a>
			<?php endif; ?>
			<?php $youtube = get_theme_mod('cim_youtube_url', '');
			if ($youtube): ?>
				<a href="<?php echo esc_url($youtube); ?>" target="_blank"
					aria-label="<?php esc_attr_e('YouTube', 'CIM'); ?>"><i class="fab fa-youtube"></i></a>
			<?php endif; ?>
		</div>

		<div class="footer-fixed-right">
			<div class="footer-fixed-categories">
				<?php // Hardcoded based on screenshot, consider making these dynamic/linked ?>
				<span>MINING</span>
				<span class="category-separator">|</span>
				<span>ENERGY</span>
				<span class="category-separator">|</span>
				<span>CONSTRUCTION</span>
			</div>
			<div class="footer-fixed-contact">
				<?php // Hardcoded based on screenshot, consider theme options ?>
				<a href="mailto:sales@innovativematerials.com.au">sales@innovativematerials.com.au</a>
				<a href="http://innovativematerials.com.au/" target="_blank" rel="noopener noreferrer">http://innovativematerials.com.au/</a>
			</div>
		</div>

	</div><!-- .container -->
</div><!-- .footer-fixed-bottom -->

</div><!-- #page --> <?php // This closes the main page wrapper, ensure it exists in your header.php ?>

<?php wp_footer(); ?>

</body>

</html>