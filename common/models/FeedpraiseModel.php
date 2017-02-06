<?php

/**
 * file FeedpraiseModel.php 用户评论赞的模型
 */
namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "feedpraise".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $feed_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class FeedpraiseModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedpraise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'feed_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'feed_id', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'feed_id' => 'Feed ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
