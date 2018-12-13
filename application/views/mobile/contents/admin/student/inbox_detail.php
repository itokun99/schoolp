							 
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-envelope fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Children Message Detail</h4>
				<div class="row">
					<div class="col-md-12" style="min-height: 400px">
						
						<div class="box-body">
							<div class="row">
								 <?php          
								   $err_message = $this->session->userdata('err_message');
								   $this->session->unset_userdata("err_message");
								 ?>
								 <?php if (isset($err_message) && $err_message <> "") { ?>
								   <div class="alert alert-warning">
									 <center><font color="#ffffff"><?php echo $err_message; ?></font></center>
								   </div>
								 <?php } ?>
								 
								 <div class="col-lg-12">
									<button type="button" class="btn" data-group="btn-link" data-url="<?php url("message/student_inbox"); ?>">Back</button>
								 </div>
								 	 
								 <div class="col-lg-12">
									 <table class="table table-bordered">
										 <tbody>
										 <tr>
											 <td bgcolor="#f7f7f7" width="120"><b>Date</b></td>
											 <td class="col-lg-5"><?php echo $message->datez_ok ?></td>
										</tr>
										<tr>
											 <td bgcolor="#f7f7f7" width="120"><b>Classroom</b></td>
											 <td><?php echo $message->classroom_name ?></td>
										 </tr>

										 <tr>
											 <td bgcolor="#f7f7f7"><b>Sender</b></td>
											 <td><?php echo $message->sender_name ?></td>
										</tr>
										<tr>
											 <td bgcolor="#f7f7f7"><b>Cources</b></td>
											 <td><?php echo $message->cources_name ?></td>
										 </tr>										 
										 <tr>
											 <td bgcolor="#f7f7f7"><b>Message</b></td>
											 <td colspan="3"><?php echo $message->message_cont ?></td>
										 </tr>
										 </tbody>
									 </table>
								 </div>
								 
								 <?php if (isset($reply_messages) && count($reply_messages) > 0) { ?>
								 <div class="col-lg-12">&nbsp;</div>
								 <div class="col-lg-12">
									 <table class="table table-bordered">
										 <tbody>
										 <?php foreach($reply_messages as $reply_message) { ?>
										 <tr bgcolor="#efefef">
											 <td>
												<?php if ($reply_message->read_status == 1) { ?>
													<i class="fa fa-envelope" aria-hidden="true" title="Read"></i>
												<?php } else { ?>
													<i class="fa fa-envelope-o" aria-hidden="true" title="Unread"></i>
												<?php } ?>
												&nbsp;
												<b><?php echo $reply_message->sender_name ?></b></td>
											 <td align="right"><?php echo $reply_message->datez_ok ?>
												
											 </td>
										 </tr>										 
										 <tr>
											 <td colspan="2"><?php echo $reply_message->message_cont ?></td>
										 </tr>
										 <?php } ?>
										 </tbody>
									 </table>
								 </div>
								 <?php } ?>
								 
								 <div class="col-lg-12">
									<button type="button" class="btn" data-group="btn-link" data-url="<?php url("message/student_inbox"); ?>">Back</button>
								 </div>
								 
								 <div class="col-lg-12">&nbsp;</div>

								 
							 </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

