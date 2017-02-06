<?php

/**
 * file OriginalController.php 原创诗文控制器
 */

namespace frontend\controllers;

use common\models\UcollectModel;
use common\models\UpoemModel;
use common\models\UpoempraiseModel;
use Yii;
use common\models\CatModel;
use common\models\UpoemExtendModel;
use frontend\models\PoemForm;
use frontend\models\UfeedForm;
use frontend\models\UpoemExtendForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class OriginalController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'upload', 'ueditor', 'add-feed', 'alter-collect','alter-praise'],
                'rules' => [
                    [
                        'actions' => ['index',],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['create', 'upload', 'ueditor', 'add-feed', 'alter-collect','alter-praise'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get', 'post'],
                ]
            ],
        ];
    }

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\file_upload\UploadAction.php',
                'config' => [
                    'imagePathFormat' => '/images/{yyyy}{mm}{dd}/{time}{rand:6}',
                ],
            ],
            'ueditor' => [
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                    'imageUrlPrefix' => '',
                    'imagePathFormat' => '/iamges/{yyyy}{mm}{dd}/{time}{rand:6}',
                ]
            ]
        ];
    }

    //原创诗文首页
    public function actionIndex()
    {
        return $this->render('index');
    }

    //诗文详细页面
    public function actionView($id)
    {
        //获取诗文信息
        $model = new PoemForm();
        $data = $model->getViewById($id, true);

        //统计诗文浏览量
        $model = new UpoemExtendModel();
        $model->upCounter(['upoem_id' => $id], 'page_view', 1, true);

        //获取诗文扩展状态信息
        $model = new UpoemExtendForm();
        $status = $model->getPoemExtendInfo($id);

        return $this->render('view', ['data' => $data,'status'=>$status]);
    }

    //诗文创建页面
    public function actionCreate()
    {
        $model = new PoemForm();

        //定义场景
        $model->setScenario(PoemForm::SCENARIOS_CREATE);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!$model->create()) { //如果没有创建成功,记录错误
                Yii::$app->session->setFlash('warning', $model->_lastError);
            } else { //如果成功了,页面重定向至诗文详细页
                return $this->redirect(['original/view', 'id' => $model->id]);
            }
        }

        //获取所有分类
        $cat = CatModel::getAllCat();
        return $this->render('create', ['model' => $model, 'cat' => $cat]);
    }

    /**
     * 诗文评论
     * @return string
     */
    public function actionAddFeed()
    {

        $model = new UfeedForm();
        $model->content = Yii::$app->request->post('content');
        $p_id = $model->upoem_id = Yii::$app->request->post('p_id');
        if ($model->validate()) {
            if ($model->create()) {

                //统计诗文评论量
                $uModel = new UpoemExtendModel();
                $uModel->upCounter(['upoem_id' => $p_id], 'comment', 1, true);
                return json_encode(['status' => true]);
            }
        }
        return json_encode(['status' => false, 'message' => '英灵召唤失败啦,/(ㄒoㄒ)/~~']);
    }

    /**
     * 修改原创诗文收藏状态
     * @param $id 原创诗文id
     * @return string
     */
    public function actionAlterCollect($id)
    {
        $model = new UpoemExtendForm();
        if (!$model->AlterCollect($id)) {    //修改诗文状态失败
            return json_encode(['status' => false, 'message' => '英灵收藏失败啦,/(ㄒoㄒ)/~~']);
        }
        $data['status']=UcollectModel::findOne(['user_id'=>Yii::$app->user->identity->id,'upoem_id'=>$id])->status;
        $data['style']=$data['status']?"fa fa-star":"fa fa-star-o";
        $data['collect']=UpoemExtendModel::findOne(['upoem_id'=>$id])->collect;
        $data['title']=UpoemModel::findOne(['id'=>$id])->title;
        return json_encode(['status' => true,'data'=>$data]);
    }

    /**
     * 修改原创诗文赞状态
     * @param $id 原创诗文id
     * @return string
     */
    public function actionAlterPraise($id)
    {
        $model = new UpoemExtendForm();
        if (!$model->AlterPraise($id)) {    //修改诗文状态失败
            return json_encode(['status' => false, 'message' => '赞英灵失败啦,/(ㄒoㄒ)/~~']);
        }
        $data['status']=UpoempraiseModel::findOne(['user_id'=>Yii::$app->user->identity->id,'upoem_id'=>$id])->status;
        $data['style']=$data['status']?"fa fa-thumbs-up":"fa fa-thumbs-o-up";
        $data['praise']=UpoemExtendModel::findOne(['upoem_id'=>$id])->praise;
        return json_encode(['status' => true,'data'=>$data]);
    }

}