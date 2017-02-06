<?php

/**
 * file RelationUpoemStatusModel.php 原创诗文与扩展状态表
 */
namespace common\models;

use Yii;
use common\models\base\BaseModel;

/**
 * This is the model class for table "relation_upoem_status".
 *
 * @property integer $id
 * @property integer $upoem_id
 * @property integer $user_id
 */
class RelationUpoemStatusModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation_upoem_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upoem_id', 'user_id'], 'required'],
            [['upoem_id', 'user_id'], 'integer'],
            [['upoem_id', 'user_id'], 'unique', 'targetAttribute' => ['upoem_id', 'user_id'], 'message' => 'The combination of Upoem ID and User ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'upoem_id' => 'Upoem ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * 一对一关联收藏表
     * @return \yii\db\ActiveQuery
     */
    public function getCollect()
    {
        return $this->hasOne(UcollectModel::className(), ['upoem_id' => 'upoem_id', 'user_id' => 'user_id']);
    }

    /**
     * 一对一关联赞表
     * @return \yii\db\ActiveQuery
     */
    public function getPraise()
    {
        return $this->hasOne(UpoempraiseModel::className(), ['upoem_id' => 'upoem_id', 'user_id' => 'user_id']);
    }
}
