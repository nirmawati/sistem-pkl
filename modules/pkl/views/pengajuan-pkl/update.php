<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */

$this->title = 'Ubah Data Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Ubah Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mhs_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengajuan-pkl-update">

    <?= $this->render('_form', [
        'model' => $model,
        'mahasiswa' => $mahasiswa,
        'userid' =>$userid,
        'mahasiswaProdi' => $mahasiswaProdi,
    ]) ?>

</div>
