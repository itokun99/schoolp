
<body>
 
				<div class="row">
					<div class="col-md-12" style="min-height: 150px">
						
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
								 
								 <?php if (isset($message) && is_object($message) && $message != false) { ?>
								 <form class="form-horizontal" id="formClassMessage" action="message/save_messagedb" method="POST" enctype="multipart/form-data">
								 <input type="Hidden" name="message_id" value="<?php echo $message_id ?>">
									<div class="form-body pal">
										<div class="form-group">
										   <label class="control-label col-lg-3">Balas Ke</label>
										   <div class="col-lg-9">
										      <div class="col-lg-12 row">
												  <input type="text" class="form-control" value="<?php echo $message->sender_name ?>" disabled>
											  </div>
										   </div>
										</div>
										<div class="form-group">
										   <label class="control-label col-lg-3">Kelas</label>
										   <div class="col-lg-9">
										      <div class="col-lg-12 row">
												  <input type="text" class="form-control" value="<?php echo $message->classroom_name ?>" disabled>
											  </div>
										   </div>
										</div>
										<div class="form-group">
										   <label class="control-label col-lg-3">Mata Pelajaran</label>
										   <div class="col-lg-9">
										      <div class="col-lg-12 row">
												  <input type="text" class="form-control" value="<?php echo $message->cources_name ?>" disabled>
											  </div>
										   </div>
										</div>
										
										<div class="form-group">
										   <label class="control-label col-lg-3">Pesan</label>
										   <div class="col-lg-9">
										      <div class="col-lg-12 row">
												  <textarea class="form-control" name="message_cont" required="true"></textarea>
											  </div>
										   </div>
										</div>
										<div class="form-group">
										   <label class="control-label col-lg-3"></label>
										   <div class="col-lg-9">
											  <div class="col-lg-12 row">
												 <button id="btnSave" type="submit" class="btn btn-info btn-round">&nbsp;Kirim&nbsp;</button>
												 &nbsp;&nbsp;&nbsp;&nbsp;
												 <button type="button" class="btn btn-warning btn-round" data-dismiss="modal">Batal</button>
											  </div>
										   </div>
										</div>
										
									</div>							   
								</form>
								<?php } else { ?>
								    <br>
									<div class="alert alert-grey" style="padding: 5px;">
										<div style="text-align: center; height: 24px"><font color="#cc3300">Tidak Ada Siswa di Database.</font></div>
								    </div>
									<div style="col-lg-12">&nbsp;</div>
									<div style="text-align: center">
									<button type="button" class="btn btn-warning btn-round" data-dismiss="modal">&nbsp;Tutup&nbsp;</button>
									</div>
								<?php } ?>
								 
							 </div>
									
						
						
					</div>
				</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function() {	
	  var cources_go = [];
	  $('#cources_id_drop option').each(function() {
		  cources_go.push( $(this).attr('text') );
	  });
  
	  $('#cources_id_drop').select2({
		  //dropdownParent: $('#myModal');
		  data: cources_go
	  });
	  
  });
</script>