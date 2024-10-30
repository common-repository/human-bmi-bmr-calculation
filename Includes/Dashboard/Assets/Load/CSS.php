<?php

namespace Hbmibmrc\Dashboard\Assets\Load;

class CSS
{
    function __construct()
    {
        function Get_Dashboard_Css()
        {
            return [

                'Dashboard_MainCss' => [
                    'src'     => Hbmibmrc__ROOT_URL . 'assets/dashboard/main/css/style.css',
                    'deps' => array(),
                    'version' => Hbmibmrc__VERSION__,
                    'media' => 'all',
                    'is_admin_enqueue_scripts' => true,
                    'is_enqueue_here' => true,
                ],

            ];
        }
    }
}
