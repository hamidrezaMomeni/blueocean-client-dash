<?php


namespace wp_panel;

if (!defined('ABSPATH')) exit; // No direct access allowed

class Router
{

    public function index($pagename)
    {
        $list = [];

        $list = apply_filters('wp_panel_router', $list);
        /*[
            'index' => [
                'include' => 'path php',
                'auth' => true,
                'title' => 'test title',
                'css' => [
                    'url',
                    'url2',
                ],
                'js' => [
                    'url',
                    'url2',
                ],
            ]
        ];*/
        if (!isset($list[$pagename]))
            return $this->NotFound();

        $page = $list[$pagename];

        if (isset($page['auth']) && $page['auth'] && is_user_logged_in())
            return $this->dashboard($page);


        return $this->login($page);
    }

    public function NotFound()
    {
        return include(plugin_dir_path(WP_PANEL_FILE) . '/core/template/global/404/404.php');
    }
}
