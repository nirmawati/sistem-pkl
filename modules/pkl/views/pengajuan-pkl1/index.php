<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

use dosamigos\datepicker\DatePicker;
use kartik\date\DatePicker as DatePic;
use app\models\MitraPkl;
use kartik\select2\Select2;



/* @var $this yii\web\View */
/* @var $searchModel app\models\PengajuanPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mahasiswa PKL';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="pengajuan-pkl-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Daftar PKL', ['value' => Url::to('pengajuan-pkl/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>

    <?php 
    Modal::begin([
        'header' => '<h4>Lembar Pendaftaran</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
        'options'=>[
            'tabindex'=> false,
        ]
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            if ($model->status == 0) {
                return ['class' => 'danger'];
            } elseif ($model->status == 1) {
                return ['class' => 'success'];
            } else {
                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'label' => 'Mahasiswa',
                'attribute' => 'nama_mhs',
                'content' => function ($data) {
                    return $data->viewMhsProdi->nama;
                }
            ],
            [
                'attribute' => 'tanggal',
                'value' => 'tanggal',
                'format' => [
                    'Date',
                    'dd-MMM-yyyy'
                ],
                'filter' => DatePic::widget([
                    'model' => $searchModel,
                    'attribute' => 'tanggal',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy',
                    ],
                ]),
            ],

            [
                'attribute' => 'mitra_id',
                'value' => 'mitra.nama',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'mitra_id',
                    'data' => ArrayHelper::map(MitraPkl::find()->all(), 'id', 'nama'),
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],

                ]),
            ],
            'topik_id',
            [
                'attribute' => 'status',
                'format' => 'text',
                'filter' => ['0' => 'Cancel', '1' => 'Registered', '2' => 'Done'],
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'content' => function ($data) {
                    if ($data->status == 1) {
                        $status = 'Registered';
                    } elseif ($data->status == 2) {
                        $status = 'Done';
                    } else {
                        $status = 'Cancel';
                    }
                    return $status;
                }

            ],
            // 'mulai',
            // 'selesai',
            // 'semester',
            //'dosen_id',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
