<?php
if (!defined('ABSPATH')) exit; // No direct access allowed
global $data;

$favicon = apply_filters('wp_panel_favicon', url_wp_panel('assets/images/logo.svg'));
$css = apply_filters('wp_panel_css_url_login', url_wp_panel('assets/css/dashboard/login-register.css'));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $data['title'] ?></title>

    <link href="<?= url_wp_panel('assets/css/lib/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= $css ?>" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?= $favicon ?>" sizes="180x180">
    <link rel="icon" href="<?= $favicon ?>" sizes="32x32" type="image/png">
    <link rel="icon" href="<?= $favicon ?>" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="<?= $favicon ?>" color="#563d7c">
    <link rel="icon" href="<?= $favicon ?>">
    <?php do_action('wp_panel_header_login'); ?>
</head>
<body>
