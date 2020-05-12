<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AKGShelter
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'AKGShelter' ); ?></a>

	<header id="masthead" class="site-header">
		<div id="preheader">
			<div class="donateBtn-header">
				<a href="https://www.paypal.com/donate/?token=FQlpb637-ROyNNM1ekCbGx40JvVLWS-9Hj5nsx-u8JZj9nejlXQiLrHv6EsGNeciDO5hE0&country.x=CA&locale.x=CA"><button class="decoBtn">Donate</button></a>
			</div>
			<h6 class="helpText-header">Get help 24/7: 905-3522-3708 or Toll Free at 1-800-388-5171</h6>
			<div class="escapeBtns">
				<a href="https://www.pcmag.com/how-to/how-to-clear-your-cache-on-any-browser"><button class="clearTracks-header">Steps to Clear Tracks</button><a>
				<a href="http://testing.zferguson.ca/holycupcake/recipes/%3C?php%20echo%20$_SERVER[%22REQUEST_URI%22];%20?%3E"><button class="exitSite-header decoBtn">Exit Site</button></a>
			</div>
		</div>
		<section id="nav">
			<div class="site-branding">
				<!-- container for the logo - mobile/tablet only -->
				<div class="title-bar-title">
					<?php
					// if there's no custom logo load the title text
					if (!has_custom_logo()) :
					?>
						<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php
					else :
						// else if there is a custom logo load the logo
						the_custom_logo();
					endif;
					?>
				</div>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'AKGShelter' ); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</section>
	</header><!-- #masthead -->
