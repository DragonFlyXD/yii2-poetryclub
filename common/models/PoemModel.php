<?php

/**
 * 诗文模型
 */

namespace common\models;

use common\models\base\BaseModel;
use Yii;

/**
 * This is the model class for table "poem".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $label_img
 * @property integer $cat_id
 * @property integer $is_valid
 * @property integer $created_at
 * @property integer $updated_at
 * @property int
 */
class PoemModel extends BaseModel
{

    /**
     * 定义文章是否发布
     * IS_VALID 已经发布
     * NO_VALID 尚未发布
     */
    const IS_VALID = 10;
    const NO_VALID = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['cat_id', 'is_valid', 'created_at', 'updated_at','author_id'], 'integer'],
            [['title', 'summary', 'label_img','author_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'summary' => 'Summary',
            'content' => 'Content',
            'label_img' => 'Label Img',
            'cat_id' => 'Cat ID',
            'is_valid' => 'Is Valid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'author_id'=>'作者ID',
            'author_name'=>'作者名字',
        ];
    }

    /**
     * 一对一的关联分类表
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(CatModel::className(), ['id' => 'cat_id']);
    }

    /**
     * 一对一的关联诗文扩展表
     * @return \yii\db\ActiveQuery
     */
    public function getExtend()
    {
        return $this->hasOne(PoemExtendModel::className(), ['poem_id' => 'id']);
    }

    /**
     * 一对多的关联诗文与标签表
     * 即,一篇诗文能拥有多个标签
     * @return \yii\db\ActiveQuery
     */
    public function getRelate()
    {
        return $this->hasMany(RelationPoemTagModel::className(), ['poem_id' => 'id']);
    }

    /**
     * 一对一关联诗文与扩展状态表
     * @return \yii\db\ActiveQuery
     */
    public function getRelateStat(){
        return $this->hasOne(RelationPoemStatusModel::className(),['poem_id'=>'id']);
    }
}
