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
 * Remove unnecessary options
 */
add_filter( 't_em_admin_filter_header_options_no_header_image', '__return_false' );
add_filter( 't_em_admin_filter_header_options_header_image', '__return_false' );
add_filter( 't_em_admin_filter_header_options_slider', '__return_false' );
add_filter( 't_em_admin_filter_front_page_options_wp_front_page', '__return_false' );
add_filter( 't_em_admin_filter_archive_options_the_content', '__return_false' );

/**
 * Enqueue styles and scripts
 */
function themingisprose_admin_enqueue(){
	$screen = get_current_screen();
	if ( $screen->id == 'toplevel_page_twenty-em-options' ):
		// Check the theme version right from the style sheet
		global $t_em_theme_data;
		wp_register_style( 'style-admin-tip', T_EM_CHILD_THEME_DIR_URL.'/admin/css-js/admin-style.css', false, $t_em_theme_data['Version'], 'all' );
		wp_enqueue_style( 'style-admin-tip' );
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
	$themingisprose_default_options = array(
		// Custom Front Page Text Witgets Options
		'headline_text_widget_five'						=> '',
		'content_text_widget_five'						=> '',
		'headline_icon_class_text_widget_five'			=> '',
		'thumbnail_src_text_widget_five'				=> '',
		'primary_button_text_text_widget_five'			=> '',
		'primary_button_link_text_widget_five'			=> '',
		'primary_button_icon_class_text_widget_five'	=> '',
		'secondary_button_text_text_widget_five'		=> '',
		'secondary_button_link_text_widget_five'		=> '',
		'secondary_button_icon_class_text_widget_five'	=> '',
		'headline_text_widget_six'						=> '',
		'content_text_widget_six'						=> '',
		'headline_icon_class_text_widget_six'			=> '',
		'thumbnail_src_text_widget_six'					=> '',
		'primary_button_text_text_widget_six'			=> '',
		'primary_button_link_text_widget_six'			=> '',
		'primary_button_icon_class_text_widget_six'		=> '',
		'secondary_button_text_text_widget_six'			=> '',
		'secondary_button_link_text_widget_six'			=> '',
		'secondary_button_icon_class_text_widget_six'	=> '',
	);

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

	// Validate all url (input[type="url"]) options
	foreach ( array(
		'thumbnail_src_text_widget_five',
		'primary_button_link_text_widget_five',
		'thumbnail_src_text_widget_six',
		'primary_button_link_text_widget_six',
	) as $url ) :
		$input[$url] = ( isset( $input[$url] ) ) ? esc_url_raw( $input[$url] ) : '';
	endforeach;

	// Validate all text field options
	foreach ( array(
		'primary_button_text_text_widget_five',
		'headline_text_widget_five',
		'primary_button_link_text_widget_five',
		'secondary_button_link_text_widget_five',
		'secondary_button_text_text_widget_five',
		'primary_button_text_text_widget_six',
		'headline_text_widget_six',
		'primary_button_link_text_widget_six',
		'secondary_button_link_text_widget_six',
		'secondary_button_text_text_widget_six',
	) as $text_field ) :
		$input[$text_field] = ( isset( $input[$text_field] ) ) ? trim( $input[$text_field] ) : '';
	endforeach;

	// Validate all text field icon-class options
	foreach ( array(
		'headline_icon_class_text_widget_five',
		'primary_button_icon_class_text_widget_five',
		'secondary_button_icon_class_text_widget_five',
		'headline_icon_class_text_widget_six',
		'primary_button_icon_class_text_widget_six',
		'secondary_button_icon_class_text_widget_six',
	) as $text_field ) :
		$input[$text_field] = ( isset( $input[$text_field] ) ) ? trim( sanitize_text_field( $input[$text_field] ) ) : '';
	endforeach;

	// Validate all textarea options
	foreach ( array(
		'content_text_widget_five',
		'content_text_widget_six',
	) as $textarea ) :
		$input[$textarea] = ( isset( $input[$textarea] ) ) ? trim( $input[$textarea] ) : '';
	endforeach;

	return $input;
}
add_filter( 't_em_admin_filter_theme_options_validate', 'themingisprose_theme_options_validate' );
?>
