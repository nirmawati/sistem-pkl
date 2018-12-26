<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KategoriIndustri */

$this->title = 'Create Kategori Industri';
$this->params['breadcrumbs'][] = ['label' => 'Kategori Industris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-industri-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
