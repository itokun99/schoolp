<style type="text/css">
  #map-canvas {
    width: 550px;
    height: 250px;
    background-color: #fff;
    border: 1px solid #999;
	text-overflow: ellipsis;
  }
   #map-canvas2 {
    width: 550px;
    height: 250px;
    background-color: #fff;
    border: 1px solid #999;
	text-overflow: ellipsis;
  }
   #map-canvas3 {
    width: 550px;
    height: 250px;
    background-color: #fff;
    border: 1px solid #999;
	text-overflow: ellipsis;
  }
  #map-canvas4 {
    width: 550px;
    height: 250px;
    background-color: #fff;
    border: 1px solid #999;
	text-overflow: ellipsis;
  }
   #map-canvas5 {
    width: 550px;
    height: 250px;
    background-color: #fff;
    border: 1px solid #999;
	text-overflow: ellipsis;
  }
  #map-canvas6 {
    width: 550px;
    height: 250px;
    background-color: #fff;
    border: 1px solid #999;
	text-overflow: ellipsis;
  }
  #map-canvas7 {
    width: 550px;
    height: 250px;
    background-color: #fff;
    border: 1px solid #999;
	text-overflow: ellipsis;
  }
      
  #panel {
    position: relative;
    top: -240px;
    left: 120px;
	width: 270px;
    padding: 0px 0px 0px 0px;
	font-family: Arial;
    font-size: 10px;
  }
