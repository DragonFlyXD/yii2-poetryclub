<?php

/**
 * file UcenterWidget.php 用户中心小部件
 */
namespace frontend\widgets\ucenter;

use yii\helpers\Url;
use frontend\models\UcenterForm;
use Yii;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;

class UcenterWidget extends Widget
{

    public $config = [];
    public $session = [];

    public function init()
    {
        $_session = Yii::$app->session;
        $_session->open();
        $_session->set('user_id', Yii::$app->request->get('id', $_session->get('user_id', 0)));
        $_config = [
            'items' => [
                [
                    'url' => Url::to(['user/index','id' => $_session->get('user_id')]),
                    'html' => '个人动态',
                    'href' => '#u-index',
                    'id' => 'u-index',
                    'class'=>'fa fa-street-view',
                    'active' => 'active'
                ],
                [
                    'url' => Url::to(['user/set-profile', 'id' => $_session->get('user_id')]),
                    'html' => '个人信息',
                    'href' => '#setprofile',
                    'id' => 'setprofile',
                    'class'=>'fa fa-info',
                ],
                [
                    'url' => Url::to(['user/collect-record','id'=>$_session->get('user_id')]),
                    'html' => '收藏记录',
                    'href' => '#collect-record',
                    'id' => 'collect-record',
                    'class'=>'fa fa-cubes',
                ],
                [
                    'url' => Url::to(['user/operate-record','id'=>$_session->get('user_id')]),
                    'html' => '操作记录',
                    'href' => '#operate-record',
                    'id' => 'operate-record',
                    'class'=>'fa fa-wrench',
                ],
            ],
        ];
        $this->config = ArrayHelper::merge($_config, $this->config);
        $this->session = ArrayHelper::merge($_session, $this->session);
    }

    public function run()
    {
        $data = UcenterForm::getInfoById($this->session['user_id']);
        return $this->render('index', ['data' => $data, 'config' => $this->config]);
    }
}