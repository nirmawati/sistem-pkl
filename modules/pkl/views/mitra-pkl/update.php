<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MitraPkl */

$this->title = 'Update Mitra Pkl: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Mitra Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mitra-pkl-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
