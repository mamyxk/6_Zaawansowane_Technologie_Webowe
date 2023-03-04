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

    echo "Hell world";
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