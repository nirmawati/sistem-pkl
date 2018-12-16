<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\KategoriIndustri;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\MitraPkl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitra-pkl-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
        <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

        <?= $form->field($model, 'kontak')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'telpon')->textInput(['maxlength' => true]) ?>
	
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
        <?= $form->field($model, 'status')->dropDownList(
            [0 => 'available', 1 => 'not available']
        ); ?>
		</div>
		<div class="col-md-6">
        
        <?= $form->field($model, 'kategori_id')->dropDownList(
            ArrayHelper::map(KategoriIndustri::find()->all(), 'id', 'nama'),
            ['prompt' => 'Pilih Kategori']
        ); ?>

		</div>
	</div>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

</div>
    
    <?php ActiveForm::end(); ?>

</div>
