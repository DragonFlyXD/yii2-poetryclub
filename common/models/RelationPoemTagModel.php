<?php

/**
 * file RelationPoemTagModel.php 诗文与标签关联模型
 */
namespace common\models;

use common\models\base\BaseModel;
use Yii;

/**
 * This is the model class for table "relation_poem_tag".
 *
 * @property integer $id
 * @property integer $poem_id
 * @property integer $tag_id
 */
class RelationPoemTagModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation_poem_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poem_id', 'tag_id'], 'required'],
            [['poem_id', 'tag_id'], 'integer'],
            [['poem_id', 'tag_id'], 'unique', 'targetAttribute' => ['poem_id', 'tag_id'], 'message' => 'The combination of Poem ID and Tag ID has already been taken.'],
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
