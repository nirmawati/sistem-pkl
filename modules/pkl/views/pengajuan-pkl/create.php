<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengajuanPkl */

$this->title = 'Daftar PKL';
$this->params['breadcrumbs'][] = ['label' => 'Pengajuan Pkls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajuan-pkl-create">


    <?= $this->render('_form', [
        'model' => $model,
        'userid' =>$userid,
        'mahasiswaProdi' => $mahasiswaProdi,
        'mahasiswa' => $mahasiswa,
        'semester' =>$semester
    ]) ?>

</div>



