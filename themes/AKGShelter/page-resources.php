<?php
/**
 * The template for displaying resources page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AKGShelter
 */

get_header();
?>

	<main id="primary" class="site-main">
	<!-- grid container for page contents -->
	<div class="grid-container">
		<div class="grid-x">
		<div class="large-5 small-12 contactForm">
		
		</div>
			<div class="large-7 small-12">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		</div><!--large-12 small-12-->
		</div><!--grid-x-->
	</div> <!--grid-container-->
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();