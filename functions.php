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

	if ( is_front_page() ) {

		wp_enqueue_style(
			'swiper-styles',
			get_template_directory_uri() . '/swiper-bundle.css',
			array(),
			'8.1.4',
		);

		wp_enqueue_script(
			'swiper-scripts',
			get_template_directory_uri() . '/js/swiper-bundle.min.js',
			array(),
			'8.1.4',
			true,
		);

		wp_enqueue_script(
			'swiper-settings',
			get_template_directory_uri() . '/js/swiper-settings.js',
			array( 'swiper-scripts' ),
			_S_VERSION,
			true,
		);
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


// Enqueue Google Font
wp_enqueue_style(
	'go-google-fonts',
	'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap',array(),
	null,
	'all'
);

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


//display empty star rating
add_filter('woocommerce_product_get_rating_html',function ( $html, $rating, $count){
    $label = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
    $html  ='<div class="star-rating" role="img" aria-label="' . esc_attr( $label ) . '">' . wc_get_star_rating_html( $rating, $count ) . '</div>';
    return $html;
},9999,3);

//below is for remving some dashboard widgets
function remove_dashboard_widgets()
{ 
//first parameter -> slig/id of the widget
//second parameter -> where the meta box is displayed, it can be page, post, dashboard etc.
//third parameter -> position of the meta box. If you have used wp_add_dashboard_widget to create the widget or deleting default widget then provide the value "normal". 
remove_meta_box('wc_admin_dashboard_setup', 'dashboard', "normal");
remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
remove_meta_box('dashboard_activity', 'dashboard', 'normal');
remove_meta_box('wc_newsletter_subscription_stats', 'dashboard', 'normal');
remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
remove_meta_box('dashboard_primary', 'dashboard', 'side');
remove_meta_box('aioseo-overview', 'dashboard', 'normal');
remove_meta_box('aioseo-seo-setup', 'dashboard', 'normal');
remove_meta_box('wpforms_reports_widget_lite', 'dashboard', 'normal');
remove_meta_box('tribe_dashboard_widget', 'dashboard', 'side');
remove_meta_box('dashboard_right_now', 'dashboard', 'side');
remove_meta_box('jetpack_summary_widget', 'dashboard', 'column3');
remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'column3');
}
add_action("wp_dashboard_setup", "remove_dashboard_widgets");

//below is for deleting Post button in dashboard menu
add_action( 'admin_init', 'custom_remove_menu_pages' );
function custom_remove_menu_pages() {
remove_menu_page('edit.php');
}

//below is for reordering dashboard menu
function wpse_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
		return array(
			'index.php', // Dashboard
			'jetpack',//Jetpack
			'separator1', // First separator
			'edit.php', // Posts
			'upload.php', // Media
			'link-manager.php', // Links
			'edit.php?post_type=tribe_events',
			'wpcf7',//Contact Form 7
			'cr-reviews',
			'edit.php?post_type=acf-field-group',//ACF
			'edit-comments.php', // Comments
			'edit.php?post_type=page', // Pages

			'separator2', // Second separator
			'woocommerce',//Woocommerce
			'edit.php?post_type=product',
			'themes.php', // Appearance
			'plugins.php', // Plugins
			'maxmegamenu',
			'users.php', // Users
			'tools.php', // Tools
			'options-general.php', // Settings
			'separator-last', // Last separator
		);
	}
	add_filter( 'custom_menu_order', 'wpse_custom_menu_order', 10, 1 );
	add_filter( 'menu_order', 'wpse_custom_menu_order', 10, 1 );

//below is for wordpress login page styles
function wpb_login_logo() { ?>
	<style type="text/css">
	#login h1 a, .login h1 a { 
	background-image: url(http://getoutdoors.bcitwebdeveloper.ca/wp-content/uploads/2022/07/cropped-cropped-Liceria-Camp-and-Outdoor-Vintage-Logo.png);
	height:150px;
	width:150px;
	background-size: 150px 150px;
	background-repeat: no-repeat;
	padding-bottom: 10px;
	 
	}
	</style>
<?php }

add_action( 'login_enqueue_scripts', 'wpb_login_logo' );
function my_login_logo_url() {
	return home_url();
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );
	function my_login_logo_url_title() {
	return 'Your Site Name to Here';
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );
function my_login_stylesheet() {
	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

//below is for turning off content editor for
//Company History,Contact,Homepage, Shop pages
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;
  if($post_id == 78 || $post_id == 14 || $post_id == 88 || $post_id == 20){
    remove_post_type_support('page', 'editor');
  }
}

//below is for editting block editor styles
add_editor_style('editor-styles.css');
add_theme_support( 'editor-styles' );

//below is for adding clients tutorial to dashboard widgets
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
function custom_dashboard_help() {
	echo '<p>Welcome to Custom Blog Theme! Need help? Contact the developer <a href="mailto:yourusername@gmail.com">here</a>. For WordPress Tutorials visit: <a href="https://www.youtube.com/watch?v=VnjeR-bsRM4" target="_blank">WPBeginner</a>. For how to use ACF, please visit <a href="https://www.youtube.com/watch?v=cUtY_07Q4T0">here</a>. For how to use Woocommerce, please visit <a href="https://www.youtube.com/watch?v=oTr--KR4qoM">here</a>. For reference document, please click <a href="http://getoutdoors.bcitwebdeveloper.ca/wp-content/uploads/2022/07/clienttutorial.pdf">here</a>.</p>';
}
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
	