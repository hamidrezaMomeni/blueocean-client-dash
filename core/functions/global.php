<?php
if (!defined('ABSPATH')) exit; // No direct access allowed

function get_option_wp_panel($name)
{
    $options = get_option('wp_panel'); // unique id of the framework

    if (isset($options[$name]))
        return $options[$name];

    return '';
}
