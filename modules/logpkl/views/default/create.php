<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LogPkl */

$this->title = 'Create Log Pkl';
$this->params['breadcrumbs'][] = ['label' => 'Log Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-pkl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
