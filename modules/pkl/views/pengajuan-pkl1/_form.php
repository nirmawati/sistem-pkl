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

/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */
/* @var $form yii\widgets\ActiveForm */

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

    <?= $form->field($model, 'dosen_id')->textInput() ?>
    
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
    <!-- <?= $form->field($model, 'status')->dropDownList(
        ['0' => 'Ditolak', '1' => 'Terdaftar', '2' => 'Selesai'],
        ['prompt' => 'Pilih Status']
    ); ?> -->

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


