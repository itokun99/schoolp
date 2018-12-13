<?php include('head.php'); ?>
<?php include('navigator.php'); ?>
<div class="modal fade" id="ModalDetail" role="dialog">
	<div class="modal-dialog modal-lg">  
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title school-detail-header">Detail Sekolah</h1>
				<button type="button" class="close" id="but_close_modal" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<button class="tablink" onclick="openPage('Identitas', this, '#308bfd')">IDENTITAS</button>
				<button class="tablink" onclick="openPage('Pelengkap', this, '#308bfd')" id="defaultOpen">DATA PELENGKAP</button>
				<button class="tablink" onclick="openPage('Kontak', this, '#308bfd')">KONTAK</button>
				<button class="tablink" onclick="openPage('Periodik', this, '#308bfd')">DATA PERIODIK</button>
				<button class="tablink" onclick="openPage('Lainnya', this, '#308bfd')">DATA LAINNYA</button>
				<div id="Identitas" class="detailtabcontent">
					<table class="school-detail">
						<tr>
							<th colspan="2">identitas sekolah</th>
						</tr>
						<tr>
							<td>NPSN</td>
							<td id="npsnSekolah"></td>
						</tr>
						<tr>
							<td>Nama Sekolah</td>
							<td id="namaSekolah"></td>
						</tr>
						<tr>
							<td>Jenjang Pendidikan</td>
							<td id="jenjangSekolah"></td>
						</tr>
						<tr>
							<td>Status Sekolah</td>
							<td id="statusSekolah"></td>
						</tr>
						<tr>
							<td>Provinsi</td>
							<td id="provinsiSekolah"></td>
						</tr>
						<tr>
							<td>Kabupaten</td>
							<td id="kabupatenSekolah"></td>
						</tr>
						<tr>
							<td>Kecamatan</td>
							<td id="kecamatanSekolah"></td>
						</tr>
						<tr>
							<td>Desa / Kelurahan</td>
							<td id="desaSekolah"></td>
						</tr>
						<tr>
							<td>RT / RW</td>
							<td id="rtrwSekolah"></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td id="alamatSekolah"></td>
						</tr>
						<tr>
							<td>Kode Pos</td>
							<td id="kodeposSekolah"></td>
						</tr>
					</table>
				</div>

				<div id="Pelengkap" class="detailtabcontent">
					<table class="school-detail">
						<tr>
							<th colspan="2">data pelengkap</th>
						</tr>
						<tr>
							<td>SK Pendirian Sekolah</td>
							<td id="skpendirianSekolah"></td>
						</tr>
						<tr>
							<td>Tanggal SK Pendirian Sekolah</td>
							<td id="tanggalskpendirianSekolah"></td>
						</tr>
						<tr>
							<td>Status Kepemilikan</td>
							<td id="statusKepemilikan"></td>
						</tr>
						<tr>
							<td>SK izin operasional</td>
							<td id="skizinOperasional"></td>
						</tr>
						<tr>
							<td>Tanggal SK izin operasional</td>
							<td id="tanggalskizinOperasional"></td>
						</tr>
						<tr>
							<td>Kebutuhan Khusus</td>
							<td id="kebutuhanKhusus"></td>
						</tr>
						<tr>
							<td>Nomor Rekening</td>
							<td id="noRekening"></td>
						</tr>
						<tr>
							<td>Nama Bank</td>
							<td id="namaBank"></td>
						</tr>
						<tr>
							<td>Cabang</td>
							<td id="cabangSekolah"></td>
						</tr>
						<tr>
							<td>Rekening Atas Nama</td>
							<td id="rekeningSekolah"></td>
						</tr>
						<tr>
							<td>MBS</td>
							<td id="mbsSekolah"></td>
						</tr>
						<tr>
							<td>Luas Tanah Milik (m2)</td>
							<td id="luastanahSekolah"></td>
						</tr>
						<tr>
							<td>Luas Tanah Bukan Milik (m2)</td>
							<td id="luastanahbukanSekolah"></td>
						</tr>
						<tr>
							<td>Nama Wajib Pajak</td>
							<td id="namawajibPajak"></td>
						</tr>
						<tr>
							<td>NPWP</td>
							<td id="npwpSekolah"></td>
						</tr>
					</table>
				</div>

				<div id="Kontak" class="detailtabcontent">
					<table class="school-detail">
						<tr>
							<th colspan="2">kontak sekolah</th>
						</tr>
						<tr>
							<td>Nomor Telepon</td>
							<td id="telpSekolah"></td>
						</tr>
						<tr>
							<td>Email</td>
							<td id="emailSekolah"></td>
						</tr>
						<tr>
							<td>Nomor Fax</td>
							<td id="faxSekolah"></td>
						</tr>
						<tr>
							<td>Website</td>
							<td id="webSekolah"></td>
						</tr>
						<tr>
							<td>CP</td>
							<td id="cpSekolah"></td>
						</tr>
					</table>
				</div>

				<div id="Periodik" class="detailtabcontent">
					<table class="school-detail">
						<tr>
							<th colspan="2">data periodik</th>
						</tr>
						<tr>
							<td>Waktu Penyelenggaraan</td>
							<td id="penyelenggaraSekolah"></td>
						</tr>
						<tr>
							<td>Bersedia Menerima Bos</td>
							<td id="bosSekolah"></td>
						</tr>
						<tr>
							<td>Sertifikasi ISO</td>
							<td id="isoSekolah"></td>
						</tr>
						<tr>
							<td>Sumber Listrik</td>
							<td id="sumberlistrikSekolah"></td>
						</tr>
						<tr>
							<td>Daya Listrik (watt)</td>
							<td id="dayalistrikSekolah"></td>
						</tr>
						<tr>
							<td>Akses Internet</td>
							<td id="aksesinternetSekolah"></td>
						</tr>
						<tr>
							<td>Akses Inernet Alternatif</td>
							<td id="aksesinternetalternatifSekolah"></td>
						</tr>
					</table>
				</div>

				<div id="Lainnya" class="detailtabcontent">
					<table class="school-detail">
						<tr>
							<th colspan="2">data lainnya</th>
						</tr>
						<tr>
							<td>Kepala Sekolah</td>
							<td id="kepalaSekolah"></td>
						</tr>
						<tr>
							<td>Operator Sekolah</td>
							<td id="operatorSekolah"></td>
						</tr>
						<tr>
							<td>Akreditasi</td>
							<td id="akreditasiSekolah"></td>
						</tr>
						<tr>
							<td>Kurikulum</td>
							<td id="kurikulumSekolah"></td>
						</tr>
						<tr>
							<td>Total Guru</td>
							<td id="totalguruSekolah"></td>
						</tr>
						<tr>
							<td>Total Siswa Pria</td>
							<td id="totalsiswaSekolah"></td>
						</tr>
						<tr>
							<td>Total Siswa Wanita</td>
							<td id="totalsiswiSekolah"></td>
						</tr>
						<tr>
							<td>Rombongan Belajar</td>
							<td id="rombelSekolah"></td>
						</tr>
						<tr>
							<td>Ruang Kelas</td>
							<td id="rukelSekolah"></td>
						</tr>
						<tr>
							<td>Laboratorium</td>
							<td id="laboratoriumSekolah"></td>
						</tr>
						<tr>
							<td>Perpustakaan</td>
							<td id="perpustakaanSekolah"></td>
						</tr>
						<tr>
							<td>Sanitasi</td>
							<td id="sanitasiSekolah"></td>
						</tr>
					</table>
				</div>
				<center><button type="button" class="btn btn-info btn-close" id="but_close_modal" data-dismiss="modal">Tutup</button></center>
			</div>
		</div>
	</div>
