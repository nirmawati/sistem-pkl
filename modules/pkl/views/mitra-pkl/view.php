<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MitraPkl */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Mitra Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitra-pkl-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nama',
            'alamat',
            'kontak',
            'telpon',
            'email:email',
            'status',
            'kategori_id',
        ],
    ]) ?>

        <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
