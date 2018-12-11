<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TopikPkl */

$this->title = 'Create Topik Pkl';
$this->params['breadcrumbs'][] = ['label' => 'Topik Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topik-pkl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
