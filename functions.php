<?php

/*-----------------------------------------------------------------------------------*/
/* Load Theme textdomain
/*-----------------------------------------------------------------------------------*/
add_action( 'after_setup_theme', 'less_reimagined_theme_setup' );
function less_reimagined_theme_setup(){
    load_theme_textdomain( 'less-reimagined', get_template_directory() . '/languages' );
}

// Define the version as a constant, so we can easily replace it throughout the theme
const LESS_VERSION = 1.0;
add_theme_support( 'title-tag' );

/*-----------------------------------------------------------------------------------*/
/* Custom Logo - <span> has removed from has_custom_logo() output.
/*-----------------------------------------------------------------------------------*/
function less_reimagined_custom_logo_setup() {
    $defaults = array(
        'height'               => 100,
        'width'                => 100,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true,
    );

    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'less_reimagined_custom_logo_setup' );

function change_custom_logo( $html ) {
    $html = str_replace( '<span class="custom-logo-link">', '', $html );
    $html = str_replace( '</span>', '', $html );
    return str_replace('custom-logo', 'avatar avatar-100 photo', $html);
}
add_filter( 'get_custom_logo', 'change_custom_logo' );

/*-----------------------------------------------------------------------------------*/
/* Add Rss to Head
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/* Add Content width
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

/*-----------------------------------------------------------------------------------*/
/* register main menu
/*-----------------------------------------------------------------------------------*/
register_nav_menus( 
	array(
		'primary'	=>	__( 'Primary Menu', 'less-reimagined' ),
	)
);

/*-----------------------------------------------------------------------------------*/
/* Enque Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function less_scripts()  { 

	// theme styles
    if (!is_admin()) {
        wp_register_style('less-Arvo', 'https://fonts.googleapis.com/css?family=Arvo:400,700', array(), null, 'all');
        wp_enqueue_style('less-Arvo');
    }
	wp_enqueue_style( 'less-style', get_template_directory_uri() . '/style.css', '10000', 'all' );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
  
}
add_action( 'wp_enqueue_scripts', 'less_scripts' );


/*-----------------------------------------------------------------------------------*/
/* Add a pingback url to header
/*-----------------------------------------------------------------------------------*/

function less_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'less_pingback_header' );

/**
* theme options additions.
*/
require get_template_directory() . '/inc/options.php';