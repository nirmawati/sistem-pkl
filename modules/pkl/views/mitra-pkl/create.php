<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MitraPkl */

$this->title = 'Tambah Mitra PKL';
$this->params['breadcrumbs'][] = ['label' => 'Mitra Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitra-pkl-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
