<?php
/*
	Plugin Name: Elodin Jobs
	Plugin URI: https://elod.in
    Description: Just another jobs listing plugin
	Version: 1.1
    Author: Jon Schroeder
    Author URI: https://elod.in

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/


/* Prevent direct access to the plugin */
if ( !defined( 'ABSPATH' ) ) {
    die( "Sorry, you are not allowed to access this page directly." );
}

// Plugin directory
define( 'ELODIN_JOBS', dirname( __FILE__ ) );

// Define the version of the plugin
define ( 'ELODIN_JOBS_VERSION', '1.1' );

// Register the content type/tax
require_once( 'lib/post_type.php' ); 
require_once( 'lib/taxonomy.php' ); 

// Template modifications
require_once( 'lib/single-template-modifications.php' );

// Register layouts
require_once( 'layout/jobs.php' );

add_action( 'wp_enqueue_scripts', 'elodin_jobs_enqueue' );
function elodin_jobs_enqueue() {
	
	// Plugin styles
    wp_register_style( 'elodin-jobs-styles', plugin_dir_url( __FILE__ ) . 'css/elodin-jobs.css', array(), ELODIN_JOBS_VERSION, 'screen' );
    	
}

// Updater
require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/elodin-jobs',
	__FILE__,
	'elodin-jobs'
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');