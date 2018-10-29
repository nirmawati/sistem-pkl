<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ListMahasiswaPkl */

$this->title = 'Create List Mahasiswa Pkl';
$this->params['breadcrumbs'][] = ['label' => 'List Mahasiswa Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-mahasiswa-pkl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
