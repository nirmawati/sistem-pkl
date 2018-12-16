<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PengajuanPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengajuan Pkls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajuan-pkl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'tanggal',
            'mhs_id',
            'mitra_id',
            'topik_id',
            'status',
            // 'mulai',
            // 'selesai',
            // 'semester',
            //'dosen_id',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
