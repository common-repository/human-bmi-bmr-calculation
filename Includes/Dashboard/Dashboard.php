<?php
class Dashboard {
    function __construct() {
        // new DashboardAssets();
        require_once Hbmibmrc_ROOT_PATH . 'Includes/Dashboard/Menu/Menu.php';
        new Menu();
    }
}
