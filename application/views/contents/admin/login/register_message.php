<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="red">
				<i class="fa fa-envelope fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Konfirmasi Pesan</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 250px">
						  							
							<div class="box-body">
							  
								<div class="panel-body pan">
								   <?php if (isset($err_message) && $err_message <> "") { ?>
								   <table id="datatable" width="100%">
										<tr>
										  <td><?php if (isset($err_message)) echo $err_message; ?></td>
										</tr>
								   </table>
								   <?php } ?>
								   
								   <table id="datatable" width="100%">
										<tr>
										  <td>
											<div style='text-align: center; color: #999999'>
											<div style="height: 30px"></div>
											<b>Terima Kasih,</b>
											<br><br>
											Akun Anda telah berhasil terdaftar.
											<br>Silahkan cek Email <b>Anda</b> untuk mendapatkan kata sandi  <b>Anda</b> to Login.
											<div style="height: 10px"></div>
											<a href="login"><button class="btn btn-info">Masuk</button></a>
											</div>
										  </td>
										</tr>
								   </table>
								   
								   
							 </div>     
							
						 </div>					  
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>

</body>
</html>