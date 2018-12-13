<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-bar-chart fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Nilai Rapor</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
							
								<form name="frmSemester" id="formSearch2" action="classroom/class_rapor_score" method="POST">
									<div class="form-group">
										<table id="datatable">
											<tbody>
												<tr bgcolor="#efefef">
													<td style="width: 10px; text-align: center"></td>
													<td>
														<select name="semester_id" id="semester_id_drop" class="form-control" style="width: 160px; display: inline" autocomplete="off">
															<option value="-1" <?php if ($semester_id == -1) echo "Selected" ?>>Pilih Semester</option>
															<?php foreach($semesters AS $semester) { ?>
																<option value="<?php echo $semester->semesterid ?>" <?php if ($semester_id == $semester->semesterid) echo "Selected" ?>><?php echo $semester->semester_name ?></option>	
															<?php } ?>	
														</select>
													</td>
													<td style="width: 20px;"></td>
													<td style="width: 80px;">
														<button id="btnSearch" type="submit" class="btn btn-info">&nbsp;&nbsp; GO &nbsp;&nbsp;</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</form>										
								
								<?php if (isset($semester_id) && $semester_id <> -1) { ?>
								
									<?php if ($classroom->promote_status <> 0) { ?>
	
										<?php if (isset($dataDetails) && count($dataDetails) > 0) { ?>
											<table id="scoreTables" class="table table-bordered" cellspacing="0" width="100%">
											  <thead>
												<tr>
												  <th bgcolor="#dddddd" style="width: 250px; text-align: center">Mata Pelajaran</th>
												  <?php foreach($type_exams AS $j => $type_exam) {  ?>
												  <th bgcolor="#efefef" style="width: 40px; text-align: center"><?php echo "$type_exam->type_name" ?></th>
												  <?php } ?>
												  <th bgcolor="#dddddd" style="width: 50px; text-align: center">Nilai Akhir</th>
												  <th bgcolor="#dddddd" style="width: 50px; text-align: center">Rata-rata</th>
												</tr>
											  </thead>
											  <tbody>
												<?php
												foreach($dataDetails AS $j => $dataDetail)
												{
													if ($dataDetail->final_score < 6) $fontcolor = "#cc3300"; else $fontcolor = "#333333";
												?>
												<tr>
												  <td><?php echo "$dataDetail->cources_name" ?></td>
												  <?php
												  foreach($dataDetail->type_exam AS $k => $student_score)
												  {
													  if ($student_score->score_exam == 0) $fontcolorsc = "#cc3300"; else $fontcolorsc = "#333333";
													  if ($student_score->score_status == 2) $bgcolor = "#D4FECA"; else $bgcolor = "#ffffff";
													  if ($dataDetail->scoring_percent < 100) $fontcolor2 = "#cc3300"; else $fontcolor2 = "#333333";
												  ?>
												  <td bgcolor="<?php echo $bgcolor ?>" style="text-align: center; color: <?php echo $fontcolorsc ?>"><?php if ($student_score->score_exam <> 0) echo number_format($student_score->score_exam, 2); else echo "-" ?></td>
												  <?php } ?>
												  <td style="text-align: center; background: #FBFECA; color: <?php echo $fontcolor ?>">
													  <?php
														if ($dataDetail->scoring_percent < 100) echo "-";
														else echo number_format($dataDetail->final_score, 2)
													  ?>
												  </td>
												  <td style="text-align: center; background: #D4FECA">													
													  <?php
														if ($dataDetail->scoring_percent < 100) echo "-";
														else echo number_format($dataDetail->class_average_score, 2)
													  ?>
												  </td>
												</tr>
												<?php } ?>															   
											  </tbody>
											</table>
											
											<?php if ($classroom->promote_status <> 0) { ?>
											<div class="col-lg-12">&nbsp;</div>
											<div class="row">
												<div class="col-lg-6">
													<table class="table table-bordered">
														<tbody>
														<?php if ($classroom->promote_status > 0) { ?>
														<tr>
															<td bgcolor="#D4FECA" width="140"><b>Status</b></td>
															<td style="color: #cc3300">
																<b><?php echo $classroom->promote_text ?></b>
															</td>
														</tr>
														<?php } ?>
														<?php if ($classroom->promote_ranking <> 0) { ?>
														<tr>
															<td bgcolor="#efefef" width="140"><b>Peringkat</b></td>
															<td>
																<b><?php echo $classroom->promote_ranking ?></b>
															</td>
														</tr>
														<?php } ?>
														<tr>
															<td bgcolor="#FBFECA" width="140"><b>Kritik & Saran</b></td>
															<td>
																<?php echo $classroom->description_text ?>
															</td>
														</tr>
														</tbody>
													</table>
												</div>
											</div>
											<?php } ?>
											
											<br>
											<div class="col-lg-12" style="text-align: right">
											<a href="classroom/print_rapor/<?php echo $semester_id ?>" title="Cetak Nilai Rapor" style="color: #cc3300"><span class="btn btn-info btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp; Cetak Nilai Rapor</span></a>
											</div>
										
										<?php } else { ?>
											<div align='center' class='alert-box info'>Tidak Ada Data di Database.</div>
										<?php } ?>
										
									<?php } else { ?>
										<div align='center' class='alert-box info'>Rapor belum diterbitkan oleh Wali Kelas.</div>
									<?php } ?>
								
								<?php } else { ?>
									<div align='center' class='alert-box info'><font color="#cc3300">Silakan Pilih Semester Terlebih Dahulu.</font></div>
								<?php } ?> 
		
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
