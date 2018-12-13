<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-envelope fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Pesan Anak</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
								
								<div style="height: 10px"></div>
									<?php if (isset($messages) && count($messages) > 0) { ?>
										
										<table id="reportTables" class="table" cellspacing="0" width="100%">
										  <thead>
											<tr>											 
											  <th style="width: 0px; height: 0px; visibility: hidden;"></th>
											</tr>
										  </thead>
										  <tbody>
											<?php foreach($messages as $message) { ?>
											<tr>
												<td>
													<table class="table table-bordered" cellspacing="0" width="100%">
														<tr>
															<td bgcolor="#efefef" style="width: 100px;">Tanggal</td>
															<td>
																<a href="message/student_inbox_detail/<?php echo $message->messageid ?>/<?php echo $student_id ?>/<?php echo $school_id ?>" style="color: #333333; ">
																<?php echo $message->datez_ok ?>
																</a>
															</td>
														</tr>
														<tr>
															<td bgcolor="#efefef">Dari</td>
															<td>
																<a href="message/student_inbox_detail/<?php echo $message->messageid ?>/<?php echo $student_id ?>/<?php echo $school_id ?>" style="color: #333333; display: block">
																<?php echo $message->sender_name ?>
																<br>
																<font color="#bbbbbb"><?php echo $message->member_type_text ?></font>
																</a>
															</td>
														 </tr>			
														 <tr>
															<td bgcolor="#efefef">Pesan</td>
															<td>
																<a href="message/student_inbox_detail/<?php echo $message->messageid ?>/<?php echo $student_id ?>/<?php echo $school_id ?>" style="color: #333333; display: block">
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
															<td bgcolor="#efefef">Balas</td>
															<td>
																<?php if ($message->reply_status == 1) { ?>
																	<i class="fa fa-envelope" aria-hidden="true"></i>
																<?php } else { ?>
																	<i class="fa fa-envelope-o" aria-hidden="true"></i>
																<?php } ?>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<?php } ?>
										  </tbody>
										</table>
										
									<?php } else { ?>										
										<div align='center' class='alert-box info'>Tidak Ada Data di Database.</div>
									<?php } ?>	
							
                        </div>
					</div>
			</div>
		</div>
	</div>
</div>                 
  