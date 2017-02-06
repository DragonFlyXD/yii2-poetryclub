<?php
/**
 * file PoemWidget.php 诗词小部件
 */

namespace frontend\widgets\poem;

use common\models\PoemModel;
use common\models\UpoemModel;
use frontend\models\PoemForm;
use yii\bootstrap\Widget;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\data\Pagination;

class PoemWidget extends Widget
{
    public $config = [];

    public function init()
    {
        $_config = [
            'page' => false,         //是否显示分页
            'limit' => 10,           //显示条数
            'more' => true,          //是否显示更多
            'title' => '最新文章',    //文章列表的标题
            'original' => false,     //是否为原创
            'orderBy' => ['id' => SORT_DESC],  //默认按诗文ID倒叙排序
            'html' => '',       //html扩展
            'ucenter-uid' => 0,        //用户中心的用户ID
            'default-alert'=>'/(ㄒoㄒ)/~~,没有任何数据~~', //默认没有数据时候的警告
        ];
        $this->config = ArrayHelper::merge($_config, $this->config);
    }

    public function run()
    {
        //根据get方法获取page参数。假若没有,则默认为1。
        $curPage = Yii::$app->request->get('page', 1);
        //查询条件
        $cond = ['=', 'is_valid', PoemModel::IS_VALID];
        $res = PoemForm::getList($cond, $curPage, $this->config['limit'], $this->config['original'], $this->config['orderBy']);
        $result['more'] = Url::to(['poem/index']);
        $result['body'] = $res['data'] ?: [];
        $result['to_url'] = $this->config['original'] ? 'original/view' : 'poem/view';

        //如果显示分页
        if ($this->config['page']) {
            $pages = new Pagination(['totalCount' => $res['count'], 'pageSize' => $res['pageSize']]);
            $result['page'] = $pages;
        }

        return $this->render('index', ['data' => $result, 'config' => $this->config]);
    }
}