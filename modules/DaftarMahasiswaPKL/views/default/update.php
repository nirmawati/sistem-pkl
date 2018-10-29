<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ListMahasiswaPkl */

$this->title = 'Update List Mahasiswa Pkl: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'List Mahasiswa Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="list-mahasiswa-pkl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
