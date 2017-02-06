<?php

/**
 * file FeedModel.php 用户反馈信息模型
 */
namespace common\models;

use Yii;

/**
 * This is the model class for table "feed".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $content
 * @property integer $poem_id
 * @property integer $created_at
 */
class FeedModel extends \common\models\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'content', 'created_at','poem_id'], 'required'],
            [['user_id', 'created_at','poem_id'], 'integer'],
            [['content'], 'string', 'max' => 255],
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
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }

    /**
     * 一对一关联用户表
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserModel::className(), ['id' => 'user_id']);
    }
}
