<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-clock-o fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Jadwal Kelas</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
							<?php if (isset($classroom) && is_object($classroom) && $classroom != false) { ?>
								<table class="table table-bordered">
									<tbody>
									<tr>
										<td bgcolor="#f7f7f7" width="140"><b>Kelas</b></td>
										<td><?php echo $classroom->classroom_name ?></td>
									</tr>
									<tr>
										<td bgcolor="#f7f7f7"><b>Tahun Ajaran</b></td>
										<td><?php echo $classroom->scyear_name ?></td>
									</tr>
									<tr>
										<td bgcolor="#f7f7f7" width="140"><b>Tingkatan Kelas</b></td>
										<td><?php echo $classroom->edulevel_name ?></td>
									</tr>
									<tr>
										<td bgcolor="#f7f7f7"><b>Wali Kelas</b></td>
										<td><?php echo $classroom->teacher_name ?></td>
									</tr>
									</tbody>
								</table>							
						   
								<?php $x = 1; ?>		
								<?php if (isset($days) && count($days) > 0) { ?>
								  <?php foreach($days as $day) { ?>							 
								  <div class="panel panel-default" style="margin: 0px">
									  <div class="panel-heading" role="tab" id="headingTwo">
										  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $x ?>" aria-expanded="false" aria-controls="collapseTwo">
											  <h4 class="panel-title">
												<div style="display: inline-block; width: 120px; text-align: center; color: #ffffff; background: #7958C5; padding: 5px 10px 5px 10px;">
												<b><?php echo $day->day_name ?></b>
												</div>
												<i class="material-icons">keyboard_arrow_down</i>
											  </h4>
										  </a>
									  </div>
									  <div id="collapseTwo<?php echo $x ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
										  <div class="panel-body">
											  <?php if (isset($day->schedule_class) && count($day->schedule_class) > 0) { ?>
											  <div style="height: 10px"></div>
											  <table id="userTables" class="table table-bordered" cellspacing="0" width="100%">														
												   <tbody>
													 <?php foreach($day->schedule_class as $k => $db_schedule_time) { ?>
													 <tr>
													   <td>																	
														   <table class="table" cellspacing="0" width="100%">																		
															   <tr>
																   <td bgcolor="<?php echo $db_schedule_time->cources_colour ?>" style="width: 100px;">Waktu</td>
																   <td>
																	   <b><?php echo "$db_schedule_time->timez_ok - $db_schedule_time->timez_finish" ?></b>
																	   (<?php echo $db_schedule_time->lesson_duration ?> min)
																   </td>
															   </tr>
															   <tr>
																   <td bgcolor="<?php echo $db_schedule_time->cources_colour ?>">Mata Pelajaran</td>
																   <td style="text-align: left">
																	 <?php echo $db_schedule_time->cources_name ?>
																   </td>
															   </tr>
															   <tr>
																   <td bgcolor="<?php echo $db_schedule_time->cources_colour ?>">Guru</td>
																   <td style="text-align: left">
																	 <?php echo $db_schedule_time->teacher_name ?>
																   </td>
															   </tr>
															   
														   </table>
														   
													   </td>
													 </tr>
													 <?php } ?>
													   
												   </tbody>
											   </table>
											   <?php } else { ?>										
													<div align='center' class='alert-box info'>Tidak Ada Jadwal Hari Ini
											   <?php } ?>
											  
										  </div>
									  </div>
								  </div>
								  <?php $x = $x + 1; } ?>
								  
								<?php } else { ?>										
								  <div align='center' class='alert-box info'>Tidak Ada Jadwal di Kelas Ini.</div>
								<?php } ?>
							
							<?php } else { ?>
								<div class="col-lg-12" style="height: 50px"></div>
								<div align='center' class='alert-box info'>Tidak Ada Jadwal di Database.</div>
							<?php } ?>
						
						</div>
					</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog modal-big">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel"><strong>Kirim Pesan</strong></h5>
			</div>
			<div class="modal-body">
				<div class="instruction">
					<div class="row">
						
					</div>
				</div>															  
			</div>
			
		</div>
	</div>
</div>

<script type="text/javascript">
    $('#myModal2').on('show.bs.modal', function (e) {
		//$("#iframeId").attr("src", $(this).attr("href"));
		var loadurl = $(e.relatedTarget).data('load-url');
		$(this).find('.modal-body').load(loadurl);
	});
</script>