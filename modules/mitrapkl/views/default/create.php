<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MitraPkl */

$this->title = 'Create Mitra Pkl';
$this->params['breadcrumbs'][] = ['label' => 'Mitra Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitra-pkl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
