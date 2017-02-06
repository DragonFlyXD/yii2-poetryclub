<?php

/**
 * file PoemController.php 诗文控制器
 */

namespace frontend\controllers;

use common\models\CollectModel;
use common\models\PoemExtendModel;
use common\models\PoemModel;
use common\models\PoempraiseModel;
use frontend\models\FeedForm;
use frontend\models\PoemExtendForm;
use Yii;
use frontend\models\PoemForm;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class PoemController extends Controller
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

    //诗文首页
    public function actionIndex()
    {
        return $this->render('index');
    }


    /** 诗文详细页面
     * @param $id 传进来的诗文ID
     * @return string
     */
    public function actionView($id)
    {
        //获取诗文信息
        $model = new PoemForm();
        $data = $model->getViewById($id);

        //统计诗文浏览量
        $model = new PoemExtendModel();
        $model->upCounter(['poem_id' => $id], 'page_view', 1);

        //诗文扩展状态
        $model = new PoemExtendForm();
        $status = $model->getPoemExtendInfo($id);

        return $this->render('view', ['data' => $data,'status'=>$status]);
    }

    /**
     * 诗文评论
     * @return string
     */
    public function actionAddFeed()
    {

        $model = new FeedForm();
        $model->content = Yii::$app->request->post('content');
        $p_id = $model->poem_id = Yii::$app->request->post('p_id');
        if ($model->validate()) {
            if ($model->create()) {

                //统计诗文评论量
                $pModel = new PoemExtendModel();
                $pModel->upCounter(['poem_id' => $p_id], 'comment', 1);
                return json_encode(['status' => true]);
            }
        }
        return json_encode(['status' => false, 'message' => "英灵召唤失败啦,/(ㄒoㄒ)/~~"]);
    }

    /**
     * 修改收藏诗文状态
     * @param $id 诗文id
     * @return string
     */
    public function actionAlterCollect($id)
    {
        $model = new PoemExtendForm();
        if (!$model->AlterCollect($id)) {    //修改诗文状态失败
            return json_encode(['status' => false, 'message' => "英灵修改失败!/(ㄒoㄒ)/~~"]);
        }
        $data['status']=CollectModel::findOne(['user_id'=>Yii::$app->user->identity->id,'poem_id'=>$id])->status;
        $data['style']=$data['status']?"fa fa-star":"fa fa-star-o";
        $data['collect']=PoemExtendModel::findOne(['poem_id'=>$id])->collect;
        $data['title']=PoemModel::findOne(['id'=>$id])->title;
        return json_encode(['status' => true,'data'=>$data]);
    }

    /**
     * 修改诗文赞状态
     * @param $id 诗文id
     * @return string
     */
    public function actionAlterPraise($id)
    {
        $model = new PoemExtendForm();
        if (!$model->AlterPraise($id)) {    //修改诗文状态失败
            return json_encode(['status' => false, 'message' => '赞英灵失败啦,/(ㄒoㄒ)/~~']);
        }
        $data['status']=PoempraiseModel::findOne(['user_id'=>Yii::$app->user->identity->id,'poem_id'=>$id])->status;
        $data['style']=$data['status']?"fa fa-thumbs-up":"fa fa-thumbs-o-up";
        $data['praise']=PoemExtendModel::findOne(['poem_id'=>$id])->praise;
        return json_encode(['status' => true,'data'=>$data]);
    }
}