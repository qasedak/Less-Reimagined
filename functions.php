<?php

/*-----------------------------------------------------------------------------------*/
/* Load Theme textdomain
/*-----------------------------------------------------------------------------------*/
add_action( 'after_setup_theme', 'less_theme_setup' );
function less_theme_setup(){
    load_theme_textdomain( 'moreOrLess', get_template_directory() . '/languages' );
}

// Define the version as a constant so we can easily replace it throughout the theme
define( 'LESS_VERSION', 1.1 );
add_theme_support( 'title-tag' );
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
		'primary'	=>	__( 'Primary Menu', 'moreOrLess' ),
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

/*-----------------------------------------------------------------------------------*/
/* Dark theme fuctions - use: $_SERVER['REMOTE_ADDR']
/*-----------------------------------------------------------------------------------*/

function FILTER_FLAG_NO_LOOPBACK_RANGE($value)
{
	return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? $value : (((ip2long($value) & 0xff000000) == 0x7f000000) ? FALSE : $value);
}

function isNight(string $ip = ""): bool
{
	if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)  && filter_var($ip, FILTER_CALLBACK, array('options' => 'FILTER_FLAG_NO_LOOPBACK_RANGE')) && $ip != "::1") {
		// ip is valid
		$apiReq = file_get_contents("https://freeipapi.com/api/json/" . $ip);
		$ipInfo = json_decode($apiReq, true)["timeZone"];
		if (!empty($ipInfo) || $ipInfo != "-") {
			$usersTimezone = $ipInfo;
		} else {
			//WP time-zone
			$usersTimezone = wp_timezone();
		}
		$date = new DateTime('now', new DateTimeZone($usersTimezone));
		$currentTime =  $date->format('H:i:s');
		return (strtotime($currentTime) >= strtotime("18:00:00") || strtotime($currentTime) <= strtotime("5:00:00")); // output True for Night time
	} else {
		// ip is not valid
		return false;
	}
}
