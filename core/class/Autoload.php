<?php


namespace BlueOceanClientDash;

use CSF;

if (!defined('ABSPATH')) exit; // No direct access allowed

/**
 * Autoloader class.
 *
 * @since 1.0.0
 */
class Autoload
{
    protected static $prefix = 'bo_client_dash', $slug;

    static function init()
    {
        // includes files
        static::includes();

        add_action('plugins_loaded', 'BlueOceanClientDash\Autoload::language');
        add_action('plugins_loaded', 'BlueOceanClientDash\Autoload::admin_page');
        add_action('admin_enqueue_scripts', 'BlueOceanClientDash\Autoload::admin_enqueue', 20, 1);
        add_action('init', 'BlueOceanClientDash\Autoload::rewrite');
        add_action('parse_query', 'BlueOceanClientDash\Autoload::rewrite_param');

        // set slug
        static::$slug = get_option_bo_client_dash('slug') == '' ? 'panel' : get_option_bo_client_dash('slug');

    }

    static private function includes()
    {
        // load global functions
        include(plugin_dir_path(BO_CLIENT_DASH_FILE) . '/core/functions/global.php');

        // load Router
        include(plugin_dir_path(BO_CLIENT_DASH_FILE) . '/core/class/Router.php');

    }

    static function language()
    {
        load_plugin_textdomain('BO_CLIENT_DASH', false, dirname(plugin_basename(BO_CLIENT_DASH_FILE)) . '/languages');
    }

    static function admin_enqueue()
    {
        // Set Info Plugin
        $plugin_info = get_plugin_data(BO_CLIENT_DASH_FILE);

        /**
         * Add Style Admin
         */
        wp_enqueue_style('wp-panel', plugins_url('assets/css/admin/core.css', BO_CLIENT_DASH_FILE), array(), $plugin_info['Version']);

        /**
         * Add javascript Admin
         */
        wp_enqueue_script('wp-panel-js', plugins_url('/assets/js/admin.js', BO_CLIENT_DASH_FILE), [], $plugin_info['Version']);

    }

    static function admin_page()
    {
        // load CSF
        include(plugin_dir_path(BO_CLIENT_DASH_FILE) . '/lib/codestar-framework/classes/setup.class.php');

        // Control core classes for avoid errors
        if (!class_exists('CSF')) {
            add_action('admin_notices', function () {
                static::alert(__('ERROR CLASS EXIST CSF', 'BO_CLIENT_DASH'));
            });
            return;
        }


        // Set Admin Option
        static::set_plugin_info();
    }

    static function set_plugin_info()
    {
        CSF::createOptions(static::$prefix, array(
            'menu_title' => __('Wp Panel', 'BO_CLIENT_DASH'),
            'framework_title' => "<img src='" . plugins_url('assets/images/logo.svg', BO_CLIENT_DASH_FILE) . "' alt=''/>" . __('Wp Panel', 'BO_CLIENT_DASH'),
            'menu_slug' => static::$prefix,
            'menu_icon' => plugins_url('assets/images/icon.svg', BO_CLIENT_DASH_FILE),
            'show_bar_menu' => false,
            'theme' => 'light',
            'class' => 'wp-panel'
        ));

        // Load Section Panel Admin
        Autoload::createSection();

    }

    static function createSection()
    {

        CSF::createSection(static::$prefix, array(
            'title' => __('Basic Settings', 'BO_CLIENT_DASH'),
            'menu_hidden' => true,
            'fields' => array(
                // slug
                array(
                    'id' => 'slug',
                    'type' => 'text',
                    'title' => __('Wp Panel Address', 'BO_CLIENT_DASH'),
                    'placeholder' => __('Wp Panel Address', 'BO_CLIENT_DASH'),
                    'default' => 'panel',
                ),
            )
        ));
        CSF::createSection(static::$prefix, array(
            'title' => __('Other Settings', 'BO_CLIENT_DASH'),
            'menu_hidden' => true,
            'fields' => array(
                // slug
                array(
                    'id' => 'slug',
                    'type' => 'text',
                    'title' => __('Wp Panel Address', 'BO_CLIENT_DASH'),
                    'placeholder' => __('Wp Panel Address', 'BO_CLIENT_DASH'),
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
        add_rewrite_rule('^' . static::$slug . '/?$', 'index.php?param=' . static::$slug, 'top');
        add_rewrite_rule('^' . static::$slug . '/(.+)/?$', 'index.php?param=' . static::$slug . '&pagename=$matches[1]', 'top');
        flush_rewrite_rules();
    }

    static function rewrite_param()
    {
        if (false !== get_query_var('param') && get_query_var('param') == static::$slug) {
            (new Router())->index(get_query_var('pagename'));
            exit;
        }
    }
}
