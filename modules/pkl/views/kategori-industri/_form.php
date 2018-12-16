<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

use app\models\Prodi;


/* @var $this yii\web\View */
/* @var $model app\models\KategoriIndustri */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kategori-industri-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prodi_id')->dropDownList(
        ArrayHelper::map(Prodi::find()->all(), 'id', 'nama'),
        ['prompt' => 'Select Prodi']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
