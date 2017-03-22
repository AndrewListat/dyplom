<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Pages */

$this->title = $model->name;
?>
<div class="pages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab_1" aria-expanded="true">Основные</a></li>
            <li class=""><a data-toggle="tab" href="#tab_3" aria-expanded="false">Seo оптимизация</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab_1" class="tab-pane active">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'id',
                        'name',
                        'url:url',
                        'desc:html',
//                        'seo_title',
//                        'seo_desc:ntext',
//                        'seo_key',
//            'created_at',
//            'updated_at',
                    ],
                ]) ?>
            </div><!-- /.tab-pane -->
            <div id="tab_3" class="tab-pane">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'id',
//                        'name',
//                        'url:url',
//                        'desc:ntext',
                        'seo_title',
                        'seo_desc:ntext',
                        'seo_key',
//            'created_at',
//            'updated_at',
                    ],
                ]) ?>
            </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
    </div>

</div>
