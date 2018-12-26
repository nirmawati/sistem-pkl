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
    <?= $form->field($model, 'mhs_id')->dropDownList(
        ArrayHelper::map(VwmahasiswaProdi::find()->all(), 'mhsid', 'nama'),
        ['prompt' => 'Select Mahasiswa']
    ); ?>

    <?= $form->field($model, 'semester')->textInput() ?>
    <?= $form->field($model, 'dosen_id')->textInput() ?>
    
    <div class="col-md-6">
    <?= $form->field($model, 'mitra_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(MitraPkl::find()->all(), 'id', 'nama'),
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    </div>

    <div class="col-md-6">
    <?= $form->field($model, 'topik_id')->dropDownList(
        ArrayHelper::map(TopikPkl::find()->all(), 'id', 'nama'),
        ['prompt' => 'Select Topik']
    ); ?>
    </div>

    <div class="col-md-6">
    <?= $form->field($model, 'mulai')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Tanggal Mulai'],
        'pluginOptions' => [
            'format' => 'dd-M-yyyy',
            'autoclose' => true
        ]
    ]); ?>
    </div>

    <div class="col-md-6">
    <?= $form->field($model, 'selesai')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Tanggal Selesai'],
        'pluginOptions' => [
            'format' => 'dd-M-yyyy',
            'autoclose' => true
        ]
    ]); ?>
    </div>

    <div class="col-md-6">
    <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Tanggal Pengajuan'],
        'pluginOptions' => [
            'format' => 'dd-M-yyyy',
            'autoclose' => true
        ]
    ]); ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'status')->dropDownList(
        ['0' => 'Cancel', '1' => 'Registered', '2' => 'Done'],
        ['prompt' => 'Pilih Status']
    ); ?>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
