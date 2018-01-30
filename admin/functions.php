<?php
/**
 * Theming is Prose
 *
 * @package			WordPress
 * @subpackage		Theming is Prose: Admin
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/
 * @since 			Theming is Prose 1.0
 */

/**
 * Register Setting
 * @link http://codex.wordpress.org/Settings_API
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_register_setting_init(){
	add_settings_field( 'themingisprose_custom_pages', __( 'Custom Pages', 'themingisprose' ), 'themingisprose_setting_fields_custom_pages', 'twenty-em-options', 'twenty-em-section' );
}
add_action( 't_em_admin_action_add_settings_field', 'themingisprose_register_setting_init' );


/**
 * Enqueue styles and scripts
 */
function themingisprose_admin_enqueue(){
	$screen = get_current_screen();
	if ( $screen->id == 'toplevel_page_twenty-em-options' ):
		// Check the theme version right from the style sheet
		global $t_em_theme_data;
		wp_register_style( 'style-admin-t-em-all', T_EM_CHILD_THEME_DIR_URL.'/admin/css-js/admin-style.css', false, $t_em_theme_data['Version'], 'all' );
		wp_enqueue_style( 'style-admin-t-em-all' );
	endif;
}
add_action( 'admin_enqueue_scripts', 'themingisprose_admin_enqueue' );

/**
 * Merge into default theme options
 * This function is attached to the "t_em_admin_filter_default_theme_options" filter hook
 * @return array 	Array of options
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_default_theme_options( $default_theme_options ){
	$themingisprose_default_options = array();

	// Get custom pages from the original function
	foreach ( themingisprose_custom_pages() as $pages => $value ) :
		$key = array( $value['value'] => '' );
		$themingisprose_default_options = array_merge( $themingisprose_default_options, array_slice( $key, -1 ) );
	endforeach;

	$default_options = array_merge( $default_theme_options, $themingisprose_default_options );

	return $default_options;
}
add_filter( 't_em_admin_filter_default_theme_options', 'themingisprose_default_theme_options' );

/**
 * Sanitize and validate the input.
 * This function is attached to the "t_em_admin_filter_theme_options_validate" filter hook
 * @param $input array  Array of options to validate
 * @return array
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_theme_options_validate( $input ){
	if ( ! $input )
		return;

	// Let's go for pages
	$select_pages = array();
	// Create the array on the fly
	foreach ( themingisprose_custom_pages() as $pages => $value ) :
		$key = array(
			$value['value'] => array(
				'set'		=> $value['value'],
				'callback'	=> themingisprose_custom_pages(),
			),
		);
	$select_pages = array_merge( $select_pages, array_slice( $key, -1 ) );
	endforeach;

	return $input;
}
add_filter( 't_em_admin_filter_theme_options_validate', 'themingisprose_theme_options_validate' );
?>
