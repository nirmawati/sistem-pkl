<?php
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
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
			<table>
				<tbody>
					<tr>
						<td>Nomor</td><td>:</td><td><?= sprintf("%03d", $model->id); ?>/S.Peng/BAAK/<?=$prodi?>/II/<?= date('Y'); ?></td>
					</tr>
                    <tr>
						<td>Lamp</td><td>:</td><td>-</td>
					</tr>
                    <tr>
						<td>Perihal</td><td>:</td><td><b>Permohonan Ijin Praktek Kerja Lapangan<b></td>
					</tr>
                    <tr>
						<td>Kepada</td><td>:</td><td><?= $model->mitra->nama ?></td>
					</tr>
                    <tr>
						<td></td><td></td><td><?= $model->mitra->alamat ?></td>
					</tr>
					
				</tbody>
			</table>
            <br><br>

			<p class="text-justify">
				Dengan Hormat,<br>
                Dalam rangka melaksanakan Program Kuliah Praktek Kerja Lapangan di Program Studi <?= $model->viewMhsProdi->prodi ?> Sekolah Tinggi Terpadu Nurul Fikri, maka dengan ini kami mohon berkenan untuk memberikan kesempatan kepada mahasiswa kami untuk melaksanakan Kerja Praktek di Perusahaan yang Bapak pimpin.
                <br><br>
                Adapun Mahasiswa tersebut adalah :
                <br>
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    Nama Mahasiswa
                                </th>
                                <th>
                                    NIM
                                </th>
                                <th>
                                    Jurusan
                                </th>
                            </tr>
                        </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        <?= $model->viewMhsProdi->nama ?>
                                    </td>
                                    <td>
                                        <?= $model->viewMhsProdi->nim ?>
                                    </td>
                                    <td>
                                        <?= $model->viewMhsProdi->prodi ?>
                                    </td>
                                </tr>
                            </tbody>
			        </table>

                <br>
                Mengenai jadwal dan pelaksanaan Kerja Praktek dilaksanakan dengan pada tanggal <?php echo tgl_indo($model->mulai) ?> s/d <?php echo tgl_indo($model->selesai) ?>.
                <br><br>
                Demikian permohonan kami. Atas perhatian dan kerja sama yang baik kami ucapkan terima kasih.
			</p><br><br>
			<div clas="row">
				<div class="col-md-12" style="margin-left:370px">
                <p class="text-justify">
                    Depok, <?= tgl_indo(date('Y-m-d')); ?><br>
                    Ketua Program Studi <?= $model->viewMhsProdi->prodi ?><br> 
                    Sekolah Tinggi Terpadu Nurul Fikri<br>
                    <br>
                    <br>
                    <br>
                    <?php
                        if($model->viewMhsProdi->prodi == "Informatika"){
                            echo '
                            <u><b>Ahmad Rio Adriansyah M,Si</b></u><br>
                            NIK: 010102130051';
                        }else{
                            echo '
                            <u><b>Amalia Rahmah, M.T</b></u><br>
                            NIK: 0402018701';
                        }
                    ?>
                </p>
				</div>
			</div>
		</div>
	</div>
</div>