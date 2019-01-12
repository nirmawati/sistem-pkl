<aside class="main-sidebar">

    <section class="sidebar">

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Home', 'icon' => 'home', 'url' => ['/']],

                    // ['label' => 'Profil', 'icon' => 'user', 'url' => ['/pkl/profil']],
                    ['label' => 'Informasi', 'icon' => 'flag', 'url' => ['/pkl/informasi']],
                    ['label' => 'Mitra PKL', 'icon' => 'road', 'url' => ['/pkl/mitra-pkl']],
                    ['label' => 'Kategori PKL', 'icon' => 'th-list', 'url' => ['/pkl/kategori-industri']],
                    ['label' => 'Mahasiswa PKL', 'icon' => 'users', 'url' => ['/pkl/pengajuan-pkl']],
                    ['label' => 'Detail PKL', 'icon' => 'book', 'url' => ['/pkl/detail-pkl']],
                    ['label' => 'Laporan Harian', 'icon' => 'tasks', 'url' => ['/pkl/log-pkl']],

                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'], ],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'], ],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#', ],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#', ],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#', ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
