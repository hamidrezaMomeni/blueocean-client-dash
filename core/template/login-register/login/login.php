<?php
if (!defined('ABSPATH')) exit; // No direct access allowed

$data = \BlueOceanClientDash\Login::data();

?>
<div class="flexbox-container">
    <div class="bg animate__animated animate__fadeIn">
        <div class="box-login-register">
            <div class="col-lg-5 col-md-12">
                <div class="scroll">
                    <h1><?= $data['title'] ?></h1>
                    <p><?= $data['desc'] ?></p>
                    <?php foreach ($data['fields'] as $field) { ?>
                        <div class="form-group">
                            <label for="<?= $field['id'] ?>"><?= $field['label'] ?></label>
                            <input type="<?= $field['id'] ?>" name="<?= $field['id'] ?>" id="<?= $field['id'] ?>"
                                   placeholder="<?= $field['placeholder'] ?>" class="form-control">
                        </div>
                    <?php } ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label" for="remember">
                            <?= $data['remember'] ?>
                        </label>
                    </div>
                    <div class="form-group form-group-btn">
                        <button type="button" class="btn btn-secondary" disabled><?= $data['sign-in'] ?></button>
                    </div>
                    <div class="form-group forgot-register">
                        <p>
                            <?= $data['dont-acc'] ?>
                            <a href="<?= url_panel_blue_ocean_cd('register') ?>">
                                <?= $data['sign-up'] ?>
                            </a>
                        </p>
                        <a href="<?= url_panel_blue_ocean_cd('forgot') ?>"><?= $data['forgot-pass'] ?></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-flex" style="background-image: url('<?= $data['background'] ?>')">
                <?php include(plugin_dir_path(__FILE__) . '/slider.php'); ?>
            </div>
        </div>
    </div>
</div>
