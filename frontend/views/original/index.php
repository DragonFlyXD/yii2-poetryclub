<?php

/**
 * file index.php 原创诗文首页
 */

use frontend\widgets\poem\PoemWidget;
$this->title="原创-保守是舒服的产物"
?>

<div class="row">
    <?= PoemWidget::widget([
            'config' => [
                'original' => true,
                'page' => 'true',
                'more' => false,
            ],
        ]
    ) ?>
</div>
