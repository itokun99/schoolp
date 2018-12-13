<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="material-icons">notifications</i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Notifikasi</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 800px">
						   
							<div class="box-body">
								<div class="x_panel no-border">
								  
									<div style="height: 10px"></div>
															
									<?php if (isset($dataDetails) && count($dataDetails) > 0) { ?>
									<div class="material-datatables">
										<table id="reportTables" class="table table-bordered" cellspacing="0" width="100%">
										  
										  <thead>
											<tr>
												<th style="width: 100px; text-align: center">Tanggal</th>
												<th style="text-align: center">Deskripsi</th>
											</tr>
										  </thead>
										  <tbody>
											<?php foreach($dataDetails as $data) { ?>
											<tr>
												<td style="text-align: center" data-order="<?php echo $data->notify_date ?>">
													<a href="#" data-toggle="modal" data-load-url="notification/notify_detail/<?php echo $data->notifyid ?>" data-target="#myModalNotify" style="color: #333333;">
														<?php if ($data->notify_read == 0) echo "<b>"; echo $data->notify_date_ok ?>
													</a>
												</td>
												<td style="text-align: left">
													<a href="#" data-toggle="modal" data-load-url="notification/notify_detail/<?php echo $data->notifyid ?>" data-target="#myModalNotify" style="color: #333333;">
														<?php if ($data->notify_read == 0) echo "<b>"; echo "$data->title"; ?>
													</a>
												</td>
											</tr>
											<?php } ?>
										  </tbody>
										</table>
										
									</div>
								
									<?php } else { ?>										
										<div align='center' class='alert-box info'>Data Tidak Ditemukan.</div>
									<?php } ?>
								</div>
							</div>
							
										  
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
#dataTables td {
  white-space:inherit;
}
</style>


                  