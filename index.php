<?php
/**
 * Plugin Name: BlueOcean Client Dash
 * Plugin URI: https://github.com/Blue-Ocean-Plus/blueocean-client-dash
 * Description: client dashboard wordpress
 * Version: 1.0
 * Author: blueocean.plus
 * Author URI: https://blueocean.plus
 * Text Domain: BLUE_OCEAN_CD
 * Domain Path: /languages
 * License: MIT
 * Requires PHP: 5.6
 **/
if (!defined('ABSPATH')) exit; // No direct access allowed

define('BLUE_OCEAN_CD_FILE', __FILE__);


/**
 * Load Core Class
 */
if (!class_exists('BlueOceanClientDash\Autoload', false))
    include(plugin_dir_path(__FILE__) . '/core/class/Autoload.php');

BlueOceanClientDash\Autoload::init();
