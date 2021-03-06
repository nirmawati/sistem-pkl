<?php
    use yii\helpers\Html;
    use kartik\widgets\FileInput;
?>

<div class="col-md-12">
	<div class="box box-primary">
        <div class="box-body box-profile">	
            <div class="profile-user">
                <div class="col-md-12">
                    <div class="col-md-8">
                        <h3 style="margin-top:0;"><?= $mahasiswa->nama ?></h3>
                    </div>
                    <table id="w0" class="table table-bordered detail-view">
                        <tbody>
                            <tr><th width="30%">Perusahaan / Instansi</th><td><?= $mitra->nama ?></td></tr>
                            <tr><th width="30%">Tanggal Mulai</th><td><?= $tgl_mulai ?></td></tr>   
                            <tr><th width="30%">Tanggal Selesai </th><td><?= $tgl_selesai ?></td></tr>    
                            <tr><th width="30%">Alamat</th><td><?= $mitra->alamat ?></td></tr>
                            <tr><th width="30%">Departemen</th><td><?= $mahasiswa->prodi ?></td></tr>
                            <tr><th width="30%">Deskripsi Tugas</th><td><?= $detailPkl->deskripsi_tugas ?></td></tr>
                            <tr><th width="30%">Laporan PKL</th>
                                <td>
                                    <?php if($detailPkl->laporan == null){
                                            echo 'Belum Ada File Laporan';
                                        } else {
                                            echo Html::a($detailPkl->laporan, Yii::$app->homeUrl . 'uploads/file-laporan/' . $detailPkl->laporan);
                                    } ?>
                                </td>
                            </tr>
                        </tbody> 
                    </table> 
                </div>			
            </div>
        </div>
        <button class="accordion">Selanjutnya</button>
        <div class="panel">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Problem</h3>
                </div>
                <div class="box-body box-profile">	
                    <div class="profile-user">
                        <div class="col-md-12">
                            <table id="w0" class="table table-bordered detail-view">
                                <tbody>
                                    <tr><th width="30%">Kesesuaian </th><td><?php if($detailPkl->kesesuaian == null){echo 'Belum terdefinisi';}else if($detailPkl->kesesuaian == 0){echo 'Sesuai';}else if($detailPkl->kesesuaian == 1){echo 'Tidak Sesuai';} ?></td></tr>
                                    <tr><th width="30%">Deskripsi Masalah</th><td><?php if($detailPkl->masalah == null){echo 'Belum terdefinisi';}else{echo $detailPkl->masalah;}?></td></tr>  
                                    <tr><th width="30%">Tanggapan Dosen</th><td><?php if($detailPkl->masukan_dosen == null){echo 'Belum terdefinisi';}else{echo $detailPkl->masukan_dosen;}?></td></tr>  
                                    <tr><th width="30%">Nilai Akhir</th><td><?php if($detailPkl->nilai_akhir == null){echo 'Belum terdefinisi';}else{echo $detailPkl->nilai_akhir;}?></td></tr>  
                                    
                                </tbody>
                            </table>  
                        </div>
                    </div>			
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
    }
    .accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    text-align: center;
    border: none;
    outline: none;
    transition: 0.4s;
    }
</style>

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
        panel.style.maxHeight = null;
        } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
        } 
    });
    }
</script>
