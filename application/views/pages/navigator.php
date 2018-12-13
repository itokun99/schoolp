<div class="container-fluid top-menu" id="section-top">
	<div class="container">
		<section>
			<div class="row">
				<div class="notif" id="alert-content"></div>
			</div>
		</section>
	</div>
</div>
<div class="container-fluid" id="section-navbar">
	<section>
		<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top navbar-adjustment">
			<a href="home"><img src="assets/website/images/dark-logo.png" class="header-image" id="logo" alt="kids education system logo"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto li-setting">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SIAPA KAMI</a>
							<div class="dropdown-menu dropdown-menu-about" aria-labelledby="navbarDropdown">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-4 col-12 d-flex justify-content-left flex-column">
										<div class="dropdown-header ">
											<h1>tentang perusahaan</h1>
											<a class="dropdown-item" href="about?section=1">Latar belakang</a>
											<a class="dropdown-item" href="about?section=2">Visi & Misi</a>
											<a class="dropdown-item" href="about?section=3">Tim KES</a>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-12 d-flex justify-content-left flex-column">
										<div class="dropdown-header ">
											<h1>sistem kes</h1>
											<a class="dropdown-item" href="kes-system?section=1">Solusi masalah</a>
											<a class="dropdown-item" href="kes-system?section=2">Fitur KES</a>
											<a class="dropdown-item" href="kes-system?section=3">Teknologi</a>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-12 d-flex justify-content-left flex-column">
										<div class="dropdown-header ">
											<h1>kemitraan</h1>
											<a class="dropdown-item" href="#">Sekolah</a>
											<a class="dropdown-item" href="#">Media</a>
											<a class="dropdown-item" href="#">Channel</a>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="news">BERITA</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="faq">FAQ</a>
						</li>
						<?php 
						if($userName == "")
						{?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">LOGIN</a>
							<div class="dropdown-menu dropdown-menu-login" aria-labelledby="navbarDropdown">
								<div class="dropdown-login-list-container">
									<input type="text" onkeypress="login(event)" id="userEmail" placeholder="Email">
									<input type="password" onkeypress="login(event)" id="userPassword" placeholder="Kata Sandi">
									<script>
										function login(e)
										{   
											if (e.keyCode == 13) {
												var email = $('#userEmail').val();
												var password = $('#userPassword').val();
												var loginFrom = "normal";
												if(email == "" || password == "")
												{
													var html='';
													html+='<div class="alert alert-danger" role="alert">Lengkapi informasi yang dibutuhkan..</div>';
													$('#alert-content').html(html);
													$('#alert-content').fadeIn(800);
													setTimeout(function(){
														$('#alert-content').fadeOut(2000);
													},2000)
												}
												else
												{
													$.ajax({
														type : "POST",
														url  : "UserController/login",
														dataType : "JSON",
														data : {
															loginEmail: email, 
															loginPassword:password,
															loginFrom:loginFrom
														},
														error: function(xhr) {
															console.log(xhr.responseText);
														},
														success: function(data){
															if(data=="ERLOG001")
															{
																var html='';
																html+='<div class="alert alert-warning" role="alert">Email tidak terdaftar atau belum diverifikasi..</div>';
																$('#alert-content').html(html);
																$('#alert-content').fadeIn(800);
																setTimeout(function(){
																	$('#alert-content').fadeOut(2000);
																},2000)
															}
															else if(data=="ERLOG002")
															{
																var html='';
																html+='<div class="alert alert-warning" role="alert">Password yang anda masukkan salah..</div>';
																$('#alert-content').html(html);
																$('#alert-content').fadeIn(800);
																setTimeout(function(){
																	$('#alert-content').fadeOut(2000);
																},2000)
															}
															else if(data=="sukses")
															{
																location.reload();
															}
														}
													});
												} 
											}
										}
									</script>
									<a href="javascript:loginNormal()"><button class="btn btn-block btn-submit" id="login-normal">Masuk</button></a>
									<p><a href="forget-password">Lupa Kata Sandi?</a></p>
									<hr>
									<a href="javascript:loginFb()"><button class="btn btn-block btn-login-fb" id="login-fb"><i class="fa fa-facebook"></i>Masuk dengan Facebook</button></a>
									<div id="gSignInWrapper">
										<div id="customBtn" class="customGPlusSignIn">
											<span class="icon"><img src="assets/website/images/google-login-logo.png" alt=""></span>
											<span class="buttonText">Masuk dengan Google</span>
										</div>
									</div>
									<div id="name"></div>
									<p>Belum punya akun KES? <a href="register">Daftar</a></p>
								</div>
							</div>
						</li>
						<?php 
						} 
						else
						{
						?>
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
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<div class="profile-picture">
								<img src="<?php echo $path; ?>" alt="profile picture">
							</div>
							<?php echo $dataUser[0]['fullname']; ?>
							</a>
							<div class="dropdown-menu dropdown-menu-profile" aria-labelledby="navbarDropdown">
								<div class="dropdown-profile-list">
									<div><i class="fa fa-user"></i> <a href="user-profile">Profil</a></div>
									<?php
										if($dataUser[0]['gender'] == "")
										{?>
											<div><i class="fa fa-group"></i><a href="parent-update">Orang Tua</a></div>
										<?php
										}
										else
										{
											?>
											<div><i class="fa fa-group"></i><a href="login/signin">Orang Tua</a></div>
										<?php
										}
									?>
									<div><i class="fa fa-gear"></i><a href="#">Pengaturan</a></div>
									<div><i class="fa fa-sign-out"></i><a href="javascript:userLogout('<?php echo $loginFrom ?>')" >Keluar</a></div>
								</div>	
							</div>
						</li>
						<?php
						} ?>
					</ul>
				</div>
		</nav>
	</section>
</div>