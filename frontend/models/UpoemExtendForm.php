<?php

/**
 * file UpoemExtendForm.php 原创诗文扩展表单
 */

namespace frontend\models;

use common\models\UpoempraiseModel;
use yii\base\Exception;
use common\models\RelationUpoemStatusModel;
use common\models\UcollectModel;
use common\models\UpoemExtendModel;
use Yii;
use yii\base\Model;

class UpoemExtendForm extends Model
{
    public $upoem_id;
    public $user_id;
    public $page_view;
    public $user_view;
    public $collect;
    public $praise;
    public $comment;

    public function rules()
    {
        return [
            ['upoem_id', 'user', 'required'],
            [['upoem_id', 'page_view', 'user_view', 'collect', 'praise', 'comment'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'upoem_id' => "原创诗文ID",
            'page_view' => "浏览量",
            'user_view' => "访问量",
            'collect' => '收藏量',
            'praise' => '赞',
            'comment' => '评论量',
        ];
    }

    /**
     * 获得原创诗文扩展状态信息
     * @param $upoem_id 原创诗文ID
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getPoemExtendInfo($upoem_id)
    {
        //如果是游客,则图标显示默认状态
        $res['collect']['style'] = "fa fa-star-o";
        $res['collect']['status'] = 0;
        $res['praise']['status'] = 0;
        $res['praise']['style'] = "fa fa-thumbs-o-up";

        if (!Yii::$app->user->isGuest) {

            $result = RelationUpoemStatusModel::findOne(['upoem_id' => $upoem_id, 'user_id' => Yii::$app->user->identity->id]);
            if (!$result) { //用户第一次访问该页面
                $model = new RelationUpoemStatusModel();
                $model->user_id = Yii::$app->user->identity->id;
                $model->upoem_id = $upoem_id;
                if (!$model->save()) {
                    throw new Exception("原创诗文扩展状态信息添加失败!/(ㄒoㄒ)/~~");
                }

                return $res; //返回图标默认状态
            }
            //获取收藏状态和赞状态
            $res = RelationUpoemStatusModel::find()
                ->with('collect', 'praise')
                ->where(['upoem_id' => $upoem_id, 'user_id' => Yii::$app->user->identity->id])
                ->asArray()
                ->one();
            //如果为空,则去默认状态。反之,取已收藏或已赞的状态。
            $res['collect']['style'] = $res['collect']['status'] == 0 ? "fa fa-star-o" : "fa fa-star";
            $res['praise']['style'] = $res['praise']['status'] == 0 ? "fa fa-thumbs-o-up" : "fa fa-thumbs-up";
            $res['collect']['status'] = isset($res['collect']['status']) ? $res['collect']['status'] : 0;
            $res['praise']['status'] = isset($res['praise']['status']) ? $res['praise']['status'] : 0;
        }

        return $res;
    }

    public function getCollInfo($user_id,$upoem_id){
        $res=UcollectModel::findAll(['user_id'=>$user_id,'status'=>10]);
    }

    /**
     * 修改收藏原创诗文状态
     * @param $upoem_id 原创诗文ID
     * @return bool
     */
    public function AlterCollect($upoem_id)
    {
        try {
            $res = UcollectModel::findOne(['user_id' => Yii::$app->user->identity->id, 'upoem_id' => $upoem_id]);
            if (!$res) { //用户第一次收藏
                $model = new UcollectModel();
                $model->setAttributes(['user_id' => Yii::$app->user->identity->id, 'upoem_id' => $upoem_id]);
                $model->status = 10;
                $model->created_at = time();
                $model->updated_at = time();
                if (!$model->save()) {
                    throw new Exception("诗文收藏数据添加失败!/(ㄒoㄒ)/~~");
                }
                //添加诗文收藏数量
                $model = new UpoemExtendModel();
                if (!$model->upCounter(['upoem_id' => $upoem_id], 'collect', 1, true)) { //如果收藏失败
                    throw new Exception("诗文收藏失败!/(ㄒoㄒ)/~~");
                }

            } else { //如果找到了数据,则修改之
                $res->updated_at=time();    //修改收藏时间
                $status = $res->status = $res->status == 0 ? 10 : 0;
                if (!$res->save()) {
                    throw new Exception("诗文收藏状态修改失败!/(ㄒoㄒ)/~~");
                }

                $model = new UpoemExtendModel();
                if ($status == 10) { //如果是诗文已收藏状态,则诗文收藏数+1
                    if (!$model->upCounter(['upoem_id' => $upoem_id], 'collect', 1, true)) { //如果收藏失败
                        throw new Exception("诗文收藏失败!/(ㄒoㄒ)/~~");
                    }
                } else {  //如果是诗文未收藏状态,则诗文收藏数-1
                    if (!$model->upCounter(['upoem_id' => $upoem_id], 'collect', -1, true)) { //如果收藏失败
                        throw new Exception("诗文收藏失败!/(ㄒoㄒ)/~~");
                    }
                }
            }

            return true;
        } catch (Exception $ex) {
            $this->_lastError = $ex->getMessage();
            return false;
        }
    }

    /**
     * 修改赞原创诗文状态
     * @param $upoem_id 原创诗文ID
     * @return bool
     */
    public function AlterPraise($upoem_id)
    {
        try {
            $res = UpoempraiseModel::findOne(['user_id' => Yii::$app->user->identity->id, 'upoem_id' => $upoem_id]);
            if (!$res) { //用户第一次赞诗文
                $model = new UpoempraiseModel();
                $model->setAttributes(['user_id' => Yii::$app->user->identity->id, 'upoem_id' => $upoem_id]);
                $model->status = 10;
                $model->created_at = time();
                $model->updated_at = time();
                if (!$model->save()) {
                    throw new Exception("赞诗文数据添加失败!/(ㄒoㄒ)/~~");
                }
                //添加诗文赞数量
                $model = new UpoemExtendModel();
                if (!$model->upCounter(['upoem_id' => $upoem_id], 'praise', 1, true)) { //如果赞失败
                    throw new Exception("赞诗文失败!/(ㄒoㄒ)/~~");
                }

            } else { //如果找到了数据,则修改之
                $status = $res->status = $res->status == 0 ? 10 : 0;
                $res->updated_at=time();    //修改点赞时间
                if (!$res->save()) {
                    throw new Exception("赞诗文状态修改失败!/(ㄒoㄒ)/~~");
                }

                $model = new UpoemExtendModel();
                if ($status == 10) { //如果是诗文已赞状态,则诗文赞+1
                    if (!$model->upCounter(['upoem_id' => $upoem_id], 'praise', 1, true)) { //如果赞失败
                        throw new Exception("赞诗文失败!/(ㄒoㄒ)/~~");
                    }
                } else {  //如果是诗文未赞状态,则诗文赞数-1
                    if (!$model->upCounter(['upoem_id' => $upoem_id], 'praise', -1, true)) { //如果赞失败
                        throw new Exception("赞诗文失败!/(ㄒoㄒ)/~~");
                    }
                }
            }

            return true;
        } catch (Exception $ex) {
            $this->_lastError = $ex->getMessage();
            return false;
        }
    }

}