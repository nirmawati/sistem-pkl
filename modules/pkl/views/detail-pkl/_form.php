<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use dosamigos\ckeditor\CKEditor;
use dosamigos\fileupload\FileUploadUI;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPkl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-pkl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pkl_id')->textInput() ?>
    <?= $form->field($model, 'pkl_id')->textInput([
        'disabled' => true,
        'value' => $mahasiswa->nama
    ]);?>

    <?= $form->field($model, 'departemen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deskripsi_tugas')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'kesesuaian')->dropDownList(
        [0 => 'Sesuai', 1 => 'Tidak Sesuai']
    ); ?>

    <?= $form->field($model, 'masalah')->textarea(['rows' => 6]) ?>

    <!-- <?= $form->field($model, 'laporan')->textarea(['rows' => 6]) ?> -->
    <div class="row">
      <?= $form->field($model, 'laporan')->widget(FileInput::classname(), [

            'pluginOptions' => ['allowedFileExtensions' => ['pdf'], 'showUpload' => true, ],
        ]); ?>
  </div>
    
    <!-- <?= $form->field($model, 'masukan_dosen')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'nilai_mentor')->textInput() ?> -->

    <!-- <?= $form->field($model, 'nilai_dosen')->textInput() ?> -->

    <!-- <?= $form->field($model, 'nilai_akhir')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
