<?php

//Nav Menus
require_once('inc/custom_nav.php');

//Thumbnails
add_theme_support('post-thumbnails');

//Register Widgets Area
require_once ('inc/widgets.php');

//Breadcrumbs
require_once ('inc/breadcrumbs.php');

//Autometa
require_once('inc/autometa.php');

//Google Fonts
add_action( 'wp_enqueue_scripts', 'custom_google_fonts' );
function custom_google_fonts() {
wp_enqueue_style( 'custom-font', "//fonts.googleapis.com/css?family=Lato:400,300,100,500,700|Ubuntu:400,300,100,500,700");
}

//Register Nav Menus
        register_nav_menus( array(
    		'primary' => __( 'Primary Menu', 'Primary Menu' ),
) );

//Custom Excerpt -> Readmore...
function new_excerpt_more($more) {
    global $post;
    return ' <a class="moretag" href="'. get_permalink($post->ID) . '">Continue Reading...</a>'; //Change to suit your needs
}

add_filter( 'excerpt_more', 'new_excerpt_more' );

// Remove unused dashboard widgets
function ilusix_remove_dashboard_widgets() {
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    remove_meta_box( 'authordiv', 'page', 'None' );
    remove_meta_box( 'commentsdiv', 'page', 'None' );
    remove_meta_box( 'commentstatusdiv', 'page', 'None' );
    remove_meta_box( 'revisionsdiv', 'page', 'None' );
}
add_action( 'admin_init', 'ilusix_remove_dashboard_widgets' );


//Remove Logo WP
function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

//Hiding WP Version
function so_remove_version() {
	return '';
}
add_filter('the_generator', 'so_remove_version');

//Disable PING
add_filter( 'xmlrpc_methods', 'so_remove_ping' );
function so_remove_ping( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
}
add_filter( 'wp_headers', 'so_remove_pingback_headers' );
function so_remove_pingback_headers( $headers ) {
   unset( $headers['X-Pingback'] );
   return $headers;
}

// Function to add prism.css and prism.js to the site
function add_prism() {
// Register prism.css file
wp_register_style(
'prismCSS', // handle name for the style so we can register, de-register, etc.
get_stylesheet_directory_uri() . '/css/prism.css' // location of the prism.css file
);
// Register prism.js file
wp_register_script(
'prismJS', // handle name for the script so we can register, de-register, etc.
get_stylesheet_directory_uri() . '/js/prism.js' // location of the prism.js file
);
// Enqueue the registered style and script files
wp_enqueue_style('prismCSS');
wp_enqueue_script('prismJS');
}
add_action('wp_enqueue_scripts', 'add_prism');





?>
