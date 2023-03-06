<?php

/**
 * Plugin Name: PlguinForAds
 */

// register_activation_hook(__FILE__,'plugin_activate');
// register_deactivation_hook( __FILE__, 'plugin_deactivate' );

global $jal_db_version;
$jal_db_version = '1.0';

register_activation_hook(__FILE__, 'jal_install');


// Add advertisment to post
add_filter('the_content', 'add_content_to_post');
function add_content_to_post($content)
{
	if (is_main_query() and is_single()) {
		$content = get_random_ad() . $content;
	}

	return $content;
}

function get_random_ad()
{
	return "<div>Tekst 123</div>";
}

// Add plugin admin page 
add_action('admin_menu', 'option_admin_page');
function option_admin_page()
{
	add_menu_page('PlguinForAds', 'PlguinForAds', 'manage_options', 'menu_plugin_for_ads', 'menu_plugin_for_ads_cb');
}

// Add button to add advertisment
function navigation_view()
{
	$res = '<form method="post">
	<input type="hidden" name="page" value="menu_plugin_for_ads" /> 
	<input type="submit" name="add_mod" value="Add new advertisment"/>	
			</form>';
	// $res = '<a ></a>';
	return $res;
}

function add_mod_advertisment_form()
{
	$val_name = '';
	$val_content = '';
	$val_start_date = '';
	$val_end_date = '';
	$val_start_time = '';
	$val_end_time = '';
	$val_is_active = '';
	$form_type = '<input type="hidden" name="action" value="add_mod_advertisment" />
	<input type="hidden" name="action_type" value="add" />
	<input type="submit" name="add_new_advertisment" value="Add">';
	if (isset($_POST['mod_del_id'])) {
		global $wpdb;
		$table_name = $wpdb->prefix . "ad_plugin";
		$mod_id = $_POST['mod_del_id'];
		$advert = $wpdb->get_results("SELECT * FROM $table_name WHERE ID = " . $mod_id  . ";")[0];
		$val_name = $advert->name;
		$val_content = $advert->content;
		$val_start_date = $advert->time_start;
		$val_end_date = $advert->time_end;
		$val_start_time = $advert->active_hours_start;
		$val_end_time = $advert->active_hours_stop;
		$val_is_active = $advert->active;

		$form_type = '<input type="hidden" name="action" value="add_mod_advertisment" />
	<input type="hidden" name="action_type" value="mod" />
	<input type="hidden name="mod_id" value="'.$mod_id.'">
	<input type="submit" name="mod_advertisment" value="Edit">';
	}



	$res = '';

	$res = '<div class="container">
		<h2>Add New Advertisement</h2>
		<form method="post">
			<input type="hidden" name="form_do_change" value="Y">
			<div class="row">
				<div class="col-25">
					<label for="name">Name:</label>
				</div>
				<div class="col-75">
					<input type="text" id="name" name="name" placeholder="Name of advertisment" value="' . $val_name . '">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="content">Content:</label>
				</div>
				<div class="col-75">
					<textarea rows="4" cols="50" id="content" name="content" placeholder="Content of advertisment">' . $val_content . '</textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="time_start">Start date:</label>
					<input type="date" id="time_start" name="time_start" min="2023-01-03"  value="' . $val_start_date . '">
				</div>
				<div class="col-75">
					<label for="time_end">End date:</label>
					<input type="date" id="time_end" name="time_end" min="2023-01-01"  value="' . $val_end_date . '">
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="active_hours_start">Start time:</label>
					<input type="time" id="active_hours_start" name="active_hours_start"  value="' . $val_start_time . '">
				</div>
				<div class="col-75">
					<label for="active_hours_stop">End time:</label>
					<input type="time" id="active_hours_stop" name="active_hours_stop"  value="' . $val_end_time . '">
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
			<div class="row">' . $form_type . '
				
			</div>
		</form>
	</div>';



	return $res;
}

