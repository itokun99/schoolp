<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-comments fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Pesan Kepada Guru</h4>
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
								 
								 <?php if (isset($classroom) && is_object($classroom) && $classroom != false) { ?>
								 <form class="form-horizontal" id="formClassMessage" action="message/insert_messagedb" method="POST" enctype="multipart/form-data">
								    <input type="Hidden" name="classroom_id" value="<?php echo $classroom_id ?>">
									<input type="Hidden" name="school_id" value="<?php echo $school_id ?>">
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
										   <label class="control-label col-lg-3">Kelas</label>
										   <div class="col-lg-9">
										      <div class="col-lg-12 row">
												  <input type="text" class="form-control" value="<?php echo $classroom->classroom_name ?>" disabled>
											  </div>
										   </div>
										</div>
										<div class="form-group">
										   <label class="control-label col-lg-3">Guru</label>
										   <div class="col-lg-9">
										      <div class="col-lg-12 row">
												  <select name="teacher_id" id="teacher_id_drop" class="form-control" autocomplete="off" required="yes">
														<option value="">Pilih:</option>
														<option value="">---</option>
													<?php foreach($teachers AS $teacher) { ?>								
														<option value="<?php echo $teacher->memberid ?>"><?php echo "$teacher->fullname ($teacher->member_code)" ?></option>	
													<?php } ?>	
												  </select>
											  </div>
										   </div>
										</div>										
										<div class="form-group">
										   <label class="control-label col-lg-3">Mata Pelajaran</label>
										   <div class="col-lg-9">
										      <div class="col-lg-12 row">
												  <select name="cources_id" id="cources_id_drop" class="form-control" autocomplete="off" required="yes">
														<option value="">Pilih:</option>
														<option value="">---</option>
													<?php foreach($cources AS $cources_ok) { ?>
														<option value="<?php echo $cources_ok->courcesid ?>"><?php echo "$cources_ok->cources_name" ?></option>	
													<?php } ?>	
												  </select>
											  </div>
										   </div>
										</div>										
										<div class="form-group">
										   <label class="control-label col-lg-3">Pesan</label>
										   <div class="col-lg-9">
										      <div class="col-lg-12 row">
												  <textarea class="form-control" name="message_cont" style="height:150px" required="true"></textarea>
											  </div>
										   </div>
										</div>
										<div class="form-group">
										   <label class="control-label col-lg-3"></label>
										   <div class="col-lg-9">
											  <div class="col-lg-12 row">
												 <button id="btnSave" type="submit" class="btn btn-info btn-round">&nbsp;Kirim&nbsp;</button>												 
											  </div>
										   </div>
										</div>
										
									</div>							   
								</form>
								 
								<?php } else { ?>
									<div class="col-lg-12" style="height: 50px"></div>
									<div align='center' class='alert-box info'>Fitur in itidak bisa diakses  <br>karena anda tidak terdaftar di kelas ini.</div>
								<?php } ?>
								
								 
							 </div>
									
						
						
					    </div>
					</div>
			</div>
		</div>
	</div>
</div>                 

<script type="text/javascript">
  $(document).ready(function() {	
	  $('#teacher_id_drop').select2();
	  $('#cources_id_drop').select2();
	  
  });
</script>