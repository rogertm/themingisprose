<?php
/**
 * Theming is Prose
 *
 * @package			WordPress
 * @subpackage		Theming is Prose: Templates
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/
 * @since 			Theming is Prose 1.0
 */

/**
 * Work Flow step by step
 * This function uses the data provided by Front Page Widgets Options
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_work_flow_card(){
	if ( ! is_front_page() )
		return;

	global $t_em;
?>
	<section id="work-flow">
		<div class="<?php echo t_em_container() ?>">
			<div class="row">
<?php
	foreach ( t_em_front_page_widgets_options() as $widget ) :
		if ( ! empty( $t_em['headline_'.$widget['name'].''] ) || ! empty( $t_em['content_'.$widget['name'].''] ) ) :
		$widget_icon_class	= ( $t_em['headline_icon_class_'.$widget['name'].''] ) ?
			'<span class="'. $t_em['headline_icon_class_'.$widget['name'].''] .' h1"></span> ' : null;

		$widget_thumbnail_url	= ( $t_em['thumbnail_src_'.$widget['name'].''] ) ?
			'<div class="work-flow-img '. t_em_grid( '5' ) .'"><img src="'. $t_em['thumbnail_src_'.$widget['name'].''] .'" alt="'. sanitize_text_field( $t_em['headline_'.$widget['name']] ) .'"/></div>' : null;

		$widget_headline	= ( $t_em['headline_'.$widget['name'].''] ) ?
			'<header class="work-flow-heading">'. $widget_icon_class .'<h3 class="h4">'. $t_em['headline_'.$widget['name'].''] .'</h3></header>' : null;

		$widget_content		= ( $t_em['content_'.$widget['name'].''] ) ?
			'<div class="work-flow-body">'. t_em_wrap_paragraph( do_shortcode( $t_em['content_'.$widget['name']] ) ) .'</div>' : null;

		$primary_link_text			= ( $t_em['primary_button_text_'.$widget['name']] ) ? $t_em['primary_button_text_'.$widget['name']] : null;
		$primary_link_icon_class	= ( $t_em['primary_button_icon_class_'.$widget['name']] ) ? $t_em['primary_button_icon_class_'.$widget['name']] : null;
		$primary_button_link 		= ( $t_em['primary_button_link_'.$widget['name']] ) ? $t_em['primary_button_link_'.$widget['name']] : null;
		$secondary_link_text		= ( $t_em['secondary_button_text_'.$widget['name']] ) ? $t_em['secondary_button_text_'.$widget['name']] : null;
		$secondary_link_icon_class	= ( $t_em['secondary_button_icon_class_'.$widget['name']] ) ? $t_em['secondary_button_icon_class_'.$widget['name']] : null;
		$secondary_button_link 		= ( $t_em['secondary_button_link_'.$widget['name']] ) ? $t_em['secondary_button_link_'.$widget['name']] : null;

		if ( ( $primary_button_link && $primary_link_text ) || ( $secondary_button_link && $secondary_link_text ) ) :
				$primary_button_link_url = ( $primary_button_link && $primary_link_text ) ?
					'<a href="'. $primary_button_link .'" class="btn btn-primary primary-button">
					<span class="'.$primary_link_icon_class.'"></span> <span class="button-text">'. $primary_link_text .'</span></a>' : null;

				$secondary_button_link_url = ( $secondary_button_link && $secondary_link_text ) ?
					'<a href="'. $secondary_button_link .'" class="btn btn-secondary secondary-button">
					<span class="'.$secondary_link_icon_class.'"></span> <span class="button-text">'. $secondary_link_text .'</span></a>' : null;

			$widget_footer = '<footer class="work-flow-footer">'. $primary_button_link_url . ' ' . $secondary_button_link_url .'</footer>';
		else :
			$widget_footer = null;
		endif;
?>
				<div id="work-flow-step-<?php echo str_replace( 'text_widget_', '', $widget['name'] ) ?>" class="work-flow text-center mb-5 px-3 <?php echo t_em_grid( '2' ) .' '. t_em_grid( '6', 'md' ) ?>">
					<?php echo $widget_thumbnail_url; ?>
					<?php	echo $widget_headline;
							echo $widget_content;
							echo $widget_footer; ?>
				</div>
<?php
		endif;
	endforeach;
?>
			</div>
		</div>
	</section>
<?php
}
// add_action( 't_em_action_main_before', 'themingisprose_work_flow_card' );

/**
 * Work Flow step by step
 * This function uses the data provided by Front Page Widgets Options
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_work_flow_slide(){
	if ( ! is_front_page() )
		return;

	global $t_em;
?>
	<section id="jumbo-work-flow" class="bg-secondary jumbo">
		<div class="<?php echo t_em_container() ?>">
			<h2 class="jumbo-title"><?php echo $t_em['work_flow_title'] ?></h2>
			<div id="work-flow-carousel" class="carousel slide" data-ride="carousel">
				<?php
					$slides = t_em_front_page_widgets_options();
					$ts = count( $slides );
					$ind = array_keys( $slides );
				?>
				<ol class="carousel-indicators">
				<?php $s = 0; while ( $s < $ts ) : ?>
					<li data-target="#work-flow-carousel" data-slide-to="<?php echo $s ?>">
						<span class="<?php echo $t_em['headline_icon_class_'.$ind[$s].''] ?> h1"></span>
						<span class="sr-only"><?php echo $t_em['headline_'.$ind[$s].''] ?></span>
					</li>
				<?php $s++; endwhile; ?>
					</ol><!-- .carousel-indicators -->
				<div class="carousel-inner">

				<?php
					foreach ( $slides as $widget ) :
						if ( ! empty( $t_em['headline_'.$widget['name'].''] ) || ! empty( $t_em['content_'.$widget['name'].''] ) ) :
						$widget_icon_class	= ( $t_em['headline_icon_class_'.$widget['name'].''] ) ?
							'<span class="'. $t_em['headline_icon_class_'.$widget['name'].''] .' h1"></span> ' : null;

						$widget_thumbnail_url	= ( $t_em['thumbnail_src_'.$widget['name'].''] ) ?
							'<div class="work-flow-img '. t_em_grid( '5' ) .'"><img src="'. $t_em['thumbnail_src_'.$widget['name'].''] .'" alt="'. sanitize_text_field( $t_em['headline_'.$widget['name']] ) .'"/></div>' : null;

						$widget_headline	= ( $t_em['headline_'.$widget['name'].''] ) ?
							'<header class="work-flow-heading"><h3 class="h4">'. $t_em['headline_'.$widget['name'].''] .'</h3></header>' : null;

						$widget_content		= ( $t_em['content_'.$widget['name'].''] ) ?
							'<div class="work-flow-body lead">'. t_em_wrap_paragraph( do_shortcode( $t_em['content_'.$widget['name']] ) ) .'</div>' : null;

						$primary_link_text			= ( $t_em['primary_button_text_'.$widget['name']] ) ? $t_em['primary_button_text_'.$widget['name']] : null;
						$primary_link_icon_class	= ( $t_em['primary_button_icon_class_'.$widget['name']] ) ? $t_em['primary_button_icon_class_'.$widget['name']] : null;
						$primary_button_link 		= ( $t_em['primary_button_link_'.$widget['name']] ) ? $t_em['primary_button_link_'.$widget['name']] : null;
						$secondary_link_text		= ( $t_em['secondary_button_text_'.$widget['name']] ) ? $t_em['secondary_button_text_'.$widget['name']] : null;
						$secondary_link_icon_class	= ( $t_em['secondary_button_icon_class_'.$widget['name']] ) ? $t_em['secondary_button_icon_class_'.$widget['name']] : null;
						$secondary_button_link 		= ( $t_em['secondary_button_link_'.$widget['name']] ) ? $t_em['secondary_button_link_'.$widget['name']] : null;

						if ( ( $primary_button_link && $primary_link_text ) || ( $secondary_button_link && $secondary_link_text ) ) :
								$primary_button_link_url = ( $primary_button_link && $primary_link_text ) ?
									'<a href="'. $primary_button_link .'" class="btn btn-primary primary-button">
									<span class="'.$primary_link_icon_class.'"></span> <span class="button-text">'. $primary_link_text .'</span></a>' : null;

								$secondary_button_link_url = ( $secondary_button_link && $secondary_link_text ) ?
									'<a href="'. $secondary_button_link .'" class="btn btn-secondary secondary-button">
									<span class="'.$secondary_link_icon_class.'"></span> <span class="button-text">'. $secondary_link_text .'</span></a>' : null;

							$widget_footer = '<footer class="work-flow-footer">'. $primary_button_link_url . ' ' . $secondary_button_link_url .'</footer>';
						else :
							$widget_footer = null;
						endif;
				?>
					<div class="carousel-item">
						<h3><?php echo $widget_headline; ?></h3>
						<?php echo $widget_content ?>
					</div>
				<?php
						endif;
					endforeach; ?>
				</div>
			</div>
		</div>
	</section>
<?php
}
add_action( 't_em_action_main_before', 'themingisprose_work_flow_slide' );
?>
