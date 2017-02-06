<?php

/**
 * file PoemExtendForm.php 诗文扩展表单
 */

namespace frontend\models;

use common\models\CollectModel;
use common\models\PoemExtendModel;
use common\models\PoempraiseModel;
use common\models\RelationPoemStatusModel;
use Exception;
use Yii;
use yii\base\Model;


class PoemExtendForm extends Model
{
    public $poem_id;
    public $page_view;
    public $user_view;
    public $collect;
    public $praise;
    public $comment;

    public function rules()
    {
        return [
            ['poem_id', 'required'],
            [['poem_id', 'page_view', 'user_view', 'collect', 'praise', 'comment'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'poem_id' => "原创诗文ID",
            'page_view' => "浏览量",
            'user_view' => "访问量",
            'collect' => '收藏量',
            'praise' => '赞',
            'comment' => '评论量',
        ];
    }

    /**
     * 获得诗文扩展状态信息
     * @param $poem_id 诗文ID
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getPoemExtendInfo($poem_id)
    {
        //如果是游客,则图标显示默认状态
        $res['collect']['style'] = "fa fa-star-o";
        $res['praise']['style'] = "fa fa-thumbs-o-up";
        $res['collect']['status'] = 0;
        $res['praise']['status'] = 0;

        if (!Yii::$app->user->isGuest) {
            $result = RelationPoemStatusModel::findOne(['poem_id' => $poem_id, 'user_id' => Yii::$app->user->identity->id]);
            if (!$result) { //用户第一次访问该页面
                $model = new RelationPoemStatusModel();
                $model->user_id = Yii::$app->user->identity->id;
                $model->poem_id = $poem_id;
                if (!$model->save()) {
                    throw new Exception("原创诗文扩展状态信息添加失败!/(ㄒoㄒ)/~~");
                }
                return $res; //返回图标默认状态
            }
            //获取收藏状态和赞状态
            $res = RelationPoemStatusModel::find()
                ->with('collect', 'praise')
                ->where(['poem_id' => $poem_id, 'user_id' => Yii::$app->user->identity->id])
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

    /**
     * 修改收藏诗文状态
     * @param $poem_id 诗文ID
     * @return bool
     */
    public function AlterCollect($poem_id)
    {
        try {
            $res = CollectModel::findOne(['user_id' => Yii::$app->user->identity->id, 'poem_id' => $poem_id]);
            if (!$res) { //如果第一次收藏
                $model = new CollectModel();
                $model->setAttributes(['user_id' => Yii::$app->user->identity->id, 'poem_id' => $poem_id]);
                $model->status = 10;
                $model->created_at = time();
                $model->updated_at = time();
                if (!$model->save()) {
                    throw new Exception("诗文收藏数据添加失败!/(ㄒoㄒ)/~~");
                }
                //添加诗文收藏数量
                $model = new PoemExtendModel();
                if (!$model->upCounter(['poem_id' => $poem_id], 'collect', 1)) { //如果收藏失败
                    throw new Exception("诗文收藏失败!/(ㄒoㄒ)/~~");
                }

            } else { //如果找到了数据,则修改之
                $status = $res->status = $res->status == 0 ? 10 : 0;
                $res->updated_at=time();    //修改收藏事件
                if (!$res->save()) {
                    throw new Exception("诗文收藏状态修改失败!/(ㄒoㄒ)/~~");
                }

                $model = new PoemExtendModel();
                if ($status==10) { //如果是诗文已收藏状态,则诗文收藏数+1
                    if (!$model->upCounter(['poem_id' => $poem_id], 'collect', 1)) { //如果收藏失败
                        throw new Exception("诗文收藏失败!/(ㄒoㄒ)/~~");
                    }
                } else {  //如果是诗文未收藏状态,则诗文收藏数-1
                    if (!$model->upCounter(['poem_id' => $poem_id], 'collect', -1)) { //如果收藏失败
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
     * 修改赞诗文状态
     * @param $poem_id 诗文ID
     * @return bool
     */
    public function AlterPraise($poem_id)
    {
        try {
            $res = PoempraiseModel::findOne(['user_id' => Yii::$app->user->identity->id, 'poem_id' => $poem_id]);
            if (!$res) { //用户第一次赞
                $model = new PoempraiseModel();
                $model->setAttributes(['user_id' => Yii::$app->user->identity->id, 'poem_id' => $poem_id]);
                $model->status = 10;
                $model->created_at = time();
                $model->updated_at = time();
                if (!$model->save()) {
                    throw new Exception("赞诗文数据添加失败!/(ㄒoㄒ)/~~");
                }
                //添加诗文赞数量
                $model = new PoemExtendModel();
                if (!$model->upCounter(['poem_id' => $poem_id], 'praise', 1)) { //如果赞失败
                    throw new Exception("赞诗文失败!/(ㄒoㄒ)/~~");
                }

            } else { //如果找到了数据,则修改之
                $status = $res->status = $res->status == 0 ? 10 : 0;
                $res->updated_at=time();    //修改点赞时间
                if (!$res->save()) {
                    throw new Exception("赞诗文状态修改失败!/(ㄒoㄒ)/~~");
                }

                $model = new PoemExtendModel();
                if ($status == 10) { //如果是诗文已赞状态,则诗文赞数量+1
                    if (!$model->upCounter(['poem_id' => $poem_id], 'praise', 1)) { //如果赞失败
                        throw new Exception("赞诗文失败!/(ㄒoㄒ)/~~");
                    }
                } else {  //如果是诗文未赞状态,则诗文赞数量-1
                    if (!$model->upCounter(['poem_id' => $poem_id], 'praise', -1)) { //如果赞失败
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