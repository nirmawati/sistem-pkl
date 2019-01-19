<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\modules\pkl\utils\Roles;

use kartik\date\DatePicker;
use fedemotta\datatables\DataTables;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Harian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-pkl-index">
    <?php
        // echo Select2::widget([
        //     'model' => $model,
        //     'attribute' => 'state_2',
        //     'data' => $data,
        //     'options' => ['placeholder' => 'Select a state ...'],
        //     'pluginOptions' => [
        //         'allowClear' => true
        //     ],
        // ]);
    ?>
    <p>
        <?php
            if (Roles::currentRole($userid) == Roles::MHS) {
                echo Html::button('Tambah Absensi ', ['value' => Url::to('log-pkl/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']);
            }elseif(Roles::currentRole($userid) == Roles::MHS){
                //tampilkan dropdown
            }
        ?>
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

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'pkl_id',
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
