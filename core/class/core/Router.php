<?php


namespace BlueOceanClientDash;

if (!defined('ABSPATH')) exit; // No direct access allowed

class Router
{
    private $login_router = ['login', 'register', 'forget', 'verify'];

    public function index($pagename)
    {
        $list = [
            '' => [
                'auth' => true,
                'title' => __('Dashboard', 'BLUE_OCEAN_CD'),
            ]
        ];

        $list = apply_filters('blue_ocean_cd_router', $list);

        if (!isset($list[$pagename]) && !in_array($pagename, $this->login_router))
            return $this->NotFound();

        // 'login', 'register', 'forget', 'verify'
        if (in_array($pagename, $this->login_router) && !is_user_logged_in())
            return $this->login($pagename, $list);

        if (in_array($pagename, $this->login_router) && is_user_logged_in())
            return wp_redirect(url_panel_blue_ocean_cd(''));

        $page = $list[$pagename];

        if ((!isset($page['auth']) && !is_user_logged_in()) || (isset($page['auth']) && $page['auth'] && !is_user_logged_in()))
            return wp_redirect(url_panel_blue_ocean_cd('login'));

        if ((!isset($page['auth']) && is_user_logged_in()) || (isset($page['auth']) && $page['auth'] && is_user_logged_in()))
            return $this->dashboard($pagename, $list);

        if (isset($page['auth']) && !$page['auth'])
            return $this->page($pagename, $list);

//        return $this->login($pagename, $list);
    }

    public function NotFound()
    {
        include(apply_filters('blue_ocean_cd_theme_path', plugin_dir_path(BLUE_OCEAN_CD_FILE) . '/core/template/default/') . 'global/404/404.php');
        return null;
    }

    public function login($page, $list)
    {

        if (is_user_logged_in())
            return wp_redirect(url_panel_blue_ocean_cd(''));

        include(apply_filters('blue_ocean_cd_theme_path', plugin_dir_path(BLUE_OCEAN_CD_FILE) . '/core/template/default/') . "{$page}/index.php");
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
