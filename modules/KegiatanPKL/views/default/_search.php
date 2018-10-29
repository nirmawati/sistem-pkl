<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KegiatanPklSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kegiatan-pkl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'waktu_datang') ?>

    <?= $form->field($model, 'waktu_pulang') ?>

    <?= $form->field($model, 'kegiatan') ?>

    <?php // echo $form->field($model, 'materi') ?>

    <?php // echo $form->field($model, 'masukan') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
