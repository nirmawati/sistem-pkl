<?php

/* @var $this yii\web\View */
use dosamigos\highcharts\HighCharts;
use app\modules\pkl\utils\Roles;
use app\models\PengajuanPkl;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '';

$pkl = PengajuanPkl::find();

if (Roles::currentRole($userid) == Roles::BAAK || Roles::currentRole($userid) == Roles::DOSEN) {
    //status_pelaksanaan
    $stSuratSelesai = $pkl->where(['status_surat' => 3])->count();
    $stSuratMenunggu = $pkl->where(['status_surat' => 2])->count();
    $stSuratDitolak = $pkl->where(['status_surat' => 1])->count();

    $suratCount = $stSuratSelesai + $stSuratMenunggu + $stSuratDitolak;

    //status_pelaksanaan
    $stPengajuanDiterima = $pkl->where(['status_pelaksanaan' => 4])->count();
    $stPengajuanMenunggu = $pkl->where(['status_pelaksanaan' => 2])->count();
    $stPengajuanDitolak = $pkl->where(['status_pelaksanaan' => 1])->count();

    $pengajuanCount = $stPengajuanDiterima + $stPengajuanMenunggu + $stPengajuanDitolak;

    //status_kegiatan
    $stKegiatanselesai = $pkl->where(['status_kegiatan' => 3])->count();
    $stKegiatansedangPKL = $pkl->where(['status_kegiatan' => 5])->count();
    $stKegiatanDitolak = $pkl->where(['status_kegiatan' => 1])->count();

    $kegiatanCount = $stKegiatanselesai + $stKegiatansedangPKL + $stKegiatanDitolak;

}

