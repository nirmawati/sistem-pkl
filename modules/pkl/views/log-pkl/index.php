<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Harian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-pkl-index">

    <p>
        <?= Html::button('Tambah Absensi ', ['value' => Url::to('log-pkl/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>

    <?php 
    Modal::begin([
        'header' => '<h4>Tambah Absensi</h4>',
        'id' => 'modal',
        'size' => 'modal-lg'
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'pkl_id',
            [
                'attribute' => 'ket',
                'format' => 'text',
                'filter' => ['0' => 'Mangkir', '1' => 'Hadir', '2' => 'Izin'],
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'content' => function ($data) {
                    if ($data->ket == 1) {
                        $ket = 'Hadir';
                    } elseif ($data->ket == 2) {
                        $ket = 'Izin';
                    } else {
                        $ket = 'Mangkir';
                    }
                    return $ket;
                }

            ],
            [
                'attribute' => 'tanggal',
                'value' => 'tanggal',
                'format' => [
                    'Date',
                    'dd-MMM-yyyy'
                ],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'tanggal',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy',
                    ],
                ]),
            ],
            'jam_masuk',
            'jam_pulang',
            'kegiatan:ntext',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
