<?php
if (!defined('ABSPATH')) exit; // No direct access allowed

function get_option_wp_panel($name)
{
    $options = get_option('wp_panel'); // unique id of the framework

    if (isset($options[$name]))
        return $options[$name];

    return '';
}

function url_wp_panel($dir)
{
    return plugins_url($dir, WP_PANEL_FILE);
}
