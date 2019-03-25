<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\file\FileInput;

use app\modules\pkl\models\VwmahasiswaProdi;
use app\modules\pkl\models\KategoriIndustri;
use app\modules\pkl\models\MitraPkl;
use app\modules\pkl\models\TopikPkl;
use app\modules\pkl\models\StatusPkl;
use app\modules\pkl\models\Dosen;
use app\modules\pkl\utils\Roles;

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
    ]); ?>    

    <?= $form->field($model, 'semester')->dropDownList(
        ['0' => 'Semester 5', '1' => 'Semester 6', '2' => 'Semester 7'],
        ['prompt' => 'Pilih Semester']
    ); ?>

    <?= $form->field($model, 'dosen_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Dosen::find()->where(['homebase_id' => $mahasiswaProdi->prodi_id])->all(), 'id', 'nama'),
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
            'allowClear' => true,
        ],
    ]); ?>
    <p>
        <?= Html::a('Tambah Mitra', ['/pkl/mitra-pkl/create'], ['class' => 'btn btn-success']) ?>
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
    
    <?= $form->field($model, 'topik')->textInput(['maxlength' => true]) ?>
    
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
    
    <?php if (Roles::currentRole($userid) == Roles::MHS) : ?>
            <?= $form->field($model, 'bukti')->widget(FileInput::classname(), [
                'pluginOptions' => [
                    'allowedFileExtensions' => ['pdf'],
                    'showUpload' => true, ],
                    'disabled' => !isset($model->status_pelaksanaan) || $model->status_pelaksanaan != 2
            ]); ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
