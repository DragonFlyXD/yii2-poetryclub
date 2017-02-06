<?php

/**
 * file signup.php 注册视图
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;

$this->title = Yii::t('common', 'Signup Ya');
$this->params['breadcrumbs'][] = $this->title;

//这段js解决yii验证码不刷新
//AppAsset::addScript($this, '/statics/js/refresh_captcha.js');
?>
<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
//            'enableAjaxValidation' => true,
//            'enableClientValidation' => true,
            'validationUrl' => Url::to(['validate-form']),
        ]); ?>

        <?= $form->field($model, 'username', [
            'inputOptions' => [
                'placeholder' => Yii::t('common', 'Your account name and login name'),
            ],
            'inputTemplate' =>
                '<div class="input-group"><span class="input-group-addon" style="background-color: #fff;">&nbsp;用 户 名&nbsp;&nbsp;&nbsp;</span>{input}</div>',
        ])->textInput(['autofocus' => true])->label(false) ?>
        <?= $form->field($model, 'password', [
            'inputOptions' => [
                'placeholder' => Yii::t('common', 'It is recommended to use at least two character combinations'),
            ],
            'inputTemplate' =>
                '<div class="input-group"><span class="input-group-addon" style="background-color: #fff;">&nbsp;设置密码&nbsp;&nbsp;</span>{input}</div>',
        ])->passwordInput()->label(false) ?>
        <?= $form->field($model, 'repassword', [
            'inputOptions' => [
                'placeholder' => Yii::t('common', 'Plear enter your password again'),
            ],
            'inputTemplate' =>
                '<div class="input-group"><span class="input-group-addon" style="background-color: #fff;">&nbsp;确认密码&nbsp;&nbsp;</span>{input}</div>',
        ])->passwordInput()->label(false) ?>
        <?= $form->field($model, 'phone', [
            'inputOptions' => [
                'placeholder' => Yii::t('common', 'Recommended the use of commonly used mobile phones'),
            ],
            'inputTemplate' =>
                '<div class="input-group"><span class="input-group-addon" style="background-color: #fff;">&nbsp;手机号码&nbsp;&nbsp;</span>{input}</div>',
        ])->label(false) ?>
        <?= $form->field($model, 'email', [
            'inputOptions' => [
                'placeholder' => Yii::t('common', 'Recommended to use commonly used mail'),
            ],
            'inputTemplate' =>
                '<div class="input-group"><span class="input-group-addon" style="background-color: #fff;">&nbsp;邮箱账号&nbsp;&nbsp;</span>{input}</div>',
        ])->label(false) ?>
        <?= $form->field($model, 'verifyCode')
            ->widget(Captcha::className(), [
                'imageOptions' => [
                    'id' => 'captcha_img',
                    'title' => Yii::t('common', 'Change another one'),
                    'alt' => Yii::t('common', 'Change another one'),
                ],
                'template' =>
                    '<div class="input-group"><span class="input-group-addon" style="background-color: #fff;">&nbsp;&nbsp;验 证 码&nbsp;&nbsp;&nbsp;</span>
                    {input}<span class="input-group-addon">{image}</span></div>',
            ])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('common', 'Signup Ya!'), ['class' => 'btn btn-success btn-block', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-1 mid-line"></div>
    <div class="col-lg-5 pull-right">
        <?= Html::img(Yii::$app->params['common']['poet'], ['alt' => Yii::t('common', 'poet')]) ?>
    </div>
</div>