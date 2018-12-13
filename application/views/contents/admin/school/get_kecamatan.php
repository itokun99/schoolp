<option value="">Pilih Kecamatan</option>
<?php foreach($tb_kecamatan AS $data) { ?>								
	<option value="<?php echo $data->kecamatanid ?>"><?php echo $data->nama_kecamatan ?></option>	
<?php } ?>	