<?php

/**
 * file index.php 热门浏览小部件视图
 */

use yii\helpers\Url;

?>
<?php if (!empty($data)) : ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">
                <span><strong><?= $data['title'] ?></strong></span>
                <span class="pull-right">TOP-TEN <i class="fa fa-leaf"></i></span>
            </div>
        </div>
        <div class="panel-body p-body">
            <?php foreach ($data['body'] as $list) : ?>
                <div class="p-view clearfix">
                    <div class="pull-left media-left">
                        <a href="<?= Url::to(['poem/view', 'id' => $list['id']]) ?>">浏览<em><?= $list['page_view'] ?></em></a>
                    </div>
                    <div class="media-right">
                        <a href="<?= Url::to(['poem/view', 'id' => $list['id']]) ?>"><?= $list['title'] ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
