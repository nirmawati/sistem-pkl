<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LogPkl */

$this->title = 'Ubah Absensi';
$this->params['breadcrumbs'][] = ['label' => 'Log Pkl', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="log-pkl-update">


    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
