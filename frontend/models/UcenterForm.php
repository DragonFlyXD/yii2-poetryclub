<?php

/**
 * file UcenterForm.php 用户中心表单
 */

namespace frontend\models;

use common\models\UcenterModel;
use yii\base\Exception;
use yii\base\Model;
use Yii;

class UcenterForm extends Model
{

    public $alias;
    public $gender;
    public $birthday;
    public $signature;
    public $city;
    public $position;

    public $_lastError = "";

    public function attributeLabels()
    {
        return [
            'alias' => '昵称',
        ];
    }

    public function rules()
    {
        return [
            ['gender', 'integer'],
            [['birthday'], 'safe'],
            [['alias', 'signature', 'city', 'position'], 'string', 'max' => 255],
            [['alias'], 'unique', 'targetClass' => '\common\models\UcenterModel'],
        ];
    }

    /**
     * 根据用户ID获取用户注册信息和个人信息
     * @param $id 用户ID
     * @return array
     * @throws Exception
     */
    public static function getInfoById($id)
    {
        $res = UcenterModel::find()
            ->with('user')
            ->where(['user_id' => $id])
            ->asArray()
            ->one();
        return $res ?: [];
    }

    /**
     * 修改个人信息
     * @return bool
     */
    public function alterUserInfo()
    {
        try {
            $res = UcenterModel::findOne(['user_id' => Yii::$app->user->identity->id]);
            if (!$res) { //如果没有个人用户信息,则新建一条
                $model = new UcenterModel();
                $model->setAttributes($this->attributes);
                $model->user_id = Yii::$app->user->identity->id;
                $model->created_at = time();
                $model->updated_at = time();
                if (!$model->save()) {
                    throw new Exception("个人用户信息新添失败!");
                }
            } else {

                //修改用户信息
                foreach (Yii::$app->request->post() as $key => $item) {
                    if (isset($item) && !empty($item)) {
                        $res->$key = $item;
                    }
                }
                if (!$res->save()) {
                    throw new Exception("个人用户信息修改失败!");
                }
            }

            return true;
        } catch (Exception $ex) {
            $this->_lastError = $ex->getMessage();
            return false;
        }
    }

    public function getCollRecord($id,$original){

    }
}