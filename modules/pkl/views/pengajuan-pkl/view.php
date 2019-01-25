<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */

$this->title = $model->viewMhsProdi->nama;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Mahasiswa PKL', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajuan-pkl-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute'=>'tanggal',
                'format'=>['Date','php:d-M-Y']
            ],
            [
                'attribute' => 'mitra_id',
                'value' => $model->mitra->nama,
            ],
            [
                'attribute'=>'mulai',
                'format'=>['Date','php:d-M-Y']
            ],
            [
                'attribute'=>'selesai',
                'format'=>['Date','php:d-M-Y']
            ],
            [
                'attribute' => 'semester',
                'value' => function ($data) {
                    if ($data->semester == 1) { //ditolak
                        return "Semester 5";
                    }else if ($data->semester == 2) { //menunggu
                        return "Semester 6";
                    }else if ($data->semester == 3) { //menunggu
                        return "Semester 7";
                    }else if ($data->semester == 4) { //menunggu
                        return "Semester 8";
                    }
                },
            ],
            // 'mhs_id',
            [
                'attribute' => 'dosen_id',
                'value' => $model->dosen->nama,
            ],
            'topik',
            [
                'attribute' => 'status_surat',
                'value' => $model->statusSurat->nama,
            ],
            [
                'attribute' => 'status_pelaksanaan',
                'value' => $model->statusPelaksanaan->nama,
            ],
            [
                'attribute' => 'status_kegiatan',
                'value' => $model->statusKegiatan->nama,
            ],
            'bukti'
        ],
    ]) ?>

</div>
