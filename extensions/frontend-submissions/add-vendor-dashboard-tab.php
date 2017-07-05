<?php
/*
 * Plugin Name: Easy Digital Downloads - Add FES Vendor Dashboard Tab
 * Description: Add a new tab to the Frontend Submissions vendor dashboard menu.
 * Author: EDD Team
 * Version: 1.0
 */

/*
 * Replace ALL instances of tab_name with a unique ID for your tab. For example,
 * if you're adding a Tax Form to your vendor dashboard, an appropriate ID would
 * be tax_form.
 */

// add the tab item itself
function custom_vendor_dashboard_menu( $menu_items ) {
	$menu_items['tab_name'] = array(
		"icon" => "earnings",
		"task" => array( 'tab_name' ),
		"name" => __( 'Tab Name', 'edd_fes' ), // the text that appears on the tab
	);
	return $menu_items;
}
add_filter( 'fes_vendor_dashboard_menu', 'custom_vendor_dashboard_menu' );

// make the new tab work
function custom_task_response( $custom, $task ) {
	if ( $task == 'tab_name' ) {
		$custom = 'tab_name';
	}
	return $custom;
}
add_filter( 'fes_signal_custom_task', 'custom_task_response', 10, 2 );

// the content associated with your new tab
function custom_tab_name_tab_content() {
	?>
	<p>Your content here.</p>
	<?php
}
add_action( 'fes_custom_task_tab_name','custom_tab_name_tab_content' );