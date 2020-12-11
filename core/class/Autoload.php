<?php


namespace BlueOceanClientDash;

if (!defined('ABSPATH')) exit; // No direct access allowed

/**
 * Autoloader class.
 *
 * @since 1.0.0
 */
class Autoload
{

    static function init()
    {
        // includes files
        static::includes();

        add_action('plugins_loaded', 'BlueOceanClientDash\Core::language');
        add_action('plugins_loaded', 'BlueOceanClientDash\Admin::admin_page');
        add_action('admin_enqueue_scripts', 'BlueOceanClientDash\Admin::admin_enqueue', 20, 1);
        add_action('init', 'BlueOceanClientDash\Core::rewrite');
        add_action('parse_query', 'BlueOceanClientDash\Core::rewrite_param');

    }

    static private function includes()
    {

        $includes = [
            '/core/functions/global.php',
            '/core/class/Core.php',
            '/core/class/Admin.php',
            '/core/class/Router.php',
        ];

        foreach ($includes as $include)
            include(plugin_dir_path(BLUE_OCEAN_CD_FILE) . $include);

    }
}
