<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-comments fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Saran</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
						
							<div class="box-body">
								 <?php          
								   $err_message = $this->session->userdata('err_message');
								   $this->session->unset_userdata("err_message");
								 ?>
								 <?php if (isset($err_message) && $err_message <> "") { ?>
								   <div class="alert alert-warning">
									 <center><font color="#ffffff"><?php echo $err_message; ?></font></center>
								   </div>
								 <?php } ?>
								 
								 <?php if (isset($school) && is_object($school) && $school != false) { ?>
								 <form class="form-horizontal" id="formClassMessage" action="suggestion/insert_db" method="POST" enctype="multipart/form-data">
								 <input type="Hidden" name="school_id" value="<?php echo $school_id ?>">
								 <input type="Hidden" name="student_id" value="<?php echo $student_id ?>">
									<div class="form-body pal">
										<div class="form-group">
										   <label class="control-label col-lg-3">Sekolah</label>
										   <div class="col-lg-9">
										      <div class="col-lg-12 row">
												  <input type="text" class="form-control" value="<?php echo $school->school_name ?>" disabled>
											  </div>
										   </div>
										</div>
										<div class="form-group">
										   <label class="control-label col-lg-3">Saran</label>
										   <div class="col-lg-9">
										      <div class="col-lg-12 row">
												  <textarea class="form-control" name="suggestion_cont" required="true" style="height:150px"></textarea>
											  </div>
										   </div>
										</div>
										<div class="form-group">
										   <label class="control-label col-lg-3"></label>
										   <div class="col-lg-9">
											  <div class="col-lg-12 row">
												 <button id="btnSave" type="submit" class="btn btn-info btn-round" style="padding: 7px 15px 7px 15px">Simpan</button>
												 
											  </div>
										   </div>
										</div>
										
									</div>							   
								</form>
								<?php } else { ?>
								    <br>
									<div class="alert alert-grey" style="padding: 5px;">
										<div style="text-align: center; height: 24px"><font color="#cc3300">Tidak Ada Data di Database.</font></div>
								    </div>
								<?php } ?>
								 
							 </div>
									
						</div>
					</div>
			</div>
		</div>
	</div>
</div>                 