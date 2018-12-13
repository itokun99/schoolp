							<style>
								html, body {
							    max-width: 100%;
							    overflow-x: hidden;
							}
							</style>

								<body style="background: #ffffff">
								<div class="box-body" style="background: #ffffff">
    								<div class="col-lg-12">
										<table class="table table-bordered">
											<tbody>
											<tr>
												<td bgcolor="#f7f7f7" style="width: 110px"><b>Siswa</b></td>
												<td><?php echo "$student->fullname ($student->member_code)" ?></td>
											</tr>
											<tr>
												<td bgcolor="#f7f7f7"><b>Kelas</b></td>
												<td><?php echo $classroom->classroom_name ?></td>
											</tr>
											<tr>
												<td bgcolor="#f7f7f7"><b>Mata Pelajaran</b></td>
												<td><?php echo $cources->cources_name ?></td>
											</tr>
											<tr>
												<td bgcolor="#f7f7f7"><b>Tanggal Ujian</b></td>
												<td><?php echo $exam->exam_date_ok ?></td>
											</tr>
											</tbody>
										</table>
									</div>
								
								 
								 
								 
								 <?php if (isset($dataDetails) && count($dataDetails) > 0) { ?>
								 <div class="material-datatables col-lg-12">
									 <table class="table table-bordered" cellspacing="0" width="100%">
									   <tbody>
										 <?php
										 foreach($dataDetails as $dataDetails)
										 {
											$url_path = $this->session->userdata('link_school') . "/";
										 ?>
										 <tr>
										   <td style="text-align: left; padding: 5px">
											   <a href="<?php echo $url_path ?>assets/images/exam/<?php echo $dataDetails->filename ?>" target="_blank">
											   <span class="btn btn-warning" style="width: 200px; margin: 0px"><?php echo $dataDetails->filename ?></span>
										       </a>
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
					</body>	