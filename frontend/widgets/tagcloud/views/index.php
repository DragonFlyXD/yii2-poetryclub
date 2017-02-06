<?php

/**
 * file index.php 标签云视图
 */
use yii\helpers\Url;

?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <span><strong><?= $data['title'] ?></strong></span>
            <span class="pull-right">TOP-TEN <i class="fa fa-leaf"></i></span>
        </div>
    </div>
    <div class="panel-body tag-body">
        <div class="tag-cloud">
            <?php foreach ($data['body'] as $list) : ?>
                <a href="<?= Url::to(['poems/index','tag'=>$list['tag_name']]) ?>"><?= $list['tag_name'] ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