add_action('add_mod_advertisment', 'hadnle_add_mod_advertisment');
function hadnle_add_mod_advertisment()
{
	global $_POST;

	if (isset($_POST['add_new_advertisment'])) {
		// $name = $_POST['name'];
		// $content = $_POST['content'];
		// $time_start = $_POST['time_start'];
		// $time_end = $_POST['time_end'];
		// $active_hours_start = $_POST['active_hours_start'];
		// $active_hours_stop = $_POST['active_hours_stop'];
		// $active = $_POST['active'];
		// echo $name.' '.$content.' '.$time_start.' '.$time_end.' '.$active_hours_start.' '.$active_hours_stop.' '.$active.' ';

		$formName = $_POST['name'];
		$formContent = $_POST['content'];
		$formTimeStart = $_POST['time_start'];
		$formTimeEnd = $_POST['time_end'];
		$formActiveHoursStart = $_POST['active_hours_start'];
		$formActiveHoursStop = $_POST['active_hours_stop'];
		if ($_POST['active']) $formActive = TRUE;
		else $formActive = FALSE;

		global $wpdb;

		$wpdb->insert(
			$wpdb->prefix . 'ad_plugin',
			[
				'name' => $formName,
				'content' => $formContent,
				'time_start' => $formTimeStart,
				'time_end' => $formTimeEnd,
				'active_hours_start' => $formActiveHoursStart,
				'active_hours_stop' => $formActiveHoursStop,
				'active' => $formActive
			]

		);
		// wp_redirect($_SERVER['HTTP_REFERER']);
		// exit;
	}

	if (isset($_POST['mod_advertisment'])) {
		$formName = $_POST['name'];
		$formContent = $_POST['content'];
		$formTimeStart = $_POST['time_start'];
		$formTimeEnd = $_POST['time_end'];
		$formActiveHoursStart = $_POST['active_hours_start'];
		$formActiveHoursStop = $_POST['active_hours_stop'];
		$mod_id = $_POST['mod_id'];
		if ($_POST['active']) $formActive = TRUE;
		else $formActive = FALSE;

		global $wpdb;

		$wpdb->update(
			$wpdb->prefix . 'ad_plugin',
			[
				'name' => $formName,
				'content' => $formContent,
				'time_start' => $formTimeStart,
				'time_end' => $formTimeEnd,
				'active_hours_start' => $formActiveHoursStart,
				'active_hours_stop' => $formActiveHoursStop,
				'active' => $formActive
			],
			[
				'ID' => $mod_id
			]

		);
	}
}

function render_list_of_advertisments()
{
	global $wpdb;
	$table_name = $wpdb->prefix . "ad_plugin";
	$all_adver = $wpdb->get_results("SELECT * FROM $table_name");
	// if(isset($_POST['mod_del_id'])){
	// 	echo $_POST['mod_del_id'];
	// }
	echo '
	<form method="post">
	<input type="hidden" name="page" value="menu_plugin_for_ads" /> 
	<input type="submit" name="add" value="Add new advertisment"/>	
			</form>

<table>
    <tr>
        <th>Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Active Start Time</th>
        <th>Active End Time</th>
        <th>Is Active?</th>
        <th></th>
    </tr>
	';
	foreach ($all_adver as $adver) {

		echo '<tr>
            <td>' . $adver->name . '</td>
            <td>' . $adver->time_start . '</td>
            <td>' . $adver->time_end . '</td>
            <td>' . $adver->active_hours_start . '</td>
            <td>' . $adver->active_hours_stop . '</td>
            <td>' . $adver->active . '</td>
            <td>
				<form method="post">
					<input type="hidden" name="mod_del_id" value="' . $adver->id . '" /> 
					<input type="submit" name="edit" value="Edit">
					<input type="submit" name="delete" value="Delete">
				</form>
            </td>
        </tr>';
	}
	echo '</table>';
}

function delete_advertisment($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "ad_plugin";
	$wpdb->query('DELETE FROM ' . $table_name . ' WHERE ID = ' . $id . ';');
}

function menu_plugin_for_ads_cb()
{
	global $_POST;
	global $_SESSION;

	hadnle_add_mod_advertisment();

	// 0/null - view list of ads
	// 1 - add new ad
	// 2 - edit ad with id in $_POST

	// echo navigation_view();

	if (isset($_POST['add']) or isset($_POST['edit'])) {
		echo add_mod_advertisment_form();
	} else {
		if (isset($_POST['delete'])) {
			delete_advertisment($_POST['mod_del_id']);
		}
		render_list_of_advertisments();
	}
}

function ad_register_styles()
{
	wp_register_style('form_styles', plugins_url('/css/form.css', __FILE__));
	wp_enqueue_style('form_styles');
}

add_action('init', 'ad_register_styles');

function jal_install()
{
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'ad_plugin';

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
		time_start DATE DEFAULT '0000-00-00' NOT NULL,
        time_end DATE DEFAULT '0000-00-00' NOT NULL,
        active_hours_start time,
        active_hours_stop time,
        active BOOLEAN DEFAULT FALSE NOT NULL,
		content text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta($sql);

	// add_option( 'jal_db_version', $jal_db_version );
}


// function run_query($sql){
// 	global $wpdb;
// 	global $jal_db_version;

// 	$table_name = $wpdb->prefix . 'ad_plugin';

// 	$charset_collate = $wpdb->get_charset_collate();

// 	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
// 	dbDelta($sql);
// }