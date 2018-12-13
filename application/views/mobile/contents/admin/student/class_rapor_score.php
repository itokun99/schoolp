<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-bar-chart fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Nilai Rapor</h4>
					<div class="row">
						<div  style="min-height: 400px">
							<?php if (isset($dataDetails) && count($dataDetails) > 0) { ?>
								<div class="material-datatables col-lg-12">
									<table id="reportTables" class="table " cellspacing="0" width="100%">
										<thead>
											<tr>
											  <th style="width: 0px; height: 0px; visibility: hidden;">
											  </th>
											</tr>
										  </thead>
										  <tbody>
											<?php
											foreach($dataDetails AS $j => $dataDetail)
											{
												if ($dataDetail->final_score < 6) $fontcolor = "#cc3300"; else $fontcolor = "#333333";
											?>
											<tr>
												<td>
													<table class="table table-bordered" cellspacing="0" width="100%">
														<tr>
															<td bgcolor="#dddddd" style="width: 100px; ">Mata Pelajaran</td>
															<td><?php echo "$dataDetail->cources_name" ?></td>
														</tr>
			
														  <?php
														  foreach($dataDetail->type_exam AS $k => $student_score)
														  {
															  if ($student_score->score_exam == 0) $fontcolorsc = "#cc3300"; else $fontcolorsc = "#333333";
															  if ($student_score->score_status == 2) $bgcolor = "#D4FECA"; else $bgcolor = "#ffffff";
															  if ($dataDetail->scoring_percent < 100) $fontcolor2 = "#cc3300"; else $fontcolor2 = "#333333";
														  ?>
														  <?php if ($student_score->score_exam <> 0) { ?>
														  <tr>
															<td bgcolor="#efefef"><?php echo "$student_score->type_name" ?></th>
															<td bgcolor="<?php echo $bgcolor ?>" style="color: <?php echo $fontcolorsc ?>"><?php if ($student_score->score_exam <> 0) echo number_format($student_score->score_exam, 2); else echo "-" ?></td>
														  </tr>
														  <?php } ?>
														  <?php } ?>
			
														  <tr>
															<td bgcolor="#dddddd">Penilaian</td>
															<td style="background: #D4FECA; color: <?php echo $fontcolor2 ?>"><?php echo number_format($dataDetail->scoring_percent) ?> %</td>
														  </tr>
			
														  <tr>
															<td bgcolor="#dddddd">Akhir</td>
															<td style="background: #FBFECA; color: <?php echo $fontcolor ?>">
															  <?php
																if ($dataDetail->scoring_percent < 100) echo "-";
																else echo number_format($dataDetail->final_score, 2)
															  ?>
															</td>
														  </tr>
			
														  <tr>
															<td bgcolor="#dddddd">Rata-rata</td>
															<td>	
															  <?php
																if ($dataDetail->scoring_percent < 100) echo "-";
																else echo number_format($dataDetail->class_average_score, 2)
															  ?>
															</td>
														</tr>
													</table>
												</td>
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
