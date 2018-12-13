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
							
							<div class="box-body">
								<div class="row">
									<?php if (isset($classroom) && is_object($classroom) && $classroom != false) { ?>
									<div class="col-lg-6">
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
											</tbody>
										</table>
									</div>
									
									<div class="col-lg-6">
										<table class="table table-bordered">
											<tbody>
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
									</div>
									<?php } ?>
								
									<div class="col-lg-12">&nbsp;</div>
									<div class="col-lg-12">
									<?php if (isset($db_schedule_times) && count($db_schedule_times) > 0) { ?>	 
										<table class="table table-bordered">
											<tbody>
											<tr>
												<td bgcolor="#FCE30C" style="text-align: center">Waktu</td>
												<?php foreach($days as $day) { ?>
												<td bgcolor="#D9E2FC" style="width: 135px; text-align: center">
												  <b><?php echo $day->day_name ?></b>                                               
												</td>
												<?php } ?>
											</tr>
											<?php foreach($db_schedule_times as $k => $db_schedule_time) { ?>
											<tr>
												<td bgcolor="#FFFBB8" style="text-align: center">
												   <b><?php echo "$db_schedule_time->timez_ok - $db_schedule_time->timez_finish" ?></b>
												   <br>
												   (<?php echo $db_schedule_time->lesson_duration ?> min)
												</td>
												<?php
												foreach($db_schedule_time->days as $j => $db_schedule_day)
												{
												   $bgcolor= "#f7f7f7";
												   //if ($db_schedule_day->time_status == 1) $bgcolor= "#C3FCBE";
												   if ($db_schedule_day->time_status == 1) $bgcolor = "$db_schedule_day->cources_colour";
												?>
												   <td bgcolor="<?php echo $bgcolor ?>" style="text-align: left">
													  <b><font color="#cc3300"><?php echo $db_schedule_day->cources_name ?></font></b>
													  <br>
													  <?php echo $db_schedule_day->teacher_name ?>
													  <?php if ($db_schedule_day->cources_religion_id <> 0) { ?>
														<div style="height: 3px"></div>
														<a href="#" data-toggle="modal" data-load-url="classroom/cources_religion/<?php echo $db_schedule_day->cources_religion_id ?>/<?php echo $classroom_id ?>" data-target="#DetailReligion" style="color: #333333; display: block;">
														<span class="btn btn-warning btn-round btn-sm" style="font-size: 10px; margin: 0px; padding: 3px 10px 3px 10px"><i class="fa fa-search" style="font-size: 14px"></i> Details</span>
														</a>
													  <?php } ?>
													  <!---
													  &nbsp;
													  <?php if ($db_schedule_day->time_status == 1) { ?>
													  <a href="#" data-toggle="modal" data-load-url="classroom/send_message/<?php echo $db_schedule_day->teacher_id ?>/<?php echo $student_id ?>/<?php echo $db_schedule_day->cources_id ?>/<?php echo $classroom_id ?>/<?php echo $school_id ?>" data-target="#myModal2" title="Send Message">
													  <button type="button" class="btn btn-info btn-round" style="margin: 0px;"><i class="fa fa-envelope"></i></button></a>
													  <?php } ?>
													  ---->
												   </td>
												<?php } ?>
											</tr>
											<?php } ?>
											
											</tbody>
										</table>
									
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

<!--- Detail Religion --->
<div class="modal fade" id="DetailReligion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog modal-medium">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel"><strong>Jadwal Agama</strong></h5>
			</div>
			<div class="modal-body">
				<div class="instruction">
					<div class="row">
						<div class="col-md-12">
							
						</div>																	  
					</div>
				</div>															  
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-warning btn-round" data-dismiss="modal">Tutup</button>
				<div style="height: 10px"></div>
			</div>
		</div>
	</div>
  </div>

<script type="text/javascript">
	$('#DetailReligion').on('show.bs.modal', function (e) {
		  $('.spinner-bg-web').fadeIn();
		  $('.spinner-img-web').fadeIn();
		  var loadurl = $(e.relatedTarget).data('load-url');
		  $(this).find('.modal-body').load(loadurl);
		  $('.spinner-bg-web').fadeOut();
		  $('.spinner-img-web').fadeOut();
	});
	
    $('#myModal2').on('show.bs.modal', function (e) {
		//$("#iframeId").attr("src", $(this).attr("href"));
		var loadurl = $(e.relatedTarget).data('load-url');
		$(this).find('.modal-body').load(loadurl);
	});
</script>