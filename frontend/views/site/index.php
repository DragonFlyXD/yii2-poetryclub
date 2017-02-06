<?php

/**
 * file index.php 首页视图
 */
/* @var $this yii\web\View */

use frontend\widgets\poem\PoemWidget;
use frontend\widgets\banner\BannerWidget;
use frontend\widgets\tagcloud\TagCloudWidget;
use frontend\widgets\popularView\PopularViewWidget;

$this->title = Yii::t('common', 'Poetry Club-Poetry is wisdom that enchants the heart');
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-9">
            <!-- 图片轮播 -->
            <?= BannerWidget::widget() ?>
            <?= PoemWidget::widget() ?>
        </div>
        <div class="col-lg-3">
            <?= PopularViewWidget::widget() ?>
            <?= TagCloudWidget::widget() ?>
        </div>
    </div>
</div>