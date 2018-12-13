<option value="">Pilih Kota / Kabupaten</option>
<?php foreach($tb_kabupaten AS $data) { ?>								
	<option value="<?php echo $data->kabupatenid ?>"><?php echo $data->nama_kabupaten ?></option>
<?php } ?>	