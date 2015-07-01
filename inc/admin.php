<?php
/**
 * function wpggf_register_plugin_settings()
 *
 * registers the default plugin settings for the plugin
 * these are the settings which appear in the plugin settings page
 */
function wpggf_register_plugin_settings() {
	
	/* get all the settings for this plugin */
	$settings = wpggf_get_plugin_settings();
	
	/* if we have some settings */
	if( ! empty( $settings ) ) {
		
		/* loop through each setting */
		foreach( $settings as $setting ) {
			
			/* register the setting */
			register_setting( 'wpggf_plugin_settings', $setting[ 'name' ] );
			
		}
		
	} // end if have settings
	
}

add_action( 'admin_init', 'wpggf_register_plugin_settings' );

/**
 * function wpbasis_add_plugin_settings()
 * adds a new page to use for the home page in admin
 */
function wpggf_add_settings_menu() {
	
	/* a plugin settings as sub page of settings */
	add_submenu_page(
		'options-general.php',
		'Google Geocoding',
		'Google Geocoding',
		'manage_options',
		'wpggf_settings',
		'wpggf_settings_page_output'
	);

}

add_action( 'admin_menu', 'wpggf_add_settings_menu' );

/**
 * function wpggf_settings_page_output()
 *
 * outputs the admin page content for the settings page
 */
function wpggf_settings_page_output() {
	
	?>
	
	<div class="wrap">
		
		<h2><?php echo apply_filters( 'wpggf_settings_page_title', 'Google Geocoding Settings' ); ?></h2>
		
		<?php
		
			/**
			 * @hooked wpggf_before_settings_page
			 */
			do_action( 'wpggf_before_settings_page' );
		
		?>
				
		<form method="post" action="options.php">
		
			<?php settings_fields( 'wpggf_plugin_settings' ); ?>
			
			<table class="form-table">
			
				<tbody>
					
					<?php
						
						/* get all the settings to show */
						$settings = wpggf_get_plugin_settings();

						/* if we have some settings */
						if( ! empty( $settings ) ) {
							
							/* loop through each feature control output */
							foreach( $settings as $setting ) {
								
								?>
						
								<tr valign="top" class="wpggc-setting wpggc-setting-<?php echo esc_attr( $setting[ 'class' ] ); ?>">
									
									<th scope="row">
										<label for="<?php echo esc_attr( $setting[ 'name' ] ); ?>"><?php echo $setting[ 'label' ]; ?></label>
									</th>
									<td>
										
										<?php
											
											/* setup a swith statement to output based on setting type */
											switch( $wpbasis_site_option_setting[ 'setting_type' ] ) {

												/* if the type is set to select input */
											    case 'select':
											    
											    	/* break out of the switch statement */
											        break;

											    /* if the type is set to a textarea input */  
											    case 'textarea':
											    
											    
											    	/* break out of the switch statement */
											        break;

											    case 'wysiwyg':
											    
											    	break;

											    /* any other type of input - treat as text input */ 
											    default:
													
													?>
													
													<input type="text" name="<?php echo $setting[ 'name' ]; ?>" id="<?php echo $setting[ 'name' ]; ?>" class="regular-text" value="<?php echo esc_attr( get_option( $setting[ 'name' ] ) ); ?>" />
												
													<?php
												
												}
												
											?>
										
										<p class="description"><?php echo $setting[ 'description' ]; ?></p>
										
									</td>
									
								</tr>
									
								<?php
									
							} // end loop through each setting
							
						} // end if have settings
						
					?>
					
				</tbody>
			
			</table>
			
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes">
			</p>
		
		</form>
		
	<?php
		
	/**
	 * @hooked wpggf_after_settings_page
	 */
	do_action( 'wpggf_after_settings_page' );

	
}