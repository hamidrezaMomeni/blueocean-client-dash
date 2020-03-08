<?php
if (!defined('ABSPATH')) exit; // No direct access allowed
?>
<div class="flexbox-container">
    <div class="col-xl-8 col-11 box-login-register">
        <div class="row m-0">
            <div class="col-lg-6 d-lg-flex d-none text-center align-self-center py-0 image-box">
                <img src="<?= url_wp_panel('core/template/login/assets/images/login.png') ?>" alt="">
            </div>
            <div class="col-lg-6 col-12 p-0 form-box form-box-login">
                <div>
                    <h2><?= __('Login', 'wp_panel') ?></h2>
                    <p><?= __('Welcome back, please login to your account.', 'wp_panel') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
