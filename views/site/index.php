<?php

/* @var $this yii\web\View */
use dosamigos\highcharts\HighCharts;

$this->title = 'Sistem Informasi PKL';
// foreach ($dgrafik as $values) {
//     $a[0] = ($values['status']);
//     $c[] = ($values['status']);
//     $b[] = array('type' => 'column', 'name' => $values['status'], 'data' => array((int)$values['jumlah']));
// }
// ?>
<div class="site-index">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="alert alert-success alert-dismissible">
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                        <h4><i class="icon fa fa-check"></i> Diizinkan!</h4>
                        Saat ini anda sudah praktik kerja di PT. Insan Nurani
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-purple"><i class="fa fa-file-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Surat Pengajuan</span>
                            <span class="info-box-number">
                                <small class="label bg-green">1</small>
                                <small class="label bg-yellow">23</small>
                                <small class="label bg-red">3</small>
                            </span>
                        </div>
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pengajuan Surat</span>
                            <span class="info-box-number">
                                <small class="label bg-green">1</small>
                                <small class="label bg-yellow">23</small>
                                <small class="label bg-red">3</small>
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
                            'text' => 'Mahasiswa PKL'
                        ],
                        'series' => [
                            [
                                'data' => [
                                    ['Cancle', 45.0],
                                    ['Registred', 26.8],
                                    ['Done', 8.5]
                                ],
                            ]
                        ],
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
