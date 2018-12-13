<?php include('head.php'); ?>
<?php include('navigator.php'); ?>
<section id="section-header">
	<div class="container-fluid">
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
							<img src="assets/website/images/icon-header-3.jpg" alt="kes header 2">
							<div class="carousel-caption slider-1">
								<h3 class="animated fadeInRight slider-1-header">Memantau kegiatan belajar mengajar lebih mudah</h3>
							</div>   
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="container-fluid">
	<div class="row align-items-center justify-content-center">
		<div class="header-search-inside">	
			<h3>Temukan sekolah terbaik untuk anak anda</h3>
			<div class="row align-items-center justify-content-center header-search-input">
				<div class="col-lg-2 col-md-2 col-sm-2 col-12 d-flex align-items-center">
					<select id="tingkatSearch">
						<option value="ALL">ALL</option>
						<option value="SD">SD</option>
						<option value="SMP">SMP</option>
						<option value="SMA">SMA</option>
						<option value="SMK">SMK</option>
					</select>
					<span class="divider"></span>
				</div>
				<div class="col-lg-2 col-md-5 col-sm-5 col-12 d-flex align-items-center">
					<input list="provinsi" placeholder="Provinsi" id="tingkatProvinsi">
					<datalist id="provinsi">
						
					</datalist>
					<span class="divider"></span>
				</div>
				<div class="col-lg-2 col-md-5 col-sm-5 col-12 d-flex align-items-center">
					<input list="kabupaten" placeholder="Kabupaten" id="tingkatKabupaten">
					<datalist id="kabupaten">
						<option value="loading.."></option>
					</datalist>
					<span class="divider"></span>
				</div>
				<div class="col-lg-2 col-md-4 col-sm-6 col-12 d-flex align-items-center">
					<input list="kecamatan" placeholder="Kecamatan" id="tingkatKecamatan"><i class="fa fa-map-marker in-icon"></i>
					<datalist id="kecamatan">
						<option value="loading.."></option>	
					</datalist>
				</div>
				<div class="col-lg-2 col-md-5 col-sm-6 col-12 d-flex align-items-center" >
					<input list="sekolah" placeholder="Sekolah" id="tingkatNamaSekolah">
					<datalist id="sekolah">
					
					</datalist>
					<i class="fa fa-search in-icon"></i>
				</div>
				<div class="col-lg-2 col-md-3 col-12">
					<button type="button" class="btn btn-block btn-info" id="but_search">Cari</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="section-divider"></div>
<section id="section-welcome">
	<div class="container">
		<div class="row align-items-center justify-content-center">
			<div class="welcome">
				<h2>Selamat datang di Kids Education System</h2>
				<h5>Senantiasa nyaman saat memantau perkembangan pendidikan anak anda</h5>
				<img id="welcome-image" src="assets/website/images/kes-system2.png" alt="">
			</div>
		</div>
	</div>
</section>
<div class="section-divider"></div>
<div class="container">
	<div class="row align-items-center justify-content-center">
		<div class="kes-overview">
			<h2>Apa itu Kids Education System?</h2>
			<h5>Ketahui tujuan kami</h5>
		</div>
	</div>
