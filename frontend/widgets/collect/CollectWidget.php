<?php

/**
 * file CollectWidget.php 用户中心收藏小部件
 */

namespace frontend\widgets\collect;

use frontend\models\PoemForm;
use Yii;
use yii\bootstrap\Widget;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class CollectWidget extends Widget
{
    public $config = [];

    public function init()
    {
        $_config = [
            'page' => true,         //是否显示分页
            'limit' => 5,           //显示条数
            'title' => '收藏',    //文章列表的标题
            'original' => false,     //是否为原创
            'orderBy' => ['updated_at' => SORT_DESC, 'id' => SORT_DESC],  //默认按收藏修改时间降序排序
            'default-alert' => '/(ㄒoㄒ)/~~,您没有任何藏品~~',  //默认无收藏时显示的警告
            'html' => '',       //html扩展
            'own-center'=>0,        //用户中心所有者ID
        ];
        $this->config = ArrayHelper::merge($_config, $this->config);
    }

    public function run()
    {
        //根据get方法获取page参数。假若没有,则默认为1。
        $curPage = Yii::$app->request->get('page', 1);
        //查询条件
        $res = PoemForm::getCollect($curPage, $this->config['limit'], $this->config['original'], $this->config['orderBy']);
        $result['body'] = $res['data'] ?: [];
        $result['count'] = $res['count']?: 0;   //收藏总数
        //诗文收藏操作URL
        $result['poem_url'] = $this->config['original'] ? 'original/alter-collect' : 'poem/alter-collect';
        //诗文详细页面URL
        $result['to_url'] = $this->config['original'] ? 'original/view' : 'poem/view';
        //显示分页
        if ($this->config['page']) {
            $pages = new Pagination(['totalCount' => $res['count'], 'pageSize' => $res['pageSize']]);
            $result['page'] = $pages;
        }
        return $this->render('index', ['data' => $result, 'config' => $this->config]);
    }
}