</style>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="orange">
				<i class="fa fa-edit fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Profil Anak</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 800px">
						  
							<div class="box-header with-border">
							  <h3 class="box-title">Ubah Profil</h3>
							</div>
							
							<div class="box-body">
							  
								<div class="panel-body pan">
								    <?php
										if ($this->session->userdata('err_message'))
										{
										  $err_message = $this->session->userdata('err_message');
										  $this->session->unset_userdata("err_message");
										}
									?>
									<table id="datatable" width="100%">
										<tr>
										  <td><?php if (isset($err_message)) echo $err_message; ?></td>
										</tr>
									</table>
								   
								   <form class="form-horizontal" id="frmStudent" name="frm" action="children/updatedb" method="POST" enctype="multipart/form-data">
									  <input type="Hidden" name="student_id" value="<?php echo $student_id ?>">
									  <div class="form-body pal">
									   <h4>i. Data Siswa</h4>
									  <div class="form-group">
											 <label class="control-label col-lg-3">Foto</label>
											 <div class="col-lg-9">
												<div class="col-lg-8 row">
												  <?php
													  $url_path = $this->session->userdata('link_school') . "/";
													  if ($student->picture == "") $img_type = 0; else $img_type = 1;
												  ?>
												  
												  <?php if ($img_type == 1) { ?>
												  <img src="<?php echo $url_path ?>assets/images/profile/mm_<?php echo $student->picture ?>" class="img-rounded" width="200" border="0">
												  <?php } else { ?>
													  <img src="assets/images/profile/mm_na.jpg" class="img-rounded" width="200" border="0">
												  <?php } ?>
												   
												</div>
											 </div>
										  </div>

										  <div class="form-group">
											 <label class="control-label col-lg-3">Tingkatan Kelas</label>
											 <label style="text-align: left" class="control-label col-lg-9"><?php echo $student->edulevel_name ?></label>
										  </div>
										
										  <div class="form-group">
											 <label class="control-label col-lg-3">Nama *</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $student->fullname ?>" required="true" />
												</div>
											 </div>
										  </div>

										   <div class="form-group">
											 <label class="control-label col-lg-3">Jenis Kelamin *</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
													<input type="Radio" name="gender" id="gender" value="Male" <?php if ($student->gender == "Male") echo "Checked" ?> required="true">&nbsp; Laki-Laki
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<input type="Radio" name="gender" id="gender" value="Female" <?php if ($student->gender == "Female") echo "Checked" ?> required="true">&nbsp; Perempuan
												</div>
											 </div>
										  </div>
										 										   
										  <div class="form-group">
											 <label class="control-label col-lg-3">Nomor Induk Siswa (NIS)</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="text" class="form-control" disabled id="nis" name="nis" value="<?php echo $student->member_code ?>" required="true">
												</div>
											 </div>
										  </div>

										  <div class="form-group">
											 <label class="control-label col-lg-3">Nomor Induk Siswa Nasional (NISN)</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="text" class="form-control" disabled id="nisn" name="nisn" value="<?php echo $student->nisn ?>" required="true">
												</div>
											 </div>
										  </div>

										   <div class="form-group">
											 <label class="control-label col-lg-3">Rombel</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="text" class="form-control" id="inputRombel" name="rombel" value="<?php if (is_object($studentDetail)) echo $studentDetail->rombel ?>">
												</div>
											 </div>
										  </div>

										   <div class="form-group">
											 <label class="control-label col-lg-3">Tempat Lahir</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
													<input type="text" class="form-control" id="inputBirthPlace" name="birth_place" value="<?php echo $student->birth_place ?>">
												</div>
											 </div>
										  </div>

										    <div class="form-group">
											 <label class="control-label col-lg-3">Tanggal Lahir</label>
											 <div class="col-lg-9">
												<div class="col-lg-8 row">
												  <select name="birth_day" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">
														<option value="">dd</option>
														<option value="">---</option>
													<?php for ($i = 1; $i <= 31; $i++) { ?>								
														<option value="<?php echo sprintf("%02d",$i) ?>" <?php if (date('d',strtotime($student->birth_date)) == $i && $student->birth_date <> "0000-00-00") echo "Selected" ?>><?php echo sprintf("%02d",$i) ?></option>	
													<?php } ?>	
												  </select>&nbsp;&nbsp;
												  <select name="birth_month" class="form-control" style="width: 120px; display: inline;" autocomplete="off" required="yes">
														<option value="">mm</option>
														<option value="">---</option>
													<?php for ($i = 1; $i <= 12; $i++)
													{
														 $monthName = date("F", mktime(0, 0, 0, $i, 10));
													?>								
														<option value="<?php echo sprintf("%02d",$i) ?>" <?php if (date('m',strtotime($student->birth_date)) == $i && $student->birth_date <> "0000-00-00") echo "Selected" ?>><?php echo $monthName ?></option>	
													<?php } ?>	
												  </select>&nbsp;&nbsp;
												  <select name="birth_year" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">
														<option value="">yyyy</option>
														<option value="">---</option>
													<?php for ($i = 1980; $i <= 2017; $i++) { ?>								
														<option value="<?php echo $i ?>" <?php if (date('Y',strtotime($student->birth_date)) == $i && $student->birth_date <> "0000-00-00") echo "Selected" ?>><?php echo $i ?></option>	
													<?php } ?>	
												  </select>
												</div>
											 </div>
										  </div>
										  
										 <div class="form-group">
											 <label class="control-label col-lg-3">Status Kewarganegaraan *</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												  <select name="citizen_status" id="citizen_status" class="form-control" autocomplete="off" required="yes">
														<option value="">Pilih:</option>
														<option value="">---</option>
														<option value="WNI" <?php if ($student->citizen_status == "WNI") echo "Selected" ?>>Warga Negara Indonesia (WNI)</option>
														<option value="WNA" <?php if ($student->citizen_status == "WNA") echo "Selected" ?>>Warga Negara Asing (WNA)</option>
												  </select>	
												</div>
											 </div>
										  </div>

										   <div class="form-group">
											 <label class="control-label col-lg-3">NIK / NIORA *</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $student->nik ?>" required="yes">
												</div>
											 </div>
										  </div>
										  
										  <div class="form-group">
											 <label class="control-label col-lg-3">Agama *</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												  <select name="religion" id="religion" class="form-control" autocomplete="off" required="yes">
														<option value="">Pilih:</option>
														<option value="">---</option>
													<?php foreach($religions AS $religionz) { ?>								
														<option value="<?php echo $religionz->religion_name ?>" <?php if ($student->religion == $religionz->religion_name) echo "Selected" ?>><?php echo $religionz->religion_name ?></option>	
													<?php } ?>	
												  </select>

												</div>
											 </div>
										  </div>

										   <div class="form-group">
											 <label class="control-label col-lg-3">Kebutuhan Khusus</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="text" class="form-control" id="inputRombel" name="special_needs" value="<?php if (is_object($studentDetail)) echo $studentDetail->special_needs ?>" />
												</div>
											 </div>
										  </div>
										    
										 

										  <h4>ii. Alamat Tempat Tinggal</h4>
										  
										  <div class="form-group">
											 <label class="control-label col-lg-3">RT</label>
											 <div class="col-lg-3">
												<input type="text" class="form-control" id="inputRT" name="rt" value="<?php  if (is_object($studentDetail)) echo $studentDetail->rt ?>" />
											 </div>
											 <label class="control-label col-lg-1">RW</label>
											 <div class="col-lg-3">
												<input type="text" class="form-control" id="inputRW" name="rw" value="<?php  if (is_object($studentDetail)) echo $studentDetail->rw ?>" />
											 </div>
											 <div class="col-lg-3"></div>
										  </div>

										  <div class="form-group">
											 <label class="control-label col-lg-3">Dusun</label>
											 <div class="col-lg-9">
												<div class="col-lg-8 row">
												   <input type="text" class="form-control" id="inputEmail" name="dusun" value="<?php if (is_object($studentDetail)) echo $studentDetail->dusun ?>" />
												</div>
											 </div>
										  </div>

										  <div class="form-group">
											 <label class="control-label col-lg-3">Kelurahan</label>
											 <div class="col-lg-9">
												<div class="col-lg-8 row">
												   <input type="text" class="form-control" id="inputEmail" name="kelurahan" value="<?php if (is_object($studentDetail)) echo $studentDetail->kelurahan ?>" />
												</div>
											 </div>
										  </div>

										  <div class="form-group">
											 <label class="control-label col-lg-3">Kecamatan</label>
											 <div class="col-lg-9">
												<div class="col-lg-8 row">
												   <input type="text" class="form-control" id="inputEmail" name="kecamatan" value="<?php if (is_object($studentDetail)) echo $studentDetail->kecamatan ?>" />
												</div>
											 </div>
										  </div>

										    <div class="form-group">
											 <label class="control-label col-lg-3">Kode Pos</label>
											 <div class="col-lg-9">
												<div class="col-lg-8 row">
												   <input type="text" class="form-control" id="inputEmail" name="post_code" value="<?php if (is_object($studentDetail)) echo $studentDetail->post_code ?>" />
												</div>
											 </div>
										  </div>

										<div class="form-group">
											 <label class="control-label col-lg-3">Jenis Tinggal</label>
											 <div class="col-lg-9">
												<div class="col-lg-8 row">
												   <input type="text" class="form-control" id="inputEmail" name="jenis_tinggal" value="<?php if (is_object($studentDetail)) echo $studentDetail->jenis_tinggal ?>" />
												</div>
											</div>
										</div>


										<div class="form-group">
											 <label class="control-label col-lg-3">Transportasi Menuju Sekolah</label>
											 <div class="col-lg-9">
												<div class="col-lg-8 row">
												   <input type="text" class="form-control" id="inputEmail" name="transportasi" value="<?php if (is_object($studentDetail)) echo $studentDetail->transportasi ?>" />
												</div>
											 </div>
										</div>										
										
									  	<div class="form-group">
											 <label class="control-label col-lg-3">Alamat</label>
											 <div class="col-lg-9">
												<div class="col-lg-8 row">
													<textarea class="form-control" id="comp_address" onchange="change_text_address()" name="address"><?php echo $student->address ?></textarea>
												</div>
											 </div>
										</div>
										<div class="form-group">
											 <label class="control-label col-lg-3">Lintang</label>
											 <div class="col-lg-3">
												<input type="text" class="form-control" id="pos_latitude" name="latitude" value="<?php if (is_object($studentDetail)) echo $studentDetail->latitude ?>" onchange="change_position()" readonly="true">
											 </div>
											 <label class="control-label col-lg-1">Bujur</label>
											 <div class="col-lg-3">
												<input type="text" class="form-control" id="pos_longitude" name="longitude" value="<?php if (is_object($studentDetail)) echo $studentDetail->longitude ?>" onchange="change_position()" readonly="true">
											 </div>
											 <div class="col-lg-3"></div>
										</div>

										<div class="form-group">
											<label class="control-label col-lg-3"></label>
											 <div class="col-lg-9">
												<div class="col-lg-9 row">
													<div id="map-canvas"></div>
													<div id="panel">
														<input type="Text" id="address_auto" class="form-control" value="" placeholder=" Enter a Location ">
													</div>		
												</div>
											</div>
										</div>	

										<h4>iii. Kontak Siswa</h4>

										  <div class="form-group">
											 <label class="control-label col-lg-3">Telephone Rumah</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="text" class="form-control" id="inputPassword" name="home_phone" value="<?php if (is_object($studentDetail)) echo $studentDetail->home_phone ?>" autocomplete="no" />
												</div>
											 </div>
										  </div>
										  
										 

										  <div class="form-group">
											 <label class="control-label col-lg-3">Handphone</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="mobile_phone" class="form-control" id="inputPhone" name="mobile_phone" value="<?php echo $student->mobile_phone ?>" />
												</div>
											 </div>
										  </div>

										   <div class="form-group">
											 <label class="control-label col-lg-3">Email</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $student->email ?>" />
												</div>
											 </div>
										  </div>

										   <div class="form-group">
											 <label class="control-label col-lg-3">Surat Keterangan Ujian Negara</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="text" class="form-control" id="inputPassword" name="skhun" value="<?php if (is_object($studentDetail)) echo $studentDetail->skhun ?>" autocomplete="no" />
												</div>
											 </div>
										  </div>

										  <div class="form-group">
											 <label class="control-label col-lg-3">Penerimaan KPS</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="text" class="form-control" id="inputPassword" name="penerima_kps"  value="<?php if (is_object($studentDetail)) echo $studentDetail->penerima_kps ?>" autocomplete="no" />
												</div>
											 </div>
										  </div>

										  <div class="form-group">
											 <label class="control-label col-lg-3">Nomor KPS</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
												   <input type="text" class="form-control" id="inputPassword" name="no_kps" value="<?php if (is_object($studentDetail)) echo $studentDetail->no_kps ?>" autocomplete="no" />
												</div>
											 </div>
										  </div>

										 <h4>iv. Data Orangtua</h4>
										 <input type="hidden" id="parent_tz" name="parent_tz" value="1">

										<div class="col-lg-12">
										<div id="tabs">
											<ul class="nav nav-pills nav-pills-warning" id="prodTabs">
												<li class="active">
													<a href="#ayah" data-id="1">Ayah</a>
												</li>
												<li>
													<a href="#ibu" data-id="2">Ibu</a>
												</li>
												<li>
													<a href="#wali" data-id="3">Wali</a>
												</li>
												
											</ul>

											<div class="tab-content">
												<div id="ayah" class="tab-pane active">
													<div class="col-lg-12">
														<div class="form-group">
															<h4>a. Ayah</h4>
															<input type="hidden" value="" name="surveymap[0][member_id]">
															<input type="hidden" value="Ayah" name="surveymap[0][parent_type]">
				 
															<label class="control-label col-lg-3">Nama Lengkap *</label>
															<div class="col-lg-9">
															   <div class="col-lg-8 row">
																  <input type="text" class="form-control" id="NameAyah" name="surveymap[0][parent_name]" value="<?php if (is_object($parentAyah)) echo $parentAyah->parent_name ?>">
															   </div>
															</div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Status Kewarganegaraan *</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																<select name="surveymap[0][type_warga]" id="TypeAyah" class="form-control" autocomplete="off">
																	  <option value="">Pilih:</option>
																	  <option value="">---</option>
																	  <option value="WNI" <?php if (is_object($parentAyah) && $parentAyah->type_warga == "WNI") echo "Selected" ?>>Warga Negara Indonesia (WNI)</option>
																	  <option value="WNA" <?php if (is_object($parentAyah) && $parentAyah->type_warga == "WNA") echo "Selected" ?>>Warga Negara Asing (WNA)</option>
																</select>
																  
															  </div>
														   </div>
														</div>
			  
														<div class="form-group">
														   <label class="control-label col-lg-3">NIK / NIORA *</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="NikAyah" name="surveymap[0][parent_nik]"  value="<?php if (is_object($parentAyah)) echo $parentAyah->parent_nik ?>">
															  </div>
														   </div>
														</div>
			  
														<div class="form-group">
														   <label class="control-label col-lg-3">Tempat Lahir</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputBirthPlace" name="surveymap[0][parent_birth_place]" value="<?php if (is_object($parentAyah)) echo $parentAyah->parent_birth_place ?>">
															  </div>
														   </div>
														</div>
		
														<div class="form-group">
														   <label class="control-label col-lg-3">Tanggal Lahir</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																  <select name="surveymap[0][pbirth_day]" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">
																		<option value="">dd</option>
																		<option value="">---</option>
																	<?php for ($i = 1; $i <= 31; $i++) { ?>								
																		<option value="<?php echo sprintf("%02d",$i) ?>" <?php if (is_object($parentAyah) && date('d',strtotime($parentAyah->parent_birth_date)) == $i && $parentAyah->parent_birth_date <> "0000-00-00") echo "Selected" ?>><?php echo sprintf("%02d",$i) ?></option>	
																	<?php } ?>	
																  </select>&nbsp;&nbsp;
																  <select name="surveymap[0][pbirth_month]" class="form-control" style="width: 120px; display: inline;" autocomplete="off" required="yes">
																		<option value="">mm</option>
																		<option value="">---</option>
																	<?php for ($i = 1; $i <= 12; $i++)
																	{
																		 $monthName = date("F", mktime(0, 0, 0, $i, 10));
																	?>								
																		<option value="<?php echo sprintf("%02d",$i) ?>" <?php if (is_object($parentAyah) && date('m',strtotime($parentAyah->parent_birth_date)) == $i && $parentAyah->parent_birth_date <> "0000-00-00") echo "Selected" ?>><?php echo $monthName ?></option>	
																	<?php } ?>	
																  </select>&nbsp;&nbsp;
																  <select name="surveymap[0][pbirth_year]" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">
																		<option value="">yyyy</option>
																		<option value="">---</option>
																	<?php for ($i = 1950; $i <= 2017; $i++) { ?>								
																		<option value="<?php echo $i ?>" <?php if (is_object($parentAyah) && date('Y',strtotime($parentAyah->parent_birth_date)) == $i && $parentAyah->parent_birth_date <> "0000-00-00") echo "Selected" ?>><?php echo $i ?></option>	
																	<?php } ?>	
																  </select>																  
															  </div>
														   </div>
														</div>
		
		
														<div class="form-group">
														   <label class="control-label col-lg-3">Telephone Rumah</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputEmail" name="surveymap[0][parent_home_phone]" value="<?php if (is_object($parentAyah)) echo $parentAyah->parent_home_phone ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Handphone *</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="MobileAyah" name="surveymap[0][parent_phone]" value="<?php if (is_object($parentAyah)) echo $parentAyah->parent_phone ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Email</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="email" class="form-control" id="EmailAyah" name="surveymap[0][parent_email]" value="<?php if (is_object($parentAyah)) echo $parentAyah->parent_email ?>">
															  </div>
														   </div>
														</div>
			  
														<div class="form-group">
														   <label class="control-label col-lg-3">Pendidikan</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputEmail" name="surveymap[0][parent_education]" value="<?php if (is_object($parentAyah)) echo $parentAyah->parent_education ?>">
															  </div>
														   </div>
														</div>
		
		
														<div class="form-group">
														   <label class="control-label col-lg-3">Jabatan Pekerjaan</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputEmail" name="surveymap[0][employment]" value="<?php if (is_object($parentAyah)) echo $parentAyah->employment ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Nama Perusahaan </label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputEmail" name="surveymap[0][company_name]" value="<?php if (is_object($parentAyah)) echo $parentAyah->company_name ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Alamat Tempat Kerja </label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <textarea id="comp_address2" class="form-control" name="surveymap[0][workplace_address]" onchange="change_text_address2()"><?php if (is_object($parentAyah)) echo $parentAyah->workplace_address ?></textarea>
															  </div>
														   </div>
														</div>
														
														<div class="form-group">
															<label class="control-label col-lg-3">Lintang</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_latitude2" name="surveymap[0][office_latitude]" onchange="change_position2()" value="<?php if (is_object($parentAyah)) echo $parentAyah->office_latitude ?>" readonly="true">
															</div>
															<label class="control-label col-lg-1">Bujur</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_longitude2" name="surveymap[0][office_longitude]" onchange="change_position2()" value="<?php if (is_object($parentAyah)) echo $parentAyah->office_longitude ?>" readonly="true">
															</div>
															<div class="col-lg-3"></div>
													    </div>		
	
														<div class="form-group">
															<label class="control-label col-lg-3"></label>
															<div class="col-lg-9">
																<div class="col-lg-8 row">
																	<div id="map-canvas2"></div>
																	<div id="panel">
																		<input type="Text" id="address_auto2" class="form-control" value="" placeholder=" Enter a Location ">
																	</div>		
																</div>
															</div>
														</div>
														
														<div class="form-group">
															 <label class="control-label col-lg-3">Penghasilan Perbulan </label>
															 <div class="col-lg-9">
																<div class="col-lg-8 row">
																   <select name="surveymap[0][parent_income]" class="form-control">
																	   <option value = "">Pilih</option>
																	   <option value = "">---</option>
																	   <option value = "< 1 juta" <?php if (is_object($parentAyah) && $parentAyah->parent_income == "< 1 juta") echo "Selected" ?>>< 1 juta</option>
																	   <option value = "1 - 2 juta" <?php if (is_object($parentAyah) && $parentAyah->parent_income == "1 - 2 juta") echo "Selected" ?>>1 - 2 juta</option>
																	   <option value = "2 - 3 juta" <?php if (is_object($parentAyah) && $parentAyah->parent_income == "2 - 3 juta") echo "Selected" ?>>2 - 3 juta</option>
																	   <option value = "3 - 5 juta" <?php if (is_object($parentAyah) && $parentAyah->parent_income == "3 - 5 juta") echo "Selected" ?>>3 - 5 juta</option>
																	   <option value = "5 - 8 juta" <?php if (is_object($parentAyah) && $parentAyah->parent_income == "5 - 8 juta") echo "Selected" ?>>5 - 8 juta</option>
																	   <option value = "8 - 15 juta" <?php if (is_object($parentAyah) && $parentAyah->parent_income == "8 - 15 juta") echo "Selected" ?>>8 - 15 juta</option>
																	   <option value = "15 - 25 juta" <?php if (is_object($parentAyah) && $parentAyah->parent_income == "15 - 25 juta") echo "Selected" ?>>15 - 25 juta</option>
																	   <option value = "25 - 40 juta" <?php if (is_object($parentAyah) && $parentAyah->parent_income == "25 - 40 juta") echo "Selected" ?>>25 - 40 juta</option>
																	   <option value = "40 - 60 juta" <?php if (is_object($parentAyah) && $parentAyah->parent_income == "40 - 60 juta") echo "Selected" ?>>40 - 60 juta</option>
																	   <option value = "60 - 100 juta" <?php if (is_object($parentAyah) && $parentAyah->parent_income == "60 - 100 juta") echo "Selected" ?>>60 - 100 juta</option>
																	   <option value = "> 100 juta" <?php if (is_object($parentAyah) && $parentAyah->parent_income == "> 100 juta") echo "Selected" ?>>> 100 juta</option>
																   </select>
																</div>
															 </div>
														</div>
														<div class="form-group">
															<label class="control-label col-lg-3">Alamat Tempat Tinggal</label>
															<div class="col-lg-9">
																<div class="col-lg-8 row">
																	<textarea class="form-control" name="surveymap[0][parent_address]" id="comp_address3" onchange="change_text_address3()"><?php if (is_object($parentAyah)) echo $parentAyah->parent_address ?></textarea>
																</div>
															</div>
														</div>
														  
														<div class="form-group">
															<label class="control-label col-lg-3">Lintang</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_latitude3" name="surveymap[0][parent_latitude]" onchange="change_position3()" value="<?php if (is_object($parentAyah)) echo $parentAyah->parent_latitude ?>" readonly="true">
															</div>
															<label class="control-label col-lg-1">Bujur</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_longitude3" name="surveymap[0][parent_longitude]" onchange="change_position3()" value="<?php if (is_object($parentAyah)) echo $parentAyah->parent_longitude ?>" readonly="true">
															</div>
															<div class="col-lg-3"></div>
													    </div>
														  
														  <div class="form-group">
															  <label class="control-label col-lg-3"></label>
															  <div class="col-lg-9">
																<div class="col-lg-8 row">
																	<div id="map-canvas3"></div>
																	<div id="panel">
																		<input type="Text" id="address_auto3" class="form-control" value="" placeholder=" Enter a Location ">
																	</div>		
																</div>
															  </div>
														  </div>
													</div>								 				
												</div>
											
											
												<div id="ibu" class="tab-pane">
													<div class="col-lg-12">
														<div class="form-group">
															<h4>b. Ibu</h4>
															<input type="hidden" value="" name="surveymap[1][member_id]">
															<input type="hidden" value="Ibu" name="surveymap[1][parent_type]">
				 
															  <label class="control-label col-lg-3">Nama Lengkap *</label>
															  <div class="col-lg-9">
																 <div class="col-lg-8 row">
																	<input type="text" class="form-control" id="NameIbu" name="surveymap[1][parent_name]" value="<?php if (is_object($parentIbu)) echo $parentIbu->parent_name ?>">
																 </div>
															  </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Status Kewarganegaraan *</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																<select name="surveymap[1][type_warga]" id="TypeIbu" class="form-control" autocomplete="off">
																	  <option value="">Pilih:</option>
																	  <option value="">---</option>
																	  <option value="WNI" <?php if (is_object($parentIbu) && $parentIbu->type_warga == "WNI") echo "Selected" ?>>Warga Negara Indonesia (WNI)</option>
																	  <option value="WNA" <?php if (is_object($parentIbu) && $parentIbu->type_warga == "WNA") echo "Selected" ?>>Warga Negara Asing (WNA)</option>
																</select>																  
															  </div>
														   </div>
														</div>
			  
														<div class="form-group">
														   <label class="control-label col-lg-3">NIK / NIORA *</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="NikIbu" name="surveymap[1][parent_nik]" value="<?php if (is_object($parentIbu)) echo $parentIbu->parent_nik ?>">
															  </div>
														   </div>
														</div>
			  
														<div class="form-group">
														   <label class="control-label col-lg-3">Tempat Lahir</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputBirthPlace" name="surveymap[1][parent_birth_place]" value="<?php if (is_object($parentIbu)) echo $parentIbu->parent_birth_place ?>">
															  </div>
														   </div>
														</div>
		
														<div class="form-group">
														   <label class="control-label col-lg-3">Tanggal Lahir</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																  <select name="surveymap[1][pbirth_day]" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">
																		<option value="">dd</option>
																		<option value="">---</option>
																	<?php for ($i = 1; $i <= 31; $i++) { ?>								
																		<option value="<?php echo sprintf("%02d",$i) ?>" <?php if (is_object($parentIbu) && date('d',strtotime($parentIbu->parent_birth_date)) == $i && $parentIbu->parent_birth_date <> "0000-00-00") echo "Selected" ?>><?php echo sprintf("%02d",$i) ?></option>	
																	<?php } ?>	
																  </select>&nbsp;&nbsp;
																  <select name="surveymap[1][pbirth_month]" class="form-control" style="width: 120px; display: inline;" autocomplete="off" required="yes">
																		<option value="">mm</option>
																		<option value="">---</option>
																	<?php for ($i = 1; $i <= 12; $i++)
																	{
																		 $monthName = date("F", mktime(0, 0, 0, $i, 10));
																	?>								
																		<option value="<?php echo sprintf("%02d",$i) ?>" <?php if (is_object($parentIbu) && date('m',strtotime($parentIbu->parent_birth_date)) == $i && $parentIbu->parent_birth_date <> "0000-00-00") echo "Selected" ?>><?php echo $monthName ?></option>	
																	<?php } ?>	
																  </select>&nbsp;&nbsp;
																  <select name="surveymap[1][pbirth_year]" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">
																		<option value="">yyyy</option>
																		<option value="">---</option>
																	<?php for ($i = 1950; $i <= 2017; $i++) { ?>								
																		<option value="<?php echo $i ?>" <?php if (is_object($parentIbu) && date('Y',strtotime($parentIbu->parent_birth_date)) == $i && $parentIbu->parent_birth_date <> "0000-00-00") echo "Selected" ?>><?php echo $i ?></option>	
																	<?php } ?>	
																  </select>	
															  </div>
														   </div>
														</div>
		
		
														<div class="form-group">
														   <label class="control-label col-lg-3">Telephone Rumah</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputPhone" name="surveymap[1][parent_home_phone]" value="<?php if (is_object($parentIbu)) echo $parentIbu->parent_home_phone ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Handphone *</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="MobileIbu" name="surveymap[1][parent_phone]" value="<?php if (is_object($parentIbu)) echo $parentIbu->parent_phone ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Email</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="email" class="form-control" id="EmailIbu" name="surveymap[1][parent_email]" value="<?php if (is_object($parentIbu)) echo $parentIbu->parent_email ?>">
															  </div>
														   </div>
														</div>
			  
														<div class="form-group">
														   <label class="control-label col-lg-3">Pendidikan</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputEmail" name="surveymap[1][parent_education]" value="<?php if (is_object($parentIbu)) echo $parentIbu->parent_education ?>">
															  </div>
														   </div>
														</div>
		
		
														<div class="form-group">
														   <label class="control-label col-lg-3">Jabatan Pekerjaan</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputEmail" name="surveymap[1][employment]" value="<?php if (is_object($parentIbu)) echo $parentIbu->employment ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Nama Perusahaan </label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputEmail" name="surveymap[1][company_name]" value="<?php if (is_object($parentIbu)) echo $parentIbu->company_name ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Alamat Tempat Kerja </label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <textarea id="comp_address4" class="form-control" name="surveymap[1][workplace_address]" onchange="change_text_address4()"><?php if (is_object($parentIbu)) echo $parentIbu->workplace_address ?></textarea>
															  </div>
														   </div>
														</div>
														
														<div class="form-group">
															<label class="control-label col-lg-3">Lintang</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_latitude4" name="surveymap[1][office_latitude]" onchange="change_position4()" value="<?php if (is_object($parentIbu)) echo $parentIbu->office_latitude ?>" readonly="true">
															</div>
															<label class="control-label col-lg-1">Bujur</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_longitude4" name="surveymap[1][office_longitude]" onchange="change_position4()" value="<?php if (is_object($parentIbu)) echo $parentIbu->office_longitude ?>" readonly="true">
															</div>
															<div class="col-lg-3"></div>
													    </div>
		
														<div class="form-group">
															<label class="control-label col-lg-3"></label>
															<div class="col-lg-9">
																<div class="col-lg-8 row">
																	<div id="map-canvas4"></div>
																	<div id="panel">
																		<input type="Text" id="address_auto4" class="form-control" value="" placeholder=" Enter a Location ">
																	</div>		
																</div>
															</div>
														</div>
														
														<div class="form-group">
															 <label class="control-label col-lg-3">Penghasilan Perbulan </label>
															 <div class="col-lg-9">
																<div class="col-lg-8 row">
																   <select name="surveymap[1][parent_income]" class="form-control">
																	   <option value = "">Pilih</option>
																	   <option value = "">---</option>
																	   <option value = "< 1 juta" <?php if (is_object($parentIbu) && $parentIbu->parent_income == "< 1 juta") echo "Selected" ?>>< 1 juta</option>
																	   <option value = "1 - 2 juta" <?php if (is_object($parentIbu) && $parentIbu->parent_income == "1 - 2 juta") echo "Selected" ?>>1 - 2 juta</option>
																	   <option value = "2 - 3 juta" <?php if (is_object($parentIbu) && $parentIbu->parent_income == "2 - 3 juta") echo "Selected" ?>>2 - 3 juta</option>
																	   <option value = "3 - 5 juta" <?php if (is_object($parentIbu) && $parentIbu->parent_income == "3 - 5 juta") echo "Selected" ?>>3 - 5 juta</option>
																	   <option value = "5 - 8 juta" <?php if (is_object($parentIbu) && $parentIbu->parent_income == "5 - 8 juta") echo "Selected" ?>>5 - 8 juta</option>
																	   <option value = "8 - 15 juta" <?php if (is_object($parentIbu) && $parentIbu->parent_income == "8 - 15 juta") echo "Selected" ?>>8 - 15 juta</option>
																	   <option value = "15 - 25 juta" <?php if (is_object($parentIbu) && $parentIbu->parent_income == "15 - 25 juta") echo "Selected" ?>>15 - 25 juta</option>
																	   <option value = "25 - 40 juta" <?php if (is_object($parentIbu) && $parentIbu->parent_income == "25 - 40 juta") echo "Selected" ?>>25 - 40 juta</option>
																	   <option value = "40 - 60 juta" <?php if (is_object($parentIbu) && $parentIbu->parent_income == "40 - 60 juta") echo "Selected" ?>>40 - 60 juta</option>
																	   <option value = "60 - 100 juta" <?php if (is_object($parentIbu) && $parentIbu->parent_income == "60 - 100 juta") echo "Selected" ?>>60 - 100 juta</option>
																	   <option value = "> 100 juta" <?php if (is_object($parentIbu) && $parentIbu->parent_income == "> 100 juta") echo "Selected" ?>>> 100 juta</option>
																   </select>
																</div>
															 </div>
														</div>
														<div class="form-group">
															<label class="control-label col-lg-3">Alamat Tempat Tinggal</label>
															<div class="col-lg-9">
																<div class="col-lg-8 row">
																	<textarea id="comp_address5" class="form-control" name="surveymap[1][parent_address]" onchange="change_text_address5()"><?php if (is_object($parentIbu)) echo $parentIbu->parent_address ?></textarea>
																</div>
															</div>
														</div>
														  
														<div class="form-group">
															<label class="control-label col-lg-3">Lintang</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_latitude5" name="surveymap[1][parent_latitude]" onchange="change_position5()" value="<?php if (is_object($parentIbu)) echo $parentIbu->parent_latitude ?>" readonly="true">
															</div>
															<label class="control-label col-lg-1">Bujur</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_longitude5" name="surveymap[1][parent_longitude]" onchange="change_position5()" value="<?php if (is_object($parentIbu)) echo $parentIbu->parent_longitude ?>" readonly="true">
															</div>
															<div class="col-lg-3"></div>
													    </div>
										
														  <div class="form-group">
															  <label class="control-label col-lg-3"></label>
															  <div class="col-lg-9">
																<div class="col-lg-8 row">
																	<div id="map-canvas5"></div>
																	<div id="panel">
																		<input type="Text" id="address_auto5" class="form-control" value="" placeholder=" Enter a Location ">
																	</div>		
																</div>
															  </div>
														  </div>
													</div>								 				
												</div>
										
												<div id="wali" class="tab-pane">
													<div class="col-lg-12">
														<div class="form-group">
															<h4>c. Wali</h4>
															<input type="hidden" value="" name="surveymap[2][member_id]">
															<input type="hidden" value="Wali" name="surveymap[2][parent_type]">
				 
															<label class="control-label col-lg-3">Nama Lengkap *</label>
															<div class="col-lg-9">
															   <div class="col-lg-8 row">
																  <input type="text" class="form-control" id="NameWali" name="surveymap[2][parent_name]" value="<?php if (is_object($parentWali)) echo $parentWali->parent_name ?>">
															   </div>
															</div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Status Kewarganegaraan *</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																<select name="surveymap[2][type_warga]" id="TypeWali" class="form-control" autocomplete="off">
																	  <option value="">Pilih:</option>
																	  <option value="">---</option>
																	  <option value="WNI" <?php if (is_object($parentWali) && $parentWali->type_warga == "WNI") echo "Selected" ?>>Warga Negara Indonesia (WNI)</option>
																	  <option value="WNA" <?php if (is_object($parentWali) && $parentWali->type_warga == "WNA") echo "Selected" ?>>Warga Negara Asing (WNA)</option>
																</select>																  
															  </div>
														   </div>
														</div>
			  
														<div class="form-group">
														   <label class="control-label col-lg-3">NIK / NIORA *</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="NikWali" name="surveymap[2][parent_nik]" value="<?php if (is_object($parentWali)) echo $parentWali->parent_nik ?>">
															  </div>
														   </div>
														</div>
			  
														<div class="form-group">
														   <label class="control-label col-lg-3">Tempat Lahir</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputBirthPlace" name="surveymap[2][parent_birth_place]" value="<?php if (is_object($parentWali)) echo $parentWali->parent_birth_place ?>">
															  </div>
														   </div>
														</div>
		
														<div class="form-group">
														   <label class="control-label col-lg-3">Tanggal Lahir</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																  <select name="surveymap[2][pbirth_day]" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">
																		<option value="">dd</option>
																		<option value="">---</option>
																	<?php for ($i = 1; $i <= 31; $i++) { ?>								
																		<option value="<?php echo sprintf("%02d",$i) ?>" <?php if (is_object($parentWali) && date('d',strtotime($parentWali->parent_birth_date)) == $i && $parentWali->parent_birth_date <> "0000-00-00") echo "Selected" ?>><?php echo sprintf("%02d",$i) ?></option>	
																	<?php } ?>	
																  </select>&nbsp;&nbsp;
																  <select name="surveymap[2][pbirth_month]" class="form-control" style="width: 120px; display: inline;" autocomplete="off" required="yes">
																		<option value="">mm</option>
																		<option value="">---</option>
																	<?php for ($i = 1; $i <= 12; $i++)
																	{
																		 $monthName = date("F", mktime(0, 0, 0, $i, 10));
																	?>								
																		<option value="<?php echo sprintf("%02d",$i) ?>" <?php if (is_object($parentWali) && date('m',strtotime($parentWali->parent_birth_date)) == $i && $parentWali->parent_birth_date <> "0000-00-00") echo "Selected" ?>><?php echo $monthName ?></option>	
																	<?php } ?>	
																  </select>&nbsp;&nbsp;
																  <select name="surveymap[2][pbirth_year]" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">
																		<option value="">yyyy</option>
																		<option value="">---</option>
																	<?php for ($i = 1950; $i <= 2017; $i++) { ?>								
																		<option value="<?php echo $i ?>" <?php if (is_object($parentWali) && date('Y',strtotime($parentWali->parent_birth_date)) == $i && $parentWali->parent_birth_date <> "0000-00-00") echo "Selected" ?>><?php echo $i ?></option>	
																	<?php } ?>	
																  </select>	
															  </div>
														   </div>
														</div>
		
		
														<div class="form-group">
														   <label class="control-label col-lg-3">Telephone Rumah</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputEmail" name="surveymap[2][parent_home_phone]" value="<?php if (is_object($parentWali)) echo $parentWali->parent_home_phone ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Handphone *</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="MobileWali" name="surveymap[2][parent_phone]" value="<?php if (is_object($parentWali)) echo $parentWali->parent_phone ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Email</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="email" class="form-control" id="EmailWali" name="surveymap[2][parent_email]" value="<?php if (is_object($parentWali)) echo $parentWali->parent_email ?>">
															  </div>
														   </div>
														</div>
			  
														<div class="form-group">
														   <label class="control-label col-lg-3">Pendidikan</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputEmail" name="surveymap[2][parent_education]" value="<?php if (is_object($parentWali)) echo $parentWali->parent_education ?>">
															  </div>
														   </div>
														</div>
		
		
														<div class="form-group">
														   <label class="control-label col-lg-3">Jabatan Pekerjaan</label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputEmail" name="surveymap[2][employment]" value="<?php if (is_object($parentWali)) echo $parentWali->employment ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Nama Perusahaan </label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <input type="text" class="form-control" id="inputEmail" name="surveymap[2][company_name]" value="<?php if (is_object($parentWali)) echo $parentWali->company_name ?>">
															  </div>
														   </div>
														</div>
														<div class="form-group">
														   <label class="control-label col-lg-3">Alamat Tempat Kerja </label>
														   <div class="col-lg-9">
															  <div class="col-lg-8 row">
																 <textarea id="comp_address6" class="form-control" name="surveymap[2][workplace_address]" onchange="change_text_address6()"><?php if (is_object($parentWali)) echo $parentWali->workplace_address ?></textarea>
															  </div>
														   </div>
														</div>
														
														<div class="form-group">
															<label class="control-label col-lg-3">Lintang</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_latitude6" name="surveymap[2][office_latitude]" onchange="change_position6()" value="<?php if (is_object($parentWali)) echo $parentWali->office_latitude ?>" readonly="true">
															</div>
															<label class="control-label col-lg-1">Bujur</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_longitude6" name="surveymap[2][office_longitude]" onchange="change_position6()" value="<?php if (is_object($parentWali)) echo $parentWali->office_longitude ?>" readonly="true">
															</div>
															<div class="col-lg-3"></div>
													    </div>		
	
														<div class="form-group">
															<label class="control-label col-lg-3"></label>
															<div class="col-lg-9">
																<div class="col-lg-8 row">
																	<div id="map-canvas6"></div>
																	<div id="panel">
																		<input type="Text" id="address_auto6" class="form-control" value="" placeholder=" Enter a Location ">
																	</div>		
																</div>
															</div>
														</div>
														
														<div class="form-group">
															 <label class="control-label col-lg-3">Penghasilan Perbulan </label>
															 <div class="col-lg-9">
																<div class="col-lg-8 row">
																   <select name="surveymap[2][parent_income]" class="form-control">
																	   <option value = "">Pilih</option>
																	   <option value = "">---</option>
																	   <option value = "< 1 juta" <?php if (is_object($parentWali) && $parentWali->parent_income == "< 1 juta") echo "Selected" ?>>< 1 juta</option>
																	   <option value = "1 - 2 juta" <?php if (is_object($parentWali) && $parentWali->parent_income == "1 - 2 juta") echo "Selected" ?>>1 - 2 juta</option>
																	   <option value = "2 - 3 juta" <?php if (is_object($parentWali) && $parentWali->parent_income == "2 - 3 juta") echo "Selected" ?>>2 - 3 juta</option>
																	   <option value = "3 - 5 juta" <?php if (is_object($parentWali) && $parentWali->parent_income == "3 - 5 juta") echo "Selected" ?>>3 - 5 juta</option>
																	   <option value = "5 - 8 juta" <?php if (is_object($parentWali) && $parentWali->parent_income == "5 - 8 juta") echo "Selected" ?>>5 - 8 juta</option>
																	   <option value = "8 - 15 juta" <?php if (is_object($parentWali) && $parentWali->parent_income == "8 - 15 juta") echo "Selected" ?>>8 - 15 juta</option>
																	   <option value = "15 - 25 juta" <?php if (is_object($parentWali) && $parentWali->parent_income == "15 - 25 juta") echo "Selected" ?>>15 - 25 juta</option>
																	   <option value = "25 - 40 juta" <?php if (is_object($parentWali) && $parentWali->parent_income == "25 - 40 juta") echo "Selected" ?>>25 - 40 juta</option>
																	   <option value = "40 - 60 juta" <?php if (is_object($parentWali) && $parentWali->parent_income == "40 - 60 juta") echo "Selected" ?>>40 - 60 juta</option>
																	   <option value = "60 - 100 juta" <?php if (is_object($parentWali) && $parentWali->parent_income == "60 - 100 juta") echo "Selected" ?>>60 - 100 juta</option>
																	   <option value = "> 100 juta" <?php if (is_object($parentWali) && $parentWali->parent_income == "> 100 juta") echo "Selected" ?>>> 100 juta</option>
																   </select>
																</div>
															 </div>
														</div>
														<div class="form-group">
															<label class="control-label col-lg-3">Alamat Tempat Tinggal</label>
															<div class="col-lg-9">
																<div class="col-lg-8 row">
																	<textarea id="comp_address7" class="form-control" name="surveymap[2][parent_address]" onchange="change_text_address7()"><?php if (is_object($parentWali)) echo $parentWali->parent_address ?></textarea>
																</div>
															</div>
														</div>
														  
														<div class="form-group">
															<label class="control-label col-lg-3">Lintang</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_latitude7" name="surveymap[2][parent_latitude]" onchange="change_position7()" value="<?php if (is_object($parentWali)) echo $parentWali->parent_latitude ?>" readonly="true">
															</div>
															<label class="control-label col-lg-1">Bujur</label>
															<div class="col-lg-3">
															   <input type="text" class="form-control" id="pos_longitude7" name="surveymap[2][parent_longitude]" onchange="change_position7()" value="<?php if (is_object($parentWali)) echo $parentWali->parent_longitude ?>" readonly="true">
															</div>
															<div class="col-lg-3"></div>
													    </div>														  
										
														  <div class="form-group">
															  <label class="control-label col-lg-3"></label>
															  <div class="col-lg-9">
																<div class="col-lg-8 row">
																	<div id="map-canvas7"></div>
																	<div id="panel">
																		<input type="Text" id="address_auto7" class="form-control" value="" placeholder=" Enter a Location ">
																	</div>		
																</div>
															  </div>
														  </div>
													</div>								 				
												</div>
											
											
													
									
										</div>
									</div>								 				
								</div>
										
								
								<div class="form-group">
									<label class="control-label col-lg-3"></label>
										<div class="col-lg-9">
											<div class="col-lg-8 row">
												<button type="Button" id="btnSave" class="btn btn-info">Simpan</button>
											    &nbsp;&nbsp;&nbsp;&nbsp;
												<a href="children/profile" class="btn">Kembali</a>
											</div>
										</div>
								</div>   
								</form>		 
								
								
							 </div>     
							
						 </div>					  
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
<script type="text/javascript">	
	$(document).ready(function() {
	    $( "#btnSave").click(function() {
		    var inputstat = 1;
			
			var parent_tz = $('#parent_tz').val();
			if (parent_tz == 1) {
			  if ($("#MobileAyah").val() == "") { msg = "Silakan Masukkan Handphone Ayah terlebih dahulu."; inputstat = 0; }
			  if ($("#NikAyah").val() == "") { msg = "Silakan Masukkan NIK / NIORA Ayah terlebih dahulu."; inputstat = 0; }
			  if ($("#TypeAyah").val() == "") { msg = "Silakan Masukkan Status Kewarganegaraan Ayah terlebih dahulu."; inputstat = 0; }
			  if ($("#NameAyah").val() == "") { msg = "Silakan Masukkan Nama Lengkap Ayah terlebih dahulu."; inputstat = 0; }
			}
			else if (parent_tz == 2) {
			  if ($("#MobileIbu").val() == "") { msg = "Silakan Masukkan Handphone Ibu terlebih dahulu."; inputstat = 0; }
			  if ($("#NikIbu").val() == "") { msg = "Silakan Masukkan NIK / NIORA Ibu terlebih dahulu."; inputstat = 0; }
			  if ($("#TypeIbu").val() == "") { msg = "Silakan Masukkan Status Kewarganegaraan Ibu terlebih dahulu."; inputstat = 0; }
			  if ($("#NameIbu").val() == "") { msg = "Silakan Masukkan Nama Lengkap Ibu terlebih dahulu."; inputstat = 0; }
			}
			else
			{
			  if ($("#MobileWali").val() == "") { msg = "Silakan Masukkan Handphone Wali terlebih dahulu."; inputstat = 0; }
			  if ($("#NikWali").val() == "") { msg = "Silakan Masukkan NIK / NIORA Wali terlebih dahulu."; inputstat = 0; }
			  if ($("#TypeWali").val() == "") { msg = "Silakan Masukkan Status Kewarganegaraan Wali terlebih dahulu."; inputstat = 0; }
			  if ($("#NameWali").val() == "") { msg = "Silakan Masukkan Nama Lengkap Wali terlebih dahulu."; inputstat = 0; }
			}
			
			if ($("#religion").val() == "") { msg = "Silakan Masukkan Agama terlebih dahulu."; inputstat = 0; }
			if ($("#nik").val() == "") { msg = "Silakan Masukkan NIK / NIORA terlebih dahulu."; inputstat = 0; }
			if ($("#citizen_status").val() == "") { msg = "Silakan Masukkan Status Kewarganegaraan terlebih dahulu."; inputstat = 0; }
			if ($("input[type=radio][name=gender]:checked").val() == undefined) { msg = "Silakan Masukkan Jenis Kelamin terlebih dahulu."; inputstat = 0; }
			if ($("#fullname").val() == "") { msg = "Silakan Masukkan Nama Siswa terlebih dahulu."; inputstat = 0; }
			
			if (inputstat == 1) {
				start_valid=confirm("Apakah Anda yakin ingin mengubah Data Siswa Ini ?")

				if (start_valid == true)
				{	
					$( "#frmStudent" ).submit();
				}
			}
			else
			{
				alert(msg);  
			}
			
		});
		
		$('#tabs').on('click','.tablink,#prodTabs a',function (e, id) {
			e.preventDefault();
			var url = $(this).attr("data-url");
			
			var idok = $(this).attr("data-id");
			$('#parent_tz').val(idok);
								
			if (typeof url !== "undefined") {
				var pane = $(this), href = this.hash;
		
				// ajax load from data-url
				$(href).load(url,function(result){      
					pane.tab('show');
				});
			} else {
				$(this).tab('show');
			}
		});
		
	});
		
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuHae3MvvdGVotQ-VtcUF4SEL05nxk3WE&libraries=places"></script>


