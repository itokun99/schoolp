<?php include('head.php'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="register-header">
            <a href="home"><img src="assets/website/images/register/logo.png" alt="kids education system logo"></a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="notif" id="alert-content"></div>
        <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 register">
            <div class="register-form">
                <?php if(isset($parameter)){ ?>
                    <input type="hidden" id="emailMobile" value="<?php echo $parameter ?>">
                <?php }else{ ?>
                    <input type="hidden" id="emailMobile" value="">
                <?php }
                ?>
                <h1>Pengaturan password baru</h1>
                <table class="table">
                    <tr>
                        <td><label for="passwordBaru">Password baru</label></td>
                        <td><input type="password" id="newPassword"></td>
                    </tr>
                    <tr>
                        <td><label for="verifyPasswordBaru">Ulangi password baru</label></td>
                        <td><input type="password" id="newPasswordVerify"></td>
                    </tr>
                    <tr>
                        <td colspan="4"><button class="btn btn-block btn-register" id="setPassword">Ubah Kata Sandi</button></td>
                    </tr>
                </table>  
            </div>
        </div>
    </div>
</div>
</body>
</html>