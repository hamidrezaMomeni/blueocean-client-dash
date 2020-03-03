<?php


namespace wp_panel;

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
        add_action('plugins_loaded', 'wp_panel\Autoload::language');
        add_action('admin_enqueue_scripts', 'wp_panel\Autoload::admin_enqueue', 20, 1);
        add_action('admin_menu', 'wp_panel\Autoload::menu_pages');

    }

    /**
     * Install Language
     */
    static function language()
    {
        load_plugin_textdomain('WP_PANEL', false, dirname(plugin_basename(WP_PANEL_FILE)) . '/languages');
    }

    /**
     * Install Admin Style And Script
     */
    static function admin_enqueue()
    {
        // Set Info Plugin
        $plugin_info = get_plugin_data(WP_PANEL_FILE);

        /**
         * Add Style Admin
         */
        wp_enqueue_style('WP_PANEL', plugins_url('assets/css/admin/core.css', WP_PANEL_FILE), array(), $plugin_info['Version']);

    }

    /**
     * Install Menu Page
     */
    static function menu_pages()
    {
        add_menu_page(__('Wp Panel', 'WP_PANEL'), __('Wp Panel', 'WP_PANEL'), 'manage_options', 'wp-panel', 'my_menu_output', plugins_url('assets/images/icon.svg', WP_PANEL_FILE), 76);
    }

}
