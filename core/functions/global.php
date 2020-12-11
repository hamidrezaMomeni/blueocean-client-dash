<?php
if (!defined('ABSPATH')) exit; // No direct access allowed

function get_option_blue_ocean_cd($name)
{
    $options = get_option('blue_ocean_cd'); // unique id of the framework

    if (isset($options[$name]))
        return $options[$name];

    return '';
}

function url_blue_ocean_cd($dir)
{
    return plugins_url($dir, BLUE_OCEAN_CD_FILE);
}
