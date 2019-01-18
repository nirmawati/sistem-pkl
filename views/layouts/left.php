<?php

use app\modules\pkl\utils\Roles;

$userid = Yii::$app->user->identity->id;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?php 
            $menus = [
                ['label' => 'Home', 'icon' => 'home', 'url' => ['/']],

                // ['label' => 'Profil', 'icon' => 'user', 'url' => ['/pkl/profil']],
                ['label' => 'Mahasiswa PKL', 'icon' => 'users', 'url' => ['/pkl/pengajuan-pkl']],
                
                ['label' => 'Mitra PKL', 'icon' => 'road', 'url' => ['/pkl/mitra-pkl']],
               
            ];

            if(Roles::currentRole($userid) == Roles::BAAK) {
                $menus[] = ['label' => 'Kategori PKL', 'icon' => 'th-list', 'url' => ['/pkl/kategori-industri']];
            } elseif(Roles::currentRole($userid) == Roles::MHS) {
                $menus[] = ['label' => 'Laporan Harian', 'icon' => 'tasks', 'url' => ['/pkl/log-pkl']];
                $menus[] = ['label' => 'Detail PKL', 'icon' => 'book', 'url' => ['/pkl/detail-pkl']];
                $menus[] = ['label' => 'Informasi', 'icon' => 'flag', 'url' => ['/pkl/informasi']];
            }elseif(Roles::currentRole($userid) == Roles::DOSEN) {
                $menus[] = ['label' => 'Laporan Harian', 'icon' => 'tasks', 'url' => ['/pkl/log-pkl']];
                $menus[] = ['label' => 'Detail PKL', 'icon' => 'book', 'url' => ['/pkl/detail-pkl']];
                $menus[] = ['label' => 'Kategori PKL', 'icon' => 'th-list', 'url' => ['/pkl/kategori-industri']];
            }

        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => $menus,
            ]
        ) ?>

    </section>

</aside>
