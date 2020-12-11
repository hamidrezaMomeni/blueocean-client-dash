<?php


namespace BlueOceanClientDash;

if (!defined('ABSPATH')) exit; // No direct access allowed

use CSF;

class Admin
{
    public static $prefix = 'bo_client_dash';

    static function set_plugin_info()
    {
        CSF::createOptions(static::$prefix, array(
            'menu_title' => __('Client Dash', 'BLUE_OCEAN_CD'),
            'framework_title' => "<img src='" . plugins_url('assets/images/logo.svg', BLUE_OCEAN_CD_FILE) . "' alt=''/>" . __('Client Dash', 'BLUE_OCEAN_CD'),
            'menu_slug' => static::$prefix,
            'menu_icon' => plugins_url('assets/images/icon.svg', BLUE_OCEAN_CD_FILE),
            'show_bar_menu' => false,
            'theme' => 'light',
            'class' => 'wp-panel'
        ));

        // Load Section Panel Admin
        static::createSection();

    }

    public static function alert($msg, $type = 'error')
    {
        ?>
        <div class="notice notice-<?= $type ?> is-dismissible" style="display: block!important">
            <p><?= $msg ?></p>
        </div>
        <?php
    }

    static function admin_enqueue()
    {
        // Set Info Plugin
        $plugin_info = get_plugin_data(BLUE_OCEAN_CD_FILE);

        /**
         * Add Style Admin
         */
        wp_enqueue_style('wp-panel', plugins_url('assets/css/admin/core.css', BLUE_OCEAN_CD_FILE), [], $plugin_info['Version']);

        /**
         * Add javascript Admin
         */
        wp_enqueue_script('wp-panel-js', plugins_url('/assets/js/admin.js', BLUE_OCEAN_CD_FILE), [], $plugin_info['Version']);

    }

    static function admin_page()
    {
        // load CSF
        include(plugin_dir_path(BLUE_OCEAN_CD_FILE) . '/lib/codestar-framework/classes/setup.class.php');

        // Control core classes for avoid errors
        if (!class_exists('CSF')) {
            add_action('admin_notices', function () {
                static::alert(__('ERROR CLASS EXIST CSF', 'BLUE_OCEAN_CD'));
            });
            return;
        }


        // Set Admin Option
        static::set_plugin_info();
    }

    static function createSection()
    {
        $sections = [
            'basic' => [
                'title' => __('Basic Settings', 'BLUE_OCEAN_CD'),
                'menu_hidden' => true,
                'fields' => array(
                    // slug
                    array(
                        'id' => 'slug',
                        'type' => 'text',
                        'title' => __('Client Dash Address', 'BLUE_OCEAN_CD'),
                        'placeholder' => __('Client Dash Address', 'BLUE_OCEAN_CD'),
                        'default' => 'panel',
                    ),
                )
            ],
            'other' => [
                'title' => __('Other Settings', 'BLUE_OCEAN_CD'),
                'menu_hidden' => true,
                'fields' => array(
                    // slug
                    array(
                        'id' => 'slug',
                        'type' => 'text',
                        'title' => __('Client Dash Address', 'BLUE_OCEAN_CD'),
                        'placeholder' => __('Client Dash Address', 'BLUE_OCEAN_CD'),
                        'default' => 'panel',
                    ),
                )
            ]
        ];

        $sections = apply_filters('blue_ocean_cd_admin_section', $sections);

        foreach ($sections as $section)
            CSF::createSection(static::$prefix, $section);

    }
}
