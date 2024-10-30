<?php

/**
 * Plugin Name:       Human Bmi Bmr Calculation
 * Plugin URI:        https://wordpress.org/plugins/human-bmi-bmr-calculation/
 * Description:       This Plugin Help Peoples to Calculate Their BMI BMR .
 * Version:           1.0
 * Author:            Khalif Al Mahmud
 * Author URI:        //khalifalmahmud.info
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Hbmibmrc
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

#Require Composer Here ...

final class Hbmibmrc__final_class {
    private function __construct() {
        $this->define_constants();
        register_activation_hook( __FILE__, [$this, 'activation'] );
        register_deactivation_hook( __FILE__, [$this, 'deactivation'] );
        add_action( 'plugins_loaded', [$this, 'plugin_init'] );
    }

    function define_constants() {
        $Hbmibmrc__plugin_data = get_file_data( __FILE__, ['version' => 'Version'], false );
        if (  ( $_SERVER['SERVER_ADDR'] == '::1' || $_SERVER['SERVER_ADDR'] == '127.0.0.1' ) ) {
            define( 'Hbmibmrc__VERSION__', time() );
        } else {
            define( 'Hbmibmrc__VERSION__', $Hbmibmrc__plugin_data['version'] );
        }
        define( 'Hbmibmrc_ROOT_URL', plugin_dir_url( __FILE__ ) );
        define( 'Hbmibmrc_ROOT_PATH', plugin_dir_path( __FILE__ ) );
    }

    function activation() {
        require_once Hbmibmrc_ROOT_PATH . 'Includes/Activation/Activation.php';
        new Activation();
    }

    function deactivation() {
        // new Deactivation();
    }

    function plugin_init() {
        load_plugin_textdomain( '', false, basename( dirname( __FILE__ ) ) . '/languages' );
        require_once Hbmibmrc_ROOT_PATH . 'Includes/Includes.php';
        new Includes();

    }

    public static function init() {
        static $instance = false;
        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }
}

function Hbmibmrc__main_function() {
    return Hbmibmrc__final_class::init();
}

Hbmibmrc__main_function();