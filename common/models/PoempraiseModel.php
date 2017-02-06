<?php

/**
 * file PoempraiseModel.php 诗文的赞模型
 */
namespace common\models;

use Yii;
use common\models\base\BaseModel;

/**
 * This is the model class for table "poempraise".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $poem_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class PoempraiseModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poempraise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'poem_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'poem_id', 'status', 'created_at', 'updated_at'], 'integer'],
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
            'poem_id' => 'Poem ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
