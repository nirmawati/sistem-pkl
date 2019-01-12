<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */

$this->title = 'Update Pengajuan Pkl: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pengajuan Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengajuan-pkl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mahasiswa' => $mahasiswa,
        'userid' =>$userid,
        'mahasiswaProdi' => $mahasiswaProdi,
    ]) ?>

</div>
