<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-book fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Jadwal Ujian</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
							
					                <?php          
										$err_message = $this->session->userdata('err_message');
										$this->session->unset_userdata("err_message");
									?>
									<table id="datatable" width="100%">
										<tr>
										  <td><?php if (isset($err_message)) echo $err_message; ?></td>
										</tr>
									</table>
									
									<?php if (isset($exams) && count($exams) > 0) { ?>
										<table id="reportTables" class="table " cellspacing="0" width="100%">										  
										  <thead>
											
											<tr>
												<th style="width: 0px; height: 0px; visibility: hidden;">
											</tr>
										  </thead>
										  <tbody>
											<?php foreach($exams as $data) { ?>
											<tr>
												<td>
													<table class="table table-bordered" cellspacing="0" width="100%">
											<tr>
											<td bgcolor="#dddddd" style="width: 100px;">Tanggal</td>
											  <td style="text-align: left" data-order="<?php echo $data->exam_date ?>"><?php echo $data->exam_date_ok ?></td>
											</tr>
											<tr>
											<td bgcolor="#dddddd" style="width: 100px;">Waktu</td>
											  <td style="text-align: left" data-order="<?php echo $data->exam_time ?>"><?php echo $data->exam_time_ok ?></td>
											</tr>
											<tr>
											<td bgcolor="#dddddd" style="width: 100px;">Mata Pelajaran</td>
											  <td style="text-align: left"><?php echo $data->cources_name ?>
										        <?php
													if ($data->total_exam_file > 0)
													{
												?>
														&nbsp;
														<a href="#" data-toggle="modal" data-load-url="classroom/attach_file/<?php echo $data->examid ?>/<?php echo $student_id ?>/<?php echo $classroom_id ?>" data-target="#ModalExamFile" title="Attach File">
														<font color="#cc3300"><i class="fa fa-upload"></i></font>
														</a>
												<?php		
													}
												?>
											  </td>
											</tr>
											<tr>
											<td bgcolor="#dddddd" style="width: 100px;">Deskripsi</td>
											  <td style="text-align: left"><?php echo $data->exam_desc ?></td>
											</tr>
											<tr>
											<td bgcolor="#dddddd" style="width: 100px;">Nilai</td>
											  <td style="text-align: left"><?php echo $data->score_value ?></td>
											</tr>
											</table></td></tr>
											<?php } ?>
										  </tbody>
										</table>
								
									<?php } else { ?>
										<div class="col-lg-12" style="height: 50px"></div>
										<div class="col-lg-12">
											<div align='center' class='alert-box info'>Tidak Ada data Di Database.</div>
										</div>
									<?php } ?>
							
						</div>
					</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ModalExamFile" role="dialog" aria-labelledby="ModalExamFileLabel" aria-hidden="false">
	<div class="modal-dialog modal-medium">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="ExamFileModalLabel"><strong>Lampiran File&nbsp;</strong></h5>
			</div>
			<div class="modal-body">
				<div class="instruction">
					<div class="row">
						<iframe id="ExamFileMd" width="100%" frameborder="0" scrolling="auto" onload="resizeIframe(this)" style="height: 450px"></iframe>
					</div>
				</div>															  
			</div>
			
		</div>
	</div>
</div>

<script>
	$('#ModalExamFile').on('show.bs.modal', function (e) {
		//$("#iframeId").attr("src", $(this).attr("href"));
		var loadurl = $(e.relatedTarget).data('load-url');
		$("#ExamFileMd").attr("src", loadurl);
        //$(this).find('.modal-body').load(loadurl);
	});
	
	$('#ModalExamFile').on('hidden.bs.modal', function (e) {
        $("#ExamFileMd").attr("src", "school/waiting");
    });
</script>            