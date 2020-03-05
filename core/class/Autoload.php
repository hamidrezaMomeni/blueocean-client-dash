<?php


namespace wp_panel;

use CSF;

if (!defined('ABSPATH')) exit; // No direct access allowed

/**
 * Autoloader class.
 *
 * @since 1.0.0
 */
class Autoload
{

    protected static $prefix = 'wp_panel';
    protected static $admin_page;


    static function init()
    {
        add_action('plugins_loaded', 'wp_panel\Autoload::language');
        add_action('plugins_loaded', 'wp_panel\Autoload::admin_page');
        add_action('admin_enqueue_scripts', 'wp_panel\Autoload::admin_enqueue', 20, 1);
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
        wp_enqueue_style('wp-panel', plugins_url('assets/css/admin/core.css', WP_PANEL_FILE), array(), $plugin_info['Version']);

        /**
         * Add javascript Admin
         */
        wp_enqueue_script('wp-panel-js', plugins_url('/assets/js/admin.js', WP_PANEL_FILE), [], $plugin_info['Version']);

    }

    /**
     * Install Admin Page by codestar
     */
    static function admin_page()
    {
        // load CSF
        include(plugin_dir_path(WP_PANEL_FILE) . '/lib/codestar-framework/classes/setup.class.php');

        // Control core classes for avoid errors
        if (!class_exists('CSF')) {
            add_action('admin_notices', function () {
                self::alert(__('ERROR CLASS EXIST CSF', 'WP_PANEL'));
            });
            return;
        }


        // Set Admin Option
        self::set_plugin_info();
    }

    static function change_copy_right_codestar()
    {
        return '';
    }

    static function set_plugin_info()
    {
        CSF::createOptions(self::$prefix, array(
            'menu_title' => __('Wp Panel', 'WP_PANEL'),
            'framework_title' => "<img src='" . plugins_url('assets/images/logo.svg', WP_PANEL_FILE) . "' alt=''/>" . __('Wp Panel', 'WP_PANEL'),
            'menu_slug' => self::$prefix,
            'menu_icon' => plugins_url('assets/images/icon.svg', WP_PANEL_FILE),
            'show_bar_menu' => false,
            'theme' => 'light',
            'class' => 'wp-panel'
        ));

        CSF::createSection(self::$prefix, array(
            'title' => __('Wp Panel', 'WP_PANEL'),
            'fields' => array()
        ));
    }

    /**
     * @param $msg
     * @param string $type
     */
    public static function alert($msg, $type = 'error')
    {
        ?>
        <div class="notice notice-<?= $type ?> is-dismissible" style="display: block!important">
            <p><?= $msg ?></p>
        </div>
        <?php
    }
}
