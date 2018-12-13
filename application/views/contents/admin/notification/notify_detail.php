
<style type="text/css">
body {background:none transparent;
}
</style>

<body bgcolor="#ffffff">
		
		<div class="box-body">
			 <div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td width="100" bgcolor="#efefef">Tanggal</td>
								<td><?php echo $calendar->calendar_date_ok ?></td>
							</tr>
							<?php if (!isset($calendar->exam_type_text)) { ?>
							<tr>
								<td bgcolor="#efefef">Waktu</td>
								<td><?php if ($calendar->timez <> "00:00") echo $calendar->timez; else echo "All Day" ?></td>
							</tr>
							<?php } ?>
							<?php if (isset($calendar->classroom_name) && $calendar->classroom_name <> "") { ?>
						    <tr>
								<td bgcolor="#efefef">Kelas</td>
								<td><?php echo $calendar->classroom_name ?></td>
							</tr>
							<?php } ?>
							<tr>
								<td bgcolor="#efefef">Judul</td>
								<td><?php echo $calendar->calendar_title ?></td>
							</tr>
							<tr>
								<td bgcolor="#efefef">Deskripsi</td>
								<td><?php echo $calendar->calendar_desc ?></td>
							</tr>							
						</tbody>
					</table>
					<div style="text-align: right">
				    <a onclick="close_modal()" class="btn btn-warning btn-round" style="margin: 0px">Tutup</a>
					</div>
					
				</div>																	  
			</div>
		</div>		
</body>
</html>

<script>
	function close_modal ()
	{
		parent.$('#myModalNotify').modal('hide');
	}
	
</script>