<script>
	var geocoder;
	var map;
	var circle;
	var marker;
	var radius_new;
	
	function change_text_address()
	{	
		codeAddress();
	}
	
	function updateMarkerPosition(latLng, radius2) {
		document.getElementById('pos_latitude').value = [latLng.lat()];
		document.getElementById('pos_longitude').value = [latLng.lng()];
	}
		
	
	function initialize() {
	  geocoder = new google.maps.Geocoder();
	  
	  <?php if (is_object($studentDetail) && ($studentDetail->latitude <> 0 && $studentDetail->longitude <> 0)) { ?>
	  var latlng = new google.maps.LatLng(<?php echo $studentDetail->latitude ?>, <?php echo $studentDetail->longitude ?>);
	  var latlng2 = new google.maps.LatLng(<?php echo $studentDetail->latitude ?>, <?php echo $studentDetail->longitude ?>);	  
	  <?php } else { ?>	  
	  var latlng = new google.maps.LatLng(-6.212176478654396,106.84216577246093);
	  var latlng2 = new google.maps.LatLng(0, 0);
	  <?php } ?>
	  
	 //  alart(latlng);
	  
	  var mapOptions = {
	      zoom: 17,
	      scaleControl: true,
	      center:  latlng,
	      draggable : true,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
		
	  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	  
	  marker = new google.maps.Marker({
	          map: map,
			  title : 'Address',
			  draggable : true,
	          position: latlng2
     });
	  
	  // Add circle overlay and bind to marker
		  circle = new google.maps.Circle({
		    map: map,
		    radius: 30,
		    
		    strokeColor   : '#cccccc',
		    strokeOpacity : 1,
		    strokeWeight  : 2,
		    fillColor     : '#009ee0',
		    fillOpacity   : 0.2
		  });
		  circle.bindTo('center', marker, 'position');
		 
	  
	  var input = /** @type {HTMLInputElement} */(
      document.getElementById('address_auto'));
	  
	  var autocomplete = new google.maps.places.Autocomplete(input);
 	  autocomplete.bindTo('bounds', map);
	  
	  var place = autocomplete.getPlace();
	  
	  var infowindow2 = new google.maps.InfoWindow();

  autocomplete.addListener('place_changed', function() {
    infowindow2.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address_go = '';
    if (place.address_components) {
      address_go = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }
    	
    var address_go = document.getElementById('address_auto').value;
	$("#comp_address").val(address_go);
	var contentString2 = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             '<strong>'+ place.name + '</strong><br>' + address_go +
	                             '</div></div>';

    infowindow2.setContent(contentString2);
    infowindow2.open(map, marker);
    setTimeout(function () { infowindow2.close(); }, 1000);
    
    geocodePosition(marker.getPosition());
    updateMarkerPosition(marker.getPosition(), radius_new);
			
  });
  
          google.maps.event.addListener(marker, 'drag', function() {
	    radius_new = circle.getRadius();
	    updateMarkerPosition(marker.getPosition(), radius_new);
	  });		  
		  
	  google.maps.event.addListener(marker, 'dragend', function() {
            radius_new = circle.getRadius();
            updateMarkerPosition(marker.getPosition(), radius_new);
	    geocodePosition(marker.getPosition());
          });
	  
	  google.maps.event.addListener(marker, 'click', function() {                                                              
	      geocodePosition(marker.getPosition());
		  
		  if (address_ok != "") 
		  {
	             var contentString = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             ''+ address_ok + '<br>' +
	                             '<a onclick=send_address()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                   
	             var infowindow = new google.maps.InfoWindow({
	                content: contentString
	             });  
	
	             infowindow.open(map, marker);
	                                   
	             setTimeout(function () { infowindow.close(); }, 3000);
		  }
	  });
	  
	}
	
      var address_ok = "";            
      function geocodePosition(pos) {
         geocoder.geocode({
         latLng: pos }, function(responses) {
	   
           if (responses && responses.length > 0) {
             address_ok = responses[0].formatted_address;
             //alert(address_ok);
    
           } else {
		     address_ok = "Cannot determine address at this location.";
		     //alert("Cannot determine address at this location.");
           }
         });
      }
	
	
	function change_position()
	{
	  var latitude_next = document.getElementById('pos_latitude').value;
	  var longitude_next = document.getElementById('pos_longitude').value;
	  latitude_next = parseFloat(latitude_next);
	  longitude_next = parseFloat(longitude_next);
	 
	  var latlng = new google.maps.LatLng(latitude_next, longitude_next);
          marker.setPosition(latlng);
	}
	
	function send_address() {
		document.getElementById('comp_address').value = address_ok;
	}
	
	function codeAddress()
	{
		google.maps.event.trigger(map, 'resize');
		var address = document.getElementById('comp_address').value;
		radius2 = 30;
		
		if (address == "") 
		{ 
			alert ("please enter a address first.");
			exit(); 
		}
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				
				var mapOptions = {
					zoom: 17,
					scaleControl: true,
					center:  results[0].geometry.location,
					draggable : true,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				  
				map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	  
				marker = new google.maps.Marker({
						map: map,
						title : 'Address',
						draggable : true,
						position: results[0].geometry.location
			    });
				
				circle = new google.maps.Circle({
					map: map,
					radius: 30,
					
					strokeColor   : '#cccccc',
					strokeOpacity : 1,
					strokeWeight  : 2,
					fillColor     : '#009ee0',
					fillOpacity   : 0.2
				});
				circle.bindTo('center', marker, 'position');				
	  
				updateMarkerPosition(marker.getPosition(), radius2);
				
				google.maps.event.addListener(marker, 'drag', function() {
				radius_new = circle.getRadius();
				updateMarkerPosition(marker.getPosition(), radius_new);
				
		   });		  
		  
	      google.maps.event.addListener(marker, 'dragend', function() {
				radius_new = circle.getRadius();
				updateMarkerPosition(marker.getPosition(), radius_new);
				geocodePosition(marker.getPosition());
          });
		  
	      google.maps.event.addListener(circle, 'click', function() {
				radius_new = circle.getRadius();
				updateMarkerPosition(marker.getPosition(), radius_new);			
	      });
		  
		  
	      google.maps.event.addListener(marker, 'click', function() {                                                              
              geocodePosition(marker.getPosition());
			  
			  if (address_ok != "") 
			  {
	              var contentString = '<div style="width:300px" id="content">'+
										'<div id="bodyContent">'+
										''+ address_ok + '<br>' +
										'<a onclick=send_address()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                    
	              var infowindow = new google.maps.InfoWindow({
	                 content: contentString
	              });  
	
	              infowindow.open(map, marker);
	                                    
	              setTimeout(function () { infowindow.close(); }, 2000);
			  }
          });
		  
		  
		} else {
			alert('Geocode was not successful for the following reason: ' + status);
		  }
		});
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);

