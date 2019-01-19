<?php

use yii\helpers\Html;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use app\modules\pkl\utils\Roles;
use app\models\PengajuanPkl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetailPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail PKL';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="detail-pkl-index">
    <?php if($listPkl->status_kegiatan == 6): ?>
        <div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-check"></i> Maaf Anda Belum Diterima di Perusahaan Manapun !</h4>Anda tidak dapat menambah detail PKL...
        </div>
    <?php else: ?>
        <?php if(Roles::currentRole($userid) == Roles::MHS): ?>
            <p> 
                <?php if($detailPkl == null): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <h4><i class="icon fa fa-check"></i> Selamat Anda Telah Diterima di <?= $mitra->nama ?>!</h4>Silahkan Melengkapi Detail PKL Anda...
                    </div>
                    <?= Html::a('Tambah Detail', ['create'], ['class' => 'btn btn-success']) ?>
                <?php else: ?>
                    <?= Html::a('Update Detail', ['update?id='.$detailPkl->id], ['class' => 'btn btn-success']) ?>
                    <?= $this->render('detailmhs', [
                        'model' => $model,
                        'mahasiswa' => $mahasiswa,
                        'listPkl'=> $listPkl,
                        'mitra'=>$mitra,
                        'tgl_mulai'=>$tgl_mulai,
                        'tgl_selesai'=>$tgl_selesai,
                        'detailPkl'=>$detailPkl
                    ]) ?>
                <?php endif; ?>
            </p>
        <?php elseif(Roles::currentRole($userid) == Roles::DOSEN): ?>
            <?= DataTables::widget([
                'tableOptions' => ['class' => 'table table-striped table-hover'],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    [
                        'label' => 'Mahasiswa',
                        'attribute' => 'pkl_id',
                        'content' => function ($data) {
                            return $data->pkl->viewMhsProdi->nama;
                        }
                    ],
                    [
                        'attribute' => 'pkl_id',
                        'content' => function ($data) {
                            return $data->pkl->mitra->nama;
                        }
                    ],
                    'departemen',
                    // [
                    //     'attribute' => 'Deskripsi Tugas',
                    //     'format' => 'text',
                    //     'value' => 'deskripsi_tugas',
                    //     'format' => 'html',
                    // ],
                    // [
                    //     'attribute' => 'kesesuaian',
                    //     'format' => 'text',
                    //     'filter' => ['0' => 'Cancel', '1' => 'Registered', '2' => 'Done'],
                    //     'headerOptions' => ['class' => 'text-center'],
                    //     'contentOptions' => ['class' => 'text-center'],
                    //     'content' => function ($data) {
                    //         if ($data->kesesuaian == 0) {
                    //             $kesesuaian = 'Belum Terdefinisi';
                    //         } elseif ($data->kesesuaian == 1) {
                    //             $kesesuaian = 'Tidak Sesuai';
                    //         } else {
                    //             $kesesuaian = 'Sesuai';
                    //         }
                    //         return $kesesuaian;
                    //     }
        
                    // ],
                    [
                        'attribute' => 'Laporan',
                        'format' => 'raw',
                        'value' => function ($model) {
                            if ($model->laporan != '')
                                return Html::a($model->laporan, Yii::$app->homeUrl . 'uploads/file-laporan/' . $model->laporan);

                            else return 'Tidak Ada Laporan';
                        },
                    ],
                    // 'masalah:ntext',
                    // 'laporan:ntext',
                    //'masukan_dosen:ntext',
                    // 'nilai_mentor',
                    // 'nilai_dosen',
                    'nilai_akhir',
                    // 'dosen_id',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
