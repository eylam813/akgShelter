<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AKGShelter
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<div class="large-9">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
	<div class="large-3">
	<?php echo do_shortcode('[thermometer raised=10 target=100]') ?>
	</div>
</aside><!-- #secondary -->
