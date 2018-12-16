<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetailPkl */

$this->title = 'Create Detail Pkl';
$this->params['breadcrumbs'][] = ['label' => 'Detail Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-pkl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
