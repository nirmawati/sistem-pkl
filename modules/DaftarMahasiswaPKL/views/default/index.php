<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ListMahasiswaPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mahasiswa PKL';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-mahasiswa-pkl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Daftar Mahasiswa PKL', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'mahasiswa_id',
            'kegiatan_id',
            'tgl_mulai',
            'tgl_selesai',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
