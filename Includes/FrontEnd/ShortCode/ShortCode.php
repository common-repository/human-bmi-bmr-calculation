<?php
class ShortCode {
    function __construct() {
        require_once Hbmibmrc_ROOT_PATH . 'Includes/FrontEnd/ShortCode/Bmi_Bmr/Bmi_Bmr.php';
        new Bmi_Bmr();
    }
}
