<?php

/**
 * file index.php 聊天版视图
 */
use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\bootstrap\Alert;

AppAsset::addScript($this, 'statics/js/chat.js');
?>
<div class="panel panel-default feed-panel">
    <div class="panel-heading">
        <div class="panel-title">
            <span><strong>英灵道场 <span class="fa fa-leaf"></span></strong></span>
            <span class="pull-right"><a href="#" class="font-12">更多<i><span class="fa fa-angle-double-right"></span></i></a></span>
        </div>
    </div>
    <div class="panel-body f-body">
        <?= Alert::widget([
            'options' => [
                'class' => 'alert-error alert-warning',
            ],
            'body' => '旅行者,请先前往祭坛,<strong><a href="/site/login.html">登录</a></strong>后方可召唤英灵,&nbsp;<strong>\~(ˇˍˇ)~/</strong>'
        ]) ?>
        <form id="feed-form" action="/" method="post" name="feed-form">
            <div class="form-group input-group field-feed-content required">
                <textarea name="content" class="feed-content form-control" id="feed-content"
                          placeholder="旅行者,将英灵的能量汇聚在评价里,\(^o^)/~" maxlength="140"></textarea>
                <span class="input-group-btn">
                    <button class="btn btn-primary feed-submit" type="button" data-pid="<?= $data['p_id'] ?>"
                        <?php if ($config['original']) { ?>
                            data-url="<?= Url::to(['original/add-feed']) ?>"
                        <?php } else { ?>
                            data-url="<?= Url::to(['poem/add-feed']) ?>"
                        <?php } ?>
                    >召唤&nbsp;&nbsp;&nbsp;&nbsp;英灵</button>
                </span>
            </div>
        </form>
        <?php if (!empty($data['feed'])) : ?>
            <ul class="media-list media-feed" id="media-feed">
                <?php foreach ($data['feed'] as $list) : ?>
                    <?php if ((isset($list['poem_id']) ? $list['poem_id'] : null) == $data['p_id'] || (isset($list['upoem_id']) ? $list['upoem_id'] : null) == $data['p_id']) : ?>
                        <li class="media feed-media">
                            <div class="media-left feed-media-left">
                                <a href="#"><img
                                                 src="<?= $list['user']['avatar'] ?: Yii::$app->params['avatar']['small'] ?>"
                                                 alt="<?= $list['user']['username'] ?>"></a>
                            </div>
                            <div class="media-body">
                                <div class="media-content">
                                    <a href="#"><?= $list['user']['username'] ?></a>
                                    <div><?= $list['content'] ?></div>
                                </div>
                                <div class="media-time">
                                    时间: <?= Yii::$app->formatter->asRelativeTime($list['created_at']) ?>
                                </div>
                            </div>
                            <div class="media-right feed-media-right">
                                <a href="#" class="text-muted"><i class="fa fa-thumbs-up "><span class="badge">12</span></i></a>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
