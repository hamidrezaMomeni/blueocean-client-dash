<?php


namespace BlueOceanClientDash;

if (!defined('ABSPATH')) exit; // No direct access allowed

class Router
{

    public function index($pagename)
    {
        $list = [
            'login' => [
                'include' => plugin_dir_path(BLUE_OCEAN_CD_FILE) . '/core/template/login/page/login.php',
                'auth' => false,
                'title' => __('Login to User Area', 'BLUE_OCEAN_CD'),
            ],
            'index' => [
                'include' => plugin_dir_path(BLUE_OCEAN_CD_FILE) . '/core/template/login/page/login.php',
                'auth' => true,
                'title' => __('Login to User Area', 'BLUE_OCEAN_CD'),
            ]
        ];

        $list = apply_filters('blue_ocean_cd_router', $list);

        if (!isset($list[$pagename]))
            return $this->NotFound();

        $page = $list[$pagename];

        if (isset($page['auth']) && $page['auth'] && is_user_logged_in())
            return $this->dashboard($pagename, $list);


        return $this->login($pagename, $list);
    }

    public function NotFound()
    {
        include(apply_filters('blue_ocean_cd_path_404', plugin_dir_path(BLUE_OCEAN_CD_FILE) . '/core/template/global/404/404.php'));
        return null;
    }

    public function login($page, $list)
    {
        global $data;


        //default route
        $default_list = ['login', 'register', 'forget', 'verify'];

        if (!in_array($page, $default_list) && !is_user_logged_in())
            return wp_redirect(url_panel_blue_ocean_cd('login'));

        if (is_user_logged_in() && in_array($page, $default_list))
            return wp_redirect(url_panel_blue_ocean_cd('index'));

        $data = $list[$page];

        include(apply_filters('blue_ocean_cd_path_404', plugin_dir_path(BLUE_OCEAN_CD_FILE) . '/core/template/global/404/404.php'));

        include(plugin_dir_path(BLUE_OCEAN_CD_FILE) . '/core/template/login/index.php');
        return null;

    }

    public function dashboard($page, $list)
    {
        global $data;

        $data = $list[$page];

        include(plugin_dir_path(BLUE_OCEAN_CD_FILE) . '/core/template/login/index.php');

        return null;

    }
}
