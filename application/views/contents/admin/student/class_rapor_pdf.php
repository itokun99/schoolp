
<style type="text/css">
body {
    font-family: Arial;
	font-size: 12px;
	line-height: 1.42857143;
	color: #333;
}

td {
    border: 1px solid #ddd;
    padding: 5px;
	font-family: Arial;
	font-size: 12px;
	line-height: 1.42857143;
	color: #333;
}

table {
    border-collapse: collapse;
    border: 1px solid #ddd;
    letter-spacing: 1px;
    font-family: Arial;
	font-size: 12px;
	line-height: 1.42857143;
	color: #333;
}

</style>

<body>
	
	<div style="text-align: center">
		<h2>KES - <?php echo $school_name ?></h2>
	</div>
	
		<table width="100%" cellspacing="0" cellspacing="0" border="0" style="border: none">
			<tr>
				<td width="48%" style="padding: 0px; border: none">
					<table width="100%">
						<tr>
							<td style="font-size: 10px;" bgcolor="#f7f7f7">Nama Siswa</td>
							<td style="font-size: 10px;"><?php echo "$student->fullname ($student->member_code)" ?></td>
						</tr>
						<tr>
							<td style="font-size: 10px;" bgcolor="#f7f7f7" width="100">Kelas</td>
							<td style="font-size: 10px;"><?php echo $classroom->classroom_name ?></td>
						</tr>
					</table>
				</td>
				<td width="4%" style="padding: 0px; border: none"></td>
				<td width="48%" style="padding: 0px; border: none">
					<table width="100%">
						<tr>
							<td style="font-size: 10px;" bgcolor="#f7f7f7" width="100">Tahun Ajaran</td>
							<td style="font-size: 10px;"><?php echo $classroom->scyear_name ?> Semester <?php echo $semester->semester_name ?></td>
						</tr>
						<tr>
							<td style="font-size: 10px;" bgcolor="#f7f7f7">Tingkatan Kelas</td>
							<td style="font-size: 10px;"><?php echo $classroom->edulevel_name ?></td>
						</tr>
					</table>					
				</td>
			</tr>
		</table>
		
		<br>
		<?php if (isset($dataDetails) && count($dataDetails) > 0) { ?>
			<table width="100%">
				  <tr bgcolor="#efefef" style="border: 1px solid #ddd;">
					<td bgcolor="#dddddd" style="font-size: 10px; width: 160px; text-align: center">Mata Pelajaran</td>
					<?php foreach($type_exams AS $j => $type_exam) {  ?>
					  <td style="font-size: 10px; width: 70px; text-align: center" colspan="2"><?php echo "$type_exam->type_name" ?></td>
					<?php } ?>
					<td bgcolor="#dddddd" style="font-size: 10px; width: 50px; text-align: center">Nilai Akhir</td>
					<td bgcolor="#efefef" style="font-size: 10px; width: 50px; text-align: center">Rata-Rata Kelas</td>
				  </tr>
				  <?php
				  foreach($dataDetails AS $j => $dataDetail)
				  {
					  if ($dataDetail->final_score < 6) $fontcolor = "#cc3300"; else $fontcolor = "#333333";
				  ?>
				  <tr>
					  <td style="font-size: 10px; height: 30px"><?php echo "$dataDetail->cources_name" ?></td>
					  <?php
						foreach($dataDetail->type_exam AS $o => $student_score)
						{
							if ($student_score->score_exam == 0) $fontcolorsc = "#cc3300"; else $fontcolorsc = "#333333";
							if ($student_score->score_status == 2) $bgcolor = "#D4FECA"; else $bgcolor = "#ffffff";
							if ($dataDetail->scoring_percent < 100) $fontcolor2 = "#cc3300"; else $fontcolor2 = "#333333";
						?>
						<td bgcolor="<?php echo $bgcolor ?>" style="font-size: 10px; text-align: center; color: <?php echo $fontcolorsc ?>"><?php if ($student_score->score_exam <> 0) echo number_format($student_score->score_exam, 2); else echo "-" ?></td>
						<td bgcolor="#f7f7f7" style="font-size: 10px; text-align: center; color: <?php echo $fontcolorsc ?>"><?php if ($student_score->score_avg <> 0) echo number_format($student_score->score_avg, 2); else echo "-" ?></td>
						<?php } ?>
						<td style="font-size: 10px; text-align: center; background: #FBFECA; color: <?php echo $fontcolor ?>">
						  <?php
							if ($dataDetail->scoring_percent < 100) echo "-";
							else echo number_format($dataDetail->final_score, 2)
						  ?>
						</td>
						<td style="font-size: 10px; text-align: center; background: #D4FECA">													
						  <?php
							if ($dataDetail->scoring_percent < 100) echo "-";
							else echo number_format($dataDetail->class_average_score, 2)
						  ?>
						</td>					
				  </tr>											
				  <?php } ?>									
			</table>
			
			<br>
			<?php if ($classroom->promote_status <> 0) { ?>
			<table width="100%" cellspacing="0" cellspacing="0" border="0" style="border: none">
				<tr>
					<?php if ($classroom->promote_status > 0) { ?>
					<td valign="top" width="40%" style="border: none">						
						<table width="100%">
							<tr>
								<td width="100" style="font-size: 10px;" bgcolor="#D4FECA">Status</td>
								<td style="font-size: 10px; color: #cc3300"><?php echo $classroom->promote_text ?></td>
							</tr>							
						</table>						
					</td>
					<td width="5%" style="border: none"></td>
					<?php } ?>
					<td valign="top" style="border: none">
						<table width="100%">
							<?php if ($classroom->promote_ranking <> 0) { ?>
							<tr>
								<td style="font-size: 10px;" bgcolor="#efefef" width="140"><b>Peringkat</b></td>
								<td style="font-size: 10px;">
									<b><?php echo $classroom->promote_ranking ?></b>
								</td>
							</tr>
							<?php } ?>
							<tr>
								<td width="100" style="font-size: 10px;" bgcolor="#FBFECA">Kritik & Saran</td>
								<td style="font-size: 10px;"><?php echo $classroom->description_text ?></td>
							</tr>							
						</table>				
					</td>
				</tr>
			</table>
				
			<?php } ?>
		<?php } ?>
	
</body>