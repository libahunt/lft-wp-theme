<?php
/**
 * ladyfest tln 15 functions and definitions
 *
 * @package ladyfest tln 15
 */



/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1180; /* pixels */
}

if ( ! function_exists( 'lft_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lft_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ladyfest tln 15, use a find and replace
	 * to change 'lft' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'lft', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

  add_image_size( 'lft-gallery-thumb', 588, 378, true ); // Hard Crop Mode
  add_image_size( 'lft-post-header', 1180, 350, true ); // Hard Crop Mode

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'lft' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lft_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // lft_setup
add_action( 'after_setup_theme', 'lft_setup' );



/*Special post types*/
function create_post_type() {
  register_post_type( 'lft_movie',
    array(
      'labels' => array(
        'name' => __( 'Kinoseansid' ),
        'singular_name' => __( 'Kinoseanss' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-video-alt',
      'supports' => array(
      	'title',
		'editor',
		'thumbnail'
      ),
    )
  );
  register_post_type( 'lft_workshop',
    array(
      'labels' => array(
        'name' => __( 'Töötoad' ),
        'singular_name' => __( 'Töötuba' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-hammer',
      'supports' => array(
      	'title',
		'editor',
		'thumbnail'
      ),
    )
  );
  register_post_type( 'lft_event',
    array(
      'labels' => array(
        'name' => __( 'Sündmused' ),
        'singular_name' => __( '' ),
        'name_admin_bar' => __( 'Sündmus' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-palmtree',
      'supports' => array(
      	'title',
		'editor',
		'thumbnail'
      ),
    )
  );
  register_post_type( 'lft_galleryitem',
    array(
      'labels' => array(
        'name' => __( 'Galerii pildid' ),
        'singular_name' => __( '' ),
        'name_admin_bar' => __( 'Galerii pilt' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-format-image',
      'supports' => array(
      	'title',
		'editor',
		'thumbnail'
      ),
    )
  );
  register_post_type( 'lft_archiveitem',
    array(
      'labels' => array(
        'name' => __( 'Arhiivi sündmused' ),
        'singular_name' => __( '' ),
        'name_admin_bar' => __( 'Arhiivi sündmus' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-lock',
      'supports' => array(
      	'title',
		'editor',
		'thumbnail'
      ),
    )
  );
  register_post_type( 'lft_sponsor',
    array(
      'labels' => array(
        'name' => __( 'Sponsorid' ),
        'singular_name' => __( 'Sponsor' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 6,
      'menu_icon' => 'dashicons-cart',
      'supports' => array(
        'title',
    'editor',
    'thumbnail'
      ),
    )
  );
}
add_action( 'init', 'create_post_type' );

// Make cutom post types show up on main list
/*function add_post_types_to_query( $query ) {
  if ( is_home() && $query->is_main_query() )
    $query->set( 'post_type', array( 'lft_movie', 'lft_workshop', 'lft_event' ) );
  return $query;
}
add_action( 'pre_get_posts', 'add_post_types_to_query' );*/


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function lft_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'lft' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'lft_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lft_scripts() {

	wp_register_script( 'bootstrap-js', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', array('jquery'), NULL, true );
    wp_register_style( 'bootstrap-css', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css', false, NULL, 'all' );
    wp_enqueue_script( 'bootstrap-js' );
    wp_enqueue_style( 'bootstrap-css' );

	wp_enqueue_style( 'lft-style', get_stylesheet_uri() );

	wp_enqueue_script( 'lft-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'lft-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

  wp_enqueue_script( 'lft', get_template_directory_uri() . '/js/lft.js', array(), '20160307', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lft_scripts' );

/**
 * Add custom version numbering to style.
 */
function version_wp_default_styles($styles)
{
  $styles->default_version = "20160307";
}
add_action("wp_default_styles", "version_wp_default_styles");


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


