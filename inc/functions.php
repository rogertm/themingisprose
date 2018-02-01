<?php
/**
 * Theming is Prose
 *
 * @package			WordPress
 * @subpackage		Theming is Prose: Setup
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/
 * @since 			Theming is Prose 1.0
 */

/**
 * Theming is Prose Setup
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_setup(){
	// Make Theming is Prose available for translation.
	load_child_theme_textdomain( 'themingisprose', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'themingisprose_setup' );

/**
 * Enqueue and register all css and js
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_enqueue(){
	global $t_em_theme_data;
	wp_register_style( 'child-style', t_em_get_css( 'theme', T_EM_CHILD_THEME_DIR_PATH .'/css', T_EM_CHILD_THEME_DIR_URL .'/css' ), '', $t_em_theme_data['Version'], 'all' );
	wp_enqueue_style( 'child-style' );
}
add_action( 'wp_enqueue_scripts', 'themingisprose_enqueue' );

/**
 * Dequeue styles form parent theme
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_dequeue(){
	wp_dequeue_style( 'twenty-em-style' );
	wp_deregister_style( 'twenty-em-style' );
}
add_action( 'wp_enqueue_scripts', 'themingisprose_dequeue', 999 );

/**
 * Remove some unnecessary templates
 *
 * @since Theming is Prose 1.0
 */
function t_em_front_page_widgets(){
	return false;
}
?>
