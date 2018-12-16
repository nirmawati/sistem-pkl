<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPkl */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detail Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-pkl-view">

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
            'pkl_id',
            'deskripsi_tugas:ntext',
            'departemen',
            'kesesuaian',
            'masalah:ntext',
            'laporan:ntext',
            'masukan_dosen:ntext',
            'nilai_mentor',
            'nilai_dosen',
            'nilai_akhir',
        ],
    ]) ?>

</div>
