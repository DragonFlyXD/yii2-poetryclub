<?php

/**
 * file LoginForm.php 后台登录表单
 */
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\UserModel;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;

    public function attributeLabels()
    {
        return [
            'username' => "用户名",
            'password' => '密码',
            'rememberMe' => '记住密码',
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '无效的用户名或密码。');
            }
        }
    }

    /**
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * @return null|static
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = UserModel::findByUsername($this->username);
        }

        return $this->_user;
    }
}
