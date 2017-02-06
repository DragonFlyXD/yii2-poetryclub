<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<!-- 铺满dot -->
<div class="sign-dot"></div>
<!-- 黑色封面 -->
<div class="sign-over"></div>
<!-- 登录panel -->
<div class="panel" id="login">
    <div class="panel-heading">
        <span class="panel-title-u">欢迎登录诗词小筑系统</span>
    </div>
    <div class="panel-body">
        <button type="button" class="btn btn-contact btn-block">联系我们</button>
        <div class="line">LOGIN</div>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form'
        ]); ?>
        <?= $form->field($model, 'username', [
            'inputOptions' => [
                'placeholder' => '请输入账户名',
            ],
            'inputTemplate' =>
                '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>{input}</div>',
        ])->textInput(['autofocus' => true])->label(false) ?>

        <?= $form->field($model, 'password', [
            'inputOptions' => [
                'placeholder' => '请输入密码',
            ],
            'inputTemplate' =>
                '<div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>{input}</div>',
        ])->passwordInput()->label(false) ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-login btn-block']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
