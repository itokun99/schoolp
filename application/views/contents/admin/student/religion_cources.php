<div class="row">
	<div class="col-lg-12">
		
			<table class="table table-bordered">
				<tr>
					<td bgcolor="#FFFBB8" width="100"><b>Hari</b></td>
					<td><?php echo $day_ok->day_name ?></td>
				</tr>
				<tr>
					<td bgcolor="#FFFBB8"><b>Waktu</b></td>
					<td><?php echo $courcesReligion->timez_ok ?></td>
				</tr>
			</table>
			
			<table id="tbReligion" class="table table-bordered" style="width: 100%">
				<tr bgcolor="#D9E2FC">
				  <td style="width: 100px; text-align: center; padding: 4px">Agama</td>
				  <td style="width: 150px; text-align: center; padding: 4px">Guru</td>
				  <td style="text-align: center; padding: 4px">Kelas</td>
				</tr>
				<?php foreach($ClassReligions as $religion) { ?>
				<tr>
				  <td style="text-align: center; padding: 5px">
					  <?php echo $religion->religion_name ?>
				  </td>
				  <td style="text-align: left; padding: 5px">
					  <?php echo $religion->teacher_name ?>
				  </td>
				  <td style="text-align: left; padding: 5px">
					  <?php echo $religion->classroom_text ?>
				  </td>						 
				</tr>
				
				<?php } ?>
		  </table>
	</div>
</div>