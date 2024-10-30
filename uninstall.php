<?php

/**
 * @author     khalifalmahmud
 * @package    human-bmi-bmr-calculation
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

class Hbmibmrc__Uninstall {
    public function Uninstall_Database_Table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'bmi_bmr_result';
        $sql        = 'DROP TABLE IF EXISTS ' . $table_name;
        $wpdb->query( $sql );
    }
}
$unintall = new Hbmibmrc__Uninstall();
$unintall->Uninstall_Database_Table();
