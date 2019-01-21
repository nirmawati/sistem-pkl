<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPkl */

$this->title = 'Ubah Detail';
$this->params['breadcrumbs'][] = ['label' => 'Detail Pkl', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detail-pkl-update">

    <?= $this->render('_form', [
        'model' => $model,
        'mitra'=>$mitra,
        'userid' => $userid,
    ]) ?>

</div>
