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
        <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12 register">
            <div class="register-form">
                <h1>Hubungi kami</h1>
                <table class="table">
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><input type="text" value="<?php if(isset($userName))
                        {
                           echo $userEmail; 
                        }  ?>" id="contactEmail"></td>
                    </tr>
                    <tr>
                        <td><label for="name">Nama</label></td>
                        <td><input type="text" value="<?php if(isset($userName))
                        {
                           echo $userName; 
                        }  ?>" id="contactNama"></td>
                    </tr>
                    <tr>
                        <td><label for="telepon">No. Telepon</label></td>
                        <td><input type="text" id="contactTelepon"></td>
                    </tr>
                    <tr>
                        <td><label for="pesan">Pesan</label></td>
                        <td><textarea id="contactPesan" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="4"><button class="btn btn-block btn-register" id="sendMessage">Kirim pertanyaan</button></td>
                    </tr>
                </table>  
            </div>
        </div>
    </div>
</div>
</body>
</html>