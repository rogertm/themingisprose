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

	$less_files = array( T_EM_CHILD_THEME_DIR_PATH . '/css/style-theme.less' => T_EM_CHILD_THEME_DIR_URL . '/css' );
	$options = array( 'compress' => true );
	wp_enqueue_style( 'child-style-less', t_em_lessphp_compiler( $less_files, $options ), '', $t_em_theme_data['Version'], 'all' );

}
add_action( 'wp_enqueue_scripts', 'themingisprose_enqueue' );
?>
