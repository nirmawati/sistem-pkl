<?php
use yii\helpers\Html;
use app\models\VwmahasiswaProdi;
use app\models\Dosen;
use app\modules\pkl\utils\Roles;

/* @var $this \yii\web\View */
/* @var $content string */
$user = Yii::$app->user->identity;
$mahasiswa = VwmahasiswaProdi::find()
    ->where(['user_id' => $user->id])
    ->one();
$dosen = Dosen::find()
    ->where(['user_id' => $user->id])
    ->one();
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">PKL</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= $directoryAsset ?>/img/default.png" class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?= $user->username ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?= $directoryAsset ?>/img/default.png" class="img-circle"
                                        alt="User Image"/>
                                    <p>
                                        <?php if (Roles::currentRole($user) == Roles::MHS) { ?>
                                            <?= $mahasiswa->nama ?>
                                            <small><?= $mahasiswa->prodi ?></small>
                                            <small><?= $mahasiswa->nim ?></small>
                                        <?php }else if(Roles::currentRole($user) == Roles::DOSEN){ ?>
                                            <?= $dosen->nama ?>
                                            <small><?= $dosen->homebase->nama ?></small>
                                            <small><?= $dosen->nidn ?></small>
                                        <?php } ?>
                                    </p>
                                </li>
                                
                                <li class="user-footer">
                                    <div class="pull-left">
                                    <?= Html::a(
                                            'Profil',
                                            ['/pkl/profil'],
                                            ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                        ) ?>
                                    </div>
                                    <div class="pull-right">
                                        <?= Html::a(
                                            'Keluar',
                                            ['/site/logout'],
                                            ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                        ) ?>
                                    </div>
                                </li>
                            
                        </ul>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
