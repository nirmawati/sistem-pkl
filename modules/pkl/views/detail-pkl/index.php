<?php

use yii\helpers\Html;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use app\modules\pkl\utils\Roles;

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
        <?= Html::a('Update Detail', ['update?id='.$detailPkl->id.''], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if(Roles::currentRole($userid) == Roles::DOSEN): ?>

        <?= DataTables::widget([
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

                        else return 'Tidak Ada Laporan';
                    },
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php elseif(Roles::currentRole($userid) == Roles::MHS): ?>
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
</div>
