=== Plugin Name ===
Contributors: wpmarkuk
Donate link: http://markwilkinson.me/saythanks/
Tags: Location, Geocoding
Requires at least: 4.2
Tested up to: 4.2.2
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Gives you some simple functions to use the Google Geocoding API as well as embedded maps.

== Description ==

This plugin provides three functions which can be used in your theme and plugin files in order to take advantage of the Google Geocoding API as well as embedded maps via an iframe. After entering your API key on the settings page you can make use of the following functions:

`
<?php
	wpggf_get_address(
		$lat,
		$lng,
		$api_key = ''
	);
?>
`

This gets the formatted address of a place using its lat lng values which are passed to the function as array args. You can also include your API Key via the function although it uses the one from the settings screen by default.

`
<?php
	wpggf_get_lat_lng(
		$location,
		$api_key = ''
	);
?>
`

This gets the latitude and longitude values (returned as an array) of any given location which is passed as an argument.

Finally the following function embeds an iframe map of a given place. See the default args in the function below to an ideas of how this works.

`
<?php
	wpggf_google_map_iframe(
		array(
			'width'		=> '100%',
			'height'	=> '300px',
			'api_key'	=> get_option( 'wpggf_api_key' ),
			'lat'		=> '54.5754324',
			'lng'		=> '-2.9289293',
			'zoom'		=> 11,
			'maptype'	=> 'roadmap',
			'echo'		=> true
		)
	);
?>
`

== Installation ==

1. Upload plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Visit the settings screen under Settings > Google Geocoding to enter your API key
1. Make use of the functions!

== Frequently Asked Questions ==

Nothing so far! If you do spot an issue though please add an issue to the [Github repository](https://github.com/wpmark/google-geo-functions).

== Screenshots ==

N/A

== Changelog ==

= 0.1 =
Initial release

== Upgrade Notice ==

Upgrade through the WordPress admin screens.