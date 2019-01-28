<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MitraPkl */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Mitra Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitra-pkl-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nama',
            'alamat',
            'kontak',
            'telpon',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    if ($data->status == 0) {
                        return "Tersedia";
                    }else if ($data->status == 1) { 
                        return "Tidak Tersedia";
                    }
                },
            ],
            [
                'attribute' => 'kategori_id',
                'value' => $model->kategori->nama,
            ],

        ],
    ]) ?>


</div>
