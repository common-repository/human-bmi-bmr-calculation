<?php
class FrontendAssets {

    function __construct() {
        require_once Hbmibmrc_ROOT_PATH . 'Includes/FrontEnd/Assets/Load/CSS.php';
        require_once Hbmibmrc_ROOT_PATH . 'Includes/FrontEnd/Assets/Load/JS.php';
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

        add_action( 'wp_enqueue_scripts', [$this, 'FrontEnd_Default_Assets'] );
    }

    function FrontEnd_Default_Assets() {
        /**
         * All Frontend Default CSS Load
         * @return css url
         * @todo
         */
        $styles = Get_Frontend_Css();
        foreach ( $styles as $handle => $style ) {
            $dependencies = isset( $style['deps'] ) ? $style['deps'] : false;
            if ( $style['is_wp_enqueue_scripts'] ) {
                /**
                 * Register CSS
                 * @return
                 * @todo
                 */
                wp_register_style( $handle, $style['src'], $dependencies, $style['version'], $style['media'] );
                /**
                 * Enqueue CSS
                 * @return
                 * @todo
                 */
                if ( $style['is_enqueue_here'] ) {
                    wp_enqueue_style( $handle );
                }
            }
        }
        /**
         * All Frontend Default JS Load
         * @return js url
         * @todo
         */
        $scripts = Get_Frontend_Js();
        foreach ( $scripts as $handle => $script ) {
            $dependencies = isset( $script['deps'] ) ? $script['deps'] : false;
            if ( $script['is_wp_enqueue_scripts'] ) {
                /**
                 * Register JS
                 * @return
                 * @todo
                 */
                wp_register_script( $handle, $script['src'], $dependencies, $script['version'], $script['is_footer'] );
                /**
                 * Enqueue JS
                 * @return
                 * @todo
                 */
                if ( $script['is_enqueue_here'] ) {
                    wp_enqueue_script( $handle );
                }
            }
        }
    }
}
