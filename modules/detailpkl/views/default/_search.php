<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPklSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-pkl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pkl_id') ?>

    <?= $form->field($model, 'deskripsi_tugas') ?>

    <?= $form->field($model, 'departemen') ?>

    <?= $form->field($model, 'kesesuaian') ?>

    <?php // echo $form->field($model, 'masalah') ?>

    <?php // echo $form->field($model, 'laporan') ?>

    <?php // echo $form->field($model, 'masukan_dosen') ?>

    <?php // echo $form->field($model, 'nilai_mentor') ?>

    <?php // echo $form->field($model, 'nilai_dosen') ?>

    <?php // echo $form->field($model, 'nilai_akhir') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
