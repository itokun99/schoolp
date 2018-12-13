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
										<img src="assets/images/profile/mm_<?php echo $member->picture ?>" class="img-rounded" width="300" border="0">
									<?php } else { ?>
										<img src="assets/images/profile/mm_na.jpg" class="img-rounded" width="300" border="0">
									<?php } ?>
									
							  </div>
							  <div class="col-md-8" style="padding-left: 10px;">
								<div style="height: 10px"></div>
								<table id="datatable" class="table" cellspacing="0" width="100%">
								  <tbody>
									<tr>
									  <td width="150">Nama</td>
									  <td><?php echo $member->fullname ?></td>  
									</tr>
									<tr>
									  <td>NIK</td>
									  <td><?php if ($member->parent_nik <> "") echo $member->parent_nik; else echo "-" ?></td>  
									</tr>
									<tr>
									  <td>Email</td>
									  <td><?php echo $member->email ?></td>  
									</tr>
									<tr>
									  <td>Handphone</td>
									  <td><?php if ($member->mobile_phone <> "") echo $member->mobile_phone; else echo "-" ?></td>  
									</tr>
									<tr>
									  <td>Hubungan</td>
									  <td><?php echo $member->relation ?></td>  
									</tr>
									<tr>
									  <td>Jenis Kelamin</td>
										<td><?php echo $member->gender ?></td>  
									</tr>
									<tr>
									  <td>Agama</td>
									  <td><?php if ($member->religion <> "") echo $member->religion; else echo "-" ?></td>  
									</tr>
									<tr>
									  <td>Tempat Lahir</td>
									  <td><?php if ($member->birth_place <> "") echo $member->birth_place; else echo "-" ?></td>  
									</tr>									
									<tr>
									  <td>Tanggal Lahir</td>
									  <td><?php if ($member->birth_date <> "0000-00-00") echo date_db_to_str($member->birth_date); else echo "-" ?></td>  
									</tr>
									<tr>
									  <td>Alamat</td>
									  <td><?php echo $member->address ?></td>  
									</tr>
									
									<tr>
									  <td>Login Terakhir</td>
									  <td><?php echo $member->lastlogin_ok ?></td>  
									</tr>
									<tr>
									  <td></td>
										<?php if($login_from == "facebook" || $login_from == "gmail")
										{
										?>
												<td>
												<div style="height: 10px"></div>
												<a href="profile/editprofile" title="Edit Profile" class="btn btn-info">Ubah Profil</a>
												</td> 
										<?php
										}
										else
										{
										?>
											<td>
										  <div style="height: 10px"></div>
										  <a href="profile/editprofile" title="Edit Profile" class="btn btn-info">Ubah Profil</a>
										  &nbsp;&nbsp;&nbsp;&nbsp;
										  <a href="profile/change_password" title="Change Password" class="btn btn-info">Ganti Kata Sandi</a>
									  	</td>  
										<?php
										}
										?>
									  
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
				msg = "Your New Password and Re-type New Password is not match.";
				xvalid = 0;
			}
			if (new_password_confirm == "")
			{
				msg = "Please fill your Re-type New Password confirm first.";
				xvalid = 0;
			}
			if (new_password == "")
			{
				msg = "Please fill your New Password first.";
				xvalid = 0;
			}
			if (old_password == "")
			{
				msg = "Please fill your Old Password first.";
				xvalid = 0;
			}
			
			if (xvalid == 1)
			{
				start_valid=confirm("Are you sure to Change Password ?")
	
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
   