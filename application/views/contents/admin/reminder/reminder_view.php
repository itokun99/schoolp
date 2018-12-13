		<table class="table table-bordered">
			<tbody>
				<tr bgcolor="#FCE30C">
					<td style="width: 100px">Tanggal</td>
					<td style="text-align:center; width: 60px">Waktu</td>
					<td>Acara / Pengumuman</td>
					<td style="text-align:center; width: 80px">Tipe</td>
					<td style="text-align:center; width: 220px">Sekolah</td>
				</tr>
				<?php foreach($reminders as $reminder) { ?>
				<tr>
					<td><a href="#" data-toggle="modal" data-load-url="reminder/details/<?php echo $reminder->reminderid ?>" data-target="#myModalReminderDetail" style="color: #333333; display: block"><?php echo $reminder->calendar_date_ok ?></a></td>
					<td style="text-align:center"><a href="#" data-toggle="modal" data-load-url="reminder/details/<?php echo $reminder->reminderid ?>" data-target="#myModalReminderDetail" style="color: #333333; display: block"><?php echo $reminder->calendar_time_ok ?></a></td>
					<td><a href="#" data-toggle="modal" data-load-url="reminder/details/<?php echo $reminder->reminderid ?>" data-target="#myModalReminderDetail" style="color: #333333; display: block"><?php echo $reminder->calendar_title ?></a></td>
					<td style="text-align:center"><a href="#" data-toggle="modal" data-load-url="reminder/details/<?php echo $reminder->reminderid ?>" data-target="#myModalReminderDetail" style="color: #333333; display: block"><?php echo $reminder->type_text ?></a></td>
					<td><a href="#" data-toggle="modal" data-load-url="reminder/details/<?php echo $reminder->reminderid ?>" data-target="#myModalReminderDetail" style="color: #333333; display: block"><?php echo $reminder->school_name ?></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>