<?php
/**
 * function wpggf_get_plugin_settings()
 * 
 * returns any setting which have been added
 */
function wpggf_get_plugin_settings() {
	
	return apply_filters(
		'wpggf_settings',
		array()
	);
	
}

/**
 * function wpggf_get_address()
 *
 * returns a formatted address for any given latitude and longitude
 * using the google geocoding api - you need to pass an API key
 *
 * @param (float)	$lat	is the latitude value to query
 * @param (float)	$lng	is the longitude value to query
 * @param (mixed)	$api_key is your google api key for the geocoding api
 *
 * @return (mixed/false) a string of the address or false if an address cannot be found
 */
function wpggf_get_address( $lat, $lng, $api_key = '' ) {
	
	/* set api key if no key passed to function */
	if( empty( $api_key ) ) {
		$api_key = get_option( 'wpggf_api_key' );
	}
	
	/* set the url to query the google geocode api */
	$url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $lng . '&key=' . $api_key;
	
	/* get the contents of the api url */
	$geodata_raw = file_get_contents( $url );
	
	/* convert the json into an object */
	$geodata = json_decode( $geodata_raw );
	
	/* check we have some geo contents to work with */
	if( $geodata->status == 'OK' ) {
		
		return $geodata->results[0]->formatted_address;
	
	/* returned data not ok */
	} else {
		
		return false;
		
	} // end if have geo data to work with
	
}

/**
 * function wpggf_get_lat_lng()
 *
 * gets the latitude and longitude values of a given location
 * using the google geocoding api
 */
function wpggf_get_lat_lng( $location, $api_key = '' ) {
	
	/* set api key if no key passed to function */
	if( empty( $api_key ) ) {
		$api_key = get_option( 'wpggf_api_key' );
	}
	
	/* set the url to query the google geocode api */
	$url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode( $location ) . '&key=' . $api_key;
	
	/* get the contents of the api url */
	$geodata_raw = file_get_contents( $url );
	
	/* convert the json into an object */
	$geodata = json_decode( $geodata_raw );

	/* check we have some geo contents to work with */
	if( $geodata->status == 'OK' ) {
	
		/* create an empty array to store lat long */
		$lat_lng = array();
		
		/* read the latitude and longitude from the returned informed */
		 $lat_lng[ 'lat' ] = ( string ) $geodata->results[0]->geometry->location->lat;
		 $lat_lng[ 'lng' ] = (string ) $geodata->results[0]->geometry->location->lng;
		 
		 /* return the lat lng array */
		 return $lat_lng;
	
	/* returned data not ok */
	} else {
		
		return false;
		
	}
	
}

/**
 * function wpggf_google_map_iframe()
 *
 * outputs an google map in an iframe according to specified args
 * @param (array)	$args see the defaults
 *
 * @return (mixed)	the iframe to output the map in
 */
function wpggf_google_map_iframe( $args = array() ) {
	
	/* setup some defaults */
	$defaults = array(
		'width'		=> '100%',
		'height'	=> '300px',
		'api_key'	=> get_option( 'wpggf_api_key' ),
		'lat'		=> '54.5754324',
		'lng'		=> '-2.9289293',
		'zoom'		=> 11,
		'maptype'	=> 'roadmap',
		'echo'		=> true
	);
	
	/* merge defaults with passed args */
	$args = wp_parse_args( $args, $defaults );

	$iframe = '<iframe width="' . esc_attr( $args[ 'width' ] ) . '" height="' . esc_attr( $args[ 'height' ] ) . '" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/view?key=' . esc_attr( $args[ 'api_key' ] ) . '&center=' . esc_attr( $args[ 'lat' ] ) . ',' . esc_attr( $args[ 'lng' ] ) . '&zoom=' . esc_attr( $args[ 'zoom' ] ) . '&maptype=' . esc_attr( $args[ 'maptype' ] ) . '" allowfullscreen>
</iframe>';
	
	/* should we echo or return */
	if( $args[ 'echo' ] == false ) {
		
		/* return the iframe string */
		return $iframe;
	
	/* we should echo not return */	
	} else {
		
		/* echo the iframe string */
		echo $iframe;
		
	}
	
}