<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\date\DatePicker;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\LogPkl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-pkl-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'pkl_id')->textInput() ?> -->

    <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Hari/Tanggal'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'DD,dd-M-yyyy'
        ]
    ]); ?>

    <?= $form->field($model, 'jam_masuk')->widget(TimePicker::classname(), [
        'pluginOptions' => [
            'showSeconds' => false,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ]
    ]); ?>

        <?= $form->field($model, 'jam_pulang')->widget(TimePicker::classname(), [
        'pluginOptions' => [
            'showSeconds' => false,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ]
    ]); ?>

    <?= $form->field($model, 'kegiatan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
