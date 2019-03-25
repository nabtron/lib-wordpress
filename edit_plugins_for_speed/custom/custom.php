<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              nabtron.com
 * @since             1.0.0
 * @package           Holidayrider_Custom
 *
 * @wordpress-plugin
 * Plugin Name:       holidayrider-custom
 * Plugin URI:        holidayrider-custom
 * Description:       custom plugin for holidayrider.
 * Version:           1.0.0
 * Author:            nabtron
 * Author URI:        nabtron.com
 * License:           private
 * Text Domain:       holidayrider-custom
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'HOLIDAYRIDER_CUSTOM_VERSION', '1.0.0' );

add_action('init', 'use_jquery_from_google');

function use_jquery_from_google () {
	if (is_admin()) {
		return;
	}

	global $wp_scripts;
	if (isset($wp_scripts->registered['jquery']->ver)) {
		$ver = $wp_scripts->registered['jquery']->ver;
	} else {
		$ver = '1.12.4';
	}

	wp_deregister_script('jquery');
	wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/$ver/jquery.min.js", false, $ver);
}

add_action('get_footer', 'use_fontawesome_cdn');
function use_fontawesome_cdn() {

		wp_dequeue_style('font-awesome');
		wp_dequeue_style('cheerup-font-awesome');
        wp_dequeue_style('cheerup-font-awesome-css');
        //wp_enqueue_style('cheerup-font-awesome-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), null);
        //wp_enqueue_script( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, bool $in_footer = false );

}

add_action('wp_footer', 'add_content_footer');
function add_content_footer() {
	echo '<!-- W3TC-include-css -->';
    //echo '<link rel="stylesheet" id="cheerup-font-awesome-css-css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" media="none" onload="if(media!=\'all\')media=\'all\'" />';
    //echo '<noscript><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></noscript>';
  
}


include_once('lazy-scripts.php');