</div>
<section id="section-kes-overview">
	<div class="container" >
		<div class="kes-objective">
			<div class="v-lign"></div>
			<div id="point"><i class="fa fa-lightbulb-o"></i></div>
			<div id="point2"><i class="fa fa-pencil"></i></div>
			<div id="point3"><i class="fa fa-question"></i></div>
			<div id="point4"><i class="fa fa-adjust"></i></div>
			<div class="objective-place-1" id="objective-place-1">
				<div id="objective-box-left-1">
					<h5>gagasan</h5>
					<p>Menyediakan <b><i>Student Information System</i></b> secara merinci untuk membantu pelaku pendidikan</p>
				</div>
			</div>
			<div class="objective-place-2" id="objective-place-2">
				<div id="objective-box-right-1">
					<h5>konsep</h5>
					<p>Menghubungkan sekolah, orang tua, dan siswa dengan aplikasi <b><i>Kids Education System</i></b> demi menunjang kegiatan belajar mengajar yang efektif</p>
				</div>
			</div>
			<div class="objective-place-3" id="objective-place-3">
				<div id="objective-box-left-2">
					<h5>cara kerja</h5>
					<p>Dengan data-data yang akurat, berbagai macam <a href="kes-system"><b>fitur</b></a> disediakan untuk mengukur perkembangan siswa</p>
				</div>
			</div>
			<div class="objective-place-4" id="objective-place-4">
				<div id="objective-box-right-2" class="objective-box-right-4-adjust">
					<h5>apa yang membedakan</h5>
					<p>KES Memiliki fitur <b><i>Student Transfer History</i></b> berdasarkan kurikulum yang berlaku di Indonesia (kurikulum 2013). Fitur ini memberikan kemudahan bagi setiap pelaku pendidikan untuk melihat statistik perkembangan siswa</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="section-kes-system">
	<div class="container-fluid" style="background-color: #54c8ff">
		<div class="row align-items-center justify-content-center">
			<div id="slider-system" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner kes-slider">
					<div class="carousel-item active">
						<div class="row align-items-center justify-content-center">
							<div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-center justify-content-center">
								<img class="animated fadeInLeft" src="assets/website/images/kes-system1.png" alt="kes system 1">
							</div>	
							<div class="col-lg-4 col-md-4 col-sm-12 d-flex flex-column align-items-center">
								<h1 class="animated fadeInRight">kids education system</h1>
								<p class="animated fadeInRight">Aplikasi yang membantu menghubungkan sekolah, orang tua, dan siswa dalam menjalankan aktivitas belajar mengajar</p>
							</div>	
						</div>
					</div>
					<div class="carousel-item">
						<div class="row align-items-center justify-content-center">
							<div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex align-items-center justify-content-center">
								<img class="animated fadeInLeft" src="assets/website/images/kes-system2.png" alt="kes system 2">
							</div>	
							<div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex flex-column align-items-center">
								<h1 class="animated fadeInRight">akses mudah</h1>
								<p class="animated fadeInRight">Dapat digunakan di berbagai jenis perangkat sehingga memudahkan pengguna dalam mengakses aplikasi</p>
							</div>	
						</div>
					</div>
					<div class="carousel-item">
						<div class="row align-items-center justify-content-center">
							<div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-center justify-content-center">
								<img class="animated fadeInLeft" src="assets/website/images/kes-system3.png" alt="kes system 3">
							</div>	
							<div class="col-lg-4 col-md-4 col-sm-12 d-flex flex-column align-items-center">
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
		</div>
	</div>
</section>
<section id="section-benefit">
	<div class="container-fluid">
		<div class="row benefit">
			<div class="col-lg-4 col-md-4 col-sm-6 d-flex flex-column align-items-center">
				<div class="background-benefit">
					<img src="assets/website/images/system/scheduling.png" alt="fitur sheduling">
					<h1>scheduling</h1>
					<p>Memberikan informasi seputar jadwal pelajaran</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 d-flex flex-column align-items-center">
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
		<div class="row justify-content-center view-more">
			<div class="col-lg-9 col-md-9 col-sm-12 col-12 d-flex align-items-center">
				<h1>Kunjungi halaman fitur kami untuk melihat fitur yang lain</h1>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-12">
				<div class="float-right">
					<a href="kes-system"><button>view more</button></a>
				</div>	
			</div>
		</div>
	</div>
</section>
<div class="sponsorship-parallax d-flex align-items-center justify-content-center" id="parallax">
	<div class="container">
		<div class="row align-items-center justify-content-center" id="parallax-content">
			<div class="col-lg-12 col-md-12 col-12">
				<h1 id="parallax-header" class="animated">terima kasih untuk media partner</h1>
			</div>
			<div class="col-lg-2 col-md-3 col-3">
				<img id="parallax-metrodata" class="animated" src="assets/website/images/parallax-metrodata.png" alt="media partner metrodata">
			</div>
			<div class="col-lg-2 col-md-3 col-3">
				<img id="parallax-mendikbud" class="animated" src="assets/website/images/parallax-mendikbud.png" alt="media partner mendikbud">
			</div>
		</div>
	</div>
</div>
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
<script type="text/babel" src="assets/website/component/search.jsx"></script>
</body>
</html>