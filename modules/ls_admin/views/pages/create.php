<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Pages */

$this->title = 'Создать страницу';
?>
<div class="pages-create">
    <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
