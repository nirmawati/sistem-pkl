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

    <div class="jumbotron">
        <h1>Selamat Datang di Sistem Informasi PKL</h1>
        <p><a class="btn btn-lg btn-success" href="https://akademik.nurulfikri.ac.id/pkl-3/">Informasi PKL</a></p>
    </div>

   <?=
    HighCharts::widget([
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
