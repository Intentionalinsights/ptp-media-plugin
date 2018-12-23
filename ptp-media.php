<?php
/**
 * Plugin Name: Pro-Truth Pledge Media
 * Description: Manage and display media entries
 *   Shortcode [ptp_media] will display media entries
 *   Shortcode [ptp_media_latest] will display latest 4 media entries
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

/******************************************************/

$repository       = new \PTP\Media\Repository($wpdb, $mediaTable);

$adminController  = new \PTP\Media\AdminController($_GET, $_POST, $repository);

$publicController = new \PTP\Media\PublicController($_GET, $_POST, $repository);

$ptpMediaPlugin   = new \PTP\Media\Plugin(
                            plugin_basename(__FILE__),
                            __FILE__,
                            $wpdb,
                            $mediaTable,
                            $adminController,
                            $publicController
                        );

$ptpMediaPlugin->register();

/**
 * Function to run when plugin is activated from plugins control panel
 */
register_activation_hook( __FILE__,   [$ptpMediaPlugin, 'activate']);
register_deactivation_hook( __FILE__, [$ptpMediaPlugin, 'deactivate']);
