<?php
/*
Plugin Name: Bean Instagram
Plugin URI: http://themebeans.com/plugin/bean-instagram-plugin/?ref=plugin_bean_instagram
Description: Enables an Instagram feed widget. You must register an <a href="http://instagram.com/developer/" target="_blank">Instagram App</a> to retrieve your client ID and secret. <a href="http://themebeans.com/registering-your-instagram-app-to-retrieve-your-client-id-secret-code">Learn More</a>
Version: 1.3
Author: ThemeBeans
Author URI: http://www.themebeans.com/?ref=plugin_bean_instagram
*/

// DON'T CALL ANYTHING
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define('BEAN_INSTAGRAM_PATH', plugin_dir_url( __FILE__ ));




/*===================================================================*/
/*
/* PLUGIN UPDATER FUNCTIONALITY
/*
/*===================================================================*/
define( 'EDD_BEANINSTAGRAM_TB_URL', 'http://themebeans.com' );
define( 'EDD_BEANINSTAGRAM_NAME', 'Bean Instagram' );

//LOAD UPDATER CLASS
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) 
{
	include( dirname( __FILE__ ) . '/updates/EDD_SL_Plugin_Updater.php' );
}
//INCLUDE UPDATER SETUP
include( dirname( __FILE__ ) . '/updates/EDD_SL_Activation.php' );


/*===================================================================*/
/* UPDATER SETUP
/*===================================================================*/
function beaninstagram_license_setup() 
{
	add_option( 'edd_beaninstagram_activate_license', 'BEANINSTAGRAM' );
	add_option( 'edd_beaninstagram_license_status' );
}
add_action( 'init', 'beaninstagram_license_setup' );

function edd_beaninstagram_plugin_updater() 
{
	//RETRIEVE LICENSE KEY
	$license_key = trim( get_option( 'edd_beaninstagram_activate_license' ) );

	$edd_updater = new EDD_SL_Plugin_Updater( EDD_BEANINSTAGRAM_TB_URL, __FILE__, array( 
			'version' 	=> '1.3',
			'license' 	=> $license_key,
			'item_name' => EDD_BEANINSTAGRAM_NAME,
			'author' 	=> 'ThemeBeans'
		)
	);
}
add_action( 'admin_init', 'edd_beaninstagram_plugin_updater' );


/*===================================================================*/
/* DEACTIVATION HOOK - REMOVE OPTION
/*===================================================================*/
function beaninstagram_deactivate() 
{
	delete_option( 'edd_beaninstagram_activate_license' );
	delete_option( 'edd_beaninstagram_license_status' );
}
register_deactivation_hook( __FILE__, 'beaninstagram_deactivate' );








/*===================================================================*/
/*
/* BEGIN BEAN SOCIAL PLUGIN
/*
/*===================================================================*/
// INCLUDE WIDGET
require_once('bean-instagram-widget.php');
?>