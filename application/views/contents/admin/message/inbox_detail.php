							 
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-envelope fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Inbox - Detail Pesan</h4>
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
								 
								 <table class="table">
									<tbody>
										<tr>
											<td><button type="button" class="btn" data-group="btn-link"  data-url="<?php url("message/inbox"); ?>">Kembali</button></td>
											<td align="right">
												<a href="#" data-toggle="modal" data-load-url="message/reply_message/<?php echo $parent_message_id ?>" data-target="#myModal2" title="Reply Message">
												<button type="button" class="btn btn-info btn-round"><i class="fa fa-reply"></i>&nbsp;&nbsp; Balas Pesan&nbsp;</button></a>
											</td>
										</tr>											
									</tbody>
								 </table>
									 
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
											 <td bgcolor="#f7f7f7"><b>Sekolah</b></td>
											 <td><?php echo $message->school_name ?></td>
											 <td bgcolor="#f7f7f7"><b>Anak</b></td>
											 <td><?php echo $message->student_name ?></td>
										 </tr>
										 <tr>
											 <td bgcolor="#f7f7f7"><b>Dibuat Oleh</b></td>
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
								 
								 <table class="table">
									<tbody>
										<tr>
											<td><button type="button" class="btn" data-group="btn-link"  data-url="<?php url("message/inbox"); ?>">Kembali</button></td>											
										</tr>											
									</tbody>
								 </table>
								 
								 <div class="col-lg-12">&nbsp;</div>

								 
							 </div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog modal-big">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel"><strong>Balas Pesan</strong></h5>
			</div>
			<div class="modal-body">
				<div class="instruction">
					<div class="row">
						
					</div>
				</div>															  
			</div>
			
		</div>
	</div>
</div>


<script type="text/javascript">
	 $('#myModal2').on('show.bs.modal', function (e) {
		//$("#iframeId").attr("src", $(this).attr("href"));
		var loadurl = $(e.relatedTarget).data('load-url');
		$(this).find('.modal-body').load(loadurl);
	});
	
</script>
	