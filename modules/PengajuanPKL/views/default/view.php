<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pengajuan Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajuan-pkl-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'mitra_id',
            'mulai',
            'selesai',
            'status',
            'semester',
            'mhs_id',
            'dosen_id',
            'topik_id',
        ],
    ]) ?>

</div>
