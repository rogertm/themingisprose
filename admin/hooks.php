<?php
/**
 * Theming is Prose
 *
 * @package			WordPress
 * @subpackage		Theming is Prose: Hooks
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/
 * @since 			Theming is Prose 1.0
 */

/**
 * Add some options to Front Page Text Widgets
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_front_page_widgets( $front_page_widgets = '' ){
	$custom_widgets = array(
		'text_widget_five'	=> array(
			'name'	=> 'text_widget_five',
			'label'	=> __( 'Fifth home page text area', 'themingisprose' ),
		),
		'text_widget_six'	=> array(
			'name'	=> 'text_widget_six',
			'label'	=> __( 'Sixth home page text area', 'themingisprose' ),
		),
	);
	$widgets = array_merge( $front_page_widgets, $custom_widgets );
	return $widgets;
}
add_filter( 't_em_admin_filter_front_page_widgets_options', 'themingisprose_front_page_widgets' );
?>
