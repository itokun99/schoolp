<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-user fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Profil</h4>
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
							  
							<form class="form-horizontal" id="formChangePassword" action="profile/changepassdb" method="POST">				
							<div class="form-body pal">
							  <div class="col-md-4" style="padding-left: 0px;">
								    <div style="height: 10px"></div>
									<?php
									  $full_path = "assets/images/profile/mm_" . $member->picture;
									  
									  if (!file_exists($full_path) || $member->picture == "") $img_type = 0; else $img_type = 1;
									  if ($img_type == 1) {
									?>
										<img src="assets/images/profile/mm_<?php echo $member->picture ?>" class="img-responsive img-rounded" width="300" border="0">
									<?php } else { ?>
										<img src="assets/images/profile/mm_na.jpg" class="img-responsive img-rounded" width="300" border="0">
									<?php } ?>
									
							  </div>
							  <div class="col-md-8" style="padding-left: 10px;">
								<div style="height: 10px"></div>
								<table id="datatable" class="table" cellspacing="0" width="100%">
								  <tbody>
									<tr>
									  <td bgcolor="#efefef" width="120">Nama</td>
									  <td><?php echo $member->fullname ?></td>  
									</tr>									
									<tr>
									  <td bgcolor="#efefef">Email</td>
									  <td><?php echo $member->email ?></td>  
									</tr>
									<tr>
									  <td bgcolor="#efefef">Handphone</td>
									  <td><?php if ($member->mobile_phone <> "") echo $member->mobile_phone; else echo "-" ?></td>  
									</tr>
									<tr>
									  <td bgcolor="#efefef">Hubungan</td>
									  <td><?php if ($member->relation <> "") echo $member->relation; else echo "-" ?></td>  
									</tr>
									<tr>
									  <td bgcolor="#efefef">Jenis Kelamin</td>
									  <td><?php if ($member->gender == "Male") echo "Laki-laki"; else echo "Perempuan" ?></td>  
									</tr>
									<tr>
									  <td bgcolor="#efefef">Agama</td>
									  <td><?php if ($member->religion <> "") echo $member->religion; else echo "-" ?></td>  
									</tr>									
																		
									<tr>
									  <td bgcolor="#efefef">Tanggal Lahir</td>
									  <td><?php if ($member->birth_date <> "0000-00-00") echo date_db_to_str($member->birth_date); else echo "-" ?></td>  
									</tr>
									<tr>
									  <td bgcolor="#efefef">Alamat</td>
									  <td><?php echo $member->address ?></td>  
									</tr>
									
									<tr>
									  <td bgcolor="#efefef">Terakhir Login</td>
									  <td><?php echo $member->lastlogin_ok ?></td>  
									</tr>
									<tr>
									  <td colspan="2" style="text-align: right">
										  <a href="profile/editprofile" title="Edit Profile" class="btn btn-info">Ubah Profil</a>
										  &nbsp;&nbsp;&nbsp;&nbsp;
										  <a href="profile/change_password" title="Change Password" class="btn btn-info">Ganti Kata Sandi</a>
									  </td>  
									</tr>
								  </tbody>
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
		
		$('#btnSave').on('click', function () {
		    
			var xvalid = 1;
			var msg;
			var old_password = $('#old_password').val();
			var new_password = $('#new_password').val();
			var new_password_confirm = $('#new_password_confirm').val();
			
			if (new_password != new_password_confirm)
			{
				msg = "Kata Sandi Baru dan Kata Sandi Baru yang diketik Ulang Tidak Cocok.";
				xvalid = 0;
			}
			if (new_password_confirm == "")
			{
				msg = "Silahkan Isi Kembali Kata Sandi Baru Andabali.";
				xvalid = 0;
			}
			if (new_password == "")
			{
				msg = "Silahkan Isi Kata Sandi Baru Anda Terlebih Dahulu.";
				xvalid = 0;
			}
			if (old_password == "")
			{
				msg = "Silahkan Isi Kata Sandi Lama Anda Terlebih Dahulu.";
				xvalid = 0;
			}
			
			if (xvalid == 1)
			{
				start_valid=confirm("Apakah Anda Yakin Ganti Kata Sandi ?")
	
				if (start_valid == true)
				{
					$('#formChangePassword').submit();
				}
			}
			else
			{
				alert(msg);
			}
            
        });
	  
  });
	
</script>	
   