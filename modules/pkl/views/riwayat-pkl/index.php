<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\bootstrap\ButtonDropdown;

use app\models\StatusPkl;
use app\models\MitraPkl;
use app\modules\pkl\utils\Roles;

use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\editable\Editable;
use kartik\grid\GridView;

use fedemotta\datatables\DataTables;
use microinginer\dropDownActionColumn\DropDownActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PengajuanPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riwayat Mahasiswa PKL';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="riwayat-pkl-index">
<!-- <h1><?= Html::encode($this->title) ?></h1> -->
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php 
        $isBAAK = true;
        $isDosen = true;
        $isMhs = true;

        if (Roles::currentRole($userid) == Roles::BAAK) {
            $isBAAK = false;
        } elseif (Roles::currentRole($userid) == Roles::DOSEN) {
            $isDosen = false;
        } elseif (Roles::currentRole($userid) == Roles::MHS) {
            $isMhs = false;
        }
    ?>
    <?php Pjax::begin(); ?>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'label' => 'Mahasiswa',
                'attribute' => 'mhs_id',
                'content' => function ($data) {
                    return $data->viewMhsProdi->nama;
                }
            ],
            [
                'attribute' => 'mulai',
                'value' => 'mulai',
                'contentOptions' => ['style' => 'width:20px; white-space: normal;'],
                'format' => [
                    'Date',
                    'dd-MMM-yyyy'
                ],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'mulai',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy',
                    ],
                ]),
            ],
            [
                'attribute' => 'selesai',
                'value' => 'selesai',
                'contentOptions' => ['style' => 'width:20px; white-space: normal;'],
                'format' => [
                    'Date',
                    'dd-MMM-yyyy'
                ],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'selesai',
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
            'topik',
            // 'mulai',
            // 'selesai',
            //'semester',
            //'mhs_id',
            //'dosen_id',
            // [
            //     'class' => DropDownActionColumn::className(),
            //     'items' => [
            //         [
            //             'label' => 'Lihat',
            //             'url'   => ['view'],
            //         ],
            //         [
            //             'label' => 'Hapus',
            //             'url'   => ['delete'],
            //             'visible' => Roles::currentRole(Yii::$app->user->identity->id) == Roles::BAAK,
            //             'linkOptions' => [
            //                 'data-method' => 'post'
            //             ],
            //         ],
            //         [
            //             'label' => 'Perbaharui',
            //             'url'   => ['update'],
            //             'visible' => Roles::currentRole(Yii::$app->user->identity->id) == Roles::MHS,
            //         ],
            //         [
            //             'label'   => 'Cetak Surat',
            //             'url'     => ['download'],
            //             'visible' => Roles::currentRole(Yii::$app->user->identity->id) == Roles::BAAK,
            //         ],
            //     ]
            // ],
            [
                'class' => DropDownActionColumn::className(),
                'items' => [
                    [
                        'label' => 'Lihat',
                        'url'   => ['view'],
                    ],
                ]
            ],
        ],
    ]); ?>
</div>
