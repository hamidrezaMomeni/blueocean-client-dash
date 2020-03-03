<?php
/**
 * Plugin Name: Wp Panel
 * Plugin URI: https://github.com/wp-panel/wp-panel-plugin
 * Description: wp panel wordpress
 * Version: 1.0
 * Author: wp-panel.com
 * Author URI: https://wp-panel.com
 * Text Domain: wp_panel
 * Domain Path: /languages
 * License: MIT
 * Requires PHP: 5.6
 **/
if (!defined('ABSPATH')) exit; // No direct access allowed

define('WP_PANEL_FILE', __FILE__);


/**
 * Load Core Class
 */
if (!class_exists('wp_panel\Autoload', false))
    include(plugin_dir_path(__FILE__) . '/core/class/Autoload.php');

wp_panel\Autoload::init();
