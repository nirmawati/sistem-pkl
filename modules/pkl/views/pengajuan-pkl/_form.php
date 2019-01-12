<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;

use app\models\VwmahasiswaProdi;
use app\models\KategoriIndustri;
use app\models\MitraPkl;
use app\models\TopikPkl;
use app\models\StatusPkl;
use app\models\Dosen;
use app\modules\pkl\utils\Roles;

/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */
/* @var $form yii\widgets\ActiveForm */

$userId = Yii::$app->user->id;

?>

<div class="pengajuan-pkl-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container-fluid">
    <!-- <?= $form->field($model, 'mhs_id')->dropDownList(
        ArrayHelper::map(VwmahasiswaProdi::find()->all(), 'mhsid', 'nama'),
        ['prompt' => 'Select Mahasiswa']
    ); ?> -->

    <?= $form->field($model, 'mhs_id')->textInput([
        'disabled' => true,
        'value' => $mahasiswa->nama
    ]);?>    

    <?= $form->field($model, 'semester')->dropDownList(
        ['0' => 'Semester 5', '1' => 'Semester 6', '2' => 'Semester 7'],
        ['prompt' => 'Pilih Semester']
    ); ?>

    <?= $form->field($model, 'dosen_id')->widget(Select2::classname(), [    
        'data' => ArrayHelper::map(Dosen::find()->all(), 'id', 'nama'),
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    
    <?= $form->field($model, 'mitra_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(MitraPkl::find()->all(), 'id', 'nama'),
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <p>
        <?= Html::a('Tambah Mitra', ['/pkl/mitra-pkl'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= $form->field($model, 'topik_id')->dropDownList(
        ArrayHelper::map(TopikPkl::find()->all(), 'id', 'nama'),
        ['prompt' => 'Select Topik']
    ); ?>
<div class="col-md-4">
    <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Tanggal Pengajuan'],
        'pluginOptions' => [
            'format' => 'dd-M-yyyy',
            'autoclose' => true
        ]
    ]); ?>
</div>
<div class="col-md-4">
    <?= $form->field($model, 'mulai')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Tanggal Mulai'],
        'pluginOptions' => [
            'format' => 'dd-M-yyyy',
            'autoclose' => true
        ]
    ]); ?>
</div>
<div class="col-md-4">
    <?= $form->field($model, 'selesai')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Tanggal Selesai'],
        'pluginOptions' => [
            'format' => 'dd-M-yyyy',
            'autoclose' => true
        ]
    ]); ?>
</div>

    <?php if(Roles::currentRole($userId) == Roles::BAAK): ?>
        <!-- BAAK -->
        <?= $form->field($model, 'status_surat')->widget(Select2::classname(), [    
            'data' => ArrayHelper::map(StatusPkl::find()->all(), 'id', 'nama'),
            'language' => 'en',
            'options' => ['placeholder' => 'Pilih ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    <?php elseif(Roles::currentRole($userId) == Roles::MHS): ?>
        <!-- MAHASISWA -->
        <?= $form->field($model, 'status_kegiatan')->widget(Select2::classname(), [    
            'data' => ArrayHelper::map(StatusPkl::find()->all(), 'id', 'nama'),
            'language' => 'en',
            'options' => [
                'placeholder' => 'Pilih ...',
                'disabled' => !isset($model->status_surat) || $model->status_surat != 3
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    <?php elseif(Roles::currentRole($userId) == Roles::DOSEN): ?>
        <!-- DOSEN -->
        <?= $form->field($model, 'status_pelaksanaan')->widget(Select2::classname(), [    
            'data' => ArrayHelper::map(StatusPkl::find()->all(), 'id', 'nama'),
            'language' => 'en',
            'options' => ['placeholder' => 'Pilih ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'disabled' => !isset($model->status_kegiatan) || $model->status_kegiatan != 3 || $model->status_surat != 3
            ],
        ]); ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
