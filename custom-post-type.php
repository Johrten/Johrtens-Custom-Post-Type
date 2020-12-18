<?php

/*
Plugin Name: Johrten's Sandwich Post Type
Description: Plugin that creates a new sandwich post type.
Version: 0.1
Author: Johrten Sternberg
Author URI: https://johrten.com/
License: GPLv2 or later
Text Domain: johrten
*/

// This should only run in a Wordpress enviroment
if( ! defined( 'ABSPATH' ) ) exit;

/**
 * This plugin didn't NEED to be more than one php file,
 * however, I think there's a balance to handling code splitting
 */
require_once( 'includes/sandwich.php' ); // This file handles the post type and its support for a meta box
require_once( 'includes/handle-meta.php' ); // This file handles saving the post meta data and inserting on the "All Sandwiches" page
