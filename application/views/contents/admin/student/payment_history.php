<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-money fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">School Fees</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
							
							<table width="100%">
								<tr style="padding: 0px">
									<td align="right">
										<form name="frm" id="formSearch" action="fee/history_payment/<?php echo $student_id ?>/<?php echo $school_id ?>" method="POST">
											<div class="form-group">
												<table id="datatable">
													<tbody>
														<tr>
															<td style="width: 45px; text-align: left">Year</td>
															<td>																		
																<select name="year_ok" class="form-control" style="width: 80px; display: inline;" autocomplete="off" required="yes">															
																  <?php for ($i = 2017; $i <= 2050; $i++) { ?>								
																	  <option value="<?php echo $i ?>" <?php if ($year_ok == $i) echo "Selected" ?>><?php echo $i ?></option>	
																  <?php } ?>	
																</select>
															</td>
															<td style="width: 20px;"></td>
															<td style="width: 60px;">
																<button id="btnSearch" type="submit" class="btn btn-info btn-round">&nbsp;&nbsp; GO &nbsp;&nbsp;</button>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</form>
									</td>
								</tr>
							</table>
																						
							<?php if (isset($dataDetails) && count($dataDetails) > 0) { ?>
							<div class="material-datatables">
								<table class="table table-bordered" cellspacing="0" width="100%">
								  
								  <thead>
									<tr bgcolor="#C3FCBE">
									  <th class="col-lg-2" style="text-align: center">Month</th>
									  <th class="col-lg-2" style="text-align: center">Student Fee</th>
									  <th class="col-lg-2" style="text-align: center">Payment Status</th>
									</tr>
								  </thead>
								  <tbody>
									<?php
									  $data_month = $dataDetails->months;											  
									?>
									<?php for ($j = 1; $j <= 12; $j++) { ?>
									<tr>
									  <td style="text-align: left" data-order="<?php echo $data_month[$j]->month_id ?>"><?php echo $data_month[$j]->month_name ?></td>
									  <td style="text-align: center"><?php echo number_format($data_month[$j]->student_fee) ?></td>
									  <td style="text-align: center">
											<?php if ($data_month[$j]->payment_status == 1) { ?>
												<i class="fa fa-check" style="color: #cc3300"></i>
											<?php } else { ?>
												-
											<?php } ?>
									  </td>
									</tr>											
									<?php } ?>
								  </tbody>
								</table>
								
							</div>
						
							<?php } ?>
							
						</div>
					</div>
			</div>
		</div>
	</div>
</div>                 