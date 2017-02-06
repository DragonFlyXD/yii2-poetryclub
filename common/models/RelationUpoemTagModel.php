<?php

/**
 * file RelationUpoemTagModel.php 原创诗文与标签关联模型
 */
namespace common\models;

use common\models\base\BaseModel;
use Yii;

/**
 * This is the model class for table "relation_upoem_tag".
 *
 * @property integer $id
 * @property integer $upoem_id
 * @property integer $tag_id
 */
class RelationUpoemTagModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation_upoem_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upoem_id', 'tag_id'], 'required'],
            [['upoem_id', 'tag_id'], 'integer'],
            [['upoem_id', 'tag_id'], 'unique', 'targetAttribute' => ['upoem_id', 'tag_id'], 'message' => 'The combination of Upoem ID and Tag ID has already been taken.'],
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
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * 一对一关联标签表
     * @return \yii\db\ActiveQuery
     */
    public function getTag(){
        return $this->hasOne(TagModel::className(),['id'=>'tag_id']);
    }
}
