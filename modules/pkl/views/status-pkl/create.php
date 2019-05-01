<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StatusPkl */

$this->title = 'Tambah Status PKL';
$this->params['breadcrumbs'][] = ['label' => 'Status Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-pkl-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
