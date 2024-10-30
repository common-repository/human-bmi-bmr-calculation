<?php
class CSS {
    function __construct() {
        function Get_Frontend_Css() {
            return [
                'FrontEnd_Main_Css' => [
                    'src'                   => Hbmibmrc_ROOT_URL . 'assets/frontEnd/main/main.css',
                    'deps'                  => [],
                    'version'               => Hbmibmrc__VERSION__,
                    'media'                 => 'all',
                    'is_wp_enqueue_scripts' => true,
                    'is_enqueue_here'       => true,
                ],
            ];
        }
    }
}
