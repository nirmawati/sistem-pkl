<?php
use yii\helpers\Html;

    function tgl_indo($tanggal){
        $bulan = [
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
    if($model->viewMhsProdi->prodi == "Informatika"){
        $prodi = "Prodi_TI";
    }else{
        $prodi = "Prodi_SI";
    }

?>

<div class="pdf-dealer container">
<p Style ="text-align:center"><h3>Daftar Hadir Mahasiswa PKL</h3></p>
<br>

<table>
	<tbody>
		<tr>
			<td>Nama Mahasiswa</td><td>:</td><td><?= $mahasiswa->nama ?></p></td>
		</tr>
        <tr>
			<td>Perusahaan / Instansi</td><td>:</td><td><?= $mitraPkl->nama ?></td>
		</tr>
					
	</tbody>
</table>
<br>

    <table class="table table-sm table-hover table-bordered">
        <thead >
            <tr>
                <td><b>Keterangan</b></td>
                <td><b>Tanggal</b></td>
                <td><b>Jam Masuk</b></td>
                <td><b>Jam Pulang</b></td>
                <td><b>Kegiatan</b></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($model as $data): ?>
                <tr>
                    <td><?php
                        if ($data->ket == 1) {
                            echo 'Hadir';
                        } elseif ($data->ket == 2) {
                            echo 'Izin';
                        } else {
                            echo 'Mangkir';
                        }
                    ?></td>
                    <td><?= $data->tanggal ?></td>
                    <td><?= $data->jam_masuk ?></td>
                    <td><?= $data->jam_pulang ?></td>
                    <td><?= $data->kegiatan ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    			<div clas="row">
				<div class="col-md-12" style="margin-left:370px">
                <p class="text-justify">
                <br>
                <br>
                    Depok, <?= tgl_indo(date('Y-m-d')); ?><br>
                    Mengetahui<br> 
                    Pembimbing Lapangan,
                    <br>
                    <br>
                    <br>
                    <br>
                    ________________________
                    
                </p>
				</div>
</div>