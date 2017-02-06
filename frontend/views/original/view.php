<?php

/**
 * file view.php 原创诗文视图
 */

use frontend\assets\AppAsset;
use yii\helpers\Url;
use frontend\widgets\chat\ChatWidget;

AppAsset::addScript($this, '/statics/js/poem.js');
$this->title = $data['title'];
$this->params['breadcrumbs'][] = ['label' => '原创', 'url' => ['original/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="modal fade view-title-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">确定</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade view-title-alert">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>旅行者,请先前往祭坛,<strong style="font-size: 1.4em"><a href="/site/login.html">登录</a></strong>后方可与英灵交流,&nbsp;<strong
                            style="font-size: 1.4em">\~(ˇˍˇ)~/</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a type="button" class="btn btn-primary" href="<?= Url::to(['site/login']) ?>">前往祭坛</a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel poem-panel">
        <div class="panel-heading">
            <a data-url="<?= Url::to(['original/create']) ?>" class="pull-right view-title-item view-title-create"
               href="javascript: void(0)"><i
                    class="fa fa-file-o"></i></a>
            <a href="javascript: void(0)" data-url="<?= Url::to(['original/alter-collect', 'id' => $data['id']]) ?>"
               class="pull-right view-title-item view-title-coll"><i class="<?= $status['collect']['style'] ?>"></i></a>
            <div class="panel-title view-title">
                <h1><?= $data['title'] ?></h1>
                <span>作者: <a
                        href="<?= Url::to(['user/index', 'id' => $data['user_id']]) ?>"><?= $data['user_name'] ?></a></span>
                <span>发布: <?= date('Y-m-d', $data['created_at']) ?></span>
                <span>游览: <?= isset($data['extend']['page_view']) ? $data['extend']['page_view'] : 0; ?></span>
            </div>
        </div>
        <div class="panel-body page-content">
            <?= $data['content'] ?>
        </div>
        <div class="page-evaluate">
            助力英灵<a href="javascript: void(0)" data-url="<?= Url::to(['original/alter-praise', 'id' => $data['id']]) ?>"
                   class="view-title-praise"><i
                    class="<?= $status['praise']['style'] ?>"></i><span><?= $data['extend']['praise'] ?: 0 ?></span></a>
            俘获英灵<a href="javascript: void(0)" data-url="<?= Url::to(['original/alter-collect', 'id' => $data['id']]) ?>"
                   class="view-title-coll"><i
                    class="<?= $status['collect']['style'] ?>"></i><span><?= $data['extend']['collect'] ?: 0 ?></span></a>
            召唤英灵<a class="view-title-write" href="javascript: void(0)"
                   data-url="<?= Url::to(['original/view', 'id' => $data['id'], '#' => 'feed-form']) ?>"><i
                    class="glyphicon glyphicon-pencil"></i></a>
        </div>
        <div class="page-tag">
            <strong>标签:<strong>
                    <?php foreach ($data['tags'] as $tag) : ?>
                        <span><a href="#"><?= $tag ?></a></span>
                    <?php endforeach; ?>
        </div>
    </div>
    <?= ChatWidget::widget([
        'config' => [
            'original' => true,
        ]
    ]) ?>
</div>
