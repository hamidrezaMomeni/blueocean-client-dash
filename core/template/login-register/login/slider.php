<?php
if (!defined('ABSPATH')) exit; // No direct access allowed
?>
<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        $i = 0;
        foreach ($data['sliders'] as $slider) { ?>
            <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                <img src="<?= $slider['img'] ?>" class="" alt="<?= $slider['title'] ?>">
                <h2><?= $slider['title'] ?></h2>
                <p><?= $slider['desc'] ?></p>
            </div>
            <?php
            $i++;
        } ?>
    </div>
    <ol class="carousel-indicators">
        <?php
        $i = 0;
        foreach ($data['sliders'] as $slider) { ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>"
                class="<?= $i == 0 ? 'active' : '' ?>"></li>
            <?php
            $i++;
        }
        ?>
    </ol>
</div>
