<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\KategoriIndustri */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kategori PKL', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-industri-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'nama',
            //'prodi_id',
            'value'=>'prodi.nama',
        ],

    ]) ?>

</div>
