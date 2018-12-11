<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogPklSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log Pkls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-pkl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Log Pkl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pkl_id',
            'tanggal',
            'jam_masuk',
            'jam_pulang',
            'kegiatan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
