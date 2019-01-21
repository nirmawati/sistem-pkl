<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use dosamigos\ckeditor\CKEditor;
use dosamigos\fileupload\FileUploadUI;
use kartik\file\FileInput;
use app\modules\pkl\utils\Roles;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPkl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-pkl-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="container-fluid">
    <?php if(Roles::currentRole($userid) == Roles::MHS): ?>
        <div class="row">
            <div class="col-md-8">
            <?= $form->field($model, 'pkl_id')->textInput([
                'disabled' => true,
                'value' => $mitra->nama
                ]);?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'departemen')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <?= $form->field($model, 'deskripsi_tugas')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic'
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            <?= $form->field($model, 'kesesuaian')->dropDownList(
                [0 => 'Sesuai', 1 => 'Tidak Sesuai']
                ); ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'masalah')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <?= $form->field($model, 'laporan')->widget(FileInput::classname(), [
                'pluginOptions' => ['allowedFileExtensions' => ['pdf'], 'showUpload' => true, ],
                ]); ?>
            </div>
        </div>
    <!-- penilaian untuk dosen -->
    <?php elseif(Roles::currentRole($userid) == Roles::DOSEN): ?>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'masukan_dosen')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'nilai_mentor')->textInput(['type' => 'number']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'nilai_dosen')->textInput(['type' => 'number']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'nilai_akhir')->textInput(['type' => 'number','disabled' => true]) ?>
            </div>
        </div>
    <?php endif; ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
