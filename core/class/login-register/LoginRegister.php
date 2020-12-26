<?php


namespace BlueOceanClientDash;

if (!defined('ABSPATH')) exit; // No direct access allowed

class LoginRegister
{

    static function init()
    {
        // includes files
        static::includes();

    }

    static private function includes()
    {

        $includes = [
            'core/class/login-register/Login.php',
        ];

        foreach ($includes as $include)
            include(plugin_dir_path(BLUE_OCEAN_CD_FILE) . $include);

    }
}

LoginRegister::init();
