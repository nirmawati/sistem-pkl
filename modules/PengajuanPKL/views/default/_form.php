<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use app\models\Status;
use app\models\Mahasiswa;

/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengajuan-pkl-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'mahasiswa_id')->textInput() ?>

            <?= $form->field($model, 'alamat_pkl')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tujuan_pengirim')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'topik_pkl')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map(Status::find()->select(['nama','id'])->all(), 'id', 'nama'),['class' => 'form-control inline-block']); ?>

            <?= $form->field($model, 'tgl_mulai')->textInput() ?>

            <?= $form->field($model, 'tgl_selesai')->textInput() ?>

            <?= $form->field($model, 'file_krs')->textInput() ?>

            <?= $form->field($model, 'file_transkip')->textInput() ?>
        
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    <div class="row">

    <?php ActiveForm::end(); ?>

</div>
