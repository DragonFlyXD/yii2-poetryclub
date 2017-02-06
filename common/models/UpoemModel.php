<?php

/**
 * file UpoemModel.php 原创诗文模型
 */
namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "upoem".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $label_img
 * @property integer $cat_id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $is_valid
 * @property integer $created_at
 * @property integer $updated_at
 */
class UpoemModel extends BaseModel
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
        return 'upoem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'summary', 'content', 'cat_id', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['content'], 'string'],
            [['cat_id', 'user_id', 'is_valid', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_img', 'user_name'], 'string', 'max' => 255],
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
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'is_valid' => 'Is Valid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
        return $this->hasOne(UpoemExtendModel::className(), ['upoem_id' => 'id']);
    }

    /**
     * 一对多的关联诗文与标签表
     * 即,一篇诗文能拥有多个标签
     * @return \yii\db\ActiveQuery
     */
    public function getRelate()
    {
        return $this->hasMany(RelationUpoemTagModel::className(), ['upoem_id' => 'id']);
    }

    /**
     * 一对一关联原创诗文与扩展状态表
     * @return \yii\db\ActiveQuery
     */
    public function getRelateStat(){
        return $this->hasOne(RelationUpoemStatusModel::className(),['upoem_id'=>'id']);
    }

}
