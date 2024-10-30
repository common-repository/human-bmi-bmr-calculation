<?php
class Menu {

    function __construct() {
        add_action( 'admin_menu', [$this, '_bmi_bmr_menu_page'] );
    }

    function _bmi_bmr_menu_page() {
        add_menu_page(
            'Human Bmi Bmr',
            'Bmi Bmr',
            'manage_options',
            '-human-bmi-bmr',
            '_bmi_bmr_menu_page_callback_function'
        );
        function _bmi_bmr_menu_page_callback_function() {
            $action = isset( $_GET['action'] ) ? trim( $_GET['action'] ) : '';
            $date   = isset( $_GET['date'] ) ? trim( $_GET['date'] ) : '';
            if ( 'view-all-patient' == $action ) {
                require_once Hbmibmrc_ROOT_PATH . 'Includes/Dashboard/Menu/views/bmi-bmr-result-list-from-db-date-details-view.php';
                ob_start();
                $bmi_bmr_form_templates = ob_get_contents();
                return $bmi_bmr_form_templates;
                ob_get_clean();
            } else {
                require_once Hbmibmrc_ROOT_PATH . 'Includes/Dashboard/Menu/views/bmi-bmr-result-list-from-db.php';
                ob_start();
                $bmi_bmr_form_templates = ob_get_contents();
                return $bmi_bmr_form_templates;
                ob_get_clean();
            }
        }

    }

}
