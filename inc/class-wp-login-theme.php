<?php

defined( 'ABSPATH' ) or die();

function WLT_LOGIN_CSS() {
	wp_enqueue_style( 'wlt_login_css', plugin_dir_url( __FILE__ ) . 'css/wlt-login.css', false );
}

// changing the logo link from wordpress.org to your site
function WLT_LOGIN_URL() {  return home_url(); }

// changing the alt text on the logo to show your site name
function WLT_LOGIN_TITLE() { return get_option( 'blogname' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'WLT_LOGIN_CSS', 10 );
add_filter( 'login_headerurl', 'WLT_LOGIN_URL' );
add_filter( 'login_headertitle', 'WLT_LOGIN_TITLE' );
