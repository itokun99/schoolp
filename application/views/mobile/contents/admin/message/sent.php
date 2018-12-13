<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-envelope fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Pesan</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 800px">
						    
							<div class="box-body">
								<div class="row">
							
									<div class="nav-center">
										<ul class="nav nav-pills nav-pills-info nav-pills-icons" id="prodTabs">
											<li>
												<a href="message/inbox"><i class="fa fa-inbox" style="padding: 5px"></i>Pesan Masuk</a>
											</li>
											<li class="active">
												<a href="message/sent"><i class="fa fa-paper-plane" aria-hidden="true" style="padding: 5px"></i>Terkirim</a>
											</li>
										</ul>
									</div>
									
									<div class="col-lg-12">&nbsp;</div>
							
									<div class="col-lg-12" style="text-align:center">
									<form name="frm" id="formSearch" action="message/sent" method="POST">
										<input type="Hidden" name="menu_message" value="1">
										<div class="form-group">
											<input type="Text" name="date_from" value="<?php echo $date_from ?>" autocomplete="off" id="dtpickerfrom" class="form-control" style="width: 100px; display: inline">
											&nbsp;-&nbsp;
											<input type="Text" name="date_to" value="<?php echo $date_to ?>" autocomplete="off" id="dtpickerto" class="form-control" style="width: 100px; display: inline">
											&nbsp;&nbsp;
											<button id="btnSearch" type="submit" class="btn btn-info btn-round">&nbsp;&nbsp; GO &nbsp;&nbsp;</button>
											
										</div>
									</form>										
									</div>
																		
									<div class="col-lg-12">
									<?php if (isset($messages) && count($messages) > 0) { ?>	
										
										<table id="reportTables" class="table table-bordered" cellspacing="0" width="100%">										
										  <thead>
											<tr>
												<th style="width: 0px; height: 0px; visibility: hidden;"></th>
											</tr>
										  </thead>

										  <tbody>
											<?php foreach($messages as $message) { ?>
											<tr>
												<td>
													<table class="table" cellspacing="0" width="100%">
														<tr>
															<td bgcolor="#efefef" style="width: 100px;">Tanggal</td>
															<td>
																<a href="message/sent_detail/<?php echo $message->messageid ?>/<?php echo $message->messageid ?>" style="color: #333333; display: block">
																<?php echo $message->datez_ok ?>
																</a>
															</td>
														</tr>
			
														<tr>
															<td bgcolor="#efefef">Dari</td>
															<td>
																<a href="message/sent_detail/<?php echo $message->messageid ?>/<?php echo $message->messageid ?>" style="color: #333333; display: block">
																<?php echo $message->recipient_name ?>
																<br>
																<font color="#bbbbbb"><?php echo $message->member_type_text ?></font>
																</a>
															</td>
														</tr>
			
														<tr>
															<td bgcolor="#efefef">Pesan</td>
															<td>
																<a href="message/sent_detail/<?php echo $message->messageid ?>/<?php echo $message->messageid ?>" style="color: #333333; ">
																<?php echo word_limiter(strip_tags($message->message_cont), 10); ?>
																</a>
															</td>
														</tr>
			
														<tr>
															<td bgcolor="#efefef">Kelas</td>
															<td><?php echo $message->classroom_name ?></td>
														</tr>
			
														<tr>
															<td bgcolor="#efefef">Mata Pelajaran</td>
															<td><?php echo $message->cources_name ?></td>
														</tr>
														
														<tr>
															<td bgcolor="#efefef">Baca</td>
															<td>
																<?php if ($message->read_status == 1) { ?>
																	<i class="fa fa-envelope" aria-hidden="true" title="Read"></i>
																<?php } else { ?>
																	<i class="fa fa-envelope-o" aria-hidden="true" title="Unread"></i>
																<?php } ?>
															</td>
														</tr>
														
														<tr>
															<td colspan="2" align="right">
																<a href="message/sent_detail/<?php echo $message->messageid ?>/<?php echo $message->messageid ?>" class="btn btn-info btn-round">Detail</a>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<?php } ?>
										  </tbody>
										</table>
									<?php } else { ?>										
										<div align='center' class='alert-box info'>Tidak Ada Pesan di Database.</div>
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