</script>



<!-- Yang Kedua -->

<script>
	var geocoder2;
	var map2;
	var circle2;
	var marker2;
	var radius_new2;
	
	function change_text_address2()
	{
		codeAddress2();
	}
	
	function updateMarkerPosition2(latLng, radius2) {
		document.getElementById('pos_latitude2').value = [latLng.lat()];
		document.getElementById('pos_longitude2').value = [latLng.lng()];
	}
		
	
	function initialize2() {
	  geocoder2 = new google.maps.Geocoder();
	  
	  <?php if (is_object($parentAyah) && ($parentAyah->office_latitude <> 0 && $parentAyah->office_longitude <> 0)) { ?>
	  var latlngOK = new google.maps.LatLng(<?php echo $parentAyah->office_latitude ?>, <?php echo $parentAyah->office_longitude ?>);
	  var latlng2OK = new google.maps.LatLng(<?php echo $parentAyah->office_latitude ?>, <?php echo $parentAyah->office_longitude ?>);	  
	  <?php } else { ?>	  
	  var latlngOK = new google.maps.LatLng(-6.212176478654396,106.84216577246093);
	  var latlng2OK = new google.maps.LatLng(0, 0);
	  <?php } ?>
	 //  alart(latlng);
	  
	  var mapOptions = {
	      zoom: 17,
	      scaleControl: true,
	      center:  latlngOK,
	      draggable : true,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
		
	  map2 = new google.maps.Map(document.getElementById('map-canvas2'), mapOptions);
	  
	  marker2 = new google.maps.Marker({
	          map: map2,
			  title : 'Address',
			  draggable : true,
	          position: latlng2OK
     });
	  
	  // Add circle overlay and bind to marker
		  circle2 = new google.maps.Circle({
		    map: map2,
		    radius: 30,
		    
		    strokeColor   : '#cccccc',
		    strokeOpacity : 1,
		    strokeWeight  : 2,
		    fillColor     : '#009ee0',
		    fillOpacity   : 0.2
		  });
		  circle2.bindTo('center', marker2, 'position');
		 
	  
	  var input2 = /** @type {HTMLInputElement} */(
      document.getElementById('address_auto2'));
	  
	  var autocomplete = new google.maps.places.Autocomplete(input2);
 	  autocomplete.bindTo('bounds', map2);
	  
	  var place2 = autocomplete.getPlace();
	  
	  var infowindow2 = new google.maps.InfoWindow();

  autocomplete.addListener('place_changed', function() {
    infowindow2.close();
    marker2.setVisible(false);
    var place2 = autocomplete.getPlace();
    if (!place2.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place2.geometry.viewport) {
      map2.fitBounds(place2.geometry.viewport);
    } else {
      map2.setCenter(place2.geometry.location);
      map2.setZoom(17);  // Why 17? Because it looks good.
    }
    
    marker2.setPosition(place2.geometry.location);
    marker2.setVisible(true);

    var address_go2 = '';
    if (place2.address_components) {
      address_go2 = [
        (place2.address_components[0] && place2.address_components[0].short_name || ''),
        (place2.address_components[1] && place2.address_components[1].short_name || ''),
        (place2.address_components[2] && place2.address_components[2].short_name || '')
      ].join(' ');
    }
    	
    var address_go2 = document.getElementById('address_auto2').value;
	$("#comp_address2").val(address_go2);
	var contentString2 = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             '<strong>'+ place2.name + '</strong><br>' + address_go2 +
	                             '</div></div>';

    infowindow2.setContent(contentString2);
    infowindow2.open(map2, marker2);
    setTimeout(function () { infowindow2.close(); }, 1000);
    
    geocodePosition2(marker2.getPosition());
    updateMarkerPosition2(marker2.getPosition(), radius_new2);
			
  });
  
          google.maps.event.addListener(marker2, 'drag', function() {
	    radius_new2 = circle2.getRadius();
	    updateMarkerPosition2(marker2.getPosition(), radius_new2);
	  });		  
		  
	  google.maps.event.addListener(marker2, 'dragend', function() {
            radius_new2 = circle2.getRadius();
            updateMarkerPosition2(marker2.getPosition(), radius_new2);
	    geocodePosition2(marker2.getPosition());
          });
	  
	  google.maps.event.addListener(marker2, 'click', function() {                                                              
	      geocodePosition2(marker2.getPosition());
		  
		  if (address_ok2 != "") 
		  {
	             var contentString = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             ''+ address_ok2 + '<br>' +
	                             '<a onclick=send_address2()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                   
	             var infowindow = new google.maps.InfoWindow({
	                content: contentString
	             });  
	
	             infowindow.open(map2, marker2);
	                                   
	             setTimeout(function () { infowindow.close(); }, 3000);
		  }
	  });
	  
	}
	
      var address_ok2 = "";            
      function geocodePosition2(pos) {
         geocoder2.geocode({
         latLng: pos }, function(responses) {
	   
           if (responses && responses.length > 0) {
             address_ok2 = responses[0].formatted_address;
             //alert(address_ok);
    
           } else {
		     address_ok2 = "Cannot determine address at this location.";
		     //alert("Cannot determine address at this location.");
           }
         });
      }
	
	
	function change_position()
	{
	  var latitude_next = document.getElementById('pos_latitude2').value;
	  var longitude_next = document.getElementById('pos_longitude2').value;
	  latitude_next = parseFloat(latitude_next);
	  longitude_next = parseFloat(longitude_next);
	 
	  var latlngOK = new google.maps.LatLng(latitude_next, longitude_next);
          marker2.setPosition(latlng);
	}
	
	function send_address2() {
		document.getElementById('comp_address2').value = address_ok2;
	}
	

	function codeAddress2() {
	  google.maps.event.trigger(map2, 'resize');
	  var address = document.getElementById('comp_address2').value;
	  radius2 = 30;
	  
	  if (address == "") 
	  { 
	    alert ("please enter a company address first.");
	    exit(); 
	  }
	  geocoder2.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	        var mapOptions = {
				zoom: 17,
				scaleControl: true,
				center:  results[0].geometry.location,
				draggable : true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			  
			map2 = new google.maps.Map(document.getElementById('map-canvas2'), mapOptions);
			
			marker2 = new google.maps.Marker({
					map: map2,
					title : 'Address',
					draggable : true,
					position: results[0].geometry.location
		    });
			
			circle2 = new google.maps.Circle({
			  map: map2,
			  radius: 30,
			  
			  strokeColor   : '#cccccc',
			  strokeOpacity : 1,
			  strokeWeight  : 2,
			  fillColor     : '#009ee0',
			  fillOpacity   : 0.2
			});
			circle2.bindTo('center', marker2, 'position');
		  

	      updateMarkerPosition2(marker2.getPosition(), radius2);
		  
 	      google.maps.event.addListener(marker2, 'drag', function() {
          radius_new2 = circle2.getRadius();
         updateMarkerPosition2(marker2.getPosition(), radius_new2);
			
	   });		  
		  
	      google.maps.event.addListener(marker2, 'dragend', function() {
            radius_new2 = circle2.getRadius();
            updateMarkerPosition2(marker2.getPosition(), radius_new2);
			geocodePosition2(marker2.getPosition());
          });
		  
	      google.maps.event.addListener(circle2, 'click', function() {
			radius_new2 = circle2.getRadius();
			updateMarkerPosition2(marker2.getPosition(), radius_new2);			
	      });
		  
		  
	      google.maps.event.addListener(marker2, 'click', function() {                                                              
              geocodePosition2(marker2.getPosition());
			  
			  if (address_ok2 != "") 
			  {
	              var contentString = '<div style="width:300px" id="content">'+
	                              '<div id="bodyContent">'+
	                              ''+ address_ok2 + '<br>' +
	                              '<a onclick=send_address2()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                    
	              var infowindow = new google.maps.InfoWindow({
	                 content: contentString
	              });  
	
	              infowindow.open(map2, marker2);
	                                    
	              setTimeout(function () { infowindow.close(); }, 3000);
			  }
          });
		  
		  
	  } else {
	      alert('Geocode was not successful for the following reason: ' + status);
	    }
	  });
	}
	
	google.maps.event.addDomListener(window, 'load', initialize2);

