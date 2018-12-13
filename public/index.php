<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>KES | Home</title>
<meta charset="UTF-8">
<meta name="description" content="Kids Education System">
<meta name="keywords" content="KES,School,Kids Education system,School system">
<meta name="author" content="KES Developer">

<meta name="google-signin-client_id" content="238640789322-t5cjlmpc30f7op3ototauqehb9b6g2qd.apps.googleusercontent.com">

<link rel="icon" href="assets/website/images/icon.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="assets/css/app.css">
<link rel="stylesheet" href="assets/css/animate.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="assets/website/js/jquery.js"></script>
<script src="assets/website/js/bootstrap.js"></script>
<script src="assets/website/js/popper.min.js"></script>
<script src="assets/website/js/jquery.waypoints.min.js"></script>
<script src="assets/website/js/gmail-platform-api.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuHae3MvvdGVotQ-VtcUF4SEL05nxk3WE&libraries=places"></script>
</head>
<body>
<div class="container-fluid top-menu" id="section-top">
	<div class="container">
		<section>
			<div class="row">
				<div class="col-lg-4">
					<p><i class="fa fa-instagram" style="font-size: 22px;"></i>&nbsp;&nbsp;<i class="fa fa-facebook" style="font-size: 22px;"></i>&nbsp;&nbsp;<i class="fa fa-youtube" style="font-size: 22px;"></i></p>
				</div>
				<div class="col-lg-4 offset-lg-4">
					<div class="float-right">
						<a href="#" class="header-link"><p>jadilah mitra kami!</p></a>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<div class="container-fluid" id="section-navbar">
	<section>
		<div class="container">
			<div class="row">
				<nav id="navbar">
					<ul class="no-padding-margin" id="global-ul">
						<div class="float-left">
							<img src="../../assets/website/images/dark-logo.png" id="logo" alt="kids education system logo">
						</div>
						<div id="li" class="float-right li-space">
							<li id="dropdown"><a href="#">Who we are<i id="dropdown-icon" style="margin-left: 5px;" class="fa fa-caret-down"></i></a></li>	
							<ul class="dropdown-list" id="dropdown-list-ul">
								<div class="col-lg-4 dropdown-float">
									<h1 class="dropdown-header">about the company</h1>
									<li><a href="#">Why we doing it</a></li>
									<li><a href="#">Vision & Mission</a></li>
									<li><a href="#">Our team</a></li>
								</div>
								<div class="col-lg-4 dropdown-float">
									<h1 class="dropdown-header">kes system</h1>
									<li><a href="#">Problem solving</a></li>
									<li><a href="#">Feature list</a></li>
									<li><a href="#">Technology</a></li>
								</div>
								<div class="col-lg-4 dropdown-float">
									<h1 class="dropdown-header">partnership</h1>
									<li><a href="#">School</a></li>
									<li><a href="#">Media</a></li>
									<li><a href="#">Channel</a></li>
								</div>
							</ul>		
							<li><a href="#">News</a></li>
							<li><a href="#">FAQ</a></li>
							<input type="text" id="but-status-login" value="off" style="display:none">
							<li id="dropdown-login"><a href="#">Login</a>	
								<ul class="dropdown-login-list" id="dropdown-login-list">
									<div class="dropdown-login-list-container">
										<input type="text" name="" id="" placeholder="Email">
										<input type="text" name="" id="" placeholder="Kata Sandi">
										<button class="btn btn-block btn-submit" id="btn-login">Masuk</button> 
										<hr>
										<button class="btn btn-block btn-login-fb" id="fb-login">Masuk dengan Facebook</button> 
										<button class="btn btn-block btn-login-gmail" id="gmail-login">Masuk dengan Gmail</button> 
										<p>Lupa Kata Sandi?</p>
									</div>
								</ul>
							</li>
						</div>
					</ul>
				</nav>
			</div>
		</div>
	</section>
</div>
	<!-- START OF CONTENT -->
