<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\User */

$this->title = 'Обновление user:' . $model->username;
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
