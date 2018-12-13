
<style type="text/css">
body {background:none transparent;
}
</style>

<body bgcolor="#ffffff">
		
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
			 <div class="col-lg-1"></div>
			 <div class="col-lg-10">
				<table class="table table-bordered">
				<tbody>
				    <tr>
					    <td width="100" bgcolor="#efefef">Tanggal</td>
						<td><?php echo $calendar->calendar_date_ok ?></td>
				    </tr>
					<tr>
					    <td bgcolor="#efefef">Waktu</td>
						<td><?php if ($calendar->timez <> "00:00") echo $calendar->timez; else echo "All Day" ?></td>
				    </tr>
				    <tr>
					    <td bgcolor="#efefef">Judul</td>
						<td><?php echo $calendar->calendar_title ?></td>
				    </tr>
				    <tr>
					    <td bgcolor="#efefef">Deskripsi</td>
						<td><?php echo $calendar->calendar_desc ?></td>
				    </tr>
					<tr>
					    <td bgcolor="#efefef">Dibuat Oleh</td>
						<td><?php echo $calendar->created_by ?></td>
				    </tr>
					<tr>
					    <td width="100"></td>
						<td>
							<table width="100%">
								<tr>								    
									<td align="right"><a onclick="close_modal()" class="btn btn-warning btn-round" style="margin: 0px">Tutup</a></td>
								</tr>
							</table>
						</td>
				    </tr>
				</tbody>
			 </table>			 
			 </div>
			 <div class="col-lg-1"></div>
		</div>		
</body>
</html>

<script>
	function close_modal ()
	{
		parent.$('#CalendarViewM').modal('hide');
	}
	
</script>
