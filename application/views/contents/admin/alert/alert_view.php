		<table class="table table-bordered">
			<tbody>
				<tr bgcolor="#FCE30C">
					<td style="width: 100px">Tanggal</td>
					<td style="text-align:center; width: 100px">Kasus</td>
					<td style="text-align:center; width: 100px">Anak</td>
					<td style="text-align:center; width: 120px">Mata Pelajaran</td>
					<td style="text-align:left">Keterangan</td>				</tr>
				<?php foreach($alerts as $alert) { ?>
				<tr>
					<td><a href="#" data-toggle="modal" data-load-url="alert/details/<?php echo $alert->alertid ?>" data-target="#myModalAlertDetail" style="color: #333333; display: block"><?php echo $alert->discipline_date_ok ?></a></td>
					<td style="text-align:left"><a href="#" data-toggle="modal" data-load-url="alert/details/<?php echo $alert->alertid ?>" data-target="#myModalAlertDetail" style="color: #333333; display: block"><?php echo $alert->type_name ?></a></td>
					<td><a href="#" data-toggle="modal" data-load-url="alert/details/<?php echo $alert->alertid ?>" data-target="#myModalAlertDetail" style="color: #333333; display: block"><?php echo $alert->student_name ?></a></td>
					<td><a href="#" data-toggle="modal" data-load-url="alert/details/<?php echo $alert->alertid ?>" data-target="#myModalAlertDetail" style="color: #333333; display: block"><?php echo $alert->cources_name ?></a></td>
					<td style="text-align:left"><a href="#" data-toggle="modal" data-load-url="alert/details/<?php echo $alert->alertid ?>" data-target="#myModalAlertDetail" style="color: #333333; display: block"><?php echo $alert->discipline_desc ?></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>