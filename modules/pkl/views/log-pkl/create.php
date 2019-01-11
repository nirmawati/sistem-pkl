<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LogPkl */

$this->title = 'Tambah Absensi';
$this->params['breadcrumbs'][] = ['label' => 'Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-pkl-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
