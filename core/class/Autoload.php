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
    protected static $prefix = 'wp_panel', $slug;

    static function init()
    {
        // includes files
        self::includes();

        add_action('plugins_loaded', 'wp_panel\Autoload::language');
        add_action('plugins_loaded', 'wp_panel\Autoload::admin_page');
        add_action('admin_enqueue_scripts', 'wp_panel\Autoload::admin_enqueue', 20, 1);
        add_action('init', 'wp_panel\Autoload::rewrite');
        add_action('parse_query', 'wp_panel\Autoload::rewrite_param');

        // set slug
        self::$slug = get_option_wp_panel('slug') == '' ? 'panel' : get_option_wp_panel('slug');

    }

    static private function includes()
    {
        // load global functions
        include(plugin_dir_path(WP_PANEL_FILE) . '/core/functions/global.php');

        // load Router
        include(plugin_dir_path(WP_PANEL_FILE) . '/core/class/Router.php');

    }

    static function language()
    {
        load_plugin_textdomain('WP_PANEL', false, dirname(plugin_basename(WP_PANEL_FILE)) . '/languages');
    }

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

        // Load Section Panel Admin
        Autoload::createSection();

    }

    static function createSection()
    {

        CSF::createSection(self::$prefix, array(
            'title' => __('Basic Settings', 'WP_PANEL'),
            'menu_hidden' => true,
            'fields' => array(
                // slug
                array(
                    'id' => 'slug',
                    'type' => 'text',
                    'title' => __('Wp Panel Address', 'WP_PANEL'),
                    'placeholder' => __('Wp Panel Address', 'WP_PANEL'),
                    'default' => 'panel',
                ),
            )
        ));
        CSF::createSection(self::$prefix, array(
            'title' => __('Other Settings', 'WP_PANEL'),
            'menu_hidden' => true,
            'fields' => array(
                // slug
                array(
                    'id' => 'slug',
                    'type' => 'text',
                    'title' => __('Wp Panel Address', 'WP_PANEL'),
                    'placeholder' => __('Wp Panel Address', 'WP_PANEL'),
                    'default' => 'panel',
                ),
            )
        ));
    }

    public static function alert($msg, $type = 'error')
    {
        ?>
        <div class="notice notice-<?= $type ?> is-dismissible" style="display: block!important">
            <p><?= $msg ?></p>
        </div>
        <?php
    }

    static function rewrite()
    {

        add_rewrite_tag('%' . 'param' . '%', '([^&]+)');
        add_rewrite_rule('^' . self::$slug . '/?$', 'index.php?param=' . self::$slug, 'top');
        add_rewrite_rule('^' . self::$slug . '/(.+)/?$', 'index.php?param=' . self::$slug . '&pagename=$matches[1]', 'top');
        flush_rewrite_rules();
    }

    static function rewrite_param()
    {
        if (false !== get_query_var('param') && get_query_var('param') == self::$slug) {
            (new Router())->index(get_query_var('pagename'));
            exit;
        }
    }
}
