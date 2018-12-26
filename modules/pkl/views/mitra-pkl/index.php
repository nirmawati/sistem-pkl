<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

use kartik\select2\Select2;
use app\models\KategoriIndustri;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MitraPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mitra Pkl';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitra-pkl-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <p>
        <?= Html::button('Tambah Mitra Pkl', ['value' => Url::to('mitra-pkl/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>

    <?php 
        Modal::begin([
            'header' => '<h4>Tambah Mitra PKL</h4>',
            'id' => 'modal',
            'size' => 'modal-lg'
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=> function($model){
            if($model->status==0){
                return['class'=>'success'];
            }else{
                return['class'=>'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nama',
            'alamat',
            //'kontak',
            //'telpon',
            //'email:email',
            
            [
                'attribute' => 'kategori_id',
                'value' => 'kategori.nama',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'kategori_id',
                    'data' => ArrayHelper::map(KategoriIndustri::find()->all(), 'id', 'nama'),
                    'options' => ['placeholder' => 'Pilih Kategori'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],

                ]),
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'filter' => [0 => 'available', 1 => 'not available'],
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'content' => function ($data) {
                    if ($data->status == 1) {
                        $status = 'not available';
                    } else {
                        $status = 'available';
                    }
                    return $status;
                }
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
