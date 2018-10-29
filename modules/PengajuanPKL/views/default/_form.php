<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengajuan-pkl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mahasiswa_id')->textInput() ?>

    <?= $form->field($model, 'alamat_pkl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tujuan_pengirim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topik_pkl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_krs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_transkip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'tgl_mulai')->textInput() ?>

    <?= $form->field($model, 'tgl_selesai')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>