</script>

<!-- Yang Ketiga -->

<script>
	var geocoder3;
	var map3;
	var circle3;
	var marker3;
	var radius_new3;
	
	function change_text_address3()
	{
		codeAddress3();
	}
	
	function updateMarkerPosition3(latLng, radius3) {
		document.getElementById('pos_latitude3').value = [latLng.lat()];
		document.getElementById('pos_longitude3').value = [latLng.lng()];
	}
		
	
	function initialize3() {
	  geocoder3 = new google.maps.Geocoder();
	  
	  <?php if (is_object($parentAyah) && ($parentAyah->parent_latitude <> 0 && $parentAyah->parent_longitude <> 0)) { ?>
	  var latlngOK = new google.maps.LatLng(<?php echo $parentAyah->parent_latitude ?>, <?php echo $parentAyah->parent_longitude ?>);
	  var latlng3OK = new google.maps.LatLng(<?php echo $parentAyah->parent_latitude ?>, <?php echo $parentAyah->parent_longitude ?>);
	  <?php } else { ?>	  
	  var latlngOK = new google.maps.LatLng(-6.212176478654396,106.84216577246093);
	  var latlng3OK = new google.maps.LatLng(0, 0);
	  <?php } ?>
	 //  alart(latlng);
	  
	  var mapOptions = {
	      zoom: 17,
	      scaleControl: true,
	      center:  latlngOK,
	      draggable : true,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
		
	  map3 = new google.maps.Map(document.getElementById('map-canvas3'), mapOptions);
	  
	  marker3 = new google.maps.Marker({
	          map: map3,
			  title : 'Address',
			  draggable : true,
	          position: latlng3OK
     });
	  
	  // Add circle overlay and bind to marker
		  circle3 = new google.maps.Circle({
		    map: map3,
		    radius: 30,
		    
		    strokeColor   : '#cccccc',
		    strokeOpacity : 1,
		    strokeWeight  : 3,
		    fillColor     : '#009ee0',
		    fillOpacity   : 0.3
		  });
		  circle3.bindTo('center', marker3, 'position');
		 
	  
	  var input3 = /** @type {HTMLInputElement} */(
      document.getElementById('address_auto3'));
	  
	  var autocomplete = new google.maps.places.Autocomplete(input3);
 	  autocomplete.bindTo('bounds', map3);
	  
	  var place3 = autocomplete.getPlace();
	  
	  var infowindow3 = new google.maps.InfoWindow();

  autocomplete.addListener('place_changed', function() {
    infowindow3.close();
    marker3.setVisible(false);
    var place3 = autocomplete.getPlace();
    if (!place3.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place3.geometry.viewport) {
      map3.fitBounds(place3.geometry.viewport);
    } else {
      map3.setCenter(place3.geometry.location);
      map3.setZoom(17);  // Why 17? Because it looks good.
    }
    
    marker3.setPosition(place3.geometry.location);
    marker3.setVisible(true);

    var address_go3 = '';
    if (place3.address_components) {
      address_go3 = [
        (place3.address_components[0] && place3.address_components[0].short_name || ''),
        (place3.address_components[1] && place3.address_components[1].short_name || ''),
        (place3.address_components[3] && place3.address_components[3].short_name || '')
      ].join(' ');
    }
    	
    var address_go3 = document.getElementById('address_auto3').value;
	$("#comp_address3").val(address_go3);
	var contentString3 = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             '<strong>'+ place3.name + '</strong><br>' + address_go3 +
	                             '</div></div>';

    infowindow3.setContent(contentString3);
    infowindow3.open(map3, marker3);
    setTimeout(function () { infowindow3.close(); }, 1000);
    
    geocodePosition3(marker3.getPosition());
    updateMarkerPosition3(marker3.getPosition(), radius_new3);
			
  });
  
          google.maps.event.addListener(marker3, 'drag', function() {
	    radius_new3 = circle3.getRadius();
	    updateMarkerPosition3(marker3.getPosition(), radius_new3);
	  });		  
		  
	  google.maps.event.addListener(marker3, 'dragend', function() {
            radius_new3 = circle3.getRadius();
            updateMarkerPosition3(marker3.getPosition(), radius_new3);
	    geocodePosition3(marker3.getPosition());
          });
	  
	  google.maps.event.addListener(marker3, 'click', function() {                                                              
	      geocodePosition3(marker3.getPosition());
		  
		  if (address_ok3 != "") 
		  {
	             var contentString = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             ''+ address_ok3 + '<br>' +
	                             '<a onclick=send_address3()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                   
	             var infowindow = new google.maps.InfoWindow({
	                content: contentString
	             });  
	
	             infowindow.open(map3, marker3);
	                                   
	             setTimeout(function () { infowindow.close(); }, 3000);
		  }
	  });
	  
	}
	
      var address_ok3 = "";            
      function geocodePosition3(pos) {
         geocoder3.geocode({
         latLng: pos }, function(responses) {
	   
           if (responses && responses.length > 0) {
             address_ok3 = responses[0].formatted_address;
             //alert(address_ok);
    
           } else {
		     address_ok3 = "Cannot determine address at this location.";
		     //alert("Cannot determine address at this location.");
           }
         });
      }
	
	
	function change_position()
	{
	  var latitude_next = document.getElementById('pos_latitude3').value;
	  var longitude_next = document.getElementById('pos_longitude3').value;
	  latitude_next = parseFloat(latitude_next);
	  longitude_next = parseFloat(longitude_next);
	 
	  var latlngOK = new google.maps.LatLng(latitude_next, longitude_next);
          marker3.setPosition(latlng);
	}
	
	function send_address3() {
		document.getElementById('comp_address3').value = address_ok3;
	}
	

	function codeAddress3() {
	  google.maps.event.trigger(map3, 'resize');
	  var address = document.getElementById('comp_address3').value;
	  radius3 = 30;
	  
	  if (address == "") 
	  { 
	    alert ("please enter a company address first.");
	    exit(); 
	  }
	  geocoder3.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	        var mapOptions = {
				zoom: 17,
				scaleControl: true,
				center:  results[0].geometry.location,
				draggable : true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			  
			map3 = new google.maps.Map(document.getElementById('map-canvas3'), mapOptions);
			
			marker3 = new google.maps.Marker({
					map: map3,
					title : 'Address',
					draggable : true,
					position: results[0].geometry.location
		    });
			
			circle3 = new google.maps.Circle({
			  map: map3,
			  radius: 30,
			  
			  strokeColor   : '#cccccc',
			  strokeOpacity : 1,
			  strokeWeight  : 3,
			  fillColor     : '#009ee0',
			  fillOpacity   : 0.3
			});
			circle3.bindTo('center', marker3, 'position');
		  

	      updateMarkerPosition3(marker3.getPosition(), radius3);
		  
 	      google.maps.event.addListener(marker3, 'drag', function() {
          radius_new3 = circle3.getRadius();
         updateMarkerPosition3(marker3.getPosition(), radius_new3);
			
	   });		  
		  
	      google.maps.event.addListener(marker3, 'dragend', function() {
            radius_new3 = circle3.getRadius();
            updateMarkerPosition3(marker3.getPosition(), radius_new3);
			geocodePosition3(marker3.getPosition());
          });
		  
	      google.maps.event.addListener(circle3, 'click', function() {
			radius_new3 = circle3.getRadius();
			updateMarkerPosition3(marker3.getPosition(), radius_new3);			
	      });
		  
		  
	      google.maps.event.addListener(marker3, 'click', function() {                                                              
              geocodePosition3(marker3.getPosition());
			  
			  if (address_ok3 != "") 
			  {
	              var contentString = '<div style="width:300px" id="content">'+
	                              '<div id="bodyContent">'+
	                              ''+ address_ok3 + '<br>' +
	                              '<a onclick=send_address3()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                    
	              var infowindow = new google.maps.InfoWindow({
	                 content: contentString
	              });  
	
	              infowindow.open(map3, marker3);
	                                    
	              setTimeout(function () { infowindow.close(); }, 3000);
			  }
          });
		  
		  
	  } else {
	      alert('Geocode was not successful for the following reason: ' + status);
	    }
	  });
	}
	
	google.maps.event.addDomListener(window, 'load', initialize3);

