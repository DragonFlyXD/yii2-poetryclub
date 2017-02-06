<?php

/**
 * file UfeedpraiseModel.php 原创用户反馈赞模型
 */
namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "ufeedpraise".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $ufeed_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class UfeedpraiseModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ufeedpraise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ufeed_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'ufeed_id', 'status', 'created_at', 'updated_at'], 'integer'],
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
            'ufeed_id' => 'Ufeed ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
