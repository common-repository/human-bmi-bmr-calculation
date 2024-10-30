<?php
class JS {
    function __construct() {
        function Get_Frontend_Js() {
            return [

                'FrontEnd_Main_Js' => [
                    'src'                   => Hbmibmrc_ROOT_URL . 'assets/frontEnd/main/main.js',
                    'deps'                  => [],
                    'version'               => Hbmibmrc__VERSION__,
                    'is_footer'             => 'true',
                    'is_wp_enqueue_scripts' => true,
                    'is_enqueue_here'       => true,
                ],

            ];
        }
    }
}
