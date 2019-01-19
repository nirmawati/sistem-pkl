<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
            <h3 class="box-title">Profil Mahasiswa</h3>
        </div>
            <div class="box-body box-profile">	
                <div class="profile-user">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <h3 style="margin-top:0;"><?= $mahasiswa->nama ?></h3>
                        </div>
                            <table id="w0" class="table table-bordered detail-view"><tbody>
                            <tr><th width="30%">Email</th><td><a href="mailto:hady18059si@unf.ac.id"><?= $useremail ?></a></td></tr>
                            <tr><th width="30%">NIM</th><td><?= $mahasiswa->nim ?></td></tr>
                            <tr><th width="30%">Program Studi</th><td><?= $mahasiswa->prodi ?></td></tr>
                            <tr><th width="30%">Semester</th><td><?= $pengajuan->semester ?></td></tr>
                            <tr><th width="30%">Total SKS</th><td><?= $sks->total_sks ?></td></tr></table>    
                    </div>
                </div>			
            </div>
            <button class="accordion">Lihat Detail</button>
<div class="panel">
<div class="box box-primary">
		<div class="box-header with-border">
            <h3 class="box-title">Detail PKL</h3>
        </div>
            <div class="box-body box-profile">	
                <div class="profile-user">
                    <div class="col-md-12">

                            <table id="w0" class="table table-bordered detail-view"><tbody>
                            <tr><th width="30%">Perusahaan / Instansi</th><td><?= $mitra->nama?></td></tr>
                            <tr><th width="30%">Alamat</th><td><?= $mitra->alamat ?></td></tr>
                            <tr><th width="30%">Kategori</th><td><?= $kategori->nama ?></td></tr>
                            <tr><th width="30%">Topik PKL</th><td><?= $pengajuan->topik ?></td></tr>
                            <tr><th width="30%">Tanggal Mulai</th><td><?= $tgl_mulai ?></td></tr>
                            <tr><th width="30%">Tanggal Selesai</th><td><?= $tgl_selesai ?></td></tr>
                            <tr><th width="30%">Status PKL</th><td></td></tr></table>    
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

    

