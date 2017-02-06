<?php

/**
 * file RelationPoemStatusModel.php
 * 诗文与扩展状态关联表
 */
namespace common\models;

use common\models\base\BaseModel;
use Yii;

/**
 * This is the model class for table "relation_poem_status".
 *
 * @property integer $id
 * @property integer $poem_id
 * @property integer $user_id
 */
class RelationPoemStatusModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation_poem_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poem_id', 'user_id'], 'required'],
            [['poem_id', 'user_id'], 'integer'],
            [['poem_id', 'user_id'], 'unique', 'targetAttribute' => ['poem_id', 'user_id'], 'message' => 'The combination of Poem ID and User ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'poem_id' => 'Poem ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * 一对一关联收藏表
     * @return \yii\db\ActiveQuery
     */
    public function getCollect()
    {
        return $this->hasOne(CollectModel::className(), ['poem_id' => 'poem_id', 'user_id' => 'user_id']);
    }

    /**
     * 一对一关联赞表
     * @return \yii\db\ActiveQuery
     */
    public function getPraise()
    {
        return $this->hasOne(PoempraiseModel::className(), ['poem_id' => 'poem_id', 'user_id' => 'user_id']);
    }
}
