<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;
use app\models\Prodi;


/* @var $this yii\web\View */
/* @var $searchModel app\models\KategoriIndustriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori PKL';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-industri-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Tambah Kategori', ['value' => Url::to('kategori-industri/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>

    <?php 
        Modal::begin([
            'header' => '<h4>Tambah Kategori</h4>',
            'id' => 'modal',
            'size' => 'modal-lg'
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'nama',
            [
                'attribute'=>'prodi_id',
                'value'=>'prodi.nama',
                'filter'=>Select2::widget([
                    'model'=>$searchModel,
                    'attribute'=>'prodi_id',
                    'data'=>ArrayHelper::map(Prodi::find()->all(),'id','nama'),
                    'options'=>['placeholder'=>''],
                    'pluginOptions'=>[
                        'allowClear'=>true
                    ],
                    
                ]),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
