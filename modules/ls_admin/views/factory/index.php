<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ls_admin\models\FactorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Підприемства';
?>
<div class="factory-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box box-success">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//                'id',
                'name',
//                'user_id',
                'address',
//                'coordinate_x',
                // 'coordinate_y',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

</div>
