<?php
/**
 * Theming is Prose
 *
 * @package			WordPress
 * @subpackage		Theming is Prose: Admin > Custom Pages
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Theming is Prose 1.0
 */

/**
 * Array of pages object
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_list_pages( $type ){
	$args = array(
		'post_type'			=> $type,
		'posts_per_page'	=> -1,
		'orderby'			=> 'title',
		'post_status'		=> array( 'publish', 'private' ),
		'order'				=> 'ASC',
	);
	$sort = get_posts( $args );
	sort( $sort );
	return apply_filters( 'themingisprose_admin_filter_list_pages', get_posts( $args ) );
}

/**
 * Custom Pages
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_custom_pages( $custom_pages = '' ){
	$custom_pages = array(
		'page_services'	=> array(
			'value'			=> 'page_services',
			'label'			=> __( 'Page Services', 'themingisprose' ),
			'public_label'	=> __( 'Services', 'themingisprose' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_portfolio'	=> array(
			'value'			=> 'page_portfolio',
			'label'			=> __( 'Page Portfolio', 'themingisprose' ),
			'public_label'	=> __( 'Portfolio', 'themingisprose' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_projects'	=> array(
			'value'			=> 'page_projects',
			'label'			=> __( 'Page Projects', 'themingisprose' ),
			'public_label'	=> __( 'Projects', 'themingisprose' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_team'	=> array(
			'value'			=> 'page_team',
			'label'			=> __( 'Page Team', 'themingisprose' ),
			'public_label'	=> __( 'Team', 'themingisprose' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_plans'	=> array(
			'value'			=> 'page_plans',
			'label'			=> __( 'Page Plans', 'themingisprose' ),
			'public_label'	=> __( 'Plans', 'themingisprose' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_contact'	=> array(
			'value'			=> 'page_contact',
			'label'			=> __( 'Page Contact', 'themingisprose' ),
			'public_label'	=> __( 'Contact', 'themingisprose' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_license'	=> array(
			'value'			=> 'page_license',
			'label'			=> __( 'Page License', 'themingisprose' ),
			'public_label'	=> __( 'License', 'themingisprose' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_privacy'	=> array(
			'value'			=> 'page_privacy',
			'label'			=> __( 'Page Privacy', 'themingisprose' ),
			'public_label'	=> __( 'Privacy', 'themingisprose' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
	);
	return apply_filters( 'themingisprose_admin_filter_custom_pages', $custom_pages );
}

/**
 * Render Custom Pages panel
 *
 * @since Theming is Prose 1.0
 */
function themingisprose_setting_fields_custom_pages(){
	global $t_em;

	foreach ( themingisprose_custom_pages() as $page ) :
?>
	<div class="text-option custom-pages">
		<label class="">
			<span><?php echo $page['label']; ?></span>
			<select name="t_em_theme_options[<?php echo $page['value'] ?>]">
				<option value="0"><?php _e( '&mdash; Select &mdash;', 'themingisprose' ); ?></option>
				<?php foreach ( themingisprose_list_pages( $page['type'] ) as $list ) :
				?>
					<?php $selected = selected( $t_em[$page['value']], $list->ID, false ); ?>
					<option value="<?php echo $list->ID ?>" <?php echo $selected; ?>><?php echo $list->post_title ?></option>
				<?php endforeach; ?>
			</select>
		</label>
		<?php if ( $t_em[$page['value']] ) : ?>
			<div class="row-action">
				<span class="edit"><a href="<?php echo get_edit_post_link( $t_em[$page['value']] ) ?>"><?php _e( 'Edit', 'themingisprose' ) ?></a> | </span>
				<span class="view"><a href="<?php echo get_permalink( $t_em[$page['value']] ) ?>"><?php _e( 'View', 'themingisprose' ) ?></a></span>
			</div>
		<?php endif; ?>
	</div>
<?php
	endforeach;
}
?>
