<?php
/*
Plugin Name: Google Geo Functions
Description: Provides helper functions to more easily access and use the <a href="https://developers.google.com/maps/documentation/geocoding/">Google Geocoding API</a>. Please note you need an API key (limited free use) from Google for this plugin..
Version:     0.1
Author:      Mark Wilkinson
Author URI:  http://markwilkinson.me
Text Domain: wpptm
License:     GPL v2 or later

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

/* exist if directly accessed */
if( ! defined( 'ABSPATH' ) ) exit;

/**
 * include the necessary functions file for the plugin
 */
require_once dirname( __FILE__ ) . '/inc/functions.php';
require_once dirname( __FILE__ ) . '/inc/defaults.php';
require_once dirname( __FILE__ ) . '/inc/admin.php';