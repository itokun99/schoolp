
<style>
      @font-face {
        font-family: 'Glyphicons Halflings';
        src:
          url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/fonts/glyphicons-halflings-regular.ttf') format('truetype');
      }
</style>
<link rel="stylesheet" href="assets/css/bootstrap-stars.css">

<script src="assets/js/jquery.barrating.js"></script>
	
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-star-o fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Penilaian Guru</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
						
							<div class="box-body">
								 <?php          
								   $err_message = $this->session->userdata('err_message');
								   $this->session->unset_userdata("err_message");
								 ?>
								 <?php if (isset($err_message) && $err_message <> "") { ?>
								   <div class="alert alert-warning">
									 <center><font color="#ffffff"><?php echo $err_message; ?></font></center>
								   </div>
								 <?php } ?>
								 
								 <?php if (isset($school) && is_object($school) && $school != false) { ?>
									<?php if (isset($classroom) && is_object($classroom) && $classroom != false) { ?>
									<form class="form-horizontal" id="formClassMessage" action="assessment/insert_db" method="POST" enctype="multipart/form-data">
									<input type="Hidden" name="school_id" value="<?php echo $school_id ?>">
									<input type="Hidden" name="student_id" value="<?php echo $student_id ?>">
									<input type="Hidden" name="classroom_id" value="<?php echo $classroom_id ?>">
									   <div class="form-body pal">
										   <div class="form-group">
											  <label class="control-label col-lg-3">Sekolah</label>
											  <div class="col-lg-9">
												 <div class="col-lg-12 row">
													 <input type="text" class="form-control" value="<?php echo $school->school_name ?>" disabled>
												 </div>
											  </div>
										   </div>
										   <div class="form-group">
											  <label class="control-label col-lg-3">Kelas</label>
											  <div class="col-lg-9">
												 <div class="col-lg-12 row">
													 <input type="text" class="form-control" value="<?php echo $classroom->classroom_name ?>" disabled>
												 </div>
											  </div>
										   </div>
										   <div class="form-group">
											  <label class="control-label col-lg-3">Guru</label>
											  <div class="col-lg-9">
												 <div class="col-lg-12 row">
													 <select name="teacher_id" id="teacher_id_drop" class="form-control" autocomplete="off" required="yes">
														   <option value="">Pilih:</option>
														   <option value="">---</option>
													   <?php foreach($teachers AS $teacher) { ?>								
														   <option value="<?php echo $teacher->memberid ?>"><?php echo "$teacher->fullname" ?></option>	
													   <?php } ?>	
													 </select>
												 </div>
											  </div>
										   </div>
										   <div class="form-group">
											  <label class="control-label col-lg-3">Pilih Peringkat</label>
											  <div class="col-lg-9">
												 <div class="col-lg-12 row">
													 <select id="teacher-rating" name="rating" autocomplete="off" required="yes" style="margin-top: 15px">
														 <option value="1">1</option>
														 <option value="2">2</option>
														 <option value="3" selected>3</option>
														 <option value="4">4</option>
														 <option value="5">5</option>
													 </select>
												 </div>
											  </div>
										   </div>
										   <div class="form-group">
											  <label class="control-label col-lg-3">Komentar</label>
											  <div class="col-lg-9">
												 <div class="col-lg-12 row">
													 <textarea class="form-control" name="comment" required="true" style="height:150px"></textarea>
												 </div>
											  </div>
										   </div>
										   <div class="form-group">
											  <label class="control-label col-lg-3"></label>
											  <div class="col-lg-9">
												 <div class="col-lg-12 row">
													<button id="btnSave" type="submit" class="btn btn-info " style="padding: 7px 15px 7px 15px">Simpan</button>												 
												 </div>
											  </div>
										   </div>
										   
									   </div>							   
								   </form>
								   <?php } else { ?>
									   <div class="col-lg-12" style="height: 50px"></div>
									   <div align='center' class='alert-box info'>Fitur ini tidak bisa diakses <br>karena anda tiak terdaftar di kelas ini.</div>
								   <?php } ?>
								
								<?php } else { ?>
								    <br>
									<div class="alert alert-grey" style="padding: 5px;">
										<div style="text-align: center; height: 24px"><font color="#cc3300">Tidak Ada Data di Databse.</font></div>
								    </div>
								<?php } ?>
								 
							 </div>
						
				        </div>
					</div>
			</div>
		</div>
	</div>
</div>                 

<script type="text/javascript">
  $(document).ready(function() {	
	  var teacher_go = [];
	  $('#teacher_id_drop option').each(function() {
		  teacher_go.push( $(this).attr('text') );
	  });
  
	  $('#teacher_id_drop').select2({
		  data: teacher_go
	  });
	  
	  function ratingEnable() {
          $('#teacher-rating').barrating({
              theme: 'bootstrap-stars',
              showSelectedRating: false
          });
      }

      function ratingDisable() {
          $('select').barrating('destroy');
      }

      $('.rating-enable').click(function(event) {
          event.preventDefault();

          ratingEnable();

          $(this).addClass('deactivated');
          $('.rating-disable').removeClass('deactivated');
      });

      $('.rating-disable').click(function(event) {
          event.preventDefault();

          ratingDisable();

          $(this).addClass('deactivated');
          $('.rating-enable').removeClass('deactivated');
      });

      ratingEnable();
	
  });
</script>