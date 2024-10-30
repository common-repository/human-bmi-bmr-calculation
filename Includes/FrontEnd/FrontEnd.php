<?php

class FrontEnd {
    public function __construct() {
        /**
         * Front Assets Load
         */
        require_once Hbmibmrc_ROOT_PATH . 'Includes/FrontEnd/Assets/FrontendAssets.php';
        new FrontendAssets();
        /**
         * Front ShortCode Load
         */
        require_once Hbmibmrc_ROOT_PATH . 'Includes/FrontEnd/ShortCode/ShortCode.php';
        new ShortCode();
    }
}