</script>

<!-- Yang Keempat -->
<script>
	var geocoder4;
	var map4;
	var circle4;
	var marker4;
	var radius_new4;
	
	function change_text_address4()
	{
		codeAddress4();
	}
	
	function updateMarkerPosition4(latLng, radius4) {
		document.getElementById('pos_latitude4').value = [latLng.lat()];
		document.getElementById('pos_longitude4').value = [latLng.lng()];
	}
		
	
	function initialize4() {
	  geocoder4 = new google.maps.Geocoder();
	  <?php if (is_object($parentIbu) && ($parentIbu->office_latitude <> 0 && $parentIbu->office_longitude <> 0)) { ?>
	  var latlngOK = new google.maps.LatLng(<?php echo $parentIbu->office_latitude ?>, <?php echo $parentIbu->office_longitude ?>);
	  var latlng4OK = new google.maps.LatLng(<?php echo $parentIbu->office_latitude ?>, <?php echo $parentIbu->office_longitude ?>);
	  <?php } else { ?>	  
	  var latlngOK = new google.maps.LatLng(-6.212176478654396,106.84216577246093);
	  var latlng4OK = new google.maps.LatLng(0, 0);
	  <?php } ?>
	 //  alart(latlng);
	  
	  var mapOptions = {
	      zoom: 17,
	      scaleControl: true,
	      center:  latlngOK,
	      draggable : true,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
		
	  map4 = new google.maps.Map(document.getElementById('map-canvas4'), mapOptions);
	  
	  marker4 = new google.maps.Marker({
	          map: map4,
			  title : 'Address',
			  draggable : true,
	          position: latlng4OK
     });
	  
	  // Add circle overlay and bind to marker
		  circle4 = new google.maps.Circle({
		    map: map4,
		    radius: 30,
		    
		    strokeColor   : '#cccccc',
		    strokeOpacity : 1,
		    strokeWeight  : 4,
		    fillColor     : '#009ee0',
		    fillOpacity   : 0.4
		  });
		  circle4.bindTo('center', marker4, 'position');
		 
	  
	  var input4 = /** @type {HTMLInputElement} */(
      document.getElementById('address_auto4'));
	  
	  var autocomplete = new google.maps.places.Autocomplete(input4);
 	  autocomplete.bindTo('bounds', map4);
	  
	  var place4 = autocomplete.getPlace();
	  
	  var infowindow4 = new google.maps.InfoWindow();

  autocomplete.addListener('place_changed', function() {
    infowindow4.close();
    marker4.setVisible(false);
    var place4 = autocomplete.getPlace();
    if (!place4.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place4.geometry.viewport) {
      map4.fitBounds(place4.geometry.viewport);
    } else {
      map4.setCenter(place4.geometry.location);
      map4.setZoom(17);  // Why 17? Because it looks good.
    }
    
    marker4.setPosition(place4.geometry.location);
    marker4.setVisible(true);

    var address_go4 = '';
    if (place4.address_components) {
      address_go4 = [
        (place4.address_components[0] && place4.address_components[0].short_name || ''),
        (place4.address_components[1] && place4.address_components[1].short_name || ''),
        (place4.address_components[4] && place4.address_components[4].short_name || '')
      ].join(' ');
    }
    	
    var address_go4 = document.getElementById('address_auto4').value;
	$("#comp_address4").val(address_go4);
	var contentString4 = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             '<strong>'+ place4.name + '</strong><br>' + address_go4 +
	                             '</div></div>';

    infowindow4.setContent(contentString4);
    infowindow4.open(map4, marker4);
    setTimeout(function () { infowindow4.close(); }, 1000);
    
    geocodePosition4(marker4.getPosition());
    updateMarkerPosition4(marker4.getPosition(), radius_new4);
			
  });
  
          google.maps.event.addListener(marker4, 'drag', function() {
	    radius_new4 = circle4.getRadius();
	    updateMarkerPosition4(marker4.getPosition(), radius_new4);
	  });		  
		  
	  google.maps.event.addListener(marker4, 'dragend', function() {
            radius_new4 = circle4.getRadius();
            updateMarkerPosition4(marker4.getPosition(), radius_new4);
	    geocodePosition4(marker4.getPosition());
          });
	  
	  google.maps.event.addListener(marker4, 'click', function() {                                                              
	      geocodePosition4(marker4.getPosition());
		  
		  if (address_ok4 != "") 
		  {
	             var contentString = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             ''+ address_ok4 + '<br>' +
	                             '<a onclick=send_address4()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                   
	             var infowindow = new google.maps.InfoWindow({
	                content: contentString
	             });  
	
	             infowindow.open(map4, marker4);
	                                   
	             setTimeout(function () { infowindow.close(); }, 3000);
		  }
	  });
	  
	}
	
      var address_ok4 = "";            
      function geocodePosition4(pos) {
         geocoder4.geocode({
         latLng: pos }, function(responses) {
	   
           if (responses && responses.length > 0) {
             address_ok4 = responses[0].formatted_address;
             //alert(address_ok);
    
           } else {
		     address_ok4 = "Cannot determine address at this location.";
		     //alert("Cannot determine address at this location.");
           }
         });
      }
	
	
	function change_position()
	{
	  var latitude_next = document.getElementById('pos_latitude4').value;
	  var longitude_next = document.getElementById('pos_longitude4').value;
	  latitude_next = parseFloat(latitude_next);
	  longitude_next = parseFloat(longitude_next);
	 
	  var latlngOK = new google.maps.LatLng(latitude_next, longitude_next);
          marker4.setPosition(latlng);
	}
	
	function send_address4() {
		document.getElementById('comp_address4').value = address_ok4;
	}
	

	function codeAddress4() {
	  google.maps.event.trigger(map4, 'resize');
	  var address = document.getElementById('comp_address4').value;
	  radius4 = 30;
	  
	  if (address == "") 
	  { 
	    alert ("please enter a company address first.");
	    exit(); 
	  }
	  geocoder4.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	        var mapOptions = {
				zoom: 17,
				scaleControl: true,
				center:  results[0].geometry.location,
				draggable : true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			  
			map4 = new google.maps.Map(document.getElementById('map-canvas4'), mapOptions);
			
			marker4 = new google.maps.Marker({
					map: map4,
					title : 'Address',
					draggable : true,
					position: results[0].geometry.location
		    });
			
			circle4 = new google.maps.Circle({
			  map: map4,
			  radius: 30,
			  
			  strokeColor   : '#cccccc',
			  strokeOpacity : 1,
			  strokeWeight  : 4,
			  fillColor     : '#009ee0',
			  fillOpacity   : 0.4
			});
			circle4.bindTo('center', marker4, 'position');
		  

	      updateMarkerPosition4(marker4.getPosition(), radius4);
		  
 	      google.maps.event.addListener(marker4, 'drag', function() {
          radius_new4 = circle4.getRadius();
         updateMarkerPosition4(marker4.getPosition(), radius_new4);
			
	   });		  
		  
	      google.maps.event.addListener(marker4, 'dragend', function() {
            radius_new4 = circle4.getRadius();
            updateMarkerPosition4(marker4.getPosition(), radius_new4);
			geocodePosition4(marker4.getPosition());
          });
		  
	      google.maps.event.addListener(circle4, 'click', function() {
			radius_new4 = circle4.getRadius();
			updateMarkerPosition4(marker4.getPosition(), radius_new4);			
	      });
		  
		  
	      google.maps.event.addListener(marker4, 'click', function() {                                                              
              geocodePosition4(marker4.getPosition());
			  
			  if (address_ok4 != "") 
			  {
	              var contentString = '<div style="width:300px" id="content">'+
	                              '<div id="bodyContent">'+
	                              ''+ address_ok4 + '<br>' +
	                              '<a onclick=send_address4()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                    
	              var infowindow = new google.maps.InfoWindow({
	                 content: contentString
	              });  
	
	              infowindow.open(map4, marker4);
	                                    
	              setTimeout(function () { infowindow.close(); }, 3000);
			  }
          });
		  
		  
	  } else {
	      alert('Geocode was not successful for the following reason: ' + status);
	    }
	  });
	}
	
	google.maps.event.addDomListener(window, 'load', initialize4);

