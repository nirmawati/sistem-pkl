<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPklSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengajuan-pkl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'mitra_id') ?>

    <?= $form->field($model, 'mulai') ?>

    <?= $form->field($model, 'selesai') ?>

    <?= $form->field($model, 'topik') ?>

    <?php echo $form->field($model, 'semester_id') ?>

    <?php // echo $form->field($model, 'mhs_id') ?>

    <?php // echo $form->field($model, 'dosen_id') ?>

    <?php // echo $form->field($model, 'status_pelaksanaan') ?>

    <?php // echo $form->field($model, 'status_kegiatan') ?>

    <?php // echo $form->field($model, 'status_surat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
