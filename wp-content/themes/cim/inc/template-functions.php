<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Industrial
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function industrial_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'industrial_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function industrial_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'industrial_pingback_header' );

/**
 * Customize excerpt length
 */
function industrial_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'industrial_custom_excerpt_length', 999 );

/**
 * Customize excerpt more
 */
function industrial_custom_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'industrial_custom_excerpt_more' );

/**
 * Add custom image sizes
 */
function industrial_custom_image_sizes() {
    add_image_size( 'industrial-featured', 1200, 600, true );
    add_image_size( 'industrial-product', 400, 300, true );
}
add_action( 'after_setup_theme', 'industrial_custom_image_sizes' );