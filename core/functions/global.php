<?php
if (!defined('ABSPATH')) exit; // No direct access allowed

function get_option_bo_client_dash($name)
{
    $options = get_option('bo_client_dash'); // unique id of the framework

    if (isset($options[$name]))
        return $options[$name];

    return '';
}

function url_bo_client_dash($dir)
{
    return plugins_url($dir, BO_CLIENT_DASH_FILE);
}
