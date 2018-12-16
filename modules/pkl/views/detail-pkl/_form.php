<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPkl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-pkl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pkl_id')->textInput() ?>

    <?= $form->field($model, 'deskripsi_tugas')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'departemen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kesesuaian')->textInput() ?>

    <?= $form->field($model, 'masalah')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'laporan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'masukan_dosen')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nilai_mentor')->textInput() ?>

    <?= $form->field($model, 'nilai_dosen')->textInput() ?>

    <?= $form->field($model, 'nilai_akhir')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
