<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-edit fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Ubah Profil</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
						  
							<div class="box-body">
								<div class="row">
									   <?php if (isset($err_message) && $err_message <> "") { ?>
										 <table id="datatable" width="100%">
										   <tr>
											 <td><?php if (isset($err_message)) echo $err_message; ?></td>
										   </tr>
										 </table>
									   <?php } ?>
									   
									<form class="form-horizontal" id="formEditProfile" action="profile/updatedb" method="POST" enctype="multipart/form-data">
									<input type="Hidden" name="picture_old" value="<?php echo $member->picture ?>">
									 
									<?php if ($member->picture <> "") { ?>
									<div class="col-lg-4" style=" text-align: center">
										<div style="height: 5px"></div>								  
										<?php if (file_exists("assets/images/profile/mm_$member->picture")) { ?>
											<img src="assets/images/profile/mm_<?php echo $member->picture ?>" width="300" class="img-responsive img-rounded" border="0">
										<?php } else { ?>
											<img src="assets/images/profile/mm_na.jpg" class="img-responsive img-rounded" width="300" border="0">
										<?php } ?>
										
										<div style="height: 5px"></div>
										<div style="color: #cc3300; text-align: center">
										   <input type="Checkbox" name="remove_file" value="1">
										   &nbsp;Hapus Foto
										</div>								  
									</div>
									<?php } ?>
									
									<div class="col-lg-8">
										<div class="form-body pal">
											 <div class="form-group">
												<label class="control-label col-lg-3">Nama</label>
												<div class="col-lg-9">
												   <div class="col-lg-10 row">
													  <input type="Text" class="form-control" name="fullname" id="fullname" value="<?php echo $member->fullname ?>" required="true" />
												   </div>
												</div>
											 </div>					 
											 <div class="form-group">
												<label class="control-label col-lg-3">Email</label>
												<div class="col-lg-9">
												   <div class="col-lg-10 row">
													  <input type="Text" class="form-control" name="email" id="email" placeholder="e.g. yourname@company.com" value="<?php echo $member->email ?>" required="true" />
												   </div>
												</div>
											 </div>
											 <div class="form-group">
												<label class="control-label col-lg-3">Handphone</label>
												<div class="col-lg-9">
												   <div class="col-lg-10 row">
													  <input type="Text" class="form-control" name="mobile_phone" id="mobilephone" placeholder="e.g. 081298765432, 081612345678" value="<?php echo $member->mobile_phone ?>" />
												   </div>
												</div>
											 </div>
											 <div class="form-group">
												<label class="control-label col-lg-3">Hubungan</label>
												<div class="col-lg-9">
												   <div class="col-lg-10 row">
													  <input type="Radio" name="relation" value="Father" <?php if ($member->relation == "Father") echo "Checked" ?> required="true">&nbsp; Ayah
													  &nbsp;&nbsp;&nbsp;&nbsp;
													  <input type="Radio" name="relation" value="Mother" <?php if ($member->relation == "Mother") echo "Checked" ?> required="true">&nbsp; Ibu
												   </div>
												</div>
											 </div>
											 <div class="form-group">
												<label class="control-label col-lg-3">Jenis Kelamin</label>
												<div class="col-lg-9">
												   <div class="col-lg-10 row">
													  <input type="Radio" name="gender" value="Male" <?php if ($member->gender == "Male") echo "Checked" ?> required="true">&nbsp; Laki-laki
													  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													  <input type="Radio" name="gender" value="Female" <?php if ($member->gender == "Female") echo "Checked" ?> required="true">&nbsp; Perempuan
												   </div>
												</div>
											 </div>
											 <div class="form-group">
												<label class="control-label col-lg-3">Agama</label>
												<div class="col-lg-9">
												   <div class="col-lg-10 row">
													  <select name="religion" class="form-control" autocomplete="off" required="yes">
															<option value="">Pilih:</option>
															<option value="">---</option>
														<?php foreach($religions AS $religion) { ?>								
															<option value="<?php echo $religion->religion_name ?>" <?php if ($member->religion == $religion->religion_name) echo "Selected" ?>><?php echo $religion->religion_name ?></option>	
														<?php } ?>	
													  </select>
												   </div>
												</div>
											 </div>

											 <div class="form-group">
												<label class="control-label col-lg-3">Tanggal Lahir *</label>
												<div class="col-lg-9">
												   <div class="col-lg-10 row">
													 <select name="birth_day" class="form-control" style="width: 65px; display: inline;" autocomplete="off" required="yes">
														   <option value="">dd</option>
														   <option value="">---</option>
													   <?php for ($i = 1; $i <= 31; $i++) { ?>								
														   <option value="<?php echo sprintf("%02d",$i) ?>" <?php if (date('d',strtotime($member->birth_date)) == $i && $member->birth_date <> "0000-00-00") echo "Selected" ?>><?php echo sprintf("%02d",$i) ?></option>	
													   <?php } ?>	
													 </select>&nbsp;&nbsp;
													 <select name="birth_month" class="form-control" style="width: 75px; display: inline;" autocomplete="off" required="yes">
														   <option value="">mm</option>
														   <option value="">---</option>
													   <?php for ($i = 1; $i <= 12; $i++)
													   {
															$monthName = date("M", mktime(0, 0, 0, $i, 10));
													   ?>								
														   <option value="<?php echo sprintf("%02d",$i) ?>" <?php if (date('m',strtotime($member->birth_date)) == $i && $member->birth_date <> "0000-00-00") echo "Selected" ?>><?php echo $monthName ?></option>	
													   <?php } ?>	
													 </select>&nbsp;&nbsp;
													 <select name="birth_year" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">
														   <option value="">yyyy</option>
														   <option value="">---</option>
													   <?php for ($i = 1950; $i <= 2017; $i++) { ?>								
														   <option value="<?php echo $i ?>" <?php if (date('Y',strtotime($member->birth_date)) == $i && $member->birth_date <> "0000-00-00") echo "Selected" ?>><?php echo $i ?></option>	
													   <?php } ?>	
													 </select>
												   </div>
												</div>
											 </div>
											 <div class="form-group">
												<label class="control-label col-lg-3">Alamat</label>
												<div class="col-lg-9">
												   <div class="col-lg-10 row">
													  <textarea class="form-control" id="inputAddress" name="address"><?php echo $member->address ?></textarea>
												   </div>
												</div>
											</div>											
											
											<div class="form-group">
												<label class="control-label col-lg-3">Foto</label>
												<div class="col-lg-9">
												   <div class="col-lg-10 row">
													   <input type="file" id="files" name="picture" size="50" accept=".png, .jpg, .jpeg">
													   <div style="height: 10px"></div>
													   <img id="image" height="100">
												   </div>
												  
												</div>
											</div>
											
										</div>
									 </div>
									 </form>
									
									<div class="col-lg-4"></div>
									<div class="col-lg-8">
											<div class="form-group">
												<label class="control-label col-lg-3"></label>
												<div class="col-lg-9">
												   <div class="col-lg-10 row">
													  <button id="btnSave" class="btn btn-info">Simpan</button>
													  &nbsp;&nbsp;&nbsp;&nbsp;
													  <a href="profile"class="btn">Kembali</a>
												   </div>
												</div>
											</div>
									</div>
									 
									<br><br>
							 
									 
								</div>
							 </div>
							
						</div>					  
					</div>
				
			</div>
		</div>
	</div>
