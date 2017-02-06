<?php

/**
 * file PoemExtendModel.php 诗文扩展模型
 */
namespace common\models;

use Yii;
use common\models\base\BaseModel;

/**
 * This is the model class for table "poem_extend".
 *
 * @property integer $id
 * @property integer $poem_id
 * @property integer $page_view
 * @property integer $uesr_view
 * @property integer $collect
 * @property integer $praise
 * @property integer $comment
 */
class PoemExtendModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poem_extend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poem_id', 'page_view', 'uesr_view', 'collect', 'praise', 'comment'], 'integer'],
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
            'page_view' => 'Page View',
            'uesr_view' => 'Uesr View',
            'collect' => 'Collect',
            'praise' => 'Praise',
            'comment' => 'Comment',
        ];
    }

}
