<?php

/**
 * file UserController.php 用户中心控制器
 */

namespace frontend\controllers;

use common\models\UcenterModel;
use Yii;
use frontend\models\UcenterForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class UserController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'set-profile', 'alter-ucenter', 'collect-record', 'operate-record'],
                'rules' => [
                    [
                        'actions' => ['index', 'set-profile', 'collect-record', 'operate-record'],
                        'allow' => 'true',
                    ],
                    [
                        'actions' => ['alter-ucenter'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get', 'post'],
                ],
            ],
        ];
    }

    /**
     * 个人中心首页
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 用户配置信息页面
     * @return string
     */
    public function actionSetProfile($id)
    {
        $res = [];    //如果无ID值,则返回一个空数组
        if ($id) {

            //如果数据库里无此个人信息,则返回一个空数组
            $res = empty($res = UcenterModel::findOne(['user_id' => $id])) ? [] : $res->toArray();
            if ($res) {
                $gender = $res['gender'];
                switch ($gender) {  //显示性别为具体中文
                    case 1:
                        $gender = "男";
                        break;
                    case 2:
                        $gender = "女";
                        break;
                    default:
                        $gender = "保密,(⊙o⊙)…";
                }
                $res['gender'] = $gender;
            }
            //查看该个人中心,是否为用户自己的
            if (!Yii::$app->user->isGuest) {
                $res['own_center'] = Yii::$app->user->identity->id == $id ? 10 : 0;
            }
        }
        if (!isset($res['own_center'])) {    //如果为游客,则去除个人编辑
            $res['own_center'] = 0;
        }
        return $this->renderAjax('setprofile', ['data' => $res]);
    }

    /**
     * 修改用户信息
     * @return string
     */
    public function actionAlterUcenter()
    {
        $model = new UcenterForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            if (!$model->alterUserInfo()) { //如果个人信息没有修改成功,则记录错误
                return json_encode(['status' => false, 'message' => $model->_lastError]);
            }
        }
        return json_encode(['status' => true]);
    }

    /**
     * 用户收藏记录页面
     * @param $id 用户ID
     * @return string
     */
    public function actionCollectRecord($id)
    {
        if ($id) {
            //查看该个人中心,是否为用户自己的
            if (!Yii::$app->user->isGuest) {
                $res['own_center'] = Yii::$app->user->identity->id == $id ? 10 : 0;
            }
        }
        if (!isset($res['own_center'])) {    //如果为游客,则去除删除诗文按钮
            $res['own_center'] = 0;
        }
        return $this->renderAjax('collect-record', ['data' => $res]);
    }

    /**
     * 用户操作记录页面
     * @param $id 用户ID
     * @return string
     */
    public function actionOperateRecord($id)
    {
        $data['user_id'] = $id;
        return $this->renderAjax('operate-record', ['data' => $data]);
    }
}