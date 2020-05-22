<?php
/* Plugin Name:       WP Verify API
* Plugin URI:         https://github.com/anorouzii/wp-verify-api
* Description:        Generate and check verification code by WP API
 * Version:           1.0.0
 * Author:            Ali Norouzi
 * Author URI:        https://github.com/anorouzii
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-verify-api
 * Domain Path:       /wp-verify-api
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

// Admin Setting
require_once ('admin/settings.php');

// Functionality
require_once('inc/send-email.php');
require_once ('inc/generate-code.php');
require_once ('inc/verify-sent-code.php');


/// Api Route
require_once('api/api.php');

// Create essential tables when the plugin activated.

function wp_verify_api_tables() {
    global $wpdb;
    global $wp_verify_api_version;
    $table_name = $wpdb->prefix . 'wp_verify_api';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		email text NOT NULL,
		OTPcode tinytext NOT NULL,
		expire text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'wp_verify_api_tables' );
