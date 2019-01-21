<?php

use yii\helpers\Html;
use app\modules\pkl\utils\Roles;


/* @var $this yii\web\View */
/* @var $model app\models\DetailPkl */

$this->title = 'Tambah Detail';
$this->params['breadcrumbs'][] = ['label' => 'Detail Pkl', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-pkl-create">

    <?= $this->render('_form', [
        'model' => $model,
        'mahasiswa' => $mahasiswa,
        'listPkl'=> $listPkl,
        'userid' => $userid,
        'mitra'=>$mitra,
    ]) ?>

</div>
