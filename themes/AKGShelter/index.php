<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AKGShelter
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
			?> <div class="blogHolder"> <?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post(); ?>
				<!-- container for archive posts -->
					<div class="grid-x card">
						<div class="card-image large-12 medium-12 small-12">
							<?php
							if (has_post_thumbnail()) {
							?>
								<!-- loading post thumbnail -->
								<div class="thumbnail-img" style="background-image:none;">
									<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
								</div>
							<?php
							}
							else {
								?>
								<div class="thumbnail-img" aria-label="<?php the_title() ?> Newletter"></div>
							<?php
							} 
							?>
						</div>
							<!-- loading post post title and excerpt -->
						<div class="card-section-wrapper large-9 medium-9 small-12">
							<div class="card-section">
								<?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
								<p>
									<?php
									the_excerpt();
									?>
								</p>
								<!-- post link -->
								<div class="blogBtnHolder">
									<a class="blogBtn" href="<?php echo get_post_permalink(); ?>">continue reading... </a>
								</div>
							</div>
						</div>
					</div>
					<?php




				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				// get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
