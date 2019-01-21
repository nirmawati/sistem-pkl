<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPkl */

$this->title = $model->pkl->viewMhsProdi->nama;
$this->params['breadcrumbs'][] = ['label' => 'Detail Pkl', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-pkl-view">


    <?= $this->render('detailmhs', [
            'model' => $model,
            'mahasiswa' => $mahasiswa,
            'listPkl'=> $listPkl,
            'mitra'=>$mitra,
            'tgl_mulai'=>$tgl_mulai,
            'tgl_selesai'=>$tgl_selesai,
            'detailPkl'=>$detailPkl
        ]) ?>

</div>
