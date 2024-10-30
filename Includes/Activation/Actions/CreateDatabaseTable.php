<?php
class CreateDatabaseTable {
    public function __construct() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name      = $wpdb->prefix . 'bmi_bmr_result';
        $schema          = "
                            CREATE TABLE IF NOT EXISTS $table_name (
                                `id` INT(255) unsigned NOT NULL AUTO_INCREMENT,
                                `patient_name` VARCHAR(255) NOT NULL,
                                `patient_gender` VARCHAR(255) NOT NULL,
                                `patient_age` INT(255) NOT NULL,
                                `patient_height` VARCHAR(255) NOT NULL,
                                `patient_weight` VARCHAR(255) NOT NULL,
                                `patient_bmi` VARCHAR(255) NOT NULL,
                                `patient_bmr` VARCHAR(255) NOT NULL,
                                `patient_condition` VARCHAR(255) NOT NULL,
                                `patient_date` VARCHAR(255) NOT NULL,
                                PRIMARY KEY (`id`)
                            );
                        ";

        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }
        dbDelta( $schema );
    }
}
