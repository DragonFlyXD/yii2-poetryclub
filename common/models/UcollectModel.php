<?php

/**
 * file UcollectModel.php 原创诗文收藏模型
 */
namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "ucollect".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $upoem_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class UcollectModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ucollect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'upoem_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'upoem_id', 'status', 'created_at', 'updated_at'], 'integer'],
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
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
