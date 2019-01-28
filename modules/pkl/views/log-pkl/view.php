<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LogPkl */

$this->title = $model->pkl->viewMhsProdi->nama;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Hadir', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-pkl-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'pkl_id',
            [
                'attribute'=>'tanggal',
                'format'=>['Date','php:d-M-Y']
            ],
            'jam_masuk',
            'jam_pulang',
            'kegiatan:ntext',
            [
                'attribute' => 'ket',
                'value' => function ($data) {
                    if ($data->ket == 0) {
                        return "Mangkir";
                    }else if ($data->ket == 1) {
                        return "Hadir";
                    }else if ($data->ket == 2) { 
                        return "Sakit";
                    }
                },
            ],
            
        ],
    ]) ?>

</div>
