<?php

/**
 * file TagCloudWidget.php 标签云小部件
 */
namespace frontend\widgets\tagcloud;

use common\models\TagModel;
use yii\bootstrap\Widget;

class TagCloudWidget extends Widget
{
    public $title = '';
    public $limit = 10;

    public function run()
    {
        $res = TagModel::find()
            ->orderBy(['poem_num' => SORT_DESC, 'id' => SORT_DESC])
            ->limit($this->limit)
            ->all();
        $result['title'] = $this->title ?: '标签云';
        $result['body'] = $res ?: [];

        return $this->render('index', ['data' => $result]);
    }
}