<?php
/**
 * Get Outdoors functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Get_Outdoors
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function get_outdoors_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Get Outdoors, use a find and replace
		* to change 'get-outdoors' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'get-outdoors', get_template_directory() . '/languages' );

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

	add_image_size( 'event-archive-img', 300, 200, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'get-outdoors' ),
			'footer-1' => esc_html__( 'Footer Social Media', 'get-outdoors' ),
			'footer-2' => esc_html__( 'Footer Misc. Links', 'get-outdoors' )
		)
	);

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
			'get_outdoors_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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
add_action( 'after_setup_theme', 'get_outdoors_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function get_outdoors_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'get_outdoors_content_width', 640 );
}
add_action( 'after_setup_theme', 'get_outdoors_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function get_outdoors_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'get-outdoors' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'get-outdoors' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'get_outdoors_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function get_outdoors_scripts() {
	wp_enqueue_style( 'get-outdoors-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'get-outdoors-style', 'rtl', 'replace' );

	wp_enqueue_script( 'get-outdoors-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'get_outdoors_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Remove block editor from pages (company history page)
 */
function get_outdoors_post_filter( $use_block_editor, $post) {
	$page_ids = array(78);
	if ( in_array( $post->ID, $page_ids ) ) {
		return false; 
	} else { 
		return $use_block_editor;
	}
}
add_filter( 'use_block_editor_for_post', 'get_outdoors_post_filter', 10, 2);

// Add support for shortcodes in PHP
add_filter( 'widget_text', 'do_shortcode' );

// Load Google Map API
function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyDnzRQv_Wyc7fULo-941w0PKG7GEaC97vw';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

//Enqueue the Google Maps script from the Google Server
wp_enqueue_script( 'google-map',
'https://maps.googleapis.com/maps/api/js?key=AIzaSyDnzRQv_Wyc7fULo-941w0PKG7GEaC97vw',
array(),
_S_VERSION,
true );

// Enqueue ACF helper code to display the Google Map
wp_enqueue_script( 'google-map-init', get_template_directory_uri() .
'/js/google-map-script.js', array( 'google-map', 'jquery' ), _S_VERSION,
true );
