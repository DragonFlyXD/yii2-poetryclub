<?php

/**
 * file CatModel.php 诗文分类模型
 */
namespace common\models;

use Yii;
use common\models\base\BaseModel;

/**
 * This is the model class for table "cat".
 *
 * @property integer $id
 * @property string $cat_name
 */
class CatModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_name' => '分类名字',
        ];
    }

    /**
     * 获取所有诗文分类
     * @return array
     */
    public static function getAllCat()
    {
        $cat = ['0' => '暂无分类'];
        $res = self::find()
            ->asArray()
            ->all();
        if ($res) {
            foreach ($res as $item) {
                $cat[$item['id']] = $item['cat_name'];
            }
        }
        return $cat;
    }
}
