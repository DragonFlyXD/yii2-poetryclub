<?php

/**
 * file UfeedForm.php 原创诗文聊天表单
 */

namespace frontend\models;

use Yii;
use common\models\UfeedModel;
use yii\base\Exception;
use yii\base\Model;

class UfeedForm extends Model
{

    public $content;
    public $upoem_id;
    public $_lastError;

    public function rules()
    {
        return [
            [['content', 'upoem_id'], 'required'],
            ['upoem_id', 'integer'],
            ['content', 'string', 'max' => 255],
        ];
    }

    public function attributeLables()
    {
        return [
            'content' => '内容',
        ];
    }

    /**
     * 获取用户反馈信息
     * @param int $limit
     * @return array
     */
    public function getList($limit = 10)
    {
        $model = new UfeedModel();
        $res = $model->find()
            ->with('user')
            ->limit($limit)
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
            $model = new UfeedModel();
            $model->user_id = Yii::$app->user->identity->id;
            $model->upoem_id = $this->upoem_id;
            $model->content = $this->content;
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