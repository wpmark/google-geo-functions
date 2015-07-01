<?php
/**
 * function wpggf_default_settings()
 *
 * adds the default plugin settings using the filter
 * just the setting for the geocoding api key
 */
function wpggf_default_settings( $settings ) {
	
	/* add the api key setting */
	$settings[ 'api_key' ] = array(
		'name' => 'wpggf_api_key',
		'label' => 'Google Geocoding API Key',
		'description' => 'Enter your API key for Google Geocoding. This can be created in the <a href="https://code.google.com/apis/console/">Google Developer Console</a>.',
		'type' => 'text',
		'class' => 'api-key',
	);
	
	return $settings;
	
}

add_filter( 'wpggf_settings', 'wpggf_default_settings', 10, 1 );