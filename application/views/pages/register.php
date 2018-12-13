<?php include('head.php'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="register-header">
            <a href="home"><img src="assets/website/images/register/logo.png" alt="kids education system logo"></a>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="notif" id="alert-content"></div>
        <div class="col-lg-10 offset-lg-1 register">
            <div class="register-form">
                <h1>Daftar Akun Kids Education System</h1>
                <h2>Sudah punya akun KES? <a href="home">Masuk</a></font></h2>
                <div>
                    <select id="akunKategori">
                        <option value="0">-- Pilih kategori akun --</option>
                        <option value="parents">Daftar sebagai Orang Tua</option>
                        <option value="user">Daftar sebagai Tamu</option>
                    </select>
                </div>
                <div id="user" style="display:none;">
                    <table class="table">
                        <tr>
                            <td><label for="nama">Nama</label></td>
                            <td><input type="text" id="userNama"></td>
                            <td><label for="telepon">No. Telepon</label></td>
                            <td><input type="text" id="userTelepon"></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input type="text" id="userEmail"></td>
                            <td><label for="password">Password</label></td>
                            <td><input type="password" id="userPassword"></td>
                        </tr>
                        <tr>
                            <td colspan="4"><button class="btn btn-block btn-register" id="userDaftar">Daftar</button></td>
                        </tr>
                    </table>  
                </div>
                <div id="parents" style="display:none;">
                    <table class="table">
                        <tr>
                            <td><label for="nama">Nama</label></td>
                            <td><input type="text" id="parentNama"></td>
                            <td><label for="telepon">No. Telepon</label></td>
                            <td><input type="text" id="parentTelepon"></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input type="text" id="parentEmail"></td>
                            <td><label for="password">Password</label></td>
                            <td><input type="password" id="parentPassword"></td>
                        </tr>
                        <tr>
                            <td><label for="alamat">Alamat</label></td>
                            <td><input type="text" id="parentAlamat"></td>
                            <td><label for="jenisKelamin">Jenis Kelamin</label></td>
                            <td>
                                <input type="radio" name="parentKelamin" id="parentKelamin" value="Pria" checked>&nbsp;Pria&nbsp;&nbsp;
                                <input type="radio" name="parentKelamin" id="parentKelamin" value="Wanita">&nbsp;Wanita
                            </td>
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
                            <td><label for="tanggalLahir">Tanggal Lahir</label></td>
                            <td><input type="date" id="parentLahir"></td>
                        </tr>
                        <tr>
                            <td colspan="4"><button class="btn btn-block btn-register" id="parentDaftar">Daftar</button></td>
                        </tr>
                    </table>   
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>