<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Factory */

$this->title = 'Добавлення підприемства';
?>
<div class="factory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'contamination' => $contamination,
        'model' => $model,
    ]) ?>

</div>