<div class="container-fluid">
	<div class="row news">
		<div id="news-list" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<div class="news-info">
						<h6>PENDIDIKAN | 18 Okt 2018</h6>
						<h2>Lorem Ipsum has been the industry's</h2>
						<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
					</div>
					<img src="assets/images/news/sample-header-news-3.jpg" alt="Los Angeles">
				</div>
				<div class="carousel-item">
					<div class="news-info">
						<h6>PENDIDIKAN | 18 Okt 2018</h6>
						<h2>Lorem Ipsum has been the industry's</h2>
						<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
					</div>
					<img src="assets/images/news/sample-header-news-2.jpg" alt="Chicago">
				</div>
				<div class="carousel-item">
					<div class="news-info">
						<h6>PENDIDIKAN | 18 Okt 2018</h6>
						<h2>Lorem Ipsum has been the industry's</h2>
						<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
					</div>
					<img src="assets/images/news/sample-header-news-3.jpg" alt="New York">
				</div>
			</div>
			<a class="carousel-control-prev" href="#news-list" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#news-list" data-slide="next">
			<span class="carousel-control-next-icon"></span>
			</a>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="news-list-content">
			<div class="container-news">
				<div class="card-news-list">
					<div class="navigation-news">
						<h4><b>baca</b> berita kami</h4>
						<h4></h4>
					</div>
				</div>
			</div>
			<div class="container-news">
				<div class="card-news-list">
					<div class="card-news-header">
					<img src="assets/images/news/sample-news-1.jpg" alt="">
					</div>
					<div class="card-news-content">
						<h5>Judul</h5>
						<h7>1 Okt 2018 | 7 comments</h7>
					</div>
				</div>
			</div>
			<div class="container-news">
				<div class="card-news-list">
					<div class="card-news-header">
						<img src="assets/images/news/sample-news-2.jpg" alt="">
					</div>
					<div class="card-news-content">
						<h5>Judul</h5>
						<h7>1 Okt 2018 | 7 comments</h7>
					</div>
				</div>
			</div>
			<div class="container-news">
				<div class="card-news-list">
					<div class="card-news-header">
					<img src="assets/images/news/sample-news-3.jpg" alt="">
					</div>
					<div class="card-news-content">
						<h5>Judul</h5>
						<h7>1 Okt 2018 | 7 comments</h7>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="news-post">
			<div class="container-latest">
				<div class="latest-post-header">
					<h5>Berita terakhir</h5>
				</div>
				<div class="latest-post-content-left">
					<div class="latest-post-content-image">
						<img src="assets/images/news/sample-news-3.jpg" alt="">
					</div>
					<h3>Lorem Ipsum has been the industry's</h3>
					<div class="latest-post-content-category">
						<div class="btn-group">
							<button class="post-category">PENDIDIKAN</button>
							<button class="post-date">13 Okt 2018</button>
						</div>
					</div>
					<div class="latest-post-content-news-overview">
						<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
					</div>
					<button class="post-read">read more</button>
				</div>
				<div class="latest-post-content-right">
					<div class="latest-post-content-image">
						<img src="assets/images/news/sample-news-1.jpg" alt="">
					</div>
					<h3>Lorem Ipsum has been the industry's</h3>
					<div class="latest-post-content-category">
						<div class="btn-group">
							<button class="post-category">PENDIDIKAN</button>
							<button class="post-date">13 Okt 2018</button>
						</div>
					</div>
					<div class="latest-post-content-news-overview">
						<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
					</div>
					<button class="post-read">read more</button>
				</div>
				<div class="latest-post-content-left">
					<div class="latest-post-content-image">
						<img src="assets/images/news/sample-news-3.jpg" alt="">
					</div>
					<h3>Lorem Ipsum has been the industry's</h3>
					<div class="latest-post-content-category">
						<div class="btn-group">
							<button class="post-category">PENDIDIKAN</button>
							<button class="post-date">13 Okt 2018</button>
						</div>
					</div>
					<div class="latest-post-content-news-overview">
						<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
					</div>
					<button class="post-read">read more</button>
				</div>
				<div class="latest-post-content-right">
					<div class="latest-post-content-image">
						<img src="assets/images/news/sample-news-1.jpg" alt="">
					</div>
					<h3>Lorem Ipsum has been the industry's</h3>
					<div class="latest-post-content-category">
						<div class="btn-group">
							<button class="post-category">PENDIDIKAN</button>
							<button class="post-date">13 Okt 2018</button>
						</div>
					</div>
					<div class="latest-post-content-news-overview">
						<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
					</div>
					<button class="post-read">read more</button>
				</div>
			</div>
			<div class="news-divider"></div>
			<div class="container-recommended">
				<div class="recommended-post-header">
					<h5>Berita yang dianjurkan</h5>
				</div>
				<div class="recommended-post-content">
					<div class="recommended-post-content-image">
						<img src="assets/images/news/sample-news-3.jpg" alt="">
					</div>
					<h5>Lorem Ipsum has been the industry's</h5>
					<div class="recommended-date">
						<p>PENDIDIKAN</p>
						<p>13 Okt 2018</p>
					</div>
				</div>
				<div class="recommended-post-content">
					<div class="recommended-post-content-image">
						<img src="assets/images/news/sample-news-1.jpg" alt="">
					</div>
					<h5>Lorem Ipsum has been the industry's</h5>
					<div class="recommended-date">
						<p>PENDIDIKAN</p>
						<p>13 Okt 2018</p>
					</div>
				</div>
				<div class="recommended-post-content">
					<div class="recommended-post-content-image">
						<img src="assets/images/news/sample-news-2.jpg" alt="">
					</div>
					<h5>Lorem Ipsum has been the industry's</h5>
					<div class="recommended-date">
						<p>PENDIDIKAN</p>
						<p>13 Okt 2018</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="section-divider"></div>
	<!-- END OF CONTENT -->
	<div><a href="#section-top" class="back-to-top" id="go-up"><i class="fa fa-angle-double-up"></i></a>
	<div class="row footer">
		<div class="col-lg-3 container-quotes">
			<h1>
				"Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book"
			</h1>
			<h2>Mr. Richard</h2>
			<p>Founder of KES</p>
		</div>
		<div class="col-lg-3 container-sitemap">
			<div class="col-lg-6 link">
				<div class="float-right">
					<a href="#">kes system</a>
				</div>
			</div>
			<div class="col-lg-6 link">
				<a href="#">news</a>
			</div>
			<div class="col-lg-6 link">
				<div class="float-right">
					<a href="#">technology</a>
				</div>
			</div>
			<div class="col-lg-6 link">
				<a href="#">membership</a>
			</div>
			<div class="col-lg-6 link">
				<div class="float-right">
					<a href="#">our partners</a>
				</div>
			</div>
			<div class="col-lg-6 link">
				<a href="#">privacy</a>
			</div>
			<div class="col-lg-6 link">
				<div class="float-right">
					<a href="#">privacy</a>
				</div>
			</div>
			<div class="col-lg-6 link">
				<a href="#">term</a>
			</div>
		</div>
		<div class="col-lg-3 container-box">
			<div class="col-lg-12 box">
				<i class="fa fa-map-marker in-icon"></i><h1>Jalan Pluit Karang Utara Blok H1 Selatan No. 80 Jakarta Utara, Indonesia - 14450</h1>
			</div>
			<div class="col-lg-12 box-2">
				<i class="fa fa-phone in-icon"></i><h1>(021) 6678519 & (021) 22661372</h1>
			</div>
			<div class="input-group mb-3">
		    	<input type="text" class="form-control" placeholder="Enter your email">
		    	<div class="input-group-append">
		      		<button class="btn btn-primary" type="submit">Subscribe</button>  
		     	</div>
		  	</div>
		</div>
		<div class="col-lg-3 container-coverage">
			<img src="assets/images/coverage-area.png" alt="kes coverage area">
		</div>
	</div>
</div>
<script src="assets/js/default.js"></script>
<script src="assets/js/news.js"></script>
</body>
</html>