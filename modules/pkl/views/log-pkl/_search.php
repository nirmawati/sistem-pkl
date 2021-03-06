<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LogPklSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-pkl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pkl_id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'jam_masuk') ?>

    <?= $form->field($model, 'jam_pulang') ?>

    <?php // echo $form->field($model, 'kegiatan') ?>

    <?php // echo $form->field($model, 'ket') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
