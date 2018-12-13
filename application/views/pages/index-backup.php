<?php include('head.php'); ?>
<?php include('navigator.php'); ?>
<div class="container-fluid no-padding-margin" id="section-header">
	<section>
		<div class="row">
			<div class="header" id="header">
				<div id="slider-header" class="carousel slide" data-ride="carousel">
					<ul class="carousel-indicators">
						<li data-target="#slider-header" data-slide-to="0" class="active"></li>
						<li data-target="#slider-header" data-slide-to="1"></li>
					</ul>
					<div class="carousel-inner header-slider">
						<div class="carousel-item active">
							<img src="assets/website/images/icon-header.jpg" alt="kes header 1">
						</div>
						<div class="carousel-item">
							<img src="assets/website/images/icon-header-2.jpg" alt="kes header 2">
							<div class="carousel-caption slider-1">
								<h3 class="animated fadeInRight slider-1-header">Kontrol anak anda dengan mudah</h3>
							</div>   
						</div>
					</div>
				</div>
				<h3 class="header-search-h3">Temukanlah sekolah yang paling sesuai untuk anak anda</h3>
				<div class="header-search-inside">
					<select id="tingkatSearch" class="input-sm input-select">
						<option value="SD">SD</option>
						<option value="SMP">SMP</option>
						<option value="SMA">SMA</option>
						<option value="SMK">SMK</option>
					</select><i class="divider"></i>
					<input list="provinsi" placeholder="Provinsi" id="tingkatProvinsi" class="input-sm"><i class="divider"></i>
					<datalist id="provinsi">
						
					</datalist>
					<input list="kabupaten" placeholder="Kabupaten" id="tingkatKabupaten" class="input-sm"><i class="divider"></i>
					<datalist id="kabupaten">
						<option value="loading.."></option>
					</datalist>
					<input list="kecamatan" placeholder="Kecamatan" id="tingkatKecamatan"><i class="fa fa-map-marker in-icon"></i><i class="divider"></i>
					<datalist id="kecamatan">
						<option value="loading.."></option>
					</datalist>
					<input list="sekolah" placeholder="Cari nama sekolah" id="tingkatNamaSekolah" class="input-lg search-sekolah"><i class="fa fa-search in-icon"></i>
					<datalist id="sekolah">
						
					</datalist>
					<button type="button" class="search" id="but_search">Cari</button>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="hide section-divider"></div>
<div class="container middle-size-search">
	<div class="row">
		<div class="col-lg-3 col-md-6">
			<select id="tingkatSearch2">
				<option value="SD">SD</option>
				<option value="SMP">SMP</option>
				<option value="SMA">SMA</option>
				<option value="SMK">SMK</option>
			</select>
		</div>
		<div class="col-lg-3 col-md-6">
			<input list="provinsi" placeholder="Provinsi" id="tingkatProvinsi2">
				<datalist id="provinsi">
					
				</datalist>
		</div>
		<div class="col-lg-3 col-md-6">
			<input list="kabupaten" placeholder="Kabupaten" id="tingkatKabupaten2">
				<datalist id="kabupaten">
					<option value="loading.."></option>
				</datalist>
		</div>
		<div class="col-lg-3 col-md-6">
			<input list="kecamatan" placeholder="Kecamatan" id="tingkatKecamatan2">
				<datalist id="kecamatan">
					<option value="loading.."></option>	
				</datalist>
		</div>
		<div class="col-lg-8 col-md-8">
				<input list="sekolah" placeholder="Cari nama sekolah (isi data daerah terlebih dahulu)" id="tingkatNamaSekolah2">
				<datalist id="sekolah">
					
				</datalist>
		</div>
		<div class="col-lg-4 col-md-4">
				<button type="button" class="btn btn-block btn-info" id="but_search2">Cari</button>
		</div>
	</div>
</div>
<div class="section-divider"></div>
<div class="container" id="section-welcome">
	<section>
		<div class="welcome">
			<h2>Selamat datang di Kids Education System</h2>
			<h5>Senantiasa nyaman saat memantau perkembangan pendidikan anak anda</h5>
			<img id="welcome-image" src="assets/website/images/kes-system2.png" alt="">
		</div>
	</section>
</div>
<div class="section-divider"></div>
<div class="container">
	<div class="kes-overview">
		<h2>Apa itu Kids Education System?</h2>
		<h5>Ketahui tujuan kami</h5>
	</div>
