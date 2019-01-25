<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\modules\pkl\utils\Roles;

use kartik\date\DatePicker;
use kartik\grid\GridView;
use fedemotta\datatables\DataTables;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\MitraPkl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Laporan Harian :'.$mahasiswa->nama;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Absensi Mahasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $mahasiswa->nama;
?>
<div class="log-pkl-index">
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            'kegiatan:ntext'
        ],
    ]); ?>
</div>