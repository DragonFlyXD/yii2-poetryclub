<?php

/**
 * file index.php 用户中心视图
 */

use frontend\assets\AppAsset;

AppAsset::addScript($this, '/statics/js/user.js');
?>
<div class="row" id="back-index">
    <div class="col-lg-4 u-center-l">
        <div class="u-avatar">
            <div class="avatar-mode center-block">
                <img
                    src="<?= isset($data['user']['avatar']) ? $data['user']['avatar'] : Yii::$app->params['avatar']['mid'] ?>">
                <div class="upload-avatar">
                    <p>
                        <a href="javascript: void(0);">客官,选个新的头像呗~(ˇˍˇ)</a>
                    </p>
                </div>
            </div>
            <div class="des-mode">
                <span><?= isset($data['alias']) ? $data['alias'] : "远方来的人儿,报上名来?<(￣3￣)>" ?></span>
                <p><?= isset($data['signature']) ? $data['signature'] : '旅行者,你可以在神石上镌刻你的墓志铭<br />\(^o^)/~' ?></p>
                <a href="javascript: void(0);"><i class="fa fa-paper-plane-o"></i></a>
            </div>
        </div>
        <div class="u-list">
            <h2>英灵管理<i class="fa fa-cog"></i></h2>
            <div class="u-line"></div>
            <ul class="u-menu nav-stacked nav-pills nav">
                <?php foreach ($config['items'] as $item) : ?>
                    <li class="<?= isset($item['active']) ? 'active' : '' ?>">
                        <a id="<?= $item['id'] ?>" href="<?= $item['href'] ?>"
                           data-url="<?= $item['url'] ?>"><?= $item['html'] ?><i class="font-12 <?= $item['class'] ?>"></i><i
                                class="fa fa-angle-right pull-right"></i></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-lg-8 u-center-r">
        <div class="u-title">
            <span class="text-left">个人动态</span>
        </div>
        <div class="u-line"></div>
        <div class="u-info">
            <p>暂时没有开放</p>
        </div>
    </div>
</div>