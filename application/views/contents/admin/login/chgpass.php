<script>
  function valid()
  {
    stat=true;
	
	if ((document.frm.password_confirm.value == document.frm.password_new.value)) 
	 { } else { msg="The entered passwords do not match!"; stat=false; }
	 
	if ((document.frm.password_confirm.value != '')) 
	 { }
	else
	 { msg="please input your confirm password first"; stat=false; }
	 
	if ((document.frm.password_new.value != '')) 
	 { }
	else
	 { msg="please input your new password first"; stat=false; }
	
	if (stat == false)
	  {alert (msg); stat=true;}
	else
	  { 
	    document.frm.submit();
	  }
  }
</script>  

<body>

  <center>
    <br><br>
	<div style="font-size: 36px">
    <b>KES - ORANGTUA</b>
	</div>
    <br><br>
  </center>

<?php if (isset($fin_message)) { ?>

  <div align="center">
	<div align='left' style="width: 600px;"><?php echo $fin_message ?></div>
  </div>

<?php } else { ?>

  
<?php if (isset($err_message)) { ?>
  
  <div align="center">
	<div align='left' style="width: 600px;"><?php echo $err_message ?></div>
  </div>
  
<?php } else { ?>

<div class="row">
    <div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-lock fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Atur Ulang Kata Sandi</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 200px">
						  							
							<div class="box-body">
							  
								<div class="panel-body pan">
								   
								   <table width="100%" cellpadding="0" cellspacing="1" border="0">
									  <tr>
										<td bgcolor="#ffffff">
										  <table width="100%" cellpadding="0" cellspacing="0" border="0">
											<form name="frm" action="login/change_forgetpassword" method="post">
											<input type="Hidden" name="uidp" value="<?php echo $uidp ?>">
											<tr><td colspan="4" height="5"></td></tr>
											<tr>
											  <td width="10"></td>
											  <td width="140" align="right">Kata Sandi Baru</font></td>
											  <td width="20" align="center"></font></td>
											  <td>
												<input type="Password" name="password_new" size="25" class="form-control">
											  </font></td>
											</tr>
											<tr><td colspan="4" height="10"></td></tr>
											<tr>
											  <td></td>
											  <td align="right">Ketik Ulang Kata Sandi Baru</font></td>
											  <td align="center"></font></td>
											  <td>
												<input type="Password" name="password_confirm" size="25" class="form-control">
											  </font></td>
											</tr>
											<tr><td colspan="4" height="7"></td></tr>
											</form>
											<tr>
											  <td colspan="3"></td>
											  <td><input type="Submit" name="bt_submit" value=" Change " class="btn btn-info" onclick="valid()"></td>
											</tr>
											<tr>
											  <td colspan="4" height="15"></td>
											</tr>			  
										  </table>
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

  
<?php } ?>

<?php } ?>


</body>
</html>
