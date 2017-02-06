<?php

/**
 * file collect-record.php 收藏记录
 */

use frontend\widgets\collect\CollectWidget;

?>
    <div class="modal fade coll-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="text-danger">确定不在守护该英灵?<span style="font-size: 2em"> /(ㄒoㄒ)/~~</span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger coll-modal-submit">确定</button>
                </div>
            </div>
        </div>
    </div>
    <div class="u-title">
        <span>收藏记录</span>
    </div>
    <div class="u-line"></div>
<?= CollectWidget::widget([
    'config' => [
        'title' => '诗库',
        'own-center' => $data['own_center'],
    ],
]) ?>
<?= CollectWidget::widget([
    'config' => [
        'title' => '原创',
        'original' => true,
        'own-center' => $data['own_center'],
    ],
]) ?>