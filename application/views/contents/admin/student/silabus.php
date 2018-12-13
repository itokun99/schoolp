<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-book fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Silabus</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 800px">
						    
							<?php          
								$err_message = $this->session->userdata('err_message');
								$this->session->unset_userdata("err_message");
							?>
							<table id="datatable" width="100%">
								<tr>
								  <td><?php if (isset($err_message)) echo $err_message; ?></td>
								</tr>
							</table>
							
							<div class="box-body">
								<div class="x_panel no-border">
									
									<?php if (isset($dataDetails) && count($dataDetails) > 0) { ?>
									<div class="material-datatables">
										<table id="userTables2" class="table table-bordered" cellspacing="0" width="100%">
										  <thead>
											<tr>
											  <th style="width: 100px; text-align: center">Tanggal</th>
											  <th style="text-align: center">Mata Pelajaran</th>
											  <th style="width: 80px; text-align: center">File</th>
											  <th style="width: 180px; text-align: center">Guru</th>
											</tr>
										  </thead>
										  <tbody>
											<?php foreach($dataDetails as $data) { ?>
											<tr>
											  <td style="text-align: center" data-order="<?php echo $data->datez ?>"><?php echo $data->datez_ok ?></td>
											  <td style="text-align: left"><?php echo $data->cources_name ?></td>
											  <td style="text-align: center; margin: 0px">
													<?php if ($data->silabus_file <> "") { ?>
													<a href="<?php echo $this->session->userdata("link_school") ?>/assets/images/silabus/<?php echo "$data->silabus_file" ?>" target="_blank" style="color: #333333;"><i class="fa fa-file-o fa-2x"></i><div style="font-size: 11px">File</div></a>
													<?php } else echo "-" ?>
											  </td>
											  <td style="text-align: center"><?php echo $data->teacher_name ?></td>
											</tr>
											<?php } ?>
										  </tbody>
										</table>
									</div>
								
									<?php } else { ?>										
										<div align='center' class='alert-box info'>Tidak Ada Data di Database.</div>
									<?php } ?>
								</div>
							</div>
							
										  
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


                  