</div>
<div class="container no-padding" id="section-kes-overview">
	<section>
		<div class="kes-objective">
			<div class="v-lign"></div>
			<div id="point"><i class="fa fa-lightbulb-o"></i></div>
			<div id="point2"><i class="fa fa-pencil"></i></div>
			<div id="point3"><i class="fa fa-question"></i></div>
			<div id="point4"><i class="fa fa-adjust"></i></div>
			<div class="objective-place-1" id="objective-place-1">
				<div id="objective-box-left-1">
					<h5>gagasan</h5>
					<p>Menyediakan <b><i>Student Information System</i></b> secara merinci untuk membantu pelaku pendidikan sehingga mereka dapat mengetahui kebutuhan dalam dunia pendidikan</p>
				</div>
			</div>
			<div class="objective-place-2" id="objective-place-2">
				<div id="objective-box-right-1">
					<h5>konsep</h5>
					<p>Menghubungkan orang tua, siswa, dan guru melalui aplikasi <b><i>Kids Education System</i></b> yang membuat kegiatan belajar mengajar menjadi lebih efektif</p>
				</div>
			</div>
			<div class="objective-place-3" id="objective-place-3">
				<div id="objective-box-left-2">
					<h5>cara kerja</h5>
					<p>Menyediakan <a href="kes-system">fitur-fitur</a> yang dapat meningkatkan proses belajar mengajar siswa dan dapat melihat perkembangan siswa tersebut dengan data yang akurat</p>
				</div>
			</div>
			<div class="objective-place-4" id="objective-place-4">
				<div id="objective-box-right-2" class="objective-box-right-4-adjust">
					<h5>apa yang membedakan</h5>
					<p>KES Memiliki fitur <b><i>Student Transfer History</i></b> berdasarkan kurikulum yang berlaku di Indonesia (kurikulum 2013). Fitur ini memberikan kemudahan bagi setiap pelaku pendidikan untuk melihat statistik perkembangan siswa</p>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="container-fluid no-padding-margin" id="section-kes-system">
	<section>
		<div id="slider-system" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner kes-slider">
				<div class="carousel-item active">
					<div class="row">
						<div class="col-lg-5 offset-lg-1 col-md-5 offset-md-1 col-sm-12">
							<img class="animated fadeInLeft" src="assets/website/images/kes-system1.png" alt="kes system 1">
						</div>	
						<div class="col-lg-5 col-md-5 col-sm-12">
							<h1 class="animated fadeInRight">kids education system</h1>
							<p class="animated fadeInRight">Aplikasi dalam bidang pendidikan yang membantu menghubungkan siswa, orang tua, dan guru dalam menjalankan aktivitas belajar mengajar</p>
						</div>	
					</div>
				</div>
				<div class="carousel-item">
					<div class="row">
						<div class="col-lg-5 offset-lg-1 col-md-5 offset-md-1 col-sm-12">
							<img class="animated fadeInLeft" src="assets/website/images/kes-system2.png" alt="kes system 2">
						</div>	
						<div class="col-lg-5 col-md-5 col-sm-12 index-header-slider">
							<h1 class="animated fadeInRight">akses mudah</h1>
							<p class="animated fadeInRight">Dapat digunakan di berbagai jenis perangkat sehingga memudahkan pengguna dalam mengakses aplikasi</p>
						</div>	
					</div>
				</div>
				<div class="carousel-item">
					<div class="row">
						<div class="col-lg-5 offset-lg-1 col-md-5 offset-md-1 col-sm-12">
							<img class="animated fadeInLeft" src="assets/website/images/kes-system3.png" alt="kes system 3">
						</div>	
						<div class="col-lg-5 col-md-5 col-sm-12 index-header-slider">
							<h1 class="animated fadeInRight">teknologi</h1>
							<p class="animated fadeInRight">Menggunakan teknologi terkini yang mampu memberikan user experience terbaik bagi pengguna aplikasi kami</p>
						</div>	
					</div>
				</div>
			</div>
			<a class="carousel-control-prev" href="#slider-system" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#slider-system" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>
		</div>
	</section>
</div>
<div class="container-fluid no-padding-margin" id="section-benefit">
	<section>
		<div class="row benefit" id="benefit-row-1">
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="background-benefit">
					<img src="assets/website/images/system/scheduling.png" alt="fitur sheduling">
					<h1>scheduling</h1>
					<p>Memberikan informasi seputar jadwal pelajaran</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="background-benefit">
					<img src="assets/website/images/system/subject-management.png" alt="fitur subject management">
					<h1>subject management</h1>
					<p>Menyediakan kemudahan dalam mangatur mata pelajaran dan silabus disetiap semester</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="background-benefit">
					<img src="assets/website/images/system/attendance.png" alt="fitur attendance">
					<h1>attendance</h1>
					<p>Memberikan informasi seputar absensi murid</p>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="container-fluid">
	<div class="row view-more">
		<div class="col-lg-10 offset-lg-1 col-sm-12 ">
			<h1>Kunjungi halaman fitur kami untuk melihat fitur yang lain</h1>
			<a href="kes-system"><button>view more</button></a>
		</div>
	</div>
</div>
<div class="sponsorship-parallax" id="parallax"></div>
<!-- <div class="container no-padding" id="section-playstore">
	<section>
		<div class="row playstore">
			<div class="col-lg-1"></div>
			<div class="col-lg-4 device-image">
				<img src="assets/website/images/playstore.png" alt="kes app download app store and play store">
			</div>
			<div class="col-lg-6 device-info">
				<h3>Unduh Aplikasi Kids Education System</h3>
				<p>aplikasi kami juga tersedia untuk Android dan IOS. Masukkan informasi dibawah ini atau unduh aplikasi pada tombol yang tersedia</p>
				<center>
				<div class="input-group mb-3 col-lg-9">
					<input type="text" placeholder="Masukkan nomor telepon">
					<div class="input-group-append">
						<button class="btn" type="button">Send</button>
					</div>
				</div>
				<p>or</p>
				<div class="input-group mb-3 col-lg-9">
					<input type="text" placeholder="Masukkan email">
					<div class="input-group-append">
						<button class="btn" type="button">Send</button>
					</div>
				</div>
				<div class="apps">
					<a href="#"><img src="assets/website/images/appstore.png" alt="kes appstore"></a>
					<a href="#"><img src="assets/website/images/googlestore.png" alt="kes playstore"></a>
				</div>
				</center>
			</div>
			<div class="col-lg-1"></div>
		</div>
	</section>
</div> -->
<?php include('footer.php'); ?>
<script src="assets/website/js/default.js"></script>
<script src="assets/website/js/home.js"></script>
</body>
</html>