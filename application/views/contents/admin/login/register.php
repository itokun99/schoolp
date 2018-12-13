<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="red">
				<i class="fa fa-sign-in fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Daftar</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
						  							
							<div class="box-body">
							  
								<div class="panel-body pan">
								   <?php if (isset($err_message) && $err_message <> "") { ?>
								   <table id="datatable" width="100%">
										<tr>
										  <td><?php if (isset($err_message)) echo $err_message; ?></td>
										</tr>
								   </table>
								   <?php } ?>	
								   <form class="form-horizontal" name="frm" action="register/save" method="POST" enctype="multipart/form-data">
									  <div class="form-body pal">
										  <div class="form-group">
											<label class="control-label col-lg-3">Nama *</label>
											<div class="col-lg-9">
											   <div class="col-lg-10 row">
												  <input type="Text" class="form-control" id="fullname" name="fullname" value="<?php echo $fullname ?>" autocomplete="off" required="true">
											   </div>
											</div>
										 </div>
										 <div class="form-group">
											<label class="control-label col-lg-3">Email *</label>
											<div class="col-lg-9">
											   <div class="col-lg-10 row">
												  <input type="Email" class="form-control" id="email" name="email" value="<?php echo $email ?>" autocomplete="off" required="true">
											   </div>
											</div>
										 </div>
										 										 
										 <div class="form-group">
											<label class="control-label col-lg-3">Handphone *</label>
											<div class="col-lg-9">
											   <div class="col-lg-10 row">
												  <input type="Text" class="form-control" id="mobile_phone" name="mobile_phone" value="<?php echo $mobile_phone ?>" autocomplete="off" required="true">
											   </div>
											</div>
										 </div>
										 <div class="form-group">
											 <label class="control-label col-lg-3">Hubungan *</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
													<input type="Radio" name="relation" value="Father" <?php if ($relation == "Father") echo "Checked" ?> required="true">&nbsp; Ayah
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<input type="Radio" name="relation" value="Mother" <?php if ($relation == "Mother") echo "Checked" ?> required="true">&nbsp; Ibu
												</div>
											 </div>
										 </div>
										 <div class="form-group">
											 <label class="control-label col-lg-3">Jenis Kelamin *</label>
											 <div class="col-lg-9">
												<div class="col-lg-6 row">
													<input type="Radio" name="gender" value="Male" <?php if ($gender == "Male") echo "Checked" ?> required="true">&nbsp; Laki-laki
													&nbsp;
													<input type="Radio" name="gender" value="Female" <?php if ($gender == "Female") echo "Checked" ?> required="true">&nbsp; Perempuan
												</div>
											 </div>
										 </div>
										 <div class="form-group">
											<label class="control-label col-lg-3">Alamat</label>
											<div class="col-lg-9">
											   <div class="col-lg-10 row">
												  <textarea name="address" class="form-control"><?php echo $address ?></textarea>
											   </div>
											</div>
										 </div>
										 
										 <div class="form-group">
											 <label class="control-label col-lg-3"></label>
											 <div class="col-lg-9">
												<div class="col-lg-10 row">
												   <button type="submit" class="btn btn-info">Submit</button>
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
	<div class="col-md-3"></div>
</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {		
		var school_go = [];
		$('#school_id_drop option').each(function() {
			school_go.push( $(this).attr('text') );
		});
		
		$("#school_id_drop").select2({
		  data: school_go
		});
	});
	
</script>