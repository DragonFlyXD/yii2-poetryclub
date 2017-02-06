<?php

/**
 * file index.php 诗文小部件视图
 */
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<div class="panel">
    <div class="panel-heading">
        <div class="panel-title poem-title">
            <span><?= $config['title'] ?></span>
            <?php if ($config['more']) : ?>
                <div class="pull-right"><a class="font-12" href="<?= $data['more'] ?>">更多<i
                            class="fa fa-angle-double-right"></i></a></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="new-list">
        <?php if (empty($data['body'])) { ?>
            <p class="text-center text-danger"><?= $config['default-alert'] ?><p/>
        <?php } else { ?>
        <?php foreach ($data['body'] as $list) : ?>
            <div class="panel-body poem-body">
                <div class="row">
                    <div class="col-lg-4 field-poem-label">
                        <a href="<?= Url::to([$data['to_url'], 'id' => $list['id']]) ?>" class="poem-label">
                            <img
                                src="<?= ((isset($list['label_img']) && !empty($list['label_img']))
                                    ? Yii::$app->params['upload_url'] . $list['label_img'] : Yii::$app->params['common']['default_label_img']) ?>"
                                alt="<?= $list['title'] ?>">
                        </a>
                    </div>
                    <div class="col-lg-8 btn-group">
                        <h1>
                            <a href="<?= Url::to([$data['to_url'], 'id' => $list['id']]) ?>"><?= $list['title'] ?></a>
                        </h1>
                        <span class="poem-tags">
                        <span class="poem-tags-item">
                            <span class="glyphicon glyphicon-user"></span>
                            <?php if ($config['original']) { ?>
                                <a href="<?= Url::to(['user/index', 'id' => $list['user_id']]) ?>"><?= $list['user_name'] ?></a>
                            <?php } else { ?>
                                <a href="<?= Url::to(['poem/author', 'id' => $list['author_id']]) ?>"><?= $list['author_name'] ?></a>
                            <?php } ?>
                        </span>
                        <span class="poem-tags-item">
                            <span class="glyphicon glyphicon-time"></span><?= date('Y-m-d', $list['created_at']) ?>
                        </span>
                            <span class="poem-tags-item">
                                <span
                                    class="glyphicon glyphicon-eye-open"></span><?= isset($list['extend']['page_view']) ? $list['extend']['page_view'] : 0 ?>
                            </span>
                            <span class="poem-tags-item">
                                <span class="glyphicon glyphicon-comment"></span><a
                                    href="<?= Url::to([$data['to_url'], 'id' => $list['id'], "#" => "feed-form"]) ?>"><?= isset($list['extend']['comment']) ? $list['extend']['comment'] : 0 ?></a>
                            </span>
                    </span>
                        <div class="poem-content"><?= $list['summary'] ?></div>
                        <a href="<?= Url::to([$data['to_url'], 'id' => $list['id']]) ?>">
                            <button class="btn btn-warning no-radius btn-sm pull-right">阅读全文</button>
                        </a>
                    </div>
                </div>
                <div class="tags">
                    <?php if (!empty($list['tags'])) : ?>
                        <span class="fa fa-tags"></span>
                        <?php foreach ($list['tags'] as $k => $item) : ?>
                            <?php if ($k == (count($list['tags']) - 1)) : ?>
                                <a href="#"><?= $item ?></a>
                            <?php else : ?>
                                <a href="#"><?= $item ?> ,</a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php if (isset($config['html']) && !empty($config['html'])): ?>
                    <div class="poem-extend"><?= $config['html'] ?></div>
                <? endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php } ?>
    <?php if ($config['page']) : ?>
        <?= LinkPager::widget([
            'pagination' => $data['page'],
            'options' => [
                'class'=>'pagination page'
            ]
        ]) ?>
    <?php endif; ?>
</div>
