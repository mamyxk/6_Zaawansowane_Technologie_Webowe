<?php

/**
 * Plugin Name: PlguinForAds
 */

// register_activation_hook(__FILE__,'plugin_activate');
// register_deactivation_hook( __FILE__, 'plugin_deactivate' );

global $jal_db_version;
$jal_db_version = '1.0';

register_activation_hook(__FILE__,'jal_install');



add_filter( 'the_content', 'add_content_to_post' );
add_action( 'admin_menu', 'option_admin_page' );
function add_content_to_post( $content ) {
if (is_main_query() AND is_single()){
        $content = get_random_ad() . $content;
    }  
    
 
    return $content;
}


// add_action( 'admin_init', 'option_admin_page' );

function get_random_ad(){
    return "<div>Tekst 123</div>";
}

function option_admin_page() { 

	add_options_page( 'PlguinForAds','PlguinForAds', 'manage_options', 'menu_plugin_for_ads','menu_plugin_for_ads_cb' );

}

function menu_plugin_for_ads_cb(){

    global $_POST;

	// if(isset($_POST['form_do_change'])){
	// 	if($_POST['form_do_change'] == 'Y'){
	// 		$formName = $_POST['name'];
	// 		$formContent = $_POST['content'];
	// 		$formTimeStart = $_POST['time_start'];
	// 		$formTimeEnd = $_POST['time_end'];
	// 		$formActiveHoursStart = $_POST['active_hours_start'];
	// 		$formActiveHoursStop = $_POST['active_hours_start'];
	// 		if($_POST['active']) $formActive = TRUE;
	// 		else $formActive = FALSE;

	// 		echo '<div class="notice notice-success isdismissible">
	// 		<p>Advertisment saved.</p>
	// 		</div>';
			
	// 		update_option('name', $formName);
	// 		update_option('content', $formContent);
	// 		update_option('time_start', $formTimeStart);
	// 		update_option('time_end', $formTimeEnd);
	// 		update_option('active_hours_start', $formActiveHoursStart);
	// 		update_option('active_hours_stop', $formActiveHoursStop);
	// 		update_option('active', $formActive);
	// 	}
	// }
?>
	<!DOCTYPE html>
	<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="form.css">
	</head>
	<body>
		<div class="container">
			<h2>Add New Advertisement</h2>
			<form>
				<input type="hidden" name="form_do_change" value="Y">
				<div class="row">
					<div class="col-25">
						<label for="name">Name:</label>
					</div>
					<div class="col-75">
						<input type="text" id="name" name="name" placeholder="Name of advertisment">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="content">Content:</label>
					</div>
					<div class="col-75">
						<textarea rows="4" cols="50" id="content" name="content" placeholder="Content of advertisment"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="time_start">Start date:</label>
						<input type="date" id="time_start" name="time_start" min="2023-01-03">
					</div>
					<div class="col-75">
						<label for="time_end">End date:</label>
						<input type="date" id="time_end" name="time_end" min="2023-01-01">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="active_hours_start">Start time:</label>
						<input type="time" id="active_hours_start" name="active_hours_start">
					</div>
					<div class="col-75">
						<label for="active_hours_stop">End time:</label>
						<input type="time" id="active_hours_stop" name="active_hours_stop">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<input type="radio" id="active" name="active" value="Active" checked>
						<label for="active">Active</label>
						<input type="radio" id="inactive" name="active" value="Inactive">
						<label for="inactive">Inactive</label>
					</div>
				</div>
				<div class="row">
					<input type="submit" value="Add">
				</div>
			</form>
		</div>
	</body>
	</html>
<?php
}

function jal_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'ad_plugin';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
		time_start datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        time_end datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        active_hours_start time,
        active_hours_stop time,
        active BOOLEAN DEFAULT FALSE NOT NULL,
		content text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	// add_option( 'jal_db_version', $jal_db_version );
}
?>