</div> 
<div class="container-fluid header" style="padding: 0px;">
	<div id="map" class="search-map">
		
	</div>
</div>
<div class="section-divider"></div>
<div class="container map-search" style="padding-bottom: 1%;">
	<div class="row">
		<div class="col-lg-1 col-md-2 col-sm-2 col-12">
			<select id="tingkatSearch">
				<option value="ALL">ALL</option>
				<option value="SD">SD</option>
				<option value="SMP">SMP</option>
				<option value="SMA">SMA</option>
				<option value="SMK">SMK</option>
			</select>
		</div>
		<div class="col-lg-2 col-md-3 col-sm-5 col-12">
			<input list="provinsi" placeholder="Provinsi" id="tingkatProvinsi">
				<datalist id="provinsi">
					
				</datalist>
		</div>
		<div class="col-lg-2 col-md-3 col-sm-5 col-12">
			<input list="kabupaten" placeholder="Kabupaten" id="tingkatKabupaten">
				<datalist id="kabupaten">
					<option value="loading.."></option>
				</datalist>
		</div>
		<div class="col-lg-2 col-md-4 col-sm-6 col-12">
			<input list="kecamatan" placeholder="Kecamatan" id="tingkatKecamatan">
				<datalist id="kecamatan">
					<option value="loading.."></option>	
				</datalist>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<input list="sekolah" placeholder="Cari nama sekolah" id="tingkatNamaSekolah">
				<datalist id="sekolah">
					
				</datalist>
		</div>
		<div class="col-lg-2 col-md-6 col-sm-12 col-12">
				<button type="button" class="btn btn-block btn-info" id="but_search2">Cari</button>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="display nowrap" style="width: 100%;" id="mydata">
					
				</table>
			</div>
		</div>
	</div>
</div>
<div class="section-divider"></div>
<?php include('footer.php'); ?>
<script>
	function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("detailtabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;

}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
</body>
</html>