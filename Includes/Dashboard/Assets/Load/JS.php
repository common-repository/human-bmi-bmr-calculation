<?php

namespace Hbmibmrc\Dashboard\Assets\Load;

class JS
{
    function __construct()
    {
        function Get_Dashboard_Js()
        {
            return [

                'Dashboard_MainJs' => [
                    'src'     => Hbmibmrc__ROOT_URL . 'assets/dashboard/main/js/script.js',
                    'deps' => array(),
                    'version' => Hbmibmrc__VERSION__,
                    'is_footer' => 'true',
                    'is_admin_enqueue_scripts' => true,
                    'is_enqueue_here' => true,
                ],


            ];
        }
    }
}
