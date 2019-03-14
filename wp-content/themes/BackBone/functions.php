<?php
//
// BackBone functions and definitions
// @link https://developer.wordpress.org/themes/basics/theme-functions/
//
if ( ! function_exists( 'backbone_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function backbone_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on BackBone, use a find and replace
		 * to change 'backbone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'backbone', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary', 'backbone' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'backbone_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'backbone_setup' );


//
// Register widget area.
// @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
//
function backbone_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'backbone' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'backbone' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'backbone_widgets_init' );


//
// Enqueue scripts and styles.
//
function backbone_scripts() {
	wp_enqueue_style( 'backbone-style', get_stylesheet_uri() );
	wp_enqueue_script( 'backbone-script', get_template_directory_uri() . '/backbone.js', array(), '11071988', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'backbone_scripts' );


//
// Bootstrap Navigation
//
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';


//
// Implement the Custom Header feature.
//
require get_template_directory() . '/inc/custom-header.php';


//
// Customizer additions.
//
require get_template_directory() . '/inc/customizer.php';


//
// Load Jetpack compatibility file.
//
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


//
// Functions which enhance the theme by hooking into WordPress.
//
require get_template_directory() . '/inc/theme-functions.php';