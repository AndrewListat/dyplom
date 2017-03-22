<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Factory */

$this->title = 'Редагування підприемства: ' . $model->name;
?>
<div class="factory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'contamination' => $contamination,
    ]) ?>

</div>