?>
<div class="site-index">

    <div class="container-fluid">
        <div class="row">
            <?php if (Roles::currentRole($userid) == Roles::MHS) : {
                if ($model->status_surat == 3 && $model->status_pelaksanaan == 2) {
                    echo '<div class="alert alert-success alert-dismissible">
                            <!-- <button type="button" class="close" aria-hidden="true">×</button> -->
                            <h4><i class="icon fa fa-check"></i> Surat Pengajuan Selesai!</h4>Silahkan Ambil Surat Pengantar PKL Anda diruang BAAK...
                        </div>';
                } else if ($model->status_surat == 3 && $model->status_pelaksanaan == 4 && $model->status_kegiatan == 5) {
                    echo '<div class="alert alert-success alert-dismissible">
                            <!-- <button type="button" class="close" aria-hidden="true">×</button> -->
                            <h4><i class="icon fa fa-check"></i> SELAMAT ANDA TELAH DITERIMA !!</h4>Semangat melaksanakan kegiatan PKL, Jangan Lupa lengkapi detail dan absensinya ya...
                        </div>';
                } else if ($model->status_surat == 3 && $model->status_pelaksanaan == 4 && $model->status_kegiatan == 3) {
                    echo '<div class="alert alert-success alert-dismissible">
                            <!-- <button type="button" class="close" aria-hidden="true">×</button> -->
                            <h4><i class="icon fa fa-check"></i> SELAMAT ANDA TELAH SELESAI PKL !!</h4>
                        </div>';
                } else if ($model->status_surat == 2 && $model->status_pelaksanaan == 6 & $model->status_kegiatan == 6) {
                    echo '<div class="alert alert-warning alert-dismissible">
                            <!-- <button type="button" class="close" aria-hidden="true">×</button> -->
                            <h4><i class="icon fa fa-check"></i> Tunggu ya!</h4>Surat Pengantar PKL Anda sedang diproses...
                        </div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible">
                    <h4><i class="icon fa fa-check"></i> BELUM DAFTAR !</h4> Anda belum terdaftar sebagai Mahasiswa PKL, silahkan daftar terlebih dahulu untuk memulai kegiatan PKL..
                </div>';
                }
            } ?>
            <div class="col-md-12">
                <!-- Tab links -->
                <div class="tab">
                    <button class="tablinks col-md-3" onclick="openCity(event, 'Prosedur')" id="defaultOpen">Panduan Pengajuan</button>
                    <button class="tablinks col-md-3" onclick="openCity(event, 'Pedoman')">Panduan Pelaksanaan</button>
                    <button class="tablinks col-md-3" onclick="openCity(event, 'Tatib')">Tata Tertib</button>
                    <button class="tablinks col-md-3" onclick="openCity(event, 'Doc')">Dokumen</button>
                </div>

                <!-- Tab content -->
                <div id="Prosedur" class="tabcontent">
                    <img style="display: block;margin-left: auto;margin-right: auto;width: 50%;" src="<?= Yii::$app->homeUrl . 'img/panduan1.jpg' ?>" class=" img-responsive" > 
                </div>
                <div id="Pedoman" class="tabcontent">
                    <img style="display: block;margin-left: auto;margin-right: auto;width: 50%;" src="<?= Yii::$app->homeUrl . 'img/panduan2.jpg' ?>" class=" img-responsive" > 
                </div>
                <div id="Tatib" class="tabcontent">
                    <div class="col-md-6">
                        <h3>Persyaratan</h3>
                        <p>Mahasiswa yang akan mengambil mata kuliah Praktek Kerja Lapangan (PKL) telah memenuhi persyaratan baik persyaratan akademik maupun persyaratan  administratif.</p>
                        <ol>
                            <li>Persyaratan Akademik<br>
                                Mahasiswa yang telah mengambil mata kuliah sebanyak 80 sks berdasarkan <a href="https://akademiksttnf.wordpress.com/khs-kartu-hasil-studi/">KHS</a> resmi yang dikeluarkan oleh BAAK.</li><br>
                            <li>Persyaratan Administratif<br>
                                Mencantumkan mata kuliah PKL dalam Kartu Rencana Studi (KRS) sebagai salah satu mata kuliah yang akan diambilnya.</li>
                        </ol>
                        <h3 style="text-align:justify;">Penilaian</h3>
                        <ol>
                            <li style="text-align:justify;">Penilaian Praktek Kerja dilakukan oleh pembimbing lapangan 40%, terdiri dari unsur: inovasi, kerjasama, kedisiplinan.</li>
                            <li style="text-align:justify;">Penilaian laporan Praktek Kerja oleh Dosen pembimbing laporan 40%, terdiri dari unsur: materi, penguasaan materi, bahasa dan tata penulisan.</li>
                            <li style="text-align:justify;">Penilaian seminar oleh koordinator PKL 20%, terdiri dari unsur presentasi, penguasaan materi.</li>
                            <li style="text-align:justify;">Semua hal yang berkaitan dengan penilaian Praktek Kerja dan laporan Praktek Kerja, dan seminar Praktek Kerja Lapangan harus dicantumkan dalam lembar penilaian.</li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <h3>Tata Tertib</h3>
                        <p>Mahasiswa yang mengikuti Kerja Praktek harus mematuhi dan mentaati tata tertib baik tata tertib yang dibuat oleh tempat kerja praktek, maupun Program Studi, antara lain:</p>
                        <ol>
                            <li>Mahasiswa harus berpakaian bersih dan rapi, memakai kemeja dan memakai sepatu tertutup;</li>
                            <li>Mahasiswa menjaga nama baik almamater;</li>
                            <li>Mahasiswa memakai tanda pengenal Praktek Kerja (jika ada);</li>
                            <li>Mahasiswa harus hadir sesuai dengan jadwal jam kerja tempat Praktek Kerja Lapangan.</li>
                            <li>Mahasiswa dilarang merokok ditempat yang tidak diperuntukkan, tidak minum minuman keras, membawa senjata tajam, senjata api dan narkoba di lingkungan tempat Praktek Kerja sebagaimana dilakukan di STT TERPADU NURUL FIKRI.</li>
                            <li>Mahasiswa harus menjaga kebersihan, keindahan dan kerapian.</li>
                            <li>Mahasiswa harus menjaga etika, sopan santun, ketenangan, ketertiban dan ketentraman tempat PKL.</li>
                            <li>Mahasiswa harus mematuhi tata tertib tempat PKL.</li>
                            <li>Pelanggaran terhadap tata tertib tempat Praktek Kerja akan dikenakan sanksi.</li>
                            <li>Hal-hal lain dapat menyesuaikan dengan kondisi di tempat PKL.</li>
                        </ol>
                    </div>
                    
                    
                </div>
                <div id="Doc" class="tabcontent">
                <h3>Dokumen PKL</h3>
                    <ul>
                        <li>
                            <a href="https://drive.google.com/file/d/0B_mJ_DuSwoOvalhzRXVtdzhlUlU/view?usp=sharing" class="nav-link active show">Form Penilaian PKL</a>
                        </li>
                        <li>
                            <a href="https://drive.google.com/file/d/1DDyBaXi6NCFQ9crScuXjcItGbaP3HX5x/view?usp=sharing">Pedoman & Template PKL</a>
                        </li>
                    </ul>
                </div>
            </div>
            <script>
                function openCity(evt, cityName) {
                    // Declare all variables
                    var i, tabcontent, tablinks;

                    document.getElementById("defaultOpen").click();

                    // Get all elements with class="tabcontent" and hide them
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }

                    // Get all elements with class="tablinks" and remove the class "active"
                    tablinks = document.getElementsByClassName("tablinks");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }

                    // Show the current tab, and add an "active" class to the button that opened the tab
                    document.getElementById(cityName).style.display = "block";
                    evt.currentTarget.className += " active";
                    }
            </script>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                <?php if (Roles::currentRole($userid) == Roles::BAAK || Roles::currentRole($userid) == Roles::DOSEN) : ?>
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="fa fa-file-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Surat Pengantar</span>
                            <span class="info-box-number">
                                <small class="label bg-green"><?= $stSuratSelesai ?></small>
                                <small class="label bg-yellow"><?= $stSuratMenunggu ?></small>
                                <small class="label bg-red"><?= $stSuratDitolak ?></small>
                            </span>
                        </div>
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-black"><i class="glyphicon glyphicon-paste"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Proses Pengajuan</span>
                            <span class="info-box-number">
                            
                                <small class="label bg-green"><?= $stPengajuanDiterima ?></small>
                                <small class="label bg-yellow"><?= $stPengajuanMenunggu ?></small>
                                <small class="label bg-red"><?= $stPengajuanDitolak ?></small>
                                
                            </span>
                        </div>
                    </div>

                     <div class="info-box">
                        <span class="info-box-icon bg-green"><i class=" fa fa-circle-o-notch"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sedang PKL</span>
                            <span class="info-box-number">
                            
                                <small class="label bg-green"><?= $stKegiatanselesai ?></small>
                                <small class="label bg-yellow"><?= $stKegiatansedangPKL ?></small>
                                <small class="label bg-red"><?= $stKegiatanDitolak ?></small>
                                
                            </span>
                        </div>
                    </div>               
                    
                </div>
                <div>
                    <!-- keterangan -->
                    <h4>Keterangan</h4>
                    <small class="label bg-green"> </small>&nbsp : Status Selesai<br>
                    <small class="label bg-yellow">  </small>&nbsp : Status Menunggu<br>
                    <small class="label bg-red">  </small>&nbsp : Status Ditolak<br>
                </div>
            </div>
            <div class="col-md-8">
                <?= HighCharts::widget([
                    'clientOptions' => [
                        'chart' => [
                            'type' => 'pie'
                        ],
                        'title' => [
                            'text' => 'Diagram Mahasiswa PKL'
                        ],
                        'series' => [
                            [
                                'data' => [
                                    ['Surat Pengantar', $suratCount],
                                    ['Proses Pengajuan', $pengajuanCount],
                                    ['Sedang PKL', $kegiatanCount]
                                ],
                            ]
                        ],
                    ]
                ]);
                ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
