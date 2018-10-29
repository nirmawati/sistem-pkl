<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */

$this->title = $model->tujuan_pengirim;
$this->params['breadcrumbs'][] = ['label' => 'Pengajuan PKL', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajuan-pkl-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'mahasiswa.nama:text:Nama',
            'mahasiswa.nim:text:NIM',
            'alamat_pkl',
            'tujuan_pengirim',
            'topik_pkl',
            'file_krs',
            'file_transkip',
            'status.nama:text:Status',
            'tgl_mulai',
            'tgl_selesai',
        ],
    ]) ?>

</div>
