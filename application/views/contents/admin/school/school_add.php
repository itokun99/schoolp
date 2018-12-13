<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-plus fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title"> Sekolah Anak</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
						  
							<div class="box-header with-border">
							  <h3 class="box-title">Tambah Sekolah Anak</h3>
							</div>
							
							<div class="box-body">
							  
								<div class="panel-body pan">
								    <?php          
										$err_message = $this->session->userdata('err_message');
										$this->session->unset_userdata("err_message");
									?>
									<table id="datatable" width="100%">
										<tr>
										  <td><?php if (isset($err_message)) echo $err_message; ?></td>
										</tr>
									</table>
								    <form class="form-horizontal" name="frm" action="school/save" method="POST" enctype="multipart/form-data">
									  <div class="form-body pal">
										  <div class="form-group">
											<label class="control-label col-lg-2">Jenjang Pendidikan</label>
											<div class="col-lg-10">
											   <div class="col-lg-8 row">
												   <select name="edulevel_id" id="edulevel_id_drop" class="form-control" autocomplete="off" required="true">
													   <option value="">Pilih Jenjang Pendidikan</option>
													   <?php foreach($edulevels AS $edulevel) { ?>								
													   <option value="<?php echo $edulevel->edulevelid ?>"><?php echo $edulevel->edulevel_name ?></option>	
													   <?php } ?>
													 </select>
											   </div>
											</div>
										  </div>
										  
										  <div class="form-group">
											<label class="control-label col-lg-2">Provinsi</label>
											<div class="col-lg-10">
											   <div class="col-lg-8 row">
												   <select name="provinsi_id" id="provinsi_id_drop" class="form-control" autocomplete="off" required="true">
													   <option value="">Pilih Propinsi</option>
													   <?php foreach($provinsis AS $provinsi) { ?>								
													   <option value="<?php echo $provinsi->provinsiid ?>"><?php echo $provinsi->nama_provinsi ?></option>	
													   <?php } ?>
													 </select>
											   </div>
											</div>
										  </div>
   
										  <div class="form-group">
											<label class="control-label col-lg-2">Kota / Kabupaten</label>
											<div class="col-lg-10">
											   <div class="col-lg-8 row">
												   <select name="kabupaten_id" id="kabupaten_id_drop" class="form-control" autocomplete="off" required="true">
													   <option value="">Pilih Kota / Kabupaten</option>													   
												   </select>
											   </div>
											</div>
										  </div>
   
										  <div class="form-group">
											<label class="control-label col-lg-2">Kecamatan</label>
											<div class="col-lg-10">
											   <div class="col-lg-8 row">
												   <select name="kecamatan_id" id="kecamatan_id_drop" class="form-control" autocomplete="off" required="true">
													   <option value="">Pilih Kecamatan</option>													   
													 </select>
											   </div>
											</div>
										  </div>
										  <div class="form-group">
											 <label class="control-label col-lg-2">Sekolah</label>
											 <div class="col-lg-10">
												<div class="col-lg-8 row">
													<select name="school_id" id="school_id_drop" class="form-control" autocomplete="off" required="yes">
														  <option value="">Pilih Sekolah</option>														  
													</select>
												</div>
											 </div>
										  </div>
										  <div class="form-group">
											 <label class="control-label col-lg-2">NIK Anak</label>
											 <div class="col-lg-10">
												<div class="col-lg-8 row">
												   <input type="text" class="form-control" id="inputCode" name="children_nik" autocomplete="off" required="true" />
												</div>
											 </div>
										  </div>
										  
										  <div class="form-group">
											 <label class="control-label col-lg-2"></label>
											 <div class="col-lg-10">
												<div class="col-lg-6 row">
												   <button type="submit" class="btn btn-info">Simpan</button>
												   &nbsp;&nbsp;&nbsp;&nbsp;
												   <a href="school"class="btn">Kembali</a>
												</div>
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
		$("#edulevel_id_drop").change(function() {
			var kecamatan_id = $("#kecamatan_id_drop").val();
			$("#school_id_drop").load("school/get_school/" + kecamatan_id + "/" + $(this).val() + "");
		});
		
		$("#provinsi_id_drop").change(function() {		
			$("#kabupaten_id_drop").load("school/get_kabupaten/" + $(this).val() + "");
		});
		
		$("#kabupaten_id_drop").change(function() { 
			$("#kecamatan_id_drop").load("school/get_kecamatan/" + $(this).val() + "");
		});
		
		$("#kecamatan_id_drop").change(function() {
			var edulevel_id = $("#edulevel_id_drop").val();
			$("#school_id_drop").load("school/get_school/" + $(this).val() + "/" + edulevel_id + "");
		});
	
	    $("#edulevel_id_drop").select2();
		$("#provinsi_id_drop").select2();
		$("#kabupaten_id_drop").select2();
		$("#kecamatan_id_drop").select2();
		$("#school_id_drop").select2();
	});
	
</script>
	