<?php

/**
 * file UcenterModel.php 用户中心模型
 */
namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "ucenter".
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $id
 * @property integer $user_id
 * @property string $alias
 * @property integer $last_login_time
 * @property integer $gender
 * @property string $birthday
 * @property string $signature
 * @property string $city
 * @property string $position

 */
class UcenterModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ucenter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_id', 'required'],
            [['user_id','gender'], 'integer'],
            [['birthday'], 'safe'],
            [['alias', 'signature', 'city', 'position'], 'string', 'max' => 255],
            [['alias'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'alias' => 'Alias',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
            'signature' => 'Signature',
            'city' => 'City',
            'position' => 'Position',
        ];
    }

    /**
     * 一对一关联用户表
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(UserModel::className(),['id'=>'user_id']);
    }
}
