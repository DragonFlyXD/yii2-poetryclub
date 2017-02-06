<?php

/**
 * file create.php 诗文创建页面
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = '创建';
$this->params['breadcrumb'][] = ['label' => '原创', 'url' => ['original/index']];
$this->params['breadcrumb'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">创建诗文</div>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin() ?>
                <?= $form->field($model, 'title')->textInput(['maxLength' => true]) ?>
                <?= $form->field($model, 'cat_id')->dropDownList($cat) ?>
                <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload', [
                    'config' => [
                        'domain_url' => 'http://www.poetryclub.com'
                    ]
                ]) ?>
                <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor', [
                    'options' => [

                    ]
                ]) ?>
                <?= $form->field($model, 'tags')->widget('common\widgets\tags\TagWidget') ?>
                <div class="form-group">
                    <?= Html::submitButton('发&nbsp;&nbsp;&nbsp;&nbsp;布', ['class' => "btn btn-primary btn-block"]) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="panel-title">注意事项</div>
            </div>
            <div class="panel-body">
                <p>不要说话</p>
                <p>不要说话</p>
                <p>不要说话</p>
                <p>不要说话</p>
            </div>
        </div>
    </div>
</div>
