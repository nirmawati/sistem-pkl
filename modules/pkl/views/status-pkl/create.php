<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StatusPkl */

$this->title = 'Create Status Pkl';
$this->params['breadcrumbs'][] = ['label' => 'Status Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-pkl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