</script>

<!-- Yang Kelima -->
<script>
	var geocoder5;
	var map5;
	var circle5;
	var marker5;
	var radius_new5;
	
	function change_text_address5()
	{
		codeAddress5();
	}
	
	function updateMarkerPosition5(latLng, radius5) {
		document.getElementById('pos_latitude5').value = [latLng.lat()];
		document.getElementById('pos_longitude5').value = [latLng.lng()];
	}
		
	
	function initialize5() {
	  geocoder5 = new google.maps.Geocoder();
	  <?php if (is_object($parentIbu) && ($parentIbu->parent_latitude <> 0 && $parentIbu->parent_longitude <> 0)) { ?>
	  var latlngOK = new google.maps.LatLng(<?php echo $parentIbu->parent_latitude ?>, <?php echo $parentIbu->parent_longitude ?>);
	  var latlng5OK = new google.maps.LatLng(<?php echo $parentIbu->parent_latitude ?>, <?php echo $parentIbu->parent_longitude ?>);
	  <?php } else { ?>	  
	  var latlngOK = new google.maps.LatLng(-6.212176478654396,106.84216577246093);
	  var latlng5OK = new google.maps.LatLng(0, 0);
	  <?php } ?>
	 //  alart(latlng);
	  
	  var mapOptions = {
	      zoom: 17,
	      scaleControl: true,
	      center:  latlngOK,
	      draggable : true,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
		
	  map5 = new google.maps.Map(document.getElementById('map-canvas5'), mapOptions);
	  
	  marker5 = new google.maps.Marker({
	          map: map5,
			  title : 'Address',
			  draggable : true,
	          position: latlng5OK
     });
	  
	  // Add circle overlay and bind to marker
		  circle5 = new google.maps.Circle({
		    map: map5,
		    radius: 30,
		    
		    strokeColor   : '#cccccc',
		    strokeOpacity : 1,
		    strokeWeight  : 5,
		    fillColor     : '#009ee0',
		    fillOpacity   : 0.5
		  });
		  circle5.bindTo('center', marker5, 'position');
		 
	  
	  var input5 = /** @type {HTMLInputElement} */(
      document.getElementById('address_auto5'));
	  
	  var autocomplete = new google.maps.places.Autocomplete(input5);
 	  autocomplete.bindTo('bounds', map5);
	  
	  var place5 = autocomplete.getPlace();
	  
	  var infowindow5 = new google.maps.InfoWindow();

  autocomplete.addListener('place_changed', function() {
    infowindow5.close();
    marker5.setVisible(false);
    var place5 = autocomplete.getPlace();
    if (!place5.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place5.geometry.viewport) {
      map5.fitBounds(place5.geometry.viewport);
    } else {
      map5.setCenter(place5.geometry.location);
      map5.setZoom(17);  // Why 17? Because it looks good.
    }
    
    marker5.setPosition(place5.geometry.location);
    marker5.setVisible(true);

    var address_go5 = '';
    if (place5.address_components) {
      address_go5 = [
        (place5.address_components[0] && place5.address_components[0].short_name || ''),
        (place5.address_components[1] && place5.address_components[1].short_name || ''),
        (place5.address_components[5] && place5.address_components[5].short_name || '')
      ].join(' ');
    }
    	
    var address_go5 = document.getElementById('address_auto5').value;
	$("#comp_address5").val(address_go5);
	var contentString5 = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             '<strong>'+ place5.name + '</strong><br>' + address_go5 +
	                             '</div></div>';

    infowindow5.setContent(contentString5);
    infowindow5.open(map5, marker5);
    setTimeout(function () { infowindow5.close(); }, 1000);
    
    geocodePosition5(marker5.getPosition());
    updateMarkerPosition5(marker5.getPosition(), radius_new5);
			
  });
  
          google.maps.event.addListener(marker5, 'drag', function() {
	    radius_new5 = circle5.getRadius();
	    updateMarkerPosition5(marker5.getPosition(), radius_new5);
	  });		  
		  
	  google.maps.event.addListener(marker5, 'dragend', function() {
            radius_new5 = circle5.getRadius();
            updateMarkerPosition5(marker5.getPosition(), radius_new5);
	    geocodePosition5(marker5.getPosition());
          });
	  
	  google.maps.event.addListener(marker5, 'click', function() {                                                              
	      geocodePosition5(marker5.getPosition());
		  
		  if (address_ok5 != "") 
		  {
	             var contentString = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             ''+ address_ok5 + '<br>' +
	                             '<a onclick=send_address5()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                   
	             var infowindow = new google.maps.InfoWindow({
	                content: contentString
	             });  
	
	             infowindow.open(map5, marker5);
	                                   
	             setTimeout(function () { infowindow.close(); }, 3000);
		  }
	  });
	  
	}
	
      var address_ok5 = "";            
      function geocodePosition5(pos) {
         geocoder5.geocode({
         latLng: pos }, function(responses) {
	   
           if (responses && responses.length > 0) {
             address_ok5 = responses[0].formatted_address;
             //alert(address_ok);
    
           } else {
		     address_ok5 = "Cannot determine address at this location.";
		     //alert("Cannot determine address at this location.");
           }
         });
      }
	
	
	function change_position()
	{
	  var latitude_next = document.getElementById('pos_latitude5').value;
	  var longitude_next = document.getElementById('pos_longitude5').value;
	  latitude_next = parseFloat(latitude_next);
	  longitude_next = parseFloat(longitude_next);
	 
	  var latlngOK = new google.maps.LatLng(latitude_next, longitude_next);
          marker5.setPosition(latlng);
	}
	
	function send_address5() {
		document.getElementById('comp_address5').value = address_ok5;
	}
	

	function codeAddress5() {
	  google.maps.event.trigger(map5, 'resize');
	  var address = document.getElementById('comp_address5').value;
	  radius5 = 30;
	  
	  if (address == "") 
	  { 
	    alert ("please enter a company address first.");
	    exit(); 
	  }
	  geocoder5.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	        var mapOptions = {
				zoom: 17,
				scaleControl: true,
				center:  results[0].geometry.location,
				draggable : true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			  
			map5 = new google.maps.Map(document.getElementById('map-canvas5'), mapOptions);
			
			marker5 = new google.maps.Marker({
					map: map5,
					title : 'Address',
					draggable : true,
					position: results[0].geometry.location
		    });
			
			circle5 = new google.maps.Circle({
			  map: map5,
			  radius: 30,
			  
			  strokeColor   : '#cccccc',
			  strokeOpacity : 1,
			  strokeWeight  : 5,
			  fillColor     : '#009ee0',
			  fillOpacity   : 0.5
			});
			circle5.bindTo('center', marker5, 'position');
		  

	      updateMarkerPosition5(marker5.getPosition(), radius5);
		  
 	      google.maps.event.addListener(marker5, 'drag', function() {
          radius_new5 = circle5.getRadius();
         updateMarkerPosition5(marker5.getPosition(), radius_new5);
			
	   });		  
		  
	      google.maps.event.addListener(marker5, 'dragend', function() {
            radius_new5 = circle5.getRadius();
            updateMarkerPosition5(marker5.getPosition(), radius_new5);
			geocodePosition5(marker5.getPosition());
          });
		  
	      google.maps.event.addListener(circle5, 'click', function() {
			radius_new5 = circle5.getRadius();
			updateMarkerPosition5(marker5.getPosition(), radius_new5);			
	      });
		  
		  
	      google.maps.event.addListener(marker5, 'click', function() {                                                              
              geocodePosition5(marker5.getPosition());
			  
			  if (address_ok5 != "") 
			  {
	              var contentString = '<div style="width:300px" id="content">'+
	                              '<div id="bodyContent">'+
	                              ''+ address_ok5 + '<br>' +
	                              '<a onclick=send_address5()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                    
	              var infowindow = new google.maps.InfoWindow({
	                 content: contentString
	              });  
	
	              infowindow.open(map5, marker5);
	                                    
	              setTimeout(function () { infowindow.close(); }, 3000);
			  }
          });
		  
		  
	  } else {
	      alert('Geocode was not successful for the following reason: ' + status);
	    }
	  });
	}
	
	google.maps.event.addDomListener(window, 'load', initialize5);

</script>

