<?php

namespace Hbmibmrc\Dashboard\Assets;

use Hbmibmrc\Dashboard\Assets\Load\CSS;
use Hbmibmrc\Dashboard\Assets\Load\JS;

use function Hbmibmrc\Dashboard\Assets\Load\Get_Dashboard_Css;
use function Hbmibmrc\Dashboard\Assets\Load\Get_Dashboard_Js;

class DashboardAssets
{

    function __construct()
    {
        /**
         * Get All CSS from Load Folder 
         * @return Initialization
         * @todo  
         */
        new CSS();
        /**
         * Get All JS from Load Folder 
         * @return Initialization
         * @todo  
         */
        new JS();

        add_action('admin_enqueue_scripts', [$this, 'Dashboard_Default_Assets']);
    }
    function Dashboard_Default_Assets()
    {
        /**
         * All Dashboard Default CSS Load 
         * @return css url 
         * @todo  
         */
        $styles  = Get_Dashboard_Css();
        foreach ($styles as $handle => $style) {
            $dependencies = isset($style['deps']) ? $style['deps'] : false;
            if ($style['is_admin_enqueue_scripts']) {
                /**
                 * Register CSS
                 * @return  
                 * @todo  
                 */
                wp_register_style($handle, $style['src'], $dependencies, $style['version'], $style['media']);
                /**
                 * Enqueue CSS 
                 * @return  
                 * @todo 
                 */
                if ($style['is_enqueue_here']) {
                    wp_enqueue_style($handle);
                }
            }
        }
        /**
         * All Dashboard Default JS Load 
         * @return js url 
         * @todo  
         */
        $scripts  = Get_Dashboard_Js();
        foreach ($scripts as $handle => $script) {
            $dependencies = isset($script['deps']) ? $script['deps'] : false;
            if ($script['is_admin_enqueue_scripts']) {
                /**
                 * Register JS
                 * @return  
                 * @todo  
                 */
                wp_register_script($handle, $script['src'], $dependencies, $script['version'], $script["is_footer"]);
                /**
                 * Enqueue JS 
                 * @return  
                 * @todo  
                 */
                if ($script['is_enqueue_here']) {
                    wp_enqueue_script($handle);
                }
            }
        }
    }
}
