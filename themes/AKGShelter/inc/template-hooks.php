<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package AKGShelter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function AKGShelter_body_classes( $classes ) {
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
add_filter( 'body_class', 'AKGShelter_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function AKGShelter_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'AKGShelter_pingback_header' );


/**
 * Load block editor JS
 */
function sample_theme_enqueue_block_editor_assets() {
    wp_enqueue_script(
        'block-editor-js',
		get_template_directory_uri() . '/assets/js/block-editor.js',
		array('wp-blocks', 'wp-dom-ready', 'wp-edit-post')
    );
}
add_action( 'enqueue_block_editor_assets', 'sample_theme_enqueue_block_editor_assets' );