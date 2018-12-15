<?php

namespace PTP\Media;


class Plugin
{
    private $pluginName;

    private $pluginFile;

    private $wpdb;

    private $mediaTable;

    private $adminController;

    public function __construct($pluginName, $pluginFile, $wpdb, $mediaTable, $adminController)
    {
        $this->pluginName      = $pluginName;
        $this->pluginFile      = $pluginFile;
        $this->wpdb            = $wpdb;
        $this->mediaTable      = $mediaTable;
        $this->adminController = $adminController;
    }

    public function register()
    {
        \add_action('admin_enqueue_scripts', [$this, 'enqueueAdmin']);
        \add_action('admin_menu',            [$this, 'adminMenu']);
        //\add_filter('plugin_action_links_' . $this->pluginName, [$this, 'settingsLink']);
    }

    /**
     * Load css/js for admin pages
     */
    public function enqueueAdmin()
    {
        \wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');

        \wp_enqueue_style('mediaAdminStyle',   \plugins_url('/assets/admin.css', $this->pluginFile));
        \wp_enqueue_script('mediaAdminScript', \plugins_url('/assets/admin.js',  $this->pluginFile));
    }

    /**
     * Adds entries to WP admin menu
     */
    public function adminMenu()
    {
        \add_menu_page('PTP Media', 'PTP Media', 'manage_options', 'ptp_media', $this->adminController, 'dashicons-format-gallery', 110);
    }

    /**
     * Runs when plugin is activated
     */
    public function activate()
    {
        $charset_collate = $this->wpdb->get_charset_collate();

        $query = "CREATE TABLE IF NOT EXISTS {$this->mediaTable} (
        `id`          mediumint(9) NOT NULL AUTO_INCREMENT,
        `title`       varchar(255)     NULL,
        `url`         varchar(255)     NULL,
        `date`        DATE             NULL,
        `active`      bool             NULL,
        `description` text,
        `image_url`   varchar(255),
        
        `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `edited`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
        ) $charset_collate;
    ";

        $this->wpdb->query($query);
    }

    /**
     * Runs when plugin is deactivated
     */
    public function deactivate()
    {
        // return;

        $query = "DROP TABLE IF EXISTS {$this->mediaTable}";

        $this->wpdb->query($query);
    }
}
