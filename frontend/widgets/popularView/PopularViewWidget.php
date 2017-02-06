<?php

/**
 * file phpularView.php 热门游览小部件
 */
namespace frontend\widgets\popularView;

use common\models\PoemExtendModel;
use common\models\PoemModel;
use yii\bootstrap\Widget;
use yii\db\Query;

class PopularViewWidget extends Widget
{
    public $title = '';
    public $limit = 10;

    public function run()
    {
        $res = (new Query())
            ->select('a.page_view,b.id,b.title')
            ->from(['a' => PoemExtendModel::tableName()])
            ->join('LEFT JOIN', ['b' => PoemModel::tableName()], 'a.poem_id=b.id')
            ->where('b.is_valid=' . PoemModel::IS_VALID)
            ->orderBy(['page_view' => SORT_DESC, 'id' => SORT_DESC])
            ->limit($this->limit)
            ->all();

        $result['title'] = $this->title ?: '热门游览';
        $result['body'] = $res ?: [];

        return $this->render('index', ['data' => $result]);
    }
}