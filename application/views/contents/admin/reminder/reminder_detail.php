
			<table class="table table-bordered">
				<tbody>
					<tr>
					    <td bgcolor="#efefef">Sekolah</td>
						<td><?php echo $calendar->school_name ?></td>
				    </tr>					
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
					    <td bgcolor="#efefef">Tipe</td>
						<td><?php echo $calendar->type_text ?></td>
				    </tr>
					<tr>
					    <td bgcolor="#efefef">Dibuat Oleh</td>
						<td><?php echo $calendar->created_by ?></td>
				    </tr>
					
				</tbody>
			 </table>