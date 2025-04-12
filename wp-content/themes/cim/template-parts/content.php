<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Industrial
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<span class="posted-on">
					<i class="far fa-calendar-alt"></i>
					<?php echo get_the_date(); ?>
				</span>
				<span class="posted-by">
					<i class="far fa-user"></i>
					<?php the_author(); ?>
				</span>
				<?php if ( has_category() ) : ?>
				<span class="post-categories">
					<i class="far fa-folder-open"></i>
					<?php the_category(', '); ?>
				</span>
				<?php endif; ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() && !is_singular() ) : ?>
	<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('large'); ?>
		</a>
	</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		if ( is_singular() ) :
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'industrial' ),
						array(
							'span' => array(
								'class' => array(),
							),
						),
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'industrial' ),
					'after'  => '</div>',
				)
			);
		else :
			the_excerpt();
			?>
			<a href="<?php the_permalink(); ?>" class="read-more-link"><?php esc_html_e('Read More', 'industrial'); ?> <i class="fas fa-arrow-right"></i></a>
		<?php
		endif;
		?>
	</div><!-- .entry-content -->

	<?php if ( is_singular() ) : ?>
	<footer class="entry-footer">
		<?php if ( has_tag() ) : ?>
		<div class="post-tags">
			<i class="fas fa-tags"></i>
			<?php the_tags('', ', '); ?>
		</div>
		<?php endif; ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->