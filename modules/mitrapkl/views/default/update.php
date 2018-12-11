<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MitraPkl */

$this->title = 'Update Mitra Pkl: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mitra Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mitra-pkl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
