    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="assets/images/bg_login2.jpg">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form action="login/signin" method="post" class="form-horizontal">
                                <div class="card card-login card-hidden" style="background-image: url('assets/images/bg_logo.png'); background-position: center; background-repeat: no-repeat;">
                                    <div class="card-header text-center" data-background-color="red">
                                        <h4 class="card-title">ORANGTUA</h4>                                        
                                    </div>
                                    <p class="category text-center">
                                        
                                    </p>
                                    <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Email / Username</label>
                                                <input type="email" name="email" value="<?php echo $email ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Kata Sandi</label>
                                                <input type="password" name="password" value="<?php echo $paswd ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-info">Masuk</button>
                                    </div>
                                    <div class="text-center">
                                        <div class="col-lg-12">
                                        <?php
                                            $err_message = $this->session->userdata('err_message');
                                            $this->session->unset_userdata("err_message");
                                        ?>
							
                                        <?php if (isset($err_message) || $err_message <> NULL) { ?>
                                            <div style="height: 20px"></div>
                                            <?php if ($err_message <> "") { ?>
                                            <?php
                                                $alert_stat = "danger";
                                                if ($this->session->userdata('err_message_stat'))
                                                {
                                                    $alert_stat = "success";
                                                    $this->session->unset_userdata("err_message_stat");
                                                }
                                            ?>
                                            <div class="alert alert-<?php echo $alert_stat ?>" style="padding: 10px;">
                                            <?php echo $err_message; ?>
                                            </div>
                                            <?php } ?>                                            
                                        <?php } ?>
                                        
                                            <div style="height: 20px"></div>
											<div style="text-align:right">
                                                <a href="register">
                                                <font color="#777777">Daftar Akun Baru
												&nbsp; <i class="fa fa-sign-in"></i></font>
                                                </a>
                                            </div>
											<div style="height: 10px"></div>
                                            <div style="text-align:right">
                                                <a href="#" data-toggle="modal" data-target="#forgetpass">
                                                <font color="#777777">Lupa Kata Sandi
												&nbsp; <i class="fa fa-lock"></i></font>
                                                </a>
                                            </div>
                                            <div style="height: 5px"></div>
                                            
                                        
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    
    <div class="modal fade" id="forgetpass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-notice">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                    <h5 class="modal-title" id="myModalLabel"><strong>Lupa Kata Sandi</strong></h5>
                </div>
                <div class="modal-body">
                    <div class="instruction">
                        <div class="row">
                            <form class="form-horizontal" name="frm" action="login/forget_pass" method="POST">    
                            <div class="col-lg-12">
                                <div class="form-group">
                                   <label class="control-label col-lg-3">Email</label>
                                   <div class="col-lg-9">
                                      <div class="col-lg-12 row">
                                         <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $email ?>" required="true" />
                                      </div>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-lg-3"></label> 
                                   <div class="col-lg-9">
                                      <div class="col-lg-12 row">
                                         <button type="submit" class="btn btn-info btn-round">Kirim</button>
                                         &nbsp;&nbsp;&nbsp;&nbsp;
                                         <button type="button" class="btn btn-warning btn-round" data-dismiss="modal">Tutup</button>
                                      </div>
                                   </div>
                                </div>   
                            </div>
                            </form>
                        </div>
                    </div>															  
                </div>
                <div class="modal-footer text-center">                    
                    <div style="height: 10px"></div>
                </div>
            </div>
        </div>
        </div>