<!-- Yang Keenam -->
<script>
	var geocoder6;
	var map6;
	var circle6;
	var marker6;
	var radius_new6;
	
	function change_text_address6()
	{
		codeAddress6();
	}
	
	function updateMarkerPosition6(latLng, radius6) {
		document.getElementById('pos_latitude6').value = [latLng.lat()];
		document.getElementById('pos_longitude6').value = [latLng.lng()];
	}
		
	
	function initialize6() {
	  geocoder6 = new google.maps.Geocoder();
	  <?php if (is_object($parentWali) && ($parentWali->office_latitude <> 0 && $parentWali->office_longitude <> 0)) { ?>
	  var latlngOK = new google.maps.LatLng(<?php echo $parentWali->office_latitude ?>, <?php echo $parentWali->office_longitude ?>);
	  var latlng6OK = new google.maps.LatLng(<?php echo $parentWali->office_latitude ?>, <?php echo $parentWali->office_longitude ?>);
	  <?php } else { ?>	  
	  var latlngOK = new google.maps.LatLng(-6.212176478654396,106.84216577246093);
	  var latlng6OK = new google.maps.LatLng(0, 0);
	  <?php } ?>
	 //  alart(latlng);
	  
	  var mapOptions = {
	      zoom: 17,
	      scaleControl: true,
	      center:  latlngOK,
	      draggable : true,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
		
	  map6 = new google.maps.Map(document.getElementById('map-canvas6'), mapOptions);
	  
	  marker6 = new google.maps.Marker({
	          map: map6,
			  title : 'Address',
			  draggable : true,
	          position: latlng6OK
     });
	  
	  // Add circle overlay and bind to marker
		  circle6 = new google.maps.Circle({
		    map: map6,
		    radius: 30,
		    
		    strokeColor   : '#cccccc',
		    strokeOpacity : 1,
		    strokeWeight  : 6,
		    fillColor     : '#009ee0',
		    fillOpacity   : 0.6
		  });
		  circle6.bindTo('center', marker6, 'position');
		 
	  
	  var input6 = /** @type {HTMLInputElement} */(
      document.getElementById('address_auto6'));
	  
	  var autocomplete = new google.maps.places.Autocomplete(input6);
 	  autocomplete.bindTo('bounds', map6);
	  
	  var place6 = autocomplete.getPlace();
	  
	  var infowindow6 = new google.maps.InfoWindow();

  autocomplete.addListener('place_changed', function() {
    infowindow6.close();
    marker6.setVisible(false);
    var place6 = autocomplete.getPlace();
    if (!place6.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place6.geometry.viewport) {
      map6.fitBounds(place6.geometry.viewport);
    } else {
      map6.setCenter(place6.geometry.location);
      map6.setZoom(17);  // Why 17? Because it looks good.
    }
    
    marker6.setPosition(place6.geometry.location);
    marker6.setVisible(true);

    var address_go6 = '';
    if (place6.address_components) {
      address_go6 = [
        (place6.address_components[0] && place6.address_components[0].short_name || ''),
        (place6.address_components[1] && place6.address_components[1].short_name || ''),
        (place6.address_components[6] && place6.address_components[6].short_name || '')
      ].join(' ');
    }
    	
    var address_go6 = document.getElementById('address_auto6').value;
	$("#comp_address6").val(address_go6);
	var contentString6 = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             '<strong>'+ place6.name + '</strong><br>' + address_go6 +
	                             '</div></div>';

    infowindow6.setContent(contentString6);
    infowindow6.open(map6, marker6);
    setTimeout(function () { infowindow6.close(); }, 1000);
    
    geocodePosition6(marker6.getPosition());
    updateMarkerPosition6(marker6.getPosition(), radius_new6);
			
  });
  
          google.maps.event.addListener(marker6, 'drag', function() {
	    radius_new6 = circle6.getRadius();
	    updateMarkerPosition6(marker6.getPosition(), radius_new6);
	  });		  
		  
	  google.maps.event.addListener(marker6, 'dragend', function() {
            radius_new6 = circle6.getRadius();
            updateMarkerPosition6(marker6.getPosition(), radius_new6);
	    geocodePosition6(marker6.getPosition());
          });
	  
	  google.maps.event.addListener(marker6, 'click', function() {                                                              
	      geocodePosition6(marker6.getPosition());
		  
		  if (address_ok6 != "") 
		  {
	             var contentString = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             ''+ address_ok6 + '<br>' +
	                             '<a onclick=send_address6()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                   
	             var infowindow = new google.maps.InfoWindow({
	                content: contentString
	             });  
	
	             infowindow.open(map6, marker6);
	                                   
	             setTimeout(function () { infowindow.close(); }, 3000);
		  }
	  });
	  
	}
	
      var address_ok6 = "";            
      function geocodePosition6(pos) {
         geocoder6.geocode({
         latLng: pos }, function(responses) {
	   
           if (responses && responses.length > 0) {
             address_ok6 = responses[0].formatted_address;
             //alert(address_ok);
    
           } else {
		     address_ok6 = "Cannot determine address at this location.";
		     //alert("Cannot determine address at this location.");
           }
         });
      }
	
	
	function change_position()
	{
	  var latitude_next = document.getElementById('pos_latitude6').value;
	  var longitude_next = document.getElementById('pos_longitude6').value;
	  latitude_next = parseFloat(latitude_next);
	  longitude_next = parseFloat(longitude_next);
	 
	  var latlngOK = new google.maps.LatLng(latitude_next, longitude_next);
          marker6.setPosition(latlng);
	}
	
	function send_address6() {
		document.getElementById('comp_address6').value = address_ok6;
	}
	

	function codeAddress6() {
	  google.maps.event.trigger(map6, 'resize');
	  var address = document.getElementById('comp_address6').value;
	  radius6 = 30;
	  
	  if (address == "") 
	  { 
	    alert ("please enter a company address first.");
	    exit(); 
	  }
	  geocoder6.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	        var mapOptions = {
				zoom: 17,
				scaleControl: true,
				center:  results[0].geometry.location,
				draggable : true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			  
			map6 = new google.maps.Map(document.getElementById('map-canvas6'), mapOptions);
			
			marker6 = new google.maps.Marker({
					map: map6,
					title : 'Address',
					draggable : true,
					position: results[0].geometry.location
		    });
			
			circle6 = new google.maps.Circle({
			  map: map6,
			  radius: 30,
			  
			  strokeColor   : '#cccccc',
			  strokeOpacity : 1,
			  strokeWeight  : 6,
			  fillColor     : '#009ee0',
			  fillOpacity   : 0.6
			});
			circle6.bindTo('center', marker6, 'position');
		  

	      updateMarkerPosition6(marker6.getPosition(), radius6);
		  
 	      google.maps.event.addListener(marker6, 'drag', function() {
          radius_new6 = circle6.getRadius();
         updateMarkerPosition6(marker6.getPosition(), radius_new6);
			
	   });		  
		  
	      google.maps.event.addListener(marker6, 'dragend', function() {
            radius_new6 = circle6.getRadius();
            updateMarkerPosition6(marker6.getPosition(), radius_new6);
			geocodePosition6(marker6.getPosition());
          });
		  
	      google.maps.event.addListener(circle6, 'click', function() {
			radius_new6 = circle6.getRadius();
			updateMarkerPosition6(marker6.getPosition(), radius_new6);			
	      });
		  
		  
	      google.maps.event.addListener(marker6, 'click', function() {                                                              
              geocodePosition6(marker6.getPosition());
			  
			  if (address_ok6 != "") 
			  {
	              var contentString = '<div style="width:300px" id="content">'+
	                              '<div id="bodyContent">'+
	                              ''+ address_ok6 + '<br>' +
	                              '<a onclick=send_address6()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                    
	              var infowindow = new google.maps.InfoWindow({
	                 content: contentString
	              });  
	
	              infowindow.open(map6, marker6);
	                                    
	              setTimeout(function () { infowindow.close(); }, 3000);
			  }
          });
		  
		  
	  } else {
	      alert('Geocode was not successful for the following reason: ' + status);
	    }
	  });
	}
	
	google.maps.event.addDomListener(window, 'load', initialize6);

</script>

<!-- Yang Ketujuh -->
<script>
	var geocoder7;
	var map7;
	var circle7;
	var marker7;
	var radius_new7;
	
	function change_text_address7()
	{
		codeAddress7();
	}
	
	function updateMarkerPosition7(latLng, radius7) {
		document.getElementById('pos_latitude7').value = [latLng.lat()];
		document.getElementById('pos_longitude7').value = [latLng.lng()];
	}
		
	
	function initialize7() {
	  geocoder7 = new google.maps.Geocoder();
	  <?php if (is_object($parentWali) && ($parentWali->parent_latitude <> 0 && $parentWali->parent_longitude <> 0)) { ?>
	  var latlngOK = new google.maps.LatLng(<?php echo $parentWali->parent_latitude ?>, <?php echo $parentWali->parent_longitude ?>);
	  var latlng7OK = new google.maps.LatLng(<?php echo $parentWali->parent_latitude ?>, <?php echo $parentWali->parent_longitude ?>);
	  <?php } else { ?>	  
	  var latlngOK = new google.maps.LatLng(-6.212176478654396,106.84216577246093);
	  var latlng7OK = new google.maps.LatLng(0, 0);
	  <?php } ?>
	 //  alart(latlng);
	  
	  var mapOptions = {
	      zoom: 17,
	      scaleControl: true,
	      center:  latlngOK,
	      draggable : true,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
		
	  map7 = new google.maps.Map(document.getElementById('map-canvas7'), mapOptions);
	  
	  marker7 = new google.maps.Marker({
	          map: map7,
			  title : 'Address',
			  draggable : true,
	          position: latlng7OK
     });
	  
	  // Add circle overlay and bind to marker
		  circle7 = new google.maps.Circle({
		    map: map7,
		    radius: 30,
		    
		    strokeColor   : '#cccccc',
		    strokeOpacity : 1,
		    strokeWeight  : 7,
		    fillColor     : '#009ee0',
		    fillOpacity   : 0.7
		  });
		  circle7.bindTo('center', marker7, 'position');
		 
	  
	  var input7 = /** @type {HTMLInputElement} */(
      document.getElementById('address_auto7'));
	  
	  var autocomplete = new google.maps.places.Autocomplete(input7);
 	  autocomplete.bindTo('bounds', map7);
	  
	  var place7 = autocomplete.getPlace();
	  
	  var infowindow7 = new google.maps.InfoWindow();

  autocomplete.addListener('place_changed', function() {
    infowindow7.close();
    marker7.setVisible(false);
    var place7 = autocomplete.getPlace();
    if (!place7.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place7.geometry.viewport) {
      map7.fitBounds(place7.geometry.viewport);
    } else {
      map7.setCenter(place7.geometry.location);
      map7.setZoom(17);  // Why 17? Because it looks good.
    }
    
    marker7.setPosition(place7.geometry.location);
    marker7.setVisible(true);

    var address_go7 = '';
    if (place7.address_components) {
      address_go7 = [
        (place7.address_components[0] && place7.address_components[0].short_name || ''),
        (place7.address_components[1] && place7.address_components[1].short_name || ''),
        (place7.address_components[7] && place7.address_components[7].short_name || '')
      ].join(' ');
    }
    	
    var address_go7 = document.getElementById('address_auto7').value;
	$("#comp_address7").val(address_go7);
	var contentString7 = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             '<strong>'+ place7.name + '</strong><br>' + address_go7 +
	                             '</div></div>';

    infowindow7.setContent(contentString7);
    infowindow7.open(map7, marker7);
    setTimeout(function () { infowindow7.close(); }, 1000);
    
    geocodePosition7(marker7.getPosition());
    updateMarkerPosition7(marker7.getPosition(), radius_new7);
			
  });
  
          google.maps.event.addListener(marker7, 'drag', function() {
	    radius_new7 = circle7.getRadius();
	    updateMarkerPosition7(marker7.getPosition(), radius_new7);
	  });		  
		  
	  google.maps.event.addListener(marker7, 'dragend', function() {
            radius_new7 = circle7.getRadius();
            updateMarkerPosition7(marker7.getPosition(), radius_new7);
	    geocodePosition7(marker7.getPosition());
          });
	  
	  google.maps.event.addListener(marker7, 'click', function() {                                                              
	      geocodePosition7(marker7.getPosition());
		  
		  if (address_ok7 != "") 
		  {
	             var contentString = '<div style="width:300px" id="content">'+
	                             '<div id="bodyContent">'+
	                             ''+ address_ok7 + '<br>' +
	                             '<a onclick=send_address7()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                   
	             var infowindow = new google.maps.InfoWindow({
	                content: contentString
	             });  
	
	             infowindow.open(map7, marker7);
	                                   
	             setTimeout(function () { infowindow.close(); }, 3000);
		  }
	  });
	  
	}
	
      var address_ok7 = "";            
      function geocodePosition7(pos) {
         geocoder7.geocode({
         latLng: pos }, function(responses) {
	   
           if (responses && responses.length > 0) {
             address_ok7 = responses[0].formatted_address;
             //alert(address_ok);
    
           } else {
		     address_ok7 = "Cannot determine address at this location.";
		     //alert("Cannot determine address at this location.");
           }
         });
      }
	
	
	function change_position()
	{
	  var latitude_next = document.getElementById('pos_latitude7').value;
	  var longitude_next = document.getElementById('pos_longitude7').value;
	  latitude_next = parseFloat(latitude_next);
	  longitude_next = parseFloat(longitude_next);
	 
	  var latlngOK = new google.maps.LatLng(latitude_next, longitude_next);
          marker7.setPosition(latlng);
	}
	
	function send_address7() {
		document.getElementById('comp_address7').value = address_ok7;
	}
	

	function codeAddress7() {
	  google.maps.event.trigger(map7, 'resize');
	  var address = document.getElementById('comp_address7').value;
	  radius7 = 30;
	  
	  if (address == "") 
	  { 
	    alert ("please enter a company address first.");
	    exit(); 
	  }
	  geocoder7.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	        var mapOptions = {
				zoom: 17,
				scaleControl: true,
				center:  results[0].geometry.location,
				draggable : true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			  
			map7 = new google.maps.Map(document.getElementById('map-canvas7'), mapOptions);
			
			marker7 = new google.maps.Marker({
					map: map7,
					title : 'Address',
					draggable : true,
					position: results[0].geometry.location
		    });
			
			circle7 = new google.maps.Circle({
			  map: map7,
			  radius: 30,
			  
			  strokeColor   : '#cccccc',
			  strokeOpacity : 1,
			  strokeWeight  : 7,
			  fillColor     : '#009ee0',
			  fillOpacity   : 0.7
			});
			circle7.bindTo('center', marker7, 'position');
		  

	      updateMarkerPosition7(marker7.getPosition(), radius7);
		  
 	      google.maps.event.addListener(marker7, 'drag', function() {
          radius_new7 = circle7.getRadius();
         updateMarkerPosition7(marker7.getPosition(), radius_new7);
			
	   });		  
		  
	      google.maps.event.addListener(marker7, 'dragend', function() {
            radius_new7 = circle7.getRadius();
            updateMarkerPosition7(marker7.getPosition(), radius_new7);
			geocodePosition7(marker7.getPosition());
          });
		  
	      google.maps.event.addListener(circle7, 'click', function() {
			radius_new7 = circle7.getRadius();
			updateMarkerPosition7(marker7.getPosition(), radius_new7);			
	      });
		  
		  
	      google.maps.event.addListener(marker7, 'click', function() {                                                              
              geocodePosition7(marker7.getPosition());
			  
			  if (address_ok7 != "") 
			  {
	              var contentString = '<div style="width:300px" id="content">'+
	                              '<div id="bodyContent">'+
	                              ''+ address_ok7 + '<br>' +
	                              '<a onclick=send_address7()><div style="font-size:11px; padding:4px; text-align:right; color:#cc3300">Copy to Address</div></a></div></div>';
	                                    
	              var infowindow = new google.maps.InfoWindow({
	                 content: contentString
	              });  
	
	              infowindow.open(map7, marker7);
	                                    
	              setTimeout(function () { infowindow.close(); }, 3000);
			  }
          });
		  
		  
	  } else {
	      alert('Geocode was not successful for the following reason: ' + status);
	    }
	  });
	}
	
	google.maps.event.addDomListener(window, 'load', initialize7);

</script>

<script type="text/javascript">
	$(document).ready(function() {
		$(window).keydown(function(event){
			if(event.keyCode == 13) {
			  event.preventDefault();
			  return false;
			}
		});	
	});
</script>