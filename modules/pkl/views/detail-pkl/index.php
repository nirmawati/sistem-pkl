<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetailPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail PKL';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-pkl-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-striped table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'pkl_id',
            'departemen',
            [
                'attribute' => 'text',
                'value' => 'deskripsi_tugas',
                'format' => 'html',
            ],
            'kesesuaian',
            // 'masalah:ntext',
            // 'laporan:ntext',
            //'masukan_dosen:ntext',
            //'nilai_mentor',
            //'nilai_dosen',
            //'nilai_akhir',
            [
                'attribute' => 'Laporan',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->laporan != '')
                        return Html::a($model->laporan, Yii::$app->homeUrl . 'uploads/file-laporan/' . $model->laporan);

                    else return 'no image';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
