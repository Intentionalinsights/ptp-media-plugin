<?php

/**
 * Defines the dbDelta function used below
 */
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

function activate_ptp_media_plugin() {

    global $wpdb;
    global $mediaTable;

    $charset_collate = $wpdb->get_charset_collate();

    $query = "CREATE TABLE IF NOT EXISTS $mediaTable (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NULL,
        `url` varchar(255) NULL,
        `active` bool NULL,
        
        `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `edited` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
        ) $charset_collate;
    ";

    dbDelta($query);

}
