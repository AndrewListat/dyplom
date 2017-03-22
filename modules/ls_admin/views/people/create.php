<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\People */

$this->title = 'Додати';

?>
<div class="people-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
