<?php

/**
 * Plugin Name:  Castlegate IT WP Disable Metabox Sort
 * Plugin URI:   https://github.com/castlegateit/cgit-wp-disable-metabox-sort
 * Description:  Disable metabox sorting.
 * Version:      1.0.0
 * Requires PHP: 8.2
 * Author:       Castlegate IT
 * Author URI:   https://www.castlegateit.co.uk/
 * License:      MIT
 * Update URI:   https://github.com/castlegateit/cgit-wp-disable-metabox-sort
 */

if (!defined('ABSPATH')) {
    wp_die('Access denied');
}

define('CGIT_WP_DISABLE_METABOX_SORT_VERSION', '1.0.0');
define('CGIT_WP_DISABLE_METABOX_SORT_PLUGIN_FILE', __FILE__);
define('CGIT_WP_DISABLE_METABOX_SORT_PLUGIN_DIR', __DIR__);

add_action('admin_enqueue_scripts', function () {
    wp_deregister_script('postbox');
});

add_action('admin_head', function () {
    ?>
    <style>
        .postbox .hndle {
            cursor: inherit !important;
        }

        .postbox .handle-actions {
            display: none !important;
        }
    </style>
    <?php
});

register_activation_hook(__FILE__, function () {
    global $wpdb;

    $wpdb->query($wpdb->prepare(
        'DELETE FROM %i WHERE meta_key LIKE "meta-box%%"',
        $wpdb->usermeta
    ));
});
