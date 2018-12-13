<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-lock fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Ganti Kata Sandi</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
						  
							<div class="box-body">
								<div class="panel-body pan">
									   <?php          
										 $err_message = $this->session->userdata('err_message');
										 $this->session->unset_userdata("err_message");
									   ?>
									   <?php if (isset($err_message) && $err_message <> "") { ?>
										 <table id="datatable" width="100%">
										   <tr>
											 <td><?php if (isset($err_message)) echo $err_message; ?></td>
										   </tr>
										 </table>
									   <?php } ?>
									   
									 <form class="form-horizontal" id="formChangePassword" action="profile/changepassdb" method="POST">				
									 <div class="form-body pal">
										  <div class="form-group">
											 <label class="control-label col-lg-3">Kata Sandi Lama</label>
											 <div class="col-lg-9">
												<div class="col-lg-4 row">
												   <input type="Password" class="form-control" id="old_password" name="old_password" required="true" />
												</div>
											 </div>
										  </div>
										  <div class="form-group">
											 <label class="control-label col-lg-3">Kata Sandi Baru</label>
											 <div class="col-lg-9">
												<div class="col-lg-4 row">
												   <input type="Password" class="form-control" id="new_password" name="new_password" required="true" />
												</div>
											 </div>
										  </div>
										  <div class="form-group">
											 <label class="control-label col-lg-3">Ketik Ulang Kata Sandi Baru</label>
											 <div class="col-lg-9">
												<div class="col-lg-4 row">
												   <input type="Password" class="form-control" id="new_password_confirm" name="new_password_confirm" required="true" />
												</div>
											 </div>
										  </div>					 
									 </div>
									 </form>
									 
									 <div class="form-group">
										 <label class="control-label col-lg-3"></label>
										 <div class="col-lg-9">
											<div class="col-lg-6 row">
											   <button id="btnSave" class="btn btn-info">Simpan</button>
											   &nbsp;&nbsp;&nbsp;&nbsp;
											   <a href="profile"><button class="btn">Kembali</button</a>
											</div>
										 </div>
									  </div>	
									 
									  <div class="col-lg-12">&nbsp;</div>
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
				msg = "Kata Sandi Baru dan KOnfirmasi Kata Sandi Baru Tidak Cocok.";
				xvalid = 0;
			}
			if (new_password_confirm == "")
			{
				msg = "Silahkan Ketik Ulang Kata Sandi Baru Anda.";
				xvalid = 0;
			}
			if (new_password == "")
			{
				msg = "Silahkan Masukkan Kata Sandi Baru Anda Terlebih Dahulu.";
				xvalid = 0;
			}
			if (old_password == "")
			{
				msg = "Silahkan Isi Kata Sandi Lama Anda Terlebih Dahulu.";
				xvalid = 0;
			}
			
			if (xvalid == 1)
			{
				start_valid=confirm("Apakah Anda Yakin Untuk Ganti Kata Sandi ?")
	
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
   