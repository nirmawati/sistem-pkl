<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LogPklSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitra-pkl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- <?= $form->field($model, 'id') ?> -->

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'alamat') ?>

    <!-- <?= $form->field($model, 'kontak') ?> -->

    <!-- <?= $form->field($model, 'telpon') ?> -->

    <?php echo $form->field($model, 'email') ?>

    <?php echo $form->field($model, 'status') ?>

    <?php echo $form->field($model, 'kategori_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
