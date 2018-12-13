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
								
									<?php if (isset($messages) && count($messages) > 0) { ?>
										
										<table id="reportTables" class="table table-bordered" cellspacing="0" width="100%">
										  <thead>
											<tr>
											  <th style="width: 90px; text-align: center">Tanggal</th>
											  <th style="width: 120px; text-align: center">Dari</th>
											  <th style="text-align: center">Pesan</th>
											  <th style="width: 150px; text-align: center">Kelas</th>
											  <th style="width: 150px; text-align: center">Mata Pelajaran</th>
											  <th style="width: 50px; text-align: center">Balas</th>
											</tr>
										  </thead>
										  <tbody>
											<?php foreach($messages as $message) { ?>
											<tr>
											  <td style="text-align: center" data-order="<?php echo $message->datez ?>">											    
												<a href="message/student_inbox_detail/<?php echo $message->messageid ?>/<?php echo $student_id ?>/<?php echo $school_id ?>" style="color: #333333; display: block">
												<?php echo $message->datez_ok ?>
												</a>
											  </td>
											  <td style="text-align: center">
												<a href="message/student_inbox_detail/<?php echo $message->messageid ?>/<?php echo $student_id ?>/<?php echo $school_id ?>" style="color: #333333; display: block">
												<?php echo $message->sender_name ?>
												<br>
												<font color="#bbbbbb"><?php echo $message->member_type_text ?></font>
												</a>
											  </td>
											  <td>
												<a href="message/student_inbox_detail/<?php echo $message->messageid ?>/<?php echo $student_id ?>/<?php echo $school_id ?>" style="color: #333333; display: block">
												<?php echo word_limiter(strip_tags($message->message_cont), 10); ?>
												</a>
											  </td>
											  <td style="text-align: center"><?php echo $message->classroom_name ?></td>
											  <td style="text-align: center"><?php echo $message->cources_name ?></td>
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
  