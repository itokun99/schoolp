<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-list-alt fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Absensi Siswa</h4>
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
								
								<div style="height: 10px"></div>
								
								<form name="frm" id="formSearch" action="classroom/class_attendance" method="POST">
									<div class="form-group">
										<table id="datatable">
											<tbody>
												<tr>
													<td>
														<select name="month_ok" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">															
														<?php for ($i = 1; $i <= 12; $i++)
														{
															 $monthName = date("M", mktime(0, 0, 0, $i, 10));
														?>								
															<option value="<?php echo $i ?>" <?php if ($month_ok == $i) echo "Selected" ?>><?php echo $monthName ?></option>	
														<?php } ?>	
													  </select>&nbsp;
													  <select name="year_ok" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">															
														<?php for ($i = 2017; $i <= 2050; $i++) { ?>								
															<option value="<?php echo $i ?>" <?php if ($year_ok == $i) echo "Selected" ?>><?php echo $i ?></option>	
														<?php } ?>	
													  </select>
													</td>
													<td style="width: 10px;"></td>
													<td style="width: 50px;">
														<button id="btnSearch" type="submit" class="btn btn-info btn-round">&nbsp; GO &nbsp;</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</form>
																 
								 <?php $x = 1; ?>		
								 <?php if (isset($dataDetails) && count($dataDetails) > 0) { ?>
										<table id="attendTables" class="table table-bordered" cellspacing="0" width="100%">
										  <thead>
											<tr>
											  <th style="text-align: center">Waktu</th>
											  <th style="width: 45px; text-align: center">Hadir</th>
											  <th style="width: 50px; text-align: center"><i class="fa fa-bed" style="color: #fffff" title="Leave & Sick"></i></th>
											</tr>
										  </thead>
										  <tbody>
											<?php foreach($dataDetails as $k => $dataDetail) { ?>
											<tr>
											  <td><?php echo "$dataDetail->timez_ok - $dataDetail->timez_finish" ?></td>
											  <td style="text-align: center"><?php echo "$dataDetail->total_attendance" ?></td>
											  <td style="text-align: center"><?php echo "$dataDetail->total_leave_sick" ?></td>
											</tr>
											<?php } ?>
										
										  </tbody>
										</table>										
								 </div>	 
	
								 <?php } else { ?>										
									<div align='center' class='alert-box info'>Tidak Ada Data di Database.</div>
								 <?php } ?>
								 
							<?php } else { ?>							
								<div class="col-lg-12" style="height: 50px"></div>
								<div align='center' class='alert-box info'>Tidak Ada Data di Database.</div>
							<?php } ?>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
	
