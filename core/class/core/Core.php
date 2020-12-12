<?php


namespace BlueOceanClientDash;

if (!defined('ABSPATH')) exit; // No direct access allowed


class Core
{
    static function language()
    {
        load_plugin_textdomain('BLUE_OCEAN_CD', false, dirname(plugin_basename(BLUE_OCEAN_CD_FILE)) . '/languages');
    }

    static function rewrite()
    {
        $slug = get_option_blue_ocean_cd('slug') == '' ? 'panel' : get_option_blue_ocean_cd('slug');

        add_rewrite_tag('%param%', '([^&]+)');
        add_rewrite_tag('%subparam%', '([^&]+)');
        add_rewrite_rule('^' . $slug . '/?$', 'index.php?param=' . $slug, 'top');
        add_rewrite_rule('^' . $slug . '/(.+)/?$', 'index.php?param=' . $slug . '&subparam=$matches[1]', 'top');
        flush_rewrite_rules();
    }

    static function rewrite_param()
    {
        $slug = get_option_blue_ocean_cd('slug') == '' ? 'panel' : get_option_blue_ocean_cd('slug');

        if (false !== get_query_var('param') && get_query_var('param') == $slug) {
            echo (new Router())->index(get_query_var('subparam'));
            exit;
        }
    }
}
