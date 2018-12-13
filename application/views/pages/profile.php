<?php include('head.php'); ?>
<?php include ('navigator.php'); ?>
<div class="container">
    <div class="row">
        <div class="notif" id="alert-content"></div>
        <div class="section-divider"></div>
        <div class="col-lg-8 offset-lg-2 profile header">
            <?php
				$full_path = "assets/images/profile/ss_" . $dataUser[0]['picture'];
				if (!file_exists($full_path) || $dataUser[0]['picture'] == "") $img_type = 0; else $img_type = 1;
                
                if ($img_type == 1)
                {
                    $path = "assets/images/profile/ss_" . $dataUser[0]['picture'];
                }
                else
                {
                    $path = "assets/images/avatar.jpg";
                }
			?>
            <div class="profile-img-container">
                <img src="<?php echo $path; ?>" id="userDisplayFoto" alt="kids education system user">
            </div>
            <div>
                <label class="fileContainer">
                    Unggah Foto 
                    <input type="file" id="userFoto" accept="image/*"/>
                </label>
            </div>
            <h1><?php echo $dataUser[0]['fullname']; ?></h1>
            <table class="table">
                <tr>
                    <td>Nama</td>
                    <td><input type="text" id="userNama" value="<?php echo $dataUser[0]['fullname'];?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" readonly id="userEmail" value="<?php echo $dataUser[0]['email'];?>"></td>
                </tr>
                <tr>
                    <td>No. Telepon</td>
                    <td><input type="text" id="userTelepon" value="<?php echo $dataUser[0]['mobile_phone'];?>"></td>
                </tr>
                <tr>
                    <td colspan="2"><button class="btn btn-block btn-register" id="but-update">Perbaharui</button></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>