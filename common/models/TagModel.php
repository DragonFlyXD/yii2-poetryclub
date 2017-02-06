<?php

/**
 * 标签模型
 */
namespace common\models;

use Yii;
use common\models\base\BaseModel;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $tag_name
 * @property integer $poem_num
 */
class TagModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poem_num'], 'integer'],
            [['tag_name'], 'string', 'max' => 255],
            [['tag_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_name' => '标签名字',
            'poem_num' => '关联诗文数目',
        ];
    }

}
