<?php
/**
 * AKGShelter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AKGShelter
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'AKGShelter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function AKGShelter_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on AKGShelter, use a find and replace
		 * to change 'AKGShelter' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'AKGShelter', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'AKGShelter' ),
			)
		);
		// Add theme support for custom colours
		add_theme_support( 'editor-color-palette', array(
			array(
				'name' => esc_html__( 'Pink', 'AKGShelter' ),
				'slug' => 'pink',
				'color' => '#FF6B89',
			),
			array(
				'name' => esc_html__( 'Light Pink', 'AKGShelter' ),
				'slug' => 'lightpink',
				'color' => '#FCE7EB',
			),
			array(
				'name' => esc_html__( 'Cream', 'AKGShelter' ),
				'slug' => 'cream',
				'color' => '#FFFAE9',
			),
			array(
				'name' => esc_html__( 'Light Blue', 'AKGShelter' ),
				'slug' => 'lightblue',
				'color' => '#F3F9FF',
			),
			array(
				'name' => esc_html__( 'Blue', 'AKGShelter' ),
				'slug' => 'blue',
				'color' => '#B0C4DE',
			),
			array(
				'name' => esc_html__( 'White', 'AKGShelter' ),
				'slug' => 'white',
				'color' => '#FFFFFF',
			),
			array(
				'name' => esc_html__( 'Black', 'AKGShelter' ),
				'slug' => 'black',
				'color' => '#000000',
			),
		) );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'AKGShelter_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		/** 
		* Add support for align-wide
		*/
		add_theme_support( 'align-wide' );
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'AKGShelter_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function AKGShelter_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'AKGShelter_content_width', 640 );
}
add_action( 'after_setup_theme', 'AKGShelter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function AKGShelter_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'AKGShelter' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'AKGShelter' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'AKGShelter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function AKGShelter_scripts() {
	// AKGShelter styles.css
	wp_enqueue_style( 'AKGShelter-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'AKGShelter-style', 'rtl', 'replace' );
	// enqueue foundation styles
	wp_enqueue_style('AKGShelter-foundation',get_template_directory_uri() . '/assets/css/vendors/foundation.min.css', null, '6.5.1');
	wp_enqueue_style('AKGShelter-foundationStyles',get_template_directory_uri() . '/assets/css/app.css',  array());
	// underscores navigation script
	wp_enqueue_script( 'AKGShelter-navigation', get_template_directory_uri() . '/assets/js/vendor/navigation.js', array(), _S_VERSION, true );
	// AKGShelter block-editor script
	// wp_enqueue_script( 'AKGShelter-block-editor', get_template_directory_uri() . '/assets/js/block-editor.js', array(), _S_VERSION, true );
	// AKGShelter script
	wp_enqueue_script( 'AKGShelter-script', get_template_directory_uri() . '/assets/js/AKGScript.js', array(), _S_VERSION, true );
	// AKGShelter custom stylesheet
	wp_enqueue_style('AKGShelter-styles',get_template_directory_uri() . '/assets/css/AKGShelter-styles.css',  array());
	// AKGShelter custom stylesheet
	wp_enqueue_style('AKGShelter-styleZ',get_template_directory_uri() . '/assets/css/styleZ.css',  array());
// adding AKGShelter foundation js
wp_enqueue_script( 'AKGShelter-foundation', get_template_directory_uri() . '/assets/js/vendors/foundation.min.js', array('jquery', 'AKGShelter-what-input'), '6.5.1', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'AKGShelter_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-hooks.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Block Editor additions.
 */
require get_template_directory() . '/inc/block-editor.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

