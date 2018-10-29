<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PengajuanPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Pengajuan PKL';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajuan-pkl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pengajuan PKL', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'mahasiswa_id',
            'alamat_pkl',
            'tujuan_pengirim',
            'topik_pkl',
            //'file_krs',
            //'file_transkip',
            //'status_id',
            //'tgl_mulai',
            //'tgl_selesai',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
