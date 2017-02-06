<?php

/**
 * file UfeedModel.php 原创诗文聊天模型
 */
namespace common\models;

use common\models\base\BaseModel;
use Yii;

/**
 * This is the model class for table "ufeed".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $upoem_id
 * @property string $content
 * @property integer $created_at
 */
class UfeedModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ufeed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'upoem_id', 'content', 'created_at'], 'required'],
            [['user_id', 'upoem_id', 'created_at'], 'integer'],
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
            'upoem_id' => 'Upoem ID',
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }

    /**
     * 一对一关联用户表
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(UserModel::className(),['id'=>'user_id']);
    }
}
