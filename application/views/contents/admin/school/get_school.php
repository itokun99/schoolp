<option value="">Pilih Sekolah</option>
<?php foreach($schools AS $data) { ?>								
	<option value="<?php echo $data->schoolid ?>"><?php echo $data->school_name ?></option>	
<?php } ?>	