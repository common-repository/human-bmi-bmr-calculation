<?php
class Includes {
    public function __construct() {
        if ( is_admin() ) {
            require_once Hbmibmrc_ROOT_PATH . 'Includes/Dashboard/Dashboard.php';
            new Dashboard();

        } else {
            require_once Hbmibmrc_ROOT_PATH . 'Includes/FrontEnd/FrontEnd.php';
            new FrontEnd();

        }
    }
}
