<?php

/**
 * file UpoemExtendModel.php 原创诗文扩展表
 */
namespace common\models;

use common\models\base\BaseModel;
use Yii;

/**
 * This is the model class for table "upoem_extend".
 *
 * @property integer $id
 * @property integer $upoem_id
 * @property integer $page_view
 * @property integer $user_view
 * @property integer $collect
 * @property integer $praise
 * @property integer $comment
 */
class UpoemExtendModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'upoem_extend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upoem_id'], 'required'],
            [['upoem_id', 'page_view', 'user_view', 'collect', 'praise', 'comment'], 'integer'],
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
            'page_view' => 'Page View',
            'user_view' => 'User View',
            'collect' => 'Collect',
            'praise' => 'Praise',
            'comment' => 'Comment',
        ];
    }


}
