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
            // $menus = [];

            if(Roles::currentRole($userid) == Roles::BAAK) {
                $menus [] =['label' => 'Home', 'icon' => 'home', 'url' => ['/']];    
                $menus [] =['label' => 'Panduan', 'icon' => 'book', 'url' => ['/pkl/panduan']];                    
                $menus [] = ['label' => 'Daftar Mahasiswa ', 'icon' => 'users', 'url' => ['/pkl/pengajuan-pkl']];
                $menus[] = ['label' => 'Kategori ', 'icon' => 'th-list', 'url' => ['/pkl/kategori-industri']];
                $menus[] = ['label' => 'Mitra', 'icon' => 'building', 'url' => ['/pkl/mitra-pkl']];
                $menus[] = ['label' => 'Riwayat', 'icon' => 'bookmark', 'url' => ['/pkl/riwayat-pkl']];
                $menus[] = ['label' => 'Status', 'icon' => 'bookmark', 'url' => ['/pkl/status-pkl']];


            } elseif(Roles::currentRole($userid) == Roles::MHS) {
                $menus [] =['label' => 'Home', 'icon' => 'home', 'url' => ['/']];   
                $menus [] =['label' => 'Panduan', 'icon' => 'book', 'url' => ['/pkl/panduan']];              
                $menus[] = ['label' => 'Pengajuan', 'icon' => 'edit', 'url' => ['/pkl/pengajuan-pkl']];
                // $menus[] = ['label' => 'Mitra', 'icon' => 'road', 'url' => ['/pkl/mitra-pkl']];
                $menus[] = ['label' => 'Laporan Harian', 'icon' => 'tasks', 'url' => ['/pkl/log-pkl']];
                $menus[] = ['label' => 'Laporan Akhir', 'icon' => 'book', 'url' => ['/pkl/detail-pkl']];
                

            }elseif(Roles::currentRole($userid) == Roles::DOSEN) {
                $menus [] =['label' => 'Home', 'icon' => 'home', 'url' => ['/']];  
                $menus [] =['label' => 'Panduan', 'icon' => 'book', 'url' => ['/pkl/panduan']];               
                $menus[] = ['label' => 'Daftar Mahasiswa', 'icon' => 'users', 'url' => ['/pkl/pengajuan-pkl']];    
                $menus[] = ['label' => 'Absensi Mahasiswa', 'icon' => 'tasks', 'url' => ['/pkl/log-pkl']];
                $menus[] = ['label' => 'Penilaian', 'icon' => 'check-square-o', 'url' => ['/pkl/detail-pkl']];                
                $menus[] = ['label' => 'Mitra', 'icon' => 'building', 'url' => ['/pkl/mitra-pkl']];
                $menus[] = ['label' => 'Kategori', 'icon' => 'th-list', 'url' => ['/pkl/kategori-industri']];
                $menus[] = ['label' => 'Riwayat', 'icon' => 'bookmark', 'url' => ['/pkl/riwayat-pkl']];                
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
