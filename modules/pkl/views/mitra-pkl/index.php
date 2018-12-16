<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MitraPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mitra Pkl';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitra-pkl-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Mitra Pkl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nama',
            'alamat',
            //'kontak',
            //'telpon',
            //'email:email',
            'status',
            [
                'attribute' => 'kategori_id',
                //'value' => 'kategori_industri.nama'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
