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

/**
 * Extend setting for Front Page Text Widgets in Twenty'em admin panel
 * Reference via t_em_front_page_options()
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_front_page_witgets_callback(){
	global 	$t_em;

	$extend_front_page = '';
	$extend_front_page .= '<div class="">';
	$extend_front_page .= 	'<div id="work-flow-title" class="sub-extend option-group">';
	$extend_front_page .= 		'<div class="layout text-option front-page">';
	$extend_front_page .= 			'<header>' . __( 'Work Flow Title', 'themingisprose' ) . '</header>';
	$extend_front_page .= 			'<p><label><span>' . __( 'Headline', 't_em' ) .'</span>';
	$extend_front_page .= 				'<input type="text" class="regular-text headline" name="t_em_theme_options[work_flow_title]" value="' . esc_textarea( $t_em['work_flow_title'] ) . '" />';
	$extend_front_page .= 			'</label></p>';
	$extend_front_page .= 		'</div>';
	$extend_front_page .= 	'</div>';
	$extend_front_page .= '</div>';

	$extend_front_page .= '<div class="row">';
	$i = 0;
	foreach ( t_em_front_page_widgets_options() as $widget ) :
		if ( 0 == $i % 2 ) :
			$extend_front_page .= '</div>';
			$extend_front_page .= '<div class="row">';
		endif;
		$extend_front_page .= '<div id="' . $widget['name'] . '" class="sub-extend option-group">';
		$extend_front_page .= 	'<div class="layout text-option front-page">';
		$extend_front_page .= 		'<header>' . $widget['label'] . '</header>';
		$extend_front_page .= 		'<p><label><span>' . __( 'Headline', 't_em' ) .'</span>';
		$extend_front_page .= 			'<input type="text" class="regular-text headline" name="t_em_theme_options[headline_' . $widget['name'] . ']" value="' . esc_textarea( $t_em['headline_'.$widget['name']] ) . '" />';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 		'<p><label><span>' . sprintf( __( 'Headline <a href="%1$s" target="_blank">Icon Class</a>', 't_em' ), T_EM_ICON_PACK ) . '</span>';
		$extend_front_page .= 			'<input type="text" class="regular-text" name="t_em_theme_options[headline_icon_class_' . $widget['name'] . ']" value="' . $t_em['headline_icon_class_'.$widget['name']] . '" />';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 		'<p><label><span>' . __( 'Content', 't_em' ) .'</span>';
		$extend_front_page .= 			'<textarea name="t_em_theme_options[content_' . $widget['name'] . ']" class="large-text" cols="50" rows="10">' . esc_textarea( $t_em['content_'.$widget['name']] ) . '</textarea>';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 	'</div>';
		$extend_front_page .= '</div>';
		$i++;
	endforeach;
	$extend_front_page .= '</div>';

	return $extend_front_page;
}
add_filter( 't_em_admin_filter_front_page_widgets_output', 'themingisprose_front_page_witgets_callback' );
?>
