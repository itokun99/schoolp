<?php include('head.php'); ?>
<?php include ('navigator.php'); ?>
<div class="container">
    <div class="row">
        <div class="notif" id="alert-content"></div>
        <div class="section-divider"></div>
        <div class="col-lg-8 offset-lg-2 profile">
            <h1><?php echo $dataUser[0]['fullname']; ?></h1>
            <table class="table">
                <tr>
                    <td><label for="alamat">Alamat</label></td>
                    <td><input type="text" id="parentAlamat"></td>
                </tr>
                <tr>
                    <td><label for="agama">Agama</label></td>
                    <td>
                        <select id="parentAgama">
                            <option value="0">-- Pilih --</option>
                            <option value="Islam">Islam</option>
                            <option value="Protestan">Protestan</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="lahir">Tanggal Lahir</label></td>
                    <td><input type="date" id="parentLahir"></td>
                </tr>
                <tr>
                    <td><label for="hubungan">Hubungan</label></td>
                    <td>
                        <select id="kategoriHubungan">
                            <option value="0">-- Pilih --</option>
                            <option value="Ayah">Ayah</option>
                            <option value="Ibu">Ibu</option>
                            <option value="Wali">Wali</option>
                        </select>                  
                    </td>
                </tr>
                <tr id="waliHubungan" style="display:none;">
                    <td><label for="kelamin">Jenis Kelamin</label></td>
                    <td>
                        <input type="radio" name="waliKelamin" id="waliKelamin" value="Pria" checked>&nbsp;Pria&nbsp;&nbsp;
                        <input type="radio" name="waliKelamin" id="waliKelamin" value="Wanita">&nbsp;Wanita             
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><button class="btn btn-block btn-register" id="parentUpgrade">Jadikan saya orang tua</button></td>
                </tr>
            </table> 
        </div>
    </div>
</div>
</body>
</html>