<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AKGShelter
 */

get_header();
?>

	<main id="primary" class="site-main">
	<!-- container for archive page -->
	<div class="grid-container">
		<div class="grid-x">
			<?php if ( have_posts() ) : ?>
				<div class="grid-x">
				<!-- .page-header -->
				<header class="cell large-12 medium-12 small-12">
					<h1 class="page-title screen-reader-text"><?php the_archive_title(); ?></h1>
					<hr class="blogHr">
				</header>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();?>
					<!-- container for archive posts -->
					<div class="cell card large-5 medium-5 small-10">
									<?php
									if (has_post_thumbnail()) {
									?>
										<!-- loading post thumbnail -->
										<div class="thumbnail-img">
											<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
										</div>
									<?php
									} ?>
									<!-- loading post post title and excerpt -->
									<div class="card-section">
										<h3><?php the_title(); ?> </h3>
										<p>
											<?php
											the_excerpt();
											?>
										</p>
										<!-- post link -->
										<a class="blogBtn" href="<?php echo get_post_permalink(); ?>">continue reading</a>
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
				?>
				</div><!--grid-x-->
				<?php
			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div> <!--grid-x -->
	</div> <!--grid-container -->
	</main><!-- #main -->

<?php
get_footer();
