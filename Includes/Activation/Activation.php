<?php
class Activation {
    public function __construct() {
        require_once Hbmibmrc_ROOT_PATH . 'Includes/Activation/Actions/CreateDatabaseTable.php';
        new CreateDatabaseTable();
        require_once Hbmibmrc_ROOT_PATH . 'Includes/Activation/Actions/Mail_Me.php';
        new Mail_Me();
    }
}
