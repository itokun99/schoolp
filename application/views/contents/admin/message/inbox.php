<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-envelope fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Pesan</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
						    
							<div class="nav-center">
								<ul class="nav nav-pills nav-pills-info nav-pills-icons" id="prodTabs">
									<li class="active">
										<a href="message/inbox"><i class="fa fa-inbox" style="padding: 5px"></i>Pesan Masuk</a>
									</li>
									<li>
										<a href="message/sent"><i class="fa fa-paper-plane" aria-hidden="true" style="padding: 5px"></i>Terkirim</a>
									</li>
								</ul>
							</div>
							
							<div class="col-lg-12" style="height: 10px"></div>
							
									<div class="col-lg-3"></div>
									<div class="col-lg-6">
									<form name="frm" id="formSearch" action="message/inbox" method="POST">
										<input type="Hidden" name="menu_message" value="1">
										<div class="form-group">
											<table id="datatable">
												<tbody>
													<tr bgcolor="#efefef">
														<td style="width: 80px; text-align: center">Tanggal</td>
														<td>
															<input type="Text" name="date_from" value="<?php echo $date_from ?>" autocomplete="off" id="dtpickerfrom" class="form-control" style="width: 100px; display: inline">
															&nbsp;-&nbsp;
															<input type="Text" name="date_to" value="<?php echo $date_to ?>" autocomplete="off" id="dtpickerto" class="form-control" style="width: 100px; display: inline">															
														</td>
														<td style="width: 20px;"></td>
														<td style="width: 80px;">
															<button id="btnSearch" type="submit" class="btn btn-info btn-round">&nbsp;&nbsp; GO &nbsp;&nbsp;</button>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</form>
										
									</div>
									<div class="col-lg-3"></div>
									<div class="col-lg-12" style="height: 10px"></div>
										
									<div class="col-lg-12">
									<?php if (isset($messages) && count($messages) > 0) { ?>											
										
										<table id="reportTables" class="table table-bordered" cellspacing="0" width="100%">
										  <thead>
											<tr>
											  <th style="width: 90px; text-align: center">Tanggal</th>
											  <th style="width: 120px; text-align: center">Dari</th>
											  <th style="text-align: center">Pesan</th>
											  <th style="width: 100px; text-align: center">Kelas</th>
											  <th style="width: 100px; text-align: center">Mata Pelajaran</th>
											  <th style="width: 100px; text-align: center">Sekolah</th>
											  <th style="width: 50px; text-align: center">Balas</th>
											</tr>
										  </thead>
										  <tbody>
											<?php foreach($messages as $message) { ?>
											<tr>
											  <td style="text-align: center" data-order="<?php echo $message->datez ?>">											    
												<a href="message/inbox_detail/<?php echo $message->messageid ?>/<?php echo $message->reply_message_id ?>" style="color: #333333; display: block">
												<?php if ($message->read_status == 0) echo "<b>" ?>
												<?php echo $message->datez_ok ?>
												</a>
											  </td>
											  <td style="text-align: center">
												<a href="message/inbox_detail/<?php echo $message->messageid ?>/<?php echo $message->reply_message_id ?>" style="color: #333333; display: block">
												<?php if ($message->read_status == 0) echo "<b><font color='#cc3300'>" ?>
												<?php echo $message->sender_name ?>
												<br>
												<font color="#bbbbbb"><?php echo $message->member_type_text ?></font>
												</a>
											  </td>
											  <td>
												<a href="message/inbox_detail/<?php echo $message->messageid ?>/<?php echo $message->reply_message_id ?>" style="color: #333333; display: block">
												<?php if ($message->read_status == 0) echo "<b><font color='#cc3300'>" ?>
												<?php echo word_limiter(strip_tags($message->message_cont), 10); ?>
												</a>
											  </td>
											  <td style="text-align: center">
											    <?php echo $message->classroom_name ?>
											  </td>
											  <td style="text-align: center">
											    <?php echo $message->cources_name ?>
											  </td>
											  <td style="text-align: center">
											    <?php echo $message->school_name ?>
											  </td>
											  <td style="text-align: center">
												<?php if ($message->reply_status == 1) { ?>
													<i class="fa fa-envelope" aria-hidden="true"></i>
												<?php } else { ?>
													<i class="fa fa-envelope-o" aria-hidden="true"></i>
												<?php } ?>
											  </td>
											</tr>
											<?php } ?>
										  </tbody>
										</table>
										
									<?php } else { ?>										
										<div align='center' class='alert-box info'>Tidak Ada Pesan di Databse.</div>
									<?php } ?>	
									</div>
								</div>
									
										  
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

		


<link rel="stylesheet" type="text/css" href="assets/css/jquery.datetimepicker.css" />
<script type="text/javascript" src="assets/js/jquery.datetimepicker.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
		$('#dtpickerfrom').datetimepicker({
			datepicker:true,
			timepicker:false,
			format:'d-m-Y'
		});
		
		$('#dtpickerto').datetimepicker({
			datepicker:true,
			timepicker:false,
			format:'d-m-Y'
		});
		
	});
</script>