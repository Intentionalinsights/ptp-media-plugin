<?php
/**
 * Plugin Name: Pro-Truth Pledge Media
 * Description: Manage and display media entries
 *   Shortcode [ptp_media] will display media entries
 *   Shortcode [ptp_media_manage] will display media management features
 * Version: 1.0
 * Author: Noah Heck
 */

global $wpdb;
global $mediaTable;

$mediaTable = $wpdb->prefix . "ptp_media";

foreach (glob(__DIR__ . "/classes/*.php") as $file) {
    include_once($file);
}

foreach (glob(__DIR__ . "/functions/*.php") as $file) {
    include_once($file);
}

foreach (glob(__DIR__ . "/shortcodes/*.php") as $file) {
    include_once($file);
}



/**
 * Function to run when plugin is activated from plugins control panel
 */
register_activation_hook( __FILE__, 'activate_ptp_media_plugin' );
