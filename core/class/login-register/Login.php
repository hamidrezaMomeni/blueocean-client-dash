<?php


namespace BlueOceanClientDash;

if (!defined('ABSPATH')) exit; // No direct access allowed

class Login
{
    static function init()
    {
        add_action('blue_ocean_cd_header', '\BlueOceanClientDash\Login::style');
        add_action('wp_ajax_nopriv_blue_ocean_cd_login', '\BlueOceanClientDash\Login::login');
    }

    static function data()
    {
        $data = [
            'title' => __('Log in.', 'BLUE_OCEAN_CD'),
            'desc' => __('Log in with you data that you entered during your registration.', 'BLUE_OCEAN_CD'),
            'remember' => __('keep me logged in', 'BLUE_OCEAN_CD'),
            'dont-acc' => __("Don't have an account?", 'BLUE_OCEAN_CD'),
            'sign-up' => __("Sign up", 'BLUE_OCEAN_CD'),
            'sign-in' => __("Log in", 'BLUE_OCEAN_CD'),
            'forgot-pass' => __("Forgot password?", 'BLUE_OCEAN_CD'),
            'background' => url_blue_ocean_cd('assets/images/bg-login.png'),
            'fields' => [
                [
                    'id' => 'username',
                    'type' => 'text',
                    'placeholder' => __('name@domain.com', 'BLUE_OCEAN_CD'),
                    'label' => __('E-mail / Username', 'BLUE_OCEAN_CD'),
                ],
                [
                    'id' => 'password',
                    'type' => 'password',
                    'placeholder' => __('at least 8 characters', 'BLUE_OCEAN_CD'),
                    'label' => __('Password', 'BLUE_OCEAN_CD'),
                ]
            ],
            'sliders' => [
                [
                    'title' => __('Account Benefits', 'BLUE_OCEAN_CD'),
                    'desc' => __('Manage your newsletter subscription<br>Insight into your orders including shipment information<br>Save your user data and settings<br>', 'BLUE_OCEAN_CD'),
                    'img' => url_blue_ocean_cd('assets/images/slider.png')
                ],
                [
                    'title' => __('Account Benefits', 'BLUE_OCEAN_CD'),
                    'desc' => __('Manage your newsletter subscription<br>Insight into your orders including shipment information<br>Save your user data and settings<br>', 'BLUE_OCEAN_CD'),
                    'img' => url_blue_ocean_cd('assets/images/slider.png')
                ],
                [
                    'title' => __('Account Benefits', 'BLUE_OCEAN_CD'),
                    'desc' => __('Manage your newsletter subscription<br>Insight into your orders including shipment information<br>Save your user data and settings<br>', 'BLUE_OCEAN_CD'),
                    'img' => url_blue_ocean_cd('assets/images/slider.png')
                ],
                [
                    'title' => __('Account Benefits', 'BLUE_OCEAN_CD'),
                    'desc' => __('Manage your newsletter subscription<br>Insight into your orders including shipment information<br>Save your user data and settings<br>', 'BLUE_OCEAN_CD'),
                    'img' => url_blue_ocean_cd('assets/images/slider.png')
                ]
            ]
        ];

        $data['fields'] = apply_filters('blue_ocean_cd_fields_login', $data['fields']);

        return $data;
    }

    static function style($type)
    {
        if ($type != 'login')
            return null;

        $styles = [
            'login-register-style' => url_blue_ocean_cd('assets/css/dashboard/login-register.css')
        ];

        $styles = apply_filters('blue_ocean_cd_styles_login', $styles);

        // Registers
        foreach ($styles as $key => $style)
            wp_register_style($key, $style);

        // Print
        foreach ($styles as $key => $style)
            wp_print_styles($key);

    }

    static function login()
    {

        return 'asdad';
    }


}

Login::init();
