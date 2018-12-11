<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

use app\models\VwmahasiswaProdi;
use app\models\KategoriIndustri;
use app\models\MitraPkl;


/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengajuan-pkl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Tanggal Pengajuan'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); ?>
    
    <?= $form->field($model, 'mitra_id')->dropDownList(
        ArrayHelper::map(MitraPkl::find()->all(),'id','nama'),
        ['prompt'=>'Select Tempat PKL']
    ); ?>
    
    <?= $form->field($model, 'topik_id')->dropDownList(
        ArrayHelper::map(KategoriIndustri::find()->all(),'id','nama'),
        ['prompt'=>'Select Topik']
    ); ?>

    <?= $form->field($model, 'mulai')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Tanggal Mulai'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); ?>

    <?= $form->field($model, 'selesai')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Tanggal Selesai'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList(
        ['0' => 'Cancel', '1' => 'Registered', '2' => 'Done'],
        ['prompt'=>'Pilih Status']
    ); ?>



    <?= $form->field($model, 'semester')->textInput() ?>


    <?= $form->field($model, 'mhs_id')->dropDownList(
        ArrayHelper::map(VwmahasiswaProdi::find()->all(),'mhsid','nama'),
        ['prompt'=>'Select Mahasiswa']
    ); ?>

    <?= $form->field($model, 'dosen_id')->textInput() ?>

   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
