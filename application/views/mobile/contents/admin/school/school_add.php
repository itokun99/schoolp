<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-plus fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Sekolah Anak</h4>
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
											 <label class="control-label col-lg-2">Sekolah</label>
											 <div class="col-lg-10">
												<div class="col-lg-8 row">
													<select name="school_id" id="school_id_drop" class="form-control" autocomplete="off" required="yes">
														  <option value="">Pilih:</option>
														  <option value="">---</option>
													  <?php foreach($schools AS $school) { ?>
														  <option value="<?php echo $school->schoolid ?>"><?php echo "$school->school_name" ?></option>	
													  <?php } ?>	
													</select>
												</div>
											 </div>
										  </div>
										  <div class="form-group">
											 <label class="control-label col-lg-2">NIK Anak</label>
											 <div class="col-lg-10">
												<div class="col-lg-8 row">
												   <input type="text" class="form-control" id="inputCode" name="children_code" autocomplete="off" required="true" />
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
		var school_go = [];
		$('#school_id_drop option').each(function() {
			school_go.push( $(this).attr('text') );
		});
		
		$("#school_id_drop").select2({
		  data: school_go
		});
	});
	
</script>
	