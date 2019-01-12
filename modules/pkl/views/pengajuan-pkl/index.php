<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

use dosamigos\datepicker\DatePicker;
use kartik\date\DatePicker as DatePic;
use app\models\MitraPkl;
use kartik\select2\Select2;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PengajuanPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengajuan PKL';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajuan-pkl-index">
<!-- <h1><?= Html::encode($this->title) ?></h1> -->
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <?php
        //$status_surat = $model->status_surat == NULL || $model->status_surat != 3; //status surat ditolak
        //$status_kegiatan = $model->status_kegiatan == NULL || $model->status_kegiatan != 3; //status kegiatan ditolak

    if ($model->status_surat == 3 || $model->status_kegiatan == 3) {
        echo '<div class="alert alert-success alert-dismissible">
                <!-- <button type="button" class="close" aria-hidden="true">×</button> -->
                <h4><i class="icon fa fa-check"></i> Surat Pengajuan Selesai!</h4>Silahkan Ambil Surat Pengantar PKL Anda diruang BAAK...
            </div>';
    } else if ($model->status_surat == 2 || $model->status_kegiatan == 2) {
        echo '<div class="alert alert-warning alert-dismissible">
                <!-- <button type="button" class="close" aria-hidden="true">×</button> -->
                <h4><i class="icon fa fa-check"></i> Tunggu ya!</h4>Surat Pengantar PKL Anda sedang diproses...
            </div>';
    } else {
        echo Html::button('Daftar PKL', ['value' => Url::to('pengajuan-pkl/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']);
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
<?php Pjax::begin(); ?>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'label' => 'Mahasiswa',
                'attribute' => 'nama_mhs',
                'content' => function ($data) {
                    return $data->viewMhsProdi->nama;
                }
            ],
            [
                'attribute' => 'tanggal',
                'value' => 'tanggal',
                'format' => [
                    'Date',
                    'dd-MMM-yyyy'
                ],
                'filter' => DatePic::widget([
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
            'topik_id',
            [
                'attribute' => 'status_surat',
                'content' => function ($data) {
                    if ($data->statusSurat->id == 1) { //ditolak
                        $class = 'label label-danger';
                    } elseif ($data->statusSurat->id == 2) { //menunggu
                        $class = 'label label-warning';
                    } else { //menunggu
                        $class = 'label label-success';
                    }
                    return Html::tag('span', $data->statusSurat->nama, [
                        'class' => $class
                    ]);
                }
            ],
            [
                'attribute' => 'status_pelaksanaan',
                'content' => function ($data) {
                    if ($data->statusPelaksanaan->id == 1) { //ditolak
                        $class = 'label label-danger';
                    } elseif ($data->statusPelaksanaan->id == 2) { //menunggu
                        $class = 'label label-warning';
                    } else { //menunggu
                        $class = 'label label-success';
                    }
                    return Html::tag('span', $data->statusPelaksanaan->nama, [
                        'class' => $class
                    ]);
                }
            ],
            [
                'attribute' => 'status_kegiatan',
                'content' => function ($data) {
                    if ($data->statusKegiatan->id == 1) { //ditolak
                        $class = 'label label-danger';
                    } elseif ($data->statusKegiatan->id == 2) { //menunggu
                        $class = 'label label-warning';
                    } else { //menunggu
                        $class = 'label label-success';
                    }
                    return Html::tag('span', $data->statusKegiatan->nama, [
                        'class' => $class
                    ]);
                }
            ],

            // 'mulai',
            // 'selesai',
            //'semester',
            //'mhs_id',
            //'dosen_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
