<?php
if (!defined('ABSPATH')) exit; // No direct access allowed
header("HTTP/1.0 404 Not Found");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= __('404 - Page Not Found!', 'wp_panel') ?></title>
    
    <link href="<?= url_wp_panel('assets/css/lib/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= url_wp_panel('assets/css/dashboard/404.css') ?>" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?= url_wp_panel('assets/images/logo.svg') ?>" sizes="180x180">
    <link rel="icon" href="<?= url_wp_panel('assets/images/logo.svg') ?>" sizes="32x32" type="image/png">
    <link rel="icon" href="<?= url_wp_panel('assets/images/logo.svg') ?>" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="<?= url_wp_panel('assets/images/logo.svg') ?>" color="#563d7c">
    <link rel="icon" href="<?= url_wp_panel('assets/images/logo.svg') ?>">

</head>
<body class="text-center">
<div>
    <img src="<?= url_wp_panel('assets/images/404.png') ?>" alt="<?= __('404 - Page Not Found!', 'wp_panel') ?>">
    <h1><?= __('404 - Page Not Found!', 'wp_panel') ?></h1>
    <p><?= __('The page you were looking for could not be found. I\'m sorry, it’s not your fault… probably.', 'wp_panel') ?></p>
</div>
</body>
</html>
