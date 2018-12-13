<?php include ('head.php'); ?>
<?php include ('navigator.php'); ?>
<div class="container-fluid">
	<div class="row news header">
		<div id="news-list" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<div class="news-info">
						<h6>PENDIDIKAN | 16 Okt 2018</h6>
						<h2>Komitmen Samsung Tingkatkan Pendidikan Berbasis Teknologi di Biak</h2>
						<p>Dalam dunia pendidikan, teknologi memang menjadi sebuah keharusan agar kualitas pendidikan anak di Indonesia, khususnya di daerah terpencil bisa lebih baik dan semakin maju</p>
					</div>
					<img src="assets/website/images/news/sample-header-news-3.jpg" alt="berita seputar pendidikan">
				</div>
				<div class="carousel-item">
					<div class="news-info">
						<h6>PENDIDIKAN | 16 Okt 2018</h6>
						<h2>Demi Persaingan Global, Indonesia Perbaiki Standar Kualitas Pendidikan</h2>
						<p>Para stakeholder utama di sektor edukasi Indonesia hari ini berkumpul bersama pada acara pembukaan GESS Indonesia 2018, di mana acara ini mengekspresikan optimisme dalam melihat prospek gemilang sistem</p>
					</div>
					<img src="assets/website/images/news/sample-header-news-2.jpg" alt="berita seputar pendidikan">
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
					</div>
				</div>
			</div>
			<?php for($i = 0; $i<3; $i++) 
				{?>
			<div class="container-news">
				<div class="card-news-list">
					<div class="card-news-header d-flex align-items-center justify-content-center">
						<img src="../schoolm/assets/images/news/mm_<?php echo $news[$i]['newspicture'] ?>" alt="berita seputar pendidikan">
					</div>
					<div class="card-news-content">
						<marquee behavior="scroll" direction="left" scrollamount="2"><h5><?php echo $news[$i]['newstitle'] ?></h5></marquee>
						<?php 
						$datestring = $news[$i]['datez'];
						$date = date('d M Y', strtotime($datestring));
						?>
						<h7><?php echo $date ?></h7>
					</div>
				</div>
			</div>
			<?php
			}?>
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
				<?php for($i = 0; $i<count($news); $i++) 
				{?>
					<div class="latest-post-content-left">
						<div class="latest-post-content-image">
							<img src="../schoolm/assets/images/news/mm_<?php echo $news[$i]['newspicture'] ?>" alt="berita seputar pendidikan">
						</div>
						<h3><?php echo $news[$i]['newstitle']; ?></h3>
						<div class="latest-post-content-category">
							<div class="btn-group">
								<button class="post-category">PENDIDIKAN</button>
								<button class="post-date">
									<?php 
									$datestring = $news[$i]['datez'];
									echo date('d M Y', strtotime($datestring));
									?>
								</button>
							</div>
						</div>
						<div class="latest-post-content-news-overview">
							<p><?php echo $news[$i]['newsbody']?></p>
						</div>
						<a href="newsdetail?id=<?php echo $news[$i]['newsid']; ?>" target="_blank"><button class="post-read">Read more</button>  </a>
					</div>
				<?php
				}?>
			</div>
			<div class="news-divider"></div>
			<div class="container-recommended">
				<div class="recommended-post-header">
					<h5>Berita yang dianjurkan</h5>
				</div>
				<?php for($i = 0; $i<3; $i++) 
				{?>
				<div class="recommended-post-content">
					<div class="recommended-post-content-image d-flex align-items-center justify-content-center">
						<img src="../schoolm/assets/images/news/mm_<?php echo $news[$i]['newspicture'] ?>" alt="berita seputar pendidikan">
					</div>
					<h5><?php echo $news[$i]['newstitle']?></h5>
					<div class="recommended-date">
						<p>PENDIDIKAN</p>
						<p><?php echo $date ?></p>
					</div>
				</div>
				<?php
				}?>
			</div>
		</div>
	</div>
</div>
<div class="section-divider"></div>
<?php include('footer.php'); ?>
</body>
</html>
