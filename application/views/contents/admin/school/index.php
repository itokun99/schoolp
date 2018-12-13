<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-university fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Sekolah Anak</h4>
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
							
							<div class="box-body">
								<div class="x_panel no-border">
								  
									  <table width="100%">
										<tr>
										  <td><a href="school/add_school" class="btn btn-info">Tambahkan Sekolah Anak</a></td>
										  <td align="right"></td>
										</tr>
									  </table>
									  <div style="height: 10px"></div>
															
									<?php if (isset($dataDetails) && count($dataDetails) > 0) { ?>
									  <div class="row">
										  <?php foreach($dataDetails as $i => $dataDetail) { ?>
										  <div class="col-lg-3 col-md-4 col-xs-6">
											  <table width="100%" class="table">
											    <tr>
												  <td>
													
													<table class="table table-bordered" style="height: 200px">
														<tr>
															<td>
																<table width="100%" class="table">
																	 <tr>
																	  <td style="text-align: center; height: 130px">
																		  <?php
																			  $link_school = $this->session->userdata('link_school');
																			  $picture = $dataDetail->student_picture;
																			  $image_link = "$link_school/assets/images/profile/ss_$picture";
																																				  
																			  $cek_dimesion = getimagesize("$link_school/assets/images/profile/ss_$picture");
																			  if ($cek_dimesion[0] > $cek_dimesion[1])
																			  {																		   
																				  echo "<img src='$link_school/assets/images/profile/ss_$picture' width='100' class='img-rounded' border=0>";
																			  } 
																			  else 
																			  {																		    
																				  echo "<img src='$link_school/assets/images/profile/ss_$picture' height='100' class='img-rounded' border=0>";
																			  }
																																					
																		  ?>
																	  </td>
																	</tr> 
																	<tr bgcolor="#efefef">
																		<td align="center"><b><?php echo $dataDetail->student_name ?></b></td>
																	</tr>
																	<tr bgcolor="#f7f7f7">
																		<td align="center"><?php if($dataDetail->student_gender=="Male") echo "Laki-laki"; else echo "Perempuan" ?></td>
																	</tr>
																	<tr>
																		<td align="center">
																			<div class="col-lg-6"><a href="school/children_access/<?php echo $dataDetail->student_id ?>"><button type="button" class="btn btn-info btn-round btn-sm" title="View Detail Children"><i class="fa fa-search"></i>&nbsp; Detail</button></a></div>
																			<div class="col-lg-6"><button type="button" onclick="btnDelChildren(<?php echo $dataDetail->parstdid ?>, '<?php echo $dataDetail->student_name ?>')" class="btn btn-danger btn-round btn-sm" title="Hapus Anak"><i class="fa fa-trash"></i>&nbsp; Hapus</button></div>
																		</td>
																	</tr>
																</table>														
															</td>
														</tr>
													</table>
													
											      </td>
											    </tr>
											  </table>
											  
										  </div>
										  <?php } ?>
								  	  </div>
								
									<?php } else { ?>										
										<div align='center' class='alert-box info'>Tidak Ada Data di Database.</div>
									<?php } ?>
								</div>
							</div>
							
										  
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function btnDelChildren (sid, oid)
	{
		start_valid=confirm("Apakah Anda yakin untuk Hapus Anak Ini \n" + oid + " ?")

		if (start_valid == true)
		{	
		   location.href = "school/remove_children/" + sid;
		}
		
	}
</script>

                  