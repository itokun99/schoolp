<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-user fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Profil Anak</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
						  
							<?php          
								$err_message = $this->session->userdata('err_message');
								$this->session->unset_userdata("err_message");
							?>
							<table id="datatable" width="100%">
								<tr>
								  <td><?php if (isset($err_message)) echo $err_message; ?></td>
								</tr>
							</table>
							  
							<div class="form-body pal">
							  
								<div class="col-lg-12">
									<div id="tabs">
										<ul class="nav nav-pills nav-pills-warning menu-hover" id="prodTabs">
											<li class="active">
												<a href="#class_menu_profile">Profil</a>
											</li>
											<?php $k = 1; foreach ($parent_details as $parent_detail) { ?>
											<li class="parent_<?php echo $k ?>">
												<a href="#class_parent_<?php echo $k ?>"><?php echo $parent_detail->parent_type ?></a>
											</li>
											<?php $k = $k + 1; } ?>
										</ul>
										
										<div class="tab-content">
										<!-- Tabs Profile Student -->
											<div style="height: 15px"></div>
											
											<div id="class_menu_profile" class="tab-pane active">
												<div class="row">
												
													<table class="table" cellspacing="0" width="100%">
														<tr>
															<td colspan="2">
																<?php
																	$url_path = $this->session->userdata('link_school') . "/";
																	if ($data->picture == "") $img_type = 0; else $img_type = 1;
																?>
																
																<?php if ($img_type == 1) { ?>
																<img src="<?php echo $url_path ?>assets/images/profile/mm_<?php echo $data->picture ?>" class="img-rounded" width="200" border="0">
																<?php } else { ?>
																	<img src="assets/images/profile/mm_na.jpg" class="img-rounded" width="200" border="0">
																<?php } ?>
															</td>
														</tr>
														<tr bgcolor="#dddddd">
															<td colspan="2"><b>DATA PRIBADI</b></td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7" style="width: 150px">Tingkatan Kelas</td>
															<td>
																<?php echo $data->edulevel_name ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Nama</td>
															<td>
																<?php echo $data->fullname ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Jenis Kelamin</td>
															<td>
																<?php if ($data->gender == "Male") echo "Laki-laki"; else echo "Perempuan"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">NIS</td>
															<td>
																<?php if ($data->member_code <> "") echo $data->member_code; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">NISN</td>
															<td>
																<?php if ($data->nisn <> "") echo $data->nisn; else echo "-"; ?>
															</td>
														</tr>
														
														<tr>
															<td bgcolor="#f7f7f7">Rombel</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->rombel <> "") echo $student_detail->rombel; else echo "-"; ?>
															</td>
														</tr>
														
														
														<tr>
															<td bgcolor="#f7f7f7">Tempat Lahir</td>
															<td>
																<?php if ($data->birth_place <> "") echo $data->birth_place; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Tanggal Lahir</td>
															<td>
																<?php if ($data->birth_date <> "0000-00-00") echo date_db_to_str($data->birth_date); else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Kewarganegaraan</td>
															<td>
																<?php if ($data->citizen_status <> "") echo $data->citizen_status; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">NIK / NIORA</td>
															<td>
																<?php if ($data->nik <> "") echo $data->nik; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Agama</td>
															<td>
																<?php if ($data->religion <> "") echo $data->religion; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Kebutuhan Khusus</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->special_needs <> "") echo $student_detail->special_needs; else echo "-"; ?>		
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Login Terakhir</td>
															<td>
																<?php if ($data->lastlogin_ok <> "") echo $data->lastlogin_ok; else echo "-"; ?>
															</td>
														</tr>
														
														<tr bgcolor="#dddddd">
															<td colspan="2"><b>TEMPAT TINGGAL</b></td>
														</tr>
														<tr>
															<td>
																RT &nbsp;&nbsp; <?php if (is_object($student_detail) && $student_detail->rt <> "") echo $student_detail->rt; else echo "-"; ?>
															</td>
															<td>
																RW &nbsp;&nbsp; <?php if (is_object($student_detail) && $student_detail->rw <> "") echo $student_detail->rw; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Dusun</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->dusun <> "") echo $student_detail->dusun; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Kelurahan</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->kelurahan <> "") echo $student_detail->kelurahan; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Kecamatan</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->kecamatan <> "") echo $student_detail->kecamatan; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Kode Pos</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->post_code <> "") echo $student_detail->post_code; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Jenis Tinggal</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->jenis_tinggal <> "") echo $student_detail->jenis_tinggal; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Transportasi Menuju Sekolah</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->transportasi <> "") echo $student_detail->transportasi; else echo "-"; ?>
															</td>
														</tr>
														
														<tr>
															<td bgcolor="#f7f7f7">Alamat</td>
															<td>
																<?php if ($data->address <> "") echo $data->address; else echo "-"; ?>
															</td>
														</tr>
														<?php if (is_object($student_detail) && $student_detail->latitude <> "0" && $student_detail->longitude <> "0") { ?>
														<tr>
															<td colspan="2" align="center">
																<iframe name="map" src="children/map/<?php echo $student_detail->latitude ?>/<?php echo $student_detail->longitude ?>" width="100%" height="275" scrolling="no" frameborder="0"></iframe>
															</td>
														</tr>
														<?php } ?>
														
														<tr bgcolor="#dddddd">
															<td colspan="2"><b>KONTAK</b></td>
														</tr>			
														<tr>
															<td bgcolor="#f7f7f7">Telephone Rumah</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->home_phone <> "") echo $student_detail->home_phone; else echo "-"; ?>
															</td>
														</tr>
														
														<tr>
															<td bgcolor="#f7f7f7">Handphone</td>
															<td>
																<?php if ($data->mobile_phone <> "") echo $data->mobile_phone; else echo "-"; ?>
															</td>
														</tr>
											
														<tr>
															<td bgcolor="#f7f7f7">Email</td>
															<td>
																<?php if ($data->email <> "") echo $data->email; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Surat Keterangan Ujian Negara</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->skhun <> "") echo $student_detail->skhun; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Penerimaan KPS</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->penerima_kps <> "") echo $student_detail->penerima_kps; else echo "-"; ?>
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Nomor KPS</td>
															<td>
																<?php if (is_object($student_detail) && $student_detail->no_kps <> "") echo $student_detail->no_kps; else echo "-"; ?>
															</td>
														</tr>
														
											
													</table>
												</div>								 
											</div>	
										
											<!-- Parent Detail -->
											<?php $k = 1; foreach ($parent_details as $parent_detail) { ?>
											<div id="class_parent_<?php echo $k ?>" class="tab-pane">
											<div class="row">
												<table class="table" cellspacing="0" width="100%">
													<?php if ($parent_detail->parent_name <> "") { ?>
														<tr>
															<td bgcolor="#f7f7f7" style="width: 150px">Name</td>
															<td>
																<?php if ($parent_detail->parent_name <> "") echo $parent_detail->parent_name; else echo "-"; ?>	  	  
															</td>
														</tr>
														<tr>
															<td bgcolor="#f7f7f7">Kewarganegaraan</td>
															<td>
																<?php if ($parent_detail->type_warga <> "") echo $parent_detail->type_warga; else echo "-"; ?>	  	  
															</td>
														</tr>	
														<tr>
															<td bgcolor="#f7f7f7">NIK / NIORA</td>
															<td>
																<?php if ($parent_detail->parent_nik <> "") echo $parent_detail->parent_nik; else echo "-"; ?>
															</td>
														</tr>	
														<tr>
															<td bgcolor="#f7f7f7">Tempat Lahir</td>
															<td>
																<?php if ($parent_detail->parent_birth_place <> "") echo $parent_detail->parent_birth_place; else echo "-"; ?>
															</td>
														</tr>	
														<tr>
															<td bgcolor="#f7f7f7">Tanggal Lahir</td>
															<td>
																<?php if ($parent_detail->parent_birth_date <> "0000-00-00") echo date_db_to_str($parent_detail->parent_birth_date); else echo "-"; ?>
															</td>
														</tr>	
														<tr>
															<td bgcolor="#f7f7f7">Telephone Rumah</td>
															<td>
																<?php if ($parent_detail->parent_home_phone <> "") echo $parent_detail->parent_home_phone; else echo "-"; ?>
															</td>
														</tr>	
														<tr>
															<td bgcolor="#f7f7f7">Handphone</td>
															<td>
																<?php if ($parent_detail->parent_phone <> "") echo $parent_detail->parent_phone; else echo "-"; ?>
															</td>
														</tr>	
														<tr>
															<td bgcolor="#f7f7f7">Email</td>
															<td>
																<?php if ($parent_detail->parent_email <> "") echo $parent_detail->parent_email; else echo "-"; ?>
															</td>
														</tr>	
														<tr>
															<td bgcolor="#f7f7f7">Pendidikan</td>
															<td>
																<?php if ($parent_detail->parent_education <> "") echo $parent_detail->parent_education; else echo "-"; ?>
															</td>
														</tr>			
														<tr>
															<td bgcolor="#f7f7f7">Jabatan Pekerjaan</td>
															<td>
																<?php if ($parent_detail->employment <> "") echo $parent_detail->employment; else echo "-"; ?>
															</td>
														</tr>	
														<tr>
															<td bgcolor="#f7f7f7">Nama Perusahaan</td>
															<td>
																<?php if ($parent_detail->company_name <> "") echo $parent_detail->company_name; else echo "-"; ?>
															</td>
														</tr>	
														<tr>
															<td bgcolor="#f7f7f7">Alamat Tempat Kerja</td>
															<td>
																<?php if ($parent_detail->workplace_address <> "") echo $parent_detail->workplace_address; else echo "-"; ?>
															</td>
														</tr>
														<?php if ($parent_detail->office_latitude <> "0" && $parent_detail->office_longitude <> "0") { ?>
														<tr>
															<td colspan="2" align="center">
																<iframe name="map" src="children/map/<?php echo $parent_detail->office_latitude ?>/<?php echo $parent_detail->office_longitude ?>" width="100%" height="275" scrolling="no" frameborder="0"></iframe>
															</td>
														</tr>
														<?php } ?>
														<tr>
															<td bgcolor="#f7f7f7">Penghasilan Perbulan</td>
															<td>
																<?php if ($parent_detail->parent_income <> "") echo $parent_detail->parent_income; else echo "-"; ?>
															</td>
														</tr>	
														<tr>
															<td bgcolor="#f7f7f7">Alamat Tempat Tinggal</td>
															<td>
																<?php if ($parent_detail->parent_address <> "") echo $parent_detail->parent_address; else echo "-"; ?>
															</td>
														</tr>
														<?php if ($parent_detail->parent_latitude <> "0" && $parent_detail->parent_longitude <> "0") { ?>
														<tr>
															<td colspan="2" align="center">
																<iframe name="map" src="children/map/<?php echo $parent_detail->parent_latitude ?>/<?php echo $parent_detail->parent_longitude ?>" width="100%" height="275" scrolling="no" frameborder="0"></iframe>
															</td>
														</tr>
														<?php } ?>
													
													<?php } else { ?>
													
														<tr>
															<td colspan="2" style="text-align: center; color: #666666">
															  <div style="height: 150px"></div>
															  Tidak Ada Data di Database.
															  <div style="height: 120px"></div>
															</td>
														</tr>
													
													<?php } ?>
												</table>
											</div>
											</div>
											<?php $k = $k + 1; } ?>
										</div>
										
										<table class="table" cellspacing="0" width="100%">
											<tr>
												<td align="right"><a href="children/edit_profile" title="Edit Children Profile" class="btn btn-info">Ubah Profil</a></td>
											</tr>										
										</table>
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
		
		$('#tabs').on('click','.tablink,#prodTabs a',function (e) {
			e.preventDefault();
			var url = $(this).attr("data-url");
		
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
   