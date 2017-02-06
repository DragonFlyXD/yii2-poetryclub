<?php

use yii\helpers\Url;

?>

<div class="panel">
    <div id="index-carousel" class="carousel slide" data-ride="carousel">
        <!-- 轮播指标 -->
        <ol class="carousel-indicators">
            <?php foreach ($data['items'] as $k => $point) : ?>
                <li data-target="#index-carousel" data-slide-to="<?= $k ?>"
                    class="<?= (isset($point['active']) && !empty($point['active'])) ? 'active' : '' ?>"></li>
            <?php endforeach; ?>
        </ol>
        <!-- 轮播项目 -->
        <div class="carousel-inner">
            <?php foreach ($data['items'] as $k => $item) : ?>
                <div class="item <?= (isset($item['active']) && !empty($item['active'])) ? 'active' : '' ?>">
                    <a href="<?= Url::to($item['url']) ?>">
                        <img src="<?= Url::to($item['image_url']) ?>" alt="<?= $item['label'] ?>">
                        <span class="carousel-caption">
                            <?= $item['html'] ?>
                        </span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- 轮播导航 -->
        <a href="#index-carousel" class="carousel-control left" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a href="#index-carousel" class="carousel-control right" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>
