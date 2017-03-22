<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab_1" aria-expanded="true">Основные</a></li>
            <li class=""><a data-toggle="tab" href="#tab_3" aria-expanded="false">Seo оптимизация</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab_1" class="tab-pane active">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'desc')->widget(CKEditor::className(), [
                    'options' => ['rows' => 6],
                    'preset' => 'full',
                    'clientOptions' => ElFinder::ckeditorOptions(['elfinder','path' => 'pages'], ['language'=>'ru']),
                ]) ?>
            </div><!-- /.tab-pane -->
            <div id="tab_3" class="tab-pane">
                <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'seo_desc')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'seo_key')->textInput(['maxlength' => true]) ?>
            </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
