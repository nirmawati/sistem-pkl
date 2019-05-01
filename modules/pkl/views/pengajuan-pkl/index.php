<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\bootstrap\ButtonDropdown;

use app\modules\pkl\models\StatusPkl;
use app\modules\pkl\models\MitraPkl;
use app\modules\pkl\models\Prodi;
use app\modules\pkl\utils\Roles;

use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\editable\Editable;
use kartik\grid\GridView;

use microinginer\dropDownActionColumn\DropDownActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PengajuanPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if (Roles::currentRole($userid) == Roles::MHS) {
    $this->title = 'Mahasiswa PKL';
}else{
    $this->title = 'Daftar Mahasiswa PKL';
}
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="pengajuan-pkl-index">
<!-- <h1><?= Html::encode($this->title) ?></h1> -->
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <?php
        //$status_surat = $model->status_surat == NULL || $model->status_surat != 3; //status surat ditolak
        //$status_kegiatan = $model->status_kegiatan == NULL || $model->status_kegiatan != 3; //status kegiatan ditolak
        
        if (Roles::currentRole($userid) == Roles::MHS) {
            if($model == NULL){
                echo '<div class="alert alert-danger alert-dismissible">
                    <h4><i class="icon fa fa-check"></i> BELUM DAFTAR !</h4> Anda belum terdaftar sebagai Mahasiswa PKL, silahkan daftar terlebih dahulu untuk memulai kegiatan PKL..
                </div>';
                echo Html::button('Daftar Sekarang', ['value' => Url::to('pengajuan-pkl/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']);
            }
            else if ($model->status_surat == 3 && $model->status_pelaksanaan == 2) {
                echo '<div class="alert alert-success alert-dismissible">
                        <!-- <button type="button" class="close" aria-hidden="true">×</button> -->
                        <h4><i class="icon fa fa-check"></i> Surat Pengajuan Selesai!</h4>Silahkan Ambil Surat Pengantar PKL Anda diruang BAAK...
                    </div>';
            }else if ($model->status_surat == 3 && $model->status_pelaksanaan == 4 && $model->status_kegiatan == 5) {
                echo '<div class="alert alert-success alert-dismissible">
                        <!-- <button type="button" class="close" aria-hidden="true">×</button> -->
                        <h4><i class="icon fa fa-check"></i> SELAMAT ANDA TELAH DITERIMA !!</h4>Semangat melaksanakan kegiatan PKL, Jangan Lupa lengkapi detail dan absensinya ya...
                    </div>';
            }else if ($model->status_surat == 3 && $model->status_pelaksanaan == 4 && $model->status_kegiatan == 3 ) {
                echo '<div class="alert alert-success alert-dismissible">
                        <!-- <button type="button" class="close" aria-hidden="true">×</button> -->
                        <h4><i class="icon fa fa-check"></i> SELAMAT ANDA TELAH SELESAI PKL !!</h4>Semangat melaksanakan kegiatan PKL, Jangan Lupa lengkapi detail dan absensinya ya...
                    </div>';
            } else if ($model->status_surat == 2 && $model->status_pelaksanaan == 6 & $model->status_kegiatan == 6) {
                echo '<div class="alert alert-warning alert-dismissible">
                        <!-- <button type="button" class="close" aria-hidden="true">×</button> -->
                        <h4><i class="icon fa fa-check"></i> Tunggu ya!</h4>Surat Pengantar PKL Anda sedang diproses...
                    </div>';
            }
        }
    ?>
</p>

<?php 
    Modal::begin([
        'header' => '<h4>Lembar Pendaftaran</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
        'options' => [
            'tabindex' => false,
        ]
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>

<?php 
    $isBAAK = true;
    $isDosen = true;
    $isMhs = true;

    if (Roles::currentRole($userid) == Roles::BAAK) {
        $isBAAK = false;
    } elseif (Roles::currentRole($userid) == Roles::DOSEN && $model != NULL && $model->status_kegiatan!=6) {
        $isDosen = false;
    } elseif (Roles::currentRole($userid) == Roles::MHS && $model != NULL && $model->status_pelaksanaan!=6 ) {
        $isMhs = false;
    }
?>
<?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'label' => 'Mahasiswa',
                'attribute' => 'mhs_id',
                'contentOptions' => ['style' => 'width:1000px; white-space: normal;'],
                'content' => function ($data) {
                    return $data->viewMhsProdi->nama;
                }
            ],
            [
                'label' => 'Prodi',
                'attribute' => 'mhs_id',
                'contentOptions' => ['style' => 'width:1000px; white-space: normal;'],
                'value' => function ($data) {
                    return $data->viewMhsProdi->prodi;
                },
                // 'filter' => Select2::widget([
                //     'model' => $searchModel,
                //     'attribute' => 'prodi',
                //     'data' => ArrayHelper::map(Prodi::find()->all(), 'id', 'nama'),
                //     'options' => ['placeholder' => ''],
                //     'pluginOptions' => [
                //         'allowClear' => true
                //     ],
                // ]),
            ],
            [
                'attribute' => 'tanggal',
                'value' => 'tanggal',
                'contentOptions' => ['style' => 'width:10px; white-space: normal;'],
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
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status_surat',
                'readonly' => $isBAAK,
                'format' => Editable::FORMAT_BUTTON,
                'editableOptions' => [
                    'disabled' => function($data){
                        if($data->status_surat == 3){
                            return true;
                        }else{
                            return false;
                        }
                    },
                    'inputType' => Editable::INPUT_DROPDOWN_LIST,
                    'data' => ArrayHelper::map(StatusPkl::find()->where(['or', ['id' => 1], ['id' => 2], ['id' => 3]])->all(), 'id', 'nama'),
                ],
                'content' => function ($data) {
                    if ($data->statusSurat->id == 1) { //ditolak
                        $class = 'label label-danger';
                    } elseif ($data->statusSurat->id == 2) { //menunggu
                        $class = 'label label-warning';
                    }else { //menunggu
                        $class = 'label label-success';
                    }
                    return Html::tag('span', $data->statusSurat->nama, [
                        'class' => $class
                    ]);
                },
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status_pelaksanaan',
                'format' => Editable::FORMAT_BUTTON,
                'readonly' => $isMhs,
                'editableOptions' => [
                    'inputType' => Editable::INPUT_DROPDOWN_LIST,
                    'data' => ArrayHelper::map(StatusPkl::find()->where(['or', ['id' => 1], ['id' => 2]])->all(), 'id', 'nama'),

                ],
                'content' => function ($data) {
                    if ($data->statusPelaksanaan->id == 1) { //ditolak
                        $class = 'label label-danger';
                    } elseif ($data->statusPelaksanaan->id == 2) { //menunggu
                        $class = 'label label-warning';
                    }  elseif ($data->statusPelaksanaan->id == 6) { //menunggu
                        $class = 'label label-info';
                    }else { //menunggu
                        $class = 'label label-success';
                    }
                    return Html::tag('span', $data->statusPelaksanaan->nama, [
                        'class' => $class
                    ]);
                },
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status_kegiatan',
                'format' => Editable::FORMAT_BUTTON,
                'readonly' => $isDosen,
                'editableOptions' => [
                    'inputType' => Editable::INPUT_DROPDOWN_LIST,
                    'data' => ArrayHelper::map(StatusPkl::find()->where(['or', ['id' => 3],['id' => 5]])->all(), 'id', 'nama'),
                ],
                'content' => function ($data) {
                    if ($data->statusKegiatan->id == 1) { //ditolak
                        $class = 'label label-danger';
                    } elseif ($data->statusKegiatan->id == 5) { //menunggu
                        $class = 'label label-warning';
                    } elseif ($data->statusKegiatan->id == 6) { //tidak diproses
                        $class = 'label label-info';
                    }else { //menunggu
                        $class = 'label label-success';
                    }
                    return Html::tag('span', $data->statusKegiatan->nama, [
                        'class' => $class
                    ]);
                },
            ],
            //'mhs_id',
            //'dosen_id',
            'semester',
            [
                'attribute' => 'bukti',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->bukti != '')
                        return Html::a($model->bukti, Yii::$app->homeUrl . 'uploads/file-bukti/' . $model->bukti);

                    else return 'Tidak Ada Bukti';
                },
            ],
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
                        'visible' => Roles::currentRole(Yii::$app->user->identity->id) == Roles::BAAK,
                        'linkOptions' => [
                            'data-method' => 'post'
                        ],
                    ],
                    [
                        'label' => 'Ubah',
                        'url'   => ['update'],
                        'visible' => Roles::currentRole(Yii::$app->user->identity->id) == Roles::MHS,
                    ],
                    [
                        'label'   => 'Cetak Surat',
                        'url'     => ['download'],
                        'visible' => Roles::currentRole(Yii::$app->user->identity->id) == Roles::BAAK,
                    ],
                ]
            ],
            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'template' => '{view} {update} {delete} {download}',
            //     'visibleButtons' => [
            //         'delete' => function($data) {
            //             if (Roles::currentRole(Yii::$app->user->identity->id) == Roles::BAAK) {
            //                 return true;
            //             } else {
            //                 return false;
            //             }
            //         },
            //         'update' => function($data) {
            //             if (Roles::currentRole(Yii::$app->user->identity->id) == Roles::MHS) {
            //                 return true;
            //             } else {
            //                 return false;
            //             }
            //         },
            //         'download' => function($data) {
            //             if (Roles::currentRole(Yii::$app->user->identity->id) == Roles::BAAK) {
            //                 return true;
            //             } else {
            //                 return false;
            //             }
            //         }
            //     ],
            //     'buttons' => [
            //         'download' => function ($url) {
            //             return Html::a( '<span class="glyphicon glyphicon-print"> </span>', $url, [ 'title' => 'Cetak surat pengantar', 'data-pjax' => '0', ] );
            //         },
            //     ]
            // ],
        ],
    ]); ?>
</div>
