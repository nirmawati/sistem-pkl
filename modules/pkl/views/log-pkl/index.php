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
use app\modules\pkl\models\MitraPkl;
use microinginer\dropDownActionColumn\DropDownActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (Roles::currentRole($userid) == Roles::MHS) {
    $this->title = 'Laporan Harian';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Daftar Absensi Mahasiswa';
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="log-pkl-index">

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
            <?php if ($pengajuanPkl == NULL || $pengajuanPkl->status_kegiatan == 6 ||$pengajuanPkl->status_kegiatan == NULL) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <h4><i class="icon fa fa-check"></i> Maaf Anda Belum Diterima di Perusahaan Manapun !</h4>Anda tidak dapat menambah Absensi PKL...
                </div>
            <?php else :?>
                <?=
                 Html::button('Tambah Absensi ', ['value' => Url::to('log-pkl/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']);
                 ?>&emsp;<?php
                    echo Html::a('Cetak Laporan Harian', ['log-pkl/pdf'], ['class' => 'btn btn-primary']);
                ?><br><br>
                <?= DataTables::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        // [
                        //     'attribute' => 'pkl_id',
                        //     'content' => function ($data) {
                        //         return $data->pkl->viewMhsProdi->nama;
                        //     }
                        // ],
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
                            'class' => DropDownActionColumn::className(),
                            'items' => [
            
                                [
                                    'label' => 'Lihat',
                                    'url'   => ['view'],
                                ],
                                [
                                    'label' => 'Hapus',
                                    'url'   => ['delete'],
                                    'visible' => Roles::currentRole(Yii::$app->user->identity->id) == Roles::MHS,
                                    'linkOptions' => [
                                        'data-method' => 'post'
                                    ],
                                ],
                                [
                                    'label' => 'Ubah',
                                    'url'   => ['update'],
                                    'visible' => Roles::currentRole(Yii::$app->user->identity->id) == Roles::MHS,
                                ],
                            ]
                        ],
                       
                        // [
                        //     'class' => 'yii\grid\ActionColumn',
                        //     'template' => '{delete} {update}',
                        //     'visibleButtons' => [
                        //         'delete' => function ($data) {
                        //             if (Roles::currentRole(Yii::$app->user->identity->id) == Roles::MHS) {
                        //                 return true;
                        //             } else {
                        //                 return false;
                        //             }
                        //         },
                        //         'update' => function ($data) {
                        //             if (Roles::currentRole(Yii::$app->user->identity->id) == Roles::MHS) {
                        //                 return true;
                        //             } else {
                        //                 return false;
                        //             }
                        //         }
                        //     ],
                        //     'buttons' => [
                        //         'detail' => function ($url) {
                        //             return Html::a('<span class="glyphicon glyphicon-eye-open"> </span>', $url, ['title' => 'Lihat Absensi', 'data-pjax' => '0', ]);
                        //         },
                        //         'delete' => function ($url) {
                        //             return Html::a('<span class="glyphicon glyphicon-trash"> </span>', $url, ['title' => 'Hapus', 'data-pjax' => '0', ]);
                        //         },
                        //         'view' => function ($url) {
                        //             return Html::a('<span class="glyphicon glyphicon-eye-open"> </span>', $url, ['title' => 'Lihat', 'data-pjax' => '0', ]);
                        //         },
                        //         'update' => function ($url) {
                        //             return Html::a('<span class="glyphicon glyphicon-pencil"> </span>', $url, ['title' => 'Ubah', 'data-pjax' => '0', ]);
                        //         },
                        //     ],
                        // ],
                    ],
                ]); ?>
            <?php endif;?>
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
                    'class' => DropDownActionColumn::className(),
                    'items' => [
    
                        [
                            'label' => 'Lihat',
                            'url'   => ['detail'],
                        ]
                    ]
                ],
            ],
        ]); ?>
    <?php endif; ?>
</div>
