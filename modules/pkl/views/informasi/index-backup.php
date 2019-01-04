<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
        <div class="tabbable" id="tabs-603091">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link" href="#tab1" 
                        data-toggle="tab">Prosedur</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link active show" href="#tab2" data-toggle="tab">Pedoman</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active show" href="#tab3" data-toggle="tab">Tata Tertib</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link active show" href="#tab4" data-toggle="tab">Dokumen PKL</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
                    <p>Mahasiswa yang akan mengambil mata kuliah Praktek Kerja Lapangan (PKL) telah memenuhi persyaratan baik persyaratan akademik maupun persyaratan administratif.</p>
					</div>

					<div class="tab-pane" id="tab2">
                    <p>Pembimbing Praktek Kerja Lapangan terdiri dari dosen pembimbing PKL Program Studi dan pembimbing lapangan. Pembimbing Lapangan adalah Pembimbing atau supervisor yang ditunjuk dan ditetapkan oleh pejabat yang berwenang di tempat kerja praktek. Dosen pembimbing PKL Program Studi adalah dosen yang mengajar di Program Studi masing-masing, baik coordinator PKL maupun dosen lain dengan keahlian yang sesuai dengan pekerjaan di tempat kerja praktek.</p>
					</div>

                    <div class="tab-pane" id="tab3">
                    
					</div>

                    <div class="tab-pane" id="tab4">
                        <ul>
                            <li>
                                <a href="https://drive.google.com/file/d/0B_mJ_DuSwoOvalhzRXVtdzhlUlU/view?usp=sharing" class="nav-link active show">Form Penilaian PKL</a>
                            </li>
                            <li>
                                <a href="https://drive.google.com/file/d/1DDyBaXi6NCFQ9crScuXjcItGbaP3HX5x/view?usp=sharing">Pedoman PKL</a>
                            </li>
                        </ul>
					</div>

				</div>
			</div>
		</div>
		<div class="col-md-4">

		</div>
	</div>
</div>

<script>
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tab-content");
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