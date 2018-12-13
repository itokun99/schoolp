							 
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-envelope fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Detail Pesan Anak</h4>
				<div class="row">
					<div class="col-md-12" style="min-height: 400px">
						
							<div class="box-body">
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
									<button type="button" class="btn" data-group="btn-link" data-url="<?php url("message/student_inbox"); ?>">Kembali</button>
								 </div>
								 	 
								 <div class="col-lg-12">
									 <table class="table table-bordered">
										 <tbody>
										 <tr>
											 <td bgcolor="#f7f7f7" width="120"><b>Tanggal</b></td>
											 <td class="col-lg-5"><?php echo $message->datez_ok ?></td>
											 <td bgcolor="#f7f7f7" width="120"><b>Mata Pelajaran</b></td>
											 <td><?php echo $message->cources_name ?></td>											 
										 </tr>
										 <tr>
											 <td bgcolor="#f7f7f7"><b>Pengirim</b></td>
											 <td><?php echo $message->sender_name ?></td>
											 <td bgcolor="#f7f7f7"><b><?php if ($message->classroom_name <> "-") echo "Kelas" ?></b></td>
											 <td><?php if ($message->classroom_name <> "-") echo $message->classroom_name ?></td>
										 </tr>										 
										 <tr>
											 <td bgcolor="#f7f7f7"><b>Pesan</b></td>
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
											 <td align="right"><b><?php echo $reply_message->datez_ok ?></b>
												
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
									<button type="button" class="btn" data-group="btn-link" data-url="<?php url("message/student_inbox"); ?>">Kembali</button>
								 </div>
								 
								 <div class="col-lg-12">&nbsp;</div>

								 
							 </div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

