<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Contamination */

$this->title = 'Update Contamination: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Contaminations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contamination-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
