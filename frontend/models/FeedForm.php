<?php

/**
 * file FeedForm.php 用户信息反馈表单
 */

namespace frontend\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use common\models\FeedModel;

class FeedForm extends Model
{
    public $content;
    public $poem_id;
    public $_lastError;

    public function rules()
    {
        return [
            [['content','poem_id'], 'required'],
            ['poem_id','integer'],
            ['content', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
        ];
    }

    /**
     * 获取用户反馈列表数据
     * @param int $limit 显示条数
     * @return array
     */
    public function getList($limit = 10)
    {
        $model = new FeedModel();
        $res = $model->find()
            ->limit($limit)
            ->with('user')
            ->orderBy(['id' => SORT_DESC])
            ->asArray()
            ->all();
        return $res ?: [];
    }

    /**
     * 创建用户反馈信息
     * @return bool
     */
    public function create()
    {
        try {
            $model = new FeedModel();
            $model->user_id = Yii::$app->user->identity->id;
            $model->content = $this->content;
            $model->poem_id = $this->poem_id;
            $model->created_at = time();
            if (!$model->save()) {
                throw new Exception("用户反馈信息保存失败!");
            }
            return true;
        } catch (Exception $ex) {
            $this->_lastError = $ex->getMessage();
            return false;
        }
    }
}

