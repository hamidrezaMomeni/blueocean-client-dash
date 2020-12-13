<?php
if (!defined('ABSPATH')) exit; // No direct access allowed

$favicon = apply_filters('blue_ocean_cd_favicon', url_blue_ocean_cd('assets/images/logo.svg'));

?>
<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= apply_filters('title', __('Log in', 'BLUE_OCEAN_CD'), 'login') ?></title>

    <!-- Styles -->
    <link href="<?= url_blue_ocean_cd('core/template/default/assets/css/login.css') ?>" rel="stylesheet">

    <!-- Favicon -->
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?= $favicon ?>" sizes="180x180">
    <link rel="icon" href="<?= $favicon ?>" sizes="32x32" type="image/png">
    <link rel="icon" href="<?= $favicon ?>" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="<?= $favicon ?>" color="#563d7c">
    <link rel="icon" href="<?= $favicon ?>">

    <?php
    do_action('blue_ocean_cd_header', 'login');
    ?>
</head>
