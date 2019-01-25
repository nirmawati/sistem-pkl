<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\LogPkl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-pkl-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'pkl_id')->textInput() ?> -->

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
        <?= $form->field($model, 'ket')->dropDownList(
            ['0' => 'Mangkir', '1' => 'Hadir', '2' => 'Izin'],
            ['prompt' => '-- Pilih Keterangan --']
        ); ?>
		</div>
	</div>

	<div class="row">
		<!-- <div class="col-md-4">
            <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Pilih Tanggal'],
                'pluginOptions' => [
                    'format' => 'dd-M-yyyy',
                    'autoclose' => true
                ]
            ]); ?>
		</div> -->

		<div class="col-md-6">
            <?= $form->field($model, 'jam_masuk')->widget(TimePicker::classname(), [
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                    'secondStep' => 5,
                ]
            ]); ?>
		</div>

		<div class="col-md-6">
            <?= $form->field($model, 'jam_pulang')->widget(TimePicker::classname(), [
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                    'secondStep' => 5,
                ]
            ]); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
        <?= $form->field($model, 'kegiatan')->textarea(['rows' => 6]) ?>
		</div>
	</div>
</div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
