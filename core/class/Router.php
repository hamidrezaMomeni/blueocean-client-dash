<?php


namespace wp_panel;

if (!defined('ABSPATH')) exit; // No direct access allowed

class Router
{

    public function index($pagename)
    {
        $list = [
            'login' => [
                'include' => plugin_dir_path(WP_PANEL_FILE) . '/core/template/login/page/login.php',
                'auth' => false,
                'title' => __('Login to User Area', 'wp_panel'),
            ],
            'index' => [
                'include' => plugin_dir_path(WP_PANEL_FILE) . '/core/template/login/page/login.php',
                'auth' => true,
                'title' => __('Login to User Area', 'wp_panel'),
            ]
        ];

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
            return $this->dashboard($pagename, $list);


        return $this->login($pagename, $list);
    }

    public function NotFound()
    {
        return include(plugin_dir_path(WP_PANEL_FILE) . '/core/template/global/404/404.php');
    }

    public function login($page, $list)
    {
        global $data;


        //default route
        $default_list = ['login' => 1, 'register' => 1, 'forget' => 1, 'verify' => 1];

        if (!isset($default_list[$page]) && !is_user_logged_in())
            return wp_redirect('http://wordpress.develop/panel/login');

        if (is_user_logged_in() && isset($default_list[$page]))
            return wp_redirect('http://wordpress.develop/panel/index');

        $data = $list[$page];

        return include(plugin_dir_path(WP_PANEL_FILE) . '/core/template/login/index.php');
    }

    public function dashboard($page, $list)
    {
        global $data;

        $data = $list[$page];

        return include(plugin_dir_path(WP_PANEL_FILE) . '/core/template/login/index.php');
    }
}
