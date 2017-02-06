<?php

/**
 * file index.php 诗文首页
 */

use frontend\widgets\poem\PoemWidget;
$this->title="诗库-诗是翻腾的内心之叹息";
?>

<div class="row">
    <?= PoemWidget::widget([
        'config' => [
            'page' => true,
            'more' => false,
        ],
    ]) ?>
</div>
