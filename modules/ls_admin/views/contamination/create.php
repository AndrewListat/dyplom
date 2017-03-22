<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Contamination */

$this->title = 'Create Contamination';
$this->params['breadcrumbs'][] = ['label' => 'Contaminations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contamination-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
