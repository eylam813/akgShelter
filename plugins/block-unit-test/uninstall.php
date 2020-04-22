<?php
/**
 * Uninstall Block Unit Test.
 *
 * @package   Block Unit Test
 * @author    Rich Tabor
 * @license   GPL-3.0
 */

// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Load the main plugin file.
require_once 'class-block-unit-test.php';

// Pull the Block Unit Test page.
$title = apply_filters( 'block_unit_test_title', 'Block Unit Test ' );
$page  = get_page_by_title( $title, OBJECT, 'page' );

wp_trash_post( $page->ID );

// Clear any cached data that has been removed.
wp_cache_flush();
