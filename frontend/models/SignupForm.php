<?php

/**
 * file SignupForm.php 注册表单
 */
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\UserModel;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repassword;
    public $phone;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => Yii::t('common', 'This username has already been taken.')],
            ['username', 'match',
                'pattern' => '/^[(\x{4E00}-\x{9FA5})a-zA-Z]+[(\x{4E00}-\x{9FA5})a-zA-Z0-9_-]*$/u',
                'message' => '用户名由字母,汉字,数字,"_","-"组成,且不能以数字和"_","-"开头。',
            ],
            ['username', 'string', 'min' => 2, 'max' => 20],

            [['password', 'repassword'], 'required'],
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 20],
            ['password', 'match',
                'pattern' => '/^[A-Za-z0-9_-]{6,20}$/',
                'message' => Yii::t('common', 'The password is supported by the numbers, letters, "_" and "-".')
            ],
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('common', 'Two password input is not consistent.')],

            ['email', 'trim'],
            ['email', 'match',
                'pattern' => '/^[A-Za-z0-9_-]+@[A-Za-z0-9_-]+(\.[A-Za-z0-9_-]+)+$/',
                'message' => Yii::t('common', 'Wrong format.'),
            ],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => Yii::t('common', 'This email address has already been taken.')],

            ['phone', 'trim'],
            ['phone', 'string', 'length' => [11, 11]],
            ['phone', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => Yii::t('common', 'This phone has already been taken.')],
            ['phone', 'match',
                'pattern' => '/^1(\3|4|5|7|8)\d{9}$/',
                'message' => Yii::t('common', 'Wrong format.'),
            ],

            ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return UserModel|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new UserModel();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'email' => '邮箱',
            'repassword' => '确认密码',
            'phone' => '手机号码',
            'verifyCode' => '验证码',
        ];
    }

}
