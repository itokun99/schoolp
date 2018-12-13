
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
								<td width="100" bgcolor="#efefef">Children Name</td>
								<td><?php echo $notification->student_name ?></td>
							</tr>
							<tr>
								<td bgcolor="#efefef">School</td>
								<td><?php echo $notification->school_name ?></td>
							</tr>
							<tr>
								<td bgcolor="#efefef">Month</td>
								<td><?php echo "$notification->month_name $notification->payment_year" ?></td>
							</tr>
							<tr>
								<td bgcolor="#efefef">School Fee</td>
								<td><?php echo number_format($notification->student_fee) ?></td>
							</tr>
						</tbody>
					</table>
					<div style="text-align: right">
				    <a onclick="close_modal()" class="btn btn-warning btn-round" style="margin: 0px">Close</a>
					</div>
					
				</div>																	  
			</div>
		</div>		
</body>
</html>

<script>
	function close_modal ()
	{
		parent.$('#myModalPayment').modal('hide');
	}
	
</script>
