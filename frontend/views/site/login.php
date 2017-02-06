<?php

/**
 * file login.php 登录视图
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('common', 'Login Ya');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username', [
            'inputOptions' => [
                'placeholder' => Yii::t('common', 'Please enter your username'),
            ],
            'inputTemplate' =>
                '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>{input}</div>',
        ])->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password', [
            'inputOptions' => [
                'placeholder' => Yii::t('common', 'Please enter your password'),
            ],
            'inputTemplate' =>
                '<div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>{input}</div>'
            ,
        ])->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="reset-pwd">
            <?= Yii::t('common', 'If you forgot your password you can') ?>
            <?= Html::a(Yii::t('common', 'reset it'), ['site/request-password-reset']) ?>.
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('common', 'Login Ya!'), ['id' => 'login-button', 'class' => 'btn btn-success btn-block center-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-1 mid-line"></div>
    <div class="col-lg-5 pull-right">
        <?= Html::img(Yii::$app->params['common']['poet'], ['alt' => Yii::t('common', 'poet')]) ?>
    </div>
</div>
