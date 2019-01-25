<?php

/* @var $this yii\web\View */
use dosamigos\highcharts\HighCharts;
use app\modules\pkl\utils\Roles;
use app\models\PengajuanPkl;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '';

$pkl = PengajuanPkl::find();

if(Roles::currentRole($userid) == Roles::BAAK||Roles::currentRole($userid) == Roles::DOSEN) {
    //status_pelaksanaan
    $stSuratSelesai = $pkl->where(['status_surat' => 3])->count();
    $stSuratMenunggu = $pkl->where(['status_surat' => 2])->count();
    $stSuratDitolak = $pkl->where(['status_surat' => 1])->count();

    $suratCount = $stSuratSelesai + $stSuratMenunggu + $stSuratDitolak;

    //status_pelaksanaan
    $stPengajuanDiterima = $pkl->where(['status_pelaksanaan' => 4])->count();
    $stPengajuanMenunggu = $pkl->where(['status_pelaksanaan' => 2])->count();
    $stPengajuanDitolak = $pkl->where(['status_pelaksanaan' => 1])->count();

    $pengajuanCount = $stPengajuanDiterima + $stPengajuanMenunggu + $stPengajuanDitolak;

    //status_kegiatan
    $stKegiatanselesai = $pkl->where(['status_kegiatan' => 3])->count();
    $stKegiatansedangPKL = $pkl->where(['status_kegiatan' => 5])->count();
    $stKegiatanDitolak = $pkl->where(['status_kegiatan' => 1])->count();

    $kegiatanCount = $stKegiatanselesai + $stKegiatansedangPKL + $stKegiatanDitolak;

}

?>
<div class="site-index">

    <div class="container-fluid">
        <div class="row">
            <?php if(Roles::currentRole($userid) == Roles::MHS): {
                if ($model->status_surat == 3 && $model->status_pelaksanaan == 2) {
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
                }else {
                    echo Html::button('Daftar PKL', ['value' => Url::to('pengajuan-pkl/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']);
                }
            }?>
 
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                <?php if(Roles::currentRole($userid) == Roles::BAAK||Roles::currentRole($userid) == Roles::DOSEN): ?>
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-file-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Surat Pengantar</span>
                            <span class="info-box-number">
                                <small class="label bg-green"><?= $stSuratSelesai ?></small>
                                <small class="label bg-yellow"><?= $stSuratMenunggu ?></small>
                                <small class="label bg-red"><?= $stSuratDitolak ?></small>
                            </span>
                        </div>
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pengajuan</span>
                            <span class="info-box-number">
                            
                                <small class="label bg-green"><?= $stPengajuanDiterima ?></small>
                                <small class="label bg-yellow"><?= $stPengajuanMenunggu ?></small>
                                <small class="label bg-red"><?= $stPengajuanDitolak ?></small>
                                
                            </span>
                        </div>
                    </div>

                     <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Kegiatan</span>
                            <span class="info-box-number">
                            
                                <small class="label bg-green"><?= $stKegiatanselesai ?></small>
                                <small class="label bg-yellow"><?= $stKegiatansedangPKL ?></small>
                                <small class="label bg-red"><?= $stKegiatanDitolak ?></small>
                                
                            </span>
                        </div>
                    </div>               
                    
                </div>
            </div>
            <div class="col-md-8">
                <?= HighCharts::widget([
                    'clientOptions' => [
                        'chart' => [
                            'type' => 'pie'
                        ],
                        'title' => [
                            'text' => 'model PKL'
                        ],
                        'series' => [
                            [
                                'data' => [
                                    ['Surat', $suratCount],
                                    ['Pengajuan', $pengajuanCount],
                                    ['Magang', $kegiatanCount]
                                ],
                            ]
                        ],
                    ]
                ]);
                ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
