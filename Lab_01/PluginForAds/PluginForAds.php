<?php

/**
 * Plugin Name: PlguinForAds
 */

// register_activation_hook(__FILE__,'plugin_activate');
// register_deactivation_hook( __FILE__, 'plugin_deactivate' );

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
	$res = '';
	global $wpdb;
	$table_name = $wpdb->prefix . "ad_plugin";
	$all_adver = $wpdb->get_results("SELECT * FROM $table_name 
	WHERE active = true 
	AND current_time BETWEEN active_hours_start AND active_hours_stop 
	AND current_date BETWEEN time_start AND time_end");
	if (count($all_adver) > 0) {
		$rand_index = array_rand($all_adver, 1);
		$rand_ad = $all_adver[$rand_index];
		$res = '<div><p>' . $rand_ad->content . '</p></div>';
	}
	return $res;
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
	$val_active_checked = 'checked';
	$val_inactive_checked = '';
	$title_type = 'Add New Advertisement';
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
		if (!$val_is_active) {
			$val_inactive_checked = 'checked';
			$val_active_checked = '';
		}
		$title_type = 'Edit Advertisment';

		$form_type = '<input type="hidden" name="action" value="add_mod_advertisment" />
	<input type="hidden" name="action_type" value="mod" />
	<input type="hidden" name="mod_id" value="' . $mod_id . '">
	<input type="submit" name="mod_advertisment" value="Edit">';
	}



	$res = '';

	$res = '
	<div class="container">
		<div class="row">
			<form method="post">
				<input type="hidden" name="back" value="back_to_main"/>
				<input type="submit" class="back-button" name="back_btn" value="&laquo;  Back"/>
			</form>
		</div>
		<h2>' . $title_type . '</h2>
		<form method="post">
			<input type="hidden" name="form_do_change" value="Y">
			<div class="row">
				<div class="col-25">
					<label for="name">Name:</label>
				</div>
				<div class="col-75">
					<input type="text" id="name" name="name" placeholder="Name of advertisment" value="' . $val_name . '" required>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="content">Content:</label>
				</div>
				<div class="col-75">
					<textarea rows="4" cols="50" id="content" name="content" placeholder="Content of advertisment" required>' . $val_content . '</textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="time_start">Start date:</label>
				</div>
				<div class="col-75">
					<input type="date" id="time_start" name="time_start" min="2023-01-03"  value="' . $val_start_date . '" required>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="time_end">End date:</label>
				</div>
				<div class="col-75">
					<input type="date" id="time_end" name="time_end" min="2023-01-01"  value="' . $val_end_date . '" required>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="active_hours_start">Start time:</label>
				</div>
				<div class="col-75">
					<input type="time" id="active_hours_start" name="active_hours_start"  value="' . $val_start_time . '" required>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="active_hours_stop">End time:</label>
				</div>
				<div class="col-75">
					<input type="time" id="active_hours_stop" name="active_hours_stop"  value="' . $val_end_time . '" required>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
				
				</div>
				<div class="col-75">
					<input type="radio" id="active" name="active" value="Active" ' . $val_active_checked . '>
					<label for="active">Active</label>
					<input type="radio" id="inactive" name="active" value="Inactive" ' . $val_inactive_checked . '>
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

		$formName = $_POST['name'];
		$formContent = $_POST['content'];
		$formTimeStart = $_POST['time_start'];
		$formTimeEnd = $_POST['time_end'];
		$formActiveHoursStart = $_POST['active_hours_start'];
		$formActiveHoursStop = $_POST['active_hours_stop'];
		if ($_POST['active'] == 'Active') $formActive = TRUE;
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
	}

	if (isset($_POST['mod_advertisment'])) {

		$formName = $_POST['name'];
		$formContent = $_POST['content'];
		$formTimeStart = $_POST['time_start'];
		$formTimeEnd = $_POST['time_end'];
		$formActiveHoursStart = $_POST['active_hours_start'];
		$formActiveHoursStop = $_POST['active_hours_stop'];
		$mod_id = $_POST['mod_id'];
		if ($_POST['active'] == 'Active') $formActive = TRUE;
		else $formActive = FALSE;

		global $wpdb;
		echo $mod_id;
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
				'id' => $mod_id
			]

		);
	}
}

function render_list_of_advertisments()
{
	global $wpdb;
	$table_name = $wpdb->prefix . "ad_plugin";
	$all_adver = $wpdb->get_results("SELECT * FROM $table_name");
	echo '
	<div class="container">
		<div class="row">
			<form method="post">
				<input type="hidden" name="page" value="menu_plugin_for_ads" /> 
				<input type="submit" class="add-new-btn" name="add" value="Add new advertisment"/>	
			</form>
		</div>	
		<div class="row">
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Active Start Time</th>
						<th>Active End Time</th>
						<th>Is Active?</th>
						<th></th>
					</tr>
				</thead>';

	foreach ($all_adver as $adver) {

		echo '
		<tr>
            <td>' . $adver->name . '</td>
            <td>' . $adver->time_start . '</td>
            <td>' . $adver->time_end . '</td>
            <td>' . $adver->active_hours_start . '</td>
            <td>' . $adver->active_hours_stop . '</td>
            <td>' . $adver->active . '</td>
            <td>
				<form method="post">
					<input type="hidden" name="mod_del_id" value="' . $adver->id . '" /> 
					<input type="submit" class="delete-btn" name="delete" value="Delete"/>
					<input type="submit" class="edit-btn" name="edit" value="Edit"/>
				</form>
            </td>
        </tr>';
	}
	echo '
		</table>
	</div>';
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

	hadnle_add_mod_advertisment();

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
	wp_register_style('form_styles', plugins_url('/css/style.css', __FILE__));
	wp_enqueue_style('form_styles');
}

add_action('init', 'ad_register_styles');

function jal_install()
{
	global $wpdb;

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
}