</div>

<script>
document.getElementById("files").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
</script>

<script type="text/javascript">

  $(document).ready(function() {
		
		$('#btnSave').on('click', function () {
		    
			var xvalid = 1;
			var msg;
			var fullname = $('#fullname').val();
			var email = $('#email').val();
			var mobilephone = $('#mobilephone').val();
			
			if (mobilephone == "")
			{
				msg = "Silahkan Isi Nomor Handphone Anda terlebih Dahulu.";
				xvalid = 0;
			}
	
			if (email == "")
			{
				msg = "Silahkan Isi Email Anda Terlebih Dahulu.";
				xvalid = 0;
			}
			else
			{
				if ((email.indexOf('@') < 0) | (email.indexOf('.') < 0)) 
				{
					msg = "Silahkan Masukkan Alamat e-Mail Dengan Format yang Benar (e.q.:yourname@company.com).";
					xvalid = 0;
				}	
			}
			
			if (fullname == "")
			{
				msg = "Silahkan  Masukkan Nama Terlebih Dahulu.";
				xvalid = 0;
			}
			
			if (xvalid == 1)
			{
				start_valid=confirm("Apakah Anda Yakin Untuk Mengubah Profil ?")
	
				if (start_valid == true)
				{
					$('#formEditProfile').submit();
				}
			}
			else
			{
				alert(msg);
			}
            
        });
	  
  });
	
</script>	
   