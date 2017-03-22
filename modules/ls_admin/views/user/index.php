<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ls_admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'username',
            'lastname',
            'login',
            'email',
            // 'password_hash',
            // 'password',
            [
                'attribute'=>'status',
                //'label'=>'Родительская категория',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return ($data->status == 10) ? 'доступен': 'заблокирован';
                },
                'filter' => array("10"=>"доступен","1"=>"заблокирован"),
            ],
             'role',
            // 'auth_key',
            // 'secret_key',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
