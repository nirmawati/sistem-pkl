<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KategoriIndustri */

$this->title = 'Update Kategori : ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kategori Industris', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->nama]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kategori-industri-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
