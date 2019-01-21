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

$this->title = 'Laporan Harian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-pkl-index">
    <p>
        <?php
        if (Roles::currentRole($userid) == Roles::MHS) {
            echo Html::button('Tambah Absensi ', ['value' => Url::to('log-pkl/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']);
            echo Html::a('Download PDF', ['log-pkl/pdf'], ['class' => 'btn btn-primary']);
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

    <?php if (Roles::currentRole($userid) == Roles::MHS) : ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'pkl_id',
                'content' => function ($data) {
                    return $data->pkl->viewMhsProdi->nama;
                }
            ],
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
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete} {update}',
                'visibleButtons' => [
                    'delete' => function ($data) {
                        if (Roles::currentRole(Yii::$app->user->identity->id) == Roles::MHS) {
                            return true;
                        } else {
                            return false;
                        }
                    },
                    'update' => function ($data) {
                        if (Roles::currentRole(Yii::$app->user->identity->id) == Roles::MHS) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                ]
            ],
        ],
    ]); ?>
    <?php elseif (Roles::currentRole($userid) == Roles::DOSEN) : ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Mahasiswa',
                'attribute' => 'nama_mhs',
                'contentOptions' => ['style' => 'white-space: normal;'],
                'content' => function ($data) {
                    return $data->viewMhsProdi->nama;
                }
            ],
            [
                'attribute' => 'mitra_id',
                'value' => 'mitra.nama',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'mitra_id',
                    'data' => ArrayHelper::map(MitraPkl::find()->all(), 'id', 'nama'),
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],

                ]),
            ],
            'topik',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{detail}',
                'visibleButtons' => [
                    'detail' => function ($data) {
                        if (Roles::currentRole(Yii::$app->user->identity->id) == Roles::DOSEN) {
                            return true;
                        } else {
                            return false;
                        }
                    },
                ],
                'buttons' => [
                    'detail' => function ($url) {
                        return Html::a( '<span class="glyphicon glyphicon-eye-open"> </span>', $url, [ 'title' => 'Add Client', 'data-pjax' => '0', ] );
                    }
                ]
            ],
        ],
    ]); ?>
    <?php endif; ?>
</div>
