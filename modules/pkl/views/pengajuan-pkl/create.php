<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */

$this->title = 'Registrasi PKL';
$this->params['breadcrumbs'][] = ['label' => 'Pengajuan Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajuan-pkl-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
